<?php

class Quest_Assessment_Workshop_Widget extends SiteOrigin_Widget {

    function __construct() {
        //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.
        $form_options = array(
	        'request_title' => array(
		        'type' => 'tinymce',
		        'rows' => 2,
		        'label' => __( 'Request Title', 'quest' ),
		        'default' => 'Request Your Workshop',
		        'description' => 'Request box will be hidden if the Request Title and Request Link fields are empty'
	        ),
            'request_link' => array(
                'type' => 'text',
                'label' => __( 'Request Link', 'quest' ),
	            'description' => 'Request Button will be hidden if this field is empty'
            ),
	        'request_btn_name' => array(
		        'type' => 'text',
		        'label' => __( 'Request Button Name', 'quest' ),
		        'default' => 'Request'
	        ),
	        'request_position' => array(
		        'type' => 'radio',
		        'label' => __( 'Request Box Position', 'quest' ),
		        'default' => 'top',
		        'options' => array(
			        'top' => __( 'Top', 'quest' ),
			        'bottom' => __( 'Bottom', 'quest' ),
		        )
	        ),
            'date_time' => array(
                'type' => 'tinymce',
                'rows' => 5,
                'label' => __('Date/Time', 'so-widgets-bundle'),
                'default' => ''
            ),
            'location' => array(
                'type' => 'tinymce',
                'rows' => 5,
                'label' => __('Location', 'so-widgets-bundle'),
                'default' => ''
            ),
            'recommended_attendee_titles' => array(
                'type' => 'tinymce',
                'rows' => 5,
                'label' => __('Recommended Attendee Titles', 'so-widgets-bundle'),
                'default' => ''
            ),
            'preferred_documentation_to_review' => array(
                'type' => 'tinymce',
                'rows' => 5,
                'label' => __('Preferred Documentation To Review', 'so-widgets-bundle'),
                'default' => ''
            ),
            'timeline_at_a_glance' => array(
                'type' => 'tinymce',
                'rows' => 5,
                'label' => __('Timeline at a Glance', 'so-widgets-bundle'),
                'default' => ''
            ),


        );
        //Call the parent constructor with the required arguments.
        parent::__construct(
        // The unique id for your widget.
            'quest-assessment-workshop-widget',

            // The name of the widget for display purposes.
            __('Quest: Assessment Workshop', 'quest'),

            // The $widget_options array, which is passed through to WP_Widget.
            // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
            array(
                'description' => __('Displays a quest assessment workshop widget', 'quest'),
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

    function get_template_name($instance) {
        return 'widget';
    }

    function get_template_dir($instance) {
        return '';
    }
}

siteorigin_widget_register('quest-assessment-workshop-widget', __FILE__, 'Quest_Assessment_Workshop_Widget');
