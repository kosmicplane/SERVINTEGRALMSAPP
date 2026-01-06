<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Atua
 */

get_header();
?>
<section id="dt_posts" class="dt_posts dt-py-default">
	<div class="dt-container">
		<div class="dt-row dt-g-4">
			<?php if (  !is_active_sidebar( 'atua-sidebar-primary' ) ): ?>
				<div class="dt-col-lg-12 dt-col-md-12 dt-col-12 wow fadeInUp">
			<?php else: ?>	
				<div id="primary" class="dt-col-lg-8 dt-col-md-12 dt-col-12 wow fadeInUp">
			<?php endif; ?>	
				<?php if( have_posts() ): ?>
				<?php 
				// Start the loop.
				while( have_posts() ): the_post(); ?>
				<article class="dt_post_item dt_posts--one single-post wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
					<div class="dt_post_wrap">
						<?php if ( has_post_thumbnail() ) { ?>
							<div class="dt_post_image">
								<a href="<?php echo esc_url( get_permalink() ); ?>">
									<?php the_post_thumbnail(); ?>
								</a>
							</div>
						<?php } ?>
						<div class="dt_post_inner">
							<div class="dt_post_top_meta">
								<ul class="dt_post_top_meta_list">
									<li>
										<div class="dt_post_author">
											<?php  $user = wp_get_current_user(); ?>
											<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>">
												<img src="<?php echo esc_url( get_avatar_url( $user->ID ) ); ?>" width="90" height="90" alt="<?php esc_attr(the_author()); ?>" class="avatar"/>
												<span><?php esc_html(the_author()); ?></span>
											</a>
										</div>
									</li>
									<li>
										<div class="dt_post_date"><i class="far fa-calendar-check dt-mr-2" aria-hidden="true"></i> <?php echo esc_html(get_the_date('M, D, Y')); ?></div>
									</li>
									<li>
										<div class="dt_post_catetag">
											<i class="dt-mr-2 fas fa-folder" aria-hidden="true"></i>
											<a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_category(' , '); ?></a>
										</div>
									</li>                                            
								</ul>
							</div>
							<?php     
								if ( is_single() ) :
								
								the_title('<h5 class="dt_post_title">', '</h5>' );
								
								else:
								
								the_title( sprintf( '<h5 class="dt_post_title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' );
								
								endif; 
							?> 
							<div class="dt_post_content">
								<?php 
									the_content( 
										sprintf( 
											__( 'Read More', 'atua' ), 
											'<span class="screen-reader-text">  '.esc_html(get_the_title()).'</span>' 
										) 
									);
								?>
							</div>
							<div class="dt_post_bottom_meta">
								<div class="dt_post_meta pull-left">
									<div class="dt_post_tags">
										 <?php the_tags('', ' ', ''); ?>
									</div>
								</div>
								<div class="dt_post_meta pull-right">
									 <div class="dt_post_comment"></div>
								</div>
							</div>
						</div>
					</div>
				</article>
				<?php endwhile;
				// End the loop.
				endif; ?>
				<?php comments_template( '', true ); // show comments  ?>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>
</section>
<?php get_footer(); ?>