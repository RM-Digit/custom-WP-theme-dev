<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package quest
 */

$blog_post_thumbnail=get_the_post_thumbnail_url();

// resize if thumbnail exists
if ($blog_post_thumbnail)
    $blog_post_thumbnail=resizeImageByURL($blog_post_thumbnail,'320x213');

$blog_post_content=get_the_content();

// try to extract the image from the post content if the thumbnail does not exist
if (!$blog_post_thumbnail && $blog_post_content && strlen($blog_post_content)>10) {

    $post_images = array();
    
    // Get image
    preg_match('@<img.*src="([^"]+)"@', $blog_post_content, $image_match);

    if (count($image_match)>1) {
        $blog_post_thumbnail=resizeImageByURL($blog_post_thumbnail,'320x213');
    }
}


?>

<article <?php post_class('flex-row position-relative'); ?> id="post-<?php the_ID(); ?>">
    <?php edit_post_link(__('<em class="fa fa-edit"><span style="display:none;">Edit</span></em>', 'understrap'), '<span class="edit-link position-absolute">', '</span>'); ?>
    <div class="row flex-grow-1 entry-body">
        <?php
            if ($blog_post_thumbnail) {
        ?>
        <div class="col blog-thumbnail">
            <div <?php // class="mb-4" ?>>
				<a href='<?php echo the_permalink() ?>'><img class="alignnone size-medium wp-image-11040" title="<?php echo get_the_title(); ?>" src="<?php echo $blog_post_thumbnail; ?>" alt="<?php echo get_the_title(); ?>" /></a>
            </div>
        </div>
        <?php } ?>
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
