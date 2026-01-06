
<?php $number_of_posts = get_theme_mod('indofinance_featured_posts_slider_number', 4);
$order = get_theme_mod('indofinance_featured_posts_slider_order', 'DESC');
$category = get_theme_mod('indofinance_featured_posts_slider_category');

$enable_fp_slider = get_theme_mod('indofinance_featured_posts_enable');


$featured_post_slider_args = array(
    'posts_per_page'      => $number_of_posts,
    'ignore_sticky_posts' => 1,
    'order'               => $order,
    'cat'                 => $category,
);

$featured_post_slider = new WP_Query($featured_post_slider_args);

if($enable_fp_slider):
if ($featured_post_slider->have_posts()) {
    echo '<div class="swiper-wrapper">';
    echo '<div class="swiper-container">';
    while ($featured_post_slider->have_posts()) {
        $featured_post_slider->the_post();

        $link = get_permalink();
        $title = get_the_title();
        $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'large'); // Retrieve the URL of the featured image

        // Each post as a swiper slide
        echo '<div class="swiper-slide" style="background-image: url(' . esc_url($thumbnail_url) . ');">';
        echo '<div class="slide-overlay">';
        echo '<div class="post-details-wrapper">';
        // Display post category
        $categories = get_the_category();
        if (!empty($categories)) {
            echo '<div class="post-category">' . esc_html($categories[0]->name) . '</div>';
        }
        echo '<a href="' . esc_url($link) . '" title="' . esc_attr($title) . '">';
        echo '<h2 class="slide-title">' . esc_html($title) . '</h2>';
        echo '</a>';
        // Display post author and date
        echo '<div class="post-meta">';
        echo '<span class="post-author">' . esc_html__('By', 'indofinance') . ' ' . get_the_author() . '</span>';
        echo '<span class="post-date">' . esc_html(get_the_date()) . '</span>';
        echo '</div>'; // End of .post-meta
        echo '</div>'; // End of .post-details-wrapper
        echo '</div>'; // End of .slide-overlay
        echo '</div>'; // End of .swiper-slide
    }

    echo '</div>'; // End of .swiper-wrapper

    // Swiper pagination and navigation
    echo '</div>'; // End of .swiper-container
}
endif;
wp_reset_postdata();?>