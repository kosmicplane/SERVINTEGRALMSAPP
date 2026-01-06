<?php
/**
* Typography Settings.
*
* @package Kindergarten Toys
*/

$kindergarten_toys_default = kindergarten_toys_get_default_theme_options();

// Layout Section.
$wp_customize->add_section( 'kindergarten_toys_typography_setting',
	array(
	'title'      => esc_html__( 'Typography Settings', 'kindergarten-toys' ),
	'priority'   => 21,
	'capability' => 'edit_theme_options',
	'panel'      => 'kindergarten_toys_theme_option_panel',
	)
);

// -----------------  Font array
$kindergarten_toys_fonts = array(
    'Select'           => __('Default Font', 'kindergarten-toys'),
    'bad-script' => 'Bad Script',
    'bitter'     => 'Bitter',
    'charis-sil' => 'Charis SIL',
    'cuprum'     => 'Cuprum',
    'exo-2'      => 'Exo 2',
    'jost'       => 'Jost',
    'open-sans'  => 'Open Sans',
    'oswald'     => 'Oswald',
    'play'       => 'Play',
    'roboto'     => 'Roboto',
    'ubuntu'     => 'Ubuntu',
    'Poppins'     => 'Poppins',
);

 // -----------------  General text font
 $wp_customize->add_setting( 'kindergarten_toys_content_typography_font', array(
    'default'           => 'Poppins',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'kindergarten_toys_radio_sanitize',
) );
$wp_customize->add_control( 'kindergarten_toys_content_typography_font', array(
    'type'     => 'select',
    'label'    => esc_html__( 'General Content Font', 'kindergarten-toys' ),
    'section'  => 'kindergarten_toys_typography_setting',
    'settings' => 'kindergarten_toys_content_typography_font',
    'choices'  => $kindergarten_toys_fonts,
) );

 // -----------------  General Heading Font
$wp_customize->add_setting( 'kindergarten_toys_heading_typography_font', array(
    'default'           => 'Poppins',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'kindergarten_toys_radio_sanitize',
) );
$wp_customize->add_control( 'kindergarten_toys_heading_typography_font', array(
    'type'     => 'select',
    'label'    => esc_html__( 'General Heading Font', 'kindergarten-toys' ),
    'section'  => 'kindergarten_toys_typography_setting',
    'settings' => 'kindergarten_toys_heading_typography_font',
    'choices'  => $kindergarten_toys_fonts,
) );