<?php
/**
 * The class use for extending basing widget class
 * @package Quest
 */

class Base_Custom_Widget extends WP_Widget
{
    /**
     * Array structure:
     * $widget_field = array(
     *    'item1' => array(
     *        'quest_widgets_name' => 'name',
     *        'quest_widgets_title' => 'title',
     *        'quest_widgets_field_type' => 'type' //
     *        'quest_widgets_field_options' => array() // 1 or 2 level
     *        'quest_widgets_description' => 'description'
     *    ),
     * )
     */
    public $widget_fields;

    public function __construct($id_base, $name, array $widget_options = array(), $widget_fields = array(), array $control_options = array())
    {
        parent::__construct($id_base, $name, $widget_options, $control_options);
        // Define widget_fields
        $this->widget_fields = $widget_fields;
        // Import scripts
        add_action('admin_enqueue_scripts', array($this, 'quest_media_scripts'));
    }

    /**
     * @param array $new_instance
     * @param array $old_instance
     * @return array
     */
    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $widget_fields = $this->widget_fields;

        foreach ($widget_fields as $widget_field) {
            $quest_widgets_name = $widget_field['quest_widgets_name'];

            $instance[$quest_widgets_name] = $this->quest_widgets_updated_field_value($widget_field, $new_instance[$quest_widgets_name]);
        }
        return $instance;
    }

    /**
     * @param array $instance
     * @return string|void
     */
    public function form($instance)
    {
        $widget_fields = $this->widget_fields;
        foreach ($widget_fields as $widget_field) {
            $quest_widgets_name = $widget_field['quest_widgets_name'];
            $quest_widgets_field_value = !empty($instance[$quest_widgets_name]) ? esc_attr($instance[$quest_widgets_name]) : '';

            $this->quest_widgets_show_widget_field($widget_field, $quest_widgets_field_value);
        }
    }


    /**
     * Quest Field Functional file
     * @package Quest
     * @param array $instance Current settings.
     * @param array $widget_field
     * @param string $quest_field_value
     */
    function quest_widgets_show_widget_field($widget_field = array(), $quest_field_value = '')
    {
        $quest_widgets_field_type = !empty($widget_field['quest_widgets_field_type']) ? esc_attr($widget_field['quest_widgets_field_type']) : '';
        $quest_widgets_name =  !empty($widget_field['quest_widgets_name']) ? esc_attr($widget_field['quest_widgets_name']) : '';
        $quest_widgets_title = !empty($widget_field['quest_widgets_title']) ? esc_attr($widget_field['quest_widgets_title']) : '';
        $quest_widgets_description = !empty($widget_field['quest_widgets_description']) ? esc_attr($widget_field['quest_widgets_description']) : '';

        switch ($quest_widgets_field_type) {
            /*  Standard text field  */
            case 'text' :
            case 'url':
            case 'title':
                include 'components/input-text.php';
                break;
            case 'textarea':
                $quest_widgets_row = !empty($widget_field['quest_widgets_row']) ? esc_attr($widget_field['quest_widgets_row']) : '';
                include 'components/textarea.php';
                break;
            case 'checkbox':
                include 'components/input-checkbox.php';
                break;
            case 'radio':
                $quest_widgets_field_options = !empty($widget_field['quest_widgets_field_options']) ? $widget_field['quest_widgets_field_options'] : array();
                include 'components/input-radio.php';
                break;
            case 'select':
                $quest_widgets_field_options = !empty($widget_field['quest_widgets_field_options']) ? $widget_field['quest_widgets_field_options'] : array();
                $quest_default_option = !empty($widget_field['quest_default_option']) ? esc_attr($widget_field['quest_default_option']) : '';
                include 'components/select.php';
                break;
            case 'multi-level-select':
                $quest_widgets_field_options = !empty($widget_field['quest_widgets_field_options']) ? $widget_field['quest_widgets_field_options'] : array();
                include 'components/multi-level-select.php';
                break;
            case 'number':
                include 'components/input-number.php';
                break;
            case 'upload':
                include 'components/upload-file.php';
                break;
            case 'group-top':
                include 'components/group-top.php';
                break;
            case 'group-bottom':
                echo "</fieldset>";
                break;

            //Multi checkboxes
            case 'multicheckboxes' :
                $quest_widgets_field_options = !empty($widget_field['quest_widgets_field_options']) ? $widget_field['quest_widgets_field_options'] : array();
                include 'components/multicheckboxes.php';
                break;

            /*   Individual field */
            case 'ratio':
            case 'content_direction':
                $quest_widgets_field_options = !empty($widget_field['quest_widgets_field_options']) ? $widget_field['quest_widgets_field_options'] : array();
                include 'components/select.php';
                break;

            /*   Don't match  */
            default:
                echo "<p>Field name don't existed in class</p>";
                break;
        }
    }

    /**
     * @param $widget_field
     * @param $new_field_value
     * @return int|string
     */
    function quest_widgets_updated_field_value($widget_field, $new_field_value)
    {

        extract($widget_field);
        $quest_widgets_field_type = !empty($widget_field['quest_widgets_field_type']) ? $widget_field['quest_widgets_field_type'] : '';

        switch ($quest_widgets_field_type) {
            case 'number':
                return absint($new_field_value);
            case 'textarea':
                if (!isset($quest_widgets_allowed_tags)) {
                    $quest_widgets_allowed_tags = '<p><strong><em><a>';
                }
                return strip_tags($new_field_value, $quest_widgets_allowed_tags);
            case 'url':
                return esc_url_raw($new_field_value);
            case 'text':
            case 'title':
            case 'multicheckboxes':
                return wp_kses_post($new_field_value);
            default:
                return strip_tags($new_field_value);
        }

    }

    /**
     * Enqueue scripts for file uploader
     */
    public function quest_media_scripts()
    {
        wp_enqueue_media();
        wp_enqueue_script('quest-media-uploader', get_template_directory_uri() . '/js/quest-init-admin.js', array('jquery', 'customize-controls'), 1.0);
        wp_localize_script('quest-media-uploader', 'quest_l10n', array(
            'upload' => __('Upload', 'quest'),
            'remove' => __('Remove', 'quest')
        ));
    }

}
