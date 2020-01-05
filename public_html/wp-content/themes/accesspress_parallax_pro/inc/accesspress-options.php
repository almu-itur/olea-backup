<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {
	$themename = 'accesspress_parallax_pro';
	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'accesspress_parallax'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	$imagepath = get_template_directory_uri().'/inc/options-framework/images/patterns/80X80/';
	$preloaderpath = get_template_directory_uri().'/images/preloader/';

	// slider transition
	$transitions = array(
		'fade' => __('Fade', 'accesspress_parallax'),
		'horizontal' => __('Slide Horizontal', 'accesspress_parallax'),
		'vertical' => __('Slide Vertical', 'accesspress_parallax')
	);

	// header position
	$header_position = array(
		'pos-top' => __('Top of Slider', 'accesspress_parallax'),
		'pos-top-overlap' => __('Over the Slider', 'accesspress_parallax'),
		'pos-bottom' => __('Bottom of Slider', 'accesspress_parallax')
	);

	// text transforms
	$text_transform = array(
		'uppercase' => __('Uppercase', 'accesspress_parallax'),
		'lowercase' => __('Lowercase', 'accesspress_parallax'),
		'capitalize' => __('Captalize', 'accesspress_parallax'),
		'none' => __('Normal', 'accesspress_parallax')
	);

	// overlay backgrounds
	$overlay = array(
		'overlay1' => __('Overlay 1', 'accesspress_parallax'),
		'overlay2' => __('Overlay 2', 'accesspress_parallax'),
		'overlay3' => __('Overlay 3', 'accesspress_parallax'),
		'overlay4'  => __( 'Overlay 4', 'accesspress_parallax')
	);

	// Website Background Options
	$background_options = array(
		'none' => __('-- None --', 'accesspress_parallax'),
		'image' => __('Image', 'accesspress_parallax'),
		'color' => __('Color', 'accesspress_parallax'),
		'pattern' => __('Pattern', 'accesspress_parallax'),
	);

	//Scroll Effect
	$scrolleffect = array(
		'linear' => __('linear', 'accesspress_parallax'),
		'swing' => __('swing', 'accesspress_parallax'),
		'easeOutQuad' => __('easeOutQuad', 'accesspress_parallax'),
		'easeInOutQuad'  => __('easeInOutQuad', 'accesspress_parallax'),
		'easeInCubic'  => __('easeInCubic', 'accesspress_parallax'),
		'easeOutCubic' => __('easeOutCubic', 'accesspress_parallax'),
		'easeInOutCubic' => __('easeInOutCubic', 'accesspress_parallax'),
		'easeInQuart' => __('easeInQuart', 'accesspress_parallax'),
		'easeOutQuart'  => __('easeOutQuart', 'accesspress_parallax'),
		'easeInOutQuart'  => __('easeInOutQuart', 'accesspress_parallax'),
		'easeInQuint' => __('easeInQuint', 'accesspress_parallax'),
		'easeOutQuint' => __('easeOutQuint', 'accesspress_parallax'),
		'easeInOutQuint' => __('easeInOutQuint', 'accesspress_parallax'),
		'easeInExpo'  => __('easeInExpo', 'accesspress_parallax'),
		'easeOutExpo'  => __('easeOutExpo', 'accesspress_parallax'),
		'easeInOutExpo' => __('easeInOutExpo', 'accesspress_parallax'),
		'easeInSine' => __('easeInSine', 'accesspress_parallax'),
		'easeOutSine' => __('easeOutSine', 'accesspress_parallax'),
		'easeInOutSine'  => __('easeInOutSine', 'accesspress_parallax'),
		'easeInCirc'  => __('easeInCirc', 'accesspress_parallax'),
		'easeOutCirc'  => __('easeOutCirc', 'accesspress_parallax'),
		'easeInOutCirc'  => __('easeInOutCirc', 'accesspress_parallax'),
		'easeInElastic'  => __('easeInElastic', 'accesspress_parallax'),
		'easeOutElastic'  => __('easeOutElastic', 'accesspress_parallax'),
		'easeInOutElastic'  => __('easeInOutElastic', 'accesspress_parallax'),
		'easeInBack'  => __('easeInBack', 'accesspress_parallax'),
		'easeOutBack'  => __('easeOutBack', 'accesspress_parallax'),
		'easeInOutBack'  => __('easeInOutBack', 'accesspress_parallax'),
		'easeInBounce'  => __('easeInBounce', 'accesspress_parallax'),
		'easeOutBounce'  => __('easeOutBounce', 'accesspress_parallax'),
		'easeInOutBounce'  => __('easeInOutBounce', 'accesspress_parallax'),
	);

	//Background Pattern
	$background_pattern = array(
		'pattern1' => $imagepath . 'pattern1.png', 
		'pattern2' => $imagepath . 'pattern2.png', 
		'pattern3' => $imagepath . 'pattern3.png', 
		'pattern4' => $imagepath . 'pattern4.png', 
		'pattern5' => $imagepath . 'pattern5.png', 
		'pattern6' => $imagepath . 'pattern6.png', 
		'pattern7' => $imagepath . 'pattern7.png', 
		'pattern8' => $imagepath . 'pattern8.png', 
		'pattern9' => $imagepath . 'pattern9.png', 
		'pattern10' => $imagepath . 'pattern10.png', 
		'pattern11' => $imagepath . 'pattern11.png', 
		'pattern12' => $imagepath . 'pattern12.png', 
		'pattern13' => $imagepath . 'pattern13.png', 
		'pattern14' => $imagepath . 'pattern14.png', 
		'pattern15' => $imagepath . 'pattern15.png', 
		'pattern16' => $imagepath . 'pattern16.png', 
		'pattern17' => $imagepath . 'pattern17.png', 
		'pattern18' => $imagepath . 'pattern18.png'
		);

	//Preloader Options
	$preloaders = array(
		'loader1' => $preloaderpath . 'loader1.gif', 
		'loader2' => $preloaderpath . 'loader2.gif', 
		'loader3' => $preloaderpath . 'loader3.gif', 
		'loader4' => $preloaderpath . 'loader4.gif', 
		'loader5' => $preloaderpath . 'loader5.gif', 
		'loader6' => $preloaderpath . 'loader6.gif', 
		'loader7' => $preloaderpath . 'loader7.gif', 
		'loader8' => $preloaderpath . 'loader8.gif',
		'loader9' => $preloaderpath . 'loader9.gif',
		'loader10' => $preloaderpath . 'loader10.gif'
		);
	
	// Social Icon Position
	$social_icon_position = array(
		'top' => __('Top', 'accesspress_parallax'),
		'bottom' => __('Bottom', 'accesspress_parallax'),
		'left' => __('Left', 'accesspress_parallax'),
		'right'  => __( 'Right', 'accesspress_parallax')
	);

	// sections
	$section_template = array(
		'default_template' => __('Default Section', 'accesspress_parallax'),
		'service_template' => __('Service Section', 'accesspress_parallax'),
		'team_template' => __('Team Section', 'accesspress_parallax'),
		'team_template_new' => __('Team Section ( New Layout )', 'accesspress_parallax'),
		'portfolio_template' => __('Portfolio Section', 'accesspress_parallax'),
		'portfolio_masonry_template' => __('Portfolio Section (Masonry)', 'accesspress_parallax'),
		'features_template' => __( 'Features Section', 'accesspress_parallax' ),
		'testimonial_template' => __('Testimonial Section', 'accesspress_parallax'),
		'testimonial_template_new' => __('Testimonial Section (New Layout)', 'accesspress_parallax'),
		'blog_template' => __('Blog Section', 'accesspress_parallax'),
		'blog_template_new' => __('Blog Section ( New Layout )', 'accesspress_parallax'),
		'action_template' => __('Call to Action Section', 'accesspress_parallax'),
		'googlemap_template' => __('Google Map Section', 'accesspress_parallax'),
		'googlemap_template_new' => __('Google Map Section (New Layout)', 'accesspress_parallax'),
		'logoslider_template' => __('Logo Slider Section', 'accesspress_parallax'),
		'blank_template' => __('Blank Section', 'accesspress_parallax'),
	);

	// check
	$check = array(
		'yes' => __('Yes', 'accesspress_parallax'),
		'no' => __('No', 'accesspress_parallax')
	);

	// Slider Type
	$slider_type = array(
		'cat_slider' => __('Category Post Slider', 'accesspress_parallax'),
		'rev_slider' => __('Revolution Slider', 'accesspress_parallax')
	);

	// Portfolio Layout
	$portfolio_layout = array(
		'grid' => __( 'Grid', 'accesspress_parallax' ),
		'list' => __( 'List', 'accesspress_parallax' )
	);

	// Portfolio Layout for homepage
	$portfolio_layout_home = array(
		'grid' => __( 'Grid', 'accesspress_parallax' ),
		'masonry' => __( 'Masonry', 'accesspress_parallax' )
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll',
		'size' => 'cover',
		 );

	// Parallax Defaults
	$parallax_defaults = NULL;
	$theme = wp_get_theme();
	$about_content = '<div class="about-accesspress">
          <img src="'.esc_url($theme->get_screenshot()).'" /><br/>'
          .$theme->get('Description').
          '<br/><br/>
          <a class="button" target="_blank" href="'.esc_url('http://doc.accesspressthemes.com/accesspress-parallax-pro-documentation/').'">'. __('View Documentaion','accesspress_parallax').'</a>
          <a class="button" target="_blank" href="'.esc_url('http://accesspressthemes.com/theme-demos/?theme=accesspress-parallax-pro/').'">'.__('View Demo','accesspress_parallax').'</a>
        </div>';
    $for_support = __("Email:","accesspress_parallax"). ' <a href="mailto:support@accesspressthemes.com">support@accesspressthemes.com</a><br/>'
        . __("Forum:","accesspress_parallax").' <a target="_blank" href="'. esc_url("https://accesspressthemes.com/support").'">accesspressthemes.com/support</a><br/>'
		. __("Online Chat:","accesspress_parallax").' <a target="_blank" href="'. esc_url("https://accesspressthemes.com").'">'.__("Visit Website to chat","accesspress_parallax").'</a><br/>';
	$for_customization = __('We offer WordPress Themes/Plugins development, customization, design integration, WordPress setup, fixes etc.','accesspress_parallax').'<br/>'
        .__('Rate: $35/hr','accesspress_parallax').'<br/>'
        .__('Email:','accesspress_parallax').' <a href="mailto:'.esc_url('sales@accesspressthemes.com').'">sales@accesspressthemes.com</a>';
    $get_social = '<p>'.__('Get connected with us on Social Media.','accesspress_parallax').'</p>
        <a target="_blank" class="facebook" href="https://www.facebook.com/pages/AccessPress-Themes/1396595907277967"><img src="'.get_template_directory_uri().'/inc/options-framework/images/facebook.png"></a>
        <a target="_blank" class="twitter" href="https://twitter.com/apthemes"><img src="'. get_template_directory_uri().'/inc/options-framework/images/twitter.png"></a>
        <a target="_blank" class="youtube" href="https://www.youtube.com/user/accesspressthemes"><img src="'. get_template_directory_uri().'/inc/options-framework/images/youtube.png"></a>';
    $about_accesspress_themes = 'AccessPress Themes is an online WordPress themes store, that provides beautiful and useful themes. All of our themes are crafted with our years of experience. Our theme don’t lack the basics and don’t have a lot of non-sense features which you might never use. AccessPress Themes has beautiful and elegant, fully responsive, multipurpose themes to meet your need for free and premium basis. Our themes have bunch of easily customizable options and features, someone with no programming knowledge can use our easy theme options panel and configure/setup the theme as needed.';        
    $from_accesspress_thems = '<div class="accesspressthemes-products"><div class="ap-themes">
        <a target="_blank" href="https://accesspressthemes.com/wordpress-themes/">
        <div class="ap-themes-img">
        <img src="'.get_template_directory_uri().'/inc/options-framework/images/wordpress-themes.png">
        <span>'.__('View all Themes','accesspress_parallax').' <i class="fa fa-external-link"></i></span>
        </div>'
        .__('WordPress Themes','accesspress_parallax'). 
        '</a>
        </div>';

    $from_accesspress_thems .= '<div class="ap-plugins">
        <a target="_blank" href="https://accesspressthemes.com/plugins/">
        <div class="ap-themes-img">
        <img src="'.get_template_directory_uri().'/inc/options-framework/images/wordpress-plugins.png">
        <span>'. __('View all Plugins','accesspress_parallax').' <i class="fa fa-external-link"></i></span>
        </div>'
        .__('WordPress Plugins','accesspress_parallax').  
        '</a>
        </div>';

    $from_accesspress_thems .= '<div class="ap-customization">
        <a target="_blank" href="https://accesspressthemes.com/request-customization/">
        <div class="ap-themes-img">
        <img src="'. get_template_directory_uri().'/inc/options-framework/images/wordpress-customization.png">
        <span>'. __('Request Customization','accesspress_parallax').' <i class="fa fa-external-link"></i></span>
        </div>'
        .__('WordPress Customization','accesspress_parallax').  
        '</a>
        </div></div>';

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	$options_categories[''] = __('Select a Category','accesspress_parallax');
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->slug] = $category->cat_name;
	}
    
    // Pull all the categories into an array
	$options_categories_multicheck = array();
	$options_categories_multicheck_obj = get_categories();
	foreach ($options_categories_multicheck_obj as $category) {
		$options_categories_multicheck[$category->slug] = $category->cat_name;
	}

	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = __('Select a Page','accesspress_parallax');
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/inc/options-framework/images/';

	/**
	 * Bottom Footer Layout
	 *
	 * @since 4.0.0
	 */
	$bottom_footer_layout = array(
				'layout1' => __( 'Layout 1', 'accesspress_parallax' ),
				'layout2' => __( 'Layout 2', 'accesspress_parallax' )
		);

	/**
	 * Portfolios categories
	 * @since 4.0.0
	 */
	$portfolio_categories = array();
	$portfolio_categories_obj = get_terms( 'portfolio-category' );
	$portfolio_categories[''] = __( 'All','accesspress_parallax' );
	foreach ($portfolio_categories_obj as $category) {
		$portfolio_categories[$category->slug] = $category->name;
	}

	/**
	 * Post content type at archive and blog page
	 * @since 4.0.0
	 */
	$post_content_type = array(
		'excerpt_content' => __('Excerpt Content', 'accesspress_parallax'),
		'full_content' => __('Full Content', 'accesspress_parallax')
	);
	

	$options = array();

/* --------------------------GENERAL SETTINGS-------------------------- */
	$options[] = array(
		'name' => __('General Settings', 'accesspress_parallax'),
		'icon' => 'fa fa-cogs',
		'type' => 'heading');

	$options[] = array(
		'name' => __('Import Demo Content','accesspress_parallax'),
		'type' => 'button',
		'button_name' => __('Import Demo','accesspress_parallax'),
		'id' => 'ap_import',
		'desc' => __('This button should only be pressed on a <strong>clean WordPress</strong> installation. This will overwrite all existing option values, please proceed with caution!','accesspress_parallax'),
		'html' => '<div class="import_message"></div>'
		);

	$options[] = array(
		'name' => __('Parallax Home Page', 'accesspress_parallax'),
		'id' => 'enable_parallax',
		'on' =>  __(__('Enable', 'accesspress_parallax'), 'accesspress_parallax'),
		'off' => __('Disable', 'accesspress_parallax'),
		'std' => '1',
		'desc' => __('If disabled, will show Blog roll or Static home page','accesspress_parallax'),
		'type' => 'switch');

	$options[] = array( 
		"name" => __('Skin Color', 'accesspress_parallax'),
		"desc" => __('Select from predefined colors', 'accesspress_parallax'),
		"id" => "skin_color",
		"std" => "#E5623B",
		"type" => "radio",
		"options" => array(
			'#E5623B' => 'color1', 
			'#627F9A' => 'color2',
			'#4DC7EC' => 'color3',
			'#232B2D' => 'color4',
			'#1ABC9C' => 'color5', 
			'#F25454' => 'color6',
			'#E5C41A' => 'color7',
			'#3E5372' => 'color8',
			)
		);

	$options[] = array( 
		"name" => __('Custom Skin Color', 'accesspress_parallax'),
		"desc" => __('Select from unlimited colors', 'accesspress_parallax'),
		"id" => "theme_color",
		"std" => "#E5623B",
		"type" => "color" );

	$options[] = array( 
		"name" => __('Website Layout', 'accesspress_parallax'),
		"id" => "website_layout",
		"std" => "wide",
		"type" => "select",
		"options" => array(
			'wide' => __('Full Width', 'accesspress_parallax'),
			'boxed' => __('Boxed', 'accesspress_parallax'),
		));

	$options[] = array( 
		"name" => __('Background', 'accesspress_parallax'),
		"desc" => __('Select between Image/Color/Pattern','accesspress_parallax'),
		"id" => "page_background_option",
		"std" => "none",
		"type" => "select",
		"options" => $background_options );

	$options[] = array( 
		"name" => __('Background Image', 'accesspress_parallax'),
		"id" => "page_background_image",
		"class" =>"sub-option",
		"type" => "background",
		'std' => array(
			'image' => '',
			'repeat' => 'repeat',
			'position' => 'top center',
			'attachment'=>'scroll',
			'size' => 'auto' )
		);

	$options[] = array( 
		"name" => __('Background Color', 'accesspress_parallax'),
		"desc" => __('Color for the Background', 'accesspress_parallax'),
		"id" => "page_background_color",
		"std" => "#FFFFFF",
		"type" => "color" );

	$options[] = array(
		'name' => __('Background Patterns', 'accesspress_parallax'),
		'id' => "page_background_pattern",
		'std' => "pattern1",
		'type' => "images",
		'options' => $background_pattern
	);

	$options[] = array(
		'name' => __('Animate Elements on Scroll', 'accesspress_parallax'),
		'id' => 'enable_animation',
		'on' => __('Enable', 'accesspress_parallax'),
		'off' => __('Disable', 'accesspress_parallax'),
		'std' => '1',
		'desc' => __('Page Elements will appear with some animation on scrolling the website','accesspress_parallax'),
		'type' => 'switch');

	$options[] = array(
		'name' => __('Enable Pre Loader', 'accesspress_parallax'),
		'id' => 'enable_preloader',
		'on' => __('Enable', 'accesspress_parallax'),
		'off' => __('Disable', 'accesspress_parallax'),
		'std' => '1',
		'type' => 'switch');

	$options[] = array(
		'name' => __('Select Preloader', 'accesspress_parallax'),
		'id' => "select_preloader",
		'std' => "loader1",
		'type' => "images",
		'options' => $preloaders
	);

	$options[] = array(
		'name' => __('Upload Fav Icon', 'accesspress_parallax'),
		'id' => 'fav_icon',
		'class' => 'sub-option',
		'std' => get_template_directory_uri().'/images/favicon.png',
		'type' => 'upload');
    
    $options[] = array(
    	'name' => __('AddThis Publisher ID', 'accesspress_parallax'),
    	'id' => 'share_publisher_id',
    	'std' => 'ra-536530f652c04fc6',
        'placeholder' => 'ra-536530f652c04fc6',
        'desc' => sprintf(__('Go to <a href="%s">Addthis</a> website, register and enter the publisher id to keep the track of your website. Leave empty if you want to remove this tracking script', 'accesspress_parallax'),esc_url("https://www.addthis.com")),
    	'type' => 'text');

	$options[] = array( 
		"name" => "",
		"id" => "tab_id",
		"std" => "#options-group-1",
		"type" => "hidden" );
/* --------------------------HEADER SETTINGS-------------------------- */
	$options[] = array(
		'name' => __('Header', 'accesspress_parallax'),
		'icon' => 'fa fa-header',
		'type' => 'heading');

	$options[] = array(
		'id' => 'top_header_sep',
		'desc' => __('Top Header', 'accesspress_parallax'),
		'class' => 'seperator',
		'type' => 'info',
		);

	$options[] = array(
		'name' => __('Show Top Menu', 'accesspress_parallax'),
		'id' => 'show_top_menu',
		'on' => __('Yes', 'accesspress_parallax'),
		'off' => __('No', 'accesspress_parallax'),
		'std' => '1',
		'type' => 'switch');

	$options[] = array(
		'name' => __('Top Header Height', 'accesspress_parallax'),
		'id' => 'top_header_height',
		'std' => '38',
		'addontext' => 'px',
		'class' => 'mini',
		'type' => 'num');

	$options[] = array( 
		"name" => __('Top Header Background Color', 'accesspress_parallax'),
		"desc" => __('Color of the Header Background', 'accesspress_parallax'),
		"id" => "top_header_bg_color",
		"std" => "#383838",
		"type" => "color" );

	$options[] = array(
		'name' => __('Top Header Font Family', 'accesspress_parallax'),
		'id' => 'topheader_typography',
		'std' => array(
			'size' => '13px',
			'face' => 'PT Sans',
			'style' => '400',
			'color' => '#999999',
			),
		'type' => 'typography');

	$options[] = array( 
		"name" => __('Top Header Hover Color', 'accesspress_parallax'),
		"desc" => __('Color of the Header Link on Hover', 'accesspress_parallax'),
		"id" => "top_header_link_hover_color",
		"std" => "#EEEEEE",
		"type" => "color" 
		);

	$options[] = array(
		'name' => __('Header Text', 'accesspress_parallax'),
		'id' => 'header_text',
		'type' => 'textarea',
		'rows' => '2',
		"std" => "info@email.com",
		'desc' => __('Header Text - Html Allowed', 'accesspress_parallax')
		);

	$options[] = array(
		'id' => 'main_header_sep',
		'desc' => __('Main Header', 'accesspress_parallax'),
		'class' => 'seperator',
		'type' => 'info',
		);

	$options[] = array(
		'name' => __('Select Header Layout', 'accesspress_parallax'),
		'id' => "header_layout",
		'std' => "logo-side",
		'type' => "images",
		'options' => array(
		'logo-side' => $imagepath . 'logo-side.jpg',
		'logo-top' => $imagepath . 'logo-top.jpg')
	);

	$options[] = array(
		'name' => __('Header Position', 'accesspress_parallax'),
		'id' => 'header_position',
		'std' => "pos-top",
		'type' => 'select',
		'options' => $header_position);

	$options[] = array(
		'name' => __('Sticky Header', 'accesspress_parallax'),
		'id' => 'sticky_header',
		'on' => __('Enable', 'accesspress_parallax'),
		'off' => __('Disable', 'accesspress_parallax'),
		'std' => '1',
		'type' => 'switch');
  
  	$options[] = array(
		'name' => __('Header Shadow', 'accesspress_parallax'),
		'id' => 'header_shadow',
        'desc' => __('Shadow below the header', 'accesspress_parallax'),
		'on' => __('Enable', 'accesspress_parallax'),
		'off' => __('Disable', 'accesspress_parallax'),
		'std' => '1',
		'type' => 'switch');

	$options[] = array( 
		"name" => __('Header Background Color', 'accesspress_parallax'),
		"desc" => __('Color of the Header Background', 'accesspress_parallax'),
		"id" => "header_bg_color",
		"std" => "#FFFFFF",
		"type" => "color" );
                
        $options[] = array(
		'name' => __('Header Background Opacity', 'accesspress_parallax'),
		'id' => 'main_header_bg_opacity',
		'std' => '0.6',
		"min" 	=> "0",
		"step"	=> "0.05",
		"max" 	=> "1.01",
		"type" 	=> "sliderui" );

/* --------------------------LOGO SETTINGS-------------------------- */
	$options[] = array(
		'name' => __('Logo Settings', 'accesspress_parallax'),
		'icon' => 'fa fa-bookmark',
		'type' => 'heading');

	$options[] = array(
		'name' => __('Upload Logo', 'accesspress_parallax'),
		'id' => 'logo',
		'std' => get_template_directory_uri().'/images/logo.png',
		'class' => 'sub-option',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Logo Top Margin', 'accesspress_parallax'),
		'id' => 'logo_top_margin',
		'std' => '0',
		'class' => 'mini',
		'addontext' => 'px',
		'type' => 'num');

	$options[] = array(
		'name' => __('Logo Left Margin', 'accesspress_parallax'),
		'id' => 'logo_left_margin',
		'std' => '0',
		'class' => 'mini',
		'addontext' => 'px',
		'type' => 'num');

	$options[] = array(
		'name' => __('Logo Right Margin', 'accesspress_parallax'),
		'id' => 'logo_right_margin',
		'std' => '0',
		'class' => 'mini',
		'addontext' => 'px',
		'type' => 'num');

	$options[] = array(
		'name' => __('Logo Bottom Margin', 'accesspress_parallax'),
		'id' => 'logo_bottom_margin',
		'std' => '0',
		'class' => 'mini',
		'addontext' => 'px',
		'type' => 'num');

	$options[] = array(
		'name' => __('Apple iPhone Icon Upload', 'accesspress_parallax'),
		'id' => 'favicon_iphone',
		'desc' => __('Favicon for Apple iPhone (57px x 57px)', 'accesspress_parallax'),
		'class' => 'sub-option',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Apple iPhone Retina Icon Upload', 'accesspress_parallax'),
		'id' => 'favicon_iphone_retina',
		'desc' => __('Favicon for Apple iPhone Retina Version (114px x 114px)', 'accesspress_parallax'),
		'class' => 'sub-option',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Apple iPad Icon Upload', 'accesspress_parallax'),
		'id' => 'favicon_ipad',
		'desc' => __('Favicon for Apple iPad (72px x 72px)', 'accesspress_parallax'),
		'class' => 'sub-option',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Apple iPad Retina Icon Upload', 'accesspress_parallax'),
		'id' => 'favicon_ipad_retina',
		'desc' => __('Favicon for Apple iPad Retina Version (144px x 144px)', 'accesspress_parallax'),
		'class' => 'sub-option',
		'type' => 'upload');

/* --------------------------MENU SETTINGS-------------------------- */
	$options[] = array(
		'name' => __('Menu Settings', 'accesspress_parallax'),
		'icon' => 'fa fa-bars',
		'type' => 'heading');
        
    $options[] = array(
		'name' => __('Activate Left Menu', 'accesspress_parallax'),
		'id' => 'alternative_menu',
		'on' => __('Yes', 'accesspress_parallax'),
		'off' => __('No', 'accesspress_parallax'),
		'std' => '0',
        'desc' => __('Note: Works with full width website layout only', 'accesspress_parallax'),
		'type' => 'switch');

    $options[] = array(
		'name' => __('Single Page Menu', 'accesspress_parallax'),
		'id' => 'parallax_menu', 
		'on' => __('Enable', 'accesspress_parallax'),
		'off' => __('Disable', 'accesspress_parallax'),
		'std' => '1',
		'desc' => __('Page scrolls between sections in home page when clicked on Menu. Will show primary menu if disabled. <br />Works only if <strong>Parallax Home Page</strong> is enabled in General Settings', 'accesspress_parallax'),
		'type' => 'switch');

    $options[] = array(
		'name' => __('Side Navigator', 'accesspress_parallax'),
		'id' => 'parallax_menu_side_navigator', 
		'on' => __('Enable', 'accesspress_parallax'),
		'off' => __('Disable', 'accesspress_parallax'),
		'std' => '0',
		'desc' => __('Floating menu as side navigator', 'accesspress_parallax'),
		'type' => 'switch');

    $options[] = array(
		'name' => __('Home Text', 'accesspress_parallax'),
		'desc' => __('Leave blank if you do not want to show' , 'accesspress_parallax'),
		'id' => 'home_text',
		'std' => __('Home' , 'accesspress_parallax'),
		'type' => 'text');

	$options[] = array(
		'name' => __('Page Scroll Effect', 'accesspress_parallax'),
		'desc' => sprintf(__('Check <a target="_blank" href="%s">http://easings.net</a> for detail', 'accesspress_parallax'),esc_url("http://easings.net")),
		'id' => 'scroll_effect',
		'std' => "swing",
		'type' => 'select',
		'options' => $scrolleffect);

	$options[] = array(
		'name' => __('Page Scroll Speed', 'accesspress_parallax'),
		'id' => 'scroll_speed',
		'std' => '3000',
		"min" 	=> "2000",
		"step"	=> "100",
		"max" 	=> "6000",
		"type" 	=> "sliderui" );

	$options[] = array(
		'name' => __('Font Family', 'accesspress_parallax'),
		'id' => 'menu_typography',
		'std' => array(
			'size' => '14px',
			'face' => 'PT Sans',
			'style' => '400',
			'color' => '#333333',
			),
		'type' => 'typography');

	$options[] = array( 
		"name" => __('Menu Hover Color', 'accesspress_parallax'),
		"id" => "menu_hover_color",
		"std" => "#000000",
		"type" => "color" );

	$options[] = array(
		'name' => __('Text Transform', 'accesspress_parallax'),
		'id' => 'menu_text_transform',
		'type' => 'select',
		'std' => 'uppercase',
		'options' => $text_transform);

	$options[] = array(
		'name' => __('Menu Top Margin', 'accesspress_parallax'),
		'id' => 'menu_top_margin',
		'std' => '0',
		'class' => 'mini',
		'addontext' => 'px',
		'type' => 'num');

	$options[] = array(
		'name' => __('Menu Left Margin', 'accesspress_parallax'),
		'id' => 'menu_left_margin',
		'std' => '0',
		'class' => 'mini',
		'addontext' => 'px',
		'type' => 'num');

	$options[] = array(
		'name' => __('Menu Right Margin', 'accesspress_parallax'),
		'id' => 'menu_right_margin',
		'std' => '0',
		'class' => 'mini',
		'addontext' => 'px',
		'type' => 'num');

	$options[] = array(
		'name' => __('Menu Bottom Margin', 'accesspress_parallax'),
		'id' => 'menu_bottom_margin',
		'std' => '0',
		'class' => 'mini',
		'addontext' => 'px',
		'type' => 'num');

/* --------------------------SLIDER SETTINGS-------------------------- */
	$options[] = array(
		'name' => __('Slider Settings', 'accesspress_parallax'),
		'icon' => 'fa fa-sliders',
		'type' => 'heading');

	$options[] = array(
		'name' => __('Show Slider', 'accesspress_parallax'),
		'id' => 'show_slider',
		'on' => __('Yes', 'accesspress_parallax'),
		'off' => __('No', 'accesspress_parallax'),
		'std' => '1',
		'type' => 'switch');

	$options[] = array(
		'name' => __('Slider Type', 'accesspress_parallax'),
		'id' => 'slider_type',
		'std' => 'cat_slider',
		'type' => 'radio',
		'options' => $slider_type);

	$options[] = array(
		'name' => __('Select a Category', 'accesspress_parallax'),
		'id' => 'slider_cat',
		'type' => 'select',
        'std' => '',
        'desc' => __('Select the Category if Slider Type is Category Post Slider', 'accesspress_parallax'),
		'options' => $options_categories);

	$options[] = array(
		'name' => __('Revolution Slider ShortCode', 'accesspress_parallax'),
		'desc' => __('Enter the ShortCode of the slider if Slider Type is Revolution Slider', 'accesspress_parallax'),
		'id' => 'rev_short_code',
		'std' => '',
		'placeholder' => '[rev_slider slider_name]',
		'type' => 'text');

	$options[] = array(
		'id'  =>'category-slider-setting',
		'class' => 'seperator',
		'desc' => 'Settings for Category Post Slider',
		'type' => 'info');

	$options[] = array(
		'name' => __('Show full window', 'accesspress_parallax'),
		'id' => 'slider_full_window',
		'on' => __('Yes', 'accesspress_parallax'),
		'off' => __('No', 'accesspress_parallax'),
		'std' => '1',
		'type' => 'switch');

	$options[] = array(
		'name' => __('Show Overlay', 'accesspress_parallax'),
		'id' => 'slider_overlay',
		'on' => __('Yes', 'accesspress_parallax'),
		'off' => __('No', 'accesspress_parallax'),
		'std' => '1',
		'type' => 'switch');

	$options[] = array(
		'name' => __('Show Pager', 'accesspress_parallax'),
		'id' => 'show_pager',
		'on' => __('Yes', 'accesspress_parallax'),
		'off' => __('No', 'accesspress_parallax'),
		'std' => '1',
		'type' => 'switch');

	$options[] = array(
		'name' => __('Show Controls', 'accesspress_parallax'),
		'id' => 'show_controls',
		'on' => __('Yes', 'accesspress_parallax'),
		'off' => __('No', 'accesspress_parallax'),
		'std' => '1',
		'type' => 'switch');

	$options[] = array(
		'name' => __('Auto Transition', 'accesspress_parallax'),
		'id' => 'auto_transition',
		'on' => __('Yes', 'accesspress_parallax'),
		'off' => __('No', 'accesspress_parallax'),
		'std' => '1',
		'type' => 'switch');

	$options[] = array(
		'name' => __('Slider Transition', 'accesspress_parallax'),
		'id' => 'slider_transition',
		'std' => 'fade',
		'type' => 'select',
		'options' => $transitions);

	$options[] = array(
		'name' => __('Slider Transition Speed', 'accesspress_parallax'),
		'id' => 'slider_speed',
		'std' => '5000',
		"min" 	=> "1000",
		"step"	=> "100",
		"max" 	=> "10000",
		"type" 	=> "sliderui");

	$options[] = array(
		'name' => __('Slider Pause Duration', 'accesspress_parallax'),
		'id' => 'slider_pause',
		'std' => '5000',
		"min" 	=> "1000",
		"step"	=> "100",
		"max" 	=> "8000",
		"type" 	=> "sliderui");

	$options[] = array(
		'name' => __('Show Caption', 'accesspress_parallax'),
		'id' => 'show_caption',
		'on' => __('Yes', 'accesspress_parallax'),
		'off' => __('No', 'accesspress_parallax'),
		'std' => '1',
		'type' => 'switch');

/* --------------------------PARALLAX SECTIONS-------------------------- */
	$options[] = array(
		'name' => __('Home Parallax Sections', 'accesspress_parallax'),
		'icon' => 'fa fa-home',
		'type' => 'heading');

	$options[] = array(
		'id' => 'home_note',
		'desc' => __('Note: Please make a new page before you create a section. Each Section should have unique Page.', 'accesspress_parallax'),
		'class' => 'seperator',
		'type' => 'info',
		);

	$options[] = array(
		'id' => 'parallax_section',
		'std' => $parallax_defaults,
		'options' => $options_pages,
		'category' => $options_categories,
		'portfolio_categories' => $portfolio_categories,
		'type' => 'parallaxsection' );

	$options[] = array(
		'id' => 'add_new_section',
		'type' => 'button',
		'button_name' => __('Add New Section', 'accesspress_parallax')
		);


/* --------------------------TYPOGRAPHY SETTINGS-------------------------- */
	$options[] = array(
		'name' => __('Typography', 'accesspress_parallax'),
		'icon' => 'fa fa-font',
		'type' => 'heading');

	$options[] = array(
		'name' => __('Body Font', 'accesspress_parallax'),
		'id' => 'body_typography',
		'std' => array(
			'size' => '16px',
			'face' => 'PT Sans',
			'style' => '400',
			'color' => '#333333',
			),
		'type' => 'typography');

	$options[] = array(
		'id' => 'header1_sep',
		'desc' => 'Header 1',
		'class' => 'seperator',
		'type' => 'info',
		);

	$options[] = array(
		'name' => __('H1 Font', 'accesspress_parallax'),
		'id' => 'h1_typography',
        'std' => array(
			'size' => '32px',
			'face' => 'Roboto',
			'style' => '300',
			'color' => '#333333',
			),
		'type' => 'typography');

	$options[] = array(
		'name' => __('H1 Text Transform', 'accesspress_parallax'),
		'id' => 'h1_text_transform',
		'type' => 'select',
		'std' => 'uppercase',
		'options' => $text_transform);

	$options[] = array(
		'id' => 'header2_sep',
		'desc' => 'Header 2',
		'class' => 'seperator',
		'type' => 'info',
		);

	$options[] = array(
		'name' => __('H2 Font', 'accesspress_parallax'),
		'id' => 'h2_typography',
        'std' => array(
			'size' => '28px',
			'face' => 'Roboto',
			'style' => '300',
			'color' => '#333333',
			),
		'type' => 'typography');

	$options[] = array(
		'name' => __('H2 Text Transform', 'accesspress_parallax'),
		'id' => 'h2_text_transform',
		'type' => 'select',
		'std' => 'uppercase',
		'options' => $text_transform);

	$options[] = array(
		'id' => 'header3_sep',
		'desc' => 'Header 3',
		'class' => 'seperator',
		'type' => 'info',
		);

	$options[] = array(
		'name' => __('H3 Font', 'accesspress_parallax'),
		'id' => 'h3_typography',
		'std' => array(
			'size' => '24px',
			'face' => 'Roboto',
			'style' => '300',
			'color' => '#333333',
			),
		'type' => 'typography');

	$options[] = array(
		'name' => __('H3 Text Transform', 'accesspress_parallax'),
		'id' => 'h3_text_transform',
		'type' => 'select',
		'std' => 'uppercase',
		'options' => $text_transform);

	$options[] = array(
		'id' => 'header4_sep',
		'desc' => 'Header 4',
		'class' => 'seperator',
		'type' => 'info',
		);

	$options[] = array(
		'name' => __('H4 Font', 'accesspress_parallax'),
		'id' => 'h4_typography',
        'std' => array(
			'size' => '20px',
			'face' => 'Roboto',
			'style' => '300',
			'color' => '#333333',
			),
		'type' => 'typography');

	$options[] = array(
		'name' => __('H4 Text Transform', 'accesspress_parallax'),
		'id' => 'h4_text_transform',
		'type' => 'select',
		'std' => 'uppercase',
		'options' => $text_transform);

	$options[] = array(
		'id' => 'header5_sep',
		'desc' => 'Header 5',
		'class' => 'seperator',
		'type' => 'info',
		);

	$options[] = array(
		'name' => __('H5 Font', 'accesspress_parallax'),
		'id' => 'h5_typography',
        'std' => array(
			'size' => '18px',
			'face' => 'PT Sans',
			'style' => '400',
			'color' => '#333333',
			),
		'type' => 'typography');

	$options[] = array(
		'name' => __('H5 Text Transform', 'accesspress_parallax'),
		'id' => 'h5_text_transform',
		'type' => 'select',
		'std' => 'uppercase',
		'options' => $text_transform);

	$options[] = array(
		'id' => 'header6_sep',
		'desc' => 'Header 6',
		'class' => 'seperator',
		'type' => 'info',
		);

	$options[] = array(
		'name' => __('H6 Font', 'accesspress_parallax'),
		'id' => 'h6_typography',
        'std' => array(
			'size' => '16px',
			'face' => 'PT Sans',
			'style' => '400',
			'color' => '#333333',
			),
		'type' => 'typography');

	$options[] = array(
		'name' => __('H6 Text Transform', 'accesspress_parallax'),
		'id' => 'h6_text_transform',
		'type' => 'select',
		'std' => 'uppercase',
		'options' => $text_transform);

	$options[] = array(
		'id' => 'widget_sep',
		'desc' => 'Widget',
		'class' => 'seperator',
		'type' => 'info',
		);

	$options[] = array(
		'name' => __('Slidebar Widget Title Font', 'accesspress_parallax'),
		'id' => 'widgettitle_typography',
        'std' => array(
			'size' => '20px',
			'face' => 'PT Sans',
			'style' => '400',
			'color' => '#333333',
			),
		'type' => 'typography');

	$options[] = array(
		'name' => __('Widget Text Heading Transform', 'accesspress_parallax'),
		'id' => 'widget_title_text_transform',
		'type' => 'select',
		'std' => 'uppercase',
		'options' => $text_transform);
	
/* --------------------------ARCHIVE SETTINGS-------------------------- */
$options[] = array(
		'name' => __('Archive/Blog Page Settings', 'accesspress_parallax'),
		'type' => 'heading');

	$options[] = array( 
		"name" => __('Archive Title Background Image', 'accesspress_parallax'),
		"id" => "archive_title_bg",
		"class" => "sub-option",
		"type" => "upload" );

	$options[] = array( 
		"name" => __('Archive Title Background Color', 'accesspress_parallax'),
		"id" => "archive_title_bg_color",
		"std" => "#FFFFFF",
        "desc" => __('Remove Background image and use background color','accesspress_parallax'),
		"type" => "color" );
  
    $options[] = array(
		'name' => __('Archive Title Background', 'accesspress_parallax'),
		'id' => 'archive_title_bg_option',
		'on' => __('Enable', 'accesspress_parallax'),
		'off' => __('Disable', 'accesspress_parallax'),
		'std' => '1',
		'type' => 'switch');

	$options[] = array( 
		"name" => __('Archive Title Color', 'accesspress_parallax'),
		"id" => "archive_title_color",
		"std" => "#000000",
		"type" => "color" );

	$options[] = array(
		'name' => __('Posted Date', 'accesspress_parallax'),
		'id' => 'post_date',
		'on' => __('Show', 'accesspress_parallax'),
		'off' => __('Hide', 'accesspress_parallax'),
		'std' => '1',
		'type' => 'switch');

	$options[] = array(
		'name' => __('Post Author', 'accesspress_parallax'),
		'id' => 'post_author',
		'on' => __('Show', 'accesspress_parallax'),
		'off' => __('Hide', 'accesspress_parallax'),
		'std' => '1',
		'type' => 'switch');

	$options[] = array(
		'name' => __('Post Footer text', 'accesspress_parallax'),
		'id' => 'post_footer',
		'on' => __('Show', 'accesspress_parallax'),
		'off' => __('Hide', 'accesspress_parallax'),
		'std' => '1',
		'type' => 'switch');
  
  	$options[] = array(
		'name' => __('Exclude From Blog Page', 'accesspress_parallax'),
		'desc' => __('Check the categories to exclude from blog page.', 'accesspress_parallax'),
		'id' => 'exclude_from_blog',
		'type' => 'multicheck',
		'options' => $options_categories_multicheck);

  	$options[] = array(
		'name' => __('Post Content Type', 'accesspress_parallax'),
		'id' => 'post_content_type',
		'std' => 'excerpt_content',
		'type' => 'radio',
		'options' => $post_content_type);

  	$options[] = array( 
		"name" => __('"Read More" Translation', 'accesspress_parallax'),
		"id" => "read_more_text",
		"std" => "Read More",
		"type" => "text" ,
        'desc' => __('Read More text that appear in blog section to open the detail page. Leave Blank if you do not want to show.', 'accesspress_parallax'));
  
  	$options[] = array( 
		"name" => __('"Read All" Translation', 'accesspress_parallax'),
		"id" => "read_all_text",
		"std" => "Read All",
		"type" => "text" ,
        'desc' => __('Read All text that appear in blog section to open category page. Leave Blank if you do not want to show.', 'accesspress_parallax'));
              
  	$options[] = array( 
		"name" => __('"Continue reading" Translation', 'accesspress_parallax'),
		"id" => "continue_reading_text",
		"std" => "Continue Reading",
		"type" => "text" );

/* --------------------------SINGLE POST SETTINGS-------------------------- */
	$options[] = array(
		'name' => __('Single Post Settings', 'accesspress_parallax'),
		'type' => 'heading');

	$options[] = array( 
		"name" => __('Post Title Background', 'accesspress_parallax'),
		"id" => "post_title_bg",
		"class" => "sub-option",
		"type" => "upload" );

	$options[] = array( 
		"name" => __('Post Title Background Color', 'accesspress_parallax'),
		"id" => "post_title_bg_color",
		"std" => "#FFFFFF",
        "desc" => __('Remove Background image and use background color','accesspress_parallax'),
		"type" => "color" );
        
  	$options[] = array(
		'name' => __('Post Title Background', 'accesspress_parallax'),
		'id' => 'post_title_bg_option',
		'on' => __('Enable', 'accesspress_parallax'),
		'off' => __('Disable', 'accesspress_parallax'),
		'std' => '1',
		'type' => 'switch');

	$options[] = array( 
		"name" => __('Post Title Color', 'accesspress_parallax'),
		"id" => "post_title_color",
		"std" => "#000000",
		"type" => "color" );

	$options[] = array(
		'name' => __('Posted Date', 'accesspress_parallax'),
		'id' => 'single_post_date',
		'on' => __('Show', 'accesspress_parallax'),
		'off' => __('Hide', 'accesspress_parallax'),
		'std' => '1',
		'type' => 'switch');

	$options[] = array(
		'name' => __('Post Author', 'accesspress_parallax'),
		'id' => 'single_post_author',
		'on' => __('Show', 'accesspress_parallax'),
		'off' => __('Hide', 'accesspress_parallax'),
		'std' => '1',
		'type' => 'switch');
        
    $options[] = array(
		'name' => __('Featured Image', 'accesspress_parallax'),
		'id' => 'post_featured_image',
		'on' => __('Show', 'accesspress_parallax'),
		'off' => __('Hide', 'accesspress_parallax'),
		'std' => '1',
		'type' => 'switch');

	$options[] = array(
		'name' => __('Post Footer text', 'accesspress_parallax'),
		'id' => 'single_post_footer',
		'on' => __('Show', 'accesspress_parallax'),
		'off' => __('Hide', 'accesspress_parallax'),
		'std' => '1',
		'type' => 'switch');

	$options[] = array(
		'name' => __('Prev Next Pagination', 'accesspress_parallax'),
		'id' => 'single_post_pagination',
		'on' => __('Show', 'accesspress_parallax'),
		'off' => __('Hide', 'accesspress_parallax'),
		'std' => '1',
		'type' => 'switch');
        
   $options[] = array(
		'name' => __('Social Sharing Button', 'accesspress_parallax'),
		'id' => 'social_share',
		'on' => __('Show', 'accesspress_parallax'),
		'off' => __('Hide', 'accesspress_parallax'),
		'std' => '0',
		'type' => 'switch');

/* --------------------------SINGLE PAGE SETTINGS-------------------------- */
	$options[] = array(
		'name' => __('Single Page Settings', 'accesspress_parallax'),
		'type' => 'heading');

	$options[] = array( 
		"name" => __('Page Title Background', 'accesspress_parallax'),
		"id" => "page_title_bg",
		"class" => "sub-option",
		'desc' => __('To Upload different header image for individual page, go to Page editor option "Header Banner Image"', 'accesspress_parallax'),
		"type" => "upload" );

	$options[] = array( 
		"name" => __('Page Title Background Color', 'accesspress_parallax'),
		"id" => "page_title_bg_color",
		"std" => "#FFFFFF",
        "desc" => __('Remove Background image and use background color','accesspress_parallax'),
		"type" => "color" );
        
    $options[] = array(
		'name' => __('Page Title Background', 'accesspress_parallax'),
		'id' => 'page_title_bg_option',
		'on' => __('Enable', 'accesspress_parallax'),
		'off' => __('Disable', 'accesspress_parallax'),
		'std' => '1',
		'type' => 'switch');

	$options[] = array( 
		"name" => __('Page Title Color', 'accesspress_parallax'),
		"id" => "page_title_color",
		"std" => "#000000",
		"type" => "color" );
  
    $options[] = array(
		'name' => __('Featured Image', 'accesspress_parallax'),
		'id' => 'page_featured_image',
		'on' => __('Show', 'accesspress_parallax'),
		'off' => __('Hide', 'accesspress_parallax'),
		'std' => '1',
		'type' => 'switch');
        
     $options[] = array(
		'name' => __('Comments', 'accesspress_parallax'),
		'id' => 'page_comments',
		'on' => __('Enable', 'accesspress_parallax'),
		'off' => __('Disable', 'accesspress_parallax'),
		'std' => '1',
		'type' => 'switch');

/* --------------------------PORTFOLIO SETTINGS-------------------------- */
	$options[] = array(
		'name' => __('Portfolio Settings', 'accesspress_parallax'),
		'icon' => 'fa fa-suitcase',
		'type' => 'heading');

	$options[] = array(
	'name' => __('Portfolio Slug', 'accesspress_parallax'),
	'id' => 'portfolio_slug',
	'desc' => __('Default', 'accesspress_parallax').' - portfolio Eg http://www.yourwebsite.com/<strong>portfolio</strong>/',
	'std' => 'portfolio',
	'type' => 'text');
    
    $options[] = array(
	'id' => 'home_protfolio',
	'desc' => __('Portfolio section setting - Home page parallax section', 'accesspress_parallax'),
	'class' => 'seperator',
	'type' => 'info');

	$options[] = array(
	'name' => __('Full Width Portfolio', 'accesspress_parallax'),
	'id' => 'enable_fullwidth_portfolio',
	'on' => __('Enable', 'accesspress_parallax'),
	'off' => __('Disable', 'accesspress_parallax'),
	'std' => '1',
	'type' => 'switch');

	$options[] = array(
	'name' => __('Space Between Portfolio', 'accesspress_parallax'),
	'id' => 'portfolio_space',
	'on' => __('Enable', 'accesspress_parallax'),
	'off' => __('Disable', 'accesspress_parallax'),
	'std' => '1',
	'type' => 'switch');
    
    $options[] = array(
	'name' => __('No of character to display in excerpt', 'accesspress_parallax'),
	'id' => 'portfolio_char',
	'type' => 'num',
	'addontext' => 'chars',
	'class' => 'mini',
	'std' => '180');

	$options[] = array(
	'name' => __('No of columns in grid layout', 'accesspress_parallax'),
	'id' => 'portfolio_grid_columns',
	'type' => 'select',
	'std' => 'column-4',
	'options' => array(
		'column-2' => '2',
		'column-3' => '3',
		'column-4' => '4',
		'column-5' => '5',
		));	

	$options[] = array(
	'name' => __('Portfolio items Style', 'accesspress_parallax'),
	'id' => 'portfolio_style',
	'type' => 'select',
	'std' => 'style1',
	'options' => array(
		'style1' => __('Line Animation', 'accesspress_parallax'),
		'style2' => __('Text Slide Right', 'accesspress_parallax'),
		'style3' => __('Text Animation', 'accesspress_parallax'),
		'style4' => __('Image Slide Up', 'accesspress_parallax'),
		));

	$options[] = array(
	'name' => __('"All" Translation Text', 'accesspress_parallax'),
	'id' => 'portfolio_all',
	'desc' => __('Leave Blank if you do not want to show', 'accesspress_parallax'),
	'std' => __('All', 'accesspress_parallax'),
	'class' => 'mini',
	'type' => 'text');
  
    $options[] = array(
	'id' => 'inner_protfolio',
	'desc' => __('Portfolio page setting - If Portfolio Page Template is assigned to the Page', 'accesspress_parallax'),
	'class' => 'seperator',
	'type' => 'info');
    
   	$options[] = array(
	'name' => __('Full Width Portfolio', 'accesspress_parallax'),
	'id' => 'enable_fullwidth_portfolio1',
	'on' => __('Enable', 'accesspress_parallax'),
	'off' => __('Disable', 'accesspress_parallax'),
	'std' => '1',
	'type' => 'switch');	

	$options[] = array(
	'name' => __('Space between Portfolio', 'accesspress_parallax'),
	'id' => 'portfolio_space1',
	'on' => __('Enable', 'accesspress_parallax'),
	'off' => __('Disable', 'accesspress_parallax'),
	'std' => '1',
	'type' => 'switch');

	$options[] = array(
	'name' => __('No of character to display in excerpt', 'accesspress_parallax'),
	'id' => 'portfolio_char1',
	'type' => 'num',
	'addontext' => 'chars',
	'class' => 'mini',
	'std' => '180');

	$options[] = array(
	'name' => __( 'Portfolio Layout', 'accesspress_parallax' ),
	'id' => 'portfolio_layout1',
	'std' => 'grid',
	'type' => 'select',
	'options' => $portfolio_layout);

	$options[] = array(
	'name' => __('No of columns in grid layout', 'accesspress_parallax'),
	'id' => 'portfolio_grid_columns1',
	'type' => 'select',
	'std' => 'column-4',
    'desc' => __('If layout grid is selected', 'accesspress_parallax'),
	'options' => array(
		'column-2' => '2',
		'column-3' => '3',
		'column-4' => '4',
		'column-5' => '5',
		));

	$options[] = array(
	'name' => __('Portfolio items Style', 'accesspress_parallax'),
	'id' => 'portfolio_style1',
	'type' => 'select',
	'std' => 'style1',
    'desc' => __('If layout grid is selected', 'accesspress_parallax'),
	'options' => array(
		'style1' => __('Line Animation', 'accesspress_parallax'),
		'style2' => __('Text Slide Right', 'accesspress_parallax'),
		'style3' => __('Text Animation', 'accesspress_parallax'),
		'style4' => __('Image Slide Up', 'accesspress_parallax'),
		));

	$options[] = array(
	'name' => __('"All" Translation Text', 'accesspress_parallax'),
	'id' => 'portfolio_all1',
	'desc' => __('Leave Blank if you do not want to show', 'accesspress_parallax'),
	'std' => __('All', 'accesspress_parallax'),
	'class' => 'mini',
	'type' => 'text');

/* --------------------------BREADCRUMBS SETTINGS-------------------------- */

	$options[] = array(
		'name' => __('Breadcrumbs Settings', 'accesspress_parallax'),
		'icon' => 'fa fa-compass',
		'type' => 'heading');

	$options[] = array(
		'name' => __('Breadcrumb', 'accesspress_parallax'),
		'id' => 'enable_breadcrumb',
		'on' => __('Show', 'accesspress_parallax'),
		'off' => __('Hide', 'accesspress_parallax'),
		'std' => '1',
		'type' => 'switch');

	$options[] = array(
		'name' => __('Breadcrumb in Mobile', 'accesspress_parallax'),
		'id' => 'enable_breadcrumb_mobile',
		'on' => __('Enable', 'accesspress_parallax'),
		'off' => __('Disable', 'accesspress_parallax'),
		'std' => '1',
		'type' => 'switch');

	$options[] = array(
		'name' => __('Breadcrumb Seperator', 'accesspress_parallax'),
		'id' => 'breadcrumb_seperator',
		'std' => '/',
		'desc'=> 'example: >> , / , - etc ',
		'type' => 'text');

	$options[] = array(
		'name' => __('Home Text', 'accesspress_parallax'),
		'id' => 'breadcrumb_home_text',
		'std' => 'Home',
		'type' => 'text');
	
/* --------------------------SOCIAL SETTINGS-------------------------- */
	$options[] = array(
		'name' => __('Social Links', 'accesspress_parallax'),
		'icon' => 'fa fa-share-alt',
		'type' => 'heading');

	$options[] = array(
		'name' => __('Show Social Icon', 'accesspress_parallax'),
		'id' => 'show_social',
		'on' => __('Enable', 'accesspress_parallax'),
		'off' => __('Disable', 'accesspress_parallax'),
		'std' => '1',
		'type' => 'switch');

	$options[] = array( 
		"name" => __('Social Icon Background', 'accesspress_parallax'),
		"id" => "social_bg_color",
		"std" => "#000000",
		"type" => "color" );

	$options[] = array( 
		"name" => __('Social Icon Hover Background', 'accesspress_parallax'),
		"id" => "social_hov_bg_color",
		"std" => "#000000",
		"type" => "color" );

	$options[] = array(
		'name' => __('Social Icon Position', 'accesspress_parallax'),
		'id' => 'social_icon_position',
		'type' => 'select',
		'std' => 'left',
		'options' => $social_icon_position);

	$options[] = array(
		'name' => __('Facebook', 'accesspress_parallax'),
		'id' => 'facebook',
		'type' => 'url');

	$options[] = array(
		'name' => __('Twitter', 'accesspress_parallax'),
		'id' => 'twitter',
		'type' => 'url');

	$options[] = array(
		'name' => __('Google Plus', 'accesspress_parallax'),
		'id' => 'google_plus',
		'type' => 'url');

	$options[] = array(
		'name' => __('Youtube', 'accesspress_parallax'),
		'id' => 'youtube',
		'type' => 'url');

	$options[] = array(
		'name' => __('Pinterest', 'accesspress_parallax'),
		'id' => 'pinterest',
		'type' => 'url');

	$options[] = array(
		'name' => __('Linkedin', 'accesspress_parallax'),
		'id' => 'linkedin',
		'type' => 'url');

	$options[] = array(
		'name' => __('Fickr', 'accesspress_parallax'),
		'id' => 'flickr',
		'type' => 'url');

	$options[] = array(
		'name' => __('Vimeo', 'accesspress_parallax'),
		'id' => 'vimeo',
		'type' => 'url');

	$options[] = array(
		'name' => __('Instagram', 'accesspress_parallax'),
		'id' => 'instagram',
		'type' => 'url');

	$options[] = array(
		'name' => __('Dribbble', 'accesspress_parallax'),
		'id' => 'dribbble',
		'type' => 'url');

	$options[] = array(
		'name' => __('MySpace', 'accesspress_parallax'),
		'id' => 'myspace',
		'type' => 'url');

	$options[] = array(
		'name' => __('Foursquare', 'accesspress_parallax'),
		'id' => 'foursquare',
		'type' => 'url');

	$options[] = array(
		'name' => __('Tumblr', 'accesspress_parallax'),
		'id' => 'tumblr',
		'type' => 'url');

	$options[] = array(
		'name' => __('WordPress', 'accesspress_parallax'),
		'id' => 'wordpress',
		'type' => 'url');

	$options[] = array(
		'name' => __('RSS', 'accesspress_parallax'),
		'id' => 'rss',
		'type' => 'url');

	$options[] = array(
		'name' => __('Delicious', 'accesspress_parallax'),
		'id' => 'delicious',
		'type' => 'url');

	$options[] = array(
		'name' => __('Last.fm', 'accesspress_parallax'),
		'id' => 'lastfm',
		'type' => 'url');

	$options[] = array(
		'name' => __('GitHub', 'accesspress_parallax'),
		'id' => 'github',
		'type' => 'url');

	$options[] = array(
		'name' => __('Soundcloud', 'accesspress_parallax'),
		'id' => 'soundcloud',
		'type' => 'url');

	$options[] = array(
		'name' => __('StumbleUpon', 'accesspress_parallax'),
		'id' => 'stumbleupon',
		'type' => 'url');

	$options[] = array(
		'name' => __('Skype', 'accesspress_parallax'),
		'id' => 'skype',
		'type' => 'text');

/* --------------------------CLIENTS TEXTS-------------------------- */

	$options[] = array(
		'name' => __('Client/Partner Logo', 'accesspress_parallax'),
		'icon' => 'fa fa-user',
		'type' => 'heading');

	$options[] = array(
		'id' => 'client_note',
		'desc' => __('Settings for "Logo Slider Section" layout in Home Parallax Section tab.', 'accesspress_parallax'),
		'class' => 'seperator',
		'type' => 'info',
		);

	$options[] = array(
		'name' => __('Client/Partner logo Slider', 'accesspress_parallax'),
		'id' => 'enable_partner',
		'on' => __('Enable', 'accesspress_parallax'),
		'off' => __('Disable', 'accesspress_parallax'),
		'std' => '1',
		'type' => 'switch');

	$options[] = array(
		'name' => __('Logos in a row', 'accesspress_parallax'),
		'id' => 'partner_logo_no',
		'std' => '8',
		'desc' => __('Number of Logo to Display in a Row. Value between 6-8', 'accesspress_parallax'),
		'class' => 'mini',
		'type' => 'num',
		'addontext' => 'logo');

	$options[] = array(
		'name' => __('Single Logo Width', 'accesspress_parallax'),
		'id' => 'partner_logo_width',
		'std' => '180',
		'class' => 'mini',
		'type' => 'num',
		'addontext' => 'px');

	$options[] = array(
		'id' => 'partner_sep',
		'desc' => __('Upload Associates Logo -  Do no upload the image with size greater than 200px', 'accesspress_parallax'),
		'class' => 'seperator',
		'type' => 'info',
		);

	$options[] = array(
		'name' => __('Associate Logo', 'accesspress_parallax'),
		'id' => 'partner_logo',
		'type' => 'parter_logo',
		'placeholder' => 'http://'
		);

/* --------------------------GOOGLE MAP SETTINGS-------------------------- */
	$options[] = array(
		'name' => __('Google Map', 'accesspress_parallax'),
		'icon' => 'fa fa-map-marker',
		'type' => 'heading');

	$options[] = array(
		'id' => 'google_note',
		'desc' => __('Settings for "Google Map Section" layout in Home Parallax Section tab.', 'accesspress_parallax'),
		'class' => 'seperator',
		'type' => 'info',
		);

	$options[] = array(
	'name' => __('Enable Google Map', 'accesspress_parallax'),
	'id' => 'enable_googlemap',
	'on' => __('Enable', 'accesspress_parallax'),
	'off' => __('Disable', 'accesspress_parallax'),
	'std' => '1',
	'type' => 'switch');

	$options[] = array(
	'name' => __('Latiitude/Longitide', 'accesspress_parallax'),
	'desc' => sprintf(__('To get Values of Latitude and Longitude by Location name, click on <a target="_blank" href="%s">http://www.latlong.net</a>', 'accesspress_parallax'),esc_url("http://www.latlong.net")),
	'id' => 'latlng',
	'type' => 'info');

	$options[] = array(
	'name' => __('Enter the latitude', 'accesspress_parallax'),
	'id' => 'map_latitude',
	'std' => '-33',
	'class' => 'mini',
	'type' => 'text');

	$options[] = array(
	'name' => __('Enter the longitude', 'accesspress_parallax'),
	'id' => 'map_longitude',
	'std' => '151',
	'class' => 'mini',
	'type' => 'text');

	$options[] = array(
	'name' => __('Map height', 'accesspress_parallax'),
	'id' => 'map_height',
	'std' => '300',
	'class' => 'mini',
	'type' => 'text');

	$options[] = array(
	'name' => __('Zoom Level', 'accesspress_parallax'),
	'id' => 'map_zoom',
	'std' => '14',
	'type' => 'select',
	'options' => array(
		'1' => '1',
		'2' => '2',
		'3' => '3',
		'4' => '4',
		'5' => '5',
		'6' => '6',
		'7' => '7',
		'8' => '8',
		'9' => '9',
		'10' => '10',
		'11' => '11',
		'12' => '12',
		'13' => '13',
		'14' => '14',
		'15' => '15',
		'16' => '16',
		'17' => '17',
		'18' => '18',
		'19' => '19', )
	);

	$options[] = array(
	'name' => __('Map Type', 'accesspress_parallax'),
	'id' => 'map_type',
	'std' => 'ROADMAP',
	'type' => 'select',
	'options' => array(
		'ROADMAP' => 'ROADMAP',
		'SATELLITE' => 'SATELLITE',
		'HYBRID' => 'HYBRID',
		'TERRAIN' => 'TERRAIN')
	);

	$options[] = array(
	'name' => __('Scrolling Wheel', 'accesspress_parallax'),
	'id' => 'map_scrolling',
	'on' => __('Enable', 'accesspress_parallax'),
	'off' => __('Disable', 'accesspress_parallax'),
	'std' => '1',
	'desc' => __('Zoom map on Scrolling', 'accesspress_parallax'),
	'type' => 'switch');

	$options[] = array(
	'name' => __('Map Controls', 'accesspress_parallax'),
	'id' => 'map_controls',
	'on' => __('Show', 'accesspress_parallax'),
	'off' => __('Hide', 'accesspress_parallax'),
	'std' => '1',
	'desc' => __('Control icons that appears above Map', 'accesspress_parallax'),
	'type' => 'switch');

	$options[] = array(
	'name' => __('Pin Marker', 'accesspress_parallax'),
	'id' => 'pin_marker',
	'on' => __('Show', 'accesspress_parallax'),
	'off' => __('Hide', 'accesspress_parallax'),
	'std' => '1',
	'desc' => __('Pin marker that points your location', 'accesspress_parallax'),
	'type' => 'switch');
    
    $options[] = array(
	'desc' => __('Contact Form (Using shortcode from contact form 7)', 'accesspress_parallax'),
	'id' => 'ap_contact_form',
    'class' => 'seperator',
	'type' => 'info');

	$options[] = array(
	'name' => __('Contact Form (ShortCode)', 'accesspress_parallax'),
	'id' => 'contact_form_shortcode',
	'type' => 'text');

	$options[] = array( 
	"name" => __('Section Background Image', 'accesspress_parallax'),
	"id" => "contact_form_bg",
	"class" => "sub-option",
	'desc' => __('To Upload background image for contact form section.', 'accesspress_parallax'),
	"type" => "upload" );

    $options[] = array(
	'desc' => __('Contact Address (Appear above Gooogle Map)', 'accesspress_parallax'),
	'id' => 'map_contact_address',
    'class' => 'seperator',
	'type' => 'info');
    
    $options[] = array(
	'name' => __('Title', 'accesspress_parallax'),
	'id' => 'contact_title',
	'type' => 'text');
    
    $options[] = array(
	'name' => __('Phone', 'accesspress_parallax'),
	'id' => 'contact_phone',
	'type' => 'text');
    
    $options[] = array(
	'name' => __('Email', 'accesspress_parallax'),
	'id' => 'contact_email',
	'type' => 'text');
    
    $options[] = array(
	'name' => __('Website', 'accesspress_parallax'),
	'id' => 'contact_website',
	'type' => 'text');
    
    $options[] = array(
	'name' => __('Contact Address', 'accesspress_parallax'),
	'id' => 'contact_address',
    'rows' => '4',
	'type' => 'textarea');
    
    $options[] = array(
	'name' => __('Additional Info', 'accesspress_parallax'),
	'id' => 'contact_detail',
    'rows' => '4',
	'type' => 'textarea');
    
    $options[] = array(
	'desc' => __('Leave the contact fields empty if you do not want to show the Contact Address', 'accesspress_parallax'),
	'id' => 'contact_empty',
    'class' => 'seperator',
	'type' => 'info');


/* --------------------------FOOTER TEXTS-------------------------- */

	$options[] = array(
		'name' => __('Footer Settings', 'accesspress_parallax'),
		'icon' => 'fa fa-copyright',
		'type' => 'heading');

	$options[] = array(
		'id' => 'footer_note',
		'desc' => __('Go to Apperance -> Widgets to add Widgets in the footer.', 'accesspress_parallax'),
		'class' => 'seperator',
		'type' => 'info',
		);

	$options[] = array(
		'name' => __('Top Footer', 'accesspress_parallax'),
		'id' => 'show_top_footer',
		'on' => __('Show', 'accesspress_parallax'),
		'off' => __('Hide', 'accesspress_parallax'),
		'std' => '1',
		'type' => 'switch');

	$options[] = array( 
		"name" => __('Top Footer Background', 'accesspress_parallax'),
		"id" => "top_footer_bg",
		"std" => "#272727",
		"type" => "color" );

	$options[] = array(
		'name' => __('Top Footer Title', 'accesspress_parcallax'),
		'id' => 'footertitle_typography',
		'type' => 'typography',
		'std' => array(
			'size' => '18px',
			'face' => 'PT Sans',
			'style' => '400',
			'color' => '#FFFFFF',
		)
		);

	$options[] = array(
		'name' => __('Top Footer Title Text Transform', 'accesspress_parallax'),
		'id' => 'footer_title_text_transform',
		'type' => 'select',
		'std' => 'normal',
		'options' => $text_transform);


	$options[] = array( 
		"name" => __('Top Footer Text Color', 'accesspress_parallax'),
		"id" => "top_footer_font_color",
		"std" => "#EEEEEE",
		"type" => "color" );

	$options[] = array( 
		"name" => __('Top Footer Link Color', 'accesspress_parallax'),
		"id" => "top_footer_link_color",
		"std" => "#999999",
		"type" => "color" );

	$options[] = array(
		'name' => __('Bottom Footer Layout', 'accesspress_parallax'),
		'id' => 'bottom_footer_layout',
		'type' => 'select',
		'std' => 'normal',
		'options' => $bottom_footer_layout);

	$options[] = array( 
		"name" => __('Bottom Footer Background', 'accesspress_parallax'),
		"id" => "bottom_footer_bg",
		"std" => "#000000",
		"type" => "color" );

	$options[] = array( 
		"name" => __('Bottom Footer Text Color', 'accesspress_parallax'),
		"id" => "bottom_footer_text_color",
		"std" => "#EEEEEE",
		"type" => "color" );

	$options[] = array(
		'name' => __('Footer Copyright Text', 'accesspress_parallax'),
		'id' => 'copy_right_text',
		'std' => __('@2015 AccessPress Parallax', 'accesspress_parallax'),
		'type' => 'text');

	$options[] = array(
		'name' => __('Right Footer Text', 'accesspress_parallax'),
		'id' => 'right_footer_text',
		'std' => sprintf(__('Powered By <a href="%s">Accesspress Themes</a>','accesspress_parallax'),'https://accesspressthemes.com/'),
		'type' => 'textarea',
        'rows' => '2'
        );

	$options[] = array(
		'name' => __('Show Social Icons in Bottom Footer', 'accesspress_parallax'),
		'id' => 'show_social_on_footer',
		'on' => __('Yes', 'accesspress_parallax'),
		'off' => __('No', 'accesspress_parallax'),
		'std' => '0',
		'type' => 'switch');

/* --------------------------CUSTOM CSS-------------------------- */
	$options[] = array(
		'name' => __('Custom CSS', 'accesspress_parallax'),
		'icon' => 'fa fa-file-code-o',
		'type' => 'heading');

	$options[] = array(
		'name' => __('Custom CSS', 'accesspress_parallax'),
		'id' => 'custom_css',
		'type' => 'textarea',
		'desc' => __('Put your custom CSS here', 'accesspress_parallax')
		);

/* --------------------------CUSTOM JS-------------------------- */

	$options[] = array(
		'name' => __('Custom JS', 'accesspress_parallax'),
		'icon' => 'fa fa-file-code-o',
		'type' => 'heading');

	$options[] = array(
		'name' => __('Custom JS', 'accesspress_parallax'),
		'id' => 'custom_js',
		'type' => 'textarea',
		'desc' => __('Put your analytics code/custom JS here', 'accesspress_parallax')
		);

/* --------------------------ABOUT SECTION-------------------------- */

	$options[] = array(
		'name' => __('About AccessPress Parallax Pro', 'accesspress_parallax'),
		'icon' => 'fa fa-globe',
		'type' => 'heading');

	$options[] = array(
		'name' => __('About AccessPress Parallax Pro', 'accesspress_parallax'),
		'desc' => $about_content,
		'type' => 'info');

	$options[] = array(
		'name' => __('For Support', 'accesspress_parallax'),
		'desc' => $for_support,
		'type' => 'info');

	$options[] = array(
		'name' => __('For Customization', 'accesspress_parallax'),
		'desc' => $for_customization,
		'type' => 'info');

	$options[] = array(
		'name' => __('Get Social', 'accesspress_parallax'),
		'desc' => $get_social,
		'type' => 'info');

/* --------------------------ABOUT SECTION-------------------------- */

	$options[] = array(
		'name' => __('About AccessPress Themes', 'accesspress_parallax'),
		'icon' => 'fa fa-globe',
		'type' => 'heading');

	$options[] = array(
		'name' => __('About AccessPress Themes', 'accesspress_parallax'),
		'desc' => $about_accesspress_themes,
		'type' => 'info');

	$options[] = array(
		'name' => __('More from AccessPress Themes', 'accesspress_parallax'),
		'desc' => $from_accesspress_thems,
		'type' => 'info');

	$options[] = array(
		'name' => __('Get Social', 'accesspress_parallax'),
		'desc' => $get_social,
		'type' => 'info');

return $options;
}