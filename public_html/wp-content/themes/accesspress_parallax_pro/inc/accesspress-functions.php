<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package accesspress_parallax
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function accesspress_parallax_page_menu_args($args) {
    $args['show_home'] = true;
    return $args;
}

add_filter('wp_page_menu_args', 'accesspress_parallax_page_menu_args');

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function accesspress_parallax_body_classes($classes) {
    // Adds a class of group-blog to blogs with more than 1 published author.
    if (is_multi_author()) {
        $classes[] = 'group-blog';
    }

    $side_navigator = of_get_option( 'parallax_menu_side_navigator' );
    if( $side_navigator == 1 ) {
        $classes[] = 'side-navigator-active';
    }

    return $classes;
}

add_filter('body_class', 'accesspress_parallax_body_classes');

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function accesspress_parallax_wp_title($title, $sep) {
    if (is_feed()) {
        return $title;
    }

    global $page, $paged;

    // Add the blog name
    $title .= get_bloginfo('name', 'display');

    // Add the blog description for the home/front page.
    $site_description = get_bloginfo('description', 'display');
    if ($site_description && ( is_home() || is_front_page() )) {
        $title .= " $sep $site_description";
    }

    // Add a page number if necessary:
    if (( $paged >= 2 || $page >= 2 ) && !is_404()) {
        $title .= " $sep " . sprintf(__('Page %s', 'accesspress_parallax'), max($paged, $page));
    }

    return $title;
}

add_filter('wp_title', 'accesspress_parallax_wp_title', 10, 2);


function accesspress_parallax_setup_author() {
    global $wp_query;

    if ($wp_query->is_author() && isset($wp_query->post)) {
        $GLOBALS['authordata'] = get_userdata($wp_query->post->post_author);
    }
}

add_action('wp', 'accesspress_parallax_setup_author');

//bxSlider Callback for do action
function accesspresslite_bxslidercb() {
    global $post;
    $accesspress_parallax = of_get_option('parallax_section');
    if (!empty($accesspress_parallax)) :
        $accesspress_parallax_first_page_array = array_slice($accesspress_parallax, 0, 1);
        $accesspress_parallax_first_page = "section-".$accesspress_parallax_first_page_array[0]['page'];
    endif;
    $accesspress_slider_category = of_get_option('slider_cat');
    $accesspress_slider_full_window = of_get_option('slider_full_window');
    $accesspress_show_pager = (of_get_option('show_pager') == '1') ? "true" : "false";
    $accesspress_show_controls = (of_get_option('show_controls') == '1') ? "true" : "false";
    $accesspress_auto_transition = (of_get_option('auto_transition') == '1') ? "true" : "false";
    $accesspress_slider_transition = (!of_get_option('slider_transition')) ? "fade" : of_get_option('slider_transition');
    $accesspress_slider_speed = (!of_get_option('slider_speed')) ? "5000" : of_get_option('slider_speed');
    $accesspress_slider_pause = (!of_get_option('slider_pause')) ? "5000" : of_get_option('slider_pause');
    $accesspress_show_caption = of_get_option('show_caption');
    $accesspress_enable_parallax = of_get_option('enable_parallax');
    ?>

    <div id="main-slider" class="full-screen-<?php echo $accesspress_slider_full_window; ?>">

        <div class="overlay"></div>

        <?php if ($accesspress_enable_parallax == '1' && !empty($accesspress_parallax_first_page)): ?>
            <div class="next-page"><a href="#<?php echo $accesspress_parallax_first_page; ?>"></a></div>
        <?php endif; ?>

        <script type="text/javascript">
            jQuery(function($) {
                $('#main-slider .bx-slider').bxSlider({
                    adaptiveHeight: true,
                    pager: <?php echo $accesspress_show_pager; ?>,
                    controls: <?php echo $accesspress_show_controls; ?>,
                    mode: '<?php echo $accesspress_slider_transition; ?>',
                    auto: <?php echo $accesspress_auto_transition; ?>,
                    pause: <?php echo $accesspress_slider_pause; ?>,
                    speed: <?php echo $accesspress_slider_speed; ?>
                });

    <?php if ($accesspress_slider_full_window == "1") : ?> 
            $(window).resize(function() {
                var winHeight = $(window).height();
                if($('.pos-top').length > 0){
                var header_height = $('#masthead').outerHeight();
                $('#main-slider .bx-viewport , #main-slider .slides').height(winHeight-header_height);
                }else{
                $('#main-slider .bx-viewport , #main-slider .slides').height(winHeight);
                }
            }).resize();
    <?php endif; ?>

            });
        </script>
        <?php
        if (!empty($accesspress_slider_category)) :

            $loop = new WP_Query(array(
                'category_name' => $accesspress_slider_category,
                'posts_per_page' => -1
            ));
            if ($loop->have_posts()) :
                ?>

                <div class="bx-slider">
                    <?php
                    while ($loop->have_posts()) : $loop->the_post();
                        $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', false);
                        $image_url = "";
                        if ($accesspress_slider_full_window == "1") :
                            $image_url = "style = background-image:url(" . $image[0] . ");";
                        endif;
                        ?>
                        <div class="slides" <?php echo $image_url; ?>>

                            <?php if ($accesspress_slider_full_window == "0") : ?>      
                                <img src="<?php echo $image[0]; ?>">
                            <?php endif; ?>

                            <?php if ($accesspress_show_caption == '1'): ?>
                                <div class="slider-caption"> 
                                    <div class="mid-content">
                                        <h1 class="caption-title"><?php the_title(); ?></h1>
                                        <h2 class="caption-description"><?php the_content(); ?></h2>
                                    </div>
                                </div>
                            <?php endif; ?>

                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?> 
        <?php endif; ?>
    </div>
    <?php
}

add_action('accesspresslite_bxslider', 'accesspresslite_bxslidercb', 10);

//add class for parallax
function accesspres_is_parallax($class) {
    $is_parallax = of_get_option('enable_parallax');
    if ($is_parallax == '1'):
        $class[] = "parallax-on";
    endif;
    return $class;
}

add_filter('body_class', 'accesspres_is_parallax');

//add class for website layout
function accesspres_layout($class) {
    $class[] = of_get_option('website_layout');
    return $class;
}

add_filter('body_class', 'accesspres_layout');

//Dynamic styles/scripts on header
function accesspress_header_styles_scripts() {
    $sections = of_get_option('parallax_section');
    $favicon = of_get_option('fav_icon');
    $favicon_iphone = of_get_option('favicon_iphone');
    $favicon_iphone_retina = of_get_option('favicon_iphone_retina');
    $favicon_ipad = of_get_option('favicon_ipad');
    $favicon_ipad_retina = of_get_option('favicon_ipad_retina');

    $custom_js = of_get_option('custom_js');
    
    if(!empty($favicon)){
        echo "<link type='image/png' rel='icon' href='" . $favicon . "'/>\n";
    }
    if(!empty($favicon_iphone)){
        echo "<link rel='apple-touch-icon' sizes='57x57' href='".$favicon_iphone."'/>\n";
    }
    if(!empty($favicon_iphone_retina)){
        echo "<link rel='apple-touch-icon' sizes='72x72' href='".$favicon_iphone_retina."'/>\n";
    }
    if(!empty($favicon_ipad)){
        echo "<link rel='apple-touch-icon' sizes='114x114' href='".$favicon_ipad."'/>\n";
    }
    if(!empty($favicon_ipad_retina)){
        echo "<link rel='apple-touch-icon' sizes='144x144' href='".$favicon_ipad_retina."'/>\n";
    }
    ?>

    <script>
    jQuery(document).ready(function($){

    <?php if(of_get_option('enable_animation') == '1' && is_front_page()) : ?>
        wow = new WOW(
        {
          offset:  200 
        }
      )
      wow.init();
    <?php endif; ?>
    
    <?php 
          if(of_get_option('alternative_menu')=='1') { ?>
            $("#site-navigation").mmenu({});
            $(".menu-toggle").click(function() {
            $("#site-navigation").trigger("open.mm");
            });
        <?php   
             if(of_get_option('enable_parallax')=='1') { ?>
                $("#site-navigation a").not('.mm-subopen, .mm-subclose').click(function() {
                $("#site-navigation").trigger("close.mm");
                });
               <?php }   ?>
             $("#site-navigation").prepend('<div id="collapse-nav"><svg class="svg" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15.642 15.642" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 15.642 15.642"><path fill-rule="evenodd" d="M8.882,7.821l6.541-6.541c0.293-0.293,0.293-0.768,0-1.061  c-0.293-0.293-0.768-0.293-1.061,0L7.821,6.76L1.28,0.22c-0.293-0.293-0.768-0.293-1.061,0c-0.293,0.293-0.293,0.768,0,1.061  l6.541,6.541L0.22,14.362c-0.293,0.293-0.293,0.768,0,1.061c0.147,0.146,0.338,0.22,0.53,0.22s0.384-0.073,0.53-0.22l6.541-6.541  l6.541,6.541c0.147,0.146,0.338,0.22,0.53,0.22c0.192,0,0.384-0.073,0.53-0.22c0.293-0.293,0.293-0.768,0-1.061L8.882,7.821z"/></svg></div>');
             $(document).on('click','#collapse-nav', function() {
                $("#site-navigation").trigger("close.mm");
             });
     <?php } ?>

    
    <?php 
    if(is_array($sections)): ?>
    $(window).on('load',function(){
        if($(window).width() > 768){ 
        <?php
        foreach ($sections as $section) {  
            if(!empty($section['image'])) {
                if($section['effects'] == "parallax"){
                echo "$('#section-" .$section['page']."').parallax('50%',0.4, true);\n";    
                }else if($section['effects'] == "movingbg"){
                echo "$('#section-" .$section['page']."').animateBg();\n"; 
                }
            }
        } 
        ?> 
        }         
    });
    <?php endif; ?>
    });

    <?php
    $map_latitude = of_get_option('map_latitude');
    $map_longitude = of_get_option('map_longitude');
    
    if(of_get_option('enable_googlemap') == '1' && !empty($map_latitude) && !empty($map_longitude) && (is_front_page() || is_page_template('contact-page.php') || is_page_template('home-page.php'))):
    $map_zoom = of_get_option('map_zoom') == '1' ? 'true' : 'false';
    $map_controls = of_get_option('map_controls') == '0' ? 'true' : 'false';
    $map_controls_inverse = of_get_option('map_controls') == '1' ? 'true' : 'false';
    $map_scrolling = of_get_option('map_scrolling') == '1' ? 'true' : 'false';
    $pin_color = of_get_option('theme_color');
    ?>
    var map;
    function initialize() {
      var apLatLng = new google.maps.LatLng(<?php echo of_get_option('map_latitude') ?>, <?php echo of_get_option('map_longitude') ?> );
      var MAP_PIN = 'M11.085,0C4.963,0,0,4.963,0,11.085c0,4.495,2.676,8.362,6.521,10.101l4.564,13.56l4.564-13.56\
    c3.846-1.739,6.521-5.606,6.521-10.101C22.17,4.963,17.208,0,11.085,0 M11.085,15.062c-2.182,0-3.95-1.769-3.95-3.95\
    c0-2.182,1.768-3.95,3.95-3.95s3.951,1.768,3.951,3.95C15.036,13.293,13.267,15.062,11.085,15.062';
      var mapOptions = {
        zoom: <?php echo of_get_option('map_zoom') ?>,
        center: apLatLng,
        mapTypeId: google.maps.MapTypeId.<?php echo of_get_option('map_type') ?>,
        scrollwheel: <?php echo $map_scrolling ?>,
        zoomControl: <?php echo $map_controls_inverse ?>,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.SMALL
        },
        mapTypeControl: <?php echo $map_controls_inverse ?>,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
        },
        disableDefaultUI: <?php echo $map_controls ?>,
      };
      map = new google.maps.Map(document.getElementById('ap-map-canvas'),
          mapOptions);
      <?php if(of_get_option('pin_marker') == '1'){ ?>
      var marker = new google.maps.Marker({
            position: apLatLng,
            map: map,
            icon: {
                path: MAP_PIN,
                fillColor: '<?php echo $pin_color; ?>',
                fillOpacity: 1,
                strokeColor: '',
                strokeWeight: 0,
                scale: 1.5,
                anchor: new google.maps.Point(11, 38)
                },   
        });
      <?php } ?>
    }

    google.maps.event.addDomListener(window, 'load', initialize);
    <?php endif; ?>
    
    <?php echo $custom_js; ?>
    </script>

    <!-- <div id="fb-root"></div>
    <script>
    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    </script> -->
<?php
}

add_action( 'wp_head', 'accesspress_header_styles_scripts', 9 );

function accesspress_footer_count() {
    $count = 0;
    if (is_active_sidebar('footer-1'))
        $count++;

    if (is_active_sidebar('footer-2'))
        $count++;

    if (is_active_sidebar('footer-3'))
        $count++;

    if (is_active_sidebar('footer-4'))
        $count++;

    return $count;
}

function accesspress_social_cb() {
    $facebooklink = of_get_option('facebook');
    $twitterlink = of_get_option('twitter');
    $google_pluslink = of_get_option('google_plus');
    $youtubelink = of_get_option('youtube');
    $pinterestlink = of_get_option('pinterest');
    $linkedinlink = of_get_option('linkedin');
    $flickrlink = of_get_option('flickr');
    $vimeolink = of_get_option('vimeo');
    $instagramlink = of_get_option('instagram');
    $dribbblelink = of_get_option('dribbble');
    $slidesharelink = of_get_option('slideshare');
    $foursquarelink = of_get_option('foursquare');
    $tumblrlink = of_get_option('tumblr');
    $wordpresslink = of_get_option('wordpress');
    $rsslink = of_get_option('rss');
    $deliciouslink = of_get_option('delicious');
    $lastfmlink = of_get_option('lastfm');
    $githublink = of_get_option('github');
    $soundcloudlink = of_get_option('soundcloud');
    $stumbleuponlink = of_get_option('stumbleupon');
    $skypelink = of_get_option('skype');
    ?>
        <?php if (!empty($facebooklink)) { ?>
            <a href="<?php echo of_get_option('facebook'); ?>" class="facebook" data-title="Facebook" target="_blank"><i class="fa fa-facebook"></i><span></span></a>
        <?php } ?>

        <?php if (!empty($twitterlink)) { ?>
            <a href="<?php echo of_get_option('twitter'); ?>" class="twitter" data-title="Twitter" target="_blank"><i class="fa fa-twitter"></i><span></span></a>
        <?php } ?>

        <?php if (!empty($google_pluslink)) { ?>
            <a href="<?php echo of_get_option('google_plus'); ?>" class="gplus" data-title="Google Plus" target="_blank"><i class="fa fa-google-plus"></i><span></span></a>
        <?php } ?>

        <?php if (!empty($youtubelink)) { ?>
            <a href="<?php echo of_get_option('youtube'); ?>" class="youtube" data-title="Youtube" target="_blank"><i class="fa fa-youtube"></i><span></span></a>
        <?php } ?>

        <?php if (!empty($pinterestlink)) { ?>
            <a href="<?php echo of_get_option('pinterest'); ?>" class="pinterest" data-title="Pinterest" target="_blank"><i class="fa fa-pinterest"></i><span></span></a>
        <?php } ?>

        <?php if (!empty($linkedinlink)) { ?>
            <a href="<?php echo of_get_option('linkedin'); ?>" class="linkedin" data-title="Linkedin" target="_blank"><i class="fa fa-linkedin"></i><span></span></a>
        <?php } ?>

        <?php if (!empty($flickrlink)) { ?>
            <a href="<?php echo of_get_option('flickr'); ?>" class="flickr" data-title="Flickr" target="_blank"><i class="fa fa-flickr"></i><span></span></a>
        <?php } ?>

        <?php if (!empty($vimeolink)) { ?>
            <a href="<?php echo of_get_option('vimeo'); ?>" class="vimeo" data-title="Vimeo" target="_blank"><i class="fa fa-vimeo-square"></i><span></span></a>
        <?php } ?>

        <?php if (!empty($instagramlink)) { ?>
            <a href="<?php echo of_get_option('instagram'); ?>" class="instagram" data-title="Instagram" target="_blank"><i class="fa fa-instagram"></i><span></span></a>
        <?php } ?>

        <?php if (!empty($dribbblelink)) { ?>
            <a href="<?php echo of_get_option('dribbble'); ?>" class="dribbble" data-title="Dribbble" target="_blank"><i class="fa fa-dribbble"></i><span></span></a>
        <?php } ?>

        <?php if (!empty($slidesharelink)) { ?>
            <a href="<?php echo of_get_option('slideshare'); ?>" class="slideshare" data-title="Slideshare" target="_blank"><i class="fa fa-slideshare"></i><span></span></a>
        <?php } ?>

        <?php if (!empty($foursquarelink)) { ?>
            <a href="<?php echo of_get_option('foursquare'); ?>" class="foursquare" data-title="FourSquare" target="_blank"><i class="fa fa-foursquare"></i><span></span></a>
        <?php } ?>

        <?php if (!empty($tumblrlink)) { ?>
            <a href="<?php echo of_get_option('tumblr'); ?>" class="tumblr" data-title="Tumblr" target="_blank"><i class="fa fa-tumblr"></i><span></span></a>
        <?php } ?>

        <?php if (!empty($wordpresslink)) { ?>
            <a href="<?php echo of_get_option('wordpress'); ?>" class="wordpress" data-title="WordPress" target="_blank"><i class="fa fa-wordpress"></i><span></span></a>
        <?php } ?>

        <?php if (!empty($deliciouslink)) { ?>
            <a href="<?php echo of_get_option('delicious'); ?>" class="delicious" data-title="Delicious" target="_blank"><i class="fa fa-delicious"></i><span></span></a>
        <?php } ?>

        <?php if (!empty($rsslink)) { ?>
            <a href="<?php echo of_get_option('rss'); ?>" class="rss" data-title="RSS" target="_blank"><i class="fa fa-rss"></i><span></span></a>
        <?php } ?>

        <?php if (!empty($lastfmlink)) { ?>
            <a href="<?php echo of_get_option('lastfm'); ?>" class="lastfm" data-title="Lastfm" target="_blank"><i class="fa fa-lastfm"></i><span></span></a>
        <?php } ?>

        <?php if (!empty($githublink)) { ?>
            <a href="<?php echo of_get_option('github'); ?>" class="github" data-title="Github" target="_blank"><i class="fa fa-github"></i><span></span></a>
        <?php } ?>

        <?php if (!empty($soundcloudlink)) { ?>
            <a href="<?php echo of_get_option('soundcloud'); ?>" class="soundcloud" data-title="Soundcloud" target="_blank"><i class="fa fa-soundcloud"></i><span></span></a>
        <?php } ?>

        <?php if (!empty($stumbleuponlink)) { ?>
            <a href="<?php echo of_get_option('stumbleupon'); ?>" class="stumbleupon" data-title="Stumbleupon" target="_blank"><i class="fa fa-stumbleupon"></i><span></span></a>
        <?php } ?>

        <?php if (!empty($skypelink)) { ?>
            <a href="<?php echo "skype:" . of_get_option('skype') ?>" class="skype" data-title="Skype"><i class="fa fa-skype"></i><span></span></a>
                <?php } ?>
    <?php
}

add_action('accesspress_social', 'accesspress_social_cb', 10);

function accesspress_remove_page_menu_div($menu) {
    return preg_replace(array('#^<div[^>]*>#', '#</div>$#'), '', $menu);
}

add_filter('wp_page_menu', 'accesspress_remove_page_menu_div');

function accesspress_customize_excerpt_more($more) {

    $excerpt_more_content = '...';
    
    return $excerpt_more_content;
}

add_filter('excerpt_more', 'accesspress_customize_excerpt_more');

function accesspress_word_count($string, $limit) {
    $words = explode(' ', $string);
    return implode(' ', array_slice($words, 0, $limit));
}

function accesspress_letter_count($content, $limit) {
    $striped_content = strip_tags($content);
    $striped_content = strip_shortcodes($striped_content);
    $limit_content = mb_substr($striped_content, 0, $limit);

    if ($limit_content < $content) {
        $limit_content .= "...";
    }
    return $limit_content;
}

function colourBrightness($hex, $percent) {
    // Work out if hash given
    $hash = '';
    if (stristr($hex, '#')) {
        $hex = str_replace('#', '', $hex);
        $hash = '#';
    }
    /// HEX TO RGB
    $rgb = array(hexdec(substr($hex, 0, 2)), hexdec(substr($hex, 2, 2)), hexdec(substr($hex, 4, 2)));
    //// CALCULATE 
    for ($i = 0; $i < 3; $i++) {
        // See if brighter or darker
        if ($percent > 0) {
            // Lighter
            $rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1 - $percent));
        } else {
            // Darker
            $positivePercent = $percent - ($percent * 2);
            $rgb[$i] = round($rgb[$i] * $positivePercent) + round(0 * (1 - $positivePercent));
        }
        // In case rounding up causes us to go to 256
        if ($rgb[$i] > 255) {
            $rgb[$i] = 255;
        }
    }
    //// RBG to Hex
    $hex = '';
    for ($i = 0; $i < 3; $i++) {
        // Convert the decimal digit to hex
        $hexDigit = dechex($rgb[$i]);
        // Add a leading zero if necessary
        if (strlen($hexDigit) == 1) {
            $hexDigit = "0" . $hexDigit;
        }
        // Append to the hex string
        $hex .= $hexDigit;
    }
    return $hash . $hex;
}

function hex2rgb($hex) {
    $hex = str_replace("#", "", $hex);

    if (strlen($hex) == 3) {
        $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
        $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
        $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
    } else {
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
    }
    $rgb = array($r, $g, $b);
    //return implode(",", $rgb); // returns the rgb values separated by commas
    return $rgb; // returns an array with the rgb values
}

/* BreadCrumb */

function accesspress_parallax_breadcrumbs() {
    global $post;
    $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show

    $delimiter = of_get_option('breadcrumb_seperator');
    if (isset($delimiter)) {
        $delimiter = of_get_option('breadcrumb_seperator');
    } else {
        $delimiter = '&raquo;'; // delimiter between crumbs
    }

    $home = of_get_option('breadcrumb_home_text');
    if (isset($home)) {
        $home = of_get_option('breadcrumb_home_text');
    } else {
        $home = __('Home','accesspress_parallax'); // text for the 'Home' link
    }

    $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $before = '<span class="current">'; // tag before the current crumb
    $after = '</span>'; // tag after the current crumb

    $homeLink = get_bloginfo('url');

    if (is_home() || is_front_page()) {

        if ($showOnHome == 1)
            echo '<div id="accesspress-breadcrumb"><a href="' . $homeLink . '">' . __($home,'accesspress_parallax') . '</a></div></div>';
    } else {

        echo '<div id="accesspress-breadcrumb"><a href="' . $homeLink . '">' . __($home,'accesspress_parallax') . '</a> ' . $delimiter . ' ';

        if (is_category()) {
            $thisCat = get_category(get_query_var('cat'), false);
            if ($thisCat->parent != 0)
                echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
            echo $before . __('Archive by category','accesspress_parallax').' "' . single_cat_title('', false) . '"' . $after;
        } elseif (is_search()) {
            echo $before . __('Search results for','accesspress_parallax'). '"' . get_search_query() . '"' . $after;
        } elseif (is_day()) {
            echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
            echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
            echo $before . get_the_time('d') . $after;
        } elseif (is_month()) {
            echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
            echo $before . get_the_time('F') . $after;
        } elseif (is_year()) {
            echo $before . get_the_time('Y') . $after;
        } elseif (is_single() && !is_attachment()) {
            if (get_post_type() != 'post') {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
                if ($showCurrent == 1)
                    echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
            } else {
                $cat = get_the_category();
                $cat = $cat[0];
                $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                if ($showCurrent == 0)
                    $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
                echo $cats;
                if ($showCurrent == 1)
                    echo $before . get_the_title() . $after;
            }
        } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
            $post_type = get_post_type_object(get_post_type());
            echo $before . $post_type->labels->singular_name . $after;
        } elseif (is_attachment()) {
            if ($showCurrent == 1) echo ' ' . $before . get_the_title() . $after;
        } elseif (is_page() && !$post->post_parent) {
            if ($showCurrent == 1)
                echo $before . get_the_title() . $after;
        } elseif (is_page() && $post->post_parent) {
            $parent_id = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                $parent_id = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            for ($i = 0; $i < count($breadcrumbs); $i++) {
                echo $breadcrumbs[$i];
                if ($i != count($breadcrumbs) - 1)
                    echo ' ' . $delimiter . ' ';
            }
            if ($showCurrent == 1)
                echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
        } elseif (is_tag()) {
            echo $before . __('Posts tagged','accesspress_parallax').' "' . single_tag_title('', false) . '"' . $after;
        } elseif (is_author()) {
            global $author;
            $userdata = get_userdata($author);
            echo $before . __('Articles posted by ','accesspress_parallax'). $userdata->display_name . $after;
        } elseif (is_404()) {
            echo $before . 'Error 404' . $after;
        }

        if (get_query_var('paged')) {
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                echo ' (';
            echo __('Page', 'accesspress_parallax') . ' ' . get_query_var('paged');
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                echo ')';
        }

        echo '</div>';
    }
}

function kriesi_pagination($pages = '', $range = 1) {
    $showitems = ($range * 2) + 1;

    global $paged;
    if (empty($paged))
        $paged = 1;

    if ($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if (!$pages) {
            $pages = 1;
        }
    }

    if (1 != $pages) {
        echo "<div class='accesspress_pagination'>";
        if ($paged > 2 && $paged > $range + 1 && $showitems < $pages)
            echo "<a href='" . get_pagenum_link(1) . "'>&laquo;</a>";
        if ($paged > 1 && $showitems < $pages)
            echo "<a href='" . get_pagenum_link($paged - 1) . "'>&lsaquo;</a>";

        for ($i = 1; $i <= $pages; $i++) {
            if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems )) {
                echo ($paged == $i) ? "<span class='current'>" . $i . "</span>" : "<a href='" . get_pagenum_link($i) . "' class='inactive' >" . $i . "</a>";
            }
        }

        if ($paged < $pages && $showitems < $pages)
            echo "<a href='" . get_pagenum_link($paged + 1) . "'>&rsaquo;</a>";
        if ($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages)
            echo "<a href='" . get_pagenum_link($pages) . "'>&raquo;</a>";
        echo "</div>\n";
    }
}

function accesspress_share_script() {
    $share_publisher_id = of_get_option('share_publisher_id');
    if(!empty($share_publisher_id) && is_single()){ 
        echo '<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=' . $share_publisher_id . '"></script>';
    }
}

add_action('wp_footer', 'accesspress_share_script');

function accesspress_get_attachment_id_from_url( $attachment_url = '' ) {
 
    global $wpdb;
    $attachment_id = false;
 
    // If there is no url, return.
    if ( '' == $attachment_url )
        return;
 
    // Get the upload directory paths
    $upload_dir_paths = wp_upload_dir();
 
    // Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
    if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {
 
        // If this is the URL of an auto-generated thumbnail, get the URL of the original image
        $attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );
 
        // Remove the upload path base directory from the attachment URL
        $attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );
 
        // Finally, run a custom database query to get the attachment ID from the modified attachment URL
        $attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );
 
    }
 
    return $attachment_id;
}

function exclude_category_from_blogpost($query) {
$exclude_cat_array = of_get_option('exclude_from_blog');
if(is_array($exclude_cat_array)):
    $cats = array();
    foreach($exclude_cat_array as $key => $value){
        if($value == 1){
            $catObj = get_category_by_slug($key);
            $catid = $catObj->term_id;
            $cats[] = -$catid; 
        }
    }
    $category = join( "," , $cats);
    if ( $query->is_home() ) {
    $query->set('cat', $category);
    }
    return $query;
endif;
}

add_filter('pre_get_posts', 'exclude_category_from_blogpost');

function accesspress_ajax_script()
{
     wp_localize_script( 'ajax_script_function', 'ajax_script', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )) );
     wp_enqueue_script( 'ajax_script_function', get_template_directory_uri().'/inc/options-framework/js/ajax.js', 'jquery', true);

}
add_action('admin_enqueue_scripts', 'accesspress_ajax_script');

function get_my_option()
{
    require get_template_directory() . '/inc/ajax.php';
    die();
}

add_action("wp_ajax_get_my_option", "get_my_option");

function accesspress_get_google_font_variants()
{
    $accesspress_parallax_font_list = get_option( 'accesspress_parallax_google_font');
    
    $font_family = $_REQUEST['font_family'];
    
    $font_array = accesspress_search_key($accesspress_parallax_font_list,'family', $font_family);

    $variants_array = $font_array['0']['variants'] ;
    $options_array = "";
    foreach ($variants_array  as $key=>$variants ) {
        $options_array .= '<option value="'.$key.'">'.$variants.'</option>';
    }
    echo $options_array;
    die();
}

add_action("wp_ajax_accesspress_get_google_font_variants", "accesspress_get_google_font_variants");

function accesspress_search_key($array, $key, $value)
{
    $results = array();

    if (is_array($array)) {
        if (isset($array[$key]) && $array[$key] == $value) {
            $results[] = $array;
        }

        foreach ($array as $subarray) {
            $results = array_merge($results, accesspress_search_key($subarray, $key, $value));
        }
    }

    return $results;
}

if (!function_exists('array_replace')){
    function array_replace(){ 
        $array=array();    
        $n=func_num_args(); 
        while ($n-- >0) { 
            $array+=func_get_arg($n); 
        } 
        return $array; 
    }
}

/**
 * get youtube video ID from URL
 *
 * @param string $url
 * @return string Youtube video id or FALSE if none found. 
 * @since 4.0.0
 */
if( ! function_exists( 'ap_youtube_id_from_url' ) ):
    function ap_youtube_id_from_url($url) {
        $pattern = 
            '%^# Match any youtube URL
            (?:https?://)?  # Optional scheme. Either http or https
            (?:www\.)?      # Optional www subdomain
            (?:             # Group host alternatives
              youtu\.be/    # Either youtu.be,
            | youtube\.com  # or youtube.com
              (?:           # Group path alternatives
                /embed/     # Either /embed/
              | /v/         # or /v/
              | /watch\?v=  # or /watch\?v=
              )             # End path alternatives.
            )               # End host alternatives.
            ([\w-]{10,12})  # Allow 10-12 for 11 char youtube id.
            $%x'
            ;
        $result = preg_match( $pattern, $url, $matches );
        if ( $result ) {
            return $matches[1];
        }
        return false;
    }
endif;

//add_filter( 'the_content', 'get_video_url', 99 );
function get_video_url( $content ) {
    if ( preg_match( '|^\s*(https?://[^\s"]+)\s*$|im', $content, $matches ) ) {
        return ( $matches[1] );
    }
}

/**
** Retina images image generate function 
**/
function ap_parallax_retina_support_attachment_meta( $metadata, $attachment_id ) {
   foreach ( $metadata as $key => $value ) {
       if ( is_array( $value ) ) {
           foreach ( $value as $image => $attr ) {
               if ( is_array( $attr ) )
                   ap_parallax_retina_support_create_images( get_attached_file( $attachment_id ), $attr['width'], $attr['height'], true );
           }
       }
   }

   return $metadata;
}
add_filter( 'wp_generate_attachment_metadata', 'ap_parallax_retina_support_attachment_meta', 10, 2 );

/**
* Create retina-ready images
* Referenced via ap_parallax_retina_support_attachment_meta().
**/
function ap_parallax_retina_support_create_images( $file, $width, $height, $crop = false ) {
   if ( $width || $height ) {
       $resized_file = wp_get_image_editor( $file );
       if ( ! is_wp_error( $resized_file ) ) {
           $filename = $resized_file->generate_filename( $width . 'x' . $height . '@2x' );

           $resized_file->resize( $width * 2, $height * 2, $crop );
           $resized_file->save( $filename );

           $info = $resized_file->get_size();

           return array(
               'file' => wp_basename( $filename ),
               'width' => $info['width'],
               'height' => $info['height'],
           );
       }
   }
   return false;
}


/**
* Delete retina-ready images
* This function is attached to the 'delete_attachment' filter hook.
**/

function ap_parallax_delete_retina_support_images( $attachment_id ) {
   $meta = wp_get_attachment_metadata( $attachment_id );
   $upload_dir = wp_upload_dir();
   $path = pathinfo( $meta['file'] );
   foreach ( $meta as $key => $value ) {
       if ( 'sizes' === $key ) {
           foreach ( $value as $sizes => $size ) {
               $original_filename = $upload_dir['basedir'] . '/' . $path['dirname'] . '/' . $size['file'];
               $retina_filename = substr_replace( $original_filename, '@2x.', strrpos( $original_filename, '.' ), strlen( '.' ) );
               if ( file_exists( $retina_filename ) )
                   unlink( $retina_filename );
           }
       }
   }
}
add_filter( 'delete_attachment', 'ap_parallax_delete_retina_support_images' );


/**
*  Cart function area for header one
*/
if ( ! function_exists( 'ap_parallax_shopping_cart' ) ) {
  function ap_parallax_shopping_cart(){ 
    if ( !class_exists( 'WooCommerce' ) ) {
        return ;
    }
?>        
            <a class="cart-contents" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" title="<?php _e( 'View your shopping cart', 'accesspress_parallax' ); ?>">
              <div class="count">
                  <i class="fa fa-shopping-cart"></i>
                  <span class="cart-count"><?php echo wp_kses_data( sprintf(  WC()->cart->get_cart_contents_count() ) ); ?></span>
              </div>                                      
            </a>
  <?php
  }
}

if ( ! function_exists( 'ap_parallax_cart_link_fragment' ) ) {

   function ap_parallax_cart_link_fragment( $fragments ) {
       global $woocommerce;
       ob_start();
       ap_parallax_shopping_cart();
       $fragments['a.cart-contents'] = ob_get_clean();
       return $fragments;
   }
}
add_filter( 'add_to_cart_fragments', 'ap_parallax_cart_link_fragment' );

/**
 * Testimonials video Ajax Function
**/
if ( ! function_exists( 'parallax_pro_ajax_action' ) ) {
    function parallax_pro_ajax_action() {
            $video_id    = $_POST['video_id'];
            ob_start();
        ?>
            <div class="ap-video-wrap">
                <span class="popup-close">
                    <i class="fa fa-close"></i>
                </span>
                <?php echo wp_oembed_get( ( 'http://www.youtube.com/watch?v=' . $video_id ) , array('width'=>1000) ); ?>
            </div>
        <?php
            $sv_html = ob_get_contents();
            ob_get_clean();
            echo $sv_html;
        die();
    }
}
add_action( 'wp_ajax_parallax_pro_ajax_action', 'parallax_pro_ajax_action' );
add_action( 'wp_ajax_nopriv_parallax_pro_ajax_action', 'parallax_pro_ajax_action' );