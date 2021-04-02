<?php
/**
 * Single post partial template.
 *
 * @package understrap
 */

?>
    <?php get_template_part('loop-templates/content', quest_get_content_slug(get_post_type())); ?>