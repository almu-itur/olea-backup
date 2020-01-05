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
<div class="blog-listing mid-content clearfix">
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

                <a href="<?php the_permalink(); ?>" class="blog-list wow fadeInDown" data-wow-delay="<?php echo $i; ?>s">
                    <div class="blog-image">
                        <?php if (has_post_thumbnail()) :
                            $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'medium-thumbnail');
                            ?>
                            <img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>">
                        <?php else: ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/images/no-image.jpg" alt="<?php the_title(); ?>">
                        <?php endif; ?>
                        <?php if($post_date == '1'){ ?>
                        <h4 class="posted-date"><i class="fa fa-calendar"></i><?php echo get_the_date(); ?></h4>
                        <?php } ?>
                    </div>
                    
                    <div class="blog-excerpt">
                        <h3><?php the_title(); ?></h3>
                        <?php echo accesspress_letter_count(get_the_excerpt(), 272); ?> <br />
                        <?php if(!empty($read_more)){  ?>
                        <span><?php _e($read_more,'accesspress_parallax'); ?></span>
                        <?php } ?>
                    </div>
                </a>

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