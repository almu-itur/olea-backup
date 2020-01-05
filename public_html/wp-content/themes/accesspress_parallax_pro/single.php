<?php
/**
 * The template for displaying all single posts.
 *
 * @package accesspress_parallax
 */
get_header();

$header_image = of_get_option('post_title_bg');
$header_bg_color = of_get_option('post_title_bg_color');
$header_image_option = of_get_option('post_title_bg_option');
$single_post_pagination = of_get_option('single_post_pagination');
$header_image_bg = "";

if (!empty($header_image) && $header_image_option == '1'):
    $header_image_bg = 'background-image:url(' . $header_image . ');'; 
endif;
if (!empty($header_bg_color) && $header_image_option == '1'):
    $header_image_bg .= 'background-color:' . $header_bg_color ; 
endif;
?>
<?php while (have_posts()) : the_post(); ?>
    <div id="main-wrap">
        <div id="header-wrap" style="<?php echo $header_image_bg; ?>">
            <header class="entry-header">
                <div class="entry-header-inner">
                    <div class="title-breadcrumb-wrap">
                        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                        <?php accesspress_parallax_breadcrumbs(); ?>
                        <?php accesspress_parallax_single_posted_on(); ?>
                    </div>
                </div>
            </header><!-- .entry-header -->
        </div>


        <div class="mid-content clearfix">
            <main id="main" class="site-main">
                <div id="primary" class="content-area">

                    <?php get_template_part('content', 'single'); ?>

                    <?php
                    if ($single_post_pagination == '1') :
                        accesspress_parallax_post_nav();
                    endif;
                    ?>

                    <?php
                    // If comments are open or we have at least one comment, load up the comment template
                    if (comments_open() || '0' != get_comments_number()) :
                        comments_template();
                    endif;
                    ?>

                </div><!-- #primary -->

                <?php get_sidebar('right'); ?>
            </main>
        </div>
    </div>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>