<?php
/**
 * Partial template for content in page.php
 *
 * @package understrap
 */
$IS_SUB_CATEGORY_PAGE = false;
if (get_post_type() == 'page') {
    $terms = wp_get_post_terms(get_the_ID(), QUEST_TAXONOMY_SERVICE);
    if (!empty($terms)) foreach ($terms as $_term) {
        if ($IS_SUB_CATEGORY_PAGE === false) {
            $IS_SUB_CATEGORY_PAGE = [$_term->slug];
        } else {
            $IS_SUB_CATEGORY_PAGE[] = $_term->slug;
        }
    }
}
$_salesform = get_post_meta(get_the_ID(), 'quest_salesform_id', true);
$_salesfusion_form_builser = get_post_meta(get_the_ID(), 'quest_salesform_html', true);
$_salesfusion_thanks = htmlentities(get_post_meta(get_the_ID(), 'quest_salesform_thanks_design', true));
?>
<article <?php post_class('position-relative'); ?> id="post-<?php the_ID(); ?>">
    <?php edit_post_link(__('<em class="fa fa-edit"><span style="display:none;">Edit</span></em>', 'understrap'), '<span class="edit-link position-absolute">', '</span>'); ?>
    <?php //echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

    <div class="entry-content">
        <div class="row row-padding">
            <?php if (empty($_salesform) && empty($_salesfusion_form_builser)): ?>
                <div class="col-12">
                    <?php the_content(); ?>
                </div>
            <?php else: ?>
                <div class="col-12 col-md-6 col-lg-7 pr-md-5">
                    <?php the_content(); ?>
                </div>
                <div class="col-12 col-md-6 col-lg-5">
                    <div class="resource-list text-light" style="display: none">
                        <?php
                        // Todo: generate by ajax after submit form and salesfusion
                        /*$tmp = new Quest_Resource_Management();
                        $resource_ids = $tmp->get_resource_ids(get_the_ID());
                        if (empty($resource_ids)) {
                            echo '<h3 class="text-center">Thank you!</h3><p>New resources coming soon...</p>';
                        } else {
                            $_post_type = '';
                            foreach ($resource_ids as $_res_id) {
                                $_post = get_post($_res_id);
                                if ($_post_type != $_post->post_type) {
                                    if ($_post_type != '') {
                                        echo '</ul></div>';
                                    }
                                    $_post_type = $_post->post_type;
                                    $_pt = get_post_type_object($_post_type);
                                    echo '<div class="resource-group"><h5>' . $_pt->label . '</h5><ul class="list-unstyled">';
                                }
                                echo '<li><a href="' . get_permalink($_post->ID) . '"><i class="quest-icon quest-' . $_post_type . '"></i> ' . $_post->post_title . '</a></li>';
                            }
                            if ($_post_type != '') {
                                echo '</ul></div>';
                            }
                        }
                        <script>
                            jQuery(document).on('.resource-list-login form').submit(function () {
                                var $ = jQuery;
                                var _h = $('.resource-list-login').height();
                                $('.resource-list-login').fadeOut('fast', function () {
                                    $('.resource-list').css('min-height', _h).fadeIn('normal');
                                });
                                return false;
                            });
                        </script>*/
                        ?>
                    </div>
                    <div class="resource-list-login">
                        <?php

                        if (!empty($_salesfusion_form_builser)) {
                            $_quest_salesform_redirect_url = get_post_meta(get_the_ID(), 'quest_salesform_redirect_url', true);
                            $dom = new DOMDocument();
                            libxml_use_internal_errors(true);
                            $dom->loadHTML($_salesfusion_form_builser);
                            $xpath = new DOMXPath($dom);

                            global $wp;
                            $names = ['rurl', 'utm_source', 'utm_term', 'utm_campaign'];
                            $data = [];

                            echo "<div class='salesfusion-column' style='text-align: center;'>";
                            echo "<div class=\"salesfusion-form blue-gradient\" data-thanks-form='{$_salesfusion_thanks}'>";

                            $data['rurl'] = !empty($_quest_salesform_redirect_url) ? rel2abs($_quest_salesform_redirect_url, home_url('/')) : '';
                            $data['utm_source'] = home_url($wp->request);
                            $data['utm_term'] = get_the_title();

                            $categories = [];
                            $terms = wp_get_post_terms(get_the_ID(), QUEST_TAXONOMY_SERVICE);
                            if (!empty($terms)) foreach ($terms as $_term) {
                                if (empty($categories)) {
                                    $categories = [$_term->name];
                                } else {
                                    $categories[] = $_term->name;
                                }
                            }

                            $data['utm_campaign'] = implode(', ', $categories);

                            foreach ($names as $name) {
                                $node = $xpath->query("//input[@name=\"{$name}\"]")->item(0);

                                if (!empty($node) && !empty($data[$name])) {
                                    $node->setAttribute('value', $data[$name]);
                                }
                            }

                            echo $dom->saveHTML();
                            echo "</div>";
                            echo "</div>";
                        } elseif (!empty($_salesform)) {
                            $_salesform_width = get_post_meta(get_the_ID(), 'quest_salesform_width', true);
                            $_salesform_height = get_post_meta(get_the_ID(), 'quest_salesform_height', true);
                            echo '<iframe class="salesfusion-form" width="' . $_salesform_width . '" height="' . $_salesform_height . '" src="' . $_salesform . '" frameborder="0" scrolling="no"></iframe>';
                        }
                        ?>
                    </div>
                </div>
                <?php
                /*wp_link_pages( array(
                    'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
                    'after'  => '</div>',
                ) );*/
                ?>
            <?php endif; ?>

        </div><!-- .entry-content -->

    </div>
</article><!-- #post-##5 -->
<?php if ($IS_SUB_CATEGORY_PAGE !== false): ?>

</main>
</div>
</div>
</div><?php # Close container to make the related services is full width;?>
<div class="related-services">
    <div>
        <div>
            <main><?php # Reopen the container?>
                <div class="widget_quest-list-posts">
                    <?php
                    $title = get_option('quest_title_relate_service_id');
                    $content = get_option('quest_content_relate_service_id');
                    $title_html = '<h2 class="text-center mb-2">' . $title . '</h2><p class="text-center mb-5" style="font-size: 1.1rem;">' . $content . '</p>';
                    quest_list_post_shortcode(['services' => $IS_SUB_CATEGORY_PAGE, 'post_type' => quest_relate_service_post_type(), 'posts_per_page' => 3, 'title' => $title_html, 'button-text' => __('View All', 'quest'), 'is_show_footer' => false,'exclude_resource'=>true]);
                    ?>
                </div>
                <?php endif; ?>

