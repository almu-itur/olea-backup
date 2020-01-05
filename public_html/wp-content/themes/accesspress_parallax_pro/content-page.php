<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package accesspress_parallax
 */
?>
<?php 
$page_featured_image = of_get_option('page_featured_image');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
    </header><!-- .entry-header -->
    
    <?php if (has_post_thumbnail() && $page_featured_image == '1') : ?>
        <div class="entry-thumb alignleft">
            <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'portfolio-thumbnail'); ?>
            <img src="<?php echo $image[0]; ?>" alt="<?php echo get_the_title(); ?>"> 
        </div>
    <?php endif; ?>

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
</article><!-- #post-## -->