<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package quest
 */
?>
<?php $article_post_type = get_post_type();?>
<article style="width: 100% !important" class="card article newsletter" <?php //post_class('card article newsletter position-relative'); ?> id="post-<?php the_ID(); ?>">
    <div class="card-body">
        <?php edit_post_link('<em class="fa fa-edit"><span style="display:none;">Edit</span></em>', '<span class="edit-link position-absolute">', '</span>'); ?>
        <div class="article-content">
            <div class="row mx-0">
                <div class="col-md-5 px-0">
                    <div class="article-thumbnail">
                        <a href="<?php echo esc_url( get_permalink() );?>" rel="bookmark">
                            <span class="sr-only">Post thumbnail</span>
                            <?php quest_posted_thumbnail();?>
                        </a>
                    </div>
                </div>
                <div class="col-md-7 newsletter-item-content pl-md-3 px-0">
                    <header class="entry-header">
                        <?php if($article_post_type == QUEST_POST_TYPE_RESOURCE_NEWSLETTER):?>
                            <div class="newsletter-quater">
                                <?php
                                $post_time = get_the_date('Y');
                                if(2012 < $post_time)
                                    $post_time = $post_time . ' Q'. ceil(get_the_date('m')/3);
                                ?>
                                <p class="news-quater"><?php echo $post_time; ?></p>
                            </div>
                        <?php endif;?>
                        <?php if ( quest_has_posted_on($article_post_type) && ($article_post_type == QUEST_POST_TYPE_CEO_BLOG || $article_post_type == QUEST_POST_TYPE_PARTNER_BLOG || $article_post_type == QUEST_POST_TYPE_GOVERNMENT_BLOG || $article_post_type == QUEST_POST_TYPE_SECURITY_BLOG) ) : ?>
                            <div class="newsletter-quater">
                                <?php quest_posted_on(); ?>
                            </div><!-- .entry-meta -->
                        <?php endif; ?>

                        <div class="entry-title">
                            <?php $targetBlank = in_array($article_post_type, get_all_target_blank_post_types()) ? 'target="_blank"' : ''; ?>
                            <?php the_title( sprintf( '<h6><a href="%s" rel="bookmark" %s>', esc_url( get_permalink() ), $targetBlank ), '</a></h6>' ); ?>
                        </div>
                    </header><!-- .entry-header -->
                </div>
	            <?php global $is_show_footer;
	            if (isset($is_show_footer) && !$is_show_footer) : ?>
                <footer class="entry-footer">
                    <?php quest_entry_footer(); ?>
                </footer><!-- .entry-footer -->
                <?php endif; ?>
            </div>
        </div>
    </div>
</article><!-- #post-##7 -->
