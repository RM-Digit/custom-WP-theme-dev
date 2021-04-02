<?php
/**
 * Right sidebar check.
 *
 * @package understrap
 */
?>

</div><!-- #closing the primary container from /global-templates/left-sidebar-check.php -->

<?php $sidebar_pos = get_theme_mod( 'understrap_sidebar_position' ); $container   = get_theme_mod( 'understrap_container_type' );?>

<?php if ( 'right' === $sidebar_pos || 'both' === $sidebar_pos ) : ?>

  <?php get_template_part( 'sidebar-templates/sidebar', 'right' ); ?>

<?php endif; ?>
