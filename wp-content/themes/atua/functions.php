<?php
/**
 * Atua functions and definitions
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Atua
 */
 
if ( ! function_exists( 'atua_theme_setup' ) ) :
function atua_theme_setup() {
	
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Atua, use a find and replace
	 * to change 'Atua' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'atua' );
	
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	
	add_theme_support( 'custom-header' );
	
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary_menu' => esc_html__( 'Primary Menu', 'atua' ),
	) );
	
	//Add selective refresh for sidebar widget
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	// woocommerce support
	add_theme_support( 'woocommerce' );
	
	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support('custom-logo');
	
	/**
	 * Custom background support.
	 */
	add_theme_support( 'custom-background', apply_filters( 'atua_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	
	/**
	 * Set default content width.
	 */
	if ( ! isset( $content_width ) ) {
		$content_width = 800;
	}	
}
endif;
add_action( 'after_setup_theme', 'atua_theme_setup' );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

function atua_widgets_init() {	
	if ( class_exists( 'WooCommerce' ) ) {
		register_sidebar( array(
			'name' => __( 'WooCommerce Widget Area', 'atua' ),
			'id' => 'atua-woocommerce-sidebar',
			'description' => __( 'This Widget area for WooCommerce Widget', 'atua' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h5 class="widget-title">',
			'after_title' => '</h5>',
		) );
	}
	
	register_sidebar( array(
		'name' => __( 'Sidebar Widget Area', 'atua' ),
		'id' => 'atua-sidebar-primary',
		'description' => __( 'The Primary Widget Area', 'atua' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h5 class="widget-title"><span></span>',
		'after_title' => '</h5>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer  1', 'atua' ),
		'id' => 'atua-footer-widget-1',
		'description' => __( 'The Footer Widget Area 1', 'atua' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer  2', 'atua' ),
		'id' => 'atua-footer-widget-2',
		'description' => __( 'The Footer Widget Area 2', 'atua' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer  3', 'atua' ),
		'id' => 'atua-footer-widget-3',
		'description' => __( 'The Footer Widget Area 3', 'atua' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer  4', 'atua' ),
		'id' => 'atua-footer-widget-4',
		'description' => __( 'The Footer Widget Area 4', 'atua' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );
}
add_action( 'widgets_init', 'atua_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
function atua_scripts() {
	
	/**
	 * Styles.
	 */
	// Owl Crousel	
	wp_enqueue_style('owl-carousel-min',get_template_directory_uri().'/assets/vendors/css/owl.carousel.min.css');
	
	// Font Awesome
	wp_enqueue_style('all-css',get_template_directory_uri().'/assets/vendors/css/all.css');
	
	// Animate
	wp_enqueue_style('animate',get_template_directory_uri().'/assets/vendors/css/animate.css');
	
	// Atua Core
	wp_enqueue_style('atua-core',get_template_directory_uri().'/assets/css/core.css');

	// Atua Theme
	wp_enqueue_style('atua-theme', get_template_directory_uri() . '/assets/css/themes.css');
	
	// Atua WooCommerce
	wp_enqueue_style('atua-woocommerce',get_template_directory_uri().'/assets/css/woo-styles.css');
	
	// Atua Style
	wp_enqueue_style( 'atua-style', get_stylesheet_uri() );
	
	// Scripts
	wp_enqueue_script( 'jquery' );
	
	// Owl Crousel
	wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/assets/vendors/js/owl.carousel.js', array('jquery'), true);
	
	// Wow
	wp_enqueue_script('wow-min', get_template_directory_uri() . '/assets/vendors/js/wow.min.js', array('jquery'), false, true);
	
	// parallax
	wp_enqueue_script('parallax', get_template_directory_uri() . '/assets/vendors/js/parallax.min.js', array('jquery'), false, true);
	
	// Atua Theme
	wp_enqueue_script('atua-theme', get_template_directory_uri() . '/assets/js/theme.js', array('jquery'), false, true);

	// Atua custom
	wp_enqueue_script('atua-custom-js', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), false, true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'atua_scripts' );


/**
 * Enqueue admin scripts and styles.
 */
function atua_admin_enqueue_scripts(){
	wp_enqueue_style('atua-admin-style', get_template_directory_uri() . '/inc/admin/assets/css/admin.css');
	wp_enqueue_script( 'atua-admin-script', get_template_directory_uri() . '/inc/admin/assets/js/atua-admin-script.js', array( 'jquery' ), '', true );
    wp_localize_script( 'atua-admin-script', 'atua_ajax_object',
        array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
    );
}
add_action( 'admin_enqueue_scripts', 'atua_admin_enqueue_scripts' );


/**
 * Enqueue User Custom styles.
 */
 if( ! function_exists( 'atua_user_custom_style' ) ):
    function atua_user_custom_style() {

		$atua_print_style = '';
		
			
		 /*=========================================
		 Atua Page Title
		=========================================*/
		$atua_print_style   .= atua_customizer_value( 'atua_breadcrumb_height_option', '.dt_pagetitle ', array( 'padding-top' ), array( 7, 7, 7 ), 'rem' );
		$atua_print_style   .= atua_customizer_value( 'atua_breadcrumb_height_option', '.dt_pagetitle ', array( 'padding-bottom' ), array( 7, 7, 7 ), 'rem' );
		
		
		$atua_breadcrumb_img_opacity 	= get_theme_mod('atua_breadcrumb_img_opacity','0.7');
		$atua_breadcrumb_opacity_color 	= get_theme_mod('atua_breadcrumb_opacity_color','#000');
			$atua_print_style .=".dt_pagetitle .parallax-bg:before {
					    opacity: " .esc_attr($atua_breadcrumb_img_opacity). ";
						background: " .esc_attr($atua_breadcrumb_opacity_color). ";
				}\n";
		
	
		 /*=========================================
		 Atua Logo Size
		=========================================*/
		$atua_print_style   .= atua_customizer_value( 'hdr_logo_size', '.site--logo img', array( 'max-width' ), array( 150, 150, 150 ), 'px !important' );
		
			
		$atua_site_container_width 			 = get_theme_mod('atua_site_container_width','1252');
			if($atua_site_container_width >=768 && $atua_site_container_width <=2000){
				$atua_print_style .=".dt-container,.dt__slider-main .owl-dots {
						max-width: " .esc_attr($atua_site_container_width). "px;
					}.header--eight .dt-container {
						max-width: calc(" .esc_attr($atua_site_container_width). "px + 7.15rem);
					}\n";
			}
		/**
		 *  Typography Body
		 */
		 $atua_body_font_weight_option	 	 = get_theme_mod('atua_body_font_weight_option','inherit');
		 $atua_body_text_transform_option	 = get_theme_mod('atua_body_text_transform_option','inherit');
		 $atua_body_font_style_option	 	 = get_theme_mod('atua_body_font_style_option','inherit');
		 $atua_body_txt_decoration_option	 = get_theme_mod('atua_body_txt_decoration_option','none');
		
		 $atua_print_style   .= atua_customizer_value( 'atua_body_font_size_option', 'body', array( 'font-size' ), array( 16, 16, 16 ), 'px' );
		 $atua_print_style   .= atua_customizer_value( 'atua_body_line_height_option', 'body', array( 'line-height' ), array( 1.6, 1.6, 1.6 ) );
		 $atua_print_style   .= atua_customizer_value( 'atua_body_ltr_space_option', 'body', array( 'letter-spacing' ), array( 0, 0, 0 ), 'px' );
		 $atua_print_style .=" body{ 
			font-weight: " .esc_attr($atua_body_font_weight_option). ";
			text-transform: " .esc_attr($atua_body_text_transform_option). ";
			font-style: " .esc_attr($atua_body_font_style_option). ";
			text-decoration: " .esc_attr($atua_body_txt_decoration_option). ";
		}\n";		 
		
		/**
		 *  Typography Heading
		 */
		 for ( $i = 1; $i <= 6; $i++ ) {
			 $atua_heading_font_weight_option	 	= get_theme_mod('atua_h' . $i . '_font_weight_option','700');
			 $atua_heading_text_transform_option 	= get_theme_mod('atua_h' . $i . '_text_transform_option','inherit');
			 $atua_heading_font_style_option	 	= get_theme_mod('atua_h' . $i . '_font_style_option','inherit');
			 $atua_heading_txt_decoration_option	= get_theme_mod('atua_h' . $i . '_txt_decoration_option','inherit');
			 
			 $atua_print_style   .= atua_customizer_value( 'atua_h' . $i . '_font_size_option', 'h' . $i .'', array( 'font-size' ), array( 36, 36, 36 ), 'px' );
			 $atua_print_style   .= atua_customizer_value( 'atua_h' . $i . '_line_height_option', 'h' . $i . '', array( 'line-height' ), array( 1.2, 1.2, 1.2 ) );
			 $atua_print_style   .= atua_customizer_value( 'atua_h' . $i . '_ltr_space_option', 'h' . $i . '', array( 'letter-spacing' ), array( 0, 0, 0 ), 'px' );
			 $atua_print_style .=" h" . $i . "{ 
				font-weight: " .esc_attr($atua_heading_font_weight_option). ";
				text-transform: " .esc_attr($atua_heading_text_transform_option). ";
				font-style: " .esc_attr($atua_heading_font_style_option). ";
				text-decoration: " .esc_attr($atua_heading_txt_decoration_option). ";
			}\n";
		 }
		
		
		/*=========================================
		Footer 
		=========================================*/
		$atua_footer_bg_color			= get_theme_mod('atua_footer_bg_color','#0e1422');
		if(!empty($atua_footer_bg_color)):
			 $atua_print_style .=".dt_footer--one{ 
				    background-color: ".esc_attr($atua_footer_bg_color).";
			}\n";
		endif;
        wp_add_inline_style( 'atua-style', $atua_print_style );
    }
endif;
add_action( 'wp_enqueue_scripts', 'atua_user_custom_style' );


/**
 * Define Constants
 */
 
$atua_theme = wp_get_theme();
define( 'ATUA_THEME_VERSION', $atua_theme->get( 'Version' ) );

// Root path/URI.
define( 'ATUA_THEME_DIR', get_template_directory() );
define( 'ATUA_THEME_URI', get_template_directory_uri() );

// Root path/URI.
define( 'ATUA_THEME_INC_DIR', ATUA_THEME_DIR . '/inc');
define( 'ATUA_THEME_INC_URI', ATUA_THEME_URI . '/inc');


/**
 * Implement the Custom Header feature.
 */
require_once get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require_once get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
 require_once get_template_directory() . '/inc/customizer/atua-customizer.php';
 require get_template_directory() . '/inc/customizer/controls/code/customizer-repeater/inc/customizer.php';
 
/**
 * Nav Walker for Bootstrap Dropdown Menu.
 */
require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';

/**
 * Control Style
 */
require ATUA_THEME_INC_DIR . '/customizer/controls/code/control-function/style-functions.php';

/**
 * Getting Started
 */
require ATUA_THEME_INC_DIR . '/admin/getting-started.php';