<?php
/**
 * Business Corporate Agency: Customizer
 *
 * @package Business Corporate Agency
 * @subpackage business_corporate_agency
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function Business_Corporate_Agency_Customize_register( $wp_customize ) {

	require get_parent_theme_file_path('/inc/controls/icon-changer.php');

	require get_parent_theme_file_path('/inc/controls/range-slider-control.php');

	// Register the custom control type.
	$wp_customize->register_control_type( 'Business_Corporate_Agency_Toggle_Control' );

	//Register the sortable control type.
	$wp_customize->register_control_type( 'Business_Corporate_Agency_Control_Sortable' );	

	//add home page setting pannel
	$wp_customize->add_panel( 'business_corporate_agency_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Custom Home page', 'business-corporate-agency' ),
	    'description' => __( 'Description of what this panel does.', 'business-corporate-agency' ),
	) );

	//TP Genral Option
	$wp_customize->add_section('business_corporate_agency_tp_general_settings',array(
        'title' => __('TP General Option', 'business-corporate-agency'),
        'priority' => 1,
        'panel' => 'business_corporate_agency_panel_id'
    ) );
 	$wp_customize->add_setting('business_corporate_agency_tp_body_layout_settings',array(
		'default' => 'Full',
		'sanitize_callback' => 'business_corporate_agency_sanitize_choices'
	));

 	$wp_customize->add_control('business_corporate_agency_tp_body_layout_settings',array(
		'type' => 'radio',
		'label'     => __('Body Layout Setting', 'business-corporate-agency'),
		'description'   => __('This option work for complete body, if you want to set the complete website in container.', 'business-corporate-agency'),
		'section' => 'business_corporate_agency_tp_general_settings',
		'choices' => array(
		'Full' => __('Full','business-corporate-agency'),
		'Container' => __('Container','business-corporate-agency'),
		'Container Fluid' => __('Container Fluid','business-corporate-agency')
		),
	) );

    // Add Settings and Controls for Post Layout
	$wp_customize->add_setting('business_corporate_agency_sidebar_post_layout',array(
     'default' => 'right',
     'sanitize_callback' => 'business_corporate_agency_sanitize_choices'
	));
	$wp_customize->add_control('business_corporate_agency_sidebar_post_layout',array(
     'type' => 'radio',
     'label'     => __('Post Sidebar Position', 'business-corporate-agency'),
     'description'   => __('This option work for blog page, blog single page, archive page and search page.', 'business-corporate-agency'),
     'section' => 'business_corporate_agency_tp_general_settings',
     'choices' => array(
         'full' => __('Full','business-corporate-agency'),
         'left' => __('Left','business-corporate-agency'),
         'right' => __('Right','business-corporate-agency'),
         'three-column' => __('Three Columns','business-corporate-agency'),
         'four-column' => __('Four Columns','business-corporate-agency'),
         'grid' => __('Grid Layout','business-corporate-agency')
     ),
	) );

	// Add Settings and Controls for single post sidebar Layout
	$wp_customize->add_setting('business_corporate_agency_sidebar_single_post_layout',array(
        'default' => 'right',
        'sanitize_callback' => 'business_corporate_agency_sanitize_choices'
	));
	$wp_customize->add_control('business_corporate_agency_sidebar_single_post_layout',array(
        'type' => 'radio',
        'label'     => __('Single Post Sidebar Position', 'business-corporate-agency'),
        'description'   => __('This option work for single blog page', 'business-corporate-agency'),
        'section' => 'business_corporate_agency_tp_general_settings',
        'choices' => array(
            'full' => __('Full','business-corporate-agency'),
            'left' => __('Left','business-corporate-agency'),
            'right' => __('Right','business-corporate-agency'),
        ),
	) );

	// Add Settings and Controls for Page Layout
	$wp_customize->add_setting('business_corporate_agency_sidebar_page_layout',array(
     'default' => 'right',
     'sanitize_callback' => 'business_corporate_agency_sanitize_choices'
	));
	$wp_customize->add_control('business_corporate_agency_sidebar_page_layout',array(
     'type' => 'radio',
     'label'     => __('Page Sidebar Position', 'business-corporate-agency'),
     'description'   => __('This option work for pages.', 'business-corporate-agency'),
     'section' => 'business_corporate_agency_tp_general_settings',
     'choices' => array(
         'full' => __('Full','business-corporate-agency'),
         'left' => __('Left','business-corporate-agency'),
         'right' => __('Right','business-corporate-agency')
     ),
	) );
	//tp typography option
	$business_corporate_agency_font_array = array(
		''                       => 'No Fonts',
		'Abril Fatface'          => 'Abril Fatface',
		'Acme'                   => 'Acme',
		'Anton'                  => 'Anton',
		'Architects Daughter'    => 'Architects Daughter',
		'Arimo'                  => 'Arimo',
		'Arsenal'                => 'Arsenal',
		'Arvo'                   => 'Arvo',
		'Alegreya'               => 'Alegreya',
		'Alfa Slab One'          => 'Alfa Slab One',
		'Averia Serif Libre'     => 'Averia Serif Libre',
		'Bangers'                => 'Bangers',
		'Boogaloo'               => 'Boogaloo',
		'Bad Script'             => 'Bad Script',
		'Bitter'                 => 'Bitter',
		'Bree Serif'             => 'Bree Serif',
		'BenchNine'              => 'BenchNine',
		'Cabin'                  => 'Cabin',
		'Cardo'                  => 'Cardo',
		'Courgette'              => 'Courgette',
		'Cherry Swash'           => 'Cherry Swash',
		'Cormorant Garamond'     => 'Cormorant Garamond',
		'Crimson Text'           => 'Crimson Text',
		'Cuprum'                 => 'Cuprum',
		'Cookie'                 => 'Cookie',
		'Chewy'                  => 'Chewy',
		'Days One'               => 'Days One',
		'Dosis'                  => 'Dosis',
		'Droid Sans'             => 'Droid Sans',
		'Economica'              => 'Economica',
		'Fredoka One'            => 'Fredoka One',
		'Fjalla One'             => 'Fjalla One',
		'Francois One'           => 'Francois One',
		'Frank Ruhl Libre'       => 'Frank Ruhl Libre',
		'Gloria Hallelujah'      => 'Gloria Hallelujah',
		'Great Vibes'            => 'Great Vibes',
		'Handlee'                => 'Handlee',
		'Hammersmith One'        => 'Hammersmith One',
		'Inconsolata'            => 'Inconsolata',
		'Indie Flower'           => 'Indie Flower',
		'IM Fell English SC'     => 'IM Fell English SC',
		'Julius Sans One'        => 'Julius Sans One',
		'Josefin Slab'           => 'Josefin Slab',
		'Josefin Sans'           => 'Josefin Sans',
		'Kanit'                  => 'Kanit',
		'Lobster'                => 'Lobster',
		'Lato'                   => 'Lato',
		'Lora'                   => 'Lora',
		'Libre Baskerville'      => 'Libre Baskerville',
		'Lobster Two'            => 'Lobster Two',
		'Merriweather'           => 'Merriweather',
		'Monda'                  => 'Monda',
		'Montserrat'             => 'Montserrat',
		'Muli'                   => 'Muli',
		'Marck Script'           => 'Marck Script',
		'Noto Serif'             => 'Noto Serif',
		'Open Sans'              => 'Open Sans',
		'Overpass'               => 'Overpass',
		'Overpass Mono'          => 'Overpass Mono',
		'Oxygen'                 => 'Oxygen',
		'Orbitron'               => 'Orbitron',
		'Patua One'              => 'Patua One',
		'Pacifico'               => 'Pacifico',
		'Padauk'                 => 'Padauk',
		'Playball'               => 'Playball',
		'Playfair Display'       => 'Playfair Display',
		'PT Sans'                => 'PT Sans',
		'Philosopher'            => 'Philosopher',
		'Permanent Marker'       => 'Permanent Marker',
		'Poiret One'             => 'Poiret One',
		'Quicksand'              => 'Quicksand',
		'Quattrocento Sans'      => 'Quattrocento Sans',
		'Raleway'                => 'Raleway',
		'Rubik'                  => 'Rubik',
		'Rokkitt'                => 'Rokkitt',
		'Russo One'              => 'Russo One',
		'Righteous'              => 'Righteous',
		'Slabo'                  => 'Slabo',
		'Source Sans Pro'        => 'Source Sans Pro',
		'Shadows Into Light Two' => 'Shadows Into Light Two',
		'Shadows Into Light'     => 'Shadows Into Light',
		'Sacramento'             => 'Sacramento',
		'Shrikhand'              => 'Shrikhand',
		'Tangerine'              => 'Tangerine',
		'Ubuntu'                 => 'Ubuntu',
		'VT323'                  => 'VT323',
		'Varela Round'           => 'Varela Round',
		'Vampiro One'            => 'Vampiro One',
		'Vollkorn'               => 'Vollkorn',
		'Volkhov'                => 'Volkhov',
		'Yanone Kaffeesatz'      => 'Yanone Kaffeesatz'
	);

	$wp_customize->add_section('business_corporate_agency_typography_option',array(
		'title'         => __('TP Typography Option', 'business-corporate-agency'),
		'priority' => 1,
		'panel' => 'business_corporate_agency_panel_id'
   	));

   	$wp_customize->add_setting('business_corporate_agency_heading_font_family', array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_corporate_agency_sanitize_choices',
	));
	$wp_customize->add_control(	'business_corporate_agency_heading_font_family', array(
		'section' => 'business_corporate_agency_typography_option',
		'label'   => __('heading Fonts', 'business-corporate-agency'),
		'type'    => 'select',
		'choices' => $business_corporate_agency_font_array,
	));

	$wp_customize->add_setting('business_corporate_agency_body_font_family', array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_corporate_agency_sanitize_choices',
	));
	$wp_customize->add_control(	'business_corporate_agency_body_font_family', array(
		'section' => 'business_corporate_agency_typography_option',
		'label'   => __('Body Fonts', 'business-corporate-agency'),
		'type'    => 'select',
		'choices' => $business_corporate_agency_font_array,
	));

	//TP Color Option
	$wp_customize->add_section('business_corporate_agency_color_option',array(
     'title'         => __('TP Color Option', 'business-corporate-agency'),
     'priority' => 1,
     'panel' => 'business_corporate_agency_panel_id'
    ) );
    
	$wp_customize->add_setting( 'business_corporate_agency_tp_color_option', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'business_corporate_agency_tp_color_option', array(
			'label'     => __('Theme First Color', 'business-corporate-agency'),
	    'description' => __('It will change the complete theme color in one click.', 'business-corporate-agency'),
	    'section' => 'business_corporate_agency_color_option',
	    'settings' => 'business_corporate_agency_tp_color_option',
  	)));

	//TP Preloader Option
	$wp_customize->add_section('business_corporate_agency_prelaoder_option',array(
		'title'         => __('TP Preloader Option', 'business-corporate-agency'),
		'priority' => 1,
		'panel' => 'business_corporate_agency_panel_id'
	) );
	$wp_customize->add_setting( 'business_corporate_agency_preloader_show_hide', array(
		'default'           => false,
		'transport'         => 'refresh',
		'sanitize_callback' => 'business_corporate_agency_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Business_Corporate_Agency_Toggle_Control( $wp_customize, 'business_corporate_agency_preloader_show_hide', array(
		'label'       => esc_html__( 'Show / Hide Preloader Option', 'business-corporate-agency' ),
		'section'     => 'business_corporate_agency_prelaoder_option',
		'type'        => 'toggle',
		'settings'    => 'business_corporate_agency_preloader_show_hide',
	) ) );
	$wp_customize->add_setting( 'business_corporate_agency_tp_preloader_color1_option', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'business_corporate_agency_tp_preloader_color1_option', array(
			'label'     => __('Preloader First Ring Color', 'business-corporate-agency'),
	    'description' => __('It will change the complete theme preloader ring 1 color in one click.', 'business-corporate-agency'),
	    'section' => 'business_corporate_agency_prelaoder_option',
	    'settings' => 'business_corporate_agency_tp_preloader_color1_option',
  	)));
  	$wp_customize->add_setting( 'business_corporate_agency_tp_preloader_color2_option', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'business_corporate_agency_tp_preloader_color2_option', array(
			'label'     => __('Preloader Second Ring Color', 'business-corporate-agency'),
	    'description' => __('It will change the complete theme preloader ring 2 color in one click.', 'business-corporate-agency'),
	    'section' => 'business_corporate_agency_prelaoder_option',
	    'settings' => 'business_corporate_agency_tp_preloader_color2_option',
  	)));
  	$wp_customize->add_setting( 'business_corporate_agency_tp_preloader_bg_color_option', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'business_corporate_agency_tp_preloader_bg_color_option', array(
			'label'     => __('Preloader Background Color', 'business-corporate-agency'),
	    'description' => __('It will change the complete theme preloader bg color in one click.', 'business-corporate-agency'),
	    'section' => 'business_corporate_agency_prelaoder_option',
	    'settings' => 'business_corporate_agency_tp_preloader_bg_color_option',
  	)));

	//TP Blog Option
	$wp_customize->add_section('business_corporate_agency_blog_option',array(
		'title' => __('TP Blog Option', 'business-corporate-agency'),
		'priority' => 1,
		'panel' => 'business_corporate_agency_panel_id'
	) );

    $wp_customize->add_setting('business_corporate_agency_edit_blog_page_title',array(
		'default'=> __('Home','business-corporate-agency'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('business_corporate_agency_edit_blog_page_title',array(
		'label'	=> __('Change Blog Page Title','business-corporate-agency'),
		'section'=> 'business_corporate_agency_blog_option',
		'type'=> 'text'
	));

	$wp_customize->add_setting('business_corporate_agency_edit_blog_page_description',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('business_corporate_agency_edit_blog_page_description',array(
		'label'	=> __('Add Blog Description','business-corporate-agency'),
		'section'=> 'business_corporate_agency_blog_option',
		'type'=> 'text'
	));

	$wp_customize->add_setting('blog_meta_order', array(
        'default' => array('date', 'author', 'comment', 'category'),
        'sanitize_callback' => 'business_corporate_agency_sanitize_sortable',
    ));
    $wp_customize->add_control(new Business_Corporate_Agency_Control_Sortable($wp_customize, 'blog_meta_order', array(
    	'label' => esc_html__('Meta Order', 'business-corporate-agency'),
        'description' => __('Drag & Drop post items to re-arrange the order and also hide and show items as per the need by clicking on the eye icon.', 'business-corporate-agency') ,
        'section' => 'business_corporate_agency_blog_option',
        'choices' => array(
            'date' => __('date', 'business-corporate-agency') ,
            'author' => __('author', 'business-corporate-agency') ,
            'comment' => __('comment', 'business-corporate-agency') ,
            'category' => __('category', 'business-corporate-agency') ,
        ) ,
    )));

    $wp_customize->add_setting( 'business_corporate_agency_excerpt_count', array(
		'default'              => 35,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'business_corporate_agency_sanitize_number_range',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'business_corporate_agency_excerpt_count', array(
		'label'       => esc_html__( 'Edit Excerpt Limit','business-corporate-agency' ),
		'section'     => 'business_corporate_agency_blog_option',
		'type'        => 'number',
		'input_attrs' => array(
			'step'             => 2,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting('business_corporate_agency_post_image_round', array(
	  'default' => '0',
      'sanitize_callback' => 'business_corporate_agency_sanitize_number_range',
	));
	$wp_customize->add_control(new business_corporate_agency_Range_Slider($wp_customize, 'business_corporate_agency_post_image_round', array(
       'section' => 'business_corporate_agency_blog_option',
      'label' => esc_html__('Edit Post Image Border Radius', 'business-corporate-agency'),
      'input_attrs' => array(
        'min' => 0,
        'max' => 180,
        'step' => 1
    )
	)));

	$wp_customize->add_setting('business_corporate_agency_post_image_width', array(
	  'default' => '',
      'sanitize_callback' => 'business_corporate_agency_sanitize_number_range',
	));
	$wp_customize->add_control(new business_corporate_agency_Range_Slider($wp_customize, 'business_corporate_agency_post_image_width', array(
       'section' => 'business_corporate_agency_blog_option',
      'label' => esc_html__('Edit Post Image Width', 'business-corporate-agency'),
      'input_attrs' => array(
        'min' => 0,
        'max' => 367,
        'step' => 1
    )
	)));

	$wp_customize->add_setting('business_corporate_agency_post_image_length', array(
	  'default' => '',
      'sanitize_callback' => 'business_corporate_agency_sanitize_number_range',
	));
	$wp_customize->add_control(new business_corporate_agency_Range_Slider($wp_customize, 'business_corporate_agency_post_image_length', array(
       'section' => 'business_corporate_agency_blog_option',
      'label' => esc_html__('Edit Post Image height', 'business-corporate-agency'),
      'input_attrs' => array(
        'min' => 0,
        'max' => 900,
        'step' => 1
    )
	)));

	$wp_customize->add_setting('business_corporate_agency_read_more_text',array(
		'default'=> __('Read More','business-corporate-agency'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('business_corporate_agency_read_more_text',array(
		'label'	=> __('Edit Button Text','business-corporate-agency'),
		'section'=> 'business_corporate_agency_blog_option',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'business_corporate_agency_remove_read_button', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'business_corporate_agency_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Business_Corporate_Agency_Toggle_Control( $wp_customize, 'business_corporate_agency_remove_read_button', array(
		'label'       => esc_html__( 'Show / Hide Read More Button', 'business-corporate-agency' ),
		'section'     => 'business_corporate_agency_blog_option',
		'type'        => 'toggle',
		'settings'    => 'business_corporate_agency_remove_read_button',
	) ) );

    $wp_customize->selective_refresh->add_partial( 'business_corporate_agency_remove_read_button', array(
		'selector' => '.readmore-btn',
		'render_callback' => 'Business_Corporate_Agency_Customize_partial_business_corporate_agency_remove_read_button',
	 ));

	 $wp_customize->add_setting( 'business_corporate_agency_remove_tags', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'business_corporate_agency_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Business_Corporate_Agency_Toggle_Control( $wp_customize, 'business_corporate_agency_remove_tags', array(
		'label'       => esc_html__( 'Show / Hide Tags Option', 'business-corporate-agency' ),
		'section'     => 'business_corporate_agency_blog_option',
		'type'        => 'toggle',
		'settings'    => 'business_corporate_agency_remove_tags',
	) ) );
    $wp_customize->selective_refresh->add_partial( 'business_corporate_agency_remove_tags', array(
		'selector' => '.box-content a[rel="tag"]',
		'render_callback' => 'Business_Corporate_Agency_Customize_partial_business_corporate_agency_remove_tags',
	));
	$wp_customize->add_setting( 'business_corporate_agency_remove_category', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'business_corporate_agency_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Business_Corporate_Agency_Toggle_Control( $wp_customize, 'business_corporate_agency_remove_category', array(
		'label'       => esc_html__( 'Show / Hide Category Option', 'business-corporate-agency' ),
		'section'     => 'business_corporate_agency_blog_option',
		'type'        => 'toggle',
		'settings'    => 'business_corporate_agency_remove_category',
	) ) );
    $wp_customize->selective_refresh->add_partial( 'business_corporate_agency_remove_category', array(
		'selector' => '.box-content a[rel="category"]',
		'render_callback' => 'Business_Corporate_Agency_Customize_partial_business_corporate_agency_remove_category',
	));
	$wp_customize->add_setting( 'business_corporate_agency_remove_comment', array(
	 'default'           => true,
	 'transport'         => 'refresh',
	 'sanitize_callback' => 'business_corporate_agency_sanitize_checkbox',
 	) );

	$wp_customize->add_control( new Business_Corporate_Agency_Toggle_Control( $wp_customize, 'business_corporate_agency_remove_comment', array(
	 'label'       => esc_html__( 'Show / Hide Comment Form', 'business-corporate-agency' ),
	 'section'     => 'business_corporate_agency_blog_option',
	 'type'        => 'toggle',
	 'settings'    => 'business_corporate_agency_remove_comment',
	) ) );

	$wp_customize->add_setting( 'business_corporate_agency_remove_related_post', array(
	 'default'           => true,
	 'transport'         => 'refresh',
	 'sanitize_callback' => 'business_corporate_agency_sanitize_checkbox',
 	) );

	$wp_customize->add_control( new Business_Corporate_Agency_Toggle_Control( $wp_customize, 'business_corporate_agency_remove_related_post', array(
	 'label'       => esc_html__( 'Show / Hide Related Post', 'business-corporate-agency' ),
	 'section'     => 'business_corporate_agency_blog_option',
	 'type'        => 'toggle',
	 'settings'    => 'business_corporate_agency_remove_related_post',
	) ) );
	$wp_customize->add_setting( 'business_corporate_agency_related_post_per_page', array(
		'default'              => 3,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'business_corporate_agency_sanitize_number_range',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'business_corporate_agency_related_post_per_page', array(
		'label'       => esc_html__( 'Related Post Per Page','business-corporate-agency' ),
		'section'     => 'business_corporate_agency_blog_option',
		'type'        => 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 3,
			'max'              => 9,
		),
	) );

	 //MENU TYPOGRAPHY
	$wp_customize->add_section( 'business_corporate_agency_menu_typography', array(
    	'title'      => __( 'Menu Typography', 'business-corporate-agency' ),
    	'priority' => 2,
		'panel' => 'business_corporate_agency_panel_id'
	) );
	$wp_customize->add_setting('business_corporate_agency_menu_font_family', array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_corporate_agency_sanitize_choices',
	));
	$wp_customize->add_control(	'business_corporate_agency_menu_font_family', array(
		'section' => 'business_corporate_agency_menu_typography',
		'label'   => __('Menu Fonts', 'business-corporate-agency'),
		'type'    => 'select',
		'choices' => $business_corporate_agency_font_array,
	));

	$wp_customize->add_setting('business_corporate_agency_menu_text_tranform',array(
		'default' => '',
		'sanitize_callback' => 'business_corporate_agency_sanitize_choices'
 	));
 	$wp_customize->add_control('business_corporate_agency_menu_text_tranform',array(
		'type' => 'select',
		'label' => __('Menu Text Transform','business-corporate-agency'),
		'section' => 'business_corporate_agency_menu_typography',
		'choices' => array(
		   'Uppercase' => __('Uppercase','business-corporate-agency'),
		   'Lowercase' => __('Lowercase','business-corporate-agency'),
		   'Capitalize' => __('Capitalize','business-corporate-agency'),
		),
	) );
	
	$wp_customize->add_setting('business_corporate_agency_menu_font_size', array(
	  'default' => '',
      'sanitize_callback' => 'business_corporate_agency_sanitize_number_range',
	));
	$wp_customize->add_control(new Business_Corporate_Agency_Range_Slider($wp_customize, 'business_corporate_agency_menu_font_size', array(
       'section' => 'business_corporate_agency_menu_typography',
      'label' => esc_html__('Font Size', 'business-corporate-agency'),
      'input_attrs' => array(
        'min' => 0,
        'max' => 20,
        'step' => 1
    )
	)));

	$wp_customize->add_setting( 'business_corporate_agency_menu_color', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'business_corporate_agency_menu_color', array(
			'label'     => __('Change Menu Color', 'business-corporate-agency'),
	    'section' => 'business_corporate_agency_menu_typography',
	    'settings' => 'business_corporate_agency_menu_color',
  	)));

	// Top bar Section
	$wp_customize->add_section( 'business_corporate_agency_topbar', array(
    	'title'      => __( 'Contact Details', 'business-corporate-agency' ),
    	'description' => __( 'Add your contact details', 'business-corporate-agency' ),
		'panel' => 'business_corporate_agency_panel_id',
      'priority' => 2,
	) );


	$wp_customize->add_setting('business_corporate_agency_location',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('business_corporate_agency_location',array(
		'label'	=> __('Add location','business-corporate-agency'),
		'section'=> 'business_corporate_agency_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('business_corporate_agency_call',array(
		'default'=> '',
		'sanitize_callback'	=> 'business_corporate_agency_sanitize_phone_number'
	));
	$wp_customize->add_control('business_corporate_agency_call',array(
		'label'	=> __('Add Phone Number','business-corporate-agency'),
		'section'=> 'business_corporate_agency_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('business_corporate_agency_header_button',array(
		'default'=> __('Get Consultant','business-corporate-agency'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('business_corporate_agency_header_button',array(
		'label'	=> __('Header Button Text','business-corporate-agency'),
		'section'=> 'business_corporate_agency_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('business_corporate_agency_header_link',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('business_corporate_agency_header_link',array(
		'label'	=> __('Header Button Link','business-corporate-agency'),
		'section'=> 'business_corporate_agency_topbar',
		'type'=> 'url'
	));

	// Social Link
	$wp_customize->add_section( 'business_corporate_agency_social_media', array(
    	'title'      => __( 'Social Media Links', 'business-corporate-agency' ),
    	'description' => __( 'Add your Social Links', 'business-corporate-agency' ),
		'panel' => 'business_corporate_agency_panel_id',
      'priority' => 2,
	) );

	$wp_customize->add_setting( 'business_corporate_agency_header_fb_new_tab', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'business_corporate_agency_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Business_Corporate_Agency_Toggle_Control( $wp_customize, 'business_corporate_agency_header_fb_new_tab', array(
		'label'       => esc_html__( 'Open in new tab', 'business-corporate-agency' ),
		'section'     => 'business_corporate_agency_social_media',
		'type'        => 'toggle',
		'settings'    => 'business_corporate_agency_header_fb_new_tab',
	) ) );

	$wp_customize->add_setting('business_corporate_agency_facebook_url',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('business_corporate_agency_facebook_url',array(
		'label'	=> __('Facebook Link','business-corporate-agency'),
		'section'=> 'business_corporate_agency_social_media',
		'type'=> 'url'
	));

	$wp_customize->selective_refresh->add_partial( 'business_corporate_agency_facebook_url', array(
		'selector' => '.social-media',
		'render_callback' => 'Business_Corporate_Agency_Customize_partial_business_corporate_agency_facebook_url',
	) );

	$wp_customize->add_setting('business_corporate_agency_facebook_icon',array(
		'default'	=> 'fab fa-facebook',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Business_Corporate_Agency_Icon_Changer(
        $wp_customize,'business_corporate_agency_facebook_icon',array(
		'label'	=> __('Facebook Icon','business-corporate-agency'),
		'transport' => 'refresh',
		'section'	=> 'business_corporate_agency_social_media',
		'type'		=> 'icon'
	)));
	$wp_customize->add_setting( 'business_corporate_agency_header_twt_new_tab', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'business_corporate_agency_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Business_Corporate_Agency_Toggle_Control( $wp_customize, 'business_corporate_agency_header_twt_new_tab', array(
		'label'       => esc_html__( 'Open in new tab', 'business-corporate-agency' ),
		'section'     => 'business_corporate_agency_social_media',
		'type'        => 'toggle',
		'settings'    => 'business_corporate_agency_header_twt_new_tab',
	) ) );

	$wp_customize->add_setting('business_corporate_agency_twitter_url',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('business_corporate_agency_twitter_url',array(
		'label'	=> __('Twitter Link','business-corporate-agency'),
		'section'=> 'business_corporate_agency_social_media',
		'type'=> 'url'
	));

	$wp_customize->add_setting('business_corporate_agency_twitter_icon',array(
		'default'	=> 'fab fa-twitter',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Business_Corporate_Agency_Icon_Changer(
        $wp_customize,'business_corporate_agency_twitter_icon',array(
		'label'	=> __('Twitter Icon','business-corporate-agency'),
		'transport' => 'refresh',
		'section'	=> 'business_corporate_agency_social_media',
		'type'		=> 'icon'
	)));
	
	$wp_customize->add_setting( 'business_corporate_agency_header_ins_new_tab', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'business_corporate_agency_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Business_Corporate_Agency_Toggle_Control( $wp_customize, 'business_corporate_agency_header_ins_new_tab', array(
		'label'       => esc_html__( 'Open in new tab', 'business-corporate-agency' ),
		'section'     => 'business_corporate_agency_social_media',
		'type'        => 'toggle',
		'settings'    => 'business_corporate_agency_header_ins_new_tab',
	) ) );

	$wp_customize->add_setting('business_corporate_agency_instagram_url',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('business_corporate_agency_instagram_url',array(
		'label'	=> __('Instagram Link','business-corporate-agency'),
		'section'=> 'business_corporate_agency_social_media',
		'type'=> 'url'
	));

	$wp_customize->add_setting('business_corporate_agency_instagram_icon',array(
		'default'	=> 'fab fa-instagram',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Business_Corporate_Agency_Icon_Changer(
        $wp_customize,'business_corporate_agency_instagram_icon',array(
		'label'	=> __('Instagram Icon','business-corporate-agency'),
		'transport' => 'refresh',
		'section'	=> 'business_corporate_agency_social_media',
		'type'		=> 'icon'
	)));
	
	$wp_customize->add_setting( 'business_corporate_agency_linkedin_new_tab', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'business_corporate_agency_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Business_Corporate_Agency_Toggle_Control( $wp_customize, 'business_corporate_agency_linkedin_new_tab', array(
		'label'       => esc_html__( 'Open in new tab', 'business-corporate-agency' ),
		'section'     => 'business_corporate_agency_social_media',
		'type'        => 'toggle',
		'settings'    => 'business_corporate_agency_linkedin_new_tab',
	) ) );

	$wp_customize->add_setting('business_corporate_agency_linkedin_url',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('business_corporate_agency_linkedin_url',array(
		'label'	=> __('Linkedin Link','business-corporate-agency'),
		'section'=> 'business_corporate_agency_social_media',
		'type'=> 'url'
	));

	$wp_customize->add_setting('business_corporate_agency_linkedin_icon',array(
		'default'	=> 'fab fa-linkedin',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Business_Corporate_Agency_Icon_Changer(
        $wp_customize,'business_corporate_agency_linkedin_icon',array(
		'label'	=> __('Linkedin Icon','business-corporate-agency'),
		'transport' => 'refresh',
		'section'	=> 'business_corporate_agency_social_media',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'business_corporate_agency_google_plus_new_tab', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'business_corporate_agency_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Business_Corporate_Agency_Toggle_Control( $wp_customize, 'business_corporate_agency_google_plus_new_tab', array(
		'label'       => esc_html__( 'Open in new tab', 'business-corporate-agency' ),
		'section'     => 'business_corporate_agency_social_media',
		'type'        => 'toggle',
		'settings'    => 'business_corporate_agency_google_plus_new_tab',
	) ) );

	$wp_customize->add_setting('business_corporate_agency_google_plus_url',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('business_corporate_agency_google_plus_url',array(
		'label'	=> __('Google Plus Link','business-corporate-agency'),
		'section'=> 'business_corporate_agency_social_media',
		'type'=> 'url'
	));

	$wp_customize->add_setting('business_corporate_agency_googleplus_icon',array(
		'default'	=> 'fab fa-google-plus-g',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Business_Corporate_Agency_Icon_Changer(
        $wp_customize,'business_corporate_agency_googleplus_icon',array(
		'label'	=> __('Googleplus Icon','business-corporate-agency'),
		'transport' => 'refresh',
		'section'	=> 'business_corporate_agency_social_media',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'business_corporate_agency_youtube_new_tab', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'business_corporate_agency_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Business_Corporate_Agency_Toggle_Control( $wp_customize, 'business_corporate_agency_youtube_new_tab', array(
		'label'       => esc_html__( 'Open in new tab', 'business-corporate-agency' ),
		'section'     => 'business_corporate_agency_social_media',
		'type'        => 'toggle',
		'settings'    => 'business_corporate_agency_youtube_new_tab',
	) ) );

	$wp_customize->add_setting('business_corporate_agency_youtube_url',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('business_corporate_agency_youtube_url',array(
		'label'	=> __('Youtube Link','business-corporate-agency'),
		'section'=> 'business_corporate_agency_social_media',
		'type'=> 'url'
	));

	$wp_customize->add_setting('business_corporate_agency_youtube_icon',array(
		'default'	=> 'fab fa-youtube',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Business_Corporate_Agency_Icon_Changer(
        $wp_customize,'business_corporate_agency_youtube_icon',array(
		'label'	=> __('Youtube Icon','business-corporate-agency'),
		'transport' => 'refresh',
		'section'	=> 'business_corporate_agency_social_media',
		'type'		=> 'icon'
	)));

	//home page slider
	$wp_customize->add_section( 'business_corporate_agency_slider_section' , array(
    	'title'      => __( 'Slider Settings', 'business-corporate-agency' ),
		'panel' => 'business_corporate_agency_panel_id',
      'priority' => 6,
	) );

	$wp_customize->add_setting( 'business_corporate_agency_slider_arrows', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'business_corporate_agency_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Business_Corporate_Agency_Toggle_Control( $wp_customize, 'business_corporate_agency_slider_arrows', array(
		'label'       => esc_html__( 'Show / Hide slider', 'business-corporate-agency' ),
		'section'     => 'business_corporate_agency_slider_section',
		'type'        => 'toggle',
		'settings'    => 'business_corporate_agency_slider_arrows',
	) ) );

    $wp_customize->selective_refresh->add_partial( 'business_corporate_agency_slider_arrows', array(
		'selector' => '#slider .carousel-caption',
		'render_callback' => 'Business_Corporate_Agency_Customize_partial_business_corporate_agency_slider_arrows',
	) );

	$wp_customize->add_setting('business_corporate_agency_slider_short_heading',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('business_corporate_agency_slider_short_heading',array(
		'label'	=> __('Add short Heading','business-corporate-agency'),
		'section'=> 'business_corporate_agency_slider_section',
		'type'=> 'text'
	));

	for ( $business_corporate_agency_count = 1; $business_corporate_agency_count <= 4; $business_corporate_agency_count++ ) {

	// Add color scheme setting and control.
	$wp_customize->add_setting( 'business_corporate_agency_slider_page' . $business_corporate_agency_count, array(
		'default'           => '',
		'sanitize_callback' => 'business_corporate_agency_sanitize_dropdown_pages'
	) );

	$wp_customize->add_control( 'business_corporate_agency_slider_page' . $business_corporate_agency_count, array(
		'label'    => __( 'Select Slide Image Page', 'business-corporate-agency' ),
		'section'  => 'business_corporate_agency_slider_section',
		'type'     => 'dropdown-pages'
	) );
	}

	$wp_customize->add_setting('business_corporate_agency_product_btn_text1',array(
		'default'=>  __('Get Started','business-corporate-agency'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('business_corporate_agency_product_btn_text1',array(
		'label'	=> esc_html__('Add Slider Button 1 Text','business-corporate-agency'),
		'section'=> 'business_corporate_agency_slider_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('business_corporate_agency_product_btn_link1',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('business_corporate_agency_product_btn_link1',array(
		'label'	=> esc_html__('Add Slider Button 1 link','business-corporate-agency'),
		'section'=> 'business_corporate_agency_slider_section',
		'type'=> 'url'
	));

	$wp_customize->add_setting('business_corporate_agency_slider_side_text',array(
		'default'=> __('WELCOME','business-corporate-agency'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('business_corporate_agency_slider_side_text',array(
		'label'	=> __('Add Welcome Text','business-corporate-agency'),
		'section'=> 'business_corporate_agency_slider_section',
		'type'=> 'text'
	));
	
	// About Us Section
	$wp_customize->add_section('business_corporate_agency_service_section', array(
	    'title'    => __('About Us Section', 'business-corporate-agency'),
	    'panel'    => 'business_corporate_agency_panel_id',
	    'priority' => 7,
	));

	$wp_customize->add_setting('business_corporate_agency_service_enable', array(
	    'default'           => true,
	    'transport'         => 'refresh',
	    'sanitize_callback' => 'business_corporate_agency_sanitize_checkbox',
	));
	$wp_customize->add_control(new Business_Corporate_Agency_Toggle_Control($wp_customize, 'business_corporate_agency_service_enable', array(
	    'label'    => esc_html__('Show / Hide About Us', 'business-corporate-agency'),
	    'section'  => 'business_corporate_agency_service_section',
	    'type'     => 'toggle',
	    'settings' => 'business_corporate_agency_service_enable',
	)));

	$wp_customize->add_setting('business_corporate_agency_service_about_us', array(
	    'default'           => '',
	    'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('business_corporate_agency_service_about_us', array(
	    'label'    => __('Add About Us Background text', 'business-corporate-agency'),
	    'section'  => 'business_corporate_agency_service_section',
	    'type'     => 'text'
	));

	$wp_customize->add_setting('business_corporate_agency_service_sub_heading', array(
	    'default'           => '',
	    'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('business_corporate_agency_service_sub_heading', array(
	    'label'    => __('Add Heading', 'business-corporate-agency'),
	    'section'  => 'business_corporate_agency_service_section',
	    'type'     => 'text'
	));

	// Add a default "Select" option to the dropdown
	$wp_customize->add_setting('business_corporate_agency_about_page', array(
	    'default'           => '0', 
	    'sanitize_callback' => 'business_corporate_agency_sanitize_dropdown_pages'
	));
	$wp_customize->add_control('business_corporate_agency_about_page', array(
	    'label'    => __('Select About Us Page', 'business-corporate-agency'),
	    'section'  => 'business_corporate_agency_service_section',
	    'type'     => 'dropdown-pages'
	));

	$wp_customize->add_setting('business_corporate_agency_about_bg',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'business_corporate_agency_about_bg',array(
	    'label' => __('Select About Image','business-corporate-agency'),
	     'section' => 'business_corporate_agency_service_section'
	)));

	for($business_corporate_agency_i=1;$business_corporate_agency_i<=8;$business_corporate_agency_i++) {

	    $wp_customize->add_setting('business_corporate_agency_tab_icon'.$business_corporate_agency_i,array(
			'default'	=> 'fas fa-check',
			'sanitize_callback'	=> 'sanitize_text_field'
		));
		$wp_customize->add_control(new Business_Corporate_Agency_Icon_Changer(
	        $wp_customize,'business_corporate_agency_tab_icon'.$business_corporate_agency_i,array(
			'label'	=> __('About Text Icon','business-corporate-agency').$business_corporate_agency_i,
			'transport' => 'refresh',
			'section'	=> 'business_corporate_agency_service_section',
			'type'		=> 'icon'
		)));

	    $wp_customize->add_setting('business_corporate_agency_tab_heading'.$business_corporate_agency_i,array(
	        'default'=> '',
	        'sanitize_callback' => 'sanitize_text_field'
	    ));
	    $wp_customize->add_control('business_corporate_agency_tab_heading'.$business_corporate_agency_i,array(
	        'label' => __('About Title ','business-corporate-agency').$business_corporate_agency_i,
	        'section'=> 'business_corporate_agency_service_section',
	        'setting'=> 'business_corporate_agency_tab_heading'.$business_corporate_agency_i,
	        'type'=> 'text'
	    ));
  	}

  	$wp_customize->add_setting('business_corporate_agency_abt_button',array(
		'default'=> __('Get Started','business-corporate-agency'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('business_corporate_agency_abt_button',array(
		'label'	=> __('About Button Text','business-corporate-agency'),
		'section'=> 'business_corporate_agency_service_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('business_corporate_agency_abt_link',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('business_corporate_agency_abt_link',array(
		'label'	=> __('About Button Link','business-corporate-agency'),
		'section'=> 'business_corporate_agency_service_section',
		'type'=> 'url'
	));

	$wp_customize->add_setting('business_corporate_agency_design_artist_experience',array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('business_corporate_agency_design_artist_experience',array(
		'label'	=> __('Add Total Experience','business-corporate-agency'),
		'section'	=> 'business_corporate_agency_service_section',
		'type'		=> 'text'
	));

	$categories = get_categories();
	$business_corporate_agency_offer_cat = array('select' => 'Select');

	foreach ($categories as $category) {
	    $business_corporate_agency_offer_cat[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('business_corporate_agency_about_catData', array(
	    'default' => 'select',
	    'sanitize_callback' => 'business_corporate_agency_sanitize_choices',
	));
	$wp_customize->add_control('business_corporate_agency_about_catData', array(
	    'type' => 'select',
	    'choices' => $business_corporate_agency_offer_cat,
	    'label' => __('Select a category to highlight Reviewers photos', 'business-corporate-agency'),
	    'section' => 'business_corporate_agency_service_section',
	));

	$wp_customize->add_setting('business_corporate_agency_customer_review', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('business_corporate_agency_customer_review', array(
	    'label' => __('Add Total number of Reviews', 'business-corporate-agency'),
	    'section' => 'business_corporate_agency_service_section',
	    'type' => 'text',
	));

	//footer
	$wp_customize->add_section('business_corporate_agency_footer_section',array(
		'title'	=> __('Footer Widget Settings','business-corporate-agency'),
		'panel' => 'business_corporate_agency_panel_id',
		'priority' => 7,
	));

	// footer columns
	$wp_customize->add_setting('business_corporate_agency_footer_columns',array(
		'default'	=> 4,
		'sanitize_callback'	=> 'business_corporate_agency_sanitize_number_absint'
	));
	$wp_customize->add_control('business_corporate_agency_footer_columns',array(
		'label'	=> __('Footer Widget Columns','business-corporate-agency'),
		'section'	=> 'business_corporate_agency_footer_section',
		'setting'	=> 'business_corporate_agency_footer_columns',
		'type'	=> 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 4,
		),
	));
	$wp_customize->add_setting( 'business_corporate_agency_tp_footer_bg_color_option', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'business_corporate_agency_tp_footer_bg_color_option', array(
			'label'     => __('Footer Widget Background Color', 'business-corporate-agency'),
			'description' => __('It will change the complete footer widget backgorund color.', 'business-corporate-agency'),
			'section' => 'business_corporate_agency_footer_section',
			'settings' => 'business_corporate_agency_tp_footer_bg_color_option',
	)));

	$wp_customize->add_setting('business_corporate_agency_footer_widget_image',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'business_corporate_agency_footer_widget_image',array(
        'label' => __('Footer Widget Background Image','business-corporate-agency'),
         'section' => 'business_corporate_agency_footer_section'
	)));

	//footer widget title font size
	$wp_customize->add_setting('business_corporate_agency_footer_widget_title_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'business_corporate_agency_sanitize_number_absint'
	));
	$wp_customize->add_control('business_corporate_agency_footer_widget_title_font_size',array(
		'label'	=> __('Change Footer Widget Title Font Size in PX','business-corporate-agency'),
		'section'	=> 'business_corporate_agency_footer_section',
	    'setting'	=> 'business_corporate_agency_footer_widget_title_font_size',
		'type'	=> 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 50,
		),
	));

	$wp_customize->add_setting( 'business_corporate_agency_footer_widget_title_color', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'business_corporate_agency_footer_widget_title_color', array(
			'label'     => __('Change Footer Widget Title Color', 'business-corporate-agency'),
	    'section' => 'business_corporate_agency_footer_section',
	    'settings' => 'business_corporate_agency_footer_widget_title_color',
  	)));
  	
	$wp_customize->add_setting( 'business_corporate_agency_return_to_header', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'business_corporate_agency_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Business_Corporate_Agency_Toggle_Control( $wp_customize, 'business_corporate_agency_return_to_header', array(
		'label'       => esc_html__( 'Show / Hide Return to header', 'business-corporate-agency' ),
		'section'     => 'business_corporate_agency_footer_section',
		'type'        => 'toggle',
		'settings'    => 'business_corporate_agency_return_to_header',
	) ) );

    $wp_customize->add_setting('business_corporate_agency_scroll_top_icon',array(
	  'default'	=> 'fas fa-arrow-up',
	  'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Business_Corporate_Agency_Icon_Changer(
	        $wp_customize,'business_corporate_agency_scroll_top_icon',array(
		'label'	=> __('Scroll to top Icon','business-corporate-agency'),
		'transport' => 'refresh',
		'section'	=> 'business_corporate_agency_footer_section',
			'type'		=> 'icon'
	)));

    // Add Settings and Controls for Scroll top
	$wp_customize->add_setting('business_corporate_agency_scroll_top_position',array(
        'default' => 'Right',
        'sanitize_callback' => 'business_corporate_agency_sanitize_choices'
	));
	$wp_customize->add_control('business_corporate_agency_scroll_top_position',array(
        'type' => 'radio',
        'label'     => __('Scroll to top Position', 'business-corporate-agency'),
        'description'   => __('This option work for scroll to top', 'business-corporate-agency'),
       'section' => 'business_corporate_agency_footer_section',
       'choices' => array(
            'Right' => __('Right','business-corporate-agency'),
            'Left' => __('Left','business-corporate-agency'),
            'Center' => __('Center','business-corporate-agency')
     ),
	) );

	//footer
	$wp_customize->add_section('business_corporate_agency_footer_copyright_section',array(
		'title'	=> __('Footer Copyright Section','business-corporate-agency'),
		'description'	=> __('Add copyright text.','business-corporate-agency'),
		'panel' => 'business_corporate_agency_panel_id',
		'priority' => 8,
	));

	$wp_customize->add_setting('business_corporate_agency_footer_text',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('business_corporate_agency_footer_text',array(
		'label'	=> __('Copyright Text','business-corporate-agency'),
		'section'	=> 'business_corporate_agency_footer_copyright_section',
		'type'		=> 'text'
	));

	//footer widget title font size
	$wp_customize->add_setting('business_corporate_agency_footer_copyright_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'business_corporate_agency_sanitize_number_absint'
	));
	$wp_customize->add_control('business_corporate_agency_footer_copyright_font_size',array(
		'label'	=> __('Change Footer Copyright Font Size in PX','business-corporate-agency'),
		'section'	=> 'business_corporate_agency_footer_copyright_section',
	    'setting'	=> 'business_corporate_agency_footer_copyright_font_size',
		'type'	=> 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 50,
		),
	));

	$wp_customize->add_setting( 'business_corporate_agency_footer_copyright_text_color', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'business_corporate_agency_footer_copyright_text_color', array(
			'label'     => __('Change Footer Copyright Text Color', 'business-corporate-agency'),
	    'section' => 'business_corporate_agency_footer_copyright_section',
	    'settings' => 'business_corporate_agency_footer_copyright_text_color',
  	)));

  	$wp_customize->add_setting('business_corporate_agency_footer_copyright_top_bottom_padding',array(
		'default'	=> '',
		'sanitize_callback'	=> 'business_corporate_agency_sanitize_number_absint'
	));
	$wp_customize->add_control('business_corporate_agency_footer_copyright_top_bottom_padding',array(
		'label'	=> __('Change Footer Copyright Padding in PX','business-corporate-agency'),
		'section'	=> 'business_corporate_agency_footer_copyright_section',
	    'setting'	=> 'business_corporate_agency_footer_copyright_top_bottom_padding',
		'type'	=> 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 50,
		),
	));

	// Add Settings and Controls for copyright
	$wp_customize->add_setting('business_corporate_agency_copyright_text_position',array(
        'default' => 'Center',
        'sanitize_callback' => 'business_corporate_agency_sanitize_choices'
	));
	$wp_customize->add_control('business_corporate_agency_copyright_text_position',array(
        'type' => 'radio',
        'label'     => __('Copyright Text Position', 'business-corporate-agency'),
        'description'   => __('This option work for Copyright', 'business-corporate-agency'),
        'section' => 'business_corporate_agency_footer_copyright_section',
        'choices' => array(
            'Right' => __('Right','business-corporate-agency'),
            'Left' => __('Left','business-corporate-agency'),
            'Center' => __('Center','business-corporate-agency')
        ),
	) );

	$wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';
	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => 'Business_Corporate_Agency_Customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'Business_Corporate_Agency_Customize_partial_blogdescription',
	) );

	//Mobile Respnsive
	$wp_customize->add_section('business_corporate_agency_mobile_media_option',array(
		'title'         => __('Mobile Responsive media', 'business-corporate-agency'),
		'description' => __('Control will not function if the toggle in the main settings is off.', 'business-corporate-agency'),
		'priority' => 8,
		'panel' => 'business_corporate_agency_panel_id'
	) );

	$wp_customize->add_setting( 'business_corporate_agency_mobile_blog_description', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'business_corporate_agency_sanitize_checkbox',
	) );
	$wp_customize->add_control( new business_corporate_agency_Toggle_Control( $wp_customize, 'business_corporate_agency_mobile_blog_description', array(
		'label'       => esc_html__( 'Show / Hide Blog Page Description', 'business-corporate-agency' ),
		'section'     => 'business_corporate_agency_mobile_media_option',
		'type'        => 'toggle',
		'settings'    => 'business_corporate_agency_mobile_blog_description',
	) ) );

	$wp_customize->add_setting( 'business_corporate_agency_return_to_header_mob', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'business_corporate_agency_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Business_Corporate_Agency_Toggle_Control( $wp_customize, 'business_corporate_agency_return_to_header_mob', array(
		'label'       => esc_html__( 'Show / Hide Return to header', 'business-corporate-agency' ),
		'section'     => 'business_corporate_agency_mobile_media_option',
		'type'        => 'toggle',
		'settings'    => 'business_corporate_agency_return_to_header_mob',
	) ) );
	$wp_customize->add_setting( 'business_corporate_agency_related_post_mob', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'business_corporate_agency_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Business_Corporate_Agency_Toggle_Control( $wp_customize, 'business_corporate_agency_related_post_mob', array(
		'label'       => esc_html__( 'Show / Hide Related Post', 'business-corporate-agency' ),
		'section'     => 'business_corporate_agency_mobile_media_option',
		'type'        => 'toggle',
		'settings'    => 'business_corporate_agency_related_post_mob',
	) ) );

	//Site Identity
	$wp_customize->add_setting( 'business_corporate_agency_site_title', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'business_corporate_agency_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Business_Corporate_Agency_Toggle_Control( $wp_customize, 'business_corporate_agency_site_title', array(
		'label'       => esc_html__( 'Show / Hide Site Title', 'business-corporate-agency' ),
		'section'     => 'title_tagline',
		'type'        => 'toggle',
		'settings'    => 'business_corporate_agency_site_title',
	) ) );

	$wp_customize->add_setting('business_corporate_agency_site_title_font_size',array(
		'default'	=> 30,
		'sanitize_callback'	=> 'business_corporate_agency_sanitize_number_absint'
	));
	$wp_customize->add_control('business_corporate_agency_site_title_font_size',array(
		'label'	=> __('Site Title Font Size in PX','business-corporate-agency'),
		'section'	=> 'title_tagline',
		'setting'	=> 'business_corporate_agency_site_title_font_size',
		'type'	=> 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 80,
		),
	));

	$wp_customize->add_setting( 'business_corporate_agency_site_tagline_color', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'business_corporate_agency_site_tagline_color', array(
			'label'     => __('Change Site Title Color', 'business-corporate-agency'),
	    'section' => 'title_tagline',
	    'settings' => 'business_corporate_agency_site_tagline_color',
  	)));

	$wp_customize->add_setting( 'business_corporate_agency_site_tagline', array(
	    'default'           => false,
		'transport'         => 'refresh',
		'sanitize_callback' => 'business_corporate_agency_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Business_Corporate_Agency_Toggle_Control( $wp_customize, 'business_corporate_agency_site_tagline', array(
		'label'       => esc_html__( 'Show / Hide Site Tagline', 'business-corporate-agency' ),
		'section'     => 'title_tagline',
		'type'        => 'toggle',
		'settings'    => 'business_corporate_agency_site_tagline',
	) ) );

	// logo site tagline size
	$wp_customize->add_setting('business_corporate_agency_site_tagline_font_size',array(
		'default'	=> 15,
		'sanitize_callback'	=> 'business_corporate_agency_sanitize_number_absint'
	));
	$wp_customize->add_control('business_corporate_agency_site_tagline_font_size',array(
		'label'	=> __('Site Tagline Font Size in PX','business-corporate-agency'),
		'section'	=> 'title_tagline',
	    'setting'	=> 'business_corporate_agency_site_tagline_font_size',
		'type'	=> 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 50,
		),
	));

	$wp_customize->add_setting( 'business_corporate_agency_logo_tagline_color', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'business_corporate_agency_logo_tagline_color', array(
			'label'     => __('Change Site Tagline Color', 'business-corporate-agency'),
	    'section' => 'title_tagline',
	    'settings' => 'business_corporate_agency_logo_tagline_color',
  	)));
  	
    $wp_customize->add_setting('business_corporate_agency_logo_width',array(
		'default' => 50,
		'sanitize_callback'	=> 'business_corporate_agency_sanitize_number_absint'
	));
	$wp_customize->add_control('business_corporate_agency_logo_width',array(
		'label'	=> esc_html__('Here You Can Customize Your Logo Size','business-corporate-agency'),
		'section'	=> 'title_tagline',
		'type'		=> 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 150,
		),
	));

	//Woo Coomerce
	$wp_customize->add_setting('business_corporate_agency_per_columns',array(
		'default'=> 3,
		'sanitize_callback'	=> 'business_corporate_agency_sanitize_number_absint'
	));
	$wp_customize->add_control('business_corporate_agency_per_columns',array(
		'label'	=> __('Product Per Row','business-corporate-agency'),
		'section'=> 'woocommerce_product_catalog',
		'type'=> 'number'
	));
	$wp_customize->add_setting('business_corporate_agency_product_per_page',array(
		'default'=> 9,
		'sanitize_callback'	=> 'business_corporate_agency_sanitize_number_absint'
	));
	$wp_customize->add_control('business_corporate_agency_product_per_page',array(
		'label'	=> __('Product Per Page','business-corporate-agency'),
		'section'=> 'woocommerce_product_catalog',
		'type'=> 'number'
	));
   	$wp_customize->add_setting( 'business_corporate_agency_product_sidebar', array(
		 'default'           => true,
		 'transport'         => 'refresh',
		 'sanitize_callback' => 'business_corporate_agency_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Business_Corporate_Agency_Toggle_Control( $wp_customize, 'business_corporate_agency_product_sidebar', array(
		'label'       => esc_html__( 'Show / Hide Shop Page Sidebar', 'business-corporate-agency' ),
		'section'     => 'woocommerce_product_catalog',
		'type'        => 'toggle',
		'settings'    => 'business_corporate_agency_product_sidebar',
	) ) );

	$wp_customize->add_setting( 'business_corporate_agency_single_product_sidebar', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'business_corporate_agency_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Business_Corporate_Agency_Toggle_Control( $wp_customize, 'business_corporate_agency_single_product_sidebar', array(
		'label'       => esc_html__( 'Show / Hide Product Page Sidebar', 'business-corporate-agency' ),
		'section'     => 'woocommerce_product_catalog',
		'type'        => 'toggle',
		'settings'    => 'business_corporate_agency_single_product_sidebar',
	) ) );
	$wp_customize->add_setting( 'business_corporate_agency_related_product', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'business_corporate_agency_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Business_Corporate_Agency_Toggle_Control( $wp_customize, 'business_corporate_agency_related_product', array(
		'label'       => esc_html__( 'Show / Hide related product', 'business-corporate-agency' ),
		'section'     => 'woocommerce_product_catalog',
		'type'        => 'toggle',
		'settings'    => 'business_corporate_agency_related_product',
	) ) );

	//add page template setting pannel
	$wp_customize->add_panel( 'business_corporate_agency_page_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Page Template Settings', 'business-corporate-agency' ),
	    'description' => __( 'Description of what this panel does.', 'business-corporate-agency' ),
	) );

	// 404 PAGE
	$wp_customize->add_section('business_corporate_agency_404_page_section',array(
		'title'         => __('404 Page', 'business-corporate-agency'),
		'description'   => 'Here you can customize 404 Page content.',
		'panel' => 'business_corporate_agency_page_panel_id'
	) );

	$wp_customize->add_setting('business_corporate_agency_edit_404_title',array(
		'default'=> __('Oops! That page cant be found.','business-corporate-agency'),
		'sanitize_callback'	=> 'sanitize_text_field',
	));
	$wp_customize->add_control('business_corporate_agency_edit_404_title',array(
		'label'	=> __('Edit Title','business-corporate-agency'),
		'section'=> 'business_corporate_agency_404_page_section',
		'type'=> 'text',
	));

	$wp_customize->add_setting('business_corporate_agency_edit_404_text',array(
		'default'=> __('It looks like nothing was found at this location. Maybe try a search?','business-corporate-agency'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('business_corporate_agency_edit_404_text',array(
		'label'	=> __('Edit Text','business-corporate-agency'),
		'section'=> 'business_corporate_agency_404_page_section',
		'type'=> 'text'
	));

	// Search Results
	$wp_customize->add_section('business_corporate_agency_no_result_section',array(
		'title'         => __('Search Results', 'business-corporate-agency'),
		'description'   => 'Here you can customize Search Result content.',
		'panel' => 'business_corporate_agency_page_panel_id'
	) );

	$wp_customize->add_setting('business_corporate_agency_edit_no_result_title',array(
		'default'=> __('Nothing Found','business-corporate-agency'),
		'sanitize_callback'	=> 'sanitize_text_field',
	));
	$wp_customize->add_control('business_corporate_agency_edit_no_result_title',array(
		'label'	=> __('Edit Title','business-corporate-agency'),
		'section'=> 'business_corporate_agency_no_result_section',
		'type'=> 'text',
	));

	$wp_customize->add_setting('business_corporate_agency_edit_no_result_text',array(
		'default'=> __('Sorry, but nothing matched your search terms. Please try again with some different keywords.','business-corporate-agency'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('business_corporate_agency_edit_no_result_text',array(
		'label'	=> __('Edit Text','business-corporate-agency'),
		'section'=> 'business_corporate_agency_no_result_section',
		'type'=> 'text'
	));

	// Header Image Height
    $wp_customize->add_setting(
        'business_corporate_agency_header_image_height',
        array(
            'default'           => 420,
            'sanitize_callback' => 'absint',
        )
    );
    $wp_customize->add_control(
        'business_corporate_agency_header_image_height',
        array(
            'label'       => esc_html__( 'Header Image Height', 'business-corporate-agency' ),
            'section'     => 'header_image',
            'type'        => 'number',
            'description' => esc_html__( 'Control the height of the header image. Default is 350px.', 'business-corporate-agency' ),
            'input_attrs' => array(
                'min'  => 220,
                'max'  => 1000,
                'step' => 1,
            ),
        )
    );

    // Header Background Position
    $wp_customize->add_setting(
        'business_corporate_agency_header_background_position',
        array(
            'default'           => 'center',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'business_corporate_agency_header_background_position',
        array(
            'label'       => esc_html__( 'Header Background Position', 'business-corporate-agency' ),
            'section'     => 'header_image',
            'type'        => 'select',
            'choices'     => array(
                'top'    => esc_html__( 'Top', 'business-corporate-agency' ),
                'center' => esc_html__( 'Center', 'business-corporate-agency' ),
                'bottom' => esc_html__( 'Bottom', 'business-corporate-agency' ),
            ),
            'description' => esc_html__( 'Choose how you want to position the header image.', 'business-corporate-agency' ),
        )
    );

    // Header Image Parallax Effect
    $wp_customize->add_setting(
        'business_corporate_agency_header_background_attachment',
        array(
            'default'           => 1,
            'sanitize_callback' => 'absint',
        )
    );
    $wp_customize->add_control(
        'business_corporate_agency_header_background_attachment',
        array(
            'label'       => esc_html__( 'Header Image Parallax', 'business-corporate-agency' ),
            'section'     => 'header_image',
            'type'        => 'checkbox',
            'description' => esc_html__( 'Add a parallax effect on page scroll.', 'business-corporate-agency' ),
        )
    );

    //Opacity
	$wp_customize->add_setting('business_corporate_agency_header_banner_opacity_color',array(
       'default'              => '0.5',
       'sanitize_callback' => 'business_corporate_agency_sanitize_choices'
	));
    $wp_customize->add_control( 'business_corporate_agency_header_banner_opacity_color', array(
		'label'       => esc_html__( 'Header Image Opacity','business-corporate-agency' ),
		'section'     => 'header_image',
		'type'        => 'select',
		'settings'    => 'business_corporate_agency_header_banner_opacity_color',
		'choices' => array(
           '0' =>  esc_attr(__('0','business-corporate-agency')),
           '0.1' =>  esc_attr(__('0.1','business-corporate-agency')),
           '0.2' =>  esc_attr(__('0.2','business-corporate-agency')),
           '0.3' =>  esc_attr(__('0.3','business-corporate-agency')),
           '0.4' =>  esc_attr(__('0.4','business-corporate-agency')),
           '0.5' =>  esc_attr(__('0.5','business-corporate-agency')),
           '0.6' =>  esc_attr(__('0.6','business-corporate-agency')),
           '0.7' =>  esc_attr(__('0.7','business-corporate-agency')),
           '0.8' =>  esc_attr(__('0.8','business-corporate-agency')),
           '0.9' =>  esc_attr(__('0.9','business-corporate-agency'))
		), 
	) );

   $wp_customize->add_setting( 'business_corporate_agency_header_banner_image_overlay', array(
	    'default'   => true,
	    'transport' => 'refresh',
	    'sanitize_callback' => 'business_corporate_agency_sanitize_checkbox',
	));
	$wp_customize->add_control( new business_corporate_agency_Toggle_Control( $wp_customize, 'business_corporate_agency_header_banner_image_overlay', array(
	    'label'   => esc_html__( 'Show / Hide Header Image Overlay', 'business-corporate-agency' ),
	    'section' => 'header_image',
	)));

    $wp_customize->add_setting('business_corporate_agency_header_banner_image_ooverlay_color', array(
		'default'           => '#000',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'business_corporate_agency_header_banner_image_ooverlay_color', array(
		'label'    => __('Header Image Overlay Color', 'business-corporate-agency'),
		'section'  => 'header_image',
	)));

    $wp_customize->add_setting(
        'business_corporate_agency_header_image_title_font_size',
        array(
            'default'           => 32,
            'sanitize_callback' => 'absint',
        )
    );
    $wp_customize->add_control(
        'business_corporate_agency_header_image_title_font_size',
        array(
            'label'       => esc_html__( 'Change Header Image Title Font Size', 'business-corporate-agency' ),
            'section'     => 'header_image',
            'type'        => 'number',
            'description' => esc_html__( 'Control the font Size of the header image title. Default is 32px.', 'business-corporate-agency' ),
            'input_attrs' => array(
                'min'  => 10,
                'max'  => 200,
                'step' => 1,
            ),
        )
    );

	$wp_customize->add_setting( 'business_corporate_agency_header_image_title_text_color', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'business_corporate_agency_header_image_title_text_color', array(
			'label'     => __('Change Header Image Title Color', 'business-corporate-agency'),
	    'section' => 'header_image',
	    'settings' => 'business_corporate_agency_header_image_title_text_color',
  	)));

}
add_action( 'customize_register', 'Business_Corporate_Agency_Customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Business Corporate Agency 1.0
 * @see Business_Corporate_Agency_Customize_register()
 *
 * @return void
 */
function Business_Corporate_Agency_Customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Business Corporate Agency 1.0
 * @see Business_Corporate_Agency_Customize_register()
 *
 * @return void
 */
function Business_Corporate_Agency_Customize_partial_blogdescription() {
	bloginfo( 'description' );
}

if ( ! defined( 'BUSINESS_CORPORATE_AGENCY_PRO_THEME_NAME' ) ) {
	define( 'BUSINESS_CORPORATE_AGENCY_PRO_THEME_NAME', esc_html__( 'Business Agency Pro', 'business-corporate-agency' ));
}
if ( ! defined( 'BUSINESS_CORPORATE_AGENCY_PRO_THEME_URL' ) ) {
	define( 'BUSINESS_CORPORATE_AGENCY_PRO_THEME_URL', esc_url('https://www.themespride.com/products/corporate-agency-wordpress-theme'));
}

if ( ! defined( 'BUSINESS_CORPORATE_AGENCY_DOCS_URL' ) ) {
	define( 'BUSINESS_CORPORATE_AGENCY_DOCS_URL', esc_url('https://page.themespride.com/demo/docs/business-corporate-agency/'));
}
if ( ! defined( 'BUSINESS_CORPORATE_AGENCY_DEMO_TITLE' ) ) {
	define( 'BUSINESS_CORPORATE_AGENCY_DEMO_TITLE', esc_html__( 'Click to View Site', 'business-corporate-agency' ));
}
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Business_Corporate_Agency_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'Business_Corporate_Agency_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Business_Corporate_Agency_Customize_Section_Pro(
				$manager,
				'business_corporate_agency_section_pro',
				array(
					'priority'   => 9,
					'title'    => BUSINESS_CORPORATE_AGENCY_PRO_THEME_NAME,
					'pro_text' => esc_html__( 'Upgrade Pro', 'business-corporate-agency' ),
					'pro_url'  => esc_url( BUSINESS_CORPORATE_AGENCY_PRO_THEME_URL, 'business-corporate-agency' ),
				)
			)
		);

		// Register sections.
		$manager->add_section(
			new business_corporate_agency_Customize_Section_Pro(
				$manager,
				'business_corporate_agency_documentation',
				array(
					'priority'   => 500,
					'title'    => esc_html__( 'Theme Documentation', 'business-corporate-agency' ),
					'pro_text' => esc_html__( 'Click Here', 'business-corporate-agency' ),
					'pro_url'  => esc_url( BUSINESS_CORPORATE_AGENCY_DOCS_URL, 'business-corporate-agency'),
				)
			)
		);

		// Register sections.
		$manager->add_section(
			new business_corporate_agency_Customize_Section_Pro(
				$manager,
				'business_corporate_agency_section_pro_demo',
				array(
					'priority'   => 9,
					'title'    => BUSINESS_CORPORATE_AGENCY_DEMO_TITLE,
					'pro_text' => esc_html__( 'View Site', 'business-corporate-agency' ),
					'pro_url'  => esc_url( home_url() ),
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'business-corporate-agency-customize-controls', trailingslashit( esc_url( get_template_directory_uri() ) ) . '/assets/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'business-corporate-agency-customize-controls', trailingslashit( esc_url( get_template_directory_uri() ) ) . '/assets/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
Business_Corporate_Agency_Customize::get_instance();