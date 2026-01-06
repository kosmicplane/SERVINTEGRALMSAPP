<?php
/* Notifications in customizer */


require get_template_directory() . '/inc/customizer-notify/corpex-customizer-notify.php';
$corpex_config_customizer = array(
	'recommended_plugins'       => array(
		'classic-widgets' => array(
			'recommended' => true,
			'description' => sprintf(__('Install and activate <strong>Classic Widget</strong> plugin for taking full advantage of all the features this theme has to offer.', 'corpex')),
		),
		'clever-fox' => array(
			'recommended' => true,
			'description' => sprintf(__('Install and activate <strong>Cleverfox</strong> plugin for taking full advantage of all the features this theme has to offer.', 'corpex')),
		),
	),
	'recommended_actions'       => array(),
	'recommended_actions_title' => esc_html__( 'Recommended Actions', 'corpex' ),
	'recommended_plugins_title' => esc_html__( 'Recommended Plugin', 'corpex' ),
	'install_button_label'      => esc_html__( 'Install and Activate', 'corpex' ),
	'activate_button_label'     => esc_html__( 'Activate', 'corpex' ),
	'corpex_deactivate_button_label'   => esc_html__( 'Deactivate', 'corpex' ),
);
Corpex_Customizer_Notify::init( apply_filters( 'corpex_customizer_notify_array', $corpex_config_customizer ) );
?>