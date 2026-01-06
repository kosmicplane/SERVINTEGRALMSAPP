<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Business Corporate Agency
 * @subpackage business_corporate_agency
 */

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function business_corporate_agency_categorized_blog() {
	$business_corporate_agency_category_count = get_transient( 'business_corporate_agency_categories' );

	if ( false === $business_corporate_agency_category_count ) {
		// Create an array of all the categories that are attached to posts.
		$categories = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$business_corporate_agency_category_count = business_corporate_agency_count( $categories );

		set_transient( 'business_corporate_agency_categories', $business_corporate_agency_category_count );
	}

	// Allow viewing case of 0 or 1 categories in post preview.
	if ( is_preview() ) {
		return true;
	}

	return $business_corporate_agency_category_count > 1;
}

if ( ! function_exists( 'the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 * @since business_corporate_agency
 */
function the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;

/**
 * Flush out the transients used in business_corporate_agency_categorized_blog.
 */
function business_corporate_agency_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'business_corporate_agency_categories' );
}
add_action( 'edit_category', 'business_corporate_agency_category_transient_flusher' );
add_action( 'save_post',     'business_corporate_agency_category_transient_flusher' );