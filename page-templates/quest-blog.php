<?php

/**
 * Template Name: Quest Blog
 *
 * Template Post Type: page
 *
 * This template can be used to override the default template and sidebar setup
 *
 * @package quest
 */

function blog_search_filter($where, $wp_query)
{
    global $wpdb;

    if ($search_term = $wp_query->get('blog_search')) {
        //$where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql( like_escape( $search_term ) ) . '%\'';
        $where .= ' AND (' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql(like_escape($search_term)) . '%\'' .
            ' OR ' . $wpdb->posts . '.post_content LIKE \'%' . esc_sql(like_escape($search_term)) . '%\' )';
    }

    return $where;
}


$blog_filter = get_query_var('url_params');
/* Show list post */
$action_url = esc_url(get_permalink());
$resources = quest_get_post_types('resources', 'array');
$blog_title = get_the_title();
$search_query = isset($_GET['search_query']) ? trim(sanitize_text_field($_GET['search_query'])) : '';

if (!empty($blog_filter)) {
    $blog_title = $resources[$blog_filter];
}

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args_resource_query['paged'] = $paged;

// Do not include posts from before 2019
$today_check = getdate();

$args_resource_query['date_query'] = array(
    array(
        'after' => $today_check['month'] . ' 1st, ' . ($today_check['year'] - 2),
        'inclusive' => true,
    )
);

$quest_blog_post_types = quest_blog_post_types();

//removing the goverment blog
foreach ($quest_blog_post_types as $key => $value) {
    if ($value == 'gov-blog') {
        unset($quest_blog_post_types[$key]);
        break;
    }
}

$args_resource_query['post_type'] = (!empty($blog_filter)) ? $blog_filter : $quest_blog_post_types;

$args_featured_query = $args_resource_query;
$args_featured_query['meta_query'] = array(
    'relation' => 'AND',
    array(
        'key' => 'is-featured',
        'value' => '1',
        'compare' => 'LIKE'
    ),
    array(
        'key' => '_thumbnail_id',
        'compare' => 'EXISTS',
    )
);


$excluded = get_option('sep_exclude_resource');
$args_resource_query['post__not_in'] = $excluded;

if (strlen($search_query) > 0) {
    $args_resource_query['blog_search'] = $search_query;
    add_filter('posts_where', 'blog_search_filter', 10, 2);
}


$resource_query = new WP_Query($args_resource_query);

if (strlen($search_query) > 0) {
    remove_filter('posts_where', 'blog_search_filter', 10);
}

get_header();

?>
<div class="wrapper" id="quest-blog-wrapper">

    <div class="custom-header-fulid" id='gradient-bg'>
        <div class="bounder">
            <div class="container">
                <h1 class="search-header-title">
                    <?php echo $blog_title; ?>
                </h1>
            </div>
        </div>
    </div>

    <div class="blog-filter-wrapper">
        <div class="blog-filter-caption">Filter by category:</div>
        <div class="blog-filter-button-wrapper">
            <a class="blog-filter-button<?php if (!$blog_filter) echo ' active'; ?>" href="<?php echo $action_url ?>">View All</a>
            <?php

            foreach ($resources as $key => $value) {
                if (!in_array($key, $quest_blog_post_types) || $key == 'gov-blog')
                    continue;

                $active_class = ($blog_filter == $key) ? ' active' : '';
            ?>
                <a class="blog-filter-button<?php echo $active_class; ?>" href="<?php echo $action_url . $key; ?>"><?php echo str_replace(' Blogs', '', $value); ?></a>
            <?php
            }
            ?>
        </div>
        <div class="blog-filter-button-wrapper">
            <?php echo do_shortcode('[wd_asp id=2]'); ?>
        </div>
    </div>

    <div class="container" id="content" tabindex="-1">
        <main class="site-main" id="main">
            <div class="blog-posts mt-5">
                <?php if ($resource_query->have_posts()) : ?>
                    <?php /* Start the Loop */ ?>
                    <?php while ($resource_query->have_posts()) : $resource_query->the_post(); ?>
                        <?php
                        get_template_part('loop-templates/content', 'blog');
                        ?>
                    <?php endwhile; ?>
                <?php else : ?>
                    <div>No articles found containing '<?php echo $search_query; ?>'. Please review your search criteria and try again.</div>
                <?php endif; ?>
            </div>
            <div class="mb-5 text-center">
                <?php
                    $page_check = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    quest_custom_pagination($resource_query->max_num_pages, $page_check); ?>
                <?php wp_reset_postdata(); ?></div>
        </main>
    </div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>