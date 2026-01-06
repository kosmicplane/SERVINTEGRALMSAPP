<!doctype html>
<html lang="zxx">
<?php $norcon_redux_demo = get_option('redux_demo'); ?>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) { ?>
        <?php if(isset($norcon_redux_demo['favicon']['url'])){?>
            <link rel="shortcut icon" href="<?php echo esc_url($norcon_redux_demo['favicon']['url']); ?>">
        <?php }?>
    <?php }?>
    <?php wp_head(); ?> 
</head>
<body <?php body_class(''); ?>>
<div class="preloader-bg"></div>
    <div id="preloader">
        <div id="preloader-status">
            <div class="preloader-position loader"> <span></span> </div>
        </div>
    </div>
    <div class="progress-wrap cursor-pointer">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- Top Navbar -->
    <div class="main-header">
        <div class="header-top">
            <div class="container">
                <div class="top-outer clearfix">
                    <!--Top Left-->
                    <div class="top-left">
                        <ul class="links clearfix">
                            <?php if ($norcon_redux_demo['phone'] !='')  { ?>
                            <li><a href="tel:<?php echo esc_attr($norcon_redux_demo['phone']);?>"><span class="fa fa-phone"></span>
                            <?php echo esc_attr($norcon_redux_demo['phone']);?></a></li>
                            <?php } ?>
                            <?php if ($norcon_redux_demo['email'] !='')  { ?>
                            <li><a href="mailto:<?php echo esc_attr($norcon_redux_demo['email']);?>"><span class="fa fa-envelope"></span><?php echo esc_attr($norcon_redux_demo['email']);?></a></li>
                            <?php } ?>
                            <?php if ($norcon_redux_demo['address'] !='')  { ?>
                            <li><a href="<?php echo esc_attr($norcon_redux_demo['link_address']);?>" target="_blank"><span class="fa fa-map-marker"></span><?php echo esc_attr($norcon_redux_demo['address']);?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <!--Top Right-->
                    <div class="top-right clearfix">
                        <ul class="social-icon-one">
                            <?php if ($norcon_redux_demo['whatsapp'] !='')  { ?>
                            <li>
                                <a href="<?php echo esc_attr($norcon_redux_demo['whatsapp']);?>" class="fa fa-whatsapp"></a>
                            </li>
                            <?php } ?>
                            <?php if ($norcon_redux_demo['twitter'] !='')  { ?>
                            <li>
                                <a href="<?php echo esc_attr($norcon_redux_demo['twitter']);?>" class="fa fa-twitter"></a>
                            </li>
                            <?php } ?>
                            <?php if ($norcon_redux_demo['instagram'] !='')  { ?>
                            <li>
                                <a href="<?php echo esc_attr($norcon_redux_demo['instagram']);?>" class="fa fa-instagram"></a>
                            </li>
                            <?php } ?>
                            <?php if ($norcon_redux_demo['youtube'] !='')  { ?>
                            <li>
                                <a href="<?php echo esc_attr($norcon_redux_demo['youtube']);?>" class="fa fa-youtube-play"></a>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-md">
        <div class="container">
            <!-- Logo -->
            <?php if(isset($norcon_redux_demo['logo']['url']) && $norcon_redux_demo['logo']['url'] != ''){?>
            <a class="logo" href="<?php echo esc_url(home_url('/')); ?>"> <img src="<?php echo esc_url($norcon_redux_demo['logo']['url']); ?>" alt=""> </a>
            <?php }else{?>
            <a class="logo" href="<?php echo esc_url(home_url('/')); ?>"> <img src="<?php echo get_template_directory_uri();?>/img/logo.png" alt=""> </a>
            <?php } ?> 
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"><i class="fa fa-bars"></i></span> </button>
            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="navbar">
                <?php 
                    wp_nav_menu( 
                      array( 
                          'theme_location' => 'primary',
                          'container' => '',
                          'menu_class' => '', 
                          'menu_id' => '',
                          'menu'            => '',
                          'container_class' => '',
                          'container_id'    => '',
                          'echo'            => true,
                           'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                           'walker'            => new norcon_wp_bootstrap_navwalker(),
                          'before'          => '',
                          'after'           => '',
                          'link_before'     => '',
                          'link_after'      => '',
                          'items_wrap'      => '<ul class=" navbar-nav ms-auto %2$s" >%3$s</ul>',
                          'depth'           => 0,        
                      )
                ); ?>   
            </div>
        </div>
    </nav>