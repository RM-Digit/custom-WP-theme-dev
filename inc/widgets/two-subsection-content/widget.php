<?php
$subcategory_id1 = ! empty( $instance['subcategory_id1'] ) ? esc_attr($instance['subcategory_id1']) : '';
$subcategory_id2 = ! empty( $instance['subcategory_id2'] ) ? esc_attr($instance['subcategory_id2']) : '';

if(!empty($subcategory_id1) && !empty($subcategory_id2))
{
    $class='5';
    $div= "<div class='col-lg-1 line'></div><div class='col-lg-1' ></div>";
}else{
    if(empty($subcategory_id1) || empty($subcategory_id2)){
        $class='8 mx-auto text-center';
        $div = '';
    }
}

if (!empty($subcategory_id1)) {

    $subcategory1 = get_term_by('id', $subcategory_id1, 'service');
    $title1 = $subcategory1->name;
    $description1 = $subcategory1->description;
    $btn_url1 = get_category_link($subcategory_id1);

    $icon_url1 = get_term_meta($subcategory_id1,'icon',true);

    $text_content1 = "<div class='col-lg-{$class} text-content text-content align-self-center'>";
    $text_content1 .= '';
    $text_content1 .= "<p><em class=' quest-icon quest-professional-services'></em></p>";
    $text_content1 .= $title1 != '' ? "<h2 class='text-primary' >{$title1}</h2>" : '';
    $text_content1 .= $description1 != '' ? "<p>{$description1}</p>" : '';
    $text_content1 .= "<a class='btn btn-primary' href='{$btn_url1}'>View All</a>";
    $text_content1 .= "</div>" . $div;


}
if(!empty($subcategory_id2)){
    $subcategory2 = get_term_by('id', $subcategory_id2, 'service');
    $title2 = $subcategory2->name;
    $description2 = $subcategory2->description;
    $btn_url2 = get_category_link($subcategory_id2);
    $icon_url1 = get_term_meta($subcategory_id2,'icon',true);

    $text_content2 = "<div class='col-lg-{$class} text-content text-content align-self-center'>";
    $text_content2 .= '';
    $text_content2 .= "<p><em class=' quest-icon quest-professional-services'></em></p>";
    $text_content2 .= $title2 != '' ? "<h2 class='text-primary' >{$title2}</h2>" : '';
    $text_content2 .= $description2 != '' ? "<p>{$description2}</p>" : '';
    $text_content2 .= "<a class='btn btn-primary' href='{$btn_url2}'>View All</a>";
    $text_content2 .= "</div> ";
}





?>
<div class="background-image">
<div class="container subsection-content " id="content" >
    <div class="row" >
        <?php if(!empty($subcategory_id1) && !empty($subcategory_id2))
        {
            echo $text_content1;
            echo $text_content2;
        }else{
            if(!empty($subcategory_id1) && empty($subcategory_id2)){
                echo $text_content1;
            }else{
                if(empty($subcategory_id1) && !empty($subcategory_id2)){
                    echo $text_content2;
                }
            }
        }
        ?>
    </div>
</div>
</div>