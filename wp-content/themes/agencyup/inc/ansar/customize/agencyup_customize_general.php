<?php
function agencyup_general_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

    /* General Section */
    $wp_customize->add_panel( 'general_options', array(
        'priority' => 3,
        'capability' => 'edit_theme_options',
        'title' => __('General Settings', 'agencyup'),
    ) );

    //Logo and Background color settings
    $wp_customize->add_section(
        'colors',
        array(
            'priority'      => 1,
            'title'         => __('Colors','agencyup'),
            'panel'         => 'general_options',
        )
    );

    $wp_customize->add_section(
        'header_image',
        array(
            'priority'      => 2,
            'title'         => __('Breadcrumb','agencyup'),
            'panel'         => 'general_options',
        )
    );

    $wp_customize->add_setting( 
        'breadcrumb_display' , 
            array(
            'default' => '1',
            'sanitize_callback' => 'agencyup_general_sanitize_checkbox',
            'capability' => 'edit_theme_options',
            'priority' => 1,
        ) 
    );
    
    $wp_customize->add_control(
    'breadcrumb_display', 
        array(
            'label'       => esc_html__( 'Hide / Show Section', 'agencyup' ),
            'section'     => 'header_image',
            'type'        => 'checkbox'
        ) 
    );

    $wp_customize->add_setting( 
    'breadcrumb_img_type_display' , 
        array(
            'default' => 'scroll',
            'capability'     => 'edit_theme_options',
            'sanitize_callback' => 'agencyup_sanitize_select',
            'priority'  => 10,
        ) 
    );
    
    $wp_customize->add_control(
    'breadcrumb_img_type_display' , 
        array(
            'label'          => __( 'Background Attachment', 'agencyup' ),
            'section'        => 'header_image',
            'type'           => 'select',
            'choices'        => 
            array(
                'inherit' => __( 'Inherit', 'agencyup' ),
                'scroll' => __( 'Scroll', 'agencyup' ),
                'fixed'   => __( 'Fixed', 'agencyup' )
            ) 
        ) 
    );

    $wp_customize->add_setting(
        'header_img_bg_color', array( 'sanitize_callback' => 'sanitize_text_field',
        'default' =>'#00000099',
    ) );
    
    $wp_customize->add_control(new Agencyup_Customize_Alpha_Color_Control( $wp_customize,
        'header_img_bg_color', array(
        'label'      => __('Overlay Color', 'agencyup' ),
        'palette' => true,
        'section' => 'header_image')
    ) );
    $wp_customize->add_setting('agencyup_title_font_size',
        array(
            'default'           => 50,
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control('agencyup_title_font_size',
        array(
            'label'    => esc_html__('Site Title Size', 'agencyup'),
            'section'  => 'title_tagline',
            'type'     => 'number',
            'priority' => 50,
        )
    );

    //Scroller settings
    $wp_customize->add_section(
        'Blog',
        array(
            'priority'      => 1,
            'title'         => __('Scroller','agencyup'),
            'panel'         => 'general_options',
        )
    );

    

    //Scroller settings
    $wp_customize->add_section(
        'scroller',
        array(
            'priority'      => 1,
            'title'         => __('Scroller','agencyup'),
            'panel'         => 'general_options',
        )
    );


    //Enable and disable social icon
    $wp_customize->add_setting(
    'scroller_enable'
    ,
    array(
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'agencyup_social_sanitize_checkbox',
        'default'  => 0,
    )   
    );
    $wp_customize->add_control(
    'scroller_enable',
    array(
        'label' => __('Hide / Show','agencyup'),
        'section' => 'scroller',
        'type' => 'checkbox',
    )
    );
}
add_action( 'customize_register', 'agencyup_general_setting' );



function agencyup_general_sanitize_checkbox( $input ) {
            // Boolean check 
    return ( ( isset( $input ) && true == $input ) ? true : false );
    
    }
add_action( 'customize_register', 'agencyup_general_sanitize_checkbox' );


function agencyup_sanitize_select( $input, $setting ) {
    
    // Ensure input is a slug.
    $input = sanitize_key( $input );
    
    // Get list of choices from the control associated with the setting.
    $choices = $setting->manager->get_control( $setting->id )->choices;
    
    // If the input is a valid key, return it; otherwise, return the default.
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}