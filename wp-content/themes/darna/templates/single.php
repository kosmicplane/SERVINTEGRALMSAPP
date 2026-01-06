<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/6/2015
 * Time: 11:37 AM
 */
global $g5plus_archive_loop;

$layout_style = g5plus_get_post_meta($post->ID, 'g5plus_page_layout', true);
if (($layout_style === '') || ($layout_style == '-1')) {
    $layout_style = g5plus_get_option('single_blog_layout','container');
}

$sidebar = g5plus_get_post_meta($post->ID, 'g5plus_page_sidebar', true);
if (($sidebar === '') || ($sidebar == '-1')) {
    $sidebar = g5plus_get_option('single_blog_sidebar','none');
}

$left_sidebar = g5plus_get_post_meta($post->ID, 'g5plus_page_left_sidebar', true);
if (($left_sidebar === '') || ($left_sidebar == '-1')) {
    $left_sidebar = g5plus_get_option('single_blog_left_sidebar','sidebar-1');
}

$right_sidebar = g5plus_get_post_meta($post->ID, 'g5plus_page_right_sidebar', true);
if (($right_sidebar === '') || ($right_sidebar == '-1')) {
    $right_sidebar = g5plus_get_option('single_blog_right_sidebar','sidebar-2');
}

$sidebar_width = g5plus_get_post_meta($post->ID, 'g5plus_sidebar_width', true);
if (($sidebar_width === '') || ($sidebar_width == '-1')) {
    $sidebar_width = g5plus_get_option('single_blog_sidebar_width','small');
}

// Calculate sidebar column & content column
$sidebar_col = 'col-md-3';
if ($sidebar_width == 'large') {
    $sidebar_col = 'col-md-4';
}
$g5plus_archive_loop['image-size'] = 'blog-classic';
$content_col_number = 12;
if (is_active_sidebar($left_sidebar) && (($sidebar == 'both') || ($sidebar == 'left'))) {
    if ($sidebar_width == 'large') {
        $content_col_number -= 4;
    } else {
        $content_col_number -= 3;
    }
    $g5plus_archive_loop['image-size'] = 'blog-classic-sidebar';
}
if (is_active_sidebar($right_sidebar) && (($sidebar == 'both') || ($sidebar == 'right'))) {
    if ($sidebar_width == 'large') {
        $content_col_number -= 4;
    } else {
        $content_col_number -= 3;
    }
    $g5plus_archive_loop['image-size'] = 'blog-classic-sidebar';
}

$content_col = 'col-md-' . $content_col_number;
if (($content_col_number == 12) && ($layout_style == 'full')) {
    $content_col = '';
}

$main_class = array('site-content-archive');
if ($content_col_number < 12) {
    $main_class[] = 'has-sidebar';
}

?>
<?php
/**
 * @hooked - g5plus_page_heading - 5
 **/
do_action('g5plus_before_page');
?>
<main role="main" class="<?php echo join(' ',$main_class) ?>">
    <?php if ($layout_style != 'full'): ?>
    <div class="<?php echo esc_attr($layout_style) ?> clearfix">
    <?php endif;?>
        <?php if (($content_col_number != 12) || ($layout_style != 'full')): ?>
        <div class="row clearfix">
            <?php endif;?>
            <?php if (is_active_sidebar( $left_sidebar ) && (($sidebar == 'left') || ($sidebar == 'both'))): ?>
                <div class="sidebar left-sidebar <?php echo esc_attr($sidebar_col) ?> hidden-sm hidden-xs">
                    <?php dynamic_sidebar( $left_sidebar );?>
                </div>
            <?php endif;?>
            <div class="site-content-archive-inner <?php echo esc_attr($content_col) ?>">
                <div class="blog-wrap">
                    <div class="blog-inner blog-single clearfix">
                        <?php
                        if ( have_posts() ) :
                            // Start the Loop.
                            while ( have_posts() ) : the_post();
                                /*
                                 * Include the post format-specific template for the content. If you want to
                                 * use this in a child theme, then include a file called called content-___.php
                                 * (where ___ is the post format) and that will be used instead.
                                 */
                                g5plus_get_template( 'single-blog/content' , get_post_format() );
                            endwhile;
                            g5plus_archive_loop_reset();
                        else :
                            // If no content, include the "No posts found" template.
                            g5plus_get_template( 'archive/content-none');
                        endif;
                        ?>
                    </div>
                </div>
                <?php comments_template(); ?>
            </div>
            <?php if (is_active_sidebar( $right_sidebar ) && (($sidebar == 'right') || ($sidebar == 'both'))): ?>
                <div class="sidebar right-sidebar <?php echo esc_attr($sidebar_col) ?> hidden-sm hidden-xs">
                    <?php dynamic_sidebar( $right_sidebar );?>
                </div>
            <?php endif;?>
            <?php if (($content_col_number != 12) || ($layout_style != 'full')): ?>
        </div>
    <?php endif;?>
        <?php if ($layout_style != 'full'): ?>
    </div>
<?php endif;?>
</main>
