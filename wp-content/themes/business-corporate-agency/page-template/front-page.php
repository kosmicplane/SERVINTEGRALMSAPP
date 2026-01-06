<?php
/**
 * Template Name: Custom Home Page
 *
 * @package Business Corporate Agency
 * @subpackage business_corporate_agency
 */

get_header(); ?>

<main id="tp_content" role="main">
	<div>
		<?php do_action('business_corporate_agency_before_slider'); ?>
		<?php get_template_part('template-parts/home/slider'); ?>
		<?php do_action('business_corporate_agency_after_slider'); ?>
	</div>
	<div>
		<?php get_template_part('template-parts/home/about-us'); ?>
		<?php do_action('business_corporate_agency_after_about_us'); ?>
		<?php get_template_part('template-parts/home/home-content'); ?>
		<?php do_action('business_corporate_agency_after_home_content'); ?>
	</div>
</main>

<?php get_footer(); ?>