<p>
    <label for="<?php echo esc_attr($this->get_field_id($quest_widgets_name)); ?>">
        <strong><?php echo $quest_widgets_title; ?>:</strong>
    </label>
    <input class="widefat" type="number" step="1" min="1"
           id="<?php echo esc_attr($this->get_field_id($quest_widgets_name)); ?>"
           name="<?php echo esc_attr($this->get_field_name($quest_widgets_name)); ?>"
           value="<?php echo $quest_field_value; ?>" />

    <?php if ($quest_widgets_description != '') : ?>
        <br/>
        <small><?php echo $quest_widgets_description; ?></small>
    <?php endif; ?>
</p>