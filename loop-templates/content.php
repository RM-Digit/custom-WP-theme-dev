<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package quest
 */

?>

<article class="card" <?php post_class('position-relative'); ?> id="post-<?php the_ID(); ?>">
    <?php edit_post_link(__('<em class="fa fa-edit"><span style="display:none;">Edit</span></em>', 'understrap'), '<span class="edit-link position-absolute">', '</span>'); ?>
	<header class="entry-header">
        <div class="entry-thumbnail">
            <?php quest_posted_thumbnail();?>
        </div>
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
    <?php if( 'post' != get_post_type() ):?>
        <div class="entry-summary">
            <?php the_excerpt(); ?>
        </div><!-- .entry-summary -->
    <?php endif; ?>
	<footer class="entry-footer">

		<?php quest_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-##15 -->
