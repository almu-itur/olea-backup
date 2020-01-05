<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package accesspress_parallax
 */
get_header();

$sections = of_get_option('parallax_section');

if (!empty($sections)):
    foreach ($sections as $section) :
        $page = get_post($section['page']);
        $overlay = $section['overlay'];
        $image = $section['image'];
        $layout = $section['layout'];
        $category = $section['category'];
        $get_portfolio_cat = $section['portfolio_categories'];
        ?> 

        <?php if (!empty($section['page'])): ?>
            <section class="parallax-section <?php echo $layout; ?>" id="section-<?php echo $section['page']; ?>">
            <div class="section-wrap clearfix">
                <?php if (!empty($image) && $overlay != "overlay0") : ?>
                    <div class="overlay"></div>
                <?php endif; ?>

                <?php if ($layout != "action_template" && $layout != "blank_template" && $layout != "googlemap_template"): ?>
                    <div class="mid-content">
                        <?php  
                            $query = new WP_Query( 'page_id='.$section['page'] );
                            while ( $query->have_posts() ) : $query->the_post();
                        ?>
                        <?php if ($section['show_title'] == '1'): ?>
                            <h2 class="parallax-title"><span><?php the_title(); ?></span></h2>
                        <?php endif; ?>
                        <div class="parallax-content">
                            <div class="page-content">
                                <?php the_content(); ?>
                            </div>
                        </div> 
                        <?php 
                        endwhile;    
                        ?>
                    </div>
                <?php endif; ?>

                <?php
                switch ($layout) {
                    case 'default_template':
                        $template = "layouts/default";
                        break;

                    case 'service_template':
                        $template = "layouts/service";
                        break;

                    case 'team_template':
                        $template = "layouts/team";
                        break;

                    case 'team_template_new':
                        $template = "layouts/new-team";
                        break;

                    case 'portfolio_template':
                        $template = "layouts/portfolio";
                        break;

                    case 'portfolio_masonry_template':
                        $template = "layouts/portfolio-masonry";
                        break;

                    case 'features_template':
                        $template = "layouts/features";
                        break;

                    case 'testimonial_template':
                        $template = "layouts/testimonial";
                        break;

                    case 'testimonial_template_new':
                        $template = "layouts/new-testimonial";
                        break;

                    case 'action_template':
                        $template = "layouts/action";
                        break;

                    case 'blank_template':
                        $template = "layouts/blank";
                        break;

                    case 'googlemap_template':
                        $template = "layouts/googlemap";
                        break;

                    case 'googlemap_template_new':
                        $template = "layouts/new-googlemap";
                        break;

                    case 'blog_template':
                        $template = "layouts/blog";
                        break;

                    case 'blog_template_new':
                        $template = "layouts/new-blog";
                        break;

                    case 'logoslider_template':
                        $template = "layouts/logoslider";
                        break;

                    default:
                        $template = "layouts/default";
                        break;
                }
                ?>

            <?php include(locate_template($template . "-section.php")); ?>
            </div>
            </section>
            <?php
        endif;
    endforeach;
else:
    echo "<div class='ap-info'>". __('Go to Appearance -> Theme Options -> Parallax Sections and new section','accesspress_parallax') ."</div>";
endif;
?>

<?php get_footer(); ?>