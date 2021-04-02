<?php
function create_shortcode_modal_button($args, $content)
{
    $args = array_merge(array(
        'title' => '',
        'button-title' => '',
        'button-class' => 'btn btn-success',
        'id' => 'mb-'.md5(rand()),
        'target' => '',
        'size' => 'md',
    ), $args);
    $title = $args['title'];
    $btnTitle = !empty($args['button-title'])?$args['button-title']:$args['title'];
    $id = preg_replace('/[^\w\d]/', '_', $args['id']);
    $target = $args['target'];
    $shortcode = "";
    $shortcode .= "<a id='btn-{$id}' class='disabled {$args['button-class']}' href='javascript:;' data-toggle=\"modal\" data-target=\"#{$id}\">{$btnTitle}</a>";
    $modal = "<div class='modal fade' id='{$id}' tabindex='-1' role='dialog' aria-hidden='true'>";
    $modal .= "<div class='modal-dialog modal-dialog-centered modal-{$args['size']}' role='document'>";
    $modal .= "<div class='modal-content'>";
    $modal .= "<div class='modal-header'>";
    $modal .= "<h5 class='modal-title text-primary'>{$title}</h5>";
    $modal .= "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
    $modal .= "<span aria-hidden='true'>&times;</span>";
    $modal .= "</button>";
    $modal .= "</div>";
    $modal .= "<div class='modal-body'>";
    if (empty($target)) {
        $modal .= html_entity_decode($content);
    }
    $modal .= "</div>";
    $modal .= "</div>";
    $modal .= "</div>";
    $modal .= "</div>";
    $shortcode .= $modal;
    $shortcode .= "<script>function init_modal_{$id}(){";
    if ($target) {
        $shortcode .= "jQuery('#btn-{$id}').click(function() {
          var $=jQuery;
          var me = $(this);
          var modal = $('#{$id}');
          var target_bounder = $('{$target}');
          var target = $('{$target}_child');
          if(!target.length){
              target=target_bounder.children().children();
              target.attr('id','{$target}_child'.replace('#',''));
          }
          if(!modal.has(target).length){
              modal.find('.modal-body').html('');
              target.appendTo(modal.find('.modal-body'));
          }
          return true;
        });";
    } else {
        $shortcode .= "jQuery('#btn-{$id}').click(function() {
          var $=jQuery;
          var me = $(this);
          var modal = $('#{$id}');
          modal.modal('show');
          return true;
        });";
    }
    $shortcode.="jQuery('#btn-{$id}').removeClass('disabled');";
    $shortcode .= "};if(window.addEventListener){window.addEventListener('load', init_modal_{$id});}else{ window.attachEvent('onload', init_modal_{$id});}</script>";
    return $shortcode;
}

add_shortcode('modal_button', 'create_shortcode_modal_button');
