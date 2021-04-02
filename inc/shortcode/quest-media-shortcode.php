<?php
function create_shortcode_quest_media($args, $content) {
	if (empty($args['video_link'])) {
		return '<p>No found video link.</p>';
	}

	$video_link = $args['video_link'];
	$video_name = !empty($args['name']) ? $args['name'] : '';
	$gradient = !empty($args['name']) ? 'gradient-trans' : '';
	$image = !empty($args['image_id']) ? wp_get_attachment_image_src($args["image_id"], 'large') : null;
	$image_postion = empty($args['position']) ? 'left-img' : $args['position'] . '-img';
	$image_height = empty($args['height']) ? '' : "height: {$args['height']}";
	preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $video_link, $matches);

	if (!empty($matches)) {
		$text_content = "<div class='quest-media-shortcode slick-active'><a class='video-img' href='#video-{$matches[0]}'>";
		$text_content .= "<div class='quest-media {$image_postion} {$gradient}'>";
		$text_content .= !empty($image) ? "<img alt='Quest youtube video' src='{$image[0]}' width='640' style='{$image_height}'/>" : "<img alt='Quest youtube video' src='//img.youtube.com/vi/{$matches[0]}/maxresdefault.jpg' width='640' height='427'/>";
		if (!empty($video_name)) $text_content .= '<div class="clearfix"></div><div class="video-name"><span>' . $video_name . '</span></div>';

		$text_content .= "</div></a></div><div class='quest-media-modal modal fade youtube-catch-event' id='video-{$matches[0]}' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>"
	                 . "<div class='modal-dialog modal-dialog-centered modal-lg' role='document'>"
	                 . "<div class='modal-content'>"
	                 . "<div class='modal-header'>"
	                 . "<h5 class='modal-title text-primary' id='exampleModalLabel'>Watch video</h5>"
	                 . "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>"
	                 . "<span aria-hidden='true'>&times;</span>"
	                 . "</button>"
	                 . "</div>"
	                 . "<div class='modal-body embed-responsive embed-responsive-16by9'>"
	                 . "<iframe class='youtube-catch-event-iframe embed-responsive-item' data-src='https://www.youtube.com/embed/{$matches[0]}'  src='https://www.youtube.com/embed/{$matches[0]}' style=\"border:0;\" allow='encrypted-media' allowfullscreen></iframe>"
	                 . "</div>"
	                 . "</div>"
	                 . "</div>"
	                 . "</div>";
	} else {
		$text_content = '<p>Video link was wrong.</p>';
	}

    return $text_content;
}

add_shortcode( 'quest_media', 'create_shortcode_quest_media' );