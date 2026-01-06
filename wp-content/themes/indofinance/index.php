<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package indofinance
 */

$title_setting = get_theme_mod('indofinance_blog_title_enable', '');
$sidebar_choice = get_theme_mod('indofinance_sidebar_choice', 'none');
$has_left_sidebar = is_active_sidebar('sidebar-2') && in_array( $sidebar_choice, ['left', 'dual'] );
$has_right_sidebar = is_active_sidebar('sidebar-1') && in_array( $sidebar_choice, ['right', 'dual'] );
$layout_setting = get_theme_mod( 'indofinance_blog_layout_choice', 'boxed' );

get_header(null, ['page-layout' => $layout_setting]);

if ( !empty( $title_setting ) ) {
    printf(
        '<div class="blog-title">
            <div class="%s">
                <h1>%s</h1>
            </div>
        </div>',
        esc_attr( $layout_setting ),
        __('Blog', 'indofinance')
    );
}
?>

<?php

$slider_width_class = get_theme_mod( 'indofinance_featured_posts_slider_width', 'boxed' );
$featured_categories = get_theme_mod('indofinance-fa-category-section','boxed');
$featured_categories_width = get_theme_mod('indofinance-fa-category_width','boxed');
$featured_area_enable = get_theme_mod('indofinance_fa-style_enable','boxed');

$featured_area_width = get_theme_mod('indofinance_featured_posts_width','boxed');
$widget_before_content = get_theme_mod('indofinance_featured_posts_widgets_before_content_width','boxed');
$featured_categories_width = get_theme_mod('indofinance-fa-category_width');
?>
<div class="ticker-outer">
    <div class="ticker-wrapper <?php echo esc_attr($layout_setting); ?>">
        <?php get_template_part('template-parts/featured-area/ticker'); ?>
    </div>
</div>
<div class="slider-wrapper <?php echo esc_attr($slider_width_class); ?>">
    <?php get_template_part('template-parts/post-slider/featured-posts-slider'); ?>
</div>

<?php if ($featured_categories) : ?>
    <div class="featured-category-wrapper <?php echo esc_attr($featured_categories_width); ?>">
        <?php get_template_part('template-parts/featured-category/featured-category'); ?>
    </div>
<?php endif; ?>

<?php if ($featured_area_enable) : ?>
    <div class="featured-area-wrapper <?php echo esc_attr($featured_area_width); ?>">
        <?php get_template_part('template-parts/featured-area/featured-area'); ?>
    </div>
<?php endif; ?>

<div class="content <?php echo esc_attr($widget_before_content);?>">
    <?php get_template_part('template-parts/widget-content-before/widget-before-content'); ?>
</div>

<div class="main-content-area <?php echo esc_attr($layout_setting); ?>">
    <div class="blog-wrapper">
        <?php if ($has_left_sidebar) : ?>
            <aside class="md-3 theme-sidebar <?php if ($sidebar_choice === 'left') echo esc_attr($sidebar_choice); ?>" id="secondary-sidebar">
                <?php dynamic_sidebar('sidebar-2'); ?>
            </aside>
        <?php endif; ?>

            <main id="primary"><?php
            $blog_layout = get_theme_mod('indofinance_blog_layout', 'card'); // or 'card'
            
            $main_classes = [
                'main-content',
                'site-main',
                'md-' . (!$has_left_sidebar && !$has_right_sidebar ? '12' : ($sidebar_choice === 'dual' ? '6' : '9')),
            ];

            if ($blog_layout === 'card') {
                $main_classes[] = 'card-layout';
            }?>

            <div class=" card-ast-wrapper <?php echo esc_attr(implode(' ', $main_classes)); ?>">
            <?php
        
            if (have_posts()) :

                while (have_posts()) :
                    the_post();
                    if ($blog_layout === 'classic') {
                        get_template_part('template-parts/blog-style/content');
                    } else {
                        get_template_part('template-parts/blog-style/content-style2');
                    }
                    

                endwhile;

               ob_start(); 
             
                the_posts_pagination(apply_filters('indofinance_posts_pagination_args', array(
                    'class' => 'indofinance-pagination',
                    'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12l4.58-4.59z"/></svg>',
                    'next_text' => '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M10.02 6L8.61 7.41 13.19 12l-4.58 4.59L10.02 18l6-6-6-6z"/></svg>'
                )));
               
          $pagination_output = ob_get_clean(); 
            

            else :

                get_template_part('template-parts/content', 'none');

            endif;
            ?>
            </div>
        </main><!-- #primary -->

        <?php if ($has_right_sidebar) : ?>
            <aside class="main-sidebar theme-sidebar md-3 secondary-content" id="right-sidebar">
                <?php dynamic_sidebar('sidebar-1'); ?>
            </aside>
        <?php endif; ?>
    </div><!-- .blog-wrapper -->
</div><!-- .main-content-area -->
<?php if (!empty($pagination_output)) : ?>
            <div class="asst-pagination <?php echo esc_attr($layout_setting); ?>">
                <?php echo $pagination_output; ?>
            </div>
        <?php endif; ?>

<?php
get_footer();