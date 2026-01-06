<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/1/2015
 * Time: 10:39 AM
 */
/*================================================
GET TEMPLATE
================================================== */
if (!function_exists('g5plus_get_template')) {
	function g5plus_get_template($template, $name = null){
		get_template_part( 'templates/' . $template, $name);
	}
}

/*================================================
GET POST META
================================================== */
if ( !function_exists( 'g5plus_get_post_meta' ) ) {
	function g5plus_get_post_meta( $id, $key = "", $single = false ) {

		$GLOBALS['g5plus_post_meta'] = isset( $GLOBALS['g5plus_post_meta'] ) ? $GLOBALS['g5plus_post_meta'] : array();
		if ( ! isset( $id ) ) {
			return;
		}
		if ( ! is_array( $id ) ) {
			if ( ! isset( $GLOBALS['g5plus_post_meta'][ $id ] ) ) {
				//$GLOBALS['g5plus_post_meta'][ $id ] = array();
				$GLOBALS['g5plus_post_meta'][ $id ] = get_post_meta( $id );
			}
			if ( ! empty( $key ) && isset( $GLOBALS['g5plus_post_meta'][ $id ][ $key ] ) && ! empty( $GLOBALS['g5plus_post_meta'][ $id ][ $key ] ) ) {
				if ( $single ) {
					return maybe_unserialize( $GLOBALS['g5plus_post_meta'][ $id ][ $key ][0] );
				} else {
					return array_map( 'maybe_unserialize', $GLOBALS['g5plus_post_meta'][ $id ][ $key ] );
				}
			}

			if ( $single ) {
				return '';
			} else {
				return array();
			}

		}

		return get_post_meta( $id, $key, $single );
	}
}

/* GET USER MENU LIST
    ================================================== */
if ( !function_exists( 'g5plus_get_menu_list' ) ){
	function g5plus_get_menu_list() {

		if ( !is_admin() ) {
			return array();
		}

		$user_menus = get_categories(array('taxonomy' => 'nav_menu', 'hide_empty' => false ) );

		$menu_list = array();

		foreach ( $user_menus as $menu ) {
			$menu_list[ $menu->term_id ] = $menu->name;
		}

		return $menu_list;
	}
}

/* CHECK IS BLOG PAGE
    ================================================== */
if ( !function_exists( 'g5plus_is_blog_page' ) ){
	function g5plus_is_blog_page() {
		global $post;

		//Post type must be 'post'.
		$post_type = get_post_type($post);

		return (
			( is_home() || is_archive() || is_single() )
			&& ($post_type == 'post')
		) ? true : false ;
	}
}



