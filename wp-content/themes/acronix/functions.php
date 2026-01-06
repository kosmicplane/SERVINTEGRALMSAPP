<?php
define( 'ACRONIX_THEME_VERSION', '1.6.3' );
function acronix_css() {
	$parent_style = 'accron-parent-style';
	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'acronix-style', get_stylesheet_uri(), array( $parent_style ));
	
	wp_dequeue_style('accron-default-css',get_template_directory_uri().'/assets/css/color/default.css');
	wp_enqueue_style( 'acronix-default-css', get_stylesheet_directory_uri().'/assets/css/color/default.css');
}
add_action( 'wp_enqueue_scripts', 'acronix_css',999);

function acronix_setup(){
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
}
add_action( 'after_setup_theme', 'acronix_setup' );

require( get_stylesheet_directory() . '/inc/customizer/acronix-header.php');
require( get_stylesheet_directory() . '/inc/customizer/acronix-premium.php');

/**
 * Import Options From Parent Theme
 *
 */
function acronix_parent_theme_options() {
	$accron_mods = get_option( 'theme_mods_accron' );
	if ( ! empty( $accron_mods ) ) {
		foreach ( $accron_mods as $accron_mod_k => $accron_mod_v ) {
			set_theme_mod( $accron_mod_k, $accron_mod_v );
		}
	}
}
add_action( 'after_switch_theme', 'acronix_parent_theme_options' );

