<?php
/**
 * Business Corporate Agency Theme Page
 *
 * @package Business Corporate Agency
 */

function business_corporate_agency_admin_scripts() {
	wp_dequeue_script('business-corporate-agency-custom-scripts');
}
add_action( 'admin_enqueue_scripts', 'business_corporate_agency_admin_scripts' );

if ( ! defined( 'BUSINESS_CORPORATE_AGENCY_FREE_THEME_URL' ) ) {
	define( 'BUSINESS_CORPORATE_AGENCY_FREE_THEME_URL', 'https://www.themespride.com/products/free-corporate-wordpress-theme' );
}
if ( ! defined( 'BUSINESS_CORPORATE_AGENCY_PRO_THEME_URL' ) ) {
	define( 'BUSINESS_CORPORATE_AGENCY_PRO_THEME_URL', 'https://www.themespride.com/products/corporate-agency-wordpress-theme' );
}
if ( ! defined( 'BUSINESS_CORPORATE_AGENCY_DEMO_THEME_URL' ) ) {
	define( 'BUSINESS_CORPORATE_AGENCY_DEMO_THEME_URL', 'https://page.themespride.com/business-corporate-agency/' );
}
if ( ! defined( 'BUSINESS_CORPORATE_AGENCY_DOCS_THEME_URL' ) ) {
    define( 'BUSINESS_CORPORATE_AGENCY_DOCS_THEME_URL', 'https://page.themespride.com/demo/docs/business-corporate-agency/' );
}
if ( ! defined( 'BUSINESS_CORPORATE_AGENCY_RATE_THEME_URL' ) ) {
    define( 'BUSINESS_CORPORATE_AGENCY_RATE_THEME_URL', 'https://wordpress.org/support/theme/business-corporate-agency/reviews/#new-post' );
}
if ( ! defined( 'BUSINESS_CORPORATE_AGENCY_CHANGELOG_THEME_URL' ) ) {
    define( 'BUSINESS_CORPORATE_AGENCY_CHANGELOG_THEME_URL', get_template_directory() . '/readme.txt' );
}
if ( ! defined( 'BUSINESS_CORPORATE_AGENCY_SUPPORT_THEME_URL' ) ) {
    define( 'BUSINESS_CORPORATE_AGENCY_SUPPORT_THEME_URL', 'https://wordpress.org/support/theme/business-corporate-agency/' );
}
if ( ! defined( 'BUSINESS_CORPORATE_AGENCY_THEME_BUNDLE' ) ) {
    define( 'BUSINESS_CORPORATE_AGENCY_THEME_BUNDLE', 'https://www.themespride.com/products/wordpress-theme-bundle' );
}
/**
 * Add theme page
 */
function business_corporate_agency_menu() {
	add_theme_page( esc_html__( 'About Theme', 'business-corporate-agency' ), esc_html__( 'Begin Installation - Import Demo', 'business-corporate-agency' ), 'edit_theme_options', 'business-corporate-agency-about', 'business_corporate_agency_about_display' );
}
add_action( 'admin_menu', 'business_corporate_agency_menu' );


/**
 * Display About page
 */
function business_corporate_agency_about_display() {
	$business_corporate_agency_theme = wp_get_theme();
	?>
	<div class="wrap about-wrap full-width-layout">
		<h1><?php echo esc_html( $business_corporate_agency_theme ); ?></h1>
		<div class="about-theme">
			<div class="theme-description">
				<p class="about-text">
					<?php
					// Remove last sentence of description.
					$business_corporate_agency_description = explode( '. ', $business_corporate_agency_theme->get( 'Description' ) );

					array_pop( $business_corporate_agency_description );

					$business_corporate_agency_description = implode( '. ', $business_corporate_agency_description );

					echo esc_html( $business_corporate_agency_description . '.' );
				?></p>
				<p class="actions">
					<a target="_blank" href="<?php echo esc_url( BUSINESS_CORPORATE_AGENCY_FREE_THEME_URL ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Theme Info', 'business-corporate-agency' ); ?></a>

					<a target="_blank" href="<?php echo esc_url( BUSINESS_CORPORATE_AGENCY_DEMO_THEME_URL ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'View Demo', 'business-corporate-agency' ); ?></a>

					<a target="_blank" href="<?php echo esc_url( BUSINESS_CORPORATE_AGENCY_DOCS_THEME_URL ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Theme Instructions', 'business-corporate-agency' ); ?></a>

					<a target="_blank" href="<?php echo esc_url( BUSINESS_CORPORATE_AGENCY_RATE_THEME_URL ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Rate this theme', 'business-corporate-agency' ); ?></a>

					<a target="_blank" href="<?php echo esc_url( BUSINESS_CORPORATE_AGENCY_PRO_THEME_URL ); ?>" class="green button button-secondary" target="_blank"><?php esc_html_e( 'Upgrade to pro', 'business-corporate-agency' ); ?></a>
				</p>
			</div>

			<div class="theme-screenshot">
				<img src="<?php echo esc_url( $business_corporate_agency_theme->get_screenshot() ); ?>" />
			</div>

		</div>

		<nav class="nav-tab-wrapper wp-clearfix" aria-label="<?php esc_attr_e( 'Secondary menu', 'business-corporate-agency' ); ?>">

			<a href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'business-corporate-agency-about' ), 'themes.php' ) ) ); ?>" class="nav-tab<?php echo ( isset( $_GET['page'] ) && 'business-corporate-agency-about' === $_GET['page'] && ! isset( $_GET['tab'] ) ) ?' nav-tab-active' : ''; ?>"><?php esc_html_e( 'One Click Demo Import', 'business-corporate-agency' ); ?></a>

			<a href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'business-corporate-agency-about', 'tab' => 'about_theme' ), 'themes.php' ) ) ); ?>" class="nav-tab<?php echo ( isset( $_GET['tab'] ) && 'about_theme' === $_GET['tab'] ) ?' nav-tab-active' : ''; ?>"><?php esc_html_e( 'About', 'business-corporate-agency' ); ?></a>

			<a href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'business-corporate-agency-about', 'tab' => 'free_vs_pro' ), 'themes.php' ) ) ); ?>" class="nav-tab<?php echo ( isset( $_GET['tab'] ) && 'free_vs_pro' === $_GET['tab'] ) ?' nav-tab-active' : ''; ?>"><?php esc_html_e( 'Compare free Vs Pro', 'business-corporate-agency' ); ?></a>

			<a href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'business-corporate-agency-about', 'tab' => 'changelog' ), 'themes.php' ) ) ); ?>" class="nav-tab<?php echo ( isset( $_GET['tab'] ) && 'changelog' === $_GET['tab'] ) ?' nav-tab-active' : ''; ?>"><?php esc_html_e( 'Changelog', 'business-corporate-agency' ); ?></a>

			<a href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'business-corporate-agency-about', 'tab' => 'get_bundle' ), 'themes.php' ) ) ); ?>" class="blink wp-bundle nav-tab<?php echo ( isset( $_GET['tab'] ) && 'get_bundle' === $_GET['tab'] ) ?' nav-tab-active' : ''; ?>"><?php esc_html_e( 'Get WordPress Theme Bundle', 'business-corporate-agency' ); ?></a>

		</nav>

		<?php
			business_corporate_agency_demo_import();

			business_corporate_agency_main_screen();

			business_corporate_agency_changelog_screen();

			business_corporate_agency_free_vs_pro();

			business_corporate_agency_get_bundle();

		?>

		<div class="return-to-dashboard">
			<?php if ( current_user_can( 'update_core' ) && isset( $_GET['updated'] ) ) : ?>
				<a href="<?php echo esc_url( self_admin_url( 'update-core.php' ) ); ?>">
					<?php is_multisite() ? esc_html_e( 'Return to Updates', 'business-corporate-agency' ) : esc_html_e( 'Return to Dashboard &rarr; Updates', 'business-corporate-agency' ); ?>
				</a> |
			<?php endif; ?>
			<a href="<?php echo esc_url( self_admin_url() ); ?>"><?php is_blog_admin() ? esc_html_e( 'Go to Dashboard &rarr; Home', 'business-corporate-agency' ) : esc_html_e( 'Go to Dashboard', 'business-corporate-agency' ); ?></a>
		</div>
	</div>
	<?php
}

/**
 * Output the Demo Import screen.
 */

function business_corporate_agency_demo_import() {
    if (isset($_GET['page']) && 'business-corporate-agency-about' === $_GET['page'] && !isset($_GET['tab'])) {

        require_once get_template_directory() . '/inc/whizzie.php';

        if (isset($_GET['import-demo']) && $_GET['import-demo'] == true) { ?>
            <div class="col card success-demo">
                <p class="imp-success"><?php echo esc_html__('Imported Successfully', 'business-corporate-agency'); ?></p><br>
                <a class="button button-primary" href="<?php echo esc_url(admin_url('customize.php')); ?>" target="_blank">
                    <?php echo esc_html__('Go to Customizer', 'business-corporate-agency'); ?>
                </a>
            </div>
            <script type="text/javascript">
                // Redirect after success
                window.onload = function() {
                    setTimeout(function() {
                        window.location.href = "<?php echo esc_url(admin_url('customize.php')); ?>";
                    }, 1000); // 1 second delay to show success message
                };
            </script>
        <?php } else { ?>
            <div class="col card demo-btn text-center">
                <form id="demo-importer-form" action="<?php echo esc_url(home_url()); ?>/wp-admin/themes.php" method="POST">
                    <p class="demo-title"><?php echo esc_html__('Demo Importer', 'business-corporate-agency'); ?></p>
                    <p class="demo-des"><?php echo esc_html__('This theme supports importing demo content with a single click. Use the button below to quickly set up your site. You can easily customize or deactivate the imported content later through the Customizer.', 'business-corporate-agency'); ?></p>
                    <i class="fas fa-long-arrow-alt-down"></i>

                    <button type="submit" class="button button-primary with-icon" id="begin-install-btn">
                        <?php echo esc_html__('Begin Installation - Import Demo', 'business-corporate-agency'); ?>
                        <span id="loader" style="display:none;margin-left:10px;">
                            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/loader.png" alt="Loading..." width="20" height="20" />
                        </span>
                    </button>
                </form>
            </div>

            <script type="text/javascript">
                jQuery(document).ready(function($) {
                    $('#demo-importer-form').on('submit', function (e) {
                        e.preventDefault();

                        if (confirm("Are you sure you want to proceed with the demo import?")) {
                            // Show loader inside button
                            $('#loader').show();

                            // Redirect to import demo (add ?import-demo=true)
                            var url = new URL(window.location.href);
                            url.searchParams.append('import-demo', 'true');
                            window.location.href = url;
                        } else {
                            return false;
                        }
                    });
                });
            </script>
        <?php }
    }
}

/**
 * Output the main about screen.
 */
function business_corporate_agency_main_screen() {
	if ( isset( $_GET['tab'] ) && 'about_theme' === $_GET['tab'] ) {
	?>
		<div class="feature-section two-col">
			<div class="col card">
				<h2 class="title"><?php esc_html_e( 'Theme Customizer', 'business-corporate-agency' ); ?></h2>
				<p><?php esc_html_e( 'All Theme Options are available via Customize screen.', 'business-corporate-agency' ) ?></p>
				<p><a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Customize', 'business-corporate-agency' ); ?></a></p>
			</div>

			<div class="col card">
				<h2 class="title"><?php esc_html_e( 'Got theme support question?', 'business-corporate-agency' ); ?></h2>
				<p><?php esc_html_e( 'Get genuine support from genuine people. Whether it\'s customization or compatibility, our seasoned developers deliver tailored solutions to your queries.', 'business-corporate-agency' ) ?></p>
				<p><a target="_blank" href="<?php echo esc_url( BUSINESS_CORPORATE_AGENCY_SUPPORT_THEME_URL ); ?>" class="button button-primary"><?php esc_html_e( 'Support Forum', 'business-corporate-agency' ); ?></a></p>
			</div>

			<div class="col card">
				<h2 class="title"><?php esc_html_e( 'Upgrade To Premium With Straight 20% OFF.', 'business-corporate-agency' ); ?></h2>
				<p><?php esc_html_e( 'Get our amazing WordPress theme with exclusive 20% off use the coupon', 'business-corporate-agency' ) ?>"<input type="text" value="GETPro20" id="myInput">".</p>
				<button class="button button-primary"><?php esc_html_e( 'GETPro20', 'business-corporate-agency' ); ?></button>
			</div>
		</div>
	<?php
	}
}

/**
 * Output the changelog screen.
 */
function business_corporate_agency_changelog_screen() {
	if ( isset( $_GET['tab'] ) && 'changelog' === $_GET['tab'] ) {
		global $wp_filesystem;
	?>
		<div class="wrap about-wrap">

			<p class="about-description"><?php esc_html_e( 'View changelog below:', 'business-corporate-agency' ); ?></p>

			<?php
				$changelog_file = apply_filters( 'business_corporate_agency_changelog_file', BUSINESS_CORPORATE_AGENCY_CHANGELOG_THEME_URL );
				// Check if the changelog file exists and is readable.
				if ( $changelog_file && is_readable( $changelog_file ) ) {
					WP_Filesystem();
					$changelog = $wp_filesystem->get_contents( $changelog_file );
					$changelog_list = business_corporate_agency_parse_changelog( $changelog );

					echo wp_kses_post( $changelog_list );
				}
			?>
		</div>
	<?php
	}
}

/**
 * Parse changelog from readme file.
 * @param  string $content
 * @return string
 */
function business_corporate_agency_parse_changelog( $content ) {
	// Explode content with ==  to juse separate main content to array of headings.
	$content = explode ( '== ', $content );

	$changelog_isolated = '';

	// Get element with 'Changelog ==' as starting string, i.e isolate changelog.
	foreach ( $content as $key => $value ) {
		if (strpos( $value, 'Changelog ==') === 0) {
	    	$changelog_isolated = str_replace( 'Changelog ==', '', $value );
	    }
	}

	// Now Explode $changelog_isolated to manupulate it to add html elements.
	$changelog_array = explode( '= ', $changelog_isolated );

	// Unset first element as it is empty.
	unset( $changelog_array[0] );

	$changelog = '<pre class="changelog">';

	foreach ( $changelog_array as $value) {
		// Replace all enter (\n) elements with </span><span> , opening and closing span will be added in next process.
		$value = preg_replace( '/\n+/', '</span><span>', $value );

		// Add openinf and closing div and span, only first span element will have heading class.
		$value = '<div class="block"><span class="heading">= ' . $value . '</span></div>';

		// Remove empty <span></span> element which newr formed at the end.
		$changelog .= str_replace( '<span></span>', '', $value );
	}

	$changelog .= '</pre>';

	return wp_kses_post( $changelog );
}

/**
 * Import Demo data for theme using catch themes demo import plugin
 */
function business_corporate_agency_free_vs_pro() {
	if ( isset( $_GET['tab'] ) && 'free_vs_pro' === $_GET['tab'] ) {
	?>
		<div class="wrap about-wrap">

			<p class="about-description"><?php esc_html_e( 'View Free vs Pro Table below:', 'business-corporate-agency' ); ?></p>
			<div class="vs-theme-table">
				<table>
					<thead>
						<tr><th scope="col"></th>
							<th class="head" scope="col"><?php esc_html_e( 'Free Theme', 'business-corporate-agency' ); ?></th>
							<th class="head" scope="col"><?php esc_html_e( 'Pro Theme', 'business-corporate-agency' ); ?></th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><span><?php esc_html_e( 'Theme Demo Set Up', 'business-corporate-agency' ); ?></span></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Additional Templates, Color options and Fonts', 'business-corporate-agency' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Included Demo Content', 'business-corporate-agency' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Section Ordering', 'business-corporate-agency' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Multiple Sections', 'business-corporate-agency' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Additional Plugins', 'business-corporate-agency' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Premium Technical Support', 'business-corporate-agency' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Access to Support Forums', 'business-corporate-agency' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Free updates', 'business-corporate-agency' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Unlimited Domains', 'business-corporate-agency' ); ?></td>
							<td><span class="dashicons dashicons-saved"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Responsive Design', 'business-corporate-agency' ); ?></td>
							<td><span class="dashicons dashicons-saved"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Live Customizer', 'business-corporate-agency' ); ?></td>
							<td><span class="dashicons dashicons-saved"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td class="feature feature--empty"></td>
							<td class="feature feature--empty"></td>
							<td headers="comp-2" class="td-btn-2"><a class="sidebar-button single-btn" href="<?php echo esc_url(BUSINESS_CORPORATE_AGENCY_PRO_THEME_URL);?>" target="_blank"><?php esc_html_e( 'Go For Premium', 'business-corporate-agency' ); ?></a></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	<?php
	}
}

function business_corporate_agency_get_bundle() {
	if ( isset( $_GET['tab'] ) && 'get_bundle' === $_GET['tab'] ) {
	?>
		<div class="wrap about-wrap">

			<p class="about-description"><?php esc_html_e( 'Get WordPress Theme Bundle', 'business-corporate-agency' ); ?></p>
			<div class="col card">
				<h2 class="title"><?php esc_html_e( ' WordPress Theme Bundle of 100+ Themes At 15% Discount. ', 'business-corporate-agency' ); ?></h2>
				<p><?php esc_html_e( 'Spring Offer Is To Get WP Bundle of 100+ Themes At 15% Discount use the coupon', 'business-corporate-agency' ) ?>"<input type="text" value=" TPRIDE15 "  id="myInput">".</p>
				<p><a target="_blank" href="<?php echo esc_url( BUSINESS_CORPORATE_AGENCY_THEME_BUNDLE ); ?>" class="button button-primary"><?php esc_html_e( 'Theme Bundle', 'business-corporate-agency' ); ?></a></p>
			</div>
		</div>
	<?php
	}
}