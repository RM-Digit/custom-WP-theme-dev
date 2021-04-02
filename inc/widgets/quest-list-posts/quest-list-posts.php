<?php
/**
 * The widget use for adding service box in home page
 * @package Quest
 */

add_action('widgets_init', 'register_widget_quest_list_posts');

function register_widget_quest_list_posts()
{
    register_widget('Quest_Widget_List_Posts');
}

class Quest_Widget_List_Posts extends SiteOrigin_Widget
{
    public function __construct()
    {
        parent::__construct(
            'quest-list-posts',
            __('Quest: List Posts', 'quest'),
            array(
                'description' => __('Section to display list posts', 'so-widgets-bundle'),
                'help' => ''
            ),
            array(),
            false,
            plugin_dir_path(__FILE__)
        );

    }

    function get_widget_form()
    {
        $types = get_post_types(array('public' => true), 'objects');
        $type_options = array(0=>array('any' => __('All', 'so-widgets-bundle')),'Resources'=>[],'News'=>[]);
        foreach ($types as $id => $type) {
            if(quest_is_resources_post_type($type->name)) {
                $type_options['Resources'][$id] = $type->labels->name;
            } else {
                $type_options[0][$id] = $type->labels->name;
            }
        }

        return array(

            'title' => array('type' => 'tinymce',
                'rows' => 5,
                'label' => __('Before List', 'so-widgets-bundle'),
                'default' => '<h1>Title</h1>',
            ),
            'content' => array(
                'type' => 'tinymce',
                'rows' => 5,
                'label' => __('After List', 'so-widgets-bundle'),
                'default' => ''
            ),
            'services' => array(
                'type' => 'autocomplete',
                'label' => __('Services type', 'so-widgets-bundle'),
                'source' => 'services',
                'description' => __('', 'so-widgets-bundle'),
            ),
            'post_type' => array(
                'type' => 'multi-select',
                'label' => __('Post type', 'so-widgets-bundle'),
                'multiple' => true,
                'options' => $type_options,
                'default' => 'post',
                'has_group'=>true
            ),
            'display_layout' => array(
                'type' => 'select',
                'label' => __('Display layout', 'so-widgets-bundle'),
                'options' => array(
                    'default' => __('Default', 'so-widgets-bundle'),
                    'blog' => __('Three blogs', 'so-widgets-bundle'),
	                'reverse_blog' => __('Three blogs - Reverse', 'so-widgets-bundle'),
                    'four_blog' => __('Four blogs', 'so-widgets-bundle'),
                    'quest_blog' => __('Quest blogs', 'so-widgets-bundle')
                ),
                'default' => 'default'
            ),
            'is_show_footer' => array(
                'type' => 'checkbox',
                'label' => __('Hide footer in post card', 'so-widgets-bundle'),
                'default' => true
            ),
            'button' => array(
	            'type' => 'section',
	            'label' => __( 'Redirect button (optional)' , 'quest' ),
	            'fields' => array(
		            'btn_color' => array(
			            'type' => 'select',
			            'label' => __( 'Button color', 'quest' ),
			            'default' => 'btn-secondary',
			            'options' => array(
				            'btn-primary' => __( 'Primary', 'quest' ),
				            'btn-secondary' => __( 'Secondary', 'quest' ),
				            'btn-success' => __( 'Success', 'quest' ),
				            'btn-info' => __( 'Info', 'quest' ),
				            'btn-warning' => __( 'Warning', 'quest' ),
				            'btn-danger' => __( 'Danger', 'quest' ),
				            'btn-link' => __( 'Link', 'quest' ),
			            )
		            ),
		            'button-text' => array(
			            'type' => 'text',
			            'label' => __( 'Button name', 'quest' ),
		            ),
		            'btn_link' => array(
			            'type' => 'text',
			            'label' => __( 'Button Link', 'quest' )
		            )
	            )
            ),
            'post__in' => array(
                'type' => 'autocomplete',
                'label' => __('Post in', 'so-widgets-bundle'),
                'source' => 'posts',
            ),

            /*'tax_query' => array(
                'type' => 'autocomplete',
                'label' => __('Taxonomies', 'so-widgets-bundle'),
                'source' => 'terms',
                'description' => __('Taxonomies are groups such as categories, tags, posts and products.', 'so-widgets-bundle'),
            ),*/

            'date_type' => array(
                'type' => 'radio',
                'label' => __('Date selection type', 'so-widgets-bundle'),
                'options' => array(
                    'specific' => __('Specific', 'so-widgets-bundle'),
                    'relative' => __('Relative', 'so-widgets-bundle'),
                ),
                'description' => __('Select a range between specific dates or relative to the current date.', 'so-widgets-bundle'),
                'default' => 'specific',
                'state_emitter' => array(
                    'callback' => 'select',
                    'args' => array('date_type')
                ),
            ),

            'date_query' => array(
                'type' => 'date-range',
                'label' => __('Dates', 'so-widgets-bundle'),
                'date_type' => 'specific',
                'state_handler' => array(
                    'date_type[specific]' => array('show'),
                    '_else[date_type]' => array('hide'),
                ),
            ),

            'date_query_relative' => array(
                'type' => 'date-range',
                'label' => __('Dates', 'so-widgets-bundle'),
                'date_type' => 'relative',
                'state_handler' => array(
                    'date_type[relative]' => array('show'),
                    '_else[date_type]' => array('hide'),
                ),
            ),

            'orderby' => array(
                'type' => 'select',
                'label' => __('Order by', 'so-widgets-bundle'),
                'options' => array(
                    'none' => __('No order', 'so-widgets-bundle'),
                    'ID' => __('Post ID', 'so-widgets-bundle'),
                    'author' => __('Author', 'so-widgets-bundle'),
                    'title' => __('Title', 'so-widgets-bundle'),
                    'date' => __('Published date', 'so-widgets-bundle'),
                    'modified' => __('Modified date', 'so-widgets-bundle'),
                    'parent' => __('By parent', 'so-widgets-bundle'),
                    'rand' => __('Random order', 'so-widgets-bundle'),
                    'comment_count' => __('Comment count', 'so-widgets-bundle'),
                    'menu_order' => __('Menu order', 'so-widgets-bundle'),
                    'meta_value' => __('By meta value', 'so-widgets-bundle'),
                    'meta_value_num' => __('By numeric meta value', 'so-widgets-bundle'),
                    'post__in' => __('By include order', 'so-widgets-bundle'),
                ),
                'default' => 'date',
            ),

            'order' => array(
                'type' => 'radio',
                'label' => __('Order direction', 'so-widgets-bundle'),
                'options' => array(
                    'ASC' => __('Ascending', 'so-widgets-bundle'),
                    'DESC' => __('Descending', 'so-widgets-bundle'),
                ),
                'default' => 'DESC',
            ),

            'posts_per_page' => array(
                'type' => 'number',
                'default' => 3,
                'label' => __('Posts per page', 'so-widgets-bundle'),
            ),

            'sticky' => array(
                'type' => 'select',
                'label' => __('Sticky posts', 'so-widgets-bundle'),
                'options' => array(
                    '' => __('Default', 'so-widgets-bundle'),
                    'ignore' => __('Ignore sticky', 'so-widgets-bundle'),
                    'exclude' => __('Exclude sticky', 'so-widgets-bundle'),
                    'only' => __('Only sticky', 'so-widgets-bundle'),
                ),
            ),

            'additional' => array(
                'type' => 'text',
                'label' => __('Additional', 'so-widgets-bundle'),
                'description' => __('Additional query arguments. See <a href="http://codex.wordpress.org/Function_Reference/query_posts" target="_blank" rel="noopener noreferrer">query_posts</a>.', 'so-widgets-bundle'),
            ),
        );
    }

    public function widget($args, $instance)
    {


        echo $args['before_widget'];
            quest_list_post_shortcode($instance);

        echo $args['after_widget'];
    }

    protected function _get_query($query)
    {
        $query = wp_parse_args($query,
            array(
                'post_status' => 'publish',
                'posts_per_page' => 10,
            )
        );
        if (!empty($query['post_type'])) {
            if ($query['post_type'] == '_all') $query['post_type'] = 'any';
            $query['post_type'] = strpos($query['post_type'], ',') !== false ? explode(',', $query['post_type']) : $query['post_type'];
        }
        if (!empty($query['post_type']) && $query['post_type'] == 'attachment' && $query['post_status'] == 'publish') {
            $query['post_status'] = 'inherit';
        }


        if (!empty($query['post__in'])) {
            $query['post__in'] = explode(',', $query['post__in']);
            $query['post__in'] = array_map('intval', $query['post__in']);
        }

        if (!empty($query['tax_query'])) {
            $tax_queries = explode(',', $query['tax_query']);

            $query['tax_query'] = array();
            $query['tax_query']['relation'] = 'OR';
            foreach ($tax_queries as $tq) {
                list($tax, $term) = explode(':', $tq);

                if (empty($tax) || empty($term)) continue;
                $query['tax_query'][] = array(
                    'taxonomy' => $tax,
                    'field' => 'slug',
                    'terms' => $term
                );
            }
        }
        if (!empty($query['services'])) {
            $tax_queries = explode(',', $query['services']);

            if (empty($query['tax_query'])) {
                $query['tax_query'] = array();
                $query['tax_query']['relation'] = 'OR';
            }
            $tax = QUEST_TAXONOMY_SERVICE;
            foreach ($tax_queries as $term) {
                if (empty($tax) || empty($term)) continue;
                $query['tax_query'][] = array(
                    'taxonomy' => $tax,
                    'field' => 'slug',
                    'terms' => $term
                );
            }
            unset($query['services']);
        }

        if (isset($query['date_type']) && $query['date_type'] == 'relative') {

            $date_query_rel = json_decode(
                stripslashes($query['date_query_relative']),
                true
            );
            $value_after = new DateTime(
                $date_query_rel['from']['value'] . ' ' . $date_query_rel['from']['unit'] . ' ago'
            );
            $value['after'] = $value_after->format('Y-m-d');
            $value_before = new DateTime(
                $date_query_rel['to']['value'] . ' ' . $date_query_rel['to']['unit'] . ' ago'
            );
            $value['before'] = $value_before->format('Y-m-d');
            $query['date_query'] = $value;
            unset($query['date_type']);
            unset($query['date_query_relative']);
        } else if (!empty($query['date_query'])) {
            $query['date_query'] = json_decode(stripslashes($query['date_query']), true);
        }

        if (!empty($query['date_query'])) {
            $query['date_query']['inclusive'] = true;
        }

        if (!empty($query['sticky'])) {
            switch ($query['sticky']) {
                case 'ignore' :
                    $query['ignore_sticky_posts'] = 1;
                    break;
                case 'only' :
                    $post_in = empty($query['post__in']) ? array() : $query['post__in'];
                    $query['post__in'] = array_merge($post_in, get_option('sticky_posts'));
                    break;
                case 'exclude' :
                    $query['post__not_in'] = get_option('sticky_posts');
                    break;
            }
            unset($query['sticky']);
        }

        // Exclude the current post (if applicable) to avoid any issues associated with showing the same post again
        if (is_singular() && get_the_id() != false) {
            $query['post__not_in'][] = get_the_id();
        }

        if (!empty($query['additional'])) {
            $query = wp_parse_args($query['additional'], $query);
            unset($query['additional']);

            // If post_not_in is set, we need to convert it to an array to avoid issues with the query.
            if (!empty($query['post__not_in']) && !is_array($query['post__not_in'])) {
                $query['post__not_in'] = explode(',', $query['post__not_in']);
                $query['post__not_in'] = array_map('intval', $query['post__not_in']);
            }
        }
        return apply_filters('quest_widget_list_posts_after_query', $query);
    }
}
