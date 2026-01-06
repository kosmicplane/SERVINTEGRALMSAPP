<?php

$business_corporate_agency_tp_theme_css = '';

$business_corporate_agency_tp_color_option = get_theme_mod('business_corporate_agency_tp_color_option');

// 1st color
$business_corporate_agency_tp_color_option = get_theme_mod('business_corporate_agency_tp_color_option', '#e00a0a');
if ($business_corporate_agency_tp_color_option) {
	$business_corporate_agency_tp_theme_css .= ':root {';
	$business_corporate_agency_tp_theme_css .= '--color-primary1: ' . esc_attr($business_corporate_agency_tp_color_option) . ';';
	$business_corporate_agency_tp_theme_css .= '}';
}

//preloader

$business_corporate_agency_tp_preloader_color1_option = get_theme_mod('business_corporate_agency_tp_preloader_color1_option');
$business_corporate_agency_tp_preloader_color2_option = get_theme_mod('business_corporate_agency_tp_preloader_color2_option');
$business_corporate_agency_tp_preloader_bg_color_option = get_theme_mod('business_corporate_agency_tp_preloader_bg_color_option');

if($business_corporate_agency_tp_preloader_color1_option != false){
$business_corporate_agency_tp_theme_css .='.center1{';
	$business_corporate_agency_tp_theme_css .='border-color: '.esc_attr($business_corporate_agency_tp_preloader_color1_option).' !important;';
$business_corporate_agency_tp_theme_css .='}';
}
if($business_corporate_agency_tp_preloader_color1_option != false){
$business_corporate_agency_tp_theme_css .='.center1 .ring::before{';
	$business_corporate_agency_tp_theme_css .='background: '.esc_attr($business_corporate_agency_tp_preloader_color1_option).' !important;';
$business_corporate_agency_tp_theme_css .='}';
}
if($business_corporate_agency_tp_preloader_color2_option != false){
$business_corporate_agency_tp_theme_css .='.center2{';
	$business_corporate_agency_tp_theme_css .='border-color: '.esc_attr($business_corporate_agency_tp_preloader_color2_option).' !important;';
$business_corporate_agency_tp_theme_css .='}';
}
if($business_corporate_agency_tp_preloader_color2_option != false){
$business_corporate_agency_tp_theme_css .='.center2 .ring::before{';
	$business_corporate_agency_tp_theme_css .='background: '.esc_attr($business_corporate_agency_tp_preloader_color2_option).' !important;';
$business_corporate_agency_tp_theme_css .='}';
}
if($business_corporate_agency_tp_preloader_bg_color_option != false){
$business_corporate_agency_tp_theme_css .='.loader{';
	$business_corporate_agency_tp_theme_css .='background: '.esc_attr($business_corporate_agency_tp_preloader_bg_color_option).';';
$business_corporate_agency_tp_theme_css .='}';
}

// footer-bg-color
$business_corporate_agency_tp_footer_bg_color_option = get_theme_mod('business_corporate_agency_tp_footer_bg_color_option');

if($business_corporate_agency_tp_footer_bg_color_option != false){
$business_corporate_agency_tp_theme_css .='#footer{';
	$business_corporate_agency_tp_theme_css .='background: '.esc_attr($business_corporate_agency_tp_footer_bg_color_option).' !important;';
$business_corporate_agency_tp_theme_css .='}';
}

// logo tagline color
$business_corporate_agency_site_tagline_color = get_theme_mod('business_corporate_agency_site_tagline_color');

if($business_corporate_agency_site_tagline_color != false){
$business_corporate_agency_tp_theme_css .='.logo h1 a, .logo p a{';
$business_corporate_agency_tp_theme_css .='color: '.esc_attr($business_corporate_agency_site_tagline_color).';';
$business_corporate_agency_tp_theme_css .='}';
}

$business_corporate_agency_logo_tagline_color = get_theme_mod('business_corporate_agency_logo_tagline_color');
if($business_corporate_agency_logo_tagline_color != false){
$business_corporate_agency_tp_theme_css .='p.site-description{';
$business_corporate_agency_tp_theme_css .='color: '.esc_attr($business_corporate_agency_logo_tagline_color).';';
$business_corporate_agency_tp_theme_css .='}';
}

// footer widget title color
$business_corporate_agency_footer_widget_title_color = get_theme_mod('business_corporate_agency_footer_widget_title_color');
if($business_corporate_agency_footer_widget_title_color != false){
$business_corporate_agency_tp_theme_css .='#footer h3, #footer h2.wp-block-heading{';
$business_corporate_agency_tp_theme_css .='color: '.esc_attr($business_corporate_agency_footer_widget_title_color).';';
$business_corporate_agency_tp_theme_css .='}';
}

// copyright text color
$business_corporate_agency_footer_copyright_text_color = get_theme_mod('business_corporate_agency_footer_copyright_text_color');
if($business_corporate_agency_footer_copyright_text_color != false){
$business_corporate_agency_tp_theme_css .='#footer .site-info p, #footer .site-info a {';
$business_corporate_agency_tp_theme_css .='color: '.esc_attr($business_corporate_agency_footer_copyright_text_color).';';
$business_corporate_agency_tp_theme_css .='}';
}

// header image title color
$business_corporate_agency_header_image_title_text_color = get_theme_mod('business_corporate_agency_header_image_title_text_color');
if($business_corporate_agency_header_image_title_text_color != false){
$business_corporate_agency_tp_theme_css .='.box-text h2{';
$business_corporate_agency_tp_theme_css .='color: '.esc_attr($business_corporate_agency_header_image_title_text_color).';';
$business_corporate_agency_tp_theme_css .='}';
}

// menu color
$business_corporate_agency_menu_color = get_theme_mod('business_corporate_agency_menu_color');
if($business_corporate_agency_menu_color != false){
$business_corporate_agency_tp_theme_css .='.main-navigation a{';
$business_corporate_agency_tp_theme_css .='color: '.esc_attr($business_corporate_agency_menu_color).';';
$business_corporate_agency_tp_theme_css .='}';
}
