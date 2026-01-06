<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Corpex
 */

get_header(); 
?>
<section class="blog-section blog-single">
	<div class="container">
	<?php do_action('blog_header_content'); ?>
		<div class="row">
			<div class="<?php esc_attr(corpex_blog_column_layout()); ?>">
				<div class="row">
					<div class="col-lg-12">
						<div class="blog-page">
							<?php if( have_posts() ): ?>
								<?php while( have_posts() ): the_post(); ?>
									<?php get_template_part('template-parts/content/content','page'); ?> 
								<?php endwhile; ?>
							<?php endif; ?>
							<hr>
							<?php comments_template( '', true ); // show comments  ?>
						</div>
					</div>
				</div>
			</div>				
			<?php get_sidebar(); ?>
		</div>
	</div>
</section>
<?php get_footer(); ?>
