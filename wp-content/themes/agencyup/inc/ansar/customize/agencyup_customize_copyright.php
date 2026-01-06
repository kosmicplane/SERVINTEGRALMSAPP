<?php // Footer copyright section 
function agencyup_footer_copyright( $wp_customize ) {
	$wp_customize->add_panel('agencyup_copyright', array(
		'priority' => 5,
		'capability' => 'edit_theme_options',
		'title' => __('Footer Settings', 'agencyup'),
	) );

    $wp_customize->add_section('footer_social_icon', array(
        'title' => __('Social Icons','agencyup'),
        'priority' => 20,
        'panel' => 'agencyup_copyright',
    ) );
	
	
	//Enable and disable social icon
	$wp_customize->add_setting(
	'footer_social_icon_enable'
    ,
    array(
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'agencyup_social_sanitize_checkbox',
        'default' => true,
    )
	);
	$wp_customize->add_control(
    'footer_social_icon_enable',
    array(
        'label' => __('Hide / Show','agencyup'),
        'section' => 'footer_social_icon',
        'type' => 'checkbox',
    )
	);

	// Soical facebook link
	$wp_customize->add_setting(
    'agencyup_footer_fb_link',
    array(
		'sanitize_callback' => 'esc_url_raw',
    )
	
	);
	$wp_customize->add_control(
    'agencyup_footer_fb_link',
    array(
        'label' => __('Facebook URL','agencyup'),
        'section' => 'footer_social_icon',
        'type' => 'text',
    )
	);

	$wp_customize->add_setting(
	'agencyup_footer_fb_target',array(
	'sanitize_callback' => 'agencyup_social_sanitize_checkbox',
	'default' => 1,
	));

	$wp_customize->add_control(
    'agencyup_footer_fb_target',
    array(
        'type' => 'checkbox',
        'label' => __('Open link in a new tab','agencyup'),
        'section' => 'footer_social_icon',
    )
	);
	
	
	//Social Twitter link
	$wp_customize->add_setting(
    'agencyup_footer_twt_link',
    array(
		'sanitize_callback' => 'esc_url_raw',
    )
	
	);
	$wp_customize->add_control(
    'agencyup_footer_twt_link',
    array(
        'label' => __('Twitter URL','agencyup'),
        'section' => 'footer_social_icon',
        'type' => 'text',
    )
	);

	$wp_customize->add_setting(
	'agencyup_footer_twt_target',array(
	'sanitize_callback' => 'agencyup_social_sanitize_checkbox',
	'default' => 1,
	));

	$wp_customize->add_control(
    'agencyup_footer_twt_target',
    array(
        'type' => 'checkbox',
        'label' => __('Open link in a new tab','agencyup'),
        'section' => 'footer_social_icon',
    )
	);
	
	//Soical Linkedin link
	$wp_customize->add_setting(
    'agencyup_footer_lnkd_link',
    array(
		'sanitize_callback' => 'esc_url_raw',
    )
	
	);
	$wp_customize->add_control(
    'agencyup_footer_lnkd_link',
    array(
        'label' => __('Linkedin URL','agencyup'),
        'section' => 'footer_social_icon',
        'type' => 'text',
    )
	);

	$wp_customize->add_setting(
	'agencyup_footer_lnkd_target',array(
	'default' => 1,
	'sanitize_callback' => 'agencyup_social_sanitize_checkbox',
	));

	$wp_customize->add_control(
    'agencyup_footer_lnkd_target',
    array(
        'type' => 'checkbox',
        'label' => __('Open link in a new tab','agencyup'),
        'section' => 'footer_social_icon',
    )
	);
	
	
	//Soical Instagram link
	$wp_customize->add_setting(
    'agencyup_footer_insta_link',
    array(
		'sanitize_callback' => 'esc_url_raw',
    )
	
	);
	$wp_customize->add_control(
    'agencyup_footer_insta_link',
    array(
        'label' => __('Instagram URL','agencyup'),
        'section' => 'footer_social_icon',
        'type' => 'text',
    )
	);

	$wp_customize->add_setting(
	'agencyup_footer_indta_target',array(
	'default' => 1,
	'sanitize_callback' => 'agencyup_social_sanitize_checkbox',
	));

	$wp_customize->add_control(
    'agencyup_footer_indta_target',
    array(
        'type' => 'checkbox',
        'label' => __('Open link in a new tab','agencyup'),
        'section' => 'footer_social_icon',
    )
	);

	
	$wp_customize->add_section('footer_widget_back', array(
        'title' => __('Background','agencyup'),
        'priority' => 30,
        'panel' => 'agencyup_copyright',
    ) );
    
    
    
     //Funfact Background image
    $wp_customize->add_setting( 
        'agencyup_footer_widget_background', array(
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'agencyup_footer_widget_background', array(
        'label'    => __( 'Background Image', 'agencyup' ),
        'section'  => 'footer_widget_back',
        'settings' => 'agencyup_footer_widget_background',
    ) ) );

	
	$wp_customize->add_section('footer_widget_column', array(
        'title' => __('Widget column layout','agencyup'),
        'priority' => 30,
		'panel' => 'agencyup_copyright',
    ) );
	
	
	
	 $wp_customize->add_setting(
                'agencyup_footer_column_layout', array(
                'default' => 3,
                'sanitize_callback' => 'agencyup_sanitize_select',
            ) );

            $wp_customize->add_control(
                'agencyup_footer_column_layout', array(
                'type' => 'select',
                'label' => __('Select Column Layout','agencyup'),
                'section' => 'footer_widget_column',
                'choices' => array(1=>1, 2=>2,3=>3,4=>4),
	) );
	
	$wp_customize->add_section('footer social icon', array(
        'title' => __('Footer social icon','agencyup'),
        'priority' => 40,
		'panel' => 'agencyup_copyright',
    ) );
	
	function agencyup_social_sanitize_checkbox( $input ) {
			// Boolean check 
			return ( ( isset( $input ) && true == $input ) ? true : false );
			}



	
	
			
	if ( ! function_exists( 'agencyup_sanitize_select' ) ) :

	/**
	 * Sanitize select.
	 *
	 * @since 1.0.0
	 *
	 * @param mixed                $input The value to sanitize.
	 * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
	 * @return mixed Sanitized value.
	 */
	function agencyup_sanitize_select( $input, $setting ) {

		// Ensure input is a slug.
		$input = sanitize_key( $input );

		// Get list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it; otherwise, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

	}

endif;		
}
add_action( 'customize_register', 'agencyup_footer_copyright' );

function agencyup_customize_partial_agencyup_footer_fb_link() {
    return get_theme_mod( 'agencyup_footer_fb_link' );
}