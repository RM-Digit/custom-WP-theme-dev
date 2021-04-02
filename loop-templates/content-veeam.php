<article <?php post_class('position-relative'); ?> id="post-<?php the_ID(); ?>">
    <?php edit_post_link(__('<em class="fa fa-edit"><span style="display:none;">Edit</span></em>', 'understrap'), '<span class="edit-link position-absolute">', '</span>'); ?>
    <div class="veeam-container">
        <?php the_content(); ?>
    </div>
</article>