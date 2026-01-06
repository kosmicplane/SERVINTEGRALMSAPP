<?php
/**
* Header Options.
*
* @package Kindergarten Toys
*/

$kindergarten_toys_default = kindergarten_toys_get_default_theme_options();

// Header Section.
$wp_customize->add_section( 'kindergarten_toys_button_header_setting',
	array(
	'title'      => esc_html__( 'Header Settings', 'kindergarten-toys' ),
	'priority'   => 10,
	'capability' => 'edit_theme_options',
	'panel'      => 'kindergarten_toys_theme_option_panel',
	)
);


$wp_customize->add_setting('kindergarten_toys_sticky',
    array(
        'default' => $kindergarten_toys_default['kindergarten_toys_sticky'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kindergarten_toys_sanitize_checkbox',
    )
);
$wp_customize->add_control('kindergarten_toys_sticky',
    array(
        'label' => esc_html__('Enable Sticky Header', 'kindergarten-toys'),
        'section' => 'kindergarten_toys_button_header_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('kindergarten_toys_header_search',
    array(
        'default' => $kindergarten_toys_default['kindergarten_toys_header_search'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kindergarten_toys_sanitize_checkbox',
    )
);
$wp_customize->add_control('kindergarten_toys_header_search',
    array(
        'label' => esc_html__('Enable Search', 'kindergarten-toys'),
        'section' => 'kindergarten_toys_button_header_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('kindergarten_toys_display_header_toggle',
    array(
        'default' => $kindergarten_toys_default['kindergarten_toys_display_header_toggle'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kindergarten_toys_sanitize_checkbox',
    )
);
$wp_customize->add_control('kindergarten_toys_display_header_toggle',
    array(
        'label' => esc_html__('Enable Toggle', 'kindergarten-toys'),
        'section' => 'kindergarten_toys_button_header_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'kindergarten_toys_header_layout_phone_number',
    array(
    'default'           => $kindergarten_toys_default['kindergarten_toys_header_layout_phone_number'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'kindergarten_toys_header_layout_phone_number',
    array(
    'label'    => esc_html__( 'Header Phone Number', 'kindergarten-toys' ),
    'section'  => 'kindergarten_toys_button_header_setting',
    'type'     => 'text',
    )
);

$wp_customize->add_setting( 'kindergarten_toys_header_layout_text',
    array(
    'default'           => $kindergarten_toys_default['kindergarten_toys_header_layout_text'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'kindergarten_toys_header_layout_text',
    array(
    'label'    => esc_html__( 'Header Discount Text', 'kindergarten-toys' ),
    'section'  => 'kindergarten_toys_button_header_setting',
    'type'     => 'text',
    )
);

$wp_customize->add_setting('kindergarten_toys_menu_font_size',
    array(
        'default'           => $kindergarten_toys_default['kindergarten_toys_menu_font_size'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'kindergarten_toys_sanitize_number_range',
    )
);
$wp_customize->add_control('kindergarten_toys_menu_font_size',
    array(
        'label'       => esc_html__('Menu Font Size', 'kindergarten-toys'),
        'section'     => 'kindergarten_toys_button_header_setting',
        'type'        => 'number',
        'input_attrs' => array(
           'min'   => 1,
           'max'   => 30,
           'step'   => 1,
        ),
    )
);


$wp_customize->add_setting( 'kindergarten_toys_menu_text_transform',
    array(
    'default'           => $kindergarten_toys_default['kindergarten_toys_menu_text_transform'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'kindergarten_toys_sanitize_menu_transform',
    )
);
$wp_customize->add_control( 'kindergarten_toys_menu_text_transform',
    array(
    'label'       => esc_html__( 'Menu Text Transform', 'kindergarten-toys' ),
    'section'     => 'kindergarten_toys_button_header_setting',
    'type'        => 'select',
    'choices'     => array(
        'capitalize' => esc_html__( 'Capitalize', 'kindergarten-toys' ),
        'uppercase'  => esc_html__( 'Uppercase', 'kindergarten-toys' ),
        'lowercase'    => esc_html__( 'Lowercase', 'kindergarten-toys' ),
        ),
    )
);

$wp_customize->add_setting( 'kindergarten_toys_header_layout_button',
    array(
    'default'           => $kindergarten_toys_default['kindergarten_toys_header_layout_button'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'kindergarten_toys_header_layout_button',
    array(
    'label'    => esc_html__( 'Header Button Text', 'kindergarten-toys' ),
    'section'  => 'kindergarten_toys_button_header_setting',
    'type'     => 'text',
    )
);

$wp_customize->add_setting( 'kindergarten_toys_header_layout_button_url',
    array(
    'default'           => $kindergarten_toys_default['kindergarten_toys_header_layout_button_url'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'kindergarten_toys_header_layout_button_url',
    array(
    'label'    => esc_html__( 'Header Button Url', 'kindergarten-toys' ),
    'section'  => 'kindergarten_toys_button_header_setting',
    'type'     => 'url',
    )
);