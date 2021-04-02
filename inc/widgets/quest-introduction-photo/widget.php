<?php
if (!empty($instance['ratio'])) {
    $ratio = $instance['ratio'];
} else {
    $ratio = 6;
}
$row_class = !empty($instance['v-align']) ? 'align-items-' . $instance['v-align'] : '';
$row_class .= !empty($instance['mobile-order']) ? ' reverse-item' : '';

$left_class = 'col-md-' . $ratio;
$right_class = 'col-md-' . (12 - $ratio);
?>
<div class="bounder two-column-widget <?php if ($ratio == 12) : ?>only-one-column-container<?php endif; ?>" style="">
    <div class="container">
        <div class="row <?php echo $row_class;?>">
            <?php if ($ratio == 12) : ?>
            <div class="col-12 only-one-column left-content quest-vertical-center">
                <div><?php echo $instance['title']; ?></div>
            </div>
	        <?php else: ?>
            <div class="col-12 <?php echo $left_class; ?> left-content quest-vertical-center">
                <div><?php echo $instance['title']; ?></div>
            </div>
            <div class="col-12 <?php echo $right_class; ?> right-content quest-vertical-center">
                <div><?php echo $instance['content']; ?></div>
            </div>
	        <?php endif; ?>
        </div>
    </div>
</div>