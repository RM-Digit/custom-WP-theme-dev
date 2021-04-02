<?php
    $resource_url = '';
    $resource = !empty( $instance['resource'] ) ? $instance['resource'] : '';

    if (strpos($resource, 'post:') === false) {
	    $resource_url = $resource;
    } else {
	    $resource_url = get_permalink(substr($resource,6));
    }

    $image_resource = ! empty( $instance['image_resource'] ) ? wp_get_attachment_image_src($instance['image_resource'], 'large') : '';
//    $postId = url_to_postid($resource_url);
//    $article_post_type = get_post_type($postId);
//    $targetBlank = in_array($article_post_type, get_all_target_blank_post_types()) ? 'target="_blank"' : '';
?>
<div class="resource-block-container">
<?php if($resource && $image_resource) : ?>
<div class='text-center bg-primary row justify-content-center align-items-center' style="margin-left: 0px; margin-right: 0px; margin-bottom: 2rem">
    <div class="col-12 image-block col-sm-6"> <a href="<?php echo $resource_url;?>"> <img src="<?php echo $image_resource[0]; ?> " alt="Resource image"/> </a></div>
    <div class="col-12 text-block col-sm-6 pt-3 pb-3 px-0"> <a href="<?php echo $resource_url;?>" class='btn btn-success' target="_blank">Learn more</a> </div>
</div>
<?php elseif ($resource && !$image_resource) : ?>
    <div class='text-center mb-4 pdf-block'>
        <h3>Download PDF</h3>
        <a href="<?php echo get_permalink(substr($resource,6)); ?>" class='btn btn-success' target="_blank">Download</a>
    </div>
<?php elseif ($image_resource && !$resource) : ?>
    <div class="mb-4"> <img src="<?php echo $image_resource[0]; ?> "> </div>
<?php endif; ?>
</div>