<?php

/**
 * @package   Options_Framework
 * @author    Devin Price <devin@wptheming.com>
 * @license   GPL-2.0+
 * @link      http://wptheming.com
 * @copyright 2010-2014 WP Theming
 */
/**
 * Sanitization for text input
 *
 * @link http://developer.wordpress.org/reference/functions/sanitize_text_field/
 */
add_filter('of_sanitize_text', 'sanitize_text_field');
add_filter('of_sanitize_hidden', 'sanitize_text_field');
add_filter('of_sanitize_switch', 'sanitize_text_field');
add_filter('of_sanitize_sliderui', 'sanitize_text_field');

/**
 * Sanitization for password input
 *
 * @link http://developer.wordpress.org/reference/functions/sanitize_text_field/
 */
add_filter('of_sanitize_password', 'sanitize_text_field');

/**
 * Sanitization for select input
 *
 * Validates that the selected option is a valid option.
 */
add_filter('of_sanitize_select', 'of_sanitize_enum', 10, 2);

/**
 * Sanitization for radio input
 *
 * Validates that the selected option is a valid option.
 */
add_filter('of_sanitize_radio', 'of_sanitize_enum', 10, 2);

/**
 * Sanitization for image selector
 *
 * Validates that the selected option is a valid option.
 */
add_filter('of_sanitize_images', 'of_sanitize_enum', 10, 2);

/**
 * Sanitization for textarea field
 *
 * @param $input string
 * @return $output sanitized string
 */
function of_sanitize_textarea($input) {
    global $allowedposttags;
    $output = wp_kses($input, $allowedposttags);
    return $output;
}

add_filter('of_sanitize_textarea', 'of_sanitize_textarea');

/**
 * Sanitization for number field
 *
 * @param $input string
 * @return $output sanitized string
 */
function of_sanitize_num($input) {
    $output = intval($input);
    return $output;
}

add_filter('of_sanitize_num', 'of_sanitize_num');

/**
 * Sanitization for url field
 *
 * @param $input string
 * @return $output sanitized string
 */
function of_sanitize_url($input) {
    $output = esc_url_raw($input);
    return $output;
}

add_filter('of_sanitize_url', 'of_sanitize_url');

/**
 * Sanitization for checkbox input
 *
 * @param $input string (1 or empty) checkbox state
 * @return $output '1' or false
 */
function of_sanitize_checkbox($input) {
    if ($input) {
        $output = '1';
    } else {
        $output = false;
    }
    return $output;
}

add_filter('of_sanitize_checkbox', 'of_sanitize_checkbox');

/**
 * Sanitization for multicheck
 *
 * @param array of checkbox values
 * @return array of sanitized values ('1' or false)
 */
function of_sanitize_multicheck($input, $option) {
    $output = '';
    if (is_array($input)) {
        foreach ($option['options'] as $key => $value) {
            $output[$key] = false;
        }
        foreach ($input as $key => $value) {
            if (array_key_exists($key, $option['options']) && $value) {
                $output[$key] = '1';
            }
        }
    }
    return $output;
}

add_filter('of_sanitize_multicheck', 'of_sanitize_multicheck', 10, 2);

/**
 * File upload sanitization.
 *
 * Returns a sanitized filepath if it has a valid extension.
 *
 * @param string $input filepath
 * @returns string $output filepath
 */
function of_sanitize_upload($input) {
    $output = '';
    $filetype = wp_check_filetype($input);
    if ($filetype["ext"]) {
        $output = esc_url($input);
    }
    return $output;
}

add_filter('of_sanitize_upload', 'of_sanitize_upload');

/**
 * Sanitization for editor input.
 *
 * Returns unfiltered HTML if user has permissions.
 *
 * @param string $input
 * @returns string $output
 */
function of_sanitize_editor($input) {
    if (current_user_can('unfiltered_html')) {
        $output = $input;
    } else {
        global $allowedtags;
        $output = wpautop(wp_kses($input, $allowedtags));
    }
    return $output;
}

add_filter('of_sanitize_editor', 'of_sanitize_editor');

/**
 * Sanitization of input with allowed tags and wpautotop.
 *
 * Allows allowed tags in html input and ensures tags close properly.
 *
 * @param string $input
 * @returns string $output
 */
function of_sanitize_allowedtags($input) {
    global $allowedtags;
    $output = wpautop(wp_kses($input, $allowedtags));
    return $output;
}

/**
 * Sanitization of input with allowed post tags and wpautotop.
 *
 * Allows allowed post tags in html input and ensures tags close properly.
 *
 * @param string $input
 * @returns string $output
 */
function of_sanitize_allowedposttags($input) {
    global $allowedposttags;
    $output = wpautop(wp_kses($input, $allowedposttags));
    return $output;
}

/**
 * Validates that the $input is one of the avilable choices
 * for that specific option.
 *
 * @param string $input
 * @returns string $output
 */
function of_sanitize_enum($input, $option) {
    $output = '';
    if (array_key_exists($input, $option['options'])) {
        $output = $input;
    }
    return $output;
}

/**
 * Sanitization for background option.
 *
 * @returns array $output
 */
function of_sanitize_background($input) {

    $output = wp_parse_args($input, array(
        'image' => '',
        'repeat' => 'repeat',
        'position' => 'top center',
        'attachment' => 'scroll',
        'size' => 'cover',
            ));

    $output['image'] = apply_filters('of_sanitize_upload', $input['image']);
    $output['repeat'] = apply_filters('of_background_repeat', $input['repeat']);
    $output['position'] = apply_filters('of_background_position', $input['position']);
    $output['attachment'] = apply_filters('of_background_attachment', $input['attachment']);
    $output['size'] = apply_filters('of_background_size', $input['size']);

    return $output;
}

add_filter('of_sanitize_background', 'of_sanitize_background');

/**
 * Sanitization for background option.
 *
 * @returns array $output
 */
function of_sanitize_parallaxsection($input) {
    if (is_array($input)) {
        foreach ($input as $key => $value) {
            $output[$key] = wp_parse_args($input[$key], array(
                'page' => '',
                'header_color' => '',
                'font_color' => '',
                'color' => '',
                'image' => '',
                'layout' => '',
                'category' => '',
                'portfolio_categories' => '',
                'repeat' => 'repeat',
                'position' => 'top center',
                'attachment' => 'scroll',
                'size' => 'cover',
                'show_title' => '0',
                'show_in_menu' => '0',
                'section_height' => '1',
                'effects' => 'none',
                'overlay' => 'none'
                    ));         

            $output[$key]['page'] = esc_attr($input[$key]['page']);
            $output[$key]['header_color'] = apply_filters('of_sanitize_hex', $input[$key]['header_color']);
            $output[$key]['font_color'] = apply_filters('of_sanitize_hex', $input[$key]['font_color']);
            $output[$key]['color'] = apply_filters('of_sanitize_hex', $input[$key]['color']);
            $output[$key]['layout'] = esc_attr($input[$key]['layout']);
            $output[$key]['category'] = esc_attr($input[$key]['category']);
            $output[$key]['image'] = apply_filters('of_sanitize_upload', $input[$key]['image']);
            $output[$key]['repeat'] = apply_filters('of_background_repeat', $input[$key]['repeat']);
            $output[$key]['position'] = apply_filters('of_background_position', $input[$key]['position']);
            $output[$key]['attachment'] = apply_filters('of_background_attachment', $input[$key]['attachment']);
            $output[$key]['size'] = apply_filters('of_background_size', $input[$key]['size']);
            $output[$key]['show_title'] = apply_filters('of_sanitize_switch', $input[$key]['show_title']);
            $output[$key]['show_in_menu'] = apply_filters('of_sanitize_switch', $input[$key]['show_in_menu']);
            $output[$key]['section_height'] = apply_filters('of_sanitize_switch', $input[$key]['section_height']);
            $output[$key]['effects'] = esc_attr($input[$key]['effects']);
            $output[$key]['overlay'] = esc_attr($input[$key]['overlay']); 
        }
    }

    return $output;
}

add_filter('of_sanitize_parallaxsection', 'of_sanitize_parallaxsection');

/**
 * Sanitization for partner logo
 *
 * @returns array $output
 */
function of_sanitize_parter_logo($input) {
    if (is_array($input)) {
        foreach ($input as $key => $value) {
            $output[$key] = wp_parse_args($input[$key], array(
                'link' => '',
                'image' => '',
                    ));
            $output[$key]['link'] = apply_filters('of_sanitize_url', $input[$key]['link']);
            $output[$key]['image'] = apply_filters('of_sanitize_upload', $input[$key]['image']);
        }
    }
    return $output;
}

add_filter('of_sanitize_parter_logo', 'of_sanitize_parter_logo');

/**
 * Sanitization for background repeat
 *
 * @returns string $value if it is valid
 */
function of_sanitize_background_repeat($value) {
    $recognized = of_recognized_background_repeat();
    if (array_key_exists($value, $recognized)) {
        return $value;
    }
    return apply_filters('of_default_background_repeat', current($recognized));
}

add_filter('of_background_repeat', 'of_sanitize_background_repeat');

/**
 * Sanitization for background position
 *
 * @returns string $value if it is valid
 */
function of_sanitize_background_position($value) {
    $recognized = of_recognized_background_position();
    if (array_key_exists($value, $recognized)) {
        return $value;
    }
    return apply_filters('of_default_background_position', current($recognized));
}

add_filter('of_background_position', 'of_sanitize_background_position');

/**
 * Sanitization for background attachment
 *
 * @returns string $value if it is valid
 */
function of_sanitize_background_size($value) {
    $recognized = of_recognized_background_size();
    if (array_key_exists($value, $recognized)) {
        return $value;
    }
    return apply_filters('of_sanitize_background_size', current($recognized));
}

add_filter('of_background_size', 'of_sanitize_background_size');

/**
 * Sanitization for background attachment
 *
 * @returns string $value if it is valid
 */
function of_sanitize_background_effects($value) {
    $recognized = of_recognized_background_effects();
    if (array_key_exists($value, $recognized)) {
        return $value;
    }
    return apply_filters('of_sanitize_background_effects', current($recognized));
}

add_filter('of_background_effects', 'of_sanitize_background_effects');

/**
 * Sanitization for background attachment
 *
 * @returns string $value if it is valid
 */
function of_sanitize_background_overlay($value) {
    $recognized = of_recognized_background_overlay();
    if (array_key_exists($value, $recognized)) {
        return $value;
    }
    return apply_filters('of_sanitize_background_overlay', current($recognized));
}

add_filter('of_background_overlay', 'of_sanitize_background_overlay');

/**
 * Sanitization for background attachment
 *
 * @returns string $value if it is valid
 */
function of_sanitize_layout($value) {
    $recognized = of_recognized_layout();
    if (array_key_exists($value, $recognized)) {
        return $value;
    }
    return apply_filters('of_sanitize_layout', current($recognized));
}

add_filter('of_layout', 'of_sanitize_layout');

/**
 * Sanitization for background attachment
 *
 * @returns string $value if it is valid
 */
function of_sanitize_background_attachment($value) {
    $recognized = of_recognized_background_attachment();
    if (array_key_exists($value, $recognized)) {
        return $value;
    }
    return apply_filters('of_default_background_attachment', current($recognized));
}

add_filter('of_background_attachment', 'of_sanitize_background_attachment');

/**
 * Sanitization for typography option.
 */
function of_sanitize_typography($input, $option) {

    $output = wp_parse_args($input, array(
        'size' => '',
        'face' => '',
        'style' => '',
        'color' => ''
            ));

    if (isset($option['options']['faces']) && isset($input['face'])) {
        if (!( array_key_exists($input['face'], $option['options']['faces']) )) {
            $output['face'] = '';
        }
    } else {
        $output['face'] = apply_filters('of_font_face', $output['face']);
    }

    $output['size'] = apply_filters('of_font_size', $output['size']);
    $output['style'] = apply_filters('of_font_style', $output['style']);
    $output['color'] = apply_filters('of_sanitize_color', $output['color']);
    return $output;
}

add_filter('of_sanitize_typography', 'of_sanitize_typography', 10, 2);

/**
 * Sanitization for font size
 */
function of_sanitize_font_size($value) {
    $recognized = of_recognized_font_sizes();
    $value_check = preg_replace('/px/', '', $value);
    if (in_array((int) $value_check, $recognized)) {
        return $value;
    }
    return apply_filters('of_default_font_size', $recognized);
}

add_filter('of_font_size', 'of_sanitize_font_size');

/**
 * Sanitization for font style
 */
function of_sanitize_font_style($value) {
    $recognized = of_recognized_font_styles();
    if (array_key_exists($value, $recognized)) {
        return $value;
    }
    return apply_filters('of_default_font_style', current($recognized));
}

add_filter('of_font_style', 'of_sanitize_font_style');

/**
 * Sanitization for font face
 */
function of_sanitize_font_face($value) {
    $recognized = of_recognized_font_faces();
    if (array_key_exists($value, $recognized)) {
        return $value;
    }
    return apply_filters('of_default_font_face', current($recognized));
}

add_filter('of_font_face', 'of_sanitize_font_face');

/**
 * Get recognized background repeat settings
 *
 * @return   array
 */
function of_recognized_background_repeat() {
    $default = array(
        'no-repeat' => __('No Repeat', 'accesspress_parallax'),
        'repeat-x' => __('Repeat Horizontally', 'accesspress_parallax'),
        'repeat-y' => __('Repeat Vertically', 'accesspress_parallax'),
        'repeat' => __('Repeat All', 'accesspress_parallax'),
    );
    return apply_filters('of_recognized_background_repeat', $default);
}

/**
 * Get recognized background positions
 *
 * @return   array
 */
function of_recognized_background_position() {
    $default = array(
        'top left' => __('Top Left', 'accesspress_parallax'),
        'top center' => __('Top Center', 'accesspress_parallax'),
        'top right' => __('Top Right', 'accesspress_parallax'),
        'center left' => __('Middle Left', 'accesspress_parallax'),
        'center center' => __('Middle Center', 'accesspress_parallax'),
        'center right' => __('Middle Right', 'accesspress_parallax'),
        'bottom left' => __('Bottom Left', 'accesspress_parallax'),
        'bottom center' => __('Bottom Center', 'accesspress_parallax'),
        'bottom right' => __('Bottom Right', 'accesspress_parallax')
    );
    return apply_filters('of_recognized_background_position', $default);
}

/**
 * Get recognized background attachment
 *
 * @return   array
 */
function of_recognized_background_attachment() {
    $default = array(
        'scroll' => __('Scroll Normally', 'accesspress_parallax'),
        'fixed' => __('Fixed in Place', 'accesspress_parallax')
    );
    return apply_filters('of_recognized_background_attachment', $default);
}

/**
 * Get recognized background size
 *
 * @return   array
 */
function of_recognized_background_size() {
    $default = array(
        'auto' => __('Auto', 'accesspress_parallax'),
        'cover' => __('Cover', 'accesspress_parallax'),
        'contain' => __('Contain', 'accesspress_parallax')
    );
    return apply_filters('of_recognized_background_size', $default);
}

/**
 * Get recognized background effects
 *
 * @return   array
 */
function of_recognized_background_effects() {
    $default = array(
        'none' => __('No Effects', 'accesspress_parallax'),
        'parallax' => __('Parallax Scrolling', 'accesspress_parallax'),
        'movingbg' => __('Moving Background', 'accesspress_parallax'),
    );
    return apply_filters('of_recognized_background_effects', $default);
}

/**
 * Get recognized background size
 *
 * @return   array
 */
function of_recognized_layout() {
    $default = array(
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
    return apply_filters('of_recognized_layout', $default);
}

/**
 * Get recognized background Overlay
 *
 * @return   array
 */
function of_recognized_background_overlay() {
    $default = array(
        'none' => __('No Overlay', 'accesspress_parallax'),
        'black-dark-bg' => __('Dark Black', 'accesspress_parallax'),
        'black-light-bg' => __('Light Black', 'accesspress_parallax'),
        'white-dark-bg' => __('Dark White', 'accesspress_parallax'),
        'white-light-bg' => __('Light White', 'accesspress_parallax'),
        'overlay1' => __('Check Box', 'accesspress_parallax'),
        'overlay2' => __('Black Small Dots', 'accesspress_parallax')
    );
    return apply_filters('of_recognized_background_overlay', $default);
}

/**
 * Sanitize a color represented in hexidecimal notation.
 *
 * @param    string    Color in hexidecimal notation. "#" may or may not be prepended to the string.
 * @param    string    The value that this function should return if it cannot be recognized as a color.
 * @return   string
 */
function of_sanitize_hex($hex, $default = '') {
    if (of_validate_hex($hex)) {
        return $hex;
    }
    return $default;
}

add_filter('of_sanitize_color', 'of_sanitize_hex');

/**
 * Get recognized font sizes.
 *
 * Returns an indexed array of all recognized font sizes.
 * Values are integers and represent a range of sizes from
 * smallest to largest.
 *
 * @return   array
 */
function of_recognized_font_sizes() {
    $sizes = range(10, 80);
    $sizes = apply_filters('of_recognized_font_sizes', $sizes);
    $sizes = array_map('absint', $sizes);
    return $sizes;
}

/**
 * Get recognized font faces.
 *
 * Returns an array of all recognized font faces.
 * Keys are intended to be stored in the database
 * while values are ready for display in in html.
 *
 * @return   array
 */
function of_recognized_font_faces() {
    $accesspress_parallax_font_list = get_option('accesspress_parallax_google_font');
    foreach ($accesspress_parallax_font_list as $font_name) {
        $font_list[$font_name['family']] = $font_name['family'];
    }
    return apply_filters('of_recognized_font_faces', $font_list);
}

/**
 * Get recognized font styles.
 *
 * Returns an array of all recognized font styles.
 * Keys are intended to be stored in the database
 * while values are ready for display in in html.
 *
 * @return   array
 */
function of_recognized_font_styles() {
    $default = array(
        '100' => __('Thin', 'accesspress_parallax'),
        '200' => __('Extra Light', 'accesspress_parallax'),
        '300' => __('Light', 'accesspress_parallax'),
        '400' => __('Normal', 'accesspress_parallax'),
        '500' => __('Medium', 'accesspress_parallax'),
        '600' => __('Semi Bold', 'accesspress_parallax'),
        '700' => __('Bold', 'accesspress_parallax'),
        '800' => __('Extra Bold', 'accesspress_parallax'),
        '900' => __('Ultra Bold', 'accesspress_parallax'),
        '100italic' => __('Thin Italic', 'accesspress_parallax'),
        '300italic' => __('Light Italic', 'accesspress_parallax'),
        '400italic' => __('Normal Italic', 'accesspress_parallax'),
        '500italic' => __('Medium Italic', 'accesspress_parallax'),
        '600italic' => __('Semi Bold Italic', 'accesspress_parallax'),
        '700italic' => __('Bold Italic', 'accesspress_parallax'),
        '800italic' => __('Extra Bold Italic', 'accesspress_parallax'),
        '900italic' => __('Ultra Bold Italic', 'accesspress_parallax'),
    );
    return apply_filters('of_recognized_font_styles', $default);
}
/**
 * Is a given string a color formatted in hexidecimal notation?
 *
 * @param    string    Color in hexidecimal notation. "#" may or may not be prepended to the string.
 * @return   bool
 */
function of_validate_hex($hex) {
    $hex = trim($hex);
    /* Strip recognized prefixes. */
    if (0 === strpos($hex, '#')) {
        $hex = substr($hex, 1);
    } elseif (0 === strpos($hex, '%23')) {
        $hex = substr($hex, 3);
    }
    /* Regex match. */
    if (0 === preg_match('/^[0-9a-fA-F]{6}$/', $hex)) {
        return false;
    } else {
        return true;
    }
}