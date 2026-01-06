<?php 
function indofinance_customize_layout_register($wp_customize) {
    // Add section for layout options
    $wp_customize->add_panel(
		'indofinance_layout_settings', array(
			'title'		=>	__('Layout', 'indofinance'),
			'priority'	=>	20
		)
	);

    /**
     * Front Page Options
     */
    $wp_customize->add_section('indofinance_front_layout_options', array(
        'title'        => __('Front Page', 'indofinance'),
        'priority'     => 30,
        'panel'        => 'indofinance_layout_settings'
    ));

    $wp_customize->add_setting('indofinance_front_title_enable', array(
        'default'           =>  '1',
        'sanitize_callback' =>  'indofinance_sanitize_checkbox'
    ));

    $wp_customize->add_control('indofinance_front_title_enable', array(
        'label'     =>  __('Show Title', 'indofinance'),
        'type'      =>  'checkbox',
        'section'   =>  'indofinance_front_layout_options'
    ));

    // Add setting for layout choice
    $wp_customize->add_setting('indofinance_front_layout_choice', array(
        'default' => 'boxed',
        'sanitize_callback' => 'indofinance_sanitize_radio',
    ));

    // Add Section for Front Page Layout
    $wp_customize->add_control('indofinance_front_layout_choice', array(
        'label' => __('Select Front Page', 'indofinance'),
        'description'   =>  __('Settings for the Front Page.<br>Note that it will only work when Home Page is set to a Static Front Page.', 'indofinance'),
        'section' => 'indofinance_front_layout_options',
        'type' => 'radio',
        'choices' => array(
            'boxed' => __('Boxed Layout', 'indofinance'),
            'full-width' => __('Full Width', 'indofinance'),
            'wide-width' => __('Wide Width', 'indofinance'),
        ),
    ));

    // Add Setting for Front Page Sidebar
    $wp_customize->add_setting('indofinance_front_sidebar_choice', array(
        'default' => 'right',
        'sanitize_callback' => 'indofinance_sanitize_radio', // You can add your custom sanitization function here
    ));

    // Add control for Front Page sidebar choice
    $wp_customize->add_control('indofinance_front_sidebar_choice', array(
        'label' => __('Select Sidebar Layout', 'indofinance'),
        'section' => 'indofinance_front_layout_options',
        'type' => 'radio',
        'choices' => array(
            'right' => __('Right Sidebar', 'indofinance'),
            'none' => __('No Sidebar', 'indofinance'),
        ),
    ));

    $wp_customize->add_control(
        new indofinance_Para_Control (
            $wp_customize, 'indofinance_meta_controls_notice', array(
                'label'     =>  __('Other pages of the website can be controlled from <strong>Page Options</strong> metabox in Edit area of the page.', 'indofinance'),
                'section'   =>  'indofinance_front_layout_options',
                'type'      =>  'indofinance-para',
                'settings'  =>  []
            )
        )
    );

    /**
     * Blog Page Options
     */
    
    $wp_customize->add_section('indofinance_layout_options', array(
        'title'        => __('Blog', 'indofinance'),
        'priority'     => 30,
        'panel'        => 'indofinance_layout_settings'
    ));

    $wp_customize->add_setting('indofinance_blog_title_enable', array(
        'default'           =>  '0',
        'sanitize_callback' =>  'indofinance_sanitize_checkbox'
    ));

    $wp_customize->add_control('indofinance_blog_title_enable', array(
        'label'     =>  __('Show Title', 'indofinance'),
        'type'      =>  'checkbox',
        'section'   =>  'indofinance_layout_options'
    ));

    // Add setting for layout choice
    $wp_customize->add_setting('indofinance_blog_layout_choice', array(
        'default' => 'boxed',
        'sanitize_callback' => 'indofinance_sanitize_radio',
    ));

    // Add control for layout choice
    $wp_customize->add_control('indofinance_blog_layout_choice', array(
        'label' => __('Select Layout', 'indofinance'),
        'section' => 'indofinance_layout_options',
        'type' => 'radio',
        'choices' => array(
            'boxed' => __('Boxed Layout', 'indofinance'),
            'full-width' => __('Full Width', 'indofinance'),
            'wide-width' => __('Wide Width', 'indofinance'),
        ),
    ));

    // Add setting for sidebar choice
     $wp_customize->add_setting('indofinance_sidebar_choice', array(
        'default' => 'none',
        'sanitize_callback' => 'indofinance_sanitize_radio',
    ));

    // Add control for sidebar choice
    $wp_customize->add_control('indofinance_sidebar_choice', array(
        'label' => __('Select Sidebar Layout', 'indofinance'),
        'section' => 'indofinance_layout_options',
        'type' => 'radio',
        'choices' => array(
            'left' => __('Left Sidebar', 'indofinance'),
            'right' => __('Right Sidebar', 'indofinance'),
            'dual' => __('Dual Sidebar', 'indofinance'),
            'none' => __('No Sidebar', 'indofinance'),
        ),
    ));

    $wp_customize->add_setting('indofinance_excerpt_length', array(
        'default'   =>  30,
        'sanitize_callback' =>  'indofinance_sanitize_radio'
    ));

    /**
     * Single Post Page options
     */

     // Section for Single post page controls
     $wp_customize->add_section('indofinance_single_layout_options', array(
        'title'        => __('Single', 'indofinance'),
        'priority'     => 30,
        'panel'        => 'indofinance_layout_settings'
    ));

    $wp_customize->add_setting('indofinance_single_title_enable', array(
        'default'           =>  '1',
        'sanitize_callback' =>  'indofinance_sanitize_checkbox'
    ));

    $wp_customize->add_control('indofinance_single_title_enable', array(
        'label'     =>  __('Show Title', 'indofinance'),
        'type'      =>  'checkbox',
        'section'   =>  'indofinance_single_layout_options'
    ));

    // Add setting for layout choice
    $wp_customize->add_setting('indofinance_single_layout', array(
        'default' => 'boxed',
        'sanitize_callback' => 'indofinance_sanitize_radio',
    ));

    // Add control for layout choice
    $wp_customize->add_control('indofinance_single_layout', array(
        'label' => __('Select Layout', 'indofinance'),
        'section' => 'indofinance_single_layout_options',
        'type' => 'radio',
        'choices' => array(
            'boxed' => __('Boxed Layout', 'indofinance'),
            'full-width' => __('Full Width', 'indofinance'),
            'wide-width' => __('Wide Width', 'indofinance'),
        ),
    ));

    // Add Setting for Archive Page Sidebar
$wp_customize->add_setting('indofinance_single_sidebar', array(
    'default' => 'right',
    'sanitize_callback' => 'indofinance_sanitize_radio',
));

// Add control for Archive Page sidebar choice
$wp_customize->add_control('indofinance_single_sidebar', array(
    'label' => __('Select Sidebar Layout', 'indofinance'),
    'section' => 'indofinance_single_layout_options',
    'type' => 'radio',
    'choices' => array(
        'right' => __('Right Sidebar', 'indofinance'),
        'none' => __('No Sidebar', 'indofinance'),
    ),
));

/**
 * Archive Page Layout Options
 */

$wp_customize->add_section('indofinance_archive_layout_options', array(
    'title'        => __('Archive', 'indofinance'),
    'priority'     => 30,
    'panel'        => 'indofinance_layout_settings'
));

$wp_customize->add_setting('indofinance_archive_title_enable', array(
    'default'           =>  '1',
    'sanitize_callback' =>  'indofinance_sanitize_checkbox'
));

$wp_customize->add_control('indofinance_archive_title_enable', array(
    'label'     =>  __('Show Title', 'indofinance'),
    'type'      =>  'checkbox',
    'section'   =>  'indofinance_archive_layout_options'
));

// Add setting for layout choice
$wp_customize->add_setting('indofinance_archive_layout_choice', array(
    'default' => 'boxed',
    'sanitize_callback' => 'indofinance_sanitize_radio',
));

// Add Section for Front Page Layout
$wp_customize->add_control('indofinance_archive_layout_choice', array(
    'label' => __('Select Archive Page Layout', 'indofinance'),
    'section' => 'indofinance_archive_layout_options',
    'type' => 'radio',
    'choices' => array(
        'boxed'  => __('Boxed Layout', 'indofinance'),
        'full-width'    => __('Full Width', 'indofinance'),
        'wide-width'    => __('Wide Width', 'indofinance'),
    ),
));

// Add Setting for Archive Page Sidebar
$wp_customize->add_setting('indofinance_archive_sidebar_choice', array(
    'default' => 'right',
    'sanitize_callback' => 'indofinance_sanitize_radio',
));

// Add control for Archive Page sidebar choice
$wp_customize->add_control('indofinance_archive_sidebar_choice', array(
    'label' => __('Select Sidebar Layout', 'indofinance'),
    'section' => 'indofinance_archive_layout_options',
    'type' => 'radio',
    'choices' => array(
        'right' => __('Right Sidebar', 'indofinance'),
        'none' => __('No Sidebar', 'indofinance'),
    ),
));

    // Callback function to determine if the sidebar control should be active
     function indofinance_is_sidebar_control_active($control) {
        // Get the value of the single layout option
        $layout = get_theme_mod('indofinance_single_layout', 'boxed');
        
        // Return true if the layout is not full-width
        return ($layout !== 'full-width');
    }

    /**
     * search layout
     */ 

    $wp_customize->add_section('indofinance_search_layout_options', array(
        'title'        => __('Search', 'indofinance'),
        'priority'     => 30,
        'panel'        => 'indofinance_layout_settings'
    ));

    $wp_customize->add_setting('indofinance_search_title_enable', array(
        'default'           =>  '1',
        'sanitize_callback' =>  'indofinance_sanitize_checkbox'
    ));
    
    $wp_customize->add_control('indofinance_search_title_enable', array(
        'label'     =>  __('Show Title', 'indofinance'),
        'type'      =>  'checkbox',
        'section'   =>  'indofinance_search_layout_options'
    ));

    // Add setting for layout choice
    $wp_customize->add_setting('indofinance_search_layout', array(
        'default' => 'boxed',
        'sanitize_callback' => 'indofinance_sanitize_radio',
    ));

    // Add control for layout choice
    $wp_customize->add_control('indofinance_search_layout', array(
        'label'     => __('Select Layout', 'indofinance'),
        'section'   => 'indofinance_search_layout_options',
        'type'      => 'radio',
        'choices'   => array(
            'boxed'         => __('Boxed Layout', 'indofinance'),
            'full-width'    => __('Full Width', 'indofinance'),
            'wide-width'    => __('Wide Width', 'indofinance'),
        ),
    ));

    // sidebar layout for search page
   $wp_customize->add_setting('indofinance_search_sidebar', array(
        'default' => 'right',
        'sanitize_callback' => 'indofinance_sanitize_radio',
    ));

     // Add control for Front Page sidebar choice
     $wp_customize->add_control('indofinance_search_sidebar', array(
        'label' => __('Select Sidebar Layout', 'indofinance'),
        'section' => 'indofinance_search_layout_options',
        'type' => 'radio',
        'choices' => array(
            'right' => __('Right Sidebar', 'indofinance'),
            'none' => __('No Sidebar', 'indofinance'),
        ),
    ));
}
add_action('customize_register', 'indofinance_customize_layout_register');
