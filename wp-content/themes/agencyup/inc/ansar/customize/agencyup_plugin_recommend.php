<?php
/* Notify in customizer */
require get_template_directory() . '/inc/ansar/customizer-notice/agencyup-customizer-notify.php';

$config_customizer = array(
	'recommended_plugins'       => array(
		'icyclub' => array(
			'recommended' => true,
			'description' => sprintf('Activate by installing <strong>ICYCLUB</strong> plugin to use front page and all theme features %s.', 'agencyup'),
		),
	),
	'recommended_actions'       => array(),
	'recommended_actions_title' => esc_html__( 'Recommended Actions', 'agencyup' ),
	'recommended_plugins_title' => esc_html__( 'Recommended Plugin', 'agencyup' ),
	'install_button_label'      => esc_html__( 'Install and Activate', 'agencyup' ),
	'activate_button_label'     => esc_html__( 'Activate', 'agencyup' ),
	'deactivate_button_label'   => esc_html__( 'Deactivate', 'agencyup' ),
);
Agencyup_Customizer_Notify::init( apply_filters( 'agencyup_customizer_notify_array', $config_customizer ) );