<?php
/**
 * Settings for demo import
 *
 */

/**
 * Define constants
 **/
if ( ! defined( 'WHIZZIE_DIR' ) ) {
	define( 'WHIZZIE_DIR', dirname( __FILE__ ) );
}
require trailingslashit( WHIZZIE_DIR ) . 'homepage-setup-contents.php';
$kindergarten_toys_current_theme = wp_get_theme();
$kindergarten_toys_theme_title = $kindergarten_toys_current_theme->get( 'Name' );


/**
 * Make changes below
 **/

// Change the title and slug of your wizard page
$config['kindergarten_toys_page_slug'] 	= 'kindergarten-toys';
$config['kindergarten_toys_page_title']	= 'Homepage Setup';

$config['steps'] = array(
	'widgets' => array(
		'id'			=> 'widgets',
		'title'			=> __( 'Setup Home Page', 'kindergarten-toys' ),
		'icon'			=> 'welcome-widgets-menus',
		'button_text'	=> __( 'Start Home Page Setup', 'kindergarten-toys' ),
		'can_skip'		=> true
	),
	'done' => array(
		'id'			=> 'done',
		'title'			=> __( 'Customize Your Site', 'kindergarten-toys' ),
		'icon'			=> 'yes',
	)
);

/**
 * This kicks off the wizard
 **/
if( class_exists( 'Kindergarten_Toys_Whizzie' ) ) {
	$Kindergarten_Toys_Whizzie = new Kindergarten_Toys_Whizzie( $config );
}