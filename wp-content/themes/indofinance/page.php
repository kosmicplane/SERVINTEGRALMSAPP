<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package indofinance
 */

$is_front = is_front_page();
$sidebar_setting	= is_front_page() ? get_theme_mod('indofinance_front_sidebar_choice', 'right') : get_post_meta( get_the_ID(), 'enable-sidebar', true );
$layout_setting		= is_front_page() ? get_theme_mod('indofinance_front_layout_choice', 'boxed') : get_post_meta( get_the_ID(), 'layout', true );
$title_setting		= is_front_page() ? get_theme_mod('indofinance_front_title_enable', '1') : get_post_meta( get_the_ID(), 'show-title', true );
get_header(null, ['page-layout' => $layout_setting]);

	if ( !empty( $title_setting ) ) {
		printf(
			'<div class="page-title">
				<div class="%s">
					<h1>%s</h1>
				</div>
			</div>',
			esc_attr( $layout_setting ),
			get_the_title()
		);
	}
	?>

	<div class="content <?php echo esc_attr( $layout_setting ); if ( $sidebar_setting === 'right' ) echo ' has-sidebar'; ?>">
		<main id="primary" class="site-main <?php echo $sidebar_setting === 'right'? 'md-9' : 'md-12'; ?>">
			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->

		<?php
			if ( $sidebar_setting === 'right'  && is_active_sidebar( 'sidebar-1' ) && $layout_setting !== 'full-width' ) {
				get_sidebar( NULL, ['sidebar' => $sidebar_setting]);
			}
		?>
	</div><!-- .content -->

<?php
get_footer();
