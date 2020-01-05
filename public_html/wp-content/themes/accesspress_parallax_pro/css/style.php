<?php
header("Content-type: text/css");

$url    = dirname( __FILE__ );
$strpos = strpos( $url, 'wp-content' );
$root   = substr( $url, 0, $strpos );

if (file_exists($root . '/wp-load.php')) {
    require_once( $root . '/wp-load.php' );
}else {
    die('/* Error */');
}

$image_url = get_template_directory_uri() . "/images/";
$overlay_url = get_template_directory_uri() . "/images/overlays/";
$sections = of_get_option('parallax_section');
$custom_css = of_get_option('custom_css');

if (is_array($sections)):
    foreach ($sections as $section) { 
        echo "#section-" . $section['page'] . "{ background:url(" . $section['image'] . ") " . $section['repeat'] . " " . $section['attachment'] . " " . $section['position'] . " " . $section['color'] . "; background-size:" . $section['size'] . "; color:" . $section['font_color'] . "}\n";
        if ($section['overlay'] != "none") {
            echo "#section-". $section['page'] . " .overlay { background:url(" . $overlay_url . $section['overlay'] . ".png);}\n";
        }
        echo "#section-". $section['page'] . ".parallax-section h2{ color:" . $section['header_color'] . "}\n";
        echo "#section-". $section['page'] . " .testimonial-listing .bx-wrapper .bx-controls-direction a{border-color:" . $section['font_color'] . ";color:". $section['font_color'] ."}\n";
        echo "#section-". $section['page'] . ".service_template .section-wrap::after{ background-color:" . $section['color'] . "}\n";
    }
endif;

$page_background_option = of_get_option('page_background_option');
$page_background_image = of_get_option('page_background_image');
$page_background_color = of_get_option('page_background_color');
$page_background_pattern = of_get_option('page_background_pattern');
$top_header_bg_color = of_get_option('top_header_bg_color');
$top_header_bg_color_hover = colourBrightness($top_header_bg_color, '0.9');
$header_background = of_get_option('header_bg_color');
$header_background_bg_opacity = of_get_option('main_header_bg_opacity');
$header_background_rgb = hex2rgb($header_background);
$header_background_rgba = 'rgba(' . $header_background_rgb[0] . ',' . $header_background_rgb[1] . ',' . $header_background_rgb[2] . ',' . $header_background_bg_opacity . ')';
$top_header_typography = of_get_option('topheader_typography');
$top_header_link_hover_color = of_get_option('top_header_link_hover_color');
$menu_typography = of_get_option('menu_typography');
$menu_hover_color = of_get_option('menu_hover_color');
$menu_text_transform = of_get_option('menu_text_transform');
$menu_top_margin = of_get_option('menu_top_margin') . "px";
$menu_left_margin = of_get_option('menu_left_margin') . "px";
$menu_right_margin = of_get_option('menu_right_margin') . "px";
$menu_bottom_margin = of_get_option('menu_bottom_margin') . "px";
$logo_top_margin = of_get_option('logo_top_margin') . "px";
$logo_left_margin = of_get_option('logo_left_margin') . "px";
$logo_right_margin = of_get_option('logo_right_margin') . "px";
$logo_bottom_margin = of_get_option('logo_bottom_margin') . "px";
$social_bg_color = of_get_option('social_bg_color');
$social_hov_bg_color = of_get_option('social_hov_bg_color');
$top_header_height = of_get_option('top_header_height') . "px";
$body_typography = of_get_option('body_typography');
$h1_typography = of_get_option('h1_typography');
$h2_typography = of_get_option('h2_typography');
$h3_typography = of_get_option('h3_typography');
$h4_typography = of_get_option('h4_typography');
$h5_typography = of_get_option('h5_typography');
$h6_typography = of_get_option('h6_typography');
$widget_title_typography = of_get_option('widgettitle_typography');
$footer_title_typography = of_get_option('footertitle_typography');
$h1_text_transform = of_get_option('h1_text_transform');
$h2_text_transform = of_get_option('h2_text_transform');
$h3_text_transform = of_get_option('h3_text_transform');
$h4_text_transform = of_get_option('h4_text_transform');
$h5_text_transform = of_get_option('h5_text_transform');
$h6_text_transform = of_get_option('h6_text_transform');
$widget_title_text_transform = of_get_option('widget_title_text_transform');
$footer_title_text_transform = of_get_option('footer_title_text_transform');
$top_footer_bg = of_get_option('top_footer_bg');
$top_footer_title_color = of_get_option('top_footer_title_color');
$top_footer_font_color = of_get_option('top_footer_font_color');
$top_footer_link_color = of_get_option('top_footer_link_color');
$bottom_footer_bg = of_get_option('bottom_footer_bg');
$bottom_footer_text_color = of_get_option('bottom_footer_text_color');
$footer_title_typography_face = "'" . $footer_title_typography['face'] . "'";
$widget_title_typography_face = "'" . $widget_title_typography['face'] . "'";
$h6_typography_face = "'" . $h6_typography['face'] . "'";
$h5_typography_face = "'" . $h5_typography['face'] . "'";
$h4_typography_face = "'" . $h4_typography['face'] . "'";
$h3_typography_face = "'" . $h3_typography['face'] . "'";
$h2_typography_face = "'" . $h2_typography['face'] . "'";
$h1_typography_face = "'" . $h1_typography['face'] . "'";
$body_typography_face = "'" . $body_typography['face'] . "'";
$menu_typography_face = "'" . $menu_typography['face'] . "'";
$top_header_typography_face = "'" . $top_header_typography['face'] . "'";
$post_title_color = of_get_option('post_title_color');
$page_title_color = of_get_option('page_title_color');
$archive_title_color = of_get_option('archive_title_color');
$select_preloader = of_get_option('select_preloader');
$map_height = of_get_option('map_height') . "px";
$theme_color = of_get_option('theme_color');
$header_shadow = of_get_option('header_shadow');
$theme_color_hov = colourBrightness($theme_color, '-0.9');
$theme_color_hov_new = colourBrightness($theme_color, '-0.8');
$enable_breadcrumb = of_get_option('enable_breadcrumb');
$enable_breadcrumb_mobile = of_get_option('enable_breadcrumb_mobile');
$slider_overlay = of_get_option('slider_overlay');

$accesspress_parallax_css = "#top-header{ background:" . $top_header_bg_color . ";font-size:" . $top_header_typography['size'] . ";font-family:" . $top_header_typography['face'] . ";font-weight:" . $top_header_typography['style'] . ";color:" . $top_header_typography['color'] . ";line-height:" . $top_header_height . "}\n";
$accesspress_parallax_css .= "#top-header a{color:" . $top_header_typography['color'] . "}\n";
$accesspress_parallax_css .= "#top-header a:hover{color:" . $top_header_link_hover_color . "}\n";
$accesspress_parallax_css .= "#main-header{ background:" . $header_background . "}\n";
$accesspress_parallax_css .= "#main-header{background:" . $header_background_rgba . "}\n";
$accesspress_parallax_css .= "#main-header.no-opacity, #main-header.pos-bottom{ background:" . $header_background . "}\n";
$accesspress_parallax_css .= ".main-navigation{margin-top:" . $menu_top_margin . ";margin-right:" . $menu_right_margin . ";margin-bottom:" . $menu_bottom_margin . ";margin-left:" . $menu_left_margin . ";}";
$accesspress_parallax_css .= ".main-navigation ul li a{font-size:" . $menu_typography['size'] . ";font-family:" . $menu_typography['face'] . ";font-weight:" . $menu_typography['style'] . ";color:" . $menu_typography['color'] . ";text-transform:" . $menu_text_transform . "}\n";
$accesspress_parallax_css .= ".main-navigation > ul > li a:hover, .main-navigation > ul > li.current a, .main-navigation .current_page_item > a, .main-navigation .current-menu-item > a{color:" . $menu_hover_color . "}\n";

$accesspress_parallax_css .= ".main-navigation .sf-arrows .sf-with-ul:after{border-color:" . $menu_typography['color'] . " transparent transparent}\n";
$accesspress_parallax_css .= ".main-navigation .sf-arrows ul .sf-with-ul:after{border-left-color:" . $menu_typography['color'] . " !important}\n";

$accesspress_parallax_css .= "#site-logo{margin-top:" . $logo_top_margin . ";margin-right:" . $logo_right_margin . ";margin-bottom:" . $logo_bottom_margin . ";margin-left:" . $logo_left_margin . ";}";
$accesspress_parallax_css .= ".top-menu ul.menu ul{background:" . $top_header_bg_color . ";}\n";
$accesspress_parallax_css .= ".top-menu .sf-arrows .sf-with-ul:after{border-color:" . $top_header_typography['color'] . " transparent transparent}\n";
$accesspress_parallax_css .= ".top-menu .sf-arrows ul .sf-with-ul:after{border-left-color:" . $top_header_typography['color'] . " !important}\n";
$accesspress_parallax_css .= ".social-icons a, .social-icons a span{background:" . $social_bg_color . "}\n";
$accesspress_parallax_css .= ".social-icons a:hover{background:" . $social_hov_bg_color . "}\n";
$accesspress_parallax_css .= ".social-icons.appear-left a span:after{border-right-color:" . $social_bg_color . "}\n";
$accesspress_parallax_css .= ".social-icons.appear-right a span:after{border-left-color:" . $social_bg_color . "}\n";
$accesspress_parallax_css .= ".social-icons.appear-top a span:after{border-bottom-color:" . $social_bg_color . "}\n";
$accesspress_parallax_css .= ".social-icons.appear-bottom a span:after{border-top-color:" . $social_bg_color . "}\n";
$accesspress_parallax_css .= "body, button, input, select, textarea{ font-size:" . $body_typography['size'] . ";font-family:" . $body_typography['face'] . ";font-weight:" . $body_typography['style'] . ";color:" . $body_typography['color'] . "}\n";
$accesspress_parallax_css .= "h1{ font-size:" . $h1_typography['size'] . ";font-family:" . $h1_typography['face'] . ";font-weight:" . $h1_typography['style'] . ";color:" . $h1_typography['color'] . ";text-transform:" . $h1_text_transform . "}\n";
$accesspress_parallax_css .= "h2{ font-size:" . $h2_typography['size'] . ";font-family:" . $h2_typography_face . ";font-weight:" . $h2_typography['style'] . ";color:" . $h2_typography['color'] . ";text-transform:" . $h2_text_transform . "}\n";
$accesspress_parallax_css .= "h3{ font-size:" . $h3_typography['size'] . ";font-family:" . $h3_typography_face . ";font-weight:" . $h3_typography['style'] . ";color:" . $h3_typography['color'] . ";text-transform:" . $h3_text_transform . "}\n";
$accesspress_parallax_css .= "h4{ font-size:" . $h4_typography['size'] . ";font-family:" . $h4_typography_face . ";font-weight:" . $h4_typography['style'] . ";color:" . $h4_typography['color'] . ";text-transform:" . $h4_text_transform . "}\n";
$accesspress_parallax_css .= "h5{ font-size:" . $h5_typography['size'] . ";font-family:" . $h5_typography_face . ";font-weight:" . $h5_typography['style'] . ";color:" . $h5_typography['color'] . ";text-transform:" . $h5_text_transform . "}\n";
$accesspress_parallax_css .= "h6{ font-size:" . $h6_typography['size'] . ";font-family:" . $h6_typography_face . ";font-weight:" . $h6_typography['style'] . ";color:" . $h6_typography['color'] . ";text-transform:" . $h6_text_transform . "}\n";
$accesspress_parallax_css .= "#secondary-left .widget-title,#secondary-right .widget-title, #secondary .widget-title{ font-size:" . $widget_title_typography['size'] . ";font-family:" . $widget_title_typography_face . ";font-weight:" . $widget_title_typography['style'] . ";color:" . $widget_title_typography['color'] . ";text-transform:" . $widget_title_text_transform . "}\n";
$accesspress_parallax_css .= ".top-footer .widget-title{ font-size:" . $footer_title_typography['size'] . ";font-family:" . $footer_title_typography_face . ";font-weight:" . $footer_title_typography['style'] . ";color:" . $footer_title_typography['color'] . ";text-transform:" . $footer_title_text_transform . "}\n";
$accesspress_parallax_css .= ".top-footer .widget-title:after{border-color:" . $footer_title_typography['color'] . "}\n";
$accesspress_parallax_css .= ".top-footer{background:" . $top_footer_bg . ";color:" . $top_footer_font_color . "}\n";
$accesspress_parallax_css .= ".top-footer h4{color:" . $top_footer_title_color . "}\n";
$accesspress_parallax_css .= ".top-footer a{color:" . $top_footer_link_color . "}\n";
$accesspress_parallax_css .= ".bottom-footer{background:" . $bottom_footer_bg . ";color:" . $bottom_footer_text_color . "}\n";
$accesspress_parallax_css .= ".bottom-footer a, .footer-social-icons a{color:" . $bottom_footer_text_color . "}\n";
$accesspress_parallax_css .= ".footer-social-icons a{border-color:" . $bottom_footer_text_color . "}\n";
$accesspress_parallax_css .= ".footer-social-icons a:hover{background:" . $bottom_footer_text_color . "}\n";
$accesspress_parallax_css .= ".single #header-wrap .entry-title, .single #header-wrap .title-breadcrumb-wrap a, .single #header-wrap .title-breadcrumb-wrap{color:" . $post_title_color . "}\n";
$accesspress_parallax_css .= ".page #header-wrap .entry-title, .page #header-wrap .title-breadcrumb-wrap a, .page #header-wrap .title-breadcrumb-wrap{color:" . $page_title_color . "}\n";
$accesspress_parallax_css .= ".archive #header-wrap .entry-title, .archive #header-wrap .title-breadcrumb-wrap a, .archive #header-wrap .title-breadcrumb-wrap{color:" . $archive_title_color . "}\n";
$accesspress_parallax_css .= ".error404 #header-wrap .entry-title, .error404 #header-wrap .title-breadcrumb-wrap a, .error404 #header-wrap .title-breadcrumb-wrap{color:" . $archive_title_color . "}\n";
$accesspress_parallax_css .= "#page-overlay{background-image:url(" . get_template_directory_uri() . "/images/preloader/" . $select_preloader . ".gif)}\n";
if ($page_background_option == "image") {
    $accesspress_parallax_css .= "body{ background-image:url(" . $page_background_image['image'] . "); background-repeat:" . $page_background_image['repeat'] . "; background-position:" . $page_background_image['position'] . ";background-attachment:" . $page_background_image['attachment'] . ";background-size:" . $page_background_image['size'] . "}\n";
} elseif ($page_background_option == "color") {
    $accesspress_parallax_css .= "body{ background-color:" . $page_background_color . "}\n";
} elseif ($page_background_option == "pattern") {
    $accesspress_parallax_css .= "body{ background-image:url(" . get_template_directory_uri() . "/inc/options-framework/images/patterns/" . $page_background_pattern . ".png)}\n";
}
$accesspress_parallax_css .= "#ap-map-canvas{height:" . $map_height . " !important}\n";
if ($header_shadow == "1") {
    $accesspress_parallax_css .= "#main-header{box-shadow: 0px 4px 10px rgba(0,0,0,0.3);}\n";
}
if (of_get_option('alternative_menu') == '1') {
    $accesspress_parallax_css .= ".menu-toggle{display:block;}\n";
}
if ($enable_breadcrumb == '0') {
    $accesspress_parallax_css .= "#accesspress-breadcrumb{display:none;}";
}
if ($slider_overlay == '1') {
    $accesspress_parallax_css .= "#main-slider .overlay{background-image:url(".get_template_directory_uri()."/images/overlays/overlay4.png);}";
}

echo $accesspress_parallax_css;
$theme_color_rgb = hex2rgb($theme_color);
?>
.main-navigation ul ul li.current_page_item > a, 
.main-navigation ul ul li.current-menu-item > a, 
.main-navigation ul ul li > a:hover,
.ap-icon-text.style3 .ap-icon-text-icon i, 
.ap-icon-text.style4 .ap-icon-text-icon i,
.bttn:after,
#go-top,
.blog-list .blog-excerpt span,
.ap-bttn:before,
.ap-bttn:after,
.ap-bttn,
.member-social-group a:hover,
.ap-progress-bar .ap-progress-bar-percentage,
.googlemap-contact-wrap li .fa,
.post-listing .posted-on,
.horizontal .ap_tab_group .tab-title.active, 
.horizontal .ap_tab_group .tab-title.hover,
.vertical .ap_tab_group .tab-title.active, 
.vertical .ap_tab_group .tab-title.hover,
#portfolio-grid.style4 h4,
.mm-menu,
.menu-toggle span,
.menu-toggle span:after,
.menu-toggle span:before,
.ap_toggle .ap_toggle_title,
.bttn:hover,
.bttn:active,
.portfolio-listing .button-group li.is-checked,
.bx-wrapper .bx-pager.bx-default-pager a:hover, 
.bx-wrapper .bx-pager.bx-default-pager a.active,
.error-404,
button,
input[type="button"]:hover,
input[type="reset"]:hover,
input[type="submit"]:hover,
.bttn.ap-default-bttn.ap-bg-bttn,
.bttn.ap-default-bttn.ap-outline-bttn:hover,
.ap_tagline_box.ap-bg-box,
.ap-dropcaps.ap-square,
#collapse-nav,
.woocommerce ul.products li.product .onsale, 
.woocommerce span.onsale,
.woocommerce ul.products li.product .button, 
.woocommerce nav.woocommerce-pagination ul li span,
.woocommerce #respond input#submit.alt, 
.woocommerce a.button.alt, 
.woocommerce button.button.alt, 
.woocommerce input.button.alt,
.woocommerce #respond input#submit:hover, 
.woocommerce a.button:hover, 
.woocommerce button.button:hover, 
.woocommerce input.button:hover,
 .woocommerce #respond input#submit.alt.disabled, 
.woocommerce #respond input#submit.alt.disabled:hover, 
.woocommerce #respond input#submit.alt:disabled, 
.woocommerce #respond input#submit.alt:disabled:hover, 
.woocommerce #respond input#submit.alt:disabled[disabled], 
.woocommerce #respond input#submit.alt:disabled[disabled]:hover, 
.woocommerce a.button.alt.disabled, 
.woocommerce a.button.alt.disabled:hover, 
.woocommerce a.button.alt:disabled, 
.woocommerce a.button.alt:disabled:hover, 
.woocommerce a.button.alt:disabled[disabled], 
.woocommerce a.button.alt:disabled[disabled]:hover, 
.woocommerce button.button.alt.disabled, 
.woocommerce button.button.alt.disabled:hover, 
.woocommerce button.button.alt:disabled, 
.woocommerce button.button.alt:disabled:hover, 
.woocommerce button.button.alt:disabled[disabled], 
.woocommerce button.button.alt:disabled[disabled]:hover, 
.woocommerce input.button.alt.disabled, 
.woocommerce input.button.alt.disabled:hover, 
.woocommerce input.button.alt:disabled, 
.woocommerce input.button.alt:disabled:hover, 
.woocommerce input.button.alt:disabled[disabled], 
.woocommerce input.button.alt:disabled[disabled]:hover,
.woocommerce .widget_price_filter .ui-slider .ui-slider-handle, 
.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
.woocommerce input.button,
nav.woocommerce-MyAccount-navigation ul li a,
.floating-bar ul li.current a, .floating-bar ul li:hover a,
.floating-bar ul li .ap-tooltip, .floating-bar ul li .ap-tooltip:before, .floating-bar ul li .ap-tooltip:after,
.layout2.featured_table .ap-price-box, .layout2 .ap-pricing-readmore a.bttn,
.blog_template_new .new-blog-listing .single-blog-wrapper .blog-content-wrapper .blog-date-wrap span.post-month,
.blog_template_new .new-blog-listing .single-blog-wrapper .blog-content-wrapper span.read-more a,
.googlemap_template_new .ap-contact-wrap .ap-ctn-form input[type="submit"],
.ap-pricing-table.layout3.featured_table .ap-price-box .ap-wrap, .ap-pricing-table.layout3.featured_table,
.testimonial_template_new .testimonial-listing ul li.testimonial-content h3,
.testimonial_template_new .testimonial-stage .owl-controls .owl-dots .owl-dot.active, .testimonial_template_new .testimonial-stage .owl-controls .owl-dots .owl-dot:hover{
background-color:<?php echo $theme_color ?>;
}

a,
.bttn,
.member-social-group a,
.ap-toggle-title .pointer span i,
.ap_toggle .ap_toggle_title:after,
.sidebar .widget-social-icons li a,
.team-tab .bx-wrapper .bx-controls-direction a,
#portfolio-grid.style2 .portfolio-link:hover,
.style1 .fancybox-gallery:hover,
.footer-social-icons a:hover,
.sidebar .menu li a:hover,
input[type="button"],
input[type="reset"],
input[type="submit"],
.sidebar ul li a:hover,
.sidebar ul li.current-menu-item > a,
.woocommerce .woocommerce-info:before,
.bttn.ap-default-bttn.ap-outline-bttn,
.layout2 .ap-pricing-readmore a.bttn:hover,
.blog_template_new .new-blog-listing .single-blog-wrapper .blog-content-wrapper span.read-more a:hover,
.woocommerce .star-rating:before, .woocommerce .star-rating span:before,
.woocommerce .star-rating:before, .woocommerce .star-rating span:before,
.mm-menu .mm-list > li:hover > a,
.mm-menu .mm-list > li:hover > a.mm-subopen:before,
.mm-menu .left-social-icons.mm-panel a:hover{
color:<?php echo $theme_color ?>;
}

.team_template_new .team-tab #team-arrow {
   fill: <?php echo $theme_color ?>;
}

.bttn,
.team-image:hover, .team-image.active,
.blog-list .blog-excerpt,
.ap-toggle-title,
.ap-toggle-title .pointer,
.ap_toggle,
.main-navigation ul ul li.current_page_item > a, 
.main-navigation ul ul li.current-menu-item > a, 
.main-navigation ul ul li > a:hover,
.menu-toggle,
.sidebar .widget-title:after,
button,
input[type="button"],
input[type="reset"],
input[type="submit"],
.bttn.ap-default-bttn.ap-outline-bttn,
.ap_tagline_box.ap-top-border-box,
.ap_tagline_box.ap-left-border-box,
.ap_tagline_box.ap-all-border-box,
input[type="text"]:focus, 
input[type="email"]:focus, 
input[type="url"]:focus, 
input[type="password"]:focus, 
input[type="search"]:focus, 
input[type="number"]:focus, 
input[type="tel"]:focus, 
input[type="range"]:focus, 
input[type="date"]:focus, 
input[type="month"]:focus, 
input[type="week"]:focus, 
input[type="time"]:focus, 
input[type="datetime"]:focus, 
input[type="datetime-local"]:focus, 
input[type="color"]:focus, 
textarea:focus,
.woocommerce ul.products li.product h3,
.woocommerce .woocommerce-info,
.portfolio_masonry_template .portfolio-listing ul li.is-checked, 
.portfolio_masonry_template .portfolio-listing ul li:hover,
.blog_template_new .new-blog-listing .single-blog-wrapper .blog-content-wrapper span.read-more a,
.googlemap_template_new .ap-contact-wrap .ap-ctn-form input[type="submit"],
.action_template .call-to-action a.ap-outline-bttn:hover,
.ap-pricing-table.layout3.featured_table .ap-price-box{
border-color:<?php echo $theme_color ?>;
}

.mm-menu .mm-list > li:after,
.mm-menu .mm-list > li > a.mm-subopen:before,
.main-navigation > ul > li{
border-color:<?php echo $theme_color_hov ?>;
}

.bttn.ap-default-bttn.ap-bg-bttn:hover,
.woocommerce ul.products li.product .button:hover,
.woocommerce #respond input#submit.alt:hover, 
.woocommerce a.button.alt:hover, 
.woocommerce button.button.alt:hover, 
.woocommerce input.button.alt:hover,
.woocommerce button.button:disabled[disabled]:hover, .woocommerce input.button.disabled:hover, 
.woocommerce input.button:disabled:hover, .woocommerce input.button:disabled[disabled]:hover,
nav.woocommerce-MyAccount-navigation ul li:hover a,
nav.woocommerce-MyAccount-navigation ul li.is-active a,
.ap-pricing-table.layout3.featured_table a.bttn:before,
.ap-pricing-table.layout3.featured_table a.bttn:hover{
background:<?php echo $theme_color_hov ?>;
}
.ap-pricing-table.layout3.featured_table a.bttn,
.ap-pricing-table.layout3.featured_table a.bttn:hover:before {
    background:<?php echo $theme_color_hov_new ?>;
}
.ap-icon-text.style3 .ap-icon-text-icon i:after, 
.ap-icon-text.style4 .ap-icon-text-icon i:after{
box-shadow: 0 0 0 1px <?php echo $theme_color ?>;
}

#portfolio-grid.style3 .portfolio-overlay,
#portfolio-grid.style2 .portfolio-inner,
#portfolio-grid.style1 .portfolio-overlay,
.style1.ap-team .ap-member-image:after,
.portfolio_masonry_template .mid-content div.portfolio-list .portfolio-inner a.portfolio-link:hover, 
.portfolio_masonry_template .mid-content div.portfolio-list .portfolio-inner a.fancybox-gallery:hover{
background:<?php echo "rgba(" . "$theme_color_rgb[0]" . "," . "$theme_color_rgb[1]" . "," . "$theme_color_rgb[2]" . ",0.8)"; ?>    
}
.ap-progress-bar{
background:<?php echo "rgba(" . "$theme_color_rgb[0]" . "," . "$theme_color_rgb[1]" . "," . "$theme_color_rgb[2]" . ",0.3)"; ?>    
}
.post-listing .posted-on:before{
border-color:transparent transparent <?php echo $theme_color_hov . " " . $theme_color_hov; ?>;
}

@media screen and (max-width:768px){
    .main-navigation ul ul{
        background:<?php echo $theme_color ?>; 
    }
    .main-navigation ul ul a,
    .main-navigation ul ul li > a:hover{
        border-color:<?php echo $theme_color_hov ?>;
    }
    
    <?php if ($enable_breadcrumb_mobile == '0') { ?>
    #accesspress-breadcrumb{display:none;};
    <?php } ?>
}

@media screen and (max-width:1000px){
    .main-navigation > ul{
        background-color:<?php echo $theme_color ?>;
    }
}

<?php

/* ===================================
  CUSTOM CSS
  =================================== */

if (!empty($custom_css)) {
    echo $custom_css;
}