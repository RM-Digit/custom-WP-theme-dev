<?php
/**
 * Left sidebar check.
 *
 * @package quest
 */
?>

<?php
$container   = get_theme_mod( 'understrap_container_type' );
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );
?>
<?php if($container=='container-full' && !is_search() && !is_archive() && !is_page_template('page-templates/resource.php') && !is_page_template('page-templates/library.php')):?>
	<div class="content-area" id="primary">
<?php else: ?>
<?php if ( 'left' === $sidebar_pos || 'both' === $sidebar_pos ) : ?>
	<?php 
		if (get_page_template_slug()=='page-templates/library.php')
			get_template_part( 'sidebar-templates/sidebar', 'libraryleft' );
		else
			get_template_part( 'sidebar-templates/sidebar', 'left' ); 
	?>
<?php endif; ?>

<?php
	$html = '';
	if ( 'right' === $sidebar_pos || 'left' === $sidebar_pos ) {
		$html = '<div class="col-md-9 content-area" id="primary">';
		echo $html; // WPCS: XSS OK.
	} elseif ( 'both' === $sidebar_pos ) {
		$html = '<div class="';
		if ( is_active_sidebar( 'right-sidebar' ) && is_active_sidebar( 'left-sidebar' ) ) {
			$html .= 'col-md-6 content-area" id="primary">';
		} elseif ( is_active_sidebar( 'right-sidebar' ) || is_active_sidebar( 'left-sidebar' ) ) {
			$html .= 'col-md-9 content-area" id="primary">';
		} else {
			$html .= 'col-md-12 content-area" id="primary">';
		}
		echo $html; // WPCS: XSS OK.
	} else {
	    echo '<div class="col-md-12 content-area" id="primary">';
	}
endif
?>
