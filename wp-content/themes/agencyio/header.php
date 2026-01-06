<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package Agencyio
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
<link rel="pingback" href="<?php echo esc_url(get_bloginfo( 'pingback_url' )); ?>">
<?php endif; ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#content">
<?php esc_html_e( 'Skip to content', 'agencyio' ); ?></a>
<div class="wrapper">
 <header class="bs-default cont tr-head ">
  <div class="container">
  <?php do_action('icycp_top_header'); ?>
    <!-- Main Menu Area-->
    <div class="bs-main-nav">
      <nav class="navbar navbar-expand-lg navbar-wp">
          <div class="container mobi-menu"> 
           <!-- Logo image --> 
           <div class="navbar-header col-12"> 
          <?php the_custom_logo(); 
                     if (display_header_text()) : ?>
                        <div class="site-branding-text navbar-brand">
                          <h1 class="site-title"> 
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                            <?php 
                            echo esc_html(get_bloginfo('name'));
                            ?>
                            </a>
                          </h1>
                              <p class="site-description"><?php echo esc_html(bloginfo('description')); ?></p>
                          </div>
                      <?php endif; ?>
            <!-- navbar-toggle --> 
            <!-- /Logo --> 
          <div class="desk-header d-flex pl-3 ml-auto my-2 my-lg-0 position-relative align-items-center">
                <?php $hide_show_nav_menu_btn = get_theme_mod('hide_show_nav_menu_btn','1'); 
                $menu_btn_label = get_theme_mod('menu_btn_label');
                $menu_btn_link = get_theme_mod('menu_btn_link');
                $menu_btn_target = get_theme_mod('menu_btn_target','1');
                if($hide_show_nav_menu_btn == '1') { if($menu_btn_label) { ?>
                <a <?php if($menu_btn_target == '1') { ?> target ="_blank" <?php } ?> href="<?php echo esc_url($menu_btn_link); ?>" class="btn btn-theme"><?php echo esc_html($menu_btn_label); ?></a>
              <?php } } ?>
            <button type="button" class="navbar-toggler collapsed" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="close fa fa-times"></span>
              <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
            </button>
            </div>
          </div>
        </div>
        <div class="container desk-menu">  
          <!-- Logo image -->  
           <div class="navbar-header"> 
            <?php the_custom_logo(); 
                  if (display_header_text()) : ?>
                    <div class="site-branding-text navbar-brand">
                      <h1 class="site-title"> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                        <?php 
                            echo esc_html(get_bloginfo('name'));
                          ?></a></h1>
                      <p class="site-description"><?php echo esc_html(bloginfo('description')); ?></p>
                    </div>
            <?php endif; ?>
          </div>
          <!-- /Logo -->
          <!-- /navbar-toggle --> 
          <!-- Navigation -->
           <div class="collapse navbar-collapse">
           <?php wp_nav_menu( array(
                'theme_location' => 'primary',
                'container'  => 'collapse navbar-collapse',
                'menu_class' => 'nav navbar-nav ml-auto',
                'fallback_cb' => 'agencyup_fallback_page_menu',
                'walker' => new agencyup_nav_walker()
            ) );  ?>
          </div>
          <div class="desk-header d-flex pl-3 ml-auto my-2 my-lg-0 position-relative align-items-center">
                <?php $hide_show_nav_menu_btn = get_theme_mod('hide_show_nav_menu_btn','1'); 
                $menu_btn_label = get_theme_mod('menu_btn_label');
                $menu_btn_link = get_theme_mod('menu_btn_link');
                $menu_btn_target = get_theme_mod('menu_btn_target','1');
        if($hide_show_nav_menu_btn == '1') { if($menu_btn_label) { ?>
                <a <?php if($menu_btn_target == '1') { ?> target ="_blank" <?php } ?> href="<?php echo esc_url($menu_btn_link); ?>" class="btn btn-theme"><?php echo esc_html($menu_btn_label); ?></a>
              <?php } } ?>
              <div class="dropdown mg-search-box">
                            <a class="dropdown-toggle msearch ml-auto" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               <i class="fa fa-search"></i>
                            </a>
                            <div class="dropdown-menu searchinner" aria-labelledby="dropdownMenuLink">
                                <form method="get" id="searchform" action="#" class="navbar-form mg-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="s" placeholder="Search..">
                                        <span class="input-group-btn">
                                            <button class="btn" type="submit"> 
                                            <span class="fa fa-search"></span>
                                            </button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                       <?php do_action('icycp_agencyio_call_header'); ?>
          </div>
        </div>
      </nav>
    </div>
        </div>
    <!--/main Menu Area-->    
    </header>