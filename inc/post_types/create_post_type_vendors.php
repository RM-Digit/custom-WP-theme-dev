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

function quest_create_post_type_vendor(){

    $labels = array(
        'name'               => _x( 'Vendors', 'post type general name', 'quest-temple' ),
        'singular_name'      => _x( 'Vendors', 'post type singular name', 'quest-temple' ),
        'menu_name'          => _x( 'Vendors', 'admin menu', 'quest-temple' ),
        'name_admin_bar'     => _x( 'Vendors', 'add new on admin bar', 'quest-temple' ),
        'add_new'            => _x( 'Add New', 'Vendor', 'quest-temple' ),
        'add_new_item'       => __( 'Add New Vendor', 'quest-temple' ),
        'new_item'           => __( 'New Vendor', 'quest-temple' ),
        'edit_item'          => __( 'Edit Vendor', 'quest-temple' ),
        'view_item'          => __( 'View Vendor', 'quest-temple' ),
        'all_items'          => __( 'All Vendors', 'quest-temple' ),
        'search_items'       => __( 'Search Vendors', 'quest-temple' ),
        'parent_item_colon'  => __( 'Parent Vendor:', 'quest-temple' ),
        'not_found'          => __( 'No Vendor found.', 'quest-temple' ),
        'not_found_in_trash' => __( 'No Vendor found in Trash.', 'quest-temple' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'show_ui'            => true,
        'query_var'          => true,
        'rewrite'            => true,
        'capability_type'    => 'post',
        'hierarchical'       => false,
        'show_in_menu'       => true,
        'menu_position'      => 8,
        'supports'           => array('title','editor','thumbnail'),
        'has_archive'        => true,
        'menu_icon'          => 'dashicons-image-filter',
        'exclude_from_search' => true
    );
    register_post_type(QUEST_POST_TYPE_VENDOR,$args);
}
add_action('init','quest_create_post_type_vendor');
