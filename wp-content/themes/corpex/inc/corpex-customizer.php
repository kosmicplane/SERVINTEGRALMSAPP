<?php
/**
 * Corpex Theme Customizer.
 *
 * @package Corpex
 */

 if ( ! class_exists( 'Corpex_Customizer' ) ) {

	/**
	 * Customizer Loader
	 *
	 * @since 1.0.0
	 */
	class Corpex_Customizer {

		/**
		 * Instance
		 *
		 * @access private
		 * @var object
		 */
		private static $instance;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {
			/**
			 * Customizer
			 */
			add_action( 'customize_preview_init',                  array( $this, 'corpex_customize_preview_js' ) );
			add_action( 'customize_controls_enqueue_scripts', 	   array( $this, 'corpex_customizer_script' ) );
			add_action( 'after_setup_theme',                       array( $this, 'corpex_customizer_settings' ) );
			add_action( 'customize_register',                      array( $this, 'corpex_customizer_register' ) );
		}
		
		/**
		 * Add postMessage support for site title and description for the Theme Customizer.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		function corpex_customizer_register( $wp_customize ) {
			
			$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
			$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
			$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
			$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
			$wp_customize->get_setting('custom_logo')->transport = 'refresh';

			/**
			 * Helper files
			 */
			require CORPEX_PARENT_INC_DIR . '/custom-controls/font-control.php';
				require CORPEX_PARENT_INC_DIR . '/customizer/corpex-range-value-control.php';
			require CORPEX_PARENT_INC_DIR . '/sanitization.php';
		}

		/**
		 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
		 */
		function corpex_customize_preview_js() {
			wp_enqueue_script( 'corpex-customizer', CORPEX_PARENT_URI . '/assets/js/customizer-preview.js', array( 'customize-preview' ), '20151215', true );
		}
		
		function corpex_customizer_script() {
			 wp_enqueue_script( 'corpex-customizer-section', CORPEX_PARENT_URI .'/assets/js/customizer-section.js', array("jquery"),'', true  );	
		}

		// Include customizer customizer settings.
			
		function corpex_customizer_settings() {
			require CORPEX_PARENT_INC_DIR . '/customizer/corpex-header.php';
			require CORPEX_PARENT_INC_DIR . '/customizer/corpex-blog.php';
			require CORPEX_PARENT_INC_DIR . '/customizer/corpex-footer.php';
			require CORPEX_PARENT_INC_DIR . '/customizer/corpex-general.php';
			require CORPEX_PARENT_INC_DIR . '/customizer/customizer_recommended_plugin.php';
			require CORPEX_PARENT_INC_DIR . '/customizer/customizer_import_data.php';
			require CORPEX_PARENT_INC_DIR . '/customizer/corpex-customize-base-control.php';
			require CORPEX_PARENT_INC_DIR . '/customizer/corpex-radio-image.php';
			require CORPEX_PARENT_INC_DIR . '/customizer/corpex-premium.php';
		}

	}
}// End if().

/**
 *  Kicking this off by calling 'get_instance()' method
 */
Corpex_Customizer::get_instance();