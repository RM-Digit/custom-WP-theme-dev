<?php
function create_shortcode_related_services($args, $content) {
	$post = get_post();
	$taxonomys = get_the_terms($post->ID, 'service');
	$text_content = '';
	if (!empty($taxonomys)) {
		$industryTerm = get_term_by('slug', 'industries', 'service');
		$serviceTerm = get_term_by('slug', 'services', 'service');

		$relatedIndustry = [];
		$relatedService = [];

		foreach ($taxonomys as $taxonomy) {
			$relatedItem = [];
			$relatedItem['icon_taxonomy'] = get_term_meta($taxonomy->term_id, 'icon', true);
			$relatedItem['name'] = $taxonomy->name;

			if (!empty($industryTerm) && $taxonomy->parent === $industryTerm->term_id) {
				$relatedItem['btn_url'] = '/industries/'.$taxonomy->slug;
				array_push($relatedIndustry, $relatedItem);
			}
			if (!empty($serviceTerm) && $taxonomy->parent === $serviceTerm->term_id) {
				$relatedItem['btn_url'] = '/services/'.$taxonomy->slug;
				array_push($relatedService, $relatedItem);
			}

		}

		$text_content .= '<div class="author-of-post"><hr>';

		if (!empty($relatedService)) {
			$text_content .= '<div class="profile-author"><h5 class="text-primary">Related Services</h5>';
			foreach ($relatedService as $item) {
				$text_content .= "<p><em class='mr-2 quest-icon {$item['icon_taxonomy']}'></em><a href='{$item['btn_url']}'>{$item['name']}</a></p>";
			}
			$text_content .= "<hr></div>";
		}

		if (!empty($relatedIndustry)) {
			$text_content .= '<div class="profile-author"><h5 class="text-primary">Related Industries</h5>';
			foreach ($relatedIndustry as $item) {
				$text_content .= "<p><em class='mr-2 quest-icon {$item['icon_taxonomy']}'></em><a href='{$item['btn_url']}'>{$item['name']}</a></p>";
			}
			$text_content .= "<hr></div>";
		}
	}

	$tags = get_the_tags($post->ID);
	if (!empty($tags)) {
		$text_content .='<div class="show-tags"><h5 class="text-primary">Tags/Topics</h5><ul>';
		foreach ($tags as $tag) {
			$link = get_tag_link($tag->term_id);
			$text_content .= "<li> &bull; <a href='{$link}'>{$tag->name}</a>";
		}
		$text_content .= "</ul></div>";
	}
	$text_content .= "</div>";
    return $text_content;
}

add_shortcode( 'related_services', 'create_shortcode_related_services' );