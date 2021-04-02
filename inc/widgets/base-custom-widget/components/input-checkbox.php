<p>
    <input class="widefat" type="checkbox"
           id="<?php echo esc_attr($this->get_field_id($quest_widgets_name)); ?>"
           name="<?php echo esc_attr($this->get_field_name($quest_widgets_name)); ?>"
           value="1" <?php checked(1, $quest_field_value); ?> />

    <label for="<?php echo esc_attr($this->get_field_id($quest_widgets_name)); ?>">
        <strong><?php echo $quest_widgets_title; ?>:</strong>
    </label>

    <?php if ($quest_widgets_description != '') : ?>
        <br/>
        <small><?php echo $quest_widgets_description; ?></small>
    <?php endif; ?>
</p>