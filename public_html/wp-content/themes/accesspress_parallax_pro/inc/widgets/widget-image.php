<?php
/**
 * Image widget
 *
 * @package Accesspress Parallax
 */

add_action('widgets_init', 'register_image_widget');

function register_image_widget() {
    register_widget('accesspress_image');
}

class Accesspress_Image extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
                'accesspress_image', 
                'AP : Image Upload', 
                array(
                'description' => __('A widget that upload image', 'accesspress_parallax')
                )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $fields = array(
            'image_title' => array(
                'accesspress_parallax_widgets_name' => 'image_title',
                'accesspress_parallax_widgets_title' => __('Title', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'text',
            ),
            'image_size' => array(
                'accesspress_parallax_widgets_name' => 'image_size',
                'accesspress_parallax_widgets_title' => __('Image Size', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'select',
                'accesspress_parallax_widgets_field_options' => array(
                    'thumbnail' => 'Thumbnail',
                    'medium' => 'Medium',
                    'large' => 'Large',
                    'full' => 'Full'
                )
            ),
            'image_align' => array(
                'accesspress_parallax_widgets_name' => 'image_align',
                'accesspress_parallax_widgets_title' => __('Image Align', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'select',
                'accesspress_parallax_widgets_field_options' => array(
                    'ap-align-none' => 'None',
                    'ap-align-left' => 'Left',
                    'ap-align-right' => 'Right',
                    'ap-align-center' => 'Center',
                )
            ),
            'image' => array(
                'accesspress_parallax_widgets_name' => 'image',
                'accesspress_parallax_widgets_title' => __('Upload Image', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'upload',
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

        $image_title = $instance['image_title'];
        $value = $instance['image'];
        $value = explode('wp-content',$value);
        $image = content_url().$value[1];
        $image_size = $instance['image_size'];
        $image_align = $instance['image_align'];


        echo $before_widget;
        ?>
        <?php
        if (!empty($image_title)):
            echo $before_title . $image_title . $after_title;
        endif;
        ?>

        <div class="wow bounceIn <?php echo $image_align; ?>">
            <?php
            if (!empty($image)):
                $attachment_id = accesspress_get_attachment_id_from_url($image);
                if(!empty($attachment_id )):
                    $image_array = wp_get_attachment_image_src($attachment_id, $image_size);
                    $image_link = $image_array[0];
                else:
                    $image_link = $image;
                endif;    
                ?>
                <img src = "<?php echo $image_link; ?>" />
            <?php 
            endif; 
            ?>
        </div>
        <?php
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
     * @uses	accesspress_parallax_widgets_updated_field_value()		defined in widget-fields.php
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
     * @param	array $instance Previously saved values from database.
     *
     * @uses	accesspress_parallax_widgets_show_widget_field()		defined in widget-fields.php
     */
    public function form($instance) {
        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {

            // Make array elements available as variables
            extract($widget_field);
            $accesspress_parallax_widgets_field_value = !empty($instance[$accesspress_parallax_widgets_name]) ? esc_attr($instance[$accesspress_parallax_widgets_name]) : '';
            accesspress_parallax_widgets_show_widget_field($this, $widget_field, $accesspress_parallax_widgets_field_value);
        }
    }

}