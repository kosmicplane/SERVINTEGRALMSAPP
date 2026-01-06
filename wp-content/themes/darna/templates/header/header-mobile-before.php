<?php
$logo_url = THEME_URL . 'assets/images/theme-options/logo.svg';
$opt_mobile_header_logo = g5plus_get_option('mobile_header_logo', array(
	'url' => THEME_URL . '/assets/images/theme-options/logo.png'
));
$opt_logo = g5plus_get_option('logo',array(
	'url' => THEME_URL . '/assets/images/theme-options/logo.png'
));

if (isset($opt_mobile_header_logo['url']) && !empty($opt_mobile_header_logo['url'])) {
	$logo_url = $opt_mobile_header_logo['url'];
}
else if (isset($opt_logo['url']) && !empty($opt_logo['url'])) {
	$logo_url = $opt_logo['url'];
}

$mobile_header_layout = 'header-mobile-1';
$opt_mobile_header_layout = g5plus_get_option('mobile_header_layout','header-mobile-2');
if ( !empty($opt_mobile_header_layout)) {
	$mobile_header_layout = $opt_mobile_header_layout;
}

?>
<?php if ($mobile_header_layout == 'header-mobile-2'): ?>
	<div class="header-mobile-before">
		<a  href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" rel="home">
			<img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" />
		</a>
	</div>
<?php endif;?>