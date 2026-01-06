<?php
function atua_theme_options_customize( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	$wp_customize->add_panel(
		'atua_theme_options', array(
			'priority' => 31,
			'title' => esc_html__( 'Theme Options', 'atua' ),
		)
	);
	
	/*=========================================
	General Options
	=========================================*/
	$wp_customize->add_section(
		'site_general_options', array(
			'title' => esc_html__( 'General Options', 'atua' ),
			'priority' => 1,
			'panel' => 'atua_theme_options',
		)
	);
	
	
	/*=========================================
	Preloader
	=========================================*/
	// Heading
	$wp_customize->add_setting(
		'atua_preloader_option'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'atua_preloader_option',
		array(
			'type' => 'hidden',
			'label' => __('Site Preloader','atua'),
			'section' => 'site_general_options',
		)
	);
	
	
	// Hide/ Show
	$wp_customize->add_setting( 
		'atua_hs_preloader_option' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'atua_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 1,
		) 
	);
	
	$wp_customize->add_control(
	'atua_hs_preloader_option', 
		array(
			'label'	      => esc_html__( 'Hide / Show Preloader', 'atua' ),
			'section'     => 'site_general_options',
			'type'        => 'checkbox'
		) 
	);
	
	/*=========================================
	Scroller
	=========================================*/
	// Heading
	$wp_customize->add_setting(
		'atua_scroller_option'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_text',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
	'atua_scroller_option',
		array(
			'type' => 'hidden',
			'label' => __('Top Scroller','atua'),
			'section' => 'site_general_options',
		)
	);
	
	// Hide/show
	$wp_customize->add_setting( 
		'atua_hs_scroller_option' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'atua_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 4,
		) 
	);
	
	$wp_customize->add_control(
	'atua_hs_scroller_option', 
		array(
			'label'	      => esc_html__( 'Hide / Show Scroller', 'atua' ),
			'section'     => 'site_general_options',
			'type'        => 'checkbox'
		) 
	);
	
	/*=========================================
	Atua Container
	=========================================*/
	// Heading
	$wp_customize->add_setting(
		'atua_site_container_option'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_text',
			'priority' => 6,
		)
	);

	$wp_customize->add_control(
	'atua_site_container_option',
		array(
			'type' => 'hidden',
			'label' => __('Site Container','atua'),
			'section' => 'site_general_options',
		)
	);
	
	if ( class_exists( 'Atua_Customizer_Range_Control' ) ) {
		//container width
		$wp_customize->add_setting(
			'atua_site_container_width',
			array(
				'default'			=> '1252',
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'atua_sanitize_range_value',
				'transport'         => 'postMessage',
				'priority'      => 6,
			)
		);
		$wp_customize->add_control( 
		new Atua_Customizer_Range_Control( $wp_customize, 'atua_site_container_width', 
			array(
				'label'      => __( 'Container Width', 'atua' ),
				'section'  => 'site_general_options',
				 'media_query'   => false,
                'input_attr'    => array(
                    'desktop' => array(
                        'min'           => 768,
                        'max'           => 2000,
                        'step'          => 1,
                        'default_value' => 1252,
                    ),
                ),
			) ) 
		);
	}
	
	
	/*=========================================
	Breadcrumb  Section
	=========================================*/
	$wp_customize->add_section(
		'atua_site_breadcrumb', array(
			'title' => esc_html__( 'Site Breadcrumb', 'atua' ),
			'priority' => 12,
			'panel' => 'atua_theme_options',
		)
	);
	
	// Heading
	$wp_customize->add_setting(
		'atua_site_breadcrumb_option'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'atua_site_breadcrumb_option',
		array(
			'type' => 'hidden',
			'label' => __('Settings','atua'),
			'section' => 'atua_site_breadcrumb',
		)
	);
	
	// Breadcrumb Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'atua_hs_site_breadcrumb' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'atua_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'atua_hs_site_breadcrumb', 
		array(
			'label'	      => esc_html__( 'Hide / Show Section', 'atua' ),
			'section'     => 'atua_site_breadcrumb',
			'type'        => 'checkbox'
		) 
	);
	
	// Breadcrumb Content Section // 
	$wp_customize->add_setting(
		'atua_site_breadcrumb_content'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_text',
			'priority' => 5,
		)
	);

	$wp_customize->add_control(
	'atua_site_breadcrumb_content',
		array(
			'type' => 'hidden',
			'label' => __('Content','atua'),
			'section' => 'atua_site_breadcrumb',
		)
	);
	
	// Height // 
	$wp_customize->add_setting(
    	'atua_breadcrumb_height_option',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_range_value',
			'transport'         => 'postMessage',
			'priority' => 8,
		)
	);
	$wp_customize->add_control( 
		new Atua_Customizer_Range_Control( $wp_customize, 'atua_breadcrumb_height_option', 
			array(
				'label'      => __( 'Top/Bottom Padding', 'atua'),
				'section'  => 'atua_site_breadcrumb',
				'media_query'   => true,
				'input_attr'    => array(
					'mobile'  => array(
						'min'           => 0,
						'max'           => 20,
						'step'          => 1,
						'default_value' => 7,
					),
					'tablet'  => array(
						'min'           => 0,
						'max'           => 20,
						'step'          => 1,
						'default_value' => 7,
					),
					'desktop' => array(
						'min'           => 0,
						'max'           => 20,
						'step'          => 1,
						'default_value' => 7,
					),
				),
			) ) 
		);
		
	// Background // 
	$wp_customize->add_setting(
		'atua_breadcrumb_bg_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_text',
			'priority' => 9,
		)
	);

	$wp_customize->add_control(
	'atua_breadcrumb_bg_options',
		array(
			'type' => 'hidden',
			'label' => __('Background','atua'),
			'section' => 'atua_site_breadcrumb',
		)
	);
	
	// Background Image // 
    $wp_customize->add_setting( 
    	'atua_breadcrumb_bg_img' , 
    	array(
			'default' 			=> esc_url(get_template_directory_uri() .'/assets/images/background/page_title.jpg'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_url',	
			'priority' => 10,
		) 
	);
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'atua_breadcrumb_bg_img' ,
		array(
			'label'          => esc_html__( 'Background Image', 'atua'),
			'section'        => 'atua_site_breadcrumb',
		) 
	));
	
	// Opacity // 
	if ( class_exists( 'Atua_Customizer_Range_Control' ) ) {
	$wp_customize->add_setting(
    	'atua_breadcrumb_img_opacity',
    	array(
	        'default'			=> '0.7',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_range_value',
			'priority'  => 11,
		)
	);
	$wp_customize->add_control( 
	new Atua_Customizer_Range_Control( $wp_customize, 'atua_breadcrumb_img_opacity', 
		array(
			'label'      => __( 'Opacity', 'atua'),
			'section'  => 'atua_site_breadcrumb',
			 'media_query'   => false,
                'input_attr'    => array(
                    'desktop' => array(
                        'min'           => 0,
                        'max'           => 1,
                        'step'          => 0.1,
                        'default_value' => 0.9,
                    ),
                ),
		) ) 
	);
	}
	
	$wp_customize->add_setting(
	'atua_breadcrumb_opacity_color', 
	array(
		'default' => '#000',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
		'priority'  => 12,
    ));
	
	$wp_customize->add_control( 
		new WP_Customize_Color_Control
		($wp_customize, 
			'atua_breadcrumb_opacity_color', 
			array(
				'label'      => __( 'Opacity Color', 'atua'),
				'section'    => 'atua_site_breadcrumb',
			) 
		) 
	);
	
	/*=========================================
	Atua Sidebar
	=========================================*/
	$wp_customize->add_section(
        'atua_sidebar_options',
        array(
        	'priority'      => 8,
            'title' 		=> __('Sidebar Options','atua'),
			'panel'  		=> 'atua_theme_options',
		)
    );
	
	//  Pages Layout // 
	$wp_customize->add_setting(
		'atua_pages_sidebar_option'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'atua_pages_sidebar_option',
		array(
			'type' => 'hidden',
			'label' => __('Sidebar Layout','atua'),
			'section' => 'atua_sidebar_options',
		)
	);
	
	// Default Page
	$wp_customize->add_setting( 
		'atua_default_pg_sidebar_option' , 
			array(
			'default' => 'right_sidebar',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_select',
			'priority' => 2,
		) 
	);

	$wp_customize->add_control(
	'atua_default_pg_sidebar_option' , 
		array(
			'label'          => __( 'Default Page Sidebar Option', 'atua' ),
			'section'        => 'atua_sidebar_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'left_sidebar' 	=> __( 'Left Sidebar', 'atua' ),
				'right_sidebar' 	=> __( 'Right Sidebar', 'atua' ),
				'no_sidebar' 	=> __( 'No Sidebar', 'atua' ),
			) 
		) 
	);
	
	// Archive Page
	$wp_customize->add_setting( 
		'atua_archive_pg_sidebar_option' , 
			array(
			'default' => 'right_sidebar',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_select',
			'priority' => 3,
		) 
	);

	$wp_customize->add_control(
	'atua_archive_pg_sidebar_option' , 
		array(
			'label'          => __( 'Archive Page Sidebar Option', 'atua' ),
			'section'        => 'atua_sidebar_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'left_sidebar' 	=> __( 'Left Sidebar', 'atua' ),
				'right_sidebar' => __( 'Right Sidebar', 'atua' ),
				'no_sidebar' 	=> __( 'No Sidebar', 'atua' ),
			) 
		) 
	);
	
	
	// Single Page
	$wp_customize->add_setting( 
		'atua_single_pg_sidebar_option' , 
			array(
			'default' => 'right_sidebar',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_select',
			'priority' => 4,
		) 
	);

	$wp_customize->add_control(
	'atua_single_pg_sidebar_option' , 
		array(
			'label'          => __( 'Single Page Sidebar Option', 'atua' ),
			'section'        => 'atua_sidebar_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'left_sidebar' 	=> __( 'Left Sidebar', 'atua' ),
				'right_sidebar' => __( 'Right Sidebar', 'atua' ),
				'no_sidebar' 	=> __( 'No Sidebar', 'atua' ),
			) 
		) 
	);
	
	
	// Blog Page
	$wp_customize->add_setting( 
		'atua_blog_pg_sidebar_option' , 
			array(
			'default' => 'right_sidebar',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_select',
			'priority' => 5,
		) 
	);

	$wp_customize->add_control(
	'atua_blog_pg_sidebar_option' , 
		array(
			'label'          => __( 'Blog Page Sidebar Option', 'atua' ),
			'section'        => 'atua_sidebar_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'left_sidebar' 	=> __( 'Left Sidebar', 'atua' ),
				'right_sidebar' => __( 'Right Sidebar', 'atua' ),
				'no_sidebar' 	=> __( 'No Sidebar', 'atua' ),
			) 
		) 
	);
	
	// Search Page
	$wp_customize->add_setting( 
		'atua_search_pg_sidebar_option' , 
			array(
			'default' => 'right_sidebar',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_select',
			'priority' => 5,
		) 
	);

	$wp_customize->add_control(
	'atua_search_pg_sidebar_option' , 
		array(
			'label'          => __( 'Search Page Sidebar Option', 'atua' ),
			'section'        => 'atua_sidebar_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'left_sidebar' 	=> __( 'Left Sidebar', 'atua' ),
				'right_sidebar' => __( 'Right Sidebar', 'atua' ),
				'no_sidebar' 	=> __( 'No Sidebar', 'atua' ),
			) 
		) 
	);
	
	
	// WooCommerce Page
	$wp_customize->add_setting( 
		'atua_shop_pg_sidebar_option' , 
			array(
			'default' => 'right_sidebar',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'atua_sanitize_select',
			'priority' => 6,
		) 
	);

	$wp_customize->add_control(
	'atua_shop_pg_sidebar_option' , 
		array(
			'label'          => __( 'WooCommerce Page Sidebar Option', 'atua' ),
			'section'        => 'atua_sidebar_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'left_sidebar' 	=> __( 'Left Sidebar', 'atua' ),
				'right_sidebar' => __( 'Right Sidebar', 'atua' ),
				'no_sidebar' 	=> __( 'No Sidebar', 'atua' ),
			) 
		) 
	);
	
	// Upgrade
	if ( class_exists( 'Desert_Companion_Customize_Upgrade_Control' ) ) {
		$wp_customize->add_setting(
		'atua_sidebar_option_upsale', 
		array(
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'priority' => 7,
		));
		
		$wp_customize->add_control( 
			new Desert_Companion_Customize_Upgrade_Control
			($wp_customize, 
				'atua_sidebar_option_upsale', 
				array(
					'label'      => __( 'Sidebar Features', 'atua' ),
					'section'    => 'atua_sidebar_options'
				) 
			) 
		);	
	}
	
}
add_action( 'customize_register', 'atua_theme_options_customize' );