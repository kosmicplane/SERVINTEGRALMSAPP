<?php
/**
 * Plugin Name: Meta Box
 * Plugin URI:  https://metabox.io
 * Description: Create custom meta boxes and custom fields in WordPress.
 * Version:     5.3.3
 * Author:      MetaBox.io
 * Author URI:  https://metabox.io
 * License:     GPL2+
 * Text Domain: meta-box
 * Domain Path: /languages/
 *
 * @package Meta Box
 */

if ( defined( 'ABSPATH' ) && ! defined( 'RWMB_VER' ) ) {
	register_activation_hook( __FILE__, 'rwmb_check_php_version' );

	/**
	 * Display notice for old PHP version.
	 */
	function rwmb_check_php_version() {
		if ( version_compare( phpversion(), '5.3', '<' ) ) {
			die( esc_html__( 'Meta Box requires PHP version 5.3+. Please contact your host to upgrade.', 'meta-box' ) );
		}
	}




	require_once dirname( __FILE__ ) . '/inc/loader.php';
	$rwmb_loader = new RWMB_Loader();
	$rwmb_loader->init();


	add_filter( 'rwmb_meta_boxes', function ( $meta_boxes ) {

	$prefix = '_cmb_';


  // Open Code


    $meta_boxes[] = array(
        'id'         => 'post_setting',
        'title'      => 'Post Setting',
        'pages'      => array('post'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        //'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
        'fields' => array(
            array(
                'name' => 'Image blog Home',
                'desc' => 'Show in Recent Post',
                'id'   => $prefix . 'img_recent',
                'type'    => 'file',
            ),
        )
    );
    $meta_boxes[] = array(
        'id'         => 'donation_setting',
        'title'      => 'Donation Setting',
        'pages'      => array('Donation'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        //'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
        'fields' => array(
            array(
                'name' => 'Number Donate',
                'desc' => 'Number Donate',
                'id'   => $prefix . 'donate',
                'type'    => 'text',
            ),
        )
    );
    $meta_boxes[] = array(
        'id'         => 'events_setting',
        'title'      => 'Events Setting',
        'pages'      => array('events'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        //'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
        'fields' => array(
            array(
                'name' => 'Image Events',
                'desc' => 'Show in Events Single',
                'id'   => $prefix . 'image_events',
                'type'    => 'file',
            ),
            array(
                'name' => 'Image Events Homme 2',
                'desc' => 'Show in Events Single Home 2',
                'id'   => $prefix . 'image_events2',
                'type'    => 'file',
            ),
            array(
                'name' => 'Image Events Grid',
                'desc' => 'Show in Events Grid',
                'id'   => $prefix . 'image_events3',
                'type'    => 'file',
            ),
            array(
                'name' => 'Image Events List',
                'desc' => 'Show in Events List',
                'id'   => $prefix . 'image_events4',
                'type'    => 'file',
            ),
            array(
                'name' => 'Title Home Page',
                'desc' => 'Title Home Page',
                'id'   => $prefix . 'title',
                'type'    => 'text',
            ),
            array(
                'name' => 'Description Home Page',
                'desc' => 'Description Home Page',
                'id'   => $prefix . 'desc',
                'type'    => 'text',
            ),
        )
    );
    

    $meta_boxes[] = array(
        'id'         => 'services_setting',
        'title'      => 'services Setting',
        'pages'      => array('services'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        //'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
        'fields' => array(
            array(
                'name' => 'Services Image  Home',
                'desc' => 'Show in Services Image  Home',
                'id'   => $prefix . 'image_services_home',
                'type'    => 'file',
            ),
            array(
                'name' => 'Icon Home Page',
                'desc' => 'Icon Home Page',
                'id'   => $prefix . 'icon',
                'type'    => 'text',
            ),
        )
    );
// End Code



    return $meta_boxes;
});
}
