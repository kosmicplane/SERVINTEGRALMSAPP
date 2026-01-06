<?php 
	$hs_above_footer			= get_theme_mod('hs_above_footer', '1');
	$hs_above_footer_client		= get_theme_mod('hs_above_footer_client', '1');
	
	$footer_info_left_title		= get_theme_mod('footer_info_left_title');
	$footer_info_left_subtitle	= get_theme_mod('footer_info_left_subtitle');
	$footer_info_left_icon		= get_theme_mod('footer_info_left_icon', 'fa-headphones');
	
	$footer_info_right_title	= get_theme_mod('footer_info_right_title');
	$footer_info_right_subtitle	= get_theme_mod('footer_info_right_subtitle');
	$footer_info_right_icon		= get_theme_mod('footer_info_right_icon', 'fa-database');
	
	$footer_visa_link		= get_theme_mod('footer_visa_link', '#');
	$footer_paypal_link		= get_theme_mod('footer_paypal_link', '#');
	$footer_mastercard_link	= get_theme_mod('footer_mastercard_link', '#');
	$footer_amex_link		= get_theme_mod('footer_amex_link', '#');
	$footer_jcb_link		= get_theme_mod('footer_jcb_link', '#');
	
	$footer_bg_img				= get_theme_mod('footer_bg_img',esc_url(get_template_directory_uri() .'/assets/images/footer/footer-bg.jpg'));
	
?>
<!-- footer -->
    <footer class="footer-section footer-one">
        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="xMidYMid slice" style="position: absolute;inset:0;z-index:-1">
            <filter id="effect2" filterUnits="userSpaceOnUse" x="0" y="0" width="100%" height="100%">
              <feImage href="<?php echo esc_url($footer_bg_img); ?>" preserveAspectRatio="xMidYMid slice" result="back"/>
              <feGaussianBlur stdDeviation="40" in="SourceGraphic"/>
              <feComponentTransfer result="cutoff">
                <feFuncA type="linear" slope="19" intercept="-9"/>
              </feComponentTransfer>
              <feComposite operator="in" in="back" in2="blur"/>
              <feGaussianBlur stdDeviation="30" result="blur"/>
            </filter>
            <image id="scene" href="<?php  echo esc_url($footer_bg_img); ?>" width="100%" height="100%" preserveAspectRatio="xMidYMid slice" />
            <g id="footer-effect" style="filter:url(#effect2);fill:white">
            </g>
          </svg>
		  
		<?php if($hs_above_footer_client == 1) { 
					do_action('corpex_top_footer');
					}		
				?>
		<?php 
				if($hs_above_footer == 1) { ?>
        <div class="footer-top">
            <div class="container">
                <div class="footer-top-bg">
                    <div class="row">
                        <div class="col-lg-6 footer-top-item">
                            <aside class="widget widget-contact">
                                <div class="contact-area">
									<?php if(!empty($footer_info_left_icon)){ ?>
										<div class="contact-icon">
											<i class="fa <?php echo esc_attr($footer_info_left_icon); ?>"></i>
										</div>
									<?php } ?>
									
                                    <div class="contact-info">
                                        <p class="text">
											<?php if(!empty($footer_info_left_title)){ ?>
												<span><?php echo esc_html($footer_info_left_title); ?></span>
											<?php } ?>
												
											<?php if(!empty($footer_info_left_subtitle)){ ?>
												<a href="#"><?php echo esc_html($footer_info_left_subtitle); ?></a>
											<?php } ?>
                                        </p>
                                    </div>
                                </div>
                            </aside>
                        </div>
                        <div class="col-lg-6 footer-top-item">
                            <aside class="widget widget-contact">
                                <div class="contact-area">
                                    <div class="contact-info">
                                        <p class="text">
                                            <?php if(!empty($footer_info_right_title)){ ?>
												<span><?php echo esc_html($footer_info_right_title); ?></span>
											<?php } ?>
												
											<?php if(!empty($footer_info_right_subtitle)){ ?>
												<a href="#"><?php echo esc_html($footer_info_right_subtitle); ?></a>
											<?php } ?>
                                        </p>
                                    </div>
									
                                    <?php if(!empty($footer_info_right_icon)){ ?>
										<div class="contact-icon">
											<i class="fa <?php echo esc_attr($footer_info_right_icon); ?>"></i>
										</div>
									<?php } ?>
									
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </div>
				<?php } ?>
        <div class="footer-main">
            <div class="container">
				<?php if ( is_active_sidebar( 'corpex-footer-widget' ) ) : ?>
					<div class="row">
						<?php dynamic_sidebar( 'corpex-footer-widget'); ?>
					</div>
				<?php endif; ?>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6">
                        <?php do_action('corpex_footer_group_third');	?>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <aside class="widget widget_payment_methods">
                            <ul class="payment_methods">
								<?php if(!empty($footer_visa_link)){ ?>
									<li><a href="<?php echo esc_url($footer_visa_link); ?>"><i class="fab fa-cc-visa"></i></a></li>
								<?php } ?>
								
								<?php if(!empty($footer_paypal_link)){ ?>
									<li><a href="<?php echo esc_url($footer_paypal_link); ?>"><i class="fab fa-cc-paypal"></i></a></li>
								<?php } ?>
								
								<?php if(!empty($footer_mastercard_link)){ ?>
									<li><a href="<?php echo esc_url($footer_mastercard_link); ?>"><i class="fab fa-cc-mastercard"></i></a></li>
								<?php } ?>
								
								<?php if(!empty($footer_amex_link)){ ?>
									<li><a href="<?php echo esc_url($footer_amex_link); ?>"><i class="fab fa-cc-amex"></i></a></li>
								<?php } ?>
								
								<?php if(!empty($footer_mastercard_link)){ ?>
									<li><a href="<?php echo esc_url($footer_jcb_link); ?>"><i class="fab fa-cc-jcb"></i></a></li>
								<?php } ?>
                            </ul>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer End -->
 <!-- ScrollUp -->
	<?php 
		$hs_scroller 	= get_theme_mod('hs_scroller','1');	
		if($hs_scroller == '1') :
	?>
	<!-- ======== Back to Top =====- -->
    <!-- scroll-top -->
	<button type="button" class="scrollingUp main-btn" aria-label="scrollingUp"><i class="fas fa-angle-double-up"></i> </button>
    <!-- ======== End ======== -->
	<?php endif; ?>

<?php 
$front_pallate_enable = get_theme_mod('front_pallate_enable');
	if($front_pallate_enable == '1') :
		get_template_part('index','switcher');
	endif;
	
wp_footer(); ?>
</body>
</html>