<?php
/**
 * Callback for WordPress 'pre_get_posts' action.
 * If doing a search, set the post type to 'post'.
 *
 * @param WP_Query $query The current WP_Query object.
 * @return none
 */
function custom_search_posts_orderby($orderby, $query)
{
    if ($query->is_search) {
        // Order by page first
        $post_type_priority = 'IF(post_type="page","",IF(post_type="' . addslashes(QUEST_POST_TYPE_CEO_BLOG) . '" OR post_type="' . addslashes(QUEST_POST_TYPE_PARTNER_BLOG) . '" OR post_type="' . addslashes(QUEST_POST_TYPE_GOVERNMENT_BLOG) . '" OR post_type="' . addslashes(QUEST_POST_TYPE_SECURITY_BLOG) . '", CONCAT("ZZ",post_type),post_type)) ASC';
        $orderby = $post_type_priority . (empty($orderby) ? '' : ',' . $orderby);
    }
    return $orderby;
}

function custom_search_post_type_services($wp_query)
{
    $resources = !empty($_GET['resources']) ? $_GET['resources'] : array();
    $services = !empty($_GET['services']) ? $_GET['services'] : array();
    $sort = !empty($_GET['sort']) ? $_GET['sort'] : 'DESC';
    if (!is_admin() && $wp_query->is_main_query() && $wp_query->is_tax(QUEST_TAXONOMY_SERVICE)) {
        $wp_query->set('post_type', 'page');
    } else if ($wp_query->is_search && empty($_REQUEST['s'])) {
        // No query
        $wp_query->set('post__in', array(0));
    } else if ($wp_query->is_search || $wp_query->is_archive) {
        if (!empty($_REQUEST['posts_per_page'])) {
            $wp_query->set('posts_per_page', $_REQUEST['posts_per_page']);
        } elseif ($wp_query->is_search) {
            $wp_query->set('posts_per_page', QUEST_SEARCH_DEFAULT_POSTS_PER_PAGE);
        }
        if (!empty($resources)) {
            $wp_query->set('post_type', $resources);
        }
        if (!empty($services)) {
            $tax_query = array(
                array(
                    'taxonomy' => QUEST_TAXONOMY_SERVICE,
                    'terms' => $services,
                    'field' => 'slug'
                )
            );
            $wp_query->set('tax_query', $tax_query);
        }
        if (!empty($sort)) {
            $wp_query->set('order', $sort);
        }
    }
    if (!empty($wp_query->query['post_type'])) {
        $post_type = $wp_query->query['post_type'];
        if ($post_type == QUEST_POST_TYPE_VENDOR) {
            // 'orderby' value can be any column name
            $wp_query->set('orderby', 'title');
            // 'order' value can be ASC or DESC
            $wp_query->set('order', 'ASC');
        }
    }
    /*if ((!is_admin() || (defined('DOING_AJAX') && DOING_AJAX))
        && $wp_query->is_search) {
        $args = array('post_type' => QUEST_POST_TYPE_PARTNER_BLOG);
        $loop = new WP_Query($args);
        while ($loop->have_posts()) : $loop->the_post();
            array_push($excluded, get_post()->ID);
        endwhile;
    }*/
    if ((!is_admin() || (defined('DOING_AJAX') && DOING_AJAX))
        && $wp_query->is_search) {
        $excluded = get_option('sep_exclude');
        if (is_array($excluded)) {
            $_excluded = [];
            foreach ($excluded as $val) {
                if (!empty($val)) array_push($_excluded, $val);
            }
            $wp_query->set('post__not_in', $_excluded);
        }
    }
}

add_filter('pre_get_posts', 'custom_search_post_type_services');
add_filter('posts_orderby', 'custom_search_posts_orderby', 99, 2);

/**
 * Callback for WordPress 'posts_join' filter.
 *
 * Join term tables to a WordPress search if the specified post
 * type is 'post'.
 *
 * @param string $join The current where clause JOIN string.
 * @param WP_Query $query The current WP_Query object.
 * @return string $join The current where clause JOIN string.
 */
/* function posts_join_taxonomies( $join, $query ){ */
/* 	global $wpdb; */

/* 	if( $query->is_search && !empty($_GET['services'])){ */
/* 		$join .= " */
/* 		INNER JOIN */
/* 		  {$wpdb->term_relationships} ON {$wpdb->posts}.ID = {$wpdb->term_relationships}.object_id */
/* 		INNER JOIN */
/* 		  {$wpdb->term_taxonomy} ON {$wpdb->term_taxonomy}.term_taxonomy_id = {$wpdb->term_relationships}.term_taxonomy_id */
/* 		INNER JOIN */
/* 		  {$wpdb->terms} ON {$wpdb->terms}.term_id = {$wpdb->term_taxonomy}.term_id "; */
/* 	} */
/* 	return $join; */
/* } */
/* add_filter( 'posts_join', 'posts_join_taxonomies', 10, 2 ); */

/**
 * Callback for WordPress 'posts_where' filter.
 *
 * @param String $where The where in the clause
 * @param WP_Query $query The current WP_Query object
 * @return String $where The where in the clause
 */
/* function tax_search_where( $where, $query ){ */
/*   	global $wpdb; */
/*     $services = !empty($_GET['services']) ? $_GET['services'] : array(); */

/*   	if($query->is_search && !empty($services)){ */
/*         $where .= " AND {$wpdb->terms}.slug IN ('". implode("','", $services) ."')"; */
/*   	} */
/*   	return $where; */
/* } */
/* add_filter( 'posts_where', 'tax_search_where', 10, 2 ); */

/**
 * Force ElasticPress search match with data
 */

add_filter('ep_fuzziness_arg', 'quest_ep_fuzziness_arg', 10, 3);
add_filter('ep_formatted_args', 'quest_ep_formatted_args', 10, 2);
add_filter('ep_search_fields', 'quest_ep_search_fields', 10, 2);
function quest_ep_fuzziness_arg($fuzziness, $search_fields, $args)
{
    return 0;//Do not allow search approximately
}

function quest_ep_formatted_args($formatted_args, $args)
{
    $_is_match_all = !empty($_REQUEST['match']) && $_REQUEST['match'] == 'all-words';
    $query = strtolower($args['s']);//search_terms
    // Request highlight
    $highlight_opt = ["fragment_size" => 80, 'fragmenter' => 'span'];
    $fields = ['post_content', 'post_excerpt', 'post_title', 'post_name'];
    if (!empty($formatted_args['query']['bool']['should'][0]['multi_match']['fields'])) {
        $fields = $formatted_args['query']['bool']['should'][0]['multi_match']['fields'];
    }
    $_fields = [];
    foreach ($fields as $_field) {
        if ($_field == 'post_title') {
            $_fields[$_field] = ["fragment_size" => 300, 'fragmenter' => 'simple'];
        } else {
            $_fields[$_field] = $highlight_opt;
        }
    }
    if (!isset($formatted_args['highlight'])) {
        $formatted_args['highlight'] = [
//          "pre_tags" => ['<em class="highlight">'],
//          "post_tags" => ["</em>"],
            'fields' => $_fields
        ];
    }
    /* No need this query: make do not show baas when search daas
    if(false &&isset($formatted_args['query']['bool']['should'][1]) &&$formatted_args['query']['bool']['should'][2]) {
        $formatted_args['query']['bool']['should'][1] = $formatted_args['query']['bool']['should'][2];
        unset($formatted_args['query']['bool']['should'][2]);
    }*/
    if (preg_match('/[\*\?]/', $query)) {
        $_queries = [$query];
        if (!$_is_match_all && !empty($args['search_terms'])) {
            $_queries = $args['search_terms'];
        }
        foreach ($_queries as $_query) {
            if (!preg_match('/[\*\?]/', $_query)) continue;
            // Remove char after *
            $_query = preg_replace('/\*[^\s]+\s+/', '* ', strtolower($_query));
            $_query = preg_replace('/\*[^\s]+$/', '*', $_query);
            // Use wildcard
            if (isset($formatted_args['query']['bool']['should'])) {
                $wildcards = [];
                foreach ($fields as $_field) {
                    array_push($formatted_args['query']['bool']['should'], ['wildcard' => [$_field => $_query]]);
                }
            }
        }
        //$formatted_args['query']['bool']['should'] = $wildcards;
    }
    {
        // Remove wildcard chars
        $_query = preg_replace('/\*\s*/', ' ', $query);
        $formatted_args['query']['bool']['should'][2]['multi_match']['query'] = $_query;
        $formatted_args['query']['bool']['should'][1]['multi_match']['query'] = $_query;
        $formatted_args['query']['bool']['should'][0]['multi_match']['query'] = $_query;
        // Force to all word match
        if ($_is_match_all) {
            if (isset($formatted_args['query']['bool']['should'])) {
                foreach ($formatted_args['query']['bool']['should'] as $key => &$term) {
                    if (isset($term['multi_match']) && empty($term['multi_match']['operator'])) {
                        $term['multi_match']['operator'] = 'and';
                    }
                }
            }
        }
    }
    return $formatted_args;
}

/**
 * Search in post name too
 * @param $search_fields
 * @param $args
 * @return mixed
 */
function quest_ep_search_fields($search_fields, $args)
{
    if (!in_array('post_name', $search_fields)) {
        array_push($search_fields, 'post_name');
    }
    return $search_fields;
}

/**
 * Add highlight option
 */
/**
 * Get score and hight light
 */
add_filter('ep_retrieve_the_post', 'quest_ep_retrieve_the_post', 10, 2);
function quest_ep_retrieve_the_post($post, $hit)
{
    if (!empty($hit['highlight'])) $post['meta']['highlight'] = $hit['highlight'];
    if (!empty($hit['_score'])) $post['meta']['search_score'] = $hit['_score'];
    return $post;
}

/**
 * Abort exclude post - no index
 */

add_filter('ep_post_sync_kill', 'quest_ep_post_sync_kill', 10, 2);
function quest_ep_post_sync_kill($kill, $post_id)
{
    $excluded = get_option('sep_exclude');
    if (is_array($excluded) && in_array($post_id, $excluded)) return true;
    return $kill;
}

/**
 * Prepare the content before sync to ElasticSearch
 * Process content, short codes
 * Remove HTML tag before index to ElasticSearch
 */
add_filter('ep_post_sync_args', 'quest_ep_post_sync_args', 10, 2);
function quest_ep_post_sync_args($post_args, $post_id)
{
    set_time_limit(0);
    global $post; // Fix for page builder.
    $post = get_post($post_id);
    $post_args['post_content'] = wp_strip_all_tags(apply_filters('the_content', $post_args['post_content']));
    if (empty($post_args['post_content'])) {
        // Use PDF content as the content
        if (!empty($post_args['meta']['quest-pdf-file-link'])) {
            $_items = (array)$post_args['meta']['quest-pdf-file-link'];
            foreach ($_items as $_item) {
                if (!empty($_item['value']) && preg_match('/(wp-content\/uploads\/.*\/)?([^\/]+)\.pdf$/i', $_item['value'], $matches)) {
                    $post_args['post_content'] .= ' ' . $matches[2];
                    if (false) {
                        // Todo: disabled since it makes interupt index processing
                        $file = ABSPATH . $matches[0];
                        if (file_exists($file)) {
                            require_once __DIR__ . "/../lib/pdfparser/vendor/autoload.php";
                            $parser = new Smalot\PdfParser\Parser();
                            try {
                                $pdf = $parser->parseFile($file);
                                $text = $pdf->getText();
                                $post_args['post_content'] .= ' ' . $text;
                            } catch (Exception $e) {
                                echo $e->getMessage() . "\n";
                            }
                        }
                    }
                }
            }
        }
    }
    return $post_args;
}

/**
 * Remove exclude pages from sitemap
 */
add_filter('aiosp_sitemap_post_query', 'quest_aiosp_sitemap_post_query', 10);
function quest_aiosp_sitemap_post_query($arg)
{
    if (!is_array($arg['exclude'])) {
        $arg['exclude'] = [];
    }
    $excluded = get_option('sep_exclude_search_engines');
    if (is_array($excluded)) {
        $arg['exclude'] = array_merge($arg['exclude'], $excluded);
    }
    return $arg;
}
