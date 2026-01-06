<?php
/**
 *
 * Pagination Functions
 *
 * @package Kindergarten Toys
 */

/**
 * Pagination for archive.
 */
function kindergarten_toys_render_posts_pagination() {
    // Get the setting to check if pagination is enabled
    $kindergarten_toys_is_pagination_enabled = get_theme_mod( 'kindergarten_toys_enable_pagination', true );

    // Check if pagination is enabled
    if ( $kindergarten_toys_is_pagination_enabled ) {
        // Get the selected pagination type from the Customizer
        $kindergarten_toys_pagination_type = get_theme_mod( 'kindergarten_toys_theme_pagination_type', 'numeric' );

        // Check if the pagination type is "newer_older" (Previous/Next) or "numeric"
        if ( 'newer_older' === $kindergarten_toys_pagination_type ) :
            // Display "Newer/Older" pagination (Previous/Next navigation)
            the_posts_navigation(
                array(
                    'prev_text' => __( '&laquo; Newer', 'kindergarten-toys' ),  // Change the label for "previous"
                    'next_text' => __( 'Older &raquo;', 'kindergarten-toys' ),  // Change the label for "next"
                    'screen_reader_text' => __( 'Posts navigation', 'kindergarten-toys' ),
                )
            );
        else :
            // Display numeric pagination (Page numbers)
            the_posts_pagination(
                array(
                    'prev_text' => __( '&laquo; Previous', 'kindergarten-toys' ),
                    'next_text' => __( 'Next &raquo;', 'kindergarten-toys' ),
                    'type'      => 'list', // Display as <ul> <li> tags
                    'screen_reader_text' => __( 'Posts navigation', 'kindergarten-toys' ),
                )
            );
        endif;
    }
}
add_action( 'kindergarten_toys_posts_pagination', 'kindergarten_toys_render_posts_pagination', 10 );