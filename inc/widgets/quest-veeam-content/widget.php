<div class="container">
    <div class="row veeam-content">
        <div class="col-lg-7 col-md-6 veeam-content-left">
            <?php echo $instance['content'];?>
        </div>
        <div class="col-lg-5 col-md-6 veeam-content-right px-md-0" <?php echo (!empty($instance['iframe_margin_top']) ? ('style="margin-top:' . $instance['iframe_margin_top'] .'px;"') : '');?> >
            <div class="salesfusion-iframe">
            </div>
        </div>
    </div>
</div>
