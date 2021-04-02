<p>
    <label for="<?php echo esc_attr($this->get_field_id($quest_widgets_name)); ?>">
        <strong><?php echo $quest_widgets_title; ?>:</strong>
    </label>
    <textarea class="widefat"
           rows="<?php echo $quest_widgets_row; ?>"
           id="<?php echo esc_attr($this->get_field_id($quest_widgets_name)); ?>"
           name="<?php echo esc_attr($this->get_field_name($quest_widgets_name)); ?>"><?php echo $quest_field_value; ?></textarea>

    <?php if ($quest_widgets_description != '') : ?>
        <br/>
        <small><?php echo $quest_widgets_description; ?></small>
    <?php endif; ?>
</p>