<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Atua
 */

get_header();
?>
<section id="dt_404" class="dt_404">
	<div class="dt-container">
		<div class="dt-container-inner dt-py-default">
			<div class="section-line">
				<div class="line line-1"></div>
				<div class="line line-3"></div>
			</div>
			<div class="dt-row">
				<div class="dt-col-xl-7 dt-col-lg-8 dt-col-md-9 dt-col-12 dt-mx-auto dt-mb-6">
					<div class="dt_siteheading dt-text-center">
						<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>	
						<h2 class="title">
							<span class="dt_heading dt_heading_9 fa-3x"><span class="dt_heading_inner"><b class="is_on"><?php esc_html_e('404','atua'); ?></b> <b><?php esc_html_e('404','atua'); ?></b> <b><?php esc_html_e('404','atua'); ?></b></span></span><br/><?php esc_html_e('Page not found','atua'); ?>
						</h2>  
						
						<div class="text dt-mt-4 wow fadeInUp" data-wow-duration="1500ms">
							<p><?php esc_html_e('The page you are looking for dosen’t exist or another error occourd go back to home or another source.','atua'); ?></p>
						</div>  
						
						<a href="<?php echo esc_url(home_url( '/' )); ?>" class="dt-btn dt-btn-primary dt-mt-5">
							<span class="dt-btn-text" data-text="<?php esc_attr_e('Return to home','atua'); ?>"><?php esc_html_e('Return to home','atua'); ?></span>
						</a>  
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>