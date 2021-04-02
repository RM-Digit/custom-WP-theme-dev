<?php
    $subcategory_id = ! empty( $instance['subcategory_id'] ) ? esc_attr($instance['subcategory_id']) : '';
    echo do_shortcode('[sub_content categories_id="' . $subcategory_id . '"]');