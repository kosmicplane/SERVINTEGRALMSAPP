<?php
$posts_count = get_theme_mod('indofinance_ticker_posts_count', 5);
$enable_ticker = get_theme_mod('indofinance_ticker_enable', 1);

$query_args = array(
    'post_type'      => 'post',
    'posts_per_page' => $posts_count,
    'post_status'    => 'publish',
);

$ticker_query = new WP_Query($query_args);

if ($enable_ticker && $ticker_query->have_posts()) : ?>
    <div class="indofinance-ticker">
        <div class="ticker-header">
            <span class="ticker-title"><?php echo esc_html__('Trending Now', 'indofinance'); ?></span>
        </div>
        <div class="ticker-content">
            <div class="ticker-track">
                <?php while ($ticker_query->have_posts()) : $ticker_query->the_post(); ?>
                    <div class="ticker-item">
                        <span class="ticker-date"><?php echo get_the_date(); ?></span>
                        <a href="<?php the_permalink(); ?>" class="ticker-link">
                            <?php the_title(); ?>
                        </a>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>

                <!-- Duplicate for smooth infinite scrolling -->
                <?php 
                $ticker_query = new WP_Query($query_args);
                while ($ticker_query->have_posts()) : $ticker_query->the_post(); ?>
                    <div class="ticker-item">

                        <a href="<?php the_permalink(); ?>" class="ticker-link">
                            <?php the_title(); ?>
                        </a>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
<?php endif; ?>

