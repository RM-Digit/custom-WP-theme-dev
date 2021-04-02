<?php
$title = ! empty( $instance['title'] ) ? esc_attr($instance['title']) : '';
$description = ! empty( $instance['description'] ) ? esc_attr($instance['description']) : '';
$bg_image = ! empty( $instance['bg_image'] ) ? $instance['bg_image '] : '';
$button = ! empty( $instance['button'] ) ? $instance['button'] : ['btn_name' => '', 'btn_link' => ''];
$vendors = ! empty( $instance['vendors'] ) ? $instance['vendors'] : [];
?>

<div class="vendor-partner">
    <div class="container" >
        <div class="vendor-content">
            <div class="text-content text-center">
                <h4 class="widget-header"><?php echo $title; ?></h4>
                <p class="widget-description"><?php echo $description; ?></p>
                <a class="btn btn-success text-white" href="<?php echo $button['btn_link']; ?>"><?php echo $button['btn_name']; ?></a>
            </div>

            <div class="row">
                <div class="col-md-12 heroSlider-fixed">
                    <button id='quest-slider-btn' class="slider-btn-container">
                        <span class="sr-only">Play button</span>
                        <em id='quest-slider-icon' class='fa fa-pause'></em>
                    </button>
                    <!-- control arrows -->
                    <button class="prev">
                        <span class="sr-only">Previous button</span>
                        <em class="fa fa-chevron-left"></em>
                    </button>
                    <button class="next">
                        <span class="sr-only">Next button</span>
                        <em class="fa fa-chevron-right"></em>
                    </button>
                    <div class="overlay">
                    </div>
                    <!-- Slider -->
                    <div class="slider responsive">
				        <?php foreach ($vendors as $vendor): ?>
                            <div class="slider-item">
                                <div class="d-flex align-items-center">
                                    <img alt='Logo of <?php echo get_the_title($vendor) ?>' class="mx-auto" src="<?php echo get_the_post_thumbnail_url($vendor); ?>">
                                </div>
                            </div>
				        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
