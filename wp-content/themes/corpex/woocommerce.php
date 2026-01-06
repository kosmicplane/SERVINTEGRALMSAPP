<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Corpex
 */

get_header();
$class =  ( is_active_sidebar( 'corpex-woocommerce-sidebar' ))?'col-lg-8':'col-lg-12';
?>
<!-- Blog & Sidebar Section -->
 <section id="product" class="product-section shop_product">
        <div class="container">
            <div class="row">
			<!--Blog Detail-->
			<div class="<?php echo esc_attr($class); ?> wow fadeInUp">
				<?php woocommerce_content(); ?>
			</div>
			
			<?php if (!is_single() ){ ?>
				<div class="col-lg-4">
					<div class="sidebar">
					<!--/End of Blog Detail-->
					<?php dynamic_sidebar('corpex-woocommerce-sidebar'); ?>
					</div>
				</div>
			<?php } ?>
		</div>	
	</div>
</section>
<!-- End of Blog & Sidebar Section -->

<?php get_footer(); ?>

