<?php
$title = ! empty( $instance['title'] ) ? esc_attr($instance['title']) : '';

$block_repeater = ! empty( $instance['block_repeater'] ) ? $instance['block_repeater'] : array();

?>

<div class="contact-further-information">
    <div class="container" >
        <h4 class="widget-header"><?php echo $title; ?></h4>
        <div class="row">
            <?php
                $col = count($block_repeater) < 5 ? (12/count($block_repeater)) : 3;
                foreach ($block_repeater as $item) :?>
            <?php
                if (!empty($item['action_link']['action_type'])) {
                    switch ($item['action_link']['action_type']) {
                        case 'url':
                            $action = esc_url($item['action_link']['action_value']);
                            break;
                        case 'email':
                            $action = "mailto:{$item['action_link']['action_value']}";
                            break;
                        default:
                            $action = '#';

                    }
                }
            ?>
                <div class="col-lg-<?php echo $col; ?> col-md-<?php echo $col; ?> item-block">
                    <div class="item-block-content">
                        <div class="block-header">
                            <a href="<?php echo $action; ?>">
                                <img alt="Image of <?php echo $item['action_link']['action_label']; ?>" src="<?php echo wp_get_attachment_image_src($item['block_icon'])[0]; ?>"/>
                                <p><?php echo $item['action_link']['action_label']; ?></p>
                            </a>
                        </div>
                        <div class="block-description">
                            <span><?php echo $item['block_description']; ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>