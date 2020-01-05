<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package accesspress_parallax
 */
?>
<?php
$copy_right_text = of_get_option('copy_right_text');
$right_footer_text = of_get_option('right_footer_text');
?>
</div><!-- #content -->
<div class="ap-popup-wrap" style="display: none;">
    <div class="ap-video-popup"></div>
</div>

<footer id="colophon" class="site-footer">
    <?php if (of_get_option('show_top_footer') == '1') : ?>
        <div class="top-footer footer-column-<?php echo accesspress_footer_count(); ?>">
            <div class="mid-content clearfix">
                <?php if (is_active_sidebar('footer-1')): ?>
                    <div class="footer-block">
                        <?php dynamic_sidebar('footer-1'); ?>
                    </div>
                <?php endif; ?>

                <?php if (is_active_sidebar('footer-2')): ?>
                    <div class="footer-block">
                        <?php dynamic_sidebar('footer-2'); ?>
                    </div>
                <?php endif; ?>

                <?php if (is_active_sidebar('footer-3')): ?>
                    <div class="footer-block">
                        <?php dynamic_sidebar('footer-3'); ?>
                    </div>
                <?php endif; ?>

                <?php if (is_active_sidebar('footer-4')): ?>
                    <div class="footer-block">
                        <?php dynamic_sidebar('footer-4'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

<?php
    $bottom_footer_layout = of_get_option( 'bottom_footer_layout', 'layout1' );
    if( $bottom_footer_layout == 'layout1' ) {
        $bottom_layout_class = '';
    } else {
        $bottom_layout_class = 'new-layout';
    }
?>
    <div class="bottom-footer <?php echo esc_attr( $bottom_layout_class ); ?>">
        <?php if( $bottom_footer_layout == 'layout2' ) { ?>
            <div id="go-top" class="new-top-icon"><a href="#page"><i class="fa fa-angle-up"></i></a></div>
        <?php } ?>
        <div class="mid-content clearfix">
            <div  class="copy-right">
                <?php
                if (!empty($copy_right_text)):
                    _e($copy_right_text);
                endif; ?>  
            </div><!-- .copy-right -->
            <div class="site-info">
                <?php
                if (!empty($right_footer_text)):
                    _e($right_footer_text);
                endif;
                ?>  
            </div><!-- .site-info -->
        </div>

        <?php
        if (of_get_option('show_social_on_footer') == '1'):
            ?>
            <div class="footer-social-icons">
            <?php do_action('accesspress_social'); ?>
            </div>
        <?php
        endif;
        ?>
    </div><!-- .bottom-footer -->
</footer><!-- #colophon -->
</div><!-- #page -->
<?php if( $bottom_footer_layout == 'layout1' ) { ?>
    <div id="go-top"><a href="#page"><i class="fa fa-angle-up"></i></a></div>
<?php } ?>
<?php wp_footer(); ?>
</body>
</html>