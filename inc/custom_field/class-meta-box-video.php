<?php
if (!defined('ABSPATH')) exit;

class Quest_Meta_Box_Video
{
    /**
     * The single instance of WordPress_Plugin_Template_Settings.
     * @var    object
     * @access  private
     * @since    1.0.0
     */
    private static $_instance = null;
    /**
     * The main plugin object.
     * @var    object
     * @access  public
     * @since    1.0.0
     */

    public function __construct()
    {
        add_action('add_meta_boxes', array($this, 'resource_meta_box_activation'));
        add_action('save_post', array($this, 'quest_save_video_link'));
    }

    public function resource_meta_box_activation()
    {
        add_meta_box(
            'quest-resource-video-link',
            __( 'Youtube video link', 'quest'),
            array($this,'quest_output_video_link'),
            QUEST_POST_TYPE_RESOURCE_VIDEO,
            'normal',
            'high'
        );
    }

   public function quest_output_video_link($post){
       wp_nonce_field( 'resource_video_link', 'resource_video_link_nonce' ); ?>

       <?php
       $video_link = get_post_meta( $post->ID, 'video-link', true );
       ?>
       <p>
           <label for="video-link"><?php _e('Video link', 'quest' ); ?></label><br/>
           <input type="text" class="widefat video-link" name="video-link" value="<?php echo esc_html( $video_link ); ?>" />
       </p>

       <?php
   }

   public function quest_save_video_link($post_id){
       if( !isset( $_POST['resource_video_link_nonce'] ) || !wp_verify_nonce( $_POST['resource_video_link_nonce'],'resource_video_link') )
           return;

       if ( !current_user_can( 'edit_post', $post_id ))
           return;

       if ( isset($_POST['video-link']) ) {
           update_post_meta($post_id, 'video-link',  sanitize_text_field($_POST['video-link']));
       }
   }

    /**
     * Main WordPress_Plugin_Template_Settings Instance
     *
     * Ensures only one instance of WordPress_Plugin_Template_Settings is loaded or can be loaded.
     *
     * @since 1.0.0
     * @static
     * @see WordPress_Plugin_Template()
     * @return Main WordPress_Plugin_Template_Settings instance
     */
    public
    static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    } // End instance()

    /**
     * Cloning is forbidden.
     *
     * @since 1.0.0
     */
    public
    function __clone()
    {
        _doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?'), $this->parent->_version);
    } // End __clone()

    /**
     * Unserializing instances of this class is forbidden.
     *
     * @since 1.0.0
     */
    public
    function __wakeup()
    {
        _doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?'), $this->parent->_version);
    } // End __wakeup()
}
