<?php

class Quest_News_Coverage_Widget extends SiteOrigin_Widget {

    function __construct() {
    	$default_url = get_site_url() . '/resources/?resources[]=';
    	$newsletter_url = $default_url . QUEST_POST_TYPE_RESOURCE_NEWSLETTER;
    	$release_url = $default_url . QUEST_POST_TYPE_RESOURCE_PRESS_RELEASE;
        //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.
        $form_options = array(
            'left_section' => array(
	            'type' => 'section',
	            'label' => __( 'Left section' , 'quest' ),
	            'fields' => array(
		            'title' => array(
			            'type' => 'text',
			            'label' => __( 'Title', 'quest'),
			            'default' => "Press Releases"
		            ),
		            'btn_name' => array(
			            'type' => 'text',
			            'label' => __( 'Button name', 'quest' ),
			            'default' => 'View All'
		            ),
		            'btn_link' => array(
			            'type' => 'link',
			            'label' => __( 'Button Link', 'quest' ),
			            'default' => $release_url
		            )
	            )
            ),
            'right_section' => array(
	            'type' => 'section',
	            'label' => __( 'Right section' , 'quest' ),
	            'fields' => array(
		            'title' => array(
			            'type' => 'text',
			            'label' => __( 'Title', 'quest'),
			            'default' => "Newsletters"
		            ),
		            'btn_name' => array(
			            'type' => 'text',
			            'label' => __( 'Button name', 'quest' ),
			            'default' => 'View All'
		            ),
		            'btn_link' => array(
			            'type' => 'link',
			            'label' => __( 'Button Link', 'quest' ),
			            'default' => $newsletter_url
		            )
	            )
            ),

        );
        //Call the parent constructor with the required arguments.
        parent::__construct(
        // The unique id for your widget.
            'quest-news-coverage-widget',

            // The name of the widget for display purposes.
            __('Quest: News Coverage', 'quest'),

            // The $widget_options array, which is passed through to WP_Widget.
            // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
            array(
                'description' => __('Displays a quest the latest posts of Press Releases and Newsletters', 'quest'),
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

siteorigin_widget_register('quest-news-coverage-widget', __FILE__, 'Quest_News_Coverage_Widget');