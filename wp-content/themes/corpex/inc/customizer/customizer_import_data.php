<?php
class corpex_import_dummy_data {

	private static $instance;

	public static function init( ) {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof corpex_import_dummy_data ) ) {
			self::$instance = new corpex_import_dummy_data;
			self::$instance->corpex_setup_actions();
		}

	}

	/**
	 * Setup the class props based on the config array.
	 */
	

	/**
	 * Setup the actions used for this class.
	 */
	public function corpex_setup_actions() {

		// Enqueue scripts
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'corpex_import_customize_scripts' ), 0 );

	}
	
	

	public function corpex_import_customize_scripts() {

	wp_enqueue_script( 'corpex-import-customizer-js', get_template_directory_uri() . '/assets/js/corpex-import-customizer.js', array( 'customize-controls' ) );
	}
}

$corpex_import_customizers = array(

		'import_data' => array(
			'recommended' => true,
			
		),
);
corpex_import_dummy_data::init( apply_filters( 'corpex_import_customizer', $corpex_import_customizers ) );