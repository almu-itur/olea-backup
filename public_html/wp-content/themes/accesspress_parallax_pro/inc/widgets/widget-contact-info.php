<?php
/**
 * Contact Info widget
 *
 * @package Accesspress Parallax
 */

add_action('widgets_init', 'register_contact_info_widget');

function register_contact_info_widget() {
    register_widget('accesspress_contact_info');
}

class Accesspress_Contact_Info extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
                'accesspress_contact_info', 
                'AP : Contact Info', 
                array(
                'description' => __('A widget that shows Contact Info', 'accesspress_parallax')
                )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $fields = array(
            'contact_info_title' => array(
                'accesspress_parallax_widgets_name' => 'contact_info_title',
                'accesspress_parallax_widgets_title' => __('Title', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'text',
            ),
            'contact_info_phone' => array(
                'accesspress_parallax_widgets_name' => 'contact_info_phone',
                'accesspress_parallax_widgets_title' => __('Phone', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'text',
            ),
            'contact_info_email' => array(
                'accesspress_parallax_widgets_name' => 'contact_info_email',
                'accesspress_parallax_widgets_title' => __('Email', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'text',
            ),
            'contact_info_website' => array(
                'accesspress_parallax_widgets_name' => 'contact_info_website',
                'accesspress_parallax_widgets_title' => __('Website', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'text',
            ),
            'contact_info_address' => array(
                'accesspress_parallax_widgets_name' => 'contact_info_address',
                'accesspress_parallax_widgets_title' => __('Contact Address', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'textarea',
                'accesspress_parallax_widgets_row' => '4'
            ),
            'contact_info_time' => array(
                'accesspress_parallax_widgets_name' => 'contact_info_time',
                'accesspress_parallax_widgets_title' => __('Contact Time', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'textarea',
                'accesspress_parallax_widgets_row' => '3'
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

        $contact_info_title = $instance['contact_info_title'];
        $contact_info_phone = $instance['contact_info_phone'];
        $contact_info_email = $instance['contact_info_email'];
        $contact_info_website = $instance['contact_info_website'];
        $contact_info_address = $instance['contact_info_address'];
        $contact_info_time = $instance['contact_info_time'];

        echo $before_widget;
        ?>
        <div class="ap-contact-info">
            <?php
            if (!empty($contact_info_title)):
                echo $before_title . $contact_info_title . $after_title;
            endif;
            ?>

            <ul class="ap-contact-info-wrapper">
                <?php if (!empty($contact_info_phone)): ?>
                    <li><i class="fa fa-phone"></i><?php echo $contact_info_phone; ?></li>
                <?php endif; ?>

                <?php if (!empty($contact_info_email)): ?>
                    <li><i class="fa fa-envelope"></i><?php echo $contact_info_email; ?></li>
                <?php endif; ?>

                <?php if (!empty($contact_info_website)): ?>
                    <li><i class="fa fa-globe"></i><?php echo $contact_info_website; ?></li>
                <?php endif; ?>

                <?php if (!empty($contact_info_address)): ?>
                    <li><i class="fa fa-map-marker"></i><?php echo wpautop($contact_info_address); ?></li>
                <?php endif; ?>

                <?php if (!empty($contact_info_time)): ?>
                    <li><i class="fa fa-clock-o"></i><?php echo wpautop($contact_info_time); ?></li>
                    <?php endif; ?>
            </ul>
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