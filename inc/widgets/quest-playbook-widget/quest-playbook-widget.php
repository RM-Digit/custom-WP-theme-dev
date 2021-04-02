<?php

class Quest_PlayBook_Widget extends SiteOrigin_Widget {

    function __construct() {
        //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.
        $form_options = array(
	        'title' => array(
				'type' => 'tinymce',
				'rows' => 5,
				'label' => __('Title', 'quest'),
				'default' => '<h3>Title</h3>',
	        ),
            'playbook' => array(
	            'type' => 'repeater',
	            'label' => __( 'Playbook' , 'quest' ),
	            'item_name'  => __( 'Item', 'quest' ),
	            'item_label' => array(
		            'selector'     => "[id*='item_title']",
		            'update_event' => 'change',
		            'value_method' => 'val'
	            ),
	            'fields' => array(
		            'item_title' => array(
			            'type' => 'text',
			            'label' => __( 'Title', 'quest' )
		            ),
		            'icon' => array(
			            'type' => 'media',
			            'label' => __( 'Choose an icon', 'quest' ),
			            'choose' => __( 'Choose image', 'quest' ),
			            'update' => __( 'Set image', 'quest' ),
			            'library' => 'image',
			            'fallback' => false
		            ),
		            'content' => array(
			            'type' => 'tinymce',
			            'rows' => 10,
			            'label' => __('Content', 'quest'),
		            ),
	            )
            ),
	        'contact' => array(
		        'type' => 'repeater',
		        'label' => __( 'Contact information' , 'quest' ),
		        'item_name'  => __( 'Item', 'quest' ),
		        'item_label' => array(
			        'selector'     => "[id*='playbook']",
			        'update_event' => 'change',
			        'value_method' => 'val'
		        ),
		        'fields' => array(
			        'first_name' => array(
				        'type' => 'text',
				        'label' => __( 'First Name', 'quest' )
			        ),
			        'last_name' => array(
				        'type' => 'text',
				        'label' => __( 'Last Name', 'quest' )
			        ),
			        'email' => array(
				        'type' => 'text',
				        'label' => __( 'Email', 'quest' )
			        ),
			        'phone' => array(
				        'type' => 'text',
				        'label' => __( 'Phone', 'quest' )
			        ),
			        'portrait' => array(
				        'type' => 'media',
				        'label' => __( 'Choose an portrait image', 'quest' ),
				        'choose' => __( 'Choose image', 'quest' ),
				        'update' => __( 'Set image', 'quest' ),
				        'library' => 'image',
				        'fallback' => false
			        )
		        )
	        ),
        );
        //Call the parent constructor with the required arguments.
        parent::__construct(
        // The unique id for your widget.
            'quest-playbook-widget',

            // The name of the widget for display purposes.
            __('Quest: Partner Playbook','quest'),

            // The $widget_options array, which is passed through to WP_Widget.
            // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
            array(
                'description' => __('A widget that shows Partner Playbook', 'quest'),
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
//    	echo "<pre>"; var_dump($instance); die;
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

siteorigin_widget_register('quest-playbook-widget', __FILE__, 'Quest_PlayBook_Widget');
