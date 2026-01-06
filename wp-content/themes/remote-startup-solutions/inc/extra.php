<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package remote_startup_solutions
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function remote_startup_solutions_body_classes( $classes ) {
  global $remote_startup_solutions_post;
  
    if( !is_page_template( 'template-home.php' ) ){
        $classes[] = 'inner';
        // Adds a class of group-blog to blogs with more than 1 published author.
    }

    if ( is_multi_author() ) {
        $classes[] = 'group-blog ';
    }

    // Adds a class of custom-background-image to sites with a custom background image.
    if ( get_background_image() ) {
        $classes[] = 'custom-background-image';
    }
    
    // Adds a class of custom-background-color to sites with a custom background color.
    if ( get_background_color() != 'ffffff' ) {
        $classes[] = 'custom-background-color';
    }
    

    if( remote_startup_solutions_woocommerce_activated() && ( is_shop() || is_product_category() || is_product_tag() || 'product' === get_post_type() ) && ! is_active_sidebar( 'shop-sidebar' ) ){
        $classes[] = 'full-width';
    }    

    // Adds a class of hfeed to non-singular pages.
    if ( ! is_page() ) {
        $classes[] = 'hfeed ';
    }
  
    if( is_404() ||  is_search() ){
        $classes[] = 'full-width';
    }
  
    if( ! is_active_sidebar( 'right-sidebar' ) ) {
        $classes[] = 'full-width'; 
    }

    return $classes;
}
add_filter( 'body_class', 'remote_startup_solutions_body_classes' );

 /**
 * 
 * @link http://www.altafweb.com/2011/12/remove-specific-tag-from-php-string.html
 */
function remote_startup_solutions_strip_single( $tag, $string ){
    $string=preg_replace('/<'.$tag.'[^>]*>/i', '', $string);
    $string=preg_replace('/<\/'.$tag.'>/i', '', $string);
    return $string;
}

if ( ! function_exists( 'remote_startup_solutions_excerpt_more' ) ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... * 
 */
function remote_startup_solutions_excerpt_more($more) {
  return is_admin() ? $more : ' &hellip; ';
}
endif;
add_filter( 'excerpt_more', 'remote_startup_solutions_excerpt_more' );


if( ! function_exists( 'remote_startup_solutions_footer_credit' ) ):
/**
 * Footer Credits
*/
function remote_startup_solutions_footer_credit(){
    $remote_startup_solutions_footer_setting = get_theme_mod( 'remote_startup_solutions_footer_setting', true );
    if ( $remote_startup_solutions_footer_setting ){ 
        $remote_startup_solutions_copyright_text = get_theme_mod( 'remote_startup_solutions_footer_copyright_text' );

        $remote_startup_solutions_text  = '<div class="site-info"><div class="container"><span class="copyright">';
        if( $remote_startup_solutions_copyright_text ){
            $remote_startup_solutions_text .= wp_kses_post( $remote_startup_solutions_copyright_text ); 
        }else{
            $remote_startup_solutions_text .= esc_html__( '&copy; ', 'remote-startup-solutions' ) . date_i18n( esc_html__( 'Y', 'remote-startup-solutions' ) ); 
            $remote_startup_solutions_text .= ' <a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>'. esc_html__( '. All Rights Reserved.', 'remote-startup-solutions' );
        }
        $remote_startup_solutions_text .= '</span>';
        $remote_startup_solutions_text .= '<span class="by"> <a href="' . esc_url( 'https://www.themeignite.com/products/free-startup-wordpress-theme' ) .'" rel="nofollow" target="_blank">' . REMOTE_STARTUP_SOLUTION_THEME_NAME . '</a> '. esc_html__( 'By ', 'remote-startup-solutions' ) . '<a href="' . esc_url( 'https://themeignite.com/' ) .'" rel="nofollow" target="_blank">' . esc_html__( 'Themeignite', 'remote-startup-solutions' ) . '</a>.';
        $remote_startup_solutions_text .= sprintf( esc_html__( ' Powered By %s', 'remote-startup-solutions' ), '<a href="'. esc_url( __( 'https://wordpress.org/', 'remote-startup-solutions' ) ) .'" target="_blank">WordPress</a>.' );
        if ( function_exists( 'the_privacy_policy_link' ) ) {
            $remote_startup_solutions_text .= get_the_privacy_policy_link();
        }
        $remote_startup_solutions_text .= '</span></div></div>';
        echo apply_filters( 'remote_startup_solutions_footer_text', $remote_startup_solutions_text );
    } 
}
add_action( 'remote_startup_solutions_footer', 'remote_startup_solutions_footer_credit' );
endif;

/**
 * Is Woocommerce activated
*/
if ( ! function_exists( 'remote_startup_solutions_woocommerce_activated' ) ) {
  function remote_startup_solutions_woocommerce_activated() {
    if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
  }
}

if( ! function_exists( 'remote_startup_solutions_change_comment_form_default_fields' ) ) :
/**
 * Change Comment form default fields i.e. author, email & url.
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function remote_startup_solutions_change_comment_form_default_fields( $fields ){    
    // get the current commenter if available
    $remote_startup_solutions_commenter = wp_get_current_commenter();
 
    // core functionality
    $req      = get_option( 'require_name_email' );
    $remote_startup_solutions_aria_req = ( $req ? " aria-required='true'" : '' );
    $remote_startup_solutions_required = ( $req ? " required" : '' );
    $remote_startup_solutions_author   = ( $req ? __( 'Name*', 'remote-startup-solutions' ) : __( 'Name', 'remote-startup-solutions' ) );
    $remote_startup_solutions_email    = ( $req ? __( 'Email*', 'remote-startup-solutions' ) : __( 'Email', 'remote-startup-solutions' ) );
 
    // Change just the author field
    $fields['author'] = '<p class="comment-form-author"><label class="screen-reader-text" for="author">' . esc_html__( 'Name', 'remote-startup-solutions' ) . '<span class="required">*</span></label><input id="author" name="author" placeholder="' . esc_attr( $remote_startup_solutions_author ) . '" type="text" value="' . esc_attr( $remote_startup_solutions_commenter['comment_author'] ) . '" size="30"' . $remote_startup_solutions_aria_req . $remote_startup_solutions_required . ' /></p>';
    
    $fields['email'] = '<p class="comment-form-email"><label class="screen-reader-text" for="email">' . esc_html__( 'Email', 'remote-startup-solutions' ) . '<span class="required">*</span></label><input id="email" name="email" placeholder="' . esc_attr( $remote_startup_solutions_email ) . '" type="text" value="' . esc_attr(  $remote_startup_solutions_commenter['comment_author_email'] ) . '" size="30"' . $remote_startup_solutions_aria_req . $remote_startup_solutions_required. ' /></p>';
    
    $fields['url'] = '<p class="comment-form-url"><label class="screen-reader-text" for="url">' . esc_html__( 'Website', 'remote-startup-solutions' ) . '</label><input id="url" name="url" placeholder="' . esc_attr__( 'Website', 'remote-startup-solutions' ) . '" type="text" value="' . esc_attr( $remote_startup_solutions_commenter['comment_author_url'] ) . '" size="30" /></p>'; 
    
    return $fields;    
}
endif;
add_filter( 'comment_form_default_fields', 'remote_startup_solutions_change_comment_form_default_fields' );

if( ! function_exists( 'remote_startup_solutions_change_comment_form_defaults' ) ) :
/**
 * Change Comment Form defaults
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function remote_startup_solutions_change_comment_form_defaults( $defaults ){    
    $defaults['comment_field'] = '<p class="comment-form-comment"><label class="screen-reader-text" for="comment">' . esc_html__( 'Comment', 'remote-startup-solutions' ) . '</label><textarea id="comment" name="comment" placeholder="' . esc_attr__( 'Comment', 'remote-startup-solutions' ) . '" cols="45" rows="8" aria-required="true" required></textarea></p>';
    
    return $defaults;    
}
endif;
add_filter( 'comment_form_defaults', 'remote_startup_solutions_change_comment_form_defaults' );

if( ! function_exists( 'remote_startup_solutions_escape_text_tags' ) ) :
/**
 * Remove new line tags from string
 *
 * @param $text
 * @return string
 */
function remote_startup_solutions_escape_text_tags( $text ) {
    return (string) str_replace( array( "\r", "\n" ), '', strip_tags( $text ) );
}
endif;

if( ! function_exists( 'wp_body_open' ) ) :
/**
 * Fire the wp_body_open action.
 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
*/
function wp_body_open() {
    /**
     * Triggered after the opening <body> tag.
    */
    do_action( 'wp_body_open' );
}
endif;

if ( ! function_exists( 'remote_startup_solutions_get_fallback_svg' ) ) :    
/**
 * Get Fallback SVG
*/
function remote_startup_solutions_get_fallback_svg( $remote_startup_solutions_post_thumbnail ) {
    if( ! $remote_startup_solutions_post_thumbnail ){
        return;
    }
    
    $remote_startup_solutions_image_size = remote_startup_solutions_get_image_sizes( $remote_startup_solutions_post_thumbnail );
     
    if( $remote_startup_solutions_image_size ){ ?>
        <div class="svg-holder">
             <svg class="fallback-svg" viewBox="0 0 <?php echo esc_attr( $remote_startup_solutions_image_size['width'] ); ?> <?php echo esc_attr( $remote_startup_solutions_image_size['height'] ); ?>" preserveAspectRatio="none">
                    <rect width="<?php echo esc_attr( $remote_startup_solutions_image_size['width'] ); ?>" height="<?php echo esc_attr( $remote_startup_solutions_image_size['height'] ); ?>" style="fill:#dedddd;"></rect>
            </svg>
        </div>
        <?php
    }
}
endif;

function remote_startup_solutions_enqueue_google_fonts() {

    require get_template_directory() . '/inc/wptt-webfont-loader.php';

    wp_enqueue_style(
            'google-fonts-basic',
        wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Basic&display=swap' ),
        array(),
        '1.0'
    );

    wp_enqueue_style(
        'google-fonts-inter',
        wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap' ),
        array(),
        '1.0'
    );
}
add_action( 'wp_enqueue_scripts', 'remote_startup_solutions_enqueue_google_fonts' );


if( ! function_exists( 'remote_startup_solutions_site_branding' ) ) :
/**
 * Site Branding
*/
function remote_startup_solutions_site_branding(){
    $remote_startup_solutions_logo_site_title = get_theme_mod( 'header_site_title', 1 );
    $remote_startup_solutions_tagline = get_theme_mod( 'header_tagline', false );
    $remote_startup_solutions_logo_width = get_theme_mod('logo_width', 100); // Retrieve the logo width setting

    ?>
    <div class="site-branding" style="max-width: <?php echo esc_attr(get_theme_mod('logo_width', '-1'))?>px;">
        <?php 
        // Check if custom logo is set and display it
        if (function_exists('has_custom_logo') && has_custom_logo()) {
            the_custom_logo();
        }
        if ($remote_startup_solutions_logo_site_title):
             if (is_front_page()): ?>
            <h1 class="site-title" style="font-size: <?php echo esc_attr(get_theme_mod('remote_startup_solutions_site_title_size', '30')); ?>px;">
            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
          </h1>
            <?php else: ?>
                <p class="site-title" itemprop="name">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                </p>
            <?php endif; ?>
        <?php endif; 
    
        if ($remote_startup_solutions_tagline) :
            $remote_startup_solutions_description = get_bloginfo('description', 'display');
            if ($remote_startup_solutions_description || is_customize_preview()) :
        ?>
                <p class="site-description" itemprop="description"><?php echo $remote_startup_solutions_description; ?></p>
            <?php endif;
        endif;
        ?>
    </div>
    <?php
}
endif;
if( ! function_exists( 'remote_startup_solutions_navigation' ) ) :
/**
 * Site Navigation
*/
function remote_startup_solutions_navigation(){
    ?>
    <nav class="main-navigation" id="site-navigation"  role="navigation">
        <?php 
        wp_nav_menu( array( 
            'theme_location' => 'primary', 
            'menu_id' => 'primary-menu' 
        ) ); 
        ?>
    </nav>
    <?php
}
endif;

if( ! function_exists( 'remote_startup_solutions_header' ) ) :
    /**
     * Header Start
    */
    function remote_startup_solutions_header() {
        $remote_startup_solutions_header_image = get_header_image();
        $remote_startup_solutions_sticky_header = get_theme_mod('remote_startup_solutions_sticky_header');
        ?>
        <div id="page-site-header" style="background-image: url('<?php echo esc_url( $remote_startup_solutions_header_image ); ?>');">
            <header id="masthead" data-sticky="<?php echo esc_attr($remote_startup_solutions_sticky_header); ?>" class="site-header header-inner" role="banner">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-6 align-self-center logo-bg">
                            <?php remote_startup_solutions_site_branding(); ?>
                        </div>
                        <div class="col-xl-9 col-lg-9 col-md-6 align-self-center menu-bg">
                            <div class="inner-menu">
                                <?php remote_startup_solutions_navigation(); ?>
                                <?php if( get_theme_mod('remote_startup_solutions_show_hide_search', false) ) { ?>
                                    <div class="search-body text-center align-self-center text-md-end">
                                        <button type="button" class="search-show">
                                            <i class="<?php echo esc_attr(get_theme_mod('remote_startup_solutions_search_icon', 'fas fa-search')); ?>"></i>
                                        </button>
                                    </div>
                                <?php } ?>
                                <div class="searchform-inner">
                                    <?php get_search_form(); ?>
                                    <button type="button" class="close" aria-label="Close"><span aria-hidden="true">X</span></button>
                                </div> 
                            </div>
                        </div> 
                    </div>
                </div>
            </header>
        </div>
        <?php
    }
endif;
add_action( 'remote_startup_solutions_header', 'remote_startup_solutions_header', 20 );