<?php
/**
 * The template for displaying search results pages.
 *
 * @package accesspress_parallax
 */
get_header();

$header_image = of_get_option('archive_title_bg');
$header_bg_color = of_get_option('archive_title_bg_color');
$header_image_option = of_get_option('archive_title_bg_option');
$header_image_bg = "";

if (!empty($header_image) && $header_image_option == '1'):
    $header_image_bg = 'background-image:url(' . $header_image . ');'; 
endif;
if (!empty($header_bg_color) && $header_image_option == '1'):
    $header_image_bg .= 'background-color:' . $header_bg_color ; 
endif;
?>

<div id="main-wrap">
    <div id="header-wrap" style="<?php echo $header_image_bg; ?>">
        <header class="entry-header">
            <div class="entry-header-inner">
                <div class="title-breadcrumb-wrap">
                    <h1 class="entry-title"><?php printf(__('Search Results for: %s', 'accesspress_parallax'), '<span>' . get_search_query() . '</span>'); ?></h1>
                </div>
            </div>
        </header><!-- .entry-header -->
    </div>

    <div class="mid-content clearfix">
        <div id="primary" class="content-area">	
            <main id="main" class="site-main post-listing">		
                <?php if (have_posts()) : ?>    
                    <?php /* Start the Loop */ ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <?php
                        /**
                         * Run the loop for the search to output the results.
                         * If you want to overload this in a child theme then include a file
                         * called content-search.php and that will be used instead.
                         */
                        get_template_part('content', 'search');
                        ?>

                    <?php endwhile; ?>

                    <?php accesspress_parallax_paging_nav(); ?>
                    <?php else : ?>

                    <?php get_template_part('content', 'none'); ?>

                <?php endif; ?>
            </main><!-- #main -->
        </div><!-- #primary -->

        <?php get_sidebar('right'); ?>
    </div>
</div>
<?php get_footer(); ?>