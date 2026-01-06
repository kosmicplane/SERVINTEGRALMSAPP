<?php
/**
 * The template for displaying 404 pages (Not Found)
 */
 $norcon_redux_demo = get_option('redux_demo');
get_header(); ?> 

<section class="not-found-wrap section-padding bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 text-center">
                <div class="box not-found">
                    <div class="text-center">
                        <div class="title-404"><?php if(isset($norcon_redux_demo['404'])){?>
                            <?php echo esc_attr($norcon_redux_demo['404']);?>
                            <?php }else{?>
                            <?php echo esc_html__( '404', 'norcon' ); } ?>
                        </div>
                        <h2><?php if(isset($norcon_redux_demo['page_not_found'])){?>
                        <?php echo esc_attr($norcon_redux_demo['page_not_found']);?>
                        <?php }else{?>
                        <?php echo esc_html__( 'Page Not Found', 'norcon' );
                        }
                        ?></h2>
                        <p class="paragraph _404"><?php if(isset($norcon_redux_demo['desc'])){?>
                        <?php echo esc_attr($norcon_redux_demo['desc']);?>
                        <?php }else{?>
                        <?php echo esc_html__( 'The page you are looking for was moved, removed, renamed or never existed.', 'norcon' );
                        }
                        ?></p>
                        <div><a href="<?php echo esc_url(home_url('/')); ?>" class="button-secondary"><?php echo esc_html__( 'Back to Home', 'norcon' ); ?></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg not-found"></div>
</section>
<?php
get_footer(); ?> 
