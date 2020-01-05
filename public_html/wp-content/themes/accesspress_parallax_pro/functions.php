<?php

/**
 * accesspress_parallax functions and definitions
 *
 * @package accesspress_parallax
 */
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if (!isset($content_width)) {
    $content_width = 640; /* pixels */
}

if (!function_exists('accesspress_parallax_setup')) :

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function accesspress_parallax_setup() {

        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on accesspress_parallax, use a find and replace
         * to change 'accesspress_parallax' to the name of your theme in all the template files
         */
        load_theme_textdomain('accesspress_parallax', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        add_theme_support('post-thumbnails');
        add_image_size('blog-header', 900, 300, array('center', 'center')); //blog Image
        add_image_size('portfolio-thumbnail', 560, 450, array('center', 'center')); //Portfolio Image	
        add_image_size('medium-thumbnail', 540, 350, array('center', 'center')); //Portfolio Image	
        add_image_size('team-thumbnail', 380, 380, array('top', 'center')); //Portfolio Image
        add_image_size('portfolio-long', 373, 560, array('top', 'center')); //Portfolio Image
        add_image_size('testimonial-thumbnial', 445, 445, true);
        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => __('Primary Menu', 'accesspress_parallax'),
            'topmenu' => __('Header Menu', 'accesspress_parallax'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
        ));

        // Adding WooCommerce Support
        add_theme_support('woocommerce');

    }

endif; // accesspress_parallax_setup
add_action('after_setup_theme', 'accesspress_parallax_setup');

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function accesspress_parallax_widgets_init() {
    register_sidebar(array(
        'name' => __('Sidebar Left', 'accesspress_parallax'),
        'id' => 'sidebar-left',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title"><span>',
        'after_title' => '</span></h4>',
    ));

    register_sidebar(array(
        'name' => __('Sidebar Right', 'accesspress_parallax'),
        'id' => 'sidebar-right',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title"><span>',
        'after_title' => '</span></h4>',
    ));

    register_sidebar(array(
        'name' => __('Sidebar Shop', 'accesspress_parallax'),
        'id' => 'sidebar-shop',
        'description' => __('Sidebar for WooCommerce Page', 'accesspress_parallax'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title"><span>',
        'after_title' => '</span></h4>',
    ));

    register_sidebar(array(
        'name' => __('Footer One', 'accesspress_parallax'),
        'id' => 'footer-1',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => __('Footer Two', 'accesspress_parallax'),
        'id' => 'footer-2',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => __('Footer Three', 'accesspress_parallax'),
        'id' => 'footer-3',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => __('Footer Four', 'accesspress_parallax'),
        'id' => 'footer-4',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));
}

add_action('widgets_init', 'accesspress_parallax_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function accesspress_parallax_scripts() {
    $map_latitude = of_get_option('map_latitude');
    $map_longitude = of_get_option('map_longitude');
    $query_args = array(
        'family' => 'PT+Sans:400|Oxygen:400',
    );
    wp_enqueue_style('google-fonts', add_query_arg($query_args, "//fonts.googleapis.com/css"));
    wp_enqueue_style('accesspress_parallax-combined-style', get_template_directory_uri() . '/css/ap-combined-style.css');
    wp_enqueue_style('accesspress_parallax-style', get_stylesheet_uri());
    wp_enqueue_style('accesspress_parallax-responsive', get_template_directory_uri() . '/css/responsive.css');
    
    wp_enqueue_script('accesspress_parallax-plugins', get_template_directory_uri() . '/js/plugins.js', array('jquery'), '1', true);
    
    if(of_get_option('enable_googlemap') == '1' && !empty($map_latitude) && !empty($map_longitude) && (is_front_page() || is_page_template('contact-page.php') || is_page_template('home-page.php'))):
        wp_enqueue_script('accesspress_parallax-googlemap', '//maps.googleapis.com/maps/api/js?key=AIzaSyAtTr98FPglJL7nEodRmS_9oMD8562RE7c', array(), '3.0', false);
    endif;
    if (of_get_option('enable_animation') == '1' && is_front_page()):
        wp_enqueue_script('accesspress_parallax-wow', get_template_directory_uri() . '/js/wow.min.js', array('jquery'), '1.0', true);
    endif;

    wp_register_script('accesspress_parallax-custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), '1.0', true);

    wp_localize_script( 'accesspress_parallax-custom', 'parallax_pro_ajax_script', array( 'ajaxurl' => admin_url( 'admin-ajax.php') ) );
    wp_enqueue_script( 'accesspress_parallax-custom' );

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'accesspress_parallax_scripts');

function accesspress_dynamic_styles() {
    wp_enqueue_style('accesspress_parallax-dynamic-style', get_template_directory_uri() . '/css/style.php');
}

add_action('wp_enqueue_scripts', 'accesspress_dynamic_styles', 15);

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/accesspress-functions.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Google Fonts.
 */
require get_template_directory() . '/inc/accesspress-google-fonts.php';

/**
 * Load Shortcodes
 */
require get_template_directory() . '/inc/accesspress-shortcodes.php';

/**
 * Load Widgets
 */
require get_template_directory() . '/inc/accesspress-widgets.php';

/**
 * Load Custom Post types
 */
require get_template_directory() . '/inc/accesspress-posts-types.php';

/**
 * Load Custom Meta Box
 */
require get_template_directory() . '/inc/accesspress-metabox.php';

/**
 * Implement the TGM
 */
require get_template_directory() . '/inc/accesspress-plugin-activation.php';

/**
 * Load TGMA
 */
require get_template_directory() . '/inc/accesspress-tgmpa.php';

/**
 * Load Theme Option Frame work files
 */
require get_template_directory() . '/inc/options-framework/options-framework.php';

/**
 * Import
 */
require get_template_directory() . '/inc/import/ap-importer.php';

/**
 * WooCommerce Function
 */
require get_template_directory() . '/woocommerce/woocommerce-function.php';

add_filter('show_admin_bar', '__return_false');