<?php
     $norcon_redux_demo = get_option('redux_demo');
     get_header(); 
?>
<?php if(isset($norcon_redux_demo['blog_image']['url']) && $norcon_redux_demo['blog_image']['url'] != ''){?>
<section class="banner-header banner-img-top section-padding valign bg-img bg-fixed" data-overlay-dark="4" data-background="<?php echo esc_attr($norcon_redux_demo['blog_image']['url']);?>">
<?php }else{?>
<section class="banner-header banner-img-top section-padding valign bg-img bg-fixed" data-overlay-dark="4" data-background="<?php echo get_template_directory_uri();?>/img/slider/1.jpg">
<?php } ?>
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <h1><?php printf( esc_html__( 'Category Archives: %s', 'norcon' ), single_cat_title( '', false ) ); ?></h1>
            </div>
        </div>
    </div>
</section>
<!-- Blog -->
<section class="news2 section-padding bg-gray">
    <div class="container">
        <div class="row">
        <!-- content -->
        <div class="col-md-8">
            <?php
                while (have_posts()): the_post();
            ?>
                <div class="item mb-60">
                    <?php if (get_post_thumbnail_id() !='')  { ?>
                    <div class="position-re o-hidden"> <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id());?>" alt="">
                        <div class="date">
                            <a href="<?php the_permalink();?>"> <span>Dec</span> <i>20</i> </a>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="con">
                        <h5><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h5>
                        <p><?php if(isset($norcon_redux_demo['blog_excerpt'])){?>
                                <?php echo esc_attr(norcon_excerpt($norcon_redux_demo['blog_excerpt'])); ?>
                                <?php }else{?>
                                <?php echo esc_attr(norcon_excerpt(50)); } ?></p>
                        <div class="divider"></div>
                        <div class="news-info">
                            <div class="split-content news-info-left">
                                <div class="news-icon-wrapper"> <i class="norcon-new-construction"></i> </div>
                                <div class="card-news-date-text"><?php 
                                    // Show all category for post
                                    $i = 1; foreach((get_the_category()) as $category) { 
                                    if ($i == 1){echo ''; }else {echo ', ';}
                                        echo ''.$category->category_nicename . ' '.''; 
                                        $i++;
                                    } ?></div>
                            </div>
                            <div class="split-content news-info-right"> <a href="<?php the_permalink();?>" class="link-btn" tabindex="0"><?php if(isset($norcon_redux_demo['read_more'])){?>
                                  <?php echo esc_attr($norcon_redux_demo['read_more']);?>
                                  <?php }else{?>
                                  <?php echo esc_html__( 'Read more', 'norcon' ); } ?></a> 
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
                <!-- Pagination -->
                    <?php 
                        $pagination = array(
                        'base'      => str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
                        'format'    => '',
                        'prev_text' => wp_specialchars_decode(esc_html__( '<i class="fa fa-angle-left"></i>', 'norcon' ),ENT_QUOTES),
                        'next_text' => wp_specialchars_decode(esc_html__( '<i class="fa fa-angle-right"></i>', 'norcon' ),ENT_QUOTES),
                        'type'      => 'list',
                        'end_size'    => 3,
                        'mid_size'    => 3
                        );
                        if(paginate_links( $pagination ) != ''){
                            $return =  paginate_links( $pagination );
                            echo str_replace( "<ul class='page-numbers'>", '<ul class="news-pagination-wrap align-center mb-30 mt-30">', $return );
                        }
                    ?>
            </div>
            <!-- sidebar -->
            <div class="col-md-4">
                <div class="news2-sidebar row">
                    <?php get_sidebar();?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
    get_footer();
?>