<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/1/2015
 * Time: 10:27 AM
 */
/*================================================
HEAD META
================================================== */
if (!function_exists('g5plus_head_meta')) {
	function g5plus_head_meta() {
		g5plus_get_template('head-meta');
	}
	add_action('wp_head','g5plus_head_meta',0);
}

/*================================================
SOCIAL META
================================================== */
if (!function_exists('g5plus_social_meta')) {
	function g5plus_social_meta() {
		g5plus_get_template('social-meta');
	}
	add_action( 'wp_head', 'g5plus_social_meta', 5 );
}

