<?php
if (!defined('ABSPATH')) exit;

class Quest_Custom_Filed_Taxonomy
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
    protected $font_icons = array(
        'quest-disaster-recovery-workshop' => 'Disaster recovery workshop',
        'quest-risk-management-workshop' => 'Risk management workshop',
        'quest-network-health-infrastruture' => 'Network health infrastruture',
        'quest-managed-it-cloud-new' => 'Managed it cloud new',
        'quest-it-infrastructure-new' => 'It infrastructure new',
        'quest-backup-data-recovery' => 'Backup data recovery',
        'quest-it-infrastructure' => 'IT Infrastructure',
        'quest-disaster-recovery' => 'Disaster Recovery',
        'quest-agriculture' => 'Agriculture',
        'quest-commercial' => 'Commercial',
        'quest-contact' => 'Contact',
        'quest-cybersecurity' => 'Cybersecurity',
        'quest-date' => 'Date',
        'quest-document' => 'Document',
        'quest-financial' => 'Financial',
        'quest-government' => 'Government',
        'quest-healthcare' => 'Health Care',
        'quest-legal' => 'Legal',
        'quest-location' => 'Location',
        'quest-mail' => 'Mail',
        'quest-managed-it-cloud' => 'Managed IT Cloud',
        'quest-person' => 'Person',
        'quest-professional-services' => 'Professional Services',
        'quest-technology' => 'Technology',
        'quest-manufacturing' => 'Manufacturing',
        'quest-time' => 'Time',
        'quest-workshop' => 'Workshop',
        'quest-video' => 'Video',
        'quest-newsletter' => 'Newsletter',
        'quest-solution-brief' => 'Solution Brief',
        'quest-assessment' => 'Assessment',
        'quest-blog' => 'Blog',
        'quest-infographic' => 'Infographic',
    );

    public function __construct()
    {
        ksort($this->font_icons);
        add_action('service_add_form_fields', array($this, 'service_taxonomy_add_new_meta_field'), 10, 2);
        add_action('edited_service', array($this, 'update_taxonomy_custom_meta'), 10, 2);
        add_action('create_service', array($this, 'save_taxonomy_custom_meta'), 10, 2);
        add_action('service_edit_form_fields', array($this, 'service_taxonomy_edit_meta_field'), 10, 2);
    }

    public function service_taxonomy_add_new_meta_field()
    {
        ?>
        <div class="form-field">
            <label for="term_icon"><?php _e('Icon', 'quest'); ?></label>
            <fieldset>
                <select name="term_icon" id="term_icon">
                    <option value="">-- Select Icon --</option>
                    <?php foreach ($this->font_icons as $font_icon => $font_name): ?>
                        <option value="<?php echo $font_icon ?>"
                                data-html="<em class='quest-icon <?php echo $font_icon ?>'></em>&nbsp;<?php echo esc_attr($font_name); ?>"><?php echo $font_name ?></option>
                    <?php endforeach; ?>
                </select>
            </fieldset>
            <p class="description"><?php _e('The icon of service.', 'quest'); ?></p>
        </div>
        <div class="form-field">
            <label for="term_landing_page"><?php _e('Landing page', 'quest'); ?></label>
            <fieldset>
                <select name="term_landing_page" id="term_landing_page">
                    <option value="">-- Select Landing page --</option>
                    <?php
                    $pages = get_pages();
                    $page_level = array();
                    ?><?php foreach ($pages as $_page):
                        $_level = 0;
                        if (!empty($_page->post_parent)) {
                            $_level = 1 + (empty($page_level[$_page->post_parent]) ? 0 : $page_level[$_page->post_parent]);
                            $page_level[$_page->ID] = $_level;
                        }
                        ?>
                        <option value="<?php echo $_page->ID ?>"><?php echo str_repeat('--', $_level) . ' ' . $_page->post_title ?></option>
                    <?php endforeach; ?>
                </select>
            </fieldset>
            <p class="description"><?php _e('The landing page of service', 'quest'); ?></p>
        </div>
        <div class="form-field">
            <label for="term_ordering"><?php _e('Ordering', 'quest'); ?></label>
            <fieldset>
                <input name="term_ordering" id="term_ordering" value="0" type="number">
            </fieldset>
            <p class="description"><?php _e('Services order', 'quest'); ?></p>
        </div>
        <?php
    }


    public function service_taxonomy_edit_meta_field($term)
    {

        // put the term ID into a variable
        $t_id = $term->term_id;
        // retrieve the existing value(s) for this meta field. This returns an array
        $term_icon = get_term_meta($t_id, 'icon', true);
        $_term_page_id = get_term_meta($t_id, 'landing_page', true);
	    $term_ordering = get_term_meta($t_id, 'ordering', true);
        ?>

        <tr class="form-field">
            <th scope="row" valign="top"><label
                        for="term_icon"><?php _e('Font icon', 'quest'); ?></label></th>
            <td>
                <fieldset style="border: 0">
                    <select name="term_icon" id="term_icon">
                        <option value=""> Select Font Icon</option>
                        <?php foreach ($this->font_icons as $font_icon => $font_name):
                            if (is_numeric($font_icon)) $font_icon = $font_name;
                            ?>
                            <option <?php echo ($term_icon == $font_icon) ? 'selected' : '' ?>
                                    value="<?php echo $font_icon ?>"
                                    data-html="<em class='quest-icon <?php echo $font_icon ?>'></em>&nbsp;<?php echo esc_attr($font_name); ?>"> <?php echo $font_name ?></option>
                        <?php endforeach; ?>
                    </select>
                </fieldset>

                <p class="description"><?php _e('Choose font icon.', 'quest'); ?></p>
            </td>
        </tr>
        <tr class="form-field">
            <th scope="row" valign="top"><label
                        for="term_landing_page"><?php _e('Landing page', 'quest'); ?></label></th>
            <td>
                <fieldset style="border: 0">

                    <select name="term_landing_page" id="term_landing_page">
                        <option value="">-- Select Landing page --</option>
                        <?php
                        $pages = get_pages();
                        $page_level = array();
                        ?><?php foreach ($pages as $_page):
                            $_level = 0;
                            if (!empty($_page->post_parent)) {
                                $_level = 1 + (empty($page_level[$_page->post_parent]) ? 0 : $page_level[$_page->post_parent]);
                                $page_level[$_page->ID] = $_level;
                            }
                            ?>
                            <option <?php echo $_page->ID == $_term_page_id ? 'selected' : '' ?>
                                    value="<?php echo $_page->ID ?>"><?php echo str_repeat('--', $_level) . ' ' . $_page->post_title ?></option>
                        <?php endforeach; ?>
                    </select>
                </fieldset>

                <p class="description"><?php _e('The landing page of service', 'quest'); ?></p>
            </td>
        </tr>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="term_ordering"><?php _e('Ordering', 'quest'); ?></label></th>
            <td>
                <fieldset style="border: 0">
                    <input name="term_ordering" id="term_ordering" value="<?php echo empty($term_ordering) ? 0 : $term_ordering; ?>" type="number">
                </fieldset>
                <p class="description"><?php _e('Services ordering', 'quest'); ?></p>
            </td>
        </tr>
        <?php
    }

    public function update_taxonomy_custom_meta($term_id)
    {
        if (isset($_POST['term_icon'])) {
            $cat_keys = $_POST['term_icon'];
            update_term_meta($term_id, 'icon', $cat_keys);
        }
        if (isset($_POST['term_landing_page'])) {
            $cat_keys = $_POST['term_landing_page'];
            update_term_meta($term_id, 'landing_page', $cat_keys);
        }
	    if (isset($_POST['term_ordering'])) {
		    $cat_keys = is_numeric($_POST['term_ordering']) ? $_POST['term_ordering'] : 0;
		    update_term_meta($term_id, 'ordering', $cat_keys);
	    }
    }

    public function save_taxonomy_custom_meta($term_id)
    {
        if (isset($_POST['term_icon'])) {
            $cat_keys = $_POST['term_icon'];
            add_term_meta($term_id, 'icon', $cat_keys);
        }
        if (isset($_POST['term_landing_page'])) {
            $cat_keys = $_POST['term_landing_page'];
            add_term_meta($term_id, 'landing_page', $cat_keys);
        }
	    if (isset($_POST['term_ordering'])) {
		    $cat_keys = is_numeric($_POST['term_ordering']) ? $_POST['term_ordering'] : 0;
		    add_term_meta($term_id, 'ordering', $cat_keys);
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
