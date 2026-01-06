<?php																																										// get header mobile layout
$mobile_header_layout = g5plus_get_option('mobile_header_layout','header-mobile-1') ;
$header_mobile_class = array('header-mobile-inner', $mobile_header_layout);

// Get logo url for mobile
$logo_url = THEME_URL . 'assets/images/theme-options/logo.png';
$opt_mobile_header_logo = g5plus_get_option('mobile_header_logo',array(
	'url' => THEME_URL . '/assets/images/theme-options/logo.png'
));
$opt_logo = g5plus_get_option('logo', array(
	'url' => THEME_URL . '/assets/images/theme-options/logo.png'
));
if (isset($opt_mobile_header_logo['url']) && !empty($opt_mobile_header_logo['url'])) {
	$logo_url = $opt_mobile_header_logo['url'];
}
else if (isset($opt_logo['url']) && !empty($opt_logo['url'])) {
	$logo_url = $opt_logo['url'];
}

// Get search & mini-cart for header mobile
$prefix = 'g5plus_';

$mobile_header_shopping_cart = g5plus_get_meta($prefix . 'mobile_header_shopping_cart');
if (($mobile_header_shopping_cart === false) || ($mobile_header_shopping_cart === '') || ($mobile_header_shopping_cart == '-1')) {
	$mobile_header_shopping_cart = g5plus_get_option('mobile_header_shopping_cart','1');
}

$mobile_header_search_box = g5plus_get_meta($prefix . 'mobile_header_search_box');
if (($mobile_header_search_box === false) || ($mobile_header_search_box === '') || ($mobile_header_search_box == '-1')) {
	$mobile_header_search_box = g5plus_get_option('mobile_header_search_box','1');
}

$mobile_header_menu_drop = g5plus_get_option('mobile_header_menu_drop','fly');
?>
<div class="container header-mobile-wrapper">
	<div class="<?php echo join(' ', $header_mobile_class) ?>">
		<div class="toggle-icon-wrapper" data-ref="main-menu" data-drop-type="<?php echo esc_attr($mobile_header_menu_drop); ?>">
			<div class="toggle-icon"> <span></span></div>
		</div>

		<div class="header-customize">
			<?php if ($mobile_header_search_box == '1'): ?>
				<?php g5plus_get_template('header/search-button'); ?>
			<?php endif; ?>
			<?php if (($mobile_header_shopping_cart == '1') && class_exists( 'WooCommerce' )): ?>
				<?php g5plus_get_template('header/mini-cart'); ?>
			<?php endif; ?>
		</div>

		<?php if ($mobile_header_layout != 'header-mobile-2'): ?>
			<div class="header-logo-mobile">
				<a  href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" rel="home">
					<img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" />
				</a>
			</div>
		<?php endif;?>
	</div>
</div>