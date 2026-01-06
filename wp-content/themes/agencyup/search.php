<?php
/**
 * The template for displaying search results pages.
 *
 * @package Agencyup
 */

get_header(); ?>
<!--==================== ti breadcrumb section ====================-->
<?php get_template_part('index','banner'); ?>
<!--==================== main content section ====================-->
<main id="content">
  <div class="container">
    <div class="row">
      <div class="col-md-<?php echo ( !is_active_sidebar( 'sidebar-1' ) ? '12' :'9' ); ?>">
          <?php 
		global $i;
		if ( have_posts() ) : ?>
		<h2><?php /* translators: %s: search term */ printf( esc_html__( 'Search Results for: %s','agencyup'), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h2>

		<?php while ( have_posts() ) : the_post();  
		 get_template_part('content','');
		 endwhile; else : ?>
		<h2><?php esc_html_e( "Nothing Found", 'agencyup' ); ?></h2>
		<div class="">
		<p><?php esc_html_e( "Sorry, but nothing matched your search criteria. Please try again with some different keywords.", 'agencyup' ); ?>
		</p>
		<?php get_search_form(); ?>
		</div><!-- .blog_con_mn -->
		<?php endif; ?>
      </div>
	  <aside class="col-md-3">
        <?php get_sidebar(); ?>
      </aside>
    </div>
  </div>
</main>
<?php
get_footer();
?>