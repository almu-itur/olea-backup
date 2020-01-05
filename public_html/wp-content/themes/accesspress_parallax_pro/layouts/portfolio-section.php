<?php
/**
 * The template for displaying all Parallax Templates.
 *
 * @package accesspress_parallax
 */
$enable_fullwidth_portfolio = of_get_option('enable_fullwidth_portfolio');
$portfolio_grid_columns = of_get_option('portfolio_grid_columns');
$portfolio_char = of_get_option('portfolio_char');
$portfolio_style = of_get_option('portfolio_style');
$portfolio_space = of_get_option('portfolio_space') == '1' ? 'enable_space' : '';
$portfolio_all = of_get_option('portfolio_all');
?>
<div class="portfolio-listing <?php if ($enable_fullwidth_portfolio == 1) {
    echo ' full-width';
} ?> mid-content clearfix">
    <?php
    $args = array(
        'orderby' => 'name',
    );
    if( empty( $get_portfolio_cat ) ) {
        $portfolio_categories = get_terms('portfolio-category', $args);
        
        if (!empty($portfolio_categories) && !is_wp_error($portfolio_categories)):
            echo "<ul class='button-group clearfix mid-content'>";
            if(!empty($portfolio_all)){
                echo '<li class="bttn" data-filter="*" >'.__($portfolio_all,'accesspress_parallax').'</li>';
            }
            foreach ($portfolio_categories as $portfolio_category) :
                echo "<li class='bttn' data-filter='.cat-" . $portfolio_category->term_taxonomy_id . "'>" . $portfolio_category->name . "</li>";
            endforeach;
            echo "</ul>";
        endif;
    }
    wp_reset_query();
    ?>

    <div id="portfolio-grid" class="clearfix <?php echo $portfolio_grid_columns . " " . $portfolio_style . " " . $portfolio_space; ?>">
        <?php
        $args = array(
            'post_type' => 'portfolio',
            'posts_per_page' => -1,
        );
        if( !empty( $get_portfolio_cat ) ) {
            $args['tax_query'] = array( 
                                    array(
                                        'taxonomy' => 'portfolio-category',
                                        'field'    => 'slug',
                                        'terms'    => $get_portfolio_cat,
                                    )
                                );
        }
        //var_dump($args);
        $query = new WP_Query($args);
        if ($query->have_posts()):
            $post_count = 0;
            while ($query->have_posts()): $query->the_post();
            $post_count++;
                $term_lists = wp_get_post_terms($post->ID, 'portfolio-category', array("fields" => "all"));
                $term_slugs = array();
                foreach ($term_lists as $term_list) {
                    $term_slugs[] = "cat-".$term_list->term_taxonomy_id;
                }
                $term_slugs = join(' ', $term_slugs);
                $thumbnail_id = get_post_thumbnail_id($post->ID);
                $image_size = wp_get_attachment_image_src($thumbnail_id, 'portfolio-thumbnail', 'true');
                $image_full = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
                ?>

                <div class="portfolio-list <?php echo $term_slugs; ?>">
                    <div class="porfolio-inner-wrap wow fadeInUp">
                        <?php if (has_post_thumbnail()) : ?>
                            <img src="<?php echo $image_size[0]; ?>" alt="<?php the_title(); ?>">
                        <?php else: ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/images/no-image.jpg" alt="<?php the_title(); ?>">
                        <?php endif; ?>
                        <div class="portfolio-overlay"></div>
                        <div class="portfolio-inner">
                            <h4><?php the_title(); ?></h4>
                            <div class="portfolio-excerpt"><?php echo accesspress_letter_count(get_the_content(), $portfolio_char) ?></div>
                            <a class="portfolio-link" href="<?php the_permalink(); ?>"><span><?php _e('Detail','accesspress_parallax') ?></span><i class="fa fa-link"></i></a>
                            <a class="fancybox-gallery portfolio-zoom" href="<?php echo $image_full[0]; ?>"><i class="fa fa-search"></i></a>	
                        </div>
                    </div>	
                </div>

                <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>
</div>