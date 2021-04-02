<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package quest
 */
?>
<?php

$IS_SUB_SERVICE_ARCHIVE=is_tax(QUEST_TAXONOMY_SERVICE);
$IS_ARCHIVE_PAGE = is_archive() && !$IS_SUB_SERVICE_ARCHIVE;
$action_url = esc_url(home_url('/'));
$params_owner = !empty($_GET['owner']) ? $_GET['owner'] : array();
$params_resource = !empty($_GET['resources']) ? $_GET['resources'] : array();
$post_type = empty($params_resource) ? QUEST_POST_TYPE_CEO_BLOG : $params_resource[0];
$params_archive = !empty($_GET['archive']) ? $_GET['archive'] : '';
$archive_resource = $params_resource;


$action_url = esc_url(get_permalink());
if(empty($archive_resource)){
    $archive_resource = quest_get_post_types('resources');
}
    
if ($IS_ARCHIVE_PAGE) {
    $action_url = esc_url(get_post_type_archive_link($post_type));
} elseif($IS_SUB_SERVICE_ARCHIVE){
    $action_url = esc_url(get_permalink(get_option('quest_resource_page_id')));
}

$disabled_url_class=(sizeof($params_resource)) ? ' bar-a-ref-disabled':'';

?>
<div class="col-md-3 widget-area" id="left-sidebar" role="complementary">
    <form id="form-left-sidebar" method="GET" action="<?php echo $action_url; ?>">
        <?php
        if(!empty($params_owner)) foreach ($params_owner as $key=>$owner){
            echo '<input name="owner['.$key.']" value="'.$owner.'" type="hidden"/>';
        }
        ?>
        <?php if (is_search()): ?>
            <input type="hidden" name="s" value="<?php echo get_search_query(); ?>">
        <?php endif; ?>
        <div class="sidebar-header">
            <h6>Clear All</h6>
            <a class="close" href="javascript:void(0)"><em class="fa fa-times" aria-hidden="true"></em><span style="display:none;">Close</span></a>
        </div>
        <div class="sidebar-content">
            <?php if($IS_ARCHIVE_PAGE){ ?>
            <div class="quest-left-sidebar resource">
                <?php
                    quest_custom_archive(array(
                        'resources'=>$archive_resource,
                        'archive'=>$params_archive
                    ));
                ?>
            </div>
            <?php }else{ ?>
            <div class="quest-left-sidebar resource">
                <h5>Resource Type</h5>
                <ul>
                    <?php 
                        $resources = quest_get_post_types('resources', 'array');
                        foreach($resources as $key => $value) {
                    ?>
                        <?php 
                            if(!in_array($key,['solution-brief','video','infographic'])){ 
                                continue;
                            }
                        ?>
                    <li>
                        <label><input type="checkbox" name="resources[]" class="resource-item" value="<?php echo $key;?>" <?php echo in_array($key, $params_resource) ? 'checked' : '';?>><a class="bar-a-ref<?php echo $disabled_url_class; ?>" href="<?php echo $action_url.'resources-res-'.$key; ?>/"><?php echo $value;?></a><span class="checkmark"></span></label>
                    </li>
                    <?php };?>
                </ul>
            </div>
            <?php }?>
<!--            <div class="quest-left-sidebar sort">-->
<!--                <div class="line-hight"></div>-->
<!--                <h5>Sort</h5>-->
<!--                <div class="sort-drop-down drop-down">-->
<!--                    --><?php //quest_sortable();?>
<!--                </div>-->
<!--            </div>-->
        </div>
        <div class="sidebar-footer">
            <button class="btn btn-filter" type="submit"><span>Filter</span></button>
        </div>
    </form>
</div><!-- #left-sidebar -->
