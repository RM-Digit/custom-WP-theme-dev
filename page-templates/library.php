<?php
/**
 * Template Name: Library Layout
 *
 * This template can be used to override the default template and sidebar setup
 *
 * @package quest
 */
get_header();
?>
<?php
/* Build filter list data */
$isset_filter = false;
$filter_keys = [];
$filter_list_keys = ['resources', 'services', 'owner'];
$resources = ['solution-brief','video','infographic'];
$services = [];
$authors = [];
if (!empty($_GET['resources'])) {
    $isset_filter=true;
    $resources = $_GET['resources'];
    $filter_keys['resources'] = $resources;
    $filters['resources'] = quest_get_post_types('resources', 'array');
    // Add only Author belongs to resources
    if(!empty($_GET['owner'])) {
        $_authors = $_GET['owner'];
        $mapAuthorIndex = [
                QUEST_POST_TYPE_CEO_BLOG =>QUEST_AUTHOR_INDEX_CEO_BLOG,
                QUEST_POST_TYPE_PARTNER_BLOG =>QUEST_AUTHOR_INDEX_PARTNER_BLOG,
                QUEST_POST_TYPE_SECURITY_BLOG =>QUEST_AUTHOR_INDEX_SECURITY_BLOG,
                QUEST_POST_TYPE_GOVERNMENT_BLOG =>QUEST_AUTHOR_INDEX_GOVERNMENT_BLOG
        ];
        foreach ($resources as $resource){
            if(!empty($mapAuthorIndex[$resource]) && !empty($_authors[$mapAuthorIndex[$resource]])){
             $authors[$mapAuthorIndex[$resource]]=$_authors[$mapAuthorIndex[$resource]];
            }
        }
    }
}
if (!empty($_GET['services'])) {
    $isset_filter=true;
    $services = $_GET['services'];
    $filter_keys['services'] = $services;
    $filters['services'] = quest_array_list_servives();
}
if (!empty($_authors)) {
    $isset_filter=true;
    $filter_keys['owner'] = $authors;
    $list_users = get_users();
    foreach ($list_users as $user) {
        $filters['owner'][$user->ID] = $user->display_name;
    }
}
/* Process params data */
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$sort = (!empty($_GET['sort']) && (!empty($resources) || !empty($services))) ? $_GET['sort'] : '';
$args_featured_query = array();
$sort_options = sort_options();
$sort_key = count($sort_options) > 2 ? 'date' : 'title';
$sort_value = count($sort_options) > 2 ? 'desc' : 'asc';
if (array_key_exists($sort, $sort_options)) {
    $sort_array = explode('-', $sort);
    $sort_key = $sort_array[0];
    $sort_value = $sort_array[1];
} else {
    $sort_array = explode('-', array_keys($sort_options)[0]);
    $sort_key = $sort_array[0];
    $sort_value = $sort_array[1];
}
$args_resource_query = array(
    'ep_integrate' => true,
    'paged' => $paged,
    'orderby' => array($sort_key => $sort_value)
);
//$is_press_release =count($services)==0 && count($resources) == 1 && in_array($resources[0], quest_our_archives());
if (!empty($services)) {
    $args_resource_query['tax_query'] = array(
        array(
            'taxonomy' => 'service',
            'terms' => $services,
            'field' => 'slug'
        )
    );
}

if (!empty($resources)) {
    $args_resource_query['post_type'] = $resources;
} else {
    $args_resource_query['post_type'] = quest_get_post_types('resources');
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
    $args_featured_query['orderby'] = 'rand';
    $args_featured_query['posts_per_page'] = 1;
}
/* Filter by authors. Todo: filter by author of each post type */
if (!empty($authors)) {
    $args_resource_query['author__in'] = $authors;
}
/* Get old posts ids that won't be displayed */
$oldPostsArgs['post_type'] = !empty($resources) ? array_intersect(quest_our_archives(), $resources) : quest_our_archives();
$oldPostsArgs['date_query'] = array('year' => date("Y") - 2, 'compare' => '<');
$oldPostsArgs['fields'] = 'ids';
$oldPostsArgs['posts_per_page'] = -1;
$oldPosts = new WP_Query($oldPostsArgs);

$excluded = get_option('sep_exclude_resource');
$args_resource_query['post__not_in'] = array_merge($excluded, $oldPosts->posts);
$resource_query = new WP_Query($args_resource_query);
if (!empty($args_featured_query)) {
    $featured_query = new WP_Query($args_featured_query);
}

$oldPostsNumber = [];
foreach ($oldPostsArgs['post_type'] as $post_type) {
    $postTemp = new WP_Query([
        'date_query' => array('year' => date("Y") - 2, 'compare' => '<'),
        'post_type' => [$post_type],
        'posts_per_page' => -1,
        'fields' => 'ids'
    ]);
    $oldPostsNumber[$post_type] = $postTemp->found_posts;
}

global $is_show_footer;
$is_show_footer = false;
?>
<div class="wrapper" id="resource-wrapper">

    <div class="custom-header-fulid">
        <div class="bounder">
            <div class="container">
                <h1 class="search-header-title">
                    <?php the_title(); ?>
                </h1>
            </div>
        </div>
    </div>
    <?php if ($isset_filter): ?>
        <div class="resource-filter-fluid container-fluid">
            <div class="container">
                <div class="resource-filter row">
                    <div class="filter-keyword col-md-12">
                        <?php quest_resource_filters($filters, $filter_keys); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="container" id="content" tabindex="-1">
        <div class="row">

            <!-- Do the left sidebar check and opens the primary div -->
            <?php get_template_part('global-templates/left-sidebar-check'); ?>
            <main class="site-main" id="main">

                <header class="page-header">
                    <a class="btn open-left-sidebar">
                        <em class="fa fa-sliders" aria-hidden="true"></em>
                    </a>
                    <?php if ($isset_filter): ?>
                        <div class="resource-filter row">
                            <div class="filter-keyword col-md-10">
                                <?php quest_resource_filters($filters, $filter_keys); ?>
                            </div>
                            <div class="desktop-drop-down drop-down col-md-2 pl-0">
                                <form id="press-release-sort" method="get" action="/library/">
                                    <?php
                                    foreach ($_GET as $name => $value) {
                                        $name = htmlspecialchars($name);

                                        if (is_array($value)) {
                                            foreach ($value as $item) {
                                                $item = htmlspecialchars($item);
                                                echo '<input type="hidden" name="' . $name . '[]" value="' . $item . '">';
                                            }
                                        } elseif ($name !== 'sort') {
                                            $value = htmlspecialchars($value);
                                            echo '<input type="hidden" name="' . $name . '" value="' . $value . '">';
                                        }
                                    }

                                    quest_sortable();
                                    ?>
                                </form>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="resource-advertising">
                            <?php if (!empty($featured_query) && $featured_query->have_posts()):
                                while ($featured_query->have_posts()) : $featured_query->the_post();
                                    ?>
                                    <?php if (get_post_type() != QUEST_POST_TYPE_CUSTOMER_STORY): ?>
                                        <div class="post-featured" style="background-image: url('<?php echo the_post_thumbnail_url('post-cover'); ?>')">
                                            <div class="featured-content">
                                                <p class="post-type"> <?php echo get_post_type(); ?> available</p>
                                                <h4 class="post-title"><?php the_title(); ?></h4>
                                                <p class="post-excerpt"><?php echo quest_excerpt(15); ?></p>
                                                <a class="btn btn-readmore btn-success" href="<?php the_permalink(); ?>">Learn More</a>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endwhile; endif; ?>
                        </div>
                    <?php endif; ?>
                </header><!-- .page-header -->

                <div class="card-columns" style="visibility: hidden">
                    <?php if ($resource_query->have_posts()) : ?>
                        <?php /* Start the Loop */ ?>
                        <?php while ($resource_query->have_posts()) : $resource_query->the_post(); ?>
                            <?php
                            /**
                             * Run the loop for the search to output the results.
                             * If you want to overload this in a child theme then include a file
                             * called content-search.php and that will be used instead.
                             */
                            if (!in_array(get_post_type(), quest_resource_item_one_column()))
                                get_template_part('loop-templates/content', 'resourcenews');
                            else
                                get_template_part('loop-templates/content', 'search');
                            ?>
                        <?php endwhile; ?>
                        <?php if ($paged == $resource_query->max_num_pages && empty($services)) : ?>
                            <?php foreach ($oldPostsArgs['post_type'] as $post_type) : ?>
                                <?php if ($oldPostsNumber[$post_type] != 0) : ?>
                                    <article class="card article" id="post-archived-newsletter">
                                        <div class="card-body">
                                            <div class="article-content">
                                                <header class="entry-header">
                                                    <div class="entry-title">
                                                        <h6 class="mb-2">
                                                            <a href="<?php echo get_post_type_archive_link($post_type); ?>" rel="bookmark">
                                                                <?php echo __('Archived ', 'quest');
                                                                echo get_post_type_object($post_type)->label ?>
                                                            </a>
                                                        </h6>
                                                        <p><?php echo __('Visit our archives to read more.', 'quest'); ?></p>
                                                    </div>
                                                    <div class="entry-footer text-right">
                                                        <a class="btn btn-secondary text-white" href="<?php echo get_post_type_archive_link($post_type); ?>" rel="bookmark">
                                                            <?php echo __('Visit Our Archives', 'quest'); ?>
                                                        </a>
                                                    </div>
                                                </header><!-- .entry-header -->
                                            </div>
                                        </div>
                                    </article><!-- #post-## -->
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php else: ?>
                        <?php if (!empty($oldPostsArgs['post_type']) && empty($services)) : ?>
                            <?php foreach ($oldPostsArgs['post_type'] as $post_type) : ?>
                                <?php if ($oldPostsNumber[$post_type] != 0) : ?>
                                    <article class="card article" id="post-archived-newsletter">
                                        <div class="card-body">
                                            <div class="article-content">
                                                <header class="entry-header">
                                                    <div class="entry-title">
                                                        <h6 class="mb-2">
                                                            <a href="<?php echo get_post_type_archive_link($post_type); ?>" rel="bookmark">
                                                                <?php echo __('Archived ', 'quest');
                                                                echo get_post_type_object($post_type)->label ?>
                                                            </a>
                                                        </h6>
                                                        <p><?php echo __('Visit our archives to read more.', 'quest'); ?></p>
                                                    </div>
                                                    <div class="entry-footer text-right">
                                                        <a class="btn btn-secondary text-white" href="<?php echo get_post_type_archive_link($post_type); ?>" rel="bookmark">
                                                            <?php echo __('Visit Our Archives', 'quest'); ?>
                                                        </a>
                                                    </div>
                                                </header><!-- .entry-header -->
                                            </div>
                                        </div>
                                    </article><!-- #post-## -->
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else :
                            get_template_part('loop-templates/content', 'none');
                            ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </main><!-- #main -->

            <!-- The pagination component -->
            <?php quest_pagination($resource_query->max_num_pages); ?>
            <?php wp_reset_postdata(); ?>
        </div><!-- .row -->
    </div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
