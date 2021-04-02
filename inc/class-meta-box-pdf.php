<?php
if (!defined('ABSPATH')) exit;

class Quest_Metabox_PDF
{
    private static $_instance = null;

    public function __construct()
    {
        add_action('add_meta_boxes', array($this, 'resource_meta_box_activation'));
        add_action('save_post', array($this, 'resource_meta_box_save'));
    }

    public function resource_meta_box_activation()
    {
        add_meta_box(
            'quest-resource-pdf',
            __('PDFs', 'quest'),
            array($this, 'resource_meta_box_output'),
            quest_all_pdf_post_types(),
            'normal',
            'high'
        );
    }

    public function resource_meta_box_output($post)
    {
        wp_enqueue_media();
        wp_nonce_field('resource_meta_box_pdf', 'resource_meta_box_pdf_nonce'); ?>
        <?php
        $upload_link = esc_url(get_upload_iframe_src('', $post->ID));
        $upload_link .= '&post_mime_type=application/pdf&tab=library';
        $pdfID = get_post_meta($post->ID, 'quest-pdf-file', true);
        $pdfLink = get_post_meta($post->ID, 'quest-pdf-file-link', true);
        $pdfCaption = get_post_meta($post->ID, 'quest-pdf-file-caption', true);
        $pdfURL = wp_get_attachment_url($pdfID);
        $hasPDFFile = !empty($pdfURL);
        ?>

        <!-- Your image container, which can be manipulated with js -->
        <div class="resource-pdf-container" data-columns="9">
            <?php if ($hasPDFFile) : ?>
                <a target="_blank" href="<?php echo $pdfURL;?>" class="thumbnail-pdf-preview centered"><em class="quest-icon quest-<?php echo get_post_type();?>"></em><label><?php echo get_the_title($pdfID);?></label></a>
            <?php endif; ?>
            <div class="clear"></div>
        </div>

        <!-- Your add & remove image links -->
        <label for="quest-pdf-file-caption"><?php _e('PDF link', 'quest' ); ?></label><br/>
        <input autocomplete="off" class="resource-pdf-link widefat" id="quest-pdf-file-link" name="quest-pdf-file-link" type="text" value="<?php echo esc_attr($pdfLink); ?>"/>
        <p class="hide-if-no-js">
            <a class="button button-primary button-large resource-add-pdf <?php if ($hasPDFFile) {
                echo 'hidden';
            } ?>"
               href="<?php echo $upload_link ?>">
                <?php _e('Add PDF') ?>
            </a>
            <a class="button button-danger-link button-large resource-del-pdf <?php if (!$hasPDFFile) {
                echo 'hidden';
            } ?>"
               href="#">
                <?php _e('Remove this file') ?>
            </a>
        </p>
        <input class="resource-pdf-id" name="quest-pdf-file" type="hidden" value="<?php echo esc_attr($pdfID); ?>"/>

        <p>
            <label for="quest-pdf-file-caption"><?php _e('Caption', 'quest' ); ?></label><br/>
            <textarea rows="3" class="widefat quest-pdf-file-caption" name="quest-pdf-file-caption"><?php echo esc_html( $pdfCaption ); ?></textarea>
        </p>
        <script>
            var FRAME;
            jQuery(document).ready(function ($) {

                // Set all variables to be used in scope
                var frame,
                    metaBox = $('#quest-resource-pdf.postbox'), // Your meta box id here
                    addImgLink = metaBox.find('.resource-add-pdf'),
                    delImgLink = metaBox.find('.resource-del-pdf'),
                    imgContainer = metaBox.find('.resource-pdf-container'),
                    captionInput = metaBox.find('.quest-pdf-file-caption'),
                    imgIdInput = metaBox.find('.resource-pdf-id');
                    imgLinkInput = metaBox.find('.resource-pdf-link');
                 var videoLink = document.getElementById('quest-pdf-file-link').value;
                 if(videoLink){
                     delImgLink.removeClass('hidden');
                     addImgLink.addClass('hidden');

                 }
                // ADD IMAGE LINK
                addImgLink.on('click', function (event) {

                    event.preventDefault();

                    // If the media frame already exists, reopen it.
                    if (frame) {
                        frame.open();
                        return;
                    }
                    frame = wp.media({
                        frame: 'post',
                        state: 'insert',
                        library: {
                            'type': 'application/pdf' // limits the frame to show only images
                        },
                        multiple: false
                    });

                    window.FRAME=frame;
                    frame.on('open', function () {
                        //frame.$el.find('select.attachment-filters').val('application/pdf').trigger('change'); => could not load new files after uploading
                    });
                    var IS_ESCAPE = false;
                    frame.on('select close', function () {
                        var attachment = frame.state().get('selection').first();
                        if (attachment != null) {
                            attachment = attachment.toJSON();
                            setTimeout(function () {
                                if (IS_ESCAPE) {
                                    IS_ESCAPE = false;
                                } else {
                                    imgContainer.append('<a target="_blank" href="' + attachment.url + '" class="thumbnail-pdf-preview centered"><em class="quest-icon quest-<?php echo get_post_type();?>"></em><label>' + attachment.filename + '</label></a>');
                                    imgIdInput.val(attachment.id);
                                    imgLinkInput.val(attachment.url);
                                    addImgLink.addClass('hidden');
                                    delImgLink.removeClass('hidden');
                                    if(captionInput.text().trim()=='') {
                                        captionInput.text(attachment.caption);
                                    }
                                }
                            }, 10);
                        }
                    });
                    frame.on('escape', function () {
                        IS_ESCAPE = true;
                    });
                    // Finally, open the modal on click
                    frame.open();
                    return false;
                });


                // DELETE IMAGE LINK
                delImgLink.on('click', function (event) {

                    event.preventDefault();
                    imgContainer.html('');
                    addImgLink.removeClass('hidden');
                    delImgLink.addClass('hidden');
                    imgIdInput.val('');
                    imgLinkInput.val('');

                });
            });

        </script>
        <?php
    }

    public function resource_meta_box_save($post_id)
    {

        if (!isset($_POST['resource_meta_box_pdf_nonce']) || !wp_verify_nonce($_POST['resource_meta_box_pdf_nonce'], 'resource_meta_box_pdf'))
            return;

        if (!current_user_can('edit_post', $post_id))
            return;

        if (isset($_POST['quest-pdf-file-link'])) {
            update_post_meta($post_id, 'quest-pdf-file-link', sanitize_text_field( $_POST['quest-pdf-file-link'] ));
        }
        if (isset($_POST['quest-pdf-file'])) {
            update_post_meta($post_id, 'quest-pdf-file', sanitize_text_field( $_POST['quest-pdf-file'] ));
        }
        if (isset($_POST['quest-pdf-file-caption'])) {
            update_post_meta($post_id, 'quest-pdf-file-caption', sanitize_text_field( $_POST['quest-pdf-file-caption'] ));
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