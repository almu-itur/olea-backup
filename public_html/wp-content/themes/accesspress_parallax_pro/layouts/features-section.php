<?php
/**
 * The template for displaying features sectiona at Parallax Templates.
 *
 * @package accesspress_parallax
 * @since 4.0.0
 */
?>
<div class="features-listing mid-content clearfix">
	<?php
    	if ( !empty( $category ) ):
	        $args = array(
	            'category_name' => $category,
	            'posts_per_page' => -1
	        );
        	$count_feature = 0;
        	$query = new WP_Query( $args );
        	if( $query->have_posts() ):
            	$i = 0;
            	while ( $query->have_posts() ): $query->the_post();
	                $i = $i + 0.25;
	                $count_feature++;
	                $feature_class = ($count_feature % 2 == 0) ? "even wow fadeInRight" : "odd wow fadeInLeft";
    ?>

                <div class="clearfix feature-list <?php echo $feature_class; ?>" data-wow-delay="<?php echo $i; ?>s">
                    <div class="feature-image">
                        <?php
                        	if ( has_post_thumbnail() ){
                            	$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'thumbnail' );
                         ?>
                            <img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>">
                        <?php } else { ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/images/no-image.jpg" alt="<?php the_title(); ?>">
                        <?php } ?>
                    </div>

                    <div class="feature-detail">
                        <h4><?php the_title(); ?></h4>
                        <div class="feature-content"><?php the_content(); ?></div>
                    </div>
                </div>

                <?php 
                	if ( $count_feature % 2 == 0 ) {
                		echo '<div class="clearfix"></div>';
                	}
                ?>
    <?php
            	endwhile;
            	wp_reset_postdata();
        	endif;
    ?>
    <?php else:
        ?>
        	<div class='ap-info'><?php _e( 'Select the Category of the Section', 'accesspress_parallax' ); ?></div>
    <?php
    	endif;
    ?>
</div><!-- .features-listing -->