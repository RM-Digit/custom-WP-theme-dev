<?php

function quest_meta_box_expiration_date()
{
    add_meta_box(
        'expiration-date',
        __('Expiration date', 'quest'),
        'quest_meta_output_expiration_date',
        QUEST_POST_TYPE_EVENT,
        'side',
        'high'
    );
}

add_action('add_meta_boxes', 'quest_meta_box_expiration_date');

function quest_meta_output_expiration_date($post)
{

    wp_nonce_field('save_expiration_date', 'expiration_date_nonce'); ?>

    <?php
    $quest_expiration_date = get_post_meta($post->ID, 'expiration-date', true);
    ?>
    <p>
        <label for="quest_expiration_date"><?php _e('Expiration date', 'quest'); ?></label><br/>
        <input type="date" class="widefat" name="quest_expiration_date" value="<?php echo esc_attr($quest_expiration_date); ?>"/>
    </p>
    <?php
}

function quest_expiration_date_save_meta($post_id)
{
    if (!isset($_POST['expiration_date_nonce']) || !wp_verify_nonce($_POST['expiration_date_nonce'], 'save_expiration_date'))
        return;
    if (!current_user_can('edit_post', $post_id))
        return;
    if (isset($_POST['quest_expiration_date'])) {
        update_post_meta($post_id, 'expiration-date', sanitize_text_field($_POST['quest_expiration_date']));
    }
}

add_action('save_post', 'quest_expiration_date_save_meta');
