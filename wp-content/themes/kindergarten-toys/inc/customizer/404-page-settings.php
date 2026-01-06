<?php
/**
* 404 Page Settings.
*
* @package Kindergarten Toys
*/

$kindergarten_toys_default = kindergarten_toys_get_default_theme_options();

$wp_customize->add_section( 'kindergarten_toys_404_page_settings',
    array(
        'title'      => esc_html__( '404 Page Settings', 'kindergarten-toys' ),
        'priority'   => 200,
        'capability' => 'edit_theme_options',
        'panel'      => 'kindergarten_toys_theme_addons_panel',
    )
);

$wp_customize->add_setting( 'kindergarten_toys_404_main_title',
    array(
        'default'           => $kindergarten_toys_default['kindergarten_toys_404_main_title'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'kindergarten_toys_404_main_title',
    array(
        'label'    => esc_html__( '404 Main Title', 'kindergarten-toys' ),
        'section'  => 'kindergarten_toys_404_page_settings',
        'type'     => 'text',
    )
);

$wp_customize->add_setting( 'kindergarten_toys_404_subtitle_one',
    array(
        'default'           => $kindergarten_toys_default['kindergarten_toys_404_subtitle_one'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'kindergarten_toys_404_subtitle_one',
    array(
        'label'    => esc_html__( '404 Sub Title One', 'kindergarten-toys' ),
        'section'  => 'kindergarten_toys_404_page_settings',
        'type'     => 'text',
    )
);

$wp_customize->add_setting( 'kindergarten_toys_404_para_one',
    array(
        'default'           => $kindergarten_toys_default['kindergarten_toys_404_para_one'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'kindergarten_toys_404_para_one',
    array(
        'label'    => esc_html__( '404 Para Text One', 'kindergarten-toys' ),
        'section'  => 'kindergarten_toys_404_page_settings',
        'type'     => 'text',
    )
);

$wp_customize->add_setting( 'kindergarten_toys_404_subtitle_two',
    array(
        'default'           => $kindergarten_toys_default['kindergarten_toys_404_subtitle_two'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'kindergarten_toys_404_subtitle_two',
    array(
        'label'    => esc_html__( '404 Sub Title Two', 'kindergarten-toys' ),
        'section'  => 'kindergarten_toys_404_page_settings',
        'type'     => 'text',
    )
);

$wp_customize->add_setting( 'kindergarten_toys_404_para_two',
    array(
        'default'           => $kindergarten_toys_default['kindergarten_toys_404_para_two'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'kindergarten_toys_404_para_two',
    array(
        'label'    => esc_html__( '404 Para Text Two', 'kindergarten-toys' ),
        'section'  => 'kindergarten_toys_404_page_settings',
        'type'     => 'text',
    )
);