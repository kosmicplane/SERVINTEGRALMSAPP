<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package indofinance
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="blog-wrapper">
		<div class="md-9 post-content">
			<header class="entry-header">
				<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

				<?php if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<?php
					indofinance_posted_on();
					indofinance_posted_by();
					?>
				</div><!-- .entry-meta -->
				<?php endif; ?>
			</header><!-- .entry-header -->

			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->

			<footer class="entry-footer">
				<?php indofinance_entry_footer(); ?>
			</footer><!-- .entry-footer -->
		</div>

		<div class="md-3 secondary-content">
			<div class="thumbnail-wrapper">
			<?php indofinance_post_thumbnail();?>
			</div>
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->