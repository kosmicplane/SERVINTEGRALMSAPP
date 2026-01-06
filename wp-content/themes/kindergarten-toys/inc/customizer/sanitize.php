<?php
/**
* Custom Functions.
*
* @package Kindergarten Toys
*/

if( !function_exists( 'kindergarten_toys_sanitize_sidebar_option' ) ) :

    // Sidebar Option Sanitize.
    function kindergarten_toys_sanitize_sidebar_option( $kindergarten_toys_input ){

        $kindergarten_toys_metabox_options = array( 'global-sidebar','left-sidebar','right-sidebar','no-sidebar' );
        if( in_array( $kindergarten_toys_input,$kindergarten_toys_metabox_options ) ){

            return $kindergarten_toys_input;

        }

        return;

    }

endif;

if ( ! function_exists( 'kindergarten_toys_sanitize_checkbox' ) ) :

	/**
	 * Sanitize checkbox.
	 */
	function kindergarten_toys_sanitize_checkbox( $kindergarten_toys_checked ) {

		return ( ( isset( $kindergarten_toys_checked ) && true === $kindergarten_toys_checked ) ? true : false );

	}

endif;


if ( ! function_exists( 'kindergarten_toys_sanitize_select' ) ) :

    /**
     * Sanitize select.
     */
    function kindergarten_toys_sanitize_select( $kindergarten_toys_input, $kindergarten_toys_setting ) {
        $kindergarten_toys_input = sanitize_text_field( $kindergarten_toys_input );
        $choices = $kindergarten_toys_setting->manager->get_control( $kindergarten_toys_setting->id )->choices;
        return ( array_key_exists( $kindergarten_toys_input, $choices ) ? $kindergarten_toys_input : $kindergarten_toys_setting->default );
    }

endif;