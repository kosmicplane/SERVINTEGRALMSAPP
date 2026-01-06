<?php
/**
 * Remote Startup Solutions Theme Customizer.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package remote_startup_solutions
 */

if( ! function_exists( 'remote_startup_solutions_customize_register' ) ):  
/**
 * Add postMessage support for site title and description for the Theme Customizer.F
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function remote_startup_solutions_customize_register( $wp_customize ) {
    require get_parent_theme_file_path('/inc/controls/changeable-icon.php');

    require get_parent_theme_file_path('/inc/controls/sortable-control.php');
    
    //Register the sortable control type.
    $wp_customize->register_control_type( 'Remote_Startup_Solutions_Control_Sortable' ); 
    
    if ( version_compare( get_bloginfo('version'),'4.9', '>=') ) {
        $wp_customize->get_section( 'static_front_page' )->title = __( 'Static Front Page', 'remote-startup-solutions' );
    }
	
    /* Option list of all post */	
    $remote_startup_solutions_options_posts = array();
    $remote_startup_solutions_options_posts_obj = get_posts('posts_per_page=-1');
    $remote_startup_solutions_options_posts[''] = esc_html__( 'Choose Post', 'remote-startup-solutions' );
    foreach ( $remote_startup_solutions_options_posts_obj as $remote_startup_solutions_posts ) {
    	$remote_startup_solutions_options_posts[$remote_startup_solutions_posts->ID] = $remote_startup_solutions_posts->post_title;
    }
    
    /* Option list of all categories */
    $remote_startup_solutions_args = array(
	   'type'                     => 'post',
	   'orderby'                  => 'name',
	   'order'                    => 'ASC',
	   'hide_empty'               => 1,
	   'hierarchical'             => 1,
	   'taxonomy'                 => 'category'
    ); 
    $remote_startup_solutions_option_categories = array();
    $remote_startup_solutions_category_lists = get_categories( $remote_startup_solutions_args );
    $remote_startup_solutions_option_categories[''] = esc_html__( 'Choose Category', 'remote-startup-solutions' );
    foreach( $remote_startup_solutions_category_lists as $remote_startup_solutions_category ){
        $remote_startup_solutions_option_categories[$remote_startup_solutions_category->term_id] = $remote_startup_solutions_category->name;
    }
    
    /** Default Settings */    
    $wp_customize->add_panel( 
        'wp_default_panel',
         array(
            'priority' => 10,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => esc_html__( 'Default Settings', 'remote-startup-solutions' ),
            'description' => esc_html__( 'Default section provided by wordpress customizer.', 'remote-startup-solutions' ),
        ) 
    );
    
    $wp_customize->get_section( 'title_tagline' )->panel                  = 'wp_default_panel';
    $wp_customize->get_section( 'colors' )->panel                         = 'wp_default_panel';
    $wp_customize->get_section( 'header_image' )->panel                   = 'wp_default_panel';
    $wp_customize->get_section( 'background_image' )->panel               = 'wp_default_panel';
    $wp_customize->get_section( 'static_front_page' )->panel              = 'wp_default_panel';
    
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    
    /** Default Settings Ends */
    
    /** Site Title control */
    $wp_customize->add_setting( 
        'header_site_title', 
        array(
            'default'           => true,
            'sanitize_callback' => 'remote_startup_solutions_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'header_site_title',
        array(
            'label'       => __( 'Show / Hide Site Title', 'remote-startup-solutions' ),
            'section'     => 'title_tagline',
            'type'        => 'checkbox',
        )
    );

    /** Tagline control */
    $wp_customize->add_setting( 
        'header_tagline', 
        array(
            'default'           => false,
            'sanitize_callback' => 'remote_startup_solutions_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'header_tagline',
        array(
            'label'       => __( 'Show / Hide Tagline', 'remote-startup-solutions' ),
            'section'     => 'title_tagline',
            'type'        => 'checkbox',
        )
    );

    $wp_customize->add_setting('logo_width', array(
        'sanitize_callback' => 'absint', 
    ));

    // Add a control for logo width
    $wp_customize->add_control('logo_width', array(
        'label' => __('Logo Width', 'remote-startup-solutions'),
        'section' => 'title_tagline',
        'type' => 'number',
        'input_attrs' => array(
            'min' => '50', 
            'max' => '500', 
            'step' => '5', 
    ),
        'default' => '100', 
    ));

    $wp_customize->add_setting( 'remote_startup_solutions_site_title_size', array(
        'default'           => 30, // Default font size in pixels
        'sanitize_callback' => 'absint', // Sanitize the input as a positive integer
    ) );

    // Add control for site title size
    $wp_customize->add_control( 'remote_startup_solutions_site_title_size', array(
        'type'        => 'number',
        'section'     => 'title_tagline', // You can change this section to your preferred section
        'label'       => __( 'Site Title Font Size (px)', 'remote-startup-solutions' ),
        'input_attrs' => array(
            'min'  => 10,
            'max'  => 100,
            'step' => 1,
        ),
    ) );

    /** Responsive Media settings */
    
    $wp_customize->add_section(
        'remote_startup_solutions_responsive_media_section',
        array(
            'title' => esc_html__( 'Responsive Media Settings', 'remote-startup-solutions' ),
            'priority' => 20,
            'capability' => 'edit_theme_options',
            'panel' => 'remote_startup_solutions_general_settings',
        )
    );

    /** Scroll to top Responsive control */
    $wp_customize->add_setting( 
        'remote_startup_solutions_resp_scroll_top', 
        array(
            'default' => 1,
            'sanitize_callback' => 'remote_startup_solutions_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'remote_startup_solutions_resp_scroll_top',
        array(
            'label'       => __( 'Show Scroll To Top', 'remote-startup-solutions' ),
            'section'     => 'remote_startup_solutions_responsive_media_section',
            'type'        => 'checkbox',
        )
    );

        /** Scroll to top Responsive control */
    $wp_customize->add_setting( 
        'remote_startup_solutions_resp_loader', 
        array(
            'default' => 0,
            'sanitize_callback' => 'remote_startup_solutions_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'remote_startup_solutions_resp_loader',
        array(
            'label'       => __( 'Show Preloader', 'remote-startup-solutions' ),
            'section'     => 'remote_startup_solutions_responsive_media_section',
            'type'        => 'checkbox',
        )
    );

    /** Responsive Media Ends */

    /** Post & Pages Settings */
    $wp_customize->add_panel( 
        'remote_startup_solutions_post_settings',
         array(
            'priority' => 40,
            'capability' => 'edit_theme_options',
            'title' => esc_html__( 'Post & Pages Settings', 'remote-startup-solutions' ),
            'description' => esc_html__( 'Customize Post & Pages Settings', 'remote-startup-solutions' ),
        ) 
    );

        /** Post Layouts */
    
    $wp_customize->add_section(
        'remote_startup_solutions_post_layout_section',
        array(
            'title' => esc_html__( 'Post Layout Settings', 'remote-startup-solutions' ),
            'priority' => 20,
            'capability' => 'edit_theme_options',
            'panel' => 'remote_startup_solutions_post_settings',
        )
    );

    $wp_customize->add_setting('remote_startup_solutions_post_layout_setting', array(
        'default'           => 'right-sidebar',
        'sanitize_callback' => 'remote_startup_solutions_sanitize_post_layout',
    ));

    $wp_customize->add_control('remote_startup_solutions_post_layout_setting', array(
        'label'    => __('Post Column Settings', 'remote-startup-solutions'),
        'section'  => 'remote_startup_solutions_post_layout_section',
        'settings' => 'remote_startup_solutions_post_layout_setting',
        'type'     => 'select',
        'choices'  => array(
            'one-column'   => __('One Column', 'remote-startup-solutions'),
            'right-sidebar'   => __('Right Sidebar', 'remote-startup-solutions'),
            'left-sidebar'   => __('Left Sidebar', 'remote-startup-solutions'),
            'three-column'   => __('Three Columns', 'remote-startup-solutions'),
            'four-column'   => __('Four Columns', 'remote-startup-solutions'),
        ),
    ));

    $wp_customize->add_setting('remote_startup_solutions_archive_pagination_alignment',array(
        'default' => 'left-align',
        'sanitize_callback' => 'remote_startup_solutions_sanitize_pagination_alignment'
    ));
    $wp_customize->add_control('remote_startup_solutions_archive_pagination_alignment',array(
        'type' => 'select',
        'label' => __('Pagination Alignment','remote-startup-solutions'),
        'section' => 'remote_startup_solutions_post_layout_section',
        'choices' => array(
            'right-align' => __('Right Alignment','remote-startup-solutions'),
            'center-align' => __('Center Alignment','remote-startup-solutions'),
            'left-align' => __('Left Alignment','remote-startup-solutions'),
        ),
    ) );

     /** Post Layouts Ends */

    /** Post Settings */
    $wp_customize->add_section(
        'remote_startup_solutions_post_settings',
        array(
            'title' => esc_html__( 'Post Settings', 'remote-startup-solutions' ),
            'priority' => 20,
            'capability' => 'edit_theme_options',
            'panel' => 'remote_startup_solutions_post_settings',
        )
    );

    /** Post Heading control */
    $wp_customize->add_setting( 
        'remote_startup_solutions_post_heading_setting', 
        array(
            'default'           => true,
            'sanitize_callback' => 'remote_startup_solutions_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'remote_startup_solutions_post_heading_setting',
        array(
            'label'       => __( 'Show / Hide Post Heading', 'remote-startup-solutions' ),
            'section'     => 'remote_startup_solutions_post_settings',
            'type'        => 'checkbox',
        )
    );

    /** Post Meta control */
    $wp_customize->add_setting( 
        'remote_startup_solutions_post_meta_setting', 
        array(
            'default'           => true,
            'sanitize_callback' => 'remote_startup_solutions_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'remote_startup_solutions_post_meta_setting',
        array(
            'label'       => __( 'Show / Hide Post Meta', 'remote-startup-solutions' ),
            'section'     => 'remote_startup_solutions_post_settings',
            'type'        => 'checkbox',
        )
    );

    /** Post Image control */
    $wp_customize->add_setting( 
        'remote_startup_solutions_post_image_setting', 
        array(
            'default'           => true,
            'sanitize_callback' => 'remote_startup_solutions_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'remote_startup_solutions_post_image_setting',
        array(
            'label'       => __( 'Show / Hide Post Image', 'remote-startup-solutions' ),
            'section'     => 'remote_startup_solutions_post_settings',
            'type'        => 'checkbox',
        )
    );

    /** Post Content control */
    $wp_customize->add_setting( 
        'remote_startup_solutions_post_content_setting', 
        array(
            'default'           => true,
            'sanitize_callback' => 'remote_startup_solutions_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'remote_startup_solutions_post_content_setting',
        array(
            'label'       => __( 'Show / Hide Post Content', 'remote-startup-solutions' ),
            'section'     => 'remote_startup_solutions_post_settings',
            'type'        => 'checkbox',
        )
    );
    /** Post ReadMore control */
     $wp_customize->add_setting( 'remote_startup_solutions_read_more_setting', array(
        'default'           => true,
        'sanitize_callback' => 'remote_startup_solutions_sanitize_checkbox',
    ) );

    $wp_customize->add_control( 'remote_startup_solutions_read_more_setting', array(
        'type'        => 'checkbox',
        'section'     => 'remote_startup_solutions_post_settings', 
        'label'       => __( 'Display Read More Button', 'remote-startup-solutions' ),
    ) );

    $wp_customize->add_setting('remote_startup_solutions_single_post_align',array(
        'default' => 'left-align',
        'sanitize_callback' => 'remote_startup_solutions_sanitize_single_post_align'
    ));
    $wp_customize->add_control('remote_startup_solutions_single_post_align',array(
        'type' => 'select',
        'label' => __('Post Content Alignment','remote-startup-solutions'),
        'section' => 'remote_startup_solutions_post_settings',
        'choices' => array(
            'left-align' => __('Left Alignment','remote-startup-solutions'),
            'right-align' => __('Right Alignment','remote-startup-solutions'),
            'center-align' => __('Center Alignment','remote-startup-solutions'),
        ),
    ) );

    $wp_customize->add_setting('remote_startup_solutions_blog_meta_order', array(
        'default' => array('heading', 'author', 'featured-image', 'content','button'),
        'sanitize_callback' => 'remote_startup_solutions_sanitize_sortable',
    ));
    $wp_customize->add_control(new Remote_Startup_Solutions_Control_Sortable($wp_customize, 'remote_startup_solutions_blog_meta_order', array(
        'label' => esc_html__('Post Meta Ordering', 'remote-startup-solutions'),
        'description' => __('Drag & drop post items to rearrange the ordering ( this control will not function by post format )', 'remote-startup-solutions') ,
        'section' => 'remote_startup_solutions_post_settings',
        'choices' => array(
            'heading' => __('heading', 'remote-startup-solutions') ,
            'author' => __('author', 'remote-startup-solutions') ,
            'featured-image' => __('featured-image', 'remote-startup-solutions') ,
            'content' => __('content', 'remote-startup-solutions') ,
            'button' => __('button', 'remote-startup-solutions') ,
        ) ,
    )));

    /** Post Settings Ends */

     /** Single Post Settings */
    $wp_customize->add_section(
        'remote_startup_solutions_single_post_settings',
        array(
            'title' => esc_html__( 'Single Post Settings', 'remote-startup-solutions' ),
            'priority' => 20,
            'capability' => 'edit_theme_options',
            'panel' => 'remote_startup_solutions_post_settings',
        )
    );

    /** Single Post Meta control */
    $wp_customize->add_setting( 
        'remote_startup_solutions_single_post_meta_setting', 
        array(
            'default'           => true,
            'sanitize_callback' => 'remote_startup_solutions_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'remote_startup_solutions_single_post_meta_setting',
        array(
            'label'       => __( 'Show / Hide Single Post Meta', 'remote-startup-solutions' ),
            'section'     => 'remote_startup_solutions_single_post_settings',
            'type'        => 'checkbox',
        )
    );

    /** Single Post Content control */
    $wp_customize->add_setting( 
        'remote_startup_solutions_single_post_content_setting', 
        array(
            'default'           => true,
            'sanitize_callback' => 'remote_startup_solutions_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'remote_startup_solutions_single_post_content_setting',
        array(
            'label'       => __( 'Show / Hide Single Post Content', 'remote-startup-solutions' ),
            'section'     => 'remote_startup_solutions_single_post_settings',
            'type'        => 'checkbox',
        )
    );

    /** Single Post Settings Ends */

         // Typography Settings Section
    $wp_customize->add_section('remote_startup_solutions_typography_settings', array(
        'title'      => esc_html__('Typography Settings', 'remote-startup-solutions'),
        'priority'   => 30,
        'capability' => 'edit_theme_options',
        'panel' => 'remote_startup_solutions_general_settings',
    ));

    // Array of fonts to choose from
    $font_choices = array(
        ''               => __('Select', 'remote-startup-solutions'),
        'Arial'          => 'Arial, sans-serif',
        'Verdana'        => 'Verdana, sans-serif',
        'Helvetica'      => 'Helvetica, sans-serif',
        'Times New Roman'=> '"Times New Roman", serif',
        'Georgia'        => 'Georgia, serif',
        'Courier New'    => '"Courier New", monospace',
        'Trebuchet MS'   => '"Trebuchet MS", sans-serif',
        'Tahoma'         => 'Tahoma, sans-serif',
        'Palatino'       => '"Palatino Linotype", serif',
        'Garamond'       => 'Garamond, serif',
        'Impact'         => 'Impact, sans-serif',
        'Comic Sans MS'  => '"Comic Sans MS", cursive, sans-serif',
        'Lucida Sans'    => '"Lucida Sans Unicode", sans-serif',
        'Arial Black'    => '"Arial Black", sans-serif',
        'Gill Sans'      => '"Gill Sans", sans-serif',
        'Segoe UI'       => '"Segoe UI", sans-serif',
        'Open Sans'      => '"Open Sans", sans-serif',
        'Roboto'         => 'Roboto, sans-serif',
        'Lato'           => 'Lato, sans-serif',
        'Montserrat'     => 'Montserrat, sans-serif',
        'Libre Baskerville' => 'Libre Baskerville',
    );

    // Heading Font Setting
    $wp_customize->add_setting('remote_startup_solutions_heading_font_family', array(
        'default'           => '',
        'sanitize_callback' => 'remote_startup_solutions_sanitize_choicess',
    ));
    $wp_customize->add_control('remote_startup_solutions_heading_font_family', array(
        'type'    => 'select',
        'choices' => $font_choices,
        'label'   => __('Select Font for Heading', 'remote-startup-solutions'),
        'section' => 'remote_startup_solutions_typography_settings',
    ));

    // Body Font Setting
    $wp_customize->add_setting('remote_startup_solutions_body_font_family', array(
        'default'           => '',
        'sanitize_callback' => 'remote_startup_solutions_sanitize_choicess',
    ));
    $wp_customize->add_control('remote_startup_solutions_body_font_family', array(
        'type'    => 'select',
        'choices' => $font_choices,
        'label'   => __('Select Font for Body', 'remote-startup-solutions'),
        'section' => 'remote_startup_solutions_typography_settings',
    ));

    /** Typography Settings Section End */

    /** General Settings */
    $wp_customize->add_panel( 
        'remote_startup_solutions_general_settings',
         array(
            'priority' => 40,
            'capability' => 'edit_theme_options',
            'title' => esc_html__( 'General Settings', 'remote-startup-solutions' ),
            'description' => esc_html__( 'Customize General Settings', 'remote-startup-solutions' ),
        ) 
    );

    /** General Settings */
    $wp_customize->add_section(
        'remote_startup_solutions_general_settings',
        array(
            'title' => esc_html__( 'Loader Settings', 'remote-startup-solutions' ),
            'priority' => 30,
            'capability' => 'edit_theme_options',
            'panel' => 'remote_startup_solutions_general_settings',
        )
    );

    /** Preloader control */
    $wp_customize->add_setting( 
        'remote_startup_solutions_header_preloader', 
        array(
            'default' => false,
            'sanitize_callback' => 'remote_startup_solutions_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'remote_startup_solutions_header_preloader',
        array(
            'label'       => __( 'Show Preloader', 'remote-startup-solutions' ),
            'section'     => 'remote_startup_solutions_general_settings',
            'type'        => 'checkbox',
        )
    );

    $wp_customize->add_setting('remote_startup_solutions_theme_width',array(
    'default' => 'full-width',
    'sanitize_callback' => 'remote_startup_solutions_sanitize_theme_width'
    ));
    $wp_customize->add_control('remote_startup_solutions_theme_width',array(
        'type' => 'select',
        'label' => __('Theme Width Option','remote-startup-solutions'),
        'section' => 'remote_startup_solutions_general_settings',
        'choices' => array(
            'full-width' => __('Fullwidth','remote-startup-solutions'),
            'container' => __('Container','remote-startup-solutions'),
            'container-fluid' => __('Container Fluid','remote-startup-solutions'),
        ),
    ) );

    /** Header Section Settings */
    $wp_customize->add_section(
        'remote_startup_solutions_header_section_settings',
        array(
            'title' => esc_html__( 'Header Section Settings', 'remote-startup-solutions' ),
            'priority' => 30,
            'capability' => 'edit_theme_options',
            'panel' => 'remote_startup_solutions_home_page_settings',
        )
    );

    $wp_customize->add_setting( 
        'remote_startup_solutions_show_hide_search', 
        array(
            'default' => false ,
            'sanitize_callback' => 'remote_startup_solutions_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'remote_startup_solutions_show_hide_search',
        array(
            'label'       => __( 'Show Search Icon', 'remote-startup-solutions' ),
            'section'     => 'remote_startup_solutions_header_section_settings',
            'type'        => 'checkbox',
        )
    );
    $wp_customize->add_setting('remote_startup_solutions_search_icon',array(
        'default'   => 'fas fa-search',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(new Remote_Startup_Solutions_Changeable_Icon(
        $wp_customize,'remote_startup_solutions_search_icon',array(
        'label' => __('Search Icon','remote-startup-solutions'),
        'transport' => 'refresh',
        'section'   => 'remote_startup_solutions_header_section_settings',
        'type'      => 'icon'
    )));

    /** Sticky Header control */
    $wp_customize->add_setting( 
        'remote_startup_solutions_sticky_header', 
        array(
            'default' => false,
            'sanitize_callback' => 'remote_startup_solutions_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'remote_startup_solutions_sticky_header',
        array(
            'label'       => __( 'Show Sticky Header', 'remote-startup-solutions' ),
            'section'     => 'remote_startup_solutions_header_section_settings',
            'type'        => 'checkbox',
        )
    );

    // Add Setting for Menu Font Weight
    $wp_customize->add_setting( 'menu_font_weight', array(
        'default'           => '700',
        'sanitize_callback' => 'remote_startup_solutions_sanitize_font_weight',
    ) );

    // Add Control for Menu Font Weight
    $wp_customize->add_control( 'menu_font_weight', array(
        'label'    => __( 'Menu Font Weight', 'remote-startup-solutions' ),
        'section'  => 'remote_startup_solutions_header_section_settings',
        'type'     => 'select',
        'choices'  => array(
            '100' => __( '100 - Thin', 'remote-startup-solutions' ),
            '200' => __( '200 - Extra Light', 'remote-startup-solutions' ),
            '300' => __( '300 - Light', 'remote-startup-solutions' ),
            '400' => __( '400 - Normal', 'remote-startup-solutions' ),
            '500' => __( '500 - Medium', 'remote-startup-solutions' ),
            '600' => __( '600 - Semi Bold', 'remote-startup-solutions' ),
            '700' => __( '700 - Bold', 'remote-startup-solutions' ),
            '800' => __( '800 - Extra Bold', 'remote-startup-solutions' ),
            '900' => __( '900 - Black', 'remote-startup-solutions' ),
        ),
    ) );

    // Add Setting for Menu Text Transform
    $wp_customize->add_setting( 'menu_text_transform', array(
        'default'           => 'uppercase',
        'sanitize_callback' => 'remote_startup_solutions_sanitize_text_transform',
    ) );

    // Add Control for Menu Text Transform
    $wp_customize->add_control( 'menu_text_transform', array(
        'label'    => __( 'Menu Text Transform', 'remote-startup-solutions' ),
        'section'  => 'remote_startup_solutions_header_section_settings',
        'type'     => 'select',
        'choices'  => array(
            'none'       => __( 'None', 'remote-startup-solutions' ),
            'capitalize' => __( 'Capitalize', 'remote-startup-solutions' ),
            'uppercase'  => __( 'Uppercase', 'remote-startup-solutions' ),
            'lowercase'  => __( 'Lowercase', 'remote-startup-solutions' ),
        ),
    ) );

    /** Header Section Settings End */

    /** Socail Section Settings */
    $wp_customize->add_section(
        'remote_startup_solutions_social_section_settings',
        array(
            'title' => esc_html__( 'Social Media Section Settings', 'remote-startup-solutions' ),
            'priority' => 30,
            'capability' => 'edit_theme_options',
            'panel' => 'remote_startup_solutions_home_page_settings',
        )
    );

    /** Home Page Settings */
    $wp_customize->add_panel( 
        'remote_startup_solutions_home_page_settings',
         array(
            'priority' => 9,
            'capability' => 'edit_theme_options',
            'title' => esc_html__( 'Home Page Settings', 'remote-startup-solutions' ),
            'description' => esc_html__( 'Customize Home Page Settings', 'remote-startup-solutions' ),
        ) 
    );

    /** Slider Section Settings */
    $wp_customize->add_section(
        'remote_startup_solutions_slider_section_settings',
        array(
            'title' => esc_html__( 'Slider Section Settings', 'remote-startup-solutions' ),
            'priority' => 30,
            'capability' => 'edit_theme_options',
            'panel' => 'remote_startup_solutions_home_page_settings',
        )
    );

    /** Slider Section control */
    $wp_customize->add_setting( 
        'remote_startup_solutions_slider_setting', 
        array(
            'default' => false,
            'sanitize_callback' => 'remote_startup_solutions_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'remote_startup_solutions_slider_setting',
        array(
            'label'       => __( 'Show Slider', 'remote-startup-solutions' ),
            'section'     => 'remote_startup_solutions_slider_section_settings',
            'type'        => 'checkbox',
        )
    );
    
    $categories = get_categories();
        $cat_posts = array();
            $i = 0;
            $cat_posts[]='Select';
        foreach($categories as $category){
            if($i==0){
            $default = $category->slug;
            $i++;
        }
        $cat_posts[$category->slug] = $category->name;
    }

    $wp_customize->add_setting(
        'remote_startup_solutions_blog_slide_category',
        array(
            'default'   => 'select',
            'sanitize_callback' => 'remote_startup_solutions_sanitize_choices',
        )
    );
    $wp_customize->add_control(
        'remote_startup_solutions_blog_slide_category',
        array(
            'type'    => 'select',
            'choices' => $cat_posts,
            'label' => __('Select Category to display Latest Post','remote-startup-solutions'),
            'section' => 'remote_startup_solutions_slider_section_settings',
        )
    );

        // Section Text
    $wp_customize->add_setting('remote_startup_solutions_slider_second_button_url', 
        array(
        'default'           => '',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',    
        'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control('remote_startup_solutions_slider_second_button_url', 
        array(
        'label'       => __('Slider Second Button URL', 'remote-startup-solutions'),
        'section'     => 'remote_startup_solutions_slider_section_settings',   
        'settings'    => 'remote_startup_solutions_slider_second_button_url',
        'type'        => 'url'
        )
    );


    /** Classes Section Settings */
    $wp_customize->add_section(
        'remote_startup_solutions_classes_section_settings',
        array(
            'title' => esc_html__( 'Project Section Settings', 'remote-startup-solutions' ),
            'priority' => 30,
            'capability' => 'edit_theme_options',
            'panel' => 'remote_startup_solutions_home_page_settings',
        )
    );

    /** Classes Section control */
    $wp_customize->add_setting( 
        'remote_startup_solutions_classes_setting', 
        array(
            'default' => false,
            'sanitize_callback' => 'remote_startup_solutions_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'remote_startup_solutions_classes_setting',
        array(
            'label'       => __( 'Show Project Section', 'remote-startup-solutions' ),
            'section'     => 'remote_startup_solutions_classes_section_settings',
            'type'        => 'checkbox',
        )
    );

    // Section Title
    $wp_customize->add_setting(
        'remote_startup_solutions_service_title', 
        array(
            'default'           => '',
            'type'              => 'theme_mod',
            'capability'        => 'edit_theme_options',    
            'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control(
        'remote_startup_solutions_service_title', 
        array(
            'label'       => __('Section Title', 'remote-startup-solutions'),
            'section'     => 'remote_startup_solutions_classes_section_settings',
            'settings'    => 'remote_startup_solutions_service_title',
            'type'        => 'text'
        )
    );

     // Section Text
    $wp_customize->add_setting(
        'remote_startup_solutions_service_text', 
        array(
            'default'           => '',
            'type'              => 'theme_mod',
            'capability'        => 'edit_theme_options',    
            'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control(
        'remote_startup_solutions_service_text', 
        array(
            'label'       => __('Section Text', 'remote-startup-solutions'),
            'section'     => 'remote_startup_solutions_classes_section_settings',
            'settings'    => 'remote_startup_solutions_service_text',
            'type'        => 'text'
        )
    );

    // Post Categories
    $categories = get_categories();
    $cat_posts = array();
    $default = '';
    $cat_posts[] = 'Select';
    foreach ($categories as $category) {
        $cat_posts[$category->slug] = $category->name;
    }

    $wp_customize->add_setting(
        'remote_startup_solutions_blog_args_',
        array(
            'default'            => 'select',
            'sanitize_callback'  => 'remote_startup_solutions_sanitize_choices',
        )
    );
    $wp_customize->add_control(
        'remote_startup_solutions_blog_args_',
        array(
            'type'     => 'select',
            'choices'  => $cat_posts,
            'label'    => __('Select Category to Display Projects', 'remote-startup-solutions'),
            'section'  => 'remote_startup_solutions_classes_section_settings',
        )
    );


    
    /** Home Page Settings Ends */
    
    /** Footer Section */
    $wp_customize->add_section(
        'remote_startup_solutions_footer_section',
        array(
            'title' => __( 'Footer Settings', 'remote-startup-solutions' ),
            'priority' => 70,
            'panel' => 'remote_startup_solutions_home_page_settings',
        )
    );

    /** Footer Copyright control */
    $wp_customize->add_setting( 
        'remote_startup_solutions_footer_setting', 
        array(
            'default' => true,
            'sanitize_callback' => 'remote_startup_solutions_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'remote_startup_solutions_footer_setting',
        array(
            'label'       => __( 'Show Footer Copyright', 'remote-startup-solutions' ),
            'section'     => 'remote_startup_solutions_footer_section',
            'type'        => 'checkbox',
        )
    );
    
    /** Copyright Text */
    $wp_customize->add_setting(
        'remote_startup_solutions_footer_copyright_text',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'remote_startup_solutions_footer_copyright_text',
        array(
            'label' => __( 'Copyright Info', 'remote-startup-solutions' ),
            'section' => 'remote_startup_solutions_footer_section',
            'type' => 'text',
        )
    );  
$wp_customize->add_setting('footer_background_image',
        array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
        )
    );


    $wp_customize->add_control(
         new WP_Customize_Cropped_Image_Control($wp_customize, 'footer_background_image',
            array(
                'label' => esc_html__('Footer Background Image', 'remote-startup-solutions'),
                'description' => sprintf(esc_html__('Recommended Size %1$s px X %2$s px', 'remote-startup-solutions'), 1024, 800),
                'section' => 'remote_startup_solutions_footer_section',
                'width' => 1024,
                'height' => 800,
                'flex_width' => true,
                'flex_height' => true,
                'priority' => 100,
            )
        )
    );

    /* Footer Background Color*/
    $wp_customize->add_setting(
        'footer_background_color',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'footer_background_color',
            array(
                'label' => __('Footer Widget Area Background Color', 'remote-startup-solutions'),
                'section' => 'remote_startup_solutions_footer_section',
                'type' => 'color',
            )
        )
    );

    /** Scroll to top control */
    $wp_customize->add_setting( 
        'remote_startup_solutions_scroll_to_top', 
        array(
            'default' => 1,
            'sanitize_callback' => 'remote_startup_solutions_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control(
        'remote_startup_solutions_scroll_to_top',
        array(
            'label'       => __( 'Show Scroll To Top', 'remote-startup-solutions' ),
            'section'     => 'remote_startup_solutions_footer_section',
            'type'        => 'checkbox',
        )
    );

     $wp_customize->add_setting('remote_startup_solutions_scroll_icon',array(
        'default'   => 'fas fa-arrow-up',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(new Remote_Startup_Solutions_Changeable_Icon(
        $wp_customize,'remote_startup_solutions_scroll_icon',array(
        'label' => __('Scroll Top Icon','remote-startup-solutions'),
        'transport' => 'refresh',
        'section'   => 'remote_startup_solutions_footer_section',
        'type'      => 'icon'
    )));

    $wp_customize->add_setting('remote_startup_solutions_scroll_top_alignment',array(
        'default' => 'right-align',
        'sanitize_callback' => 'remote_startup_solutions_sanitize_scroll_top_alignment'
    ));
    $wp_customize->add_control('remote_startup_solutions_scroll_top_alignment',array(
        'type' => 'select',
        'label' => __('Scroll Top Alignment','remote-startup-solutions'),
        'section' => 'remote_startup_solutions_footer_section',
        'choices' => array(
            'right-align' => __('Right Alignment','remote-startup-solutions'),
            'center-align' => __('Center Alignment','remote-startup-solutions'),
            'left-align' => __('Left Alignment','remote-startup-solutions'),
        ),
    ) );

    // 404 PAGE SETTINGS
    $wp_customize->add_section(
        'remote_startup_solutions_404_section',
        array(
            'title' => __( '404 Page Settings', 'remote-startup-solutions' ),
            'priority' => 70,
            'panel' => 'remote_startup_solutions_general_settings',
        )
    );
   
    $wp_customize->add_setting('404_page_image', array(
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw', // Sanitize as URL
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, '404_page_image', array(
        'label' => __('404 Page Image', 'remote-startup-solutions'),
        'section' => 'remote_startup_solutions_404_section',
        'settings' => '404_page_image',
    )));

    $wp_customize->add_setting('404_pagefirst_header', array(
        'default' => __('404', 'remote-startup-solutions'),
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field', // Sanitize as text field
    ));

    $wp_customize->add_control('404_pagefirst_header', array(
        'type' => 'text',
        'label' => __('Heading', 'remote-startup-solutions'),
        'section' => 'remote_startup_solutions_404_section',
    ));

    // Setting for 404 page header
    $wp_customize->add_setting('404_page_header', array(
        'default' => __('Sorry, that page can\'t be found!', 'remote-startup-solutions'),
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field', // Sanitize as text field
    ));

    $wp_customize->add_control('404_page_header', array(
        'type' => 'text',
        'label' => __('Heading', 'remote-startup-solutions'),
        'section' => 'remote_startup_solutions_404_section',
    ));

}
add_action( 'customize_register', 'remote_startup_solutions_customize_register' );
endif;

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function remote_startup_solutions_customize_preview_js() {
    // Use minified libraries if SCRIPT_DEBUG is false
    $remote_startup_solutions_build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
    $remote_startup_solutions_suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script( 'remote_startup_solutions_customizer', get_template_directory_uri() . '/js' . $remote_startup_solutions_build . '/customizer' . $remote_startup_solutions_suffix . '.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'remote_startup_solutions_customize_preview_js' );