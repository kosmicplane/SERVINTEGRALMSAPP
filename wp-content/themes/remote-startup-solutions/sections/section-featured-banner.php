<?php
/**
 * Banner Section
 * 
 * @package remote_startup_solutions
 */
$remote_startup_solutions_slider = get_theme_mod( 'remote_startup_solutions_slider_setting',false );
$remote_startup_solutions_args = array(
  'post_type' => 'post',
  'post_status' => 'publish',
  'category_name' =>  get_theme_mod('remote_startup_solutions_blog_slide_category'),
  'posts_per_page' => 3,
); ?>

<?php if ( $remote_startup_solutions_slider ){?>
  <div class="banner">
    <div class="owl-carousel">
      <?php $remote_startup_solutions_arr_posts = new WP_Query( $remote_startup_solutions_args );
      if ( $remote_startup_solutions_arr_posts->have_posts() ) :
        while ( $remote_startup_solutions_arr_posts->have_posts() ) :
          $remote_startup_solutions_arr_posts->the_post();
          ?>
          <div class="banner_inner_box">
            <?php
              if ( has_post_thumbnail() ) :
                the_post_thumbnail();
              else:
                ?>
                <div class="banner_inner_box">
                  <img src="<?php echo get_stylesheet_directory_uri() . '/images/banner.jpg'; ?>">
                </div>
                <?php
              endif;
            ?>
            <div class="banner_box">
              <h3 class="my-3"><?php the_title(); ?></a></h3>
              <p class="mb-0"><?php echo wp_trim_words( get_the_content(), 30 ); ?></p>
              <div class="slide-btns">
                <p class="btn-green mt-4">
                  <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php esc_html_e('Read More','remote-startup-solutions'); ?></a>
                </p>
                <?php if ( get_theme_mod('remote_startup_solutions_slider_second_button_url') ) : ?>
                  <p class="btn-green btn-2 mt-4">
                    <a target="_blank" href="<?php echo esc_url(get_theme_mod('remote_startup_solutions_slider_second_button_url'));?>"><?php esc_html_e('Request a Quote','remote-startup-solutions'); ?></a>
                  </p>
                <?php endif; ?>                
              </div>
            </div>
          </div>
        <?php
      endwhile;
      wp_reset_postdata();
      endif; ?>
    </div>
  </div>
<?php } ?>