<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package quest
 */
?>
<?php
$article_post_type = get_post_type();
$customer_portrait = wp_get_attachment_url(get_post_meta(get_the_ID(), 'quest-customer-portrait', true));
?>
<article style="width: 100%!important;" <?php post_class('customer-stories article mb-3 position-relative'); ?> id="post-<?php the_ID(); ?>">
    <div class="row" style="padding: 0px; display: flex; align-items: center;">
        <div class="article-thumbnail col-md-2 col-12">
            <img src="<?php echo !empty($customer_portrait) ? $customer_portrait : ''; ?>" alt="Customer portrait">
        </div>
        <div class="col-12 col-md-10" style="padding-left: 2rem;">
            <header class="entry-header d-flex justify-content-between">
                <div>
                    <div class="entry-title">
                        <?php the_title(sprintf('<h6><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h6>'); ?>
                    </div>
                </div>
            </header><!-- .entry-header -->
            <?php if ($article_post_type != 'post'): ?>
                <div class="entry-summary sub-header">
                    <?php
                    $press_release = get_post();
                    $post_content = apply_filters( 'get_the_excerpt',$press_release->post_content, $press_release );
                    $count_words_content = str_word_count($post_content);
                    $line_words_content = 100;

                    $temp_content = implode(' ', array_slice(
                            explode(' ', $post_content), 0, $line_words_content)
                    );

                    $post_content = $count_words_content > $line_words_content ? strip_tags($temp_content) . '...' : strip_tags($temp_content);
                    ?>
                    <?php echo $post_content?>
                </div><!-- .entry-summary -->
            <?php endif; ?>
            <footer class="entry-footer">
                <?php quest_entry_footer(false); ?>
            </footer><!-- .entry-footer -->
        </div>
    </div>
</article><!-- #post-##2 -->