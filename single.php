<?php
/**
 * The template for displaying all single posts.
 *
 * @package understrap
 */

get_header();
$container = get_theme_mod('understrap_container_type');
?>

<div class="wrapper" id="single-wrapper">

    <div class="<?php echo esc_attr($container); ?>" id="content-header" tabindex="-1">
        <div class="custom-header-fulid">
            <div class="bounder">
                <div class="container">
                    <div class="">
                        <?php if (quest_has_posted_on(get_post_type())) : ?>
                            <div class="entry-meta">
                                <?php quest_posted_on(false); ?>
                            </div><!-- .entry-meta -->
                        <?php elseif (get_post_type()==QUEST_POST_TYPE_CUSTOMER_STORY): ?>
                            <div>
                                <span class="posted-on">Customer Stories</span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <h1 class="search-header-title"><?php the_title() ?></h1>
                </div>
            </div>
        </div>
    </div>
    <div id="content" class="container has-padding">
        <div class="">

            <!-- Do the left sidebar check -->
            <?php get_template_part('global-templates/left-sidebar-check'); ?>

            <main class="site-main" id="main">

                <?php while (have_posts()) : the_post(); ?>

                    <?php get_template_part('loop-templates/content', quest_get_content_slug(get_post_type())); ?>

                    <?php //understrap_post_nav(); ?>
                    <?php if(!in_array($post->post_type,[QUEST_POST_TYPE_CEO_BLOG, QUEST_POST_TYPE_PRODUCT, QUEST_POST_TYPE_PARTNER_BLOG,QUEST_POST_TYPE_GOVERNMENT_BLOG,QUEST_POST_TYPE_SECURITY_BLOG])): ?>
                    <?php
                    // If comments are open or we have at least one comment, load up the comment template.
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;
                    ?>
                    <?php endif; ?>

                <?php endwhile; // end of the loop. ?>

            </main><!-- #main -->

            <!-- Do the right sidebar check -->
            <?php get_template_part('global-templates/right-sidebar-check'); ?>

        </div><!-- .row -->

    </div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
