<?php

class Quest_Widget_Contact_Form extends SiteOrigin_Widget {

	function __construct() {
		//Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.
		$form_options = array(
			'form_builder_html' => array(
				'type' => 'htmlcode',
				'rows' => 15,
				'label' => __('Salesfusion form builder', 'quest'),
			),
			'redirect_url' => array(
				'type' => 'text',
				'label' => __('Redirect URL', 'quest'),
				'description' => __('Replace the salesfusion redirect url'),
			),
// TODO Disable recaptcha
//			'g_recaptcha' => array(
//				'type' => 'radio',
//				'label' => __( 'reCAPTCHA', 'quest' ),
//				'default' => 'yes',
//				'options' => array(
//					'yes' => __( 'Yes', 'quest' ),
//					'no' => __( 'No', 'quest' ),
//				)
//			),
			'address' => array(
				'type' => 'text',
				'label' => __( 'Address', 'quest'),
				'default' => ""
			),
			'map_image_url' => array(
				'type' => 'media',
				'label' => __( 'Icon image', 'quest' ),
				'choose' => __( 'Choose image', 'quest' ),
				'library' => 'image',
				'update' => __( 'Set image', 'quest' ),
				'fallback' => true
			),
			'phone' => array(
				'type' => 'text',
				'label' => __( 'Phone', 'quest'),
				'default' => ""
			),
			'email' => array(
				'type' => 'text',
				'label' => __( 'Email', 'quest'),
				'default' => ""
			),

		);
		//Call the parent constructor with the required arguments.
		parent::__construct(
		// The unique id for your widget.
			'quest-widget-contact-form',

			// The name of the widget for display purposes.
			__('Quest: Contact Form', 'quest'),

			// The $widget_options array, which is passed through to WP_Widget.
			// It has a couple of extras like the optional help URL, which should link to your sites help or support page.
			array(
				'description' => __('Displays a quest contact form', 'quest'),
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

siteorigin_widget_register('quest-widget-contact-form', __FILE__, 'Quest_Widget_Contact_Form');
