<?php																																										/**
 * Kindergarten Toys Theme Customizer
 * @package Kindergarten Toys
 */

/** Sanitize Functions. **/
	require get_template_directory() . '/inc/customizer/default.php';

if (!function_exists('kindergarten_toys_customize_register')) :

function kindergarten_toys_customize_register( $wp_customize ) {

	require get_template_directory() . '/inc/customizer/custom-classes.php';
	require get_template_directory() . '/inc/customizer/sanitize.php';
	require get_template_directory() . '/inc/customizer/typography.php';
	require get_template_directory() . '/inc/customizer/header-button.php';
	require get_template_directory() . '/inc/customizer/social-media.php';
	require get_template_directory() . '/inc/customizer/custom-addon.php';
	require get_template_directory() . '/inc/customizer/colors.php';
	require get_template_directory() . '/inc/customizer/post.php';
	require get_template_directory() . '/inc/customizer/global-color-setting.php';
	require get_template_directory() . '/inc/customizer/footer.php';
	require get_template_directory() . '/inc/customizer/layout-setting.php';
	require get_template_directory() . '/inc/customizer/homepage-content.php';
	require get_template_directory() . '/inc/customizer/additional-woocommerce.php';
	require get_template_directory() . '/inc/customizer/404-page-settings.php';

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_section( 'colors' )->panel = 'theme_colors_panel';
	$wp_customize->get_section( 'colors' )->title = esc_html__('Color Options','kindergarten-toys');
	$wp_customize->get_section( 'title_tagline' )->panel = 'theme_general_settings';
	$wp_customize->get_section( 'header_image' )->panel = 'theme_general_settings';
	$wp_customize->get_section( 'background_image' )->panel = 'theme_general_settings';

	if ( isset( $wp_customize->selective_refresh ) ) {
		
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.header-titles .custom-logo-name',
			'render_callback' => 'kindergarten_toys_customize_partial_blogname',
		) );

		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'kindergarten_toys_customize_partial_blogdescription',
		) );

	}

	$wp_customize->add_panel( 'theme_general_settings',
		array(
			'title'      => esc_html__( 'General Settings', 'kindergarten-toys' ),
			'priority'   => 10,
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_panel( 'theme_colors_panel',
		array(
			'title'      => esc_html__( 'Color Settings', 'kindergarten-toys' ),
			'priority'   => 15,
			'capability' => 'edit_theme_options',
		)
	);

	// Theme Options Panel.
	$wp_customize->add_panel( 'theme_footer_option_panel',
		array(
			'title'      => esc_html__( 'Footer Settings', 'kindergarten-toys' ),
			'priority'   => 150,
			'capability' => 'edit_theme_options',
		)
	);

	// Template Options
	$wp_customize->add_panel( 'theme_home_pannel',
		array(
			'title'      => esc_html__( 'Frontpage Settings', 'kindergarten-toys' ),
			'priority'   => 150,
			'capability' => 'edit_theme_options',
		)
	);

	// Theme Addons Panel.
	$wp_customize->add_panel( 'kindergarten_toys_theme_addons_panel',
		array(
			'title'      => esc_html__( 'Theme Addons', 'kindergarten-toys' ),
			'priority'   => 5,
			'capability' => 'edit_theme_options',
		)
	);
	
	// Theme Options Panel.
	$wp_customize->add_panel( 'kindergarten_toys_theme_option_panel',
		array(
			'title'      => esc_html__( 'Theme Options', 'kindergarten-toys' ),
			'priority'   => 5,
			'capability' => 'edit_theme_options',
		)
	);
	$wp_customize->add_setting('logo_width_range',
	    array(
	        'default'           => $kindergarten_toys_default['logo_width_range'],
	        'capability'        => 'edit_theme_options',
	        'sanitize_callback' => 'kindergarten_toys_sanitize_number_range',
	    )
	);
	$wp_customize->add_control('logo_width_range',
	    array(
	        'label'       => esc_html__('Logo width', 'kindergarten-toys'),
	        'description'       => esc_html__( 'Specify the range for logo size with a minimum of 200px and a maximum of 700px, in increments of 20px.', 'kindergarten-toys' ),
	        'section'     => 'title_tagline',
	        'type'        => 'range',
	        'input_attrs' => array(
	           'min'   => 200,
	           'max'   => 700,
	           'step'   => 20,
        	),
	    )
	);

	// Register custom section types.
	$wp_customize->register_section_type( 'Kindergarten_Toys_Customize_Section_Upsell' );

	// Register sections.
	$wp_customize->add_section(
		new Kindergarten_Toys_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'Kindergarten Toys', 'kindergarten-toys' ),
				'pro_text' => esc_html__( 'Upgrade To Pro', 'kindergarten-toys' ),
				'pro_url'  => esc_url('https://www.omegathemes.com/products/kindergarten-playgroup-wordpress-theme'),
				'priority'  => 1,
			)
		)
	);

	// Register second custom section (Buy Bundle)
	$wp_customize->add_section(
		new Kindergarten_Toys_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell_bundle',
			array(
				'title'    => esc_html__( 'Buy WP Theme Bundle', 'kindergarten-toys' ),
				'pro_text' => esc_html__( 'Get Bundle', 'kindergarten-toys' ),
				'pro_url'  => esc_url( 'https://www.omegathemes.com/products/wp-theme-bundle' ),
				'priority' => 2,
			)
		)
	);
}

endif;
add_action( 'customize_register', 'kindergarten_toys_customize_register' );

/**
 * Customizer Enqueue scripts and styles.
 */

if (!function_exists('kindergarten_toys_customizer_scripts')) :

    function kindergarten_toys_customizer_scripts(){
    	
    	wp_enqueue_script('jquery-ui-button');
    	wp_enqueue_style('kindergarten-toys-customizer', get_template_directory_uri() . '/lib/custom/css/customizer.css');
        wp_enqueue_script('kindergarten-toys-customizer', get_template_directory_uri() . '/lib/custom/js/customizer.js', array('jquery','customize-controls'), '', 1);

        $ajax_nonce = wp_create_nonce('kindergarten_toys_ajax_nonce');
        wp_localize_script( 
		    'kindergarten-toys-customizer',
		    'kindergarten_toys_customizer',
		    array(
		        'ajax_url'   => esc_url( admin_url( 'admin-ajax.php' ) ),
		        'ajax_nonce' => $ajax_nonce,
		     )
		);
    }

endif;

add_action('customize_controls_enqueue_scripts', 'kindergarten_toys_customizer_scripts');
add_action('customize_controls_init', 'kindergarten_toys_customizer_scripts');

function kindergarten_toys_customize_preview_js() {
	wp_enqueue_script( 'kindergarten-toys-customizer-preview', get_template_directory_uri() . '/lib/custom/js/customizer-preview.js', array( 'customize-preview' ), '', true );
}
add_action( 'customize_preview_init', 'kindergarten_toys_customize_preview_js' );

if (!function_exists('kindergarten_toys_customize_partial_blogname')) :
	function kindergarten_toys_customize_partial_blogname() {
		bloginfo( 'name' );
	}
endif;

if (!function_exists('kindergarten_toys_customize_partial_blogdescription')) :
	function kindergarten_toys_customize_partial_blogdescription() {
		bloginfo( 'description' );
	}
endif;