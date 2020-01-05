<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package accesspress_parallax
 */
if (!is_active_sidebar('sidebar-left')) {
    return;
}
?>

<div id="secondary-left" class="sidebar">
    <?php dynamic_sidebar('sidebar-left'); ?>
</div><!-- #secondary -->