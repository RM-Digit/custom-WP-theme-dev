<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package quest
 */

$the_theme = wp_get_theme();
$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="wrapper-footer">
	<div class="container">
        <?php do_action( 'quest_before_footer' ); ?>
            <footer id="colophon" class="site-footer">
                <?php
                    /**
                     * @hooked quest_footer_widgets - 10
                     * @hooked quest_copyright - 40
                     */
                    do_action( 'quest_footer' );
                ?>
            </footer><!-- #colophon -->
        <?php do_action( 'quest_before_footer' ); ?>
	</div><!-- container end -->

</div><!-- wrapper end -->

<div class="cookie-law-bar">
    <span>
        We use cookies to give you the best experience possible on our website. To find out more, read our
        <a class="font-family-inherit" href="<?php echo esc_url( get_permalink( get_option( 'wp_page_for_privacy_policy' ) ) ); ?>">privacy policy.</a>
    </span>
    <span class="close-icon"><em class="fa fa-times" aria-hidden="true"></em></span>
</div>

</div>
<?php
if (is_resource_page()) {
    // close .hfeed div, #page we need this extra closing tag here
?>
</div>
<?php } ?>


<?php wp_footer(); ?>

<!-- Clicky tracking scripts -->
<?php
/*
    do_action('quest_salesfusion_web_tracking_code_whole_site');
    $clicky_tracking_id = get_option('quest_clicky_analytic_tracking_id', 100678095); //100678095
    $clicky_tracking_id = empty($clicky_tracking_id) ? 100678095 : $clicky_tracking_id;
    */
?>

<script>var clicky_site_ids = clicky_site_ids || []; clicky_site_ids.push(100678095);</script>

<script async src="//static.getclicky.com/js"></script>

<?php if( is_page('Resources')) { ?>
<script>
jQuery(document).ready(function(){
	
	jQuery('.bar-a-ref:contains("On-Demand Contents")').text("On-Demand Content");
	jQuery('.bar-a-ref:contains("Disaster Recovery")').text("Disaster Recovery Services");
	jQuery('.bar-a-ref:contains("Infrastructure")').text("Infrastructure Services"); 
	jQuery(".footer-content").hide();
   
});
</script>
<?php } ?>


<!-- OptinMonster -->
<script type="text/javascript" src="https://a.omappapi.com/app/js/api.min.js" data-account="5215" data-user="1660" async></script>
<!-- / Breezy Hill Marketing -->

<script>(function(){var s = document.createElement('script'),e = ! document.body ? document.querySelector('head') : document.body;s.src = 'https://acsbap.com/apps/app/assets/js/acsb.js';s.async = s.defer = true;s.onload = function(){acsbJS.init({statementLink : '',feedbackLink : '',footerHtml : '',hideMobile : false,hideTrigger : false,language : 'en',position : 'right',leadColor : '#146FF8',triggerColor : '#146FF8',triggerRadius : '50%',triggerPositionX : 'right',triggerPositionY : 'bottom',triggerIcon : 'default',triggerSize : 'medium',triggerOffsetX : 20,triggerOffsetY : 20,mobile : {triggerSize : 'small',triggerPositionX : 'right',triggerPositionY : 'center',triggerOffsetX : 0,triggerOffsetY : 0,triggerRadius : '50%'}});};e.appendChild(s);}());</script>

</body>

</html>

