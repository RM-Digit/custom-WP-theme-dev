<?php
/**
 * Single post partial template.
 *
 * @package understrap
 */
$IS_SUB_CATEGORY_PAGE = false;
    $terms = wp_get_post_terms(get_the_ID(), QUEST_TAXONOMY_SERVICE);
    if (!empty($terms)) foreach ($terms as $_term) {
        if (!empty($_term->parent)) {
            if($IS_SUB_CATEGORY_PAGE===false) {
                $IS_SUB_CATEGORY_PAGE = [$_term->slug];
            } else {
                $IS_SUB_CATEGORY_PAGE[] = $_term->slug;
            }
        }
    }

$_salesfusion_form_builser = get_post_meta(get_the_ID(), 'quest_salesform_html', true);
$_salesform = get_post_meta(get_the_ID(), 'quest_salesform_id', true);
$_salesfusion_thanks = htmlentities(get_post_meta(get_the_ID(), 'quest_salesform_thanks_design', true));

$html = '';
if (!empty($_salesfusion_form_builser)) {
    $_quest_salesform_redirect_url = get_post_meta(get_the_ID(), 'quest_salesform_redirect_url', true);
    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML($_salesfusion_form_builser);
    $xpath = new DOMXPath($dom);

    global $wp;
    $names = ['rurl', 'utm_source', 'utm_term', 'utm_campaign'];
    $data = [];

    $html = "<div class='salesfusion-column' style='text-align: center;'>";
    $html .= "<div class=\"salesfusion-form blue-gradient\" data-thanks-form='{$_salesfusion_thanks}'>";

    $data['rurl'] = !empty($_quest_salesform_redirect_url) ? rel2abs($_quest_salesform_redirect_url, home_url('/')) : '';
    $data['utm_source'] = home_url($wp->request);
    $data['utm_term'] = get_the_title();

    $categories = [];
    $terms = wp_get_post_terms(get_the_ID(), QUEST_TAXONOMY_SERVICE);
    if (!empty($terms)) foreach ($terms as $_term) {
        if(empty($categories)) {
            $categories = [$_term->name];
        } else {
            $categories[] = $_term->name;
        }
    }

    $data['utm_campaign'] = implode(', ', $categories);

    foreach ($names as $name) {
        $node = $xpath->query("//input[@name=\"{$name}\"]")->item(0);

        if (!empty($node) && !empty($data[$name])) {
            $node->setAttribute('value', $data[$name]);
        }
    }

	$html .= $dom->saveHTML();
	$html .= "</div>";
	$html .= "</div>";
}elseif (!empty($_salesform)) {
    $_salesform_width = get_post_meta(get_the_ID(), 'quest_salesform_width', true);
    $_salesform_height = get_post_meta(get_the_ID(), 'quest_salesform_height', true);
    $html .= '<iframe class="salesfusion-form" width="' . $_salesform_width . '" height="' . $_salesform_height . '" src="' . $_salesform . '" frameborder="0" scrolling="no"></iframe>';
}
?>

<article <?php post_class('position-relative'); ?> id="post-<?php the_ID(); ?>">
    <?php edit_post_link(__('<em class="fa fa-edit"><span style="display:none;">Edit</span></em>', 'understrap'), '<span class="edit-link position-absolute">', '</span>'); ?>

    <div class="entry-content">
        <div class="row">
            <?php
            $_has_featured_image = has_post_thumbnail();
            $_content = get_the_content();
            $_has_left_content = !empty($_content);
            $_has_salesform = !empty($_salesform);
            $_has_right_content = $_has_salesform;
            ?>
            <?php if (quest_is_video_post_type(get_post_type())):
                $videoLink = get_post_meta(get_the_ID(), 'video-link', true);
                $_has_video_link = !empty($videoLink);
                $_has_right_content = $_has_right_content || $_has_video_link;
                if ($_has_left_content) {
                    echo '<div class=" col-12 ' . ($_has_right_content ? 'col-md-7 pr-md-5 pb-5 pb-md-0' : '') . '">';
                    the_content();
echo '</div>';
                }
                ?>
                <div class="col-12 col-md-<?php echo $_has_left_content ? '5' : '8 offset-md-2' ?>">
                    <?php if($_has_left_content && $_has_featured_image ):?>
                        <?php if($_has_video_link):?>
                        <div class='text-center bg-primary row justify-content-center align-items-center' style="margin-left: 0px; margin-right: 0px; margin-bottom: 2rem">
                            <div class="col-12 pl-0 col-md-6 quest-thumbnail-single"> <?php echo get_the_post_thumbnail($post->ID, 'large'); ?></div>
                            <div class="col-12 col-md-6 pt-4 pt-md-0"> <a href="<?php echo $videoLink?>" class='btn btn-success'>Learn more</a> </div>
                        </div>
                        <?php endif; ?>
                    <?php elseif($_has_video_link):
                        $matches = null;
                        preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $videoLink, $matches);
                        ?>
                        <div class="youtube-iframe-size">
                        <iframe frameborder="0" width="100%" height="<?php echo $_has_left_content ? '300px' : '400px' ?>"
                                src=" https://www.youtube.com/embed/<?php echo $matches[0] ?>?rel=0&autoplay=1&loop=1" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                        </iframe>
                        </div>
                    <?php endif; ?>
                    <?php echo $html; ?>
                </div>
            <?php elseif (quest_is_pdf_post_type(get_post_type())):
                $pdfID = get_post_meta(get_the_ID(), 'quest-pdf-file', true);
                $pdfLink = get_post_meta(get_the_ID(), 'quest-pdf-file-link', true);
                $pdfCaption = get_post_meta(get_the_ID(), 'quest-pdf-file-caption', true);
                $formViewSB = get_post_meta(get_the_ID(), 'is-show-form-view', true);
                $viewLink = get_post_meta(get_the_ID(), 'view-link', true);
                if (empty($pdfLink) && !empty($pdfID)) {
                    // Autoload pdf link if it has pdf id only
                    $pdfLink = wp_get_attachment_url($pdfID);
                }

                $_has_pdf_link = !empty($pdfLink);
                $_has_salesfusion = !empty($_salesform) || !empty($_salesfusion_form_builser);
                $_has_solution_box = !$_has_pdf_link && get_post_type() == QUEST_POST_TYPE_RESOURCE_SOLUTION_BRIEF;
                $_has_right_content = $_has_right_content || $_has_pdf_link || $_has_solution_box || $_has_salesfusion;
                if ($_has_left_content) {
                    echo '<div class="col-12 ' . ($_has_right_content ? 'col-md-7 pr-md-5 pb-5 pb-md-0' : '') . '">';
                    the_content();
echo '</div>';
                }
                ?>

                <div class="col-12 col-md-<?php echo $_has_left_content ? '5' : '6 offset-md-3' ?>">
                    <?php if ($_has_featured_image): ?>
                        <?php if (!$_has_pdf_link && $formViewSB == 0): ?>
                        <div class="quest-thumbnail-single mb-4"> <?php echo get_the_post_thumbnail($post->ID, 'large'); ?></div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if ($_has_pdf_link): ?>
                        <?php if ($_has_featured_image): ?>
                    <div class='text-center bg-primary row justify-content-center align-items-center' style="margin-left: 0px; margin-right: 0px; margin-bottom: 2rem">
                        <div class="col-12 pl-0 col-md-6 quest-thumbnail-single"> <?php echo get_the_post_thumbnail($post->ID, 'large'); ?></div>
                        <div class="col-12 col-md-6 pt-4 pt-md-0"> <a href="<?php echo $pdfLink; ?>" class='btn btn-success'>Learn more</a> </div>
                    </div>
                        <?php else: ?>
                        <div class='text-center mb-4 pdf-block'>
                            <h3>Download PDF</h3>
                            <h6><?php if (!empty($pdfCaption)) echo $pdfCaption; ?></h6>
                            <a href="<?php echo $pdfLink; ?>" class='btn btn-success'>Download</a>
                        </div>
                        <?php endif; ?>
                    <?php elseif ($_has_solution_box):
                        $pdfLink = quest_resource_url(['resources'=>['solution-brief']]);
                        ?>
                    <?php if ($formViewSB != 0 ): ?>
                        <?php if ($_has_featured_image): ?>
                            <div class='text-center row justify-content-center align-items-center' style="margin-left: 0px; margin-right: 0px; margin-bottom: 2rem">
                                <div class="col-12 pl-0 col-md-6 quest-thumbnail-single"> <?php echo get_the_post_thumbnail($post->ID, 'large'); ?></div>
                                <div class="col-12 col-md-6 pt-4 pt-md-0"> <a href="<?php echo $viewLink ? $viewLink : $pdfLink; ?>" class='btn btn-success'>Learn more</a> </div>
                            </div>
                        <?php else: ?>
                        <div class='text-center mb-4 pdf-block'>
                            <h3>View Solution Brief with more information</h3>
                            <h6><?php if (!empty($pdfCaption)) echo $pdfCaption; ?></h6>
                            <a href="<?php echo $viewLink ? $viewLink : $pdfLink; ?>" class='btn btn-success'>View</a>
                        </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php endif; ?>
	                <?php echo $html; ?>
                </div>
            <?php endif; ?>
        </div>
    </div><!-- .entry-content -->
</article><!-- #post-##10 -->
</main>
</div>
</div>
</div>
<div style="background-color: #f6f6f6">
<div>
<div>
<main>
<?php if ($IS_SUB_CATEGORY_PAGE !== false): ?>
    <div class="col-12">
        <div class="widget_quest-list-posts">
            <?php
            quest_list_post_shortcode(['is_related_service_section' => true, 'services' => $IS_SUB_CATEGORY_PAGE, 'post_type' => quest_all_resources_post_type([QUEST_POST_TYPE_PARTNER_BLOG, QUEST_POST_TYPE_GOVERNMENT_BLOG, QUEST_POST_TYPE_SECURITY_BLOG]), 'posts_per_page' => 3, 'title' => '<h2 class="text-center">Related Services</h2>', 'button-text' => __('View All', 'quest'), 'is_show_footer' => false]);
            ?>
        </div>
    </div>
<?php endif; ?>
