<?php
    $address = ! empty( $instance['address'] ) ? $instance['address'] : '';
    $map_image_url = ! empty( $instance['map_image_url'] ) ? wp_get_attachment_image_src(esc_attr($instance['map_image_url']), 'large')[0] : '';
    $phone = ! empty( $instance['phone'] ) ? esc_attr($instance['phone']) : '';
    $email = ! empty( $instance['email'] ) ? esc_attr($instance['email']) : '';
    $recaptcha = !empty($instance['g_recaptcha']) ? $instance['g_recaptcha'] : 'yes';
?>

<div class="contact-form">
    <div class="container" >
        <div class="row">
            <div class="col-lg-6 col-md-12 left-content salesfusion-form" data-thanks-form="">
                <?php if (!empty($instance['form_builder_html'])) :?>
	                <?php

	                $dom = new DOMDocument();
	                libxml_use_internal_errors(true);
	                $dom->loadHTML($instance['form_builder_html']);
	                $xpath = new DOMXPath($dom);

	                global $wp;
	                $names = ['rurl', 'utm_source', 'utm_term', 'utm_campaign'];
	                $data = [];

	                $data['rurl'] = !empty($instance['redirect_url']) ? rel2abs($instance['redirect_url'], home_url()) : '';
	                $data['utm_source'] = home_url($wp->request);
	                $data['utm_term'] = get_the_title();

	                $categories = [];
	                $terms = wp_get_post_terms(get_the_ID(), QUEST_TAXONOMY_SERVICE);
	                if (!empty($terms)) foreach ($terms as $_term) {
		                if(empty($categories)) {
			                $categories = [$_term->name];
		                } else {
			                $categories[] = $_term->name;
		                }
	                }

	                $data['utm_campaign'] = implode(', ', $categories);

	                foreach ($names as $name) {
		                $node = $xpath->query("//input[@name=\"{$name}\"]")->item(0);

		                if (!empty($node) && !empty($data[$name])) {
			                $node->setAttribute('value', $data[$name]);
		                }
	                }

                    $html=$dom->saveHTML();
                    $html=str_replace('<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">', '', $html);
                    $html=str_replace('<html>', '', $html);
                    $html=str_replace('</html>', '', $html);
                    $html=str_replace('</body>', '', $html);
                    $html=str_replace('<body>', '', $html);
                    $html=str_replace('<head>', '', $html);
                    $html=str_replace('</head>', '', $html);
	                echo $html;
	                ?>
                <?php endif; ?>
            </div>
            <div class="col-lg-6 col-md-12 right-content">
                <div class="us-information">
                    <?php if(!empty($address)): ?>
                    <div class="some-icon row">
                        <div class="d-inline-block"><em class="fa fa-map-marker" aria-hidden="true"></em></div>
                        <div class="d-inline-block"><span><?php echo $address; ?></span></div>
                    </div>
                    <?php endif; ?>
                    <div class="some-icon row">
                        <div class="d-inline-block"><em class="fa fa-phone" aria-hidden="true"></em></div>
                        <div class="d-inline-block"><span><?php echo $phone; ?></span></div>
                    </div>
                    <div class="some-icon row">
                        <div class="d-inline-block"><em class="fa fa-envelope" aria-hidden="true"></em></div>
                        <div class="d-inline-block"><span class=""><a href="mailto:<?php echo $email; ?>" target="_top"><?php echo $email; ?></a></span></div>
                    </div>
                    <div class="pt-4">
                        <h3 class="text-secondary">"Agile, responsive, dependable technical expertise whenever you need it."</h3>
                        <h4 class="text-secondary text-center">-Tim Burke, Quest President and CEO</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
// TODO Disable recaptcha
if ($recaptcha == 'yes' && false) : ?>
    <script>
        jQuery(function($) {
            if ($('.salesfusion-form form').length && !$('.salesfusion-form form .g-recaptcha').length) {
                var content = '<div class="form-row quest-g-recaptcha-container">' +
                    '<div id="field9999" field_map_id="9999" >\n' +
                    '<div class="component-container">\n' +
                    '<div class="element-container layout-row"><div id="recaptchaForm-9999" class="quest-g-recaptcha"></div></div></div>\n' +
                    '</div>' +
                    '</div>';
                var $_selector = $('.salesfusion-form form input[type="submit"]').closest('.form-row');
                $(content).insertBefore($_selector);

                loadGoogleChartsAPI();
            }
        });
    </script>
<?php endif; ?>
<?php
do_action('quest_salesfusion_web_tracking_code');
?>
