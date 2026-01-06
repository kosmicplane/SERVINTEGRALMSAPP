<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Corpex
 */

if ( ! function_exists( 'corpex_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function corpex_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'corpex' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'corpex' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);
	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
}
endif;

if ( ! function_exists( 'corpex_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function corpex_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'corpex' ) );
		if ( $categories_list && corpex_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'corpex' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'corpex' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'corpex' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'corpex' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'corpex' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function corpex_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'corpex_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'corpex_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so corpex_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so corpex_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in corpex_categorized_blog.
 */
function corpex_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'corpex_categories' );
}
add_action( 'edit_category', 'corpex_category_transient_flusher' );
add_action( 'save_post',     'corpex_category_transient_flusher' );

/**
 * Function that returns if the menu is sticky
 */
if (!function_exists('corpex_sticky_menu')):
    function corpex_sticky_menu()
    {
        $is_sticky = get_theme_mod('hide_show_sticky','0');

        if ($is_sticky == '1'):
            return 'is-sticky-on ';
        else:
            return 'not-sticky';
        endif;
    }
endif;


/**
 * Register Google fonts for corpex.
 */
function corpex_google_font() {
	
    $get_fonts_url = '';
		
    $font_families = array();
 
	$font_families = array('Fira Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900');
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $get_fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

    return $get_fonts_url;
}

function corpex_scripts_styles() {
    wp_enqueue_style( 'corpex-fonts', corpex_google_font(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'corpex_scripts_styles' );


/**
 * Register Breadcrumb for Multiple Variation
 */
function corpex_breadcrumbs_style() {
	get_template_part('./template-parts/sections/section','breadcrumb');			
}


/**
 * This Function Check whether Sidebar active or Not
 */
if(!function_exists( 'corpex_post_layout' )) :
function corpex_post_layout(){
	if(is_active_sidebar('corpex-sidebar-primary'))
		{ echo 'col-8'; } 
	else 
		{ echo 'col-12'; }  
} endif;



/**
 * This Function Check whether Sidebar active or Not
 */
if(!function_exists( 'corpex_post_columns' )) :
function corpex_post_columns(){
		if(is_single()){
			echo 'col';
		}
		else if (is_page_template('templates/template-homepage.php')){
			echo 'col-lg-4 col-md-6 col-sm';
		}
		else if(!is_active_sidebar('corpex-sidebar-primary')){
			echo 'col-lg-4 col-md-6 col-sm';
		} else {
			echo 'col-md-6 col';
		}
} endif;



if( ! function_exists( 'corpex_dynamic_style' ) ):
    function corpex_dynamic_style() {
$output_css = '';
		
		$theme = wp_get_theme(); // gets the current theme
		
		/**
		 * Logo Width 
		 */
		 $logo_width			= get_theme_mod('logo_width','220');
		if($logo_width !== '') { 
				$output_css .=".main-navigation a img, .mobile-logo img {
					max-width: " .esc_attr($logo_width). "px;
				}\n";
			}
			
		$hs_breadcrumb				= get_theme_mod('hs_breadcrumb','1');	
		$breadcrumb_bg_img			= get_theme_mod('breadcrumb_bg_img',get_template_directory_uri() .'/assets/images/breadcrumb.jpg'); 
		$breadcrumb_back_attach		= get_theme_mod('breadcrumb_back_attach','scroll'); 
		$breadcrumb_bg_img_opacity	= get_theme_mod('breadcrumb_bg_img_opacity','0.5');
		$breadcrumb_overlay_color	= get_theme_mod('breadcrumb_overlay_color','#000000');

		// if($breadcrumb_bg_img !== '' && $hs_breadcrumb == '1') { 
			// $output_css .=".breadcrumb-area {
					// background-image: url(" .esc_url($breadcrumb_bg_img). ");
					// background-attachment: " .esc_attr($breadcrumb_back_attach). ";
				// }\n";
		// }
		
		if($breadcrumb_bg_img !== '') { 
			$output_css .=".breadcrumb-area::before{
					background-color: " .esc_attr($breadcrumb_overlay_color). ";
					opacity: " .esc_attr($breadcrumb_bg_img_opacity). ";
				}\n";
		}
				
		$corpex_site_cntnr_width 			 = get_theme_mod('corpex_site_cntnr_width','1320');
			if($corpex_site_cntnr_width >=768 && $corpex_site_cntnr_width <=2000){
				$output_css .=".container {
						max-width: " .esc_attr($corpex_site_cntnr_width). "px;
					}\n";
			}

		$footer_bg_img						= get_theme_mod('footer_bg_img',esc_url(get_template_directory_uri() .'/assets/images/footer/footer-bg.jpg'));
		$footer_info_left_bg_image			= get_theme_mod('footer_info_left_bg_image',esc_url(get_template_directory_uri() .'/assets/images/ft-1.jpg'));
		$footer_info_right_bg_image			= get_theme_mod('footer_info_right_bg_image',esc_url(get_template_directory_uri() .'/assets/images/ft-2.jpg'));
		$footer_bg_color				= get_theme_mod('footer_bg_color');
		$footer_bg_img_opacity				= get_theme_mod('footer_bg_img_opacity', '0.6');
			if(!empty($footer_bg_color)):
				 $output_css .=".footer-section:before{ 
					background-color: ".esc_html($footer_bg_color).";
					opacity: ".esc_html($footer_bg_img_opacity).";
				}\n";
			endif;
			if(!empty($footer_bg_img)):
				 $output_css .=".footer-section{ 
					background: url(".esc_url($footer_bg_img).");
				}\n";
			endif;
			if(!empty($footer_info_left_bg_image)):
				 $output_css .=".footer-top .footer-top-item:nth-child(1) .contact-area:before{ 
					background-image: url(".esc_url($footer_info_left_bg_image).");
				}\n";
			endif;
			if(!empty($footer_info_right_bg_image)):
				 $output_css .=".footer-top .footer-top-item:nth-child(2) .contact-area:before{ 
					background-image: url(".esc_url($footer_info_right_bg_image).");
				}\n";
			endif;
		// }
		
			
		/**
		 *  Background Elements
		 */
		$hs_bg_elements	= get_theme_mod('hs_bg_elements','1');	
		
		if($hs_bg_elements ==''):
			 $output_css .=".bg-elements { 
					   display:none;
				}\n";	
		endif; 	
		
        wp_add_inline_style( 'corpex-style', $output_css );
    }
endif;
add_action( 'wp_enqueue_scripts', 'corpex_dynamic_style' );