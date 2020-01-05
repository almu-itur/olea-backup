<?php
/**
 * The template for displaying all Parallax Templates.
 *
 * @package accesspress_parallax
 */
?>

	<div class="call-to-action">
		<?php  
            $query = new WP_Query( 'page_id='.$section['page'] );
            while ( $query->have_posts() ) : $query->the_post();
        ?>
        <?php if ($section['show_title'] == '1'): ?>
			<h2 class="wow slideInRight"><?php the_title(); ?></h2>
		<?php endif; ?>

		<div class="parallax-content wow slideInLeft">
			<?php if(get_the_content() != "") : ?>
			<div class="page-content">
				<?php the_content(); ?>
			</div>
			<?php endif; ?>
		</div>

		<?php endwhile; ?>

	</div><!-- #primary -->