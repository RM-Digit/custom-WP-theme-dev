<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package quest
 */
?>
<div class="entry-title row">
	<?php
    $article_post_type = get_post_type();
    $targetBlank = in_array($article_post_type, get_all_target_blank_post_types()) ? 'target="_blank"' : ''; ?>
    <h5>
        <?php the_title( sprintf( '<h5 style="font-weight: lighter"><a style="text-decoration: underline;" href="%s" rel="bookmark" %s>', esc_url( get_permalink() ), $targetBlank ), '</a></h5>' ); ?>
        <a style="padding: 5px; font-weight: lighter">
            <?php
                if ($article_post_type == QUEST_POST_TYPE_RESOURCE_NEWSLETTER) {
                    $post_time = get_the_date('Y');
                    $quarter = intval($post_time) !== 2012 ? ' Q' . ceil(get_the_date('m') / 3) : '';
                    echo '<span class="text-primary font-weight-bold"> - </span>' . $post_time . $quarter;
                } else {
                    quest_posted_on(false);
                }
            ?>
        </a>
    </h5>
</div>