<?php
function fb_add_custom_user_profile_fields( $user ) {
    if(!current_user_can('edit_users')){
        return '';
    }
	?>
	<h3><?php _e('Extra Profile Information', 'quest'); ?></h3>

	<table class="form-table">
		<tr>
			<th>
				<label for="user_title"><?php _e('Title', 'quest'); ?>
				</label></th>
			<td>
				<input type="text" name="user_title" id="user_title" value="<?php echo esc_attr( get_the_author_meta( 'user_title', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e('Please enter your title.', 'quest'); ?></span>
			</td>
		</tr>
        <tr>
            <th>
                <label for="author_for"><?php _e('Author for', 'quest'); ?>
                </label></th>
            <td>
                <?php
                    $blog_post_types = quest_blog_post_types();
                    $author_for = get_the_author_meta( 'author_for', $user->ID );
                    $author_for_order = get_the_author_meta( 'author_for_order', $user->ID );
                    if(empty($author_for_order)){
                        $author_for_order=quest_get_author_index($author_for);
                    }
                ?>
                <div class="fs-wrap multiple" tabindex="0">
                    <select name="author_for" onchange="suggestDefaultOrder(this)">
                        <option value="">Select</option>
			            <?php foreach ($blog_post_types as $post_type) : ?>
                            <option order="<?php echo quest_get_author_index($post_type)?>" <?php echo $post_type == $author_for ? 'selected' : '';?> value="<?php echo $post_type; ?>">
                                <?php $type = get_post_type_object($post_type); ?>
                                <?php echo $type ? $type->labels->singular_name : '' ?>
                            </option>
			            <?php endforeach; ?>
                    </select>
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label for="author_for_order"><?php _e('Order', 'quest'); ?>
                </label></th>
            <td>
                <input type="number" step="1" min="0" name="author_for_order" id="author_for_order" value="<?php echo esc_attr( $author_for_order ); ?>" class="regular-text" /><br />
                <span class="description"><?php _e('Please enter the order in Quest Blog Page.', 'quest'); ?></span>
            </td>
        </tr>
	</table>
    <script>
        function suggestDefaultOrder(dom) {
if(window.jQuery){
    var author = jQuery(dom);
    var select = author.find('option:selected');
    var order = select.attr('order');
    var orderInput = jQuery('[name=author_for_order]');
    if(order) {
        orderInput.val(order);
    } else {
        orderInput.val('');
    }
}
        }
    </script>
<?php }

function fb_save_custom_user_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return FALSE;

	update_usermeta( $user_id, 'user_title', $_POST['user_title'] );
	update_usermeta( $user_id, 'author_for', $_POST['author_for'] );
	update_usermeta( $user_id, 'author_for_order', $_POST['author_for_order'] );
}

add_action( 'show_user_profile', 'fb_add_custom_user_profile_fields' );
add_action( 'edit_user_profile', 'fb_add_custom_user_profile_fields' );

add_action( 'personal_options_update', 'fb_save_custom_user_profile_fields' );
add_action( 'edit_user_profile_update', 'fb_save_custom_user_profile_fields' );
