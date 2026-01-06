<?php
$kindergarten_toys_layout = kindergarten_toys_get_final_sidebar_layout();
$kindergarten_toys_sidebar_class = 'column-order-1';

if ( $kindergarten_toys_layout === 'left-sidebar' ) {
    $kindergarten_toys_sidebar_class = 'column-order-1';
} elseif ( $kindergarten_toys_layout === 'right-sidebar' ) {
    $kindergarten_toys_sidebar_class = 'column-order-2';
}

if ( $kindergarten_toys_layout !== 'no-sidebar' ) : ?>
    <aside id="secondary" class="widget-area <?php echo esc_attr( $kindergarten_toys_sidebar_class ); ?>">
        <div class="widget-area-wrapper">
            <?php if ( is_active_sidebar('sidebar-1') ) : ?>
                <?php dynamic_sidebar( 'sidebar-1' ); ?>
            <?php else : ?>
                <!-- Default widgets -->
                <div class="widget widget_block widget_search">
                    <h3 class="widget-title"><?php esc_html_e('Search', 'kindergarten-toys'); ?></h3>
                    <?php get_search_form(); ?>
                </div>
                
                <div class="widget widget_pages">
                    <h3 class="widget-title"><?php esc_html_e('Pages', 'kindergarten-toys'); ?></h3>
                    <ul>
                        <?php
                        wp_list_pages(array(
                            'title_li' => '',
                        ));
                        ?>
                    </ul>
                </div>

                <div class="widget widget_archive">
                    <h3 class="widget-title"><?php esc_html_e('Archives', 'kindergarten-toys'); ?></h3>
                    <ul>
                        <?php wp_get_archives(['type' => 'monthly', 'show_post_count' => true]); ?>
                    </ul>
                </div>

                <div class="widget widget_categories">
                    <h3 class="widget-title"><?php esc_html_e('Categories', 'kindergarten-toys'); ?></h3>
                    <ul class="wp-block-categories-list wp-block-categories">
                        <?php wp_list_categories(['orderby' => 'name', 'title_li' => '', 'show_count' => true]); ?>
                    </ul>
                </div>

                <div class="widget widget_tag_cloud">
                    <h3 class="widget-title"><?php esc_html_e('Tags', 'kindergarten-toys'); ?></h3>
                    <?php
                    $kindergarten_toys_tags = get_tags();
                    if ( $kindergarten_toys_tags ) {
                        echo '<div class="tagcloud">';
                        foreach ( $kindergarten_toys_tags as $kindergarten_toys_tag ) {
                            $kindergarten_toys_link = get_tag_link($kindergarten_toys_tag->term_id);
                            echo '<a href="' . esc_url($kindergarten_toys_link) . '" class="tag-cloud-link">' . esc_html($kindergarten_toys_tag->name) . '</a> ';
                        }
                        echo '</div>';
                    } else {
                        echo '<p>' . esc_html__('No tags found.', 'kindergarten-toys') . '</p>';
                    }
                    ?>
                </div>

            <?php endif; ?>
        </div>
    </aside>
<?php endif; ?>
