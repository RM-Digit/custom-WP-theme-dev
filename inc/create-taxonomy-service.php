<?php
function quest_register_service_taxonomy()
{
    $labels = array(
        'name' => 'Services',
        'singular' => 'Services',
        'menu_name' => 'Services',
        'search_items' => 'Search Services',
        'all_items' => 'All Services',
        'parent_item' => 'Parent Service',
        'parent_item_colon' => 'Parent Service:',
        'edit_item' => 'Edit Service',
        'update_item' => 'Edit Service',
        'add_new_item' => 'Add New Service',
        'new_item_name' => 'New Service Name',
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
    );
    $types = array(
        'post', 'page',
        QUEST_POST_TYPE_RESOURCE_PRESS_RELEASE, QUEST_POST_TYPE_RESOURCE_NEWSLETTER, QUEST_POST_TYPE_RESOURCE_CLIP, QUEST_POST_TYPE_CEO_BLOG, QUEST_POST_TYPE_PARTNER_BLOG, QUEST_POST_TYPE_GOVERNMENT_BLOG, QUEST_POST_TYPE_SECURITY_BLOG, QUEST_POST_TYPE_INFOGRAPHIC,
        QUEST_POST_TYPE_PRODUCT, QUEST_POST_TYPE_RESOURCE_ASSESSMENT, QUEST_POST_TYPE_RESOURCE_WORKSHOP, QUEST_POST_TYPE_RESOURCE_SOLUTION_BRIEF, QUEST_POST_TYPE_RESOURCE_VIDEO, QUEST_POST_TYPE_RESOURCE_NEWSLETTER,
        QUEST_POST_TYPE_VENDOR, QUEST_POST_TYPE_CUSTOMER_STORY
    );

    register_taxonomy(QUEST_TAXONOMY_SERVICE, $types, $args);
}

add_action('init', 'quest_register_service_taxonomy', 0);
