<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" id="custom-header" rel="home">
		<img src="<?php echo esc_url(get_header_image()); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr(get_bloginfo( 'title' )); ?>">
	</a>	
<?php endif;  ?>
<!-- header start -->
<header class="main-header header-two transparent  <?php echo esc_attr(accron_sticky_menu()); ?>">
    <div class="topbar">
        <div class="container">
            <div class="topbar-inner">
                <div class="row align-items-center">
                    <div class="navbar-brand col-lg-3 px-lg-3">
                        <?php do_action('accron_logo_content'); ?>
                    </div>
                    <div class="col-lg-7 px-lg-3">
						<?php
							$hide_show_social_icon 		= get_theme_mod( 'hide_show_social_icon','1'); 
						
							$hide_show_mbl_details 		= get_theme_mod( 'hide_show_mbl_details','1'); 
							$tlh_mobile_icon 			= get_theme_mod( 'tlh_mobile_icon');
							$tlh_mobile_title 			= get_theme_mod( 'tlh_mobile_title'); 
							$tlh_mobile_number 			= get_theme_mod( 'tlh_mobile_number'); 
							
							$hide_show_email_details 	= get_theme_mod( 'hide_show_email_details','1');
							$tlh_email_icon 			= get_theme_mod( 'tlh_email_icon');
							$tlh_email_title 			= get_theme_mod( 'tlh_email_title');
							$tlh_email 					= get_theme_mod( 'tlh_email');
							
							$hide_show_office_hours_details = get_theme_mod( 'hide_show_office_hours_details','1'); 
							$tlh_office_hours_icon 		= get_theme_mod( 'tlh_office_hours_icon');
							$tlh_office_hours_title 	= get_theme_mod( 'tlh_office_hours_title');
							$tlh_office_hours 			= get_theme_mod( 'tlh_office_hours');
							
							if($hide_show_office_hours_details =='1' || $hide_show_email_details =='1' || $hide_show_mbl_details =='1'):
						?>
							<div class="header-widget widget-slide">
								<?php if($hide_show_mbl_details =='1' && !empty($tlh_mobile_number)): ?>
									<aside class="widget widget-contact">
										<div class="contact-area">
											<div class="contact-icon">
												<i class="fa <?php echo esc_attr($tlh_mobile_icon); ?>"></i>
											</div>
											<div class="contact-info">
												<p class="text">
													<span><?php echo esc_html($tlh_mobile_title); ?></span>
													<a href="tel:<?php echo esc_attr(str_replace(' ','',$tlh_mobile_number)); ?>">
														<?php echo esc_html($tlh_mobile_number); ?>
													</a>
												</p>
											</div>
										</div>
									</aside>
								<?php endif; ?>
																		
								<?php if($hide_show_email_details =='1' && !empty($tlh_email)): ?>
									<aside class="widget widget-contact">
										<div class="contact-area">
											<div class="contact-icon">
												<i class="fa <?php echo esc_attr($tlh_email_icon); ?>"></i>
											</div>
											<div class="contact-info">
												<p class="text">
													<span><?php echo esc_html($tlh_email_title); ?></span>
													<a href="mailto:<?php echo esc_attr($tlh_email); ?>"><?php echo esc_html($tlh_email); ?></a>
												</p>
											</div>
										</div>
									</aside>
								<?php endif; ?>
								
								<?php if($hide_show_office_hours_details =='1' && !empty($tlh_office_hours)): ?>									
									<aside class="widget widget-contact">
										<div class="contact-area">
											<div class="contact-icon">
												<i class="fa <?php echo esc_attr($tlh_office_hours_icon);?>"></i>
											</div>
											<div class="contact-info">
												<p class="text">
													<span><?php echo esc_html($tlh_office_hours_title); ?></span>
													<a href="#"><?php echo esc_html($tlh_office_hours); ?></a>
												</p>
											</div>
										</div>
									</aside>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>
                    <div class="col-lg-2 px-lg-3">
						<div class="header-top-right">
							<?php 
								$tlh_btn_lbl 			= get_theme_mod( 'tlh_btn_lbl','Buy Now');
								$tlh_btn_link 			= get_theme_mod( 'tlh_btn_link','#');
								if(!empty($tlh_btn_lbl)){
							?>
								<a href="<?php echo esc_url($tlh_btn_link); ?>" class="main-btn"><?php echo esc_html($tlh_btn_lbl); ?></a>
							<?php } ?>							
							</div>
					</div>
                </div>
            </div>
        </div>
    </div>
    <div class="nav-area">
        <div class="container">
            <div class="nav-area-inner">
                <div class="row">
                    <div class="col-lg-3 col-md-auto col-sm-auto col-auto p-0 px-lg-3 d-lg-none">
                        <?php do_action('accron_logo_content'); ?>
                    </div>
                    <div class="col-lg col-md-auto col-sm-auto col-auto p-0 px-lg-3">
                        <nav class="navbar navbar-expand-lg">
                            <button class="btn-bars d-lg-none" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasExample" aria-controls="offcanvasExample" aria-label="bar btn">
                                <i class="fas fa-bars"></i>
                            </button>
                            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
                                aria-labelledby="offcanvasExampleLabel">
                                <div class="offcanvas-header">
									<a class="navbar-brand" id="offcanvasExampleLabel" href="index.html"><?php do_action('accron_logo_content'); ?></a>
                                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"  aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body">
                                    <?php do_action('accron_primary_navigation');	?>
								</div>
                            </div>
                        </nav>
                    </div>
                    <div class="col-lg-auto col-md-auto col-sm-auto col-auto p-0 ps-lg-3">
                        <div class="menu-right">
                            <ul>
                                <li>
                                    <?php 
										$hide_show_search 	= get_theme_mod( 'hide_show_search','1'); 
										if($hide_show_search=='1'):	
									?>
										<a href="#" aria-label="search" data-bs-toggle="modal" data-bs-target="#GFG">
											<i class="fas fa-search"></i>
										</a>
									<?php endif; ?>
                                    <div class="modal fade" id="GFG">
                                        <div class="modal-dialog modal-fullscreen">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                    </button>
                                                </div>
                                                <?php 
													$hide_show_search 	= get_theme_mod( 'hide_show_search','1'); 
													if($hide_show_search=='1'):	
												?>
													<div class="modal-body">
														<div class="header-search-flex">
															<form  method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php echo esc_attr( 'Site Search', 'acronix' ); ?>"> <input type="search" class="search-form-control header-search-field" placeholder="<?php echo esc_attr( 'Type To Search', 'acronix' ); ?>" name="s" id="search">
																<button type="submit" class="search-submit"><i
																	class="fa fa-search"></i></button>
															</form>
														</div>
													</div>
												<?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </li>
								
                                <?php do_action('accron_navigation_cart'); ?>
								
								<?php if($hide_show_social_icon =='1'):	?>
									<li class="d-none d-lg-block">
										<?php do_action('accron_abv_hdr_social'); ?>
									</li>
								<?php endif; ?>
                              
                                </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header End -->
<?php 
if ( !is_page_template( 'templates/template-homepage.php' )) {
		accron_breadcrumbs_style();  
	}