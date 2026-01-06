<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package remote_startup_solutions
 */
$remote_startup_solutions_heading_setting  = get_theme_mod( 'remote_startup_solutions_post_heading_setting' , true );
$remote_startup_solutions_meta_setting  = get_theme_mod( 'remote_startup_solutions_post_meta_setting' , true );
$remote_startup_solutions_content_setting  = get_theme_mod( 'remote_startup_solutions_post_content_setting' , true );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		  if ( $remote_startup_solutions_heading_setting ){ 
			if ( is_single() ) {
				the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title" itemprop="headline"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
		  }

		if ( 'post' === get_post_type() ) : ?>
		<?php
		if ( $remote_startup_solutions_meta_setting ){ ?>
			<div class="entry-meta">
				<?php remote_startup_solutions_posted_on(); ?>
			</div><!-- .entry-meta -->
		<?php } ?>
		<?php
		endif; ?>
	</header><!-- .entry-header -->
	 <?php
			// Get the post ID
			$remote_startup_solutions_post_id = get_the_ID();

			// Check if there are videos embedded in the post content
			$remote_startup_solutions_post = get_post($remote_startup_solutions_post_id);
			$remote_startup_solutions_content = do_shortcode(apply_filters('the_content', $remote_startup_solutions_post->post_content));
			$remote_startup_solutions_embeds = get_media_embedded_in_content($remote_startup_solutions_content);

			if (!empty($remote_startup_solutions_embeds)) {
			    // Loop through embedded media and display videos
			    foreach ($remote_startup_solutions_embeds as $embed) {
			        // Check if the embed code contains a video tag or specific video providers like YouTube or Vimeo
			        if (strpos($embed, 'video') !== false || strpos($embed, 'youtube') !== false || strpos($embed, 'vimeo') !== false || strpos($embed, 'dailymotion') !== false || strpos($embed, 'vine') !== false || strpos($embed, 'wordPress.tv') !== false || strpos($embed, 'hulu') !== false) {
			            ?>
			            <div class="custom-embedded-video">
			                <div class="video-container">
			                    <?php echo $embed; ?>
			                </div>
			                <div class="video-comments">
			                    <?php
			                    // Add your comments section here
			                    comments_template(); // This will include the default WordPress comments template
			                    ?>
			                </div>
			            </div>
			            <?php
			        }
			    }
			}
	    ?>
    <?php
	if ( $remote_startup_solutions_content_setting ){ ?>
		<div class="entry-content" itemprop="text">
			<?php
			if( is_single()){
				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'remote-startup-solutions' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );
				}else{
				the_excerpt();
				}
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'remote-startup-solutions' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
    <?php } ?>
</article><!-- #post-## -->