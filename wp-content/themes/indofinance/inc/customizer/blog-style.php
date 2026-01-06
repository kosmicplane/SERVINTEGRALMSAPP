<?php

function indofinance_blog_style_settings_customize_register( $wp_customize ) {
    // Add panel for blog style settings
    $wp_customize->add_panel(
        'indofinance_blog_style_settings', array(
            'title'    => __( 'Blog Style', 'indofinance' ),
            'priority' => 30,
        )
    );

    // Add section for blog layout
    $wp_customize->add_section( 'indofinance_blog_layout_section', array(
        'title'    => __( 'Blog Layout', 'indofinance' ),
        'priority' => 10,
        'panel'    => 'indofinance_blog_style_settings',
    ) );

    // Setting and control for blog layout (grid or list)
    $wp_customize->add_setting( 'indofinance_blog_layout', array(
        'default'           => 'card',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh', // or 'postMessage' if using live preview
    ) );

    $wp_customize->add_control( 'indofinance_blog_layout_ctrl', array(
        'label'       => __( 'Blog Layout', 'indofinance' ),
        'description' => __( 'Choose between Classic or Card layout for your blog posts. If you want to use dual sidebar then Card layout is recommended.', 'indofinance' ),
        'section'     => 'indofinance_blog_layout_section',
        'settings'    => 'indofinance_blog_layout',
        'type'        => 'select',
        'choices'     => array(
            'classic' => __( 'Classic', 'indofinance' ),
            'card' => __( 'Cards', 'indofinance' ),
        ),
        'priority'    => 10,
    ) );

}

add_action( 'customize_register', 'indofinance_blog_style_settings_customize_register' );
