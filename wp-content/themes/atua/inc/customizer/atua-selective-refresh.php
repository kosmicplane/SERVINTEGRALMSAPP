<?php
function atua_site_selective_partials( $wp_customize ){
	// atua_footer_copyright_text
	$wp_customize->selective_refresh->add_partial( 'atua_footer_copyright_text', array(
		'selector'            => '.dt_footer_copyright-text',
		'settings'            => 'atua_footer_copyright_text',
		'render_callback'  => 'atua_footer_copyright_text_render_callback',
	) );
	}
add_action( 'customize_register', 'atua_site_selective_partials' );