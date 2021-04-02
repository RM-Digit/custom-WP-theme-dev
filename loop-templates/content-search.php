<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package quest
 */
?>
<?php $article_post_type = get_post_type();?>
<article class="card article" <?php post_class('position-relative'); ?> id="post-<?php the_ID(); ?>">
    <div class="card-body">
    <?php edit_post_link('<em class="fa fa-edit"><span style="display:none;">Edit</span></em>', '<span class="edit-link position-absolute">', '</span>'); ?>
	<?php if ( in_array($article_post_type, array('post', QUEST_POST_TYPE_CEO_BLOG, QUEST_POST_TYPE_PARTNER_BLOG,QUEST_POST_TYPE_GOVERNMENT_BLOG, QUEST_POST_TYPE_SECURITY_BLOG)) ) : ?>
    <div class="article-thumbnail">
        <?php quest_posted_thumbnail();?>
    </div>
    <?php endif;?>
    <?php
    $target = '';
    if (get_post_meta(get_the_ID(), 'is-blank-target', true) == 1) {
        $target = 'target="_blank"';
    }
    ?>
    <div class="article-content">
        <header class="entry-header d-flex justify-content-between">
            <div>
                <?php if (quest_has_posted_on($article_post_type)) : ?>
                    <div class="entry-meta">
                        <?php quest_posted_on(); ?>
                    </div><!-- .entry-meta -->
                <?php endif; ?>
                <?php quest_posted_icon(); ?>
                <div class="entry-title">
                    <?php the_title(sprintf('<h6><a href="%s" rel="bookmark" %s>', esc_url(get_permalink()), $target), '</a></h6>'); ?>
                </div>
            </div>
            <?php if ( in_array($article_post_type, array(QUEST_POST_TYPE_RESOURCE_PRESS_RELEASE, QUEST_POST_TYPE_RESOURCE_CLIP)) ) : ?>
            <div>
                <img style="max-width: inherit;" src="<?php echo get_bloginfo('template_url') ?>/img/logo-quest.png" alt="Questsys icon">
            </div>
            <?php endif; ?>
        </header><!-- .entry-header -->
        <?php if (QUEST_POST_TYPE_RESOURCE_CLIP == get_post_type()) : ?>
            <div class="clip-view-source">
                <em class="quest-resources-icon icon-internet"></em>
                <a <?php echo $target; ?> href="<?php echo esc_url(get_permalink()); ?>">View Source</a>
            </div>
        <?php endif;?>
        <?php if($article_post_type !='post'):?>
            <div class="entry-summary sub-header">
                <?php if($article_post_type == QUEST_POST_TYPE_RESOURCE_PRESS_RELEASE){
                    quest_resource_excerpt();
                } else {
                    the_excerpt();
                }?>
            </div><!-- .entry-summary -->
        <?php endif; ?>
        <footer class="entry-footer">
            <?php if($article_post_type == QUEST_POST_TYPE_RESOURCE_PRESS_RELEASE):?>
                <div class="readmore text-right">
                    <a class="btn btn-secondary text-white" href="<?php echo esc_url(get_permalink());?>">Read More</a>
                </div>
            <?php endif;?>
            <?php quest_entry_footer(); ?>
        </footer><!-- .entry-footer -->
    </div>
    </div>
</article><!-- #post-##11 -->
