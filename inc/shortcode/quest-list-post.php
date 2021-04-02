<?php
function quest_list_post_shortcode($args, $content = "")
{
    //print_r($args);
    $_HAS_POST = false;
    $html = "";
    $_cond_services = null;
    $originArgs = $args;
    $_exclude_resource = !empty($args['exclude_resource']); # Is ignore posts that has been mark Excluded Resource
    $args['template'] = 'loop-templates/content-preview.php';
    $btn_name = __('View More', 'quest');
    if (empty($args['display_layout'])) $args['display_layout'] = 'default';
    if (!empty($args['button']['button-text'])) {
        $btn_name = $args['button']['button-text'];
    }
    if (!empty($args['button-text'])) {
        $btn_name = $args['button-text'];
    }
    if (empty($args['button']['btn_color'])) $args['button']['btn_color'] = 'btn-secondary';
    if (empty($args['post_type'])) $args['post_type'] = get_post_type();
    if (!is_array($args['post_type'])) $args['post_type'] = [$args['post_type']];
    global $num_post_type;
    $num_post_type = count($args['post_type']);

    static $depth = 0;
    $depth++;
    if ($depth > 1) {
        // Because of infinite loops, don't render this post loop if its inside another
        $depth--;
        return;
    }

    $query_args = $args;
    {
        if (!empty($query_args['services'])) {
            $_cond_services = $query_args['services'];
        }
        $query_args = quest_parse_query_args($query_args);
        if (!empty($query_args['sticky'])) {
            switch ($query_args['sticky']) {
                case 'ignore' :
                    $query_args['ignore_sticky_posts'] = 1;
                    break;
                case 'only' :
                    $query_args['post__in'] = get_option('sticky_posts');
                    break;
                case 'exclude' :
                    $query_args['post__not_in'] = get_option('sticky_posts');
                    break;
            }
        }
        if ($_exclude_resource) {
            $excluded = get_option('sep_exclude_resource');
            if (!empty($excluded)) {
                if (!is_array($excluded)) $excluded = array($excluded);
                if (!is_array($query_args['post__not_in'])) $query_args['post__not_in'] = array();
                $query_args['post__not_in'] = array_merge($excluded, $query_args['post__not_in']);
            }
        }
        unset($query_args['template']);
        unset($query_args['title']);
        unset($query_args['sticky']);
        unset($query_args['services']);
        if (empty($query_args['additional'])) {
            $query_args['additional'] = array();
        }
    }
    $query_args = wp_parse_args($query_args['additional'], $query_args);
    unset($query_args['additional']);

    if (!empty($query_args['post__in']) && !is_array($query_args['post__in'])) {
        $query_args['post__in'] = explode(',', $query_args['post__in']);
        $query_args['post__in'] = array_map('intval', $query_args['post__in']);
    }
    $loadFirstPostOfEachBlog = $args['display_layout'] == 'quest_blog';
// Create the query
    if ($loadFirstPostOfEachBlog) {
        //query_posts(apply_filters('siteorigin_panels_postloop_query_args', $query_args));
    } else {
        query_posts(apply_filters('siteorigin_panels_postloop_query_args', $query_args));
    }

    global $more;
    global $is_show_footer;
    global $is_related_service_section;
    $old_more = $more;
    $more = empty($args['more']);
    $is_show_footer = !empty($args['is_show_footer']) ? $args['is_show_footer'] : false;
    $is_related_service_section = !empty($args['is_related_service_section']) ? $args['is_related_service_section'] : false;
    ?>
    <div class="bounder latest-posts" style="">
    <div class="container">
        <div class="before-content"><?php echo $loadFirstPostOfEachBlog || have_posts() ? @$args['title'] : ''; ?></div>
        <?php if ($loadFirstPostOfEachBlog):
            //Reorder port type follow index
            $postTypes = [];
            foreach ($args['post_type'] as $__postType) {
                $postTypes[quest_get_author_index($__postType)] = $__postType;
            }
            ?>
            <div class="card-columns">
                <?php foreach ($postTypes as $__postType): ?>
                    <?php
                    $query_args=$query_args;
                    $_query_args['posts_per_page'] = 1;
                    $_query_args['post_type'] = [$__postType];
                    query_posts(apply_filters('siteorigin_panels_postloop_query_args', $_query_args));
                    if (have_posts()) {
                        $_HAS_POST = true;
                        the_post();
                        ?>
                        <?php locate_template('loop-templates/content-resourcenews.php', true, false); ?>
                        <?php
                    }
                endforeach;
                ?>
                <?php wp_reset_postdata(); ?>
            </div>
        <?php endif; ?>
        <?php if ($args['display_layout'] == 'default'): ?>
            <div class="row list-post-items">
                <?php
                while (have_posts()) {
                    $_HAS_POST = true;
                    the_post();
                    ?>
                    <div class="col-12 col-md-4 mb-4">
                        <?php if (in_array(get_post_type(), quest_resource_item_two_column())) {
                            locate_template('loop-templates/content-relate-service.php', true, false);
                        } elseif ($is_related_service_section) {
                            locate_template('loop-templates/content-video-related-service.php', true, false);
                        } else {
                            locate_template($args['template'], true, false);
                        } ?>
                    </div>
                    <?php
                }
                ?>
            </div>
        <?php elseif ($args['display_layout'] == 'four_blog'): ?>
            <?php $count = 0 ?>
            <div class="card-columns">
                <?php while (have_posts()):
                    $_HAS_POST = true; ?>
                    <?php the_post(); ?>

                    <?php locate_template('loop-templates/content-resourcenews.php', true, false); ?>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <?php $count = $args['display_layout'] == 'reverse_blog' ? 1 : 0; ?>
            <div class="row blog-style">
                <?php while (have_posts()):
                    $_HAS_POST = true; ?>
                    <?php the_post(); ?>
                    <?php if ($count == 1) : ?>
                    <div class="col-12 col-lg-5 mb-4 blog-style-item small-item-style">
                    <div class="row quest-flex-column">
                    <div class="col-12">
                        <?php locate_template($args['template'], true, false); ?>
                    </div>
                <?php elseif ($count == 2): ?>
                    <div class="col-12">
                        <?php locate_template($args['template'], true, false); ?>
                    </div>
                    </div>
                    </div>
                <?php else: ?>
                    <div class="col-12 col-lg-7 mb-4 blog-style-item big-item-style">
                        <?php locate_template($args['template'], true, false); ?>
                    </div>
                <?php endif; ?>
                    <?php $count++; ?>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>

        <?php
        // Reset everything
        wp_reset_query();
        $depth--;
        ?>
        <div class="after-content"><?php
            $searchable = ['post_type', 'post__in', 'orderby', 'order'];
            $query = ['s' => ''];
            if (is_array($_cond_services)) {
                $query['services'] = $_cond_services;
            } elseif (!empty($_cond_services)) {
                $query['services'] = explode(',', $_cond_services);
            }
            foreach ($searchable as $item) {
                if (!empty($query_args[$item])) {
                    if ($item == 'services') {
                        if (is_array($query_args[$item])) {
                            $_services = $query_args[$item];
                        } else {
                            $_services = explode(',', $query_args[$item]);
                        }
                        if (!empty($_services)) {
                            $query[$item] = $_services;
                        }
                    }
                    if ($item == 'post_type') {
                        $query['resources'] = is_array($query_args[$item]) ? $query_args[$item] : explode(',', $query_args[$item]);
                    } else {
                        $query[$item] = $query_args[$item];
                    }
                }
            }

            $resource_post_types = quest_all_resources_post_type();

            if (empty($originArgs['post_type']) || count($args['post_type']) == count($resource_post_types)) {
                // This case show Related service
                $temp['services'] = $query['services'];
                $_btn_link = get_site_url() . '/resources/?' . http_build_query($temp);
            } elseif (count(array_intersect($query['resources'], $resource_post_types)) == count($query['resources'])) {
                // The chose post types just include in resource post types
                unset($query['s']);
                $_btn_link = get_site_url() . '/resources/?' . http_build_query($query);
            } else {
                $_btn_link = get_site_url() . '?' . http_build_query($query);
            }

            if (!empty($args['button']['btn_link'])) $_btn_link = esc_url($args['button']['btn_link']);
            echo $_HAS_POST ? '<div class="text-center view-more-btn"><a href="' . $_btn_link . '" class="text-white btn ' . $args['button']['btn_color'] . '">' . $btn_name . '</a></div>' : '';
            echo $content;
            ?>
            <div class="after-content-second"><?php echo @$args['content']; ?></div>
        </div>
    </div>
    </div><?php
    return $html;
}

add_shortcode('quest-list-post', 'quest_list_post_shortcode');
function quest_parse_query_args($query)
{
    $query = wp_parse_args($query,
        array(
            'post_status' => 'publish',
            'posts_per_page' => 10,
        )
    );
    if (!empty($query['post_type'])) {
        if ($query['post_type'] == '_all') $query['post_type'] = 'any';
        if (!is_array($query['post_type'])) {
            $query['post_type'] = strpos($query['post_type'], ',') !== false ? explode(',', $query['post_type']) : $query['post_type'];
        }
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
        if (is_array($query['services'])) {
            $tax_queries = $query['services'];
        } else {
            $tax_queries = explode(',', $query['services']);
        }

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
