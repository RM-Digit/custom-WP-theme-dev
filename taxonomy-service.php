<?php
get_header();
foreach (get_terms(QUEST_TAXONOMY_SERVICE, array('hide_empty' => false,)) as $term) {
    if (is_tax(QUEST_TAXONOMY_SERVICE, $term->slug)) {
        $term = get_term_by('slug', $term->slug, QUEST_TAXONOMY_SERVICE);
        break;
    }
}
$container = get_theme_mod('understrap_container_type');
?>

<div class="wrapper" id="page-wrapper">
    <div class="custom-header-fulid">
        <div class="bounder">
            <div class="container">
                <h1 class="search-header-title"><?php echo $term->name ?></h1>
                <?php if(!empty($term->description)): ?>
                <h6> <?php echo $term->description ?> </h6>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="container has-padding" id="content" tabindex="-1">

        <div class="row">

            <!-- Do the left sidebar check and opens the primary div -->
            <?php get_template_part('global-templates/left-sidebar-check'); ?>
            <main class="site-main list-service-pages" id="main">

                <?php if (have_posts()) :
                    global $is_show_footer;
                    $is_show_footer = true;
                    ?>
                    <div class="card-columns">
                        <?php while (have_posts()) : the_post(); ?>
                            <?php
                                locate_template('loop-templates/content-preview.php',true, false);
                                ?>
                        <?php endwhile; ?>
                    </div>
                <?php else : ?>

                    <?php get_template_part('loop-templates/content', 'none'); ?>

                <?php endif; ?>

            </main><!-- #main -->

            <!-- The pagination component -->
            <?php quest_pagination(); ?>

        </div><!-- .row -->
    </div><!-- .row -->
</div><!-- Wrapper end -->

<?php get_footer(); ?>
