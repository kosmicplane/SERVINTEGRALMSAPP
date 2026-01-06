<?php
/*
 *  Customizer Notifications
 */
require get_template_directory() . '/inc/customizer/customizer-plugin-notice/atua-customizer-notify.php';
$atua_config_customizer = array(
    'recommended_plugins' => array( 
        'desert-companion' => array(
            'recommended' => true,
            'description' => sprintf( 
                /* translators: %s: plugin name */
                esc_html__( 'If you want to show all the features and sections of the Theme. please install and activate %s plugin', 'atua' ), '<strong>Desert Companion</strong>' 
            ),
        ),
    ),
	'recommended_actions'       => array(),
	'recommended_actions_title' => esc_html__( 'Recommended Actions', 'atua' ),
	'recommended_plugins_title' => esc_html__( 'Recommended Plugin', 'atua' ),
	'install_button_label'      => esc_html__( 'Install and Activate', 'atua' ),
	'activate_button_label'     => esc_html__( 'Activate', 'atua' ),
	'atua_deactivate_button_label'   => esc_html__( 'Deactivate', 'atua' ),
);
Atua_Customizer_Notify::init( apply_filters( 'atua_customizer_notify_array', $atua_config_customizer ) );