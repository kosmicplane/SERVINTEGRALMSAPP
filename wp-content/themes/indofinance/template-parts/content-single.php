<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package indofinance
 */

?>

<article class="single-style1" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	   <div class="secondary-content">
			<?php indofinance_post_thumbnail();?>
		</div>

		<?php
		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				indofinance_posted_on();
				indofinance_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'indofinance' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->

