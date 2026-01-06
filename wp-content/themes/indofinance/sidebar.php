<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package indofinance
 */
if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}

if ( $args['sidebar'] === 'none' ) {
	return;
}

$class = ['widget-area', 'theme-sidebar'];
if (isset($args['sidebar']) && in_array($args['sidebar'], ['right', 'dual'] ) ) {
	array_push($class, 'md-3');
}
?>

<aside id="secondary" class="<?php echo implode( " ", $class ); ?>">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
