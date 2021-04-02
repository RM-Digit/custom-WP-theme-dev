<?php
$left_content = ! empty( $instance['left_content'] ) ? $instance['left_content'] : array();

$sizeOfContent = empty(sizeof($left_content)) ? 1 : sizeof($left_content);

$all_column_size = 12 / $sizeOfContent;

?>

<div class="partner-login">
    <div class="container" >
        <div class="partner-login-content">
            <div class="row">
                <?php foreach ($left_content as $item) : ?>
                <div class="col-12 col-md-<?php echo $all_column_size; ?> text-center left-block-item">
                    <div class="left-content">
                        <div class="top-content">
                            <div class="title mb-4">
                                <h4 class="text-primary" style="text-align: left"><?php echo $item['title']; ?></h4>
                            </div>
                            <div class="description" style="text-align: left">
                                <p><?php echo $item['description']; ?></p>
                            </div>
                        </div>
                        <div class="button mt-4">
                            <a href="<?php echo $item['redirect_button']['btn_url']; ?>"
                               class="btn <?php echo $item['redirect_button']['btn_color']; ?>"><?php echo $item['redirect_button']['btn_name']; ?></a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
