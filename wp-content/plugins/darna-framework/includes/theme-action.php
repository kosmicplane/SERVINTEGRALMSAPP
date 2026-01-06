<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

/*---------------------------------------------------
/* CUSTOM HEADER CSS
/*---------------------------------------------------*/
add_action('wp_enqueue_scripts', 'g5plus_framework_enqueue_custom_page_styles',12);
function g5plus_framework_enqueue_custom_page_styles() {
	if (is_singular()) {
		$custom_page_css = g5plus_framework_get_custom_header_css(get_the_ID());
		wp_add_inline_style('g5plus_framework_vc_customize_css', $custom_page_css);
	}
}

if (!function_exists('g5plus_get_custom_header_css')) {
	function g5plus_framework_get_custom_header_css($pageId) {

		if (!function_exists('g5plus_custom_css_variable')) return '';
		$css_variable = g5plus_custom_css_variable($pageId);
		if (!class_exists('Less_Parser')) {
			require_once( PLUGIN_G5PLUS_FRAMEWORK_DIR . 'g5plus-framework/less/Less.php' );
		}
		$parser = new Less_Parser(array( 'compress'=>true ));

		$parser->parse($css_variable);

		$parser->parseFile( G5PLUS_FRAMEWORK_THEME_DIR . 'assets/css/less/header-customize.less' );

		return $parser->getCss();
	}
}