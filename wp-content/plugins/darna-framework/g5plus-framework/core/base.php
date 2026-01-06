<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

if (!function_exists('g5plus_install_demo_data_generate_less')) {
	function g5plus_install_demo_data_generate_less() {
		require_once( PLUGIN_G5PLUS_FRAMEWORK_DIR . 'g5plus-framework/core/generate-less.php' );
		$gen_css = g5plus_generate_less();
		if ($gen_css['status'] == 'error') {
			ob_end_clean();

			$data_response = array(
				'code' => 'done',
				'message' => $gen_css['message']
			);
			echo json_encode($data_response);
			die();
		}
	}
	add_action('g5plus_install_demo_data_done','g5plus_install_demo_data_generate_less');
}


if (!function_exists('g5plus_redux_generate_less')) {
	function g5plus_redux_generate_less($success) {
		// Save & Generate LESS to CSS
		require_once PLUGIN_G5PLUS_FRAMEWORK_DIR . 'g5plus-framework/core/generate-less.php';
		$gen_css = g5plus_generate_less();
		if ($gen_css['status'] == 'error') {
			$error = array( 'status' => $gen_css['message'] );
			echo json_encode( $error );
		}
		else {
			echo json_encode( $success );
		}
	}
	add_action('redux/generate_less_to_css','g5plus_redux_generate_less');
}

/*================================================
MAINTENANCE MODE
================================================== */
if (!function_exists('g5plus_maintenance_mode')) {
	function g5plus_maintenance_mode() {

		if (current_user_can( 'edit_themes' ) || is_user_logged_in()) {
			return;
		}

		global $g5plus_darna_options;
		$enable_maintenance = isset($g5plus_darna_options['enable_maintenance']) ? $g5plus_darna_options['enable_maintenance'] : 0;

		switch ($enable_maintenance) {
			case 1 :
				wp_die( '<p style="text-align:center">' . esc_html__( 'We are currently in maintenance mode, please check back shortly.', 'g5plus-darna' ) . '</p>', get_bloginfo( 'name' ) );
				break;
			case 2:
				$maintenance_mode_page = $g5plus_darna_options['maintenance_mode_page'];
				if (empty($maintenance_mode_page)) {
					wp_die( '<p style="text-align:center">' . esc_html__( 'We are currently in maintenance mode, please check back shortly.', 'g5plus-darna' ) . '</p>', get_bloginfo( 'name' ) );
				} else {
					$maintenance_mode_page_url = get_permalink($maintenance_mode_page);
					$current_page_url = g5plus_current_page_url();
					if ($maintenance_mode_page_url != $current_page_url) {
						wp_redirect($maintenance_mode_page_url);
					}
				}
				break;
		}
	}
	add_action( 'get_header', 'g5plus_maintenance_mode' );
}

/*================================================
GET CURRENT PAGE URL
================================================== */
if (!function_exists('g5plus_current_page_url')) {
	function g5plus_current_page_url() {
		$pageURL = 'http';
		if ( isset( $_SERVER["HTTPS"] ) ) {
			if ( $_SERVER["HTTPS"] == "on" ) {
				$pageURL .= "s";
			}
		}
		$pageURL .= "://";
		if ( $_SERVER["SERVER_PORT"] != "80" ) {
			$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
		}

		return $pageURL;
	}
}

add_action( 'admin_bar_menu', 'xmenu_add_toolbar_items', 100 );
function xmenu_get_toolbar_icon($icon_name) {
	return '<i class="fa fa-'. esc_attr($icon_name) . '"></i>';
}
function xmenu_add_toolbar_items($admin_bar) {
	if( !current_user_can( 'manage_options' ) ) return;

	$admin_bar->add_node( array(
		'id'    => 'xmenutoolbar',
		'title' => '<span class="ab-icon"></span><span>' . __('XMEMU','g5plus-darna') . '</span>',
		'href'  => admin_url( 'themes.php?page=xmenu-settings' ),
		'meta'  => array(
			'title' => esc_html__( 'XMenu' , 'g5plus-darna' ),
		),
	));

	$admin_bar->add_node( array(
		'id'    => 'xmenu_settings',
		'parent' => 'xmenutoolbar',
		'title' => esc_html__( 'XMENU Settings' , 'g5plus-darna' ),
		'href'  => admin_url( 'themes.php?page=xmenu-settings' )
	));

	$admin_bar->add_node( array(
		'id'    => 'xmenu_menu_edit',
		'parent' => 'xmenutoolbar',
		'title' => esc_html__( 'Edit Menus' , 'g5plus-darna' ),
		'href'  => admin_url( 'nav-menus.php' )
	));
	$menus = wp_get_nav_menus( array('orderby' => 'name') );
	foreach( $menus as $menu ){
		$admin_bar->add_node( array(
			'id'    	=> 'xmenu_menu_edit_'.$menu->slug,
			'parent' 	=> 'xmenu_menu_edit',
			'title' 	=> $menu->name,
			'href'  	=> admin_url( 'nav-menus.php?action=edit&menu='.$menu->term_id ),
			'meta'  	=> array(
				'title' => esc_html__('Configure' , 'g5plus-darna' ) . ' '. $menu->name,
				'target' => '_blank',
				'class' => ''
			),
		));
	}

	$admin_bar->add_node( array(
		'id'    => 'xmenu_menu_assign',
		'parent' => 'xmenutoolbar',
		'title' => esc_html__( 'Assign Menus' , 'g5plus-darna' ),
		'href'  => admin_url( 'nav-menus.php?action=locations' )
	));
}

function g5plus_xmenu_generate_css_file($option_key,$settings) {

	try {
		$regex = array(
			"`^([\t\s]+)`ism"                       => '',
			"`^\/\*(.+?)\*\/`ism"                   => "",
			"`([\n\A;]+)\/\*(.+?)\*\/`ism"          => "$1",
			"`([\n\A;\s]+)//(.+?)[\n\r]`ism"        => "$1\n",
			"`(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+`ism" => "\n"
		);
		$css = '';
		$responsive_breakpoint = 991;
		/*if (isset($settings['setting-responsive-breakpoint']) && !empty($settings['setting-responsive-breakpoint']) && is_numeric($settings['setting-responsive-breakpoint'])) {
			$responsive_breakpoint = $settings['setting-responsive-breakpoint'];
		}*/

		$animation_duration = '.5s';
		if (isset($settings['transition-duration']) && !empty($settings['transition-duration'])) {
			$animation_duration = $settings['transition-duration'];
		}

		$css .= '@x_nav_menu_slug:' . (empty($option_key) ? '' : 'x-nav-menu' . $option_key) . ';';
		$css .= '@x_nav_menu_dot:'. (empty($option_key) ? '': '.') .';';
		$css .= '@responsive_breakpoint:'. $responsive_breakpoint . 'px;';
		$css .= '@animation_duration:' . $animation_duration . ';';

		require_once PLUGIN_G5PLUS_FRAMEWORK_DIR . 'g5plus-framework/less/Less.php';
		WP_Filesystem();
		global $wp_filesystem;
		$options = array( 'compress'=>true );
		$parser = new Less_Parser($options);
		$parser->parse($css);
		$parser->parseFile(XMENU_DIR . 'assets/css/style.less');
		$css = $parser->getCss();
		$css   = preg_replace( array_keys( $regex ), $regex, $css );
		$wp_filesystem->put_contents( XMENU_DIR .   'assets/css/style' . $option_key . '.css', $css, FS_CHMOD_FILE);
	}
	catch (Exception $e) {
		?>
		<div class="error">
			<?php esc_html_e('Caught exception:','g5plus-darna') . esc_html($e->getMessage()) ?>
		</div>
		<?php
	}
}
add_action('xmenu_setting_save','g5plus_xmenu_generate_css_file',10,2);