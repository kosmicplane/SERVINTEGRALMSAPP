<?php
/**
 *  Font Sizes
 *  Google fonts
 *  Excerpt Lenth Controller
 *  Sticky Sidebar
 */ 

function indofinance_options_settings_customize_register( $wp_customize ) {
	$wp_customize->add_panel(
		'indofinance-general-settings', array(
			'title'		=>	__('Indofinance Options', 'indofinance'),
			'priority'	=>	20
		)
	);
// Theme Color Section
$wp_customize->add_section( 'indofinance_colors_section', array(
    'title'    => __( 'Theme Colors', 'indofinance' ),
    'priority' => 25,
    'panel'    => 'indofinance-general-settings', // Associate with the 'indofinance Options' panel
) );

// Primary Theme Color
$wp_customize->add_setting( 'indofinance_theme_color', array(
    'default'           => '#ffc906',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control( new WP_Customize_Color_Control(
    $wp_customize, 'indofinance_theme_color', array(
        'label'    => esc_html__('Primary Theme Color', 'indofinance'),
        'section'  => 'indofinance_colors_section',
        'settings' => 'indofinance_theme_color'
    )
));

// Secondary Theme Color
$wp_customize->add_setting( 'indofinance_secondary_color', array(
    'default'           => '#101828',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control( new WP_Customize_Color_Control(
    $wp_customize, 'indofinance_secondary_color', array(
        'label'    => esc_html__('Secondary Color', 'indofinance'),
        'section'  => 'indofinance_colors_section',
        'settings' => 'indofinance_secondary_color'
    )
));

// Light Color
$wp_customize->add_setting( 'indofinance_light_color', array(
    'default'           => '#ffffff',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control( new WP_Customize_Color_Control(
    $wp_customize, 'indofinance_light_color', array(
        'label'    => esc_html__('Light Color', 'indofinance'),
        'section'  => 'indofinance_colors_section',
        'settings' => 'indofinance_light_color'
    )
));

// Header Background Color
$wp_customize->add_setting( 'indofinance_header_color', array(
    'default'           => '#182d57',
    'sanitize_callback' => 'sanitize_hex_color'
));

$wp_customize->add_control( new WP_Customize_Color_Control(
    $wp_customize, 'indofinance_header_color', array(
        'label'    => esc_html__('Header Background Color', 'indofinance'),
        'section'  => 'indofinance_colors_section',
        'settings' => 'indofinance_header_color'
    )
));


// Add a section within the panel for sticky sidebar
	$wp_customize->add_section( 'indofinance-sticky-sidebar', array(
		'title'    => __( 'Sticky Sidebar', 'indofinance' ),
		'priority' => 30,
		'panel'    => 'indofinance-general-settings', // Associate with the 'General Settings' panel
	) );

// Add a setting for sticky sidebar
	$wp_customize->add_setting( 'indofinance-sticky-sidebar_set', array(
		'default'           => true,
		'sanitize_callback' => 'indofinance_sanitize_checkbox', 
	) );

// Add a control to set the excerpt length
	$wp_customize->add_control( 'indofinance-sticky-sidebar_set_ctrl', array(
		'label'    => __( 'Sticky Sidebar', 'indofinance' ),
		'section'  => 'indofinance-sticky-sidebar',
		'settings' => 'indofinance-sticky-sidebar_set',
		'type'     => 'checkbox',
		'priority' => 10,
	) );

	// Add a section within the panel for sticky sidebar
	$wp_customize->add_section( 'indofinance-disable-readmore', array(
		'title'    => __( 'Read More', 'indofinance' ),
		'priority' => 30,
		'panel'    => 'indofinance-general-settings', // Associate with the 'General Settings' panel
	) );

// Add a setting for sticky sidebar
	$wp_customize->add_setting( 'indofinance-disable-readmore_set', array(
		'default'           => true,
		'sanitize_callback' => 'indofinance_sanitize_checkbox', 
	) );

// Add a control to set the excerpt length
	$wp_customize->add_control( 'indofinance-disable-readmore_set_ctrl', array(
		'label'    => __( 'Read More', 'indofinance' ),
		'section'  => 'indofinance-disable-readmore',
		'settings' => 'indofinance-disable-readmore_set',
		'type'     => 'checkbox',
		'description' => 'Check the box to enable "Read More" button on posts',
		'priority' => 10,
	) );

	// Add a section within the panel for sticky sidebar
	$wp_customize->add_section( 'indofinance-scrolltotop', array(
		'title'    => __( 'Scroll to top', 'indofinance' ),
		'priority' => 30,
		'panel'    => 'indofinance-general-settings', // Associate with the 'General Settings' panel
	) );

// Add a setting for sticky sidebar
	$wp_customize->add_setting( 'indofinance-scrolltotop-set', array(
		'default'           => true,
		'sanitize_callback' => 'indofinance_sanitize_checkbox', 
	) );

// Add a control to set the excerpt length
	$wp_customize->add_control( 'indofinance-scrolltotop-set-ctrl', array(
		'label'    => __( 'Scroll to Top', 'indofinance' ),
		'section'  => 'indofinance-scrolltotop',
		'settings' => 'indofinance-scrolltotop-set',
		'type'     => 'checkbox',
		'description' => 'Check the box to enable "Read More" button on posts',
		'priority' => 10,
	) );

// Ticker Section
$wp_customize->add_section('indofinance_ticker_section', array(
	'title'       => __('News Ticker', 'indofinance'),
	'priority'    => 10,
	'description' => __('Configure the news ticker settings.', 'indofinance'),
));


// Ticker Speed Setting
$wp_customize->add_setting('indofinance_ticker_enable', array(
	'default'           => 1,
	'sanitize_callback' => 'indofinance_sanitize_checkbox',
));

// Ticker Speed Control
$wp_customize->add_control('indofinance_ticker_enable', array(
	'label'    => __('Enable/Disable ticker', 'indofinance'),
	'section'  => 'indofinance_ticker_section',
	'settings' => 'indofinance_ticker_enable',
	'type'     => 'checkbox',
));

// Number of Posts Setting
$wp_customize->add_setting('indofinance_ticker_posts_count', array(
	'default'           => 5,
	'sanitize_callback' => 'absint',
));

// Number of Posts Control
$wp_customize->add_control('indofinance_ticker_posts_count', array(
	'label'    => __('Number of Posts', 'indofinance'),
	'section'  => 'indofinance_ticker_section',
	'settings' => 'indofinance_ticker_posts_count',
	'type'     => 'number',
));

	}
add_action('customize_register', 'indofinance_options_settings_customize_register');
