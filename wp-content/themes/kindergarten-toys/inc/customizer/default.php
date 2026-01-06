<?php
/**
 * Default Values.
 *
 * @package Kindergarten Toys
 */

if ( ! function_exists( 'kindergarten_toys_get_default_theme_options' ) ) :
	function kindergarten_toys_get_default_theme_options() {

        $kindergarten_toys_defaults = array();
		
        // Options.
        $kindergarten_toys_defaults['logo_width_range']                                                 = 300;
	$kindergarten_toys_defaults['kindergarten_toys_global_sidebar_layout']	                        = 'right-sidebar';
        $kindergarten_toys_defaults['kindergarten_toys_header_layout_phone_number']                     = esc_html__( '+(0321)7528659', 'kindergarten-toys' );
        $kindergarten_toys_defaults['kindergarten_toys_header_layout_text']           = esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt', 'kindergarten-toys' );
        $kindergarten_toys_defaults['kindergarten_toys_header_layout_button']                           = esc_html__( 'Enrol Now', 'kindergarten-toys' );
        $kindergarten_toys_defaults['kindergarten_toys_header_layout_button_url']                       = esc_url( '#', 'kindergarten-toys' );
        $kindergarten_toys_defaults['kindergarten_toys_slider_button_text']                             = esc_html__( 'Waiting List', 'kindergarten-toys' );
        $kindergarten_toys_defaults['kindergarten_toys_slider_button_url']                              = esc_url( '#', 'kindergarten-toys' );
        $kindergarten_toys_defaults['kindergarten_toys_header_search']                                  = 1;
        $kindergarten_toys_defaults['kindergarten_toys_display_header_toggle']                          = 1;
        $kindergarten_toys_defaults['kindergarten_toys_theme_pagination_options_alignment']             = 'Center';
        $kindergarten_toys_defaults['kindergarten_toys_theme_breadcrumb_options_alignment']             = 'Left';
        $kindergarten_toys_defaults['kindergarten_toys_pagination_layout']                              = 'numeric';
        $kindergarten_toys_defaults['kindergarten_toys_menu_text_transform']                            = 'capitalize';
        $kindergarten_toys_defaults['kindergarten_toys_single_page_content_alignment']                  = 'left';
        $kindergarten_toys_defaults['kindergarten_toys_theme_loader']                  = 0;
        $kindergarten_toys_defaults['kindergarten_toys_theme_breadcrumb_enable']                 = 1;
        $kindergarten_toys_defaults['kindergarten_toys_single_post_content_alignment']                 = 'left';
        $kindergarten_toys_defaults['kindergarten_toys_footer_column_layout'] 		                = 3;
        $kindergarten_toys_defaults['kindergarten_toys_menu_font_size']                                 = 14;
        $kindergarten_toys_defaults['kindergarten_toys_copyright_font_size']                            = 16;
        $kindergarten_toys_defaults['kindergarten_toys_breadcrumb_font_size']                           = 16;
        $kindergarten_toys_defaults['kindergarten_toys_excerpt_limit']                                  = 20;
        $kindergarten_toys_defaults['kindergarten_toys_per_columns']                                    = 3;
        $kindergarten_toys_defaults['kindergarten_toys_product_per_page']                               = 9;
        $kindergarten_toys_defaults['kindergarten_toys_custom_related_products_number'] = 6;
        $kindergarten_toys_defaults['kindergarten_toys_custom_related_products_number_per_row'] = 3;
        $kindergarten_toys_defaults['kindergarten_toys_footer_copyright_text'] 		                = esc_html__( 'All rights reserved.', 'kindergarten-toys' );
        $kindergarten_toys_defaults['twp_navigation_type']              			        = 'theme-normal-navigation';
        $kindergarten_toys_defaults['kindergarten_toys_post_author']                	                = 1;
        $kindergarten_toys_defaults['kindergarten_toys_post_date']                		        = 1;
        $kindergarten_toys_defaults['kindergarten_toys_post_category']                	                = 1;
        $kindergarten_toys_defaults['kindergarten_toys_post_tags']                		        = 1;
        $kindergarten_toys_defaults['kindergarten_toys_floating_next_previous_nav']                     = 1;
        $kindergarten_toys_defaults['kindergarten_toys_category_section']                               = 0;
        $kindergarten_toys_defaults['kindergarten_toys_courses_category_section']                       = 0;
        $kindergarten_toys_defaults['kindergarten_toys_sticky']                                         = 0;
        $kindergarten_toys_defaults['kindergarten_toys_background_color']                               = '#fff';
        $kindergarten_toys_defaults['kindergarten_toys_footer_widget_title_alignment']                  = 'left'; 
        $kindergarten_toys_defaults['kindergarten_toys_show_hide_related_product']                      = 1;
        $kindergarten_toys_defaults['kindergarten_toys_display_footer']                                 = 1;
        $kindergarten_toys_defaults['kindergarten_toys_global_color']                                   = '#FE9403';

        $kindergarten_toys_defaults['kindergarten_toys_display_archive_post_category']          = 1;
        $kindergarten_toys_defaults['kindergarten_toys_display_archive_post_title']             = 1;
        $kindergarten_toys_defaults['kindergarten_toys_display_archive_post_content']           = 1;
        $kindergarten_toys_defaults['kindergarten_toys_display_archive_post_image']             = 1;
        $kindergarten_toys_defaults['kindergarten_toys_display_archive_post_button']            = 1;

        $kindergarten_toys_defaults['kindergarten_toys_enable_to_the_top']                      = 1;
        $kindergarten_toys_defaults['kindergarten_toys_to_the_top_text']                      = esc_html__( 'To The Top', 'kindergarten-toys' );
        $kindergarten_toys_defaults['kindergarten_toys_heading_typography_font']                    = 'Poppins, sans-serif';
        $kindergarten_toys_defaults['kindergarten_toys_content_typography_font']                    = 'Poppins, sans-serif';
        $kindergarten_toys_defaults['kindergarten_toys_display_single_post_image']            = 1;
        $kindergarten_toys_defaults['kindergarten_toys_display_archive_post_format_icon']       = 1;
        
        // Social Icon
        $kindergarten_toys_defaults['kindergarten_toys_header_layout_facebook_link']              = esc_url( '#', 'kindergarten-toys' );
        $kindergarten_toys_defaults['kindergarten_toys_header_layout_twitter_link']               = esc_url( '#', 'kindergarten-toys' );
        $kindergarten_toys_defaults['kindergarten_toys_header_layout_pintrest_link']              = esc_url( '#', 'kindergarten-toys' );
        $kindergarten_toys_defaults['kindergarten_toys_header_layout_instagram_link']             = esc_url( '#', 'kindergarten-toys' );
        $kindergarten_toys_defaults['kindergarten_toys_header_layout_youtube_link']               = esc_url( '#', 'kindergarten-toys' );

        //slider
        $kindergarten_toys_defaults['kindergarten_toys_header_banner']                            = 1;
        $kindergarten_toys_defaults['kindergarten_toys_slider_section_title']                     = esc_html__( 'Join Us Now', 'kindergarten-toys' );

        // Courses Section
        $kindergarten_toys_defaults['kindergarten_toys_locations_post']                             = 0;
        
        // 404 Page Defaults
        $kindergarten_toys_defaults['kindergarten_toys_404_main_title'] = esc_html__( 'Oops! That page can’t be found.', 'kindergarten-toys' );
        $kindergarten_toys_defaults['kindergarten_toys_404_subtitle_one'] = esc_html__( 'Maybe it’s out there, somewhere...', 'kindergarten-toys' );
        $kindergarten_toys_defaults['kindergarten_toys_404_para_one'] = esc_html__( 'You can always find insightful stories on our', 'kindergarten-toys' );
        $kindergarten_toys_defaults['kindergarten_toys_404_subtitle_two'] = esc_html__( 'Still feeling lost? You’re not alone.', 'kindergarten-toys' );
        $kindergarten_toys_defaults['kindergarten_toys_404_para_two'] = esc_html__( 'Enjoy these stories about getting lost, losing things, and finding what you never knew you were looking for.', 'kindergarten-toys' );

	// Pass through filter.
	$kindergarten_toys_defaults = apply_filters( 'kindergarten_toys_filter_default_theme_options', $kindergarten_toys_defaults );
                return $kindergarten_toys_defaults;
	}
endif;