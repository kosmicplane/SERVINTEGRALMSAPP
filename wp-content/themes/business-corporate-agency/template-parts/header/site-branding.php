<?php
/*
* Display header
*/
?>

<div class="headerbox">
    <div class="header-main">
        <div class="row m-0">
            <div class="col-lg-3 col-md-3 logo-col p-md-0">
                <div class="logo text-center">
                    <?php if (has_custom_logo()) : ?>
                        <?php the_custom_logo(); ?>
                    <?php endif; ?>

                    <?php if (get_theme_mod('business_corporate_agency_site_title', true)) : ?>
                        <?php if (is_front_page() && is_home()) : ?>
                            <p class="text-capitalize">
                                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                            </p>
                        <?php else : ?>
                            <h1 class="text-capitalize">
                                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                            </h1>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php
                    $description = get_bloginfo('description', 'display');
                    if ($description || is_customize_preview()) :
                        if (get_theme_mod('business_corporate_agency_site_tagline', false)) :
                            ?>
                            <p class="site-description my-1 text-capitalize"><?php echo esc_html($description); ?></p>
                        <?php endif; 
                    endif;
                    ?>
                </div>
                <div class="logo-shadow"></div>
            </div>

            <div class="col-lg-9 col-md-9 align-self-center px-0">
                <div class="top-main py-2">
                    <div class="row m-0">
                        <div class="col-lg-4 col-md-4 align-self-center">
                            <div class="contact">
                                <?php if (get_theme_mod('business_corporate_agency_location')) : ?>
                                    <p class="mb-md-0 mb-2 ps-md-5 contact-content">
                                        <i class="fas fa-map-marker-alt me-2"></i><?php echo esc_html(get_theme_mod('business_corporate_agency_location')); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 align-self-center">
                            <div class="contact">
                                <?php if (get_theme_mod('business_corporate_agency_call')) : ?>
                                    <p class="mb-0 contact-content call">
                                        <i class="fas fa-phone-volume me-md-2 me-1"></i><a href="tel:<?php echo esc_html(get_theme_mod('business_corporate_agency_call')); ?>">
                                                <?php echo esc_html(get_theme_mod('business_corporate_agency_call')); ?>
                                        </a>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 align-self-center">
                            <div class="social-media text-md-end text-center my-2">
                                <?php
                                $business_corporate_agency_fb_url = get_theme_mod('business_corporate_agency_facebook_url');
                                $business_corporate_agency_twt_url = get_theme_mod('business_corporate_agency_twitter_url');
                                $business_corporate_agency_ins_url = get_theme_mod('business_corporate_agency_instagram_url');
                                $business_corporate_agency_linkedin_url = get_theme_mod('business_corporate_agency_linkedin_url');
                                $business_corporate_agency_google_plus_url = get_theme_mod('business_corporate_agency_google_plus_url');
                                $business_corporate_agency_youtube_url = get_theme_mod('business_corporate_agency_youtube_url');

                                $business_corporate_agency_fb_new_tab = esc_attr(get_theme_mod('business_corporate_agency_header_fb_new_tab', 'true'));
                                $business_corporate_agency_twt_new_tab = esc_attr(get_theme_mod('business_corporate_agency_header_twt_new_tab', 'true'));
                                $business_corporate_agency_ins_new_tab = esc_attr(get_theme_mod('business_corporate_agency_header_ins_new_tab', 'true'));
                                $business_corporate_agency_linkedin_new_tab = esc_attr(get_theme_mod('business_corporate_agency_header_linkedin_new_tab', 'true'));
                                $business_corporate_agency_google_plus_new_tab = esc_attr(get_theme_mod('business_corporate_agency_google_plus_new_tab', 'true'));
                                $business_corporate_agency_youtube_new_tab = esc_attr(get_theme_mod('business_corporate_agency_youtube_new_tab', 'true'));

                                if ($business_corporate_agency_fb_url || $business_corporate_agency_twt_url || $business_corporate_agency_ins_url || $business_corporate_agency_linkedin_url) : ?>
                                    
                                    <?php if ($business_corporate_agency_fb_url) : ?>
                                        <a <?php if ($business_corporate_agency_fb_new_tab != false) : ?>target="_blank" <?php endif; ?>href="<?php echo esc_url($business_corporate_agency_fb_url); ?>"><i class="me-lg-3 me-2 <?php echo esc_attr(get_theme_mod('business_corporate_agency_facebook_icon', 'fab fa-facebook')); ?>"></i></a>
                                    <?php endif; ?>
                                    
                                    <?php if ($business_corporate_agency_twt_url) : ?>
                                        <a <?php if ($business_corporate_agency_twt_new_tab != false) : ?>target="_blank" <?php endif; ?>href="<?php echo esc_url($business_corporate_agency_twt_url); ?>"><i class="me-lg-3 me-2 <?php echo esc_attr(get_theme_mod('business_corporate_agency_twitter_icon', 'fab fa-twitter')); ?>"></i></a>
                                    <?php endif; ?>
                                    
                                    <?php if ($business_corporate_agency_ins_url) : ?>
                                        <a <?php if ($business_corporate_agency_ins_new_tab != false) : ?>target="_blank" <?php endif; ?>href="<?php echo esc_url($business_corporate_agency_ins_url); ?>"><i class="me-lg-3 me-2  <?php echo esc_attr(get_theme_mod('business_corporate_agency_instagram_icon', 'fab fa-instagram')); ?>"></i></a>
                                    <?php endif; ?>

                                    <?php if ($business_corporate_agency_linkedin_url) : ?>
                                        <a <?php if ($business_corporate_agency_linkedin_new_tab != false) : ?>target="_blank" <?php endif; ?>href="<?php echo esc_url($business_corporate_agency_linkedin_url); ?>"><i class="me-lg-3 me-2 <?php echo esc_attr(get_theme_mod('business_corporate_agency_linkedin_icon', 'fab fa-linkedin')); ?>"></i></a>
                                    <?php endif; ?>

                                    <?php if ($business_corporate_agency_google_plus_url) : ?>
                                        <a <?php if ($business_corporate_agency_google_plus_new_tab != false) : ?>target="_blank" <?php endif; ?>href="<?php echo esc_url($business_corporate_agency_googleplus_url); ?>"><i class="me-lg-3 me-2 <?php echo esc_attr(get_theme_mod('business_corporate_agency_googleplus_icon', 'fab fa-google-plus-g')); ?>"></i></a>
                                    <?php endif; ?>

                                    <?php if ($business_corporate_agency_youtube_url) : ?>
                                        <a <?php if ($business_corporate_agency_youtube_new_tab != false) : ?>target="_blank" <?php endif; ?>href="<?php echo esc_url($business_corporate_agency_youtube_url); ?>"><i class="<?php echo esc_attr(get_theme_mod('business_corporate_agency_youtube_icon', 'fab fa-youtube')); ?>"></i></a>
                                    <?php endif; ?>
                                    
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row menu-box-col m-0 py-2">
                    <div class="col-lg-8 col-md-3 col-6 align-self-center">
                        <div class="main-navhead">
                            <div class="menubox text-md-start text-center">
                                <div class="container-fluid">
                                    <div class="menu-content">
                                        <?php get_template_part('template-parts/navigation/site-nav'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-3 col-6 align-self-center d-flex justify-content-center align-items-center">
                        <span class="search-bar">
                            <button type="button" class="open-search"><i class="fas fa-search"></i></button>
                        </span>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12 align-self-center">
                        <?php if (get_theme_mod('business_corporate_agency_header_link') || get_theme_mod('business_corporate_agency_header_button','Get Consultant')) : ?>
                            <div class="header-btn my-md-0 my-2 text-center">
                                <a href="<?php echo esc_url(get_theme_mod('business_corporate_agency_header_link')); ?>" class="book-appoin">
                                    <span class="head-icon"><i class="fas fa-calendar"></i></span>
                                    <span class="head-btn text-capitalize"><?php echo esc_html(get_theme_mod('business_corporate_agency_header_button','Get Consultant')); ?></span></a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="search-outer">
                        <div class="inner_searchbox w-100 h-100">
                            <?php get_search_form(); ?>
                        </div>
                        <button type="button" class="search-close"><?php esc_html_e('CLOSE', 'business-corporate-agency'); ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>