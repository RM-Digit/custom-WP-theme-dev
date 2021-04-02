(function () {
    var $ = jQuery;
    function sort() {
        var $ = jQuery;
        $('.card-columns').masonry({
            itemSelector: '.card',
            columnWidth: '.card',
            gutter: 13,
            horizontalOrder: true
        })
    }
    function sortCardEnd(){
        _labelMain = $('.card-columns');
        if (_labelMain.length != 0) {
        _labelMain[0].style.visibility = '';
        }
        var _labels = $('#resource-wrapper .card-columns .card, #search-wrapper .card-columns .card');
        if (_labels.length != 0) {
            var _labelEnd = _labels[_labels.length - 1];
            if (_labelEnd.offsetLeft != 0) {
                for (var i = _labels.length - 2; i >= 0; i--) {
                    var _label = _labels[i];
                    if (_label.offsetLeft == 0) {
                        var height = Math.abs(_labelEnd.offsetTop - (_label.offsetHeight + _label.offsetTop)) / _labelEnd.offsetHeight;
                        if (height < 0.5 || ( _labelEnd.offsetTop >= (_label.offsetHeight + _label.offsetTop) )) {
                            _labelEnd.style.top = _label.offsetHeight + _label.offsetTop + 13 + 'px';
                            _labelEnd.style.left = 0 + 'px';
                            _labelMain = $('.card-columns');
                            _labelMain[0].style.height = _labelMain[0].scrollHeight + 'px';
                            break;
                        }else{
                            break;
                        }

                    }
                }
            }
            else{
                for (var i = _labels.length - 2; i >= 0; i--) {
                    var _label = _labels[i];
                    if (_label.offsetLeft != 0) {
                        var height = Math.abs(_labelEnd.offsetTop - (_label.offsetHeight + _label.offsetTop)) / _labelEnd.offsetHeight;
                        if (height > 0.5 && (_labelEnd.offsetTop >=(_label.offsetHeight + _label.offsetTop)) ) {
                            _labelEnd.style.top = _label.offsetHeight + _label.offsetTop + 13 + 'px';
                            _labelEnd.style.left = _label.offsetLeft + 'px';
                            _labelMain = $('.card-columns');
                            _labelMain[0].style.height = _labelMain[0].scrollHeight + 'px';
                            break;
                        }else{
                            break;
                        }
                    }
                }
            }
        }
    }

    function addLabelToGRecaptcha() {
        if($('.salesfusion-form form #g-recaptcha-response').length) {
            var content = '<label class="d-none" for="g-recaptcha-response">G Recaptcha</label>';
            $('.salesfusion-form form #g-recaptcha-response').parent().append(content);
        }
    }

    $(window).load(function () {
        sort();
        setTimeout(sortCardEnd,500);
        setTimeout(addLabelToGRecaptcha, 500);
    });
    // setTimeout(sort,500);
    // setTimeout(sortCardEnd,1000);

    var _labels = $('body .salesfusion-form').find('form .form-row input, form .form-row textarea, form .form-row select ');

    if (_labels.length > 0) {
        var checkboxIndex = 0;

        for (var i=0; i<_labels.length;i++) {
            var _label = _labels[i]
            var parentLabel = _label.parentElement;
            var nameAttr = _label.getAttribute('name');
            var idAttr = _label.getAttribute('id');
            var typeAttr = _label.getAttribute('type');
            var phoneNameAttr = ['phone', 'oppphone'];
            _label.removeAttribute('maxlength');

            // if ($.inArray(nameAttr, phoneNameAttr) !== -1) {
            //     var des = "<span>Ex: +1 (234) 231-2313 or (234) 231-2313</span>";
            //     var _labelParent = _label.closest('.component-container');
            //     $(des).insertAfter(_labelParent);
            // }

            if (typeAttr !== 'checkbox' && typeAttr !== 'radio') {
                if (!idAttr) {
                    _label.setAttribute('id', nameAttr);
                    extLabel = '<label for="' + nameAttr + '" class="d-none">' + nameAttr + '</label>';
                    $(extLabel).insertAfter(_label);
                }

                // if (typeAttr === 'submit') {
                //     console.log(1231);
                //     _label.setAttribute('disabled', true);
                //     _label.setAttribute('class', 'disable-class');
                // }

                if (!_label.validity.valid) {
                    $('<span class="required-class" style="color: #ffb9b9; display: block">*</span>').insertAfter(_label);
                    parentLabel.className = parentLabel.className + ' d-flex';
                } else {
                    $('<span class="required-class" style="color: #ffb9b9;display: block; width: 8px"></span>').insertAfter(_label);
                    parentLabel.className = parentLabel.className + ' d-flex';
                }
            } else {
                var checkboxNewId = nameAttr + '_' + checkboxIndex++;
                var checkboxNewlabel = _label.closest('.radio-check').nextElementSibling.innerHTML;
                _label.setAttribute('id', checkboxNewId);
                _label.nextSibling.remove();

                extLabel = '<label for="' + checkboxNewId + '" class="d-none">' + checkboxNewlabel + '</label>';
                $(extLabel).insertAfter(_label);
            }
        }
    }

    var consentContent = '<div class="consent-field999">' +
        '<div class="component-container">' +
        '<div class="element-container text-left mb-2">' +
        'I consent to the processing of the personal data that I provide Salesfusion and I would like to receive marketing communications from Salesfusion in accordance with and as described in the' +
        ' <a href="/privacy-policy/" class="privacy-policy">Privacy Policy</a>' +
        '</div>' +
        '<div class="element-container layout-row layout-wrap">' +
        '<div class="label-left-right">' +
        '<div class="radio-check">' +
        '<input type="checkbox" id="i-agree" class="align-middle" value="0" name="quest_i_agree"><label for="i-agree" class="d-none">I agree</label>' +
        '</div>' +
        '<span class="radio-check-label">I agree</span>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>';

    // $('.salesfusion-form:not(".inline-block-layout") form .form-row:last-child').prepend(consentContent);

    $(document).on('change', '.salesfusion-form form #i-agree', function () {
        if ($(this).is(':checked')) {
            $(this).closest('form').find('input[type="submit"]').prop('disabled', false);
        } else {
            $(this).closest('form').find('input[type="submit"]').prop('disabled', true);
        }
    });

    jQuery.extend(jQuery.validator.messages, {
        required: "This field is required.",
        remote: "Please fix this field.",
        email: "Please enter a valid email address. <br>Ex: yourname@gmail.com",
        url: "Please enter a valid URL.",
        date: "Please enter a valid date.",
        dateISO: "Please enter a valid date (ISO).",
        number: "Please enter a valid number.",
        digits: "Please enter only digits.",
        creditcard: "Please enter a valid credit card number.",
        equalTo: "Please enter the same value again.",
        accept: "Please enter a value with a valid extension.",
        maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
        minlength: jQuery.validator.format("Please enter at least {0} characters."),
        rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
        range: jQuery.validator.format("Please enter a value between {0} and {1}."),
        max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
        min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
    });

    $.validator.addMethod("emptyphone", function(value, element, param) {
        return value ? true : false;
    }, "Please enter a valid phone number.<br>Ex: +1 (234) 123-1234");

    $.validator.addMethod("phonenumber", function(value, element, param) {
        return (/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im.test(value))
    }, "Please enter a valid phone number.<br>Ex: (123)456-7890, 123-456-7890 or 1234567890");

    $.validator.addMethod("custom_email", function(value, element, param) {
        return (/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,3}$/.test(value))
    }, "Please enter a valid email address. <br>Ex: yourname@gmail.com");

    $(".salesfusion-form form").validate({
        rules: {
            phone: {
                required: true,
            },
            oppphone: {
                required: true,
            },
            email: {
                required: true,
                custom_email: true
            }
        },
        messages: {
            phone: {
                required: "This field is required. Ex: +1 (123) 123-1234"
            },
            oppphone: {
                required: "This field is required. Ex: +1 (123) 123-1234"
            }
        },
        errorPlacement: function(error, element) {
            $(element).closest('.component-container').parent().append(error);
        },
        showErrors: function (errorMap, errorList) {
            this.defaultShowErrors();

            for (var key in errorMap) {
                var selector = '[name="' + key +'"]';
                var _input = $(this.currentForm).find(selector);
                if (_input.attr('type') != 'checkbox' && _input.attr('type') != 'radio') {
                    $(this.currentForm).find(selector).closest('.component-container').find('label').attr('for', '');
                }
            }
        },
        success: function (label, element) {
            var inputID = $(element).attr('id');
            $(element).closest('.component-container').find('label').attr('for', inputID);
            $(element).closest('.component-container').parent().find('label.error').remove();
        },
        submitHandler: function(form) {
            var title = $('title').text();

            if (grecaptcha.getResponse()) {
                gtag('event', 'submit', {
                    'event_category' : 'Salesfusion Submission',
                    'event_label' : title,
                    'event_callback': function() {
                        form.submit();
                    }
                });
            } else {
                alert('Please confirm captcha to proceed')
            }
        }
    });

    if (getCookie('cookie_consent') === "") {
        $('.cookie-law-bar').show();
    }

    $(document).on('click', '.cookie-law-bar .close-icon', function () {
        setCookie('cookie_consent', true, 1000);
        $(this).parent().hide();
    });

    $('#s').on('focus', function () {
        var _parent = $(this).closest('.search-container');
        _parent.addClass('active');
    });
    $('#search-toggle').on('click', function () {
        var _parent = $(this).closest('.search-container');
        _parent.toggleClass('active');
        if (_parent.hasClass('active')) {
            _parent.find('#s').focus();
        }
    });
    $('.navbar-toggler').on('click', function () {
        var nav = jQuery('#navbarNavDropdown');
        nav.toggleClass('active');
        if (nav.hasClass('active')) {
            $('.navbar-toggler').addClass('expanded');
        } else {
            $('.navbar-toggler').removeClass('expanded');
        }
        return false;
    });
    $('#testimonial-area').carousel({
        interval: 7000
    });
    // $('.services-item').on('click', function(){
    //     insertParam('services[]', $(this).val());
    // })
    // $('.resource-item').on('click', function(){
    //     insertParam('resources[]', $(this).val());
    // })
    $('#testimonial-area #quest-slider-btn').click(function () {
        if ($(this).find('.fa').hasClass('fa-pause')) {
            $('#testimonial-area').carousel('pause');
            $(this).find('.fa').removeClass('fa-pause');
            $(this).find('.fa').addClass('fa-play');
        } else {
            $('#testimonial-area').carousel('cycle');
            $(this).find('.fa').removeClass('fa-play');
            $(this).find('.fa').addClass('fa-pause');
        }

    });

    $('#form-left-sidebar input').focusin(function () {
        $(this).siblings('.checkmark').css('background', 'rgba(27, 79, 145, 0.2)');
        $(this).parent().css('color', '#1B4F91');
    });

    $('#form-left-sidebar input').focusout(function () {
        $(this).siblings('.checkmark').css('background', '');
        $(this).parent().css('color', '');
    });

    $('#form-left-sidebar input').change(function(){
        var width = $( window  ).width();
        if(width > 576){
            $('#form-left-sidebar').submit();
        }
    })
    //TOGGLING NESTED ul
    $(".archive-drop-down .selected a").click(function() {
        $('.sort-drop-down .options ul').hide();
        $('.archive-drop-down .options ul').toggle();
    });

    $(".sort-drop-down .selected a").click(function() {
        $('.archive-drop-down .options ul').hide();
        $('.sort-drop-down .options ul').toggle();
    });

    $(".desktop-drop-down .selected a").click(function(){
        $(this).find('i').toggleClass('fa-caret-up');
        $(".desktop-drop-down .options ul").toggle();
    })
    //SELECT OPTIONS AND HIDE OPTION AFTER SELECTION
    $(".drop-down .options ul li label").click(function() {
        var text = $(this).html();
        $(this).parents('div.drop-down').find('span').html(text);
        $(this).parents('div.drop-down').find('ul').hide();
        $('.desktop-drop-down .selected a i').removeClass('fa-caret-up');
    });


    //HIDE OPTIONS IF CLICKED ANYWHERE ELSE ON PAGE
    $(document).bind('click', function(e) {
        var $clicked = $(e.target);
        if (! $clicked.parents().hasClass("drop-down")){
            $(".drop-down .options ul").hide();
            $('.desktop-drop-down .selected a i').removeClass('fa-caret-up');
        }
    });
    $('.desktop-drop-down .options ul li label').click(function(){
        $("#form-left-sidebar input[type=radio][value="+ $('.desktop-drop-down input[name="sort"]').val() +"]").prop("checked", true);
        $('#form-left-sidebar').submit();

    })
    //Submit Press Release page sort
    $('#press-release-sort input').on('change', function(){
        $('#press-release-sort').submit();
    })

    $('.uncheck-item').click(function(){
        var value = $(this).attr('data-type');
        $("input[type=checkbox][value="+ value +"]").prop("checked", false);
        $('#form-left-sidebar').submit();
    })

    function insertParam(key, value){
        key = encodeURI(key); value = encodeURI(value);
        var kvp = document.location.search.substr(1).split('&');
        var i=kvp.length; var x; while(i--){
            x = kvp[i].split('=');
            if (x[0]==key && x[1] == value){
                kvp.splice(i, 1);
                break;
            }
        }
        if(i<0){ kvp[kvp.length] = [key,value].join('='); }
        //this will reload the page, it's likely better to store this until finished
        document.location.search = kvp.join('&');
    }
    $('.open-left-sidebar').on('click', function(){
        $('#left-sidebar').show();
    })
    $('#left-sidebar .close').on('click', function(){
        $('#left-sidebar').hide();
    })

    $('.responsive').slick({
        dots: true,
        prevArrow: $('.prev'),
        nextArrow: $('.next'),
        slidesToShow: 4,
        slidesToScroll: 4,
        autoplay: true,
        autoplaySpeed: 3000,
        accessibility: false,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });

    $(".regular").slick({
        dots: true,
        infinite: true,
        prevArrow: $('.prev'),
        nextArrow: $('.next'),
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 30000,
        accessibility: false,
        responsive: [
            {
                breakpoint: 767.98,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            }
        ]
    });

    $('.vendor-partner #quest-slider-btn').click(function () {
        if ($(this).find('.fa').hasClass('fa-pause')) {
            $('.responsive').slick('slickPause');
            $(this).find('.fa').removeClass('fa-pause');
            $(this).find('.fa').addClass('fa-play');
        } else {
            $('.responsive').slick('slickPlay');
            $(this).find('.fa').removeClass('fa-play');
            $(this).find('.fa').addClass('fa-pause');
        }

    });

    $(document).on('click', '.slick-active .video-img', function (event) {
        event.preventDefault();
        var videoID = $(this).attr('href');
        $(videoID).modal('show');

        var youtubeLink = $(videoID).find('.modal-body iframe').data('src');
        var newYoutubeLink = youtubeLink + '?rel=0&autoplay=1&loop=1';

        var iframeHTML = '<iframe data-src="' + youtubeLink +'" class="youtube-catch-event-iframe embed-responsive-item" frameborder="0" allowfullscreen></iframe>';
        $(videoID).find('.modal-body iframe').remove();
        $(iframeHTML).attr("src", newYoutubeLink)
            .appendTo(videoID + ' .modal-body');
    });

    $(document).on('click', '.dropdown-mobile-toggle', function () {
        var _id = $(this).attr('data-target');
        $(this).toggleClass('expanded');
        jQuery('[aria-labelledby="'+_id+'"]').toggleClass('show-on-mobile');
    });

    $(document).on('click', '#join-our-team', function () {
        var iframeUrl = $(this).data('iframe');

        var colHtml = "";
        colHtml += '<link rel="stylesheet" type="text/css" href="//reports.hrmdirect.com/employment/default/sm/settings/dynamic-embed/dynamic-iframe-embed-css.php" />'

        colHtml += '<script type="text/javascript" src="//reports.hrmdirect.com/employment/default/sm/settings/dynamic-embed/dynamic-iframe-embed-js.php"></script>'

        colHtml += '<div class="row"><div id="iframe-neo" class="iframe-body col-12" style="height: 100%">' +
            "<iframe id='iframeHeightDiv' width='100%' height='100%' style='overflow: hidden' src='" + iframeUrl + "' frameborder='0' allowtransparency='true'></iframe>" +
            '</div></div>';

        $(this).closest('.row').parent().append(colHtml);
        window.location.hash = '#iframe-neo';
        $(this).remove();

    });

    $('.youtube-catch-event').on('hidden.bs.modal', function () {
        var $youtubeIframe = $(this).find('.youtube-catch-event-iframe');
        var leg = $youtubeIframe.data('src');
        $youtubeIframe.attr("src", leg);
    });


    $(".salesfusion-form form").submit(function(e) {
        var _this = $(this);
        var thanks_html = _this.parent().data('thanks-form');

        if (thanks_html !== '') {
            _this.find('input[name="rurl"]').val(window.location.href + '?thanks_form=true#thanks-neo');
        }

        e.preventDefault();
    });

    $('.salesfusion-form form .component-container .radio-check input[type="radio"]').closest('.component-container').addClass('radio-inline');
    $('#veeam-wrapper video').on('loadedmetadata', function(){
        $('.mejs-poster-img').attr('alt','poster video veeam image');
    });

    var _bgVideoBtn = document.getElementById("quest-bg-video-btn");

    if (_bgVideoBtn) {
        _bgVideoBtn.addEventListener("click", playPause);
        var _bgVideo = document.getElementById("quest-background-video");

        function playPause() {
            if (_bgVideo.paused) {
                _bgVideo.play();
                document.getElementById('quest-bg-video-icon').classList.remove('fa-play');
                document.getElementById('quest-bg-video-icon').classList.add('fa-pause');
            }
            else  {
                _bgVideo.pause();
                document.getElementById('quest-bg-video-icon').classList.remove('fa-pause');
                document.getElementById('quest-bg-video-icon').classList.add('fa-play');
            }
        }
    }

    $('.playbook-container .playbook-item .pb-item-header').click(function () {
        var _currentContent = $(this).closest('.playbook-item').find('.pb-item-content');
        var _otherHeaders = $('.playbook-container .playbook-item .pb-item-header').not(this);
        var _otherContents = $('.playbook-container .playbook-item .pb-item-content').not($(this).closest('.playbook-item').find('.pb-item-content'));

        _otherContents.slideUp();
        _otherHeaders.removeClass('active');
        _otherHeaders.find('span.fa').removeClass();
        _otherHeaders.find('span:first-child').addClass('fa fa-caret-right');

        if (_currentContent.is(':visible')) {
            $(this).removeClass('active');
            $(this).find('span.fa').removeClass('fa-caret-down');
            $(this).find('span.fa').addClass('fa-caret-right');
        } else {
            $(this).addClass('active');
            $(this).find('span.fa').removeClass('fa-caret-right');
            $(this).find('span.fa').addClass('fa-caret-down');
        }
        _currentContent.slideToggle();


    });

    var _phoneSelector = $('.salesfusion-form').find('input[name="phone"], input[name="oppphone"], input[name="workphone"], input[name="telephone"]');

    if (_phoneSelector.length) {
        _phoneSelector.mobilePhoneNumber({allowPhoneWithoutPrefix: '+1'});
    }

    $(document).on('change', '#quest-blog-wrapper .select-boxes select', function (event) {
        var id = $(this).val();
        var post_type = $(this).data('type');
        var index = $(this).data('index');
        if (id === "all") {
            window.location.href = window.location.protocol + '//' + window.location.hostname + '/resources?resources[]=' + post_type;
        } else if (id !== "") {
            window.location.href = window.location.protocol + '//' + window.location.hostname + '/resources?resources[]=' + post_type + '&owner[' + index + ']=' + id;
        }
    });
})();
