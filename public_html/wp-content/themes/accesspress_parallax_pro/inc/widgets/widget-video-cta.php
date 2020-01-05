<?php
/**
 * Team widget
 *
 * @package Accesspress Parallax
 * @since 4.0.0
 */

add_action( 'widgets_init', 'ap_parallax_register_team_widget' );

function ap_parallax_register_team_widget() {
    register_widget( 'accesspress_video_cta' );
}

class Accesspress_Video_Cta extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
                'accesspress_video_cta', 
                'AP : Video CTA', 
                array(
                'description' => __( 'A widget that shows video call to action.', 'accesspress_parallax' )
                )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        
        $fields = array(
            
            'cta_video_url' => array(
                'accesspress_parallax_widgets_name' => 'cta_video_url',
                'accesspress_parallax_widgets_title' => __( 'Video Url', 'accesspress_parallax' ),
                'accesspress_parallax_widgets_description' => __( 'Add yutube video url like: ( https://www.youtube.com/watch?v=r1xohS2u69E )', 'accesspress_parallax' ),
                'accesspress_parallax_widgets_field_type' => 'url',
            ),

            'cta_video_title' => array(
                'accesspress_parallax_widgets_name' => 'cta_video_title',
                'accesspress_parallax_widgets_title' => __( 'Video Title', 'accesspress_parallax' ),
                'accesspress_parallax_widgets_description' => __( 'Add title display over video', 'accesspress_parallax' ),
                'accesspress_parallax_widgets_field_type' => 'text',
            ),

            'cta_video_info' => array(
                'accesspress_parallax_widgets_name' => 'cta_video_info',
                'accesspress_parallax_widgets_title' => __( 'Video Information', 'accesspress_parallax' ),
                'accesspress_parallax_widgets_description' => __( 'Add more info about section which display over video', 'accesspress_parallax' ),
                'accesspress_parallax_widgets_field_type' => 'textarea',
            ),

            'cta_play_button' => array(
                'accesspress_parallax_widgets_name' => 'cta_play_button',
                'accesspress_parallax_widgets_title' => __( 'Use Play Button', 'accesspress_parallax' ),
                'accesspress_parallax_widgets_field_type' => 'checkbox'
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
    public function widget( $args, $instance ) {
        extract($args);
        $video_url = empty( $instance['cta_video_url'] ) ? '' : $instance['cta_video_url'];
        $play_button_option = empty( $instance['cta_play_button'] ) ? '' : $instance['cta_play_button'];
        $cta_video_title = empty( $instance['cta_video_title'] ) ? '' : $instance['cta_video_title'];
        $cta_video_info = empty( $instance['cta_video_info'] ) ? '' : $instance['cta_video_info'];
        $video_autoplay_option = empty( $instance['cta_play_button'] ) ? 'true' : 'false' ;
        
        $cta_video_id = ap_youtube_id_from_url( $video_url );
        if( empty( $cta_video_id ) ){
            return;
        }
        if( wp_is_mobile() ) { 
            $apvideoWrap = 'on-mobile';
        } else {
            $apvideoWrap = '';
        }

        echo $before_widget;
    ?>
        <div class="ap-video-cta-wrapper">
            <div class="ap-cta-video-content <?php echo esc_attr( $apvideoWrap ); ?>">
                <h3 class="ap-video-title"><?php echo esc_html( $cta_video_title ); ?></h3>
                <p class="ap-video-info"><?php echo esc_html( $cta_video_info ); ?></p>
                <?php if( !empty( $play_button_option ) ) { ?>
                    <button class="ytp-button ap-cta-play" id="ap-cta-button">Play</button>
                <?php } ?>
            </div><!-- .ap-cta-video-content -->
            <div id="videoCta" class="bg-video player js-video" data-property="{videoURL:'<?php echo esc_attr( $cta_video_id ); ?>', autoPlay:<?php echo esc_attr( $video_autoplay_option ); ?>}"></div><!-- .bg-video -->
        </div><!-- .ap-video-cta-wrapper -->
    <?php
        echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param   array   $new_instance   Values just sent to be saved.
     * @param   array   $old_instance   Previously saved values from database.
     *
     * @uses    accesspress_parallax_widgets_updated_field_value()      defined in widget-fields.php
     *
     * @return  array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ( $widget_fields as $widget_field ) {

            extract( $widget_field );

            // Use helper function to get updated field values
            $instance[$accesspress_parallax_widgets_name] = accesspress_parallax_widgets_updated_field_value( $widget_field, $new_instance[$accesspress_parallax_widgets_name] );
        }

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param   array $instance Previously saved values from database.
     *
     * @uses    accesspress_parallax_widgets_show_widget_field()        defined in widget-fields.php
     */
    public function form( $instance ) {
        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ( $widget_fields as $widget_field ) {

            // Make array elements available as variables
            extract($widget_field);
            $accesspress_parallax_widgets_field_value = isset( $instance[$accesspress_parallax_widgets_name] ) ? esc_attr( $instance[$accesspress_parallax_widgets_name] ) : '';
            accesspress_parallax_widgets_show_widget_field($this, $widget_field, $accesspress_parallax_widgets_field_value );
        }
    }

}