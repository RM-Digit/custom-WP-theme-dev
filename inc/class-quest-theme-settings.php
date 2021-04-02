<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class Quest_Theme_Settings {

    /**
     * The single instance of WordPress_Plugin_Template_Settings.
     * @var 	object
     * @access  private
     * @since 	1.0.0
     */
    private static $_instance = null;

    /**
     * The main plugin object.
     * @var 	object
     * @access  public
     * @since 	1.0.0
     */
    public $parent = null;

    /**
     * Prefix for plugin settings.
     * @var     string
     * @access  public
     * @since   1.0.0
     */
    public $base = '';
    public $_token = 'quest';

    /**
     * Available settings for plugin.
     * @var     array
     * @access  public
     * @since   1.0.0
     */
    public $settings = array();

    public function __construct (  ) {

        $this->base = 'quest_';

        // Initialise settings
        add_action( 'init', array( $this, 'init_settings' ), 11 );

        // Register plugin settings
        add_action( 'admin_init' , array( $this, 'register_settings' ) );

        // Add settings page to menu
        add_action( 'admin_menu' , array( $this, 'add_menu_item' ) );

        // Add settings link to plugins page
        //add_filter( 'plugin_action_links_' . plugin_basename( $this->parent->file ) , array( $this, 'add_settings_link' ) );
    }

    /**
     * Initialise settings
     * @return void
     */
    public function init_settings () {
        $this->settings = $this->settings_fields();
    }

    /**
     * Add settings page to admin menu
     * @return void
     */
    public function add_menu_item () {
        $page = add_options_page( __( 'Quest Settings', 'quest' ) , __( 'Quest Settings', 'quest' ) , 'manage_options' , $this->_token . '_settings' ,  array( $this, 'settings_page' ) );
        add_action( 'admin_print_styles-' . $page, array( $this, 'settings_assets' ) );
    }

    /**
     * Load settings JS & CSS
     * @return void
     */
    public function settings_assets () {

        // We're including the farbtastic script & styles here because they're needed for the colour picker
        // If you're not including a colour picker field then you can leave these calls out as well as the farbtastic dependency for the wpt-admin-js script below
        //wp_enqueue_style( 'farbtastic' );
        //wp_enqueue_script( 'farbtastic' );

        // We're including the WP media scripts here because they're needed for the image upload field
        // If you're not including an image upload then you can leave this function call out
        wp_enqueue_media();

        /*wp_register_script( $this->_token . '-settings-js', $this->parent->assets_url . 'js/settings' . $this->parent->script_suffix . '.js', array( 'farbtastic', 'jquery' ), '1.0.0' );
        wp_enqueue_script( $this->_token . '-settings-js' );*/
    }

    /**
     * Add settings link to plugin list table
     * @param  array $links Existing links
     * @return array 		Modified links
     */
    public function add_settings_link ( $links ) {
        $settings_link = '<a href="options-general.php?page=' . $this->_token . '_settings">' . __( 'Settings', 'quest' ) . '</a>';
        array_push( $links, $settings_link );
        return $links;
    }

    /**
     * Build settings fields
     * @return array Fields to be displayed on settings page
     */
    private function settings_fields () {
        $social_links = array('linkedin' => 'Linkedin', 'twitter'=>'Twitter', 'facebook'=>'Facebook', 'google-plus'=>'Google Plus', 'youtube'=>'Youtube', 'instagram'=>'Instagram', 'tumblr'=>'Tumblr', 'pinterest'=>'Pinterest', 'flickr'=>'Flickr', 'skype'=>'Skype');
        $settings['general'] = array(
            'title' => __('General', 'quest'),
            'description' => __('These are seting general'),
            'fields' => array(
                array(
                    'id'        => 'phone_number',
                    'label'     => __('Phone', 'quest'),
                    'description'=> __('This is a phone number', 'quest'),
                    'type' => 'text',
                    'default' => '800-326-4220',
                    'placeholder' => '800-326-4220',
                ),
                array(
                    'id'        => 'homepage_url',
                    'label'     => __('Homepage url', 'quest'),
                    'description'=> __('This is a homepage url', 'quest'),
                    'type' => 'text',
                    'default' => 'www.questsys.com',
                    'placeholder' => 'www.questsys.com'
                ),
	            array(
		            'id'        => 'go_analytic_tracking_id',
		            'label'     => __('Google Tracking ID', 'quest'),
		            'description'=> __('This is a Google Analytics Tracking ID', 'quest'),
		            'type' => 'text',
		            'default' => '',
		            'placeholder' => 'UA-128021760-1'
	            ),
	            array(
		            'id'        => 'clicky_analytic_tracking_id',
		            'label'     => __('Clicky Tracking ID', 'quest'),
		            'description'=> __('This is a Clicky Analytics Tracking ID', 'quest'),
		            'type' => 'text',
		            'default' => '100678095',
		            'placeholder' => '100678095'
	            ),
	            array(
		            'id'        => 'slx_web_tracker_code',
		            'label'     => __('Salesfusion Web Tracking Code', 'quest'),
		            'description'=> __('You can get it at Web Tracking Code page in your Salesfusion console', 'quest'),
		            'type' => 'textarea',
		            'default' => '',
		            'placeholder' => ''
	            ),
	            array(
		            'id' 			=> 'slx_tracking_target',
		            'label'			=> __( 'Salesfusion Tracking Target' , 'quest' ),
		            'description'	=> __( '', 'quest' ),
		            'type'			=> 'radio',
		            'default'		=> 1,
		            'options'       => array(1=>'Only pages that contain Salesfusion form', 2=>'All pages in site'),
		            'placeholder'	=> ''
	            ),
	            array(
		            'id'        => 'ip_allow_list',
		            'label'     => __('IP Whitelist', 'quest'),
		            'description'=> __('One IP or IP range (1.2.3.4-5.6.7.8) per line. Only IP addresses are not limited accessibility', 'quest'),
		            'type' => 'textarea',
		            'default' => '',
		            'placeholder' => ''
	            ),
	            array(
		            'id'        => 'ip_deny_list',
		            'label'     => __('IP Blacklist', 'quest'),
		            'description'=> __('One IP or IP range (1.2.3.4-5.6.7.8) per line. IPs cannot access the whole site', 'quest'),
		            'type' => 'textarea',
		            'default' => '',
		            'placeholder' => ''
	            ),
//	            array(
//		            'id'        => 'is_enable_rule',
//		            'label'     => __('Is Enable IP Rules?', 'quest'),
//		            'description'=> __('', 'quest'),
//		            'type' => 'checkbox',
//		            'default' => '',
//		            'placeholder' => ''
//	            ),
            )
        );
        $settings['social'] = array(
            'title'					=> __( 'Social Links', 'quest' ),
            'description'			=> __( 'These are setting social link.', 'quest' ),
            'fields'				=> array(
                array(
                    'id' 			=> 'linkedin_url',
                    'label'			=> __( 'Linkedin' , 'quest' ),
                    'description'	=> __( 'This is a Linkedin page url filed.', 'quest' ),
                    'type'			=> 'text',
                    'default'		=> '',
                    'placeholder'	=> ''
                ),
                array(
                    'id' 			=> 'twitter_url',
                    'label'			=> __( 'Twitter' , 'quest' ),
                    'description'	=> __( 'This is a Twitter page url field.', 'quest' ),
                    'type'			=> 'text',
                    'default'		=> '',
                    'placeholder'	=> ''
                ),
                array(
                    'id' 			=> 'facebook_url',
                    'label'			=> __( 'Facebook' , 'quest' ),
                    'description'	=> __( 'This is a Facebook page url field.', 'quest' ),
                    'type'			=> 'text',
                    'default'		=> '',
                    'placeholder'	=> ''
                ),
                array(
                    'id' 			=> 'google-plus_url',
                    'label'			=> __( 'GooglePlus' , 'quest' ),
                    'description'	=> __( 'This is a Google plus page url field.', 'quest' ),
                    'type'			=> 'text',
                    'default'		=> '',
                    'placeholder'	=> ''
                ),
                array(
                    'id' 			=> 'youtube_url',
                    'label'			=> __( 'Youtube' , 'quest' ),
                    'description'	=> __( 'This is a Youtube page url field.', 'quest' ),
                    'type'			=> 'text',
                    'default'		=> '',
                    'placeholder'	=> ''
                ),
                array(
                    'id' 			=> 'instagram_url',
                    'label'			=> __( 'Instagram' , 'quest' ),
                    'description'	=> __( 'This is a Instagram page url field.', 'quest' ),
                    'type'			=> 'text',
                    'default'		=> '',
                    'placeholder'	=> ''
                ),
                array(
                    'id' 			=> 'tumblr_url',
                    'label'			=> __( 'Tumblr' , 'quest' ),
                    'description'	=> __( 'This is a Tumblr page url field.', 'quest' ),
                    'type'			=> 'text',
                    'default'		=> '',
                    'placeholder'	=> ''
                ),
                array(
                    'id' 			=> 'pinterest_url',
                    'label'			=> __( 'Pinterest' , 'quest' ),
                    'description'	=> __( 'This is a Pinterest url field.', 'quest' ),
                    'type'			=> 'text',
                    'default'		=> '',
                    'placeholder'	=> ''
                ),
                array(
                    'id' 			=> 'flickr_url',
                    'label'			=> __( 'Flickr' , 'quest' ),
                    'description'	=> __( 'This is a Flickr page url field.', 'quest' ),
                    'type'			=> 'text',
                    'default'		=> '',
                    'placeholder'	=> ''
                ),
                array(
                    'id' 			=> 'skype_url',
                    'label'			=> __( 'Skype' , 'quest' ),
                    'description'	=> __( 'This is a Skype url field.', 'quest' ),
                    'type'			=> 'text',
                    'default'		=> '',
                    'placeholder'	=> ''
                ),
                array(
					'id' 			=> 'social_items',
					'label'			=> __( 'Show Items', 'quest' ),
					'description'	=> __( 'You can select multiple items and they will be show in footer (only show 4 items).', 'quest' ),
					'type'			=> 'checkbox_multi',
					'options'		=> $social_links,
					'default'		=> array( 'linkedin', 'twitter', 'facebook', 'google-plus')
				)
            )
        );
        $page_args= array(
            'meta_key' => '_wp_page_template',
            'meta_value' => 'page-templates/resource.php'
         );
        $the_pages = get_pages( $page_args  );
        $list_page = array();
        foreach($the_pages as $page){
            $list_page[$page->ID] = $page->post_title;
        }
        $settings['pages'] = array(
            'title'					=> __( 'Pages', 'quest' ),
            'description'			=> __( 'These are setting pages.', 'quest' ),
            'fields'				=> array(
                array(
                    'id' 			=> 'resource_page_id',
                    'label'			=> __( 'Resource Page', 'quest' ),
                    'description'	=> __( 'Select resource page.', 'quest' ),
                    'type'			=> 'select',
                    'options'		=> $list_page,
                ),
                array(
                    'id' 			=> 'title_relate_service_id',
                    'label'			=> __( 'Title relate service', 'quest' ),
                    'description'	=> __( 'Title relate service.', 'quest' ),
                    'type'			=> 'text',
                    'default'		=> 'Relate Service',
                    'placeholder'	=> ''
                ),
                array(
                    'id' 			=> 'content_relate_service_id',
                    'label'			=> __( 'Content relate service', 'quest' ),
                    'description'	=> __( 'Content relate service.', 'quest' ),
                    'type'			=> 'textarea',
                    'default'		=> '',
                    'placeholder'	=> ''
                ),
//	            array(
//		            'id' 			=> 'is_display_cta_button_id',
//		            'label'			=> __( 'Display CTA button?', 'quest' ),
//		            'description'	=> __( 'Display CTA button below the author\'s headshot in all the blog page', 'quest' ),
//		            'type'			=> 'radio',
//		            'default'		=> false,
//		            'options'       => array(true=>'Yes: Display CTA button.', false=>'No: Hide CTA button'),
//		            'placeholder'	=> ''
//	            ),
//	            array(
//		            'id' 			=> 'cta_button_name_id',
//		            'label'			=> __( 'CTA button name', 'quest' ),
//		            'description'	=> __( 'CTA button name', 'quest' ),
//		            'type'			=> 'text',
//		            'default'		=> 'Contact Us',
//		            'placeholder'	=> ''
//	            ),
//	            array(
//		            'id' 			=> 'cta_button_link_id',
//		            'label'			=> __( 'CTA button link', 'quest' ),
//		            'description'	=> __( 'CTA button link', 'quest' ),
//		            'type'			=> 'text',
//		            'default'		=> 'https://www.questsys.com/contact/?utm_source=Blog&utm_medium=footer&utm_campaign=Compliance%20Auditing%20Changes',
//		            'placeholder'	=> ''
//	            ),
            )
        );
        // Add the list archive pages
        $_list_custom_post_types = [
                QUEST_POST_TYPE_CUSTOMER_STORY => 'Customer Stories',
            QUEST_POST_TYPE_THANK_YOU =>'Thank you',
            QUEST_POST_TYPE_EVENT =>'Quest Event',
            QUEST_POST_TYPE_VENDOR => 'Vendor'
        ];
        $list_page = [ 0=>'-- Use default archive page --',-1=>'> Redirect to Homepage'];
        $page_args=['post_type'=>'page'];
        $the_pages = get_pages( $page_args  );
        foreach($the_pages as $page){
            $list_page[$page->ID] = $page->post_title;
        }
        foreach ($_list_custom_post_types as $_post_type=>$_name){
            array_push($settings['pages']['fields'], array(
                'id' 			=> 'archive_alternative_page_'.$_post_type,
                'label'			=> __( $_name, 'quest' ),
                'description'	=> __( 'Select alternative page for the archive page of '.$_name, 'quest' ),
                'type'			=> 'select',
                'options'		=> $list_page,
            ));
        }
        $settings['mail_smtp'] = array(
            'title'					=> __( 'Mail SMTP', 'quest' ),
            'description'			=> __( 'Configure the mail SMTP.', 'quest' ),
            'fields'				=> array(
                array(
                    'id' 			=> 'smtp_host',
                    'label'			=> __( 'SMTP Host' , 'quest' ),
                    'description'	=> __( 'The hostname for your SMTP server.', 'quest' ),
                    'type'			=> 'text',
                    'default'		=> SMTP_HOST,
                    'placeholder'	=> ''
                ),
                array(
                    'id' 			=> 'smtp_auth',
                    'label'			=> __( 'SMTP Auth' , 'quest' ),
                    'description'	=> __( 'Select yes if your SMTP server requires authentication.', 'quest' ),
                    'type'			=> 'radio',
                    'default'		=> SMTP_AUTH,
                    'options'       => array(true=>'Yes: Use SMTP authentication.', false=>'No: Do not use SMTP authentication'),
                    'placeholder'	=> ''
                ),
                array(
                    'id' 			=> 'smtp_port',
                    'label'			=> __( 'SMTP Port' , 'quest' ),
                    'description'	=> __( 'The port your server works on', 'quest' ),
                    'type'			=> 'text',
                    'default'		=> SMTP_PORT,
                    'placeholder'	=> ''
                ),
                array(
                    'id' 			=> 'smtp_secure',
                    'label'			=> __( 'SMTP Secure' , 'quest' ),
                    'description'	=> __( 'If you have SSL/TLS encryption available for that hostname, select it here.', 'quest' ),
                    'type'			=> 'text',
                    'default'		=> SMTP_SECURE,
                    'placeholder'	=> ''
                ),
                array(
                    'id' 			=> 'smtp_username',
                    'label'			=> __( 'SMTP Username' , 'quest' ),
                    'description'	=> __( 'Username for SMTP authentication.', 'quest' ),
                    'type'			=> 'text',
                    'default'		=> SMTP_USERNAME,
                    'placeholder'	=> ''
                ),
                array(
                    'id' 			=> 'smtp_password',
                    'label'			=> __( 'SMTP Password' , 'quest' ),
                    'description'	=> __( 'Password for SMTP authentication.', 'quest' ),
                    'type'			=> 'text',
                    'default'		=> SMTP_PASSWORD,
                    'placeholder'	=> ''
                ),
                array(
                    'id' 			=> 'smtp_from',
                    'label'			=> __( 'SMTP From Email' , 'quest' ),
                    'description'	=> __( 'You can specify the email address that emails should be sent from.', 'quest' ),
                    'type'			=> 'text',
                    'default'		=> SMTP_FROM,
                    'placeholder'	=> ''
                ),
                array(
                    'id' 			=> 'smtp_fromname',
                    'label'			=> __( 'SMTP Form Name' , 'quest' ),
                    'description'	=> __( 'You can specify the name that emails should be sent from.', 'quest' ),
                    'type'			=> 'text',
                    'default'		=> SMTP_FROMNAME,
                    'placeholder'	=> ''
                )
            )
        );

        $settings = apply_filters( $this->_token . '_settings_fields', $settings );

        return $settings;
    }

    /**
     * Register plugin settings
     * @return void
     */
    public function register_settings () {
        if ( is_array( $this->settings ) ) {

            // Check posted/selected tab
            $current_section = '';
            if ( isset( $_POST['tab'] ) && $_POST['tab'] ) {
                $current_section = $_POST['tab'];
            } else {
                if ( isset( $_GET['tab'] ) && $_GET['tab'] ) {
                    $current_section = $_GET['tab'];
                }
            }

            foreach ( $this->settings as $section => $data ) {

                if ( $current_section && $current_section != $section ) continue;

                // Add section to page
                add_settings_section( $section, $data['title'], array( $this, 'settings_section' ), $this->_token . '_settings' );

                foreach ( $data['fields'] as $field ) {

                    // Validation callback for field
                    $validation = '';
                    if ( isset( $field['callback'] ) ) {
                        $validation = $field['callback'];
                    }

                    // Register field
                    $option_name = $this->base . $field['id'];
                    register_setting( $this->_token . '_settings', $option_name, $validation );

                    // Add field to page
                    add_settings_field( $field['id'], $field['label'], array( $this, 'display_field' ), $this->_token . '_settings', $section, array( 'field' => $field, 'prefix' => $this->base ) );
                }

                if ( ! $current_section ) break;
            }
        }
    }

    public function settings_section ( $section ) {
        $html = '<p> ' . $this->settings[ $section['id'] ]['description'] . '</p>' . "\n";
        echo $html;
    }

    /**
     * Load settings page content
     * @return void
     */
    public function settings_page () {

        // Build page HTML
        $html = '<div class="wrap" id="' . $this->_token . '_settings">' . "\n";
        $html .= '<h2>' . __( 'Plugin Settings' , 'quest' ) . '</h2>' . "\n";

        $tab = '';
        if ( isset( $_GET['tab'] ) && $_GET['tab'] ) {
            $tab .= $_GET['tab'];
        }

        // Show page tabs
        if ( is_array( $this->settings ) && 1 < count( $this->settings ) ) {

            $html .= '<h2 class="nav-tab-wrapper">' . "\n";

            $c = 0;
            foreach ( $this->settings as $section => $data ) {

                // Set tab class
                $class = 'nav-tab';
                if ( ! isset( $_GET['tab'] ) ) {
                    if ( 0 == $c ) {
                        $class .= ' nav-tab-active';
                    }
                } else {
                    if ( isset( $_GET['tab'] ) && $section == $_GET['tab'] ) {
                        $class .= ' nav-tab-active';
                    }
                }

                // Set tab link
                $tab_link = add_query_arg( array( 'tab' => $section ) );
                if ( isset( $_GET['settings-updated'] ) ) {
                    $tab_link = remove_query_arg( 'settings-updated', $tab_link );
                }

                // Output tab
                $html .= '<a href="' . $tab_link . '" class="' . esc_attr( $class ) . '">' . esc_html( $data['title'] ) . '</a>' . "\n";

                ++$c;
            }

            $html .= '</h2>' . "\n";
        }

        $html .= '<form method="post" action="options.php" enctype="multipart/form-data">' . "\n";

        // Get settings fields
        ob_start();
        settings_fields( $this->_token . '_settings' );
        do_settings_sections( $this->_token . '_settings' );
        $html .= ob_get_clean();

        $html .= '<p class="submit">' . "\n";
        $html .= '<input type="hidden" name="tab" value="' . esc_attr( $tab ) . '" />' . "\n";
        $html .= '<input name="Submit" type="submit" class="button-primary" value="' . esc_attr( __( 'Save Settings' , 'quest' ) ) . '" />' . "\n";
        $html .= '</p>' . "\n";
        $html .= '</form>' . "\n";
        $html .= '</div>' . "\n";

        echo $html;
    }
    /**
     * Generate HTML for displaying fields
     * @param  array   $field Field data
     * @param  boolean $echo  Whether to echo the field HTML or return it
     * @return void
     */
    public function display_field ( $data = array(), $post = false, $echo = true ) {
        // Get field info
        if ( isset( $data['field'] ) ) {
            $field = $data['field'];
        } else {
            $field = $data;
        }
        // Check for prefix on option name
        $option_name = '';
        if ( isset( $data['prefix'] ) ) {
            $option_name = $data['prefix'];
        }
        // Get saved data
        $data = '';
        if ( $post ) {
            // Get saved field data
            $option_name .= $field['id'];
            $option = get_post_meta( $post->ID, $field['id'], true );
            // Get data to display in field
            if ( isset( $option ) ) {
                $data = $option;
            }
        } else {
            // Get saved option
            $option_name .= $field['id'];
            $option = get_option( $option_name );
            // Get data to display in field
            if ( isset( $option ) ) {
                $data = $option;
            }
        }
        // Show default data if no option saved and default is supplied
        if ( $data === false && isset( $field['default'] ) ) {
            $data = $field['default'];
        } elseif ( $data === false ) {
            $data = '';
        }
        $html = '';
        switch( $field['type'] ) {
            case 'text':
            case 'url':
            case 'email':
                $html .= '<input id="' . esc_attr( $field['id'] ) . '" type="text" name="' . esc_attr( $option_name ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '" value="' . esc_attr( $data ) . '" />' . "\n";
                break;
            case 'password':
            case 'number':
            case 'hidden':
                $min = '';
                if ( isset( $field['min'] ) ) {
                    $min = ' min="' . esc_attr( $field['min'] ) . '"';
                }
                $max = '';
                if ( isset( $field['max'] ) ) {
                    $max = ' max="' . esc_attr( $field['max'] ) . '"';
                }
                $html .= '<input id="' . esc_attr( $field['id'] ) . '" type="' . esc_attr( $field['type'] ) . '" name="' . esc_attr( $option_name ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '" value="' . esc_attr( $data ) . '"' . $min . '' . $max . '/>' . "\n";
                break;
            case 'text_secret':
                $html .= '<input id="' . esc_attr( $field['id'] ) . '" type="text" name="' . esc_attr( $option_name ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '" value="" />' . "\n";
                break;
            case 'textarea':
                $html .= '<textarea id="' . esc_attr( $field['id'] ) . '" rows="8" cols="50" name="' . esc_attr( $option_name ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '">' . $data . '</textarea><br/>'. "\n";
                break;
            case 'checkbox':
                $checked = '';
                if ( $data && 'on' == $data ) {
                    $checked = 'checked="checked"';
                }
                $html .= '<input id="' . esc_attr( $field['id'] ) . '" type="' . esc_attr( $field['type'] ) . '" name="' . esc_attr( $option_name ) . '" ' . $checked . '/>' . "\n";
                break;
            case 'checkbox_multi':
                foreach ( $field['options'] as $k => $v ) {
                    $checked = false;
                    if ( in_array( $k, (array) $data ) ) {
                        $checked = true;
                    }
                    $html .= '<p><label for="' . esc_attr( $field['id'] . '_' . $k ) . '" class="checkbox_multi"><input type="checkbox" ' . checked( $checked, true, false ) . ' name="' . esc_attr( $option_name ) . '[]" value="' . esc_attr( $k ) . '" id="' . esc_attr( $field['id'] . '_' . $k ) . '" /> ' . $v . '</label></p> ';
                }
                break;
            case 'radio':
                foreach ( $field['options'] as $k => $v ) {
                    $checked = false;
                    if ( $k == $data ) {
                        $checked = true;
                    }
                    $html .= '<label for="' . esc_attr( $field['id'] . '_' . $k ) . '"><input type="radio" ' . checked( $checked, true, false ) . ' name="' . esc_attr( $option_name ) . '" value="' . esc_attr( $k ) . '" id="' . esc_attr( $field['id'] . '_' . $k ) . '" /> ' . $v . '</label><br/> ';
                }
                break;
            case 'select':
                $html .= '<select name="' . esc_attr( $option_name ) . '" id="' . esc_attr( $field['id'] ) . '">';
                foreach ( $field['options'] as $k => $v ) {
                    $selected = false;
                    if ( $k == $data ) {
                        $selected = true;
                    }
                    $html .= '<option ' . selected( $selected, true, false ) . ' value="' . esc_attr( $k ) . '">' . $v . '</option>';
                }
                $html .= '</select> ';
                break;
            case 'select_multi':
                $html .= '<select name="' . esc_attr( $option_name ) . '[]" id="' . esc_attr( $field['id'] ) . '" multiple="multiple">';
                foreach ( $field['options'] as $k => $v ) {
                    $selected = false;
                    if ( in_array( $k, (array) $data ) ) {
                        $selected = true;
                    }
                    $html .= '<option ' . selected( $selected, true, false ) . ' value="' . esc_attr( $k ) . '">' . $v . '</option>';
                }
                $html .= '</select> ';
                break;
            case 'image':
                $image_thumb = '';
                if ( $data ) {
                    $image_thumb = wp_get_attachment_thumb_url( $data );
                }
                $html .= '<img id="' . $option_name . '_preview" class="image_preview" src="' . $image_thumb . '" /><br/>' . "\n";
                $html .= '<input id="' . $option_name . '_button" type="button" data-uploader_title="' . __( 'Upload an image' , 'quest' ) . '" data-uploader_button_text="' . __( 'Use image' , 'quest' ) . '" class="image_upload_button button" value="'. __( 'Upload new image' , 'quest' ) . '" />' . "\n";
                $html .= '<input id="' . $option_name . '_delete" type="button" class="image_delete_button button" value="'. __( 'Remove image' , 'quest' ) . '" />' . "\n";
                $html .= '<input id="' . $option_name . '" class="image_data_field" type="hidden" name="' . $option_name . '" value="' . $data . '"/><br/>' . "\n";
                break;
            case 'color':
                ?><div class="color-picker" style="position:relative;">
                <input type="text" name="<?php esc_attr_e( $option_name ); ?>" class="color" value="<?php esc_attr_e( $data ); ?>" />
                <div style="position:absolute;background:#FFF;z-index:99;border-radius:100%;" class="colorpicker"></div>
                </div>
                <?php
                break;

            case 'editor':
                wp_editor($data, $option_name, array(
                    'textarea_name' => $option_name
                ) );
                break;
        }
        switch( $field['type'] ) {
            case 'checkbox_multi':
            case 'select_multi':
                $html .= '<br/><span class="description">' . $field['description'] . '</span>';
                break;
            default:
                if ( ! $post ) {
                    $html .= '<label for="' . esc_attr( $field['id'] ) . '">' . "\n";
                }
                $html .= '<span class="description">' . $field['description'] . '</span>' . "\n";
                if ( ! $post ) {
                    $html .= '</label>' . "\n";
                }
                break;
        }
        if ( ! $echo ) {
            return $html;
        }
        echo $html;
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
    public static function instance ( $parent ) {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self( $parent );
        }
        return self::$_instance;
    } // End instance()

    /**
     * Cloning is forbidden.
     *
     * @since 1.0.0
     */
    public function __clone () {
        _doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), 1 );
    } // End __clone()

    /**
     * Unserializing instances of this class is forbidden.
     *
     * @since 1.0.0
     */
    public function __wakeup () {
        _doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), 1 );
    } // End __wakeup()

}
