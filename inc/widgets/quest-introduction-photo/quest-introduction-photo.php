<?php
/**
 * The widget use for adding service box in home page
 * @package Quest
 */

add_action('widgets_init', 'register_widget_quest_introduction_photo');

function register_widget_quest_introduction_photo()
{
	register_widget('Quest_Widget_Introduction_Photo');
}

class Quest_Widget_Introduction_Photo extends SiteOrigin_Widget
{
	public function __construct() {
		parent::__construct(
			'quest-introduction-photo',
			__('Quest: Two columns', 'quest'),
			array(
				'description' => __('Section to display text on a half of an photo', 'so-widgets-bundle'),
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
			'background_video' => array(
				'type' => 'section',
				'label' => __( 'Video background' , 'quest' ),
				'description' => '*Support for homepage header',
				'hide' => true,
				'fields' => array(
					'video_media' => array(
						'type' => 'media',
						'label' => __( 'Choose a video', 'quest' ),
						'choose' => __( 'Choose video', 'quest' ),
						'update' => __( 'Set video', 'video' ),
						'library' => 'video',
						'fallback' => false
					)
				)
			),
			'title' => array(
				'type' => 'tinymce',
				'rows' => 10,
				'label' => __('Left Content', 'so-widgets-bundle'),
				'default' => '<h1>Title</h1>',
			),
			'content' => array(
				'type' => 'tinymce',
				'rows' => 10,
				'label' => __('Right Content', 'so-widgets-bundle'),
				'default' => ''
			),
			'ratio' => array(
				'type' => 'select',
				'label' => __( 'Ratio', 'so-widgets-bundle' ),
				'default' => '6',
				'options' => array(
					'12' => __( 'Only one column', 'so-widgets-bundle' ),
					'1' => __( '1:11 (8%)', 'so-widgets-bundle' ),
					'2' => __( '2:10 (17%)', 'so-widgets-bundle' ),
					'3' => __( '3:9 (25%)', 'so-widgets-bundle' ),
					'4' => __( '4:8 (33%)', 'so-widgets-bundle' ),
					'5' => __( '5:7 (42%)', 'so-widgets-bundle' ),
					'6' => __( '6:6 (50%)', 'so-widgets-bundle' ),
					'7' => __( '7:5 (58%)', 'so-widgets-bundle' ),
					'8' => __( '8:4 (67%)', 'so-widgets-bundle' ),
					'9' => __( '9:3 (75%)', 'so-widgets-bundle' ),
					'10' => __( '10:2 (83%)', 'so-widgets-bundle' ),
					'11' => __( '11:1 (92%)', 'so-widgets-bundle' ),
				)
			),
			'v-align' => array(
				'type' => 'select',
				'label' => __( 'Vertical Align', 'so-widgets-bundle' ),
				'default' => '',
				'options' => array(
					'' => __( '--Default--', 'so-widgets-bundle' ),
					'start' => __( 'Top', 'so-widgets-bundle' ),
					'end' => __( 'Bottom', 'so-widgets-bundle' ),
					'center' => __( 'Middle', 'so-widgets-bundle' ),
					'baseline' => __( 'Baseline', 'so-widgets-bundle' ),
					'stretch' => __( 'Stretch', 'so-widgets-bundle' )
				)
			),
			'mobile-order' => array(
				'type' => 'select',
				'label' => __( 'Mobile Order', 'so-widgets-bundle' ),
				'default' => '',
				'options' => array(
					'' => __( 'Normal', 'so-widgets-bundle' ),
					'reverse' => __( 'Reverse', 'so-widgets-bundle' )
				)
			)
		);
	}
	public function widget( $args, $instance ) {
		// Display service box
		echo $args['before_widget'];
		if (!empty($instance['background_video']['video_media'])) {
			$video_media_url = wp_get_attachment_url($instance['background_video']['video_media']);
			$video_content = "<div class='overlay'></div><video id='quest-background-video' class='background-video' style='display: none' playsinline='playsinline' autoplay='autoplay' muted='muted' loop='loop'>" .
			                 "<source src='{$video_media_url}' type='video/mp4'>" .
			                 "</video>" .
							 "<div class='video-btn-container'><a id='quest-bg-video-btn' href='javascript:;'><span class='sr-only'>Play button</span><span id='quest-bg-video-icon' class='fa fa-pause'></span></a></div>";
			echo $video_content;
		}
		include 'widget.php';
		echo $args['after_widget'];
	}
}
