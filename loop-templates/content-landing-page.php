<?php
/**
 * Partial template for content in page.php
 *
 * @package understrap
 */

?>
<article <?php post_class('position-relative'); ?> id="post-<?php the_ID(); ?>">
    <?php edit_post_link( __( '<em class="fa fa-edit"><span style="display:none;">Edit</span></em>', 'understrap' ), '<span class="edit-link position-absolute">', '</span>' ); ?>
	<header class="entry-header d-none">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	</header><!-- .entry-header -->

	<?php //echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

	<div class="entry-content">

		<?php the_content(); ?>

		<?php
		/*wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
			'after'  => '</div>',
		) );*/
		?>

	</div><!-- .entry-content -->


</article><!-- #post-##3 -->
