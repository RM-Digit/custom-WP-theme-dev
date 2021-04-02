<?php
if (!defined('ABSPATH')) exit;

class Quest_Admin_Columns
{
    private static $_instance = null;

    public function __construct()
    {

        add_filter( 'manage_posts_columns', array($this, 'set_custom_edit_book_columns') );
        add_action( 'manage_posts_custom_column' , array($this,'custom_book_column'), 10, 2 );
        add_filter( 'manage_page_posts_columns', array($this, 'set_custom_edit_book_columns') );
        add_action( 'manage_page_posts_custom_column' , array($this,'custom_book_column'), 10, 2 );
    }
    function set_custom_edit_book_columns($columns) {
        $columns['quest_old_link'] = __( 'Old Link', 'quest' );

        return $columns;
    }

    function custom_book_column( $column, $post_id ) {
        switch ( $column ) {

            case 'quest_old_link' :
                $_url = get_post_meta( $post_id , 'old-link' , true );
                if(!empty($_url)) {
                    echo '<a target="_blank" href="'.$_url.'">'.preg_replace('/https?:\/\/[^\\/]+\//i','',$_url).'</a>';
                }
                break;

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