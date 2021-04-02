<?php
/**
 *
 * This template can be used to override the default template and sidebar setup
 *
 * @package quest
 */

get_header();
?>
<?php
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
$sort = !empty($_GET['sort']) ? $_GET['sort'] : '';
$sort_key = 'date';
$sort_value = 'desc';
if(array_key_exists($sort, sort_options())){
    $sort_array = explode('-', $sort);
    $sort_key = $sort_array[0];
    $sort_value = $sort_array[1];
}

$args = array(
    'ep_integrate'   => true,
    'paged' => $paged,
    'posts_per_page'=> 20,
    'orderby'=> array($sort_key=>$sort_value),
    'post_type'=> QUEST_POST_TYPE_GOVERNMENT_BLOG,
    'date_query'=> array(
        array(
            'year' => 2012,
            'compare' => '>=',
        ),
        array(
            'year' => date("Y")-3,
            'compare' => '<=',
        ),
    )
);
$newsletters = new WP_Query($args);
?>
<div class="wrapper" id="resource-wrapper">

    <div class="custom-header-fulid">
        <div class="bounder">
            <div class="container">
                <h1 class="search-header-title">
                    <?php _e('Archived Government Blogs', 'quest');?>
                </h1>
            </div>
        </div>
    </div>
    <div class="container" id="content" tabindex="-1">
        <?php if ( $newsletters->have_posts() ) :?>
            <div class="row">
                <div class="desktop-drop-down drop-down offset-md-10 col-md-2 pl-0">
                    <form id="press-release-sort" method="get" action="<?php echo get_post_type_archive_link(QUEST_POST_TYPE_GOVERNMENT_BLOG);?>">
                        <?php quest_sortable();?>
                    </form>
                </div>
            </div>
        <?php endif;?>
        <div class="row" style="padding-left: inherit;">
            <main class="site-main col-md-12" id="main">
                <?php
                if ( $newsletters->have_posts() ) {
                    while( $newsletters->have_posts() ) {
                        $newsletters->the_post();
                        get_template_part( 'loop-templates/content', 'our-archive' );
                    }
                }else{
                    get_template_part( 'loop-templates/content', 'none' );
                }?>
            </main><!-- #main -->
        </div>
        <!-- The pagination component -->
        <div class="pb-4">
        <?php quest_pagination($newsletters->max_num_pages == null ? 1 : $newsletters->max_num_pages ); ?>
        </div>
        <?php wp_reset_postdata(); ?>
    </div><!-- .row -->

</div><!-- Container end -->

<?php get_footer(); ?>


</div><!-- Wrapper end -->