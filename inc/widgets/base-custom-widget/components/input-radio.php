<p>
    <?php
    echo $quest_widgets_title;
    echo '<br />';
    foreach ($quest_widgets_field_options as $quest_option_name => $quest_option_title) : ?>
        <input
            id="<?php echo esc_attr($instance->get_field_id($quest_option_name)); ?>"
            name="<?php echo esc_attr($instance->get_field_name($quest_widgets_name)); ?>"
            type="radio" value="<?php echo esc_attr($quest_option_name); ?>"
            <?php checked($quest_option_name, $quest_field_value); ?> />

        <label for="<?php echo esc_attr($instance->get_field_id($quest_option_name)); ?>">
            <?php echo esc_html($quest_option_title); ?>
        </label>
        <br />
    <?php endforeach; ?>

    <?php if ($quest_widgets_description != '') : ?>
        <br/>
        <small><?php echo $quest_widgets_description; ?></small>
    <?php endif; ?>
</p>