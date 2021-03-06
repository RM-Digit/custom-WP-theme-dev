<?php
/**
 * Pagination layout.
 *
 * @package understrap
 */

if ( ! function_exists ( 'understrap_pagination' ) ) {

    function understrap_pagination($args = [], $class = 'pagination') {

        if ($GLOBALS['wp_query']->max_num_pages <= 1) return;

        $args = wp_parse_args( $args, [
            'mid_size'           => 2,
            'prev_next'          => true,
            'prev_text'          => __('&laquo;', 'understrap'),
            'next_text'          => __('&raquo;', 'understrap'),
            'screen_reader_text' => __('Posts navigation', 'understrap'),
            'type'               => 'array',
            'current'            => max( 1, get_query_var('paged') ),
        ]);

        $links = paginate_links($args);

        ?>

        <nav aria-label="<?php echo $args['screen_reader_text']; ?>">

            <ul class="pagination">

                <?php

                    foreach ( $links as $key => $link ) { ?>

                        <li class="page-item <?php echo strpos( $link, 'current' ) ? 'active' : '' ?>">

                            <?php echo str_replace( 'page-numbers', 'page-link', $link ); ?>

                        </li>

                <?php } ?>

            </ul>

        </nav>

        <?php
    }
}
if ( ! function_exists ( 'quest_pagination' ) ) {

    function quest_pagination($pages = null, $args = [], $class = 'pagination') {

        if($pages == null){
            if ($GLOBALS['wp_query']->max_num_pages <= 1) return;
            $pages = $GLOBALS['wp_query']->max_num_pages;
        }

        $args = wp_parse_args( $args, [
            'total'              => $pages,
            'format'             => '?paged=%#%',
            'mid_size'           => 3,
            'prev_next'          => true,
            'prev_text'          => __('&laquo;', 'understrap'),
            'next_text'          => __('&raquo;', 'understrap'),
            'screen_reader_text' => __('Posts navigation', 'understrap'),
            'type'               => 'array',
            'current'            => max( 1, get_query_var('paged') ),
        ]);

        $links = paginate_links($args);
        if(empty($links)) return;
        ?>

        <nav aria-label="<?php echo $args['screen_reader_text']; ?>">

            <ul class="pagination">

                <?php

                    foreach ( $links as $key => $link ) { ?>

                        <li class="page-item <?php echo strpos( $link, 'current' ) ? 'active' : '' ?>">

                            <?php echo str_replace( 'page-numbers', 'page-link', $link ); ?>

                        </li>

                <?php } ?>

            </ul>

        </nav>

        <?php
    }
}

?>
