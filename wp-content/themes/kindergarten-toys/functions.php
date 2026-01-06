<?php
/**
 * Kindergarten Toys functions and definitions
 * @package Kindergarten Toys
 */

if ( ! function_exists( 'kindergarten_toys_after_theme_support' ) ) :

	function kindergarten_toys_after_theme_support() {
		
		add_theme_support( 'automatic-feed-links' );

		add_theme_support('woocommerce');
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');
        add_theme_support('woocommerce', array(
            'gallery_thumbnail_image_width' => 300,
        ));

        load_theme_textdomain( 'kindergarten-toys', get_template_directory() . '/languages' );

		add_theme_support(
			'custom-background',
			array(
				'default-color' => 'ffffff',
			)
		);

		$GLOBALS['content_width'] = apply_filters( 'kindergarten_toys_content_width', 1140 );
		
		add_theme_support( 'post-thumbnails' );

		add_theme_support(
			'custom-logo',
			array(
				'height'      => 270,
				'width'       => 90,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);
		
		add_theme_support( 'title-tag' );

		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
			)
		);

		add_theme_support( 'post-formats', array(
			'video',  
			'audio',  
			'gallery',
			'quote',  
			'image',  
			'link',   
			'status', 
			'aside',  
			'chat',   
		) );	
		
		add_theme_support( 'align-wide' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'wp-block-styles' );
		
		require get_template_directory() . '/inc/metabox.php';
		require get_template_directory() . '/inc/homepage-setup/homepage-setup-settings.php';

		if (! defined( 'KINDERGARTEN_TOYS_DOCS_PRO' ) ){
		define('KINDERGARTEN_TOYS_DOCS_PRO',__('https://layout.omegathemes.com/steps/pro-kindergarten-toys/','kindergarten-toys'));
		}
		if (! defined( 'KINDERGARTEN_TOYS_BUY_NOW' ) ){
		define('KINDERGARTEN_TOYS_BUY_NOW',__('https://www.omegathemes.com/products/kindergarten-playgroup-wordpress-theme','kindergarten-toys'));
		}
		if (! defined( 'KINDERGARTEN_TOYS_SUPPORT_FREE' ) ){
		define('KINDERGARTEN_TOYS_SUPPORT_FREE',__('https://wordpress.org/support/theme/kindergarten-toys/','kindergarten-toys'));
		}
		if (! defined( 'KINDERGARTEN_TOYS_REVIEW_FREE' ) ){
		define('KINDERGARTEN_TOYS_REVIEW_FREE',__('https://wordpress.org/support/theme/kindergarten-toys/reviews/#new-post/','kindergarten-toys'));
		}
		if (! defined( 'KINDERGARTEN_TOYS_DEMO_PRO' ) ){
		define('KINDERGARTEN_TOYS_DEMO_PRO',__('https://layout.omegathemes.com/kindergarten-toys/','kindergarten-toys'));
		}
		if (! defined( 'KINDERGARTEN_TOYS_LITE_DOCS_PRO' ) ){
		define('KINDERGARTEN_TOYS_LITE_DOCS_PRO',__('https://layout.omegathemes.com/steps/free-kindergarten-toys/','kindergarten-toys'));
		}
		if (! defined( 'KINDERGARTEN_TOYS_BUNDLE_BUTTON' ) ){
			define('KINDERGARTEN_TOYS_BUNDLE_BUTTON',__('https://www.omegathemes.com/products/wp-theme-bundle','kindergarten-toys'));
		}

	}

endif;

add_action( 'after_setup_theme', 'kindergarten_toys_after_theme_support' );

/**
 * Register and Enqueue Styles.
 */
function kindergarten_toys_register_styles() {

	wp_enqueue_style( 'dashicons' );

    $kindergarten_toys_theme_version = wp_get_theme()->get( 'Version' );
	$kindergarten_toys_fonts_url = kindergarten_toys_fonts_url();
    if( $kindergarten_toys_fonts_url ){
    	require_once get_theme_file_path( 'lib/custom/css/wptt-webfont-loader.php' );
        wp_enqueue_style(
			'kindergarten-toys-google-fonts',
			wptt_get_webfont_url( $kindergarten_toys_fonts_url ),
			array(),
			$kindergarten_toys_theme_version
		);
    }

    wp_enqueue_style( 'swiper', get_template_directory_uri() . '/lib/swiper/css/swiper-bundle.min.css');
    wp_enqueue_style( 'owl.carousel', get_template_directory_uri() . '/lib/custom/css/owl.carousel.min.css');
	wp_enqueue_style( 'kindergarten-toys-style', get_stylesheet_uri(), array(), $kindergarten_toys_theme_version );

	wp_enqueue_style( 'kindergarten-toys-style', get_stylesheet_uri() );
	require get_parent_theme_file_path( '/custom_css.php' );
	wp_add_inline_style( 'kindergarten-toys-style',$kindergarten_toys_custom_css );

	$kindergarten_toys_css = '';

	if ( get_header_image() ) :

		$kindergarten_toys_css .=  '
			.wrapper.header-wrapper.header-box{
				background-image: url('.esc_url(get_header_image()).');
				-webkit-background-size: cover !important;
				-moz-background-size: cover !important;
				-o-background-size: cover !important;
				background-size: cover !important;
			}';

	endif;

	wp_add_inline_style( 'kindergarten-toys-style', $kindergarten_toys_css );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}	

	wp_enqueue_script( 'imagesloaded' );
    wp_enqueue_script( 'masonry' );
	wp_enqueue_script( 'swiper', get_template_directory_uri() . '/lib/swiper/js/swiper-bundle.min.js', array('jquery'), '', 1);
	wp_enqueue_script( 'kindergarten-toys-custom', get_template_directory_uri() . '/lib/custom/js/theme-custom-script.js', array('jquery'), '', 1);
	wp_enqueue_script( 'owl.carousel', get_template_directory_uri() . '/lib/custom/js/owl.carousel.js', array('jquery'), '', 1);

    // Global Query
    if( is_front_page() ){

    	$kindergarten_toys_posts_per_page = absint( get_option('posts_per_page') );
        $kindergarten_toys_c_paged = ( get_query_var( 'page' ) ) ? absint( get_query_var( 'page' ) ) : 1;
        $kindergarten_toys_posts_args = array(
            'posts_per_page'        => $kindergarten_toys_posts_per_page,
            'paged'                 => $kindergarten_toys_c_paged,
        );
        $kindergarten_toys_posts_qry = new WP_Query( $kindergarten_toys_posts_args );
        $kindergarten_toys_max = $kindergarten_toys_posts_qry->max_num_pages;

    }else{
        global $wp_query;
        $kindergarten_toys_max = $wp_query->max_num_pages;
        $kindergarten_toys_c_paged = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;
    }

    $kindergarten_toys_default = kindergarten_toys_get_default_theme_options();
    $kindergarten_toys_pagination_layout = get_theme_mod( 'kindergarten_toys_pagination_layout',$kindergarten_toys_default['kindergarten_toys_pagination_layout'] );
}

add_action( 'wp_enqueue_scripts', 'kindergarten_toys_register_styles',200 );

function kindergarten_toys_admin_enqueue_scripts_callback() {
    if ( ! did_action( 'wp_enqueue_media' ) ) {
    wp_enqueue_media();
    }
    wp_enqueue_script('kindergarten-toys-uploaderjs', get_stylesheet_directory_uri() . '/lib/custom/js/uploader.js', array(), "1.0", true);
}
add_action( 'admin_enqueue_scripts', 'kindergarten_toys_admin_enqueue_scripts_callback' );

/**
 * Register navigation menus uses wp_nav_menu in five places.
 */
function kindergarten_toys_menus() {

	$kindergarten_toys_locations = array(
		'kindergarten-toys-primary-menu'  => esc_html__( 'Primary Menu', 'kindergarten-toys' ),
	);

	register_nav_menus( $kindergarten_toys_locations );
}

add_action( 'init', 'kindergarten_toys_menus' );

add_filter('loop_shop_columns', 'kindergarten_toys_loop_columns');
if (!function_exists('kindergarten_toys_loop_columns')) {
	function kindergarten_toys_loop_columns() {
		$kindergarten_toys_columns = get_theme_mod( 'kindergarten_toys_per_columns', 3 );
		return $kindergarten_toys_columns;
	}
}

add_filter( 'loop_shop_per_page', 'kindergarten_toys_per_page', 20 );
function kindergarten_toys_per_page( $kindergarten_toys_cols ) {
  	$kindergarten_toys_cols = get_theme_mod( 'kindergarten_toys_product_per_page', 9 );
	return $kindergarten_toys_cols;
}

add_filter( 'woocommerce_output_related_products_args', 'kindergarten_toys_products_args' );

function kindergarten_toys_products_args( $kindergarten_toys_args ) {

    $kindergarten_toys_args['posts_per_page'] = get_theme_mod( 'kindergarten_toys_custom_related_products_number', 6 );

    $kindergarten_toys_args['columns'] = get_theme_mod( 'kindergarten_toys_custom_related_products_number_per_row', 3 );

    return $kindergarten_toys_args;
}

require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/classes/class-svg-icons.php';
require get_template_directory() . '/classes/class-walker-menu.php';
require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/custom-functions.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/classes/body-classes.php';
require get_template_directory() . '/inc/widgets/widgets.php';
require get_template_directory() . '/inc/pagination.php';
require get_template_directory() . '/lib/breadcrumbs/breadcrumbs.php';
require get_template_directory() . '/lib/custom/css/dynamic-style.php';


function kindergarten_toys_remove_customize_register() {
    global $wp_customize;

    $wp_customize->remove_setting( 'display_header_text' );
    $wp_customize->remove_control( 'display_header_text' );

}

add_action( 'customize_register', 'kindergarten_toys_remove_customize_register', 11 );


function kindergarten_toys_radio_sanitize(  $kindergarten_toys_input, $kindergarten_toys_setting  ) {
	$kindergarten_toys_input = sanitize_key( $kindergarten_toys_input );
	$kindergarten_toys_choices = $kindergarten_toys_setting->manager->get_control( $kindergarten_toys_setting->id )->choices;
	return ( array_key_exists( $kindergarten_toys_input, $kindergarten_toys_choices ) ? $kindergarten_toys_input : $kindergarten_toys_setting->default );
}
require get_template_directory() . '/inc/general.php';

function kindergarten_toys_sticky_sidebar_enabled() {
	$kindergarten_toys_sticky_sidebar = get_theme_mod('kindergarten_toys_sticky_sidebar', true);
	if($kindergarten_toys_sticky_sidebar == false) {
		echo '<style>.widget-area-wrapper {position: relative !important;}</style>';
	}
}

add_action('wp_head', 'kindergarten_toys_sticky_sidebar_enabled');

// NOTICE FUNCTION

function kindergarten_toys_admin_notice() { 
    global $pagenow;
    $theme_args = wp_get_theme();
    $meta = get_option( 'kindergarten_toys_admin_notice' );
    $name = $theme_args->get( 'Name' );
    $current_screen = get_current_screen();

    if ( ! $meta ) {
        if ( is_network_admin() ) {
            return;
        }

        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }

        if ( $current_screen->base != 'appearance_page_kindergartentoys-wizard' ) {
            ?>
            <div class="notice notice-success notice-content">
                <h2><?php esc_html_e('Welcome! Thank you for choosing Kindergarten Toys. Let’s Set Up Your Website!', 'kindergarten-toys') ?> </h2>
                <p><?php esc_html_e('Before you dive into customization, let’s go through a quick setup process to ensure everything runs smoothly. Click below to start setting up your website in minutes!', 'kindergarten-toys') ?> </p>
                <div class="info-link">
                    <a href="<?php echo esc_url( admin_url( 'themes.php?page=kindergartentoys-wizard' ) ); ?>"><?php esc_html_e('Get Started with Kindergarten Toys', 'kindergarten-toys'); ?></a>
                </div>
                <p class="dismiss-link"><strong><a href="?kindergarten_toys_admin_notice=1"><?php esc_html_e( 'Dismiss', 'kindergarten-toys' ); ?></a></strong></p>
            </div>
            <?php
        }
    }
}
add_action( 'admin_notices', 'kindergarten_toys_admin_notice' );

if ( ! function_exists( 'kindergarten_toys_update_admin_notice' ) ) :
/**
 * Updating admin notice on dismiss
 */
function kindergarten_toys_update_admin_notice() {
    if ( isset( $_GET['kindergarten_toys_admin_notice'] ) && $_GET['kindergarten_toys_admin_notice'] == '1' ) {
        update_option( 'kindergarten_toys_admin_notice', true );
    }
}
endif;
add_action( 'admin_init', 'kindergarten_toys_update_admin_notice' );

// After Switch theme function
add_action( 'after_switch_theme', 'kindergarten_toys_getstart_setup_options' );
function kindergarten_toys_getstart_setup_options() {
    update_option( 'kindergarten_toys_admin_notice', false );
}