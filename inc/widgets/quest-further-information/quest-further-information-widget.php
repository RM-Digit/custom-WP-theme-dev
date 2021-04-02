<?php

class Quest_Further_Information_Widget extends SiteOrigin_Widget {

    function __construct() {
        //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.
        $form_options = array(
            'title' => array(
                'type' => 'text',
                'label' => __( 'Widget title', 'quest'),
                'default' => 'Further Information'
            ),
            'block_repeater' => array(
                'type' => 'repeater',
                'label' => __( 'Widget section' , 'quest' ),
                'item_name'  => __( 'Widget block', 'quest' ),
                'item_label' => array(
                    'selector'     => "[id*='further-information']",
                    'update_event' => 'change',
                    'value_method' => 'val'
                ),
                'fields' => array(
                	'action_link' => array(
	                    'type' => 'section',
	                    'label' => __( "Link's actions" , 'quest' ),
	                    'item_name'  => __( "Link's action", 'quest' ),
	                    'fields' => array(
		                    'action_type' => array(
			                    'type' => 'select',
			                    'label' => __( 'Action type', 'quest' ),
			                    'default' => 'url',
			                    'options' => array(
				                    'url' => __( 'Redirect URL', 'quest' ),
				                    'email' => __( 'Open mailer', 'quest' ),
			                    )
		                    ),
		                    'action_label' => array(
			                    'type' => 'text',
			                    'label' => __( 'Label', 'quest' )
		                    ),
		                    'action_value' => array(
		                    	'type' => 'text',
			                    'label' => __( 'Value', 'quest')
		                    )
	                    )
                    ),
                    'block_description' => array(
                        'type' => 'textarea',
                        'label' => __( 'Description', 'quest' )
                    ),
                    'block_icon' => array(
                        'type' => 'media',
                        'label' => __( 'Icon image', 'quest' ),
                        'choose' => __( 'Choose image', 'quest' ),
                        'library' => 'image',
                        'update' => __( 'Set image', 'quest' ),
                        'fallback' => true
                    )
                ),
            )
        );
        //Call the parent constructor with the required arguments.
        parent::__construct(
        // The unique id for your widget.
            'quest-further-information-widget',

            // The name of the widget for display purposes.
            __('Quest: Further Information', 'quest'),

            // The $widget_options array, which is passed through to WP_Widget.
            // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
            array(
                'description' => __('Displays a quest further information widget', 'quest'),
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

siteorigin_widget_register('quest-further-information-widget', __FILE__, 'Quest_Further_Information_Widget');
