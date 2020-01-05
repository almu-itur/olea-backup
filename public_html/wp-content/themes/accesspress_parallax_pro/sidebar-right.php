<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package accesspress_parallax
 */
if (!is_active_sidebar('sidebar-right')) {
    return;
}
?>

<div id="secondary-right" class="sidebar">
    <?php dynamic_sidebar('sidebar-right'); ?>
</div><!-- #secondary -->