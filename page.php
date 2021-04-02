<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package understrap
 */
get_header();
$container = get_theme_mod('understrap_container_type');
$IS_SUB_CATEGORY_PAGE = false;
if (get_post_type() == 'page') {
    $terms = wp_get_post_terms(get_the_ID(), QUEST_TAXONOMY_SERVICE);
    if (!empty($terms)) foreach ($terms as $_term) {
        if (!empty($_term->parent)) {
            $IS_SUB_CATEGORY_PAGE = $_term->slug;
            break;
        }
    }
}
?>

<div class="wrapper" id="page-wrapper">

    <div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">
        <div class="custom-header-fulid">
            <div class="bounder">
                <div class="container">
                    <h1 class="search-header-title"><?php the_title() ?></h1>
                    <?php if(has_excerpt()) :?>
                    <h6><?php
                            has_excerpt() && the_excerpt();
                        ?> </h6>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container has-padding default-template">
        <div class="row">

            <div class="col-md-12 content-area" id="primary">

                <!-- Do the left sidebar check -->
                <?php //get_template_part( 'global-templates/left-sidebar-check' ); ?>

                <main class="site-main" id="main">

                    <?php while (have_posts()) : the_post(); ?>

                        <?php get_template_part('loop-templates/content', quest_get_content_slug(get_post_type())); ?>

                        <?php
                        // If comments are open or we have at least one comment, load up the comment template.
                        if (comments_open() || get_comments_number()) :
                            comments_template();
                        endif;
                        ?>

                    <?php endwhile; // end of the loop. ?>

                </main><!-- #main -->

            </div>

        </div><!-- .row -->

    </div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
