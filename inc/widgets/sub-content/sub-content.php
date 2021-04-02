<?php
/**
 * The widget use for adding service box in home page
 * @package Quest
 */

add_action('widgets_init', 'register_widget_sub_content');

function register_widget_sub_content()
{
    register_widget('Widget_Sub_Content');
}

class Widget_Sub_Content extends Base_Custom_Widget
{
    public function __construct() {
        $widget_options = array(
            'classname' => 'widget_sub_content',
            'description' => __("Displays a subcategory content section widget")
        );

        $fields = array(
            'subcategory_id' => array(
                'quest_widgets_name' => 'subcategory_id',
                'quest_widgets_title' => __('Subcategory', 'quest'),
                'quest_widgets_field_type' => 'multi-level-select',
                'quest_widgets_field_options' => $this->get_subcategory()
            ),
        );

        parent::__construct( 'widget_sub_content', __('Quest: Sub Content Section'), $widget_options, $fields );
    }

    public function widget( $args, $instance ) {
        // Display service box
        echo $args['before_widget'];
        include 'widget.php';
        echo $args['after_widget'];
    }

    private function get_subcategory()
    {
        $args = array(
            'hide_empty' => 0,
            'parent' => 0,
            'taxonomy'=> 'service'
        );
        $categories = get_categories($args);
        $field_options = array();

        foreach ($categories as $category) {
            $subcategories = get_categories( array(
                'child_of' => $category->term_id,
                'hide_empty' => 0,
                'taxonomy'=> 'service'
            ));
            $primary_key = $category->name;
            foreach ($subcategories as $subcategory) {
                $field_options[$primary_key][$subcategory->term_id] = $subcategory->name;
            }
        }

        return $field_options;
    }
}