<div class="bounder">
    <div class="salesfusion-column">
        <div class="before-salesfusion">
            <?php echo $instance['before_content'];?>
        </div>
        <div class="salesfusion-iframe">
            <?php
                $margin_top=!empty($instance['iframe_margin_top']) ? $instance['iframe_margin_top']:'0px';
                $margin_bottom=!empty($instance['iframe_margin_bottom']) ? $instance['iframe_margin_bottom']:'0px';
            ?>
        <?php echo do_shortcode('[salesfusion-form form_url="'. str_replace('http://', 'https://', $instance['iframe_url']) .'" form_width="'. $instance['iframe_width'].'" form_height="'.$instance['iframe_height'].'" wrapper_styles="margin-top:'. $margin_top .';margin-bottom:'. $margin_bottom .'"]');?>
        </div>
        <div class="after-salesfusion">
            <?php echo $instance['after_content'];?>
        </div>
    </div>
</div>