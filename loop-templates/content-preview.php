<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package quest
 */

?>

<article <?php post_class("card position-relative content-preview"); ?> id="post-<?php the_ID(); ?>" style="width: 100% !important;">
    <div class="card-border">
    <header class="entry-header">
        <?php
        $included_post_type = [
            QUEST_POST_TYPE_CEO_BLOG,
            QUEST_POST_TYPE_PARTNER_BLOG,
            QUEST_POST_TYPE_GOVERNMENT_BLOG,
            QUEST_POST_TYPE_SECURITY_BLOG,
            'post',
            'page'
        ];
        ?>
        <?php if (in_array(get_post_type(), $included_post_type)) : ?>
            <div class="entry-thumbnail">
                <?php if (has_post_thumbnail()) {
                    the_post_thumbnail('post-cover');
                } else {
                    echo '<div class="post-cover-image-placeholder"></div>';
                }; ?>
            </div>
        <?php endif; ?>
	    <?php
            $target = '';
            if (get_post_meta(get_the_ID(), 'is-blank-target', true) == 1) {
                $target = 'target="_blank"';
            }
	    ?>
        <div class="entry-body" style="padding-bottom: 0px">
            <?php if(get_post_type()==QUEST_POST_TYPE_RESOURCE_CLIP):  ?>
            <div class="d-flex justify-content-between">
                <div>
                    <?php if (quest_has_posted_on(get_post_type())) : ?>
                        <div class="entry-meta">
                            <?php quest_posted_on(); ?>
                        </div><!-- .entry-meta -->
                    <?php else: ?>
                        <?php quest_posted_icon(); ?>
                    <?php endif; ?>

                    <div class="entry-title" style="min-height: auto">
                        <?php
                        $html_input = "<div class='h6'><a {$target} href='%s' rel='bookmark'>";
                        the_title(sprintf($html_input, esc_url(get_permalink())), '</a></div>');
                        ?>
                    </div>
                </div>
                <div>
                    <img style="max-width: inherit;" src="<?php echo get_bloginfo('template_url') ?>/img/logo-quest.png" alt="Questsys icon">
                </div>
            </div>
            <?php else: ?>
            <?php if (quest_has_posted_on(get_post_type())) : ?>
                <div class="entry-meta">
                    <?php quest_posted_on(); ?>
                </div><!-- .entry-meta -->
            <?php else: ?>
                <?php quest_posted_icon(); ?>
            <?php endif; ?>

            <div class="entry-title" style="min-height: auto">
                <?php
                $html_input = "<div class='h6'><a {$target} href='%s' rel='bookmark'>";
                the_title(sprintf($html_input, esc_url(get_permalink())), '</a></div>');
                ?>
            </div>
            <?php endif; ?>
            <?php global $num_post_type; ?>
            <?php if ('page' == get_post_type()):?>
                <div class="entry-summary">
                    <?php the_excerpt(); ?>
                </div><!-- .entry-summary -->
            <?php elseif (QUEST_POST_TYPE_RESOURCE_CLIP == get_post_type() && $num_post_type == 1) : ?>
                <div class="view-source d-flex align-items-center">
                    <em class="quest-resources-icon icon-internet p-1"></em>
                    <a class="p-1" <?php echo $target; ?> href="<?php echo esc_url(get_permalink()); ?>">View Source</a>
                </div>
                <div class="entry-summary">
                    <?php the_excerpt(); ?>
                </div><!-- .entry-summary -->
<!--                <div class="read-story">-->
<!--                    <a --><?php //echo $target; ?><!--  href="--><?php //echo esc_url(get_permalink()); ?><!--" class="btn btn-secondary">Read Story</a>-->
<!--                </div>-->
            <?php endif; ?>

        </div>
    </header><!-- .entry-header -->
    <?php global $is_show_footer;
    if (isset($is_show_footer) && !$is_show_footer) : ?>
        <footer class="entry-footer">

            <?php quest_entry_footer(); ?>

        </footer><!-- .entry-footer -->
    <?php endif; ?>
    </div>
</article><!-- #post-##6 -->
