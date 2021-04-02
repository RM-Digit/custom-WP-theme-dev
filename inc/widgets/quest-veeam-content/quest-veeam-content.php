<?php
/**
 * The widget use for adding service box in home page
 * @package Quest
 */

add_action('widgets_init', 'register_widget_quest_veeam_content');

function register_widget_quest_veeam_content()
{
	register_widget('Quest_Widget_Veeam_Content');
}

class Quest_Widget_Veeam_Content extends SiteOrigin_Widget
{
	public function __construct() {
		parent::__construct(
			'quest-veeam-content',
			__('Quest: Veeam Content', 'quest'),
			array(
				'description' => __('Section to display veeam content page', 'quest'),
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
			'content' => array(
				'type' => 'tinymce',
				'rows' => 10,
				'label' => __('Left Content', 'quest'),
				'default' => '<h1>Title</h1>',
			),
			'iframe_id' => array(
				'type' => 'text',
				'label' => __('Salesfusion Form Id', 'quest'),
				'default' => ''
			),
			'iframe_width' => array(
				'type' => 'text',
				'label' => __('Salesfusion Form Width', 'quest'),
				'default' => ''
			),
			'iframe_height' => array(
				'type' => 'text',
				'label' => __('Salesfusion Form Height', 'quest'),
				'default' => ''
			),
            'iframe_margin_top' => array(
                'type' => 'text',
                'label' => __('Salesfusion Top Margin', 'quest'),
                'description' => __('Space under the salesfusion. Default is 0px.'),
                'default' =>0,
            )
		);
	}
	public function widget( $args, $instance ) {
		// Display service box
		echo $args['before_widget'];
		include 'widget.php';
		echo $args['after_widget'];
	}
}
