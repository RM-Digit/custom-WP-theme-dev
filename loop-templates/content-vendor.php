<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package quest
 */

?>

<article class="vendor-card" <?php post_class(); ?> id="post-<?php the_ID(); ?>">
    <div class="card-thumbnail">
        <?php quest_posted_thumbnail();?>
    </div>
    <div class="card-content">
        <header class="entry-header">
            <div class="entry-title">
                <?php the_title('<h5>', '</h5>' ); ?>
            </div>
        </header><!-- .entry-header -->
        <?php if( 'post' != get_post_type() ):?>
            <div class="entry-summary">
                <?php the_content(); ?>
            </div><!-- .entry-summary -->
        <?php endif; ?>
    </div>
</article><!-- #post-##13 -->
