<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * @link    https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Atua
 */
function atua_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'atua_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '161C2D',
		'width'                  => 1920,
		'height'                 => 200,
		'flex-height'            => true,
		'wp-head-callback'       => 'atua_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'atua_custom_header_setup' );

if ( ! function_exists( 'atua_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see atua_custom_header_setup().
	 */
function atua_header_style() {
	$header_text_color = get_header_textcolor();
	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		if ( ! display_header_text() ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		else :
	?>
		body header h4.site-title,
		body header p.site-description {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif;
