<?php
/**
 * Team widget
 *
 * @package Accesspress Parallax
 */

add_action('widgets_init', 'register_team_widget');

function register_team_widget() {
    register_widget('accesspress_team');
}

class Accesspress_Team extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
                'accesspress_team', 
                'AP : Team Member', 
                array(
                'description' => __('A widget that shows Team Member', 'accesspress_parallax')
                )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $style = array(
            'style1' => 'Show Client Detail',
            'style2' => 'Hide Client Detail'
        );
        $fields = array(
            // This widget has no title
            // Other fields
            'team_upload' => array(
                'accesspress_parallax_widgets_name' => 'team_upload',
                'accesspress_parallax_widgets_title' => __('Team Member Image', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'upload',
            ),
            'team_member_name' => array(
                'accesspress_parallax_widgets_name' => 'team_member_name',
                'accesspress_parallax_widgets_title' => __('Team Member Name', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'text',
            ),
            'team_member_position' => array(
                'accesspress_parallax_widgets_name' => 'team_member_position',
                'accesspress_parallax_widgets_title' => __('Team Member Position', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'text',
            ),
            'team_detail' => array(
                'accesspress_parallax_widgets_name' => 'team_detail',
                'accesspress_parallax_widgets_title' => __('Team Member Detail', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'textarea',
                'accesspress_parallax_widgets_row' => '6'
            ),
            'team_social_facebook' => array(
                'accesspress_parallax_widgets_name' => 'team_social_facebook',
                'accesspress_parallax_widgets_title' => __('Team Member Facebook url', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'url',
            ),
            'team_social_twitter' => array(
                'accesspress_parallax_widgets_name' => 'team_social_twitter',
                'accesspress_parallax_widgets_title' => __('Team Member Twitter url', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'url',
            ),
            'team_social_linkedin' => array(
                'accesspress_parallax_widgets_name' => 'team_social_linkedin',
                'accesspress_parallax_widgets_title' => __('Team Member Linkedin url', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'url',
            ),
            'team_social_google_plus' => array(
                'accesspress_parallax_widgets_name' => 'team_social_google_plus',
                'accesspress_parallax_widgets_title' => __('Team Member Google Plus url', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'url',
            ),
            'team_member_style' => array(
                'accesspress_parallax_widgets_name' => 'team_member_style',
                'accesspress_parallax_widgets_title' => __('Style', 'accesspress_parallax'),
                'accesspress_parallax_widgets_field_type' => 'select',
                'accesspress_parallax_widgets_field_options' => $style
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
        $value = $instance['team_upload'];
        $value = explode('wp-content',$value);
        $team_upload = content_url().$value[1];
        $team_member_name = $instance['team_member_name'];
        $team_member_position = $instance['team_member_position'];
        $team_detail = $instance['team_detail'];
        $team_social_facebook = $instance['team_social_facebook'];
        $team_social_twitter = $instance['team_social_twitter'];
        $team_social_linkedin = $instance['team_social_linkedin'];
        $team_social_google_plus = $instance['team_social_google_plus'];
        $team_member_style = $instance['team_member_style'];

        echo $before_widget;
        ?>
        <div class="ap-team <?php echo $team_member_style; ?> wow fadeInUp"> 
            <?php
            if (!empty($team_upload)):
                $attachment_id = accesspress_get_attachment_id_from_url($team_upload);
                if(!empty($attachment_id)):
                    $image = wp_get_attachment_image_src($attachment_id, 'team-thumbnail');
                    $image_link = $image[0];
                    $image_full = wp_get_attachment_image_src($attachment_id, 'full');
                    $image_full_link = $image_full[0];
                else:
                    $image_link = $team_upload; 
                    $$image_full_link = $team_upload;
                endif;    
                ?>
                <div class="ap-member-image">
                    <?php echo '<img src="' . $image_link . '"/>'; ?>
                    <?php
                    if ($team_member_style == 'style2'):
                        if (!empty($team_detail)):
                            ?>
                            <div class="ap-member-message">
                                <div class="ap-member-message-inner">
                                    <span>
                                        <?php echo $team_detail; ?>
                                        <br />
                                        <a class="fancybox-gallery" href="<?php echo $image_full_link; ?>"><i class="fa fa-picture-o"></i></a>
                                    </span>
                                </div>
                            </div>
                            <?php
                        endif;
                    else:
                        ?>
                        <a class="fancybox-gallery" href="<?php echo $image_full_link; ?>"><i class="fa fa-picture-o"></i></a>
                <?php endif;
                ?>
                </div>
            <?php endif; ?>

                <?php if (!empty($team_member_name)): ?>
                <h4 class="ap-member-name">
                <?php echo $team_member_name; ?>
                </h4>
            <?php endif; ?>

            <?php if (!empty($team_member_name)): ?>
                <h6 class="ap-member-position">
                    <?php echo $team_member_position; ?>
                </h6>
            <?php endif; ?>

            <div class="ap-line"></div>

            <?php
            if ($team_member_style == 'style1'):
                if (!empty($team_detail)):
                    ?>
                    <div class="ap-member-message">
                    <?php echo $team_detail; ?>
                    </div>
                    <?php
                endif;
            endif;
            ?>

            <div class="member-social-group">
            <?php if(!empty($team_social_facebook) || !empty($team_social_twitter) || !empty($team_social_linkedin) || !empty($team_social_google_plus)): ?>
                <?php if (!empty($team_social_facebook)): ?>
                    <a href="<?php echo $team_social_facebook; ?>" class="ap-member-facebook">
                        <i class="fa fa-facebook"></i>
                    </a>
                <?php endif; ?>

                <?php if (!empty($team_social_twitter)): ?>
                    <a href="<?php echo $team_social_twitter; ?>" class="ap-member-twitter">
                        <i class="fa fa-twitter"></i>
                    </a>
                <?php endif; ?>

                <?php if (!empty($team_social_linkedin)): ?>
                    <a href="<?php echo $team_social_linkedin; ?>" class="ap-member-linkedin">
                        <i class="fa fa-linkedin"></i>
                    </a>
                <?php endif; ?>

                <?php if (!empty($team_social_google_plus)): ?>
                    <a href="<?php echo $team_social_google_plus; ?>" class="ap-member-google-plus">
                        <i class="fa fa-google-plus"></i>
                    </a>
                <?php endif; ?>
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