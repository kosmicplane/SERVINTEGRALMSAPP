<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Atua
 */
?>
<div id="post-<?php the_ID(); ?>" <?php post_class('dt_post_item dt_posts--one dt-mb-4'); ?>>
	<div class="dt_post_wrap">
		<div class="dt_post_front">
			<?php if ( has_post_thumbnail() ) { ?>
				<div class="dt_post_image">
					<a href="<?php echo esc_url( get_permalink() ); ?>">
						<?php the_post_thumbnail(); ?>
					</a>
				</div>
			<?php } ?>
			<div class="dt_post_inner">
				<div class="dt_post_date"><i class="far fa-calendar-check dt-mr-2" aria-hidden="true"></i> <?php echo esc_html(get_the_date('M, D, Y')); ?></div>
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
				<div class="dt_post_author">
					<?php  $user = wp_get_current_user(); ?>
					<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>">
						<img src="<?php echo esc_url( get_avatar_url( $user->ID ) ); ?>" width="90" height="90" alt="<?php esc_attr(the_author()); ?>" class="avatar"/>
						<span><?php esc_html(the_author()); ?></span>
					</a>
				</div>
			</div>
		</div>
		<div class="dt_post_back bg-image" style="background-image: url(<?php the_post_thumbnail_url(); ?>);">
			<div class="dt_post_inner">
				<div class="dt_post_catetag">
					<i class="dt-mr-2 fas fa-folder" aria-hidden="true"></i>
					<a href="<?php echo esc_url( get_permalink() ); ?>" rel="category tag"><?php the_category(' , '); ?></a>
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
			</div>
		</div>
	</div>
</div>