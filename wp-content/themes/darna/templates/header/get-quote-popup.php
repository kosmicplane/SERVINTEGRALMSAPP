<?php
$prefix = 'g5plus_';

$enable_header_customize = g5plus_get_meta($prefix . 'enable_header_customize');

$header_customize = array();
$get_quote_shortcode = '[mc4wp_form]';
if ($enable_header_customize == '1') {
	$page_header_customize = g5plus_get_meta($prefix . 'header_customize');
	if (isset($page_header_customize['enable']) && !empty($page_header_customize['enable'])) {
		$header_customize = explode('||', $page_header_customize['enable']);
	}

	$get_quote_shortcode = g5plus_get_meta($prefix . 'header_get_a_quote_shortcode');
	if (empty($get_quote_shortcode)) {
		$get_quote_shortcode = '[mc4wp_form]';
	}
} else {
	$opt_header_customize = g5plus_get_option('header_customize',
		array(
			'enabled'  => array(
				'get-a-quote' => 'Get a quote',
				'shopping-cart'   => 'Shopping Cart',
				'search' => 'Search Box',
			),
			'disabled' => array(
				'custom-text' => 'Custom Text',
			)
		));
	if (isset($opt_header_customize['enabled']) && is_array($opt_header_customize['enabled'])) {
		foreach ($opt_header_customize['enabled'] as $key => $value) {
			$header_customize[] = $key;
		}
	}
	$opt_header_get_a_quote_shortcode = g5plus_get_option('header_get_a_quote_shortcode');
	if ( !empty($opt_header_get_a_quote_shortcode)) {
		$get_quote_shortcode = $opt_header_get_a_quote_shortcode;
	}
}
$default_form_id = get_option('mc4wp_default_form_id');
if ($get_quote_shortcode === '[mc4wp_form]' &&  $default_form_id === false) return;
if (in_array('get-a-quote', $header_customize)):
	?>
	<div id="get_quote_popup" class="dialog">
		<div class="dialog__overlay"></div>
		<div class="dialog__content">
			<div class="morph-shape">
				<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 520 280"
				     preserveAspectRatio="none">
					<rect x="3" y="3" fill="none" width="516" height="276"/>
				</svg>
			</div>
			<div class="dialog-inner">
				<?php if ($get_quote_shortcode == '[mc4wp_form]'): ?>
					<h2><?php _e('Get a quote','g5plus-darna'); ?></h2>
				<?php endif;?>
				<div class="mail-chimp-popup">
					<?php echo do_shortcode($get_quote_shortcode); ?>
				</div>
				<div><button type="button" class="action" data-dialog-close="close"><i class="fa fa-close"></i></button></div>
			</div>
		</div>
	</div>
<?php
endif;