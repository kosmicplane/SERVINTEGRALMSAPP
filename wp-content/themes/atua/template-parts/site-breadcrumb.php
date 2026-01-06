<?php 
	$atua_hs_site_breadcrumb    = get_theme_mod('atua_hs_site_breadcrumb','1');
	$atua_breadcrumb_bg_img		= get_theme_mod('atua_breadcrumb_bg_img',esc_url(get_template_directory_uri() .'/assets/images/background/page_title.jpg'));	
if($atua_hs_site_breadcrumb == '1'):	
?>
<section id="dt_pagetitle" class="dt_pagetitle dt-text-center">
	<canvas class="canvas" id="canvas"></canvas>
	<div class="bg__ayer parallax_none parallax-bg" data-parallax='{"y": 100}' style="background-image: url(<?php echo esc_url($atua_breadcrumb_bg_img); ?>);"></div>
	<div class="dt-container">
		<div class="dt_pagetitle_content">
			<div class="title">
				<?php
					if(is_home() || is_front_page()) {
						echo '<h1>'; echo single_post_title(); echo '</h1>';
					} else {
						atua_theme_page_header_title();
					} 
				?>
			</div>
			<ul class="dt_pagetitle_breadcrumb">
				<?php atua_page_header_breadcrumbs(); ?>
			</ul>
		</div>
	</div>
</section>
<?php else: ?>
<section id="dt_pagetitle" class="dt_pagetitle dt-text-center" style="padding-top: 5rem;">
	<canvas class="canvas" id="canvas"></canvas>
</section>
<?php endif; ?>	