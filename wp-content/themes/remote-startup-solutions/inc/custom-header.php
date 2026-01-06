<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
 * <?php the_header_image_tag(); 
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Remote Startup Solutions
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses remote_startup_solutions_header_style()
 */
function remote_startup_solutions_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'remote_startup_solutions_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '282828',
		'width'                  => 1920,
		'height'                 => 100,
		'flex-height'            => true,
		'flex-width'             => true,
		'wp-head-callback'       => 'remote_startup_solutions_header_style',
	) ) );

	// Register default headers.
	register_default_headers( array(
		'default-banner' => array(
			'url'           => '%s/images/default-header.png',
			'thumbnail_url' => '%s/images/default-header.png',
			'description'   => esc_html_x( 'Default Banner', 'header image description', 'remote-startup-solutions' ),
		),

	) );
}
add_action( 'after_setup_theme', 'remote_startup_solutions_custom_header_setup' );

function remote_startup_solutions_header_style() {
	$remote_startup_solutions_header_text_color = get_header_textcolor();

	/*
	 * If no custom options for text are set, let's bail.
	 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: HEADER_TEXTCOLOR.
	 */
	if ( get_theme_support( 'custom-header', 'default-text-color' ) === $remote_startup_solutions_header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	// Has the text been hidden?
	if ( ! display_header_text() ) :
		$remote_startup_solutions_custom_css = ".site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}";
	// If the user has set a custom color for the text use that.
	else :
		$remote_startup_solutions_custom_css = ".site-title a,
		.site-description {
			color: #" . esc_attr( $remote_startup_solutions_header_text_color ) . "}";
	endif;
	wp_add_inline_style( 'remote-startup-solutions-style', $remote_startup_solutions_custom_css );
}
add_action( 'wp_enqueue_scripts', 'remote_startup_solutions_header_style' );