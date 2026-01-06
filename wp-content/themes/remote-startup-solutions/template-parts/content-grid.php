<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package remote_startup_solutions
 */
$remote_startup_solutions_heading_setting  = get_theme_mod( 'remote_startup_solutions_post_heading_setting' , true );
$remote_startup_solutions_meta_setting  = get_theme_mod( 'remote_startup_solutions_post_meta_setting' , true );
$remote_startup_solutions_image_setting  = get_theme_mod( 'remote_startup_solutions_post_image_setting' , true );
$remote_startup_solutions_content_setting  = get_theme_mod( 'remote_startup_solutions_post_content_setting' , true );
$remote_startup_solutions_read_more_setting = get_theme_mod( 'remote_startup_solutions_read_more_setting' , true );
$remote_startup_solutions_read_more_text = get_theme_mod( 'remote_startup_solutions_read_more_text', __( 'Read More', 'remote-startup-solutions' ) );
?>

<div class="col-lg-4 col-md-6">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php 
    $remote_startup_solutions_meta_order = get_theme_mod('remote_startup_solutions_blog_meta_order', array('heading', 'author', 'featured-image', 'content', 'button'));
    
    foreach ($remote_startup_solutions_meta_order as $remote_startup_solutions_order) :
        if ('heading' === $remote_startup_solutions_order) :
            if ($remote_startup_solutions_heading_setting) { ?>
                <header class="entry-header">
                    <?php if (is_single()) {
                        the_title('<h1 class="entry-title" itemprop="headline">', '</h1>');
                    } else {
                        the_title('<h2 class="entry-title" itemprop="headline"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                    } ?>
                </header>
            <?php }
        endif;

        if ('author' === $remote_startup_solutions_order) :
            if ('post' === get_post_type() && $remote_startup_solutions_meta_setting) { ?>
                <div class="entry-meta">
                    <?php remote_startup_solutions_posted_on(); ?>
                </div>
            <?php }
        endif;

        if ('featured-image' === $remote_startup_solutions_order) :
            if ($remote_startup_solutions_image_setting) { ?>
                <?php echo (!is_single()) ? '<a href="' . esc_url(get_the_permalink()) . '" class="post-thumbnail">' : '<div class="post-thumbnail">'; ?>
                    <?php if (has_post_thumbnail()) {
                        if (is_active_sidebar('right-sidebar')) {
                            the_post_thumbnail('remote-startup-solutions-with-sidebar', array('itemprop' => 'image'));
                        } else {
                            the_post_thumbnail('remote-startup-solutions-without-sidebar', array('itemprop' => 'image'));
                        }
                    } else { ?>
                        <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/images/default-header.png'); ?>">
                    <?php } ?>
                <?php echo (!is_single()) ? '</a>' : '</div>'; ?>
            <?php }
        endif;

        if ('content' === $remote_startup_solutions_order) :
            if ($remote_startup_solutions_content_setting) { ?>
                <div class="entry-content" itemprop="text">
                    <?php if (is_single()) {
                        the_content(
                            sprintf(
                                wp_kses(
                                    __('Continue reading %s <span class="meta-nav">&rarr;</span>', 'remote-startup-solutions'),
                                    array('span' => array('class' => array()))
                                ),
                                '<span class="screen-reader-text">"' . get_the_title() . '"</span>'
                            )
                        );
                    } else {
                        the_excerpt();
                    }
                    
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'remote-startup-solutions'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>
            <?php }
        endif;

        if ('button' === $remote_startup_solutions_order) :
            if (!is_single() && $remote_startup_solutions_read_more_setting) { ?>
                <div class="read-more-button">
                    <a href="<?php echo esc_url(get_permalink()); ?>" class="read-more-button"><?php echo esc_html($remote_startup_solutions_read_more_text); ?></a>
                </div>
            <?php }
        endif;
    endforeach; ?>
</article>
</div>