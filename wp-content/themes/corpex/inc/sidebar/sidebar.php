<?php	
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package corpex
 */


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

function corpex_widgets_init() {	
	register_sidebar( array(
		'name' => __( 'Sidebar Widget Area', 'corpex' ),
		'id' => 'corpex-sidebar-primary',
		'description' => __( 'The Primary Widget Area', 'corpex' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h2 class="widget-title"><span></span>',
		'after_title' => '</h2>',
	) );	
	 
	register_sidebar( array(
		'name' => __( 'Footer', 'corpex' ),
		'id' => 'corpex-footer-widget',
		'description' => __( 'The Footer Widget Area', 'corpex' ),
		'before_widget' => ' <div id="%1$s" class="col-lg-3 col-md-6"><div class="footer-item"><aside class="widget widget_block ">',
		'after_widget' => '</aside></div></div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) ); 
	
	register_sidebar( array(
		'name' => __( 'WooCommerce Widget Area', 'corpex' ),
		'id' => 'corpex-woocommerce-sidebar',
		'description' => __( 'This Widget Area For WooCommerce Widget', 'corpex' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );
}
add_action( 'widgets_init', 'corpex_widgets_init' );