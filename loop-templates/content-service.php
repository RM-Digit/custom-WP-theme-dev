<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package quest
 */

?>

<article <?php post_class('card flex-row position-relative'); ?> id="post-<?php the_ID(); ?>">
    <?php edit_post_link(__('<em class="fa fa-edit"><span style="display:none;">Edit</span></em>', 'understrap'), '<span class="edit-link position-absolute">', '</span>'); ?>
        <div class="entry-thumbnail">
            <?php
            if(has_post_thumbnail()){
                the_post_thumbnail('thumbnail');
            }
            ?>
        </div>
        <div class="flex-grow-1 entry-body">
            <header class="entry-header">
                <?php if ( quest_has_posted_on(get_post_type()) ) : ?>

                    <div class="entry-meta">
                        <?php quest_posted_on(); ?>
                    </div><!-- .entry-meta -->
                <?php endif; ?>
                <?php quest_posted_icon(); ?>
                <div class="entry-title">
                    <?php the_title( sprintf( '<h6><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h6>' ); ?>
                </div>
            </header><!-- .entry-header -->
            <?php if( true || 'post' != get_post_type() ):?>
                <div class="entry-summary">
                    <?php the_excerpt(); ?>
                </div><!-- .entry-summary -->
            <?php endif; ?>
            <footer class="entry-footer">
                <?php quest_entry_footer(); ?>
            </footer><!-- .entry-footer -->
        </div>

</article><!-- #post-##12 -->
