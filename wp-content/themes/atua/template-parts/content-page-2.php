<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Atua
 */ 
?>
<div id="post-<?php the_ID(); ?>" <?php post_class('dt_post_item dt_posts--one single-post style2 dt-mb-4'); ?>>
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
						<div class="dt_post_catetag">
							<i class="dt-mr-2 fas fa-folder" aria-hidden="true"></i>
							<a href="<?php echo esc_url( get_permalink() ); ?>" rel="category tag"><?php the_category(' , '); ?></a>
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
		</div>
	</div>
</div>