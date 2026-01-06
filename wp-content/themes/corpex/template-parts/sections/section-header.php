<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" id="custom-header" rel="home">
		<img src="<?php echo esc_url(get_header_image()); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr(get_bloginfo( 'title' )); ?>">
	</a>	
<?php endif;  ?>
<!-- header -->
    <header class="main-header header-one transparent">
	
	 <?php do_action('corpex_above_hdr'); ?>
        
        <div class="container">
            <nav class="navbar navbar-expand-lg nav_bg <?php echo esc_attr(corpex_sticky_menu()); ?>">
			 <div class="container">
				<div class="navbar-brand">
					<?php do_action('corpex_logo_content'); ?>
				</div>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<i class="fas fa-bars"></i>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<?php do_action('corpex_primary_navigation');	?>
					<div class="main-menu-right d-none d-lg-block">
						<ul class="menu-right-list">

							<li>
								<?php 
									$hide_show_search 	= get_theme_mod( 'hide_show_search','1'); 
									if($hide_show_search=='1'):	
								?>
									<a href="#" data-bs-toggle="modal" class="header-search-toggle" data-bs-target="#GFG">
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
														<form  method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php echo esc_attr( 'Site Search', 'corpex' ); ?>">
															<input type="search" class="form-control header-search-field" name="s" id="search" placeholder="<?php echo esc_attr( 'Type To Search', 'corpex' ); ?>"><button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
														</form>
													</div>
												</div>
											<?php endif; ?>
										</div>
									</div>
								</div>
							</li>
							
							<?php do_action('corpex_navigation_cart'); ?>
							
							<?php 
								$tlh_btn_lbl 			= get_theme_mod( 'tlh_btn_lbl');
								$hs_nav_button 			= get_theme_mod( 'hs_nav_button','1');
								$tlh_btn_link 			= get_theme_mod( 'tlh_btn_link');
								if(!empty($tlh_btn_lbl) && $hs_nav_button == 1){
							?>
								<li class="button-area">
									<a href="<?php echo esc_url($tlh_btn_link); ?>" target="_blank" class="main-btn"><?php echo esc_html($tlh_btn_lbl); ?></a>
								</li>
							<?php } ?>
						</ul>
					</div>
				</div>
				</div>
            </nav>
        </div>
		
		<?php do_action('corpex_bottom_hdr'); ?>
        
    </header>
    <!-- header End -->

<?php 
if ( !is_page_template( 'templates/template-homepage.php' )) {
		corpex_breadcrumbs_style();  
	}