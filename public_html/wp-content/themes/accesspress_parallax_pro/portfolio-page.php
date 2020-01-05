<?php
/**
 * Template Name: Portfolio Page
 *
 * @package accesspress_parallax
 */
get_header();
global $post;
$header_image = get_post_meta($post->ID, 'accesspress_parallax_page_header_image', true);
$header_image_option = of_get_option('page_title_bg_option');
$header_height = of_get_option('page_title_bar_height');

if (!empty($header_image) && $header_image_option == '1'):
    $header_image_bg = 'background-image:url(' . $header_image . ');'; 
elseif($header_image_option == '0'):
    $header_image_bg = "";
else:
    $header_image_bg = 'background-image:url(' . get_template_directory_uri() . '/images/bg-breadcrumb.jpg);'; 
endif;

$enable_fullwidth_portfolio = of_get_option('enable_fullwidth_portfolio1');
$portfolio_grid_columns = of_get_option('portfolio_grid_columns1');
$portfolio_layout = of_get_option('portfolio_layout1');
$portfolio_style = of_get_option('portfolio_style1');
$portfolio_char = of_get_option('portfolio_char1');
$portfolio_space = of_get_option('portfolio_space1') == '1' ? 'enable_space' : '';
$portfolio_all = of_get_option('portfolio_all1');

?>

<?php while (have_posts()) : the_post(); ?>
    <div id="main-wrap">
        <div id="header-wrap" style="<?php echo $header_image_bg; ?>height:<?php echo $header_height . 'px'; ?>">
            <header class="entry-header">
                <div class="entry-header-inner">
                    <div class="title-breadcrumb-wrap">
                        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                        <?php accesspress_parallax_breadcrumbs(); ?>
                    </div>
                </div>
            </header><!-- .entry-header -->
        </div>

        <div class="portfolio-listing <?php if ($enable_fullwidth_portfolio == 1) {
            echo ' full-width';
        } ?> mid-content clearfix">
            <?php
            $args = array(
                'orderby' => 'name',
            );

            $portfolio_categories = get_terms('portfolio-category', $args);
            if (!empty($portfolio_categories) && !is_wp_error($portfolio_categories)):
                echo "<ul class='button-group clearfix mid-content'>";
                if(!empty($portfolio_all)){
                    echo '<li class="bttn" data-filter="*" >'.__($portfolio_all, 'accesspress_parallax').'</li>';
                }
                foreach ($portfolio_categories as $portfolio_category) :
                    echo "<li class='bttn' data-filter='." . $portfolio_category->slug . "'>" . $portfolio_category->name . "</li>";
                endforeach;
                echo "</ul>";
            endif;
            wp_reset_query();
            ?>

            <div id="portfolio-<?php echo $portfolio_layout; ?>" class="clearfix <?php echo $portfolio_grid_columns . " " . $portfolio_style . " " . $portfolio_space; ?>">
                <?php
                $args = array(
                    'post_type' => 'portfolio',
                    'posts_per_page' => -1,
                );
                $query = new WP_Query($args);
                if ($query->have_posts()):
                    while ($query->have_posts()): $query->the_post();
                        $term_lists = wp_get_post_terms($post->ID, 'portfolio-category', array("fields" => "all"));
                        $term_slugs = array();
                        foreach ($term_lists as $term_list) {
                            $term_slugs[] = $term_list->slug;
                        }
                        $term_slugs = join(' ', $term_slugs);
                        $thumbnail_id = get_post_thumbnail_id($post->ID);
                        $image = wp_get_attachment_image_src($thumbnail_id, 'portfolio-thumbnail', 'true');
                        $image_large = wp_get_attachment_image_src($thumbnail_id, 'large', 'true');
                        ?>

                        <div class="portfolio-list clearfix <?php echo $term_slugs; ?>">
                            <?php
                            if (has_post_thumbnail()) :
                                $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'portfolio-thumbnail');
                                $image_full = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
                                ?>
                                <img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>">
                            <?php else: ?>
                                $image_fulll[0] = "#";
                                <img src="<?php echo get_template_directory_uri(); ?>/images/no-image.jpg" alt="<?php the_title(); ?>">
            <?php endif; ?>
                            <div class="portfolio-overlay"></div>
                            <div class="portfolio-inner">
                                <h4><?php the_title(); ?></h4>
                                <div class="portfolio-excerpt"><?php echo accesspress_letter_count(get_the_content(), $portfolio_char) ?></div>
                                <a class="portfolio-link" href="<?php the_permalink(); ?>"><span <?php if($portfolio_layout == "list") echo 'class="bttn"'; ?>><?php _e('Detail','accesspress_parallax') ?></span><i class="fa fa-link"></i></a>
                                <a class="fancybox-gallery portfolio-zoom" href="<?php echo $image_full[0]; ?>"><i class="fa fa-search"></i></a>	
                            </div>

                        </div>

                        <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </div>
<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>