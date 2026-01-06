<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package indofinance
 */
$page_layout = isset($args['page-layout']) ? $args['page-layout'] : '';
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'indofinance' ); ?></a>

	<?php
		$layout = get_theme_mod('indofinance_header_layout', 'center');
	?>
	<header id="masthead" class="site-header header header__<?php echo esc_attr($layout); ?>">
		<?php
		if (!empty(get_theme_mod('indofinance_top_bar_enable', '1'))) {
		?>
		<div class="top-bar">
			<div class="container">
				<?php
				if (!empty(get_theme_mod('indofinance_top_menu_enable', ''))) {
					get_template_part('inc/modules/nav', 'top');
				}
				?>
				<div class="top-bar__social-icons">
					<?php
						$social_networks = array(
							'facebook-alt' 	=> esc_html__('Facebook', 'indofinance'),
							'twitter' 		=> esc_html__('Twitter', 'indofinance'),
							'instagram' 	=> esc_html__('Instagram', 'indofinance'),
							'linkedin'      => esc_html__('LinkedIn', 'indofinance'),
							'youtube' 		=> esc_html__('Youtube', 'indofinance'),
						);
						for ($i = 1; $i <= 6; $i++) {
							$icon	= get_theme_mod("indofinance_{$i}_icon", 'none');
							$url	= get_theme_mod("indofinance_social_url_{$i}", '');
							
							if ($icon !== 'none') {
								printf('<span><a href="%s" title="%s"><span class="dashicons dashicons-%s"></span></a></span>', esc_url( $url ), esc_attr( $social_networks[$icon] ), $icon );
							}
						}
					?>
				</div>
			</div>
		</div>
		<?php } ?>
		<?php get_template_part('template-parts/header/header', $layout, ['layout' => $page_layout]); ?>
	</header><!-- #masthead -->