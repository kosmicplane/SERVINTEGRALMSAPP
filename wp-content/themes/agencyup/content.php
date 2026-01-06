<?php
/**
 * The template for displaying the content.
 * @package Agencyup
 */
?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="bs-blog-post shd">
		<div class="bs-blog-thumb">
			<?php 
			if(has_post_thumbnail()){
			echo '<a  href="'.esc_url(get_the_permalink()).'">';
			the_post_thumbnail( '', array( 'class'=>'img-fluid' ) );
			echo '</a>';
			?>
			<?php } ?>
		</div>


		<article class="small"> 
			<?php $post_category = get_theme_mod('post_category_enable',false);
			$post_title = get_theme_mod('post_title_enable',false);
			$post_meta = get_theme_mod('post_meta_enable',false);
			if($post_category !== true){ ?>
			<div class="bs-blog-category">
				<?php   $cat_list = get_the_category_list();
				if(!empty($cat_list)) { ?>
				<?php the_category(', '); ?>
				<?php } ?>
			</div>
			<?php }  
			if($post_title !== true) { ?>
			<h4 class="title"> <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array('before' => 'Permalink to: ','after'  => '') ); ?>">
			<?php the_title(); ?></a>
			</h4>	
			<?php }  
			if($post_meta !== true) { ?>
			<div class="bs-blog-meta">
				<span class="bs-blog-date"><a href="<?php echo esc_url(get_month_link(get_post_time('Y'),get_post_time('m'))); ?>">
				<?php echo esc_html(get_the_date('M j, Y')); ?></a></span>
				<span class="bs-author">
				<a class="bs-icon" href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"> <?php esc_html_e('by','agencyup'); ?>
					<?php the_author(); ?>
				</a>
				</span>
				<span class="comments-link">
					<a href="<?php echo esc_url(get_comments_link( )); ?>"><?php echo esc_html(get_comments_number()); ?> <?php esc_html_e('Comments','agencyup'); ?></a>
				</span>
				<?php 
				agencyup_edit_link();
                $tags = get_the_tags();
                if($tags){ ?>
                  <span class="tag-links"><?php
                  $keys = array_keys($tags);
                    foreach ($tags as $key => $tag) {
                      $tag_link = get_tag_link($tag->term_id);
                      if ($key === end($keys)) {
                        echo '<a href="'.esc_url($tag_link).'">#'.esc_html($tag->name).'</a>';
                      } else {
                        echo ' <a href="'.esc_url($tag_link).'">#'.esc_html($tag->name).'</a>, ';
                      }
                    } ?>
                  </span>
                <?php } ?>
			</div>	
    		<?php } the_content(__('Read More','agencyup'));
				wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'agencyup' ), 'after' => '</div>' ) ); ?>
		</article>
	</div>
</div>