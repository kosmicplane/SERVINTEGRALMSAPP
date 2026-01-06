<?php
/**
 * The template for displaying single posts and pages.
 * @package Kindergarten Toys
 * @since 1.0.0
 */

get_header();

$kindergarten_toys_default = kindergarten_toys_get_default_theme_options();
$kindergarten_toys_global_layout = get_theme_mod('kindergarten_toys_global_sidebar_layout', $kindergarten_toys_default['kindergarten_toys_global_sidebar_layout']);
$kindergarten_toys_page_layout = get_theme_mod('kindergarten_toys_page_sidebar_layout', $kindergarten_toys_global_layout);
$kindergarten_toys_post_layout = get_theme_mod('kindergarten_toys_post_sidebar_layout', $kindergarten_toys_global_layout);
$kindergarten_toys_post_meta = get_post_meta(get_the_ID(), 'kindergarten_toys_post_sidebar_option', true);

$kindergarten_toys_final_layout = $kindergarten_toys_global_layout;
if (!empty($kindergarten_toys_post_meta) && $kindergarten_toys_post_meta !== 'default') {
    $kindergarten_toys_final_layout = $kindergarten_toys_post_meta;
} elseif (is_page() || (function_exists('is_shop') && is_shop())) {
    $kindergarten_toys_final_layout = $kindergarten_toys_page_layout;
} elseif (is_single()) {
    $kindergarten_toys_final_layout = $kindergarten_toys_post_layout;
}

// Set content column order based on sidebar layout
$kindergarten_toys_sidebar_column_class = 'column-order-1';
if ($kindergarten_toys_final_layout === 'left-sidebar') {
    $kindergarten_toys_sidebar_column_class = 'column-order-2';
}

?>

<div id="single-page" class="singular-main-block">
    <div class="wrapper">
        <div class="column-row <?php echo esc_attr($kindergarten_toys_final_layout === 'no-sidebar' ? 'no-sidebar-layout' : ''); ?>">

            <?php if ($kindergarten_toys_final_layout === 'left-sidebar') : ?>
                <?php get_sidebar(); ?>
            <?php endif; ?>

            <div id="primary" class="content-area <?php echo esc_attr($kindergarten_toys_final_layout === 'no-sidebar' ? 'full-width-content' : $kindergarten_toys_sidebar_column_class); ?>">
                <main id="site-content" role="main">

                    <?php
                    kindergarten_toys_breadcrumb(); // Display breadcrumb

                    if (have_posts()) : ?>

                        <div class="article-wraper">
                            <?php while (have_posts()) : the_post(); ?>

                                <?php get_template_part('template-parts/content', 'single'); ?>

                                <?php if ((is_single() || is_page()) && (comments_open() || get_comments_number()) && !post_password_required()) : ?>
                                    <div class="comments-wrapper">
                                        <?php comments_template(); ?>
                                    </div>
                                <?php endif; ?>

                            <?php endwhile; ?>
                        </div>

                    <?php else : ?>

                        <?php get_template_part('template-parts/content', 'none'); ?>

                    <?php endif;

                    do_action('kindergarten_toys_navigation_action');
                    ?>

                </main>
            </div>

            <?php if ($kindergarten_toys_final_layout === 'right-sidebar') : ?>
                <?php get_sidebar(); ?>
            <?php endif; ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>