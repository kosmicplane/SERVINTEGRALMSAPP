<?php
/**
 * Atua Customizer Class
 *
 * @package Atua
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

 if ( ! class_exists( 'Atua_Customizer' ) ) :

	class Atua_Customizer {

		// Constructor customizer
		public function __construct() {
			add_action( 'customize_register',array( $this, 'atua_customizer_register' ) );
			add_action( 'customize_register',array( $this, 'atua_customizer_sainitization_selective_refresh' ) );
			add_action( 'customize_register',array( $this, 'atua_customizer_control' ) );
			add_action( 'customize_preview_init',array( $this, 'atua_customize_preview_js' ) );
			add_action( 'customize_controls_enqueue_scripts',array( $this, 'atua_customizer_navigation_script' ) );
			add_action( 'after_setup_theme',array( $this, 'atua_customizer_settings' ) );
		}
		
		/**
		 * Add postMessage support for site title and description for the Theme Customizer.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public function atua_customizer_register( $wp_customize ) {
			
			$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
			$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
			$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
			$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
			$wp_customize->get_setting('custom_logo')->transport = 'refresh';
		}
		
		// Register custom controls
		public function atua_customizer_control( $wp_customize ) {
			
			$atua_control_dir =  ATUA_THEME_INC_DIR . '/customizer/controls';
			
			// Load custom control classes.
			$wp_customize->register_control_type( 'Atua_Customizer_Range_Control' );
			require $atua_control_dir . '/code/atua-slider-control.php';
			require $atua_control_dir . '/code/editor/class/class-atua-page-editor.php';

		}
		
		// selective refresh.
		public function atua_customizer_sainitization_selective_refresh() {

			require ATUA_THEME_INC_DIR . '/customizer/sanitization.php';

		}

		// Theme Customizer preview reload changes asynchronously.
		public function atua_customize_preview_js() {
			wp_enqueue_script( 'atua-customizer', ATUA_THEME_INC_URI . '/customizer/assets/js/customizer-preview.js', array( 'customize-preview' ), ATUA_THEME_VERSION, true );
		}
		
		public function atua_customizer_navigation_script() {
			 wp_enqueue_script( 'atua-customizer-section', ATUA_THEME_INC_URI .'/customizer/assets/js/customizer-section.js', array("jquery"),'', true  );	
		}
		

		// Include customizer settings.
			
		public function atua_customizer_settings() {
			// Recommended Plugin
			require ATUA_THEME_INC_DIR . '/customizer/customizer-plugin-notice/atua-notify-plugin.php';
			
			// Upsale
			require ATUA_THEME_INC_DIR . '/customizer/controls/code/upgrade/class-customize.php';
			
			$atua_customize_dir =  ATUA_THEME_INC_DIR . '/customizer/customizer-settings';
			require $atua_customize_dir . '/atua-header-customize-setting.php';
			require $atua_customize_dir . '/atua-footer-customize-setting.php';
			require $atua_customize_dir . '/atua-theme-customize-setting.php';
			require $atua_customize_dir . '/atua-typography-customize-setting.php';
			require ATUA_THEME_INC_DIR . '/customizer/atua-selective-partial.php';
			require ATUA_THEME_INC_DIR . '/customizer/atua-selective-refresh.php';
		}

	}
endif;
new Atua_Customizer();