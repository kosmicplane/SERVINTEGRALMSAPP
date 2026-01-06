<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package indofinance
 */
$title_setting = get_theme_mod('indofinance_search_title_enable', '1');
$layout_setting = get_theme_mod('indofinance_search_layout', 'boxed');

get_header(null, ['page-layout' => $layout_setting]);
// Get sidebar choice from Customizer
$indofinance_search_sidebar_choice = get_theme_mod('indofinance_search_sidebar', '');

// Determine the grid class for the main content area
$content_grid_class = ($indofinance_search_sidebar_choice === 'right') ? 'md-9' : 'md-12';
if (!empty($title_setting)) {
	printf(
        '<div class="page-header">
            <div class="%s">
                <h1>%s</h1>
            </div>
        </div>',
        esc_attr( $layout_setting ),
    	'Search Results for: <span>' . get_search_query() . '</span>',
    );
}
?>

<div class="content <?php echo esc_attr(get_theme_mod('indofinance_search_layout', 'boxed')); ?>">
	<div class="blog-wrapper">
		<main id="primary" class="site-main search-content <?php echo esc_attr($content_grid_class); ?>">
			<?php if ( have_posts() ) :

				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/**
					 * Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called content-search.php and that will be used instead.
					 */
					get_template_part( 'template-parts/content', 'search' );

				endwhile;

				the_posts_pagination( apply_filters( 'indofinance_posts_pagination_args', array(
					'class'	=>	'indofinance-pagination',
					'prev_text'	=> '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12l4.58-4.59z"/></svg>',
					'next_text'	=> '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M10.02 6L8.61 7.41 13.19 12l-4.58 4.59L10.02 18l6-6-6-6z"/></svg>'
				) ) );

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>
		</main><!-- #main -->
		<?php
		// If sidebar is enabled and layout is not full width, display it
		if ($indofinance_search_sidebar_choice !== 'none') :
			get_sidebar(null, ['sidebar' => $indofinance_search_sidebar_choice]);
		endif;
		?>
	</div><!-- .blog-wrapper -->
</div><!-- .content -->

<?php
get_footer();
