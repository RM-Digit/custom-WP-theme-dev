<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package understrap
 */


/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
if (!function_exists('understrap_posted_on')) {
    function understrap_posted_on()
    {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s"> (%4$s) </time>';
        }
        $time_string = sprintf($time_string,
            esc_attr(get_the_date('c')),
            esc_html(get_the_date()),
            esc_attr(get_the_modified_date('c')),
            esc_html(get_the_modified_date())
        );
        $posted_on = sprintf(
            esc_html_x('Posted on %s', 'post date', 'understrap'),
            '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
        );

        $byline = '';
        $quest_is_author_hidden = get_post_meta(get_the_ID(), 'is-author-hidden', true);
        $included_post_type = quest_blog_post_types();

        if (
            in_array(get_post_type(), $included_post_type) && empty($quest_is_author_hidden)
        ) {
            $byline = sprintf(
                esc_html_x('by %s', 'post author', 'understrap'),
                '<span class="author vcard"><a class="url fn n">' . esc_html(get_the_author()) . '</a></span>'
            );
        }

//        echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
        echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
    }
}


/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
if (!function_exists('understrap_entry_footer')) {
    function understrap_entry_footer()
    {
        // Hide category and tag text for pages.
        if ('post' === get_post_type()) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list(esc_html__(', ', 'understrap'));
            if ($categories_list && understrap_categorized_blog()) {
                printf('<span class="cat-links">' . esc_html__('Posted in %1$s', 'understrap') . '</span>', $categories_list); // WPCS: XSS OK.
            }
            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list('', esc_html__(', ', 'understrap'));
            if ($tags_list) {
                printf('<span class="tags-links">' . esc_html__('Tagged %1$s', 'understrap') . '</span>', $tags_list); // WPCS: XSS OK.
            }
        }
        if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
            echo '<span class="comments-link">';
            comments_popup_link(esc_html__('Leave a comment', 'understrap'), esc_html__('1 Comment', 'understrap'), esc_html__('% Comments', 'understrap'));
            echo '</span>';
        }
        edit_post_link(
            sprintf(
            /* translators: %s: Name of current post */
                esc_html__('Edit %s', 'understrap'),
                the_title('<span class="screen-reader-text">"', '"</span>', false)
            ),
            '<span class="edit-link">',
            '</span>'
        );
    }
}
/**
 * Get list post type custom by menu name is resources
 */
if (!function_exists('quest_get_post_types')) {
    function quest_get_post_types($groupName = 'resources', $type = 'slug')
    {
        $post_types = get_post_types(array('public' => true), 'objects');
        $result = array();
        foreach ($post_types as $post_type) {
            if (is_string($post_type->show_in_menu) && $post_type->show_in_menu == $groupName) {
                if ($type == 'slug') {
                    array_push($result, $post_type->name);
                } else {
                    $result[$post_type->name] = $post_type->label;
                }
            }
        }
        return $result;
    }
}
/**
 * Show post thumbnail
 */
if (!function_exists('quest_posted_thumbnail')) {
    function quest_posted_thumbnail()
    {
        if (has_post_thumbnail()) {
            the_post_thumbnail('medium');
        } elseif (get_post_type() == QUEST_POST_TYPE_RESOURCE_VIDEO) {
            $video_link = get_post_meta(get_the_ID(), 'video-link', true);
            if (empty($video_link))
                return;
            if (preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $video_link, $matches)) {
                echo '<img alt="Quest youtube video" src="//img.youtube.com/vi/' . $matches[0] . '/sddefault.jpg">';
            }
        }
    }
}

/**
 * Show post thumbnail
 */
if (!function_exists('quest_posted_cover_image')) {
    function quest_posted_cover_image()
    {
        if (has_post_thumbnail()) {
            the_post_thumbnail('post-cover');
        }
    }
}

/**
 * Show icon if post type is resources
 */
if (!function_exists('quest_posted_icon')) {
    function quest_posted_icon()
    {
        $curret_post_type = get_post_type();
        if (in_array($curret_post_type, quest_is_show_resource_icon())) {
            $post_type = get_post_type_object($curret_post_type);
            echo '<div class="entry-resource-icon">';
            echo '<span class="quest-resources-icon ' . $post_type->resource_icon . '"></span>';
            echo '</div>';
        }
    }
}
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
if (!function_exists('quest_posted_on')) {
    function quest_posted_on($author = true,$show=false)
    {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
        }
        $time_string = sprintf($time_string,
            esc_attr(get_the_date('c')),
            esc_html(get_the_date()),
            esc_attr(get_the_modified_date('c')),
            esc_html(get_the_modified_date())
        );

        $target = '';
        if (get_post_meta(get_the_ID(), 'is-blank-target', true) == 1) {
            $target = 'target="_blank"';
        }

        $posted_on = sprintf(
            esc_html_x('%s', 'post date', 'quest'),
            $time_string
        );

        $byline = '';
        $quest_is_author_hidden = get_post_meta(get_the_ID(), 'is-author-hidden', true);
        $included_post_type = quest_blog_post_types();

        if (
            $author && in_array(get_post_type(), $included_post_type) && empty($quest_is_author_hidden)
        ) {
            $byline = sprintf(
                esc_html_x('%s', 'post author', 'quest'),
                '<span class="author vcard"><a class="url fn n">' . esc_html(get_the_author()) . '</a></span>'
            );
        }
        $before='';
        $after='';
        if(in_array(get_post_type(), quest_blog_post_types())){
            $postType = get_post_type_object(get_post_type());
            if ($postType) {
                $url = quest_resource_url(['resources[]' => $postType->name]);
                if($show){
                    $before .= '<a href="'.$url.'"><strong>'.$postType->labels->singular_name.'</strong></a>';
//                    $before.='<span class="d-none d-sm-inline-block px-2"> - </span><br class="d-inline-block d-sm-none" />';
                }
            }
//            $show &&($before .= '<strong>Published: </strong>');
        }
//        echo '<p>'.$before.'<span class="posted-on">' . $posted_on . '</span>' ;
        echo '<p>'.$before ;

        echo (!empty($byline) ? '<span class=""> ' . $byline . '</span>' : '') . '</p>';

    }
}


/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
if (!function_exists('quest_entry_footer')) {
    function quest_entry_footer($title_post_type = true)
    {
        $term_list = wp_get_post_terms(get_the_ID(), QUEST_TAXONOMY_SERVICE);
        $resources = quest_get_post_types('resources', 'array');
        $_post_type = get_post_type();
        $symbol = !empty($term_list) ? ':' : '';

        if (!(empty($term_list) && empty($resources[$_post_type]))) {
            echo '<div class="footer-content row mx-0">';
            if (!empty($resources[$_post_type]) && $title_post_type) {
                echo '<span class="newsletter-footer">' . $resources[$_post_type] . $symbol . ' </span>';
            }
            foreach ($term_list as $term) {
                printf('<span class="service-links"><u>' . esc_html__('%1$s', 'quest') . '</u></span>', '<a href="' . quest_resource_url(['services' => [$term->slug]]) . '">' . $term->name . '</a>'); // WPCS: XSS OKe
            }
            echo '</div>';
        }
    }
}
/**
 * @deprecated since the filter types have been merge, This function not working properly if the keys are the same. Use quest_resource_filters
 */
if (!function_exists('quest_resource_filter')) {
    function quest_resource_filter($all_resource, $filters, $type = "post")
    {
        echo '<h1 class="page-title">';
        if ($type == "post")
            echo esc_html__('Filter Types:', 'quest');
        foreach ($filters as $value) {
            if (isset($all_resource[$value]))
                echo '<p>' . $all_resource[$value] . '<span class="uncheck-item" data="' . $value . '">x</span></p>';
        }
        echo '</h1>';
    }
}
if (!function_exists('quest_resource_filters')) {
    /**
     * @param $data: ['resources'=[1=>'R1'],'services'=>[5=>'S5']]
     * @param $filters : ['resources'=[1],'services'=>[5]]
     * @param string $type
     */
    function quest_resource_filters($data, $filters, $type = "post")
    {
        echo '<h1 class="page-title">';
        if ($type == "post") {
            echo esc_html__('Filter Types:', 'quest');
        }
        foreach ($filters as $type=>$filter) {
            foreach ($filter as $value) {
                if (isset($data[$type][$value]))
                    echo '<p>' . $data[$type][$value] . '<span class="uncheck-item" type="'.$type.'" data="' . $value . '">&times;</span></p>';
            }
        }
        echo '</h1>';
    }
}
if (!function_exists('quest_array_list_servives')) {
    function quest_array_list_servives()
    {
        $services = get_terms(QUEST_TAXONOMY_SERVICE, array('parent' => 0, 'hide_empty' => false, 'orderby' => 'id', 'order' => 'ASC'));
        $result = array();
        foreach ($services as $parent) {
            $childs = get_terms(QUEST_TAXONOMY_SERVICE, array('parent' => $parent->term_id, 'hide_empty' => false, 'orderby' => 'id', 'order' => 'ASC'));
            foreach ($childs as $child) {
                $result[$child->slug] = $child->name;
            }
        }
        return $result;
    }
}
if (!function_exists('quest_excerpt')) {
    function quest_excerpt($limit)
    {
        $excerpt = explode(' ', get_the_excerpt(), $limit);

        if (count($excerpt) >= $limit) {
            array_pop($excerpt);
            $excerpt = implode(" ", $excerpt);
        } else {
            $excerpt = implode(" ", $excerpt);
        }

        $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);

        return $excerpt;
    }
}

if (!function_exists('quest_sortable')) {
    function quest_sortable()
    {
        $result = sort_options();
        $text_sort = count($result) > 2 ? 'date-desc' : 'title-asc';
        if (!empty($_GET['sort']) && array_key_exists($_GET['sort'], $result)) {
            $text_sort = $_GET['sort'];
        } else {
            $text_sort = array_keys($result)[0];
        }
        echo '<div class="selected">';
        echo '<a href="javascript:void(0)"><span>' . $result[$text_sort] . '</span><em class="fa fa-caret-down" aria-hidden="true"></em></a>';
        echo '</div><div class="options"><ul>';
        foreach ($result as $key => $value) {
            echo '<li>';
            echo '<input type="radio" id="sort-' . $key . '" ' . ($text_sort == $key ? 'checked' : '') . ' name="sort" class="dropdown-item" value="' . $key . '"/>';
            echo '<label for="sort-' . $key . '">' . $value . '</label></li>';
        }
        echo '</ul></div>';
    }
}
/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
if (!function_exists('understrap_categorized_blog')) {
    function understrap_categorized_blog()
    {
        if (false === ($all_the_cool_cats = get_transient('understrap_categories'))) {
            // Create an array of all the categories that are attached to posts.
            $all_the_cool_cats = get_categories(array(
                'fields' => 'ids',
                'hide_empty' => 1,
                // We only need to know if there is more than one category.
                'number' => 2,
            ));
            // Count the number of categories that are attached to the posts.
            $all_the_cool_cats = count($all_the_cool_cats);
            set_transient('understrap_categories', $all_the_cool_cats);
        }
        if ($all_the_cool_cats > 1) {
            // This blog has more than 1 category so components_categorized_blog should return true.
            return true;
        } else {
            // This blog has only 1 category so components_categorized_blog should return false.
            return false;
        }
    }
}


/**
 * Flush out the transients used in understrap_categorized_blog.
 */
add_action('edit_category', 'understrap_category_transient_flusher');
add_action('save_post', 'understrap_category_transient_flusher');

if (!function_exists('understrap_category_transient_flusher')) {
    function understrap_category_transient_flusher()
    {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        // Like, beat it. Dig?
        delete_transient('understrap_categories');
    }
}

/**
 * Footer Section Function Area
 */

add_action('quest_footer', 'quest_footer_widgets');
if (!function_exists('quest_footer_widgets')) {
    /**
     * Display the theme quick info
     * @since  1.0.0
     * @return void
     */
    function quest_footer_widgets()
    { ?>
        <section class="footer-widgets clearfix">
            <div class="top-footer-wrap">
                <div class="row quest-container">
                    <section class="block footer-widget-1 col-md-4 col-sm-12 order-md-0 order-3">
                        <div class="store-container">
                            <div class="about-info clearfix">
                                <a href="<?php echo get_home_url(); ?>">
                                    <span class="sr-only">logo footer</span>
                                    <img class="logo-footer" src="<?php echo get_bloginfo('template_url') ?>/img/logo-white@4x.png" alt="Questsys logo">
                                </a>
                                <ul>
                                    <?php
                                    $social_links = get_option('quest_social_items');
                                    foreach ($social_links as $social_item) {
                                        $option_key = 'quest_' . $social_item . '_url';
                                        if (!empty(get_option($option_key))) { ?>
                                            <li>
                                                <a href="<?php echo esc_url(get_option($option_key)); ?>" target="_blank"><em class="fa fa-<?php echo $social_item; ?>"></em><span style="display:none;"> Questsys social link</span></a>
                                            </li>
                                        <?php }
                                    } ?>
                                </ul>
                            </div>
                        </div>
                    </section>
                    <?php if (is_active_sidebar('questfooter-ours-services')) : ?>
                        <section class="block footer-widget-2 col-lg-3 col-md-3 order-md-1 order-0 col-sm-5 offset-md-0 offset-sm-2 col-6">
                            <?php dynamic_sidebar('questfooter-ours-services'); ?>
                        </section>
                    <?php endif; ?>
                    <?php if (is_active_sidebar('questfooter-navigation-links')) : ?>
                        <section class="block footer-widget-3 col-lg-2 col-md-3 order-md-2 order-1 col-sm-5 col-6">
                            <?php
                            $is_home = is_front_page();
                            dynamic_sidebar($is_home ? 'questfooter-home-navigation-links' : 'questfooter-navigation-links');
                            ?>
                        </section>
                    <?php endif; ?>
                </div>
            </div>
            <div class="bottom-footer-wrap">
                <p style="margin-left: -1rem; margin-right: -1rem">Quest. All Rights Reserved. Quest © <?php echo date('Y');?>.
                    <span style="white-space: nowrap;">Quest <span class="copyright-text">®</span></span> and
                    <span style="white-space: nowrap;"><img class="copyright-img" src="<?php echo get_bloginfo('template_url') ?>/img/q-copyright.png" alt="Questsys copyright"> <span class="copyright-text">®</span></span>
                    are registered trademarks of Quest Media & <span style="white-space: nowrap;">Supplies, Inc.</span>
                    <br/>Other company names or logos appearing herein may be registered trademarks of their respective holders.</p>
                <p class="mb-0 footer-links">
                    <a class="under" href="<?php echo get_home_url(null, '/privacy-policy') ?>">Read our privacy policy.</a>
                </p>
            </div>
        </section><!-- .footer-widgets  -->
        <?php
    }
}
