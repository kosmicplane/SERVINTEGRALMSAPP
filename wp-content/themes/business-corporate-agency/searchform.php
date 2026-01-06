<?php
/**
 * Template for displaying search forms in Business Corporate Agency
 *
 * @package Business Corporate Agency
 * @subpackage business_corporate_agency
 */
?>

<?php $business_corporate_agency_unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">	
	<input type="search" id="<?php echo esc_attr( $business_corporate_agency_unique_id ); ?>" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'business-corporate-agency' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="search-submit"><?php echo esc_html_x( 'Search', 'submit button', 'business-corporate-agency' ); ?></button>
</form>