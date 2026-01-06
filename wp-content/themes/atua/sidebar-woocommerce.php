<?php 
/**
 * The sidebar containing the woocommerce widget area
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Atua
 */
 
if ( ! is_active_sidebar( 'atua-woocommerce-sidebar' ) ) {	return; } ?>
<div class="dt-col-lg-4 dt-col-md-12 dt-col-12">
	<div class="dt_widget-area">
		<?php dynamic_sidebar('atua-woocommerce-sidebar'); ?>
	</div>
</div>