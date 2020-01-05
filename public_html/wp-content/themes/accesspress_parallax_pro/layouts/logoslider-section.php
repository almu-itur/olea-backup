<?php
/**
 * The template for displaying all Parallax Templates.
 *
 * @package accesspress_parallax
 */
?>

<div class="content-area">

    <?php
    $logos = of_get_option('partner_logo');
    if (is_array($logos)):
        ?>
        <div class="client-logo-wrap">
            <div class="client-logo-slider">
                <?php
                $i = 0;
                foreach ($logos as $logo) :
                    $i = $i + 0.2;
                    if (!empty($logo['link'])):
                        ?>
                        <a target="_blank" href="<?php echo $logo['link']; ?>">
                        <?php endif; ?>
                        <img class="wow fadeInDown" src="<?php echo $logo['image']; ?>" data-wow-delay="<?php echo $i; ?>s">
                    <?php if (!empty($logo['link'])): ?>
                        </a>
                <?php endif;
                endforeach;
                ?>
            </div>
        </div>

        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $('.client-logo-slider').imagesLoaded(function() {
                    $('.client-logo-slider').bxSlider({
                        auto: true,
                        pager: false,
                        controls: false,
                        moveSlides: 1,
                        minSlides: 2,
                        maxSlides: <?php echo of_get_option('partner_logo_no'); ?>,
                        slideWidth: <?php echo of_get_option('partner_logo_width'); ?>,
                        slideMargin: 20
                    });
                });
            });
        </script>
<?php endif; ?>
</div>