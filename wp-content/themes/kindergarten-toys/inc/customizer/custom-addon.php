<?php
/**
* Custom Addons.
*
* @package Kindergarten Toys
*/

$wp_customize->add_section( 'kindergarten_toys_theme_pagination_options',
    array(
    'title'      => esc_html__( 'Customizer Custom Settings', 'kindergarten-toys' ),
    'priority'   => 10,
    'capability' => 'edit_theme_options',
    'panel'      => 'kindergarten_toys_theme_addons_panel',
    )
);

$wp_customize->add_setting('kindergarten_toys_theme_loader',
    array(
        'default' => $kindergarten_toys_default['kindergarten_toys_theme_loader'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kindergarten_toys_sanitize_checkbox',
    )
);
$wp_customize->add_control('kindergarten_toys_theme_loader',
    array(
        'label' => esc_html__('Enable Preloader', 'kindergarten-toys'),
        'section' => 'kindergarten_toys_theme_pagination_options',
        'type' => 'checkbox',
    )
);


// Add Pagination Enable/Disable option to Customizer
$wp_customize->add_setting( 'kindergarten_toys_enable_pagination', 
    array(
        'default'           => true, // Default is enabled
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'kindergarten_toys_sanitize_enable_pagination', // Sanitize the input
    )
);

// Add the control to the Customizer
$wp_customize->add_control( 'kindergarten_toys_enable_pagination', 
    array(
        'label'    => esc_html__( 'Enable Pagination', 'kindergarten-toys' ),
        'section'  => 'kindergarten_toys_theme_pagination_options', // Add to the correct section
        'type'     => 'checkbox',
    )
);

$wp_customize->add_setting( 'kindergarten_toys_theme_pagination_type', 
    array(
        'default'           => 'numeric', // Set "numeric" as the default
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'kindergarten_toys_sanitize_pagination_type', // Use our sanitize function
    )
);

$wp_customize->add_control( 'kindergarten_toys_theme_pagination_type',
    array(
        'label'       => esc_html__( 'Pagination Style', 'kindergarten-toys' ),
        'section'     => 'kindergarten_toys_theme_pagination_options',
        'type'        => 'select',
        'choices'     => array(
            'numeric'      => esc_html__( 'Numeric (Page Numbers)', 'kindergarten-toys' ),
            'newer_older'  => esc_html__( 'Newer/Older (Previous/Next)', 'kindergarten-toys' ), // Renamed to "Newer/Older"
        ),
    )
);

$wp_customize->add_setting( 'kindergarten_toys_theme_pagination_options_alignment',
    array(
    'default'           => $kindergarten_toys_default['kindergarten_toys_theme_pagination_options_alignment'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'kindergarten_toys_sanitize_pagination_meta',
    )
);
$wp_customize->add_control( 'kindergarten_toys_theme_pagination_options_alignment',
    array(
    'label'       => esc_html__( 'Pagination Alignment', 'kindergarten-toys' ),
    'section'     => 'kindergarten_toys_theme_pagination_options',
    'type'        => 'select',
    'choices'     => array(
        'Center'    => esc_html__( 'Center', 'kindergarten-toys' ),
        'Right' => esc_html__( 'Right', 'kindergarten-toys' ),
        'Left'  => esc_html__( 'Left', 'kindergarten-toys' ),
        ),
    )
);

$wp_customize->add_setting('kindergarten_toys_theme_breadcrumb_enable',
array(
    'default' => $kindergarten_toys_default['kindergarten_toys_theme_breadcrumb_enable'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'kindergarten_toys_sanitize_checkbox',
)
);
$wp_customize->add_control('kindergarten_toys_theme_breadcrumb_enable',
    array(
        'label' => esc_html__('Enable Breadcrumb', 'kindergarten-toys'),
        'section' => 'kindergarten_toys_theme_pagination_options',
        'type' => 'checkbox',
    )
);


$wp_customize->add_setting( 'kindergarten_toys_theme_breadcrumb_options_alignment',
    array(
    'default'           => $kindergarten_toys_default['kindergarten_toys_theme_breadcrumb_options_alignment'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'kindergarten_toys_sanitize_pagination_meta',
    )
);
$wp_customize->add_control( 'kindergarten_toys_theme_breadcrumb_options_alignment',
    array(
    'label'       => esc_html__( 'Breadcrumb Alignment', 'kindergarten-toys' ),
    'section'     => 'kindergarten_toys_theme_pagination_options',
    'type'        => 'select',
    'choices'     => array(
        'Center'    => esc_html__( 'Center', 'kindergarten-toys' ),
        'Right' => esc_html__( 'Right', 'kindergarten-toys' ),
        'Left'  => esc_html__( 'Left', 'kindergarten-toys' ),
        ),
    )
);

$wp_customize->add_setting('kindergarten_toys_breadcrumb_font_size',
    array(
        'default'           => $kindergarten_toys_default['kindergarten_toys_breadcrumb_font_size'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'kindergarten_toys_sanitize_number_range',
    )
);
$wp_customize->add_control('kindergarten_toys_breadcrumb_font_size',
    array(
        'label'       => esc_html__('Breadcrumb Font Size', 'kindergarten-toys'),
        'section'     => 'kindergarten_toys_theme_pagination_options',
        'type'        => 'number',
        'input_attrs' => array(
           'min'   => 1,
           'max'   => 45,
           'step'   => 1,
        ),
    )
);