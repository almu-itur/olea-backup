jQuery(document).ready(function($) {

   
    //Masonory for Portfolio
    var $container = $('#portfolio-grid, #portfolio-list').imagesLoaded(function() {
        $container.isotope({
            itemSelector: '.portfolio-list',
            layoutMode: 'fitRows'
        });
    });

    var $masonryContainer = $('#portfolio-masonry').imagesLoaded(function() {
        $masonryContainer.isotope({
            itemSelector: '.portfolio-list'
        });
    });

    var firstValue = $('.button-group li:first').attr('data-filter');
    $('.button-group li:first').addClass('is-checked');
    $container.isotope({filter: firstValue});

    $('.portfolio-listing .button-group').on('click', 'li', function() {
        var filterValue = $(this).attr('data-filter');
        $container.isotope({filter: filterValue});
    });

    var firstValue = $('.button-group li:first').attr('data-filter');
    $('.button-group li:first').addClass('is-checked');
    $masonryContainer.isotope({filter: firstValue});

    $('.portfolio-listing .button-group').on('click', 'li', function() {
        var filterValue = $(this).attr('data-filter');
        $masonryContainer.isotope({filter: filterValue});
    });
    

    // change is-checked class on buttons
    $('.button-group').each(function(i, buttonGroup) {
        var $buttonGroup = $(buttonGroup);
        $buttonGroup.on('click', 'li', function() {
            $buttonGroup.find('.is-checked').removeClass('is-checked');
            $(this).addClass('is-checked');
        });
    });

    //Social Icons Centering
    $(window).resize(function() {
        var socialWidth = $('.social-icons').outerWidth();
        var socialHeight = $('.social-icons').outerHeight();
        if ($('.social-icons').hasClass('appear-right') || $('.social-icons').hasClass('appear-left')) {
            $('.social-icons').css('margin-top', -(socialHeight / 2));
        } else if ($('.social-icons').hasClass('appear-top') || $('.social-icons').hasClass('appear-bottom')) {
            $('.social-icons').css('margin-left', -(socialWidth / 2));
        }
    }).resize();


    var mainHeaderHeight = $('#main-header').outerHeight();

    //Scroll To
    $('#content, #main-slider-wrap, #top-header, #site-navigation .normal-nav, #go-top').localScroll({
        offset: {
            top: -mainHeaderHeight
        }
    });

    //Align middle for caption
    $(window).resize(function() {

        if ($('#top-header').length > 0 && !$('body').hasClass('home')) {
            var topHeaderHeight = $('#top-header').outerHeight();
            $('#masthead').next('div').css('padding-top', topHeaderHeight);
        }

        $('.slider-caption').each(function() {
            var cap_height = $(this).actual('outerHeight');
            $(this).css('margin-top', -(cap_height / 2));
        });

        var MainHeaderHeight = $('#main-header').outerHeight();
        $('#header-wrap .entry-header').css('padding-top', MainHeaderHeight);
    }).resize();

    //Add Overlay for Each Slides
    $('#main-slider .overlay').prependTo('#main-slider .slides');

    $('.testimonial-slider, .team-slider, .new-team-slider').imagesLoaded(function() {
        //Testimonial Slider
        $('.testimonial-slider').bxSlider({
            adaptiveHeight: true,
            auto: false,
            speed: 1000,
            pause: 8000,
            pager: false,
            nextText: '&#8250',
            prevText: '&#8249',
        });

        $('.team-slider').bxSlider({
            auto: false,
            pager: false,
            nextText: '<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 59.414 59.414" style="enable-background:new 0 0 59.414 59.414;" xml:space="preserve"><g> <polygon id="team-arrow" points="15.561,59.414 14.146,58 42.439,29.707 14.146,1.414 15.561,0 45.268,29.707    "/></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>',
            prevText: '<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 59.414 59.414" style="enable-background:new 0 0 59.414 59.414;" xml:space="preserve"><g> <polygon id="team-arrow" points="43.854,59.414 14.146,29.707 43.854,0 45.268,1.414 16.975,29.707 45.268,58    "/></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>',
            moveSlides: 1,
            minSlides: 2,
            maxSlides: 4,
            slideWidth: 140,
            slideMargin: 20,
            infiniteLoop: false, 
            hideControlOnEnd: true
        });
    });

    /**
     * Testimonials new section
     */
    $('.testimonial-stage').each(function(){
        $this = $(this);

        $this.owlCarousel({
            center: true,
            items:5,
            loop:true,
            margin:0,
            autoplay:true,
            autoplayHoverPause:true,
            mouseDrag:false,
            pullDrag:false,
            responsive:{
                0:{
                    items:2,
                    pullDrag:true
                },
                600:{
                    items:3,
                },
                1000:{
                    items:5,
                }
            }
        });

        $this.on('translated.owl.carousel', function(e){
            id = e.item.index;
            $this = $(this);
            var itemId = $this.find('.owl-item').eq(id).find('.testimonial-content').attr('data-termid');
            $this.prev('.testimonials-content-wrap').find('.single-content').hide();
            $this.prev('.testimonials-content-wrap').find('#tcontent-'+itemId).fadeIn();
        });

    });

    $('.team-content').each(function(){
        $(this).find('.team-list:first').show();
    });
    
    $('.team-tab').each(function(){
        $(this).find('.team-image:first').addClass('active');
    });

    $('.team-tab .team-image').on('click', function() {
        $(this).parents('.team-listing').find('.team-image').removeClass('active');
        $(this).parents('.team-listing').find('.team-list').hide();
        $(this).addClass('active');
        var teamid = $(this).attr('id');
        $('.team-content .' + teamid).fadeIn();
        return false;
    });

    $('.social-icons a').each(function() {
        var title = $(this).attr('data-title');
        $(this).find('span').text(title);
    });

    $('.gallery-item a').each(function() {
        $(this).addClass('fancybox-gallery').attr('data-lightbox-gallery', 'gallery');
    });

    /*$(".fancybox-gallery").nivoLightbox();*/

    $('.menu-toggle').click(function() {
        $('#site-navigation > ul').not( ".mm-menu ul" ).slideToggle();
    });

    $('.top-menu-toggle').click(function() {
        $('.top-menu').slideToggle();
    });

    $('.parallax-nav > li').click(function(){
        $('.parallax-nav').not( ".mm-menu ul" ).hide();
    });

    $("#primary, #secondary-right").fitVids();

    /*Super Fish Menu*/
    $('.top-menu .menu, .main-navigation ul.nav').superfish({
        animation: {opacity: 'show', height: 'show'}, // fade-in and slide-down animation
        animationOut: {opacity: 'hide', height: 'hide'}, // fade-in and slide-down animation
        speed: 'fast' // faster animation speed
    });

    var mastheadHeight = $('#masthead').outerHeight();

    $('#masthead').css('min-height' , mastheadHeight);

    if ($('#masthead.pos-bottom.sticky-header').length > 0) {
        var headerTopPos = $('#main-header').offset().top;
        $(window).scroll(function() {
            var headerHeight = $('#masthead').outerHeight();
            var headerTotal = headerTopPos + headerHeight;

            if ($(window).scrollTop() > headerTotal) {
                $('#main-header').addClass('menu-fix');
            } else if ($(window).scrollTop() <= headerTopPos) {
                $('#main-header').removeClass('menu-fix');
            }
        });
    }else if($('#masthead.sticky-header').length > 0) {
        $(window).scroll(function() {
            var headerTopPos = $('#main-header').offset().top;
            var topHeaderHeight = $('#masthead').outerHeight();

            if ($(window).scrollTop() > topHeaderHeight) {
                $('#main-header').addClass('menu-fix');
            } else if ($(window).scrollTop() <= headerTopPos) {
                $('#main-header').removeClass('menu-fix');
            }
        });
    }

    //Go To Top
    $(window).scroll(function() {
        if ($(window).scrollTop() > 200) {
            $('#go-top').fadeIn();
            $('#main-header').addClass('no-opacity');
        } else {
            $('#go-top').fadeOut();
            $('#main-header').removeClass('no-opacity');
        }
    });

    $('.ap-toggle-title.open span i').text('-');
    $('.ap-toggle-title.close span i').text('+');

    $('.ap-toggle-title').click(function() {
        $(this).next('.ap-toggle-content').slideToggle();
        if ($(this).hasClass('open')) {
            $(this).find('span i').text('+');
            $(this).removeClass('open').addClass('close');
        } else {
            $(this).find('span i').text('-');
            $(this).removeClass('close').addClass('open');
        }
    });
 
    $('.counter').counterUp({
        delay: 20,
        time: 2000
    });
    
    $('.ap-progress-bar').each(function() { 
        var that = $(this);
        that.waypoint(function(direction) {
          var progressWidth = that.find('.ap-progress-bar-percentage').data('width') + '%';
          that.find('.ap-progress-bar-percentage').animate({width: progressWidth}, 2000);
        }, {
          offset: '80%'
        })
    });

    /*Short Codes Js*/
    $('.slider_wrap').bxSlider({
        pager: false,
        auto: true,
        adaptiveHeight: true,
        captions: true,
        prevText: '<i class="fa fa-angle-left"></i>',
        nextText: '<i class="fa fa-angle-right"></i>'
    });

    $('.ap_accordian:first').children('.ap_accordian_content').show();
    $('.ap_accordian:first').children('.ap_accordian_title').addClass('active');
    $('.ap_accordian_title').click(function() {
        if ($(this).hasClass('active')) {
        }
        else {
            $(this).parent('.ap_accordian').siblings().find('.ap_accordian_content').slideUp();
            $(this).next('.ap_accordian_content').slideToggle();
            $(this).parent('.ap_accordian').siblings().find('.ap_accordian_title').removeClass('active')
            $(this).toggleClass('active')
        }
    });

    $('.ap_toggle_title').click(function() {
        $(this).next('.ap_toggle_content').slideToggle();
        $(this).toggleClass('active')
    });

    $('.ap_tab_wrap').prepend('<div class="ap_tab_group clearfix"></div>');

    $('.ap_tab_wrap').each(function() {
        $(this).children('.ap_tab').find('.tab-title').prependTo($(this).find('.ap_tab_group'));
        $(this).children('.ap_tab').wrapAll("<div class='ap_tab_content' />");
    });

    $('#page').each(function() {
        $(this).find('.ap_tab:first-child').show();
        $(this).find('.tab-title:first-child').addClass('active')
    });


    $('.ap_tab_group .tab-title').click(function() {
        $(this).siblings().removeClass('active');
        $(this).addClass('active');
        $(this).parent('.ap_tab_group ').next('.ap_tab_content').find('.ap_tab').hide();
        var ap_id = $(this).attr('id');
        $(this).parent('.ap_tab_group ').next('.ap_tab_content').find('.' + ap_id).show();
    });
        
    if($('html').hasClass('desktop')){
        skrollr.init({
            forceHeight: false
        });
    }

    // *only* if we have anchor on the url
    if(window.location.hash) {

        $('html, body').animate({
            scrollTop: $(window.location.hash).offset().top-mainHeaderHeight
        }, 1000 );
           
    }
    /**
     * Video CTA
     */
    var apPlayer;
    apPlayer = $('.bg-video').YTPlayer({
        containment:'#videoCta',
        showControls:false, 
        loop:true, 
        mute:true, 
        opacity:1, 
        startAt:0,
        quality:'default',
        showYTLogo: false
    });
    $('#ap-cta-button').on( 'click', function(){
        apPlayer.YTPTogglePlay();
        $(this).toggleClass('play');
        return false;
    });

    /**
     * Testimonials video ajax
     */
    $('.apt-video').click(function(){

        var videoId = $(this).data('videoid');

        $.ajax({
                url : parallax_pro_ajax_script.ajaxurl,
                
                data:{
                        action : 'parallax_pro_ajax_action',
                        video_id:  videoId,
                    },
                type:'post',
                 success: function(res){
                        $('.ap-popup-wrap').show();
                        $('.ap-video-popup').html(res);
                    }
            });
    });

    $('body').on( 'click', '.popup-close' , function() {
        $('.ap-popup-wrap').fadeOut();
    });

    //Contact form bg parallax
    $('.cnt-bg-parallax').parallax( '50%', 0.4, true );
    
});




(function($) {
    var defaults = {
        bgWidth: 10000, //background image width
        transitionSpeed: 500000, //animation speed
        easing: 'linear' //default jquery easings
    }
    $.fn.animateBg = function(options) {
        var plugin = {};

        if (this.length == 0)
            return this;

        if (this.length > 1) {
            this.each(function() {
                $(this).animateBg(options)
            });
            return this;
        }

        var el = this;
        plugin.el = this;

        //initialize function
        var init = function() {
            plugin.settings = $.extend({}, defaults, options);

            plugin.el.animate({'background-position': '-' + plugin.settings.bgWidth + 'px'}, plugin.settings.transitionSpeed, plugin.settings.easing, function() {
                plugin.el.css('background-position', '0');
                $(plugin.el).animateBg(options);
            });
        }
        init();
        return this;
    }

    $(window).load(function(){
        $('#page-overlay').hide();
    });

}(jQuery));