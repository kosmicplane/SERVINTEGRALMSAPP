<?php
function acronix_header_settings( $wp_customize ) {
	// Search
	$wp_customize->add_setting(
		'hdr_social_icons'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'accron_sanitize_text',
			'priority' => 10,
		)
	);

	$wp_customize->add_control(
	'hdr_social_icons',
		array(
			'type' => 'hidden',
			'label' => __('Social Icons','acronix'),
			'section' => 'header_navigation',
		)
	);
	$wp_customize->add_setting( 
		'hide_show_social_icon' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'accron_sanitize_checkbox',
			'priority' => 11,
		) 
	);
	
	$wp_customize->add_control(
	'hide_show_social_icon', 
		array(
			'label'	      => esc_html__( 'Hide/Show', 'acronix' ),
			'section'     => 'header_navigation',
			'type'        => 'checkbox'
		) 
	);	
}
add_action( 'customize_register', 'acronix_header_settings',99 );