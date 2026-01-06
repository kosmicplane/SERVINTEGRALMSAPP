<?php define( 'AGENCYUP_THEME_DIR', get_template_directory() . '/' );
	define( 'AGENCYUP_THEME_URI', get_template_directory_uri() . '/' );
	define( 'AGENCYUP_THEME_SETTINGS', 'agencyup-settings' );
	
	
	$agencyup_theme_path = get_template_directory() . '/inc/ansar/';

	require( $agencyup_theme_path . '/agencyup-custom-navwalker.php' );
	require( $agencyup_theme_path . '/default_menu_walker.php' );
	require( $agencyup_theme_path . '/font/font.php');
	require( $agencyup_theme_path . '/customize/agencyup_plugin_recommend.php');
	/*-----------------------------------------------------------------------------------*/
	/*	Enqueue scripts and styles.
	/*-----------------------------------------------------------------------------------*/
	require( $agencyup_theme_path .'/enqueue.php');
	/* ----------------------------------------------------------------------------------- */
	/* Customizer */
	/* ----------------------------------------------------------------------------------- */
	
	require( $agencyup_theme_path  . '/customize/agencyup_customize_general.php');
	require( $agencyup_theme_path . '/customize/agencyup_customize_copyright.php');
	require( $agencyup_theme_path  . '/customize/agencyup_customize_header.php');
	require( $agencyup_theme_path  . '/customize/agencyup_customize_archive.php'); 
	require( $agencyup_theme_path . '/customize/class-alpha-color-control/class-alpha-color-control.php');
	require_once( trailingslashit( get_template_directory() ) . 'inc/ansar/customize-pro/class-customize.php' );
	require_once( trailingslashit( get_template_directory() ) . 'inc/ansar/customize/agencyup_customize_partials.php' );
	require_once get_template_directory() . '/inc/ansar/agencyup-admin-plugin-install.php';


	$agencyup_theme_start = wp_get_theme();
	if (( 'Agencyup' == $agencyup_theme_start->name) || ( 'Busiage' == $agencyup_theme_start->name) || ( 'Financey' == $agencyup_theme_start->name) 
		|| ( 'Reckon' == $agencyup_theme_start->name) || ( 'Agencyup Dark' == $agencyup_theme_start->name) )  {
	if ( is_admin() ) {
		require ($agencyup_theme_path . '/admin/getting-started.php');
	}
	}


	// Theme version.
	$agencyup_theme = wp_get_theme();
	define( 'AGENCYUP_THEME_VERSION', $agencyup_theme->get( 'Version' ) );
	define( 'AGENCYUP_THEME_NAME', $agencyup_theme->get( 'Name' ) );
	
if ( ! function_exists( 'agencyup_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function agencyup_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on agencyup, use a find and replace
	 * to change 'agencyup' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'agencyup', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary menu', 'agencyup' ),
	) );

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

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'agencyup_custom_background_args', array(
		'default-color' => 'eff2f7',
		'default-image' => '',
	) ) );

    // Set up the woocommerce feature.
    add_theme_support( 'woocommerce');

    // Woocommerce Gallery Support
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

    // Added theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/* Add theme support for gutenberg block */
	add_theme_support( 'align-wide' );

	// Add support for responsive embedded content.
	add_theme_support( 'responsive-embeds' );
	
	//Custom logo
	
	//Custom logo
	add_theme_support(
    'custom-logo',
    array(
        'unlink-homepage-logo' => true, // Add Here!
    	)
	);
	
	// custom header Support
			$args = array(
			'default-image'		=>  get_template_directory_uri() .'/images/sub-header.jpg',
			'width'			=> '1600',
			'height'		=> '600',
			'flex-height'		=> false,
			'flex-width'		=> false,
			'header-text'		=> true,
			'default-text-color'	=> '#143745',
			 'wp-head-callback' => 'agencyup_header_color',
		);
		add_theme_support( 'custom-header', $args );
	

}
endif;
add_action( 'after_setup_theme', 'agencyup_setup' );


	function agencyup_the_custom_logo() {
	
		if ( function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
		}

	}

	add_filter('get_custom_logo','agencyup_logo_class');


	function agencyup_logo_class($html)
	{
	$html = str_replace('custom-logo-link', 'navbar-brand', $html);
	return $html;
	}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function agencyup_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'agencyup_content_width', 640 );
}
add_action( 'after_setup_theme', 'agencyup_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function agencyup_widgets_init() {
	
	$agencyup_footer_column_layout = get_theme_mod('agencyup_footer_column_layout',3);
	
	$agencyup_footer_column_layout = 12 / $agencyup_footer_column_layout;
	
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Widget Area', 'agencyup' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="bs-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6>',
		'after_title'   => '</h6>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area', 'agencyup' ),
		'id'            => 'footer_widget_area',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="col-md-'.$agencyup_footer_column_layout.' rotateInDownLeft animated bs-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6>',
		'after_title'   => '</h6>',
	) );

}
add_action( 'widgets_init', 'agencyup_widgets_init' );

//Editor Styling 
add_editor_style( array( 'css/editor-style.css') );

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Fire the wp_body_open action.
	 *
	 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
	 *
	 * @since Twenty Nineteen 1.4
	 */
	function wp_body_open() {
		/**
		 * Triggered after the opening <body> tag.
		 *
		 * @since Twenty Nineteen 1.4
		 */
		do_action( 'wp_body_open' );
	}
endif;

add_filter( 'woocommerce_show_page_title', 'agencyup_hide_shop_page_title' );

function agencyup_hide_shop_page_title( $title ) {
    if ( is_shop() ) $title = false;
    return $title;
}

if (!function_exists('agencyup_edit_link')) :

    function agencyup_edit_link($view = 'default')
    {
        global $post;
		edit_post_link(
			sprintf(
				wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
					__('Edit <span class="screen-reader-text">%s</span>', 'agencyup'),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link"><i class="fas fa-edit"></i>',
			'</span>'
		);

    } 
endif;