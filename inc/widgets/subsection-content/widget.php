<?php

$image_url =! empty( $instance['image_url'] ) ? wp_get_attachment_image_src($instance['image_url'], 'large')[0] : '';
$link_video = ! empty( $instance['link_video'] ) ? esc_attr($instance['link_video']) : '';
$subcategory_id = ! empty( $instance['subcategory_id'] ) ? esc_attr($instance['subcategory_id']) : '';
$ratio = ! empty( $instance['ratio'] ) ? explode(':', esc_attr($instance['ratio'])) : array(6,6);
$content_direction = ! empty( $instance['content_direction'] ) ? strtolower(esc_attr($instance['content_direction'])) : 'text2image';

if($content_direction == 'text2image'){
    $css_class = 'text2image';
    $order_text= 0;
    $order_image = 1;
}else {
    $css_class = 'image2text';
    $order_text= 1;
    $order_image = 0;
}
// Create image content
$image_content = "<div class='col-lg-{$ratio[1]} image-content order-lg-{$order_image} order-md-0 order-0 image-content align-self-center {$css_class}'>";
if($image_url!=''){
$image_content .= "<img src='{$image_url}'";

if($link_video!=''){
    $image_content .= " data-toggle='modal' data-target='#modal{$subcategory_id}'/> </p>";
    $image_content .= "<a class='round-button' data-toggle='modal' data-target='#modal{$subcategory_id}'><em class='fa fa-play fa-2x'></em></a>";
}else{$image_content .=  "/> </p>";}}
$image_content .= "</div>";

$modal = "<div class='modal fade' id='modal{$subcategory_id}' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>";
$modal .= "<div class='modal-dialog modal-dialog-centered modal-lg' role='document'>";
$modal .= "<div class='modal-content'>";
$modal .= "<div class='modal-header'>";
$modal .= "<h5 class='modal-title text-primary' id='exampleModalCenterTitle'>Watch video</h5>";
$modal .= "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
$modal .= "<span aria-hidden='true'>&times;</span>";
$modal .= "</button>";
$modal .= "</div>";
$modal .= "<div class='modal-body embed-responsive embed-responsive-16by9'>";
$modal .= "<iframe class='embed-responsive-item'  id='iframeYoutube' src='{$link_video}' frameborder='0' allowfullscreen></iframe>";
$modal .= "</div>";
$modal .= "</div>";
$modal .= "</div>";
$modal .= "</div>"

?>
<div class="background-image">
<div class="container subsection-content " id="content" >
    <div class="row" >

        <?php if ($content_direction == 'text2image') {
            echo do_shortcode('[sub_content categories_id="' . $subcategory_id . '" ratio="' . $ratio[0] .'" order="' . $order_text .'"]' );
            echo $image_content;
        } else {
            echo $image_content;
            echo do_shortcode('[sub_content categories_id="' . $subcategory_id . '" ratio="' . $ratio[0] .'" order="' . $order_text .'"]' );
        }
        ?>
    </div>
    <?php if($link_video!=''){
        echo $modal;
    } ?>
</div>
</div>