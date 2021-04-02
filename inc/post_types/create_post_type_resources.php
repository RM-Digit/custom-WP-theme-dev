<?php

/**
 * Support in $args can add 'title'
 * 'editor' (content)
 * 'author'
 * 'thumbnail' (featured image, current theme must also support post-thumbnails)
 * 'excerpt'
 * 'trackbacks'
 * 'custom-fields'
 * 'comments' (also will see comment count balloon on edit screen)
 * 'revisions' (will store revisions)
 * 'page-attributes' (menu order, hierarchical must be true to show Parent option)
 * 'post-formats' add post formats, see Post Formats
 */

function quest_create_post_type_press_release(){

    $labels = array(
        'name'               => _x( 'Press Releases', 'post type general name', 'quest' ),
        'singular_name'      => _x( 'Press Releases', 'post type singular name', 'quest' ),
        'menu_name'          => _x( 'Press Releases', 'admin menu', 'quest' ),
        'name_admin_bar'     => _x( 'Press Releases', 'add new on admin bar', 'quest' ),
        'add_new'            => _x( 'Add New', 'Press Release', 'quest' ),
        'add_new_item'       => __( 'Add New Press Release', 'quest' ),
        'new_item'           => __( 'New Press Release', 'quest' ),
        'edit_item'          => __( 'Edit Press Release', 'quest' ),
        'view_item'          => __( 'View Press Release', 'quest' ),
        'all_items'          => __( 'Press Releases', 'quest' ),
        'search_items'       => __( 'Search Press Releases', 'quest' ),
        'parent_item_colon'  => __( 'Parent Press Release:', 'quest' ),
        'not_found'          => __( 'No Press Release found.', 'quest' ),
        'not_found_in_trash' => __( 'No Press Release found in Trash.', 'quest' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'show_ui'            => true,
        'query_var'          => true,
        'rewrite'            => true,
        'capability_type'    => 'post',
        'hierarchical'       => false,
        'show_in_menu'       => 'resources',
        'menu_position'      => null,
        'supports'           => array('title','editor','thumbnail', 'excerpt', 'author'),
        'has_archive'        => true,
    );
    register_post_type(QUEST_POST_TYPE_RESOURCE_PRESS_RELEASE,$args);
}

function quest_create_post_type_solution_news_clip(){

    $labels = array(
        'name'               => _x( 'News Clips', 'post type general name', 'quest' ),
        'singular_name'      => _x( 'News Clips', 'post type singular name', 'quest' ),
        'menu_name'          => _x( 'News Clips', 'admin menu', 'quest' ),
        'name_admin_bar'     => _x( 'News Clips', 'add new on admin bar', 'quest' ),
        'add_new'            => _x( 'Add New', 'News Clip', 'quest' ),
        'add_new_item'       => __( 'Add New News Clip', 'quest' ),
        'new_item'           => __( 'New News Clip', 'quest' ),
        'edit_item'          => __( 'Edit News Clip', 'quest' ),
        'view_item'          => __( 'View News Clip', 'quest' ),
        'all_items'          => __( 'Clips', 'quest' ),
        'search_items'       => __( 'Search News Clips', 'quest' ),
        'parent_item_colon'  => __( 'Parent News Clip:', 'quest' ),
        'not_found'          => __( 'No News Clip found.', 'quest' ),
        'not_found_in_trash' => __( 'No News Clip found in Trash.', 'quest' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'show_ui'            => true,
        'query_var'          => true,
        'rewrite'            => true,
        'capability_type'    => 'post',
        'hierarchical'       => false,
        'show_in_menu'       => 'resources',
        'menu_position'      => null,
        'supports'           => array('title','editor','thumbnail', 'excerpt', 'author'),
        'has_archive'        => true,
    );
    register_post_type(QUEST_POST_TYPE_RESOURCE_CLIP,$args);
}
function quest_create_post_type_assessment()
{

    $labels = array(
        'name' => _x('Workshops', 'post type general name', 'quest'),
        'singular_name' => _x('Workshop', 'post type singular name', 'quest'),
        'menu_name' => _x('Workshops', 'admin menu', 'quest'),
        'name_admin_bar' => _x('Workshop', 'add new on admin bar', 'quest'),
        'add_new' => _x('Add New', 'Workshop', 'quest'),
        'add_new_item' => __('Add New Workshop', 'quest'),
        'new_item' => __('New Workshop', 'quest'),
        'edit_item' => __('Edit Workshop', 'quest'),
        'view_item' => __('View Workshop', 'quest'),
        'all_items' => __('Workshops', 'quest'),
        'search_items' => __('Search Workshop', 'quest'),
        'parent_item_colon' => __('Parent Workshop:', 'quest'),
        'not_found' => __('No Workshop found.', 'quest'),
        'not_found_in_trash' => __('No Workshop found in Trash.', 'quest')
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'show_in_menu' => 'resources',
        'menu_position' => null,
        'supports' => array('title', 'editor', 'thumbnail','excerpt', 'author'),
        'has_archive' => true,
        'resource_icon' => 'icon-assessment'
    );
    register_post_type(QUEST_POST_TYPE_RESOURCE_ASSESSMENT, $args);
}

function quest_create_post_type_workshop()
{
    $labels = array(
        'name' => _x('Workshops', 'post type general name', 'quest'),
        'singular_name' => _x('Workshop', 'post type singular name', 'quest'),
        'menu_name' => _x('Workshops', 'admin menu', 'quest'),
        'name_admin_bar' => _x('Workshops', 'add new on admin bar', 'quest'),
        'add_new' => _x('Add New', 'Workshop', 'quest'),
        'add_new_item' => __('Add New Workshop', 'quest'),
        'new_item' => __('New Workshop', 'quest'),
        'edit_item' => __('Edit Workshop', 'quest'),
        'view_item' => __('View Workshop', 'quest'),
        'all_items' => __('Workshops', 'quest'),
        'search_items' => __('Search Workshops', 'quest'),
        'parent_item_colon' => __('Parent Workshop:', 'quest'),
        'not_found' => __('No Workshop found.', 'quest'),
        'not_found_in_trash' => __('No Workshop found in Trash.', 'quest')
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'show_in_menu' => 'resources',
        'menu_position' => null,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'author'),
        'has_archive' => true,
        'resource_icon' => 'icon-workshop'
    );
    register_post_type(QUEST_POST_TYPE_RESOURCE_WORKSHOP, $args);
}

function quest_create_post_type_solution_brief()
{

    $labels = array(
        'name' => _x('On-Demand Content', 'post type general name', 'quest'),
        'singular_name' => _x('On-Demand Content', 'post type singular name', 'quest'),
        'menu_name' => _x('On-Demand Contents', 'admin menu', 'quest'),
        'name_admin_bar' => _x('On-Demand Contents', 'add new on admin bar', 'quest'),
        'add_new' => _x('Add New', 'On-Demand Content', 'quest'),
        'add_new_item' => __('Add New On-Demand Content', 'quest'),
        'new_item' => __('New On-Demand Content', 'quest'),
        'edit_item' => __('Edit On-Demand Content', 'quest'),
        'view_item' => __('View On-Demand Content', 'quest'),
        'all_items' => __('On-Demand Contents', 'quest'),
        'search_items' => __('Search On-Demand Contents', 'quest'),
        'parent_item_colon' => __('Parent On-Demand Content:', 'quest'),
        'not_found' => __('No On-Demand Content found.', 'quest'),
        'not_found_in_trash' => __('No On-Demand Content found in Trash.', 'quest')
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'show_in_menu' => 'resources',
        'menu_position' => null,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'author'),
        'has_archive' => true,
        'resource_icon' => 'icon-solution_brief'
    );
    register_post_type(QUEST_POST_TYPE_RESOURCE_SOLUTION_BRIEF, $args);
}

function quest_create_post_type_video()
{

    $labels = array(
        'name' => _x('Videos', 'post type general name', 'quest'),
        'singular_name' => _x('Video', 'post type singular name', 'quest'),
        'menu_name' => _x('Videos', 'admin menu', 'quest'),
        'name_admin_bar' => _x('Videos', 'add new on admin bar', 'quest'),
        'add_new' => _x('Add New', 'Video', 'quest'),
        'add_new_item' => __('Add New Video', 'quest'),
        'new_item' => __('New Video', 'quest'),
        'edit_item' => __('Edit Video', 'quest'),
        'view_item' => __('View Video', 'quest'),
        'all_items' => __('Videos', 'quest'),
        'search_items' => __('Search Videos', 'quest'),
        'parent_item_colon' => __('Parent Video:', 'quest'),
        'not_found' => __('No Video found.', 'quest'),
        'not_found_in_trash' => __('No Video found in Trash.', 'quest')
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'show_in_menu' => 'resources',
        'menu_position' => null,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'author'),
        'has_archive' => true,
        'resource_icon' => 'icon-video'
    );
    register_post_type(QUEST_POST_TYPE_RESOURCE_VIDEO, $args);
}
function quest_create_post_type_newsletter()
{

    $labels = array(
        'name' => _x('Newsletters', 'post type general name', 'quest'),
        'singular_name' => _x('Resource Newsletter', 'post type singular name', 'quest'),
        'menu_name' => _x('Newsletters', 'admin menu', 'quest'),
        'name_admin_bar' => _x('Newsletters', 'add new on admin bar', 'quest'),
        'add_new' => _x('Add New', 'Newsletter', 'quest'),
        'add_new_item' => __('Add New Newsletter', 'quest'),
        'new_item' => __('New Newsletter', 'quest'),
        'edit_item' => __('Edit Newsletter', 'quest'),
        'view_item' => __('View Newsletter', 'quest'),
        'all_items' => __('Newsletters', 'quest'),
        'search_items' => __('Search Newsletters', 'quest'),
        'parent_item_colon' => __('Parent Newsletter:', 'quest'),
        'not_found' => __('No Newsletter found.', 'quest'),
        'not_found_in_trash' => __('No Newsletter found in Trash.', 'quest')
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'newsletter'),
        'capability_type' => 'post',
        'hierarchical' => false,
        'show_in_menu' => 'resources',
        'menu_position' => null,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'author'),
        'has_archive' => true,
        'resource_icon' => 'icon-newsletter'
    );
    register_post_type(QUEST_POST_TYPE_RESOURCE_NEWSLETTER, $args);
}

function quest_create_post_type_ceo_blog(){

    $labels = array(
        'name'               => _x( 'CEO Blogs', 'post type general name', 'quest' ),
        'singular_name'      => _x( 'CEO Blog', 'post type singular name', 'quest' ),
        'menu_name'          => _x( 'CEO Blogs', 'admin menu', 'quest' ),
        'name_admin_bar'     => _x( 'CEO Blogs', 'add new on admin bar', 'quest' ),
        'add_new'            => _x( 'Add New', 'CEO Blog', 'quest' ),
        'add_new_item'       => __( 'Add New CEO Blog', 'quest' ),
        'new_item'           => __( 'New CEO Blog', 'quest' ),
        'edit_item'          => __( 'Edit CEO Blog', 'quest' ),
        'view_item'          => __( 'View CEO Blog', 'quest' ),
        'all_items'          => __( 'CEO Blogs', 'quest' ),
        'search_items'       => __( 'Search CEO Blogs', 'quest' ),
        'parent_item_colon'  => __( 'Parent CEO Blog:', 'quest' ),
        'not_found'          => __( 'No CEO Blog found.', 'quest' ),
        'not_found_in_trash' => __( 'No CEO Blog found in Trash.', 'quest' )
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'ceo-blog'),
        'capability_type' => 'post',
        'hierarchical' => false,
        'show_in_menu' => 'resources',
        'menu_position' => null,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt','author'),
        'has_archive' => true,
        'resource_icon' => 'icon-blog'
    );
    register_post_type(QUEST_POST_TYPE_CEO_BLOG,$args);
    register_taxonomy_for_object_type('post_tag', QUEST_POST_TYPE_CEO_BLOG);
}

function quest_create_post_type_partner_blog(){

    $labels = array(
        'name'               => _x( 'Partner Blogs', 'post type general name', 'quest' ),
        'singular_name'      => _x( 'Partner Blog', 'post type singular name', 'quest' ),
        'menu_name'          => _x( 'Partner Blogs', 'admin menu', 'quest' ),
        'name_admin_bar'     => _x( 'Partner Blogs', 'add new on admin bar', 'quest' ),
        'add_new'            => _x( 'Add New', 'Partner Blog', 'quest' ),
        'add_new_item'       => __( 'Add New Partner Blog', 'quest' ),
        'new_item'           => __( 'New Partner Blog', 'quest' ),
        'edit_item'          => __( 'Edit Partner Blog', 'quest' ),
        'view_item'          => __( 'View Partner Blog', 'quest' ),
        'all_items'          => __( 'Partner Blogs', 'quest' ),
        'search_items'       => __( 'Search Partner Blogs', 'quest' ),
        'parent_item_colon'  => __( 'Parent Partner Blog:', 'quest' ),
        'not_found'          => __( 'No Partner Blog found.', 'quest' ),
        'not_found_in_trash' => __( 'No Partner Blog found in Trash.', 'quest' )
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'partner-blog'),
        'capability_type' => 'post',
        'hierarchical' => false,
        'show_in_menu' => 'resources',
        'menu_position' => null,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'author'),
        'has_archive' => true,
        'resource_icon' => 'icon-blog'
    );
    register_post_type(QUEST_POST_TYPE_PARTNER_BLOG,$args);
    register_taxonomy_for_object_type('post_tag', QUEST_POST_TYPE_PARTNER_BLOG);
}
function quest_create_post_type_gov_blog(){

    $labels = array(
        'name'               => _x( 'Government Blogs', 'post type general name', 'quest' ),
        'singular_name'      => _x( 'Government Blog', 'post type singular name', 'quest' ),
        'menu_name'          => _x( 'Government Blogs', 'admin menu', 'quest' ),
        'name_admin_bar'     => _x( 'Government Blogs', 'add new on admin bar', 'quest' ),
        'add_new'            => _x( 'Add New', 'Government Blog', 'quest' ),
        'add_new_item'       => __( 'Add New Government Blog', 'quest' ),
        'new_item'           => __( 'New Government Blog', 'quest' ),
        'edit_item'          => __( 'Edit Government Blog', 'quest' ),
        'view_item'          => __( 'View Government Blog', 'quest' ),
        'all_items'          => __( 'Government Blogs', 'quest' ),
        'search_items'       => __( 'Search Government Blogs', 'quest' ),
        'parent_item_colon'  => __( 'Parent Government Blog:', 'quest' ),
        'not_found'          => __( 'No Government Blog found.', 'quest' ),
        'not_found_in_trash' => __( 'No Government Blog found in Trash.', 'quest' )
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'gov-blog'),
        'capability_type' => 'post',
        'hierarchical' => false,
        'show_in_menu' => 'resources',
        'menu_position' => null,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'author'),
        'has_archive' => true,
        'resource_icon' => 'icon-blog'
    );
    register_post_type(QUEST_POST_TYPE_GOVERNMENT_BLOG,$args);
    register_taxonomy_for_object_type('post_tag', QUEST_POST_TYPE_GOVERNMENT_BLOG);
}
function quest_create_post_type_security_blog(){

    $labels = array(
        'name'               => _x( 'Cybersecurity Blogs', 'post type general name', 'quest' ),
        'singular_name'      => _x( 'Cybersecurity Blog', 'post type singular name', 'quest' ),
        'menu_name'          => _x( 'Cybersecurity Blogs', 'admin menu', 'quest' ),
        'name_admin_bar'     => _x( 'Cybersecurity Blogs', 'add new on admin bar', 'quest' ),
        'add_new'            => _x( 'Add New', 'Cybersecurity Blog', 'quest' ),
        'add_new_item'       => __( 'Add New Cybersecurity Blog', 'quest' ),
        'new_item'           => __( 'New Cybersecurity Blog', 'quest' ),
        'edit_item'          => __( 'Edit Cybersecurity Blog', 'quest' ),
        'view_item'          => __( 'View Cybersecurity Blog', 'quest' ),
        'all_items'          => __( 'Cybersecurity Blogs', 'quest' ),
        'search_items'       => __( 'Search Cybersecurity Blogs', 'quest' ),
        'parent_item_colon'  => __( 'Parent Cybersecurity Blog:', 'quest' ),
        'not_found'          => __( 'No Cybersecurity Blog found.', 'quest' ),
        'not_found_in_trash' => __( 'No Cybersecurity Blog found in Trash.', 'quest' )
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'security-blog'),
        'capability_type' => 'post',
        'hierarchical' => false,
        'show_in_menu' => 'resources',
        'menu_position' => null,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'author'),
        'has_archive' => true,
        'resource_icon' => 'icon-blog'
    );
    register_post_type(QUEST_POST_TYPE_SECURITY_BLOG,$args);
    register_taxonomy_for_object_type('post_tag', QUEST_POST_TYPE_SECURITY_BLOG);
}

function quest_create_post_type_customer_story(){

    $labels = array(
        'name'               => _x( 'Customer Stories', 'post type general name', 'quest' ),
        'singular_name'      => _x( 'Customer Story', 'post type singular name', 'quest' ),
        'menu_name'          => _x( 'Customer Stories', 'admin menu', 'quest' ),
        'name_admin_bar'     => _x( 'Customer Stories', 'add new on admin bar', 'quest' ),
        'add_new'            => _x( 'Add New', 'Customer Story', 'quest' ),
        'add_new_item'       => __( 'Add New Customer Story', 'quest' ),
        'new_item'           => __( 'New Customer Story', 'quest' ),
        'edit_item'          => __( 'Edit Customer Story', 'quest' ),
        'view_item'          => __( 'View Customer Story', 'quest' ),
        'all_items'          => __( 'Customer Stories', 'quest' ),
        'search_items'       => __( 'Search Customer Story', 'quest' ),
        'parent_item_colon'  => __( 'Parent Customer Story:', 'quest' ),
        'not_found'          => __( 'No Customer Story found.', 'quest' ),
        'not_found_in_trash' => __( 'No Customer Story found in Trash.', 'quest' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'show_ui'            => true,
        'query_var'          => true,
        'rewrite'            => true,
        'capability_type'    => 'post',
        'hierarchical'       => false,
        'show_in_menu'       => 'resources',
        'menu_position'      => 7,
        'supports'           => array('title', 'editor', 'thumbnail','excerpt', 'author'),
        'has_archive'        => true,
        'menu_icon'          => 'dashicons-format-status',
        'exclude_from_search' => true
    );
    register_post_type(QUEST_POST_TYPE_CUSTOMER_STORY,$args);
}

function quest_create_post_type_infographics(){

	$labels = array(
		'name'               => _x( 'Infographics', 'post type general name', 'quest' ),
		'singular_name'      => _x( 'Infographic', 'post type singular name', 'quest' ),
		'menu_name'          => _x( 'Infographics', 'admin menu', 'quest' ),
		'name_admin_bar'     => _x( 'Infographics', 'add new on admin bar', 'quest' ),
		'add_new'            => _x( 'Add New', 'Infographic', 'quest' ),
		'add_new_item'       => __( 'Add New Infographic', 'quest' ),
		'new_item'           => __( 'New Infographic', 'quest' ),
		'edit_item'          => __( 'Edit Infographic', 'quest' ),
		'view_item'          => __( 'View Infographic', 'quest' ),
		'all_items'          => __( 'Infographics', 'quest' ),
		'search_items'       => __( 'Search Infographic', 'quest' ),
		'parent_item_colon'  => __( 'Parent Infographic:', 'quest' ),
		'not_found'          => __( 'No Infographic found.', 'quest' ),
		'not_found_in_trash' => __( 'No Infographic found in Trash.', 'quest' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'show_ui'            => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'hierarchical'       => false,
		'show_in_menu'       => 'resources',
		'menu_position'      => 7,
		'supports'           => array('title', 'editor', 'thumbnail','excerpt', 'author'),
		'has_archive'        => true,
		'menu_icon'          => 'dashicons-format-status',
		'exclude_from_search' => true
	);
	register_post_type(QUEST_POST_TYPE_INFOGRAPHIC,$args);
	register_taxonomy_for_object_type('post_tag', QUEST_POST_TYPE_INFOGRAPHIC);
}

/*function quest_create_post_type_product()
{

    $labels = array(
        'name'               => _x('Products', 'post type general name', 'quest'),
        'singular_name'      => _x('Product', 'post type singular name', 'quest'),
        'menu_name'          => _x('Products', 'admin menu', 'quest'),
        'name_admin_bar'     => _x('Products', 'add new on admin bar', 'quest'),
        'add_new'            => _x('Add New', 'Product', 'quest'),
        'add_new_item'       => __('Add New Product', 'quest'),
        'new_item'           => __('New Product', 'quest'),
        'edit_item'          => __('Edit Product', 'quest'),
        'view_item'          => __('View Product', 'quest'),
        'all_items'          => __('Products', 'quest'),
        'search_items'       => __('Search Products', 'quest'),
        'parent_item_colon'  => __('Parent Products:', 'quest'),
        'not_found'          => __('No products found.', 'quest'),
        'not_found_in_trash' => __('No products found in Trash.', 'quest')
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'show_ui'            => true,
        'query_var'          => true,
        'rewrite' => array('slug' => 'product-resource'),
        'capability_type'    => 'post',
        'hierarchical'       => false,
        'show_in_menu'       => 'resources',
        'menu_position'      => 7,
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'author'),
        'has_archive'        => true,
        'menu_icon'          => 'dashicons-format-status',
        'exclude_from_search' => true
    );
    register_post_type(QUEST_POST_TYPE_PRODUCT, $args);
    register_taxonomy_for_object_type('post_tag', QUEST_POST_TYPE_PRODUCT);
}*/

add_action('init', 'quest_create_post_type_assessment');
//add_action('init', 'quest_create_post_type_workshop');
add_action('init', 'quest_create_post_type_ceo_blog');
add_action('init', 'quest_create_post_type_security_blog');
add_action('init', 'quest_create_post_type_solution_brief');
add_action('init', 'quest_create_post_type_customer_story');
add_action('init', 'quest_create_post_type_video');
add_action('init', 'quest_create_post_type_newsletter');
add_action('init', 'quest_create_post_type_press_release');
add_action('init', 'quest_create_post_type_solution_news_clip');
add_action('init', 'quest_create_post_type_gov_blog');
add_action('init', 'quest_create_post_type_partner_blog');
add_action('init', 'quest_create_post_type_infographics');
//add_action('init', 'quest_create_post_type_product');

function quest_register_resource_menu()
{
    add_menu_page('Resources Page', 'Resources',
        'edit_posts', 'resources', '', 'dashicons-format-gallery', 8);
}

add_action('admin_menu', 'quest_register_resource_menu');
