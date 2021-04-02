<?php
if (!defined('ABSPATH')) exit;

class Quest_Meta_Box_Information_Post
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

    public function __construct()
    {
        add_action('add_meta_boxes', array($this, 'meta_box_information_post'));
        add_action('save_post', array($this, 'information_save_meta'));
    }

    public function meta_box_information_post()
    {
        add_meta_box(
            'information',
            __( 'Post Settings', 'quest'),
            array($this,'meta_output_information_post'),
            get_post_types(array('public' => true)),
            'side',
            'high'
        );
    }

    public function meta_output_information_post($post){
        wp_nonce_field('save_information_post', 'information_post_nonce'); ?>

        <?php
        $quest_is_featured = get_post_meta($post->ID, 'is-featured', true);
	    $quest_is_author_hidden = get_post_meta($post->ID, 'is-author-hidden', true);
        $quest_old_link = get_post_meta($post->ID, 'old-link', true);
        $quest_contact_us_blog_link = get_post_meta($post->ID, 'contact_us_blog_link');
        if (empty($quest_contact_us_blog_link)) {
	        $quest_contact_us_blog_link = 'https://www.questsys.com/contact/?utm_source=Blog&utm_medium=Footer&utm_campaign=';
	        $quest_contact_us_blog_link .= rawurlencode(strip_tags($post->post_title));
        } else {
	        $quest_contact_us_blog_link = reset($quest_contact_us_blog_link);
        }
//	    $quest_naspo_link = get_post_meta($post->ID, 'naspo-link', true);
//	    if (empty($quest_naspo_link)) {
//		    $quest_naspo_link = 'https://www.questsys.com/naspo-valuepoint-supplier-partner/';
//        }
        $quest_is_exclude_search = get_post_meta($post->ID,'exclude-search', true);
        $quest_is_exclude_resource = get_post_meta($post->ID,'exclude-resource', true);
        $quest_is_exclude_search_engines = get_post_meta($post->ID,'exclude-search-engines', true);
        if($quest_is_exclude_search_engines===''){
            // If the post has been set this meta, load from the options
            $_excludes = $this->getExcludedSearchEngines();
            if($_excludes) {
                $quest_is_exclude_search_engines = in_array($post->ID, $_excludes);
            }
        }
        if (get_post_type($post->ID) == QUEST_POST_TYPE_RESOURCE_CLIP) {
            $quest_is_blank_target = get_post_meta($post->ID, 'is-blank-target', true);
            $checked = '';
            if ($quest_is_blank_target == '' || $quest_is_blank_target == 1) $checked = 'checked';
        }
        if (get_post_type($post->ID) == QUEST_POST_TYPE_RESOURCE_SOLUTION_BRIEF) {
            $quest_show_form_view = get_post_meta($post->ID, 'is-show-form-view', true);
            $checkedView = '';
            if ($quest_show_form_view == '' || $quest_show_form_view == 1) $checkedView = 'checked';
            $quest_view_link = get_post_meta($post->ID, 'view-link', true);
        }
        ?>
        <?php if(in_array(get_post_type($post->ID), quest_blog_post_types())) : ?>
        <p>
            <input type="checkbox" class="widefat" name="quest_is_author_hidden"
                   value="hidden" <?php if ($quest_is_author_hidden == 1) echo 'checked' ?>/>
            <label title="Do not display author information of the blog post" for="quest_is_author_hidden"><?php _e('Hide Author', 'quest'); ?></label>
        </p>
        <?php endif; ?>
        <p>
            <input type="checkbox" class="widefat" name="quest_is_featured"
                   value="featured" <?php if ($quest_is_featured == 1) echo 'checked' ?>/>
            <label for="quest_is_featured"><?php _e('Is featured', 'quest'); ?></label>
        </p>
        <p>
            <input type="checkbox" class="widefat" name="quest_is_exclude_search"
                   value="exclude_search" <?php if ($quest_is_exclude_search == 1) echo 'checked' ?>/>
            <label for="quest_is_exclude_search"><?php _e('Exclude from Search', 'quest'); ?></label>
        </p>
        <p>
            <input type="checkbox" class="widefat" name="quest_is_exclude_search_engines"
                   value="exclude_search_engines" <?php if ($quest_is_exclude_search_engines == 1) echo 'checked' ?>/>
            <label for="quest_is_exclude_search_engines"><?php _e('Exclude from Search Engines', 'quest'); ?></label>
        </p>
        <p>
            <input type="checkbox" class="widefat" name="quest_is_exclude_resource"
                   value="exclude_resource" <?php if ($quest_is_exclude_resource == 1) echo 'checked' ?>/>
            <label for="quest_is_exclude_resource"><?php _e('Exclude from Resource', 'quest'); ?></label>
        </p>
        <p>
            <label for="quest_old_link"><?php _e('Old Link', 'quest'); ?></label><br/>
            <input type="text" class="widefat" name="quest_old_link" value="<?php echo esc_attr($quest_old_link); ?>"/>
        </p>
	    <?php if (in_array(get_post_type($post->ID), quest_get_list_blog_page_constants())) : ?>
                <p>
                    <label for="quest_contact_us_blog_link"><?php _e('Contact Us Link', 'quest'); ?></label><br/>
                    <input type="text" id="quest_contact_us_blog_link" class="widefat" name="quest_contact_us_blog_link" value="<?php echo esc_attr($quest_contact_us_blog_link); ?>"/>
                </p>
	    <?php endif; ?>
	    <?php if (in_array(get_post_type($post->ID),[QUEST_POST_TYPE_GOVERNMENT_BLOG, QUEST_POST_TYPE_SECURITY_BLOG])) : ?>
<!--        <p>-->
<!--            <label for="quest_naspo_link">--><?php //_e('NASPO Link', 'quest'); ?><!--</label><br/>-->
<!--            <input type="text" class="widefat" name="quest_naspo_link" value="--><?php //echo esc_attr($quest_naspo_link); ?><!--"/>-->
<!--        </p>-->
        <?php endif; ?>
        <?php if($post->post_type == QUEST_POST_TYPE_RESOURCE_SOLUTION_BRIEF ) : ?>
            <fieldset style="border: 1px solid #ccc; padding: 10px; margin-bottom: 20px;">
                <legend>View Solution Brief</legend>
                <p>
                    <input type="checkbox" class="widefat" name="quest_show_form_view"
                           value="show" <?php echo $checkedView; ?>/>
                    <label for="quest_show_form_view"><?php _e('View block', 'quest'); ?></label>
                </p>
                <p>
                    <label for="quest_view_link"><?php _e('View Link', 'quest'); ?></label><br/>
                    <input type="text" class="widefat" name="quest_view_link"
                           value="<?php echo esc_attr($quest_view_link); ?>"/>
                </p>
            </fieldset>
        <?php endif; ?>
        <?php if ($post->post_type == QUEST_POST_TYPE_RESOURCE_CLIP) : ?>
            <p>
                <input type="checkbox" class="widefat" name="quest_is_blank_target" value="blank" <?php echo $checked; ?>/>
                <label for="quest_is_blank_target"><?php _e('Is blank target', 'quest'); ?></label>
            </p>

        <?php endif; ?>
        <?php
    }

    public function information_save_meta($post_id){
        if (!isset($_POST['information_post_nonce']) || !wp_verify_nonce($_POST['information_post_nonce'], 'save_information_post'))
            return;

        if (!current_user_can('edit_post', $post_id))
            return;

        if (isset($_POST['quest_is_featured']) && $_POST['quest_is_featured'] == "featured") {
            update_post_meta($post_id, 'is-featured', 1);
        } else {
            update_post_meta($post_id, 'is-featured', 0);
        }

        if (isset($_POST['quest_is_author_hidden']) && $_POST['quest_is_author_hidden'] == "hidden") {
	        update_post_meta($post_id, 'is-author-hidden', 1);
        } else {
	        update_post_meta($post_id, 'is-author-hidden', 0);
        }

	    if (isset($_POST['quest_is_author_showed']) && $_POST['quest_is_author_showed'] == "showed") {
		    update_post_meta($post_id, 'is-author-showed', 1);
	    } else {
		    update_post_meta($post_id, 'is-author-showed', 0);
	    }

        if (isset($_POST['quest_is_exclude_search']) && $_POST['quest_is_exclude_search'] == "exclude_search") {
            $this->savePostIdToSearchExclude($post_id, 1);
            update_post_meta($post_id, 'exclude-search', 1);

        } else {
            $this->savePostIdToSearchExclude($post_id, 0);
            update_post_meta($post_id, 'exclude-search', 0);
        }
        if (isset($_POST['quest_is_exclude_resource']) && $_POST['quest_is_exclude_resource'] == "exclude_resource") {
            $this->savePostIdToResourceExclude($post_id, 1);
            update_post_meta($post_id, 'exclude-resource', 1);

        } else {
            $this->savePostIdToResourceExclude($post_id, 0);
            update_post_meta($post_id, 'exclude-resource', 0);
        }
        if (isset($_POST['quest_is_exclude_search_engines']) && $_POST['quest_is_exclude_search_engines'] == "exclude_search_engines") {
            $this->savePostIdToSearchEnginesExclude($post_id, 1);//Todo: add this function
            update_post_meta($post_id, 'exclude-search-engines', 1);

        } else {
            $this->savePostIdToSearchEnginesExclude($post_id, 0);
            update_post_meta($post_id, 'exclude-search-engines', 0);
        }
        if (isset($_POST['quest_old_link'])) {
            update_post_meta($post_id, 'old-link', sanitize_text_field($_POST['quest_old_link']));
        }
        if (isset($_POST['quest_contact_us_blog_link'])) {
            update_post_meta($post_id, 'contact_us_blog_link', strip_tags($_POST['quest_contact_us_blog_link']));
        }
	    if (isset($_POST['quest_naspo_link'])) {
		    update_post_meta($post_id, 'naspo-link', sanitize_text_field($_POST['quest_naspo_link']));
	    }
        $_post_type = get_post_type($post_id);
        if($_post_type == QUEST_POST_TYPE_RESOURCE_SOLUTION_BRIEF) {
            update_post_meta($post_id, 'is-show-form-view', isset($_POST['quest_show_form_view']) && $_POST['quest_show_form_view'] == "show" ? 1 : 0);
            update_post_meta($post_id, 'view-link', sanitize_text_field($_POST['quest_view_link']));
        }
        if ($_post_type == QUEST_POST_TYPE_RESOURCE_CLIP) {
            update_post_meta($post_id, 'is-blank-target', isset($_POST['quest_is_blank_target']) && $_POST['quest_is_blank_target'] == "blank" ? 1 : 0);
        }
    }
    protected function savePostIdToSearchExclude($postId, $exclude)
    {
        $this->savePostIdsToSearchExclude(array(intval($postId)), $exclude);
    }
    protected function savePostIdToResourceExclude($postId, $exclude)
    {
        $this->savePostIdsToResourceExclude(array(intval($postId)), $exclude);
    }

    protected function savePostIdToSearchEnginesExclude($postId, $exclude)
    {
        $this->savePostIdsToSearchEnginesExclude(array(intval($postId)), $exclude);
    }

    public function savePostIdsToSearchExclude($postIds, $exclude)
    {
        $exclude  = (bool) $exclude;
        $excluded = $this->getExcluded();

        if ($exclude) {
            $excluded = array_unique(array_merge($excluded, $postIds));
        } else {
            $excluded = array_diff($excluded, $postIds);
        }
        $this->saveExcluded($excluded);
    }
    public function savePostIdsToResourceExclude($postIds, $exclude)
    {
        $exclude  = (bool) $exclude;
        $excluded = $this->getExcludedResource();

        if ($exclude) {
            $excluded = array_unique(array_merge($excluded, $postIds));
        } else {
            $excluded = array_diff($excluded, $postIds);
        }
        $this->saveExcludedResource($excluded);
    }
    public function savePostIdsToSearchEnginesExclude($postIds, $exclude)
    {
        $exclude  = (bool) $exclude;
        $excluded = $this->getExcludedSearchEngines();

        if ($exclude) {
            $excluded = array_unique(array_merge($excluded, $postIds));
        } else {
            $excluded = array_diff($excluded, $postIds);
        }
        $this->saveExcludedSearchEngines($excluded);
    }

    protected function saveExcludedResource($excluded)
    {
        update_option('sep_exclude_resource', $excluded);
    }

    protected function getExcludedResource()
    {
        $excluded = get_option('sep_exclude_resource');
        if (!is_array($excluded)) {
            $excluded = array();
        }

        return $excluded;
    }
    protected function saveExcludedSearchEngines($excluded)
    {
        update_option('sep_exclude_search_engines', $excluded);
    }

    protected function getExcludedSearchEngines()
    {
        $excluded = get_option('sep_exclude_search_engines');
        if (!is_array($excluded)) {
            $excluded = $this->getExcluded();
            $this->saveExcludedSearchEngines($excluded);
            // Todo: remove after first time init, Copy exclude to search engines exclude for the first time
        }

        return $excluded;
    }
    protected function saveExcluded($excluded)
    {
        update_option('sep_exclude', $excluded);
    }

    protected function getExcluded()
    {
            $excluded = get_option('sep_exclude');
            if (!is_array($excluded)) {
                $excluded = array();
            }

        return $excluded;
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
