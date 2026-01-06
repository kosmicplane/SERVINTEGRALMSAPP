<?php
/*
* Custom Copyright Text
* Enable Additional Footer Menu
* 
*/
function indofinance_footer_customize_register($wp_customize) {

	$wp_customize->add_panel(
		'indofinance-footer-panel', array(
			'title'		=>	__('Footer', 'indofinance'),
			'priority'	=>	20
		)
	);
	
	$wp_customize->add_section(
		'indofinance-footer-section', array(
			'title'		=>	__('Copyright Text', 'indofinance'),
			'panel'		=> 'indofinance-footer-panel',
			'priority'	=>	20
		)
	);
	
	$wp_customize->add_setting(
		'indofinance-copyright-text', array(
			'sanitize_callback'	=>	'sanitize_text_field', 
			'default'		=>	__('&copy; ','indofinance').esc_html(get_bloginfo('name')).__(" ", 'indofinance').date('Y'),
			
		)
	);
	
	$wp_customize->add_control(
		'indofinance-copyright-text', array(
			  'type' => 'text',
			  'section'		=>	'indofinance-footer-section',
			  'label' => __( 'Copyright Text','indofinance' ),
			  'description' => __( 'Enter your own Copyright text. Default Copyright Message is (c) Sitename and Year.','indofinance' ),
			)	
	);

		
	$wp_customize->add_section(
		'indofinance-footer-layout', array(
			'title'		=>	__('Footer Layout', 'indofinance'),
			'panel'		=> 'indofinance-footer-panel',
			'priority'	=>	20
		)
	);

	 // Add Setting
	 $wp_customize->add_setting( 'indofinance_footer_column_choice', array(
        'default'           => 'four-columns', // Set default value
        'sanitize_callback' => 'indofinance_sanitize_select', // Sanitize input
        'transport'         => 'refresh', // How the customizer should update the setting (refresh the page by default)
    ));

    // Add Control
    $wp_customize->add_control( 'indofinance_footer_column_choice', array(
        'label'       => __( 'Footer Column Layout', 'indofinance' ),
        'section'     => 'indofinance-footer-layout',
        'settings'    => 'indofinance_footer_column_choice',
        'type'        => 'select',
        'choices'     => array(
            'one-column'   => __( 'One Column', 'indofinance' ),
            'two-columns'  => __( 'Two Columns', 'indofinance' ),
            'three-columns' => __( 'Three Columns', 'indofinance' ),
            'four-columns' => __( 'Four Columns', 'indofinance' ),
        ),
	));


		// Add section for footer settings
		$wp_customize->add_section('indofinance_footer_section', array(
			'title'    => __('Footer Background Image', 'indofinance'),
			'priority' => 30,
			'panel'    => 'indofinance-footer-panel'
		));
		
		// Add setting for footer background image
		$wp_customize->add_setting('indofinance_footer_background_image', array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => 'refresh',
		));
		
		// Add control for footer background image
		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'indofinance_footer_background_image', array(
			'label'    => __('Footer Background Image', 'indofinance'),
			'section'  => 'indofinance_footer_section',
			'settings' => 'indofinance_footer_background_image',
		)));	
		
	}

add_action('customize_register','indofinance_footer_customize_register');