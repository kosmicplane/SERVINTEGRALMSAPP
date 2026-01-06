<?php
/**
 * indofinance functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package indofinance
 */

if ( ! defined( 'indofinance_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'indofinance_VERSION', '1.0.0.2' );
}

if ( ! defined( 'indofinance_URL' ) ) {
	define( 'indofinance_URL', trailingslashit( get_template_directory_uri() ) );
}

if ( ! defined( 'indofinance_PATH' ) ) {
	define( 'indofinance_PATH', trailingslashit( get_template_directory() ) );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function indofinance_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on indofinance, use a find and replace
		* to change 'indofinance' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'indofinance', get_template_directory() . '/languages' );

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
	// block width support
	add_theme_support( 'align-wide' );
	add_theme_support( 'align-full' );

		// This theme uses wp_nav_menu() in multiple locations.
	register_nav_menus(
		array(
			'menu-1'     => esc_html__( 'Primary', 'indofinance' ),
			'menu-top'   => esc_html__( 'Top', 'indofinance' ),
			'menu-mobile'=> esc_html__( 'Mobile Menu', 'indofinance' ),
		)
	);


	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'indofinance_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 120,
			'width'       => 300,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'indofinance_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function indofinance_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'indofinance_content_width', 640 );
}
add_action( 'after_setup_theme', 'indofinance_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function indofinance_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar - Right', 'indofinance' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'indofinance' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widgettitle">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar - Left', 'indofinance' ),
			'id'            => 'sidebar-2',
			'description'   => esc_html__( 'Add widgets here.', 'indofinance' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widgettitle">',
			'after_title'   => '</h2>',
		)
	);
	
	register_sidebar(
		array(
			'name'          => esc_html__( 'Widget Area - Header', 'indofinance' ),
			'id'            => 'header-widget',
			'description'   => esc_html__( 'Widget to add blocks in Header - Widget layout. Add widgets here.', 'indofinance' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widgettitle">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Widgets Area 1', 'indofinance' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add widgets here.', 'indofinance' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<div class="widgettitle">',
			'after_title'   => '</div>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Widgets Area 2', 'indofinance' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Add widgets here.', 'indofinance' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<div class="widgettitle">',
			'after_title'   => '</div>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Widgets Area 3 ', 'indofinance' ),
			'id'            => 'footer-3',
			'description'   => esc_html__( 'Add widgets here.', 'indofinance' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<div class="widgettitle">',
			'after_title'   => '</div>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Widgets Area 4 ', 'indofinance' ),
			'id'            => 'footer-4',
			'description'   => esc_html__( 'Add widgets here.', 'indofinance' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<div class="widgettitle">',
			'after_title'   => '</div>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Before Footer ', 'indofinance' ),
			'id'            => 'ad-before-footer',
			'description'   => esc_html__( 'Add widgets here.', 'indofinance' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<div class="widgettitle">',
			'after_title'   => '</div>',
		)
	);	

	register_sidebar(
		array(
			'name'          => esc_html__( 'Before Main Content ', 'indofinance' ),
			'id'            => 'ad-before-main-content',
			'description'   => esc_html__( 'Add widgets here.', 'indofinance' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<div class="widgettitle">',
			'after_title'   => '</div>',
		)
	);	

	register_sidebar(
		array(
			'name'          => esc_html__( 'After Header Content ', 'indofinance' ),
			'id'            => 'ad-after-header-content',
			'description'   => esc_html__( 'Add widgets here.', 'indofinance' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<div class="widgettitle">',
			'after_title'   => '</div>',
		)
	);	

	register_sidebar(
		array(
			'name'          => esc_html__( 'Widget Before Content Left ', 'indofinance' ),
			'id'            => 'ad-before-content-left',
			'description'   => esc_html__( 'Add widgets here.', 'indofinance' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<div class="widgettitle">',
			'after_title'   => '</div>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Widget Before Content Center ', 'indofinance' ),
			'id'            => 'ad-before-content-center',
			'description'   => esc_html__( 'Add widgets here.', 'indofinance' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<div class="widgettitle">',
			'after_title'   => '</div>',
		)
	);	

	register_sidebar(
		array(
			'name'          => esc_html__( 'Widget Before Content Right ', 'indofinance' ),
			'id'            => 'ad-before-content-right',
			'description'   => esc_html__( 'Add widgets here.', 'indofinance' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<div class="widgettitle">',
			'after_title'   => '</div>',
		)
	);	

	register_sidebar(
		array(
			'name'          => esc_html__( 'Header Ad Banner', 'indofinance' ),
			'id'            => 'header-ad-banner',
			'description'   => esc_html__( 'Add widgets here.', 'indofinance' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<div class="widgettitle">',
			'after_title'   => '</div>',
		)
	);
	

}
add_action( 'widgets_init', 'indofinance_widgets_init' );
/**
 * Enqueue scripts and styles.
 */
function indofinance_scripts() {
    wp_enqueue_style( 'indofinance-style', get_stylesheet_uri(), array(), indofinance_VERSION );
    wp_style_add_data( 'indofinance-style', 'rtl', 'replace' );

    wp_enqueue_script( 'indofinance-navigation', indofinance_URL . 'js/navigation.js', array(), indofinance_VERSION, [ 'strategy' => 'defer' ] );
    wp_enqueue_script( 'indofinance-main-js', indofinance_URL . 'js/main.js', array(), indofinance_VERSION, [ 'strategy' => 'defer' ] );
    wp_enqueue_script( 'indofinance-slider-js', indofinance_URL . 'js/swiper.js', array(), indofinance_VERSION, [ 'strategy' => 'defer' ] );
    wp_enqueue_script( 'indofinance-swiper-js', indofinance_URL . 'theme-styles/js/swiper-bundle.min.js', array(), indofinance_VERSION, true );
    wp_enqueue_style( 'indofinance-swiper-css', indofinance_URL . 'theme-styles/css/swiper-bundle.min.css', array(), indofinance_VERSION );

    wp_enqueue_style( 'indofinance-fonts', 'https://fonts.googleapis.com/css2?family=Cabin:ital,wght@0,400..700;1,400..700&family=Nunito:wght@400&family=Poppins:wght@400&family=Red+Rose:wght@400&family=Rubik:wght@400&display=swap', array(), null );

    wp_enqueue_style( 'indofinance-main-css', indofinance_URL . 'theme-styles/css/main.css', array( 'wp-block-library' ), indofinance_VERSION );

    // Localize the main JS file with icon URLs
    wp_localize_script( 'indofinance-main-js', 'indofinanceIcons', array(
        'moon' => indofinance_URL . 'images/moon-icon.png',
        'sun'  => indofinance_URL . 'images/sun-icon.png',
    ) );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'indofinance_scripts' );


function indofinance_excerpt_length($length) {
    if (!is_admin()) {
        // Get the custom excerpt length from the customizer
        $custom_excerpt_length = get_theme_mod('phcreativeblogpro-excerpt_length', 20); // Default length is 30

        // Use the custom excerpt length if available, else use the default
        return (int) $custom_excerpt_length;
    }

    return $length;
}
add_filter('excerpt_length', 'indofinance_excerpt_length', 999);

function phcreativeblogpro_excerpt_more( $more ) {
	if (!is_admin() ) {
		return '....'; 
	} 
	return $more;

}


if ( !function_exists('indofinance_admin_scripts') ) {
	function indofinance_admin_scripts() {
		$screen = get_current_screen();
		if ( $screen->id === 'appearance_page_indofinance_options' ) {
			wp_enqueue_script('indofinance-theme-page-js', indofinance_URL . 'js/theme-page.js', array('jquery', 'jquery-ui-tabs'), indofinance_VERSION, true );
		}
	}
}
add_action('admin_enqueue_scripts', 'indofinance_admin_scripts');

/**
 * Enqueue scripts and styles for the Customizer
 */
if ( !function_exists('indofinance_customize_controls_enqueue_scripts') ) {
    function indofinance_customize_controls_enqueue_scripts() {
        wp_enqueue_script('indofinance-customize-controls-js', esc_url( indofinance_URL . 'js/customize_controls.js' ), array('jquery'), indofinance_VERSION, true );
    }
	add_action('customize_controls_enqueue_scripts', 'indofinance_customize_controls_enqueue_scripts');
}

/**
 * Implement the Custom Header feature.
 */
require indofinance_PATH . 'inc/custom-header.php';

/**
 * Add Page Options metabox
 */
require indofinance_PATH . 'inc/metabox/page-options.php';

/**
 * Custom template tags for this theme.
 */
require indofinance_PATH . 'inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require indofinance_PATH . 'inc/template-functions.php';

/**
 * Include the Walker Class
 */
require indofinance_PATH . 'inc/walker.php';

/**
 * Include the PHP dependent Custom CSS styles
 */
require indofinance_PATH . 'inc/custom-css.php';

/**
 * Customizer additions.
 */
require indofinance_PATH . 'inc/customizer/customizer.php';

/**
 * Customizer additions.
 */
require indofinance_PATH . 'inc/customizer/theme-layout.php';

/**
 * Customizer additions.
 */
require indofinance_PATH . 'inc/customizer/panel-theme-options.php';

/**
 * Customizer additions.
 */
require indofinance_PATH . 'inc/customizer/popular-post-widget.php';

/**
 * Customizer additions.
 */
require indofinance_PATH . '/tgmpa/tgmpa-configuration.php';



/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require indofinance_PATH . 'inc/jetpack.php';
}
		
	function indofinance_sticky_sidebar_styles() {
		// Retrieve the value of the 'indofinance-sticky-sidebar_set' setting from the Customizer
		$sticky_sidebar_enabled = get_theme_mod('indofinance-sticky-sidebar_set');

		// Check if the sticky sidebar setting is enabled
if ($sticky_sidebar_enabled) {
    $styles = '';

    // Generate CSS styles for sticky sidebar with a media query
    $styles .= "@media (min-width: 968px) {";
    $styles .= "    .theme-sidebar {";
    $styles .= "        position: sticky;";
    $styles .= "        top: 0;";
    $styles .= "        height: fit-content;";
    $styles .= "    }";
    $styles .= "}";

    // Add inline styles only if the setting is enabled
    if (!empty($styles)) {
        wp_add_inline_style('indofinance-main-css', $styles);
    } 
          }

	}

	// Hook the function into the wp_enqueue_scripts action to add inline styles
	add_action('wp_enqueue_scripts', 'indofinance_sticky_sidebar_styles');
	
	
	
	function indofinance_custom_header_styles() {
		if (get_header_image()) {
			$custom_css = "
				.site-header {
					background-image: url('" . esc_url(get_header_image()) . "');
					background-size: cover;
					background-position: center;
					background-repeat: no-repeat;
					position: relative;
					z-index: 2;
				}
				
				.site-header::before {
					content: '';
					position: absolute;
					top: 0;
					left: 0;
					width: 100%;
					height: 100%;
					background: linear-gradient(to bottom, rgba(var(--primary-color), 0.7), rgba(var(--secondary-color), 0.7));
					z-index: 2;
					pointer-events: none;
				}";
	
			wp_add_inline_style('indofinance-style', $custom_css);
		}
	}
	add_action('wp_enqueue_scripts', 'indofinance_custom_header_styles');


	function indofinance_enqueue_dashicons_for_theme() {
		wp_enqueue_style('dashicons');
	}
	add_action('wp_enqueue_scripts', 'indofinance_enqueue_dashicons_for_theme');
	

	function indofinance_ocdi_register_plugins( $plugins ) {
		$theme_plugins = [
		  [ // A WordPress.org plugin repository example.
			'name'     => 'One Click Demo Import', // Name of the plugin.
			'slug'     => 'one-click-demo-import', // Plugin slug - the same as on WordPress.org plugin repository.
			'required' => false,                     // If the plugin is required or not.
		  ],
	
		];
	   
		return array_merge( $plugins, $theme_plugins );
	  }
	  add_filter( 'ocdi/register_plugins', 'indofinance_ocdi_register_plugins' );

	  function indofinance_ocdi_import_files() {
		return [
			[
				'import_file_name'           => 'IndoFinance',
				'categories'                 => [ 'Finance News' ],
				'import_file_url'            => 'https://theme-demos.pixahive.com/indofinance-demos/indofinance.WordPress.xml',
				'import_widget_file_url'     => 'https://theme-demos.pixahive.com/indofinance-demos/theme-demos.pixahive.com-indo-finance-widgets.wie', // Add widget file URL
				'import_customizer_file_url' => 'https://theme-demos.pixahive.com/indofinance-demos/indofinance-export.dat',
				'import_preview_image_url'   => 'https://theme-demos.pixahive.com/indofinance-demos/screenshot.png',
				'preview_url'                => 'https://theme-demos.pixahive.com/indo-finance/',
			]
		];
	}
	add_filter( 'ocdi/import_files', 'indofinance_ocdi_import_files' );
	
	function indofinance_ocdi_after_import_setup() {
		// Assign menus to their locations.
		$main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
		$top_menu = get_term_by( 'name', 'Top Menu', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
			'primary' => $main_menu->term_id,
			'top-menu' => $top_menu->term_id,
		) );
	
		// Set default post and page settings.
		$front_page_id = get_page_by_title( 'Home' );
		if ( $front_page_id ) {
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $front_page_id->ID );
		}
	
	}	