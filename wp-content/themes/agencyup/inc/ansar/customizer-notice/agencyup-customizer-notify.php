<?php

class Agencyup_Customizer_Notify {

	private $recommended_actions;

	
	private $recommended_plugins;

	
	private static $instance;

	
	private $recommended_actions_title;

	
	private $recommended_plugins_title;

	
	private $dismiss_button;

	
	private $install_button_label;

	
	private $activate_button_label;

	
	private $agencyup_deactivate_button_label;

	private $config;

	
	public static function init( $config ) {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Agencyup_Customizer_Notify ) ) {
			self::$instance = new Agencyup_Customizer_Notify;
			if ( ! empty( $config ) && is_array( $config ) ) {
				self::$instance->config = $config;
				self::$instance->setup_config();
				self::$instance->setup_actions();
			}
		}

	}

	
	public function setup_config() {

		global $agencyup_customizer_notify_recommended_plugins;
		global $agencyup_customizer_notify_recommended_actions;

		global $install_button_label;
		global $activate_button_label;
		global $agencyup_deactivate_button_label;

		$this->recommended_actions = isset( $this->config['recommended_actions'] ) ? $this->config['recommended_actions'] : array();
		$this->recommended_plugins = isset( $this->config['recommended_plugins'] ) ? $this->config['recommended_plugins'] : array();

		$this->recommended_actions_title = isset( $this->config['recommended_actions_title'] ) ? $this->config['recommended_actions_title'] : '';
		$this->recommended_plugins_title = isset( $this->config['recommended_plugins_title'] ) ? $this->config['recommended_plugins_title'] : '';
		$this->dismiss_button            = isset( $this->config['dismiss_button'] ) ? $this->config['dismiss_button'] : '';

		$agencyup_customizer_notify_recommended_plugins = array();
		$agencyup_customizer_notify_recommended_actions = array();

		if ( isset( $this->recommended_plugins ) ) {
			$agencyup_customizer_notify_recommended_plugins = $this->recommended_plugins;
		}

		if ( isset( $this->recommended_actions ) ) {
			$agencyup_customizer_notify_recommended_actions = $this->recommended_actions;
		}

		$install_button_label    = isset( $this->config['install_button_label'] ) ? $this->config['install_button_label'] : '';
		$activate_button_label   = isset( $this->config['activate_button_label'] ) ? $this->config['activate_button_label'] : '';
		$agencyup_deactivate_button_label = isset( $this->config['agencyup_deactivate_button_label'] ) ? $this->config['agencyup_deactivate_button_label'] : '';

	}

	
	public function setup_actions() {

		// Register the section
		add_action( 'customize_register', array( $this, 'agencyup_plugin_notification_customize_register' ) );

		// Enqueue scripts and styles
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'agencyup_customizer_notify_scripts_for_customizer' ), 0 );

		/* ajax callback for dismissable recommended actions */
		add_action( 'wp_ajax_quality_customizer_notify_dismiss_action', array( $this, 'agencyup_customizer_notify_dismiss_recommended_action_callback' ) );

		add_action( 'wp_ajax_ti_customizer_notify_dismiss_recommended_plugins', array( $this, 'agencyup_customizer_notify_dismiss_recommended_plugins_callback' ) );

	}

	
	public function agencyup_customizer_notify_scripts_for_customizer() {

		wp_enqueue_style( 'agencyup-customizer-notify-css', get_template_directory_uri() . '/inc/ansar/customizer-notice/css/agencyup-customizer-notify.css', array());
		wp_style_add_data( 'agencyup-customizer-notify-css', 'rtl', 'replace' );

		wp_enqueue_style( 'agencyup-plugin-install' );
		wp_enqueue_script( 'agencyup-plugin-install' );
		wp_add_inline_script( 'plugin-install', 'var pagenow = "customizer";' );

		wp_enqueue_script( 'agencyup-updates' );

		wp_enqueue_script( 'agencyup-customizer-notify-js', get_template_directory_uri() . '/inc/ansar/customizer-notice/js/agencyup-customizer-notify.js', array( 'customize-controls' ));
		wp_localize_script(
			'agencyup-customizer-notify-js', 'AgencyupCustomizercompanionObject', array(
				'agencyup_ajaxurl'   => esc_url(admin_url( 'admin-ajax.php' )),
				'template_directory' => esc_url(get_template_directory_uri()),
				'base_path'          => esc_url(admin_url()),
				'activating_string'  => __( 'Activating', 'agencyup' ),
			)
		);

	}

	
	public function agencyup_plugin_notification_customize_register( $wp_customize ) {

		
		require_once get_template_directory() . '/inc/ansar/customizer-notice/agencyup-customizer-notify-section.php';

		$wp_customize->register_section_type( 'Agencyup_Customizer_Notify_Section' );

		$wp_customize->add_section(
			new Agencyup_Customizer_Notify_Section(
				$wp_customize,
				'agencyup-customizer-notify-section',
				array(
					'title'          => $this->recommended_actions_title,
					'plugin_text'    => $this->recommended_plugins_title,
					'dismiss_button' => $this->dismiss_button,
					'priority'       => 0,
				)
			)
		);

	}


		public function agencyup_customizer_notify_dismiss_recommended_action_callback() {

		global $agencyup_customizer_notify_recommended_actions;

		$action_id = ( isset( $_GET['id'] ) ) ? $_GET['id'] : 0;

		echo esc_html($action_id); 

		if ( ! empty( $action_id ) ) {

			
			if ( get_option( 'agencyup_customizer_notify_show' ) ) {

				$agencyup_customizer_notify_show_recommended_actions = get_option( 'agencyup_customizer_notify_show' );
				switch ( $_GET['todo'] ) {
					case 'add':
						$agencyup_customizer_notify_show_recommended_actions[ $action_id ] = true;
						break;
					case 'dismiss':
						$agencyup_customizer_notify_show_recommended_actions[ $action_id ] = false;
						break;
				}
				update_option( 'agencyup_customizer_notify_show', $agencyup_customizer_notify_show_recommended_actions );
				
			} else {
				$agencyup_customizer_notify_show_recommended_actions = array();
				if ( ! empty( $agencyup_customizer_notify_recommended_actions ) ) {
					foreach ( $agencyup_customizer_notify_recommended_actions as $agencyup_lite_customizer_notify_recommended_action ) {
						if ( $agencyup_lite_customizer_notify_recommended_action['id'] == $action_id ) {
							$agencyup_customizer_notify_show_recommended_actions[ $agencyup_lite_customizer_notify_recommended_action['id'] ] = false;
						} else {
							$agencyup_customizer_notify_show_recommended_actions[ $agencyup_lite_customizer_notify_recommended_action['id'] ] = true;
						}
					}
					echo esc_html($agencyup_customizer_notify_show_recommended_actions);
				}
			}
		}
		die(); 
	}

	
	public function agencyup_customizer_notify_dismiss_recommended_plugins_callback() {

		$action_id = ( isset( $_GET['id'] ) ) ? $_GET['id'] : 0;

		echo esc_html($action_id); 

		if ( ! empty( $action_id ) ) {

			$agencyup_lite_customizer_notify_show_recommended_plugins = get_option( 'agencyup_customizer_notify_show_recommended_plugins' );

			switch ( $_GET['todo'] ) {
				case 'add':
					$agencyup_lite_customizer_notify_show_recommended_plugins[ $action_id ] = false;
					break;
				case 'dismiss':
					$agencyup_lite_customizer_notify_show_recommended_plugins[ $action_id ] = true;
					break;
			}
			update_option( 'agencyup_customizer_notify_show_recommended_plugins', $agencyup_lite_customizer_notify_show_recommended_plugins );
		}
		die(); 
	}

}