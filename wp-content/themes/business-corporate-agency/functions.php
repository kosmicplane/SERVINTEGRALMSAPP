<?php
/**
 * Business Corporate Agency functions and definitions
 *
 * @package Business Corporate Agency
 * @subpackage business_corporate_agency
 */

function business_corporate_agency_setup() {

	load_theme_textdomain( 'business-corporate-agency', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'title-tag' );
	add_theme_support( "responsive-embeds" );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'business-corporate-agency-featured-image', 2000, 1200, true );
	add_image_size( 'business-corporate-agency-thumbnail-avatar', 100, 100, true );

	// Set the default content width.
	$GLOBALS['content_width'] = 525;

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary-menu'    => __( 'Primary Menu', 'business-corporate-agency' ),
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
		'flex-height' => true,
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array('image','video','gallery','audio',) );

	add_theme_support( 'html5', array('comment-form','comment-list','gallery','caption',) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style( array( 'assets/css/editor-style.css', business_corporate_agency_fonts_url() ) );

	  add_theme_support( 'custom-header', apply_filters( 'business_corporate_agency_custom_header_args', array(
        'default-text-color' => 'fff',
        'header-text'        => false,
        'width'              => 1600,
        'height'             => 420,
        'flex-width'         => true,
        'flex-height'        => true,
        'wp-head-callback'   => 'business_corporate_agency_header_style',
        'default-image'      => get_template_directory_uri() . '/assets/images/header_img.png',
    ) ) );

	/**
	 * Implement the Custom Header feature.
	 */
	require get_parent_theme_file_path( '/inc/custom-header.php' );

}
add_action( 'after_setup_theme', 'business_corporate_agency_setup' );

/**
 * Register custom fonts.
 */
function business_corporate_agency_fonts_url(){
	$business_corporate_agency_font_url = '';
	$business_corporate_agency_font_family = array();
	$business_corporate_agency_font_family[] = 'Outfit:wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900';
	$business_corporate_agency_font_family[] = 'Mali:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700';
	$business_corporate_agency_font_family[] = 'Roboto:wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900';
	$business_corporate_agency_font_family[] = 'Fira Sans Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900';
	$business_corporate_agency_font_family[] = 'Jura:ital,wght@300;400;500;600;700';
	$business_corporate_agency_font_family[] = 'Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900';
	$business_corporate_agency_font_family[] = 'Bad Script';
	$business_corporate_agency_font_family[] = 'Bebas Neue';
	$business_corporate_agency_font_family[] = 'Fjalla One';
	$business_corporate_agency_font_family[] = 'PT Sans:ital,wght@0,400;0,700;1,400;1,700';
	$business_corporate_agency_font_family[] = 'PT Serif:ital,wght@0,400;0,700;1,400;1,700';
	$business_corporate_agency_font_family[] = 'Roboto Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700';
	$business_corporate_agency_font_family[] = 'Alex Brush';
	$business_corporate_agency_font_family[] = 'Overpass:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900';
	$business_corporate_agency_font_family[] = 'Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900';
	$business_corporate_agency_font_family[] = 'Playball';
	$business_corporate_agency_font_family[] = 'Alegreya:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900';
	$business_corporate_agency_font_family[] = 'Julius Sans One';
	$business_corporate_agency_font_family[] = 'Arsenal:ital,wght@0,400;0,700;1,400;1,700';
	$business_corporate_agency_font_family[] = 'Slabo 13px';
	$business_corporate_agency_font_family[] = 'Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900';
	$business_corporate_agency_font_family[] = 'Overpass Mono:wght@300;400;500;600;700';
	$business_corporate_agency_font_family[] = 'Source Sans Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900';
	$business_corporate_agency_font_family[] = 'Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900';
	$business_corporate_agency_font_family[] = 'Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900';
	$business_corporate_agency_font_family[] = 'Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900';
	$business_corporate_agency_font_family[] = 'Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700';
	$business_corporate_agency_font_family[] = 'Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700';
	$business_corporate_agency_font_family[] = 'Cabin:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700';
	$business_corporate_agency_font_family[] = 'Arimo:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700';
	$business_corporate_agency_font_family[] = 'Playfair Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900';
	$business_corporate_agency_font_family[] = 'Quicksand:wght@300;400;500;600;700';
	$business_corporate_agency_font_family[] = 'Padauk:wght@400;700';
	$business_corporate_agency_font_family[] = 'Mulish:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900;1,1000';
	$business_corporate_agency_font_family[] = 'Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900';
	$business_corporate_agency_font_family[] = 'Inconsolata:wght@200;300;400;500;600;700;800;900&family=Mulish:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900;1,1000';
	$business_corporate_agency_font_family[] = 'Bitter:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Mulish:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900;1,1000';
	$business_corporate_agency_font_family[] = 'Pacifico';
	$business_corporate_agency_font_family[] = 'Indie Flower';
	$business_corporate_agency_font_family[] = 'VT323';
	$business_corporate_agency_font_family[] = 'Dosis:wght@200;300;400;500;600;700;800';
	$business_corporate_agency_font_family[] = 'Frank Ruhl Libre:wght@300;400;500;700;900';
	$business_corporate_agency_font_family[] = 'Fjalla One';
	$business_corporate_agency_font_family[] = 'Figtree:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900';
	$business_corporate_agency_font_family[] = 'Oxygen:wght@300;400;700';
	$business_corporate_agency_font_family[] = 'Arvo:ital,wght@0,400;0,700;1,400;1,700';
	$business_corporate_agency_font_family[] = 'Noto Serif:ital,wght@0,400;0,700;1,400;1,700';
	$business_corporate_agency_font_family[] = 'Lobster';
	$business_corporate_agency_font_family[] = 'Crimson Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700';
	$business_corporate_agency_font_family[] = 'Yanone Kaffeesatz:wght@200;300;400;500;600;700';
	$business_corporate_agency_font_family[] = 'Anton';
	$business_corporate_agency_font_family[] = 'Libre Baskerville:ital,wght@0,400;0,700;1,400';
	$business_corporate_agency_font_family[] = 'Bree Serif';
	$business_corporate_agency_font_family[] = 'Gloria Hallelujah';
	$business_corporate_agency_font_family[] = 'Abril Fatface';
	$business_corporate_agency_font_family[] = 'Varela Round';
	$business_corporate_agency_font_family[] = 'Vampiro One';
	$business_corporate_agency_font_family[] = 'Shadows Into Light';
	$business_corporate_agency_font_family[] = 'Cuprum:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700';
	$business_corporate_agency_font_family[] = 'Rokkitt:wght@100;200;300;400;500;600;700;800;900';
	$business_corporate_agency_font_family[] = 'Vollkorn:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900';
	$business_corporate_agency_font_family[] = 'Francois One';
	$business_corporate_agency_font_family[] = 'Orbitron:wght@400;500;600;700;800;900';
	$business_corporate_agency_font_family[] = 'Patua One';
	$business_corporate_agency_font_family[] = 'Acme';
	$business_corporate_agency_font_family[] = 'Satisfy';
	$business_corporate_agency_font_family[] = 'Josefin Slab:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700';
	$business_corporate_agency_font_family[] = 'Quattrocento Sans:ital,wght@0,400;0,700;1,400;1,700';
	$business_corporate_agency_font_family[] = 'Architects Daughter';
	$business_corporate_agency_font_family[] = 'Russo One';
	$business_corporate_agency_font_family[] = 'Monda:wght@400;700';
	$business_corporate_agency_font_family[] = 'Righteous';
	$business_corporate_agency_font_family[] = 'Lobster Two:ital,wght@0,400;0,700;1,400;1,700';
	$business_corporate_agency_font_family[] = 'Hammersmith One';
	$business_corporate_agency_font_family[] = 'Courgette';
	$business_corporate_agency_font_family[] = 'Permanent Marke';
	$business_corporate_agency_font_family[] = 'Cherry Swash:wght@400;700';
	$business_corporate_agency_font_family[] = 'Cormorant Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700';
	$business_corporate_agency_font_family[] = 'Poiret One';
	$business_corporate_agency_font_family[] = 'BenchNine:wght@300;400;700';
	$business_corporate_agency_font_family[] = 'Economica:ital,wght@0,400;0,700;1,400;1,700';
	$business_corporate_agency_font_family[] = 'Handlee';
	$business_corporate_agency_font_family[] = 'Cardo:ital,wght@0,400;0,700;1,400';
	$business_corporate_agency_font_family[] = 'Alfa Slab One';
	$business_corporate_agency_font_family[] = 'Averia Serif Libre:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700';
	$business_corporate_agency_font_family[] = 'Cookie';
	$business_corporate_agency_font_family[] = 'Chewy';
	$business_corporate_agency_font_family[] = 'Great Vibes';
	$business_corporate_agency_font_family[] = 'Coming Soon';
	$business_corporate_agency_font_family[] = 'Philosopher:ital,wght@0,400;0,700;1,400;1,700';
	$business_corporate_agency_font_family[] = 'Days One';
	$business_corporate_agency_font_family[] = 'Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900';
	$business_corporate_agency_font_family[] = 'Shrikhand';
	$business_corporate_agency_font_family[] = 'Tangerine:wght@400;700';
	$business_corporate_agency_font_family[] = 'IM Fell English SC';
	$business_corporate_agency_font_family[] = 'Boogaloo';
	$business_corporate_agency_font_family[] = 'Bangers';
	$business_corporate_agency_font_family[] = 'Fredoka One';
	$business_corporate_agency_font_family[] = 'Volkhov:ital,wght@0,400;0,700;1,400;1,700';
	$business_corporate_agency_font_family[] = 'Shadows Into Light Two';
	$business_corporate_agency_font_family[] = 'Marck Script';
	$business_corporate_agency_font_family[] = 'Sacramento';
	$business_corporate_agency_font_family[] = 'Unica One';
	$business_corporate_agency_font_family[] = 'Dancing Script:wght@400;500;600;700';
	$business_corporate_agency_font_family[] = 'Exo 2:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900';
	$business_corporate_agency_font_family[] = 'Archivo:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900';
	$business_corporate_agency_font_family[] = 'Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900';
	$business_corporate_agency_font_family[] = 'DM Serif Display:ital@0;1';
	$business_corporate_agency_font_family[] = 'Open Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800';
	
	$business_corporate_agency_query_args = array(
		'family'	=> rawurlencode(implode('|',$business_corporate_agency_font_family)),
	);
	$business_corporate_agency_font_url = add_query_arg($business_corporate_agency_query_args,'//fonts.googleapis.com/css');
	return $business_corporate_agency_font_url;
	$contents = business_corporate_agency_wptt_get_wefont_url( esc_url_raw( $fonts_url ) );
}

/**
 * Register widget area.
 */
function business_corporate_agency_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'business-corporate-agency' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'business-corporate-agency' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'business-corporate-agency' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your sidebar on pages.', 'business-corporate-agency' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar 3', 'business-corporate-agency' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'business-corporate-agency' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'business-corporate-agency' ),
		'id'            => 'footer-1',
		'description'   => __( 'Add widgets here to appear in your footer.', 'business-corporate-agency' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s py-2">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'business-corporate-agency' ),
		'id'            => 'footer-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'business-corporate-agency' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s py-2">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 3', 'business-corporate-agency' ),
		'id'            => 'footer-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'business-corporate-agency' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s py-2">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 4', 'business-corporate-agency' ),
		'id'            => 'footer-4',
		'description'   => __( 'Add widgets here to appear in your footer.', 'business-corporate-agency' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s py-2">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'business_corporate_agency_widgets_init' );

// Category count 
function business_corporate_agency_display_post_category_count() {
    $business_corporate_agency_category = get_the_category();
    $business_corporate_agency_category_count = ($business_corporate_agency_category) ? count($business_corporate_agency_category) : 0;
    $business_corporate_agency_category_text = ($business_corporate_agency_category_count === 1) ? 'category' : 'categories'; // Check for pluralization
    echo $business_corporate_agency_category_count . ' ' . $business_corporate_agency_category_text;
}

//post tag
function business_corporate_agency_custom_tags_filter($business_corporate_agency_tag_list) {
    // Replace the comma (,) with an empty string
    $business_corporate_agency_tag_list = str_replace(', ', '', $business_corporate_agency_tag_list);

    return $business_corporate_agency_tag_list;
}
add_filter('the_tags', 'business_corporate_agency_custom_tags_filter');

function business_corporate_agency_custom_output_tags() {
    $business_corporate_agency_tags = get_the_tags();

    if ($business_corporate_agency_tags) {
        $business_corporate_agency_tags_output = '<div class="post_tag">Tags: ';
        $business_corporate_agency_first_tag = reset($business_corporate_agency_tags);
        foreach ($business_corporate_agency_tags as $tag) {
            $business_corporate_agency_tags_output .= '<a href="' . esc_url(get_tag_link($tag)) . '" rel="tag" class="mr-2">' . esc_html($tag->name) . '</a>';
            if ($tag !== $business_corporate_agency_first_tag) {
                $business_corporate_agency_tags_output .= ' ';
            }
        }
        $business_corporate_agency_tags_output .= '</div>';
        echo $business_corporate_agency_tags_output;
    }
}
/**
 * Enqueue scripts and styles.
 */
function business_corporate_agency_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'business-corporate-agency-fonts', business_corporate_agency_fonts_url(), array(), null );

	// owl
	wp_enqueue_style( 'owl-carousel-css', get_theme_file_uri( '/assets/css/owl.carousel.css' ) );

	// Bootstrap
	wp_enqueue_style( 'bootstrap-css', get_theme_file_uri( '/assets/css/bootstrap.css' ) );

	// Theme stylesheet.
	wp_enqueue_style( 'business-corporate-agency-style', get_stylesheet_uri() );
	require get_parent_theme_file_path( '/tp-theme-color.php' );
	wp_add_inline_style( 'business-corporate-agency-style',$business_corporate_agency_tp_theme_css );
	require get_parent_theme_file_path( '/tp-body-width-layout.php' );
	wp_add_inline_style( 'business-corporate-agency-style',$business_corporate_agency_tp_theme_css );
	wp_style_add_data('business-corporate-agency-style', 'rtl', 'replace');
	
	// Theme block stylesheet.
	wp_enqueue_style( 'business-corporate-agency-block-style', get_theme_file_uri( '/assets/css/blocks.css' ), array( 'business-corporate-agency-style' ), '1.0' );

	// Fontawesome
	wp_enqueue_style( 'fontawesome-css', get_theme_file_uri( '/assets/css/fontawesome-all.css' ) );

	wp_enqueue_script( 'bootstrap-js', get_theme_file_uri( '/assets/js/bootstrap.js' ), array( 'jquery' ), true );

	wp_enqueue_script( 'owl-carousel-js', get_theme_file_uri( '/assets/js/owl.carousel.js' ), array( 'jquery' ), true );
	
	wp_enqueue_script( 'business-corporate-agency-custom-scripts', esc_url( get_template_directory_uri() ) . '/assets/js/business-corporate-agency-custom.js', array('jquery'), true);

	wp_enqueue_script( 'business-corporate-agency-focus-nav', esc_url( get_template_directory_uri() ) . '/assets/js/focus-nav.js', array('jquery'), true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	$business_corporate_agency_body_font_family = get_theme_mod('business_corporate_agency_body_font_family', '');

	$business_corporate_agency_heading_font_family = get_theme_mod('business_corporate_agency_heading_font_family', '');

	$business_corporate_agency_menu_font_family = get_theme_mod('business_corporate_agency_menu_font_family', '');

	$business_corporate_agency_tp_theme_css = '
		body{
		    font-family: '.esc_html($business_corporate_agency_body_font_family).';
		}
		.more-btn a{
		    font-family: '.esc_html($business_corporate_agency_body_font_family).';
		}
		h1{
		    font-family: '.esc_html($business_corporate_agency_heading_font_family).';
		}
		h2{
		    font-family: '.esc_html($business_corporate_agency_heading_font_family).';
		}
		h3{
		    font-family: '.esc_html($business_corporate_agency_heading_font_family).';
		}
		h4{
		    font-family: '.esc_html($business_corporate_agency_heading_font_family).';
		}
		h5{
		    font-family: '.esc_html($business_corporate_agency_heading_font_family).';
		}
		h6{
		    font-family: '.esc_html($business_corporate_agency_heading_font_family).';
		}
		#theme-sidebar .wp-block-search .wp-block-search__label{
		    font-family: '.esc_html($business_corporate_agency_heading_font_family).';
		}
		.menubar,.main-navigation a{
		    font-family: '.esc_html($business_corporate_agency_menu_font_family).';
		}
	';
	wp_add_inline_style('business-corporate-agency-style', $business_corporate_agency_tp_theme_css);
}
add_action( 'wp_enqueue_scripts', 'business_corporate_agency_scripts' );

/*radio button sanitization*/
function business_corporate_agency_sanitize_choices( $input, $setting ) {
    global $wp_customize;
    $control = $wp_customize->get_control( $setting->id );
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

// Sanitize Sortable control.
function business_corporate_agency_sanitize_sortable( $val, $setting ) {
	if ( is_string( $val ) || is_numeric( $val ) ) {
		return array(
			esc_attr( $val ),
		);
	}
	$sanitized_value = array();
	foreach ( $val as $item ) {
		if ( isset( $setting->manager->get_control( $setting->id )->choices[ $item ] ) ) {
			$sanitized_value[] = esc_attr( $item );
		}
	}
	return $sanitized_value;
}

function business_corporate_agency_sanitize_dropdown_pages( $page_id, $setting ) {
  // Ensure $input is an absolute integer.
  $page_id = absint( $page_id );
  // If $page_id is an ID of a published page, return it; otherwise, return the default.
  return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}


// Change number or products per row to 3
add_filter('loop_shop_columns', 'business_corporate_agency_loop_columns');
if (!function_exists('business_corporate_agency_loop_columns')) {
	function business_corporate_agency_loop_columns() {
		$business_corporate_agency_columns = get_theme_mod( 'business_corporate_agency_per_columns', 3 );
		return $business_corporate_agency_columns;
	}
}

//Change number of products that are displayed per page (shop page)
add_filter( 'loop_shop_per_page', 'business_corporate_agency_per_page', 20 );
function business_corporate_agency_per_page( $business_corporate_agency_cols ) {
  	$business_corporate_agency_cols = get_theme_mod( 'business_corporate_agency_product_per_page', 9 );
	return $business_corporate_agency_cols;
}

function business_corporate_agency_sanitize_number_range( $number, $setting ) {

	// Ensure input is an absolute integer.
	$number = absint( $number );

	// Get the input attributes associated with the setting.
	$atts = $setting->manager->get_control( $setting->id )->input_attrs;

	// Get minimum number in the range.
	$min = ( isset( $atts['min'] ) ? $atts['min'] : $number );

	// Get maximum number in the range.
	$max = ( isset( $atts['max'] ) ? $atts['max'] : $number );

	// Get step.
	$step = ( isset( $atts['step'] ) ? $atts['step'] : 1 );

	// If the number is within the valid range, return it; otherwise, return the default
	return ( $min <= $number && $number <= $max && is_int( $number / $step ) ? $number : $setting->default );
}

function business_corporate_agency_sanitize_checkbox( $input ) {
	// Boolean check
	return ( ( isset( $input ) && true == $input ) ? true : false );
}


function business_corporate_agency_sanitize_phone_number( $phone ) {
	return preg_replace( '/[^\d+]/', '', $phone );
}

function business_corporate_agency_sanitize_number_absint( $number, $setting ) {
	// Ensure $number is an absolute integer (whole number, zero or greater).
	$number = absint( $number );

	// If the input is an absolute integer, return it; otherwise, return the default
	return ( $number ? $number : $setting->default );
}

/**
 * Use front-page.php when Front page displays is set to a static page.
 */
function business_corporate_agency_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template','business_corporate_agency_front_page_template' );

/**
 * Logo Custamization.
 */

function business_corporate_agency_logo_width(){

	$business_corporate_agency_logo_width   = get_theme_mod( 'business_corporate_agency_logo_width', 50 );

	echo "<style type='text/css' media='all'>"; ?>
		img.custom-logo{
		    width: <?php echo absint( $business_corporate_agency_logo_width ); ?>px;
		    max-width: 100%;
		}
	<?php echo "</style>";
}

add_action( 'wp_head', 'business_corporate_agency_logo_width' );

// get started
add_action( 'wp_ajax_business_corporate_agency_dismissed_notice_handler', 'business_corporate_agency_ajax_notice_handler' );

function business_corporate_agency_ajax_notice_handler() {
	if (!wp_verify_nonce($_POST['wpnonce'], 'business_corporate_agency_dismissed_notice_nonce')) {
		exit;
	}
    if ( isset( $_POST['type'] ) ) {
        $type = sanitize_text_field( wp_unslash( $_POST['type'] ) );
        update_option( 'dismissed-' . $type, TRUE );
    }
}

function business_corporate_agency_activation_notice() { 

	if ( ! get_option('dismissed-get_started', FALSE ) ) { ?>

    <div class="business-corporate-agency-notice-wrapper updated notice notice-get-started-class is-dismissible" data-notice="get_started">
        <div class="business-corporate-agency-getting-started-notice clearfix">
            <div class="business-corporate-agency-theme-notice-content">
                <h2 class="business-corporate-agency-notice-h2">
                    <?php
                printf(
                /* translators: 1: welcome page link starting html tag, 2: welcome page link ending html tag. */
                    esc_html__( 'Welcome! Thank you for choosing %1$s!', 'business-corporate-agency' ), '<strong>'. wp_get_theme()->get('Name'). '</strong>' );
                ?>
                </h2>

                <p class="plugin-install-notice"><?php echo sprintf(__('Click here to get started with the theme set-up.', 'business-corporate-agency')) ?></p>

                <a class="business-corporate-agency-btn-get-started button button-primary button-hero business-corporate-agency-button-padding" href="<?php echo esc_url( admin_url( 'themes.php?page=business-corporate-agency-about' )); ?>" ><?php esc_html_e( 'Begin Installation - Import Demo', 'business-corporate-agency' ) ?></a><span class="business-corporate-agency-push-down">
                <?php
                    /* translators: %1$s: Anchor link start %2$s: Anchor link end */
                    printf(
                        'or %1$sCustomize theme%2$s</a></span>',
                        '<a target="_blank" href="' . esc_url( admin_url( 'customize.php' ) ) . '">',
                        '</a>'
                    );
                ?>
            </div>
        </div>
    </div>
<?php }

}
add_action( 'admin_notices', 'business_corporate_agency_activation_notice' );

add_action('after_switch_theme', 'business_corporate_agency_setup_options');
function business_corporate_agency_setup_options () {
    update_option('dismissed-get_started', FALSE );
}

add_action( 'admin_notices', 'business_corporate_agency_activation_notice' );

//Admin Enqueue for Admin
function business_corporate_agency_admin_enqueue_scripts(){
	wp_enqueue_style('business-corporate-agency-admin-style', get_template_directory_uri() . '/assets/css/admin.css');
	wp_register_script( 'business-corporate-agency-admin-script', get_template_directory_uri() . '/assets/js/business-corporate-agency-admin.js', array( 'jquery' ), '', true );

	wp_localize_script(
		'business-corporate-agency-admin-script',
		'business_corporate_agency',
		array(
			'admin_ajax'	=>	admin_url('admin-ajax.php'),
			'wpnonce'			=>	wp_create_nonce('business_corporate_agency_dismissed_notice_nonce')
		)
	);
	wp_enqueue_script('business-corporate-agency-admin-script');

    wp_localize_script( 'business-corporate-agency-admin-script', 'business_corporate_agency_ajax_object',
        array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
    );
}
add_action( 'admin_enqueue_scripts', 'business_corporate_agency_admin_enqueue_scripts' );

function business_corporate_agency_theme_setup() {

	// footer link
	define('BUSINESS_CORPORATE_AGENCY_CREDIT',__('https://www.themespride.com/products/free-corporate-wordpress-theme','business-corporate-agency') );
	if ( ! function_exists( 'BUSINESS_CORPORATE_AGENCY_CREDIT' ) ) {
		function BUSINESS_CORPORATE_AGENCY_CREDIT(){
			echo "<a href=".esc_url(BUSINESS_CORPORATE_AGENCY_CREDIT)." target='_blank'>".esc_html__(get_theme_mod('business_corporate_agency_footer_text',__('Business Corpoate Agency WordPress Theme','business-corporate-agency')))."</a>";
		}
	}
 
	/**
	 * Custom template tags for this theme.
	 */
	require get_parent_theme_file_path( '/inc/template-tags.php' );

	/**
	 * Additional features to allow styling of the templates.
	 */
	require get_parent_theme_file_path( '/inc/template-functions.php' );

	/**
	 * Customizer additions.
	 */
	require get_parent_theme_file_path( '/inc/customizer.php' );
	/**
	 * Load Theme Web File
	 */
	require get_parent_theme_file_path('/inc/wptt-webfont-loader.php' );
	/**
	 * Load Toggle file
	 */
	require get_parent_theme_file_path( '/inc/controls/customize-control-toggle.php' );

	/**
	 * load sortable file
	 */
	require get_parent_theme_file_path( '/inc/controls/sortable-control.php' );

	/**
	 * About Theme Page
	 */
	require get_parent_theme_file_path( '/inc/about-theme.php' );

	/**
	 * TGM Recommendation
	 */
	require get_parent_theme_file_path( '/inc/TGM/tgm.php' );

}
add_action( 'after_setup_theme', 'business_corporate_agency_theme_setup' );