<?php
if (!function_exists('g5plus_register_sidebar')) {
    function g5plus_register_sidebar() {
        register_sidebar( array(
            'name'          => esc_html__("Sidebar 1",'g5plus-darna'),
            'id'            => 'sidebar-1',
            'description'   => esc_html__("Widget Area 1",'g5plus-darna'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="widget-title"><span>',
            'after_title'   => '</span></h4>',
        ) );
    }
    add_action( 'widgets_init', 'g5plus_register_sidebar' );
}
