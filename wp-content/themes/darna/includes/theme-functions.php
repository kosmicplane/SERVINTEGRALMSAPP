<?php
// GET CUSTOM CSS VARIABLE
//--------------------------------------------------
if (!function_exists('g5plus_custom_css_variable')) {
	function g5plus_custom_css_variable($page_id = '') {
		$prefix = 'g5plus_';
		$top_bar_bg_color = '#333';
		$opt_top_bar_bg_color = g5plus_get_option('top_bar_bg_color',array(
			'color' => '#F8F8F8',
			'alpha' => '1'
		));

		if (isset($opt_top_bar_bg_color['rgba'])) {
			$top_bar_bg_color = $opt_top_bar_bg_color['rgba'];
		}
		elseif (isset($opt_top_bar_bg_color['color'])) {
			$top_bar_bg_color = $opt_top_bar_bg_color['color'];
		}

		$top_bar_text_color = '#c5c5c5';
		$opt_top_bar_text_color = g5plus_get_option('top_bar_text_color','#222');
		if (! empty($opt_top_bar_text_color)) {
			$top_bar_text_color = $opt_top_bar_text_color;
		}

		$top_drawer_bg_color = '#2f2f2f';
		$opt_top_drawer_bg_color = g5plus_get_option('top_drawer_bg_color','#2f2f2f');
		if (!empty($opt_top_drawer_bg_color)) {
			$top_drawer_bg_color = $opt_top_drawer_bg_color;
		}

		$top_drawer_text_color = '#c5c5c5';
		$opt_top_drawer_text_color = g5plus_get_option('top_drawer_text_color','#c5c5c5');
		if (! empty($opt_top_drawer_text_color)) {
			$top_drawer_text_color = $opt_top_drawer_text_color;
		}


		$primary_color = '#e8aa00';
		$opt_primary_color = g5plus_get_option('primary_color','#ffb600');
		if (! empty($opt_primary_color)) {
			$primary_color = $opt_primary_color;
		}

		$secondary_color = '#fff';
		$opt_secondary_color = g5plus_get_option('secondary_color','#222222');
		if (! empty($opt_secondary_color)) {
			$secondary_color = $opt_secondary_color;
		}

		$text_color = '#888';
		$opt_text_color = g5plus_get_option('text_color','#8f8f8f');
		if ( ! empty($opt_text_color)) {
			$text_color = $opt_text_color;
		}

		$bold_color = '#222222';
		$opt_bold_color = g5plus_get_option('bold_color','#222');
		if (! empty($opt_bold_color)) {
			$bold_color = $opt_bold_color;
		}

        $heading_color = '#222222';
		$opt_heading_color = g5plus_get_option('heading_color','#222222');
        if (! empty($opt_heading_color)) {
            $heading_color = $opt_heading_color;
        }

		$footer_bg_color = '#2F2F2F';
        $opt_footer_bg_color = g5plus_get_option('footer_bg_color','#2F2F2F');
		if (! empty($opt_footer_bg_color)) {
			$footer_bg_color = $opt_footer_bg_color;
		}

		$footer_text_color = '#afafaf';
		$opt_footer_text_color = g5plus_get_option('footer_text_color','#8f8f8f');
		if (! empty($opt_footer_text_color)) {
			$footer_text_color = $opt_footer_text_color;
		}

		$footer_heading_text_color = '#fff';
		$opt_footer_heading_text_color = g5plus_get_option('footer_heading_text_color','#FFFFFF');
		if (! empty($opt_footer_heading_text_color)) {
			$footer_heading_text_color = $opt_footer_heading_text_color;
		}

		$bottom_bar_bg_color = '#292929';
		$opt_bottom_bar_bg_color = g5plus_get_option('bottom_bar_bg_color','#191919');
		if (! empty($opt_bottom_bar_bg_color)) {
			$bottom_bar_bg_color = $opt_bottom_bar_bg_color;
		}

		$bottom_bar_text_color = '#828282';
		$opt_bottom_bar_text_color = g5plus_get_option('bottom_bar_text_color','#828282');
		if (! empty($opt_bottom_bar_text_color)) {
			$bottom_bar_text_color = $opt_bottom_bar_text_color;
		}

		$link_color = '#e8aa00';
		$opt_link_color = g5plus_get_option('link_color', array(
			'regular'  => '#ffb600', // blue
			'hover'    => '#ffb600', // red
			'active'   => '#ffb600',  // purple
		));
		if (isset($opt_link_color['regular']) && !empty($opt_link_color['regular'])) {
			$link_color = $opt_link_color['regular'];
		}

		$link_color_hover = '#e8aa00';
		if (isset($opt_link_color['hover']) && !empty($opt_link_color['hover'])) {
			$link_color_hover =  $opt_link_color['hover'];
		}

		$link_color_active = '#e8aa00';
		if (isset($opt_link_color['active']) && !empty($opt_link_color['active'])) {
			$link_color_active = $opt_link_color['active'];
		}

		$menu_font = 'Arial';
		$opt_menu_font = g5plus_get_option('menu_font',array(
			'font-family'=>'Roboto',
		));
		if (isset($opt_menu_font['font-family']) && !empty($opt_menu_font['font-family'])) {
			$menu_font = $opt_menu_font['font-family'];
		}

        $primary_font = 'Arial';
		$opt_primary_font = g5plus_get_option('primary_font',array(
			'font-family'=>'Lato',
		));
		if (isset($opt_primary_font['font-family']) && !empty($opt_primary_font['font-family'])) {
            $primary_font = $opt_primary_font['font-family'];
        }

		$secondary_font = 'Arial';
		$opt_secondary_font = g5plus_get_option('secondary_font',array(
			'font-family'=>'Oswald',
		));
		if (isset($opt_secondary_font['font-family']) && !empty($opt_secondary_font['font-family'])) {
			$secondary_font = $opt_secondary_font['font-family'];
		}



		// Page Title
		//-------------------
		$page_title_text_color = '#fff';
		$opt_page_title_text_color = g5plus_get_option('page_title_text_color','#FFFFFF');
		if (! empty($opt_page_title_text_color)) {
			$page_title_text_color = $opt_page_title_text_color;
		}

		$page_title_bg_color = '#fff';
		$opt_page_title_bg_color = g5plus_get_option('page_title_bg_color','#2a2a2a');
		if (! empty($opt_page_title_bg_color)) {
			$page_title_bg_color = $opt_page_title_bg_color;
		}

		$page_title_overlay_color = '#000';
		$opt_page_title_overlay_color = g5plus_get_option('page_title_overlay_color','#000');
		if (! empty($opt_page_title_overlay_color)) {
			$page_title_overlay_color = $opt_page_title_overlay_color;
		}

		$page_title_overlay_opacity = '0.5';
		$opt_page_title_overlay_opacity = g5plus_get_option('page_title_overlay_opacity','40');
		if (! empty($opt_page_title_overlay_opacity)) {
			$page_title_overlay_opacity = $opt_page_title_overlay_opacity/100;
		}

		$g5plus_header_layout = '';
		if (!empty($page_id)) {
			$g5plus_header_layout = g5plus_get_meta($prefix . 'header_layout', array(), $page_id);
		}
		if (($g5plus_header_layout === '') || ($g5plus_header_layout == '-1')) {
			$g5plus_header_layout = g5plus_get_option('header_layout','header-3');
		}

		$logo_max_height = '80px';
		$logo_padding = '10px';
		$main_menu_height = '100px';

		$logo_matrix = array(
			'header-1' => array(80, 10),
			'header-2' => array(80, 10),
			'header-3' => array(80, 10, 60),
			'header-4' => array(60, 10),
			'header-5' => array(112, 10, 46),
		);

		if (isset($logo_matrix[$g5plus_header_layout])) {
			$logo_max_height = $logo_matrix[$g5plus_header_layout][0] . 'px';
			$logo_padding = $logo_matrix[$g5plus_header_layout][1] . 'px';
			if (isset($logo_matrix[$g5plus_header_layout][2])) {
				$main_menu_height = $logo_matrix[$g5plus_header_layout][2] . 'px';
			}
			else {
				$main_menu_height = ($logo_matrix[$g5plus_header_layout][0] + $logo_matrix[$g5plus_header_layout][1] * 2) . 'px';
			}
		}

		$opt_logo_max_height = g5plus_get_option('logo_max_height',array(
			'height'  => ''
		));
		if (isset($opt_logo_max_height['height']) &&  ! empty($opt_logo_max_height['height']) && ($opt_logo_max_height['height'] !== 'px')) {
			$logo_max_height = $opt_logo_max_height['height'];
		}

		$opt_logo_padding = g5plus_get_option('logo_padding');
		if (! empty($opt_logo_padding)) {
			$logo_padding = $opt_logo_padding . 'px';
		}

		if (!isset($logo_matrix[$g5plus_header_layout][2])) {
			$main_menu_height = ((str_replace('px', '', $logo_max_height))  + (str_replace('px', '', $logo_padding) * 2)) . 'px';
		}

		$menu_text_color = '#191919';
		$opt_menu_text_color = g5plus_get_option('menu_text_color','#222');
		if (! empty($opt_menu_text_color)) {
			$menu_text_color = $opt_menu_text_color;
		}

		$menu_sub_bg_color = '#F8F8F8';
		$opt_menu_sub_bg_color = g5plus_get_option('menu_sub_bg_color','#F8F8F8');
		if (! empty($opt_menu_sub_bg_color)) {
			$menu_sub_bg_color = $opt_menu_sub_bg_color;
		}

		$menu_sub_text_color = '#222';
		$opt_menu_sub_text_color = g5plus_get_option('menu_sub_text_color','#222');
		if (! empty($opt_menu_sub_text_color)) {
			$menu_sub_text_color = $opt_menu_sub_text_color;
		}

		$logo_mobile_max_height = '42px';
		$logo_mobile_padding = '15px';
		$main_menu_mobile_height = '72px';

		$logo_mobile_matrix = array(
			'header-mobile-1' => array(42, 15),
			'header-mobile-2' => array(72, 25, 52),
			'header-mobile-3' => array(42, 15),
			'header-mobile-4' => array(42, 15),
		);


		// GET logo_max_height, logo_padding
		$mobile_header_layout = g5plus_get_option('mobile_header_layout','header-mobile-2');

		if (isset($logo_mobile_matrix[$mobile_header_layout])) {
			$logo_mobile_max_height = $logo_mobile_matrix[$mobile_header_layout][0] . 'px';
			$logo_mobile_padding = $logo_mobile_matrix[$mobile_header_layout][1] . 'px';
			if (isset($logo_mobile_matrix[$mobile_header_layout][2])) {
				$main_menu_mobile_height = $logo_mobile_matrix[$mobile_header_layout][2] . 'px';
			}
			else {
				$main_menu_mobile_height = ($logo_mobile_matrix[$mobile_header_layout][0] + $logo_mobile_matrix[$mobile_header_layout][1] * 2) . 'px';
			}
		}
		$opt_logo_mobile_max_height = g5plus_get_option('logo_mobile_max_height',array(
			'height'  => ''
		));
		if ( isset($opt_logo_mobile_max_height['height']) && ! empty($opt_logo_mobile_max_height['height']) && ($opt_logo_mobile_max_height['height'] !== 'px')) {
			$logo_mobile_max_height = $opt_logo_mobile_max_height['height'] . 'px';
		}

		$opt_logo_mobile_padding = g5plus_get_option('logo_mobile_padding',array(
			'height'  => ''
		));
		if (isset($opt_logo_mobile_padding['height']) && ! empty($opt_logo_mobile_padding['height']) && ($opt_logo_mobile_padding['height'] !== 'px')) {
			$logo_mobile_padding = $opt_logo_mobile_padding['height'] . 'px';
		}

		$opt_body_font = g5plus_get_option('body_font',array(
			'font-size'=>'14px',
			'font-family'=>'Lato',
			'font-weight'=>'400',
		));
		$body_font = g5plus_get_option('body_font',array(
			'font-size'=>'14px',
			'font-family'=>'Lato',
			'font-weight'=>'400',
		));
		$body_font_size = $body_font['font-size'];
		$body_font_family = $body_font['font-family'];
		$body_font_weight = $body_font['font-weight'];

		ob_start();

		echo "@top_drawer_bg_color:		$top_drawer_bg_color;", PHP_EOL;
		echo "@top_drawer_text_color:	$top_drawer_text_color;", PHP_EOL;
		echo "@top_bar_bg_color:		$top_bar_bg_color;", PHP_EOL;
		echo "@top_bar_text_color:		$top_bar_text_color;", PHP_EOL;
		echo "@primary_color:			$primary_color;", PHP_EOL;
		echo "@secondary_color:			$secondary_color;", PHP_EOL;
		echo "@text_color:				$text_color;", PHP_EOL;
        echo "@heading_color:			$heading_color;", PHP_EOL;
        echo "@bold_color:				$bold_color;", PHP_EOL;
		echo "@footer_bg_color:			$footer_bg_color;", PHP_EOL;
		echo "@footer_text_color:		$footer_text_color;", PHP_EOL;
		echo "@footer_heading_text_color:$footer_heading_text_color;", PHP_EOL;
		echo "@bottom_bar_bg_color:		$bottom_bar_bg_color;", PHP_EOL;
		echo "@bottom_bar_text_color:	$bottom_bar_text_color;", PHP_EOL;
		echo "@link_color:				$link_color;", PHP_EOL;
		echo "@link_color_hover:		$link_color_hover;", PHP_EOL;
		echo "@link_color_active:		$link_color_active;", PHP_EOL;
		echo "@menu_font:				'$menu_font';", PHP_EOL;
		echo "@secondary_font:				'$secondary_font';", PHP_EOL;
        echo "@primary_font:				'$primary_font';", PHP_EOL;

		echo "@page_title_text_color:	$page_title_text_color;", PHP_EOL;
		echo "@page_title_bg_color:		$page_title_bg_color;", PHP_EOL;
		echo "@page_title_overlay_color:	$page_title_overlay_color;", PHP_EOL;
		echo "@page_title_overlay_opacity:	$page_title_overlay_opacity;", PHP_EOL;

		echo "@logo_max_height:	$logo_max_height;", PHP_EOL;
		echo "@logo_padding:	$logo_padding;", PHP_EOL;
		echo "@main_menu_height:	$main_menu_height;", PHP_EOL;

		echo "@logo_mobile_max_height:	$logo_mobile_max_height;", PHP_EOL;
		echo "@logo_mobile_padding:	$logo_mobile_padding;", PHP_EOL;
		echo "@main_menu_mobile_height:	$main_menu_mobile_height;", PHP_EOL;

		echo "@menu_text_color:	$menu_text_color;", PHP_EOL;
		echo "@menu_sub_bg_color:	$menu_sub_bg_color;", PHP_EOL;
		echo "@menu_sub_text_color:	$menu_sub_text_color;", PHP_EOL;

        echo "@body_font_family:	'$body_font_family';", PHP_EOL;
        echo "@body_font_size:	$body_font_size;", PHP_EOL;
        echo "@body_font_weight:	$body_font_weight;", PHP_EOL;

		echo '@theme_url:"'. THEME_URL . '";', PHP_EOL;


		return ob_get_clean();
	}
}

// GET CUSTOM CSS
//--------------------------------------------------
if (!function_exists('g5plus_custom_css')) {
	function g5plus_custom_css() {
        $custom_css = '';
        $background_image_css = '';

        $layout_style = g5plus_get_option('layout_style','wide');
        if ($layout_style == 'boxed') {
            $body_background_mode = g5plus_get_option('body_background_mode','background');
            if ($body_background_mode == 'background') {
            	$opt_body_background = g5plus_get_option('body_background',array(
		            'background-color' => '',
		            'background-repeat' => 'no-repeat',
		            'background-position' => 'center center',
		            'background-attachment' => 'fixed',
		            'background-size' => 'cover'
	            ));

                $background_image_url = isset($opt_body_background['background-image']) ? $opt_body_background['background-image'] : '';
                $background_color = isset($opt_body_background['background-color']) ? $opt_body_background['background-color'] : '';

                if (!empty($background_color)) {
                    $background_image_css .= 'background-color:' . $background_color . ';';
                }

                if (!empty($background_image_url)) {
                    $background_repeat = isset($opt_body_background['background-repeat']) ? $opt_body_background['background-repeat'] : '';
                    $background_position = isset($opt_body_background['background-position']) ? $opt_body_background['background-position'] : '';
                    $background_size = isset($opt_body_background['background-size']) ? $opt_body_background['background-size'] : '';
                    $background_attachment = isset($opt_body_background['background-attachment']) ? $opt_body_background['background-attachment'] : '';

                    $background_image_css .= 'background-image: url("'. $background_image_url .'");';


                    if (!empty($background_repeat)) {
                        $background_image_css .= 'background-repeat: '. $background_repeat .';';
                    }

                    if (!empty($background_position)) {
                        $background_image_css .= 'background-position: '. $background_position .';';
                    }

                    if (!empty($background_size)) {
                        $background_image_css .= 'background-size: '. $background_size .';';
                    }

                    if (!empty($background_attachment)) {
                        $background_image_css .= 'background-attachment: '. $background_attachment .';';
                    }
                }

            }

            if ($body_background_mode == 'pattern') {
            	$opt_body_background_pattern = g5plus_get_option('body_background_pattern','pattern-1.png');
                $background_image_url = THEME_URL . 'assets/images/theme-options/' . $opt_body_background_pattern;
                $background_image_css .= 'background-image: url("'. $background_image_url .'");';
                $background_image_css .= 'background-repeat: repeat;';
                $background_image_css .= 'background-position: center center;';
                $background_image_css .= 'background-size: auto;';
                $background_image_css .= 'background-attachment: scroll;';
            }
        }

        if (!empty($background_image_css)) {
            $custom_css.= 'body.boxed{'.$background_image_css.'}';
        }



		$custom_css .=  g5plus_get_option('custom_css');

        $custom_scroll = g5plus_get_option('custom_scroll','0');
        if ($custom_scroll == 1) {
            $custom_scroll_width = g5plus_get_option('custom_scroll_width','10');
            $custom_scroll_color = g5plus_get_option('custom_scroll_color','#333333');
            $custom_scroll_thumb_color = g5plus_get_option('custom_scroll_thumb_color','#e8aa00');

            $custom_css .= 'body::-webkit-scrollbar {width: '.$custom_scroll_width.'px;background-color: '.$custom_scroll_color .';}';
            $custom_css .= 'body::-webkit-scrollbar-thumb{background-color: '.$custom_scroll_thumb_color .';}';
        }

        $opt_footer_bg_image = g5plus_get_option('footer_bg_image',array(
	        'url' => THEME_URL . 'assets/images/theme-options/bg-footer.jpg'
        ));
		$footer_bg_image =  isset($opt_footer_bg_image['url']) ? $opt_footer_bg_image['url'] : '';

		if (!empty($footer_bg_image)) {
			$footer_bg_css = 'background-image:url(' . $footer_bg_image . ');';
			$footer_bg_css .= '-webkit-background-size: cover;';
			$footer_bg_css .= '-moz-background-size: cover;';
			$footer_bg_css .= '-o-background-size: cover;';
			$footer_bg_css .= 'background-size: cover;';
			$footer_bg_css .= 'background-attachment: fixed;';
			$custom_css .= 'footer.main-footer-wrapper {' . $footer_bg_css . '}';
		}


        $custom_css = str_replace( "\r\n", '', $custom_css );
        $custom_css = str_replace( "\n", '', $custom_css );
        $custom_css = str_replace( "\t", '', $custom_css );
		return $custom_css;
	}
}


// UNREGISTER CUSTOM POST TYPES
//--------------------------------------------------
if (!function_exists('g5plus_unregister_post_type')) {
	function g5plus_unregister_post_type( $post_type, $slug = '' ) {
		global $wp_post_types;

		$cpt_disable = g5plus_get_option('cpt-disable',array(
			'portfolio' => '0',
			'ourteam' => '0',
		));
		if ( is_array( $cpt_disable ) ) {
			foreach ( $cpt_disable as $post_type => $cpt ) {
				if ( $cpt == 1 && isset( $wp_post_types[ $post_type ] ) ) {
					unset( $wp_post_types[ $post_type ] );
				}
			}
		}
	}
	add_action( 'init', 'g5plus_unregister_post_type', 20 );
}


/**
 * Get Tax meta with key not prefix
 * *******************************************************
 */
if ( !function_exists( 'g5plus_get_tax_meta') ) {
	function g5plus_get_tax_meta($term_id,$key,$multi = false) {
		if ( function_exists('get_term_meta')){
			$meta = get_term_meta($term_id, $key, !$multi );
			if ($meta === false || $meta === '') {
				$meta = get_tax_meta( $term_id, $key, !$multi  );
			}
			return $meta;
		}else{
			return get_tax_meta( $term_id, $key, !$multi  );
		}
	}
}


if (!function_exists('g5plus_get_default_fonts')) {
	function g5plus_get_default_fonts($is_frontEnd = true) {
		return  array(
			'body_font' => array(
				'default' => array(
					'font-size' => '14px',
					'font-family'=> 'Lato',
					'font-weight' =>'400',
				),
				'selector' => $is_frontEnd ? array('body') : array('.editor-styles-wrapper.editor-styles-wrapper')
			) ,
			'h1_font' => array(
				'default' =>  array(
					'font-size'=>'32px',
					'line-height'=>'48px',
					'font-family'=>'Oswald',
					'font-weight'=>'400',
				),
				'selector' => $is_frontEnd ? array('h1') :  array('.editor-styles-wrapper.editor-styles-wrapper h1')
			),
			'h2_font' => array(
				'default' =>  array(
					'font-size'=>'24px',
					'line-height'=>'36px',
					'font-family'=>'Oswald',
					'font-weight'=>'400',
				),
				'selector' => $is_frontEnd ? array('h2') : array('.editor-styles-wrapper.editor-styles-wrapper h2')
			),
			'h3_font' => array(
				'default' =>  array(
					'font-size'=>'22px',
					'line-height'=>'28px',
					'font-family'=>'Oswald',
					'font-weight'=>'400',
				),
				'selector' => $is_frontEnd ? array('h3') :array('.editor-styles-wrapper.editor-styles-wrapper h3','.editor-post-title__block.editor-post-title__block .editor-post-title__input')
			),
			'h4_font' => array(
				'default' =>  array(
					'font-size'=>'18px',
					'line-height'=>'24px',
					'font-family'=>'Oswald',
					'font-weight'=>'400',
				),
				'selector' => $is_frontEnd ? array('h4') : array('.editor-styles-wrapper.editor-styles-wrapper h4')
			),
			'h5_font' => array(
				'default' =>  array(
					'font-size'=>'16px',
					'line-height'=>'22px',
					'font-family'=>'Oswald',
					'font-weight'=>'400',
				),
				'selector' => $is_frontEnd ? array('h5') : array('.editor-styles-wrapper.editor-styles-wrapper h5')
			),
			'h6_font'  => array(
				'default' =>  array(
					'font-size'=>'12px',
					'line-height'=>'16px',
					'font-family'=>'Oswald',
					'font-weight'=>'400',
				),
				'selector' => $is_frontEnd ? array('h6') : array('.editor-styles-wrapper.editor-styles-wrapper h6')
			),
			'menu_font' => array(
				'default' =>  array(
					'font-family'=>'Roboto',
				),
			),
			'primary_font' => array(
				'default' =>  array(
					'font-family'=>'Lato',
				),
			),
			'secondary_font' => array(
				'default' =>  array(
					'font-family'=>'Oswald',
				),
			)
		);
	}
}

if (!function_exists('g5plus_get_fonts_css')) {
	function g5plus_get_fonts_css($is_frontEnd = true) {
		$custom_fonts_variable = g5plus_get_default_fonts($is_frontEnd);
		$custom_css = '';
		foreach ($custom_fonts_variable as $optionKey => $v) {
			$fonts = g5plus_get_option($optionKey,$v['default']);
			if ($fonts) {
				$selector = (isset($v['selector']) && is_array($v['selector'])) ? implode(',', $v['selector']) : '';
				$fonts = g5plus_process_font($fonts);
				$fonts_attributes = array();
				if (isset($fonts['font-family'])) {
					$fonts['font-family'] = g5plus_get_font_family($fonts['font-family']);
					$fonts_attributes[] = "font-family: '{$fonts['font-family']}'";
				}

				if (isset($fonts['font-size'])) {
					$fonts_attributes[] = "font-size: {$fonts['font-size']}";
				}

				if (isset($fonts['font-weight'])) {
					$fonts_attributes[] = "font-weight: {$fonts['font-weight']}";
				}

				if (isset($fonts['font-style'])) {
					$fonts_attributes[] = "font-style: {$fonts['font-style']}";
				}

				if (isset($fonts['text-transform'])) {
					$fonts_attributes[] = "text-transform: {$fonts['text-transform']}";
				}

				if (isset($fonts['color'])) {
					$fonts_attributes[] = "color: {$fonts['color']}";
				}

				if (isset($fonts['line-height'])) {
					$fonts_attributes[] = "line-height: {$fonts['line-height']}";
				}


				if ((count($fonts_attributes) > 0)  && ($selector != '')) {
					$fonts_css = implode(';', $fonts_attributes);

					$custom_css .= <<<CSS
                {$selector} {
                    {$fonts_css}
                }
CSS;
				}
			}
		}

		// Remove comments
		$custom_css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $custom_css);
		// Remove space after colons
		$custom_css = str_replace(': ', ':', $custom_css);
		// Remove whitespace
		$custom_css = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $custom_css);
		return $custom_css;
	}
}

if (!function_exists('g5plus_get_fonts_url')) {
	function g5plus_get_fonts_url() {
		$custom_fonts_variable = g5plus_get_default_fonts();
		$google_fonts = array();
		foreach ($custom_fonts_variable as $k => $v) {
			$custom_fonts = g5plus_get_option($k,$v['default']);
			if ($custom_fonts && isset($custom_fonts['font-family']) && !in_array($custom_fonts['font-family'],$google_fonts)) {
				$google_fonts[] = $custom_fonts['font-family'];
			}
		}
		$fonts_url = '';
		$fonts = '';
		foreach($google_fonts as $google_font)
		{
			$fonts .= str_replace('','+',$google_font) . ':100,300,400,600,700,900,100italic,300italic,400italic,600italic,700italic,900italic|';
		}
		if ($fonts != '')
		{
			$protocol = is_ssl() ? 'https' : 'http';
			$fonts_url =  $protocol . '://fonts.googleapis.com/css?family=' . substr_replace( $fonts, "", - 1 );
		}
		return $fonts_url;
	}
}



if (!function_exists('g5plus_get_meta')) {
	function g5plus_get_meta($key, $args = array(), $post_id = null ) {
		if (function_exists('rwmb_meta')) {
			return rwmb_meta($key,$args, $post_id);
		}
		$default = &g5plus_get_meta_default();
		return isset($default[$key]) ? $default[$key] : '';
	}
}

if (!function_exists('g5plus_get_meta_default')) {
	function &g5plus_get_meta_default() {
		$prefix = 'g5plus_';
		$default =  array (
			"{$prefix}post_format_image" => '',
			"{$prefix}post_format_gallery" => '',
			"{$prefix}post_format_video" => '',
			"{$prefix}post_format_audio" => '',
			"{$prefix}post_format_quote" => '',
			"{$prefix}post_format_quote_author" => '',
			"{$prefix}post_format_quote_author_url" => '',
			"{$prefix}post_format_link_url" => '',
			"{$prefix}post_format_link_text" => '',
			"{$prefix}services_gallery" => '',


			"{$prefix}show_page_title" => '-1',
			"{$prefix}page_title_custom" => '',
			"{$prefix}page_title_text_color" => '',
			"{$prefix}page_title_bg_color" => '',
			"{$prefix}page_title_bg_image" => '',
			"{$prefix}page_title_overlay_color" => '',
			"{$prefix}enable_custom_overlay_opacity" => 0,
			"{$prefix}page_title_overlay_opacity" => '',
			"{$prefix}page_title_height" => '',
			"{$prefix}breadcrumbs_in_page_title" => '-1',
			"{$prefix}page_title_remove_margin_bottom" => 0,

			"{$prefix}page_menu" => '',
			"{$prefix}is_one_page" => '',

			"{$prefix}top_bar" => '-1',
			"{$prefix}top_bar_layout" => '',
			"{$prefix}top_left_sidebar" => '',
			"{$prefix}top_right_sidebar" => '',


			"{$prefix}header_show_hide" => '1',
			"{$prefix}header_layout" => '',
			"{$prefix}enable_header_customize" => 0,
			"{$prefix}header_customize" => '',
			"{$prefix}header_customize_text" => '',
			"{$prefix}header_get_a_quote_shortcode" => '',
			"{$prefix}header_sticky" => '-1',
			"{$prefix}mobile_header_search_box" => '-1',
			"{$prefix}mobile_header_shopping_cart" => '-1',
			"{$prefix}custom_logo" => '',


			"{$prefix}footer_show_hide" => '-1',
			"{$prefix}footer_layout" => '',

			"{$prefix}bottom_bar" => '-1',
			"{$prefix}bottom_bar_layout" => '',
			"{$prefix}bottom_bar_left_sidebar" => '',
			"{$prefix}bottom_bar_right_sidebar" => '',

			"{$prefix}layout_style" => '-1',
			"{$prefix}page_layout" => '-1',
			"{$prefix}page_sidebar" => '',
			"{$prefix}page_left_sidebar" => '',
			"{$prefix}page_right_sidebar" => '',
			"{$prefix}sidebar_width" => '-1',
			"{$prefix}page_class_extra" => '',

		);
		return $default;
	}
}