<?php
/**
 * @package accesspress_parallax
 */

$post_date = of_get_option('post_date');
$post_footer = of_get_option('post_footer');
$post_date_class = ($post_date == '0' || has_post_thumbnail()) ? " no-date" : "";
$continue_reading_text = of_get_option('continue_reading_text');
if( empty( $continue_reading_text ) ){
    $continue_reading_text = __( 'Continue reading', 'accesspress_parallax' ) ;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if (has_post_thumbnail()) : ?>
        <div class="entry-thumb">
            <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'blog-header'); ?>
            <img src="<?php echo $image[0]; ?>" alt="<?php echo get_the_title(); ?>"> 
        </div>
    <?php endif; ?>

    <header class="entry-header">
        <h3 class="entry-title<?php echo $post_date_class; ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <?php if ('post' == get_post_type()) : ?>
            <div class="entry-meta">
                <?php accesspress_parallax_posted_on(); ?>
            </div><!-- .entry-meta -->
        <?php endif; ?>
    </header><!-- .entry-header -->

    <div class="entry-content"> 
        <?php 
            $post_content_type = of_get_option( 'post_content_type' );
            if( empty( $post_content_type ) || $post_content_type == 'excerpt_content' ) {
                the_excerpt();
                echo '<a href="'.get_the_permalink().'" class="ap-archive-btn" rel="nofollow">'.esc_html( $continue_reading_text ).'</a>';

            } else {
                the_content(__($continue_reading_text,'accesspress_parallax'));
                wp_link_pages(array(
                    'before' => '<div class="page-links">' . __('Pages:', 'accesspress_parallax'),
                    'after' => '</div>',
                ));
            }
        ?>
    </div><!-- .entry-content -->

    <?php if ($post_footer == '1') : ?>
        <footer class="entry-footer">
            <?php if ('post' == get_post_type()) : // Hide category and tag text for pages on Search ?>
                <?php
                /* translators: used between list items, there is a space after the comma */
                $categories_list = get_the_category_list(__(', ', 'accesspress_parallax'));
                if ($categories_list && accesspress_parallax_categorized_blog()) :
                    ?>
                    <span class="cat-links">
                        <?php printf(__('<i class="fa fa-folder-open"></i>Posted in %1$s', 'accesspress_parallax'), $categories_list); ?>
                    </span>
                <?php endif; // End if categories ?>

                <?php
                /* translators: used between list items, there is a space after the comma */
                $tags_list = get_the_tag_list('', __(', ', 'accesspress_parallax'));
                if ($tags_list) :
                    ?>
                    <span class="tags-links">
                        <?php printf(__('<i class="fa fa-tags"></i>Tagged %1$s', 'accesspress_parallax'), $tags_list); ?>
                    </span>
                <?php endif; // End if $tags_list ?>
            <?php endif; // End if 'post' == get_post_type() ?>

            <?php if (!post_password_required() && ( comments_open() || '0' != get_comments_number() )) : ?>
                <span class="comments-link"><?php comments_popup_link(__('<i class="fa fa-comments"></i>Leave a comment', 'accesspress_parallax'), __('<i class="fa fa-comments"></i>1 Comment', 'accesspress_parallax'), __('<i class="fa fa-comments"></i>% Comments', 'accesspress_parallax')); ?></span>
            <?php endif; ?>
        </footer><!-- .entry-footer -->
    <?php endif; ?>
    <?php edit_post_link('<i class="fa fa-pencil-square-o"></i>'. __('Edit', 'accesspress_parallax'), '<span class="edit-link">', '</span>'); ?>
</article><!-- #post-## -->