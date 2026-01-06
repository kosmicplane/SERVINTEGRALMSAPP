<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Corpex
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function corpex_body_classes( $classes ) {
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
add_filter( 'body_class', 'corpex_body_classes' );



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

if (!function_exists('corpex_str_replace_assoc')) {

    /**
     * corpex_str_replace_assoc
     * @param  array $replace
     * @param  array $subject
     * @return array
     */
    function corpex_str_replace_assoc(array $replace, $subject) {
        return str_replace(array_keys($replace), array_values($replace), $subject);
    }
}

// Corpex Navigation
if ( ! function_exists( 'corpex_primary_navigation' ) ) :
function corpex_primary_navigation() {
	wp_nav_menu( 
		array(  
			'theme_location' => 'primary_menu',
			'container'  => '',
			'menu_class' => 'navbar-nav ms-auto mb-2 mb-lg-0',
			'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
			'walker' => new WP_Bootstrap_Navwalker()
			 ) 
		);
	} 
endif;
add_action( 'corpex_primary_navigation', 'corpex_primary_navigation' );



// Corpex Navigation Cart
if ( ! function_exists( 'corpex_navigation_cart' ) ) :
function corpex_navigation_cart() {
	$hide_show_cart 	= get_theme_mod( 'hide_show_cart','1'); 
		if($hide_show_cart=='1' && class_exists( 'Woocommerce' )):	
	?>
	<li class="cart-wrapper">
            <button type="button" class="cart-icon-wrap header-cart">
				<i class="fas fa-shopping-cart"></i>
				<?php 
					if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
						$count = WC()->cart->cart_contents_count;
						$cart_url = wc_get_cart_url();
						
						if ( $count > 0 ) {
						?>
							<span class="cart-badge count"><?php echo esc_html( $count ); ?></span>
						<?php 
						}
						else {
							?>
							<span class="cart-badge count"><?php echo esc_html_e('0','corpex'); ?></span>
							<?php 
						}
					}
				?>
			</button>
			<div class="shopping-cart">
				<?php get_template_part('woocommerce/cart/mini','cart'); ?>
			</div>
			<!-- Shopping Cart End -->
		</li>
	<?php endif; 
	} 
endif;
add_action( 'corpex_navigation_cart', 'corpex_navigation_cart' );



// Corpex Logo
if ( ! function_exists( 'corpex_logo_content' ) ) :
function corpex_logo_content() {
		if(has_custom_logo())
			{	
				the_custom_logo();
			} 
			
			$corpex_site_title = get_bloginfo( 'name');
			if ($corpex_site_title) :
		?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<h4 class="site-title">
					<?php echo esc_html($corpex_site_title);  ?>
				</h4>	
			</a>
		<?php endif; ?>
		<?php
			$corpex_site_desc = get_bloginfo( 'description');
			if ($corpex_site_desc) : ?>
				<p class="site-description"><?php echo esc_html($corpex_site_desc); ?></p>
		<?php endif;
	} 
endif;
add_action( 'corpex_logo_content', 'corpex_logo_content' );



 /**
 * Add WooCommerce Cart Icon With Cart Count (https://isabelcastillo.com/woocommerce-cart-icon-count-theme-header)
 */
function corpex_add_to_cart_fragment( $fragments ) {
	
    ob_start();
    $count = WC()->cart->cart_contents_count; 
    ?> 
	<a href="javascript:void(0);" class="cart-icon-wrap" id="cart" title="<?php esc_attr_e('View your shopping cart','corpex'); ?>">
	<i class="fa fa-shopping-bag"></i>	
	<?php
    if ( $count > 0 ) { 
	?>
        <span><?php echo esc_html( $count ); ?></span>
	<?php            
    } else {
	?>	
	<span><?php echo esc_html_e('0','corpex'); ?></span>
	<?php
	}
    ?></a><?php
 
    $fragments['a.cart-icon-wrap'] = ob_get_clean();
     
    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'corpex_add_to_cart_fragment' );





/*******************************************************************************
 *  Get Started Notice
 *******************************************************************************/

add_action( 'wp_ajax_corpex_dismissed_notice_handler', 'corpex_ajax_notice_handler' );

/**
 * AJAX handler to store the state of dismissible notices.
 */
function corpex_ajax_notice_handler() {
	// Verify the nonce
    check_ajax_referer( 'corpex-ajax-nonce', 'nonce' );
	
    if ( isset( $_POST['type'] ) ) {
        // Pick up the notice "type" - passed via jQuery (the "data-notice" attribute on the notice)
        $type = sanitize_text_field( wp_unslash( $_POST['type'] ) );
        // Store it in the options table
        update_option( 'dismissed-' . $type, TRUE );
    }
	
	// Send a response (you can use wp_send_json_success() or wp_send_json_error())
    wp_send_json_success( 'Notice dismissed!' );
}

function corpex_deprecated_hook_admin_notice() {
        // Check if it's been dismissed...
        if ( ! get_option('dismissed-get_started', FALSE ) ) {
            // Added the class "notice-get-started-class" so jQuery pick it up and pass via AJAX,
            // and added "data-notice" attribute in order to track multiple / different notices
            // multiple dismissible notice states ?>
            <div class="updated notice notice-get-started-class is-dismissible" data-notice="get_started">
                <div class="corpex-getting-started-notice clearfix">
                    <div class="corpex-theme-screenshot">
                        <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/screenshot.jpg" class="screenshot" alt="<?php esc_attr_e( 'Theme Screenshot', 'corpex' ); ?>" />
                    </div><!-- /.corpex-theme-screenshot -->
                    <div class="corpex-theme-notice-content">
                        <h2 class="corpex-notice-h2">
                            <?php
                        printf(
                        /* translators: 1: welcome page link starting html tag, 2: welcome page link ending html tag. */
                            esc_html__( 'Welcome! Thank you for choosing %1$s!', 'corpex' ), '<strong>'. wp_get_theme()->get('Name'). '</strong>' );
                        ?>
                        </h2>

                        <p class="plugin-install-notice"><?php printf(__('Install and activate %1$sClever Fox%2$s plugin for taking full advantage of all the features this theme has to offer.', 'corpex'), '<strong>', '</strong>'); ?></p>

                        <?php
						$theme = wp_get_theme();
						$theme_name = esc_html($theme->get('Name'));
						$get_started_text = esc_html__('Get started with %s', 'corpex');
						?>
						<a class="corpex-btn-get-started button button-primary button-hero corpex-button-padding" href="#" data-name="" data-slug="">
							<?php printf('%s', sprintf($get_started_text, $theme_name)); ?>
						</a><span class="corpex-push-down">
						
                        <?php
                            /* translators: %1$s: Anchor link start %2$s: Anchor link end */
                            printf(
                                __('or %1$sCustomize theme%2$s</a></span>','corpex'),
                                '<a target="_blank" href="' . esc_url( admin_url( 'customize.php' ) ) . '">',
                                '</a>'
                            );
                        ?>
                    </div><!-- /.corpex-theme-notice-content -->
                </div>
            </div>
        <?php }
}

add_action( 'admin_notices', 'corpex_deprecated_hook_admin_notice' );

/*******************************************************************************
 *  Plugin Installer
 *******************************************************************************/

add_action( 'wp_ajax_install_act_plugin', 'corpex_admin_install_plugin' );

function corpex_admin_install_plugin() {
	 // Verify the nonce
    check_ajax_referer( 'corpex-ajax-nonce', 'nonce' );
	
    /**
     * Install Plugin.
     */
    include_once ABSPATH . '/wp-admin/includes/file.php';
    include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
    include_once ABSPATH . 'wp-admin/includes/plugin-install.php';

    if ( ! file_exists( WP_PLUGIN_DIR . '/clever-fox' ) ) {
        $api = plugins_api( 'plugin_information', array(
            'slug'   => sanitize_key( wp_unslash( 'clever-fox' ) ),
            'fields' => array(
                'sections' => false,
            ),
        ) );

        $skin     = new WP_Ajax_Upgrader_Skin();
        $upgrader = new Plugin_Upgrader( $skin );
        $result   = $upgrader->install( $api->download_link );
    }

    // Activate plugin.
    if ( current_user_can( 'activate_plugin' ) ) {
        $result = activate_plugin( 'clever-fox/clever-fox.php' );
    }
	
	 // Return a response if needed
    wp_send_json_success( 'Plugin installed successfully!' );
}


/**
 * This Function Check whether Sidebar active or Not
 */
if(!function_exists( 'corpex_blog_column_layout' )) :
function corpex_blog_column_layout(){
	if(is_active_sidebar('corpex-sidebar-primary'))
		{ echo 'col-lg-8'; } 
	else 
		{ echo 'col-lg-12'; }  
} endif;



// Corpex Footer Group Third
if ( ! function_exists( 'corpex_footer_group_third' ) ) :
function corpex_footer_group_third() {	
	$footer_third_custom 		= get_theme_mod('footer_third_custom','Copyright &copy; [current_year] | Powered by [theme_author]');
 	
				$corpex_copyright_allowed_tags = array(
					'[current_year]' => date_i18n('Y', current_time( 'timestamp' )),
					'[site_title]'   => get_bloginfo('name'),
					'[theme_author]' => sprintf(__('<a href="#">Corpex</a>', 'corpex')),
				);
			?>                        
				<p class="copyright-text">
					<?php
						echo apply_filters('corpex_footer_copyright', wp_kses_post(corpex_str_replace_assoc($corpex_copyright_allowed_tags, $footer_third_custom)));
					?>
				</p>
		
	<?php 
	} 
endif;	
add_action('corpex_footer_group_third','corpex_footer_group_third');

 
if ( ! function_exists( 'corpex_top_footer' ) ) {
	function corpex_top_footer() {
	$footer_client_contents	= get_theme_mod('footer_client_contents',corpex_get_footer_client_default());

			if ( ! empty( $footer_client_contents )) {
			$footer_client_contents = json_decode( $footer_client_contents );
		?>
			<div class="sponsors">
				<div class="container">
					<div class="slide-sponsor">
						<?php
							foreach ( $footer_client_contents as $client_item ) {
								$link = ! empty( $client_item->link ) ? apply_filters( 'corpex_translate_single_string', $client_item->link, 'Client section' ) : '';
								$image = ! empty( $client_item->image_url ) ? apply_filters( 'corpex_translate_single_string', $client_item->image_url, 'Client section' ) : '';
								
							if(!empty($image) || !empty($link)):
						?>
							<div class="sponsor">
								<div class="sponsor-image">
									<a href="<?php echo esc_url($link); ?>">
										<img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr__('Footer Clients Image','corpex'); ?>">
									</a>
								</div>
							</div>
						<?php 
							endif;
							} 
						?>
					</div>
				</div>
			</div>
		<?php } 
	}
}
add_action( 'corpex_top_footer', 'corpex_top_footer' );

/*
 *
 * Client Default
 */
function corpex_get_footer_client_default() {
	return apply_filters(
		'corpex_get_footer_client_default', json_encode(
			array(
				array(
					'image_url'     => esc_url(get_template_directory_uri() . '/assets/images/sponsor/image-1.png'),
					'link'       	=> '#',
					'id'            => 'customizer_repeater_footer_client_001',
				),
				array(
					'image_url'     => esc_url(get_template_directory_uri() . '/assets/images/sponsor/image-2.png'),
					'link'          => '#',
					'id'            => 'customizer_repeater_footer_client_002',				
				),
				array(
					'image_url'     => esc_url(get_template_directory_uri() . '/assets/images/sponsor/image-3.png'),
					'link'          => '#',
					'id'            => 'customizer_repeater_footer_client_003',
				),
				array(
					'image_url'     => esc_url(get_template_directory_uri() . '/assets/images/sponsor/image-4.png'),
					'link'       	=> '#',
					'id'            => 'customizer_repeater_footer_client_004',
				),
				array(
					'image_url'     => esc_url(get_template_directory_uri() . '/assets/images/sponsor/image-5.png'),
					'link'       	=> '#',
					'id'            => 'customizer_repeater_footer_client_005',
				)
			)
		)
	);
}