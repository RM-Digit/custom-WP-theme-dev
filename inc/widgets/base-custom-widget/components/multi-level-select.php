<p>
    <label for="<?php echo esc_attr($this->get_field_id($quest_widgets_name)); ?>">
        <strong><?php echo $quest_widgets_title; ?>:</strong>
    </label>
    <select
        class="widefat"
        id="<?php echo esc_attr($this->get_field_id($quest_widgets_name)); ?>"
        name="<?php echo esc_attr($this->get_field_name($quest_widgets_name)); ?>" >
        <?php foreach ($quest_widgets_field_options as $quest_primary_option_title => $quest_primary_option_sub) : ?>
            <option value="">Select</option>
            <optgroup label="<?php echo esc_attr($quest_primary_option_title); ?>">
                <?php foreach ($quest_primary_option_sub as $quest_option_value => $quest_option_title) : ?>
                <option
                    value="<?php echo esc_attr($quest_option_value); ?>"
                    <?php selected($quest_option_value, $quest_field_value); ?>><?php echo esc_html($quest_option_title); ?></option>
                <?php endforeach;; ?>
            </optgroup>
        <?php endforeach; ?>
    </select>

    <?php if ($quest_widgets_description != '') : ?>
        <br/>
        <small><?php echo $quest_widgets_description; ?></small>
    <?php endif; ?>
</p>