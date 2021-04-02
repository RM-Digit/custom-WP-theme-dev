<?php
/**
 * The widget use for adding service box in home page
 * @package Quest
 */

add_action('widgets_init', 'register_widget_quest_veeam_content_item');

function register_widget_quest_veeam_content_item()
{
	register_widget('Quest_Widget_Veeam_Content_Item');
}

class Quest_Widget_Veeam_Content_Item extends SiteOrigin_Widget
{
	public function __construct() {
		parent::__construct(
			'quest-veeam-content-item',
			__('Quest: Veeam Content Item', 'quest'),
			array(
				'description' => __('Section to display veeam content item', 'quest'),
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
			'title' => array(
				'type' => 'text',
				'label' => __('Item Title', 'quest'),
				'default' => ''
            ),
            'content' => array(
				'type' => 'tinymce',
				'rows' => 10,
				'label' => __('Item Content', 'quest'),
				'default' => '<h1>Title</h1>',
			),
			'button_text' => array(
				'type' => 'text',
				'label' => __('View More Text', 'quest'),
				'default' => ''
			),
			'button_link' => array(
				'type' => 'text',
				'label' => __('View More Link', 'quest'),
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
