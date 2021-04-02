<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package quest
 */
?>
<article class="card article" <?php post_class('position-relative'); ?> id="post-archived-newsletter">
    <div class="card-body">
    <?php edit_post_link('<em class="fa fa-edit"><span style="display:none;">Edit</span></em>', '<span class="edit-link position-absolute">', '</span>'); ?>
    <div class="article-content">
        <header class="entry-header">
            <div class="entry-title">
            <h6 class="mb-2"><a href="<?php echo get_post_type_archive_link(get_post_type());?>" rel="bookmark"><?php echo _e('Archived ', 'quest'); echo get_post_type_object(get_post_type())->label ?></a></h6>
            <p><?php echo _e('Visit our archives to read more.', 'quest');?></p>
            </div>
            <div class="entry-footer text-right">
            <a class="btn btn-secondary text-white" href="<?php echo get_post_type_archive_link(get_post_type());?>" rel="bookmark"><?php echo _e('Visit Our Archives', 'quest');?></a>
            </div>
        </header><!-- .entry-header -->
    </div>
    </div>
</article><!-- #post-##8 -->
