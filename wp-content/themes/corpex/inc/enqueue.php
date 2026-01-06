<?php
 /**
 * Enqueue scripts and styles.
 */
function corpex_scripts() {
	
	// Styles	
	wp_enqueue_style('bootstrap',get_template_directory_uri().'/assets/css/bootstrap.min.css');	
	wp_enqueue_style('slick.min',get_template_directory_uri().'/assets/css/slick.min.css');	
	wp_enqueue_style('magnific-popup',get_template_directory_uri().'/assets/css/magnific-popup.min.css');	
	wp_enqueue_style('animate',get_template_directory_uri().'/assets/css/animate.min.css');
	wp_enqueue_style('font-awesome',get_template_directory_uri().'/assets/css/fonts/font-awesome/css/all.min.css');
	wp_enqueue_style('main',get_template_directory_uri().'/assets/css/main.css');	
	wp_enqueue_style('widget',get_template_directory_uri().'/assets/css/widget.css');
	wp_enqueue_style('woo',get_template_directory_uri().'/assets/css/woo.css');
	wp_enqueue_style('responsive',get_template_directory_uri().'/assets/css/responsive.css');	
	wp_enqueue_style('editor-style',get_template_directory_uri().'/assets/css/editor-style.css');	
	wp_enqueue_style( 'corpex-style', get_stylesheet_uri() );
	
	// Scripts
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script('bootstrap.bundle.min', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array('jquery'), false, true);
	wp_enqueue_script('imagesloaded-min', get_template_directory_uri() . '/assets/js/imagesloaded.pkgd.min.js', array('jquery'), false, true);
	wp_enqueue_script('isotope.pkgd.min', get_template_directory_uri() . '/assets/js/isotope.pkgd.min.js', array('jquery'), false, true);
	wp_enqueue_script('slick.min', get_template_directory_uri() . '/assets/js/slick.min.js', array('jquery'), false, true);
	wp_enqueue_script('tilt.min', get_template_directory_uri() . '/assets/js/tilt.jquery.min.js', array('jquery'), false, true);
	wp_enqueue_script('magnific-popup.min', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', array('jquery'), false, true);
	wp_enqueue_script('jquery-counterup-min', get_template_directory_uri() . '/assets/js/jquery-counterup-min.js', array('jquery'), false, true);
	wp_enqueue_script('corpex-custom', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), false, true);
	

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'corpex_scripts' );

//Admin Enqueue for Admin
function corpex_admin_enqueue_scripts(){
	wp_enqueue_style('corpex-admin-style', get_template_directory_uri() . '/assets/css/admin-min.css');	
	wp_enqueue_script( 'corpex-admin-script', get_template_directory_uri() . '/assets/js/corpex-admin-script-min.js', array( 'jquery' ), '', true );
	$nonce = wp_create_nonce( 'corpex-ajax-nonce' ); // Generate a nonce and pass it to the JavaScript
    wp_localize_script( 'corpex-admin-script', 'corpex_ajax_object',
		array( 
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'nonce'    => $nonce, 
	));
}
add_action( 'admin_enqueue_scripts', 'corpex_admin_enqueue_scripts' );