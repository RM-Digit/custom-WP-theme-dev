<?php
get_header();

$quest_expiration_date = get_post_meta($post->ID, 'expiration-date', true);

?>

<div class="wrapper" id="veeam-wrapper">

    <div class="container-fluid veeam-header">
        <div class="container">
            <h1 class="search-header-title"><?php echo the_title();?></h1>
        </div>
    </div>

    <div class="container" id="content" tabindex="-1">
        <div class="row">
            <main class="site-main" id="main">
                <?php if(have_posts()):?>
                    <?php if(strtotime($quest_expiration_date . "23:59:59" ) > time()): ?>
                        <?php while(have_posts()): the_post();?>
                            <?php get_template_part('loop-templates/content', 'page');?>
                        <?php endwhile;?>
                    <?php else:?>
                    <div class="text-center" style="padding-bottom: 7.5rem; padding-top: 7.5rem">
                        <h6> <strong><?php echo the_title(); ?></strong>  event was is expired. Please contact Quest for inquiries at <a href="mailto:events@questsys.com">events@questsys.com</a></h6>
                        <a class="btn btn-success text-white mt-4 font-weight-bold" href="<?php echo get_home_url(); ?>">Back to Homepage</a>
                    </div>
                    <?php endif; ?>
                <?php else:?>
                <?php endif;?>
            </main>
        </div>
    </div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
