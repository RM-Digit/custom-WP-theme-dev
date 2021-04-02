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
$services = get_terms(QUEST_TAXONOMY_SERVICE, array('parent'=> 0, 'hide_empty'=> false, 'orderby' => 'id', 'order' => 'ASC'));
$params_archive = !empty($_GET['archive']) ? $_GET['archive'] : '';
$archive_resource = $params_resource;

if (is_resource_page()) {
    $action_url = esc_url(get_permalink());
    if(empty($archive_resource)){
        $archive_resource = quest_get_post_types('resources');
    }
} elseif ($IS_ARCHIVE_PAGE) {
    $action_url = esc_url(get_post_type_archive_link($post_type));
} elseif($IS_SUB_SERVICE_ARCHIVE){
    $action_url = esc_url(get_permalink(get_option('quest_resource_page_id')));
}
$params_service = !empty($_GET['services']) ? $_GET['services'] : array();
if($IS_SUB_SERVICE_ARCHIVE) {
    $params_service[]=get_query_var('term');
}

$disabled_url_class=(sizeof($params_service) || sizeof($params_resource)) ? ' bar-a-ref-disabled':'';

?>
<div class="col-md-3 widget-area" id="left-sidebar" role="complementary" data-request = "<?php print_r($_GET['resources']) ?>">
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
			<?php //print_r($services);
		//	echo QUEST_TAXONOMY_SERVICE; 
		?>
			 <div class="quest-left-sidebar service">
			 <h5>Service Type</h5>
			<ul>
            <?php foreach($services as $parent):?>
                <div class=" <?php echo strtolower($parent->name);?>">
					
                    <li><?php
						$serviceC = array("cybersecurity", "managed-it-cloud", "disaster-recovery", "professional-services", "it-infrastructure", "products");
                        if(in_array($parent->slug, $serviceC)): ?>
						<label>
							<input type="checkbox" name="services[]" class="resource-item" value="<?php echo $parent->slug ; ?>" <?php echo in_array($parent->slug, $params_service) ? 'checked' : '';?> /><a class="bar-a-ref-disabled" href="<?php echo '/resources/services-res-'.$parent->slug; ?>/"><?php echo $parent->name ;?></a><span class="checkmark"></span>
							</label>
                       </li>
                    <?php endif;
					?>
					<?php /*
                    <ul>
                        <?php $child = get_terms(QUEST_TAXONOMY_SERVICE, array('parent'=> $parent->term_id, 'hide_empty'=> false, 'orderby' => 'id', 'order' => 'ASC'));
                        $ordered_term = [];
                        foreach($child as $item) {
                            $ordered_term_index = get_term_meta( $item->term_id, 'ordering', true );
                            $ordered_term_index = empty($ordered_term_index) ? "999_{$item->term_id}"  : "{$ordered_term_index}_{$item->term_id}";
                            $ordered_term[$ordered_term_index] = $item;
                        }
                        ksort( $ordered_term );
                        foreach($ordered_term as $item) {
                           $item_ref='<a class="bar-a-ref'.$disabled_url_class.'" href="'/.$parent->slug/.'services-res-'.$item->slug.'/">'.$item->name.'</a>'; 
                            ?>
                            <li>
                                <?php if($IS_SUB_SERVICE_ARCHIVE):?>
                                    <label><a href="<?php echo get_term_link($item);?>">
                                            <input type="radio" name="services[]" class="services-item" value="<?php echo $item->slug;?>" <?php echo in_array($item->slug, $params_service) ? 'checked' : '';?>><?php echo $item->name;?><span class="checkmark"></span></a></label>
                                <?php else:?>
                                    <label><input type="checkbox" name="services[]" class="services-item" value="<?php echo $item->slug;?>" <?php echo in_array($item->slug, $params_service) ? 'checked' : '';?>><?php echo $item_ref;?><span class="checkmark"></span></label>
                                <?php endif;?>
                            </li>
                        <?php }?>
                    </ul>
                </div>
             <!--   <div class="line-hight"></div> --> */ ?>
				</div>
            <?php endforeach;?>
			</ul>
		</div>
            <?php if($IS_ARCHIVE_PAGE){ ?>
                <div class="quest-left-sidebar resource">
                    <?php
                    quest_custom_archive(array(
                        'resources'=>$archive_resource,
                        'services'=>$params_service,
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
	                    $sort_resource = array( 'customer-story' => 'Customer Stories', 'quest-blog' => 'Blogs', 'video' => 'Videos', 'solution-brief' => 'On-Demand Content', 'newsletter' => 'Newsletters', 'press-release' => 'Press Releases', 'clip' => 'News Clips', 'infographic' => 'Infographics' );
	                     foreach($sort_resource as $key => $value) { 
                            ?>
                        	<li>
                                <label><input type="checkbox" name="resources[]" class="resource-item" value="<?php echo $key;?>" <?php echo in_array($key, $params_resource) ? 'checked' : '';?>><a class="bar-a-ref<?php echo $disabled_url_class; ?>" href="<?php echo $action_url.'resources-res-'.$key; ?>/"><?php echo $value;?></a><span class="checkmark"></span></label>
                            </li>
						 <?php }; /*
                        //manually add quest blog as resource as it's not a post type
                        $resources['quest-blog'] = 'Blogs';
                        $array_for_sidebar_filter = ['Workshops','CEO Blogs','Cybersecurity Blogs','Partner Blogs'];
                        foreach($array_for_sidebar_filter as $value){

                            if (($key = array_search($value, $resources)) !== false) {
                                unset($resources[$key]);
                            }

                        }
                        foreach($resources as $key => $value) {
                            ?>
                            <?php
                            if(in_array($key,[QUEST_POST_TYPE_PARTNER_BLOG,QUEST_POST_TYPE_GOVERNMENT_BLOG, QUEST_POST_TYPE_SECURITY_BLOG]) && is_search()){ continue;
                            }

                            if (in_array($key, [QUEST_POST_TYPE_GOVERNMENT_BLOG]))
                                continue;
                            ?>
                            <li>
                                <label><input type="checkbox" name="resources[]" class="resource-item" value="<?php echo $key;?>" <?php echo in_array($key, $params_resource) ? 'checked' : '';?>><a class="bar-a-ref<?php echo $disabled_url_class; ?>" href="<?php echo $action_url.'resources-res-'.$key; ?>/"><?php echo $value;?></a><span class="checkmark"></span></label>
                            </li>
                        <?php };  */  ?>
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
