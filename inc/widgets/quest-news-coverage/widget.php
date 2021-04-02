<?php
global $post;
$press_releases = get_posts([
	'post_type' => QUEST_POST_TYPE_RESOURCE_PRESS_RELEASE,
	'post_status' => 'publish',
	'numberposts' => 2
]);
$newsletters = get_posts([
	'post_type' => QUEST_POST_TYPE_RESOURCE_NEWSLETTER,
	'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
	'numberposts' => 4
]);

$left_section = ! empty( $instance['left_section'] ) ? $instance['left_section'] : ['title' => '', 'btn_name' => '', 'btn_link' => ''];
$right_section = ! empty( $instance['right_section'] ) ? $instance['right_section'] : ['title' => '', 'btn_name' => '', 'btn_link' => ''];

?>

<div class="news-coverage">
    <div class="container" >
        <div class="news-coverage-content row">
            <div class="left-content col-md-4 col-sm-12">
                <div class="title-content text-center">
                    <h4><?php echo $left_section['title']; ?></h4>
                </div>
                <div class="body-content">
                    <?php foreach ($press_releases as $press_release): ?>
                    <div class="content-item">
                        <div style="padding: 1.78571rem">
                            <div class="d-flex justify-content-between">
                            <div>
                            <p class="news-title">
                                <a href="<?php echo get_permalink($press_release->ID); ?>">
                                <?php
                                    $post_title = $press_release->post_title;
                                ?>
                                    <?php echo $post_title?>
                                </a>
                            </p>
                            </div>
                            <div>
                                <img style="max-width: inherit;" src="<?php echo get_bloginfo('template_url') ?>/img/logo-quest.png" alt="Questsys icon">
                            </div>
                            </div>
                            <div class="entry-summary">
                                <?php
                                $press_release = get_post( $press_release );
                                $post_content = apply_filters( 'get_the_excerpt',$press_release->post_excerpt, $press_release );
                                $count_words_content = str_word_count($post_content);
                                $line_words_content = 20;

                                $temp_content = implode(' ', array_slice(
                                        explode(' ', $post_content), 0, $line_words_content)
                                );

                                $post_content = $count_words_content > $line_words_content ? $temp_content . '...' : $temp_content;
                                ?>
                                <?php echo $post_content?>
                            </div>
                            <footer class="entry-footer" style="padding: 0px">
                                    <div class="readmore text-right">
                                        <a class="btn btn-secondary text-white" href="<?php echo esc_url(get_permalink($press_release));?>">Read More</a>
                                    </div>
                                <?php
                                $term_list = wp_get_post_terms($press_release->ID, QUEST_TAXONOMY_SERVICE);
                                $resources = quest_get_post_types('resources', 'array');
                                $_post_type =  QUEST_POST_TYPE_RESOURCE_PRESS_RELEASE;
                                $symbol2 = !empty($term_list) ? ':' : '';

                                if(!(empty($term_list) && empty($resources[$_post_type]))) {
                                    echo '<div class="footer-content row mx-0">';
                                    if(!empty($resources[$_post_type])){
                                        echo '<span class="newsletter-footer">'. $resources[$_post_type] . $symbol2 . ' </span>';
                                    }
                                    foreach($term_list as $term){
                                        printf( '<span class="service-links"><u>' . esc_html__( '%1$s', 'quest' ) . '</u></span>', '<a href="'.quest_resource_url(['services'=>[$term->slug]]).'">'. $term->name . '</a>'); // WPCS: XSS OKe
                                    }
                                    echo '</div>';
                                }
                                ?>
                            </footer><!-- .entry-footer -->
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="button-view text-center">
                    <a href="<?php echo $left_section['btn_link']; ?>" class="btn btn-success-dark text-white"><?php echo $left_section['btn_name']; ?></a>
                </div>
            </div>

            <div class="col-md-8 col-sm-12">
                <div class="title-content text-center">
                    <h4><?php echo $right_section['title']; ?></h4>
                </div>
                <div class="body-content">
                    <div class="card-columns">
                    <?php foreach ( $newsletters as $post ):?>
                        <?php setup_postdata($post); ?>

                        <?php
                        /**
                         * Run the loop for the search to output the results.
                         * If you want to overload this in a child theme then include a file
                         * called content-search.php and that will be used instead.
                         */
                        global $is_show_footer;
                        $is_show_footer = false;
                        get_template_part('loop-templates/content-resourcenews');
                        ?>
                    <?php endforeach; ?>
                    <?php wp_reset_postdata(); ?>
                    </div>
                </div>
                <div class="button-view text-center">
                    <a href="<?php echo $right_section['btn_link']; ?>" class="btn btn-success-dark text-white"><?php echo $right_section['btn_name']; ?></a>
                </div>
            </div>
        </div>
    </div>
</div>
