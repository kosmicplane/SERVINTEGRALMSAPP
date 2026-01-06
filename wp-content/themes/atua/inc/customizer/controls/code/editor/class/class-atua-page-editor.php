<?php
/**
 * Page editor control
 *
 * @package atua
 * @since atua 1.0
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

/**
 * Class to create a custom tags control
 */
class Atua_Page_Editor extends WP_Customize_Control {

	/**
	 * Flag to include sync scripts if needed
	 *
	 * @var bool|mixed
	 */
	private $needsync = false;

	/**
	 * Atua_Page_Editor constructor.
	 *
	 * @param WP_Customize_Manager $manager Manager.
	 * @param string               $id Id.
	 * @param array                $args Constructor args.
	 */
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
		if ( ! empty( $args['needsync'] ) ) {
			$this->needsync = $args['needsync'];
		}
	}

	/**
	 * Enqueue scripts
	 *
	 * @since   1.1.0
	 * @access  public
	 * @updated Changed wp_enqueue_scripts order and dependencies.
	 */
	public function enqueue() {
		wp_enqueue_style( 'atua_text_editor_css', get_template_directory_uri() . '/inc/customizer/controls/code/editor/css/atua-page-editor.css', array(),'atua');
		wp_enqueue_script(
			'atua_text_editor', get_template_directory_uri() . '/inc/customizer/controls/code/editor/js/atua-text-editor.js', array(
				'jquery',
				'customize-preview',
			),'atua', true
		);
		if ( $this->needsync === true ) {
			wp_enqueue_script( 'atua_controls_script', get_template_directory_uri() . '/inc/customizer/controls/code/editor/js/atua-update-controls.js', array( 'jquery', 'atua_text_editor' ),'atua', true );
			wp_localize_script(
				'atua_controls_script', 'requestpost', array(
					'ajaxurl'           => admin_url( 'admin-ajax.php' ),
					'thumbnail_control' => 'atua_feature_thumbnail', // name of image control that needs sync
				'editor_control'    => 'Atua_Page_Editor', // name of control (theme_mod) that needs sync
				'thumbnail_label'   => esc_html__( 'About background', 'atua' ), // name of thumbnail control
				)
			);
		}
	}

	/**
	 * Render the content on the theme customizer page
	 */
	public function render_content() {
		?>
		<label>
			<?php if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif; ?>
			<input type="hidden" <?php $this->link(); ?> value="<?php echo esc_textarea( $this->value() ); ?>" id="<?php echo esc_attr( $this->id ); ?>" class="editorfield">
			<a onclick="javascript:WPEditorWidget.toggleEditor('<?php echo $this->id; ?>');" class="button edit-content-button"><?php _e( '(Edit)', 'atua' ); ?></a>
		</label>
		<?php
	}
}
