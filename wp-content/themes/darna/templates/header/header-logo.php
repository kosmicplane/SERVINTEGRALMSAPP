<?php
$prefix = 'g5plus_';
$header_layout = g5plus_get_meta($prefix . 'header_layout');
if ((!$header_layout) || ($header_layout === '') || ($header_layout == '-1')) {
	$header_layout = g5plus_get_option('header_layout','header-3');
}

$logo_meta = g5plus_get_meta($prefix . 'custom_logo', 'type=image_advanced');
$logo_url = '';
if (is_array($logo_meta)) {
	foreach ( $logo_meta as $item ) {
		if (isset($item['full_url']) & !empty($item['full_url'])) {
			$logo_url = $item['full_url'];
			break;
		}

	}
}

if ($logo_url === '') {
	$logo_url = THEME_URL . 'assets/images/theme-options/logo.png';
	$opt_logo = g5plus_get_option('logo',array(
		'url' => THEME_URL . '/assets/images/theme-options/logo.png'
	));
	if (isset($opt_logo['url']) && !empty($opt_logo['url'])) {
		$logo_url = $opt_logo['url'];
	}
}

?>
<div class="header-logo">
	<a  href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" rel="home">
		<img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" />
	</a>
</div>