<?php

class Options_Framework_Interface {

    /**
     * Generates the tabs that are used in the options menu
     */
    static function optionsframework_tabs() {
        $counter = 0;
        $options = & Options_Framework::_optionsframework_options();
        $menu = '';

        foreach ($options as $value) {

            // Heading for Navigation
            if ($value['type'] == "heading") {
                $counter++;
                $class = '';
                $class = !empty($value['id']) ? $value['id'] : $value['name'];
                $class = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower($class)) . '-tab';
                $menu_icon = !empty($value['icon']) ? $value['icon'] : 'fa fa-cog';
                $menu .= '<a id="options-group-' . $counter . '-tab" class="nav-tab ' . $class . '" title="' . esc_attr($value['name']) . '" href="' . esc_attr('#options-group-' . $counter) . '"><i class="'.esc_attr($menu_icon).'"></i>' . esc_html($value['name']) . '</a>';
            }
        }

        return $menu;
    }

    /**
     * Generates the options fields that are used in the form.
     */
    static function optionsframework_fields() {

        global $allowedtags;
        $add_allowedtags1 = array( 'a' => array(
            'href' => true,
            'title' => true,
            'target' => true,
            ));
        $add_allowedtags2 = array(
            'br' => true
            );
        $allowedtags = array_replace($allowedtags, $add_allowedtags1, $add_allowedtags2);
        $optionsframework_settings = get_option('optionsframework');

        // Gets the unique option id
        if (isset($optionsframework_settings['id'])) {
            $option_name = $optionsframework_settings['id'];
        } else {
            $option_name = 'optionsframework';
        };

        $settings = get_option($option_name);

        $options = & Options_Framework::_optionsframework_options();

        $counter = 0;
        $menu = '';

        foreach ($options as $value) {

            $val = '';
            $select_value = '';
            $output = '';

            // Wrap all options
            if (( $value['type'] != "heading" ) && ( $value['type'] != "info" )) {

                // Keep all ids lowercase with no spaces
                $value['id'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower($value['id']));

                $id = 'section-' . $value['id'];

                $class = 'section';
                if (isset($value['type'])) {
                    $class .= ' section-' . $value['type'];
                }
                if (isset($value['class'])) {
                    $class .= ' ' . $value['class'];
                }

                $output .= '<div id="' . esc_attr($id) . '" class="' . esc_attr($class) . '">' . "\n";
                if (isset($value['name'])) {
                    $output .= '<h4 class="heading">' . esc_html($value['name']) . '</h4>' . "\n";
                }
                if ($value['type'] != 'editor') {
                    $output .= '<div class="option">' . "\n" . '<div class="controls">' . "\n";
                } else {
                    $output .= '<div class="option">' . "\n" . '<div>' . "\n";
                }
            }

            // Set default value to $val
            if (isset($value['std'])) {
                $val = $value['std'];
            }

            // If the option is already saved, override $val
            if (( $value['type'] != 'heading' ) && ( $value['type'] != 'info')) {
                if (isset($settings[($value['id'])])) {
                    $val = $settings[($value['id'])];
                    // Striping slashes of non-array options
                    if (!is_array($val)) {
                        $val = stripslashes($val);
                    }
                }
            }

            // If there is a description save it for labels
            $explain_value = '';
            if (isset($value['desc'])) {
                $explain_value = $value['desc'];
            }

            // Set the placeholder if one exists
            $placeholder = '';
            if (isset($value['placeholder'])) {
                $placeholder = ' placeholder="' . esc_attr($value['placeholder']) . '"';
            }

            if (has_filter('optionsframework_' . $value['type'])) {
                $output .= apply_filters('optionsframework_' . $value['type'], $option_name, $value, $val);
            }


            switch ($value['type']) {

                // Basic text input
                case 'text':
                    $output .= '<input id="' . esc_attr($value['id']) . '" class="of-input" name="' . esc_attr($option_name . '[' . $value['id'] . ']') . '" type="text" value="' . esc_attr($val) . '"' . $placeholder . ' />';
                    break;

                // Basic text input
                case 'hidden':
                    $output .= '<input id="' . esc_attr($value['id']) . '" class="of-input" name="' . esc_attr($option_name . '[' . $value['id'] . ']') . '" type="hidden" value="' . esc_attr($val) . '"' . $placeholder . ' />';
                    break;

                case 'num':
                    $output .= '<div class="addon-input">';
                    $output .= '<input id="' . esc_attr($value['id']) . '" class="of-input" name="' . esc_attr($option_name . '[' . $value['id'] . ']') . '" type="text" value="' . esc_attr($val) . '"' . $placeholder . ' />';
                    $output .= '<span class="addon-text">' . esc_attr($value['addontext']) . '</span>';
                    $output .= '</div>';
                    break;

                // Basic text input
                case 'url':
                    $output .= '<input id="' . esc_attr($value['id']) . '" class="of-input" name="' . esc_attr($option_name . '[' . $value['id'] . ']') . '" type="text" value="' . esc_url($val) . '"' . $placeholder . ' />';
                    break;

                // Password input
                case 'password':
                    $output .= '<input id="' . esc_attr($value['id']) . '" class="of-input" name="' . esc_attr($option_name . '[' . $value['id'] . ']') . '" type="password" value="' . esc_attr($val) . '" />';
                    break;

                // Textarea
                case 'textarea':
                    $rows = '14';

                    if (isset($value['rows'])) {
                        $custom_rows = $value['rows'];
                        if (is_numeric($custom_rows)) {
                            $rows = $custom_rows;
                        }
                    }

                    $val = stripslashes($val);
                    $output .= '<textarea id="' . esc_attr($value['id']) . '" class="of-input" name="' . esc_attr($option_name . '[' . $value['id'] . ']') . '" rows="' . $rows . '"' . $placeholder . '>' . esc_textarea($val) . '</textarea>';
                    break;

                // Select Box
                case 'select':
                    $output .= '<select class="of-input" name="' . esc_attr($option_name . '[' . $value['id'] . ']') . '" id="' . esc_attr($value['id']) . '">';

                    foreach ($value['options'] as $key => $option) {
                        $output .= '<option' . selected($val, $key, false) . ' value="' . esc_attr($key) . '">' . esc_html($option) . '</option>';
                    }
                    $output .= '</select>';
                    break;


                // Radio Box
                case "radio":
                    $name = $option_name . '[' . $value['id'] . ']';
                    foreach ($value['options'] as $key => $option) {
                        $id = $option_name . '-' . $value['id'] . '-' . $key;
                        $output .= '<div class="radio"><input class="of-input of-radio" type="radio" name="' . esc_attr($name) . '" id="' . esc_attr($id) . '" value="' . esc_attr($key) . '" ' . checked($val, $key, false) . ' /><label for="' . esc_attr($id) . '">' . esc_html($option) . '</label></div>';
                    }
                    break;

                // Image Selectors
                case "images":
                    $name = $option_name . '[' . $value['id'] . ']';
                    foreach ($value['options'] as $key => $option) {
                        $selected = '';
                        if ($val != '' && ($val == $key)) {
                            $selected = ' of-radio-img-selected';
                        }
                        $output .= '<input type="radio" id="' . esc_attr($value['id'] . '_' . $key) . '" class="of-radio-img-radio" value="' . esc_attr($key) . '" name="' . esc_attr($name) . '" ' . checked($val, $key, false) . ' />';
                        $output .= '<div class="of-radio-img-label">' . esc_html($key) . '</div>';
                        $output .= '<img src="' . esc_url($option) . '" alt="' . $option . '" class="of-radio-img-img' . $selected . '" onclick="document.getElementById(\'' . esc_attr($value['id'] . '_' . $key) . '\').checked=true;" />';
                    }
                    break;

                // Checkbox
                case "checkbox":
                    $output .= '<div class=toggle data-checkbox=checkme></div><input id="' . esc_attr($value['id']) . '" class="checkbox of-input" type="checkbox" name="' . esc_attr($option_name . '[' . $value['id'] . ']') . '" ' . checked($val, 1, false) . ' />';
                    $output .= '<label class="explain" for="' . esc_attr($value['id']) . '">' . wp_kses($explain_value, $allowedtags) . '</label>';
                    break;

                // Switch
                case "switch":
                    $output .= '<div class="switch_options">';
                    $output .= '<span class="switch_enable">' . esc_attr($value['on']) . '</span>';
                    $output .= '<span class="switch_disable">' . esc_attr($value['off']) . '</span>';
                    $output .= '<input id="' . esc_attr($value['id']) . '" type="hidden" class="switch_val" name="' . esc_attr($option_name . '[' . $value['id'] . ']') . '" value="' . esc_attr($val) . '"/>';
                    $output .= '</div>';
                    break;

                // SliderUI
                case "sliderui":
                    $s_min = $s_max = $s_step = $s_edit = '';
                    $s_edit = ' readonly="readonly"';

                    if (!isset($value['min'])) {
                        $s_min = '0';
                    } else {
                        $s_min = $value['min'];
                    }
                    if (!isset($value['max'])) {
                        $s_max = $s_min + 1;
                    } else {
                        $s_max = $value['max'];
                    }
                    if (!isset($value['step'])) {
                        $s_step = '1';
                    } else {
                        $s_step = $value['step'];
                    }


                    //values
                    $s_data = 'data-id="' . $value['id'] . '" data-val="' . esc_attr($val) . '" data-min="' . $s_min . '" data-max="' . $s_max . '" data-step="' . $s_step . '"';

                    //html output
                    $output .= '<input type="text" name="' . esc_attr($option_name . '[' . $value['id'] . ']') . '" id="' . esc_attr($value['id']) . '" value="' . esc_attr($val) . '" ' . $s_edit . ' />';
                    $output .= '<div id="' . $value['id'] . '-slider" class="ap_sliderui" ' . $s_data . '></div>';

                    break;

                // Multicheck
                case "multicheck":
                    foreach ($value['options'] as $key => $option) {
                        $checked = '';
                        $label = $option;
                        $option = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower($key));

                        $id = $option_name . '-' . $value['id'] . '-' . $option;
                        $name = $option_name . '[' . $value['id'] . '][' . $option . ']';

                        if (isset($val[$option])) {
                            $checked = checked($val[$option], 1, false);
                        }

                        $output .= '<input id="' . esc_attr($id) . '" class="checkbox of-input" type="checkbox" name="' . esc_attr($name) . '" ' . $checked . ' /><label for="' . esc_attr($id) . '">' . esc_html($label) . '</label>';
                    }
                    break;

                // Color picker
                case "color":
                    $default_color = '';
                    if (isset($value['std'])) {
                        if ($val != $value['std'])
                            $default_color = ' data-default-color="' . $value['std'] . '" ';
                    }
                    $output .= '<input name="' . esc_attr($option_name . '[' . $value['id'] . ']') . '" id="' . esc_attr($value['id']) . '" class="of-color"  type="text" value="' . esc_attr($val) . '"' . $default_color . ' />';

                    break;

                // Uploader
                case "upload":
                    $output .= Options_Framework_Media_Uploader::optionsframework_uploader($value['id'], $val, null);

                    break;

                // Uploader
                case "parter_logo":
                    $i = 0;
                    if (!empty($settings['partner_logo'])):
                        foreach ($settings['partner_logo'] as $key => $ival) {
                            $i++;
                            $link = $val[$key]['link'];
                            $image = $val[$key]['image'];
                            $output .= '<div class="associate-logo sub-option clearfix">';
                            $output .= '<input class="of-input partner-link-input" name="' . esc_attr($option_name . '[' . $value['id'] . '][' . $i . '][link]') . '" type="text" value="' . esc_url($link) . '"' . $placeholder . ' />';
                            $output .= Options_Framework_Media_Uploader::optionsframework_uploader($value['id'], $image, null, esc_attr($option_name . '[' . $value['id'] . '][' . $i . '][image]'));
                            $output .= '<div class="logo-remove">×</div></div>';
                        }
                    endif;
                    $output .= '<div class="logo-wrap"></div>';
                    $output .= '<div class="button-primary" id="add-logo">'. __('Add Logo','accesspress_parallax') .'</div>';
                    $output .= '<input id="logo-count" type="hidden" value="' . $i . '"/>';
                    break;

                // Typography
                case 'typography':

                    unset($font_size, $font_style, $font_face, $font_color);

                    $typography_defaults = array(
                        'size' => '',
                        'face' => '',
                        'style' => '',
                        'color' => ''
                    );

                    $typography_stored = wp_parse_args($val, $typography_defaults);

                    $accesspress_parallax_font_list = get_option('accesspress_parallax_google_font');
                    $font_family = $typography_stored['face'];
                    $font_array = accesspress_search_key($accesspress_parallax_font_list,'family', $font_family);
                    $variants_array = $font_array['0']['variants'] ;


                    $typography_options = array(
                        'sizes' => of_recognized_font_sizes(),
                        'faces' => of_recognized_font_faces(),
                        'styles' => $variants_array,
                        'color' => true
                    );

                    if (isset($value['options'])) {
                        $typography_options = wp_parse_args($value['options'], $typography_options);
                    }

                    // Font Size
                    if ($typography_options['sizes']) {
                        $font_size = '<select class="of-typography of-typography-size" name="' . esc_attr($option_name . '[' . $value['id'] . '][size]') . '" id="' . esc_attr($value['id'] . '_size') . '">';
                        $sizes = $typography_options['sizes'];
                        foreach ($sizes as $i) {
                            $size = $i . 'px';
                            $font_size .= '<option value="' . esc_attr($size) . '" ' . selected($typography_stored['size'], $size, false) . '>' . esc_html($size) . '</option>';
                        }
                        $font_size .= '</select>';
                    }

                    // Font Face
                    if ($typography_options['faces']) {
                        $font_face = '<select class="of-typography of-typography-face" name="' . esc_attr($option_name . '[' . $value['id'] . '][face]') . '" id="' . esc_attr($value['id'] . '_face') . '">';
                        $faces = $typography_options['faces'];
                        foreach ($faces as $key => $face) {
                            $font_face .= '<option value="' . esc_attr($key) . '" ' . selected($typography_stored['face'], $key, false) . '>' . esc_html($face) . '</option>';
                        }
                        $font_face .= '</select>';
                    }

                    // Font Styles
                    if ($typography_options['styles']) {
                        $font_style = '<select class="of-typography of-typography-style" name="' . $option_name . '[' . $value['id'] . '][style]" id="' . $value['id'] . '_style">';
                        $styles = $typography_options['styles'];
                        foreach ($styles as $key => $style) {
                            $font_style .= '<option value="' . esc_attr($key) . '" ' . selected($typography_stored['style'], $key, false) . '>' . $style . '</option>';
                        }
                        $font_style .= '</select>';
                    }

                    // Font Color
                    if ($typography_options['color']) {
                        $default_color = '';
                        if (isset($value['std']['color'])) {
                            if ($val != $value['std']['color'])
                                $default_color = ' data-default-color="' . $value['std']['color'] . '" ';
                        }
                        $font_color = '<input name="' . esc_attr($option_name . '[' . $value['id'] . '][color]') . '" id="' . esc_attr($value['id'] . '_color') . '" class="of-color of-typography-color"  type="text" value="' . esc_attr($typography_stored['color']) . '"' . $default_color . ' />';
                    }

                    // Allow modification/injection of typography fields
                    $typography_fields = compact('font_size', 'font_face', 'font_style', 'font_color');
                    $typography_fields = apply_filters('of_typography_fields', $typography_fields, $typography_stored, $option_name, $value);
                    $output .= implode('', $typography_fields);
                    $output .= '<div class="typographytextbox" id="' . $value['id'] . '">The Quick Brown Fox Jumps Over The Lazy Dog. 1234567890</div>';
                    break;

                // Background
                case 'background':

                    $background = $val;

                    // Background Image
                    if (!isset($background['image'])) {
                        $background['image'] = '';
                    }

                    $output .= Options_Framework_Media_Uploader::optionsframework_uploader($value['id'], $background['image'], null, esc_attr($option_name . '[' . $value['id'] . '][image]'));

                    $class = 'of-background-properties';
                    if ('' == $background['image']) {
                        $class .= ' hide';
                    }
                    $output .= '<div class="' . esc_attr($class) . '">';

                    // Background Repeat
                    $output .= '<select class="of-background of-background-repeat" name="' . esc_attr($option_name . '[' . $value['id'] . '][repeat]') . '" id="' . esc_attr($value['id'] . '_repeat') . '">';
                    $repeats = of_recognized_background_repeat();

                    foreach ($repeats as $key => $repeat) {
                        $output .= '<option value="' . esc_attr($key) . '" ' . selected($background['repeat'], $key, false) . '>' . esc_html($repeat) . '</option>';
                    }
                    $output .= '</select>';

                    // Background Position
                    $output .= '<select class="of-background of-background-position" name="' . esc_attr($option_name . '[' . $value['id'] . '][position]') . '" id="' . esc_attr($value['id'] . '_position') . '">';
                    $positions = of_recognized_background_position();

                    foreach ($positions as $key => $position) {
                        $output .= '<option value="' . esc_attr($key) . '" ' . selected($background['position'], $key, false) . '>' . esc_html($position) . '</option>';
                    }
                    $output .= '</select>';

                    // Background Attachment
                    $output .= '<select class="of-background of-background-attachment" name="' . esc_attr($option_name . '[' . $value['id'] . '][attachment]') . '" id="' . esc_attr($value['id'] . '_attachment') . '">';
                    $attachments = of_recognized_background_attachment();

                    foreach ($attachments as $key => $attachment) {
                        $output .= '<option value="' . esc_attr($key) . '" ' . selected($background['attachment'], $key, false) . '>' . esc_html($attachment) . '</option>';
                    }
                    $output .= '</select>';

                    // Background Size
                    $output .= '<select class="of-background of-background-size" name="' . esc_attr($option_name . '[' . $value['id'] . '][size]') . '" id="' . esc_attr($value['id'] . '_size') . '">';
                    $sizes = of_recognized_background_size();

                    foreach ($sizes as $key => $size) {
                        $output .= '<option value="' . esc_attr($key) . '" ' . selected($background['size'], $key, false) . '>' . esc_html($size) . '</option>';
                    }
                    $output .= '</select>';
                    $output .= '</div>';

                    break;

                // Editor
                case 'editor':
                    $output .= '<div class="explain">' . wp_kses($explain_value, $allowedtags) . '</div>' . "\n";
                    echo $output;
                    $textarea_name = esc_attr($option_name . '[' . $value['id'] . ']');
                    $default_editor_settings = array(
                        'textarea_name' => $textarea_name,
                        'media_buttons' => false,
                        'tinymce' => array('plugins' => 'wordpress')
                    );
                    $editor_settings = array();
                    if (isset($value['settings'])) {
                        $editor_settings = $value['settings'];
                    }
                    $editor_settings = array_merge($default_editor_settings, $editor_settings);
                    wp_editor($val, $value['id'], $editor_settings);
                    $output = '';
                    break;

                // Info
                case "info":
                    $id = '';
                    $class = 'section';
                    if (isset($value['id'])) {
                        $id = 'id="' . esc_attr($value['id']) . '" ';
                    }
                    if (isset($value['type'])) {
                        $class .= ' section-' . $value['type'];
                    }
                    if (isset($value['class'])) {
                        $class .= ' ' . $value['class'];
                    }

                    $output .= '<div ' . $id . 'class="' . esc_attr($class) . '">' . "\n";
                    if (isset($value['name'])) {
                        $output .= '<h4 class="heading">' . esc_html($value['name']) . '</h4>' . "\n";
                    }
                    $output .='<div class="option">';
                    if (isset($value['desc'])) {
                        $output .= $value['desc'] . "\n";
                    }
                    $output .= '</div></div>' . "\n";
                    break;

                // Heading for Navigation
                case "heading":
                    $counter++;
                    if ($counter >= 2) {
                        $output .= '</div>' . "\n";
                    }
                    $class = '';
                    $class = !empty($value['id']) ? $value['id'] : $value['name'];
                    $class = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower($class));
                    $output .= '<div id="options-group-' . $counter . '" class="group ' . $class . '">';
                    $output .= '<h3>' . esc_html($value['name']) . '</h3>' . "\n";
                    break;

                // Background
                case 'parallaxsection':
                    $parallaxsection_array = array();
                    if (!empty($settings['parallax_section'])) {
                        foreach ($settings['parallax_section'] as $i => $ival) {
                            $parallaxsection_array[] = $i;
                            $parallaxsection = $val;
                            $output .='<div class="sub-option clearifx"><h3 class="title">' . __('Page Title:','accesspress_parallax') . '<span></span><div class="section-toggle"><i class="fa fa-chevron-down"></i></div></h3>';
                            $output .='<div class="sub-option-inner" style="display:none">';
                            $output .='<div class="inline-label">';
                            $output .='<label>' . __('Page','accesspress_parallax') . '</label>';
                            $output .= '<select class="of-input ' . esc_attr($value['id'] . '_page') . '" name="' . esc_attr($option_name . '[' . $value['id'] . '][' . $i . '][page]') . '">';

                            foreach ($value['options'] as $key => $option) {
                                $output .= '<option' . selected($parallaxsection[$i]['page'], $key, false) . ' value="' . esc_attr($key) . '">' . esc_html($option) . '</option>';
                            }
                            $output .= '</select>';
                            $output .='</div>';

                            // Section Layout
                            $output .='<div class="inline-label">';
                            $output .='<label class=""> ' . __('Layout','accesspress_parallax') . '</label>';
                            $output .= '<select class="of-section of-section-layout parallax_section_layout" name="' . esc_attr($option_name . '[' . $value['id'] . '][' . $i . '][layout]') . '">';
                            $layouts = of_recognized_layout();

                            foreach ($layouts as $key => $layout) {
                                $output .= '<option value="' . esc_attr($key) . '" ' . selected($parallaxsection[$i]['layout'], $key, false) . '>' . esc_html($layout) . '</option>';
                            }
                            $output .= '</select>';
                            $output .='</div>';

                            $output .='<div class="inline-label toggle-category">';
                            $output .='<label class=""> ' . __('Category','accesspress_parallax') . '</label>';
                            $output .= '<select class="of-input" name="' . esc_attr($option_name . '[' . $value['id'] . '][' . $i . '][category]') . '" id="' . esc_attr($value['id'] . '_category') . '">';

                            // Section Category
                            foreach ($value['category'] as $key => $category) {
                                $output .= '<option' . selected($parallaxsection[$i]['category'], $key, false) . ' value="' . esc_attr($key) . '">' . esc_html($category) . '</option>';
                            }
                            $output .= '</select>';
                            $output .='</div>';

                            /**
                             * section portfolio category
                             * @since 4.0.0
                             */
                            if( ! isset( $value['portfolio_categories'] ) ) {
                                $key = '';
                            }
                            $output .='<div class="inline-label toggle-portfolio-categories">';
                            $output .='<label class=""> ' . __('Portfolio Categories','accesspress_parallax') . '</label>';
                            $output .= '<select class="of-input" name="' . esc_attr($option_name . '[' . $value['id'] . '][' . $i . '][portfolio_categories]') . '" id="' . esc_attr($value['id'] . '_portfolio_categories') . '">';

                            foreach ($value['portfolio_categories'] as $key => $category) {
                                $output .= '<option' . selected($parallaxsection[$i]['portfolio_categories'], $key, false) . ' value="' . esc_attr($key) . '">' . esc_html($category) . '</option>';
                            }
                            $output .= '</select>';
                            $output .='</div>';

                            // Page Title switch
                            $output .='<div class="inline-label">';
                            $output .='<label>' . __('Page Title','accesspress_parallax') . '</label>';
                            $output .= '<div class="switch_options">';
                            $output .= '<span class="switch_enable">' . __('Show','accesspress_parallax') . '</span>';
                            $output .= '<span class="switch_disable">' . __('Hide','accesspress_parallax') . '</span>';
                            $output .= '<input type="hidden" class="switch_val" name="' . esc_attr($option_name . '[' . $value['id'] . '][' . $i . '][show_title]') . '" value="' . esc_attr($parallaxsection[$i]['show_title']) . '"/>';
                            $output .= '</div>';
                            $output .='</div>';

                            // Display in menu switch
                            $output .='<div class="inline-label">';
                            $output .='<label>' . __('Display in Menu','accesspress_parallax') . '</label>';
                            $output .= '<div class="switch_options">';
                            $output .= '<span class="switch_enable">' . __('Show','accesspress_parallax') . '</span>';
                            $output .= '<span class="switch_disable">' . __('Hide','accesspress_parallax') . '</span>';
                            $output .= '<input type="hidden" class="switch_val" name="' . esc_attr($option_name . '[' . $value['id'] . '][' . $i . '][show_in_menu]') . '" value="' . esc_attr($parallaxsection[$i]['show_in_menu']) . '"/>';
                            $output .= '</div>';
                            $output .='</div>';

                            /**
                             * Section height
                             * @since 4.0.0
                             */
                            if( isset( $parallaxsection[$i]['section_height'] ) ) {
                                $section_height = $parallaxsection[$i]['section_height'];
                            } else {
                                $section_height = '1';
                            }
                            
                            $output .='<div class="inline-label">';
                            $output .='<label>' . __('Section Height','accesspress_parallax') . '</label>';
                            $output .= '<div class="switch_options">';
                            $output .= '<span class="switch_enable">' . __('Default','accesspress_parallax') . '</span>';
                            $output .= '<span class="switch_disable">' . __('Expand','accesspress_parallax') . '</span>';
                            $output .= '<input type="hidden" class="switch_val" name="' . esc_attr($option_name . '[' . $value['id'] . '][' . $i . '][section_height]') . '" value="' . esc_attr( $section_height ) . '"/>';
                            $output .= '</div>';
                            $output .='</div>';

                            // Heading Text Color
                            $output .='<div class="color-picker inline-label">';
                            $output .='<label class="">' . __('Heading Text Color','accesspress_parallax') . '</label>';
                            $output .= '<input name="' . esc_attr($option_name . '[' . $value['id'] . '][' . $i . '][header_color]') . '" id="' . esc_attr($value['id'] . '_header_color') . '" class="of-color of-background-color"  type="text" value="' . esc_attr($parallaxsection[$i]['header_color']) . '" />';
                            $output .='</div>';

                            // Font Color
                            $output .='<div class="color-picker inline-label">';
                            $output .='<label class="">' . __('Text Color','accesspress_parallax') . '</label>';
                            $output .= '<input name="' . esc_attr($option_name . '[' . $value['id'] . '][' . $i . '][font_color]') . '" id="' . esc_attr($value['id'] . '_font_color') . '" class="of-color of-background-color"  type="text" value="' . esc_attr($parallaxsection[$i]['font_color']) . '" />';
                            $output .='</div>';

                            // Background Color
                            $output .='<div class="color-picker inline-label">';
                            $output .='<label class="">' . __('Background Color','accesspress_parallax') . '</label>';
                            $output .= '<input name="' . esc_attr($option_name . '[' . $value['id'] . '][' . $i . '][color]') . '" id="' . esc_attr($value['id'] . '_color') . '" class="of-color of-background-color"  type="text" value="' . esc_attr($parallaxsection[$i]['color']) . '" />';
                            $output .='</div>';

                            // Background Image
                            if (!isset($parallaxsection[$i]['image'])) {
                                $parallaxsection[$i]['image'] = '';
                            }

                            $output .='<div class="inline-label">';
                            $output .='<label class="">' . __('Background Image','accesspress_parallax') . '</label>';
                            $output .= Options_Framework_Media_Uploader::optionsframework_uploader($value['id'], $parallaxsection[$i]['image'], null, esc_attr($option_name . '[' . $value['id'] . '][' . $i . '][image]'));
                            $output .='</div>';

                            $class = 'of-background-properties';
                            if ('' == $parallaxsection[$i]['image']) {
                                $class .= ' hide';
                            }
                            $output .= '<div class="' . esc_attr($class) . '">';

                            // Background Overlay
                            $output .='<div class="color-picker inline-label">';
                            $output .='<label class="">' . __('Background Overlay','accesspress_parallax') . '</label>';
                            $output .= '<select class="of-background of-background-overlay" name="' . esc_attr($option_name . '[' . $value['id'] . '][' . $i . '][overlay]') . '" id="' . esc_attr($value['id'] . '_overlay') . '">';
                            $overlays = of_recognized_background_overlay();

                            foreach ($overlays as $key => $overlay) {
                                $output .= '<option value="' . esc_attr($key) . '" ' . selected($parallaxsection[$i]['overlay'], $key, false) . '>' . esc_html($overlay) . '</option>';
                            }
                            $output .= '</select>';
                            $output .= '</div>';

                            // Background Settings
                            $output .= '<div class="inline-label"><label class="">' . __('Background Settings','accesspress_parallax') . '</label>';

                            // Background Repeat
                            $output .= '<div class="background-settings">';
                            $output .= '<div class="clearfix">';
                            $output .= '<select class="of-background of-background-repeat" name="' . esc_attr($option_name . '[' . $value['id'] . '][' . $i . '][repeat]') . '" id="' . esc_attr($value['id'] . '_repeat') . '">';
                            $repeats = of_recognized_background_repeat();

                            foreach ($repeats as $key => $repeat) {
                                $output .= '<option value="' . esc_attr($key) . '" ' . selected($parallaxsection[$i]['repeat'], $key, false) . '>' . esc_html($repeat) . '</option>';
                            }
                            $output .= '</select>';

                            // Background Position
                            $output .= '<select class="of-background of-background-position" name="' . esc_attr($option_name . '[' . $value['id'] . '][' . $i . '][position]') . '" id="' . esc_attr($value['id'] . '_position') . '">';
                            $positions = of_recognized_background_position();

                            foreach ($positions as $key => $position) {
                                $output .= '<option value="' . esc_attr($key) . '" ' . selected($parallaxsection[$i]['position'], $key, false) . '>' . esc_html($position) . '</option>';
                            }
                            $output .= '</select>';

                            // Background Attachment
                            $output .= '<select class="of-background of-background-attachment" name="' . esc_attr($option_name . '[' . $value['id'] . '][' . $i . '][attachment]') . '" id="' . esc_attr($value['id'] . '_attachment') . '">';
                            $attachments = of_recognized_background_attachment();

                            foreach ($attachments as $key => $attachment) {
                                $output .= '<option value="' . esc_attr($key) . '" ' . selected($parallaxsection[$i]['attachment'], $key, false) . '>' . esc_html($attachment) . '</option>';
                            }
                            $output .= '</select>';

                            // Background Size
                            $output .= '<select class="of-background of-background-size" name="' . esc_attr($option_name . '[' . $value['id'] . '][' . $i . '][size]') . '" id="' . esc_attr($value['id'] . '_size') . '">';
                            $sizes = of_recognized_background_size();

                            foreach ($sizes as $key => $size) {
                                $output .= '<option value="' . esc_attr($key) . '" ' . selected($parallaxsection[$i]['size'], $key, false) . '>' . esc_html($size) . '</option>';
                            }
                            $output .= '</select>';
                            $output .= '</div></div></div>';

                            // Parallax Effect
                            $output .= '<div class="inline-label parallax-effects"><label class="">'. __('Parallax Effects','accesspress_parallax') .'</label>';
                            $effects = of_recognized_background_effects();
                            
                            foreach ($effects as $key => $option) {
                                $id = $value['id'] . '-' . $key. $i;
                                $output .= '<div class="radio"><input class="of-input of-radio" type="radio" name="' . esc_attr($option_name . '[' . $value['id'] . '][' . $i . '][effects]') . '" id="' . esc_attr($id) . '" value="' . esc_attr($key) . '" ' . checked($parallaxsection[$i]['effects'], $key, false) . ' /><label for="' . esc_attr($id) . '">' . esc_html($option) . '</label></div>';
                            }

                            $output .= '</div>';

                            $output .= '</div>';

                            $output .= '<div class="button-primary remove-parallax">' . __('Remove','accesspress_parallax') . '</div></div>';
                            $output .= '</div>';
                        }
                    }
                    update_option('accesspress_parallax_count', $parallaxsection_array);

                    break;

                // Button
                case "button":
                    $output .= '<a id="' . esc_attr($value['id']) . '" class="button-primary" href="javascript:void(0);">'. esc_attr($value['button_name']).'</a>' . "\n";
                    if(!empty($value['html'])){
                    $output .= wp_kses_post($value['html']);
                    }
                    break;
                    
            }


            if (( $value['type'] != "heading" ) && ( $value['type'] != "info" )) {
                $output .= '</div>';
                if (( $value['type'] != "checkbox" ) && ( $value['type'] != "editor" ) && ( $value['type'] != "parallaxsection" )) {
                    $output .= '<div class="explain">' . wp_kses($explain_value, $allowedtags) . '</div>' . "\n";
                }
                $output .= '</div></div>' . "\n";
            }

            echo $output;
        }

        // Outputs closing div if there tabs
        if (Options_Framework_Interface::optionsframework_tabs() != '') {
            echo '</div>';
        }
    }

}