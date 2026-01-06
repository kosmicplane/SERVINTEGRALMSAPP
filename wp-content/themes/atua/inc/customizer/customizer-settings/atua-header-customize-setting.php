<?php
function atua_header_customize_settings( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Header Settings Panel
	=========================================*/
	$wp_customize->add_panel( 
		'header_options', 
		array(
			'priority'      => 2,
			'capability'    => 'edit_theme_options',
			'title'			=> __('Header Options', 'atua'),
		) 
	);
	
	/*=========================================
	Atua Site Identity
	=========================================*/
	$wp_customize->add_section(
        'title_tagline',
        array(
        	'priority'      => 1,
            'title' 		=> __('Site Identity','atua'),
			'panel'  		=> 'header_options',
		)
    );
	
	// Logo Width // 
	if ( class_exists( 'Atua_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'hdr_logo_size',
			array(
				'default'			=> '150',
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'atua_sanitize_range_value',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control( 
		new Atua_Customizer_Range_Control( $wp_customize, 'hdr_logo_size', 
			array(
				'label'      => __( 'Logo Size', 'atua' ),
				'section'  => 'title_tagline',
				 'media_query'   => true,
					'input_attr'    => array(
						'mobile'  => array(
							'min'           => 0,
							'max'           => 500,
							'step'          => 1,
							'default_value' => 150,
						),
						'tablet'  => array(
							'min'           => 0,
							'max'           => 500,
							'step'          => 1,
							'default_value' => 150,
						),
						'desktop' => array(
							'min'           => 0,
							'max'           => 500,
							'step'          => 1,
							'default_value' => 150,
						),
					),
			) ) 
		);
	}
	
	/*=========================================
	Header Navigation
	=========================================*/	
	$wp_customize->add_section(
        'atua_hdr_nav',
        array(
        	'priority'      => 4,
            'title' 		=> __('Navigation Bar','atua'),
			'panel'  		=> 'header_options',
		)
    );
	
	/*=========================================
	Header Cart
	=========================================*/	
	$wp_customize->add_setting(
		'atua_hdr_cart'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'atua_hdr_cart',
		array(
			'type' => 'hidden',
			'label' => __('WooCommerce Cart','atua'),
			'section' => 'atua_hdr_nav',
		)
	);
	
	
	$wp_customize->add_setting( 
		'atua_hs_hdr_cart' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'atua_hs_hdr_cart', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'atua' ),
			'section'     => 'atua_hdr_nav',
			'type'        => 'checkbox'
		) 
	);	
	
	/*=========================================
	Header Search
	=========================================*/	
	$wp_customize->add_setting(
		'atua_hdr_search'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_text',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
	'atua_hdr_search',
		array(
			'type' => 'hidden',
			'label' => __('Site Search','atua'),
			'section' => 'atua_hdr_nav',
		)
	);
	$wp_customize->add_setting( 
		'atua_hs_hdr_search' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_checkbox',
			'priority' => 4,
		) 
	);
	
	$wp_customize->add_control(
	'atua_hs_hdr_search', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'atua' ),
			'section'     => 'atua_hdr_nav',
			'type'        => 'checkbox'
		) 
	);	
	
	/*=========================================
	Header Button
	=========================================*/	
	$wp_customize->add_setting(
		'atua_hdr_button'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_text',
			'priority' => 7,
		)
	);

	$wp_customize->add_control(
	'atua_hdr_button',
		array(
			'type' => 'hidden',
			'label' => __('Button','atua'),
			'section' => 'atua_hdr_nav',
		)
	);
	

	$wp_customize->add_setting( 
		'atua_hs_hdr_btn' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_checkbox',
			'priority' => 8,
		) 
	);
	
	$wp_customize->add_control(
	'atua_hs_hdr_btn', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'atua' ),
			'section'     => 'atua_hdr_nav',
			'type'        => 'checkbox'
		) 
	);	
	
	// Button Label // 
	$wp_customize->add_setting(
    	'atua_hdr_btn_lbl',
    	array(
			'sanitize_callback' => 'atua_sanitize_html',
			'capability' => 'edit_theme_options',
			'priority' => 9,
		)
	);	

	$wp_customize->add_control( 
		'atua_hdr_btn_lbl',
		array(
		    'label'   		=> __('Button Label','atua'),
		    'section' 		=> 'atua_hdr_nav',
			'type'		 =>	'text'
		)  
	);
	
	// Button Link // 
	$wp_customize->add_setting(
    	'atua_hdr_btn_link',
    	array(
			'sanitize_callback' => 'atua_sanitize_url',
			'capability' => 'edit_theme_options',
			'priority' => 10,
		)
	);	

	$wp_customize->add_control( 
		'atua_hdr_btn_link',
		array(
		    'label'   		=> __('Button Link','atua'),
		    'section' 		=> 'atua_hdr_nav',
			'type'		 =>	'text'
		)  
	);
	
	
	// Open New Tab
	$wp_customize->add_setting( 
		'atua_hdr_btn_target' , 
			array(
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_checkbox',
			'priority' => 11,
		) 
	);
	
	$wp_customize->add_control(
	'atua_hdr_btn_target', 
		array(
			'label'	      => esc_html__( 'Open in New Tab ?', 'atua' ),
			'section'     => 'atua_hdr_nav',
			'type'        => 'checkbox'
		) 
	);	
	/*=========================================
	Sticky Header
	=========================================*/	
	$wp_customize->add_section(
        'atua_sticky_header_set',
        array(
        	'priority'      => 4,
            'title' 		=> __('Header Sticky','atua'),
			'panel'  		=> 'header_options',
		)
    );
	
	// Heading
	$wp_customize->add_setting(
		'atua_hdr_sticky'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'atua_hdr_sticky',
		array(
			'type' => 'hidden',
			'label' => __('Sticky Header','atua'),
			'section' => 'atua_sticky_header_set',
		)
	);
	$wp_customize->add_setting( 
		'atua_hs_hdr_sticky' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'atua_hs_hdr_sticky', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'atua' ),
			'section'     => 'atua_sticky_header_set',
			'type'        => 'checkbox'
		) 
	);	
}
add_action( 'customize_register', 'atua_header_customize_settings' );