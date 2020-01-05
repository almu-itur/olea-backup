<?php
/**
 * AccessPress Pro Custom Post Types
 *
 * @package Accesspress Pro
 */

function accesspress_parallax_create_portfolio() {
    $labels = array(
        'name'               => _x( 'Portfolios', 'post type general name' , 'accesspress_parallax' ),
        'singular_name'      => _x( 'Portfolio', 'post type singular name' , 'accesspress_parallax' ),
        'add_new'            => _x( 'Add New', 'Portfolio' , 'accesspress_parallax' ),
        'add_new_item'       => __( 'Add New Portfolio' , 'accesspress_parallax' ),
        'edit_item'          => __( 'Edit Portfolio' , 'accesspress_parallax' ),
        'new_item'           => __( 'New Portfolio' , 'accesspress_parallax' ),
        'all_items'          => __( 'All Portfolio' , 'accesspress_parallax'),
        'view_item'          => __( 'View Portfolio' , 'accesspress_parallax'),
        'search_items'       => __( 'Search Portfolio' , 'accesspress_parallax'),
        'not_found'          => __( 'No Portfolio found' , 'accesspress_parallax'),
        'not_found_in_trash' => __( 'No Portfolio found in the Trash' , 'accesspress_parallax'),
        'parent_item_colon'  => '',
        'menu_name'          => 'Portfolio'
    );
    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds our Testimonials and Portfolio specific data',
        'public'        => true,
        'menu_position' => 5,
        'supports'      => array( 'title', 'editor', 'thumbnail'),
        'has_archive'   => false,
        'menu_icon' => 'dashicons-portfolio',
        'rewrite'   => array( 'slug' => of_get_option('portfolio_slug') ),
    );
    register_post_type( 'portfolio', $args );    
}

add_action( 'init', 'accesspress_parallax_create_portfolio' );

function create_portfolio_category() {
    $labels = array(
        'name'              => _x( 'Portfolio Categories', 'taxonomy general name', 'accesspress_parallax' ),
        'singular_name'     => _x( 'Portfolio Category', 'taxonomy singular name', 'accesspress_parallax' ),
        'search_items'      => __( 'Search Portfolio Categories', 'accesspress_parallax' ),
        'all_items'         => __( 'All Portfolio Categories', 'accesspress_parallax' ),
        'parent_item'       => __( 'Parent Portfolio Category', 'accesspress_parallax' ),
        'parent_item_colon' => __( 'Parent Portfolio Category:', 'accesspress_parallax' ),
        'edit_item'         => __( 'Edit Portfolio Category', 'accesspress_parallax' ),
        'update_item'       => __( 'Update Portfolio Category', 'accesspress_parallax' ),
        'add_new_item'      => __( 'Add New Portfolio Category', 'accesspress_parallax' ),
        'new_item_name'     => __( 'New Portfolio Category', 'accesspress_parallax' ),
        'menu_name'         => __( 'Portfolio Categories', 'accesspress_parallax' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
    );
    register_taxonomy( 'portfolio-category', 'portfolio', $args );
}
add_action( 'init', 'create_portfolio_category', 0 );

function my_rewrite_flush() {
    flush_rewrite_rules();
}
add_action( 'init', 'my_rewrite_flush' );