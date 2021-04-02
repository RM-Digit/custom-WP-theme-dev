<?php
$testimonial_top_title = empty( $instance['quest_testimonial_top_title'] ) ? '' : $instance['quest_testimonial_top_title'];
$testimonial_descriptions = empty( $instance['quest_testimonial_descriptions'] ) ? '' : $instance['quest_testimonial_descriptions'];
$testimonial_viewmore = empty( $instance['quest_testimonial_viewmore'] ) ? '#' : $instance['quest_testimonial_viewmore'];
$slider =  empty( $instance['slider'] ) ? [] : $instance['slider'];
$posts_id = [];
foreach ($slider as $item) {
	$posts_id[] = (int) filter_var($item['customer_story'], FILTER_SANITIZE_NUMBER_INT);
}

$args = array(
	'post_type' => QUEST_POST_TYPE_CUSTOMER_STORY,
	'post__in' => $posts_id,
	'orderby' => 'post__in',
);
$query = new WP_Query( $args );

?>
<div class="testimonial-outer-container">

    <div class="container">

        <div class="block-title">
			<?php if( !empty( $testimonial_top_title ) ) { ?><h2 class="testimonial-header"><?php echo esc_html( $testimonial_top_title ); ?></h2> <?php } ?>
			<?php if( !empty( $testimonial_descriptions ) ) { ?><p class="testimonial-desciptions"><?php echo esc_html( $testimonial_descriptions ); ?></p> <?php } ?>
            <a href="<?php echo esc_url($testimonial_viewmore); ?>" class="btn btn-success-dark">View All</a>
        </div>

        <div id="testimonial-area" class="testimonial-area carousel slide" data-ride="carousel">
            <button id='quest-slider-btn' class="slider-btn-container">
                <span class="sr-only">Play button</span>
                <em id='quest-slider-icon' class='fa fa-pause'></em>
            </button>
            <a class="carousel-control-prev" href="#testimonial-area" role="button" data-slide="prev">
                        <span>
                        <em class="fa fa-chevron-left" aria-hidden="true"></em>
                        </span>
                <span style="display:none;">Previous</span>
            </a>
            <a class="carousel-control-next" href="#testimonial-area" role="button" data-slide="next">
                        <span>
                        <em class="fa fa-chevron-right" aria-hidden="true"></em>
                        </span>
                <span style="display:none;">Next</span>
            </a>
            <div class="carousel-inner">
				<?php $count = 0;?>
				<?php if( $query->have_posts() ) : while( $query->have_posts() ) : $query->the_post(); ?>

                    <div class="testimonial-preview-item carousel-item <?php echo !$count ? 'active': ''; $count++;?>">
                        <div class="row mx-0">
							<?php
							if( has_post_thumbnail() ){
								$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'medium', true);

								?>
                                <div class="col-lg-6 px-0">
                                    <a href="<?php echo esc_url(get_permalink());?>">
                                        <img style="width: 100%" alt="Customers stories" title="<?php the_title( ); ?>" src="<?php echo esc_url( $image[0] ); ?>">
                                    </a>
                                </div>
							<?php } ?>
                            <div class="testimonial-preview-info col-lg-6">
                                <h2><a href="<?php echo esc_url(get_permalink());?>"><?php the_title(); ?></a></h2>
                                <div class="testimonial-preview_desc">

									<?php if (has_excerpt()){
										the_excerpt();
									} ?>
                                </div>
                            </div>
                        </div>
                    </div>

				<?php endwhile; endif; wp_reset_postdata(); ?>
            </div>
            <ol class="carousel-indicators">
				<?php for($i = 0; $i < $count; $i++){
					echo '<li data-target="#testimonial-area" data-slide-to="'.$i.'"'. ($i == 0 ? ' class="active"' : '') .'></li>';
				}?>
            </ol>
        </div>

    </div>

</div><!-- End Latest Blog -->