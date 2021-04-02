<?php
/**
 * Single post partial template.
 *
 * @package understrap
 */
?>
<article <?php post_class('position-relative'); ?> id="post-<?php the_ID(); ?>">
    <?php edit_post_link(__('<em class="fa fa-edit"><span style="display:none;">Edit</span></em>', 'understrap'), '<span class="edit-link position-absolute">', '</span>'); ?>

    <div class="entry-content customer-stories-container">
        <div class="row">
            <div class="col-12 col-md-9 customer-stories-content">
                <?php the_content(); ?>
                <?php if( have_rows('download_guide') ): ?>
                    <div class="download_guide">
                    <?php while( have_rows('download_guide') ): the_row(); 
                         $image = get_sub_field('image_url');
                         $header = get_sub_field('download_header');
                         $short_desc = get_sub_field('download_short_description');
                         $desc = get_sub_field('download_footer_description');
                         $download_btn = get_sub_field('download_button');
                    ?>
                        <div class="download-section-image">
                            <!-- <img src="/wp-content/uploads/2021/03/NewRulesForCybersecurity@2x.png" alt="download-guide" /> -->
                            <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
                            
                        </div>
                        <div class="download-section-text">
                            <p class="download-section-header"><?php echo esc_attr( $header ); ?></p>
                            <div class="download-section-description">
                                <p><?php echo esc_attr( $short_desc ); ?></p>
                                <div class = "download-section-footer">
                                    <p><?php echo esc_attr( $desc ); ?></p>
                                    <p><a class="download_btn" href="<?php echo esc_attr( $download_btn ); ?>" download>Download the Guide</a></p>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                    </div>
                <?php endif; ?>
                <?php if(is_single()) : ?>
                   <!-- Para pantallas grandes -->
                    <div class="btn-group btn-group-justified hidden-sm hidden-xs" role="group" aria-label="..." id="nextpreviouslinks">
                        <div class="btn-group prev post" role="group">
                            <?php previous_post_link( '%link', '« Previous post'); ?>
                        </div>
                        
                        <div class="btn-group next-post" role="group">
                            <?php next_post_link( '%link', 'Next post »' ); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-12 col-md-3 author-of-post">
                <?php if (!in_array($post->post_type, [QUEST_POST_TYPE_RESOURCE_PRESS_RELEASE, QUEST_POST_TYPE_INFOGRAPHIC/*, QUEST_POST_TYPE_GOVERNMENT_BLOG, QUEST_POST_TYPE_SECURITY_BLOG*/])):?>
                    <?php if ($post->post_type == QUEST_POST_TYPE_CUSTOMER_STORY): ?>
                        <div class="mb-4">
                            <?php
                            $customer_portrait = wp_get_attachment_url(get_post_meta(get_the_ID(), 'quest-customer-portrait', true));
                            echo "<img src='$customer_portrait' alt='Customer portrait'>";
                            ?>
                        </div>
                        <h5 class="text-primary">THE BOTTOM LINE</h5>
                        <?php if (has_excerpt()) the_excerpt(); ?>
                    <?php else: ?>
                        <div class="mb-4">
                            <?php echo get_avatar(get_the_author_meta('ID'), '600'); ?>
                        </div>
                        <h5 class="text-primary">Meet the Author</h5>
                        <p><?php echo get_the_author_meta('description'); ?></p>
                    <?php endif; ?>
                <?php endif; ?>
                <?php $taxonomys = get_the_terms($post->ID, 'service');

                if (!empty($taxonomys)) :
                    $industryTerm = get_term_by('slug', 'industries', 'service');
                    $serviceTerm = get_term_by('slug', 'services', 'service');

                    $relatedIndustry = [];
                    $relatedService = [];

                    foreach ($taxonomys as $taxonomy) {
                        $relatedItem = [];
	                    $relatedItem['icon_taxonomy'] = get_term_meta($taxonomy->term_id, 'icon', true);
	                    $relatedItem['name'] = $taxonomy->name;
                        // hiding related industries
                        /*
	                    if (!empty($industryTerm) && $taxonomy->parent === $industryTerm->term_id) {
		                    $relatedItem['btn_url'] = '/industries/'.$taxonomy->slug;
		                    array_push($relatedIndustry, $relatedItem);
	                    }
                        */
	                    if (!empty($serviceTerm) && $taxonomy->parent === $serviceTerm->term_id) {
		                    $relatedItem['btn_url'] = '/services/'.$taxonomy->slug;
		                    array_push($relatedService, $relatedItem);
	                    }

                    }
                ?>
	                <?php
	                $cta_btn = quest_get_CTA_button($post);
	                if (!empty($cta_btn) && in_array($post->post_type, quest_get_list_blog_page_constants())) :
		                ?>
                        <div class="cta-btn-section mt-3">
                            <a target="_blank" class="btn btn-secondary" href="<?php echo $cta_btn['link']?>"><?php echo $cta_btn['name']?></a>
                        </div>
						 <div class="cta-btn-section mt-3">
						 <?php $url = get_option( 'siteurl' )."/blog/"; ?>
                            <a class="btn btn-secondary" href="<?php echo $url;?>">See all of our blogs here</a>
                        </div>

                        <div class="related-posts">
                            <h6 style="font-weight:bold"><?php echo the_field('related_post_header'); ?></h6>
                            <?php

                            // check if the repeater field has rows of data
                            if( have_rows('related_posts') ):

                                // loop through the rows of data
                                while ( have_rows('related_posts') ) : the_row();

                                    // display a sub field value
                            ?>
                           
                             <li class="re-post">
                                <a href="<?php echo the_sub_field('related_post_link'); ?>" class="re-post-link"> <?php echo the_sub_field('related_post_title'); ?>  </a>
                             </li>
                           
                            <?php
                                    
                                endwhile;

                            else :

                                // no rows found

                            endif;

                            ?>
                        </div>


	                <?php endif;?>
                    <?php if (!in_array($post->post_type, [QUEST_POST_TYPE_RESOURCE_PRESS_RELEASE, QUEST_POST_TYPE_INFOGRAPHIC])): ?>
                        <hr>
                    <?php endif; ?>

                    <?php if (!empty($relatedService)) : ?>
                    <div class="profile-author">
                        <h5 class="text-primary">Related Services</h5>
                        <?php foreach ($relatedService as $item): ?>
                            <p>
                                <em class='mr-2 quest-icon <?php echo $item['icon_taxonomy']; ?>'></em>
                                <a href="<?php echo $item['btn_url'] ?>"><?php echo $item['name']; ?> </a>
                            </p>
                        <?php endforeach; ?>
                        <hr>
                    </div>
                    <?php endif; ?>

	                <?php if (!empty($relatedIndustry)) : ?>
                    <div class="profile-author">
                        <h5 class="text-primary">Related Industries</h5>
		                <?php foreach ($relatedIndustry as $item): ?>
                            <p>
                                <em class='mr-2 quest-icon <?php echo $item['icon_taxonomy']; ?>'></em>
                                <a href="<?php echo $item['btn_url'] ?>"><?php echo $item['name']; ?> </a>
                            </p>
		                <?php endforeach; ?>
                        <hr>
                    </div>
                    <?php endif; ?>
                <?php endif; ?>
                <?php $tags = get_the_tags($post->ID);
                if (!empty($tags)) : ?>
                    <div class="show-tags">
                        <h5 class="text-primary">Tags/Topics</h5>
                        <ul>
                            <?php foreach ($tags as $tag): ?>
                                <li> &bull; <a
                                            href="<?php echo get_tag_link($tag->term_id) ?>"><?php echo $tag->name; ?></a>
                                </li>
                            <?php endforeach; ?>
                            .
                        </ul>
                    </div>
                <?php endif; ?>
	            <?php if ($post->post_type == QUEST_POST_TYPE_CUSTOMER_STORY): ?>
                <div>
                    <a href="<?php echo get_site_url(null,'/customer-stories/')?>" class="btn btn-secondary">View All Customer Stories</a>
                </div>
                <?php endif;?>
	            <?php
                if (in_array($post->post_type, [QUEST_POST_TYPE_GOVERNMENT_BLOG])):
//		            $naspo_link = get_post_meta( $post->ID , 'naspo-link' , true );
//	                if (!empty($naspo_link)) :
                ?>
                    <div class="text-center mt-5">
                        <div>
                            <img style="max-width: 100%;" src="<?php echo get_bloginfo('template_url') ?>/img/naspo_logo.png" alt="Naspo Logo">
                        </div>
                        <div class="mt-4">
                            <a class="btn btn-secondary" href="https://www.questsys.com/naspo-valuepoint-supplier-partner">Learn More</a>
                        </div>
                    </div>
                    <hr>
                    <?php //endif;?>
                <?php endif;?>
            </div>
        </div>
    </div><!-- .entry-content -->
</article><!-- #post-##4 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    jQuery(document).ready(function ($) {
            console.log("hello world");
            
            $(".download_guide").insertAfter($(".customer-stories-content>p:nth-child(4)"));
    });
</script>