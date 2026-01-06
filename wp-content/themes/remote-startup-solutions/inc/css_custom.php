<?php

$remote_startup_solutions_custom_css = "";

/*-------------------- Container Width-------------------*/

$remote_startup_solutions_theme_width = get_theme_mod( 'remote_startup_solutions_theme_width','full-width');

if($remote_startup_solutions_theme_width == 'full-width'){
$remote_startup_solutions_custom_css .='body{';
	$remote_startup_solutions_custom_css .='max-width: 100% !important;';
$remote_startup_solutions_custom_css .='}';
$remote_startup_solutions_custom_css .='.sticky-head{';
$remote_startup_solutions_custom_css .='left: 0;';
$remote_startup_solutions_custom_css .='}';
}else if($remote_startup_solutions_theme_width == 'container'){
$remote_startup_solutions_custom_css .='body{';
	$remote_startup_solutions_custom_css .='width: 80% !important; padding-right: 15px; padding-left: 15px;  margin-right: auto !important; margin-left: auto !important;';
$remote_startup_solutions_custom_css .='}';
$remote_startup_solutions_custom_css .='.sticky-head{';
$remote_startup_solutions_custom_css .='left: 0;';
$remote_startup_solutions_custom_css .='}';
}else if($remote_startup_solutions_theme_width == 'container-fluid'){
$remote_startup_solutions_custom_css .='body{';
	$remote_startup_solutions_custom_css .='width: 95% !important;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';
$remote_startup_solutions_custom_css .='}';
$remote_startup_solutions_custom_css .='.sticky-head{';
$remote_startup_solutions_custom_css .='left: 0;';
$remote_startup_solutions_custom_css .='}';
}

/*-------------------- Single Post Alignment-------------------*/

$remote_startup_solutions_single_post_align = get_theme_mod( 'remote_startup_solutions_single_post_align','left-align');

if($remote_startup_solutions_single_post_align == 'left-align'){
$remote_startup_solutions_custom_css .='body:not(.hide-post-meta) .post{';
	$remote_startup_solutions_custom_css .='text-align: left';
$remote_startup_solutions_custom_css .='}';
}else if($remote_startup_solutions_single_post_align == 'right-align'){
$remote_startup_solutions_custom_css .='body:not(.hide-post-meta) .post{';
	$remote_startup_solutions_custom_css .='text-align: right';
$remote_startup_solutions_custom_css .='}';
}else if($remote_startup_solutions_single_post_align == 'center-align'){
$remote_startup_solutions_custom_css .='body:not(.hide-post-meta) .post{';
	$remote_startup_solutions_custom_css .='text-align: center';
$remote_startup_solutions_custom_css .='}';
}

/*-------------------- Scroll Top Alignment-------------------*/

$remote_startup_solutions_scroll_top_alignment = get_theme_mod( 'remote_startup_solutions_scroll_top_alignment','right-align');

if($remote_startup_solutions_scroll_top_alignment == 'right-align'){
$remote_startup_solutions_custom_css .='#button{';
	$remote_startup_solutions_custom_css .='right: 5%;';
$remote_startup_solutions_custom_css .='}';
}else if($remote_startup_solutions_scroll_top_alignment == 'center-align'){
$remote_startup_solutions_custom_css .='#button{';
	$remote_startup_solutions_custom_css .='right:0; left:0; margin: 0 auto;';
$remote_startup_solutions_custom_css .='}';
}else if($remote_startup_solutions_scroll_top_alignment == 'left-align'){
$remote_startup_solutions_custom_css .='#button{';
	$remote_startup_solutions_custom_css .='left: 5%;';
$remote_startup_solutions_custom_css .='}';
}

/*-------------------- Archive Page Pagination Alignment-------------------*/

$remote_startup_solutions_archive_pagination_alignment = get_theme_mod( 'remote_startup_solutions_archive_pagination_alignment','left-align');

if($remote_startup_solutions_archive_pagination_alignment == 'right-align'){
$remote_startup_solutions_custom_css .='.pagination{';
	$remote_startup_solutions_custom_css .='justify-content: end;';
$remote_startup_solutions_custom_css .='}';
}else if($remote_startup_solutions_archive_pagination_alignment == 'center-align'){
$remote_startup_solutions_custom_css .='.pagination{';
	$remote_startup_solutions_custom_css .='justify-content: center;';
$remote_startup_solutions_custom_css .='}';
}else if($remote_startup_solutions_archive_pagination_alignment == 'left-align'){
$remote_startup_solutions_custom_css .='.pagination{';
	$remote_startup_solutions_custom_css .='justify-content: start;';
$remote_startup_solutions_custom_css .='}';
}

/*-------------------- Scroll Top Responsive-------------------*/

$remote_startup_solutions_resp_scroll_top = get_theme_mod( 'remote_startup_solutions_resp_scroll_top',true);
if($remote_startup_solutions_resp_scroll_top == true && get_theme_mod( 'remote_startup_solutions_scroll_to_top',true) != true){
	$remote_startup_solutions_custom_css .='#button.show{';
		$remote_startup_solutions_custom_css .='visibility:hidden !important;';
	$remote_startup_solutions_custom_css .='} ';
}
if($remote_startup_solutions_resp_scroll_top == true){
	$remote_startup_solutions_custom_css .='@media screen and (max-width:575px) {';
	$remote_startup_solutions_custom_css .='#button.show{';
		$remote_startup_solutions_custom_css .='visibility:visible !important;';
	$remote_startup_solutions_custom_css .='} }';
}else if($remote_startup_solutions_resp_scroll_top == false){
	$remote_startup_solutions_custom_css .='@media screen and (max-width:575px){';
	$remote_startup_solutions_custom_css .='#button.show{';
		$remote_startup_solutions_custom_css .='visibility:hidden !important;';
	$remote_startup_solutions_custom_css .='} }';
}

/*-------------------- Preloader Responsive-------------------*/

	$remote_startup_solutions_resp_loader = get_theme_mod('remote_startup_solutions_resp_loader',false);
	if($remote_startup_solutions_resp_loader == true && get_theme_mod('remote_startup_solutions_header_preloader',false) == false){
		$remote_startup_solutions_custom_css .='@media screen and (min-width:575px){
			.preloader{';
			$remote_startup_solutions_custom_css .='display:none !important;';
		$remote_startup_solutions_custom_css .='} }';
	}

	if($remote_startup_solutions_resp_loader == false){
		$remote_startup_solutions_custom_css .='@media screen and (max-width:575px){
			.preloader{';
			$remote_startup_solutions_custom_css .='display:none !important;';
		$remote_startup_solutions_custom_css .='} }';
	}