<?php
$form_design = $instance['form_design'];
$form_margin = !empty($form_design['form_margin']) ? "margin: {$form_design['form_margin']};" : '';
$form_width = !empty($form_design['form_width']) ? "width: {$form_design['form_width']};" : '';
$form_text_align = !empty($form_design['text_horizontal_align']) ? $form_design['text_horizontal_align'] : '';
$thanks_form = !empty($instance['thanks_form']) ? $instance['thanks_form'] : '';
$recaptcha = !empty($instance['g_recaptcha']) ? $instance['g_recaptcha'] : 'yes';

if (!empty($form_design['horizontal_align'])) {
    switch ($form_design['horizontal_align']) {
        case 'default':
            $horizontal_style = '';
            break;
        case 'center':
	        $horizontal_style = 'margin: auto;';
	        break;
	    case 'right':
		    $horizontal_style = 'margin-left: auto;';
		    break;
        default:
	        $horizontal_style = '';
	        break;
    }
}
?>
<div class="bounder">
    <div class="salesfusion-column" >
        <div class="before-salesfusion">
            <?php echo $instance['before_content'];?>
        </div>

        <div style="<?php echo $form_margin; ?>">
            <div id="thanks-neo" class="salesfusion-form <?php echo $form_design['bg_content']?> <?php echo $form_design['layout_type']?>"
                 data-thanks-form="<?php echo htmlentities($thanks_form); ?>"
                 style="<?php echo $form_width . ' ' . $horizontal_style . ' ' . $form_text_align; ?>">

            <?php if (!empty($_GET['thanks_form'])) : ?>
            <div class="thanks-form">
            <?php echo $thanks_form; ?>
            </div>
            <?php elseif (!empty($instance['form_builder_html'])) : ?>
            <?php

                $dom = new DOMDocument();
                libxml_use_internal_errors(true);
                $dom->loadHTML($instance['form_builder_html']);
                $xpath = new DOMXPath($dom);

                global $wp;
                $names = ['rurl', 'utm_source', 'utm_term', 'utm_campaign'];
                $data = [];

                $data['rurl'] = !empty($instance['redirect_url']) ? rel2abs($instance['redirect_url'], home_url('/')) : '';
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

                echo $dom->saveHTML();
            ?>
            <?php endif; ?>
            </div>
        </div>
        <div class="after-salesfusion">
            <?php echo $instance['after_content'];?>
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
                    '<div class="element-container layout-row recaptcha-container"><div id="recaptchaForm-9999" class="quest-g-recaptcha"></div></div></div>\n' +
                    '</div>' +
                    '</div>';
                var $_selector = $('.salesfusion-form form input[type="submit"]').closest('.form-row');
                $(content).insertBefore($_selector);

                loadGoogleChartsAPI();
            }
        });
    </script>
<?php endif; ?>
