<?php

class Quest_Vendor_Partner_Widget extends SiteOrigin_Widget {

    function __construct() {
        //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.
        $vendors = $this->get_vendors(8);



        $form_options = array(
            'title' => array(
                'type' => 'text',
                'label' => __( 'Widget title', 'quest'),
                'default' => ""
            ),
            'description' => array(
                'type' => 'textarea',
                'label' => __( 'Widget description', 'quest'),
                'default' => ""
            ),
            'button' => array(
                'type' => 'section',
                'label' => __( 'Widget button' , 'quest' ),
                'fields' => array(
                    'btn_name' => array(
                        'type' => 'text',
                        'label' => __( 'Name', 'quest' ),
                        'default' => 'View All'
                    ),
                    'btn_link' => array(
                        'type' => 'link',
                        'label' => __( 'Destination Link', 'quest' ),
	                    'default' => get_site_url() . '/vendor'
                    )
                )
            ),
            'vendors' => array(
                'type' => 'select',
                'label' => __( 'Vendors', 'quest' ),
                'multiple' => true,
                'default' => $vendors['default'],
                'options' => $vendors['vendors']
            )

        );
        //Call the parent constructor with the required arguments.
        parent::__construct(
        // The unique id for your widget.
            'quest-vendor-partner-widget',

            // The name of the widget for display purposes.
            __('Quest: Vendor Partner', 'quest'),

            // The $widget_options array, which is passed through to WP_Widget.
            // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
            array(
                'description' => __('Displays a quest vendor partner widget', 'quest'),
                'has_preview' => false
            ),

            //The $control_options array, which is passed through to WP_Widget
            array(
            ),

            //The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
            $form_options,

            //The $base_folder path string.
            plugin_dir_path(__FILE__)
        );
    }

    public function get_template_name($instance)
    {
        return 'widget';
    }

    public function get_template_dir($instance)
    {
        return '';
    }

    private function get_vendors($limit)
    {
        $vendor_posts = get_posts([
            'post_type' => 'vendor',
            'post_status' => 'publish',
            'numberposts' => -1,
             'order'    => 'ASC'
        ]);

        $default_vendors = [];
        $all_vendors = [];
        $count = 0;
        foreach ($vendor_posts as $vendor_post) {
            $id = $vendor_post->ID;
            $title = $vendor_post->post_title;
            // Get limit number beginning posts for default value
            if ($count < $limit) {
                $default_vendors[] = $id;
            }
            // Get all posts
            $all_vendors[$id] = $title;
            $count++;
        }
        // prepare result for returning
        $result = [
            'vendors' => $all_vendors,
            'default' => $default_vendors
        ];
        return $result;
    }

}

siteorigin_widget_register('quest-vendor-partner-widget', __FILE__, 'Quest_Vendor_Partner_Widget');