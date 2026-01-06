<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package remote_startup_solutions
 */
$remote_startup_solutions_footer_background = get_theme_mod('footer_background_image');
$remote_startup_solutions_footer_background_url = '';
if(!empty($remote_startup_solutions_footer_background)){
    $remote_startup_solutions_footer_background = absint($remote_startup_solutions_footer_background);
    $remote_startup_solutions_footer_background_url = wp_get_attachment_url($remote_startup_solutions_footer_background);
}

$footer_background_color = get_theme_mod('footer_background_color', '#121212'); // New line

$remote_startup_solutions_footer_background_style = '';
if (!empty($remote_startup_solutions_footer_background_url)) {
    $remote_startup_solutions_footer_background_style = ' style="background-image: url(\'' . esc_url($remote_startup_solutions_footer_background_url) . '\'); background-repeat: no-repeat; background-size: cover;"';
} else {
    $remote_startup_solutions_footer_background_style = ' style="background-color: ' . esc_attr($footer_background_color) . ';"'; // Updated line
}
?>

</div>
</div>
</div>
</div>

<footer class="site-footer"<?php echo($remote_startup_solutions_footer_background_style);  ?>>
    <?php if( is_active_sidebar( 'footer-one' ) || is_active_sidebar( 'footer-two' ) || is_active_sidebar( 'footer-three' ) || is_active_sidebar( 'footer-four' ) ){ ?>
        <div class="footer-t">
            <div class="container">
                <div class="row">
                    <?php 
                    if( is_active_sidebar( 'footer-one') ) {
                        echo '<div class="col">';
                        dynamic_sidebar( 'footer-one' ); 
                        echo '</div>';
                    }
                    
                    if( is_active_sidebar( 'footer-two') ) {
                        echo '<div class="col">';
                        dynamic_sidebar( 'footer-two' );
                        echo '</div>';
                    }
                    
                    if( is_active_sidebar( 'footer-three') ) {
                        echo '<div class="col">';
                        dynamic_sidebar( 'footer-three' );
                        echo '</div>';
                    }
                    
                    if( is_active_sidebar( 'footer-four' ) ) {
                        echo '<div class="col">';
                        dynamic_sidebar( 'footer-four' );
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="footer-t">
            <div class="container">
                <div class="row">
                    <!-- Archive -->
                    <aside id="archive" class="widget widget_archive col" role="complementary" aria-label="<?php esc_attr_e( 'secondsidebar', 'remote-startup-solutions' ); ?>">
                        <h2 class="widget-title"><?php esc_html_e('Archive List', 'remote-startup-solutions'); ?></h2>
                        <ul>
                            <?php wp_get_archives('type=monthly'); ?>
                        </ul>
                    </aside>
                    <!-- Recent Posts -->
                    <aside id="recent-posts" class="widget widget_recent_posts col" role="complementary" aria-label="<?php esc_attr_e( 'thirdsidebar', 'remote-startup-solutions' ); ?>">
                        <h2 class="widget-title"><?php esc_html_e('Recent Posts', 'remote-startup-solutions'); ?></h2>
                        <ul>
                            <?php
                            $args = array(
                                'post_type'      => 'post',
                                'posts_per_page' => 5,
                            );
                            $remote_startup_solutions_recent_posts = new WP_Query($args);

                            while ($remote_startup_solutions_recent_posts->have_posts()) : $remote_startup_solutions_recent_posts->the_post();
                            ?>
                                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                            <?php endwhile; ?>
                            <?php wp_reset_postdata(); ?>
                        </ul>
                    </aside>
                    <!-- Categories -->
                    <aside id="categories" class="widget widget_categories col" role="complementary" aria-label="<?php esc_attr_e( 'fourthsidebar', 'remote-startup-solutions' ); ?>">
                        <h2 class="widget-title"><?php esc_html_e('Categories', 'remote-startup-solutions'); ?></h2>
                        <ul>
                            <?php
                            $args = array(
                                'title_li' => '',
                            );
                            wp_list_categories($args);
                            ?>
                        </ul>
                    </aside>
                    <!-- Tags Widget -->
                    <aside id="tags" class="widget widget_tags col" role="complementary" aria-label="fifthsidebar">
                        <h2 class="widget-title"><?php esc_html_e('Tags', 'remote-startup-solutions'); ?></h2>
                        <div class="tag-cloud">
                            <?php wp_tag_cloud(); ?>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    <?php } 
    do_action( 'remote_startup_solutions_footer' );
    ?>
    <?php if( get_theme_mod( 'remote_startup_solutions_scroll_to_top',true) == 1 || get_theme_mod( 'remote_startup_solutions_resp_scroll_top',true) == 1) { ?>
        <a id="button"><i class="<?php echo esc_attr(get_theme_mod('remote_startup_solutions_scroll_icon','fas fa-arrow-up')); ?>"></i></a>
    <?php } ?>
</footer>
</div>
</div>

<?php wp_footer(); ?>

</body>
</html>
