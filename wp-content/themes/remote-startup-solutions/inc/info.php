<?php
/**
 * Remote Startup Solutions Theme Info
 *
 * @package remote_startup_solutions
 */

if( class_exists( 'WP_Customize_control' ) ){

	class Remote_Startup_Solutions_Theme_Info extends WP_Customize_Control{
    	/**
       	* Render the content on the theme customizer page
       	*/
       	public function render_content()
       	{
       		?>
       		<label>
       			<strong class="customize-text_editor"><?php echo esc_html( $this->label ); ?></strong>
       			<br />
       			<span class="customize-text_editor_desc">
       				<?php echo wp_kses_post( $this->description ); ?>
       			</span>
       		</label>
       		<?php
       	}
    }
    
}

if( class_exists( 'WP_Customize_Section' ) ) :


/**
 * Adding Go to Pro Section in Customizer
 * https://github.com/justintadlock/trt-customizer-pro
 */
class Remote_Startup_Solutions_Customize_Section_Pro extends WP_Customize_Section {

	/**
	 * The type of customize section being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'pro-section';

	/**
	 * Custom button text to output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_text = '';

	/**
	 * Custom pro button URL.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_url = '';

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function json() {
		$json = parent::json();

		$json['pro_text'] = $this->pro_text;
		$json['pro_url']  = esc_url( $this->pro_url );

		return $json;
	}

	/**
	 * Outputs the Underscore.js template.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	protected function render_template() { ?>

		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">

			<h3 class="accordion-section-title">
				{{ data.title }}

				<# if ( data.pro_text && data.pro_url ) { #>
					<a href="{{ data.pro_url }}" class="button button-secondary alignright" target="_blank">{{ data.pro_text }}</a>
				<# } #>
			</h3>
		</li>
	<?php }
}
endif;

if ( ! defined( 'REMOTE_STARTUP_SOLUTION_URL' ) ) {
    define( 'REMOTE_STARTUP_SOLUTION_URL', esc_url( 'https://www.themeignite.com/products/startup-solutions-wordpress-theme', 'remote-startup-solutions') );
}
if ( ! defined( 'REMOTE_STARTUP_SOLUTION_TEXT' ) ) {
    define( 'REMOTE_STARTUP_SOLUTION_TEXT', __( 'Remote Startup PRO','remote-startup-solutions' ));
}
if ( ! defined( 'REMOTE_STARTUP_SOLUTION_DOC_URL' ) ) {
    define( 'REMOTE_STARTUP_SOLUTION_DOC_URL', esc_url( 'https://demo.themeignite.com/documentation/remote-startup-solutions-free/', 'remote-startup-solutions') );
}
if ( ! defined( 'REMOTE_STARTUP_SOLUTION_DOC_TEXT' ) ) {
    define( 'REMOTE_STARTUP_SOLUTION_DOC_TEXT', __( 'For Reference','remote-startup-solutions' ));
}
add_action( 'customize_register', 'remote_startup_solutions_sections_pro' );
function remote_startup_solutions_sections_pro( $manager ) {
	// Register custom section types.
	$manager->register_section_type( 'Remote_Startup_Solutions_Customize_Section_Pro' );

	// Register sections.
	$manager->add_section(
		new Remote_Startup_Solutions_Customize_Section_Pro(
			$manager,
			'remote_startup_solutions_view_pro',
			array(
				'title'    => esc_html__( 'Pro Available', 'remote-startup-solutions' ),
                'priority' => 5, 
				'pro_text' => esc_html( REMOTE_STARTUP_SOLUTION_TEXT, 'remote-startup-solutions' ),
				'pro_url'  => esc_url( REMOTE_STARTUP_SOLUTION_URL)
			)
		)
	);
	$manager->add_section( new Remote_Startup_Solutions_Customize_Section_Pro( $manager,'remote_startup_solutions_doc_button_link', array(
			'priority'   => 5,
			'title'    => esc_html( REMOTE_STARTUP_SOLUTION_DOC_TEXT, 'remote-startup-solutions' ),
			'pro_text' => esc_html__( 'Lite Documentation', 'remote-startup-solutions' ),
			'pro_url'  => esc_url( REMOTE_STARTUP_SOLUTION_DOC_URL)
		) )	);
}

