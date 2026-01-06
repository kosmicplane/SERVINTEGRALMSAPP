<?php
/**
* Color Settings.
* @package Kindergarten Toys
*/

$kindergarten_toys_default = kindergarten_toys_get_default_theme_options();

$wp_customize->add_setting( 'kindergarten_toys_default_text_color',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control( 
    new WP_Customize_Color_Control( 
    $wp_customize, 
    'kindergarten_toys_default_text_color',
    array(
        'label'      => esc_html__( 'Text Color', 'kindergarten-toys' ),
        'section'    => 'colors',
        'settings'   => 'kindergarten_toys_default_text_color',
    ) ) 
);

$wp_customize->add_setting( 'kindergarten_toys_border_color',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control( 
    new WP_Customize_Color_Control( 
    $wp_customize, 
    'kindergarten_toys_border_color',
    array(
        'label'      => esc_html__( 'Border Color', 'kindergarten-toys' ),
        'section'    => 'colors',
        'settings'   => 'kindergarten_toys_border_color',
    ) ) 
);