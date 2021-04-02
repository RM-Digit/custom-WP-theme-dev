<?php
function my_custom_fields_class_prefixes( $class_prefixes ) {
	$class_prefixes[] = 'My_Custom_Field_';
	return $class_prefixes;
}
add_filter( 'siteorigin_widgets_field_class_prefixes', 'my_custom_fields_class_prefixes' );

function my_custom_fields_class_paths( $class_paths ) {
	$class_paths[] = get_template_directory() . '/inc/page-builder/my_custom_fields/';
	return $class_paths;
}
add_filter( 'siteorigin_widgets_field_class_paths', 'my_custom_fields_class_paths' );