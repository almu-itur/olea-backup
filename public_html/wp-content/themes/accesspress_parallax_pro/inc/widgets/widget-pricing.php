<?php
/**
 * Pricing widget
 *
 * @package Accesspress Parallax
 */

add_action('widgets_init', 'ap_register_pricing_widget');

function ap_register_pricing_widget() {
    register_widget('accesspress_pricing');
}

class Accesspress_Pricing extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
                'accesspress_pricing',
                 __( 'AP : Pricing Table', 'accesspress_parallax' ),
                 array(
                'description' => __('A widget that shows Pricing Table', 'accesspress_parallax')
                )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        
        $table_layout = array(
            'layout1' => esc_html__( 'Layout 1', 'accesspress_parallax' ),
            'layout2' => esc_html__( 'Layout 2', 'accesspress_parallax' ),
            'layout3' => esc_html__( 'Layout 3', 'accesspress_parallax' ),
        );

        $fields = array(
            // This widget has no title
            // Other fields
            'pricing_featured_option' => array(
                'accesspress_parallax_widgets_name' => 'pricing_featured_option',
                'accesspress_parallax_widgets_title' => __('Featured Option', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'checkbox',
            ),
            'pricing_layout' => array(
                'accesspress_parallax_widgets_name' => 'pricing_layout',
                'accesspress_parallax_widgets_title' => __('Table Layout', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'select',
                'accesspress_parallax_widgets_field_options' => $table_layout
            ),
            'pricing_plan' => array(
                'accesspress_parallax_widgets_name' => 'pricing_plan',
                'accesspress_parallax_widgets_title' => __('Plan Name', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'text',
            ),
            'pricing_plan_sub_text' => array(
                'accesspress_parallax_widgets_name' => 'pricing_plan_sub_text',
                'accesspress_parallax_widgets_title' => __('Sub Text', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'text',
            ),
            'pricing_price' => array(
                'accesspress_parallax_widgets_name' => 'pricing_price',
                'accesspress_parallax_widgets_title' => __('Price', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'text',
            ),
            'pricing_price_per' => array(
                'accesspress_parallax_widgets_name' => 'pricing_price_per',
                'accesspress_parallax_widgets_title' => __('Price Per', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'text',
            ),
            'pricing_feature1' => array(
                'accesspress_parallax_widgets_name' => 'pricing_feature1',
                'accesspress_parallax_widgets_title' => __('Feature 1', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'text',
            ),
            'pricing_feature2' => array(
                'accesspress_parallax_widgets_name' => 'pricing_feature2',
                'accesspress_parallax_widgets_title' => __('Feature 2', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'text',
            ),
            'pricing_feature3' => array(
                'accesspress_parallax_widgets_name' => 'pricing_feature3',
                'accesspress_parallax_widgets_title' => __('Feature 3', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'text',
            ),
            'pricing_feature4' => array(
                'accesspress_parallax_widgets_name' => 'pricing_feature4',
                'accesspress_parallax_widgets_title' => __('Feature 4', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'text',
            ),
            'pricing_feature5' => array(
                'accesspress_parallax_widgets_name' => 'pricing_feature5',
                'accesspress_parallax_widgets_title' => __('Feature 5', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'text',
            ),
            'pricing_feature6' => array(
                'accesspress_parallax_widgets_name' => 'pricing_feature6',
                'accesspress_parallax_widgets_title' => __('Feature 6', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'text',
            ),
            'pricing_feature7' => array(
                'accesspress_parallax_widgets_name' => 'pricing_feature7',
                'accesspress_parallax_widgets_title' => __('Feature7', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'text',
            ),
            'pricing_feature8' => array(
                'accesspress_parallax_widgets_name' => 'pricing_feature8',
                'accesspress_parallax_widgets_title' => __('Feature 8', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'text',
            ),
            'pricing_button_text' => array(
                'accesspress_parallax_widgets_name' => 'pricing_button_text',
                'accesspress_parallax_widgets_title' => __('Button Text', 'accesspress_parallax'),
                'accesspress_parallax_widgets_desc' => __('Leave Empty not to show', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'text',
            ),
            'pricing_button_link' => array(
                'accesspress_parallax_widgets_name' => 'pricing_button_link',
                'accesspress_parallax_widgets_title' => __('Button Link', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'url',
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

        $pricing_plan = $instance['pricing_plan'];
        $pricing_plan_sub_text = $instance['pricing_plan_sub_text'];
        $pricing_price = $instance['pricing_price'];
        $pricing_price_per = $instance['pricing_price_per'];
        $pricing_feature1 = $instance['pricing_feature1'];
        $pricing_feature2 = $instance['pricing_feature2'];
        $pricing_feature3 = $instance['pricing_feature3'];
        $pricing_feature4 = $instance['pricing_feature4'];
        $pricing_feature5 = $instance['pricing_feature5'];
        $pricing_feature6 = $instance['pricing_feature6'];
        $pricing_feature7 = $instance['pricing_feature7'];
        $pricing_feature8 = $instance['pricing_feature8'];
        $pricing_button_text = $instance['pricing_button_text'];
        $pricing_button_link = $instance['pricing_button_link'];
        $pricing_featured_option = empty( $instance['pricing_featured_option'] ) ? '' : 'featured_table'; 
        $pricing_layout = empty( $instance['pricing_layout'] ) ? 'layout1' : $instance['pricing_layout'];


        echo $before_widget;
        ?>
        <div class="wow fadeInUp ap-pricing-table <?php echo esc_attr( $pricing_featured_option.' '.$pricing_layout ); ?>">
            <div class="ap-pricing-head">
                <?php if (!empty($pricing_plan)): ?>
                    <h2 class="ap-pricing-plan">
                        <?php echo $pricing_plan; ?>
                    </h2>
                <?php endif; ?>

                <?php if (!empty($pricing_plan_sub_text)): ?>
                    <div class="ap-pricing-plan-sub-text"><?php echo $pricing_plan_sub_text; ?></div>
                <?php endif; ?>
            </div>

            <div class="ap-price-box">
                <?php if( $pricing_layout == 'layout3' ) { echo '<div class="ap-wrap">'; } ?>
                <?php if (!empty($pricing_price)): ?>
                    <div class="ap-pricing-plan">
                        <?php echo $pricing_price; ?>
                    </div>
                    <div class="ap-per"><?php echo $pricing_price_per; ?></div>
                <?php endif; ?>
                <?php if( $pricing_layout == 'layout3' ) { echo '</div> <!-- . ap-wrap -->'; } ?>
            </div>

            <div class="ap-pricing-features">
                <ul class="ap-pricing-features-inner">
                    <?php if (!empty($pricing_feature1)): ?>
                        <li><?php echo $pricing_feature1; ?></li>
                    <?php endif; ?>
                    <?php if (!empty($pricing_feature2)): ?>
                        <li><?php echo $pricing_feature2; ?></li>
                    <?php endif; ?>
                    <?php if (!empty($pricing_feature3)): ?>
                        <li><?php echo $pricing_feature3; ?></li>
                    <?php endif; ?>
                    <?php if (!empty($pricing_feature4)): ?>
                        <li><?php echo $pricing_feature4; ?></li>
                    <?php endif; ?>
                    <?php if (!empty($pricing_feature5)): ?>
                        <li><?php echo $pricing_feature5; ?></li>
                    <?php endif; ?>
                    <?php if (!empty($pricing_feature6)): ?>
                        <li><?php echo $pricing_feature6; ?></li>
                    <?php endif; ?>
                    <?php if (!empty($pricing_feature7)): ?>
                        <li><?php echo $pricing_feature7; ?></li>
                    <?php endif; ?>
                    <?php if (!empty($pricing_feature8)): ?>
                        <li><?php echo $pricing_feature8; ?></li>
                    <?php endif; ?>
                </ul>
            </div>

            <?php if (!empty($pricing_button_text)): ?>
                <div class="ap-pricing-readmore"><a class="bttn" href="<?php echo $pricing_button_link; ?>"><?php echo $pricing_button_text; ?></a></div>
            <?php endif; ?>
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