<?php 
	$blog_hs				=	get_theme_mod('blog_hs','1');
	$blog_num				=	get_theme_mod('blog_num','3');
	
if($blog_hs == 1){	
?>
<section class="blog-section post-home">
    <div class="container">
		<?php do_action('blog_header_content'); ?>
		<div>
			<div class="row">
				<?php 
					$corpex_blog_args = array( 'post_type' => 'post', 'posts_per_page' => $blog_num,'post__not_in'=>get_option("sticky_posts")) ; 	
				
					$corpex_wp_query = new WP_Query($corpex_blog_args);
					if($corpex_wp_query)
					{	
					while($corpex_wp_query->have_posts()):$corpex_wp_query->the_post();
				?>
					<?php get_template_part('template-parts/content/content','page'); ?>
				<?php endwhile; } wp_reset_postdata(); ?>
			</div>
		</div>
	</div>
</section>
<?php } ?>