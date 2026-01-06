<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package indofinance
 */

$has_thumb = has_post_thumbnail() ? 'has-thumbnail' : '';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('blog-style2 ' . $has_thumb); ?>>
    <div class="content-img-wrapper">
        <?php if (has_post_thumbnail()) : ?>
            <div class="thumbnail-wrapper-outer">
                <div class="thumbnail-wrapper">
                    <?php indofinance_post_thumbnail(); ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="post-content">
            <header class="entry-header">
                <?php
                if (is_singular()) :
                    the_title('<h1 class="entry-title">', '</h1>');
                else :
                    the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                endif;

                if ('post' === get_post_type()) :
                ?>
                    <div class="entry-meta">
                        <?php
                        indofinance_posted_on();
                        indofinance_posted_by();
                        ?>
                    </div><!-- .entry-meta -->
                <?php endif; ?>
            </header><!-- .entry-header -->

            <div class="entry-content">
                <?php
                the_excerpt();

                wp_link_pages(
                    array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'indofinance'),
                        'after'  => '</div>',
                    )
                );
                ?>
            </div><!-- .entry-content -->
        </div><!-- .post-content -->
    </div><!-- .content-img-wrapper -->
</article><!-- #post-<?php the_ID(); ?> -->