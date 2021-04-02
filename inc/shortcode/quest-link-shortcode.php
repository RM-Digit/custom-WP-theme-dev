<?php
function create_shortcode_quest_link($args, $content) {
	$post_id = !empty($args['post_id']) ? $args['post_id'] : 0;
	$title = !empty($args['title']) ? $args['title'] : get_the_title($post_id);
	$font_size = !empty($args['font_size']) ? "font-size: {$args['font_size']}px" : '';
	$text_color = !empty($args['text_color']) ? $args['text_color'] : '';

	$url = get_permalink($post_id);
	$text_content = !empty($url) ? "<a href='{$url}' class='{$text_color}' style='{$font_size}'>{$title}</a><br>": '<p>The post is not existed.</p>';
	return $text_content;
}

add_shortcode( 'quest_link', 'create_shortcode_quest_link' );