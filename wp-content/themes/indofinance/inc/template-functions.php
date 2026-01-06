<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package indofinance
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function indofinance_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'indofinance_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function indofinance_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'indofinance_pingback_header' );

/**
 * Change the excerpt more string
 */

function indofinance_excerpt_more($more) {
	if (!is_admin()) {
		global $post;

		// Check if the "Disable Read More" setting is enabled
		$enable_read_more = get_theme_mod('indofinance-disable-readmore_set', true);

		if ($enable_read_more) {
			// Append "Read More" link to excerpt
			$more_link = sprintf(' <br><a class="read-more" href="%s"><span>%s</span></a>',
				esc_url(get_permalink($post->ID)),
				__('Keep Reading...', 'indofinance') // Customize the "Read More" text
			);

			return ' ...' . $more_link;
		} else {
			// Return ellipsis if "Disable Read More" setting is disabled
			return ' ...';
		}
	}

	return $more;
}
add_filter('excerpt_more', 'indofinance_excerpt_more');

/**
 * Custom Color functionality
 */
function indofinance_custom_color() {
    $primary_color   = get_theme_mod('indofinance_theme_color', '#ffc906');
    $secondary_color = get_theme_mod('indofinance_secondary_color', '#101828');
    $light_color     = get_theme_mod('indofinance_light_color', '#ffffff');
    $header_color    = get_theme_mod('indofinance_header_color', '#182d57');

    $css = ":root { 
        --primary-color: {$primary_color}; 
        --secondary-color: {$secondary_color}; 
        --light-color: {$light_color}; 
        --header-bg: {$header_color}; 
    }";

    wp_add_inline_style('indofinance-main-css', $css);
}
add_action('wp_enqueue_scripts', 'indofinance_custom_color');



/**
 * Filter the header searchform
 *
 * @param   string  $form  HTML Tag
 * @param   array  	$args  The array of arguments for building the search form.
 *
 * @return  string $form	Filtered Searchform HTML
 */

function indofinance_header_searchform() {
    ?>
    <div id="searchOverlay" class="search-overlay">
        <button id="searchClose" class="search-close">&times;</button>
        <div class="search__form-wrapper">
		<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
                <input type="search" name="s" class="search__input" placeholder="Search..." required>
                <p class="search-instruction">Type above and press Enter to search. Press Esc to cancel.</p>
            </form>
        </div>
    </div>
    <?php
}
add_action('wp_footer', 'indofinance_header_searchform');



function indofinance_after_header_sidebar( $enable = true, $layout = 'boxed' ) {
	if (is_active_sidebar('after-header') && !empty($enable)) {
		?>
		<div class="indofinance-after-header-area <?php echo esc_attr( $layout ); ?>">
			<?php dynamic_sidebar('after-header'); ?>
		</div>
	<?php
	}
}