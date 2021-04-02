<?php

function meta_box_salesfusion()
{
	$post_type = quest_all_resources_post_type();
	array_push($post_type, 'page', QUEST_POST_TYPE_EVENT);

    add_meta_box(
        'salesfusion',
        __('Salesfusion', 'quest'),
        'meta_output_salesfusion',
	    $post_type,
        'advanced',
        'high'
    );
}

add_action('add_meta_boxes', 'meta_box_salesfusion');

function meta_output_salesfusion($post)
{

    wp_nonce_field('save_salesfusion_post', 'salesfusion_post_nonce');

    if (quest_is_support_salesfusion_form($post->post_type)) :
        $quest_salesform_id = get_post_meta($post->ID, 'quest_salesform_id', true);
        $quest_salesform_width = get_post_meta($post->ID, 'quest_salesform_width', true);
        $quest_salesform_height = get_post_meta($post->ID, 'quest_salesform_height', true);
	    $quest_salesform_html = get_post_meta($post->ID, 'quest_salesform_html', true);
	    $quest_salesform_redirect_url =  get_post_meta($post->ID, 'quest_salesform_redirect_url', true);
	    $quest_salesform_thanks_design =  get_post_meta($post->ID, 'quest_salesform_thanks_design', true);
        if (empty($quest_salesform_width)) $quest_salesform_width = '100%';
        if (empty($quest_salesform_height)) $quest_salesform_height = '400px';
    ?>

    <fieldset class="salesfusion-form-box"  style="border: 1px solid #ccc; padding: 10px; margin-bottom: 20px;">
        <legend><b><?php _e('Using the Form builder:', 'quest'); ?></b></legend>
        <label for="quest_salesform_html"><?php _e('HTML editor', 'quest'); ?></label><br/>
        <textarea class="widefat" name="quest_salesform_html" rows="10"><?php echo esc_attr($quest_salesform_html); ?></textarea>
        <p>
            <label for="quest_salesform_redirect_url"><?php _e('Redirect URL', 'quest'); ?></label><br/>
            <input type="text" class="widefat" name="quest_salesform_redirect_url"
                   value="<?php echo esc_attr($quest_salesform_redirect_url); ?>"/>
        </p>
        <div>
            <label for="quest_salesform_html"><?php _e('Thank you form', 'quest'); ?></label><br/>
	        <?php wp_editor($quest_salesform_thanks_design, 'quest_salesform_thanks_design', array(
		        'wpautop'               => true,
		        'textarea_name' =>      'quest_salesform_thanks_design',
		        'textarea_rows' =>      5
	        )); ?>
            <small style="color: red;"><i>If its content is existed, thank you message will be instead of salesfusion form without redirect to thank you page.</i></small>
        </div>
    </fieldset>

    <fieldset class="salesfusion-iframe-box"  style="border: 1px solid #ccc; padding: 10px">
        <legend><b><?php _e('Using the Iframe:', 'quest'); ?></b></legend>
        <small style="color: red;"><i>Only display when Form Builder is empty.</i></small>
        <p>
            <label for="quest_salesform_id"><?php _e('Salesfusion URL', 'quest'); ?></label><br/>
            <input type="text" class="widefat" name="quest_salesform_id"
                   value="<?php echo esc_attr($quest_salesform_id); ?>"/>
        </p>
        <div class="row">
        <div class="col-6">
            <label for="quest_salesform_width"><?php _e('Width', 'quest'); ?></label><br/>
            <input type="text" class="widefat" name="quest_salesform_width"
                   value="<?php echo esc_attr($quest_salesform_width); ?>"/>
        </div>
        <div class="col-6">
            <label for="quest_salesform_height"><?php _e('Height', 'quest'); ?></label><br/>
            <input type="text" class="widefat" name="quest_salesform_height"
                   value="<?php echo esc_attr($quest_salesform_height); ?>"/>
        </div>
        </div>
    </fieldset>

<?php endif; ?>
    <?php
}

function salesfusion_save_meta($post_id)
{
    if (!isset($_POST['salesfusion_post_nonce']) || !wp_verify_nonce($_POST['salesfusion_post_nonce'], 'save_salesfusion_post'))
        return;

    if (!current_user_can('edit_post', $post_id))
        return;

    $_post_type = get_post_type($post_id);

    if (quest_is_support_salesfusion_form($_post_type)) {
        $quest_salesform_html = preg_replace('/(<(style)\b[^>]*>).*?(<\/\2>)/s', "$1$3", keep_html_form($_POST['quest_salesform_html']));
        $_POST['quest_salesform_id']=str_replace('http://','https://',$_POST['quest_salesform_id']);
        update_post_meta($post_id, 'quest_salesform_id', sanitize_text_field($_POST['quest_salesform_id']));
        update_post_meta($post_id, 'quest_salesform_width', sanitize_text_field($_POST['quest_salesform_width']));
        update_post_meta($post_id, 'quest_salesform_height', sanitize_text_field($_POST['quest_salesform_height']));
	    update_post_meta($post_id, 'quest_salesform_html', $quest_salesform_html);
	    update_post_meta($post_id, 'quest_salesform_redirect_url', sanitize_text_field($_POST['quest_salesform_redirect_url']));
	    update_post_meta($post_id, 'quest_salesform_thanks_design', $_POST['quest_salesform_thanks_design']);
    }
}

function keep_html_form ($content = '')
{
	$newcontent = remove_html_comments($content);
	$newcontent = remove_html_scripts($newcontent);
	$newcontent = remove_html_styles($newcontent);

	return preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $newcontent);
}

function remove_html_comments($content = '')
{
	return preg_replace('/<!--(.|\s)*?-->/', '', $content);
}

function remove_html_scripts($content = '')
{
	return preg_replace('#<script(.*?)>(.*?)</script>#is', '', $content);
}

function remove_html_styles($content = '')
{
	return preg_replace('#<style(.*?)>(.*?)</style>#is', '', $content);
}

add_action('save_post', 'salesfusion_save_meta');
