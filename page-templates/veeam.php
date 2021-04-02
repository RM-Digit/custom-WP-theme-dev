<?php
/**
 * Template Name: Veeam Layout
 *
 * This template can be used to override the default template and sidebar setup
 *
 * @package quest
 */

get_header();
?>

<div class="wrapper" id="veeam-wrapper">

    <div class="container-fluid veeam-header">
        <div class="container">
            <h1 class="search-header-title"><?php echo the_title();?></h1>
        </div>
    </div>

    <div class="container" id="content" tabindex="-1">
        <main class="site-main" id="main">
            <?php if(have_posts()):?>
                <?php while(have_posts()): the_post();?>
                    <?php get_template_part('loop-templates/content', 'veeam');?>
                <?php endwhile;?>
            <?php else:?>
                <?php get_template_part('loop-teamplates/content', 'none');?>
            <?php endif;?>
        </main>
    </div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
