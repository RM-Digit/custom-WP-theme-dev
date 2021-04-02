<?php
/**
 * The template for displaying search results pages.
 *
 * @package quest
 */
/* Build filter list data, current on search page resources, services and owner is always empty*/
$isset_filter = false;
$filter_keys = [];
$filter_list_keys = ['resources', 'services', 'owner'];
$resources = [];
$services = [];
$authors = [];
if (!empty($_GET['resources'])) {
    $isset_filter=true;
    $resources = $_GET['resources'];
    $filter_keys['resources'] = $resources;
    $filters['resources'] = quest_get_post_types('resources', 'array');
    // Add only Author belongs to resources
    if(!empty($_GET['owner'])) {
        $_authors = $_GET['owner'];
        $mapAuthorIndex = [
            QUEST_POST_TYPE_CEO_BLOG =>QUEST_AUTHOR_INDEX_CEO_BLOG,
            QUEST_POST_TYPE_PARTNER_BLOG =>QUEST_AUTHOR_INDEX_PARTNER_BLOG,
            QUEST_POST_TYPE_SECURITY_BLOG =>QUEST_AUTHOR_INDEX_SECURITY_BLOG,
            QUEST_POST_TYPE_GOVERNMENT_BLOG =>QUEST_AUTHOR_INDEX_GOVERNMENT_BLOG
        ];
        foreach ($resources as $resource){
            if(!empty($mapAuthorIndex[$resource]) && !empty($_authors[$mapAuthorIndex[$resource]])){
                $authors[$mapAuthorIndex[$resource]]=$_authors[$mapAuthorIndex[$resource]];
            }
        }
    }
}
if (!empty($_GET['services'])) {
    $isset_filter=true;
    $services = $_GET['services'];
    $filter_keys['services'] = $services;
    $filters['services'] = quest_array_list_servives();
}
if (!empty($_authors)) {
    $isset_filter=true;
    $filter_keys['owner'] = $authors;
    $list_users = get_users();
    foreach ($list_users as $user) {
        $filters['owner'][$user->ID] = $user->display_name;
    }
}
/* Process params data */
$posts_per_page = !empty($_GET['posts_per_page']) ? $_GET['posts_per_page'] : QUEST_SEARCH_DEFAULT_POSTS_PER_PAGE;
$match = !empty($_GET['match']) ? $_GET['match'] : 'any-words';
$posts_per_page_options = [QUEST_SEARCH_DEFAULT_POSTS_PER_PAGE, 20, 50, 100];
get_header();
?>

<div class="wrapper search-page" id="search-wrapper">

    <div class="custom-header-fulid">
        <div class="bounder">
            <div class="container">
                <div class="img">

                </div>

            </div>
        </div>
    </div>
    <div class="search-form container-fluid d-none">
        <div class="container">
            <h6 class="title">
                <?php printf(esc_html__( 'Search Results for:', 'quest' )); ?>
            </h6>
            <form method="get" id="search-form" action="<?php echo esc_url(home_url('/'));?>" role="search">
                <div class="search-container">
                    <label class="mr-3 sr-only" for="s1">Search for: </label>
                    <input autocomplete="off" class="field form-control" id="s1" name="s" type="text" placeholder="Search" value="<?php echo get_search_query();?>">
                    <button type="submit" class="submit btn btn-link search-toggle d-md-none" name="submit" id="search-submit1" value="Search" alt="Search"><em class="fa fa-search"></em><span style="display:none;">Search</span></button>
                </div>
            </form>
        </div>
    </div>
	<div class="container" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check and opens the primary div -->
			<?php //get_template_part( 'global-templates/left-sidebar-check' ); ?>
            <div class="col-12 mb-3">
                <form method="get" id="search-form" action="<?php echo esc_url(home_url('/'));?>" role="search">
                    <div class="form-inline" >
                        <div class="form-group search-field">
                            <label class="mr-3" for="s2">Search for: </label>
                            <input autocomplete="off" class="field form-control" id="s2" name="s" type="text" placeholder="Search" value="<?php echo get_search_query();?>">
                        </div>
                        <button type="submit" class="btn-search btn btn-success" name="submit" id="search-submit" value="Search" alt="Search">Submit</button>
                        <div class="form-group result-per-page">
                            <label for="select" class="mr-3">Results per page</label>
                            <select name="posts_per_page" class="form-control" id="select" onchange="jQuery(this).closest('form').submit();jQuery(this).closest('form').find('[type=submit]').click();">
                                <?php foreach ($posts_per_page_options as $option) : ?>
                                <option value="<?php echo $option; ?>" <?php echo $option == $posts_per_page ? 'selected' : ''?>>
                                    <?php echo $option; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="match-type">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">Match: </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input"
                                   type="radio" name="match"
                                   id="match-any" value="any-words"
                                   <?php echo ($match == 'all-words') ? '' : 'checked'; ?>>
                            <label class="form-check-label" for="match-any">any search words</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input"
                                   type="radio" name="match"
                                   id="match-all" value="all-words"
                                   <?php echo ($match == 'all-words') ? 'checked' : ''; ?> >
                            <label class="form-check-label" for="match-all">all search words</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12 pb-5">
                <main class="site-main" id="main">

                    <?php if ( have_posts() ) : ?>

                        <header class="page-header">
                            <?php if(get_search_query()!=""): ?>
                            <h1 class="page-title"><?php printf(
                                /* translators:*/
                                 esc_html__( 'Search Results for: %s', 'quest' ),
                                    '<span>' . get_search_query() . '</span>' ); ?></h1>
                            <a class="btn open-left-sidebar">
                                <em class="fa fa-sliders" aria-hidden="true"></em>
                            </a>
                            <?php endif;?>
                            <?php if($isset_filter):?>
                                <div class="search-filter-fluid">
                                    <?php quest_resource_filters($filters, $filter_keys);?>
                                </div>
                            <?php endif;?>
                            <div class="mt-2">
                                <em style="font-size: 0.85rem"><?php echo $wp_query->found_posts?> results found</em>
                            </div>
                            <div class="mt-2">
                                <span><?php echo $wp_query->max_num_pages?> pages of results.</span>
                            </div>
                        </header><!-- .page-header -->
                        <div class="list-search">
                        <?php /* Start the Loop */
                        global $count, $quest_is_any_match, $quest_search_term;
                        $count = !empty($_GET['paged']) ? ($_GET['paged'] - 1) * 10 : 0;

                        // Make regexp pattern for each search term to detect missing term
                        $quest_is_any_match = empty($_REQUEST['match']) || $_REQUEST['match'] != 'all-words';
                        if ($quest_is_any_match) {
                            if (preg_match_all('/".*?("|$)|((?<=[\t ",+])|^)[^\t ",+]+/', get_search_query(), $matches)) {
                                $quest_search_term = [];
                                foreach ($matches[0] as $match) {
                                    $_term = $match;
                                    // Remove chars after *
                                    //$match = preg_replace('/\*.+$/', '*', $match);
                                    // Transfer
                                    $match = preg_replace('/[^\w\d\s\*\?]/','?',$match);
                                    $match = str_replace(['\\*', '\\?'], ['|', '.?'], preg_quote($match));
                                    $quest_search_term[$_term] = ['pattern' => '/' . $match . '/i', 'count' => 0];
                                }
                            }
                        }
                        ?>
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php
                                $count ++;
                            /**
                             * Run the loop for the search to output the results.
                             * If you want to overload this in a child theme then include a file
                             * called content-search.php and that will be used instead.
                             */

                                get_template_part( 'loop-templates/content', 'classicsearch' );
                            ?>
                        <?php endwhile; ?>
                        </div>
                    <?php else : ?>
                        <header class="page-header">
                            <h1 class="page-title" style="line-height: 2" ><?php if(get_search_query()!=""): ?>
                                <?php printf(
                                    /* translators:*/
                                        esc_html__( 'No Results for: %s', 'quest' ),
                                        '<span>"' . get_search_query() . '"</span>' ); ?>
                            <?php else:?>
                                No search query entered
                            <?php endif;?>
                            </h1>
                            <?php if($isset_filter):?>
                            <?php if(get_search_query()!=""): ?>
                                <h1 class="page-title" style="line-height: 2">	&nbsp;in&nbsp;</h1>
                            <?php else: ?>
                                <h1 class="page-title" style="line-height: 2">	No Results for Filter Types:</h1>
                                <?php endif;?>
                                <div class="search-filter-fluid">
                                    <?php quest_resource_filters($filters, $filter_keys, "none");?>
                                </div>
                            <?php endif;?>
                        </header><!-- .page-header -->

                    <?php endif; ?>

                </main><!-- #main -->

			<!-- The pagination component -->
			<?php quest_pagination(); ?>
            </div>
	</div><!-- .row -->

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
