<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package understrap
 */

get_header();
?>

<?php
$container   = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper archive-vendor" id="archive-wrapper">
    <div class="custom-header-fulid">
        <div class="bounder">
            <div class="container">
                <h1 class="custom-header-title">Quest's Vendor Partners</h1>
                <p class="mb-0">We work with leading vendors across all technology product and services lines and recommend the most appropriate for your business objectives.</p>
                <p><a class="contact-quest-link" href="/contact-us">Contact Quest</a> to learn about our various certifications with the vendor partners below.</p>
            </div>
        </div>
    </div>
	<div class="container" id="content" tabindex="-1">

			<main class="site-main" id="main">

                <?php
                    $args = array('post_type'=> 'vendor', 'posts_per_page'=> '-1', 'orderby'=>'title', 'order'=>'ASC');
                    $vendorposts = new WP_Query( $args  );
                ?>
				<?php if ($vendorposts->have_posts()) : ?>
                    <div class="vendor-card-columns">
                        <?php /* Start the Loop */ ?>
                        <?php while ( $vendorposts->have_posts()) : $vendorposts->the_post(); ?>

                            <?php

                            /*
                             * Include the Post-Format-specific template for the content.
                             * If you want to override this in a child theme, then include a file
                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                             */
                            get_template_part( 'loop-templates/content', 'vendor');
                            ?>

                        <?php endwhile; ?>
                    </div>
				<?php else : ?>

					<?php get_template_part( 'loop-templates/content', 'none' ); ?>

				<?php endif; ?>
                <?php wp_reset_postdata();?>
			</main><!-- #main -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
