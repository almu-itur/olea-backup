/**
 * Custom scripts needed for the colorpicker, image button selectors,
 * and navigation tabs.
 */

jQuery(document).ready(function($) {

    $(document).on('click', '.logo-remove', function() {
        var $this = $(this);
        $this.parents('.sub-option').slideUp(800);
        setTimeout(function() {
            $this.parents('.sub-option').remove();
        }, 750);
    });

    // Loads the color pickers
    $('.of-color').wpColorPicker();

    // Image Options
    $('.of-radio-img-img').click(function() {
        $(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
        $(this).addClass('of-radio-img-selected');
    });

    $('.of-radio-img-label').hide();
    $('.of-radio-img-img').show();
    $('.of-radio-img-radio').hide();

    // Loads tabbed sections if they exist
    if ($('.nav-tab-wrapper').length > 0) {
        options_framework_tabs();
    }

    function options_framework_tabs() {

        var $group = $('.group'),
                $navtabs = $('.nav-tab-wrapper a'),
                active_tab = '';

        // Hides all the .group sections to start
        $group.hide();

        active_tab = $('#tab_id').attr('value');

        // If active tab is saved and exists, load it's .group
        if (active_tab != '' && $(active_tab).length) {
            $(active_tab).fadeIn();
            $(active_tab + '-tab').addClass('nav-tab-active');
        } else {
            $('.group:first').fadeIn();
            $('.nav-tab-wrapper a:first').addClass('nav-tab-active');
        }

        // Bind tabs clicks
        $navtabs.click(function(e) {

            e.preventDefault();

            activeTab = $(this).attr('href');
            $('#tab_id').attr('value', activeTab);

            // Remove active class from all tabs
            $navtabs.removeClass('nav-tab-active');

            $(this).addClass('nav-tab-active').blur();

            var selected = $(this).attr('href');

            $group.hide();
            $(selected).fadeIn();

        });
    }

    $('#enable_parallax').click(function() {
        $('#section-sticky_header').fadeToggle(400);
    });

    if ($('#enable_parallax:checked').val() == undefined) {
        $('#section-sticky_header').show();
    }

    $("#section-parallax_section .controls").sortable({
        axis: "y",
        handle: ".title"
    });
    $("#sub-option-inner").disableSelection();

    $(document).on('click', '#section-parallax_section .section-toggle', function() {
        $(this).parent('.title').next('.sub-option-inner').slideToggle();
    });

    $('.parallax_section_page').on('change', function() {
        var sled = $(this).find("option:selected").text();
        $(this).parents('.sub-option').find('.title span').text(sled);
    }).change();

    $(document).on('click', '.remove-parallax', function() {
        var $this = $(this);
        $this.parents('.sub-option').slideUp(800);
        setTimeout(function() {
            $this.parents('.sub-option').remove();
        }, 750);
    });

    var logo_count = $('#logo-count').val();

    $('#add-logo').on('click', function() {
        logo_count++;
        var logo_code = '<div class="associate-logo sub-option clearfix">' +
                '<input class="of-input partner-link-input" type="text" placeholder="http://" value="" name="accesspress_parallax_pro[partner_logo][' + logo_count + '][link]">' +
                '<input type="text" placeholder="No file chosen" value="" name="accesspress_parallax_pro[partner_logo][' + logo_count + '][image]" class="upload">' +
                '<input type="button" value="Upload" class="upload-button button">' +
                '<div id="logo-image" class="screenshot"></div>' +
                '<div class="logo-remove">&times;</div>' +
                '</div>';
        $('.logo-wrap').append(logo_code);
    });

    jQuery('.switch_options').each(function() {

        //This object
        var obj = jQuery(this);

        var enb = obj.children('.switch_enable'); //cache first element, this is equal to ON
        var dsb = obj.children('.switch_disable'); //cache first element, this is equal to OFF
        var input = obj.children('input'); //cache the element where we must set the value
        var input_val = obj.children('input').val(); //cache the element where we must set the value

        /* Check selected */
        if (0 == input_val) {
            dsb.addClass('selected');
        }
        else if (1 == input_val) {
            enb.addClass('selected');
        }

        //Action on user's click(ON)
        enb.on('click', function() {
            $(dsb).removeClass('selected'); //remove "selected" from other elements in this object class(OFF)
            $(this).addClass('selected'); //add "selected" to the element which was just clicked in this object class(ON) 
            $(input).val(1).change(); //Finally change the value to 1
        });

        //Action on user's click(OFF)
        dsb.on('click', function() {
            $(enb).removeClass('selected'); //remove "selected" from other elements in this object class(ON)
            $(this).addClass('selected'); //add "selected" to the element which was just clicked in this object class(OFF) 
            $(input).val(0).change(); // //Finally change the value to 0
        });

    });

    jQuery('.ap_sliderui').each(function() {

        var obj = jQuery(this);
        var sId = "#" + obj.data('id');
        var val = obj.data('val');
        var min = obj.data('min');
        var max = obj.data('max');
        var step = obj.data('step');

        //slider init
        obj.slider({
            value: val,
            min: min,
            max: max,
            step: step,
            range: "min",
            slide: function(event, ui) {
                jQuery(sId).val(ui.value);
            }
        });

    });

    //scope = scope || document;
    $('#optionsframework-wrap select').each(function() {
        if (!$(this).parent().hasClass('select-wrapper')) {
            $(this).wrap('<div class="select-wrapper" />');
            $(this).parent('.select-wrapper').prepend('<span>' + $(this).find('option:selected').text() + '</span>');
        }
    });

    $(document).on('change', '#optionsframework-wrap select', function() {
        $(this).prev('span').replaceWith('<span>' + $(this).find('option:selected').text() + '</span>');
    });

    $(document).on($.browser.msie ? 'click' : 'change', '#optionsframework-wrap select', function(event) {
        $(this).prev('span').replaceWith('<span>' + $(this).find('option:selected').text() + '</span>');
    });

    var parallax_menu = $('#parallax_menu').val();
    if (parallax_menu == 1) {
        $('#section-scroll_effect, #section-scroll_speed, #section-home_text, #section-parallax_menu_side_navigator').fadeIn()
    } else {
        $('#section-scroll_effect, #section-scroll_speed, #section-home_text, #section-parallax_menu_side_navigator').fadeOut()
    }

    $('#section-parallax_menu .switch_options span').click(function() {
        var enable_parallax_val = $('#parallax_menu').val();
        if (enable_parallax_val == 1) {
            $('#section-scroll_effect, #section-scroll_speed, #section-home_text, #section-parallax_menu_side_navigator').fadeIn()
        } else {
            $('#section-scroll_effect, #section-scroll_speed, #section-home_text, #section-parallax_menu_side_navigator').fadeOut()
        }
    });

    $('#page_background_option').change(function() {
        var page_background_option_val = $(this).val();
        if (page_background_option_val == 'image') {
            $('#section-page_background_image').fadeIn();
            $('#section-page_background_pattern, #section-page_background_color').hide()
        } else if (page_background_option_val == 'color') {
            $('#section-page_background_color').fadeIn();
            $('#section-page_background_pattern, #section-page_background_image').hide()
        } else if (page_background_option_val == 'pattern') {
            $('#section-page_background_pattern').fadeIn();
            $('#section-page_background_color, #section-page_background_image').hide()
        } else {
            $('#section-page_background_color, #section-page_background_image, #section-page_background_pattern').hide()
        }
    }).change();

    $('#section-skin_color .radio input').click(function() {
        var Color = $(this).val();
        $('#theme_color').attr('value', Color);
        $('#section-theme_color .wp-color-result').css('background', Color);
    });

    $('#section-skin_color .radio').each(function() {
        var Color = $(this).find('input').val();
        $(this).css('background', Color);
    });

    $('#section-parallax_section .parallax_section_layout').each(function() {
        var IntlayoutValue = $(this).val();
        if (IntlayoutValue == 'service_template' || IntlayoutValue == 'team_template' || IntlayoutValue == 'team_template_new' || IntlayoutValue == 'features_template' || IntlayoutValue == 'testimonial_template' || IntlayoutValue == 'testimonial_template_new' || IntlayoutValue == 'blog_template'  || IntlayoutValue == 'blog_template_new') {
            $(this).parents('.sub-option-inner').find('.toggle-category').show();
        } else {
            $(this).parents('.sub-option-inner').find('.toggle-category').hide();
        }

        /**
         * For portfolio categories
         */
        if (IntlayoutValue == 'portfolio_template' || IntlayoutValue == 'portfolio_masonry_template') {
            $(this).parents('.sub-option-inner').find('.toggle-portfolio-categories').show();
        } else {
            $(this).parents('.sub-option-inner').find('.toggle-portfolio-categories').hide();
        }
    });

    $(document).on('change', '.parallax_section_layout', function() {
        var layoutValue = $(this).val();
        if (layoutValue == 'service_template' || layoutValue == 'team_template' || layoutValue == 'team_template_new' || layoutValue == 'features_template' || layoutValue == 'testimonial_template' || layoutValue == 'testimonial_template_new' || layoutValue == 'blog_template'|| layoutValue == 'blog_template_new') {
            $(this).parents('.sub-option-inner').find('.toggle-category').fadeIn();
        } else {
            $(this).parents('.sub-option-inner').find('.toggle-category').fadeOut();
        }
        
        /**
         * For portfolio categories
         */
        if (layoutValue == 'portfolio_template' || layoutValue == 'portfolio_masonry_template') {
            $(this).parents('.sub-option-inner').find('.toggle-portfolio-categories').show();
        } else {
            $(this).parents('.sub-option-inner').find('.toggle-portfolio-categories').hide();
        }
    });

    $('#portfolio_layout1').each(function(){
        var layoutValue = $(this).val();
        if(layoutValue == 'grid') {
            $('#section-portfolio_grid_columns1').fadeIn();
        } else {
            $('#section-portfolio_grid_columns1').fadeOut();
        }
    });

    $(document).on('change', '#portfolio_layout1', function() {
        var layoutValue = $(this).val();
        if(layoutValue == 'grid') {
            $('#section-portfolio_grid_columns1').fadeIn();
        } else {
            $('#section-portfolio_grid_columns1').fadeOut();
        }
    });

    var myCodeMirror1 = CodeMirror.fromTextArea(custom_css, {
        'mode': 'css',
        'lineNumbers': true,
        'lineWrapping': true
    });
    myCodeMirror1.setSize(false, 500);

    var myCodeMirror2 = CodeMirror.fromTextArea(custom_js, {
        'mode': 'htmlmixed',
        'lineNumbers': true,
        'lineWrapping': true
    });
    myCodeMirror2.setSize(false, 500);

});