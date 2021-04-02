<?php

class Quest_Technology_Partner_Widget extends SiteOrigin_Widget {

    function __construct() {
        //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

        $form_options = array(
            'title' => array(
                'type' => 'text',
                'label' => __( 'Title', 'quest'),
                'default' => "Quest's Technology Partner Program Overview"
            ),
            'video_repeater' => array(
	            'type' => 'repeater',
	            'label' => __( 'Video Slider' , 'quest' ),
	            'item_name'  => __( 'Video Slider Item', 'quest' ),
	            'item_label' => array(
		            'selector'     => "[id*='video-slider']",
		            'update_event' => 'change',
		            'value_method' => 'val'
	            ),
	            'fields' => array(
		            'video_link' => array(
			            'type' => 'link',
			            'label' => __( 'Video link', 'quest' ),
			            'description' => __( 'This version only support the video from youtube.', 'quest' ),
		            ),
		            'video_thumbnail' => array(
			            'type' => 'media',
			            'label' => __( 'Icon image', 'quest' ),
			            'choose' => __( 'Choose image', 'quest' ),
			            'library' => 'image',
			            'update' => __( 'Set image', 'quest' ),
			            'fallback' => true,
			            'description' => __( 'This is optional', 'quest' ),
		            )
	            ),
            )

        );
        //Call the parent constructor with the required arguments.
        parent::__construct(
        // The unique id for your widget.
            'quest-technology-partner-widget',

            // The name of the widget for display purposes.
            __('Quest: Technology Partner Program Overview', 'quest'),

            // The $widget_options array, which is passed through to WP_Widget.
            // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
            array(
                'description' => __('Displays a quest Technology Partner Program Overview widget', 'quest'),
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

    public function get_template_name($instance)
    {
        return 'widget';
    }

    public function get_template_dir($instance)
    {
        return '';
    }

}

siteorigin_widget_register('quest-technology-partner-widget', __FILE__, 'Quest_Technology_Partner_Widget');
