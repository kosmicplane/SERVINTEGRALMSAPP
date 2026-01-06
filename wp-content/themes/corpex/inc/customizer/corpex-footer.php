<?php
function corpex_footer( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	// Footer Panel // 
	$wp_customize->add_panel( 
		'footer_section', 
		array(
			'priority'      => 34,
			'capability'    => 'edit_theme_options',
			'title'			=> __('Footer', 'corpex'),
		) 
	);
	
	/*=========================================
	Footer Above
	=========================================*/	
	$wp_customize->add_section(
        'footer_above',
        array(
            'title' 		=> __('Footer Above','corpex'),
			'panel'  		=> 'footer_section',
			'priority'      => 2,
		)
    );
	
	//Above Footer Documentation Link
	class WP_footer_above_Customize_Control extends WP_Customize_Control {
	public $type = 'new_menu';

	   function render_content()
	   
	   {
	   ?>
			<h3>How to use above footer section :</h3>
			<p>Footer > Above Footer <br><br> <a href="#" style="background-color:rgba(223, 69, 44, 1);; color:#fff;display: flex;align-items: center;justify-content: center;text-decoration: none;   font-weight: 600;padding: 15px 10px;">Click Here</a></p>
			
		<?php
	   }
	}
	
	// Above Footer Doc Link // 
	$wp_customize->add_setting( 
		'footer_above_doc_link' , 
			array(
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);

	$wp_customize->add_control(new WP_footer_above_Customize_Control($wp_customize,
	'footer_above_doc_link' , 
		array(
			'label'          => __( 'Footer Above Documentation Link', 'corpex' ),
			'section'        => 'footer_above',
			'type'           => 'radio',
			'description'    => __( 'Sidebar Documentation Link', 'corpex' ), 
		) 
	) );
	
	// hide/show
	$wp_customize->add_setting( 
		'hs_above_footer' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'corpex_sanitize_checkbox',
			'priority' => 1,
		) 
	);
	
	$wp_customize->add_control(
	'hs_above_footer', 
		array(
			'label'	      => esc_html__( 'Hide/Show', 'corpex' ),
			'section'     => 'footer_above',
			'type'        => 'checkbox'
		) 
	);	
	
	$wp_customize->add_setting(
		'footer_info_content_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpex_sanitize_text',
			'priority' => 7,
		)
	);

	$wp_customize->add_control(
	'footer_info_content_head',
		array(
			'type' => 'hidden',
			'label' => __('Footer Info','corpex'),
			'section' => 'footer_above',
		)
	);
	
	// Info Left Title
	$wp_customize->add_setting(
    	'footer_info_left_title',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpex_sanitize_html',
		)
	);	

	$wp_customize->add_control( 
		'footer_info_left_title',
		array(
		    'label'   		=> __('Left Title','corpex'),
		    'section'		=> 'footer_above',
			'type' 			=> 'text',
		)  
	);	
	
	// info Left Subtitle
	$wp_customize->add_setting(
    	'footer_info_left_subtitle',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpex_sanitize_text',
		)
	);	

	$wp_customize->add_control( 
		'footer_info_left_subtitle',
		array(
		    'label'   		=> __('Left Subtitle','corpex'),
		    'section'		=> 'footer_above',
			'type' 			=> 'text',
		)  
	);	
	
	// Info Left icon // 
	$wp_customize->add_setting(
    	'footer_info_left_icon',
    	array(
	        'default' => 'fa-headphones',
			'sanitize_callback' => 'sanitize_text_field',
			'capability' => 'edit_theme_options',
			'priority' => 4,
		)
	);	

	$wp_customize->add_control(new corpex_Icon_Picker_Control($wp_customize, 
		'footer_info_left_icon',
		array(
		    'label'   		=> __('Left Icon','corpex'),
		    'section' 		=> 'footer_above',
			'iconset' => 'fa',
			
		))  
	);
	
	// Info Left Image // 
	$wp_customize->add_setting( 
    	'footer_info_left_bg_image' , 
    	array(
			'default'			=> esc_url(get_template_directory_uri() .'/assets/images/ft-1.jpg'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpex_sanitize_url',	
			'priority' => 14,
		) 
	);
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'footer_info_left_bg_image' ,
		array(
			'label'          => __( 'Footer Left Background Image', 'corpex' ),
			'section'        => 'footer_above',
		) 
	));
	
	
	
	// Info Right Title
	$wp_customize->add_setting(
    	'footer_info_right_title',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpex_sanitize_html',
		)
	);	

	$wp_customize->add_control( 
		'footer_info_right_title',
		array(
		    'label'   		=> __('Right Title','corpex'),
		    'section'		=> 'footer_above',
			'type' 			=> 'text',
		)  
	);	
	
	// info Right Subtitle
	$wp_customize->add_setting(
    	'footer_info_right_subtitle',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpex_sanitize_text',
		)
	);	

	$wp_customize->add_control( 
		'footer_info_right_subtitle',
		array(
		    'label'   		=> __('Right Subtitle','corpex'),
		    'section'		=> 'footer_above',
			'type' 			=> 'text',
		)  
	);	
	
	// Info Right icon // 
	$wp_customize->add_setting(
    	'footer_info_right_icon',
    	array(
	        'default' => 'fa-database',
			'sanitize_callback' => 'sanitize_text_field',
			'capability' => 'edit_theme_options',
			'priority' => 4,
		)
	);	

	$wp_customize->add_control(new corpex_Icon_Picker_Control($wp_customize, 
		'footer_info_right_icon',
		array(
		    'label'   		=> __('Right Icon','corpex'),
		    'section' 		=> 'footer_above',
			'iconset' => 'fa',
			
		))  
	);
	
	// Info Right Image // 
	$wp_customize->add_setting( 
    	'footer_info_right_bg_image' , 
    	array(
			'default'			=> esc_url(get_template_directory_uri() .'/assets/images/ft-2.jpg'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpex_sanitize_url',	
			'priority' => 14,
		) 
	);
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'footer_info_right_bg_image' ,
		array(
			'label'          => __( 'Footer Right Background Image', 'corpex' ),
			'section'        => 'footer_above',
		) 
	));
	
	
	// Client content Section // 
	
	$wp_customize->add_setting(
		'footer_client_content_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpex_sanitize_text',
			'priority' => 7,
		)
	);

	$wp_customize->add_control(
	'footer_client_content_head',
		array(
			'type' => 'hidden',
			'label' => __('Client Section','corpex'),
			'section' => 'footer_above',
		)
	);
	
	// hide/show
	$wp_customize->add_setting( 
		'hs_above_footer_client' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'corpex_sanitize_checkbox',
			'priority' => 1,
		) 
	);
	
	$wp_customize->add_control(
	'hs_above_footer_client', 
		array(
			'label'	      => esc_html__( 'Hide/Show', 'corpex' ),
			'section'     => 'footer_above',
			'type'        => 'checkbox'
		) 
	);
	
	/**
	 * Customizer Repeater for add Footer client
	 */
	
	$wp_customize->add_setting( 'footer_client_contents', 
		array(
		 'sanitize_callback' => 'corpex_repeater_sanitize',
		 'priority' => 8,
		 'default' => corpex_get_footer_client_default()
		)
	);
	
	$wp_customize->add_control( 
		new corpex_Repeater( $wp_customize, 
			'footer_client_contents', 
				array(
					'label'   => esc_html__('Client','corpex'),
					'section' => 'footer_above',
					'add_field_label'                   => esc_html__( 'Add New Client', 'corpex' ),
					'item_name'                         => esc_html__( 'Client', 'corpex' ),
					'customizer_repeater_image_control' => true,
					'customizer_repeater_link_control' => true,
				) 
			) 
		);
	
	//Pro feature
		class Corpex_client__section_upgrade extends WP_Customize_Control {
			public function render_content() { 
				$theme = wp_get_theme(); // gets the current theme	
				
			?>
				<a class="customizer_client_upgrade_section up-to-pro" href="https://www.nayrathemes.com/corpex-pro/" target="_blank" style="display: none;"><?php _e('Upgrade to Pro','corpex'); ?></a>
				
			<?php }
		}
		
		$wp_customize->add_setting( 'corpex_client_upgrade_to_pro', array(
			'capability'			=> 'edit_theme_options',
			'corpex_sanitize_callback'	=> 'wp_filter_nohtml_kses',
			'priority' => 5,
		));
		$wp_customize->add_control(
			new Corpex_client__section_upgrade(
			$wp_customize,
			'corpex_client_upgrade_to_pro',
				array(
					'section'		=> 'footer_above',
				)
			)
		);
	// Footer Setting Section // 
	$wp_customize->add_section(
        'footer_copy_Section',
        array(
            'title' 		=> __('Below Footer','corpex'),
			'panel'  		=> 'footer_section',
			'priority'      => 4,
		)
    );
	//Above Footer Documentation Link
	class WP_footer_copy_Section_Customize_Control extends WP_Customize_Control {
	public $type = 'new_menu';

	   function render_content()
	   
	   {
	   ?>
			<h3>How to Add footer copy Section :</h3>
			<p>Footer > Footer Copy Section <br><br> <a href="#" style="background-color:rgba(223, 69, 44, 1);; color:#fff;display: flex;align-items: center;justify-content: center;text-decoration: none;   font-weight: 600;padding: 15px 10px;">Click Here</a></p>
			
		<?php
	   }
	}
	
	// Visa Link
	$wp_customize->add_setting(
    	'footer_visa_link',
    	array(
			'default' 			=> '#',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpex_sanitize_url',
		)
	);	

	$wp_customize->add_control( 
		'footer_visa_link',
		array(
		    'label'   		=> __('Visa Link','corpex'),
		    'section'		=> 'footer_copy_Section',
			'type' 			=> 'text',
		)  
	);
	
	// Paypal Link
	$wp_customize->add_setting(
    	'footer_paypal_link',
    	array(
			'default' 			=> '#',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpex_sanitize_url',
		)
	);	

	$wp_customize->add_control( 
		'footer_paypal_link',
		array(
		    'label'   		=> __('Paypal Link','corpex'),
		    'section'		=> 'footer_copy_Section',
			'type' 			=> 'text',
		)  
	);
	
	// MasterCard Link
	$wp_customize->add_setting(
    	'footer_mastercard_link',
    	array(
			'default' 			=> '#',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpex_sanitize_url',
		)
	);	

	$wp_customize->add_control( 
		'footer_mastercard_link',
		array(
		    'label'   		=> __('Mastercard Link','corpex'),
		    'section'		=> 'footer_copy_Section',
			'type' 			=> 'text',
		)  
	);
	
	// American Express Link
	$wp_customize->add_setting(
    	'footer_amex_link',
    	array(
			'default' 			=> '#',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpex_sanitize_url',
		)
	);	

	$wp_customize->add_control( 
		'footer_amex_link',
		array(
		    'label'   		=> __('American Express Link','corpex'),
		    'section'		=> 'footer_copy_Section',
			'type' 			=> 'text',
		)  
	);
	
	// JCB Link
	$wp_customize->add_setting(
    	'footer_jcb_link',
    	array(
			'default' 			=> '#',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpex_sanitize_url',
		)
	);	

	$wp_customize->add_control( 
		'footer_jcb_link',
		array(
		    'label'   		=> __('JCB Link','corpex'),
		    'section'		=> 'footer_copy_Section',
			'type' 			=> 'text',
		)  
	);
	
	
	
	// Above Footer Doc Link // 
	$wp_customize->add_setting( 
		'footer_copy_Section_doc_link' , 
			array(
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);

	$wp_customize->add_control(new WP_footer_copy_Section_Customize_Control($wp_customize,
	'footer_copy_Section_doc_link' , 
		array(
			'label'          => __( 'Footer Above Documentation Link', 'corpex' ),
			'section'        => 'footer_copy_Section',
			'type'           => 'radio',
			'description'    => __( 'footer copy Section Documentation Link', 'corpex' ), 
		) 
	) );
	
	// footer third text // 
	$corpex_footer_copyright = esc_html__('Copyright &copy; [current_year] [site_title] | Powered by [theme_author]', 'corpex' );
	$wp_customize->add_setting(
    	'footer_third_custom',
    	array(
			'default' => $corpex_footer_copyright,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpex_sanitize_html',
		)
	);	

	$wp_customize->add_control( 
		'footer_third_custom',
		array(
		    'label'   		=> __('Copyright Text','corpex'),
		    'section'		=> 'footer_copy_Section',
			'type' 			=> 'textarea',
			'priority'      => 9,
		)  
	);	
	
	
	// Footer Background // 
	$wp_customize->add_section(
        'footer_background',
        array(
            'title' 		=> __('Footer Background','corpex'),
			'panel'  		=> 'footer_section',
			'priority'      => 4,
		)
    );
	
	

	
	// Footer Setting Section // 
	$wp_customize->add_section(
        'footer_copy_Section',
        array(
            'title' 		=> __('Below Footer','corpex'),
			'panel'  		=> 'footer_section',
			'priority'      => 4,
		)
    );
	
	//Above Footer Documentation Link
	class WP_footer_background_Customize_Control extends WP_Customize_Control {
	public $type = 'new_menu';

	   function render_content()
	   
	   {
	   ?>
			<h3>How to Add footer background Section :</h3>
			<p>Footer > Footer Background <br><br> <a href="#" style="background-color:rgba(223, 69, 44, 1);; color:#fff;display: flex;align-items: center;justify-content: center;text-decoration: none;   font-weight: 600;padding: 15px 10px;">Click Here</a></p>
			
		<?php
	   }
	}
	
	// Above Footer Doc Link // 
	$wp_customize->add_setting( 
		'footer_background_doc_link' , 
			array(
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);

	$wp_customize->add_control(new WP_footer_background_Customize_Control($wp_customize,
	'footer_background_doc_link' , 
		array(
			'label'          => __( 'Footer Background Documentation Link', 'corpex' ),
			'section'        => 'footer_background',
			'type'           => 'radio',
			'description'    => __( 'footer background Documentation Link', 'corpex' ), 
		) 
	) );
	
	//  Color
	$wp_customize->add_setting(
	'footer_bg_color', 
	array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'default' => '#242526'
    ));
	
	$wp_customize->add_control( 
		new WP_Customize_Color_Control
		($wp_customize, 
			'footer_bg_color', 
			array(
				'label'      => __( 'Background Color', 'corpex' ),
				'section'    => 'footer_background',
			) 
		) 
	);
	
	//  Background Image // 
    $wp_customize->add_setting( 
    	'footer_bg_img' , 
    	array(
			'default' 			=> esc_url(get_template_directory_uri() .'/assets/images/footer/footer-bg.jpg'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpex_sanitize_url',	
			'priority' => 10,
		) 
	);
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'footer_bg_img' ,
		array(
			'label'          => esc_html__( 'Background Image', 'corpex'),
			'section'        => 'footer_background',
		) 
	));
	
	/* Opacity */
	if ( class_exists( 'Corpex_Customizer_Range_Control' ) ) {
	$wp_customize->add_setting(
    	'footer_bg_img_opacity',
    	array(
	        'default'			=> '0.75',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'corpex_pro_sanitize_range_value',
			'priority'  => 11,
		)
	);
	$wp_customize->add_control( 
	new Corpex_Customizer_Range_Control( $wp_customize, 'footer_bg_img_opacity', 
		array(
			'label'      => __( 'Opacity', 'corpex'),
			'section'  => 'footer_background',
			 'media_query'   => false,
                'input_attr'    => array(
                    'desktop' => array(
                        'min'           => 0,
                        'max'           => 1,
                        'step'          => 0.1,
                        'default_value' => 0.6,
                    ),
                ),
		) ) 
	);
	}
}
add_action( 'customize_register', 'corpex_footer' );
// Footer selective refresh
function corpex_footer_partials( $wp_customize ){	
	//footer_above_content 
	$wp_customize->selective_refresh->add_partial( 'footer_above_content', array(
		'selector'            => '.footer-above .av-columns-area',
	) );
	
	// footer_third_custom
	$wp_customize->selective_refresh->add_partial( 'footer_third_custom', array(
		'selector'            => '.footer-copyright .copyright-text',
		'settings'            => 'footer_third_custom',
		'render_callback'  => 'corpex_footer_third_custom_render_callback',
	) );
	
	//footer_widget_middle_content
	$wp_customize->selective_refresh->add_partial( 'footer_widget_middle_content', array(
		'selector'            => '.footer-main .footer-info-overwrap',
		'settings'            => 'footer_widget_middle_content',
		'render_callback'  => 'corpex_footer_widget_middle_content_render_callback',
	) );
	}

add_action( 'customize_register', 'corpex_footer_partials' );


// copyright_content
function corpex_footer_third_custom_render_callback() {
	return get_theme_mod( 'footer_third_custom' );
}

// footer_widget_middle_content
function corpex_footer_widget_middle_content_render_callback() {
	return get_theme_mod( 'footer_widget_middle_content' );
}