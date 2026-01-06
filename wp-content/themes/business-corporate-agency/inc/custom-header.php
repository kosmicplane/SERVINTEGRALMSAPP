<?php
/**
 * Custom header implementation
 *
 * @link https://codex.wordpress.org/Custom_Headers
 *
 * @package Business Corporate Agency
 * @subpackage business_corporate_agency
 */

function business_corporate_agency_custom_header_setup() {
    register_default_headers( array(
        'default-image' => array(
            'url'           => get_template_directory_uri() . '/assets/images/header_img.png',
            'thumbnail_url' => get_template_directory_uri() . '/assets/images/header_img.png',
            'description'   => __( 'Default Header Image', 'business-corporate-agency' ),
        ),
    ) );
}
add_action( 'after_setup_theme', 'business_corporate_agency_custom_header_setup' );

/**
 * Styles the header image based on Customizer settings.
 */
function business_corporate_agency_header_style() {
    $business_corporate_agency_header_image = get_header_image() ? get_header_image() : get_template_directory_uri() . '/assets/images/header_img.png';

    $business_corporate_agency_height     = get_theme_mod( 'business_corporate_agency_header_image_height', 420 );
    $business_corporate_agency_position   = get_theme_mod( 'business_corporate_agency_header_background_position', 'center' );
    $business_corporate_agency_attachment = get_theme_mod( 'business_corporate_agency_header_background_attachment', 1 ) ? 'fixed' : 'scroll';

    $business_corporate_agency_custom_css = "
        .header-img, .single-page-img, .external-div .box-image-page img, .external-div {
            background-image: url('" . esc_url( $business_corporate_agency_header_image ) . "');
            background-size: cover;
            height: " . esc_attr( $business_corporate_agency_height ) . "px;
            background-position: " . esc_attr( $business_corporate_agency_position ) . ";
            background-attachment: " . esc_attr( $business_corporate_agency_attachment ) . ";
        }

        @media (max-width: 1000px) {
            .header-img, .single-page-img, .external-div .box-image-page img,.external-div,.featured-image{
                height: 250px !important;
            }
            .box-text h2{
                font-size: 27px;
            }
        }
    ";

    wp_add_inline_style( 'business-corporate-agency-style', $business_corporate_agency_custom_css );
}
add_action( 'wp_enqueue_scripts', 'business_corporate_agency_header_style' );

/**
 * Enqueue the main theme stylesheet.
 */
function business_corporate_agency_enqueue_styles() {
    wp_enqueue_style( 'business-corporate-agency-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'business_corporate_agency_enqueue_styles' );