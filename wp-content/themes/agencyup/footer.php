<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @package Agencyup
 */
?>
<!--==================== AGENCYUP-FOOTER AREA ====================-->
  <?php 
  $agencyup_footer_widget_background = get_theme_mod('agencyup_footer_widget_background');
  $agencyup_overlay_footer_widget_control = get_theme_mod('agencyup_overlay_footer_widget_control'); 
  
  $footer_social_icon_enable = get_theme_mod('footer_social_icon_enable',true); $agencyup_footer_fb_link = get_theme_mod('agencyup_footer_fb_link');
  $agencyup_footer_fb_target = get_theme_mod('agencyup_footer_fb_target',1);
  $agencyup_footer_twt_link = get_theme_mod('agencyup_footer_twt_link');
  $agencyup_footer_twt_target = get_theme_mod('agencyup_footer_twt_target',1);
  $agencyup_footer_lnkd_link = get_theme_mod('agencyup_footer_lnkd_link');
  $agencyup_footer_lnkd_target = get_theme_mod('agencyup_footer_lnkd_target',1);
  $agencyup_footer_insta_link = get_theme_mod('agencyup_footer_insta_link');
  $agencyup_footer_insta_target = get_theme_mod('agencyup_footer_insta_target',1);
   if($agencyup_footer_widget_background != '') { ?>
<footer style="background-image:url('<?php echo esc_url($agencyup_footer_widget_background);?>');">
  <?php } else { ?>
<footer> 
  <?php } ?>
  <div class="overlay" style="background-color: <?php echo esc_attr($agencyup_overlay_footer_widget_control);?>;">
  <!--Start agencyup-footer-widget-area-->
  <?php if ( is_active_sidebar( 'footer_widget_area' ) ) { ?>
  <div class="bs-footer-widget-area">
    <div class="container">
      <div class="row">
        <?php  dynamic_sidebar( 'footer_widget_area' ); ?>
      </div>
    </div>
  </div>
  <?php } ?>
  <!--End agencyup-footer-widget-area-->
  <div class="bs-footer-copyright">
    <div class="container">
      <div class="row">
        <div class="col-md-<?php if((!empty($agencyup_footer_fb_link) || !empty($agencyup_footer_twt_link) || !empty($agencyup_footer_lnkd_link) || !empty($agencyup_footer_insta_link)) && ($footer_social_icon_enable == true) ){ echo '6'; } else { echo '12 text-center';}?>">
			<div class="site-info">
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'agencyup' ) ); ?>">
					<?php
					/* translators: placeholder replaced with string */
					printf( esc_html__( 'Proudly powered by %s', 'agencyup' ), 'WordPress' );
					?>
				</a>
				<span class="sep"> | </span>
				<?php
				/* translators: placeholder replaced with string */
				printf( esc_html__( 'Theme: %1$s  %2$s.', 'agencyup' ), 'Agencyup by', '<a href="' . esc_url( __( 'https://themeansar.com/', 'agencyup' ) ) . '" rel="designer"> Themeansar</a>' );
				?>		
			</div>
		</div>
           <?php 
		  if($footer_social_icon_enable == true)
		  { 
			 
			if(!empty($agencyup_footer_fb_link) || !empty($agencyup_footer_twt_link) || !empty($agencyup_footer_lnkd_link) || !empty($agencyup_footer_insta_link) ){
			  ?>
		<div class="col-md-6 text-right">
		  <ul class="bs-social">
			<?php if($agencyup_footer_fb_link !=''){?>
			<li><span class="icon-soci"><a <?php if($agencyup_footer_fb_target) { ?> target="_blank" <?php } ?>href="<?php echo esc_url($agencyup_footer_fb_link); ?>"><i class="fab fa-facebook-f"></i></a></span> </li>
			<?php } if($agencyup_footer_twt_link !=''){ ?>
			<li><span class="icon-soci"><a <?php if($agencyup_footer_twt_target) { ?>target="_blank" <?php } ?>href="<?php echo esc_url($agencyup_footer_twt_link);?>"><i class="fab fa-twitter"></i></a></span></li>
			<?php } if($agencyup_footer_lnkd_link !=''){ ?>
			<li><span class="icon-soci"><a <?php if($agencyup_footer_lnkd_target) { ?>target="_blank" <?php } ?> href="<?php echo esc_url($agencyup_footer_lnkd_link); ?>"><i class="fab fa-linkedin"></i></a></span></li>
			<?php } 
			if($agencyup_footer_insta_link !=''){ ?>
			<li><span class="icon-soci"><a <?php if($agencyup_footer_insta_target) { ?>target="_blank" <?php } ?> href="<?php echo esc_url($agencyup_footer_insta_link); ?>"><i class="fab fa-instagram"></i></a></span></li>
			<?php } ?>
			</ul>
		</div>
		  <?php } } ?>
      </div>
    </div>
  </div>
  </div>
</footer>
</div>
<?php $scoller = get_theme_mod('scroller_enable','on');
if($scoller !='off')
{
?>
<!-- Scroll To Top -->
<a href="#" class="bs_upscr"><i class="fas fa-angle-up"></i></a>
<!-- /Scroll To Top -->
<?php } ?>
<?php wp_footer(); ?>
</body>
</html>