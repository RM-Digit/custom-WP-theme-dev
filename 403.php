<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package understrap
 */

get_header();

$container   = get_theme_mod( 'understrap_container_type' );
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );

?>

<div class="wrapper" id="error-404-wrapper">
	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">
			<div class="content-area" id="primary">
				<main class="site-main" id="main">
					<section class="error-404 not-found">
                        <header class="page-header">
                            <div class="text-error-404">
                                <p style="font-size: 13rem; line-height: 0.8" class="page-title font-weight-bold">403</p>
                                <p style="font-size: 2rem" class="font-weight-bold" >Access Forbidden</p>
                                <a class="btn btn-success text-white mt-4 font-weight-bold" href="<?php echo get_home_url(); ?>">Back to Homepage</a>
                            </div>
						</header><!-- .page-header -->
					</section><!-- .error-404 -->
				</main><!-- #main -->
			</div><!-- #primary -->
	</div><!-- Container end -->
</div><!-- Wrapper end -->

<?php get_footer(); ?>
