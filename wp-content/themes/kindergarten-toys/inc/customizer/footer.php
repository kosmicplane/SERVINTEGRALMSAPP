<?php
/**
* Footer Settings.
*
* @package Kindergarten Toys
*/

$kindergarten_toys_default = kindergarten_toys_get_default_theme_options();

$wp_customize->add_section( 'kindergarten_toys_footer_widget_area',
	array(
	'title'      => esc_html__( 'Footer Settings', 'kindergarten-toys' ),
	'priority'   => 200,
	'capability' => 'edit_theme_options',
	'panel'      => 'kindergarten_toys_theme_option_panel',
	)
);

$wp_customize->add_setting('kindergarten_toys_display_footer',
    array(
        'default' => $kindergarten_toys_default['kindergarten_toys_display_footer'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kindergarten_toys_sanitize_checkbox',
    )
);
$wp_customize->add_control('kindergarten_toys_display_footer',
    array(
        'label' => esc_html__('Enable Footer', 'kindergarten-toys'),
        'section' => 'kindergarten_toys_footer_widget_area',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'kindergarten_toys_footer_column_layout',
	array(
	'default'           => $kindergarten_toys_default['kindergarten_toys_footer_column_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'kindergarten_toys_sanitize_select',
	)
);
$wp_customize->add_control( 'kindergarten_toys_footer_column_layout',
	array(
	'label'       => esc_html__( 'Footer Column Layout', 'kindergarten-toys' ),
	'section'     => 'kindergarten_toys_footer_widget_area',
	'type'        => 'select',
	'choices'               => array(
		'1' => esc_html__( 'One Column', 'kindergarten-toys' ),
		'2' => esc_html__( 'Two Column', 'kindergarten-toys' ),
		'3' => esc_html__( 'Three Column', 'kindergarten-toys' ),
	    ),
	)
);

$wp_customize->add_setting( 'kindergarten_toys_footer_widget_title_alignment',
        array(
        'default'           => $kindergarten_toys_default['kindergarten_toys_footer_widget_title_alignment'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'kindergarten_toys_sanitize_footer_widget_title_alignment',
        )
);
$wp_customize->add_control( 'kindergarten_toys_footer_widget_title_alignment',
    array(
    'label'       => esc_html__( 'Footer Widget Title Alignment', 'kindergarten-toys' ),
    'section'     => 'kindergarten_toys_footer_widget_area',
    'type'        => 'select',
    'choices'     => array(
        'left' => esc_html__( 'Left', 'kindergarten-toys' ),
        'center'  => esc_html__( 'Center', 'kindergarten-toys' ),
        'right'    => esc_html__( 'Right', 'kindergarten-toys' ),
        ),
    )
);

$wp_customize->add_setting( 'kindergarten_toys_footer_copyright_text',
	array(
	'default'           => $kindergarten_toys_default['kindergarten_toys_footer_copyright_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'kindergarten_toys_footer_copyright_text',
	array(
	'label'    => esc_html__( 'Footer Copyright Text', 'kindergarten-toys' ),
	'section'  => 'kindergarten_toys_footer_widget_area',
	'type'     => 'text',
	)
);

$wp_customize->add_setting('kindergarten_toys_copyright_font_size',
    array(
        'default'           => $kindergarten_toys_default['kindergarten_toys_copyright_font_size'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'kindergarten_toys_sanitize_number_range',
    )
);
$wp_customize->add_control('kindergarten_toys_copyright_font_size',
    array(
        'label'       => esc_html__('Copyright Font Size', 'kindergarten-toys'),
        'section'     => 'kindergarten_toys_footer_widget_area',
        'type'        => 'number',
        'input_attrs' => array(
           'min'   => 5,
           'max'   => 30,
           'step'   => 1,
    	),
    )
);

$wp_customize->add_setting( 'kindergarten_toys_copyright_alignment', array(
    'default'           => 'Default',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'kindergarten_toys_sanitize_copyright_alignment_meta',
) );

$wp_customize->add_control( 'kindergarten_toys_copyright_alignment', array(
    'label'    => esc_html__( 'Copyright Section Alignment', 'kindergarten-toys' ),
    'section'  => 'kindergarten_toys_footer_widget_area',
    'type'     => 'select',
    'choices'  => array(
        'Default' => esc_html__( 'Default View', 'kindergarten-toys' ),
        'Reverse' => esc_html__( 'Reverse View', 'kindergarten-toys' ),
        'Center'  => esc_html__( 'Centered Content', 'kindergarten-toys' ),
    ),
) );

$wp_customize->add_setting( 'kindergarten_toys_footer_widget_background_color', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
));
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'kindergarten_toys_footer_widget_background_color', array(
    'label'     => __('Footer Widget Background Color', 'kindergarten-toys'),
    'description' => __('It will change the complete footer widget background color.', 'kindergarten-toys'),
    'section' => 'kindergarten_toys_footer_widget_area',
    'settings' => 'kindergarten_toys_footer_widget_background_color',
)));

$wp_customize->add_setting('kindergarten_toys_footer_widget_background_image',array(
    'default'   => '',
    'sanitize_callback' => 'esc_url_raw',
));
$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'kindergarten_toys_footer_widget_background_image',array(
    'label' => __('Footer Widget Background Image','kindergarten-toys'),
    'section' => 'kindergarten_toys_footer_widget_area'
)));

$wp_customize->add_setting('kindergarten_toys_enable_to_the_top',
    array(
        'default' => $kindergarten_toys_default['kindergarten_toys_enable_to_the_top'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kindergarten_toys_sanitize_checkbox',
    )
);
$wp_customize->add_control('kindergarten_toys_enable_to_the_top',
    array(
        'label' => esc_html__('Enable To The Top', 'kindergarten-toys'),
        'section' => 'kindergarten_toys_footer_widget_area',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'kindergarten_toys_to_the_top_text',
    array(
    'default'           => $kindergarten_toys_default['kindergarten_toys_to_the_top_text'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'kindergarten_toys_to_the_top_text',
    array(
    'label'    => esc_html__( 'Edit Text Here', 'kindergarten-toys' ),
    'section'  => 'kindergarten_toys_footer_widget_area',
    'type'     => 'text',
    )
);