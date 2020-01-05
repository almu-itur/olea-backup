<?php
/**
 * Template Name: Contact Page
 *
 * @package accesspress_parallax
 */
get_header();
global $post;
$header_image = of_get_option('page_title_bg');
$header_bg_color = of_get_option('page_title_bg_color');
$sidebar = get_post_meta($post->ID, 'accesspress_parallax_sidebar_layout', true);
$single_header_image = get_post_meta($post->ID, 'accesspress_parallax_page_header_image', true);
if(!empty($single_header_image)){
    $header_image = $single_header_image ;
}
$header_image_option = of_get_option('page_title_bg_option');
$page_comments = of_get_option('page_comments');
$header_image_bg = "";

if (!empty($header_image) && $header_image_option == '1'):
    $header_image_bg = 'background-image:url(' . $header_image . ');'; 
endif;
if (!empty($header_bg_color) && $header_image_option == '1'):
    $header_image_bg .= 'background-color:' . $header_bg_color ; 
endif;
?>

<?php while (have_posts()) : the_post(); ?>
    
    <div id="main-wrap" class="<?php echo $sidebar; ?>">
        <div id="header-wrap" style="<?php echo $header_image_bg; ?>">
            <header class="entry-header">
                <div class="entry-header-inner">
                    <div class="title-breadcrumb-wrap">
                        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                        <?php accesspress_parallax_breadcrumbs(); ?>
                    </div>
                </div>
            </header><!-- .entry-header -->
        </div>

        <div class="mid-content clearfix">
        <?php if ($sidebar == "both-sidebar"): ?>
                <div id="primary-wrap">
            <?php endif; ?>

                <div id="primary" class="content-area">

                    <div class="entry-content">
                    <?php the_content(); ?>
                    <?php
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . __('Pages:', 'accesspress_parallax'),
                        'after' => '</div>',
                    ));
                    ?>
                    </div><!-- .entry-content -->
                    <footer class="entry-footer">
                        <?php edit_post_link('<i class="fa fa-pencil-square-o"></i>'. __('Edit', 'accesspress_parallax'), '<span class="edit-link">', '</span>'); ?>
                    </footer><!-- .entry-footer -->

                        <?php
                        if($page_comments == '1'):
                            // If comments are open or we have at least one comment, load up the comment template
                            if (comments_open() || '0' != get_comments_number()) :
                                comments_template();
                            endif;
                        endif;
                        ?>

                </div><!-- #primary -->

    <?php
    if ($sidebar == "left-sidebar" || $sidebar == "both-sidebar"):
        get_sidebar('left');
        ?>
                <?php endif; ?>

                <?php if ($sidebar == "both-sidebar"): ?>
                </div>
                <?php endif; ?>

            <?php
            if ($sidebar == "right-sidebar" || $sidebar == "both-sidebar"):
                get_sidebar('right');
            endif;
            ?>

        </div>
    </div>
<?php endwhile; // end of the loop.  ?>

<div class="googlemap-content">
    <div id="ap-map-canvas"></div>
</div>

<?php get_footer(); ?>