<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/6/2015
 * Time: 9:36 AM
 */

/*================================================
FILTER SEARCH FORM
================================================== */
if (!function_exists('g5plus_search_form')) {
    function g5plus_search_form($form)
    {
        $form = '<form role="search" class="search-form" method="get" id="searchform" action="' . home_url('/') . '">
                <input type="text" value="' . get_search_query() . '" name="s" id="s"  placeholder="' . esc_attr__("Search Here...", 'g5plus-darna') . '">
                <button type="submit"><i class="fa fa-search"></i></button>
     		</form>';
        return $form;
    }
    add_filter('get_search_form', 'g5plus_search_form');
}


/* CUSTOM PAGE TEMPLATE
    ================================================== */
if (!function_exists('g5plus_page_template_custom')) {
	function g5plus_page_template_custom($template ){
		if (isset($_REQUEST['custom-page']) && !empty($_REQUEST['custom-page'])) {
			global $g5plus_is_do_action_custom_page;
			if (!isset($g5plus_is_do_action_custom_page) || $g5plus_is_do_action_custom_page !== '1') {
				$g5plus_is_do_action_custom_page = '1';
				do_action('custom-page/'.$_REQUEST['custom-page']);
			}
			return;
		}
		return $template;

	}
	add_filter( "page_template", "g5plus_page_template_custom" );
}