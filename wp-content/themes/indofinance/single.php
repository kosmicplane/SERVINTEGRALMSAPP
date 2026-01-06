<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package indofinance
 */


// Whether to show title or not
$title_setting = get_theme_mod('indofinance_single_title_enable', '1');

// Get sidebar choice from Customizer
$single_sidebar_choice = get_theme_mod('indofinance_single_sidebar', 'right');

// Determine the grid class for the main content area
$content_grid_class = $single_sidebar_choice === 'right' ? 'md-9' : 'md-12';

// Check if layout is full width
$layout = get_theme_mod('indofinance_single_layout', 'boxed');


$is_full_width = $layout === 'full-width';

get_header(null, ['page-layout' => $layout]);
if ( !empty( $title_setting ) ) {
    if ( is_singular() ) :
        printf(
            '<div class="post-title">
                <div class="%s">
                    <h1>%s</h1>
                </div>
            </div>',
            esc_attr( get_theme_mod('indofinance_single_layout', 'boxed') ),
            esc_html( get_the_title() )
        );
    else :
        printf(
            '<div class="post-title">
                <div class="%s">
                    <h2<a href="%s" rel="bookmark">%s</a></h2>
                </div>
            </div>',
            esc_attr( get_theme_mod('indofinance_single_layout', 'boxed') ),
            esc_url( get_permalink() ),
            esc_html( get_the_title() )
        );
    endif;
}
?>

<div class="content <?php echo esc_attr( get_theme_mod( 'indofinance_single_layout', 'boxed' ) ); ?>">
    <div class="blog-wrapper">
        <main id="primary" class="site-main single-content <?php echo esc_attr($content_grid_class); ?>">
            <div class="entry-content">
            <?php
            while (have_posts()) :
                the_post();

                get_template_part('template-parts/content', 'single');

                the_post_navigation(
                    array(
                        'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'indofinance') . '</span> <span class="nav-title">%title</span>',
                        'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'indofinance') . '</span> <span class="nav-title">%title</span>',
                    )
                );

                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;

            endwhile; // End of the loop.
            ?>
            </div>
        </main><!-- #main -->

            <?php
            // If sidebar is enabled and layout is not full width, display it
            if ($single_sidebar_choice === 'right' && !$is_full_width) :
                get_sidebar(null, ['sidebar' => $single_sidebar_choice]);
            endif;
            ?>
    </div>
    </div>
<?php
get_footer();
?>
