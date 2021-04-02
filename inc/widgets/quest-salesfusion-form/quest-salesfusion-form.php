<?php
/**
 * The widget use for adding service box in home page
 * @package Quest
 */

add_action('widgets_init', 'register_widget_quest_salesfusion_form');

function register_widget_quest_salesfusion_form()
{
	register_widget('Quest_Widget_Salesfusion_Form');
}

class Quest_Widget_Salesfusion_Form extends SiteOrigin_Widget
{
	public function __construct() {
		parent::__construct(
			'quest-salesfusion-form',
			__('Quest: Salesfusion Content', 'quest'),
			array(
				'description' => __('Section to display salesfusion iframe and content before or after salesfusion iframe', 'quest'),
				'help' => ''
			),
			array(),
			false,
			plugin_dir_path(__FILE__)
		);

	}

	function get_widget_form() {
		$global_settings = $this->get_global_settings();
		return array(
            'before_content' => array(
				'type' => 'tinymce',
				'rows' => 10,
				'label' => __('Before Content Salesfusion Iframe', 'quest'),
				'default' => ''
            ),
            'iframe_url' => array(
				'type' => 'text',
				'label' => __('Salesfusion URL', 'quest'),
				'default' => ''
			),
			'iframe_width' => array(
				'type' => 'text',
				'label' => __('Salesfusion Width', 'quest'),
				'default' => '350'
			),
			'iframe_height' => array(
				'type' => 'text',
				'label' => __('Salesfusion Height', 'quest'),
				'default' => '450'
			),
            'iframe_margin_top' => array(
                'type' => 'text',
                'label' => __('Salesfusion Top Margin', 'quest'),
                'description' => __('Space above the salesfusion. Default is 0px.'),
                'default' =>'0px',
            ),
            'iframe_margin_bottom' => array(
                'type' => 'text',
                'label' => __('Salesfusion Bottom Margin', 'quest'),
                'description' => __('Space under the salesfusion. Default is 0px.'),
                'default' =>'0px',
            ),
            'after_content' => array(
				'type' => 'tinymce',
				'rows' => 10,
				'label' => __('After Content Salesfusion Iframe', 'quest'),
				'default' => ''
			),
		);
	}
	public function widget( $args, $instance ) {
		// Display service box
		echo $args['before_widget'];
		include 'widget.php';
		echo $args['after_widget'];
	}
}
