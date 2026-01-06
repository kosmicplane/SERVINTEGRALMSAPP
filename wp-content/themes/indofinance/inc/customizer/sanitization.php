<?php
/**
 * Sanitization functions
 */

 //radio box sanitization function
 function indofinance_sanitize_radio( $input, $setting ){
          
    //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
    $input = sanitize_key($input);

    //get the list of possible radio box options 
    $choices = $setting->manager->get_control( $setting->id )->choices;
                      
    //return input if valid or return default option
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );                
      
}

/**
 * Sanitize Checkbox Control
 */
function indofinance_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}

/**
 * Sanitize Social Media URLs
 */
function indofinance_sanitize_social( $input ) {
	$social_networks = array(
				'none' ,
				'facebook-alt',
				'twitter',
				'instagram',
                'linkedin',
				'youtube'
			);
	if ( in_array($input, $social_networks) )
		return $input;
	else
		return '';
}

/**
 * Sanitize Select Customizer Control
 */
function indofinance_sanitize_select( $input, $setting ) {

    //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
    $input = sanitize_key($input);

    //get the list of possible select options
    $choices = $setting->manager->get_control( $setting->id )->choices;

    //return input if valid or return default option
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

}

// Sanize Color Control
function indofinance_sanitize_hex_color( $hex_color, $setting ) {
    // Sanitize $input as a hex value without the hash prefix.
    $hex_color = sanitize_hex_color( $hex_color );
  
    // If $input is a valid hex value, return it; otherwise, return the default.
    return ( ! null( $hex_color ) ? $hex_color : $setting->default );
}