<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package quest
 */

$blog_post_content=get_the_content();

?>

<article <?php post_class('flex-row position-relative'); ?> id="post-<?php the_ID(); ?>">
    <?php edit_post_link(__('<em class="fa fa-edit"><span style="display:none;">Edit</span></em>', 'understrap'), '<span class="edit-link position-absolute">', '</span>'); ?>
    <div class="row flex-grow-1 entry-body">
        <div class="col <?php //flex-grow-1?>">
            <div class="blog-excerpt">
                <header class="entry-header d-flex">
                    <div class="entry-title">
                        <?php the_title(sprintf('<h6><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h6>'); ?>
                    </div>
                </header>
				<div class='post-text'>
					<?php the_excerpt() ?>
				</div>

            </div>
			<p class='custom-author'><?php echo get_the_author_meta('display_name', $author_id); ?></p>
        </div>
    </div>
</article><!-- #post-##1 -->
