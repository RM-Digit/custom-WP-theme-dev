jQuery(document).ready(function($){

    /**
     * Script for Customizer icons
    */
    $(document).on('click', '.ap-customize-icons li', function() {
        $(this).parents('.ap-customize-icons').find('li').removeClass();
        $(this).addClass('selected');
        var iconVal = $(this).parents('.icons-list-wrapper').find('li.selected').children('i').attr('class');
        var inpiconVal = iconVal.split(' ');
        $(this).parents( '.ap-customize-icons' ).find('.ap-icon-value').val(inpiconVal[1]);
        $(this).parents( '.ap-customize-icons' ).find('.selected-icon-preview').html('<i class="' + iconVal + '"></i>');
        $('.ap-icon-value').trigger('change');
    });

    $( "#term_meta" ).fSelect({
        multiple:false
    });

	var quest_upload;
	var quest_selector;
    var quest_file_frame, thumbnails;
    function quest_add_file(event, selector) {

		var upload = $(".uploaded-file"), frame;
		var $el = $(this);
		quest_selector = selector;

		event.preventDefault();
		if ( quest_upload ) {
			quest_upload.open();
		} else {
			quest_upload = wp.media.frames.quest_upload =  wp.media({
				title: $el.data('choose'),
				button: {
					text: $el.data('update'),
					close: false
				}
			});


			quest_upload.on( 'select', function() {
				var attachment = quest_upload.state().get('selection').first();
				quest_upload.close();
                var _url = attachment.attributes.url;
                var imageID = attachment.attributes.id;

                if(typeof attachment.attributes.sizes.medium != 'undefined') {
                    _url = attachment.attributes.sizes.medium.url;
                }
                quest_selector.find('input[type="text"].upload').val(imageID).trigger('input');
				if ( attachment.attributes.type == 'image' ) {
                    quest_selector.find('.screenshot').empty().hide().append('<img style="width:35%" src="' + _url + '"><br><a class="remove-image" style="cursor: pointer">Remove</a>').slideDown('fast');
				}
				quest_selector.find('.upload-button-wdgt').unbind().addClass('remove-file').removeClass('upload-button-wdgt').val(quest_l10n.remove);
				quest_selector.find('.of-background-properties').slideDown();
				quest_selector.find('.remove-image, .remove-file').on('click', function() {
					quest_remove_file( $(this).parents('.section') );
				});
			});
		}
		quest_upload.open();
	}

	function quest_remove_file(selector) {
		selector.find('.remove-image').hide();
		selector.find('.upload').val('');
		selector.find('.of-background-properties').hide();
		selector.find('.screenshot').slideUp();
		selector.find('.remove-file').unbind().addClass('upload-button-wdgt').removeClass('remove-file').val(quest_l10n.upload);
		if ( $('.section-upload .upload-notice').length > 0 ) {
			$('.upload-button-wdgt').remove();
		}
		selector.find('.upload-button-wdgt').on('click', function(event) {
			quest_add_file(event, $(this).parents('.section'));

		});
	}

	$('body').on('click','.remove-image, .remove-file', function() {
		quest_remove_file( $(this).parents('.section') );
    });

    $(document).on('click', '.upload-button-wdgt', function( event ) {
    	quest_add_file(event, $(this).parents('.section'));
    });

    /**
     * Customizser More Image Upload
    */
    $('.upload_gallery_button').click(function(event){
        var current_gallery = $( this ).closest( 'label' );

        if ( event.currentTarget.id === 'clear-gallery' ) {
            //remove value from input
            current_gallery.find( '.gallery_values' ).val( '' ).trigger( 'change' );

            //remove preview images
            current_gallery.find( '.gallery-screenshot' ).html( '' );
            return;
        }

        // Make sure the media gallery API exists
        if ( typeof wp === 'undefined' || !wp.media || !wp.media.gallery ) {
            return;
        }
        event.preventDefault();

        // Activate the media editor
        var val = current_gallery.find( '.gallery_values' ).val();
        var final;

        if ( !val ) {
            final = '[gallery ids="0"]';
        } else {
            final = '[gallery ids="' + val + '"]';
        }
        var frame = wp.media.gallery.edit( final );

        frame.state( 'gallery-edit' ).on(
            'update', function( selection ) {

                //clear screenshot div so we can append new selected images
                current_gallery.find( '.gallery-screenshot' ).html( '' );

                var element, preview_html = '', preview_img;
                var ids = selection.models.map(
                    function( e ) {
                        element = e.toJSON();
                        preview_img = typeof element.sizes.thumbnail !== 'undefined' ? element.sizes.thumbnail.url : element.url;
                        preview_html = "<div class='screen-thumb'><img src='" + preview_img + "'/></div>";
                        current_gallery.find( '.gallery-screenshot' ).append( preview_html );
                        return e.id;
                    }
                );

                current_gallery.find( '.gallery_values' ).val( ids.join( ',' ) ).trigger( 'change' );
            }
        );
        return false;
    });

    $("input[name='quest_social_items[]']").on('change', function (e) {
        if ($("input[name='quest_social_items[]']:checked").length > 4) {
            $(this).prop('checked', false);
            alert("Allowed only 4 item");
        }
    });

    var auto_logout = {
        timeoutID : 0,

        init : function()
        {
            document.addEventListener("mousemove", auto_logout.resetTimer, false);
            document.addEventListener("mousedown", auto_logout.resetTimer, false);
            document.addEventListener("keypress", auto_logout.resetTimer, false);
            document.addEventListener("DOMMouseScroll", auto_logout.resetTimer, false);
            document.addEventListener("mousewheel", auto_logout.resetTimer, false);
            document.addEventListener("touchmove", auto_logout.resetTimer, false);
            document.addEventListener("MSPointerMove", auto_logout.resetTimer, false);
        },

        startTimer : function()
        {
            auto_logout.timeoutID = window.setTimeout(auto_logout.goInactive, 1800000); // Three minutes logout
        },

        resetTimer : function()
        {
            window.clearTimeout(auto_logout.timeoutID);
            auto_logout.goActive();
        },

        endTimmer : function()
        {
            document.removeEventListener("mousemove", auto_logout.resetTimer, false);
            document.removeEventListener("mousedown", auto_logout.resetTimer, false);
            document.removeEventListener("keypress", auto_logout.resetTimer, false);
            document.removeEventListener("DOMMouseScroll", auto_logout.resetTimer, false);
            document.removeEventListener("mousewheel", auto_logout.resetTimer, false);
            document.removeEventListener("touchmove", auto_logout.resetTimer, false);
            document.removeEventListener("MSPointerMove", auto_logout.resetTimer, false);
        },

        goInactive : function()
        {
            var data = {
                'action': 'auto_logout',
                'time': true,
                'ajaxsecurity': ajaxurl,
            };
            jQuery.post(ajaxurl, data, function(response) {
                auto_logout.endTimmer();
                alert('You have been logged out due to inactivity.');
                window.location.href = "/";
            });
        },

        goActive : function()
        {
            auto_logout.startTimer();
        },
    };

    if( $('body').hasClass('logged-in') || $('body').hasClass('wp-admin') ){
        // auto_logout.init();
    }
});
