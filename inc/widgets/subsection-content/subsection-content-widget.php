<?php
/**
 * The widget use for adding service box in home page
 * @package Quest
 */

add_action('widgets_init', 'register_widget_subsection_content');

function register_widget_subsection_content()
{
    register_widget('Widget_Subsection_Content');
}

class Widget_Subsection_Content extends Base_Custom_Widget
{
    public function __construct() {
        $widget_options = array(
            'classname' => 'widget_subsection_content',
            'description' => __("Displays a subcategory content section widget")
        );
        $ratios = array('6:6' => '6:6', '5:7' => '5:7', '4:8' => '4:8', '3:9' => '3:9', '2:10' => '2:10');
        $ratio_direction = array('text2image' => 'Text to Image', 'image2text' => 'Image to Text');

        $fields = array(
            'subcategory_id' => array(
                'quest_widgets_name' => 'subcategory_id',
                'quest_widgets_title' => __('Subcategory', 'quest'),
                'quest_widgets_field_type' => 'multi-level-select',
                'quest_widgets_field_options' => $this->get_subcategory()
            ),

            'image_url' => array(
                'quest_widgets_name' => 'image_url',
                'quest_widgets_title' => __('Cover Image', 'quest'),
                'quest_widgets_field_type' => 'upload',
            ),

            'link_video' => array(
                'quest_widgets_name' => 'link_video',
                'quest_widgets_title' => __('Link video', 'quest'),
                'quest_widgets_field_type' => 'url',
            ),

            'ratio' => array(
                'quest_widgets_name' => 'ratio',
                'quest_widgets_title' => __('Ratio of text and image', 'quest'),
                'quest_widgets_field_type' => 'ratio',
                'quest_widgets_field_options' => $ratios
            ),

            'content_direction' => array(
                'quest_widgets_name' => 'content_direction',
                'quest_widgets_title' => __('Content direction', 'quest'),
                'quest_widgets_field_type' => 'content_direction',
                'quest_widgets_field_options' => $ratio_direction
            ),
        );

        parent::__construct( 'widget_subsection_content', __('Quest: Subcategory Content Section'), $widget_options, $fields );
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