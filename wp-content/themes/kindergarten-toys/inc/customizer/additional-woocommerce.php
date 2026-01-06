<?php
/**
* Additional Woocommerce Settings.
*
* @package Kindergarten Toys
*/

$kindergarten_toys_default = kindergarten_toys_get_default_theme_options();

// Additional Woocommerce Section.
$wp_customize->add_section( 'kindergarten_toys_additional_woocommerce_options',
	array(
	'title'      => esc_html__( 'Additional Woocommerce Options', 'kindergarten-toys' ),
	'priority'   => 210,
	'capability' => 'edit_theme_options',
	'panel'      => 'kindergarten_toys_theme_option_panel',
	)
);

	$wp_customize->add_setting('kindergarten_toys_per_columns',
		array(
		'default'           => $kindergarten_toys_default['kindergarten_toys_per_columns'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'kindergarten_toys_sanitize_number_range',
		)
	);
	$wp_customize->add_control('kindergarten_toys_per_columns',
		array(
		'label'       => esc_html__('Products Per Column', 'kindergarten-toys'),
		'section'     => 'kindergarten_toys_additional_woocommerce_options',
		'type'        => 'number',
		'input_attrs' => array(
		'min'   => 1,
		'max'   => 6,
		'step'   => 1,
		),
		)
	);

	$wp_customize->add_setting('kindergarten_toys_product_per_page',
		array(
		'default'           => $kindergarten_toys_default['kindergarten_toys_product_per_page'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'kindergarten_toys_sanitize_number_range',
		)
	);
	$wp_customize->add_control('kindergarten_toys_product_per_page',
		array(
		'label'       => esc_html__('Products Per Page', 'kindergarten-toys'),
		'section'     => 'kindergarten_toys_additional_woocommerce_options',
		'type'        => 'number',
		'input_attrs' => array(
		'min'   => 1,
		'max'   => 100,
		'step'   => 1,
		),
		)
	);

	$wp_customize->add_setting('kindergarten_toys_show_hide_related_product',
    array(
        'default' => $kindergarten_toys_default['kindergarten_toys_show_hide_related_product'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kindergarten_toys_sanitize_checkbox',
    )
	);
	$wp_customize->add_control('kindergarten_toys_show_hide_related_product',
	    array(
	        'label' => esc_html__('Enable Related Products', 'kindergarten-toys'),
	        'section' => 'kindergarten_toys_additional_woocommerce_options',
	        'type' => 'checkbox',
	    )
	);

	$wp_customize->add_setting('kindergarten_toys_custom_related_products_number',
		array(
		'default'           => $kindergarten_toys_default['kindergarten_toys_custom_related_products_number'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'kindergarten_toys_sanitize_number_range',
		)
	);
	$wp_customize->add_control('kindergarten_toys_custom_related_products_number',
		array(
		'label'       => esc_html__('Related Products Per Page', 'kindergarten-toys'),
		'section'     => 'kindergarten_toys_additional_woocommerce_options',
		'type'        => 'number',
		'input_attrs' => array(
		'min'   => 1,
		'max'   => 10,
		'step'   => 1,
		),
		)
	);

	$wp_customize->add_setting('kindergarten_toys_custom_related_products_number_per_row',
		array(
		'default'           => $kindergarten_toys_default['kindergarten_toys_custom_related_products_number_per_row'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'kindergarten_toys_sanitize_number_range',
		)
	);
	$wp_customize->add_control('kindergarten_toys_custom_related_products_number_per_row',
		array(
		'label'       => esc_html__('Related Products Per Row', 'kindergarten-toys'),
		'section'     => 'kindergarten_toys_additional_woocommerce_options',
		'type'        => 'number',
		'input_attrs' => array(
		'min'   => 1,
		'max'   => 5,
		'step'   => 1,
		),
		)
	);