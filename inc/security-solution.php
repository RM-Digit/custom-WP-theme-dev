<?php
/* Disable update notifications and hide wp version in front */
remove_action('wp_head', 'wp_generator');

// remove wp version param from any enqueued scripts
function vc_remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = add_query_arg( 'ver', ENQUEUE_VERSION, $src );
	return $src;
}
add_filter( 'style_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'vc_remove_wp_ver_css_js', 9999 );

//Disable update notifications
function remove_core_updates($data){
	global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
}


/*
add_filter('pre_site_transient_update_core','remove_core_updates');
add_filter('pre_site_transient_update_plugins','remove_core_updates');
*/
add_filter('pre_site_transient_update_themes','remove_core_updates');

/**
 * Auto logout ajax.
 */
//add_action( 'wp_ajax_auto_logout', 'auto_logout' );
//add_action( 'wp_ajax_nopriv_auto_logout', 'auto_logout' );
//function auto_logout(){
//	wp_verify_nonce($_POST['ajaxsecurity'], 'secure-my-logout');
//	echo "Logged Out.";
//	if($_POST['time']){
//		wp_clear_auth_cookie();
//		die();
//	}
//	die();
//}

function wpse_159462_login_form() {
	echo '<script>document.getElementById( "user_pass" ).autocomplete = "off"; document.getElementById( "user_login" ).autocomplete = "off";</script>';
}

add_action( 'login_form', 'wpse_159462_login_form' );