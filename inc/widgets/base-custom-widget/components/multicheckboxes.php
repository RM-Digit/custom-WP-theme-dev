<div>
    <label for="<?php echo esc_attr($this->get_field_id($quest_widgets_name)); ?>">
        <strong><?php echo $quest_widgets_title; ?>:</strong>
    </label>
    <div class="quest-multiplecat">
        <?php foreach ( $quest_widgets_field_options as $quest_option_name => $quest_option_title) :
            if( isset( $quest_field_value[$quest_option_name] ) ) {
                $quest_field_value[$quest_option_name] = 1;
            }else{
                $quest_field_value[$quest_option_name] = 0;
            }
        ?>
        <p>
            <input id="<?php echo esc_attr($this->get_field_id($quest_widgets_name)); ?>" name="<?php echo esc_attr($this->get_field_name($quest_widgets_name)).'['.esc_attr($quest_option_name).']'; ?>" type="checkbox" value="1" <?php checked('1', $quest_field_value[$quest_option_name]); ?>/>
            <label for="<?php echo esc_attr($this->get_field_id($quest_option_name)); ?>"><?php echo esc_html($quest_option_title); ?></label>
        </p>
        <?php endforeach; ?>
    </div>

    <?php if ($quest_widgets_description != '') : ?>
        <br/>
        <small><?php echo $quest_widgets_description; ?></small>
    <?php endif; ?>
</div>
