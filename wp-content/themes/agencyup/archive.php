<?php
/**
 * The template for displaying archive pages.
 *
 * @package Agencyup
 */
get_header(); ?>
<!-- Breadcrumb -->
<div class="bs-breadcrumb-section" style='background-image: url("<?php echo esc_url(( has_header_image() ? esc_url(get_header_image()) : get_theme_support( 'custom-header', 'default-image' ) )); ?>");'>
  <div class="overlay">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="bs-breadcrumb-title">
            <?php echo agencyup_archive_page_title(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /End Breadcrumb -->
<main id="content">
  <div class="container">
    <div class="row">
      <?php $agencyup_content_layout = get_theme_mod('agencyup_content_layout','align-content-right');
      if($agencyup_content_layout == 'align-content-left'){ ?>
        <aside class="col-lg-3 col-md-4">
          <?php get_sidebar(); ?>
        </aside>
      <?php } 
      if(($agencyup_content_layout == 'align-content-left') || ($agencyup_content_layout == 'align-content-right')){ ?>
        <div class="col-lg-9 col-md-8">
      <?php } else { ?>
        <div class="col-md-12">
      <?php }
			if( have_posts() ) :
			while( have_posts() ): the_post();
			get_template_part('content',''); 
			endwhile; endif;
			?>
        <div class="col d-flex text-center justify-content-center">
			<?php
			//Previous / next page navigation
			the_posts_pagination( array(
			'prev_text'          => '<i class="fas fa-angle-left"></i>',
			'next_text'          => '<i class="fas fa-angle-right"></i>',
			) );
			?>
        </div>
      </div>
      <?php if($agencyup_content_layout == 'align-content-right'){ ?>
        <aside class="col-lg-3 col-md-4">
          <?php get_sidebar(); ?>
        </aside>
      <?php } ?>
    </div>
  </div>
</main>
<?php get_footer(); ?>