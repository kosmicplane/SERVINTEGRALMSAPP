<?php
$show_page_title = g5plus_get_option('show_archive_product_title','1');
if ($show_page_title == 0) {
    return;
}
$prefix = 'g5plus_';

//archive
$page_title_bg_image = '';
$page_title_height = '';
$cat = get_queried_object();
if ($cat && property_exists( $cat, 'term_id' )) {
    $page_title_bg_image = g5plus_get_tax_meta($cat->term_id,$prefix.'page_title_background');
    $page_title_height = g5plus_get_tax_meta($cat->term_id,$prefix.'page_title_height');
}

if(!$page_title_bg_image || $page_title_bg_image === '') {
    $page_title_bg_image = g5plus_get_option('archive_product_title_bg_image',array(
	    'url' => THEME_URL . 'assets/images/bg-shop-title.jpg'
    ));
}

if (isset($page_title_bg_image) && isset($page_title_bg_image['url'])) {
    $page_title_bg_image_url = $page_title_bg_image['url'];
}

if ( ($page_title_height === '') || $page_title_height <= 0) {
	$opt_archive_product_title_height = g5plus_get_option('archive_product_title_height',array(
		'height'  => ''
	));
	if (isset($opt_archive_product_title_height['height']) && !empty($opt_archive_product_title_height['height']) && ($opt_archive_product_title_height['height'] !== 'px')) {
		$page_title_height = $opt_archive_product_title_height['height'];
	}
}

$breadcrumbs_in_page_title = g5plus_get_option('breadcrumbs_in_archive_product_title','1');

$class = array();
$class[] = 'page-title-wrap';

$custom_styles = array();

if ($page_title_bg_image_url != '') {
    $class[] = 'page-title-wrap-bg';
    $custom_styles[] = 'background-image: url(' . $page_title_bg_image_url . ')';
}

if (($page_title_height != '')) {
    if (strpos($page_title_height,'px') === FALSE) {
        $page_title_height = $page_title_height . 'px';
    }
    $custom_styles[] = 'height:' . $page_title_height;
}

$class_name = join(' ', $class);

$custom_style= '';
if ($custom_styles) {
    $custom_style = 'style="'. join(';',$custom_styles).'"';
}
?>
<section class="<?php echo esc_attr($class_name) ?>" <?php echo wp_kses_post($custom_style); ?>>
    <div class="page-title-overlay"></div>
    <div class="container">
        <div class="page-title-inner block-center">
            <div class="block-center-inner">
                <h1><?php woocommerce_page_title(); ?></h1>
                <?php if($breadcrumbs_in_page_title == 1) {
                    g5plus_the_breadcrumb();
                } ?>
            </div>
        </div>
    </div>
</section>