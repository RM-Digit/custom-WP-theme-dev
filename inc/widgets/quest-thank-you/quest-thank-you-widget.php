<?php

class Quest_Thank_You_Widget extends SiteOrigin_Widget {

    function __construct() {
        //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.
        $form_options = array(
            'primary_content' => array(
                'type' => 'tinymce',
                'label' => __( 'Primary Content', 'quest'),
                'default' => "<h3 class='mb-3'  style='text-align: center;'>Thank you for contacting us. We will respond to you soon.</h3><p class='mb-4'  style='text-align: center;'>Have additional comments, questions or concerns? </p>",
                'rows' => 10,
            ),
            'secondary_content' => array(
	            'type' => 'section',
	            'label' => __( 'Secondary Content' , 'quest' ),
	            'hide' => true,
	            'fields' => array(
		            'layout_type' => array(
			            'type' => 'select',
			            'label' => __( 'Choose layout type', 'quest' ),
			            'default' => 'default',
			            'options' => array(
				            'default' => __( 'Default', 'quest' ),
				            'event' => __( 'Event with calendar', 'quest' ),
				            'download_file' => __( 'Download file', 'quest' ),
			            )
		            ),
		            'email' => array(
			            'type' => 'text',
			            'label' => __( 'Email', 'quest' )
		            ),
		            'tks_file' => array(
			            'type' => 'media',
			            'label' => __( 'Choose calendar file', 'quest' ),
			            'choose' => __( 'Choose file', 'quest' ),
			            'update' => __( 'Set file', 'quest' ),
			            'library' => 'all',
			            'fallback' => false
		            ),
	            )
            ),
        );
        //Call the parent constructor with the required arguments.
        parent::__construct(
        // The unique id for your widget.
            'quest-thank-you-widget',

            // The name of the widget for display purposes.
            __('Quest: Thank you', 'quest'),

            // The $widget_options array, which is passed through to WP_Widget.
            // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
            array(
                'description' => __('Displays a quest Thank you widget', 'quest'),
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

siteorigin_widget_register('quest-thank-you-widget', __FILE__, 'Quest_Thank_You_Widget');
