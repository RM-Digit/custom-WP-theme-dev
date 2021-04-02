<?php
if (!defined('ABSPATH')) exit;
require __DIR__ . '/class-quest-theme-settings.php';
require __DIR__ . '/class-post-resource-management.php';
require __DIR__ . '/class-meta-box-pdf.php';
require __DIR__ . '/custom_field/class-meta-box-blog-authors.php';
require __DIR__ . '/class-admin-columns.php';
require __DIR__ . '/custom_field/create_custom_filed_taxonomy.php';
require __DIR__ . '/custom_field/class-meta-box-video.php';
require __DIR__ . '/custom_field/create_meta_box.php';

class Quest_Custom_Meta_Boxes
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
    public $setting = null;
    public $resource = null;
    public $taxonomy = null;
    public $pdf = null;
    public $blog_authors = null;
    public $video_link = null;
    public $admin_columns = null;
    public $information_post = null;

    public function __construct()
    {
        $this->setting = new Quest_Theme_Settings();
        //$this->resource = new Quest_Resource_Management(); Resource no longer support on the page
        $this->taxonomy = new Quest_Custom_Filed_Taxonomy();
        $this->pdf = new Quest_Metabox_PDF();
//        $this->blog_authors = new Quest_MetaBox_Blog_Authors();
        $this->video_link = new Quest_Meta_Box_Video();
        $this->admin_columns = new Quest_Admin_Columns();
        $this->information_post = new Quest_Meta_Box_Information_Post();
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