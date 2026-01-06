<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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
      <?php $content_layout = get_theme_mod('agencyup_content_layout','align-content-right');
      if($content_layout == 'align-content-left'){ ?>
        <aside class="col-lg-3 col-md-4">
          <?php get_sidebar(); ?>
        </aside>
      <?php }  ?>
      <div class="col-lg-<?php echo ( $content_layout == 'full-width-content' ? '12' :'9 col-md-8' ); ?>"><?php
    		  while(have_posts()){ the_post();
              get_template_part('content','');
    		  } ?>
          <div class="col-md-12 text-center">
      			<?php //Previous / next page navigation
      			the_posts_pagination( array(
      			  'prev_text'          => '<i class="fa fa-angle-left"></i>',
      			  'next_text'          => '<i class="fa fa-angle-right"></i>',
      			) ); ?>
          </div>
      </div>
      <?php if($content_layout == 'align-content-right'){ ?>
        <aside class="col-lg-3 col-md-4">
          <?php get_sidebar(); ?>
        </aside>
      <?php } ?>
    </div>
  </div>
 </main>
<?php
get_footer();
?>