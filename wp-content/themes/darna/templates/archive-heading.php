<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/3/2015
 * Time: 9:16 AM
 */
$prefix = 'g5plus_';
$show_page_title = g5plus_get_option('show_archive_title','1');
if ($show_page_title == 0) {
    return;
}

$on_front = get_option('show_on_front');
$page_title = '';
if (!have_posts()) {
    $page_title = esc_html__("Nothing Found", 'g5plus-darna');
} elseif (is_home()) {
    if (($on_front == 'page' && get_queried_object_id() == get_post(get_option('page_for_posts'))->ID) || ($on_front == 'posts')) {
        $page_title = esc_html__("Blog", 'g5plus-darna');
    } else {
        $page_title = '';
    }
} elseif (is_category()) {
    $page_title = single_cat_title('', false);
} elseif (is_tag()) {
    $page_title = single_tag_title(esc_html__("Tags: ", 'g5plus-darna'), false);
} elseif (is_author()) {
    $page_title = sprintf(esc_html__('Author: %s', 'g5plus-darna'), get_the_author());
} elseif (is_day()) {
    $page_title = sprintf(esc_html__('Daily Archives: %s', 'g5plus-darna'), get_the_date());
} elseif (is_month()) {
    $page_title = sprintf(esc_html__('Monthly Archives: %s', 'g5plus-darna'), get_the_date(_x('F Y', 'monthly archives date format', 'g5plus-darna')));
} elseif (is_year()) {
    $page_title = sprintf(esc_html__('Yearly Archives: %s', 'g5plus-darna'), get_the_date(_x('Y', 'yearly archives date format', 'g5plus-darna')));
} elseif (is_search()) {
    $page_title = sprintf(esc_html__('Search Results for: %s', 'g5plus-darna'), get_search_query());
} elseif (is_tax('post_format', 'post-format-aside')) {
    $page_title = esc_html__('Asides', 'g5plus-darna');
} elseif (is_tax('post_format', 'post-format-gallery')) {
    $page_title = esc_html__('Galleries', 'g5plus-darna');
} elseif (is_tax('post_format', 'post-format-image')) {
    $page_title = esc_html__('Images', 'g5plus-darna');
} elseif (is_tax('post_format', 'post-format-video')) {
    $page_title = esc_html__('Videos', 'g5plus-darna');
} elseif (is_tax('post_format', 'post-format-quote')) {
    $page_title = esc_html__('Quotes', 'g5plus-darna');
} elseif (is_tax('post_format', 'post-format-link')) {
    $page_title = esc_html__('Links', 'g5plus-darna');
} elseif (is_tax('post_format', 'post-format-status')) {
    $page_title = esc_html__('Statuses', 'g5plus-darna');
} elseif (is_tax('post_format', 'post-format-audio')) {
    $page_title = esc_html__('Audios', 'g5plus-darna');
} elseif (is_tax('post_format', 'post-format-chat')) {
    $page_title = esc_html__("Chats", 'g5plus-darna');
} else {
    $page_title = esc_html__("Archives", 'g5plus-darna');
}


//archive
$page_title_bg_image = '';
$page_title_height = '';
$cat = get_queried_object();
if ($cat && property_exists( $cat, 'term_id' )) {
    $page_title_bg_image = g5plus_get_tax_meta($cat->term_id,$prefix.'page_title_background');
    $page_title_height = g5plus_get_tax_meta($cat->term_id,$prefix.'page_title_height');
}


if(!$page_title_bg_image || ($page_title_bg_image === '')) {
    $page_title_bg_image = g5plus_get_option('archive_title_bg_image',array(
	    'url' => THEME_URL . 'assets/images/bg-archive-title.jpg'
    ));
}


if (isset($page_title_bg_image) && isset($page_title_bg_image['url'])) {
    $page_title_bg_image_url = $page_title_bg_image['url'];
}
if (($page_title_height === '')  || $page_title_height <= 0) {
	$opt_archive_title_height = g5plus_get_option('archive_title_height',array('height'  => ''));
	if (isset($opt_archive_title_height['height']) && !empty($opt_archive_title_height['height']) && ($opt_archive_title_height['height'] !== 'px')) {
		$page_title_height = $opt_archive_title_height['height'];
	}
}


$breadcrumbs_in_page_title = g5plus_get_option('breadcrumbs_in_archive_title','1');

$class = array();
$class[] = 'page-title-wrap';

$custom_styles = array();

if ($page_title_bg_image_url != '') {
    $class[] = 'page-title-wrap-bg';
    $custom_styles[] = 'background-image: url(' . $page_title_bg_image_url . ')';
}
if ( ($page_title_height != '')) {
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

/*if (!empty($page_title_bg_image_url)) {
    $custom_style.= ' data-stellar-background-ratio="0.5"';
}*/

?>

<section class="<?php echo esc_attr($class_name) ?>" <?php echo wp_kses_post($custom_style); ?>>
    <div class="page-title-overlay"></div>
    <div class="container">
        <div class="page-title-inner block-center">
            <div class="block-center-inner">
                <h1><?php echo esc_html($page_title); ?></h1>
                <?php if($breadcrumbs_in_page_title == 1) {
                    g5plus_the_breadcrumb();
                } ?>
            </div>
        </div>
    </div>
</section>