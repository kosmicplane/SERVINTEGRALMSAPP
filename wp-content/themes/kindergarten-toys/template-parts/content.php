<?php
/**
 * The default template for displaying content
 * @package Kindergarten Toys
 * @since 1.0.0
 */

$kindergarten_toys_default = kindergarten_toys_get_default_theme_options();
$kindergarten_toys_image_size = get_theme_mod('kindergarten_toys_archive_image_size', 'medium');
global $kindergarten_toys_archive_first_class; 
$kindergarten_toys_archive_classes = [
    'theme-article-post',
    'theme-article-animate',
    $kindergarten_toys_archive_first_class
];?>

<article id="post-<?php the_ID(); ?>" <?php post_class($kindergarten_toys_archive_classes); ?>>
    <div class="theme-article-image">
        <?php if ( get_theme_mod('kindergarten_toys_display_archive_post_image', true) == true ) : ?>
            <div class="entry-thumbnail">
                <?php
                if ( is_search() || is_archive() || is_front_page() ) {

                    $kindergarten_toys_image_size = get_theme_mod('kindergarten_toys_archive_image_size', 'medium');

                    $kindergarten_toys_image_size_class_map = array(
                        'full'      => 'data-bg-large',
                        'large'     => 'data-bg-big',
                        'medium'    => 'data-bg-medium',
                        'small'     => 'data-bg-small',
                        'xsmall'    => 'data-bg-xsmall',
                        'thumbnail' => 'data-bg-thumbnail',
                    );

                    $kindergarten_toys_image_size_class = isset( $kindergarten_toys_image_size_class_map[ $kindergarten_toys_image_size ] )
                        ? $kindergarten_toys_image_size_class_map[ $kindergarten_toys_image_size ]
                        : 'data-bg-medium';

                    if ( has_post_thumbnail() ) {
                        $kindergarten_toys_featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), $kindergarten_toys_image_size );
                        $kindergarten_toys_featured_image = isset( $kindergarten_toys_featured_image[0] ) ? $kindergarten_toys_featured_image[0] : '';
                    } else {
                        $kindergarten_toys_featured_image = get_template_directory_uri() . '/assets/images/default.jpg';
                    }
                    ?>
                    <div class="post-thumbnail data-bg <?php echo esc_attr( $kindergarten_toys_image_size_class ); ?>"
                        data-background="<?php echo esc_url( $kindergarten_toys_featured_image ); ?>">
                        <a href="<?php the_permalink(); ?>" class="theme-image-responsive" tabindex="0"></a>
                    </div>
                    <?php
                } else {
                    kindergarten_toys_post_thumbnail( $kindergarten_toys_image_size );
                }

                if ( get_theme_mod( 'kindergarten_toys_display_archive_post_format_icon', true ) ) :
                    kindergarten_toys_post_format_icon();
                endif;
                ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="theme-article-details">
        <?php if ( get_theme_mod('kindergarten_toys_display_archive_post_category', true) == true ) : ?>  
            <div class="entry-meta-top">
                <div class="entry-meta">
                    <?php kindergarten_toys_entry_footer($cats = true, $tags = false, $edits = false); ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if ( get_theme_mod('kindergarten_toys_display_archive_post_title', true) == true ) : ?>
            <header class="entry-header">
                <h2 class="entry-title entry-title-medium">
                    <a href="<?php the_permalink(); ?>" rel="bookmark">
                        <span><?php the_title(); ?></span>
                    </a>
                </h2>
            </header>
        <?php endif; ?>
        <?php if ( get_theme_mod('kindergarten_toys_display_archive_post_content', true) == true ) : ?>
            <div class="entry-content">

                <?php
                if (has_excerpt()) {

                    the_excerpt();

                } else {

                    echo '<p>';
                    echo esc_html(wp_trim_words(get_the_content(), get_theme_mod('kindergarten_toys_excerpt_limit', 20), '...'));
                    echo '</p>';
                }

                wp_link_pages(array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'kindergarten-toys'),
                    'after' => '</div>',
                )); ?>
            </div>
        <?php endif; ?>
        <?php if ( get_theme_mod('kindergarten_toys_display_archive_post_button', true) == true ) : ?>
            <a href="<?php the_permalink(); ?>" rel="bookmark" class="theme-btn-link">
            <span> <?php esc_html_e('Read More', 'kindergarten-toys'); ?> </span>
            <span class="topbar-info-icon"><?php kindergarten_toys_the_theme_svg('arrow-right-1'); ?></span>
            </a>
        <?php endif; ?>
    </div>
</article>