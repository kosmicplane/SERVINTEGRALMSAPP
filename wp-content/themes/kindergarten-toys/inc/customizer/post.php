<?php
/**
* Posts Settings.
*
* @package Kindergarten Toys
*/

$kindergarten_toys_default = kindergarten_toys_get_default_theme_options();

// Single Post Section.
$wp_customize->add_section( 'kindergarten_toys_single_posts_settings',
    array(
    'title'      => esc_html__( 'Single Meta Information Settings', 'kindergarten-toys' ),
    'priority'   => 35,
    'capability' => 'edit_theme_options',
    'panel'      => 'kindergarten_toys_theme_option_panel',
    )
);

$wp_customize->add_setting('kindergarten_toys_display_single_post_image',
    array(
        'default' => $kindergarten_toys_default['kindergarten_toys_display_single_post_image'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kindergarten_toys_sanitize_checkbox',
    )
);
$wp_customize->add_control('kindergarten_toys_display_single_post_image',
    array(
        'label' => esc_html__('Enable Single Posts Image', 'kindergarten-toys'),
        'section' => 'kindergarten_toys_single_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('kindergarten_toys_post_author',
    array(
        'default' => $kindergarten_toys_default['kindergarten_toys_post_author'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kindergarten_toys_sanitize_checkbox',
    )
);
$wp_customize->add_control('kindergarten_toys_post_author',
    array(
        'label' => esc_html__('Enable Posts Author', 'kindergarten-toys'),
        'section' => 'kindergarten_toys_single_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('kindergarten_toys_post_date',
    array(
        'default' => $kindergarten_toys_default['kindergarten_toys_post_date'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kindergarten_toys_sanitize_checkbox',
    )
);
$wp_customize->add_control('kindergarten_toys_post_date',
    array(
        'label' => esc_html__('Enable Posts Date', 'kindergarten-toys'),
        'section' => 'kindergarten_toys_single_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('kindergarten_toys_post_category',
    array(
        'default' => $kindergarten_toys_default['kindergarten_toys_post_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kindergarten_toys_sanitize_checkbox',
    )
);
$wp_customize->add_control('kindergarten_toys_post_category',
    array(
        'label' => esc_html__('Enable Posts Category', 'kindergarten-toys'),
        'section' => 'kindergarten_toys_single_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('kindergarten_toys_post_tags',
    array(
        'default' => $kindergarten_toys_default['kindergarten_toys_post_tags'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kindergarten_toys_sanitize_checkbox',
    )
);
$wp_customize->add_control('kindergarten_toys_post_tags',
    array(
        'label' => esc_html__('Enable Posts Tags', 'kindergarten-toys'),
        'section' => 'kindergarten_toys_single_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'kindergarten_toys_single_page_content_alignment',
    array(
    'default'           => $kindergarten_toys_default['kindergarten_toys_single_page_content_alignment'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'kindergarten_toys_sanitize_page_content_alignment',
    )
);
$wp_customize->add_control( 'kindergarten_toys_single_page_content_alignment',
    array(
    'label'       => esc_html__( 'Single Page Content Alignment', 'kindergarten-toys' ),
    'section'     => 'kindergarten_toys_single_posts_settings',
    'type'        => 'select',
    'choices'     => array(
        'left' => esc_html__( 'Left', 'kindergarten-toys' ),
        'center'  => esc_html__( 'Center', 'kindergarten-toys' ),
        'right'    => esc_html__( 'Right', 'kindergarten-toys' ),
        ),
    )
);

$wp_customize->add_setting( 'kindergarten_toys_single_post_content_alignment',
    array(
    'default'           => $kindergarten_toys_default['kindergarten_toys_single_post_content_alignment'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'kindergarten_toys_sanitize_page_content_alignment',
    )
);
$wp_customize->add_control( 'kindergarten_toys_single_post_content_alignment',
    array(
    'label'       => esc_html__( 'Single Post Content Alignment', 'kindergarten-toys' ),
    'section'     => 'kindergarten_toys_single_posts_settings',
    'type'        => 'select',
    'choices'     => array(
        'left' => esc_html__( 'Left', 'kindergarten-toys' ),
        'center'  => esc_html__( 'Center', 'kindergarten-toys' ),
        'right'    => esc_html__( 'Right', 'kindergarten-toys' ),
        ),
    )
);

// Archive Post Section.
$wp_customize->add_section( 'kindergarten_toys_posts_settings',
    array(
    'title'      => esc_html__( 'Archive Meta Information Settings', 'kindergarten-toys' ),
    'priority'   => 36,
    'capability' => 'edit_theme_options',
    'panel'      => 'kindergarten_toys_theme_option_panel',
    )
);

$wp_customize->add_setting('kindergarten_toys_display_archive_post_format_icon',
    array(
        'default' => $kindergarten_toys_default['kindergarten_toys_display_archive_post_format_icon'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kindergarten_toys_sanitize_checkbox',
    )
);
$wp_customize->add_control('kindergarten_toys_display_archive_post_format_icon',
    array(
        'label' => esc_html__('Enable Posts Format Icon', 'kindergarten-toys'),
        'section' => 'kindergarten_toys_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('kindergarten_toys_display_archive_post_image',
    array(
        'default' => $kindergarten_toys_default['kindergarten_toys_display_archive_post_image'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kindergarten_toys_sanitize_checkbox',
    )
);
$wp_customize->add_control('kindergarten_toys_display_archive_post_image',
    array(
        'label' => esc_html__('Enable Posts Image', 'kindergarten-toys'),
        'section' => 'kindergarten_toys_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('kindergarten_toys_display_archive_post_category',
    array(
        'default' => $kindergarten_toys_default['kindergarten_toys_display_archive_post_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kindergarten_toys_sanitize_checkbox',
    )
);
$wp_customize->add_control('kindergarten_toys_display_archive_post_category',
    array(
        'label' => esc_html__('Enable Posts Category', 'kindergarten-toys'),
        'section' => 'kindergarten_toys_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('kindergarten_toys_display_archive_post_title',
    array(
        'default' => $kindergarten_toys_default['kindergarten_toys_display_archive_post_title'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kindergarten_toys_sanitize_checkbox',
    )
);
$wp_customize->add_control('kindergarten_toys_display_archive_post_title',
    array(
        'label' => esc_html__('Enable Posts Title', 'kindergarten-toys'),
        'section' => 'kindergarten_toys_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('kindergarten_toys_display_archive_post_content',
    array(
        'default' => $kindergarten_toys_default['kindergarten_toys_display_archive_post_content'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kindergarten_toys_sanitize_checkbox',
    )
);
$wp_customize->add_control('kindergarten_toys_display_archive_post_content',
    array(
        'label' => esc_html__('Enable Posts Content', 'kindergarten-toys'),
        'section' => 'kindergarten_toys_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('kindergarten_toys_display_archive_post_button',
    array(
        'default' => $kindergarten_toys_default['kindergarten_toys_display_archive_post_button'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kindergarten_toys_sanitize_checkbox',
    )
);
$wp_customize->add_control('kindergarten_toys_display_archive_post_button',
    array(
        'label' => esc_html__('Enable Posts Button', 'kindergarten-toys'),
        'section' => 'kindergarten_toys_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('kindergarten_toys_excerpt_limit',
    array(
        'default'           => $kindergarten_toys_default['kindergarten_toys_excerpt_limit'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'kindergarten_toys_sanitize_number_range',
    )
);
$wp_customize->add_control('kindergarten_toys_excerpt_limit',
    array(
        'label'       => esc_html__('Blog Posts Excerpt limit', 'kindergarten-toys'),
        'section'     => 'kindergarten_toys_posts_settings',
        'type'        => 'number',
        'input_attrs' => array(
           'min'   => 1,
           'max'   => 100,
           'step'   => 1,
        ),
    )
);

$wp_customize->add_setting( 'kindergarten_toys_archive_image_size',
	array(
	'default'           => 'medium',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'kindergarten_toys_sanitize_select',
	)
);
$wp_customize->add_control( 'kindergarten_toys_archive_image_size',
	array(
	'label'       => esc_html__( 'Blog Posts Image Size', 'kindergarten-toys' ),
	'section'     => 'kindergarten_toys_posts_settings',
	'type'        => 'select',
	'choices'               => array(
		'full' => esc_html__( 'Large Size Image', 'kindergarten-toys' ),
		'large' => esc_html__( 'Big Size Image', 'kindergarten-toys' ),
		'medium' => esc_html__( 'Medium Size Image', 'kindergarten-toys' ),
		'small' => esc_html__( 'Small Size Image', 'kindergarten-toys' ),
		'xsmall' => esc_html__( 'Extra Small Size Image', 'kindergarten-toys' ),
		'thumbnail' => esc_html__( 'Thumbnail Size Image', 'kindergarten-toys' ),
	    ),
	)
);

$wp_customize->add_setting('kindergarten_toys_posts_per_columns',
    array(
    'default'           => '3',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'kindergarten_toys_sanitize_number_range',
    )
);
$wp_customize->add_control('kindergarten_toys_posts_per_columns',
    array(
    'label'       => esc_html__('Blog Posts Per Column', 'kindergarten-toys'),
    'section'     => 'kindergarten_toys_posts_settings',
    'type'        => 'number',
    'input_attrs' => array(
    'min'   => 1,
    'max'   => 6,
    'step'   => 1,
    ),
    )
);