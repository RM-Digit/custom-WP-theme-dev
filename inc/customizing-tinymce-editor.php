<?php


function tiny_mce_add_buttons( $plugins ) {
	$plugins['mytinymceplugin'] = get_template_directory_uri() . '/js/tiny-mce/tiny-mce.js';
	return $plugins;
}

function tiny_mce_register_buttons( $buttons ) {
	$newBtns = array(
		'myblockquotebtn'
	);
	$buttons = array_merge( $buttons, $newBtns );
	return $buttons;
}

/**
 * Register customizing button into init for add new button in TinyMCE editor
 */
add_action( 'init', 'tiny_mce_new_buttons' );

function tiny_mce_new_buttons() {
	add_filter( 'mce_external_plugins', 'tiny_mce_add_buttons' );
	add_filter( 'mce_buttons', 'tiny_mce_register_buttons' );
}


/**
 * Register wp_ajax_my_action for getting data by using ajax
 */

add_action( 'wp_ajax_my_action', 'my_ajax_action_function' );

/**
 * Response data for requesting by ajax
 */
function my_ajax_action_function(){

	$reponse = array();

	if (!empty($_POST['param'])) {
		switch ($_POST['param']) {
			case "categories":
				$response['response'] = get_subcategory();
				break;
			case "posts":
				$post_types = quest_get_all_post_types();
				$post_type = !empty($_POST['post_type']) ? $_POST['post_type'] : '';

				$existed = false;
				foreach ($post_types as $items) {
					if (array_key_exists($post_type, $items)) {
						$existed = true;
						break;
					}
				}
				if ($existed) {
					$response['response'] = quest_get_all_posts($post_type);
				} else {
					$response['response'] = false;
				}

				break;
			case "post_types":
				$response['response'] = quest_get_all_post_types();
				break;
			default:
				$response['response'] = false;
		}
	}

	header( "Content-Type: application/json" );
	echo json_encode($response);

	//Don't forget to always exit in the ajax function.
	exit();

}

/**
 * Get subcategories
 */
function get_subcategory()
{
	$args = array(
		'hide_empty' => 0,
		'parent' => 0,
		'taxonomy'=> QUEST_TAXONOMY_SERVICE
	);
	$categories = get_categories($args);
	$field_options = array();

	foreach ($categories as $category) {
		$subcategories = get_categories( array(
			'child_of' => $category->term_id,
			'hide_empty' => 0,
			'taxonomy'=> QUEST_TAXONOMY_SERVICE
		));
		$primary_key = $category->name;
		foreach ($subcategories as $subcategory) {
			$field_options[$primary_key][$subcategory->term_id] = $subcategory->name;
		}
	}
	$field_options['object_level'] = '2';
	return $field_options;
}

/**
 * Get posts
 */
function quest_get_all_posts($post_type = 'post')
{
	$posts = [];
	$obj_posts = new WP_Query(array(
		'post_type' => $post_type,
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'orderby' => 'title',
		'order' => 'ASC'
	));

	foreach ($obj_posts->posts as $obj_post) {
		$posts[$obj_post->ID] = $obj_post->post_title;
	}

	$posts['object_level'] = 1;

	return $posts;
}

/**
 * Get post types
 */
function quest_get_all_post_types()
{
	$post_types = [];
	$obj_post_types = get_post_types(array('public' => true), 'objects');
	foreach ( $obj_post_types as $obj_post_type ) {
		if (quest_is_resources_post_type($obj_post_type->name)) {
			$post_types['Resources'][$obj_post_type->name] = $obj_post_type->label;
		} else {
			$post_types['Others'][$obj_post_type->name] = $obj_post_type->label;
		}
	}
	$post_types['object_level'] = 2;

	return $post_types;
}