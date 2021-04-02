<?php
/**
 * The widget use for adding service box in home page
 * @package Quest
 */

add_action('widgets_init', 'register_widget_quest_salesfusion_form_builder');

function register_widget_quest_salesfusion_form_builder()
{
	register_widget('Quest_Widget_Salesfusion_Form_Builder');
}

class Quest_Widget_Salesfusion_Form_Builder extends SiteOrigin_Widget
{
	public function __construct() {
		parent::__construct(
			'quest-salesfusion-form-builder',
			__('Quest: Salesfusion Form Builder', 'quest'),
			array(
				'description' => __('Section to display Salesfusion form builder', 'quest'),
				'help' => ''
			),
			array(),
			false,
			plugin_dir_path(__FILE__)
		);

	}

	function get_widget_form() {
		$global_settings = $this->get_global_settings();
		$useable_units = array( 'px', '%', 'rem', 'em' );
		return array(
			'before_content' => array(
				'type' => 'tinymce',
				'rows' => 5,
				'label' => __('Up content', 'quest'),
				'default' => ''
			),
			'form_builder_html' => array(
				'type' => 'htmlcode',
				'rows' => 15,
				'label' => __('Salesfusion Form Builder HTML', 'quest'),
			),
			'redirect_url' => array(
				'type' => 'text',
				'label' => __('Redirect URL', 'quest'),
				'description' => __('Replace the salesfusion redirect url', 'quest'),
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
			'thanks_form' => array(
				'type' => 'tinymce',
				'rows' => 5,
				'label' => __('Thank you form design', 'quest'),
				'description' => __('When the below content is existed, this will be instead of salesfusion form after submitting is successful')
			),
			'form_design' => array(
				'type' => 'section',
				'label' => __( 'Salesfusion form design' , 'quest' ),
				'hide' => false,
				'fields' => array(
					'form_margin' => array(
						'type' => 'multi-measurement',
						'autofill' => true,
						'default' => '0px 0px 0px 0px',
						'label' => 'Form margin',
						'measurements' => array(
							'top' => array(
								'label' => __( 'Margin Top', 'quest' ),
								'units' => $useable_units,
							),
							'right' => array(
								'label' => __( 'Margin Right', 'quest' ),
								'units' => $useable_units,
							),
							'bottom' => array(
								'label' => __( 'Margin Bottom', 'quest' ),
								'units' => $useable_units,
							),
							'left' => array(
								'label' => __( 'Margin Left', 'quest' ),
								'units' => $useable_units,
							),
						),
					),
					'form_width' => array(
						'type' => 'measurement',
						'label' => __('Form width', 'quest'),
						'default' =>'100%',
					),
					'horizontal_align' => array(
						'type' => 'select',
						'label' => __( 'Form block\'s horizontal align', 'quest' ),
						'default' => 'default',
						'options' => array(
							'default' => __( 'Left', 'quest' ),
							'center' => __( 'Center', 'quest' ),
							'right' => __( 'Right', 'quest' ),
						)
					),
					'text_horizontal_align' => array(
						'type' => 'select',
						'label' => __( 'Form text align', 'quest' ),
						'default' => 'text-align: center;',
						'options' => array(
							'text-align: center;' => __( 'Center', 'quest' ),
							'text-align: left;' => __( 'Left', 'quest' ),
							'text-align: right;' => __( 'Right', 'quest' ),
							'text-align: justify;' => __( 'Justify', 'quest' ),
						)
					),
					'bg_content' => array(
						'type' => 'select',
						'label' => __( 'Main content background', 'quest' ),
						'default' => 'salesfusion-none-bg',
						'options' => array(
							'salesfusion-none-bg' => __( 'None', 'quest' ),
							'blue-gradient' => __( 'Blue gradient', 'quest' ),
						)
					),
					'layout_type' => array(
						'type' => 'select',
						'label' => __( 'Layout type', 'quest' ),
						'default' => 'salesfusion-default-layout',
						'options' => array(
							'salesfusion-default-layout' => __( 'Default', 'quest' ),
							'inline-block-layout' => __( 'Inline block', 'quest' ),
						)
					)
				)
			),
			'after_content' => array(
				'type' => 'tinymce',
				'rows' => 5,
				'label' => __('Under content', 'quest'),
				'default' => ''
			)
		);
	}
	public function widget( $args, $instance ) {
		// Display service box
//		echo "<pre>";
//		var_dump($instance);
//		die(1231);
		echo $args['before_widget'];
		include 'widget.php';
		do_action('quest_salesfusion_web_tracking_code');
		echo $args['after_widget'];
	}
}
