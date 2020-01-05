<?php
	if ( isset($_REQUEST) ) {
	
	$parallax_section_array = get_option('accesspress_parallax_count');
	
	// Parallax Defaults
	$parallax_defaults = NULL;

	// Pull all the pages into an array
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');

	$options_categories_obj = get_categories();

	/**
	 * Portfolios categories
	 * @since 4.0.0
	 */
	$portfolio_categories = array();
	$portfolio_categories_obj = get_terms( 'portfolio-category' );
	$portfolio_categories[''] = __( 'All','accesspress_parallax' );
	foreach ($portfolio_categories_obj as $category) {
		$portfolio_categories[$category->slug] = $category->name;
	}

	$countsettings = rand(0, 100);
	while(in_array($countsettings, $parallax_section_array)){
		$countsettings = rand(0, 100);
	}
?>	

<div class="sub-option clearfix">
<h3 class="title"><?php _e('Page Title:','accesspress_parallax') ?> <span></span><div class="section-toggle"><i class="fa fa-chevron-down"></i></div></h3>
<div class="sub-option-inner">

<div class="inline-label">
<label><?php _e('Page','accesspress_parallax') ?></label>
<select class="parallax_section_page" name="accesspress_parallax_pro[parallax_section][<?php echo $countsettings; ?>][page]" class="of-input">
<option value=""><?php _e('Select a page:','accesspress_parallax') ?> </option>
<?php foreach ($options_pages_obj as $page) { ?>
	<option value="<?php echo $page->ID; ?>"><?php echo $page->post_title; ?></option>
<?php } ?>
</select>
</div>

<div class="inline-label">
<label class=""><?php _e('Layout','accesspress_parallax') ?> </label>
<select class="parallax_section_layout" class="of-section of-section-layout" name="accesspress_parallax_pro[parallax_section][<?php echo $countsettings; ?>][layout]">
	<option value="default_template"><?php _e('Default Section','accesspress_parallax') ?> </option>
	<option value="service_template"><?php _e('Service Section','accesspress_parallax') ?> </option>
	<option value="team_template"><?php _e('Team Section','accesspress_parallax') ?> </option>
	<option value="team_template_new"><?php _e('Team Section ( New Layout )','accesspress_parallax') ?> </option>
	<option value="portfolio_template"><?php _e('Portfolio Section','accesspress_parallax') ?> </option>
	<option value="portfolio_masonry_template"><?php _e('Portfolio Section (Masonry)','accesspress_parallax') ?> </option>
	<option value="features_template"><?php _e('Features Section','accesspress_parallax') ?> </option>
	<option value="testimonial_template"><?php _e('Testimonial Section','accesspress_parallax') ?> </option>
	<option value="testimonial_template_new"><?php _e('Testimonial Section (New Layout)','accesspress_parallax') ?> </option>
	<option value="blog_template"><?php _e('Blog Section','accesspress_parallax') ?> </option>
	<option value="blog_template_new"><?php _e('Blog Section (New Layout)','accesspress_parallax') ?> </option>
	<option value="action_template"><?php _e('Call to Action Section','accesspress_parallax') ?> </option>
	<option value="googlemap_template"><?php _e('Google Map Section','accesspress_parallax') ?> </option>
	<option value="googlemap_template_new"><?php _e('Google Map Section (New Layout)','accesspress_parallax') ?> </option>
	<option value="logoslider_template"><?php _e('Logo Slider Section','accesspress_parallax') ?> </option>
	<option value="blank_template"><?php _e('Blank Section','accesspress_parallax') ?> </option>
</select>
</div>

<div class="inline-label toggle-category">
<label class=""><?php _e('Category','accesspress_parallax') ?> </label>
<select class="parallax_section_category" name="accesspress_parallax_pro[parallax_section][<?php echo $countsettings; ?>][category]" class="of-input">
	<option value=""><?php _e('Select a Category:','accesspress_parallax') ?> </option>
<?php foreach ($options_categories_obj as $category) { ?>
	<option value="<?php echo $category->slug; ?>"><?php echo $category->cat_name; ?></option>
<?php } ?>
</select>
</div>

<div class="inline-label toggle-portfolio-categories">
<label class=""><?php _e( 'Portfolio Categories', 'accesspress_parallax' ) ;?></label>
<select class="of-input" name="accesspress_parallax_pro[parallax_section][<?php echo $countsettings; ?>][portfolio_categories]" id="parallax_section_portfolio_categories">
	<option selected="selected" value=""><?php _e( 'All', 'accesspress_parallax' ); ?></option>
	<?php foreach ($portfolio_categories_obj as $category) { ?>
		<option value="<?php echo $category->slug; ?>"><?php echo $category->name; ?></option>
	<?php } ?>
</select>
</div>

<div class="inline-label">
<label><?php _e('Disable Page Title','accesspress_parallax') ?> </label>
<div class="switch_options">
<span class="switch_enable selected"><?php _e('Show','accesspress_parallax') ?> </span>
<span class="switch_disable"><?php _e('Hide','accesspress_parallax') ?> </span>
<input class="switch_val" type="hidden" value="1" name="accesspress_parallax_pro[parallax_section][<?php echo $countsettings; ?>][hide_title]">
</div>
</div>

<div class="inline-label">
<label><?php _e('Display in Menu','accesspress_parallax') ?> </label>
<div class="switch_options">
<span class="switch_enable selected"><?php _e('Show','accesspress_parallax') ?> </span>
<span class="switch_disable"><?php _e('Hide','accesspress_parallax') ?> </span>
<input class="switch_val" type="hidden" value="1" name="accesspress_parallax_pro[parallax_section][<?php echo $countsettings; ?>][show_in_menu]">
</div>
</div>

<div class="inline-label">
<label><?php _e('Section Height','accesspress_parallax') ?> </label>
<div class="switch_options">
<span class="switch_enable selected"><?php _e('Default','accesspress_parallax') ?> </span>
<span class="switch_disable"><?php _e('Expand','accesspress_parallax') ?> </span>
<input class="switch_val" type="hidden" value="1" name="accesspress_parallax_pro[parallax_section][<?php echo $countsettings; ?>][section_height]">
</div>
</div>

<div class="color-picker inline-label">
<label class=""><?php _e('Heading Text Color','accesspress_parallax') ?> </label>
<input value="#333333" name="accesspress_parallax_pro[parallax_section][<?php echo $countsettings; ?>][header_color]" class="of-color" type="text">
</div>

<div class="color-picker inline-label">
<label class=""><?php _e('Font Color','accesspress_parallax') ?> </label>
<input value="#333333" name="accesspress_parallax_pro[parallax_section][<?php echo $countsettings; ?>][font_color]" class="of-color" type="text">
</div>

<div class="color-picker inline-label">
<label class=""><?php _e('Background Color','accesspress_parallax') ?> </label>
<input value="#FFFFFF" name="accesspress_parallax_pro[parallax_section][<?php echo $countsettings; ?>][color]" class="of-color" type="text">
</div>

<div class="inline-label">
<label class=""><?php _e('Background Image','accesspress_parallax') ?> </label>
<input type="text" placeholder="<?php _e('No file chosen','accesspress_parallax') ?>" value="" name="accesspress_parallax_pro[parallax_section][<?php echo $countsettings; ?>][image]" class="upload" id="parallax_section">
<input type="button" value="<?php _e('Upload','accesspress_parallax') ?>" class="upload-button button" id="upload-parallax_section">
<div id="parallax_section-image" class="screenshot"></div>
</div>


<div class="of-background-properties hide">
<div class="inline-label">
<label class=""><?php _e('Overlay','accesspress_parallax') ?> </label>
<select id="parallax_section_overlay" class="of-background of-background-overlay" name="accesspress_parallax_pro[parallax_section][<?php echo $countsettings; ?>][overlay]">
<option value="none"><?php _e('No Overlay','accesspress_parallax') ?> </option>
<option value="black-dark-bg"><?php _e('Dark Black','accesspress_parallax') ?> </option>
<option value="black-light-bg"><?php _e('Light Black','accesspress_parallax') ?> </option>
<option value="white-dark-bg"><?php _e('Dark White','accesspress_parallax') ?> </option>
<option value="white-light-bg"><?php _e('Light White','accesspress_parallax') ?> </option>
<option value="overlay1"><?php _e('Check Box','accesspress_parallax') ?> </option>
<option value="overlay2"><?php _e('Black Small Dots','accesspress_parallax') ?> </option>
</select>
</div>

<div class="inline-label">
<label class=""><?php _e('Background Settings','accesspress_parallax') ?></label>
<div class="background-settings">
	<div class="clearfix">
	<select id="parallax_section_repeat" name="accesspress_parallax_pro[parallax_section][<?php echo $countsettings; ?>][repeat]" class="of-background of-background-repeat">
		<option value="no-repeat"><?php _e('No Repeat','accesspress_parallax') ?></option>
		<option value="repeat-x"><?php _e('Repeat Horizontally','accesspress_parallax') ?></option>
		<option value="repeat-y"><?php _e('Repeat Vertically','accesspress_parallax') ?></option>
		<option value="repeat"><?php _e('Repeat All','accesspress_parallax') ?></option>
	</select>

	<select id="parallax_section_position" name="accesspress_parallax_pro[parallax_section][<?php echo $countsettings; ?>][position]" class="of-background of-background-position">
	<option value="top left"><?php _e('Top Left','accesspress_parallax') ?></option>
	<option value="top center"><?php _e('Top Center','accesspress_parallax') ?></option>
	<option value="top right"><?php _e('Top Right','accesspress_parallax') ?></option>
	<option value="center left"><?php _e('Middle Left','accesspress_parallax') ?></option>
	<option value="center center"><?php _e('Middle Center','accesspress_parallax') ?></option>
	<option value="center right"><?php _e('Middle Right','accesspress_parallax') ?></option>
	<option value="bottom left"><?php _e('Bottom Left','accesspress_parallax') ?></option>
	<option value="bottom center"><?php _e('Bottom Center','accesspress_parallax') ?></option>
	<option value="bottom right"><?php _e('Bottom Right','accesspress_parallax') ?></option>
	</select>

	<select id="parallax_section_attachment" name="accesspress_parallax_pro[parallax_section][<?php echo $countsettings; ?>][attachment]" class="of-background of-background-attachment">
	<option value="scroll"><?php _e('Scroll Normally','accesspress_parallax') ?></option>
	<option value="fixed"><?php _e('Fixed in Place','accesspress_parallax') ?></option>
	</select>

	<select id="parallax_section_size" name="accesspress_parallax_pro[parallax_section][<?php echo $countsettings; ?>][size]" class="of-background of-background-size">
	<option value="auto"><?php _e('Auto','accesspress_parallax') ?></option>
	<option value="cover"><?php _e('Cover','accesspress_parallax') ?></option>
	<option value="contain"><?php _e('Contain','accesspress_parallax') ?></option>
	</select>
	</div>
</div>
</div>

<div class="inline-label parallax-effects">
<label class=""><?php _e('Parallax Effects','accesspress_parallax') ?></label>
<div class="radio">
<input id="parallax_section-none<?php echo $countsettings; ?>" checked="checked" class="of-input of-radio" type="radio" value="none" name="accesspress_parallax_pro[parallax_section][<?php echo $countsettings; ?>][effects]">
<label for="parallax_section-none<?php echo $countsettings; ?>"><?php _e('No Effects','accesspress_parallax') ?></label>
</div>
<div class="radio">
<input id="parallax_section-parallax<?php echo $countsettings; ?>" class="of-input of-radio" type="radio" value="parallax" name="accesspress_parallax_pro[parallax_section][<?php echo $countsettings; ?>][effects]">
<label for="parallax_section-parallax<?php echo $countsettings; ?>"><?php _e('Parallax Scrolling','accesspress_parallax') ?></label>
</div>
<div class="radio">
<input id="parallax_section-movingbg<?php echo $countsettings; ?>" class="of-input of-radio" type="radio" value="movingbg" name="accesspress_parallax_pro[parallax_section][<?php echo $countsettings; ?>][effects]">
<label for="parallax_section-movingbg<?php echo $countsettings; ?>"><?php _e('Moving Background','accesspress_parallax') ?></label>
</div>
</div>

</div>
<div class="remove-parallax button-primary"><?php _e('Remove','accesspress_parallax') ?></div>
</div>
</div>
<?php } ?>
