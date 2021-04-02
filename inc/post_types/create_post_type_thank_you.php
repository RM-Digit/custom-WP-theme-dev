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

function quest_create_post_type_thank_you(){

    $labels = array(
        'name'               => _x( 'Thank You Pages', 'post type general name', 'quest-temple' ),
        'singular_name'      => _x( 'Thank You Page', 'post type singular name', 'quest-temple' ),
        'menu_name'          => _x( 'Thank You Pages', 'admin menu', 'quest-temple' ),
        'name_admin_bar'     => _x( 'Thank You Pages', 'add new on admin bar', 'quest-temple' ),
        'add_new'            => _x( 'Add New', 'Thank You Page', 'quest-temple' ),
        'add_new_item'       => __( 'Add New Thank You Page', 'quest-temple' ),
        'new_item'           => __( 'New Thank You Page', 'quest-temple' ),
        'edit_item'          => __( 'Edit Thank You Page', 'quest-temple' ),
        'view_item'          => __( 'View Thank You Page', 'quest-temple' ),
        'all_items'          => __( 'All Thank You Pages', 'quest-temple' ),
        'search_items'       => __( 'Search Thank You Pages', 'quest-temple' ),
        'parent_item_colon'  => __( 'Parent Thank You Page:', 'quest-temple' ),
        'not_found'          => __( 'No Thank You Pages found.', 'quest-temple' ),
        'not_found_in_trash' => __( 'No Thank You Pages found in Trash.', 'quest-temple' )
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
        'menu_icon'          => 'dashicons-smiley',
        'exclude_from_search' => true,
    );
    register_post_type(QUEST_POST_TYPE_THANK_YOU ,$args);
}
add_action('init','quest_create_post_type_thank_you');