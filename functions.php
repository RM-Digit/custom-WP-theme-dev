<?php

/**
 * Understrap functions and definitions
 *
 * @package understrap
 */

/**
 * Initialize theme default settings
 */
require get_template_directory() . '/inc/constants.php';
require get_template_directory() . '/inc/theme-settings.php';

/**
 * Theme setup and custom theme supports.
 */
require get_template_directory() . '/inc/setup.php';

/**
 * Register widget area.
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Enqueue scripts and styles.
 */
require get_template_directory() . '/inc/enqueue.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom pagination for this theme.
 */
require get_template_directory() . '/inc/pagination.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

require get_template_directory() . '/inc/quest-limit-login-attempts.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Custom Comments file.
 */
require get_template_directory() . '/inc/custom-comments.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load custom WordPress nav walker.
 */
require get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
require get_template_directory() . '/inc/class-wp-quest-navwalker.php';

/**
 * Load WooCommerce functions.
 */
require get_template_directory() . '/inc/woocommerce.php';

/**
 * Load Editor functions.
 */
require get_template_directory() . '/inc/editor.php';

/**
 ** Load quest widget section.
 */

$widget_custom_path = get_template_directory() . '/inc/widgets/';

require get_template_directory() . '/inc/widgets/base-custom-widget/class-base-custom-widget.php';

require get_template_directory() . '/inc/widgets/subsection-content/subsection-content-widget.php';
require $widget_custom_path . '/quest-introduction-photo/quest-introduction-photo.php';
require $widget_custom_path . '/quest-list-posts/quest-list-posts.php';
require $widget_custom_path . '/quest-assessment-workshop/quest-assessment-workshop.php';
require $widget_custom_path . '/testimonial-widget/quest-customer-stories-widget.php';

require $widget_custom_path . '/contact-form/contact-form-widget.php';
require $widget_custom_path . '/quest-content/quest-content.php';
require $widget_custom_path . '/quest-further-information/quest-further-information-widget.php';

require $widget_custom_path . 'two-subsection-content/two-subsection-content.php';

require $widget_custom_path . 'quest-vendor-partner/quest-vendor-partner-widget.php';

require $widget_custom_path . 'quest-technology-partner/quest-technology-partner-widget.php';

require $widget_custom_path . 'quest-news-coverage/quest-news-coverage-widget.php';

require $widget_custom_path . 'quest-partner-login/quest-partner-login-widget.php';

require $widget_custom_path . 'sub-content/sub-content.php';

require $widget_custom_path . 'quest-veeam-content/quest-veeam-content.php';

require $widget_custom_path . 'quest-veeam-content-item/quest-veeam-content-item.php';

require $widget_custom_path . 'quest-thank-you/quest-thank-you-widget.php';

require $widget_custom_path . 'quest-salesfusion-form/quest-salesfusion-form.php';

require $widget_custom_path . 'quest-salesfusion-form-builder/quest-salesfusion-form-builder.php';

require $widget_custom_path . 'quest-resource-block/quest-resource-block-widget.php';

require $widget_custom_path . 'quest-playbook-widget/quest-playbook-widget.php';

/**
 * Load taxonomy.
 */
if (!taxonomy_exists(QUEST_TAXONOMY_SERVICE)) {
    require get_template_directory() . '/inc/create-taxonomy-service.php';
}
/**
 * Load custom post type.
 */

require get_template_directory() . '/inc/post_types/create_post_type_resources.php';

require get_template_directory() . '/inc/post_types/create_post_type_vendors.php';

require get_template_directory() . '/inc/post_types/create_post_type_thank_you.php';

require get_template_directory() . '/inc/post_types/create_post_type_events.php';


/**
 * Load custom search
 */

require get_template_directory() . '/inc/custom-search.php';
/*
 * Load Meta box.
*/

require get_template_directory() . '/inc/custom_field/create_salesfusion_meta_box.php';
require get_template_directory() . '/inc/custom_field/quest_metabox_expiration_date.php';
require get_template_directory() . '/inc/custom_field/quest_metabox_customer_portrait.php';
require get_template_directory() . '/inc/custom_field/add_user_title_to_profile.php';
require get_template_directory() . '/inc/class-custom-meta-boxes.php';
/**
 * Load custom filed Font Icon in taxonomy service
 */
require get_template_directory() . '/inc/shortcode/sub-content-shortcode.php';
require get_template_directory() . '/inc/shortcode/form-sign-up.php';
require get_template_directory() . '/inc/shortcode/quest-list-post.php';
require get_template_directory() . '/inc/shortcode/quest_subscribe_newsletter.php';
require get_template_directory() . '/inc/shortcode/quest-media-shortcode.php';
require get_template_directory() . '/inc/shortcode/quest-link-shortcode.php';
require get_template_directory() . '/inc/shortcode/quest-related-services-shortcode.php';

require get_template_directory() . '/inc/shortcode/quest-join-our-team.php';
require get_template_directory() . '/inc/shortcode/modal-button.php';

require get_template_directory() . '/inc/customizing-tinymce-editor.php';

require get_template_directory() . '/inc/shortcode/quest-salesfusion-form.php';
/* End function file */
$Quest_Custom_Meta_Boxes = new Quest_Custom_Meta_Boxes();

require get_template_directory() . '/inc/page-builder/custom-widget-field.php';

require get_template_directory() . '/inc/security-solution.php';

require get_template_directory() . '/inc/salesfusion-tracking-code.php';

if (!(is_admin())) {
    function defer_parsing_of_js($url)
    {
        if (false === strpos($url, '.js')) {
            return $url;
        }

        if (strpos($url, 'jquery.js')) {
            return $url;
        }
        if (strpos($url, 'jquery')) {
            return $url;
        }
       
        return "$url' defer data-temp='";
    }

    add_filter('clean_url', 'defer_parsing_of_js', 11, 1);
}

// rewrite resources URL
add_action('parse_query', 'quest_resources_parse_query');

function quest_resources_parse_query($wp_query)
{
    if (($urlParams = get_query_var('url_params', 'none')) != 'none') {
        $filter_parts = explode('-res-', $urlParams);

        if (sizeof($filter_parts) == 2) {
            $param_name = $filter_parts[0];
            $_GET[$param_name] = array($filter_parts[1]);
        }
    }
}

function quest_resources_query_var($vars)
{
    $vars[] = 'url_params';
    return $vars;
}

add_filter('query_vars', 'quest_resources_query_var');

function quest_resources_rewrite_rule()
{
    $current_uri = $_SERVER['REQUEST_URI'];

    add_rewrite_rule(
        '^resources/([^/]+)/?$',
        'index.php?pagename=resources&url_params=$matches[1]',
        'top'
    );

    add_rewrite_rule(
        '^resources/([^/]+)/page/([^/]+)?$',
        'index.php?pagename=resources&url_params=$matches[1]&paged=$matches[2]',
        'top'
    );

    add_rewrite_rule(
        '^blog/([^/]+)/?$',
        'index.php?pagename=blog&url_params=$matches[1]',
        'top'
    );

    add_rewrite_rule(
        '^blog/([^/]+)/page/([^/]+)?$',
        'index.php?pagename=blog&url_params=$matches[1]&paged=$matches[2]',
        'top'
    );

    add_rewrite_rule(
        '^library/([^/]+)/?$',
        'index.php?pagename=library&url_params=$matches[1]',
        'top'
    );

    add_rewrite_rule(
        '^library/([^/]+)/page/([^/]+)?$',
        'index.php?pagename=library&url_params=$matches[1]&paged=$matches[2]',
        'top'
    );
}

add_action('init', 'quest_resources_rewrite_rule');

function transformPageLink($link)
{
    if (strpos($link, '?paged=') === false)
        return $link;

    $url_start_pos = strpos($link, 'href="') + 6;
    $url_end_pos = strpos($link, '"', $url_start_pos);
    $url = substr($link, $url_start_pos, $url_end_pos - $url_start_pos);

    $url = str_replace('?paged=', 'page/', $url);

    if (($amp_index = strpos($url, '&')) !== false) {
        $url = substr_replace($url, '/?', $amp_index, 1);
        $url = str_replace('?#038;', '?', $url);
    } else {
        $url = $url . '/';
    }

    return substr($link, 0, $url_start_pos) . $url . substr($link, $url_end_pos);
}

// Rewrite pagination
function quest_pagination($pages = null, $args = [], $class = 'pagination')
{

    if ($pages == null) {
        if ($GLOBALS['wp_query']->max_num_pages <= 1) return;
        $pages = $GLOBALS['wp_query']->max_num_pages;
    }

    $args = wp_parse_args($args, [
        'total'              => $pages,
        'format'             => '?paged=%#%',
        'mid_size'           => 3,
        'prev_next'          => true,
        'prev_text'          => __('&laquo;', 'understrap'),
        'next_text'          => __('&raquo;', 'understrap'),
        'screen_reader_text' => __('Posts navigation', 'understrap'),
        'type'               => 'array',
        'current'            => max(1, get_query_var('paged')),
    ]);

    $links = paginate_links($args);
    if (empty($links)) return;

?>

    <nav aria-label="<?php echo $args['screen_reader_text']; ?>">

        <ul class="pagination">

            <?php

            foreach ($links as $key => $link) {
            ?>

                <li class="page-item <?php echo strpos($link, 'current') ? 'active' : '' ?>">

                    <?php echo transformPageLink(str_replace('page-numbers', 'page-link', $link)); ?>
                    <?php //echo str_replace( 'page-numbers', 'page-link', $link ); 
                    ?>

                </li>

            <?php } ?>

        </ul>

    </nav>

<?php
}

function quest_resource_filters($data, $filters, $type = "post")
{
    echo '<div class="page-title">';
    if ($type == "post") {
        echo esc_html__('Filter Types:', 'quest');
    }
    foreach ($filters as $type => $filter) {
        foreach ($filter as $value) {
            if (isset($data[$type][$value]))
                echo '<p>' . $data[$type][$value] . '<span class="uncheck-item" data-type="' . $value . '">&times;</span></p>';
        }
    }
    echo '</div>';
}


function quest_resource_filter($all_resource, $filters, $type = "post")
{
    echo '<h1 class="page-title">';
    if ($type == "post")
        echo esc_html__('Filter Types:', 'quest');
    foreach ($filters as $value) {
        if (isset($all_resource[$value]))
            echo '<p>' . $all_resource[$value] . '<span class="uncheck-item" data-type="' . $value . '">x</span></p>';
    }
    echo '</h1>';
}

/**
 * Disable the emoji's
 */
function disable_emojis()
{
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

    // Remove from TinyMCE
    add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
}
add_action('init', 'disable_emojis');

/**
 * Filter out the tinymce emoji plugin.
 */
function disable_emojis_tinymce($plugins)
{
    if (is_array($plugins)) {
        return array_diff($plugins, array('wpemoji'));
    } else {
        return array();
    }
}

//de-register styles to move to the foolter
add_action('wp_enqueue_scripts', 'quest_theme_deregister_styles');

function quest_theme_deregister_styles()
{

    wp_deregister_style('wp-block-library');
    wp_deregister_style('siteorigin-panels-front');
    wp_deregister_style('understrap-styles');
    wp_deregister_style('quest-slick-slider-styles-1');
    wp_deregister_style('quest-slick-slider-styles-2');

    // enqueue lazyloader
    wp_enqueue_script('quest-lazysizes', get_template_directory_uri() . '/js/lazysizes.min.js', array(), '1.0', true);
}

// add the styles to the footer

function quest_add_footer_styles()
{
    $theme_version = '1.1';

    $css_version = $theme_version . '.' . filemtime(get_template_directory() . '/css/theme.min.css');

    wp_enqueue_style('wp-block-library', '/wp-includes/css/dist/block-library/style.min.css');
    wp_enqueue_style('siteorigin-panels-front', '/wp-content/plugins/siteorigin-panels/css/front-flex.min.css');


    wp_enqueue_style('understrap-styles', get_stylesheet_directory_uri() . '/css/theme.min.css', array(), $css_version);
    wp_enqueue_style('quest-slick-slider-styles-1', get_stylesheet_directory_uri() . '/js/slick/slick.min.css');
    wp_enqueue_style('quest-slick-slider-styles-2', get_stylesheet_directory_uri() . '/js/slick/slick-theme.min.css');
};

add_action('get_footer', 'quest_add_footer_styles');

// library sitemap
add_action('init', 'quest_library_sitemap');

function quest_library_sitemap()
{

    if (preg_match('#(/sitemap-library.xml)$#i', $_SERVER['REQUEST_URI'])) {
        $blog_charset = get_option('blog_charset');
        header("Content-Type: text/xml; charset=$blog_charset", true);
        $server_name = $_SERVER['HTTP_HOST'];

        echo '<?xml version="1.0" encoding="UTF-8"?>
        <urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.google.com/schemas/sitemap-image/1.1 http://www.google.com/schemas/sitemap-image/1.1/sitemap-image.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        $home_url = get_home_url();

        echo '<url><loc>' . $home_url . '/library/</loc>' ./*<lastmod>2019-07-09T09:56:22+00:00</lastmod>*/ '</url>';

        echo '<url><loc>' . $home_url . '/library/resources-res-solution-brief/</loc>' ./*<lastmod>2019-07-09T09:56:22+00:00</lastmod>*/ '</url>';
        echo '<url><loc>' . $home_url . '/library/resources-res-video/</loc>' ./*<lastmod>2019-07-09T09:56:22+00:00</lastmod>*/ '</url>';
        echo '<url><loc>' . $home_url . '/library/resources-res-infographic/</loc>' ./*<lastmod>2019-07-09T09:56:22+00:00</lastmod>*/ '</url>';

        echo '</urlset>';
        exit();
    }
}

// blogs sitemap
add_action('init', 'quest_blog_filters_sitemap');

function quest_blog_filters_sitemap()
{

    if (preg_match('#(/sitemap-blog-filters.xml)$#i', $_SERVER['REQUEST_URI'])) {
        $blog_charset = get_option('blog_charset');
        header("Content-Type: text/xml; charset=$blog_charset", true);
        $server_name = $_SERVER['HTTP_HOST'];

        echo '<?xml version="1.0" encoding="UTF-8"?>
        <urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.google.com/schemas/sitemap-image/1.1 http://www.google.com/schemas/sitemap-image/1.1/sitemap-image.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        $home_url = get_home_url();
        $quest_blog_post_types = quest_blog_post_types();

        foreach ($quest_blog_post_types as $blog_post_type) {
            if ($blog_post_type == 'gov-blog') {
                continue;
            }
            //TODO: lastmod if any importance?
            echo '<url><loc>' . $home_url . '/blog/' . $blog_post_type . '/</loc>' ./*<lastmod>2019-07-09T09:56:22+00:00</lastmod>*/ '</url>';
        }

        echo '</urlset>';
        exit();
    }
}

// resources sitemap
add_action('init', 'quest_resources_sitemap');

function quest_resources_sitemap()
{

    if (preg_match('#(/sitemap-resources.xml)$#i', $_SERVER['REQUEST_URI'])) {
        $blog_charset = get_option('blog_charset');
        header("Content-Type: text/xml; charset=$blog_charset", true);
        $server_name = $_SERVER['HTTP_HOST'];

        echo '<?xml version="1.0" encoding="UTF-8"?>
        <urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.google.com/schemas/sitemap-image/1.1 http://www.google.com/schemas/sitemap-image/1.1/sitemap-image.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        $home_url = get_home_url();
        $services = get_terms(QUEST_TAXONOMY_SERVICE, array('parent' => 0, 'hide_empty' => false, 'orderby' => 'id', 'order' => 'ASC'));

        foreach ($services as $parent) {
            $child = get_terms(QUEST_TAXONOMY_SERVICE, array('parent' => $parent->term_id, 'hide_empty' => false, 'orderby' => 'id', 'order' => 'ASC'));

            $ordered_term = [];
            foreach ($child as $item) {
                $ordered_term_index = get_term_meta($item->term_id, 'ordering', true);
                $ordered_term_index = empty($ordered_term_index) ? "999_{$item->term_id}"  : "{$ordered_term_index}_{$item->term_id}";
                $ordered_term[$ordered_term_index] = $item;
            }

            foreach ($ordered_term as $item) {
                //TODO: lastmod if any importance?
                echo '<url><loc>' . $home_url . '/resources/services-res-' . $item->slug . '/</loc>' ./*<lastmod>2019-07-09T09:56:22+00:00</lastmod>*/ '</url>';
            }

            $resources = quest_get_post_types('resources', 'array');

            foreach ($resources as $key => $value) {
                /*
                if(!in_array($key,[QUEST_POST_TYPE_PARTNER_BLOG,QUEST_POST_TYPE_CEO_BLOG,QUEST_POST_TYPE_GOVERNMENT_BLOG, QUEST_POST_TYPE_SECURITY_BLOG])){ 
                    continue;
                }
                */

                if ($key == 'gov-blog')
                    continue;

                //TODO: lastmod if any importance?
                echo '<url><loc>' . $home_url . '/resources/resources-res-' . $key . '/</loc>' ./*<lastmod>2019-07-09T09:56:22+00:00</lastmod>*/ '</url>';
            }
        }

        echo '</urlset>';
        exit();
    }
}

// adding it to Yoast
add_filter('wpseo_sitemap_index', 'add_quest_resources_items');
function add_quest_resources_items()
{
    $sitemap_custom_items = '
    <sitemap>
    <loc>' . get_home_url() . '/sitemap-resources.xml</loc>
    </sitemap>
    <sitemap>
    <loc>' . get_home_url() . '/sitemap-blog-filters.xml</loc>
    </sitemap>';
    //    <sitemap>
    //    <loc>'.get_home_url().'/sitemap-library.xml</loc>
    //    </sitemap>'
    //    ;

    return $sitemap_custom_items;
}

// Register Header Top Navigation
function register_header_top_menu()
{
    register_nav_menu('header-top-menu', __('Header Top Menu'));
}

add_action('init', 'register_header_top_menu');

// resizing images
function resizeImageByURL($url, $size, $crop = true)
{

    if (strlen($url) > 0) {

        $ind = strpos($url, '/wp-content');

        if ($ind !== false)
            $url = substr($url, $ind);

        $size_arr = explode('x', $size);

        if (count($size_arr) < 2)
            return false;

        $im_absolute_path = get_home_path() . substr($url, 1);

        if (!file_exists($im_absolute_path)) {
            return $url;
        }

        $im_absolute_path_info = pathinfo($im_absolute_path);

        $im_target_absolute_path = $im_absolute_path_info['dirname'] . '/' . $size_arr[0] . '-' . $size_arr[1] . '-' . md5($im_absolute_path_info['filename']) . '.' . $im_absolute_path_info['extension'];
        $im_target_url = str_replace(get_home_path(), '/', $im_target_absolute_path);

        if (file_exists($im_target_absolute_path)) {
            return $im_target_url;
        }

        $editor = wp_get_image_editor($im_absolute_path, array());

        if (is_wp_error($editor)) {
            throw new Exception("Could not get image editor");
        }

        $curr_size_arr = $editor->get_size();

        if ($curr_size_arr['width'] < $size_arr[0])
            return null;

        $result = $editor->resize($size_arr[0], $size_arr[1], $crop);

        if (is_wp_error($result)) {
            throw new Exception("Could not resize image");
        } else {
            $editor->save($im_target_absolute_path);
            return $im_target_url;
        }
    }

    return $url;
}

// custom post status
function quest_custom_post_status()
{
    register_post_status('archived', array(
        'label'                     => _x('Archived', QUEST_POST_TYPE_RESOURCE_NEWSLETTER),
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop('Archived <span class="count">(%s)</span>', 'Archived <span class="count">(%s)</span>'),
    ));
}
add_action('init', 'quest_custom_post_status');


add_action('admin_footer-post.php', 'quest_append_post_status_list');
function quest_append_post_status_list()
{
    global $post;
    $complete = '';
    $label = '';
    if ($post->post_type == QUEST_POST_TYPE_RESOURCE_NEWSLETTER) {
        if ($post->post_status == 'archived') {
            $complete = ' selected="selected"';
            $label = '<span id="post-status-display"> Archived</span>';
        }
        echo '
        <script>
        jQuery(document).ready(function($){
        $("select#post_status").append("<option value=\"archived\" ' . $complete . '>Archived</option>");
        $(".misc-pub-section label").append("' . $label . '");
        });
        </script>
        ';
    }
}

add_action('admin_footer-edit.php', 'quest_status_into_inline_edit');

function quest_status_into_inline_edit()
{
    echo "<script>
    jQuery(document).ready( function() {
        jQuery( 'select[name=\"_status\"]' ).append( '<option value=\"archived\">Archived</option>' );
    });
    </script>";
}

//override the footer for newsletters

function quest_entry_footer_newsletter($title_post_type = true)
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
            if ($term->slug != 'commercial')
                printf('<span class="service-links"><u>' . esc_html__('%1$s', 'quest') . '</u></span>', '<a href="' . quest_resource_url(['services' => [$term->slug]]) . '">' . $term->name . '</a>'); // WPCS: XSS OKe
        }

        echo '</div>';
    }
}

// override resource tile list block footer
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
            // exclude government
            if ($term->slug == 'government') {
                continue;
            }

            printf('<span class="service-links"><u>' . esc_html__('%1$s', 'quest') . '</u></span>', '<a href="' . quest_resource_url(['services' => [$term->slug]]) . '">' . $term->name . '</a>'); // WPCS: XSS OKe
        }
        echo '</div>';
    }
}

function get_cleaned_paged_url($url)
{
    // echo 'VISH: ';
    $parsed_url = parse_url($url);
    parse_str($parsed_url['query'], $params);
    // print_r( $parsed_url );
    // print_r( $params );
    if (isset($params['paged'])) {
        return strtok($url, '?') . 'paged/' . $params['paged'];
    }
    return $url;
}

//add_filter( 'the_seo_framework_rel_canonical_output', '__return_empty_string', 47);
function create_canonical_link_custom($request = array(), $args = array())
{

    $arr_canonical_links = array(
        'previous' => '',
        'current' => '',
        'next' => ''
    );

    if (!empty($request)) {

        $args = wp_parse_args($args, [
            'total'              => $request->max_num_pages,
            'format'             => '?paged=%#%',
            'mid_size'           => 3,
            'prev_next'          => true,
            'prev_text'          => __('<<<', 'understrap'),
            'next_text'          => __('>>>', 'understrap'),
            'screen_reader_text' => __('Posts navigation', 'understrap'),
            'type'               => 'array',
            'current'            => max(1, get_query_var('paged')),
        ]);

        $links = paginate_links($args);

        foreach ($links as $link_key => $link) {
            if (strpos($link, 'prev page-numbers')) {
                preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $link, $match);
                $prev_link = $match[0][0];
                $arr_canonical_links['previous'] = '<link rel="prev" href="' . get_cleaned_paged_url($prev_link) . '" />';
            }
            if (strpos($link, 'next page-numbers')) {
                preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $link, $match);
                $next_link = $match[0][0];
                $arr_canonical_links['next'] = '<link rel="next" href="' . get_cleaned_paged_url($next_link) . '" />';
            }
        };
    }
    $curr_url = ($_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://') . $_SERVER["SERVER_NAME"] . strtok($_SERVER["REQUEST_URI"], '?');
    $arr_canonical_links['current'] = '<link rel="canonical" href="' . $curr_url . '" />';

    foreach ($arr_canonical_links as $clink => $clink_html) {
        if (!empty($clink_html)) {
            echo $clink_html . '
            ';
        }
    }
}
add_action('wp_head', 'create_canonical_link_custom');

// Prints the template in use in the header for debug purposes
// Should be commented out in all live sites
function quest_show_template()
{
    global $template;
    $header_template = '<!-- Using ' . $template . ' FINDME -->';
    print_r($header_template);
}
//add_action('wp_footer', 'quest_show_template');

// Rewriting pagination for archives fix
// & adding a body class fix to the new archives to fix the header problem
add_filter('body_class', 'quest_archive_body_fix');
function quest_archive_body_fix($classes)
{

    if (is_page_template('page-templates/quest-archive.php')) {

        $classes[] = 'page-template-quest-blog';
    }

    return $classes;
}

// Fixing templating issue with press releases, infographics, & products
// by adding a body class fix to fix the header problem
add_filter('body_class', 'quest_resource_body_fix');
function quest_resource_body_fix($classes)
{

    if (in_array('single-product',$classes) || in_array('single-press-release', $classes) || in_array('single-infographic', $classes)) {

        $classes[] = 'single-partner-blog';
    }

    return $classes;
}

function quest_custom_pagination($pages = null, $c_p = 1, $args = [], $class = 'pagination')
{
    //echo 'testing pages:'.$pages.'current page:'.$c_p;

    if ($pages == null) {
        if ($GLOBALS['wp_query']->max_num_pages <= 1) return;
        $pages = $GLOBALS['wp_query']->max_num_pages;
    }

    $args = wp_parse_args($args, [
        'total'              => $pages,
        'format'             => '?paged=%#%',
        'mid_size'           => 3,
        'prev_next'          => true,
        'prev_text'          => __('&laquo;', 'understrap'),
        'next_text'          => __('&raquo;', 'understrap'),
        'screen_reader_text' => __('Posts navigation', 'understrap'),
        'type'               => 'array',
        'current'            => max(1, get_query_var('paged')),
    ]);

    $links = paginate_links($args);
    //print_r($links);
    if (empty($links)) return;

    // Construct filter
    $allowed_links = [
        'dots',
        'current',
        'prev',
        'next',
        sprintf('paged=%d', $c_p - 2),
        sprintf('paged=%d', $c_p - 1),
        sprintf('paged=%d', $c_p + 1),
        sprintf('paged=%d', $c_p + 2),
        sprintf('page/%d/"', $c_p - 2),
        sprintf('page/%d/"', $c_p - 1),
        sprintf('page/%d/"', $c_p + 1),
        sprintf('page/%d/"', $c_p + 2)
    ];

    if ($c_p === 1) {
        array_push($allowed_links, sprintf('paged=%d"', $c_p + 3));
    } else if ($c_p === 2 || $c_p === 3) {
        array_push($allowed_links, '>1</a>');
    }

    $has_final_page = false;
    $dots_replace = false;
    $dots_left = false;
    // fix the dots
    if (strpos($links[1], 'dots') !== false || strpos($links[2], 'dots') !== false) {
        $dots_left = true;
    }

    if ($c_p == 1) {
        if ($pages > $c_p + 3) {
            $has_final_page = true;
            $dots_replace = $c_p + 4;
        }
    } else {
        if ($pages > $c_p + 2) {
            // Add dots if lacking right dots
            $links_length = count($links);
            $add_dots = true;
            for ($x = 3; $x <= $links_length - 1; $x++) {
                if (strpos($links[$x], 'dots') !== false) {
                    $add_dots = false;
                }
            }
            if($add_dots){
                array_splice($links, $links_length - 2, 0, '<span class="page-numbers dots">…</span>');
            }
            $has_final_page = true;
            $dots_replace = $c_p + 3;
        }
    }

?>

    <nav aria-label="<?php echo $args['screen_reader_text']; ?>">
        <?php
            $prev_dots = false;
        ?>
        <ul class="pagination">

            <?php
            foreach ($links as $key => $link) {
                $check_link_type = false;

                if ($prev_dots && $has_final_page) {
                    $link = str_replace($pages, $dots_replace, $link) ?>
                     <li class="page-item">
                        <?php echo transformPageLink(str_replace('page-numbers', 'page-link', $link)); ?>
                    </li>
                <?php
                    $prev_dots = false;
                }

                foreach ($allowed_links as $allowed_link) {
                    if ( strpos($link, $allowed_link) !== false ) {
                        $check_link_type = true;
                    }
                    if ( strpos($link, 'dots') !== false ) {
                        if( $dots_left ) {
                            $check_link_type = false;
                            $dots_left = false;
                        } else {
                            $prev_dots = true;
                        }
                    }
                }

                if ( !$check_link_type ) {
                    continue;
                }
            ?>

                <li class="page-item <?php echo strpos($link, 'current') ? 'active' : '' ?>">

                    <?php echo transformPageLink(str_replace('page-numbers', 'page-link', $link)); ?>

                </li>

            <?php } ?>

        </ul>

    </nav>

<?php
}