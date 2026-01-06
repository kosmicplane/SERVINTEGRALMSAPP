<?php
/**
 * Created by PhpStorm.
 * User: phuongth
 * Date: 3/20/15
 * Time: 4:53 PM
 */

add_action("wp_ajax_nopriv_g5plusframework_portfolio_load_more", "g5plusframework_portfolio_load_more");
add_action("wp_ajax_g5plusframework_portfolio_load_more", "g5plusframework_portfolio_load_more");
function g5plusframework_portfolio_load_more(){
    $current_page = $_REQUEST['current_page'];
    $offset = $_REQUEST['offset'];
    $posts_per_page = $_REQUEST['postsPerPage'];
    $layout_type = $_REQUEST['layoutType'];
    $overlay_style = $_REQUEST['overlayStyle'];
    $column = $_REQUEST['columns'];
    $padding = $_REQUEST['colPadding'];
    $order = $_REQUEST['order'];
    $short_code = sprintf('[g5plusframework_portfolio show_category="" column="%s" item="%s" show_pagging="1" overlay_style="%s" layout_type="%s" padding="%s" current_page="%s" order="%s"]', $column, $posts_per_page, $overlay_style, $layout_type, $padding, $current_page, $order);
    echo do_shortcode($short_code);
    die();
}

add_action("wp_ajax_nopriv_g5plusframework_portfolio_load_by_category", "g5plusframework_portfolio_load_by_category");
add_action("wp_ajax_g5plusframework_portfolio_load_by_category", "g5plusframework_portfolio_load_by_category");
function g5plusframework_portfolio_load_by_category(){
    $current_page = $_REQUEST['current_page'];
    $offset = $_REQUEST['offset'];
    $posts_per_page = $_REQUEST['postsPerPage'];
    $layout_type = $_REQUEST['layoutType'];
    $overlay_style = $_REQUEST['overlayStyle'];
    $column = $_REQUEST['columns'];
    $padding = $_REQUEST['colPadding'];
    $category = $_REQUEST['category'];
    $order = $_REQUEST['order'];
    if($category=='all')
        $category = '';
    $short_code = sprintf('[g5plusframework_portfolio category="%s" column="%s" item="%s" show_pagging="1" overlay_style="%s" layout_type="%s" padding="%s" current_page="%s" order="%s"]', $category, $column, $posts_per_page, $overlay_style, $layout_type, $padding, $current_page, $order);
    echo do_shortcode($short_code);
    die();
}