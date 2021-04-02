<?php
$id = esc_attr($this->get_field_id($quest_widgets_name));
$name = esc_attr($this->get_field_name($quest_widgets_name));
$title = $quest_widgets_title;
$value = wp_get_attachment_image_src($quest_field_value, 'large')[0];

$class = $value ? 'has-file' : '';
?>
<div class="sub-option section widget-upload" style="margin: 13px 0px">
    <label for="<?php echo $id; ?>">
        <strong><?php echo $quest_widgets_title; ?>:</strong>
    </label><br />
    <input class="upload <?php echo esc_attr($class); ?>" type="text"
        id="<?php echo $id; ?>" style="display:none;"
        name="<?php echo $name; ?>"
        value="<?php echo $value; ?>"
        placeholder="<?php esc_html_e('No file chosen', 'quest'); ?>" />

    <?php if (function_exists('wp_enqueue_media')) : ?>
        <?php if (( $value == '')) : ?>
            <input
                id="upload-<?php echo $id; ?>"
                class="upload-button-wdgt button" type="button"
                value="<?php esc_html_e('Upload', 'quest'); ?>" />
        <?php else: ?>
            <input
                id="remove-<?php echo $id; ?>"
                class="remove-file button" type="button"
                value="<?php esc_html_e('Remove', 'quest'); ?>" />
        <?php endif; ?>
    <?php else: ?>
        <p><i><?php esc_html_e('Upgrade your version of WordPress for full media support.', 'quest'); ?></i></p>
    <?php endif; ?>

    <div class="screenshot team-thumb" style="margin: 7px 0px" id="<?php echo $id; ?>-image">
        <?php if ($value != '') : ?>
            <?php $image = preg_match('/(^.*\.jpg|jpeg|png|gif|ico*)/i', $value) ?>
            <?php if ($image) : ?>
                <img src="<?php echo $value?>" style="width:35%" alt="" /> <br>
                <a class="remove-image" style="cursor: pointer"><?php esc_html_e( 'Remove', 'quest' ); ?></a>
            <?php else: ?>
                <?php
                    $parts = explode("/", $value);
                    for ($i = 0; $i < sizeof($parts); ++$i) {
                        $title = $parts[$i];
                    }
                ?>
                <div class="no-image">
                    <span class="file_link">
                        <a href="<?php esc_url($value); ?>" target="_blank" rel="external">
                            <?php esc_html_e('View File', 'quest'); ?>
                        </a>
                    </span>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <?php if ($quest_widgets_description != '') : ?>
        <p><small><?php echo $quest_widgets_description; ?></small></p>
    <?php endif; ?>
</div>
