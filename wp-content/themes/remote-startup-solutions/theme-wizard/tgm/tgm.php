<?php require get_template_directory() . '/theme-wizard/tgm/class-tgm-plugin-activation.php';

function remote_startup_solutions_register_recommended_plugins() {
	$plugins = array(
		array(
			'name'             => __( 'Classic Widgets', 'remote-startup-solutions' ),
			'slug'             => 'classic-widgets',
			'source'           => '',
			'required'         => false,
			'force_activation' => false,
		),
	);
	$config = array();
	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'remote_startup_solutions_register_recommended_plugins' );