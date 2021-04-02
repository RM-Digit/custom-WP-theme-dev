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
$obj = get_queried_object();
$post_type = $obj->name;
?>

<div class="wrapper" id="archive-wrapper">
    <div class="custom-header-fulid">
        <div class="bounder">
            <div class="container">
                <h1 class="custom-header-title">
                    <?php $pt = get_post_type_object($post_type); if(!EMPTY($pt)) {echo $pt->label;} else echo get_the_title();?>
                </h1>
            </div>
        </div>
    </div>
	<div class="container" id="content" tabindex="-1">
		<div class="row">

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">

				<?php if ( have_posts() ) : ?>

					<header class="page-header">
                         <div class="row">
                            <div class="archive-header col-sm-10">
                                <h5 class="page-title">
                                    <?php printf(esc_html__( 'Latest %s',
                                        'quest' ), $pt->label); ?>
                                </h5>
                            </div>
                            <div class="desktop-drop-down drop-down col-sm-2">
                                <?php $sort = empty($_GET['sort']) ? 'DESC' : $_GET['sort'];?>
                                <div class="selected">
                                <a href="javascript:void(0)"><span><?php if(empty($_GET['sort'])){ echo 'Sort'; }elseif($_GET['sort']=='DESC'){ echo 'Newest'; }else{ echo 'Oldest'; }?></span><em class="fa fa-caret-down" aria-hidden="true"></em></a>
                                </div>
                                <div class="options">
                                    <ul>
                                        <li><input type="radio" id="sort-newest" name="sort" class="dropdown-item" value="DESC" <?php echo $sort == 'DESC' ? 'checked' : '' ; ?> /><label for="sort-newest">Newest</label></li>
                                        <li><input type="radio" id="sort-oldest" name="sort" class="dropdown-item" value="ASC" <?php echo $sort == 'ASC' ? 'checked' : ''; ?> /><label for="sort-oldest">Oldest</label></li>
                                    </ul>
                                </div>
                                <a class="btn open-left-sidebar">
                                    <em class="fa fa-sliders" aria-hidden="true"></em>
                                </a>
                            </div>
                        </div>
					</header><!-- .page-header -->
                    <div class="card-columns">
                        <?php /* Start the Loop */ ?>
                        <?php while ( have_posts() ) : the_post(); ?>

                            <?php

                            /*
                             * Include the Post-Format-specific template for the content.
                             * If you want to override this in a child theme, then include a file
                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                             */
                            get_template_part( 'loop-templates/content',
                                'search');
                            ?>

                        <?php endwhile; ?>
                    </div>
				<?php else : ?>

					<?php get_template_part( 'loop-templates/content', 'none' ); ?>

				<?php endif; ?>

			</main><!-- #main -->

			<!-- The pagination component -->
			<?php understrap_pagination(); ?>

		<!-- Do the right sidebar check -->
		<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

	</div> <!-- .row -->

</div><!-- Container end -->


<?php get_footer(); ?>
</div><!-- Wrapper end -->
