<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package indofinance
 */

	$layout_setting = get_theme_mod( 'indofinance_blog_layout_choice', 'boxed' );
	get_header(null, ['page-layout' => $layout_setting]);
?>
	<header class="page-header boxed">
		<h1><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'indofinance' ); ?></h1>
	</header><!-- .page-header -->

	<main id="primary" class="site-main boxed">

		<section class="error-404 not-found">
			<div class="page-content">
				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'indofinance' ); ?></p>

				<?php get_search_form(); ?>

			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
