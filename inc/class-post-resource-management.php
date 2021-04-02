<?php
if (!defined('ABSPATH')) exit;

class Quest_Resource_Management
{
    /**
     * The single instance of WordPress_Plugin_Template_Settings.
     * @var    object
     * @access  private
     * @since    1.0.0
     */
    private static $_instance = null;
    /**
     * The main plugin object.
     * @var    object
     * @access  public
     * @since    1.0.0
     */
    protected $table = 'quest_post_resources';

    public function __construct()
    {
        global $table_prefix;
        $this->table = $table_prefix . 'quest_post_resources';
        add_action('add_meta_boxes', array($this, 'resource_meta_box_activation'));
        add_action('save_post', array($this, 'resource_meta_box_save'));
        add_action("after_switch_theme", array($this, 'init_database'));
    }

    public function resource_meta_box_activation()
    {
        add_meta_box(
            'quest-resource',
            __('Resources', 'quest'),
            array($this, 'resource_meta_box_output'),
            ['page'],
            'normal',
            'high'
        );
    }

    public function resource_meta_box_output($post)
    {

        wp_nonce_field('resource_meta_box_activation', 'resource_meta_box_activation_nonce'); ?>
        <div class="row">
            <div class="col-6">
                <select class="f-select" multiple="multiple" name="resources[]">
                    <?php
                    $resource_ids = $this->get_resource_ids($post->ID);

                    $avail_resource_ids = $this->get_available_resource_ids();
                    $_post_type = '';
                    foreach ($avail_resource_ids as $_res_id) {
                        $_post = get_post($_res_id);
                        if ($_post_type != $_post->post_type) {
                            if ($_post_type != '') {
                                echo '</optgroup>';
                            }
                            $_post_type = $_post->post_type;
                            $_pt = get_post_type_object($_post_type);
                            echo '<optgroup data-icon="'.$_pt->name.'" label="' . $_pt->label . '">';
                        }
                        $_selected = in_array($_post->ID, $resource_ids) ? 'selected="selected"' : '';
                        echo '<option ' . $_selected . ' value="' . $_post->ID . '">' . $_post->post_title . '</option>';
                    }
                    if ($_post_type != '') {
                        echo '</optgroup>';
                    }
                    /*$args = array(
                        'post_type' => quest_get_post_types('resources'),
                        'order_by' => ['type' => 'ASC', 'ID' => 'DESC']
                    );
                    $query = new WP_Query($args);
                    $_post_type = '';
                    while ($query->have_posts()) : $query->the_post();
                        if ($_post_type != get_post_type()) {
                            $_post_type = get_post_type();
                            $_pt = get_post_type_object($_post_type);
                            if ($_post_type != '') {
                                echo '</optgroup>';
                            }
                            echo '<optgroup label="' . $_pt->label . '">';
                        }
                        $_selected = in_array(get_the_ID(), $resource_ids) ? 'selected="selected"' : '';
                        echo '<option ' . $_selected . ' value="' . get_the_ID() . '">' . get_the_title() . '</option>';
                    endwhile;
                    wp_reset_postdata();
                    if ($_post_type != '') {
                        echo '</optgroup>';
                    }*/

                    ?>
                </select>
            </div>
            <div class="col-6">
                <ul class="resource-preview"></ul>
            </div>
        </div>
        <script>
            var QUEST_RS_LIST = <?php echo json_encode($resource_ids);?>;
            jQuery(document).ready(function () {
                var $ = jQuery;
                $('.f-select').fSelect({
                    inline:true,
                    placeholder: "Select page resources"
                }).on('change', function (e) {
                    var me = $(this);
                    generateResourceHTML();

                });
                $(document).on('click', '.resource-preview .resource-group label', function () {
                    $(this).parent().toggleClass('collapsed');
                });
                generateResourceHTML(true);
            });

            function generateResourceHTML(init) {
                var $ = jQuery;
                var _ids = $('.f-select').val();
                if(init) {
                    _ids = QUEST_RS_LIST;
                    QUEST_RS_LIST = [];
                }
                var me = $('.f-select');
                var out = $('.resource-preview');
                var _opts = $('.f-select').find('option');
                var _ogs = $('.f-select').find('optgroup');
                var _html = $('.resource-preview');
                /* Add items */
                for (var i in _ids) {
                    var _id = _ids[i];
                    var _i = QUEST_RS_LIST.indexOf(_id);
                    if (_i < 0) {
                        // Add new
                        var _opt = _opts.filter('[value="' + _id + '"]');
                        var _og = _opt.parent('optgroup');
                        var _og_i = _ogs.index(_og);
                        var _og_e = null;
                        _og_e = _html.find('li[data-group="' + _og_i + '"] ul');
                        if (_og_e.length == 0) {
                            _og_e = $('<li class="resource-group" data-count="0" data-group="' + _og_i + '"><label>' + _og.attr('label') + '</label><ul data-icon="' + _og.attr('data-icon') + '"></ul></li>');
                            _html.append(_og_e);
                            _og_e = _og_e.children('ul');
                        }
                        _og_e.append('<li class="resource-item" data-id="' + _opt.attr('value') + '"><em class="quest-icon quest-'+_og_e.attr('data-icon')+'"></em> ' + _opt.text() + '<input type="hidden" name="resource_oder[' + _opt.attr('value') + ']" value="" /></li>');
                        var _og_liv = _og_e.parent();
                        _og_liv.attr('data-count', _og_liv.attr('data-count') - 0 + 1);
                    } else {
                        QUEST_RS_LIST.splice(_i, 1);
                    }
                }
                /* Remove items */
                for (var i in QUEST_RS_LIST) {
                    var _og_item = _html.find('li[data-id="' + QUEST_RS_LIST[i] + '"]');
                    var _og_liv = _og_item.closest('[data-group]');
                    var _cnt = _og_liv.attr('data-count');
                    if (_cnt - 1 <= 0) {
                        _og_liv.remove();
                    } else {
                        _og_liv.attr('data-count', _cnt - 1);
                        _og_item.remove();
                    }
                }
                /* Reorder item */
                reorder_resource_items();
                /* Make them sortable */
                QUEST_RS_LIST = _ids === null ? [] : _ids;
                $('.resource-preview').sortable({
                    placeholder: "resource-group-highlight",
                    stop: function (e,ui) {
                        reorder_resource_items();
                    }
                });
                $('.resource-preview').disableSelection(); // worked great
                $('.resource-group ul').each(function () {
                    $(this).sortable({
                        placeholder: "resource-item-highlight",
                        connectWith: ['.resource-group'],
                        stop: function (e,ui) {
                            reorder_resource_items();
                        }
                    });
                });
            }
            function reorder_resource_items() {
                var $ = jQuery;
                var _html = $('.resource-preview');
                var _i = 0;
                _html.find('.resource-item').each(function () {
                    $(this).find('input').val(_i++);
                })
            }
        </script>
        <?php
    }

    public function resource_meta_box_save($post_id)
    {

        if (!isset($_POST['resource_meta_box_activation_nonce']) || !wp_verify_nonce($_POST['resource_meta_box_activation_nonce'], 'resource_meta_box_activation'))
            return;

        if (!current_user_can('edit_post', $post_id))
            return;


        if (isset($_POST['resources'])) {
            $this->save_resources($post_id, $_POST['resources'], $_POST['resource_oder']);
        }

    }

    public function save_resources($post_id, $resources,$orders)
    {
        global $wpdb;
        $ids = implode(',', array_map('absint', $resources));
        $wpdb->query($wpdb->prepare("DELETE FROM {$this->table} WHERE post_id=%d AND resource_id NOT IN($ids)", $post_id));
        //die($wpdb->prepare("DELETE FROM {$this->table} WHERE post_id=%d AND resource_id IN($ids)", $post_id));
        if (!empty($resources)) {
            $_post_terms = wp_list_pluck(wp_get_object_terms($post_id, QUEST_TAXONOMY_SERVICE), 'term_id');
            foreach ($resources as $resource_id) {
                $wpdb->replace(
                    $this->table,
                    array(
                        'post_id' => $post_id,
                        'resource_id' => $resource_id,
                        'order' => empty($orders[$resource_id])?0:$orders[$resource_id]
                    ),
                    array(
                        '%d',
                        '%d'
                    )
                );
                // Copy post's services to resource
                wp_set_object_terms($resource_id, $_post_terms, QUEST_TAXONOMY_SERVICE);
            }
        }
    }

    public function get_available_resource_ids()
    {
        global $wpdb;
        //SELECT SQL_CALC_FOUND_ROWS  wp_posts.ID FROM wp_posts  WHERE 1=1  AND wp_posts.post_type IN ('assessment', 'workshop', 'solution-brief', 'video', 'resource-blog', 'resource-newsletter') AND (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'future' OR wp_posts.post_status = 'draft' OR wp_posts.post_status = 'pending' OR wp_posts.post_author = 1 AND wp_posts.post_status = 'private')  ORDER BY wp_posts.post_date
        $_post_types = implode("','", quest_get_post_types('resources'));
        return $wpdb->get_col($wpdb->prepare(
            "
	SELECT      ID
	FROM        $wpdb->posts
	WHERE       post_type IN ('$_post_types')
	  AND post_status = %s OR post_status = %s
	  ORDER BY post_type, post_date DESC
	", 'publish', 'future'));
    }

    public function get_resource_ids($post_id)
    {
        global $wpdb;
        return $wpdb->get_col($wpdb->prepare(
            "
	SELECT      resource_id
	FROM        $this->table
	WHERE       post_id=%d
	ORDER BY `order`, resource_id
	",
            $post_id
        ));
    }

    public function init_database()
    {
        global $wpdb;


        if ($wpdb->get_var("show tables like '$this->table'") != $this->table) {

            $sql = "CREATE TABLE `" . $this->table . "` ( ";
            $sql .= " `post_id` bigint(20) UNSIGNED NOT NULL, ";
            $sql .= " `resource_id` bigint(20) UNSIGNED NOT NULL, ";
            $sql .= "  `order`  int(11)   NOT NULL DEFAULT 100, ";
            $sql .= "  `resource_type`  varchar(20) NOT NULL DEFAULT '', ";
            $sql .= "  PRIMARY KEY (`post_id`,`resource_id`) ";
            $sql .= "); ";
            require_once(ABSPATH . '/wp-admin/includes/upgrade.php');
            dbDelta($sql);
        }
    }

    /**
     * Main WordPress_Plugin_Template_Settings Instance
     *
     * Ensures only one instance of WordPress_Plugin_Template_Settings is loaded or can be loaded.
     *
     * @since 1.0.0
     * @static
     * @see WordPress_Plugin_Template()
     * @return Main WordPress_Plugin_Template_Settings instance
     */
    public
    static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    } // End instance()

    /**
     * Cloning is forbidden.
     *
     * @since 1.0.0
     */
    public
    function __clone()
    {
        _doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?'), $this->parent->_version);
    } // End __clone()

    /**
     * Unserializing instances of this class is forbidden.
     *
     * @since 1.0.0
     */
    public
    function __wakeup()
    {
        _doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?'), $this->parent->_version);
    } // End __wakeup()
}
