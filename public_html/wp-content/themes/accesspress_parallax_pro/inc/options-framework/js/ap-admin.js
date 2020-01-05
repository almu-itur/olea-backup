jQuery(document).ready(function($) {

    $(document).on('click', '.ap-font-group li', function() {
        $('.ap-font-group li').removeClass();
        $(this).addClass('selected');
        var aa = $(this).parents('#ap-font-awesome-list').find('.ap-font-group li.selected').children('i').attr('class');
        $(this).parents('#ap-font-awesome-list').siblings('p').find('.hidden-icon-input').val(aa);
        $(this).parents('#ap-font-awesome-list').siblings('p').find('.icon-receiver').html('<i class="' + aa + '"></i>');
        return false;
    });

});