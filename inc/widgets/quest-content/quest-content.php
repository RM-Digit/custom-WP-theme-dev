<?php
/**
 * The widget use for adding service box in home page
 * @package Quest
 */

add_action('widgets_init', 'register_widget_quest_content');

function register_widget_quest_content()
{
    register_widget('Quest_Widget_Content');
}

class Quest_Widget_Content extends SiteOrigin_Widget
{
    public function __construct() {
        parent::__construct(
            'quest-content',
            __('Quest: Content Editor', 'quest'),
            array(
                'description' => __('Display content', 'quest'),
                'help' => ''
            ),
            array(),
            false,
            plugin_dir_path(__FILE__)
        );

    }

    function get_widget_form() {
        return array(
            'content' => array(
                'type' => 'tinymce',
                'rows' => 20,
                'label' => __('Content', 'so-widgets-bundle'),
                'default' => ''
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
