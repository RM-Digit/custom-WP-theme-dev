<?php

class Quest_Partner_Login_Widget extends SiteOrigin_Widget {

    function __construct() {
        //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

        $form_options = array(
            'left_content' => array(
	            'type' => 'repeater',
	            'label' => __( 'Content' , 'quest' ),
	            'item_name'  => __( 'Content item', 'quest' ),
	            'item_label' => array(
		            'selector'     => "[id*='title']",
		            'update_event' => 'change',
		            'value_method' => 'val'
	            ),
	            'fields' => array(
		            'title' => array(
			            'type' => 'text',
			            'label' => __( 'Title', 'quest' ),
		            ),
		            'description' => array(
			            'type' => 'textarea',
			            'label' => __( 'Description', 'quest' )
		            ),
		            'redirect_button' => array(
			            'type' => 'section',
			            'label' => __( 'Button' , 'quest' ),
			            'hide' => true,
			            'fields' => array(
				            'btn_name' => array(
					            'type' => 'text',
					            'label' => __( 'Name', 'quest' )
				            ),
				            'btn_url' => array(
					            'type' => 'link',
					            'label' => __( 'Destination URL', 'quest' )
				            ),
				            'btn_color' => array(
					            'type' => 'select',
					            'label' => __( 'Color', 'quest' ),
					            'default' => 'btn-secondary',
					            'options' => array(
						            'btn-primary' =>__('Primary', 'quest'),
						            'btn-secondary' =>__('Secondary', 'quest'),
						            'btn-success' =>__('Success', 'quest'),
						            'btn-danger' =>__('Danger', 'quest'),
						            'btn-warning' =>__('Warning', 'quest'),
						            'btn-info' =>__('Info', 'quest'),
						            'btn-light' =>__('Light', 'quest'),
						            'btn-dark' =>__('Dark', 'quest'),
						            'btn-link' =>__('Link', 'quest'),
					            )
				            )
			            )
		            )
	            )
            ),
//	        'right_content' => array(
//		        'type' => 'section',
//		        'label' => __( 'Right Content - Login Form' , 'quest' ),
//		        'fields' => array(
//			        'title' => array(
//				        'type' => 'text',
//				        'label' => __( 'Title', 'quest' ),
//				        'default' => 'Already A Member'
//			        )
//		        )
//	        )

        );
        //Call the parent constructor with the required arguments.
        parent::__construct(
        // The unique id for your widget.
            'quest-partner-login-widget',

            // The name of the widget for display purposes.
            __('Quest: Partner Portal Section', 'quest'),

            // The $widget_options array, which is passed through to WP_Widget.
            // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
            array(
                'description' => __('Displays a quest partner portal section widget', 'quest'),
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

siteorigin_widget_register('quest-partner-login-widget', __FILE__, 'Quest_Partner_Login_Widget');
