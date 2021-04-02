<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package understrap
 */
require __DIR__.'/extras-redirect.php';
//remove_action('template_redirect', 'redirect_canonical');
add_filter( 'redirect_canonical', 'quest_custom_redirect_canonical', 10, 2 );
function quest_custom_redirect_canonical( $redirect_url, $requested_url ) {
    $redirect_urls = parse_url($redirect_url);
    $requested_urls = parse_url($requested_url);
    // Do not redirect diff domain
    if( $requested_urls['host'] != 'questsys.com' && $redirect_urls['host'] != $requested_urls['host'] ) {
        return $requested_url;
    }
    return $redirect_url;
}
add_filter( 'login_url', 'quest_custom_login_redirect_canonical', 10, 3 );
function quest_custom_login_redirect_canonical( $login_url, $redirect, $force_reauth ) {
    $redirect_urls = parse_url($redirect);
    $requested_urls = parse_url($login_url);
    if( !empty($redirect_urls['host']) && $redirect_urls['host'] != $requested_urls['host'] ) {
        $requested_urls['scheme']=$redirect_urls['scheme'];
        $requested_urls['host']=$redirect_urls['host'];
        $requested_url = $requested_urls['host'];
        if(!empty($requested_urls['scheme'])) {
            $requested_url=$requested_urls['scheme'].'://'.$requested_url;
        }
        if(!empty($requested_urls['path'])) {
            $requested_url.=$requested_urls['path'];
        }
        if(!empty($requested_urls['query'])) {
            $requested_url.='?'.$requested_urls['query'];
        }
        return $requested_url;
    }
}
if (!function_exists('quest_theme_url')) {
    /**
     * Quick echo url of the file in quest theme
     * @param $asset
     */
    function quest_theme_url($file)
    {
        echo get_theme_file_uri($file);
    }
}
add_action('wp_head', 'quest_add_favicons');

if (!function_exists('quest_add_favicons')) {
    function quest_add_favicons()
    {
        echo '<link rel="apple-touch-icon" sizes="180x180" href="' . get_theme_file_uri('favicons/apple-touch-icon.png') . '">
                <link rel="icon" type="image/png" sizes="32x32" href="' . get_theme_file_uri('favicons/favicon-32x32.png') . '">
                <link rel="icon" type="image/png" sizes="16x16" href="' . get_theme_file_uri('favicons/favicon-16x16.png') . '">
                <link rel="manifest" href="' . get_theme_file_uri('favicons/site.js') . '">
                <link rel="mask-icon" href="' . get_theme_file_uri('favicons/safari-pinned-tab.svg') . '" color="#1c4a8d">
                <link rel="shortcut icon" href="' . get_theme_file_uri('favicons/favicon.ico') . '">
                <meta name="msapplication-TileColor" content="#1c4a8d">
                <meta name="msapplication-config" content="' . get_theme_file_uri('favicons/browserconfig.xml') . '">
                <meta name="theme-color" content="#ffffff">';
    }
}
add_filter('body_class', 'understrap_body_classes');

if (!function_exists('understrap_body_classes')) {
    /**
     * Adds custom classes to the array of body classes.
     *
     * @param array $classes Classes for the body element.
     *
     * @return array
     */
    function understrap_body_classes($classes)
    {
        // Adds a class of group-blog to blogs with more than 1 published author.
        if (is_multi_author()) {
            $classes[] = 'group-blog';
        }
        // Adds a class of hfeed to non-singular pages.
        if (!is_singular()) {
            $classes[] = 'hfeed';
        }

        return $classes;
    }
}

// Removes tag class from the body_class array to avoid Bootstrap markup styling issues.
add_filter('body_class', 'understrap_adjust_body_class');

if (!function_exists('understrap_adjust_body_class')) {
    /**
     * Setup body classes.
     *
     * @param string $classes CSS classes.
     *
     * @return mixed
     */
    function understrap_adjust_body_class($classes)
    {

        foreach ($classes as $key => $value) {
            if ('tag' == $value) {
                unset($classes[$key]);
            }
        }

        return $classes;

    }
}

// Filter custom logo with correct classes.
add_filter('get_custom_logo', 'understrap_change_logo_class');

if (!function_exists('understrap_change_logo_class')) {
    /**
     * Replaces logo CSS class.
     *
     * @param string $html Markup.
     *
     * @return mixed
     */
    function understrap_change_logo_class($html)
    {

        $html = str_replace('class="custom-logo"', 'class="img-fluid"', $html);
        $html = str_replace('class="custom-logo-link"', 'class="navbar-brand custom-logo-link"', $html);
        $html = str_replace('alt=""', 'title="Home" alt="logo"', $html);

        return $html;
    }
}

/**
 * Display navigation to next/previous post when applicable.
 */

if (!function_exists('understrap_post_nav')) {
    function understrap_post_nav()
    {
        // Don't print empty markup if there's nowhere to navigate.
        $previous = (is_attachment()) ? get_post(get_post()->post_parent) : get_adjacent_post(false, '', true);
        $next = get_adjacent_post(false, '', false);

        if (!$next && !$previous) {
            return;
        }
        ?>
        <nav class="container navigation post-navigation">
            <h2 class="sr-only"><?php _e('Post navigation', 'understrap'); ?></h2>
            <div class="row nav-links justify-content-between">
                <?php

                if (get_previous_post_link()) {
                    previous_post_link('<span class="nav-previous">%link</span>', _x('<em class="fa fa-angle-left"></em>&nbsp;%title', 'Previous post link', 'understrap'));
                }
                if (get_next_post_link()) {
                    next_post_link('<span class="nav-next">%link</span>', _x('%title&nbsp;<em class="fa fa-angle-right"></em>', 'Next post link', 'understrap'));
                }
                ?>
            </div><!-- .nav-links -->
        </nav><!-- .navigation -->

        <?php
    }
}
/* CUSTOM PAGE BUILDER STYLES */

add_filter('siteorigin_panels_settings_defaults', 'quest_mobile_breakpoint', 12, 1);
/**
 * Reset default settings of page builder
 * @param $defaults
 * @return mixed
 */
function quest_mobile_breakpoint($defaults)
{
    $defaults['mobile-width'] = 767.98;
    $defaults['margin-bottom'] = 0;
    return $defaults;
}

add_filter('siteorigin_panels_row_style_fields', 'quest_row_style_fields', 12, 1);
/**
 * Support row with container, not yet support full width background
 * @param $fields
 * @return mixed
 */
function quest_row_style_fields($fields)
{
    $fields['row_stretch']['options']['container'] = __('Full Width Standard', 'quest');
    return $fields;
}

add_filter('siteorigin_panels_row_style_attributes', 'quest_row_style_attributes', 10, 2);
/**
 * Render row with container
 * @param $attributes
 * @param $style
 * @return mixed
 */
function quest_row_style_attributes($attributes, $style)
{
    if (isset($style['row_stretch']) || !empty($style['row_stretch']) && $style['row_stretch'] == 'container') {
        $attributes['class'][] = 'container';
        $attributes['style'] = '';
    }
    return $attributes;
}

add_filter('siteorigin_panels_widget_style_attributes', 'quest_panels_widget_style_attributes', 10, 2);
/**
 * Render row with container
 * @param $attributes
 * @param $style
 * @return mixed
 */
function quest_panels_widget_style_attributes($attributes, $style)
{
    if (!empty($style['background_overlay'])) {
        $_cls = [];
        if (!is_array($style['background_overlay'])) {
            $_cls = explode(' ', $style['background_overlay']);
        }
        $attributes['class'] = array_merge($attributes['class'], $_cls);
    }
    return $attributes;
}

add_filter('siteorigin_panels_widget_style_css', 'quest_row_general_style_css', 10, 2);
/**
 * Custom background size when set it's background of widget
 * @param $attributes
 * @param $style
 * @return mixed
 */
function quest_row_general_style_css($css, $style)
{
    if (!empty($style['background_display']) &&
        !empty($style['background_image_attachment'])
    ) {

        $url = SiteOrigin_Panels_Styles::get_attachment_image_src($style['background_image_attachment'], 'background');

        if (!empty($url)) {
            $css['background-image'] = 'url(' . $url[0] . ')';
        }
    }
    return $css;
}

function _get_all_image_sizes()
{
    global $_wp_additional_image_sizes;
    $default_image_sizes = array('thumbnail', 'medium', 'large');

    foreach ($default_image_sizes as $size) {
        $image_sizes[$size]['width'] = intval(get_option("{$size}_size_w"));
        $image_sizes[$size]['height'] = intval(get_option("{$size}_size_h"));
        $image_sizes[$size]['crop'] = get_option("{$size}_crop") ? get_option("{$size}_crop") : false;
    }

    if (isset($_wp_additional_image_sizes) && count($_wp_additional_image_sizes))
        $image_sizes = array_merge($image_sizes, $_wp_additional_image_sizes);

    return $image_sizes;
}

// Switch div, work not properly
add_filter('siteorigin_panels_row_attributes', 'quest_row_attributes', 10, 2);
function quest_row_attributes($attributes, $row)
{
    if (!empty($row['style']['row_stretch']) && $row['style']['row_stretch'] == 'container') {
        $attributes['id'] .= '-container';
        $attributes['class'] .= ' panel-row-style';
    }

    return $attributes;
}

add_filter('siteorigin_panels_before_row', 'quest_row_before_row', 10, 3);
function quest_row_before_row($html, $row, $attributes)
{
    $id = '';
    if (!empty($row['style']['row_stretch']) && $row['style']['row_stretch'] == 'container') {
        $attributes['id'] = str_replace('-container', '', $attributes['id']);

        return $html . quest_render_element('div', $attributes);
    }
    return $html;
}

add_filter('siteorigin_panels_after_row', 'quest_row_after_row', 10, 3);
function quest_row_after_row($html, $row, $attr)
{
    if (!empty($row['style']['row_stretch']) && $row['style']['row_stretch'] == 'container') {
        return '</div>' . $html;
    }
    return $html;
}

function quest_render_element($tag, $attributes)
{

    echo '<' . $tag;
    foreach ($attributes as $name => $value) {
        if ($value) {
            echo ' ' . $name . '="' . esc_attr($value) . '" ';
        }
    }
    echo '>';

}

/**
 * Add panel widget style fields
 */
add_filter('siteorigin_panels_widget_style_fields', 'quest_panels_widget_style_fields');
function quest_panels_widget_style_fields($fields)
{
    $fields['background_overlay'] = array(
        'name' => __('Background Overlay', 'siteorigin-panels'),
        'type' => 'select',
        'group' => 'design',
        'options' => array(
            '' => __('-- None --', 'siteorigin-panels'),
            'home-header-background-video' => __('Home header video background', 'siteorigin-panels'),
            'homepage-how-can-help with-blue-gradient' => __('Home page header gradient', 'siteorigin-panels'),
            'gradient-bg-content gradient-bg-color-dark-blue' => __('Landing page header gradient', 'siteorigin-panels'),
            'gradient-bg-content gradient-dark-blue-without-image' => __('Header gradient without image', 'siteorigin-panels'),
            'gradient-bg-content gradient-bg-color-light-blue' => __('Cyan gradient', 'siteorigin-panels'),
            'gradient-bg-content gradient-light-blue-without-image special-image' => __('Cyan gradient with special image', 'siteorigin-panels'),
            'gradient-bg-content gradient-light-blue-without-image' => __('Cyan gradient without image', 'siteorigin-panels'),
            'gradient-bg-content transparent-bg-color-light-blue' => __('Cyan transparent', 'siteorigin-panels'),
            'gradient-bg-content transparent-bg-color-light-blue blue-line' => __('Cyan transparent with blue line', 'siteorigin-panels'),
            'gradient-bg-content transparent-bg-color-light-blue special-image' => __('Cyan transparent with special image', 'siteorigin-panels'),
            'gradient-bg-content transparent-bg-color-light-blue without-image' => __('Cyan transparent with two contents', 'siteorigin-panels'),

        ),
        'description' => __('How the background image is displayed.', 'siteorigin-panels'),
        'priority' => 8,
    );
    return $fields;
}

/*
add_filter('siteorigin_panels_css_object', 'quest_panels_css_object', 10, 4);
function quest_panels_css_object($css, $panels_data, $post_id, $layout)
{
    print_r([$css, $panels_data, $post_id, $layout]);
    return $css;
}*/
/**
 * Action to handle searching taxonomy terms: service
 */
function quest_sort_terms_hierarchicaly(Array &$cats, Array &$into, $parentId = 0)
{
    foreach ($cats as $i => $cat) {
        if ($cat->parent == $parentId) {
            $into[$cat->term_id] = $cat;
            unset($cats[$i]);
        }
    }

    foreach ($into as $topCat) {
        $topCat->children = array();
        quest_sort_terms_hierarchicaly($cats, $topCat->children, $topCat->term_id);
    }
}

function quest_append_children_terms($result, &$results, $level = 0)
{
    $results[] = array(
        'value' => $result->slug,
        'label' => str_repeat('&nbsp;', $level * 2) . $result->name,
        'type' => $result->count,
    );
    if (!empty($result->children)) foreach ($result->children as $key => $res) {
        quest_append_children_terms($res, $results, $level + 1);
    }
}

function quest_widget_action_search_services()
{
    if (empty($_REQUEST['_widgets_nonce']) || !wp_verify_nonce($_REQUEST['_widgets_nonce'], 'widgets_action')) {
        wp_die(__('Invalid request.', 'so-widgets-bundle'), 403);
    }
    $res = get_categories(['taxonomy' => QUEST_TAXONOMY_SERVICE, 'hide_empty' => false]);
    $categoryHierarchy = array();
    quest_sort_terms_hierarchicaly($res, $categoryHierarchy);
    $results = array();
    foreach ($categoryHierarchy as $result) {
        quest_append_children_terms($result, $results);
    }

    wp_send_json($results);
}

add_action('wp_ajax_so_widgets_search_services', 'quest_widget_action_search_services');
/* END CUSTOM PAGE BUILDER STYLES */
/* COMMON FUNCTIONS */
function quest_is_show_posted_on()
{
    return array('post', QUEST_POST_TYPE_CEO_BLOG, QUEST_POST_TYPE_PARTNER_BLOG, QUEST_POST_TYPE_GOVERNMENT_BLOG, QUEST_POST_TYPE_SECURITY_BLOG, QUEST_POST_TYPE_RESOURCE_CLIP, QUEST_POST_TYPE_RESOURCE_PRESS_RELEASE);
}

function quest_is_show_resource_icon()
{
    return array(QUEST_POST_TYPE_RESOURCE_ASSESSMENT, QUEST_POST_TYPE_RESOURCE_SOLUTION_BRIEF, QUEST_POST_TYPE_RESOURCE_VIDEO, QUEST_POST_TYPE_RESOURCE_NEWSLETTER);
}

function quest_has_posted_on($post_type)
{
    return in_array($post_type, quest_is_show_posted_on());
}

function quest_is_resources_post_type($post_type)
{
    return in_array($post_type, quest_all_resources_post_type());
}

function quest_is_pdf_post_type($post_type)
{
    return in_array($post_type, quest_all_pdf_post_types());
}

function quest_is_video_post_type($post_type)
{
    return in_array($post_type, quest_all_video_post_types());
}

function quest_is_support_salesfusion_form($post_type)
{
    return $post_type == 'page' || $post_type == QUEST_POST_TYPE_EVENT || quest_is_resources_post_type($post_type);
}

function quest_all_resources_post_type($except = [])
{
	$all = array(QUEST_POST_TYPE_RESOURCE_CLIP, QUEST_POST_TYPE_PARTNER_BLOG, QUEST_POST_TYPE_GOVERNMENT_BLOG, QUEST_POST_TYPE_SECURITY_BLOG, QUEST_POST_TYPE_CEO_BLOG, QUEST_POST_TYPE_RESOURCE_PRESS_RELEASE, QUEST_POST_TYPE_RESOURCE_ASSESSMENT, QUEST_POST_TYPE_RESOURCE_NEWSLETTER, QUEST_POST_TYPE_RESOURCE_SOLUTION_BRIEF, QUEST_POST_TYPE_RESOURCE_VIDEO, QUEST_POST_TYPE_INFOGRAPHIC);

    return array_diff($all, $except);
}

function quest_relate_service_post_type()
{
    return array(QUEST_POST_TYPE_RESOURCE_ASSESSMENT, QUEST_POST_TYPE_RESOURCE_SOLUTION_BRIEF);
}

function quest_our_archives()
{
    return array(QUEST_POST_TYPE_CEO_BLOG, QUEST_POST_TYPE_PARTNER_BLOG, QUEST_POST_TYPE_GOVERNMENT_BLOG, QUEST_POST_TYPE_SECURITY_BLOG, QUEST_POST_TYPE_RESOURCE_PRESS_RELEASE, QUEST_POST_TYPE_RESOURCE_CLIP, QUEST_POST_TYPE_RESOURCE_NEWSLETTER);
}

function quest_all_pdf_post_types()
{
    return array(QUEST_POST_TYPE_RESOURCE_ASSESSMENT, QUEST_POST_TYPE_RESOURCE_SOLUTION_BRIEF, QUEST_POST_TYPE_RESOURCE_NEWSLETTER, QUEST_POST_TYPE_CUSTOMER_STORY, 'post');
}

function quest_all_video_post_types()
{
    return array(QUEST_POST_TYPE_RESOURCE_VIDEO);
}

function get_all_target_blank_post_types()
{
	return array(QUEST_POST_TYPE_RESOURCE_ASSESSMENT, QUEST_POST_TYPE_RESOURCE_SOLUTION_BRIEF, QUEST_POST_TYPE_RESOURCE_NEWSLETTER, QUEST_POST_TYPE_RESOURCE_CLIP);
}

function quest_resource_item_one_column()
{
    return array(QUEST_POST_TYPE_RESOURCE_PRESS_RELEASE, QUEST_POST_TYPE_RESOURCE_CLIP);
}

function quest_resource_item_two_column()
{
    return array(QUEST_POST_TYPE_RESOURCE_ASSESSMENT, QUEST_POST_TYPE_RESOURCE_NEWSLETTER, QUEST_POST_TYPE_RESOURCE_SOLUTION_BRIEF, QUEST_POST_TYPE_PARTNER_BLOG, QUEST_POST_TYPE_GOVERNMENT_BLOG, QUEST_POST_TYPE_SECURITY_BLOG, QUEST_POST_TYPE_CEO_BLOG);
}

function quest_blog_post_types()
{
    // Order is important
    return array(QUEST_POST_TYPE_CEO_BLOG, QUEST_POST_TYPE_SECURITY_BLOG, QUEST_POST_TYPE_GOVERNMENT_BLOG, QUEST_POST_TYPE_PARTNER_BLOG);
}
function quest_get_blog_post_types_other_name($post_type)
{
	$otherNames = [
        QUEST_POST_TYPE_CEO_BLOG => 'CEO',
        QUEST_POST_TYPE_SECURITY_BLOG => 'Cybersecurity',
        QUEST_POST_TYPE_GOVERNMENT_BLOG => 'Government',
        QUEST_POST_TYPE_PARTNER_BLOG => 'Partnership'
    ];
	return empty($otherNames[$post_type]) ? '' : $otherNames[$post_type];
}

function quest_get_author_index($post_type)
{
	$mapAuthorIndex = [
		QUEST_POST_TYPE_CEO_BLOG => QUEST_AUTHOR_INDEX_CEO_BLOG,
		QUEST_POST_TYPE_SECURITY_BLOG => QUEST_AUTHOR_INDEX_SECURITY_BLOG,
		QUEST_POST_TYPE_GOVERNMENT_BLOG => QUEST_AUTHOR_INDEX_GOVERNMENT_BLOG,
        QUEST_POST_TYPE_PARTNER_BLOG => QUEST_AUTHOR_INDEX_PARTNER_BLOG,
	];
	return empty($mapAuthorIndex[$post_type]) ? -1 : (int) $mapAuthorIndex[$post_type];
}
/* END COMMON FUNCTIONS */
/* MENU */
/**
 * Add service
 * @param $items
 * @param $args
 * @return mixed
 */
function quest_add_nav_menu_objects($items, $args)
{
    if ($args->theme_location == 'primary') {

    }
    die(print_r($items, true));
    return $items;
}

//add_filter('wp_nav_menu_objects', 'quest_add_nav_menu_objects', 10, 2);

function quest_pre_add_nav_menu_objects($items, $menu, $args)
{

    return $items;
}

//add_filter('wp_get_nav_menu_items', 'quest_pre_add_nav_menu_objects', 10, 3);
function quest_nave_menu_add_category_icon($title, $item, $args, $depth)
{//die(print_r($args,true));
    if ($args->theme_location == 'primary') {
        if ($depth == 1 && $item->type == 'taxonomy' && $item->object == QUEST_TAXONOMY_SERVICE) {
            $icon = get_term_meta($item->object_id, 'icon', true);
            if (!empty($icon)) {
                $title = '<em class="quest-icon ' . $icon . '"></em>&nbsp;' . $title;
            }
        }
    }
    return $title;
}

// add_filter('nav_menu_item_title', 'quest_nave_menu_add_category_icon', 10, 4);
/* END MENU */
function quest_so_fields_class_paths($class_paths)
{
    $class_paths[] = plugin_dir_path(__FILE__) . 'so-fields/';
    //die(print_r($class_paths,true));
    return $class_paths;
}

add_filter('siteorigin_widgets_field_class_paths', 'quest_so_fields_class_paths');
function quest_media_add_pdf($post_mime_types)
{

    // select the mime type, here: 'application/pdf'
    // then we define an array with the label values

    $post_mime_types['application/pdf'] = array(__('PDFs'), __('Manage PDFs'), _n_noop('PDF <span class="count">(%s)</span>', 'PDFs <span class="count">(%s)</span>'));
    $post_mime_types['application/ics'] = array(__('iCalendar'), __('Manage iCalendar'), _n_noop('ICS <span class="count">(%s)</span>', 'ICS <span class="count">(%s)</span>'));
    $post_mime_types['application/vcs'] = array(__('vCalendar'), __('Manage iCalendar'), _n_noop('VCS <span class="count">(%s)</span>', 'VCS <span class="count">(%s)</span>'));

    // then we return the $post_mime_types variable
    return $post_mime_types;

}

function quest_calendar_mimes($existing_mimes)
{
    // add webm to the list of mime types
    $existing_mimes['ics'] = 'application/ics';
    $existing_mimes['vcs'] = 'application/vcs';
    $existing_mimes['pst'] = 'application/pst';
    // return the array back to the function with our added mime type
    return $existing_mimes;
}

add_filter('mime_types', 'quest_calendar_mimes');

// Add Filter Hook
add_filter('post_mime_types', 'quest_media_add_pdf');
add_action('template_redirect', 'quest_resource_redirect_empty_content_pre',1);
add_action('template_redirect', 'quest_resource_redirect_empty_content');
function quest_resource_redirect_empty_content()
{
    // Disable access thank you, event archive page and attachment page
    if (is_attachment()) {
        global $wp_query;
        $wp_query->set_404();
        status_header(404);
        get_template_part(404);
        exit();
    }
    if (is_tax(QUEST_TAXONOMY_SERVICE)) {
        global $wp_query;
        // Redirect sub-service taxonomy page to single page if it has one page
        if ($wp_query->found_posts == 1) {
            $_post = $wp_query->get_posts();
            wp_redirect(get_permalink($_post[0]), 302);
        } else {
            wp_redirect(quest_resource_url(['services[]' => get_query_var('term')]), 302);
        }
    } elseif (is_archive()
        && !is_post_type_archive(QUEST_POST_TYPE_CEO_BLOG)
        && !is_post_type_archive(QUEST_POST_TYPE_PARTNER_BLOG)
        && !is_post_type_archive(QUEST_POST_TYPE_GOVERNMENT_BLOG)
        && !is_post_type_archive(QUEST_POST_TYPE_SECURITY_BLOG)
        && !is_post_type_archive(QUEST_POST_TYPE_RESOURCE_PRESS_RELEASE)
        && !is_post_type_archive(QUEST_POST_TYPE_RESOURCE_NEWSLETTER)
        && !is_post_type_archive(QUEST_POST_TYPE_RESOURCE_CLIP)) {
        $post_type = get_post_type();
        if (quest_is_resources_post_type($post_type)) {
            wp_redirect(quest_resource_url(['resources[]' => $post_type]), 302);
        } else {
            if ($post_type) {
                $_url = quest_archive_alternative_page($post_type);

                if (!empty($_url)) {
                    wp_redirect($_url, 302);
                }
            } else {
                wp_redirect(home_url());
            }
        }
    } elseif (is_single()) {
        $post_type = get_post_type();
        // Todo: Vendor do not have single page
        if ($post_type == QUEST_POST_TYPE_VENDOR) {
            wp_redirect(get_post_type_archive_link($post_type));
            return true;
        }
        // Redirect to PDF/URL if it's news clip
        if ($post_type == QUEST_POST_TYPE_RESOURCE_CLIP) {
            $post = get_post();
            $content = trim(str_replace(['<p>', '</p>'], '', $post->post_content));
            if (filter_var($content, FILTER_VALIDATE_URL)) {
                wp_redirect(($content), 302);
            }
        }
        // Redirect to PDF if this resource does not have caption and content
        if (quest_is_pdf_post_type($post_type)) {
            $post = get_post();
            if (empty($post->post_content)) {
                $pdfCaption = get_post_meta(get_the_ID(), 'quest-pdf-file-caption', true);
                if (empty($pdfCaption)) {
                    $pdfID = get_post_meta(get_the_ID(), 'quest-pdf-file', true);
                    $pdfLink = get_post_meta(get_the_ID(), 'quest-pdf-file-link', true);
                    $pdfURL = wp_get_attachment_url($pdfID);
                    //die(print_r(get_post($pdfID)));
                    if (!empty($pdfID)) {
                        $fileObj = get_post($pdfID);
                        $file = get_attached_file($pdfID);
                        if(file_exists($file)) {
                            $maxRead = 1 * 1024 * 1024; // 1MB
                            $fileName = $post->post_title.'.'. pathinfo($pdfURL, PATHINFO_EXTENSION);
                            $fh = fopen($file, 'r');
                            header('Content-Type: ' . $fileObj->post_mime_type);
                            header('Content-Disposition: inline; filename="' . $fileName . '"');
                            while (!feof($fh)) {
                                // Read and output the next chunk.
                                echo fread($fh, $maxRead);
                                // Flush the output buffer to free memory.
                                ob_flush();
                            }
                            exit;
                        }
                    } else {
                        if (!empty($pdfURL)) {
                            wp_redirect(quest_convert_domain_link($pdfURL), 302);
                        }
                    }
                    if (!empty($pdfLink)) {
                        if(preg_match('/^(https?:\/\/)([^\\/]+\.)?questsys.com+(\/)/i',$pdfLink.'/')){
                            // Accept to redirect to https://questsys.com/
                            wp_redirect($pdfLink, 302);
                        }else{wp_redirect(quest_convert_domain_link($pdfLink), 302);}
                    }
                }
            }
        }
    } elseif (is_404()) {
        $uri = parse_url($_SERVER['REQUEST_URI']);
        quest_detect_old_link($uri['path'],$uri);
    }
}

function quest_detect_old_link($uri,$uris=null)
{
    global $wpdb;

    $url = 'https://www.questsys.com' . $uri;
    $query_string = "SELECT DISTINCT post_id " .
        "FROM {$wpdb->postmeta} " .
        "WHERE meta_key = 'old-link' AND meta_value = '{$url}'";

    $post_id_objects = $wpdb->get_results($query_string, OBJECT);

    if (!empty($post_id_objects)) foreach ($post_id_objects as $post_id_object){
        $post_id = $post_id_object->post_id;
        $_post = get_post($post_id);
        if(empty($_post->ID) || $_post->post_status!='publish'){
            continue;
        }
        $post_url = get_permalink($post_id);
        wp_redirect($post_url, 302);
    }
    quest_redirect_collection($uri,$uris);
}

/**
 * Change domain of the old link to new domain
 * @param $url
 * @param $domain
 */
function quest_convert_domain_link($url, $domain = null)
{
    if (empty($domain)) $domain = get_home_url();
    return preg_replace('/^(https?:\/\/)?[^\\/]+(\/)/i', $domain . '/', $url);
}

function is_resource_page()
{
    return get_option('quest_resource_page_id') == get_the_ID();
}

// Add noindex for exclude pages
add_filter('aioseop_robots_meta', 'quest_aioseop_robots_meta', 10);
function quest_aioseop_robots_meta($robots_meta)
{
    if (strpos($robots_meta, 'noindex') === false && (is_single() || is_page())) {

        $quest_is_exclude_search = get_post_meta(get_the_ID(), 'exclude-search-engines', true);
        if($quest_is_exclude_search===''){ // Has not set, copy from exclude search
            $quest_is_exclude_search =  get_post_meta(get_the_ID(), 'exclude-search', true);
        }
        if ($quest_is_exclude_search) {
            if ($robots_meta == '') return 'noindex, follow';
            else return str_replace('index', 'noindex', $robots_meta);
        }
    }
    return $robots_meta;
}

remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'quest_trim_excerpt', 8, 2);
function quest_trim_excerpt($excerpt, $post)
{
    if (!empty($excerpt)) return $excerpt;
    $_min_words = 20;
    $_max_words = 80;
    $text = strip_shortcodes($post->post_content . '</p>');
    $text = str_replace(']]>', ']]&gt;', $text);
    if (preg_match('/<!--more(.*?)?-->/', $text, $matches)) {
        list($text) = explode($matches[0], $text, 2);
        $text = strip_tags($text, '<p><h1><h2><h3><h4><h5><h6>');
    } else {
        $text = strip_tags($text, '<p><h1><h2><h3><h4><h5><h6>');
        if (preg_match_all('/(<\/p>|<h\d+>)/iU', $text, $matches, PREG_OFFSET_CAPTURE)) {
            $i = count($matches[1]) - 1;
            $_is_trimmed = false;
            for (; $i >= 0; $i--) {
                $_match = $matches[1][$i];
                if ($_match[1] < $_max_words * 7 && $_match[1] > $_min_words * 7) {
                    $_is_trimmed = true;
                    $text = substr($text, 0, $_match[1] - 1);
                    break;
                }
            }
            if (!$_is_trimmed) {
                $text = wp_trim_words($text, $_max_words, '');
            }
        }

    }
    if ($post->post_type == 'page') {
        $text = preg_replace('/<h([6])[^>]*>(.*?)<\/h\1>/', '$2', $text);
    } else {
        $text = preg_replace('/<h(\d+)[^>]*>(.*?)<\/h\1>/', '$2', $text);
    }
    $text = preg_replace('/^[\s]*(.*)[\s]*$/', '\\1', $text);
    return $text;
}

function quest_resource_excerpt()
{
    echo rtrim(get_the_excerpt(), ' \t.') . '...';
}

function quest_resource_url($arg)
{
    $url = esc_url(get_permalink(get_option('quest_resource_page_id')));

    if (is_array($arg) && sizeof($arg)==1){
        $keys=array_keys($arg);

        if (sizeof($keys)==1) {
            $key=$keys[0];

            if (in_array($key, array('services','resources')) && is_array($arg[$key]) && sizeof($arg[$key])==1) {
                $filter_param=$arg[$key][0];

                return $url.$key.'-res-'.$filter_param.'/';
            } else if ($key=='resources[]' && !is_array($arg[$key])) {
                return $url.'resources-res-'.$arg[$key].'/';
            }
        }
    }

    $url .= '?' . http_build_query($arg);
    return $url;
}

/**
 * Get the landing page of a post type that setup in WP Admin / Quest Settings / Pages
 * @param $post_type
 * @param $arg
 * @return string
 */
function quest_archive_alternative_page($post_type, $arg = null)
{
    $page_id = get_option('quest_archive_alternative_page_' . $post_type);
    if ($page_id == -1) {
        return home_url();
    } else if (!empty($page_id)) {
        $url = esc_url(get_permalink($page_id));
        if (!empty($arg)) {
            $url .= '?' . http_build_query($arg);
        }
        return $url;
    }
    return '';
}

function quest_get_content_slug($post_type, $default = 'news')
{
    if ($post_type == 'page' || $post_type == QUEST_POST_TYPE_THANK_YOU) return 'page';
    if ($post_type == QUEST_POST_TYPE_CEO_BLOG || $post_type == QUEST_POST_TYPE_PARTNER_BLOG || $post_type == QUEST_POST_TYPE_GOVERNMENT_BLOG || $post_type == QUEST_POST_TYPE_SECURITY_BLOG || $post_type == QUEST_POST_TYPE_RESOURCE_CLIP || $post_type == QUEST_POST_TYPE_RESOURCE_PRESS_RELEASE || $post_type == QUEST_POST_TYPE_INFOGRAPHIC ) return 'news';
    return (quest_is_resources_post_type($post_type) ? 'resources' : $default);
}

function quest_custom_archive($args = '')
{
    global $wpdb, $wp_locale;

    $defaults = array(
        'limit' => '',
        'format' => 'html', 'before' => '',
        'after' => '', 'show_post_count' => false,
        'echo' => 1
    );

    $r = wp_parse_args($args, $defaults);
    extract($r, EXTR_SKIP);

    if ('' != $limit) {
        $limit = absint($limit);
        $limit = ' LIMIT ' . $limit;
    }
    //filters
    $where = apply_filters('customarchives_where', "WHERE post_status = 'publish'", $r);
    $join = apply_filters('customarchives_join', "", $r);
    $select_text = '- Select a month -';
    if (!empty($archive)) {
        $archive_params = explode('-', $archive);
        if (intval($archive_params[0]) && intval($archive_params[1])) {
            $select_text = $wp_locale->get_month(intval($archive_params[1])) . ', ' . $archive_params[0];
        }
    }
    if (!empty($resources)) {
        $where .= " AND {$wpdb->posts}.post_type IN ('" . implode("','", $resources) . "')";
    }
    if (!empty($services)) {
        $join .= "
            INNER JOIN
              {$wpdb->term_relationships} ON {$wpdb->posts}.ID = {$wpdb->term_relationships}.object_id
            INNER JOIN
              {$wpdb->term_taxonomy} ON {$wpdb->term_taxonomy}.term_taxonomy_id = {$wpdb->term_relationships}.term_taxonomy_id
            INNER JOIN
              {$wpdb->terms} ON {$wpdb->terms}.term_id = {$wpdb->term_taxonomy}.term_id ";
        $where .= " AND {$wpdb->terms}.slug IN ('" . implode("','", $services) . "')";
    }
    $output = '<h5>Archive</h5>
        <div class="archive-drop-down drop-down">
            <div class="selected">
                <a href="javascript:void(0)"><span>' . $select_text . '</span></a>
            </div>
        <div class="options">
            <ul>';
    $query = "SELECT YEAR(post_date) AS `year`, MONTH(post_date) AS `month`, count(ID) as posts FROM $wpdb->posts $join $where GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date DESC $limit";
    $key = md5($query);
    $cache = wp_cache_get('quest_custom_archive', 'quest');
    if (!isset($cache[$key])) {
        $arcresults = $wpdb->get_results($query);
        $cache[$key] = $arcresults;
        wp_cache_set('quest_custom_archive', $cache, 'quest');
    } else {
        $arcresults = $cache[$key];
    }
    if ($arcresults) {
        if (!empty($archive) && $archive != 'none') {
            $output .= '<li><label><input type="radio" name="archive" class="hidden" value="none">- Select a month -</label></li>';
        }
        foreach ((array)$arcresults as $arcresult) {
            $value = $arcresult->year . '-' . $arcresult->month;
            /* translators: 1: month name, 2: 4-digit year */
            $text = sprintf(__('%s, %d'), $wp_locale->get_month($arcresult->month), $arcresult->year);
            $output .= '<li><label><input type="radio" name="archive" class="hidden" value="' . $value . '" ' . ($archive == $value ? 'checked' : '') . '>' . $text . '</label></li>';
        }
    }

    $output .= '</ul></div></div>';

    if ($echo)
        echo $output;
    else
        return $output;
}

function rel2abs($rel, $base)
{
    /* return if already absolute URL */
    if (parse_url($rel, PHP_URL_SCHEME) != '') {
        return $rel;
    }

    /* queries and anchors */
    if ($rel[0] == '#' || $rel[0] == '?') {
        return $base . $rel;
    }

    /* parse base URL and convert to local variables:
       $scheme, $host, $path */
    extract(parse_url($base));

    /* remove non-directory element from path */
    $path = preg_replace('#/[^/]*$#', '', $path);

    /* destroy path if relative url points to root */
    if ($rel[0] == '/') {
        $path = '';
    }

    /* dirty absolute URL */
    $abs = "$host$path/$rel";

    /* replace '//' or '/./' or '/foo/../' with '/' */
    $re = array('#(/\.?/)#', '#/(?!\.\.)[^/]+/\.\./#');
    for ($n = 1; $n > 0; $abs = preg_replace($re, '/', $abs, -1, $n)) {
    }

    /* absolute URL is ready! */

    return $scheme . '://' . $abs;
}

function sort_options()
{
    $check_sort_by_date = false;
    $sort_by_date = array(QUEST_POST_TYPE_RESOURCE_ASSESSMENT, QUEST_POST_TYPE_RESOURCE_SOLUTION_BRIEF, QUEST_POST_TYPE_RESOURCE_VIDEO);
    if (!empty($_GET['resources'])) {
        $post_types = $_GET['resources'];
        foreach ($post_types AS $post_type) {
            if (in_array($post_type, $sort_by_date)) {
                $check_sort_by_date = true;
            }
        }
    }
    if (!empty($_GET['resources']) && empty(array_diff($_GET['resources'], $sort_by_date))) {
        $result = array('title-asc' => 'A-Z', 'title-desc' => 'Z-A');
    } else {
        if ($check_sort_by_date) {
            $result = array('date-desc' => 'Newest-Oldest', 'date-asc' => 'Oldest-Newest', 'title-asc' => 'A-Z', 'title-desc' => 'Z-A');
        } else {
            $result = array('date-desc' => 'Newest-Oldest', 'date-asc' => 'Oldest-Newest');
        }
    }
    return $result;
}

remove_filter('sanitize_title', 'sanitize_title_with_dashes');
add_filter('sanitize_title', 'wpse5029_sanitize_title_with_dashes');
function wpse5029_sanitize_title_with_dashes($title)
{
    $title = strip_tags($title);
    // Preserve escaped octets.
    $title = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '---$1---', $title);
    // Remove percent signs that are not part of an octet.
    $title = str_replace('%', '', $title);
    // Restore octets.
    $title = preg_replace('|---([a-fA-F0-9][a-fA-F0-9])---|', '%$1', $title);

    $title = remove_accents($title);
    if (seems_utf8($title)) {
        //if (function_exists('mb_strtolower')) {
        //    $title = mb_strtolower($title, 'UTF-8');
        //}
        $title = utf8_uri_encode($title, 200);
    }

    //$title = strtolower($title);
    $title = preg_replace('/&.+?;/', '', $title); // kill entities
    $title = str_replace('.', '-', $title);
    // Keep upper-case chars too!
    $title = preg_replace('/[^%a-zA-Z0-9 _-]/', '', $title);
    $title = preg_replace('/\s+/', '-', $title);
    $title = preg_replace('|-+|', '-', $title);
    $title = trim($title, '-');

    return $title;
}

if (!function_exists('quest_blog_get_author_name')) {
	function quest_blog_get_author_name($author) {
		$author_name = !empty($author->data->display_name) ? $author->data->display_name : '';
		if (!empty($author->data->ID)) {
			$author_title = get_user_meta($author->data->ID, 'user_title', true);
			$author_name .= !empty($author_title) ? ', ' . $author_title : '';
		}
		return $author_name;
	}
}

if (!function_exists('quest_get_CTA_button')) {
	function quest_get_CTA_button($post) {
		$btnName = 'Contact Us';
		$btnLink = get_post_meta($post->ID, 'contact_us_blog_link');

		if (empty($btnLink)) {
			$btnLink = 'https://www.questsys.com/contact/?utm_source=Blog&utm_medium=Footer&utm_campaign=';
			$btnLink .= rawurlencode(strip_tags($post->post_title));
        } else {
			$btnLink = reset($btnLink);
        }

		if (empty($btnLink)) {
		    return false;
		} else {
		  return [
              'name' => $btnName,
              'link' => $btnLink
          ];
        }
	}
}

if (!function_exists('quest_get_list_blog_page_constants')) {
	function quest_get_list_blog_page_constants() {
		return [QUEST_POST_TYPE_CEO_BLOG, QUEST_POST_TYPE_PARTNER_BLOG, QUEST_POST_TYPE_SECURITY_BLOG, QUEST_POST_TYPE_GOVERNMENT_BLOG];
	}
}
