<?php
/**
* Layouts Settings.
*
* @package Kindergarten Toys
*/

$kindergarten_toys_default = kindergarten_toys_get_default_theme_options();

// Layout Section.
$wp_customize->add_section( 'kindergarten_toys_layout_setting',
	array(
	'title'      => esc_html__( 'Sidebar Settings', 'kindergarten-toys' ),
	'priority'   => 20,
	'capability' => 'edit_theme_options',
	'panel'      => 'kindergarten_toys_theme_option_panel',
	)
);

$wp_customize->add_setting( 'kindergarten_toys_global_sidebar_layout',
    array(
    'default'           => $kindergarten_toys_default['kindergarten_toys_global_sidebar_layout'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'kindergarten_toys_sanitize_sidebar_option',
    )
);
$wp_customize->add_control( 'kindergarten_toys_global_sidebar_layout',
    array(
    'label'       => esc_html__( 'Global Sidebar Layout', 'kindergarten-toys' ),
    'section'     => 'kindergarten_toys_layout_setting',
    'type'        => 'select',
    'choices'     => array(
        'right-sidebar' => esc_html__( 'Right Sidebar', 'kindergarten-toys' ),
        'left-sidebar'  => esc_html__( 'Left Sidebar', 'kindergarten-toys' ),
        'no-sidebar'    => esc_html__( 'No Sidebar', 'kindergarten-toys' ),
        ),
    )
);

$wp_customize->add_setting('kindergarten_toys_page_sidebar_layout', array(
    'default'           => $kindergarten_toys_default['kindergarten_toys_global_sidebar_layout'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'kindergarten_toys_sanitize_sidebar_option',
));

$wp_customize->add_control('kindergarten_toys_page_sidebar_layout', array(
    'label'       => esc_html__('Single Page Sidebar Layout', 'kindergarten-toys'),
    'section'     => 'kindergarten_toys_layout_setting',
    'type'        => 'select',
    'choices'     => array(
        'right-sidebar' => esc_html__('Right Sidebar', 'kindergarten-toys'),
        'left-sidebar'  => esc_html__('Left Sidebar', 'kindergarten-toys'),
        'no-sidebar'    => esc_html__('No Sidebar', 'kindergarten-toys'),
    ),
));

$wp_customize->add_setting('kindergarten_toys_post_sidebar_layout', array(
    'default'           => $kindergarten_toys_default['kindergarten_toys_global_sidebar_layout'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'kindergarten_toys_sanitize_sidebar_option',
));

$wp_customize->add_control('kindergarten_toys_post_sidebar_layout', array(
    'label'       => esc_html__('Single Post Sidebar Layout', 'kindergarten-toys'),
    'section'     => 'kindergarten_toys_layout_setting',
    'type'        => 'select',
    'choices'     => array(
        'right-sidebar' => esc_html__('Right Sidebar', 'kindergarten-toys'),
        'left-sidebar'  => esc_html__('Left Sidebar', 'kindergarten-toys'),
        'no-sidebar'    => esc_html__('No Sidebar', 'kindergarten-toys'),
    ),
));

$wp_customize->add_setting('kindergarten_toys_sticky_sidebar',
    array(
        'default'           => true,
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kindergarten_toys_sanitize_checkbox',
    )
);
$wp_customize->add_control('kindergarten_toys_sticky_sidebar',
    array(
        'label' => esc_html__('Enable/Disable Sticky Sidebar', 'kindergarten-toys'),
        'section' => 'kindergarten_toys_layout_setting',
        'type' => 'checkbox',
    )
);