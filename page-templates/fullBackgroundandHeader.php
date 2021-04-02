<?php
/**
 *
 * Template Name: Full Width with Header
 *
 * The template for displaying content from pagebuilder.
 *
 * Template Post Type: page, assessment, solution-brief, infographic
 *
 * This is the template that displays pages without title in fullwidth layout. Suitable for use with Pagebuilder.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Quest
 */
$container = get_theme_mod('understrap_container_type');
get_header(); ?>

<?php
/**
 * flash_before_body_content hook
 */
do_action('flash_before_body_content'); ?>
<style>
    .latest-posts h2 {
        color: #1c1f22;
    }
</style>
    <div class="wrapper full-bg-header" id="page-wrapper">
        <div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">
            <div class="custom-header-fulid">
                <div class="bounder">
                    <div class="container">
                        <h1 class="search-header-title"><?php the_title() ?></h1>
                        <?php if (has_excerpt()) : ?>
                            <h6><?php
                                has_excerpt() && the_excerpt();
                                ?> </h6>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="<?php echo esc_attr( $container ); ?>" id="content">
            <main class="site-main" id="main">

                <?php while ( have_posts() ) : the_post(); ?>

                    <?php get_template_part( 'loop-templates/content', 'page' ); ?>

                    <?php
                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :

                        comments_template();

                    endif;
                    ?>

                <?php endwhile; // end of the loop. ?>

            </main><!-- #main -->
        </div><!-- Container end -->
    </div><!-- Wrapper end -->

<?php
/**
 * flash_after_body_content hook
 */
do_action('flash_after_body_content'); ?>

<?php
get_footer();
