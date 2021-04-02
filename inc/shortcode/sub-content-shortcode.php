<?php
function create_shortcode_sub_content($args, $content) {
	$objectContent = null;

	if (isset($args['categories_id'])) {
		$objectContent = get_term_by('id', $args['categories_id'], QUEST_TAXONOMY_SERVICE);
		if (empty($objectContent)) return '<p>Not found the category</p>';

		$title = empty($args['new_title']) ? $objectContent->name : $args['new_title'];
		$description = empty($content) ? wp_trim_words(wp_strip_all_tags($objectContent->description), 70, '...') : $content;
		$btn_url = empty($args['btn_link']) ? get_category_link($args['categories_id']) : esc_url_raw($args['btn_link']);
		$icon_url = get_term_meta($args['categories_id'],'icon',true);

		$icon_url_html = "<em style='font-size: 3rem' class='text-primary quest-icon {$icon_url}'></em>";
		$btn_name = empty($args['btn_name']) ? 'View All' : $args['btn_name'];
	} elseif (isset($args['posts_id'])) {
		$objectContent = get_post($args['posts_id']);
		if ($args['posts_id'] == 0) return '<p>Not found the post</p>';

		$icon_url_html = !empty($args['icon_url']) ? "<em style='font-size: 3rem' class='text-primary {$args['icon_url']}'></em>": '';
		$title = empty($args['new_title']) ? $objectContent->post_title : $args['new_title'];
		//$description = empty($content) ? wp_trim_words(wp_strip_all_tags($objectContent->post_content), 70, '...') : $content;
		$description = empty($content) ? (!empty($objectContent->post_excerpt) ? $objectContent->post_excerpt:wp_trim_words(wp_strip_all_tags($objectContent->post_content), 70, '...')) : $content;
		$btn_url = empty($args['btn_link']) ? get_permalink($args['posts_id']) : esc_url_raw($args['btn_link']);
		$btn_name = empty($args['btn_name']) ? 'Learn More' : $args['btn_name'];
	} else {
		return '<p>Not Found</p>';
	}

	$btn_color = empty($args['btn_color']) ? 'btn-primary' : $args['btn_color'];
    $class ='';

    if(!empty($args['ratio'])){
        $class .= 'col-lg-' . $args["ratio"];
    }

    if(isset($args['order'])){
    	if ($args['order'] == 0) {
		    $class .= ' order-lg-' . $args["order"] . ' order-md-1 order-1';
	    }
    }

    $text_content = "<div class='{$class} text-content align-self-center'>";
    $text_content .= '';
    $text_content .= "<p class='mb-3 limiting-icon'>{$icon_url_html}</p>";
    $text_content .= $title != '' ? "<h2 class='text-primary mb-3' >{$title}<span class='trademark-symbol' style='display:none;'>®</span></h2>" : '';
    $text_content .= $description != '' ? "<p class='mb-4 limiting-text'>{$description}</p>" : '';
    $text_content .= "<a class='btn {$btn_color} text-white' href='{$btn_url}'>". $btn_name ."</a>";
    $text_content .= "</div> ";
    return $text_content;
}

add_shortcode( 'sub_content', 'create_shortcode_sub_content' );