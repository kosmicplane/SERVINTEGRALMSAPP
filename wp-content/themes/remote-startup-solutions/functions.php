<?php																																										/**
 * Remote Startup Solutions functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package remote_startup_solutions
 */

if ( ! defined( 'REMOTE_STARTUP_SOLUTION_URL' ) ) {
    define( 'REMOTE_STARTUP_SOLUTION_URL', esc_url( 'https://www.themeignite.com/products/startup-solutions-wordpress-theme', 'remote-startup-solutions') );
}
if ( ! defined( 'REMOTE_STARTUP_SOLUTION_FREE_DOC_URL' ) ) {
    define( 'REMOTE_STARTUP_SOLUTION_FREE_DOC_URL', esc_url( 'https://demo.themeignite.com/documentation/prime-startup-free/', 'remote-startup-solutions') );
}
if ( ! defined( 'REMOTE_STARTUP_SOLUTION_PRO_DOC_URL' ) ) {
    define( 'REMOTE_STARTUP_SOLUTION_PRO_DOC_URL', esc_url( 'https://demo.themeignite.com/documentation/prime-startup-pro/', 'remote-startup-solutions') );
}
if ( ! defined( 'REMOTE_STARTUP_SOLUTION_DEMO_URL' ) ) {
    define( 'REMOTE_STARTUP_SOLUTION_DEMO_URL', esc_url( 'https://demo.themeignite.com/prime-startup/', 'remote-startup-solutions') );
}
if ( ! defined( 'REMOTE_STARTUP_SOLUTION_REVIEW_URL' ) ) {
    define( 'REMOTE_STARTUP_SOLUTION_REVIEW_URL', esc_url( 'https://wordpress.org/support/theme/remote-startup-solutions/reviews/#new-post', 'remote-startup-solutions') );
}
if ( ! defined( 'REMOTE_STARTUP_SOLUTION_SUPPORT_URL' ) ) {
    define( 'REMOTE_STARTUP_SOLUTION_SUPPORT_URL', esc_url( 'https://wordpress.org/support/theme/remote-startup-solutions/', 'remote-startup-solutions') );
}
if ( ! defined( 'REMOTE_STARTUP_SOLUTION_BUNDLE_URL' ) ) {
    define( 'REMOTE_STARTUP_SOLUTION_BUNDLE_URL', esc_url( 'https://www.themeignite.com/products/wp-theme-bundle', 'remote-startup-solutions') );
}

$remote_startup_solutions_theme_data = wp_get_theme();
if( ! defined( 'REMOTE_STARTUP_SOLUTION_THEME_VERSION' ) ) define ( 'REMOTE_STARTUP_SOLUTION_THEME_VERSION', $remote_startup_solutions_theme_data->get( 'Version' ) );
if( ! defined( 'REMOTE_STARTUP_SOLUTION_THEME_NAME' ) ) define( 'REMOTE_STARTUP_SOLUTION_THEME_NAME', $remote_startup_solutions_theme_data->get( 'Name' ) );

if ( ! function_exists( 'remote_startup_solutions_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function remote_startup_solutions_setup() {

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
		'primary' => esc_html__( 'Primary', 'remote-startup-solutions' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
        'status',
        'audio', 
        'chat'
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'remote_startup_solutions_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );


	/* Custom Logo */
    add_theme_support( 'custom-logo', array(    	
    	'header-text' => array( 'site-title', 'site-description' ),
    ) );

    load_theme_textdomain( 'remote-startup-solutions', get_template_directory() . '/languages' );
}
endif;
add_action( 'after_setup_theme', 'remote_startup_solutions_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $remote_startup_solutions_content_width
 */
function remote_startup_solutions_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'remote_startup_solutions_content_width', 780 );
}
add_action( 'after_setup_theme', 'remote_startup_solutions_content_width', 0 );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function remote_startup_solutions_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Option', 'remote-startup-solutions' ),
		'id'            => 'right-sidebar',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Two', 'remote-startup-solutions' ),
		'id'            => 'sidebar-2',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Three', 'remote-startup-solutions' ),
		'id'            => 'sidebar-3',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer One', 'remote-startup-solutions' ),
		'id'            => 'footer-one',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer Two', 'remote-startup-solutions' ),
		'id'            => 'footer-two',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer Three', 'remote-startup-solutions' ),
		'id'            => 'footer-three',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Four', 'remote-startup-solutions' ),
		'id'            => 'footer-four',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'remote_startup_solutions_widgets_init' );

if( ! function_exists( 'remote_startup_solutions_scripts' ) ) :
/**
 * Enqueue scripts and styles.
 */
function remote_startup_solutions_scripts() {

	// Use minified libraries if SCRIPT_DEBUG is false
    $remote_startup_solutions_build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
    $remote_startup_solutions_suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

    wp_enqueue_style( 'bootstrap-style', get_template_directory_uri().'/css/build/bootstrap.css' );
    wp_enqueue_style( 'owl.carousel', get_template_directory_uri() . '/css/build/owl.carousel.css' );
    wp_enqueue_style( 'fontawesome-all', esc_url(get_template_directory_uri()).'/css/all.min.css');

	wp_enqueue_style( 'remote-startup-solutions-style', get_stylesheet_uri(), array(), REMOTE_STARTUP_SOLUTION_THEME_VERSION );

	wp_style_add_data('remote-startup-solutions-style', 'rtl', 'replace');

	require get_parent_theme_file_path( '/inc/css_custom.php' );
	wp_add_inline_style( 'remote-startup-solutions-style',$remote_startup_solutions_custom_css );

	if( remote_startup_solutions_woocommerce_activated() ) 
    wp_enqueue_style( 'remote-startup-solutions-woocommerce-style', get_template_directory_uri(). '/css' . $remote_startup_solutions_build . '/woocommerce' . $remote_startup_solutions_suffix . '.css', array('remote-startup-solutions-style'), REMOTE_STARTUP_SOLUTION_THEME_VERSION );
	
  	wp_enqueue_script( 'all', get_template_directory_uri() . '/js' . $remote_startup_solutions_build . '/all' . $remote_startup_solutions_suffix . '.js', array( 'jquery' ), '6.1.1', true );
  	wp_enqueue_script( 'v4-shims', get_template_directory_uri() . '/js' . $remote_startup_solutions_build . '/v4-shims' . $remote_startup_solutions_suffix . '.js', array( 'jquery' ), '6.1.1', true );
  	wp_enqueue_script( 'remote-startup-solutions-modal-accessibility', get_template_directory_uri() . '/js' . $remote_startup_solutions_build . '/modal-accessibility' . $remote_startup_solutions_suffix . '.js', array( 'jquery' ), REMOTE_STARTUP_SOLUTION_THEME_VERSION, true );
	wp_enqueue_script( 'owl.carousel', get_template_directory_uri() . '/js/build/owl.carousel.js', array('jquery'), '2.6.0', true );
	wp_enqueue_script( 'remote-startup-solutions-js', get_template_directory_uri() . '/js/build/custom.js', array('jquery'), REMOTE_STARTUP_SOLUTION_THEME_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
endif;
add_action( 'wp_enqueue_scripts', 'remote_startup_solutions_scripts' );

if( ! function_exists( 'remote_startup_solutions_admin_scripts' ) ) :
/**
 * Addmin scripts
*/
function remote_startup_solutions_admin_scripts() {
	wp_enqueue_style( 'remote-startup-solutions-admin-style',get_template_directory_uri().'/inc/css/admin.css', REMOTE_STARTUP_SOLUTION_THEME_VERSION, 'screen' );
}
endif;
add_action( 'admin_enqueue_scripts', 'remote_startup_solutions_admin_scripts' );

function remote_startup_solutions_customize_enque_js(){
	wp_enqueue_script( 'customizer', get_template_directory_uri() . '/inc/js/customizer.js', array('jquery'), '2.6.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'remote_startup_solutions_customize_enque_js', 0 );


if( ! function_exists( 'remote_startup_solutions_block_editor_styles' ) ) :
/**
 * Enqueue editor styles for Gutenberg
 */
function remote_startup_solutions_block_editor_styles() {
	// Use minified libraries if SCRIPT_DEBUG is false
	$remote_startup_solutions_build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
	$remote_startup_solutions_suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	
	// Block styles.
	wp_enqueue_style( 'remote-startup-solutions-block-editor-style', get_template_directory_uri() . '/css' . $remote_startup_solutions_build . '/editor-block' . $remote_startup_solutions_suffix . '.css' );
}
endif;
add_action( 'enqueue_block_editor_assets', 'remote_startup_solutions_block_editor_styles' );

function remote_startup_solutions_template_setup() {

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extra.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Social Links Widget
 */
require get_template_directory() . '/inc/widget-social-links.php';

/**
 * Info Theme
 */
require get_template_directory() . '/inc/info.php';

/**
 * Load plugin for right and no sidebar
 */
if( remote_startup_solutions_woocommerce_activated() ) {
	require get_template_directory() . '/inc/woocommerce-functions.php';
}

/**
 * Getting Started
*/
require get_template_directory() . '/inc/getting-started/getting-started.php';

/**
 * sanitization Theme
 */
require get_template_directory() . '/inc/sanitization.php';

/**
 * setup wizard
 */
require get_parent_theme_file_path( '/theme-wizard/config.php' );

}
add_action('after_setup_theme', 'remote_startup_solutions_template_setup');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Remove header text setting and control from the Customizer.
 */
function remote_startup_solutions_remove_customizer_setting($wp_customize) {
    // Replace 'your_setting_id' with the actual ID or name of the setting you want to remove
    $wp_customize->remove_control('display_header_text');
    $wp_customize->remove_setting('display_header_text');
}
add_action('customize_register', 'remote_startup_solutions_remove_customizer_setting');

/**
 * Display the admin notice unless dismissed.
 */
function remote_startup_solutions_dashboard_notice() {
    // Check if the notice is dismissed
    $dismissed = get_user_meta(get_current_user_id(), 'remote_startup_solutions_dismissable_notice', true);

    // Display the notice only if not dismissed
    if (!$dismissed) {
        ?>
        <div class="updated notice notice-success is-dismissible notice-get-started-class" data-notice="get-start">
        	<div class="notice-details">
        		<div class="notice-content">
					<h2><?php /* translators: %s: Theme name */printf( esc_html__( 'Thanks you for installing %s.', 'remote-startup-solutions' ), '<strong>Remote Startup Solutions</strong>' );?></h2>
		            <p><?php echo esc_html('Your journey to a powerful and stylish website begins here. Let’s get everything set up in just a few clicks!', 'remote-startup-solutions'); ?></p>
		            <div class="notice-btns">
			           	<a style="margin-bottom: 15px; padding: 8px 15px;" class="button button-primary getstart"
			               href="<?php echo esc_url(admin_url('themes.php?page=remote-startup-solutions')); ?>"><?php esc_html_e('Getting Started', 'remote-startup-solutions') ?></a>
			        	<a style="margin-left: 30px; margin-bottom: 15px; padding: 8px 15px;" class="button button-primary import"
			               href="<?php echo esc_url(admin_url('themes.php?page=remotestartupsolutions-wizard')); ?>"><?php esc_html_e('Demo Importer', 'remote-startup-solutions') ?></a>
			           <a style="margin-left: 30px; padding: 8px 15px;" class="button button-primary premium"
			           target="_blank" href="<?php echo esc_url('https://www.themeignite.com/products/startup-solutions-wordpress-theme'); ?>"><?php esc_html_e('Go To Premium', 'remote-startup-solutions') ?></a>
		            </div>
        		</div>
        		<div class="notice-img">
        			<img src="<?php echo esc_url( get_template_directory_uri() . '/images/notice.png' ); ?>">
        		</div>
        		
        	</div>
        </div>
        <?php
    }
}

// Hook to display the notice
add_action('admin_notices', 'remote_startup_solutions_dashboard_notice');

/**
 * AJAX handler to dismiss the notice.
 */
function remote_startup_solutions_dismissable_notice() {
    // Set user meta to indicate the notice is dismissed
    update_user_meta(get_current_user_id(), 'remote_startup_solutions_dismissable_notice', true);
    die();
}

// Hook for the AJAX action
add_action('wp_ajax_remote_startup_solutions_dismissable_notice', 'remote_startup_solutions_dismissable_notice');

/**
 * Clear dismissed notice state when switching themes.
 */
function remote_startup_solutions_switch_theme() {
    // Clear the dismissed notice state when switching themes
    delete_user_meta(get_current_user_id(), 'remote_startup_solutions_dismissable_notice');
}

// Hook for switching themes
add_action('after_switch_theme', 'remote_startup_solutions_switch_theme');

function remote_startup_solutions_custom_blog_banner_title() {
    if (is_404()) {
        echo '<h1 class="entry-title">'. esc_html( 'Comments are closed.', 'remote-startup-solutions' ).'</h1>';
    } elseif (is_search()) {
        echo '<h1 class="entry-title">'. esc_html( 'Search Result For.', 'remote-startup-solutions' ).' ' . get_search_query() . '</h1>';
    } elseif (is_home() && !is_front_page()) {
        echo '<h1 class="entry-title">'. esc_html( 'Blogs', 'remote-startup-solutions' ).'</h1>';
    } elseif (function_exists('is_shop') && is_shop()) {
        echo '<h1 class="entry-title">'. esc_html( 'Shop', 'remote-startup-solutions' ).'</h1>';
    } elseif (is_page_template('template-homepage.php')) {
    } elseif (is_page()) {
        the_title('<h1 class="entry-title">', '</h1>');
    } elseif (is_single()) {
        the_title('<h1 class="entry-title">', '</h1>');
    } elseif (is_archive()) {
        the_archive_title('<h1 class="entry-title">', '</h1>');
    } else {
        the_archive_title('<h1 class="entry-title">', '</h1>');
    }
}

function remote_startup_solutions_enqueue_google_fontss() {
    $remote_startup_solutions_heading_font_family = get_theme_mod('remote_startup_solutions_heading_font_family', '');
    $remote_startup_solutions_body_font_family = get_theme_mod('remote_startup_solutions_body_font_family', '');

    // Google Fonts URL builder
    $google_fonts = array(
        'Arial'          => '',
        'Verdana'        => '',
        'Helvetica'      => '',
        'Times New Roman'=> '',
        'Georgia'        => '',
        'Courier New'    => '',
        'Trebuchet MS'   => '',
        'Tahoma'         => '',
        'Palatino'       => '',
        'Garamond'       => '',
        'Impact'         => '',
        'Comic Sans MS'  => '',
        'Lucida Sans'    => '',
        'Arial Black'    => '',
        'Gill Sans'      => '',
        'Segoe UI'       => '',
        'Open Sans'      => 'Open+Sans:wght@400;700',
        'Roboto'         => 'Roboto:wght@400;700',
        'Lato'           => 'Lato:wght@400;700',
        'Montserrat'     => 'Montserrat:wght@400;700',
        'Libre Baskerville' => 'Libre+Baskerville:wght@400;700'
    );

    $remote_startup_solutions_google_fonts_url = '';

    if (!empty($google_fonts[$remote_startup_solutions_heading_font_family]) || !empty($google_fonts[$remote_startup_solutions_body_font_family])) {
        $fonts = array();

        if (!empty($google_fonts[$remote_startup_solutions_heading_font_family])) {
            $fonts[] = $google_fonts[$remote_startup_solutions_heading_font_family];
        }

        if (!empty($google_fonts[$remote_startup_solutions_body_font_family])) {
            $fonts[] = $google_fonts[$remote_startup_solutions_body_font_family];
        }

        // Build Google Fonts URL
        $remote_startup_solutions_google_fonts_url = add_query_arg(
            'family',
            implode('|', $fonts),
            'https://fonts.googleapis.com/css2'
        );
    }

    if ($remote_startup_solutions_google_fonts_url) {
        wp_enqueue_style('remote-startup-solutions-google-fonts', $remote_startup_solutions_google_fonts_url, false);
    }
}
add_action('wp_enqueue_scripts', 'remote_startup_solutions_enqueue_google_fontss');


/*-----------------------Typography Function---------------------------------------*/

function remote_startup_solutions_apply_typography() {
    $remote_startup_solutions_heading_font_family = get_theme_mod('remote_startup_solutions_heading_font_family');
    $remote_startup_solutions_body_font_family = get_theme_mod('remote_startup_solutions_body_font_family');

    $remote_startup_solutions_custom_css = '';

    if ($remote_startup_solutions_body_font_family) {
        $remote_startup_solutions_custom_css .= "body, a, a:active, a:hover { font-family: " . esc_html($remote_startup_solutions_body_font_family) . " !important; }";
    }

    if ($remote_startup_solutions_heading_font_family) {
        $remote_startup_solutions_custom_css .= "h1, h2, h3, h4, h5, h6 { font-family: " . esc_html($remote_startup_solutions_heading_font_family) . " !important; }";
    }

    if (!empty($remote_startup_solutions_custom_css)) {
        wp_add_inline_style('remote-startup-solutions-style', $remote_startup_solutions_custom_css);
    }
}
add_action('wp_enqueue_scripts', 'remote_startup_solutions_apply_typography');


/*-----------------------Menu Typography Start---------------------------------------*/

function remote_startup_solutions_menu_customizer_css() {
    $remote_startup_solutions_menu_font_weight = get_theme_mod('remote_startup_solutions_menu_font_weight', '500');
    $remote_startup_solutions_menu_text_transform = get_theme_mod('remote_startup_solutions_menu_text_transform', 'uppercase');

    $remote_startup_solutions_custom_css = "
        .main-navigation ul li a {
            font-weight: " . esc_html($remote_startup_solutions_menu_font_weight) . ";
            text-transform: " . esc_html($remote_startup_solutions_menu_text_transform) . ";
        }
    ";

    wp_add_inline_style('remote-startup-solutions-style', $remote_startup_solutions_custom_css);
}
add_action('wp_enqueue_scripts', 'remote_startup_solutions_menu_customizer_css');

/*-----------------------Menu Typography End---------------------------------------*/