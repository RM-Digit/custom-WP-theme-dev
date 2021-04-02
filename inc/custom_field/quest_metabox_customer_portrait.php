<?php

function quest_meta_box_customer_portrait()
{
    add_meta_box(
        'quest-customer-portrait',
        __('Customer Portrait', 'quest'),
        'quest_meta_output_customer_portrait',
	    QUEST_POST_TYPE_CUSTOMER_STORY,
        'side',
        'high'
    );
}

add_action('add_meta_boxes', 'quest_meta_box_customer_portrait');

function quest_meta_output_customer_portrait($post)
{

    wp_nonce_field('save_customer_portrait', 'customer_portrait_nonce'); ?>

    <?php
    $quest_customer_portrait = get_post_meta($post->ID, 'quest-customer-portrait', true);
    ?>
    <div class="sub-option section widget-upload" style="margin: 13px 0px; text-align: center">
        <input class="upload ?>" type="text"
               id="quest-customer-portrait" style="display:none;"
               name="quest_customer_portrait"
               value="<?php echo $quest_customer_portrait; ?>"
               placeholder="<?php esc_html_e('No file chosen', 'quest'); ?>" />

		<?php if (function_exists('wp_enqueue_media')) : ?>
			<?php if (( $quest_customer_portrait == '')) : ?>
                <input
                        id="upload-customer-button"
                        class="upload-button-wdgt button" type="button"
                        value="<?php esc_html_e('Upload', 'quest'); ?>" />
			<?php else: ?>
                <input
                        id="remove-customer-portrait; ?>"
                        class="remove-file button" type="button"
                        value="<?php esc_html_e('Remove', 'quest'); ?>" />
			<?php endif; ?>
		<?php else: ?>
            <p><i><?php esc_html_e('Upgrade your version of WordPress for full media support.', 'quest'); ?></i></p>
		<?php endif; ?>

        <div class="screenshot team-thumb" style="margin: 7px 0px">
			<?php if ($quest_customer_portrait != '') : ?>
				<?php $image = preg_match('/(^.*\.jpg|jpeg|png|gif|ico*)/i', wp_get_attachment_url($quest_customer_portrait));?>
				<?php if ($image) : ?>
                    <img src="<?php echo wp_get_attachment_url($quest_customer_portrait)?>" style="width:60%" alt="" /> <br>
                    <a class="remove-image" style="cursor: pointer"><?php esc_html_e( 'Remove', 'quest' ); ?></a>
				<?php else: ?>
					<?php
					$parts = explode("/", $quest_customer_portrait);
					for ($i = 0; $i < sizeof($parts); ++$i) {
						$title = $parts[$i];
					}
					?>
                    <div class="no-image">
                    <span class="file_link">
                        <a href="<?php esc_url(wp_get_attachment_url($quest_customer_portrait)); ?>" target="_blank" rel="external">
                            <?php esc_html_e('View File', 'quest'); ?>
                        </a>
                    </span>
                    </div>
				<?php endif; ?>
			<?php endif; ?>
        </div>
    </div>
    <?php
}

function quest_customer_portrait_save_meta($post_id)
{
    if (!isset($_POST['customer_portrait_nonce']) || !wp_verify_nonce($_POST['customer_portrait_nonce'], 'save_customer_portrait'))
        return;
    if (!current_user_can('edit_post', $post_id))
        return;
    if (isset($_POST['quest_customer_portrait'])) {
        update_post_meta($post_id, 'quest-customer-portrait', sanitize_text_field($_POST['quest_customer_portrait']));
    }
}

add_action('save_post', 'quest_customer_portrait_save_meta');

function customer_portrait_admin_scripts() {
	wp_enqueue_media();
}

add_action('admin_enqueue_scripts', 'customer_portrait_admin_scripts');
