<?php
/**
 * Social Icons widget
 *
 * @package Accesspress Parallax
 */

add_action('widgets_init', 'register_social_icon_widget');

function register_social_icon_widget(){
    register_widget( 'accesspress_social_icons' );
}

class Accesspress_Social_Icons extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
                'accesspress_social_icons', 
                'AP : Social Icons', 
                array(
                'description' => __('Display links to your social network profiles, enter full profile URLs', 'accesspress_parallax')
                )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $fields = array(
            // Title
            'widget_title' => array(
                'accesspress_parallax_widgets_name' => 'widget_title',
                'accesspress_parallax_widgets_title' => __('Title', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'text'
            ),
            // Other fields
            'twitter' => array(
                'accesspress_parallax_widgets_name' => 'twitter-square',
                'accesspress_parallax_widgets_title' => __('Twitter', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'text'
            ),
            'facebook' => array(
                'accesspress_parallax_widgets_name' => 'facebook-square',
                'accesspress_parallax_widgets_title' => __('Facebook', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'text'
            ),
            'linkedin' => array(
                'accesspress_parallax_widgets_name' => 'linkedin-square',
                'accesspress_parallax_widgets_title' => __('LinkedIn', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'text'
            ),
            'gplus' => array(
                'accesspress_parallax_widgets_name' => 'google-plus-square',
                'accesspress_parallax_widgets_title' => __('Google+', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'text'
            ),
            'pinterest' => array(
                'accesspress_parallax_widgets_name' => 'pinterest-square',
                'accesspress_parallax_widgets_title' => __('Pinterest', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'text'
            ),
            'youtube' => array(
                'accesspress_parallax_widgets_name' => 'youtube-square',
                'accesspress_parallax_widgets_title' => __('YouTube', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'text'
            ),
            'vimeo' => array(
                'accesspress_parallax_widgets_name' => 'vimeo-square',
                'accesspress_parallax_widgets_title' => __('Vimeo', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'text'
            ),
            'flickr' => array(
                'accesspress_parallax_widgets_name' => 'flickr',
                'accesspress_parallax_widgets_title' => __('Flickr', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'text'
            ),
            'dribbble' => array(
                'accesspress_parallax_widgets_name' => 'dribbble',
                'accesspress_parallax_widgets_title' => __('Dribbble', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'text'
            ),
            'dribbble' => array(
                'accesspress_parallax_widgets_name' => 'stumbleupon',
                'accesspress_parallax_widgets_title' => __('Stumbleupon', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'text'
            ),
            'tumblr' => array(
                'accesspress_parallax_widgets_name' => 'tumblr-square',
                'accesspress_parallax_widgets_title' => __('Tumblr', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'text'
            ),
            'instagram' => array(
                'accesspress_parallax_widgets_name' => 'instagram',
                'accesspress_parallax_widgets_title' => __('Instagram', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'text'
            ),
            'lastfm' => array(
                'accesspress_parallax_widgets_name' => 'skype',
                'accesspress_parallax_widgets_title' => __('Skype', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'text'
            ),
            'soundcloud' => array(
                'accesspress_parallax_widgets_name' => 'soundcloud',
                'accesspress_parallax_widgets_title' => __('SoundCloud', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'text'
            ),
        );

        return $fields;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
        extract($args);

        $widget_title = apply_filters('widget_title', $instance['widget_title']);

        echo $before_widget;

        // Show title
        if (isset($widget_title)) {
            echo $before_title . $widget_title . $after_title;
        }

        echo '<ul class="clearfix widget-social-icons">';
        // Loop through fields
        $widget_fields = $this->widget_fields();
        foreach ($widget_fields as $widget_field) {
            // Make array elements available as variables
            extract($widget_field);
            // Check if field has value and skip title field
            unset($accesspress_parallax_widgets_field_value);
            if (isset($instance[$accesspress_parallax_widgets_name]) && 'widget_title' != $accesspress_parallax_widgets_name) {
                $accesspress_parallax_widgets_field_value = esc_attr($instance[$accesspress_parallax_widgets_name]);
                if ('' != $accesspress_parallax_widgets_field_value) {
                    ?>
                    <li><a href="<?php echo $accesspress_parallax_widgets_field_value; ?>" target="_blank"><i class="fa fa-<?php echo $accesspress_parallax_widgets_name; ?>"></i></a></li>
                    <?php
                }
            }
        }
        echo '<!-- .widget-social-icons --></ul>';

        echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param	array	$new_instance	Values just sent to be saved.
     * @param	array	$old_instance	Previously saved values from database.
     *
     * @uses	accesspress_parallax_widgets_show_widget_field()		defined in widget-fields.php
     *
     * @return	array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {
            extract($widget_field);

            // Use helper function to get updated field values
            $instance[$accesspress_parallax_widgets_name] = accesspress_parallax_widgets_updated_field_value($widget_field, $new_instance[$accesspress_parallax_widgets_name]);
        }

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     *
     * @uses	accesspress_parallax_widgets_show_widget_field()		defined in widget-fields.php
     */
    public function form($instance) {
        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {

            // Make array elements available as variables
            extract($widget_field);
            $accesspress_parallax_widgets_field_value = isset($instance[$accesspress_parallax_widgets_name]) ? esc_attr($instance[$accesspress_parallax_widgets_name]) : '';
            accesspress_parallax_widgets_show_widget_field($this, $widget_field, $accesspress_parallax_widgets_field_value);
        }
    }

}