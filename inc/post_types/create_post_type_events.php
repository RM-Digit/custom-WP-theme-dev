<?php

/**
 * Support in $args can add 'title'
'editor' (content)
'author'
'thumbnail' (featured image, current theme must also support post-thumbnails)
'excerpt'
'trackbacks'
'custom-fields'
'comments' (also will see comment count balloon on edit screen)
'revisions' (will store revisions)
'page-attributes' (menu order, hierarchical must be true to show Parent option)
'post-formats' add post formats, see Post Formats
 */

function quest_create_post_type_event(){

    $labels = array(
        'name'               => _x( 'Quest Event', 'post type general name', 'quest-temple' ),
        'singular_name'      => _x( 'Quest Event', 'post type singular name', 'quest-temple' ),
        'menu_name'          => _x( 'Quest Events', 'admin menu', 'quest-temple' ),
        'name_admin_bar'     => _x( 'Quest Events', 'add new on admin bar', 'quest-temple' ),
        'add_new'            => _x( 'Add New', 'Quest Event', 'quest-temple' ),
        'add_new_item'       => __( 'Add New Quest Event', 'quest-temple' ),
        'new_item'           => __( 'New Quest Event', 'quest-temple' ),
        'edit_item'          => __( 'Edit Quest Event', 'quest-temple' ),
        'view_item'          => __( 'View Quest Event', 'quest-temple' ),
        'all_items'          => __( 'All Quest Events', 'quest-temple' ),
        'search_items'       => __( 'Search Quest Events', 'quest-temple' ),
        'parent_item_colon'  => __( 'Parent Quest Event:', 'quest-temple' ),
        'not_found'          => __( 'No Quest Events found.', 'quest-temple' ),
        'not_found_in_trash' => __( 'No Quest Events found in Trash.', 'quest-temple' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'show_ui'            => true,
        'query_var'          => true,
        'rewrite'            => true,
        'capability_type'    => 'post',
        'publicly_queryable' => true,
        'hierarchical'       => false,
        'show_in_menu'       => true,
        'menu_position'      => 10,
        'supports'           => array('title','editor','thumbnail'),
        'has_archive'        => true,
        'menu_icon'          => 'dashicons-calendar',
        'exclude_from_search' => true,
    );
    register_post_type(QUEST_POST_TYPE_EVENT ,$args);
}
add_action('init','quest_create_post_type_event');