<?php
/**
* Header Banner Options.
*
* @package Kindergarten Toys
*/

$kindergarten_toys_default = kindergarten_toys_get_default_theme_options();
$kindergarten_toys_post_category_list = kindergarten_toys_post_category_list();

$wp_customize->add_section( 'kindergarten_toys_header_banner_setting',
    array(
    'title'      => esc_html__( 'Slider Settings', 'kindergarten-toys' ),
    'priority'   => 10,
    'capability' => 'edit_theme_options',
    'panel'      => 'theme_home_pannel',
    )
);

$wp_customize->add_setting('kindergarten_toys_display_header_text',
    array(
        'default' => $kindergarten_toys_default['kindergarten_toys_header_banner'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kindergarten_toys_sanitize_checkbox',
    )
);
$wp_customize->add_control('kindergarten_toys_display_header_text',
    array(
        'label' => esc_html__('Enable / Disable Tagline', 'kindergarten-toys'),
        'section' => 'title_tagline',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('kindergarten_toys_header_banner',
    array(
        'default' => $kindergarten_toys_default['kindergarten_toys_header_banner'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kindergarten_toys_sanitize_checkbox',
    )
);
$wp_customize->add_control('kindergarten_toys_header_banner',
    array(
        'label' => esc_html__('Enable Slider', 'kindergarten-toys'),
        'section' => 'kindergarten_toys_header_banner_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'kindergarten_toys_slider_section_title',
    array(
    'default'           => $kindergarten_toys_default['kindergarten_toys_slider_section_title'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'kindergarten_toys_slider_section_title',
    array(
    'label'    => esc_html__( 'Slider Title', 'kindergarten-toys' ),
    'section'  => 'kindergarten_toys_header_banner_setting',
    'type'     => 'text',
    )
);

$wp_customize->add_setting( 'kindergarten_toys_header_banner_cat',
    array(
    'default'           => 'Slider',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'kindergarten_toys_sanitize_select',
    )
);
$wp_customize->add_control( 'kindergarten_toys_header_banner_cat',
    array(
    'label'       => esc_html__( 'Slider Post Category', 'kindergarten-toys' ),
    'section'     => 'kindergarten_toys_header_banner_setting',
    'type'        => 'select',
    'choices'     => $kindergarten_toys_post_category_list,
    )
);

// Courses Settings

$wp_customize->add_section( 'product_column_setting',
    array(
    'title'      => esc_html__( 'Courses Settings', 'kindergarten-toys' ),
    'priority'   => 10,
    'capability' => 'edit_theme_options',
    'panel'      => 'theme_home_pannel',
    )
);

$wp_customize->add_setting( 'kindergarten_toys_locations_post_cat',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'kindergarten_toys_sanitize_select',
    )
);
$wp_customize->add_control( 'kindergarten_toys_locations_post_cat',
    array(
    'label'       => esc_html__( 'Courses Post Category', 'kindergarten-toys' ),
    'section'     => 'product_column_setting',
    'type'        => 'select',
    'choices'     => $kindergarten_toys_post_category_list,
    )
);

for ($i=1; $i <=9 ; $i++) {

    $wp_customize->add_setting( 'kindergarten_toys_course_section_starting_date'.$i,
        array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control( 'kindergarten_toys_course_section_starting_date'.$i,
        array(
        'label'    => esc_html__( 'Starting Date ', 'kindergarten-toys' ) .$i,
        'section'  => 'product_column_setting',
        'type'     => 'text',
        )
    );

    $wp_customize->add_setting( 'kindergarten_toys_course_section_course_price'.$i,
        array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control( 'kindergarten_toys_course_section_course_price'.$i,
        array(
        'label'    => esc_html__( 'Course Price ', 'kindergarten-toys' ) .$i,
        'section'  => 'product_column_setting',
        'type'     => 'text',
        )
    );

    $wp_customize->add_setting( 'kindergarten_toys_course_section_class_time'.$i,
        array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control( 'kindergarten_toys_course_section_class_time'.$i,
        array(
        'label'    => esc_html__( 'Class Time ', 'kindergarten-toys' ) .$i,
        'section'  => 'product_column_setting',
        'type'     => 'text',
        )
    );

    $wp_customize->add_setting( 'kindergarten_toys_course_section_student_age'.$i,
        array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control( 'kindergarten_toys_course_section_student_age'.$i,
        array(
        'label'    => esc_html__( 'Student Age ', 'kindergarten-toys' ) .$i,
        'section'  => 'product_column_setting',
        'type'     => 'text',
        )
    );
}
