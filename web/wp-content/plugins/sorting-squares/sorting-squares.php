<?php

/*
Plugin Name: Sorting Squares
Description: Adds custom post type and shortcode for filtered content squares layout.
Version: 1.0.0
Author: Nora Krane
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit;

define('SQUARES_DIR', plugin_dir_url( __FILE__ ));

function squares_styles() {
    wp_enqueue_style('squares-css', SQUARES_DIR . 'assets/dist/css/main.css');

    wp_enqueue_script('squares-jquery',
        SQUARES_DIR . 'assets/dist/js/lib/jquery.min.js', '2', true);

    wp_enqueue_script('library-isotope',
        SQUARES_DIR . 'assets/dist/js/lib/isotope.min.js', array('jquery'), '2', true);

    wp_enqueue_script('squares-js',
        SQUARES_DIR . 'assets/dist/js/sorting.min.js', array('jquery'), '2', true);
}
add_action( 'wp_enqueue_scripts', 'squares_styles' );

// Custom Post Type
add_action( 'init', 'create_squares_post_type' );
function create_squares_post_type() {
    register_post_type( 'sorting-squares',
        array(
            'labels'      => array(
                'name'          => __( 'Sorting Squares' ),
                'singular_name' => __( 'Sorting Square' )
            ),
            'menu_icon'   => 'dashicons-format-gallery',
            'public'      => true,
            'has_archive' => false,
            'supports'    => array('title', 'editor', 'thumbnail'),
            'taxonomies'  => array('')
        )
    );
}

add_action( 'init', 'create_squares_tax' );
function create_squares_tax() {
    register_taxonomy(
        'square-categories',
        'sorting-squares',
        array(
            'label' => __( 'Category' ),
            'rewrite' => array( 'slug' => 'category' ),
            'hierarchical' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_admin_column' => true,
            'show_in_quick_edit' => false,
            'public' => false
        )
    );
}

// Sorting Squares Layout Shortcode
add_shortcode('sorting-squares', function ($atts) {
    $atts = shortcode_atts([
        'filter' => '',
		'hover_color' => ''
    ], $atts);

    echo '<div class="sorting-squares-container">';

    // If filter="false" is not specified, then filter buttons will display
    if ($atts['filter'] !== 'false') {
        include('parts/squares-filters.php');
    }

    include('parts/squares-gallery.php');

    echo '</div>';
});