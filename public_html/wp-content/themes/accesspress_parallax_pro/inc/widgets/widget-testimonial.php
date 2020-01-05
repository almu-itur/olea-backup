<?php
/**
 * Testimonial widget
 *
 * @package Accesspress Parallax
 */ 

add_action('widgets_init', 'register_testimonial_widget');

function register_testimonial_widget() {
    register_widget('accesspress_testimonial');
}

class Accesspress_Testimonial extends WP_Widget { 

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
                'accesspress_testimonial', 
                'AP : Testimonial', array(
                'description' => __('A widget that shows Testimonial', 'accesspress_parallax')
                )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $fields = array(
            // This widget has no title
            // Other fields
            'testimonial_upload' => array(
                'accesspress_parallax_widgets_name' => 'testimonial_upload',
                'accesspress_parallax_widgets_title' => __('Client Image', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'upload',
            ),
            'testimonial_client_name' => array(
                'accesspress_parallax_widgets_name' => 'testimonial_client_name',
                'accesspress_parallax_widgets_title' => __('Client Name', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'text',
            ),
            'testimonial_client_position' => array(
                'accesspress_parallax_widgets_name' => 'testimonial_client_position',
                'accesspress_parallax_widgets_title' => __('Client Position', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'text',
            ),
            'testimonial_detail' => array(
                'accesspress_parallax_widgets_name' => 'testimonial_detail',
                'accesspress_parallax_widgets_title' => __('Testimonial', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'textarea',
                'accesspress_parallax_widgets_row' => '6'
            )
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

        $testimonial_client_name = $instance['testimonial_client_name'];
        $testimonial_client_position = $instance['testimonial_client_position'];
        $testimonial_detail = $instance['testimonial_detail'];
        $value = $instance['testimonial_upload'];
        $value = explode('wp-content',$value);
        $testimonial_upload = content_url().$value[1];

        echo $before_widget;
        ?>
        <div class="ap-testimonial clearfix wow zoomInLeft"> 
            <?php
            if (!empty($testimonial_upload)):
                $attachment_id = accesspress_get_attachment_id_from_url($testimonial_upload);
                if(!empty($attachment_id)):
                    $image = wp_get_attachment_image_src($attachment_id, 'thumbnail');
                    $image_link = $image[0];
                else:
                    $image_link = $testimonial_upload;
                endif;    
                ?>
                <div class="ap-client-image">
                    <?php echo '<img src="' . $image_link . '"/>'; ?>
                </div>
            <?php endif; ?>

            <div class="ap-client-testimonial">
                <div class="ap-client-testimonial-heading">
                    <?php if (!empty($testimonial_client_name)): ?>
                        <h4 class="ap-client-name">
                            <?php echo $testimonial_client_name; ?>
                        </h4>
                    <?php endif; ?>

                    <?php if (!empty($testimonial_client_name)): ?>
                        <h6 class="ap-client-position">
                        <?php echo $testimonial_client_position; ?>
                        </h6>
                        <?php endif; ?>
                </div>

        <?php if (!empty($testimonial_detail)): ?>
                    <div class="ap-client-message">
                    <?php echo $testimonial_detail; ?>
                    </div>
                    <?php endif; ?>
            </div>
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
                    $accesspress_parallax_widgets_field_value = isset($instance[$accesspress_parallax_widgets_name]) ? esc_attr($instance[$accesspress_parallax_widgets_name]) : '';
                    accesspress_parallax_widgets_show_widget_field($this, $widget_field, $accesspress_parallax_widgets_field_value);
                }
            }

        }