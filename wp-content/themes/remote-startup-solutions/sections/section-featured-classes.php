<?php 
/**
 * Template part for displaying Featured Classes Section
 *
 * @package Remote Startup Solutions
 */

$remote_startup_solutions_classes = get_theme_mod( 'remote_startup_solutions_classes_setting',false );
$remote_startup_solutions_service_title = get_theme_mod( 'remote_startup_solutions_service_title' );
$remote_startup_solutions_service_text = get_theme_mod( 'remote_startup_solutions_service_text' );

?>
<?php if ( $remote_startup_solutions_classes ){?>
<div class="our-classes">
    <div class="container">
        <div class="service">
            <div class="row mb-5">
                <div class="col-lg-3 col-md-5 align-self-center service_head">
                    <?php if ( $remote_startup_solutions_service_title ){?>
                        <img src="<?php echo esc_url( get_template_directory_uri() ) . '/images/service.png'; ?>" />
                        <h3><?php echo esc_html( $remote_startup_solutions_service_title );?></h3>
                    <?php } ?>
                </div>
                <div class="col-lg-9 col-md-7 align-self-center">
                    <?php if ( $remote_startup_solutions_service_text ){?>
                        <p class="title-text"><?php echo esc_html( $remote_startup_solutions_service_text );?></p>
                    <?php } ?>
                </div>
            </div>
            <div class="owl-carousel">
                <?php 
                    $remote_startup_solutions_catergory_name = get_theme_mod('remote_startup_solutions_blog_args_');
                    $args = array(
                        'post_type'           => 'post',
                        'category_name'       => $remote_startup_solutions_catergory_name,
                        'orderby'             => 'post__in',
                        'ignore_sticky_posts' => true,
                    );?>
                    <?php
                    $loop = new WP_Query($args);
                    if ( $loop->have_posts() ) :
                        while ($loop->have_posts()) : $loop->the_post(); ?>
                            <div class=" align-self-center px-0">
                                <div class="box">
                                    <?php
                                        if ( has_post_thumbnail() ) : ?>
                                        <div class="image-blog">
                                          <?php the_post_thumbnail();?>
                                        </div>
                                        <?php else:
                                          ?>
                                          <div class="image-blog">
                                            <img src="<?php echo get_stylesheet_directory_uri() . '/images/default-header.png'; ?>">
                                          </div>
                                          <?php
                                        endif;
                                      ?>
                                    <div class="box-content">
                                        <h4 class="title mb-2">
                                            <a href="<?php the_permalink();?>"><?php the_title();?></a>
                                        </h4>
                                        <p class="mb-0"><?php echo wp_trim_words( get_the_content(), 15 ); ?></p>
                                    </div>
                                    <div class="blog-title"><h5 class="title mb-2"><?php the_title();?></h5></div>
                                </div>

                                </div>
                        <?php endwhile;
                    endif;
                ?>
            </div>
        </div>
    </div>
</div>
<?php } ?>