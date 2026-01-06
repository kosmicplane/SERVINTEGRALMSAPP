<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Atua
 */

/**
 * Theme Page Header Title
*/
function atua_theme_page_header_title(){
	if( is_archive() )
	{
		echo '<h1>';
		if ( is_day() ) :
		/* translators: %1$s %2$s: date */	
		  printf( esc_html__( '%1$s %2$s', 'atua' ), esc_html__('Archives','atua'), get_the_date() );  
        elseif ( is_month() ) :
		/* translators: %1$s %2$s: month */	
		  printf( esc_html__( '%1$s %2$s', 'atua' ), esc_html__('Archives','atua'), get_the_date( 'F Y' ) );
        elseif ( is_year() ) :
		/* translators: %1$s %2$s: year */	
		  printf( esc_html__( '%1$s %2$s', 'atua' ), esc_html__('Archives','atua'), get_the_date( 'Y' ) );
		elseif( is_author() ):
		/* translators: %1$s %2$s: author */	
			printf( esc_html__( '%1$s %2$s', 'atua' ), esc_html__('All posts by','atua'), get_the_author() );
        elseif( is_category() ):
		/* translators: %1$s %2$s: category */	
			printf( esc_html__( '%1$s %2$s', 'atua' ), esc_html__('Category','atua'), single_cat_title( '', false ) );
		elseif( is_tag() ):
		/* translators: %1$s %2$s: tag */	
			printf( esc_html__( '%1$s %2$s', 'atua' ), esc_html__('Tag','atua'), single_tag_title( '', false ) );
		elseif( class_exists( 'WooCommerce' ) && is_shop() ):
		/* translators: %1$s %2$s: WooCommerce */	
			printf( esc_html__( '%1$s %2$s', 'atua' ), esc_html__('Shop','atua'), single_tag_title( '', false ));
        elseif( is_archive() ): 
		the_archive_title( '<h1>', '</h1>' ); 
		endif;
		echo '</h1>';
	}
	elseif( is_404() )
	{
		echo '<h1>';
		/* translators: %1$s: 404 */	
		printf( esc_html__( '%1$s ', 'atua' ) , esc_html__('404','atua') );
		echo '</h1>';
	}
	elseif( is_search() )
	{
		echo '<h1>';
		/* translators: %1$s %2$s: search */
		printf( esc_html__( '%1$s %2$s', 'atua' ), esc_html__('Search results for','atua'), get_search_query() );
		echo '</h1>';
	}
	else
	{
		echo '<h1>'.esc_html( get_the_title() ).'</h1>';
	}
}


/**
 * Theme Breadcrumbs Url
*/
function atua_page_url() {
	$page_url = 'http';
	if ( key_exists("HTTPS", $_SERVER) && ( $_SERVER["HTTPS"] == "on" ) ){
		$page_url .= "s";
	}
	$page_url .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$page_url .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$page_url .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $page_url;
}


/**
 * Theme Breadcrumbs
*/
if( !function_exists('atua_page_header_breadcrumbs') ):
	function atua_page_header_breadcrumbs() { 	
		global $post;
		$homeLink = home_url();
								
			if (is_home() || is_front_page()) :
				echo '<li class="breadcrumb-item"><a href="'.$homeLink.'">'.__('Home','atua').'</a></li>';
	            echo '<li class="breadcrumb-item active">'; echo single_post_title(); echo '</li>';
			else:
				echo '<li class="breadcrumb-item"><a href="'.$homeLink.'">'.__('Home','atua').'</a></li>';
				if ( is_category() ) {
				    echo '<li class="breadcrumb-item active"><a href="'. atua_page_url() .'">' . __('Archive by category','atua').' "' . single_cat_title('', false) . '"</a></li>';
				} elseif ( is_day() ) {
					echo '<li class="breadcrumb-item active"><a href="'. get_year_link(get_the_time('Y')) . '">'. get_the_time('Y') .'</a>';
					echo '<li class="breadcrumb-item active"><a href="'. get_month_link(get_the_time('Y'),get_the_time('m')) .'">'. get_the_time('F') .'</a>';
					echo '<li class="breadcrumb-item active"><a href="'. atua_page_url() .'">'. get_the_time('d') .'</a></li>';
				} elseif ( is_month() ) {
					echo '<li class="breadcrumb-item active"><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>';
					echo '<li class="breadcrumb-item active"><a href="'. atua_page_url() .'">'. get_the_time('F') .'</a></li>';
				} elseif ( is_year() ) {
				    echo '<li class="breadcrumb-item active"><a href="'. atua_page_url() .'">'. get_the_time('Y') .'</a></li>';
				} elseif ( is_single() && !is_attachment() && is_page('single-product') ) {					
				if ( get_post_type() != 'post' ) {
					$cat = get_the_category(); 
					$cat = $cat[0];
					echo '<li class="breadcrumb-item">';
					echo get_category_parents($cat, TRUE, '');
					echo '</li>';
					echo '<li class="breadcrumb-item active"><a href="' . atua_page_url() . '">'. get_the_title() .'</a></li>';
				} }  
					elseif ( is_page() && $post->post_parent ) {
				    $parent_id  = $post->post_parent;
					$breadcrumbs = array();
					while ($parent_id) {
						$page = get_page($parent_id);
						$breadcrumbs[] = '<li class="breadcrumb-item active"><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
					$parent_id  = $page->post_parent;
					}
					$breadcrumbs = array_reverse($breadcrumbs);
					foreach ($breadcrumbs as $crumb) echo $crumb;
					    echo '<li class="breadcrumb-item active"><a href="' . atua_page_url() . '">'. get_the_title() .'</a></li>';
                    }
					elseif( is_search() )
					{
					    echo '<li class="breadcrumb-item active"><a href="' . atua_page_url() . '">'. get_search_query() .'</a></li>';
					}
					elseif( is_404() )
					{
						echo '<li class="breadcrumb-item active"><a href="' . atua_page_url() . '">'.__('Error 404','atua').'</a></li>';
					}
					else { 
					    echo '<li class="breadcrumb-item active"><a href="' . atua_page_url() . '">'. get_the_title() .'</a></li>';
					}
				endif;
        }
endif;

/*=========================================
Register Google fonts for Atua.
=========================================*/
function atua_google_fonts_url() {
	
    $font_families = array('DM+Sans:wght@400;500;700&family=Red+Hat+Display:wght@400;500;600;700;800;900');

	$fonts_url = add_query_arg( array(
		'family' => implode( '&family=', $font_families ),
		'display' => 'swap',
	), 'https://fonts.googleapis.com/css2' );

	require_once get_theme_file_path( 'inc/wptt-webfont-loader.php' );

	return wptt_get_webfont_url( esc_url_raw( $fonts_url ) );
}

function atua_google_fonts_scripts_styles() {
    wp_enqueue_style( 'atua-google-fonts', atua_google_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'atua_google_fonts_scripts_styles' );


/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function atua_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	
	return $classes;
}
add_filter( 'body_class', 'atua_body_classes' );

if ( ! function_exists( 'wp_body_open' ) ) {
	/**
	 * Backward compatibility for wp_body_open hook.
	 *
	 * @since 1.0.0
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

if (!function_exists('atua_str_replace_assoc')) {

    /**
     * atua_str_replace_assoc
     * @param  array $replace
     * @param  array $subject
     * @return array
     */
    function atua_str_replace_assoc(array $replace, $subject) {
        return str_replace(array_keys($replace), array_values($replace), $subject);
    }
}

/*=========================================
Atua Site Preloader
=========================================*/
if ( ! function_exists( 'atua_site_preloader' ) ) :
function atua_site_preloader() {
	$atua_hs_preloader_option 	= get_theme_mod( 'atua_hs_preloader_option','1'); 
	if($atua_hs_preloader_option == '1') { 
	?>
		 <div id="dt_preloader" class="dt_preloader">
			<div class="dt_preloader-inner">
				<button type="button" class="dt_preloader-close site--close"></button>
				<div id="dt_preloader-handle" class="dt_preloader-handle">
					<div class="dt_preloader-animation">
						<div class="dt_preloader-spinner"></div>
						<div class="dt_preloader-text">
							<?php 
							$atua_preloader_string = get_bloginfo('name');
							//Using the explode method
							$atua_preloader_arr_string = str_split($atua_preloader_string);

							//foreach loop to display the returned array
							foreach($atua_preloader_arr_string as $str){
								echo sprintf(__('<span class="splitted" data-char=%1$s>%1$s</span>', 'atua'),$str);
							}
							?>
						</div>
					</div>  
				</div>
			</div>
		</div>
	<?php }
	} 
endif;
add_action( 'atua_site_preloader', 'atua_site_preloader' );



/*=========================================
Atua Site Header
=========================================*/
if ( ! function_exists( 'atua_site_main_header' ) ) :
function atua_site_main_header() {
	get_template_part('template-parts/site','header');
	} 
endif;
add_action( 'atua_site_main_header', 'atua_site_main_header' );



/*=========================================
Atua Header Image
=========================================*/
if ( ! function_exists( 'atua_wp_hdr_image' ) ) :
function atua_wp_hdr_image() {
	if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-header" id="custom-header" rel="home">
		<img src="<?php echo esc_url(get_header_image()); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr(get_bloginfo( 'title' )); ?>">
	</a>
<?php endif;
	} 
endif;
add_action( 'atua_wp_hdr_image', 'atua_wp_hdr_image' );

/*=========================================
Atua Site Navigation
=========================================*/
if ( ! function_exists( 'atua_site_header_navigation' ) ) :
function atua_site_header_navigation() {
	wp_nav_menu( 
		array(  
			'theme_location' => 'primary_menu',
			'container'  => '',
			'menu_class' => 'dt_navbar-mainmenu',
			'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
			'walker' => new WP_Bootstrap_Navwalker()
			 ) 
		);
	} 
endif;
add_action( 'atua_site_header_navigation', 'atua_site_header_navigation' );


/*=========================================
Atua Header Button
=========================================*/
if ( ! function_exists( 'atua_header_button' ) ) :
function atua_header_button() {
	$atua_hs_hdr_btn 		= get_theme_mod( 'atua_hs_hdr_btn','1'); 
	$atua_hdr_btn_lbl 		= get_theme_mod( 'atua_hdr_btn_lbl'); 
	$atua_hdr_btn_link 		= get_theme_mod( 'atua_hdr_btn_link'); 
	$atua_hdr_btn_target 		= get_theme_mod( 'atua_hdr_btn_target');
	if($atua_hdr_btn_target=='1'): $target='target=_blank'; else: $target=''; endif; 
	if($atua_hs_hdr_btn=='1'  && !empty($atua_hdr_btn_lbl)):	
?>
	<li class="dt_navbar-button-item">
		<a href="<?php echo esc_url($atua_hdr_btn_link); ?>" <?php echo esc_attr($target); ?> class="dt-btn dt-btn-primary">
			<span class="dt-btn-text" data-text="<?php echo esc_attr($atua_hdr_btn_lbl); ?>"><?php echo wp_kses_post($atua_hdr_btn_lbl); ?></span>
		</a>
	</li>
<?php else: ?>	
	<li class="dt_navbar-blank-tag" style="padding-right: 1.2rem;"></li>
<?php endif;
	} 
endif;
add_action( 'atua_header_button', 'atua_header_button' );


/*=========================================
Atua Site Search
=========================================*/
if ( ! function_exists( 'atua_site_main_search' ) ) :
function atua_site_main_search() {
	$atua_hs_hdr_search 	= get_theme_mod( 'atua_hs_hdr_search','1'); 
	if($atua_hs_hdr_search=='1'):	
?>
<li class="dt_navbar-search-item">
	<button class="dt_navbar-search-toggle"><i class="fa fa-search" aria-hidden="true"></i></button>
	<div class="dt_search search--header">
		<form  method="get" class="dt_search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'search again', 'atua' ); ?>">
			<label for="dt_search-form-1">
				<span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'atua' ); ?></span>
				<input type="search" id="dt_search-form-1" class="dt_search-field" placeholder="<?php esc_attr_e( 'search Here', 'atua' ); ?>" value="" name="s">
			</label>
			<button type="submit" class="dt_search-submit search-submit"><i class="fa fa-search" aria-hidden="true"></i></button>
		</form>
		<button type="button" class="dt_search-close"><i class="fas fa-angle-up" aria-hidden="true"></i></button>
	</div>
</li>
<?php endif;
	} 
endif;
add_action( 'atua_site_main_search', 'atua_site_main_search' );



/*=========================================
Atua WooCommerce Cart
=========================================*/
if ( ! function_exists( 'atua_woo_cart' ) ) :
function atua_woo_cart() {
	$atua_hs_hdr_cart 	= get_theme_mod( 'atua_hs_hdr_cart','1'); 
		if($atua_hs_hdr_cart=='1' && class_exists( 'WooCommerce' )):	
	?>
	<li class="dt_navbar-cart-item">
		<a href="javascript:void(0);" class="dt_navbar-cart-icon">
			<svg class="cart-svg" width="2.8rem" height="2.8rem" fill="none" viewBox="0 0 70 75">
				<path class="cart-path" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="
				M14.973,26.021V15.296c0-1.109-0.865-2.292-1.922-2.628L1.49,8.99 M62.354,55.639c0,1.109-0.101,2.236-0.224,2.504
				c-0.123,0.268-1.684,0.487-2.793,0.487H17.989c-1.109,0-2.242-0.098-2.517-0.218c-0.275-0.12-0.5-1.664-0.5-2.773V23.273
				c0-1.109,0.101-2.236,0.224-2.504c0.123-0.268,1.684-0.487,2.793-0.487h41.348c1.109,0,2.242,0.098,2.517,0.218 c0.275,0.12,0.5,1.664,0.5,2.773V55.639z"/>
				<line class="cart-line" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="30.863" y1="20.74" x2="30.863" y2="58.63"/>
				<line class="cart-line" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="46.837" y1="20.74" x2="46.837" y2="58.63"/>
				<line class="cart-line" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="15.973" y1="33.308" x2="61.24" y2="33.308"/>
				<line class="cart-line" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="15.973" y1="46.285" x2="61.125" y2="46.285"/>
				<circle class="cart-wheel" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" cx="23.442" cy="64.554" r="5.924"/>
				<circle class="cart-wheel" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" cx="53.314" cy="64.554" r="5.924"/>
			</svg>
			<?php 
				$count = WC()->cart->cart_contents_count;
				
				if ( $count > 0 ) {
				?>
					 <strong class="cart-count"><?php echo esc_html( $count ); ?></strong>
				<?php 
				}
				else {
					?>
					<strong class="cart-count"><?php  esc_html_e('0','atua'); ?></strong>
					<?php 
				}
		?>
		</a>
		<div class="dt_navbar-shopcart">
			<?php get_template_part('woocommerce/cart/mini','cart'); ?>
		</div>
	</li>
	<?php endif; 
	} 
endif;
add_action( 'atua_woo_cart', 'atua_woo_cart' );


 /**
 * Add WooCommerce Cart Icon With Cart Count (https://isabelcastillo.com/woocommerce-cart-icon-count-theme-header)
 */
function atua_woo_add_to_cart_fragment( $fragments ) {
	
    ob_start();
    $count = WC()->cart->cart_contents_count; 
    ?> 
	<?php 
			$count = WC()->cart->cart_contents_count;
			
			if ( $count > 0 ) {
			?>
				 <strong class="cart-count"><?php echo esc_html( $count ); ?></strong>
			<?php 
			}
			else {
				?>
				<strong class="cart-count"><?php esc_html_e('0','atua'); ?></strong>
				<?php 
			}
	?>
	<?php
 
    $fragments['.cart-count'] = ob_get_clean();
     
    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'atua_woo_add_to_cart_fragment' );

/*=========================================
Atua Site Logo
=========================================*/
if ( ! function_exists( 'atua_site_logo' ) ) :
function atua_site_logo() {
		if(has_custom_logo())
			{	
				the_custom_logo();
			}
			else { 
			?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site--title">
				<h4 class="site-title">
					<?php 
						echo esc_html(get_bloginfo('name'));
					?>
				</h4>
			</a>	
		<?php 						
			}
		?>
		<?php
			$atua_description = get_bloginfo( 'description');
			if ($atua_description) : ?>
				<p class="site-description"><?php echo esc_html($atua_description); ?></p>
		<?php endif;
	} 
endif;
add_action( 'atua_site_logo', 'atua_site_logo' );

/*=========================================
Atua Footer Widget
=========================================*/
if ( ! function_exists( 'atua_footer_widget' ) ) :
function atua_footer_widget() {
	?>
	<div class="dt_footer_middle">
		<div class="dt-container">
			<div class="dt-row dt-g-lg-4 dt-g-5">
				<?php if ( is_active_sidebar( 'atua-footer-widget-1' ) ) : ?>
					<div class="dt-col-lg-3 dt-col-sm-6 dt-col-12 wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
						<?php dynamic_sidebar( 'atua-footer-widget-1'); ?>
					</div>
				<?php endif; ?>
				
				<?php if ( is_active_sidebar( 'atua-footer-widget-2' ) ) : ?>
					<div class="dt-col-lg-3 dt-col-sm-6 dt-col-12 wow fadeInUp animated" data-wow-delay="100ms" data-wow-duration="1500ms">
						<?php dynamic_sidebar( 'atua-footer-widget-2'); ?>
					</div>
				<?php endif; ?>
				
				<?php if ( is_active_sidebar( 'atua-footer-widget-3' ) ) : ?>
					<div class="dt-col-lg-3 dt-col-sm-6 dt-col-12 wow fadeInUp animated" data-wow-delay="200ms" data-wow-duration="1500ms">
						<?php dynamic_sidebar( 'atua-footer-widget-3'); ?>
					</div>
				<?php endif; ?>
				
				<?php if ( is_active_sidebar( 'atua-footer-widget-4' ) ) : ?>
					<div class="dt-col-lg-3 dt-col-sm-6 dt-col-12 wow fadeInUp animated" data-wow-delay="300ms" data-wow-duration="1500ms">
						<?php dynamic_sidebar( 'atua-footer-widget-4'); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php 
	 } 
endif;
add_action( 'atua_footer_widget', 'atua_footer_widget' );


/*=========================================
Atua Footer Bottom
=========================================*/
if ( ! function_exists( 'atua_footer_bottom' ) ) :
function atua_footer_bottom() {
	?>
	<div class="dt_footer_copyright">
		<div class="dt-container">
			<div class="dt-row dt-g-4 dt-mt-0">
				<div class="dt-col-md-12 dt-col-sm-12 dt-text-sm-center dt-text-center">
					<?php do_action('atua_footer_copyright_data'); ?>
				</div>
			</div>
		</div>
	</div>
	<?php
	} 
endif;
add_action( 'atua_footer_bottom', 'atua_footer_bottom' );

/*=========================================
Atua Footer Copyright
=========================================*/
if ( ! function_exists( 'atua_footer_copyright_data' ) ) :
function atua_footer_copyright_data() {
	$atua_footer_copyright_text = get_theme_mod('atua_footer_copyright_text','Copyright &copy; [current_year] [site_title] | Powered by [theme_author]');
	?>
	<?php if(!empty($atua_footer_copyright_text)): 
			$atua_copyright_allowed_tags = array(
				'[current_year]' => date_i18n('Y'),
				'[site_title]'   => get_bloginfo('name'),
				'[theme_author]' => sprintf(__('<a href="#">Desert Themes</a>', 'atua')),
			);
	?>
		<div class="dt_footer_copyright-text">
			<?php
				echo apply_filters('atua_footer_copyright', wp_kses_post(atua_str_replace_assoc($atua_copyright_allowed_tags, $atua_footer_copyright_text)));
			?>
		</div>
<?php endif;
	} 
endif;
add_action( 'atua_footer_copyright_data', 'atua_footer_copyright_data' );


/*=========================================
Atua Scroller
=========================================*/
if ( ! function_exists( 'atua_top_scroller' ) ) :
function atua_top_scroller() {
	$atua_hs_scroller_option	=	get_theme_mod('atua_hs_scroller_option','1');
?>		
	<?php if ($atua_hs_scroller_option == '1') { ?>
		<button type="button" id="dt_uptop" class="dt_uptop">
			<svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
				<path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: -0.0171453;"></path>
			</svg>
		</button>
	<?php }
	} 
endif;
add_action( 'atua_top_scroller', 'atua_top_scroller' );