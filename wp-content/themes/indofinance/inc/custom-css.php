<?php
/**
 * File to load PHP dependent CSS styles
 */
function indofinance_custom_css() {
    $css = '';

    $sticky             = get_theme_mod('indofinance-sticky-sidebar_set');
    $footer_parallax    = get_theme_mod('indofinance_footer_parallax_effect', '');

    if (!empty($sticky)) {
        $css .= '@media (min-width: 968px) { 
            .theme-sidebar {
                position: -webkit-sticky; /* For Safari */
                position: sticky;
                top: 0;
                height: fit-content;
            }
        }';
    }
    

    if (!empty($footer_parallax)) {
        $css .= '#footer-widgets { background-attachment: fixed; }';
    }

    wp_add_inline_style( 'indofinance-main-css', $css );
}
add_action('wp_enqueue_scripts', 'indofinance_custom_css', 15);