<?php

$kindergarten_toys_custom_css = "";

	$kindergarten_toys_theme_pagination_options_alignment = get_theme_mod('kindergarten_toys_theme_pagination_options_alignment', 'Center');
	if ($kindergarten_toys_theme_pagination_options_alignment == 'Center') {
		$kindergarten_toys_custom_css .= '.navigation.pagination,.navigation.posts-navigation .nav-links{';
		$kindergarten_toys_custom_css .= 'justify-content: center;margin: 0 auto;';
		$kindergarten_toys_custom_css .= '}';
	} else if ($kindergarten_toys_theme_pagination_options_alignment == 'Right') {
		$kindergarten_toys_custom_css .= '.navigation.pagination,.navigation.posts-navigation .nav-links{';
		$kindergarten_toys_custom_css .= 'justify-content: right;margin: 0 0 0 auto;';
		$kindergarten_toys_custom_css .= '}';
	} else if ($kindergarten_toys_theme_pagination_options_alignment == 'Left') {
		$kindergarten_toys_custom_css .= '.navigation.pagination,.navigation.posts-navigation .nav-links{';
		$kindergarten_toys_custom_css .= 'justify-content: left;margin: 0 auto 0 0;';
		$kindergarten_toys_custom_css .= '}';
	}

	$kindergarten_toys_theme_breadcrumb_enable = get_theme_mod('kindergarten_toys_theme_breadcrumb_enable',true);
	if($kindergarten_toys_theme_breadcrumb_enable != true){
		$kindergarten_toys_custom_css .='nav.breadcrumb-trail.breadcrumbs,nav.woocommerce-breadcrumb{';
			$kindergarten_toys_custom_css .='display: none;';
		$kindergarten_toys_custom_css .='}';
	}

	$kindergarten_toys_theme_breadcrumb_options_alignment = get_theme_mod('kindergarten_toys_theme_breadcrumb_options_alignment', 'Left');
	if ($kindergarten_toys_theme_breadcrumb_options_alignment == 'Center') {
		$kindergarten_toys_custom_css .= '.breadcrumbs ul,nav.woocommerce-breadcrumb{';
		$kindergarten_toys_custom_css .= 'text-align: center !important;';
		$kindergarten_toys_custom_css .= '}';
	} else if ($kindergarten_toys_theme_breadcrumb_options_alignment == 'Right') {
		$kindergarten_toys_custom_css .= '.breadcrumbs ul,nav.woocommerce-breadcrumb{';
		$kindergarten_toys_custom_css .= 'text-align: Right !important;';
		$kindergarten_toys_custom_css .= '}';
	} else if ($kindergarten_toys_theme_breadcrumb_options_alignment == 'Left') {
		$kindergarten_toys_custom_css .= '.breadcrumbs ul,nav.woocommerce-breadcrumb{';
		$kindergarten_toys_custom_css .= 'text-align: Left !important;';
		$kindergarten_toys_custom_css .= '}';
	}

	$kindergarten_toys_single_page_content_alignment = get_theme_mod('kindergarten_toys_single_page_content_alignment', 'left');
	if ($kindergarten_toys_single_page_content_alignment == 'left') {
		$kindergarten_toys_custom_css .= '#single-page .type-page,section.theme-custom-block.theme-error-sectiontheme-error-section.error-block-middle,section.theme-custom-block.theme-error-section.error-block-heading .theme-area-header{';
		$kindergarten_toys_custom_css .= 'text-align: left !important;';
		$kindergarten_toys_custom_css .= '}';
	} else if ($kindergarten_toys_single_page_content_alignment == 'center') {
		$kindergarten_toys_custom_css .= '#single-page .type-page,section.theme-custom-block.theme-error-sectiontheme-error-section.error-block-middle,section.theme-custom-block.theme-error-section.error-block-heading .theme-area-header{';
		$kindergarten_toys_custom_css .= 'text-align: center !important;';
		$kindergarten_toys_custom_css .= '}';
	} else if ($kindergarten_toys_single_page_content_alignment == 'right') {
		$kindergarten_toys_custom_css .= '#single-page .type-page,section.theme-custom-block.theme-error-sectiontheme-error-section.error-block-middle,section.theme-custom-block.theme-error-section.error-block-heading .theme-area-header{';
		$kindergarten_toys_custom_css .= 'text-align: right !important;';
		$kindergarten_toys_custom_css .= '}';
	}

	$kindergarten_toys_single_post_content_alignment = get_theme_mod('kindergarten_toys_single_post_content_alignment', 'left');
	if ($kindergarten_toys_single_post_content_alignment == 'left') {
		$kindergarten_toys_custom_css .= '#single-page .type-post,#single-page .type-post .entry-meta,#single-page .type-post .is-layout-flex{';
		$kindergarten_toys_custom_css .= 'text-align: left !important;justify-content: left;';
		$kindergarten_toys_custom_css .= '}';
	} else if ($kindergarten_toys_single_post_content_alignment == 'center') {
		$kindergarten_toys_custom_css .= '#single-page .type-post,#single-page .type-post .entry-meta,#single-page .type-post .is-layout-flex{';
		$kindergarten_toys_custom_css .= 'text-align: center !important;justify-content: center;';
		$kindergarten_toys_custom_css .= '}';
	} else if ($kindergarten_toys_single_post_content_alignment == 'right') {
		$kindergarten_toys_custom_css .= '#single-page .type-post,#single-page .type-post .entry-meta,#single-page .type-post .is-layout-flex{';
		$kindergarten_toys_custom_css .= 'text-align: right !important;justify-content: right;';
		$kindergarten_toys_custom_css .= '}';
	}

	$kindergarten_toys_menu_text_transform = get_theme_mod('kindergarten_toys_menu_text_transform', 'Capitalize');
	if ($kindergarten_toys_menu_text_transform == 'Capitalize') {
		$kindergarten_toys_custom_css .= '.site-navigation .primary-menu > li a{';
		$kindergarten_toys_custom_css .= 'text-transform: Capitalize !important;';
		$kindergarten_toys_custom_css .= '}';
	} else if ($kindergarten_toys_menu_text_transform == 'uppercase') {
		$kindergarten_toys_custom_css .= '.site-navigation .primary-menu > li a{';
		$kindergarten_toys_custom_css .= 'text-transform: uppercase !important;';
		$kindergarten_toys_custom_css .= '}';
	} else if ($kindergarten_toys_menu_text_transform == 'lowercase') {
		$kindergarten_toys_custom_css .= '.site-navigation .primary-menu > li a{';
		$kindergarten_toys_custom_css .= 'text-transform: lowercase !important;';
		$kindergarten_toys_custom_css .= '}';
	}

	$kindergarten_toys_footer_widget_title_alignment = get_theme_mod('kindergarten_toys_footer_widget_title_alignment', 'left');
	if ($kindergarten_toys_footer_widget_title_alignment == 'left') {
		$kindergarten_toys_custom_css .= 'h2.widget-title{';
		$kindergarten_toys_custom_css .= 'text-align: left !important;';
		$kindergarten_toys_custom_css .= '}';
	} else if ($kindergarten_toys_footer_widget_title_alignment == 'center') {
		$kindergarten_toys_custom_css .= 'h2.widget-title{';
		$kindergarten_toys_custom_css .= 'text-align: center !important;';
		$kindergarten_toys_custom_css .= '}';
	} else if ($kindergarten_toys_footer_widget_title_alignment == 'right') {
		$kindergarten_toys_custom_css .= 'h2.widget-title{';
		$kindergarten_toys_custom_css .= 'text-align: right !important;';
		$kindergarten_toys_custom_css .= '}';
	}

	$kindergarten_toys_show_hide_related_product = get_theme_mod('kindergarten_toys_show_hide_related_product',true);
	if($kindergarten_toys_show_hide_related_product != true){
		$kindergarten_toys_custom_css .='.related.products{';
			$kindergarten_toys_custom_css .='display: none;';
		$kindergarten_toys_custom_css .='}';
	}

	/*-------------------- Global First Color -------------------*/

	$kindergarten_toys_global_color = get_theme_mod('kindergarten_toys_global_color', '#FE9403'); // Add a fallback if the color isn't set

	if ($kindergarten_toys_global_color) {
		$kindergarten_toys_custom_css .= ':root {';
		$kindergarten_toys_custom_css .= '--global-color: ' . esc_attr($kindergarten_toys_global_color) . ';';
		$kindergarten_toys_custom_css .= '}';
	}

	/*-------------------- Content Color -------------------*/

	$kindergarten_toys_content_typography_font = get_theme_mod('kindergarten_toys_content_typography_font', 'Poppins'); // Add a fallback if the color isn't set

	if ($kindergarten_toys_content_typography_font) {
		$kindergarten_toys_custom_css .= ':root {';
		$kindergarten_toys_custom_css .= '--font-main: ' . esc_attr($kindergarten_toys_content_typography_font) . ';';
		$kindergarten_toys_custom_css .= '}';
	}

	/*-------------------- Heading Color -------------------*/

	$kindergarten_toys_heading_typography_font = get_theme_mod('kindergarten_toys_heading_typography_font', 'Poppins'); // Add a fallback if the color isn't set

	if ($kindergarten_toys_heading_typography_font) {
		$kindergarten_toys_custom_css .= ':root {';
		$kindergarten_toys_custom_css .= '--font-head: ' . esc_attr($kindergarten_toys_heading_typography_font) . ';';
		$kindergarten_toys_custom_css .= '}';
	}
				
	$kindergarten_toys_columns = get_theme_mod('kindergarten_toys_posts_per_columns', 3);
	$kindergarten_toys_columns = absint($kindergarten_toys_columns);
	if ( $kindergarten_toys_columns < 1 || $kindergarten_toys_columns > 6 ) {
		$kindergarten_toys_columns = 3;
	}
	$kindergarten_toys_custom_css .= "
		.site-content .article-wraper-archive {
			grid-template-columns: repeat({$kindergarten_toys_columns}, 1fr);
		}
	";

	// FOOTER

	$kindergarten_toys_footer_widget_background_color = get_theme_mod('kindergarten_toys_footer_widget_background_color');
	if ($kindergarten_toys_footer_widget_background_color) {

		$kindergarten_toys_custom_css .= "
			.footer-widgetarea {
				background-color: ". esc_attr($kindergarten_toys_footer_widget_background_color) .";
			}
		";
	}

	$kindergarten_toys_footer_widget_background_image = get_theme_mod('kindergarten_toys_footer_widget_background_image');
	if ($kindergarten_toys_footer_widget_background_image) {
		$kindergarten_toys_custom_css .= "
			.footer-widgetarea {
				background-image: url(" . esc_url($kindergarten_toys_footer_widget_background_image) . ");
			}
		";
	}

	$kindergarten_toys_copyright_font_size = get_theme_mod('kindergarten_toys_copyright_font_size');
	if ($kindergarten_toys_copyright_font_size) {

		$kindergarten_toys_custom_css .= "
			.footer-copyright {
				font-size: ". esc_attr($kindergarten_toys_copyright_font_size) ."px;
			}
		";
	}

	$kindergarten_toys_copyright_alignment = get_theme_mod( 'kindergarten_toys_copyright_alignment', 'Default' );
	if ( $kindergarten_toys_copyright_alignment === 'Reverse' ) {
		$kindergarten_toys_custom_css .= '.site-info .column-row { flex-direction: row-reverse; }';
		$kindergarten_toys_custom_css .= '.footer-credits { justify-content: flex-end; }';
		$kindergarten_toys_custom_css .= '.footer-copyright { text-align: right; }';
		$kindergarten_toys_custom_css .= '.site-info .column.column-3 { text-align: left; }';
	} elseif ( $kindergarten_toys_copyright_alignment === 'Center' ) {
		$kindergarten_toys_custom_css .= '.site-info .column-row { flex-direction: column; align-items: center; gap: 15px; }';
		$kindergarten_toys_custom_css .= '.footer-credits { justify-content: center; }';
		$kindergarten_toys_custom_css .= '.footer-copyright { text-align: center; }';
		$kindergarten_toys_custom_css .= '.site-info .column.column-3 { text-align: center; }';
	}