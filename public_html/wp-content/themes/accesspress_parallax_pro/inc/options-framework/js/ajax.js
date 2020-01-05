jQuery(document).ready(function($) {
    $('#add_new_section').click(function() {
        $.ajax({
            url: ajaxurl,
            data: ({'action': 'get_my_option'}),
            success: function(data) {
                $('#section-parallax_section .controls').append(data);
                $('.of-color').wpColorPicker();

                $('.parallax_section_page').on('change', function() {
                    var sled = $(this).find("option:selected").text();
                    $(this).parents('.sub-option').find('.title span').text(sled);
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
            }
        });
    });

    $('.of-typography-face').on('change',function() {
        var font_family = $(this).val();
        var dis = $(this).attr('id');
        var dis_split = dis.split('_');
        $.ajax({
            url: ajaxurl,
            data: ({
                'action': 'accesspress_get_google_font_variants',
                'font_family':font_family,
            }),
            success: function(response) {
                $('#'+dis_split[0]+'_typography_style').html(response);
                var first_option = $('#'+dis_split[0]+'_typography_style option:first').html();
                $('#'+dis).parent('.select-wrapper').next().find('span').text(first_option);
            }
        });
    });
});