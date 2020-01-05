<?php
/**
 * Toggle widget
 *
 * @package Accesspress Parallax
 */

add_action('widgets_init', 'register_toggle_widget');

function register_toggle_widget() {
    register_widget('accesspress_toggle');
}

class Accesspress_Toggle extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
                'accesspress_toggle', 
                'AP : Toggle', array(
                'description' => __('A widget that shows Toggle', 'accesspress_parallax')
                )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $status = array(
            'open' => 'Open',
            'close' => 'Close',
        );
        $fields = array(
            // This widget has no title
            // Other fields
            'toggle_title' => array(
                'accesspress_parallax_widgets_name' => 'toggle_title',
                'accesspress_parallax_widgets_title' => __('Toggle Title', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'textarea',
                'accesspress_parallax_widgets_row' => '3'
            ),
            'toggle_content' => array(
                'accesspress_parallax_widgets_name' => 'toggle_content',
                'accesspress_parallax_widgets_title' => __('Toggle Content', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'textarea',
                'accesspress_parallax_widgets_row' => '6'
            ),
            'toggle_status' => array(
                'accesspress_parallax_widgets_name' => 'toggle_status',
                'accesspress_parallax_widgets_title' => __('Toggle Status', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'select',
                'accesspress_parallax_widgets_field_options' => $status
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

        $toggle_title = $instance['toggle_title'];
        $toggle_content = $instance['toggle_content'];
        $toggle_status = $instance['toggle_status'];

        echo $before_widget;
        ?>

        <?php if (isset($toggle_title)): ?>
            <h6 class="ap-toggle-title <?php echo $toggle_status; ?>">
                <?php echo $toggle_title; ?>
                <div class="pointer"><span><i>+</i></span></div>
            </h6>
        <?php endif; ?>

        <?php if (isset($toggle_content)): ?>
            <div class="ap-toggle-content">
            <?php echo $toggle_content; ?>
            </div>
            <?php endif; ?>

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