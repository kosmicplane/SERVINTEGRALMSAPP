<?php

class Corpex_Customizer_Notify {

	private $recommended_actions;

	
	private $recommended_plugins;

	
	private static $instance;

	
	private $recommended_actions_title;

	
	private $recommended_plugins_title;

	
	private $dismiss_button;

	
	private $install_button_label;

	
	private $activate_button_label;

	
	private $corpex_deactivate_button_label;
	
	
	private $config;

	
	public static function init( $config ) {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Corpex_Customizer_Notify ) ) {
			self::$instance = new Corpex_Customizer_Notify;
			if ( ! empty( $config ) && is_array( $config ) ) {
				self::$instance->config = $config;
				self::$instance->setup_config();
				self::$instance->setup_actions();
			}
		}

	}

	
	public function setup_config() {

		global $corpex_customizer_notify_recommended_plugins;
		global $corpex_customizer_notify_recommended_actions;

		global $install_button_label;
		global $activate_button_label;
		global $corpex_deactivate_button_label;

		$this->recommended_actions = isset( $this->config['recommended_actions'] ) ? $this->config['recommended_actions'] : array();
		$this->recommended_plugins = isset( $this->config['recommended_plugins'] ) ? $this->config['recommended_plugins'] : array();

		$this->recommended_actions_title = isset( $this->config['recommended_actions_title'] ) ? $this->config['recommended_actions_title'] : '';
		$this->recommended_plugins_title = isset( $this->config['recommended_plugins_title'] ) ? $this->config['recommended_plugins_title'] : '';
		$this->dismiss_button            = isset( $this->config['dismiss_button'] ) ? $this->config['dismiss_button'] : '';

		$corpex_customizer_notify_recommended_plugins = array();
		$corpex_customizer_notify_recommended_actions = array();

		if ( isset( $this->recommended_plugins ) ) {
			$corpex_customizer_notify_recommended_plugins = $this->recommended_plugins;
		}

		if ( isset( $this->recommended_actions ) ) {
			$corpex_customizer_notify_recommended_actions = $this->recommended_actions;
		}

		$install_button_label    = isset( $this->config['install_button_label'] ) ? $this->config['install_button_label'] : '';
		$activate_button_label   = isset( $this->config['activate_button_label'] ) ? $this->config['activate_button_label'] : '';
		$corpex_deactivate_button_label = isset( $this->config['corpex_deactivate_button_label'] ) ? $this->config['corpex_deactivate_button_label'] : '';

	}

	
	public function setup_actions() {

		// Register the section
		add_action( 'customize_register', array( $this, 'corpex_plugin_notification_customize_register' ) );

		// Enqueue scripts and styles
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'corpex_customizer_notify_scripts_for_customizer' ), 0 );

		/* ajax callback for dismissable recommended actions */
		add_action( 'wp_ajax_quality_customizer_notify_dismiss_action', array( $this, 'corpex_customizer_notify_dismiss_recommended_action_callback' ) );

		add_action( 'wp_ajax_ti_customizer_notify_dismiss_recommended_plugins', array( $this, 'corpex_customizer_notify_dismiss_recommended_plugins_callback' ) );

	}

	
	public function corpex_customizer_notify_scripts_for_customizer() {

		wp_enqueue_style( 'corpex-customizer-notify-css', get_template_directory_uri() . '/inc/customizer-notify/css/corpex-customizer-notify.css', array());

		wp_enqueue_style( 'corpex-plugin-install' );
		wp_enqueue_script( 'corpex-plugin-install' );
		wp_add_inline_script( 'corpex-plugin-install', 'var pagenow = "customizer";' );

		wp_enqueue_script( 'corpex-updates' );

		wp_enqueue_script( 'corpex-customizer-notify-js', get_template_directory_uri() . '/inc/customizer-notify/js/corpex-customizer-notify.js', array( 'customize-controls' ));
		wp_localize_script(
			'corpex-customizer-notify-js', 'CorpexCustomizercompanionObject', array(
				'corpex_ajaxurl'            => esc_url(admin_url( 'admin-ajax.php' )),
				'corpex_template_directory' => esc_url(get_template_directory_uri()),
				'corpex_base_path'          => esc_url(admin_url()),
				'corpex_activating_string'  => __( 'Activating', 'corpex' ),
			)
		);

	}

	
	public function corpex_plugin_notification_customize_register( $wp_customize ) {

		
		require_once get_template_directory() . '/inc/customizer-notify/corpex-customizer-notify-section.php';

		$wp_customize->register_section_type( 'Corpex_Customizer_Notify_Section' );

		$wp_customize->add_section(
			new Corpex_Customizer_Notify_Section(
				$wp_customize,
				'Corpex-customizer-notify-section',
				array(
					'title'          => $this->recommended_actions_title,
					'plugin_text'    => $this->recommended_plugins_title,
					'dismiss_button' => $this->dismiss_button,
					'priority'       => 0,
				)
			)
		);

	}

	
	public function corpex_customizer_notify_dismiss_recommended_action_callback() {

		global $corpex_customizer_notify_recommended_actions;

		$action_id = ( isset( $_GET['id'] ) ) ? $_GET['id'] : 0;

		echo esc_html($action_id); 

		if ( ! empty( $action_id ) ) {
			
			if ( get_theme_mod( 'corpex_customizer_notify_show' ) ) {

				$corpex_customizer_notify_show_recommended_actions = get_theme_mod( 'corpex_customizer_notify_show' );
				switch ( $_GET['todo'] ) {
					case 'add':
						$corpex_customizer_notify_show_recommended_actions[ $action_id ] = true;
						break;
					case 'dismiss':
						$corpex_customizer_notify_show_recommended_actions[ $action_id ] = false;
						break;
				}
				echo esc_html($corpex_customizer_notify_show_recommended_actions);
				
			} else {
				$corpex_customizer_notify_show_recommended_actions = array();
				if ( ! empty( $corpex_customizer_notify_recommended_actions ) ) {
					foreach ( $corpex_customizer_notify_recommended_actions as $corpex_lite_customizer_notify_recommended_action ) {
						if ( $corpex_lite_customizer_notify_recommended_action['id'] == $action_id ) {
							$corpex_customizer_notify_show_recommended_actions[ $corpex_lite_customizer_notify_recommended_action['id'] ] = false;
						} else {
							$corpex_customizer_notify_show_recommended_actions[ $corpex_lite_customizer_notify_recommended_action['id'] ] = true;
						}
					}
					echo esc_html($corpex_customizer_notify_show_recommended_actions);
				}
			}
		}
		die(); 
	}

	
	public function corpex_customizer_notify_dismiss_recommended_plugins_callback() {

		$action_id = ( isset( $_GET['id'] ) ) ? $_GET['id'] : 0;

		echo esc_html($action_id); 

		if ( ! empty( $action_id ) ) {
		// Get the list of dismissed plugin IDs from the options table
        $dismissed_plugins = get_option( 'corpex_customizer_notify_dismissed_plugins', array() );		

			switch ( $_GET['todo'] ) {
            case 'add':
                // Remove the plugin ID from the dismissed list when re-added
                if ( isset( $dismissed_plugins[ $action_id ] ) ) {
                    unset( $dismissed_plugins[ $action_id ] );
                    update_option( 'corpex_customizer_notify_dismissed_plugins', $dismissed_plugins );
                }
                break;
            case 'dismiss':
                // Add the plugin ID to the dismissed list
                if ( ! isset( $dismissed_plugins[ $action_id ] ) ) {
                    $dismissed_plugins[ $action_id ] = true;
                    update_option( 'corpex_customizer_notify_dismissed_plugins', $dismissed_plugins );
                }
                break;
			}
		}
		die(); 
	}
}
