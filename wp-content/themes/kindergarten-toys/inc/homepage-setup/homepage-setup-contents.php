<?php
/**
 * Wizard
 *
 * @package Kindergarten_Toys_Whizzie
 * @author Catapult Themes
 * @since 1.0.0
 */

class Kindergarten_Toys_Whizzie {
	
	protected $version = '1.1.0';
	
	/** @var string Current theme name, used as namespace in actions. */
	protected $kindergarten_toys_theme_name = '';
	protected $kindergarten_toys_theme_title = '';
	
	/** @var string Wizard page slug and title. */
	protected $kindergarten_toys_page_slug = '';
	protected $kindergarten_toys_page_title = '';
	
	/** @var array Wizard steps set by user. */
	protected $config_steps = array();
	
	public $parent_slug;
	
	/**
	 * Constructor
	 *
	 * @param $config	Our config parameters
	 */
	public function __construct( $config ) {
		$this->set_vars( $config );
		$this->init();
	}
	
	/**
	 * Set some settings
	 * @since 1.0.0
	 * @param $config	Our config parameters
	 */
	public function set_vars( $config ) {

		if( isset( $config['kindergarten_toys_page_slug'] ) ) {
			$this->kindergarten_toys_page_slug = esc_attr( $config['kindergarten_toys_page_slug'] );
		}
		if( isset( $config['kindergarten_toys_page_title'] ) ) {
			$this->kindergarten_toys_page_title = esc_attr( $config['kindergarten_toys_page_title'] );
		}
		if( isset( $config['steps'] ) ) {
			$this->config_steps = $config['steps'];
		}

		$kindergarten_toys_current_theme = wp_get_theme();
		$this->kindergarten_toys_theme_title = $kindergarten_toys_current_theme->get( 'Name' );
		$this->kindergarten_toys_theme_name = strtolower( preg_replace( '#[^a-zA-Z]#', '', $kindergarten_toys_current_theme->get( 'Name' ) ) );
		$this->kindergarten_toys_page_slug = apply_filters( $this->kindergarten_toys_theme_name . '_theme_setup_wizard_kindergarten_toys_page_slug', $this->kindergarten_toys_theme_name . '-wizard' );
		$this->parent_slug = apply_filters( $this->kindergarten_toys_theme_name . '_theme_setup_wizard_parent_slug', '' );

	}
	
	/**
	 * Hooks and filters
	 * @since 1.0.0
	 */	
	public function init() {

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_menu', array( $this, 'menu_page' ) );
		add_action( 'wp_ajax_kindergarten_toys_setup_widgets', array( $this, 'kindergarten_toys_setup_widgets' ) );
		
	}
	
	public function enqueue_scripts() {
		wp_enqueue_style( 'kindergarten-toys-homepage-setup-style', get_template_directory_uri() . '/inc/homepage-setup/assets/css/homepage-setup-style.css');
		wp_register_script( 'kindergarten-toys-homepage-setup-script', get_template_directory_uri() . '/inc/homepage-setup/assets/js/homepage-setup-script.js', array( 'jquery' ), time() );
		wp_localize_script( 
			'kindergarten-toys-homepage-setup-script',
			'whizzie_params',
			array(
				'ajaxurl' 		=> admin_url( 'admin-ajax.php' ),
				'wpnonce' 		=> wp_create_nonce( 'whizzie_nonce' ),
				'verify_text'	=> esc_html( 'verifying', 'kindergarten-toys' )
			)
		);
		wp_enqueue_script( 'kindergarten-toys-homepage-setup-script' );
	}
	
	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}
	
	/**
	 * Make a modal screen for the wizard
	 */
	public function menu_page() {
		add_theme_page( esc_html( $this->kindergarten_toys_page_title ), esc_html( $this->kindergarten_toys_page_title ), 'manage_options', $this->kindergarten_toys_page_slug, array( $this, 'wizard_page' ) );
	}
	
	/**
	 * Make an interface for the wizard
	 */
	public function wizard_page() {

		$url = wp_nonce_url( add_query_arg( array( 'plugins' => 'go' ) ), 'whizzie-setup' );
		$method = '';
		$fields = array_keys( $_POST );

		if ( false === ( $creds = request_filesystem_credentials( esc_url_raw( $url ), $method, false, false, $fields ) ) ) {
			return true;
		}

		if ( ! WP_Filesystem( $creds ) ) {
			request_filesystem_credentials( esc_url_raw( $url ), $method, true, false, $fields );
			return true;
		}

		$kindergarten_toys_theme = wp_get_theme();
		$kindergarten_toys_theme_title = $kindergarten_toys_theme->get( 'Name' );
		$kindergarten_toys_theme_version = $kindergarten_toys_theme->get( 'Version' );

		?>
		<div class="wrap">
			<?php
				printf( '<h1>%s %s</h1>', esc_html( $kindergarten_toys_theme_title ), esc_html( '(Version :- ' . $kindergarten_toys_theme_version . ')' ) );
			?>
			<div class="homepage-setup">
				<div class="homepage-setup-theme-bundle">
					<div class="homepage-setup-theme-bundle-one">
						<h1><?php echo esc_html__( 'WP Theme Bundle', 'kindergarten-toys' ); ?></h1>
						<p><?php echo wp_kses_post( 'Get <span>15% OFF</span> on all WordPress themes! Use code <span>"BNDL15OFF"</span> at checkout. Limited time offer!' ); ?></p>
					</div>
					<div class="homepage-setup-theme-bundle-two">
						<p><?php echo wp_kses_post( 'Extra <span>15%</span> OFF' ); ?></p>
					</div>
					<div class="homepage-setup-theme-bundle-three">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/inc/homepage-setup/assets/homepage-setup-images/bundle-banner.png' ); ?>" alt="<?php echo esc_attr__( 'Theme Bundle Image', 'kindergarten-toys' ); ?>">
					</div>
					<div class="homepage-setup-theme-bundle-four">
						<p><?php echo wp_kses_post( '<span>$2795</span>$69' ); ?></p>
						<a target="_blank" href="<?php echo esc_url( KINDERGARTEN_TOYS_BUNDLE_BUTTON ); ?>"><?php echo esc_html__( 'SHOP NOW', 'kindergarten-toys' ); ?> <span class="dashicons dashicons-arrow-right-alt2"></span></a>
					</div>
				</div>
			</div>
			
			<div class="card whizzie-wrap">
				<div class="demo_content_image">
					<div class="demo_content">
						<?php
							$kindergarten_toys_steps = $this->get_steps();
							echo '<ul class="whizzie-menu">';
							foreach ( $kindergarten_toys_steps as $kindergarten_toys_step ) {
								$class = 'step step-' . esc_attr( $kindergarten_toys_step['id'] );
								echo '<li data-step="' . esc_attr( $kindergarten_toys_step['id'] ) . '" class="' . esc_attr( $class ) . '">';
								printf( '<h2>%s</h2>', esc_html( $kindergarten_toys_step['title'] ) );

								$content = call_user_func( array( $this, $kindergarten_toys_step['view'] ) );
								if ( isset( $content['summary'] ) ) {
									printf(
										'<div class="summary">%s</div>',
										wp_kses_post( $content['summary'] )
									);
								}
								if ( isset( $content['detail'] ) ) {
									printf(
										'<div class="detail">%s</div>',
										wp_kses_post( $content['detail'] )
									);
								}
								if ( isset( $kindergarten_toys_step['button_text'] ) && $kindergarten_toys_step['button_text'] ) {
									printf( 
										'<div class="button-wrap"><a href="#" class="button button-primary do-it" data-callback="%s" data-step="%s">%s</a></div>',
										esc_attr( $kindergarten_toys_step['callback'] ),
										esc_attr( $kindergarten_toys_step['id'] ),
										esc_html( $kindergarten_toys_step['button_text'] )
									);
								}
								echo '</li>';
							}
							echo '</ul>';
						?>
						
						<ul class="whizzie-nav">
							<?php
							$step_number = 1;	
							foreach ( $kindergarten_toys_steps as $kindergarten_toys_step ) {
								echo '<li class="nav-step-' . esc_attr( $kindergarten_toys_step['id'] ) . '">';
								echo '<span class="step-number">' . esc_html( $step_number ) . '</span>';
								echo '</li>';
								$step_number++;
							}
							?>
							<div class="blank-border"></div>
						</ul>

						<div class="homepage-setup-links">
							<div class="homepage-setup-links buttons">
								<a href="<?php echo esc_url( KINDERGARTEN_TOYS_LITE_DOCS_PRO ); ?>" target="_blank" class="button button-primary"><?php echo esc_html__( 'Free Documentation', 'kindergarten-toys' ); ?></a>
								<a href="<?php echo esc_url( KINDERGARTEN_TOYS_BUY_NOW ); ?>" class="button button-primary" target="_blank"><?php echo esc_html__( 'Get Premium', 'kindergarten-toys' ); ?></a>
								<a href="<?php echo esc_url( KINDERGARTEN_TOYS_DEMO_PRO ); ?>" class="button button-primary" target="_blank"><?php echo esc_html__( 'Premium Demo', 'kindergarten-toys' ); ?></a>
								<a href="<?php echo esc_url( KINDERGARTEN_TOYS_SUPPORT_FREE ); ?>" target="_blank" class="button button-primary"><?php echo esc_html__( 'Support Forum', 'kindergarten-toys' ); ?></a>
							</div>
						</div> <!-- .demo_image -->

						<div class="step-loading"><span class="spinner"></span></div>
					</div> <!-- .demo_content -->

					<div class="homepage-setup-image">
						<div class="homepage-setup-theme-buynow">
							<div class="homepage-setup-theme-buynow-one">
								<h1><?php echo wp_kses_post( 'Kindergarten<br>Playgroup<br>WordPress Theme' ); ?></h1>
								<p><?php echo wp_kses_post( '<span>25%<br>Off</span> SHOP NOW' ); ?></p>
							</div>
							<div class="homepage-setup-theme-buynow-two">
								<img src="<?php echo esc_url( get_template_directory_uri() . '/inc/homepage-setup/assets/homepage-setup-images/kindergarten-toys.png' ); ?>" alt="<?php echo esc_attr__( 'Theme Bundle Image', 'kindergarten-toys' ); ?>">
							</div>
							<div class="homepage-setup-theme-buynow-three">
								<p><?php echo wp_kses_post( 'Get <span>25% OFF</span> on Premium Kindergarten Playgroup WordPress Theme Use code <span>"NYTHEMES25"</span> at checkout.' ); ?></p>
							</div>
							<div class="homepage-setup-theme-buynow-four">
								<a target="_blank" href="<?php echo esc_url( KINDERGARTEN_TOYS_BUY_NOW ); ?>"><?php echo esc_html__( 'Upgrade To Pro With Just $40', 'kindergarten-toys' ); ?></a>
							</div>
						</div>
					</div> <!-- .demo_image -->

				</div> <!-- .demo_content_image -->
			</div> <!-- .whizzie-wrap -->
		</div> <!-- .wrap -->
		<?php
	}


	/**
	 * Set options for the steps
	 * Incorporate any options set by the theme dev
	 * Return the array for the steps
	 * @return Array
	 */
	public function get_steps() {
		$kindergarten_toys_dev_steps = $this->config_steps;
		$kindergarten_toys_steps = array(
			'widgets' => array(
				'id'			=> 'widgets',
				'title'			=> __( 'Setup Home Page', 'kindergarten-toys' ),
				'icon'			=> 'welcome-widgets-menus',
				'view'			=> 'get_step_widgets',
				'callback'		=> 'kindergarten_toys_install_widgets',
				'button_text'	=> __( 'Start Home Page Setup', 'kindergarten-toys' ),
				'can_skip'		=> false
			),
			'done' => array(
				'id'			=> 'done',
				'title'			=> __( 'Customize Your Site', 'kindergarten-toys' ),
				'icon'			=> 'yes',
				'view'			=> 'get_step_done',
				'callback'		=> ''
			)
		);
		
		// Iterate through each step and replace with dev config values
		if( $kindergarten_toys_dev_steps ) {
			// Configurable elements - these are the only ones the dev can update from homepage-setup-settings.php
			$can_config = array( 'title', 'icon', 'button_text', 'can_skip' );
			foreach( $kindergarten_toys_dev_steps as $kindergarten_toys_dev_step ) {
				// We can only proceed if an ID exists and matches one of our IDs
				if( isset( $kindergarten_toys_dev_step['id'] ) ) {
					$id = $kindergarten_toys_dev_step['id'];
					if( isset( $kindergarten_toys_steps[$id] ) ) {
						foreach( $can_config as $element ) {
							if( isset( $kindergarten_toys_dev_step[$element] ) ) {
								$kindergarten_toys_steps[$id][$element] = $kindergarten_toys_dev_step[$element];
							}
						}
					}
				}
			}
		}
		return $kindergarten_toys_steps;
	}
	
	/**
	 * Print the content for the widgets step
	 * @since 1.1.0
	 */
	public function get_step_widgets() { ?> <?php }
	
	/**
	 * Print the content for the final step
	 */
	public function get_step_done() { ?>
		<div id="kindergarten-toys-demo-setup-guid">
			<div class="customize_div">
				<div class="customize_div finish">
					<div class="customize_div finish btns">
						<h3><?php echo esc_html( 'Your Site Is Ready To View' ); ?></h3>
						<div class="btnsss">
							<a target="_blank" href="<?php echo esc_url( get_home_url() ); ?>" class="button button-primary">
								<?php esc_html_e( 'View Your Site', 'kindergarten-toys' ); ?>
							</a>
							<a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-primary">
								<?php esc_html_e( 'Customize Your Site', 'kindergarten-toys' ); ?>
							</a>
							<a href="<?php echo esc_url(admin_url()); ?>" class="button button-primary">
								<?php esc_html_e( 'Finsh', 'kindergarten-toys' ); ?>
							</a>
						</div>
					</div>
					<div class="kindergarten-toys-setup-finish">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/screenshot.png' ); ?>"/>
					</div>
				</div>
			</div>
		</div>
	<?php }


	public function kindergarten_toys_customizer_nav_menu() {

		/* -+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+- Kindergarten Toys Primary Menu -+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-*/

		$kindergarten_toys_themename = 'Kindergarten Toys';
		$kindergarten_toys_menuname = $kindergarten_toys_themename . ' Primary Menu';
		$kindergarten_toys_menulocation = 'kindergarten-toys-primary-menu';
		$kindergarten_toys_menu_exists = wp_get_nav_menu_object($kindergarten_toys_menuname);

		if (!$kindergarten_toys_menu_exists) {
			$kindergarten_toys_menu_id = wp_create_nav_menu($kindergarten_toys_menuname);

			// Home
			wp_update_nav_menu_item($kindergarten_toys_menu_id, 0, array(
				'menu-item-title' => __('Home', 'kindergarten-toys'),
				'menu-item-classes' => 'home',
				'menu-item-url' => home_url('/'),
				'menu-item-status' => 'publish'
			));

			// About
			$kindergarten_toys_page_about = get_page_by_path('about');
			if($kindergarten_toys_page_about){
				wp_update_nav_menu_item($kindergarten_toys_menu_id, 0, array(
					'menu-item-title' => __('About', 'kindergarten-toys'),
					'menu-item-classes' => 'about',
					'menu-item-url' => get_permalink($kindergarten_toys_page_about),
					'menu-item-status' => 'publish'
				));
			}

			// Services
			$kindergarten_toys_page_services = get_page_by_path('services');
			if($kindergarten_toys_page_services){
				wp_update_nav_menu_item($kindergarten_toys_menu_id, 0, array(
					'menu-item-title' => __('Services', 'kindergarten-toys'),
					'menu-item-classes' => 'services',
					'menu-item-url' => get_permalink($kindergarten_toys_page_services),
					'menu-item-status' => 'publish'
				));
			}

			// Shop Page (WooCommerce)
			if (class_exists('WooCommerce')) {
				$kindergarten_toys_shop_page_id = wc_get_page_id('shop');
				if ($kindergarten_toys_shop_page_id) {
					wp_update_nav_menu_item($kindergarten_toys_menu_id, 0, array(
						'menu-item-title' => __('Shop', 'kindergarten-toys'),
						'menu-item-classes' => 'shop',
						'menu-item-url' => get_permalink($kindergarten_toys_shop_page_id),
						'menu-item-status' => 'publish'
					));
				}
			}

			// Blog
			$kindergarten_toys_page_blog = get_page_by_path('blog');
			if($kindergarten_toys_page_blog){
				wp_update_nav_menu_item($kindergarten_toys_menu_id, 0, array(
					'menu-item-title' => __('Blog', 'kindergarten-toys'),
					'menu-item-classes' => 'blog',
					'menu-item-url' => get_permalink($kindergarten_toys_page_blog),
					'menu-item-status' => 'publish'
				));
			}

			// 404 Page
			$kindergarten_toys_notfound = get_page_by_path('404 Page');
			if($kindergarten_toys_notfound){
				wp_update_nav_menu_item($kindergarten_toys_menu_id, 0, array(
					'menu-item-title' => __('404 Page', 'kindergarten-toys'),
					'menu-item-classes' => '404',
					'menu-item-url' => get_permalink($kindergarten_toys_notfound),
					'menu-item-status' => 'publish'
				));
			}

			if (!has_nav_menu($kindergarten_toys_menulocation)) {
				$kindergarten_toys_locations = get_theme_mod('nav_menu_locations');
				$kindergarten_toys_locations[$kindergarten_toys_menulocation] = $kindergarten_toys_menu_id;
				set_theme_mod('nav_menu_locations', $kindergarten_toys_locations);
			}
		}
	}

	
	/**
	 * Imports the Demo Content
	 * @since 1.1.0
	 */
	public function kindergarten_toys_setup_widgets(){

		/* -+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+- MENUS PAGES -+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-*/
		
			// Creation of home page //
			$kindergarten_toys_home_content = '';
			$kindergarten_toys_home_title = 'Home';
			$kindergarten_toys_home = array(
					'post_type' => 'page',
					'post_title' => $kindergarten_toys_home_title,
					'post_content'  => $kindergarten_toys_home_content,
					'post_status' => 'publish',
					'post_author' => 1,
					'post_slug' => 'home'
			);
			$kindergarten_toys_home_id = wp_insert_post($kindergarten_toys_home);

			add_post_meta( $kindergarten_toys_home_id, '_wp_page_template', 'frontpage.php' );

			$kindergarten_toys_home = get_page_by_path( 'Home' );
			update_option( 'page_on_front', $kindergarten_toys_home->ID );
			update_option( 'show_on_front', 'page' );

			// Creation of blog page //
			$kindergarten_toys_blog_title = 'Blog';
			$kindergarten_toys_blog_check = get_page_by_path('blog');
			if (!$kindergarten_toys_blog_check) {
				$kindergarten_toys_blog = array(
					'post_type'    => 'page',
					'post_title'   => $kindergarten_toys_blog_title,
					'post_status'  => 'publish',
					'post_author'  => 1,
					'post_name'    => 'blog'
				);
				$kindergarten_toys_blog_id = wp_insert_post($kindergarten_toys_blog);

				if (!is_wp_error($kindergarten_toys_blog_id)) {
					update_option('page_for_posts', $kindergarten_toys_blog_id);
				}
			}

			// Creation of about page //
			$kindergarten_toys_about_title = 'About';
			$kindergarten_toys_about_content = 'What is Lorem Ipsum?
														Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
														&nbsp;
														Why do we use it?
														It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
														&nbsp;
														Where does it come from?
														There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.
														&nbsp;
														Why do we use it?
														It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
														&nbsp;
														Where does it come from?
														There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.';
			$kindergarten_toys_about_check = get_page_by_path('about');
			if (!$kindergarten_toys_about_check) {
				$kindergarten_toys_about = array(
					'post_type'    => 'page',
					'post_title'   => $kindergarten_toys_about_title,
					'post_content'   => $kindergarten_toys_about_content,
					'post_status'  => 'publish',
					'post_author'  => 1,
					'post_name'    => 'about'
				);
				wp_insert_post($kindergarten_toys_about);
			}

			// Creation of services page //
			$kindergarten_toys_services_title = 'Services';
			$kindergarten_toys_services_content = 'What is Lorem Ipsum?
														Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
														&nbsp;
														Why do we use it?
														It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
														&nbsp;
														Where does it come from?
														There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.
														&nbsp;
														Why do we use it?
														It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
														&nbsp;
														Where does it come from?
														There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.';
			$kindergarten_toys_services_check = get_page_by_path('services');
			if (!$kindergarten_toys_services_check) {
				$kindergarten_toys_services = array(
					'post_type'    => 'page',
					'post_title'   => $kindergarten_toys_services_title,
					'post_content'   => $kindergarten_toys_services_content,
					'post_status'  => 'publish',
					'post_author'  => 1,
					'post_name'    => 'services'
				);
				wp_insert_post($kindergarten_toys_services);
			}

			// Creation of 404 page //
			$kindergarten_toys_notfound_title = '404 Page';
			$kindergarten_toys_notfound = array(
				'post_type'   => 'page',
				'post_title'  => $kindergarten_toys_notfound_title,
				'post_status' => 'publish',
				'post_author' => 1,
				'post_slug'   => '404'
			);
			$kindergarten_toys_notfound_id = wp_insert_post($kindergarten_toys_notfound);
			add_post_meta($kindergarten_toys_notfound_id, '_wp_page_template', '404.php');


		/* -+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+- SLIDER POST -+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-*/

			$kindergarten_toys_slider_title = array('Your Trusted Partner To Find The Right Services');
			for($kindergarten_toys_i=1;$kindergarten_toys_i<=1;$kindergarten_toys_i++){

				$kindergarten_toys_title = $kindergarten_toys_slider_title[$kindergarten_toys_i-1];
				$kindergarten_toys_content = 'Lorem Ipsum Content.';

				// Create post object
				$kindergarten_toys_my_post = array(
						'post_title'    => wp_strip_all_tags( $kindergarten_toys_title ),
						'post_content'  => $kindergarten_toys_content,
						'post_status'   => 'publish',
						'post_type'     => 'post',
				);
				// Insert the post into the database
				$kindergarten_toys_post_id = wp_insert_post( $kindergarten_toys_my_post );

				wp_set_object_terms($kindergarten_toys_post_id, 'Slider', 'category', true);

				wp_set_object_terms($kindergarten_toys_post_id, 'Slider', 'post_tag', true);

				$kindergarten_toys_image_url = get_template_directory_uri().'/inc/homepage-setup/assets/homepage-setup-images/slider-img'.$kindergarten_toys_i.'.png';

				$kindergarten_toys_image_name= 'slider-img'.$kindergarten_toys_i.'.png';
				$upload_dir       = wp_upload_dir();
				// Set upload folder
				$kindergarten_toys_image_data       = file_get_contents($kindergarten_toys_image_url);
				// Get image data
				$unique_file_name = wp_unique_filename( $upload_dir['path'], $kindergarten_toys_image_name );

				$kindergarten_toys_filename = basename( $unique_file_name ); 
				
				// Check folder permission and define file location
				if( wp_mkdir_p( $upload_dir['path'] ) ) {
						$kindergarten_toys_file = $upload_dir['path'] . '/' . $kindergarten_toys_filename;
				} else {
						$kindergarten_toys_file = $upload_dir['basedir'] . '/' . $kindergarten_toys_filename;
				}
				// Create the image  file on the server
				// Generate unique name
				if ( ! function_exists( 'WP_Filesystem' ) ) {
					require_once( ABSPATH . 'wp-admin/includes/file.php' );
				}
				
				WP_Filesystem();
				global $wp_filesystem;
				
				if ( ! $wp_filesystem->put_contents( $kindergarten_toys_file, $kindergarten_toys_image_data, FS_CHMOD_FILE ) ) {
					wp_die( 'Error saving file!' );
				}
				// Check image file type
				$wp_filetype = wp_check_filetype( $kindergarten_toys_filename, null );
				// Set attachment data
				$kindergarten_toys_attachment = array(
						'post_mime_type' => $wp_filetype['type'],
						'post_title'     => sanitize_file_name( $kindergarten_toys_filename ),
						'post_content'   => '',
						'post_type'     => 'post',
						'post_status'    => 'inherit'
				);
				// Create the attachment
				$kindergarten_toys_attach_id = wp_insert_attachment( $kindergarten_toys_attachment, $kindergarten_toys_file, $kindergarten_toys_post_id );
				// Include image.php
				require_once(ABSPATH . 'wp-admin/includes/image.php');
				// Define attachment metadata
				$kindergarten_toys_attach_data = wp_generate_attachment_metadata( $kindergarten_toys_attach_id, $kindergarten_toys_file );
				// Assign metadata to attachment
					wp_update_attachment_metadata( $kindergarten_toys_attach_id, $kindergarten_toys_attach_data );
				// And finally assign featured image to post
				set_post_thumbnail( $kindergarten_toys_post_id, $kindergarten_toys_attach_id );

			}


		/* -+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+- SECOND SECTION POST -+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-*/

			$kindergarten_toys_second_section_title = array('Active Learning And Skills Development For Settlers','Drawing And Painting Class For Little Artists','Summer Camp With Outdoor Games And Activities');
			for($kindergarten_toys_i=1;$kindergarten_toys_i<=3;$kindergarten_toys_i++){

				$kindergarten_toys_title = $kindergarten_toys_second_section_title[$kindergarten_toys_i-1];
				$kindergarten_toys_content = 'It is a long established fact that reader will bestracted by the readablectenta page when looking at its layout.';

				// Create post object
				$kindergarten_toys_my_post = array(
						'post_title'    => wp_strip_all_tags( $kindergarten_toys_title ),
						'post_content'  => $kindergarten_toys_content,
						'post_status'   => 'publish',
						'post_type'     => 'post',
				);
					// Insert the post into the database
				$kindergarten_toys_post_id = wp_insert_post( $kindergarten_toys_my_post );

				wp_set_object_terms($kindergarten_toys_post_id, 'Second', 'category', true);

				wp_set_object_terms($kindergarten_toys_post_id, 'Second', 'post_tag', true);

				$kindergarten_toys_image_url = get_template_directory_uri().'/inc/homepage-setup/assets/homepage-setup-images/post-img'.$kindergarten_toys_i.'.png';

				$kindergarten_toys_image_name= 'post-img'.$kindergarten_toys_i.'.png';
				$upload_dir       = wp_upload_dir();
				// Set upload folder
				$kindergarten_toys_image_data       = file_get_contents($kindergarten_toys_image_url);
				// Get image data
				$unique_file_name = wp_unique_filename( $upload_dir['path'], $kindergarten_toys_image_name );

				$kindergarten_toys_filename = basename( $unique_file_name ); 
				
				// Check folder permission and define file location
				if( wp_mkdir_p( $upload_dir['path'] ) ) {
						$kindergarten_toys_file = $upload_dir['path'] . '/' . $kindergarten_toys_filename;
				} else {
						$kindergarten_toys_file = $upload_dir['basedir'] . '/' . $kindergarten_toys_filename;
				}
				// Create the image  file on the server
				// Generate unique name
				if ( ! function_exists( 'WP_Filesystem' ) ) {
					require_once( ABSPATH . 'wp-admin/includes/file.php' );
				}
				
				WP_Filesystem();
				global $wp_filesystem;
				
				if ( ! $wp_filesystem->put_contents( $kindergarten_toys_file, $kindergarten_toys_image_data, FS_CHMOD_FILE ) ) {
					wp_die( 'Error saving file!' );
				}
				// Check image file type
				$wp_filetype = wp_check_filetype( $kindergarten_toys_filename, null );
				// Set attachment data
				$kindergarten_toys_attachment = array(
						'post_mime_type' => $wp_filetype['type'],
						'post_title'     => sanitize_file_name( $kindergarten_toys_filename ),
						'post_content'   => '',
						'post_type'     => 'post',
						'post_status'    => 'inherit'
				);
				// Create the attachment
				$kindergarten_toys_attach_id = wp_insert_attachment( $kindergarten_toys_attachment, $kindergarten_toys_file, $kindergarten_toys_post_id );
				// Include image.php
				require_once(ABSPATH . 'wp-admin/includes/image.php');
				// Define attachment metadata
				$kindergarten_toys_attach_data = wp_generate_attachment_metadata( $kindergarten_toys_attach_id, $kindergarten_toys_file );
				// Assign metadata to attachment
					wp_update_attachment_metadata( $kindergarten_toys_attach_id, $kindergarten_toys_attach_data );
				// And finally assign featured image to post
				set_post_thumbnail( $kindergarten_toys_post_id, $kindergarten_toys_attach_id );

			}


		/* -+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+- Second Section -+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-*/

			$kindergarten_toys_starting_date=array('Starting From Of April 2025 10 Days','Starting From Of April 2025 10 Month','Starting From Of April 2025 3 Month','Starting From Of April 2025 10 Month','Starting From Of April 2025 8 Month','Starting From Of April 2025 10 Month','Starting From Of January 2025 10 Month','Starting From Of June 2025 10 Month','Starting From Of May 2025 10 Month');
			$kindergarten_toys_course_price=array('$299','$199','$99','$29','$200','$2029','$2569','$2994','$939');
			$kindergarten_toys_class_time=array('Class Time-1:45 pm to 12:00 pm','Class Time-9:45 am to 11:00 pm','Class Time-11:45 am to 4:00 pm','Class Time-9:45 am to 11:00 pm','Class Time-9:00 am to 11:00 pm','Class Time-9:30 am to 11:00 pm','Class Time-10:45 am to 11:00 pm','Class Time-9:45 pm to 12:00 pm','Class Time-9:45 pm to 14:00 pm');
			$kindergarten_toys_student_age=array('Age-2 years to 3 years old','Age-1 years to 5 years old','Age-6 years to 9 years old','Age-8 years to 15 years old','Age-10 years to 18 years old','Age-1 years to 2 years old','Age-2 years to 3 years old','Age-0 years to 2 years old','Age-2 years to 3 years old');
			for($kindergarten_toys_i=1;$kindergarten_toys_i<=9;$kindergarten_toys_i++) {
				set_theme_mod( 'kindergarten_toys_course_section_starting_date'.$kindergarten_toys_i, $kindergarten_toys_starting_date[$kindergarten_toys_i-1] );
				set_theme_mod( 'kindergarten_toys_course_section_course_price'.$kindergarten_toys_i, $kindergarten_toys_course_price[$kindergarten_toys_i-1] );
				set_theme_mod( 'kindergarten_toys_course_section_class_time'.$kindergarten_toys_i, $kindergarten_toys_class_time[$kindergarten_toys_i-1] );
				set_theme_mod( 'kindergarten_toys_course_section_student_age'.$kindergarten_toys_i, $kindergarten_toys_student_age[$kindergarten_toys_i-1] );
			}


        $this->kindergarten_toys_customizer_nav_menu();

	    exit;
	}
}