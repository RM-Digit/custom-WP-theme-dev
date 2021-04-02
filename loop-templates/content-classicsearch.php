<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package quest
 */
$_is_elasticsearch = isset($post->meta['highlight']);
$highlight = !empty($post->meta['highlight']) ? $post->meta['highlight'] : [];
$score = !empty($post->meta['search_score']) ? $post->meta['search_score'] : 0;
global $quest_search_term, $quest_is_any_match;
$_search_terms = $quest_search_term;
$post_content_text = '';
$post_title_text = '';
$post_excerpt_text = '';
$title_prefix = '';
$excerpt_suffix = '';
?>
<?php
// Add PDF prefix
if ($_is_elasticsearch && empty($post->post_content) && !empty($post->meta['quest-pdf-file-link'])) {

    $_is_pdf = false;
    $_items = (array)$post->meta['quest-pdf-file-link'];
    foreach ($_items as $_item) {
        if (!empty($_item['value']) && preg_match('/\.pdf$/i', $_item['value'])) {
            $_is_pdf = true;
            //$excerpt_suffix .= $_item['value'];
            break;
        }
    }
    if ($_is_pdf) {
        $title_prefix = '<sup>[PDF]</sup> ';
    }
}
?>
<?php $article_post_type = get_post_type();
global $count; ?>
<div class="result-block mb-3">
    <div class="result-title"><b><?php echo $count; ?>.</b>&nbsp;
        <a href="<?php echo esc_url(get_permalink()); ?>">
            <?php
            echo $title_prefix;
            if (!empty($highlight['post_title'])) {
                if (sizeof($highlight['post_title']) === 1) {
                    $post_title_text .= $highlight['post_title'][0];
                } else {
                    foreach ($highlight['post_title'] as $item) {
                        $post_title_text .= ' ... ' . $item;
                    }
                }
                echo strip_tags($post_title_text, '<em>');
            } else {
                echo strip_tags(get_the_title());
            }
            ?>
        </a>
    </div>
    <div class="description">
        <?php
        if (!empty($highlight['post_excerpt'])) {
            foreach ($highlight['post_excerpt'] as $item) {
                $post_excerpt_text .= ' ... ' . $item;
            }
            echo strip_tags($post_excerpt_text, '<em>');
        }
        echo $excerpt_suffix;
        ?>
    </div>
    <div class="context">
        <?php
        if (!empty($highlight['post_content'])) {
            foreach ($highlight['post_content'] as $item) {
                $post_content_text .= ' ... ' . $item;
            }
            echo strip_tags($post_content_text, '<em>');
        } else {
            echo wp_trim_words(wp_strip_all_tags($post->post_content));
        }

        ?>
    </div>
    <div class="infoline">
        <?php
        if ($_is_elasticsearch) {
            // Count term matches
            $wholeText = '';
            if (!empty($highlight)) foreach ($highlight as $key => $items) {
                $wholeText .= implode(' ', $items);
            }
            $termMatches = [];
            $termMissing = [];
            preg_match_all('/<em[^>]*>(.*?(?=\<\/em\>))<\/em>/', $wholeText, $matches);
            foreach ($matches[1] as $item) {
                $item = strtolower($item);
                if (!in_array($item, $termMatches)) {
                    $termMatches[] = $item;
                    if ($quest_is_any_match) {
                        foreach ($_search_terms as $_term => &$_arr) {
                            if (preg_match($_arr['pattern'], $item)) {
                                $_arr['count']++;
                            }
                        }
                    }
                }
            }
            $termNo = sizeof($termMatches);
            if ($quest_is_any_match) {
                foreach ($_search_terms as $_term => &$_arr) {
                    if ($_arr['count'] <= 0) {
                        array_push($termMissing, $_term);
                    }
                }
            }
            if ($quest_is_any_match && !empty($termMissing)) {
                //echo 'Missing: <s>' . implode('</s>, <s>', $termMissing) . '</s> - ';
            }
            echo 'Terms matched: ' . $termNo . ' - Score: ' . round($score) . ' -&nbsp;';
        }
        ?>
        URL: <?php echo get_permalink(); ?>
    </div>
</div>

