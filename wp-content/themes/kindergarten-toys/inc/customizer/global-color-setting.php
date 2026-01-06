<?php
/**
* Global Color  Settings.
*
* @package Kindergarten Toys
*/

$kindergarten_toys_default = kindergarten_toys_get_default_theme_options();

// Layout Section.
$wp_customize->add_section( 'kindergarten_toys_global_color_setting',
	array(
	'title'      => esc_html__( 'Global Color Settings', 'kindergarten-toys' ),
	'priority'   => 21,
	'capability' => 'edit_theme_options',
	'panel'      => 'kindergarten_toys_theme_option_panel',
	)
);

$wp_customize->add_setting( 'kindergarten_toys_global_color',
    array(
    'default'           => '#FE9403',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control( 
    new WP_Customize_Color_Control( 
    $wp_customize, 
    'kindergarten_toys_global_color',
    array(
        'label'      => esc_html__( 'Global Color', 'kindergarten-toys' ),
        'section'    => 'kindergarten_toys_global_color_setting',
        'settings'   => 'kindergarten_toys_global_color',
    ) ) 
);