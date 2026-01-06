<?php
$enable_featured_area = get_theme_mod('indofinance_fa_post_enable');
$enable_featured_area_title = get_theme_mod('indofinance_fa_title');
$featured_category = get_theme_mod('indofinance_fa_post_category');

if (!$enable_featured_area) : ?>
    <h2 class="fa-posts-title"><?php echo esc_html($enable_featured_area_title ? $enable_featured_area_title : 'Trending Posts'); ?></h2>
    <div class="featured-posts-main">
        <?php
        // Query for the latest four posts in the selected category
        $featured_query = new WP_Query(array(
            'posts_per_page' => 4,
            'post_status' => 'publish',
            'cat' => $featured_category,
        ));

        // Check if there are posts
        if ($featured_query->have_posts()) :
            $count = 0;

            // Start the loop
            while ($featured_query->have_posts()) : $featured_query->the_post();
                // Determine post class based on count
                if ($count == 0) {
                    $post_class = 'post-large'; // 1st post takes full width
                } elseif ($count == 1) {
                    $post_class = 'post-medium'; // 2nd post takes full width
                } elseif ($count == 2) {
                    $post_class = 'post-small'; // 3rd post (half width)
                } else {
                    $post_class = 'post-small'; // 4th post (half width)
                }
                $thumbnail_size = ($count == 0) ? 'large' : 'medium';
        ?>
                <?php if ($count == 2): // Start of wrapper for 3rd and 4th post ?>
                    <div class="post-wrapper">
                <?php endif; ?>

                <div class="post-featured <?php echo esc_attr($post_class); ?>" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID())); ?>');">
                    <div class="post-content">
                        <div class="post-category"><?php the_category(); ?></div>
                        <a href="<?php the_permalink(); ?>">
                            <<?php echo ($count == 0 || $count == 1) ? 'h2' : 'h3'; ?> class="fp-title"><?php the_title(); ?></<?php echo ($count == 0 || $count == 1) ? 'h2' : 'h3'; ?>>
                        </a>
                        <div class="post-meta">
                            <span class="post-author"><?php the_author(); ?></span>
                            <span class="post-date"><?php the_date(); ?></span>
                        </div>
                    </div>
                    <div class="box-shadow"></div>
                </div>

                <?php if ($count == 3): // End of wrapper for 3rd and 4th post ?>
                    </div>
                <?php endif; ?>

        <?php
                $count++;
            endwhile;
            wp_reset_postdata();
        else :
            echo '<p>No posts found.</p>';
        endif;
        ?>
    </div>
<?php endif; ?>