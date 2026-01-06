<?php
function atua_footer_customize_settings( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	// Footer Section Panel // 
	$wp_customize->add_panel( 
		'footer_options', 
		array(
			'priority'      => 34,
			'capability'    => 'edit_theme_options',
			'title'			=> __('Footer Options', 'atua'),
		) 
	);	
	
	/*=========================================
	Footer Copright
	=========================================*/
	$wp_customize->add_section(
        'atua_footer_copyright',
        array(
            'title' 		=> __('Footer Copright','atua'),
			'panel'  		=> 'footer_options',
			'priority'      => 4,
		)
    );
	
	// Heading
	$wp_customize->add_setting(
		'atua_footer_copyright_first_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_text',
		)
	);

	$wp_customize->add_control(
	'atua_footer_copyright_first_head',
		array(
			'type' => 'hidden',
			'label' => __('Copyright','atua'),
			'section' => 'atua_footer_copyright',
			'priority'  => 3,
		)
	);
	
	// footer third text // 
	$atua_copyright = esc_html__('Copyright &copy; [current_year] [site_title] | Powered by [theme_author]', 'atua' );
	$wp_customize->add_setting(
    	'atua_footer_copyright_text',
    	array(
			'default' => $atua_copyright,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_html',
		)
	);	

	$wp_customize->add_control( 
		'atua_footer_copyright_text',
		array(
		    'label'   		=> __('Copyright','atua'),
		    'section'		=> 'atua_footer_copyright',
			'type' 			=> 'textarea',
			'priority'      => 4,
		)  
	);	
	
	/*=========================================
	Footer Background
	=========================================*/
	$wp_customize->add_section(
        'footer_background_options',
        array(
            'title' 		=> __('Footer Background','atua'),
			'panel'  		=> 'footer_options',
			'priority'      => 4,
		)
    );
	
	
	//  Footer Background Color
	$wp_customize->add_setting(
	'atua_footer_bg_color', 
	array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'default' => '#0e1422'
    ));
	
	$wp_customize->add_control( 
		new WP_Customize_Color_Control
		($wp_customize, 
			'atua_footer_bg_color', 
			array(
				'label'      => __( 'Footer Background Color', 'atua' ),
				'section'    => 'footer_background_options',
			) 
		) 
	);
}
add_action( 'customize_register', 'atua_footer_customize_settings' );