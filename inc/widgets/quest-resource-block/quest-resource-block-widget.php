<?php
/**
 * The widget use for adding service box in home page
 * @package Quest
 */

add_action('widgets_init', 'register_widget_quest_resource_block');

function register_widget_quest_resource_block()
{
    register_widget('Quest_Widget_Resource_Block');
}

class Quest_Widget_Resource_Block extends SiteOrigin_Widget
{
    public function __construct() {
        parent::__construct(
            'quest-resource-block',
            __('Quest: Resource Block', 'quest'),
            array(
                'description' => __('Display resource block', 'quest'),
                'help' => ''
            ),
            array(),
            false,
            plugin_dir_path(__FILE__)
        );
    }
    function get_widget_form() {
        $types = get_post_types(array('public' => true), 'objects');
        $type_options = array();
        foreach ($types as $id => $type) {
            if(quest_is_resources_post_type($type->name)) {
                $type_options[$id] = $type->labels->name;
            }
        }

        return array(
            'resource' => array(
                'type' => 'link',
                'post_types' => quest_all_resources_post_type(),
                'label' => __('Resource', 'so-widgets-bundle'),
	            'description' => 'This field only accepts two string formats: post: [post_id] and web link'
            ),
            'image_resource' => array(
                'type' => 'media',
                'label' => __( 'Choose a image resource', 'widget-form-fields-text-domain' ),
                'choose' => __( 'Choose image', 'widget-form-fields-text-domain' ),
                'update' => __( 'Set image', 'widget-form-fields-text-domain' ),
                'library' => 'image',
                'fallback' => false
            )
        );
    }
    public function widget( $args, $instance ) {
        // Display service box
        echo $args['before_widget'];
        include 'widget.php';
        echo $args['after_widget'];
    }

}
