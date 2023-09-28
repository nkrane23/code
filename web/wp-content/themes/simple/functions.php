<?php

defined( 'ABSPATH' ) or die( 'No direct access' );

include('includes/basic.php');
include('includes/builder.php');
include('includes/Roxanne.php');

remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
remove_action('wp_head', 'wp_oembed_add_host_js');

function menu_setup() {
    register_nav_menus( array(
        'mobile-nav'    => __( 'Mobile Navigation', 'simple' ),
        'main-nav'    => __( 'Main Navigation', 'simple' ),
    ) );
}
add_action( 'after_setup_theme', 'menu_setup' );

/**
 * Enqueue scripts and styles.
 */
function site_scripts() {
    wp_enqueue_style( 'styles-featherlight', get_template_directory_uri() . '/dist/css/featherlight.css');

    wp_enqueue_style( 'styles-featherlight-gallery', get_template_directory_uri() . '/dist/css/featherlight.gallery.css');

    wp_enqueue_style('styles-gray', get_template_directory_uri() . '/dist/css/gray.min.css');

    wp_enqueue_style(
        'styles-flickity', get_template_directory_uri() . '/dist/css/flickity.min.css');

    wp_enqueue_style(
        'styles-main', get_template_directory_uri() . '/dist/css/styles.css', array(), '1.0.0');

    wp_enqueue_script('featherlight-js', get_template_directory_uri() . '/dist/js/featherlight.min.js', array(), '2', true);

    wp_enqueue_script('featherlight-gallery', get_template_directory_uri() . '/dist/js/featherlight.gallery.min.js', array(), '2', true);

    wp_enqueue_script('jquery-cycle2-js', get_template_directory_uri() . '/dist/js/jquery-cycle2.min.js', array(), '3', true);

    wp_enqueue_script('flickity-js',
        get_template_directory_uri() . '/src/js/lib/flickity.min.js', array('jquery'), '2', true);

    wp_enqueue_script('materialize-js',
        get_template_directory_uri() . '/src/js/lib/materialize.min.js', array('jquery'), '2', true);

    wp_enqueue_script('isotope',
        get_template_directory_uri() . '/src/js/lib/isotope.min.js', array('jquery'), '2', true);

    wp_enqueue_script('packery-mode',
        get_template_directory_uri() . '/src/js/lib/packery-mode.min.js', array('jquery'), '2', true);

    wp_enqueue_script('app', get_template_directory_uri() . '/dist/js/app.min.js', array('jquery'), '2', true);
}
add_action( 'wp_enqueue_scripts', 'site_scripts' );

if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title' => 'Options',
        'menu_title' => 'Options',
        'menu_slug' => 'site-options',
        'capability' => 'edit_posts',
        'redirect' => false
    ));
}

function my_acf_admin_enqueue_scripts() {
    // register style
    wp_register_style( 'my-acf-input-css', get_stylesheet_directory_uri() . '/dist/css/custom-editor-style.css', false, '1.0.0' );
    wp_enqueue_style( 'my-acf-input-css' );
}
add_action( 'acf/input/admin_enqueue_scripts', 'my_acf_admin_enqueue_scripts' );

// Custom Post Type
add_action( 'init', 'create_post_type' );
function create_post_type() {
    register_post_type( 'custom-nav-menu',
        array(
            'labels'      => array(
                'name'          => __( 'Custom Menus' ),
                'singular_name' => __( 'Custom Menu' )
            ),
            'menu_icon' => 'dashicons-list-view',
            'public'      => true,
            'has_archive' => false,
            'supports'    => array('title'),
        )
    );
    register_post_type( 'block-slides',
        array(
            'labels'      => array(
                'name'          => __( 'Block Slider' ),
                'singular_name' => __( 'Block Sliders' )
            ),
            'menu_icon' => 'dashicons-format-gallery',
            'rewrite' => array('slug' => 'block-slides', 'with_front' => false),
            'public'      => true,
            'has_archive' => false,
            'supports'    => array('title'),
        )
    );
}

add_filter('wp_headers', 'site_headers');
function site_headers() {
    header("X-Frame-Options: DENY");
    header("Content-Security-Policy: frame-ancestors 'none'", false);
    header("X-Content-Type-Options: nosniff");
	header("X-Powered-By: Stir Fry");
}

function add_specific_menu_atts( $atts, $item, $args ) {
	$home_link = array(1356);
	if (in_array($item->ID, $home_link)) {
		$atts['aria-label'] = 'Home Page';
	}

	$resume_link = array(1358);
	if (in_array($item->ID, $resume_link)) {
		$atts['aria-label'] = 'About Page';
	}

	$contact_link = array(1357);
	if (in_array($item->ID, $contact_link)) {
		$atts['aria-label'] = 'Contact Page';
	}

	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'add_specific_menu_atts', 10, 3 );

function register_acf_blocks() {
	register_block_type( __DIR__ . '/blocks/testimonial' );
}
add_action( 'init', 'register_acf_blocks' );