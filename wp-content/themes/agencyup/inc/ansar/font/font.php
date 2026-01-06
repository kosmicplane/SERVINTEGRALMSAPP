<?php
/*--------------------------------------------------------------------*/
/*     Register Google Fonts
/*--------------------------------------------------------------------*/
function agencyup_fonts_url() {
	
    $fonts_url = '';
		
    $font_families = array();
 
	$font_families = array('Rubik:400,500','Fira Sans:400,500,600,700,800');
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

    return $fonts_url;
}
function agencyup_scripts_styles() {
    wp_enqueue_style( 'agencyup-fonts', agencyup_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'agencyup_scripts_styles' );