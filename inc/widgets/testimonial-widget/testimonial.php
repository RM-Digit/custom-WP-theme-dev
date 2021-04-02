<?php

/**
 * Adds quest_testimonial_widget widget.
*/
add_action('widgets_init', 'quest_testimonial_widget');
function quest_testimonial_widget() {
    register_widget('quest_testimonial_widget_area');
}
class quest_testimonial_widget_area extends Base_Custom_Widget {

    /**
     * Register widget with WordPress.
    **/
    public function __construct() {
        parent::__construct(
            'quest_testimonial_widget_area', __('Quest: Customers Stories Widget Section','quest'), array(
            'description' => __('A widget that shows customer stories posts', 'quest')
        ), $this->widget_fields());
    }

    private function widget_fields() {

        $fields = array(

            'quest_testimonial_top_title' => array(
                'quest_widgets_name' => 'quest_testimonial_top_title',
                'quest_widgets_title' => __('Title', 'quest'),
                'quest_widgets_field_type' => 'title',
            ),

            'quest_testimonial_descriptions' => array(
                'quest_widgets_name' => 'quest_testimonial_descriptions',
                'quest_widgets_title' => __('Descriptions', 'quest'),
                'quest_widgets_field_type' => 'textarea',
            ),

            'quest_testimonial_viewmore' => array(
                'quest_widgets_name' => 'quest_testimonial_viewmore',
                'quest_widgets_title' => __('View More', 'quest'),
                'quest_widgets_field_type' => 'url',
            ),

            'quest_testimonial_number_post' => array(
                'quest_widgets_name' => 'quest_testimonial_number_post',
                'quest_widgets_title' => __('Number of posts to show', 'quest'),
                'quest_widgets_field_type' => 'number',
            ),
        );

        return $fields;
    }
    public function widget($args, $instance) {
        extract($args);
        extract($instance);
        /**
        ** wp query for first block
        **/
        $testimonial_top_title     = empty( $instance['quest_testimonial_top_title'] ) ? '' : $instance['quest_testimonial_top_title'];
        $testimonial_descriptions    = empty( $instance['quest_testimonial_descriptions'] ) ? '' : $instance['quest_testimonial_descriptions'];
        $testimonial_viewmore    = empty( $instance['quest_testimonial_viewmore'] ) ? '#' : $instance['quest_testimonial_viewmore'];
        $testimonial_number_post    = empty($instance['quest_testimonial_number_post']) ? 3 : $instance['quest_testimonial_number_post'];
        $blogs_posts = new WP_Query( array(
            'post_type'           => QUEST_POST_TYPE_CUSTOMER_STORY,
            'posts_per_page'      => $testimonial_number_post,
        ));

        echo wp_kses_post($before_widget);
    ?>

        <div class="testimonial-outer-container">

            <div class="container">

                <div class="block-title">
                    <?php if( !empty( $testimonial_top_title ) ) { ?><h2 class="testimonial-header"><?php echo esc_html( $testimonial_top_title ); ?></h2> <?php } ?>
                    <?php if( !empty( $testimonial_descriptions ) ) { ?><p class="testimonial-desciptions"><?php echo esc_html( $testimonial_descriptions ); ?></p> <?php } ?>
                    <a href="<?php echo esc_url($testimonial_viewmore); ?>" class="btn btn-success"><span>View All<span></a>
                </div>

                <div id="testimonial-area" class="testimonial-area carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                    <?php $count = 0;?>
                    <?php if( $blogs_posts->have_posts() ) : while( $blogs_posts->have_posts() ) : $blogs_posts->the_post(); ?>

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

                    <?php endwhile; endif; wp_reset_query(); ?>
                    </div>
                    <ol class="carousel-indicators">
                        <?php for($i = 0; $i < $count; $i++){
                            echo '<li data-target="#testimonial-area" data-slide-to="'.$i.'"'. ($i == 0 ? ' class="active"' : '') .'></li>';
                        }?>
                    </ol>

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
                 </div>

            </div>

        </div><!-- End Latest Blog -->

    <?php
        echo wp_kses_post($after_widget);
    }
}


