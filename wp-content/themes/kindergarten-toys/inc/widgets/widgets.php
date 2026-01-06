<?php
/**
* Widget Functions.
*
* @package Kindergarten Toys
*/

function kindergarten_toys_widgets_init(){

	register_sidebar(array(
	    'name' => esc_html__('Main Sidebar', 'kindergarten-toys'),
	    'id' => 'sidebar-1',
	    'description' => esc_html__('Add widgets here.', 'kindergarten-toys'),
	    'before_widget' => '<div id="%1$s" class="widget %2$s">',
	    'after_widget' => '</div>',
	    'before_title' => '<h3 class="widget-title"><span>',
	    'after_title' => '</span></h3>',
	));

	register_sidebar(array(
	    'name' => esc_html__('Home Page Sidebar', 'kindergarten-toys'),
	    'id' => 'sidebar-2',
	    'description' => esc_html__('Add widgets here.', 'kindergarten-toys'),
	    'before_widget' => '<div id="%1$s" class="widget %2$s">',
	    'after_widget' => '</div>',
	    'before_title' => '<h3 class="widget-title"><span>',
	    'after_title' => '</span></h3>',
	));


    $kindergarten_toys_default = kindergarten_toys_get_default_theme_options();
    $kindergarten_toys_footer_column_layout = absint( get_theme_mod( 'kindergarten_toys_footer_column_layout',$kindergarten_toys_default['kindergarten_toys_footer_column_layout'] ) );

    for( $i = 0; $i < $kindergarten_toys_footer_column_layout; $i++ ){
    	
    	if( $i == 0 ){ $count = esc_html__('One','kindergarten-toys'); }
    	if( $i == 1 ){ $count = esc_html__('Two','kindergarten-toys'); }
    	if( $i == 2 ){ $count = esc_html__('Three','kindergarten-toys'); }

	    register_sidebar( array(
	        'name' => esc_html__('Footer Widget ', 'kindergarten-toys').$count,
	        'id' => 'kindergarten-toys-footer-widget-'.$i,
	        'description' => esc_html__('Add widgets here.', 'kindergarten-toys'),
	        'before_widget' => '<div id="%1$s" class="widget %2$s">',
	        'after_widget' => '</div>',
	        'before_title' => '<h2 class="widget-title">',
	        'after_title' => '</h2>',
	    ));
	}

}

add_action('widgets_init', 'kindergarten_toys_widgets_init');