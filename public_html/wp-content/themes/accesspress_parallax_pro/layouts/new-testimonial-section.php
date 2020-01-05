<?php
/**
 * The template for displaying all Parallax Templates.
 *
 * @package accesspress_parallax
 */
?>

<div class="testimonial-listing clearfix wow fadeInUp">
    <?php
    if (!empty($category)):
        $args = array(
            'category_name' => $category,
            'posts_per_page' => -1
        );
        $query = new WP_Query($args);
        if( $query->have_posts() ) {
            echo '<div class="testimonials-content-wrap" style="position:relative">';
            while($query->have_posts()){
                $query->the_post();
                $post_id = get_the_ID();
        ?>
                <div class="single-content" id="tcontent-<?php echo intval( $post_id ); ?>" style="display: none;">
                    <?php 
                        $get_content = get_the_content();
                        $content = preg_replace('/((?:https?:\/\/)?www\.youtube\.com\/watch\?v=\w+)/', '[video]\1[/video]', $get_content);
                        $content = apply_filters( 'the_content', $content );
                        echo $content;
                    ?>
                </div>
        <?php
            }
            echo '</div>';
        }
        wp_reset_query();
        if ($query->have_posts()):
            ?>

            <ul class="testimonial-stage owl-theme">
                <?php
                while ($query->have_posts()): $query->the_post();
                ?>
                    <li class="testimonial-content" data-termid="<?php echo get_the_ID(); ?>">
                        <?php
                            $get_content = get_the_content(); 
                            $get_video_url = get_video_url( $get_content );
                            if( !empty( $get_video_url ) ) {
                                $get_video_id = ap_youtube_id_from_url( $get_video_url );
                                $holder_class = 'has-video';
                                $img_class = 'apt-video';
                                $video_icon = '<span class="ply-btn"></span>';
                            } else {
                                $get_video_id = '';
                                $holder_class = '';
                                $img_class = 'apt-img';
                                $video_icon = '';
                            }

                            if ( has_post_thumbnail() ) :
                                $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'testimonial-thumbnial' );
                                ?>
                                    <div class="testimonial-holder <?php echo esc_attr( $holder_class ); ?>">
                                        <a href="javascript:void(0)" class="<?php echo esc_attr( $img_class ); ?>" data-videoid="<?php echo $get_video_id; ?>">
                                            <?php echo $video_icon; ?>
                                            <img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>">
                                        </a>
                                        <h3><?php the_title(); ?></h3>
                                    </div>
                                    <!-- <div class="client-content"><?php echo $content; ?></div> -->
                            <?php endif;
                        ?>
                    </li>

            <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </ul>
            <?php
        endif;
        ?>
    <?php else:
        ?>
        <div class='ap-info'><?php _e('Select the Category of the Section','accesspress_parallax'); ?></div>
    <?php
    endif;
    ?>
</div>