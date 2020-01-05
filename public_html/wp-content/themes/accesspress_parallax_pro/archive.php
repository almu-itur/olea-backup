<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
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
                    <h1 class="entry-title">
                        <?php
                        if (is_category()) :
                            single_cat_title();

                        elseif (is_tag()) :
                            single_tag_title();

                        elseif (is_author()) :
                            printf(__('Author: %s', 'accesspress_parallax'), '<span class="vcard">' . get_the_author() . '</span>');

                        elseif (is_day()) :
                            printf(__('Day: %s', 'accesspress_parallax'), '<span>' . get_the_date() . '</span>');

                        elseif (is_month()) :
                            printf(__('Month: %s', 'accesspress_parallax'), '<span>' . get_the_date(_x('F Y', 'monthly archives date format', 'accesspress_parallax')) . '</span>');

                        elseif (is_year()) :
                            printf(__('Year: %s', 'accesspress_parallax'), '<span>' . get_the_date(_x('Y', 'yearly archives date format', 'accesspress_parallax')) . '</span>');

                        elseif (is_tax('post_format', 'post-format-aside')) :
                            _e('Asides', 'accesspress_parallax');

                        elseif (is_tax('post_format', 'post-format-gallery')) :
                            _e('Galleries', 'accesspress_parallax');

                        elseif (is_tax('post_format', 'post-format-image')) :
                            _e('Images', 'accesspress_parallax');

                        elseif (is_tax('post_format', 'post-format-video')) :
                            _e('Videos', 'accesspress_parallax');

                        elseif (is_tax('post_format', 'post-format-quote')) :
                            _e('Quotes', 'accesspress_parallax');

                        elseif (is_tax('post_format', 'post-format-link')) :
                            _e('Links', 'accesspress_parallax');

                        elseif (is_tax('post_format', 'post-format-status')) :
                            _e('Statuses', 'accesspress_parallax');

                        elseif (is_tax('post_format', 'post-format-audio')) :
                            _e('Audios', 'accesspress_parallax');

                        elseif (is_tax('post_format', 'post-format-chat')) :
                            _e('Chats', 'accesspress_parallax');

                        else :
                            _e('Archives', 'accesspress_parallax');

                        endif;
                        ?>	
                    </h1>
                    <?php accesspress_parallax_breadcrumbs(); ?>

                    <?php
                    // Show an optional term description.
                    $term_description = term_description();
                    if (!empty($term_description)) :
                        printf('<div class="taxonomy-description">%s</div>', $term_description);
                    endif;
                    ?>
                </div>
            </div>
        </header><!-- .entry-header -->
    </div>
    <div class="mid-content">
        <section id="primary" class="content-area">
            <main id="main" class="site-main post-listing">

                <?php if (have_posts()) : ?>
                    <?php /* Start the Loop */ ?>
                    <?php while (have_posts()) : the_post(); ?>

                        <?php
                        /* Include the Post-Format-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                         */
                        get_template_part('content');
                        ?>

                    <?php endwhile; ?>

                    <?php accesspress_parallax_paging_nav(); ?>
                <?php else : ?>

                    <?php get_template_part('content', 'none'); ?>

                <?php endif; ?>

            </main><!-- #main -->
        </section><!-- #primary -->

        <?php get_sidebar('right'); ?>
    </div>
</div>
<?php get_footer(); ?>