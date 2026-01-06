<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package indofinance
 */

?>
    <?php do_action('indofinance_before_footer'); 
	get_template_part( 'template-parts/footer/before-footer-widget'); 
	get_template_part( 'template-parts/footer/footer-widgets'); ?>

<div class="scroll-to-top">
    <?php if (!get_theme_mod('indofinance-scrolltotop-set')) : ?>
        <button class="backToTopBtn" onclick="scrollToTop()">
            <div class="circle">
                <span class="arrow-up"></span>
                <svg class="progress-ring" width="50" height="50">
                    <circle class="progress-ring__circle" stroke="white" stroke-width="4" fill="transparent" r="22" cx="25" cy="25"/>
                </svg>
            </div>
        </button>
    <?php endif; ?>
</div>

<footer id="colophon" class="site-footer">
	<div class="site-info">
			<?php 
				if (get_theme_mod('indofinance-copyright-text')) : 
					echo esc_html(get_theme_mod('indofinance-copyright-text'));
				else :	
					_e('© ','indofinance'); ?> <?php echo esc_html(get_bloginfo('name'));?> <?php echo esc_html(date('Y'));
				endif;	
			?>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Designed by %1$s', 'indofinance' ), '<a href="https://retirewithrohit.com" rel="nofollow">RetireWithRohit</a>' );
				?>
		</div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->
<div id="mobileMenu" class="mobile-navigation" role="navigation">
	
	<button class="go-to-bottom"></button>

	<div class="close-menu-wrapper">
		<button id="close-menu" class="menu-link" aria-label="<?php echo esc_attr__('Close Mobile Navigation', 'indofinance'); ?>">
			<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff">
				<path d="M0 0h24v24H0V0z" fill="none"/>
				<path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/>
			</svg>
		</button>
	</div>

	<?php get_search_form(); ?>


	<?php
		if ( has_nav_menu( 'menu-mobile' ) ) {
			wp_nav_menu( array(
				'theme_location' => 'menu-mobile',
				'menu_class'     => 'mobile-menu',
				'walker'         => new indofinance_Mobile_Menu(),
			) );
		} else {
			echo '<p class="no-menu-msg">' . esc_html__('Please assign a Mobile Menu.', 'indofinance') . '</p>';
		}
	?>

	<button class="go-to-top" aria-label="<?php echo esc_attr__('Go to Top', 'indofinance'); ?>"></button>
</div>

<?php wp_footer(); ?>

</body>
</html>
