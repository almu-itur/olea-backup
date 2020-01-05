<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package accesspress_parallax
 */
get_header();

$header_image = of_get_option('archive_title_bg');
$header_image_option = of_get_option('archive_title_bg_option');
$header_height = of_get_option('archive_title_bar_height');

if (!empty($header_image) && $header_image_option == '1'):
    $header_image_bg = 'background-image:url(' . $header_image . ');'; 
elseif($header_image_option == '0'):
    $header_image_bg = "";
else:
    $header_image_bg = 'background-image:url(' . get_template_directory_uri() . '/images/bg-breadcrumb.jpg);'; 
endif;
?>
<div id="main-wrap">
    <div id="header-wrap" style="<?php echo $header_image_bg; ?>height:<?php echo $header_height . 'px'; ?>">
        <header class="entry-header">
            <div class="entry-header-inner">
                <div class="title-breadcrumb-wrap">
                    <h1 class="entry-title"><?php _e('Oops! That page can&rsquo;t be found.', 'accesspress_parallax'); ?></h1>
                    <?php accesspress_parallax_breadcrumbs(); ?>
                </div>
            </div>
        </header><!-- .entry-header -->
    </div>

    <div class="mid-content no-sidebar">
        <div id="primary" class="content-area">

            <div class="error-404 not-found">
                404     
                <span><?php _e('Error', 'accesspress_parallax'); ?></span>	
            </div><!-- .error-404 -->

        </div><!-- #primary -->
    </div>

</div>

<?php get_footer(); ?>