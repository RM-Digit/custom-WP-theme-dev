<?php
/**
 * The header for veem teamplate.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package understrap
 */

$container = get_theme_mod('understrap_container_type');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=11">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="<?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="hfeed site" id="page">

    <!-- ******************* The Navbar Area ******************* -->
    <div id="veeam-wrapper-navbar" itemscope itemtype="http://schema.org/WebSite">
        <div class="container veeam-header">
            <div class="row">
                <div class="col-md-5 brand">
                    <!-- Your site title as branding in the menu -->
                    <?php
                        printf('<a href="%1$s" class="veam-logo-link" rel="home" itemprop="url">%2$s</a>',
                            esc_url(home_url('/')),
                            '<img src="' . get_theme_file_uri('img/logo-white.png') . '" class="attachment-full size-full" alt="Questsys logo" />'
                        );
                    ?><!-- end custom logo -->
                        <img src="<?php echo get_theme_file_uri('img/veeam.png');?>" class="veeam-logo attachment-full size-full" alt="Veeam text"/>'
                </div>
                <div class="col-md-7 sky-header no-padding">
                    <img src="<?php echo get_theme_file_uri('img/images_r1_c2.jpg');?>" class="attachment-full size-full" alt="Header sky"/>
                </div>
            </div>
        </div><!-- .container -->

    </div><!-- #wrapper-navbar end -->
