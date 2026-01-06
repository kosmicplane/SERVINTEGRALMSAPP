<?php
if (!function_exists('g5plus_framework_register_sidebar')) {
    function g5plus_framework_register_sidebar() {
        register_sidebar( array(
            'name'          => __("Sidebar 2",'g5plus-darna'),
            'id'            => 'sidebar-2',
            'description'   => __("Widget Area 2",'g5plus-darna'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="widget-title"><span>',
            'after_title'   => '</span></h4>',
        ) );

        register_sidebar( array(
            'name'          => __("Top Drawer",'g5plus-darna'),
            'id'            => 'top_drawer_sidebar',
            'description'   => __("Top Drawer",'g5plus-darna'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="widget-title"><span>',
            'after_title'   => '</span></h4>',
        ));

	    register_sidebar( array(
		    'name'          => __("Footer Above",'g5plus-darna'),
		    'id'            => 'footer-above',
		    'description'   => __("Footer above",'g5plus-darna'),
		    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		    'after_widget'  => '</aside>',
		    'before_title'  => '<h4 class="widget-title"><span>',
		    'after_title'   => '</span></h4>',
	    ) );

        register_sidebar( array(
            'name'          => __("Footer 1",'g5plus-darna'),
            'id'            => 'footer-1',
            'description'   => __("Footer 1",'g5plus-darna'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="widget-title"><span>',
            'after_title'   => '</span></h4>',
        ) );

        register_sidebar( array(
            'name'          => __("Footer 2",'g5plus-darna'),
            'id'            => 'footer-2',
            'description'   => __("Footer 2",'g5plus-darna'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="widget-title"><span>',
            'after_title'   => '</span></h4>',
        ) );

        register_sidebar( array(
            'name'          => __("Footer 3",'g5plus-darna'),
            'id'            => 'footer-3',
            'description'   => __("Footer 3",'g5plus-darna'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="widget-title"><span>',
            'after_title'   => '</span></h4>',
        ) );

        register_sidebar( array(
            'name'          => __("Footer 4",'g5plus-darna'),
            'id'            => 'footer-4',
            'description'   => __("Footer 4",'g5plus-darna'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="widget-title"><span>',
            'after_title'   => '</span></h4>',
        ) );

        register_sidebar( array(
            'name'          => __("Bottom Bar Left",'g5plus-darna'),
            'id'            => 'bottom_bar_left',
            'description'   => __("Bottom Bar Left",'g5plus-darna'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="widget-title"><span>',
            'after_title'   => '</span></h4>',
        ) );

        register_sidebar( array(
            'name'          => __("Bottom Bar Right",'g5plus-darna'),
            'id'            => 'bottom_bar_right',
            'description'   => __("Bottom Bar Right",'g5plus-darna'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="widget-title"><span>',
            'after_title'   => '</span></h4>',
        ) );

        register_sidebar( array(
            'name'          => __("Woocommerce",'g5plus-darna'),
            'id'            => 'woocommerce',
            'description'   => __("Woocommerce",'g5plus-darna'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="widget-title"><span>',
            'after_title'   => '</span></h4>',
        ) );

	    register_sidebar( array(
		    'name'          => __("Top Bar Left",'g5plus-darna'),
		    'id'            => 'top_bar_left',
		    'description'   => __("Top Bar Left",'g5plus-darna'),
		    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		    'after_widget'  => '</aside>',
		    'before_title'  => '<h4 class="widget-title"><span>',
		    'after_title'   => '</span></h4>',
	    ) );

        register_sidebar( array(
            'name'          => __("Top Bar Right",'g5plus-darna'),
            'id'            => 'top_bar_right',
            'description'   => __("Top Bar Right",'g5plus-darna'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="widget-title"><span>',
            'after_title'   => '</span></h4>',
        ) );

    }
    add_action( 'widgets_init', 'g5plus_framework_register_sidebar',11 );
}

if (!function_exists('g5plus_redux_custom_widget_area_filter')) {
    function g5plus_redux_custom_widget_area_filter($arg) {
        return array(
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>'
        );
    }
    add_filter('redux_custom_widget_args','g5plus_redux_custom_widget_area_filter');
}

