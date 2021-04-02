<?php

class quest_testimonial_widget_area extends SiteOrigin_Widget {

    function __construct() {
        //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.
        $form_options = array(
            'quest_testimonial_top_title' => array(
                'type' => 'text',
                'label' => __('Title', 'quest'),
	            'default' => 'Customer Stories',
            ),
            'slider' => array(
	            'type' => 'repeater',
	            'label' => __( 'Slider' , 'quest' ),
	            'item_name'  => __( 'Item', 'quest' ),
	            'item_label' => array(
		            'selector'     => "[id*='customer_story']",
		            'update_event' => 'change',
		            'value_method' => 'val'
	            ),
	            'fields' => array(
		            'customer_story' => array(
			            'type' => 'link',
			            'post_types' => QUEST_POST_TYPE_CUSTOMER_STORY,
			            'readonly' => true,
			            'label' => __( 'Customer story', 'quest' )
		            ),
	            )
            ),
            'quest_testimonial_descriptions' => array(
	            'type' => 'textarea',
	            'label' => __('Descriptions', 'quest'),
	            'default' => 'Please browse our customers’ success stories and learn how Quest can assist bussinesses like yours.',
            ),
            'quest_testimonial_viewmore' => array(
	            'type' => 'text',
	            'label' => __('View More', 'quest'),
	            'default' => '/customer-stories/',
            ),
        );
        //Call the parent constructor with the required arguments.
        parent::__construct(
        // The unique id for your widget.
            'quest_testimonial_widget_area',

            // The name of the widget for display purposes.
            __('Quest: Customers Stories Widget Section','quest'),

            // The $widget_options array, which is passed through to WP_Widget.
            // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
            array(
                'description' => __('A widget that shows customer stories posts', 'quest'),
                'has_preview' => false
            ),

            //The $control_options array, which is passed through to WP_Widget
            array(
            ),

            //The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
            $form_options,

            //The $base_folder path string.
            plugin_dir_path(__FILE__)
        );
    }

    public function widget($args, $instance)
    {
	    extract($args);
	    echo wp_kses_post($before_widget);
		include 'widget-template.php';
	    echo wp_kses_post($after_widget);
    }

    public function get_template_dir($instance)
    {
        return '';
    }

}

siteorigin_widget_register('quest_testimonial_widget_area', __FILE__, 'quest_testimonial_widget_area');
