<?php
if (!defined('ABSPATH')) exit;

class Quest_MetaBox_Blog_Authors
{
    private static $_instance = null;

    public function __construct()
    {
        add_action('add_meta_boxes', array($this, 'resource_meta_box_activation'));
        add_action('save_post', array($this, 'resource_meta_box_save'));
    }

    public function resource_meta_box_activation()
    {
        global $post;
	    if ( 'page-templates/quest-blog.php' == get_post_meta( $post->ID, '_wp_page_template', true )){
            add_meta_box(
                'quest-blog-author',
                __( 'Blog Authors', 'quest' ),
                array( $this, 'resource_meta_box_output' ),
                'page',
                'normal',
                'high'
            );
        }
    }

    public function resource_meta_box_output($post)
    {
        wp_enqueue_media();
        wp_nonce_field('quest_meta_box_blog_author', 'quest_meta_box_blog_author_nonce');

        $blog_authors = get_post_meta($post->ID, 'quest_blog_authors', true);
        $blog_authors = json_decode($blog_authors);
        $blog_authors = is_array($blog_authors) ? $blog_authors : [];
        $authors = get_users();
	    ?>

        <div class="fs-wrap multiple" tabindex="0">
            <select name="quest_blog_authors[]" id="quest-metabox-blog-author" class="fs-select" multiple="">
                <?php foreach ($authors as $author) : ?>
                <option <?php echo in_array($author->data->ID, $blog_authors) ? 'selected' : '';?>
                        value="<?php echo $author->data->ID?>"><?php echo $author->data->display_name; ?></option>
                <?php endforeach; ?>
            </select>
            <script>
                jQuery(document).ready(function () {
                    jQuery('#quest-metabox-blog-author').fSelect();
                });
            </script>
        </div>

        <?php
    }

    public function resource_meta_box_save($post_id)
    {

        if (!isset($_POST['quest_meta_box_blog_author_nonce']) || !wp_verify_nonce($_POST['quest_meta_box_blog_author_nonce'], 'quest_meta_box_blog_author'))
            return;

        if (!current_user_can('edit_post', $post_id))
            return;

        if (isset($_POST['quest_blog_authors'])) {
            update_post_meta($post_id, 'quest_blog_authors', json_encode( $_POST['quest_blog_authors'] ));
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