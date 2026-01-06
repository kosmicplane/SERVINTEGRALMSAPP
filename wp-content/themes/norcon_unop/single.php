<?php
   $norcon_redux_demo = get_option('redux_demo');
   get_header(); 
?>
<?php 
    while (have_posts()): the_post();
?>
<?php if(isset($norcon_redux_demo['blog_single_image']['url']) && $norcon_redux_demo['blog_single_image']['url'] != ''){?> 
<section class="banner-header banner-img-top section-padding valign bg-img bg-fixed" data-overlay-dark="4" data-background="<?php echo esc_url($norcon_redux_demo['blog_single_image']['url']);?>">
<?php }else{?>
<section class="banner-header banner-img-top section-padding valign bg-img bg-fixed" data-overlay-dark="4" data-background="<?php echo get_template_directory_uri();?>/img/slider/1.jpg">
<?php } ?> 
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h6><a href="news.html">Blog</a> / Post</h6>
                <h1><?php the_title(); ?></h1>
                <div class="post">
                    <div class="author"> <i class="fa fa-user"></i> <span><?php the_author_posts_link(); ?></span> </div>
                    <div class="date-comment"> <i class="fa fa-calendar"></i> <?php the_time(get_option( 'date_format' ));?> </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Post -->
<section class="section-padding bg-gray">
    <div class="container">
        <div class="row">
           <!-- content -->
            <div class="col-md-8">
                <?php if ( has_post_thumbnail() ) { ?>
               <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id());?>" class="mb-30" alt=""> 
               <?php } ?>
               <div class="section-title2"><?php the_title(); ?></div>
               <?php the_content(); ?>
                <?php wp_link_pages( array(
                    'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'norcon' ),
                    'after'       => '</div>',
                    'link_before' => '<p class="page-number">',
                    'link_after'  => '</p>',
                ) ); ?>
                <div class="news-comment-section">
                    <!-- Comment -->
                    <?php comments_template();?>
                </div>
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
<?php endwhile; ?>
<?php
    get_footer();
?>

