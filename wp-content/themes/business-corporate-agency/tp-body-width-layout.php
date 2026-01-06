<?php

	$business_corporate_agency_tp_theme_css = "";

$business_corporate_agency_theme_lay = get_theme_mod( 'business_corporate_agency_tp_body_layout_settings','Full');
if($business_corporate_agency_theme_lay == 'Container'){
$business_corporate_agency_tp_theme_css .='body{';
	$business_corporate_agency_tp_theme_css .='max-width: 1140px; width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;';
$business_corporate_agency_tp_theme_css .='}';
$business_corporate_agency_tp_theme_css .='@media screen and (max-width:575px){';
		$business_corporate_agency_tp_theme_css .='body{';
			$business_corporate_agency_tp_theme_css .='max-width: 100%; padding-right:0px; padding-left: 0px';
		$business_corporate_agency_tp_theme_css .='} }';
$business_corporate_agency_tp_theme_css .='.page-template-front-page .menubar{';
	$business_corporate_agency_tp_theme_css .='position: static;';
$business_corporate_agency_tp_theme_css .='}';
$business_corporate_agency_tp_theme_css .='.scrolled{';
	$business_corporate_agency_tp_theme_css .='width: auto; left:0; right:0;';
$business_corporate_agency_tp_theme_css .='}';
}else if($business_corporate_agency_theme_lay == 'Container Fluid'){
$business_corporate_agency_tp_theme_css .='body{';
	$business_corporate_agency_tp_theme_css .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';
$business_corporate_agency_tp_theme_css .='}';
$business_corporate_agency_tp_theme_css .='@media screen and (max-width:575px){';
		$business_corporate_agency_tp_theme_css .='body{';
			$business_corporate_agency_tp_theme_css .='max-width: 100%; padding-right:0px; padding-left:0px';
		$business_corporate_agency_tp_theme_css .='} }';
$business_corporate_agency_tp_theme_css .='.page-template-front-page .menubar{';
	$business_corporate_agency_tp_theme_css .='width: 99%';
$business_corporate_agency_tp_theme_css .='}';		
$business_corporate_agency_tp_theme_css .='.scrolled{';
	$business_corporate_agency_tp_theme_css .='width: auto; left:0; right:0;';
$business_corporate_agency_tp_theme_css .='}';
}else if($business_corporate_agency_theme_lay == 'Full'){
$business_corporate_agency_tp_theme_css .='body{';
	$business_corporate_agency_tp_theme_css .='max-width: 100%;';
$business_corporate_agency_tp_theme_css .='}';
}

$business_corporate_agency_scroll_position = get_theme_mod( 'business_corporate_agency_scroll_top_position','Right');
if($business_corporate_agency_scroll_position == 'Right'){
$business_corporate_agency_tp_theme_css .='#return-to-top{';
    $business_corporate_agency_tp_theme_css .='right: 20px;';
$business_corporate_agency_tp_theme_css .='}';
}else if($business_corporate_agency_scroll_position == 'Left'){
$business_corporate_agency_tp_theme_css .='#return-to-top{';
    $business_corporate_agency_tp_theme_css .='left: 20px;';
$business_corporate_agency_tp_theme_css .='}';
}else if($business_corporate_agency_scroll_position == 'Center'){
$business_corporate_agency_tp_theme_css .='#return-to-top{';
    $business_corporate_agency_tp_theme_css .='right: 50%;left: 50%;';
$business_corporate_agency_tp_theme_css .='}';
}

    
//Social icon Font size
$business_corporate_agency_social_icon_fontsize = get_theme_mod('business_corporate_agency_social_icon_fontsize');
	$business_corporate_agency_tp_theme_css .='.media-links a i{';
$business_corporate_agency_tp_theme_css .='font-size: '.esc_attr($business_corporate_agency_social_icon_fontsize).'px;';
$business_corporate_agency_tp_theme_css .='}';

// site title font size option
$business_corporate_agency_site_title_font_size = get_theme_mod('business_corporate_agency_site_title_font_size', 30);{
$business_corporate_agency_tp_theme_css .='.logo h1 , .logo p a{';
	$business_corporate_agency_tp_theme_css .='font-size: '.esc_attr($business_corporate_agency_site_title_font_size).'px;';
$business_corporate_agency_tp_theme_css .='}';
}

//site tagline font size option
$business_corporate_agency_site_tagline_font_size = get_theme_mod('business_corporate_agency_site_tagline_font_size', 15);{
$business_corporate_agency_tp_theme_css .='.logo p{';
	$business_corporate_agency_tp_theme_css .='font-size: '.esc_attr($business_corporate_agency_site_tagline_font_size).'px;';
$business_corporate_agency_tp_theme_css .='}';
}

// related post
$business_corporate_agency_related_post_mob = get_theme_mod('business_corporate_agency_related_post_mob', true);
$business_corporate_agency_related_post = get_theme_mod('business_corporate_agency_remove_related_post', true);
$business_corporate_agency_tp_theme_css .= '.related-post-block {';
if ($business_corporate_agency_related_post == false) {
    $business_corporate_agency_tp_theme_css .= 'display: none;';
}
$business_corporate_agency_tp_theme_css .= '}';
$business_corporate_agency_tp_theme_css .= '@media screen and (max-width: 575px) {';
if ($business_corporate_agency_related_post == false || $business_corporate_agency_related_post_mob == false) {
    $business_corporate_agency_tp_theme_css .= '.related-post-block { display: none; }';
}
$business_corporate_agency_tp_theme_css .= '}';

//return to header mobile				
$business_corporate_agency_return_to_header_mob = get_theme_mod('business_corporate_agency_return_to_header_mob', true);
$business_corporate_agency_return_to_header = get_theme_mod('business_corporate_agency_return_to_header', true);
$business_corporate_agency_tp_theme_css .= '.return-to-header{';
if ($business_corporate_agency_return_to_header == false) {
    $business_corporate_agency_tp_theme_css .= 'display: none;';
}
$business_corporate_agency_tp_theme_css .= '}';
$business_corporate_agency_tp_theme_css .= '@media screen and (max-width: 575px) {';
if ($business_corporate_agency_return_to_header == false || $business_corporate_agency_return_to_header_mob == false) {
    $business_corporate_agency_tp_theme_css .= '.return-to-header{ display: none; }';
}
$business_corporate_agency_tp_theme_css .= '}';

//blog description              
$business_corporate_agency_mobile_blog_description = get_theme_mod('business_corporate_agency_mobile_blog_description', true);
$business_corporate_agency_tp_theme_css .= '@media screen and (max-width: 575px) {';
if ($business_corporate_agency_mobile_blog_description == false) {
    $business_corporate_agency_tp_theme_css .= '.blog-description{ display: none; }';
}
$business_corporate_agency_tp_theme_css .= '}';

//footer image
$business_corporate_agency_footer_widget_image = get_theme_mod('business_corporate_agency_footer_widget_image');
if($business_corporate_agency_footer_widget_image != false){
$business_corporate_agency_tp_theme_css .='#footer{';
	$business_corporate_agency_tp_theme_css .='background: url('.esc_attr($business_corporate_agency_footer_widget_image).');';
$business_corporate_agency_tp_theme_css .='}';
}

// related product
$business_corporate_agency_related_product = get_theme_mod('business_corporate_agency_related_product',true);
if($business_corporate_agency_related_product == false){
$business_corporate_agency_tp_theme_css .='.related.products{';
	$business_corporate_agency_tp_theme_css .='display: none;';
$business_corporate_agency_tp_theme_css .='}';
}

//menu font size
$business_corporate_agency_menu_font_size = get_theme_mod('business_corporate_agency_menu_font_size', '');{
$business_corporate_agency_tp_theme_css .='.main-navigation a, .main-navigation li.page_item_has_children:after,.main-navigation li.menu-item-has-children:after{';
	$business_corporate_agency_tp_theme_css .='font-size: '.esc_attr($business_corporate_agency_menu_font_size).'px;';
$business_corporate_agency_tp_theme_css .='}';
}

// menu text tranform
$business_corporate_agency_menu_text_tranform = get_theme_mod( 'business_corporate_agency_menu_text_tranform','');
if($business_corporate_agency_menu_text_tranform == 'Uppercase'){
$business_corporate_agency_tp_theme_css .='.main-navigation a {';
	$business_corporate_agency_tp_theme_css .='text-transform: uppercase;';
$business_corporate_agency_tp_theme_css .='}';
}else if($business_corporate_agency_menu_text_tranform == 'Lowercase'){
$business_corporate_agency_tp_theme_css .='.main-navigation a {';
	$business_corporate_agency_tp_theme_css .='text-transform: lowercase;';
$business_corporate_agency_tp_theme_css .='}';
}
else if($business_corporate_agency_menu_text_tranform == 'Capitalize'){
$business_corporate_agency_tp_theme_css .='.main-navigation a {';
	$business_corporate_agency_tp_theme_css .='text-transform: capitalize;';
$business_corporate_agency_tp_theme_css .='}';
}

// header
$business_corporate_agency_slider_arrows = get_theme_mod('business_corporate_agency_slider_arrows',true);
if($business_corporate_agency_slider_arrows == false){
$business_corporate_agency_tp_theme_css .='.page-template-front-page .header-main{';
	$business_corporate_agency_tp_theme_css .='position:static;';
$business_corporate_agency_tp_theme_css .='}';
$business_corporate_agency_tp_theme_css .='.page-template-front-page .menu-box-col{';
	$business_corporate_agency_tp_theme_css .='background-color:#1c2539;margin-left: -2em !important;';
$business_corporate_agency_tp_theme_css .='}';
}

/*------------- Blog Page------------------*/
	$business_corporate_agency_post_image_round = get_theme_mod('business_corporate_agency_post_image_round', 0);
	if($business_corporate_agency_post_image_round != false){
		$business_corporate_agency_tp_theme_css .='.blog .box-image img{';
			$business_corporate_agency_tp_theme_css .='border-radius: '.esc_attr($business_corporate_agency_post_image_round).'px;';
		$business_corporate_agency_tp_theme_css .='}';
	}

	$business_corporate_agency_post_image_width = get_theme_mod('business_corporate_agency_post_image_width', '');
	if($business_corporate_agency_post_image_width != false){
		$business_corporate_agency_tp_theme_css .='.blog .box-image img{';
			$business_corporate_agency_tp_theme_css .='Width: '.esc_attr($business_corporate_agency_post_image_width).'px;';
		$business_corporate_agency_tp_theme_css .='}';
	}

	$business_corporate_agency_post_image_length = get_theme_mod('business_corporate_agency_post_image_length', '');
	if($business_corporate_agency_post_image_length != false){
		$business_corporate_agency_tp_theme_css .='.blog .box-image img{';
			$business_corporate_agency_tp_theme_css .='height: '.esc_attr($business_corporate_agency_post_image_length).'px;';
		$business_corporate_agency_tp_theme_css .='}';
	}

	// footer widget title font size
	$business_corporate_agency_footer_widget_title_font_size = get_theme_mod('business_corporate_agency_footer_widget_title_font_size', '');{
	$business_corporate_agency_tp_theme_css .='#footer h3, #footer h2.wp-block-heading{';
		$business_corporate_agency_tp_theme_css .='font-size: '.esc_attr($business_corporate_agency_footer_widget_title_font_size).'px;';
	$business_corporate_agency_tp_theme_css .='}';
	}

	// Copyright text font size
	$business_corporate_agency_footer_copyright_font_size = get_theme_mod('business_corporate_agency_footer_copyright_font_size', '');{
	$business_corporate_agency_tp_theme_css .='#footer .site-info p{';
		$business_corporate_agency_tp_theme_css .='font-size: '.esc_attr($business_corporate_agency_footer_copyright_font_size).'px;';
	$business_corporate_agency_tp_theme_css .='}';
	}

	// copyright padding
	$business_corporate_agency_footer_copyright_top_bottom_padding = get_theme_mod('business_corporate_agency_footer_copyright_top_bottom_padding', '');
	if ($business_corporate_agency_footer_copyright_top_bottom_padding !== '') { 
	    $business_corporate_agency_tp_theme_css .= '.site-info {';
	    $business_corporate_agency_tp_theme_css .= 'padding-top: ' . esc_attr($business_corporate_agency_footer_copyright_top_bottom_padding) . 'px;';
	    $business_corporate_agency_tp_theme_css .= 'padding-bottom: ' . esc_attr($business_corporate_agency_footer_copyright_top_bottom_padding) . 'px;';
	    $business_corporate_agency_tp_theme_css .= '}';
	}

	// copyright position
	$business_corporate_agency_copyright_text_position = get_theme_mod( 'business_corporate_agency_copyright_text_position','Center');
	if($business_corporate_agency_copyright_text_position == 'Center'){
	$business_corporate_agency_tp_theme_css .='#footer .site-info p{';
	$business_corporate_agency_tp_theme_css .='text-align:center;';
	$business_corporate_agency_tp_theme_css .='}';
	}else if($business_corporate_agency_copyright_text_position == 'Left'){
	$business_corporate_agency_tp_theme_css .='#footer .site-info p{';
	$business_corporate_agency_tp_theme_css .='text-align:left;';
	$business_corporate_agency_tp_theme_css .='}';
	}else if($business_corporate_agency_copyright_text_position == 'Right'){
	$business_corporate_agency_tp_theme_css .='#footer .site-info p{';
	$business_corporate_agency_tp_theme_css .='text-align:right;';
	$business_corporate_agency_tp_theme_css .='}';
}

// Header Image title font size
$business_corporate_agency_header_image_title_font_size = get_theme_mod('business_corporate_agency_header_image_title_font_size', '32');{
$business_corporate_agency_tp_theme_css .='.box-text h2{';
    $business_corporate_agency_tp_theme_css .='font-size: '.esc_attr($business_corporate_agency_header_image_title_font_size).'px;';
$business_corporate_agency_tp_theme_css .='}';
}

/*--------------------------- banner image Opacity -------------------*/
    $business_corporate_agency_theme_lay = get_theme_mod( 'business_corporate_agency_header_banner_opacity_color','0.5');
        if($business_corporate_agency_theme_lay == '0'){
            $business_corporate_agency_tp_theme_css .='.single-page-img, .featured-image{';
                $business_corporate_agency_tp_theme_css .='opacity:0';
            $business_corporate_agency_tp_theme_css .='}';
        }else if($business_corporate_agency_theme_lay == '0.1'){
            $business_corporate_agency_tp_theme_css .='.single-page-img, .featured-image{';
                $business_corporate_agency_tp_theme_css .='opacity:0.1';
            $business_corporate_agency_tp_theme_css .='}';
        }else if($business_corporate_agency_theme_lay == '0.2'){
            $business_corporate_agency_tp_theme_css .='.single-page-img, .featured-image{';
                $business_corporate_agency_tp_theme_css .='opacity:0.2';
            $business_corporate_agency_tp_theme_css .='}';
        }else if($business_corporate_agency_theme_lay == '0.3'){
            $business_corporate_agency_tp_theme_css .='.single-page-img, .featured-image{';
                $business_corporate_agency_tp_theme_css .='opacity:0.3';
            $business_corporate_agency_tp_theme_css .='}';
        }else if($business_corporate_agency_theme_lay == '0.4'){
            $business_corporate_agency_tp_theme_css .='.single-page-img, .featured-image{';
                $business_corporate_agency_tp_theme_css .='opacity:0.4';
            $business_corporate_agency_tp_theme_css .='}';
        }else if($business_corporate_agency_theme_lay == '0.5'){
            $business_corporate_agency_tp_theme_css .='.single-page-img, .featured-image{';
                $business_corporate_agency_tp_theme_css .='opacity:0.5';
            $business_corporate_agency_tp_theme_css .='}';
        }else if($business_corporate_agency_theme_lay == '0.6'){
            $business_corporate_agency_tp_theme_css .='.single-page-img, .featured-image{';
                $business_corporate_agency_tp_theme_css .='opacity:0.6';
            $business_corporate_agency_tp_theme_css .='}';
        }else if($business_corporate_agency_theme_lay == '0.7'){
            $business_corporate_agency_tp_theme_css .='.single-page-img, .featured-image{';
                $business_corporate_agency_tp_theme_css .='opacity:0.7';
            $business_corporate_agency_tp_theme_css .='}';
        }else if($business_corporate_agency_theme_lay == '0.8'){
            $business_corporate_agency_tp_theme_css .='.single-page-img, .featured-image{';
                $business_corporate_agency_tp_theme_css .='opacity:0.8';
            $business_corporate_agency_tp_theme_css .='}';
        }else if($business_corporate_agency_theme_lay == '0.9'){
            $business_corporate_agency_tp_theme_css .='.single-page-img, .featured-image{';
                $business_corporate_agency_tp_theme_css .='opacity:0.9';
            $business_corporate_agency_tp_theme_css .='}';
        }else if($business_corporate_agency_theme_lay == '1'){
            $business_corporate_agency_tp_theme_css .='#slider img{';
                $business_corporate_agency_tp_theme_css .='opacity:1';
            $business_corporate_agency_tp_theme_css .='}';
        }

    $business_corporate_agency_header_banner_image_overlay = get_theme_mod('business_corporate_agency_header_banner_image_overlay', true);
    if($business_corporate_agency_header_banner_image_overlay == false){
        $business_corporate_agency_tp_theme_css .='.single-page-img, .featured-image{';
            $business_corporate_agency_tp_theme_css .='opacity:1;';
        $business_corporate_agency_tp_theme_css .='}';
    }

    $business_corporate_agency_header_banner_image_ooverlay_color = get_theme_mod('business_corporate_agency_header_banner_image_ooverlay_color', true);
    if($business_corporate_agency_header_banner_image_ooverlay_color != false){
        $business_corporate_agency_tp_theme_css .='.box-image-page{';
            $business_corporate_agency_tp_theme_css .='background-color: '.esc_attr($business_corporate_agency_header_banner_image_ooverlay_color).';';
        $business_corporate_agency_tp_theme_css .='}';
    }