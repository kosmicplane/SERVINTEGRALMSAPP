<?php
/**
 * Theme functions and definitions
 *
 * @package Agencyio
 */

if ( ! function_exists( 'agencyio_enqueue_styles' ) ) :

	/**
	 * Load assets.
	 *
	 * @since 1.0.0
	 */
	function agencyio_enqueue_styles() {

		wp_enqueue_style( 'agencyup-style-parent', get_template_directory_uri() . '/style.css' );
		wp_enqueue_style( 'agencyio-style', get_stylesheet_directory_uri() . '/style.css', array( 'agencyup-style-parent' ), '1.0' );
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css');
		wp_enqueue_style( 'agencyio-default-css', get_stylesheet_directory_uri()."/css/colors/default.css" );
		wp_dequeue_style( 'default',get_template_directory_uri() .'/css/colors/default.css');
	}

endif;

add_action( 'wp_enqueue_scripts', 'agencyio_enqueue_styles', 99 );

function agencyio_theme_setup() {

    //Load text domain for translation-ready
    load_theme_textdomain('blogrift', get_stylesheet_directory() . '/languages');
    add_theme_support( "title-tag" );
    add_theme_support( 'automatic-feed-links' );
}

add_action( 'after_setup_theme', 'agencyio_theme_setup' );


add_action( 'customize_register', 'agencyip_customizer_rid_values', 1000 );
function agencyip_customizer_rid_values($wp_customize) {

  $wp_customize->remove_control('hide_show_nav_menu_btn');
  $wp_customize->remove_control('menu_btn_target');
  $wp_customize->remove_control('menu_btn_label');
  $wp_customize->remove_control('menu_btn_link');

 }


/*--------------------------------------------------------------------*/
/*     Register Google Fonts
/*--------------------------------------------------------------------*/
function agencyio_fonts_url() {
	
    $fonts_url = '';
		
    $font_families = array();
 
	$font_families = array('Plus Jakarta Sans:300,400,500,600,700,|Urbanist:400,500,600,700,800&display=swap');
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

    return $fonts_url;
}
function agencyio_scripts_styles() {
    wp_enqueue_style( 'agencyio-fonts', agencyio_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'agencyio_scripts_styles' );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function agencyio_widgets_init() {
	
	$agencyio_footer_column_layout = get_theme_mod('agencyup_footer_column_layout',3);
	
	$agencyio_footer_column_layout = 12 / $agencyio_footer_column_layout;
	
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Widget Area', 'agencyio' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="bs-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6>',
		'after_title'   => '</h6>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area', 'agencyio' ),
		'id'            => 'footer_widget_area',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="col-md-'.$agencyio_footer_column_layout.' rotateInDownLeft animated bs-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6>',
		'after_title'   => '</h6>',
	) );

}
add_action( 'widgets_init', 'agencyio_widgets_init' );