<?php
/**
 * The header for our theme.
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="<?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <meta content="telephone=no" name="format-detection">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">    
    <?php wp_head(); ?>
    <script>
        function setCookie(cname, cvalue, exdays) {
            var d = new Date();
            d.setTime(d.getTime() + (exdays*24*60*60*1000));
            var expires = "expires="+ d.toUTCString();
            // document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
            document.cookie = cname + "=" + cvalue + ";path=/";
        }

        function getCookie(cname) {
            var name = cname + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var ca = decodedCookie.split(';');
            for(var i = 0; i <ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }
    </script>
    <!-- Hotjar Tracking Code for https://questsys.com -->
    <script>
        (function(h,o,t,j,a,r){
            h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
            h._hjSettings={hjid:1843726,hjsv:6};
            a=o.getElementsByTagName('head')[0];
            r=o.createElement('script');r.async=1;
            r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
            a.appendChild(r);
        })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    </script>
    <?php include 'critical-css.php' ?>    
</head>

<body <?php body_class(); ?>>

<div class="hfeed site fixed-header" id="page">

    <!-- ******************* The Navbar Area ******************* -->
    <div id="wrapper-navbar" itemscope itemtype="http://schema.org/WebSite">
        <div class="container">
			<?php echo do_shortcode('[wd_asp id=1]'); ?>
            <div class="header-contact-btn">
                <a href="https://www.questsys.com/contact-us/">Contact</a>
            </div>
        </div>
        
        <a class="btn btn-secondary skip-to-content sr-only"
           href="#web-content"><?php esc_html_e('Skip to content', 'understrap'); ?></a>

        <nav class="navbar navbar-expand-md navbar-light">


            <div class="container">
                

                <!-- Your site title as branding in the menu -->
                <?php if (true || !has_custom_logo()) {
                    $html = sprintf('<a href="%1$s" class="custom-logo-link" rel="home" itemprop="url"><span class="sr-only">Quest Logo</span>%2$s</a>',
                        esc_url(home_url('/')),
                        '<img alt="Quest" src="' . get_theme_file_uri('img/logo@2x.png') . '" class="attachment-full size-full" />'
                    );
                    echo apply_filters('get_custom_logo', $html, get_current_blog_id());
                } else {
                    the_custom_logo();
                } ?><!-- end custom logo -->

                <a href="#nav" class="navbar-toggler">
                    <span class="sr-only">Quest Logo</span>
                    <span class="navbar-toggler-bounder"><em class="fa fa-bars" style="font-size: 1.7rem"></em></span>
                </a>
               
                <!-- The WordPress Menu goes here -->
                <?php wp_nav_menu(
                    array(
                        'theme_location' => 'primary',
                        'container_class' => 'collapse navbar-collapse',
                        'container_id' => 'navbarNavDropdown',
                        'menu_class' => 'navbar-nav ml-auto',
                        'fallback_cb' => '',
                        'menu_id' => 'main-menu',
                        'depth' => 3,
                        'walker' => new Quest_WP_Bootstrap_Navwalker(),
                        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s<li class="menu-item nav-item menu-search-item"><form method="get" id="search-form" action="' . esc_url(home_url('/')) . '" role="search"><div class="search-container"><label class="d-none" for="s">Search:</label>
                        <input autocomplete="off" class="field form-control" id="s" name="s" type="text" placeholder="Search" value="">
                        <input type="submit" value="search" name="submit" class="d-none" />
                        <a href="#ok" class="submit btn btn-link search-toggle d-md-none" id="search-submit"><span class="sr-only">Search button</span><em class="fa fa-search"></em></a>
                            <a href="#close" class="submit btn btn-link search-toggle d-none d-md-block" id="search-toggle"><span class="sr-only">Search button</span><em class="fa fa-search"></em></a></div></form><a href="#nav" class="navbar-toggler">
                    <span class="sr-only">Search button</span><span class="navbar-toggler-bounder"><em class="fa fa-times"></em></span>
                </a></li></ul>'
                    )
                ); ?>


            </div><!-- .container -->


        </nav><!-- .site-navigation -->

    </div><!-- #wrapper-navbar end -->
    <div id="web-content"></div>
    <!--open div .hfeed -->
