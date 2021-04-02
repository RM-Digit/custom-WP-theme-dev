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

<div class="wrapper" id="veeam-wrapper-footer">
    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="row footer">
            <?php do_action( 'quest_before_footer' ); ?>
                <div class="col-md-9 quest-veeam-info">
                    <p class="quest-footer-info">
                        <a href="tel:<?php echo get_option('quest_phone_number');?>"> <?php echo get_option('quest_phone_number');?></a> |
                        <a href="<?php echo esc_url(get_option('quest_homepage_url'));?>"> <?php echo get_option('quest_homepage_url');?></a>
                    </p>
                    <p>Quest. All Rights Reserved. Quest © <?php echo date('Y');?>. Quest <span class="copyright-text">®</span> and <img class="copyright-img" src="<?php echo get_bloginfo('template_url') ?>/img/q-copyright.png" alt="Questsys copyright"> <span class="copyright-text">®</span> are registered trademarks of Quest Media & Supplies, Inc </p>
                </div>
                <div class="col-md-3 how-can-we-help">
                    <a href="<?php echo esc_url(home_url('/'));?>" class="footer-home-link">How can we help?</a>
                </div>
            <?php do_action( 'quest_before_footer' ); ?>
            </div>
        </div><!-- container end -->
    </footer><!-- #colophon -->
</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

<script>(function(){var s = document.createElement('script'),e = ! document.body ? document.querySelector('head') : document.body;s.src = 'https://acsbap.com/apps/app/assets/js/acsb.js';s.async = s.defer = true;s.onload = function(){acsbJS.init({statementLink : '',feedbackLink : '',footerHtml : '',hideMobile : false,hideTrigger : false,language : 'en',position : 'right',leadColor : '#146FF8',triggerColor : '#146FF8',triggerRadius : '50%',triggerPositionX : 'right',triggerPositionY : 'bottom',triggerIcon : 'default',triggerSize : 'medium',triggerOffsetX : 20,triggerOffsetY : 20,mobile : {triggerSize : 'small',triggerPositionX : 'right',triggerPositionY : 'center',triggerOffsetX : 0,triggerOffsetY : 0,triggerRadius : '50%'}});};e.appendChild(s);}());</script>

</body>

</html>
