<?php
function quest_salesfusion_form($args, $content)
{
    $shortcode = "";
    $form_styles = !empty($args['form_styles']) ? $args['form_styles'] :'';
    $wrapper_styles = !empty($args['wrapper_styles']) ? $args['wrapper_styles'] :'';
    if(!empty($args['form_url'])){
        $form_width = !empty($args['form_width']) ? $args['form_width'] : 350;
        $form_height = !empty($args['form_height']) ? $args['form_height'] : 515;
        $shortcode = '<div class="salesfusion-wrapper" style="'. $wrapper_styles .'"><iframe style="overflow:auto;'. $form_styles .'" frameborder="0" width="'. $form_width .'" height="'. $form_height .'" src="'. $args['form_url'].'"></iframe></div>'
                     . do_action('quest_salesfusion_web_tracking_code');
    }

    return $shortcode;
}

add_shortcode('salesfusion-form', 'quest_salesfusion_form');
