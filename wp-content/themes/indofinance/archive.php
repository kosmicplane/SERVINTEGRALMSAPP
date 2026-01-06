<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package indofinance
 */

$title_setting = get_theme_mod('indofinance_archive_title_enable', '1');
$layout_setting = get_theme_mod('indofinance_archive_layout_choice', 'boxed');
$sidebar_setting = get_theme_mod('indofinance_archive_sidebar_choice', 'right');

get_header(null, ['page-layout' => $layout_setting]);

if (!empty($title_setting)) {
	printf(
        '<div class="blog-title">
            <div class="%s">
                <h1>%s</h1>
				<p class="archive-description">%s</p>
            </div>
        </div>',
        esc_attr( $layout_setting ),
    	get_the_archive_title(),
       	get_the_archive_description()
    );
}
?>
	

	<div class="content <?php echo esc_attr( $layout_setting ); if ( $sidebar_setting === 'right' ) echo ' has-sidebar'; ?>">
		<main id="primary" class="site-main <?php if ( $sidebar_setting === 'right' ) echo "md-9"; ?>">

			<?php if ( have_posts() ) : ?>

				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/*
					* Include the Post-Type-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Type name) and that will be used instead.
					*/
					get_template_part( 'template-parts/blog-style/content', get_post_type() );

				endwhile;

				the_posts_navigation();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>

		</main><!-- #main -->

	<?php
	get_sidebar(null, ['sidebar' => $sidebar_setting]);
	?>
	</div><!-- .content -->
<?php
get_footer();
