<?php
/**
 * Theme functions and definitions
 *
 * @package SoftMunch
 */

/**
 * After setup theme hook
 */
function softmunch_theme_setup(){
    /*
     * Make child theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_child_theme_textdomain( 'softmunch' );	
}
add_action( 'after_setup_theme', 'softmunch_theme_setup' );

/**
 * Load assets.
 */

function softmunch_theme_css() {
	wp_enqueue_style( 'softmunch-parent-theme-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'softmunch_theme_css', 99);

/*=========================================
 SoftMunch Customize Panel from parent theme
=========================================*/
function softmunch_change_parent_setting( $wp_customize ) {
	$wp_customize->remove_control('softme_mobile_logo_head');
	$wp_customize->remove_control('softme_mobile_logo');
}
add_action( 'customize_register', 'softmunch_change_parent_setting',99 );

require get_stylesheet_directory() . '/theme-functions/controls/class-customize.php';

/**
 * Import Options From Parent Theme
 *
 */
function softmunch_parent_theme_options() {
	$softme_mods = get_option( 'theme_mods_softme' );
	if ( ! empty( $softme_mods ) ) {
		foreach ( $softme_mods as $softme_mod_k => $softme_mod_v ) {
			set_theme_mod( $softme_mod_k, $softme_mod_v );
		}
	}
}
add_action( 'after_switch_theme', 'softmunch_parent_theme_options' );