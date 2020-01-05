<?php
/**
 * The template for displaying all Parallax Templates.
 *
 * @package accesspress_parallax
 */
?>
<?php 
$read_more = of_get_option('read_more_text');
$read_all = of_get_option('read_all_text');
$post_date = of_get_option('post_date');
?>
<div class="new-blog-listing mid-content clearfix">
    <?php
    if (!empty($category)):
        $args = array(
            'category_name' => $category,
            'posts_per_page' => 3
        );
        $count_service = 0;
        $query = new WP_Query($args);
        if ($query->have_posts()):
            $i = 0;
            while ($query->have_posts()): $query->the_post();
                $i = $i + 0.25;
                ?>
                <div class="single-blog-wrapper wow fadeInUp" data-wow-delay="<?php echo $i; ?>s">
                
                    <div class="blog-image">
                        <a href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()) :
                                $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'medium-thumbnail');
                                ?>
                                <img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>">
                            <?php else: ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/images/no-image.jpg" alt="<?php the_title(); ?>">
                            <?php endif; ?>
                        </a>
                    </div>
                    <div class="blog-content-wrapper">
                        <div class="top-blog-content clearfix">
                            <?php if($post_date == '1'){ ?>
                                <div class="blog-date-wrap">
                                    <span class="post-day"><?php echo get_the_date('d'); ?></span>
                                    <span class="post-month"><?php echo get_the_date('M'); ?></span>
                                </div>
                            <?php } ?>
                            <div class="blog-title-wrap">
                                <h3><a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a> </h3>
                                <div class="blog-meta-wrap">
                                    <?php accesspress_parallax_new_blog_poston(); ?>
                                </div>
                            </div><!-- .blog-title-wrap -->
                        </div>
                        <div class="post-excerpt">
                            <?php echo accesspress_letter_count(get_the_excerpt(), 272); ?>
                        </div>
                        <?php if(!empty($read_more)){  ?>
                            <span class="read-more clearfix"><a href="<?php the_permalink(); ?>"><?php _e($read_more,'accesspress_parallax'); ?></a></span>
                        <?php } ?>
                    </div><!-- .blog-content-wrapper -->
                </div><!-- .single-blog-wrapper -->

                <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>
    <?php if(!empty($read_all)){  
        $idObj = get_category_by_slug($category); 
        $category = $idObj->term_id;
    ?>
    <div class="clearfix btn-wrap">
        <a class="ap-bttn" href="<?php echo get_category_link($category) ?>"><?php _e($read_all ,'accesspress_parallax'); ?></a>
    </div>
    <?php 
    }else{ 
    ?>
    <div class="clearfix btn-wrap">
        <a class="ap-bttn" href="<?php echo get_category_link($category) ?>"><?php _e('View All' ,'accesspress_parallax'); ?></a>
    </div>    
    <?php
    } ?>
    <?php else:
    ?>
    <div class='ap-info'><?php _e('Select the Category of the Section','accesspress_parallax'); ?></div>
<?php
endif;
?> 