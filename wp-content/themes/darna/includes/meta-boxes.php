<?php
/*
*
*	Meta Box Functions
*	------------------------------------------------
*	G5Plus Framework
* 	Copyright Swift Ideas 2015 - http://www.g5plus.net
*
*/
global $meta_boxes;

/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function g5plus_register_meta_boxes()
{
	global $meta_boxes;
	$prefix = 'g5plus_';
	/* PAGE MENU */
	$menu_list = array();
	if ( function_exists( 'g5plus_get_menu_list' ) ) {
		$menu_list = g5plus_get_menu_list();
	}

// POST FORMAT: Image
//--------------------------------------------------
	$meta_boxes[] = array(
		'title' => esc_html__('Post Format: Image', 'g5plus-darna'),
		'id' => $prefix .'meta_box_post_format_image',
		'pages' => array('post'),
		'format' => 'post-format',
		'fields' => array(
			array(
				'name' => esc_html__('Image', 'g5plus-darna'),
				'id' => $prefix . 'post_format_image',
				'type' => 'image_advanced',
				'max_file_uploads' => 1,
				'desc' => esc_html__('Select a image for post','g5plus-darna')
			),
		),
	);

// POST FORMAT: Gallery
//--------------------------------------------------
	$meta_boxes[] = array(
		'title' => esc_html__('Post Format: Gallery', 'g5plus-darna'),
		'format' => 'post-format',
		'id' => $prefix . 'meta_box_post_format_gallery',
		'pages' => array('post'),
		'fields' => array(
			array(
				'name' => esc_html__('Images', 'g5plus-darna'),
				'id' => $prefix . 'post_format_gallery',
				'type' => 'image_advanced',
				'desc' => esc_html__('Select images gallery for post','g5plus-darna')
			),
		),
	);

// POST FORMAT: Video
//--------------------------------------------------
	$meta_boxes[] = array(
		'title' => esc_html__('Post Format: Video', 'g5plus-darna'),
		'format' => 'post-format',
		'id' => $prefix . 'meta_box_post_format_video',
		'pages' => array('post'),
		'fields' => array(
			array(
				'name' => esc_html__( 'Video URL or Embeded Code', 'g5plus-darna' ),
				'id'   => $prefix . 'post_format_video',
				'type' => 'textarea',
			),
		),
	);

// POST FORMAT: Audio
//--------------------------------------------------
	$meta_boxes[] = array(
		'title' => esc_html__('Post Format: Audio', 'g5plus-darna'),
		'format' => 'post-format',
		'id' => $prefix . 'meta_box_post_format_audio',
		'pages' => array('post'),
		'fields' => array(
			array(
				'name' => esc_html__( 'Audio URL or Embeded Code', 'g5plus-darna' ),
				'id'   => $prefix . 'post_format_audio',
				'type' => 'textarea',
			),
		),
	);

// POST FORMAT: QUOTE
//--------------------------------------------------
    $meta_boxes[] = array(
        'title' => esc_html__('Post Format: Quote', 'g5plus-darna'),
        'format' => 'post-format',
        'id' => $prefix . 'meta_box_post_format_quote',
        'pages' => array('post'),
        'fields' => array(
            array(
                'name' => esc_html__( 'Quote', 'g5plus-darna' ),
                'id'   => $prefix . 'post_format_quote',
                'type' => 'textarea',
            ),
            array(
                'name' => esc_html__( 'Author', 'g5plus-darna' ),
                'id'   => $prefix . 'post_format_quote_author',
                'type' => 'text',
            ),
            array(
                'name' => esc_html__( 'Author Url', 'g5plus-darna' ),
                'id'   => $prefix . 'post_format_quote_author_url',
                'type' => 'url',
            ),
        ),
    );
    // POST FORMAT: LINK
//--------------------------------------------------
    $meta_boxes[] = array(
        'title' => esc_html__('Post Format: Link', 'g5plus-darna'),
        'format' => 'post-format',
        'id' => $prefix . 'meta_box_post_format_link',
        'pages' => array('post'),
        'fields' => array(
            array(
                'name' => esc_html__( 'Url', 'g5plus-darna' ),
                'id'   => $prefix . 'post_format_link_url',
                'type' => 'url',
            ),
            array(
                'name' => esc_html__( 'Text', 'g5plus-darna' ),
                'id'   => $prefix . 'post_format_link_text',
                'type' => 'text',
            ),
        ),
    );
//GALLERY
    $meta_boxes[] = array(
        'id' => $prefix . 'serives_gallery_meta_box',
        'title' => esc_html__('Gallery', 'g5plus-darna'),
        'pages' => array('services'),
        'fields' => array(
            array(
                'name' => esc_html__('Images', 'g5plus-darna'),
                'id' => $prefix . 'services_gallery',
                'type' => 'image_advanced',
                'desc' => esc_html__('Select images gallery for post','g5plus-darna')
            ),
        )
    );
// PAGE TITLE
//--------------------------------------------------
	$meta_boxes[] = array(
		'id' => $prefix . 'page_title_meta_box',
		'title' => esc_html__('Page Title', 'g5plus-darna'),
		'pages' => array('post', 'page', 'portfolio', 'services'),
		'fields' => array(
			array(
				'name'  => esc_html__( 'Show/Hide Page Title?', 'g5plus-darna' ),
				'id'    => $prefix . 'show_page_title',
				'type'  => 'button_set',
				'std'	=> '-1',
				'options' => array(
					'-1'	=> esc_html__('Default','g5plus-darna'),
					'1'	=> esc_html__('Show Page Title','g5plus-darna'),
					'0'	=> esc_html__('Hide Page Title','g5plus-darna'),
				)

			),

			// PAGE TITLE LINE 1
			array(
				'name' => esc_html__('Custom Page Title', 'g5plus-darna'),
				'id' => $prefix . 'page_title_custom',
				'desc' => esc_html__("Enter a custom page title if you'd like.", 'g5plus-darna'),
				'type'  => 'text',
				'std' => '',
                'required-field' => array($prefix . 'show_page_title','<>','0'),
			),

			// PAGE TITLE TEXT COLOR
			array(
				'name' => esc_html__('Page Title Text Color', 'g5plus-darna'),
				'id' => $prefix . 'page_title_text_color',
				'desc' => esc_html__("Optionally set a text color for the page title.", 'g5plus-darna'),
				'type'  => 'color',
				'std' => '',
                'required-field' => array($prefix . 'show_page_title','<>','0'),
			),

			// PAGE TITLE BACKGROUND COLOR
			array(
				'name' => esc_html__('Page Title Background Color', 'g5plus-darna'),
				'id' => $prefix . 'page_title_bg_color',
				'desc' => esc_html__("Optionally set a background color for the page title.", 'g5plus-darna'),
				'type'  => 'color',
				'std' => '',
                'required-field' => array($prefix . 'show_page_title','<>','0'),
			),

			// BACKGROUND IMAGE
			array(
				'id'    => $prefix.  'page_title_bg_image',
				'name'  => esc_html__('Background Image', 'g5plus-darna'),
				'desc'  => esc_html__('Background Image for page title.', 'g5plus-darna'),
				'type'  => 'image_advanced',
				'max_file_uploads' => 1,
                'required-field' => array($prefix . 'show_page_title','<>','0'),
			),

			// PAGE TITLE OVERLAY COLOR
			array(
				'id'   => $prefix. 'page_title_overlay_color',
				'name' => esc_html__( 'Page Title Overlay Color', 'g5plus-darna' ),
				'desc' => esc_html__( "Set an overlay color for page title image.", 'g5plus-darna' ),
				'type' => 'color',
				'std'  => '',
                'required-field' => array($prefix . 'show_page_title','<>','0'),
			),

			array(
				'name'  => esc_html__( 'Custom Overlay Opacity?', 'g5plus-darna' ),
				'id'    => $prefix . 'enable_custom_overlay_opacity',
				'type'  => 'checkbox',
				'std'	=> 0,
                'required-field' => array($prefix . 'show_page_title','<>','0'),
			),


			// Overlay Opacity Value
			array(
				'name'       => esc_html__( 'Overlay Opacity', 'g5plus-darna' ),
				'id'         => $prefix .'page_title_overlay_opacity',
				'desc'       => esc_html__( 'Set the opacity level of the overlay. This will lighten or darken the image depening on the color selected.', 'g5plus-darna' ),
				'clone'      => false,
				'type'       => 'slider',
				'prefix'     => '',
				'js_options' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'required-field' => array($prefix . 'enable_custom_overlay_opacity','=','1'),
			),

			// PAGE TITLE Height
			array(
				'name' => esc_html__('Page Title Height', 'g5plus-darna'),
				'id' => $prefix . 'page_title_height',
				'desc' => esc_html__("Enter a page title height value (not include unit).", 'g5plus-darna'),
				'type'  => 'number',
				'std' => '',
                'required-field' => array($prefix . 'show_page_title','<>','0'),
			),
			// Breadcrumbs in Page Title
			array(
				'name' => esc_html__('Breadcrumbs in Page Title', 'g5plus-darna'),
				'id' => $prefix . 'breadcrumbs_in_page_title',
				'desc' => esc_html__("Show/Hide Breadcrumbs in Page Title", 'g5plus-darna'),
				'type'  => 'button_set',
				'options'	=> array(
					'-1' => esc_html__('Default','g5plus-darna'),
					'1' => esc_html__('Show Breadcrumbs','g5plus-darna'),
					'0' => esc_html__('Hide Breadcrumbs','g5plus-darna'),
				),
				'std' => '-1',
                'required-field' => array($prefix . 'show_page_title','<>','0'),
			),
            array(
                'name'  => esc_html__( 'Remove Margin Bottom', 'g5plus-darna' ),
                'id'    => $prefix . 'page_title_remove_margin_bottom',
                'type'  => 'checkbox',
                'std'	=> 0,
                'required-field' => array($prefix . 'show_page_title','<>','0')
            ),
		)
	);

// PAGE HEADER
//--------------------------------------------------
	$meta_boxes[] = array(
		'id' => $prefix . 'page_header_meta_box',
		'title' => esc_html__('Page Header', 'g5plus-darna'),
		'pages' => array('post', 'page', 'portfolio', 'services'),
		'fields' => array(
			array(
				'name'  => esc_html__( 'Page Menu', 'g5plus-darna' ),
				'id'    => $prefix . 'page_menu',
				'type'  => 'select_advanced',
				'options' => $menu_list,
				'placeholder' => esc_html__('Select Menu','g5plus-darna'),
				'std'	=> '',
				'multiple' => false,
				'desc' => esc_html__('Optionally you can choose to override the menu that is used on the page', 'g5plus-darna'),
			),

			array(
				'name'  => esc_html__( 'Is One Page', 'g5plus-darna' ),
				'id'    => $prefix . 'is_one_page',
				'type'  => 'checkbox',
				'std'	=> 0,
				'desc' => esc_html__('Set page style is One Page', 'g5plus-darna'),
			),

			array (
				'name' 	=> esc_html__('Show/Hide Top Bar', 'g5plus-darna'),
				'id' 	=> $prefix . 'top_bar',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => esc_html__('Default','g5plus-darna'),
					'1' => esc_html__('Show Top Bar','g5plus-darna'),
					'0' => esc_html__('Hide Top Bar','g5plus-darna')
				),
				'desc' => esc_html__('Show Hide Top Bar.', 'g5plus-darna'),
			),

			array (
				'name' 	=> esc_html__('Top Bar Layout', 'g5plus-darna'),
				'id' 	=> $prefix . 'top_bar_layout',
				'type' 	=> 'image_set',
				'allowClear' => true,
				'width' => '80px',
				'std' 	=> '',
				'options' => array(
					'top-bar-1' => THEME_URL.'/assets/images/theme-options/top-bar-layout-1.jpg',
					'top-bar-2' => THEME_URL.'/assets/images/theme-options/top-bar-layout-2.jpg',
					'top-bar-3' => THEME_URL.'/assets/images/theme-options/top-bar-layout-3.jpg',
					'top-bar-4' => THEME_URL.'/assets/images/theme-options/top-bar-layout-4.jpg',
				),
				'required-field' => array($prefix . 'top_bar','<>','0'),
			),

			array (
				'name' 	=> esc_html__('Top Left Sidebar', 'g5plus-darna'),
				'id' 	=> $prefix . 'top_left_sidebar',
				'type' 	=> 'sidebars',
				'std' 	=> '',
				'placeholder' => esc_html__('Select Sidebar','g5plus-darna'),
                'required-field' => array($prefix . 'top_bar','<>','0'),
			),

			array (
				'name' 	=> esc_html__('Top Right Sidebar', 'g5plus-darna'),
				'id' 	=> $prefix . 'top_right_sidebar',
				'type' 	=> 'sidebars',
				'std' 	=> '',
				'placeholder' => esc_html__('Select Sidebar','g5plus-darna'),
                'required-field' => array($prefix . 'top_bar','<>','0'),
			),

			array (
				'name' 	=> esc_html__('Show/Hide Header', 'g5plus-darna'),
				'id' 	=> $prefix . 'header_show_hide',
				'type' 	=> 'button_set',
				'std' 	=> '1',
				'options' => array(
					'1' => esc_html__('Show Header','g5plus-darna'),
					'0' => esc_html__('Hide Header','g5plus-darna')
				),
				'desc' => esc_html__('Show/hide header', 'g5plus-darna'),
			),

			array (
				'name' 	=> esc_html__('Header Layout', 'g5plus-darna'),
				'id' 	=> $prefix . 'header_layout',
				'type'  => 'image_set',
				'allowClear' => true,
				'std'	=> '',
				'options' => array(
					'header-1'	    => THEME_URL.'/assets/images/theme-options/header-1.jpg',
					'header-2'	    => THEME_URL.'/assets/images/theme-options/header-2.jpg',
					'header-3'	    => THEME_URL.'/assets/images/theme-options/header-3.jpg',
					'header-4'	    => THEME_URL.'/assets/images/theme-options/header-4.jpg',
					'header-5'	    => THEME_URL.'/assets/images/theme-options/header-5.jpg',
				),
			),

			array(
				'name'  => esc_html__( 'Set header customize?', 'g5plus-darna' ),
				'id'    => $prefix . 'enable_header_customize',
				'type'  => 'checkbox',
				'std'	=> 0,
			),

			array (
				'name' 	=> esc_html__('Header Customize', 'g5plus-darna'),
				'id' 	=> $prefix . 'header_customize',
				'type' 	=> 'sorter',
				'std' 	=> '',
				'desc'  => esc_html__('Select element for header customize. Drag to change element order', 'g5plus-darna'),
				'options' => array(
					'get-a-quote' => 'Get a quote',
					'shopping-cart'   => 'Shopping Cart',
					'search' => 'Search Box',
					'custom-text' => 'Custom Text',
				),
				'required-field' => array($prefix . 'enable_header_customize','=','1'),
			),

			array(
				'name'  => esc_html__( 'Custom text content?', 'g5plus-darna' ),
				'id'    => $prefix . 'header_customize_text',
				'type'  => 'textarea',
				'std'	=> '',
				'required-field' => array($prefix . 'enable_header_customize','=','1'),
			),
			array(
				'name'  => esc_html__( 'Get a quote shortcode', 'g5plus-darna' ),
				'id'    => $prefix . 'header_get_a_quote_shortcode',
				'type'  => 'text',
				'desc'  => esc_html__('Set shortcode for popup content. Blank to default (mail chimp shortcode: mc4wp_form)', 'g5plus-darna'),
				'std'	=> '',
				'required-field' => array($prefix . 'enable_header_customize','=','1'),
			),

			array (
				'name' 	=> esc_html__('Header Sticky', 'g5plus-darna'),
				'id' 	=> $prefix . 'header_sticky',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => esc_html__('Default','g5plus-darna'),
					'1' => esc_html__('Enable Header Sticky','g5plus-darna'),
					'0' => esc_html__('Disable Header Sticky','g5plus-darna'),
				),
			),

			array (
				'name' 	=> esc_html__('Mobile Header Search Box', 'g5plus-darna'),
				'id' 	=> $prefix . 'mobile_header_search_box',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => esc_html__('Default','g5plus-darna'),
					'1' => esc_html__('Show','g5plus-darna'),
					'0' => esc_html__('Hide','g5plus-darna')
				),
			),

			array (
				'name' 	=> esc_html__('Mobile Header Shopping Cart', 'g5plus-darna'),
				'id' 	=> $prefix . 'mobile_header_shopping_cart',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => esc_html__('Default','g5plus-darna'),
					'1' => esc_html__('Show','g5plus-darna'),
					'0' => esc_html__('Hide','g5plus-darna')
				),
			),

			array(
				'id'    => $prefix.  'custom_logo',
				'name'  => esc_html__('Custom Logo', 'g5plus-darna'),
				'desc'  => esc_html__('Upload custom logo in header.', 'g5plus-darna'),
				'type'  => 'image_advanced',
				'max_file_uploads' => 1,
			),

		)
	);


// PAGE FOOTER
//--------------------------------------------------
	$meta_boxes[] = array(
		'id' => $prefix . 'page_footer_meta_box',
		'title' => esc_html__('Page Footer', 'g5plus-darna'),
		'pages' => array('post', 'page', 'portfolio', 'services'),
		'fields' => array(
			array (
				'name' 	=> esc_html__('Show/Hide Footer', 'g5plus-darna'),
				'id' 	=> $prefix . 'footer_show_hide',
				'type' 	=> 'button_set',
				'std' 	=> '1',
				'options' => array(
					'1' => esc_html__('Show Footer','g5plus-darna'),
					'0' => esc_html__('Hide Footer','g5plus-darna')
				),
				'desc' => esc_html__('Show/hide footer', 'g5plus-darna'),
			),

			array (
				'name' 	=> esc_html__('Footer Layout', 'g5plus-darna'),
				'id' 	=> $prefix . 'footer_layout',
				'type' 	=> 'image_set',
				'allowClear' => true,
				'width' => '80px',
				'std' 	=> '',
				'options' => array(
					'footer-1' => THEME_URL.'/assets/images/theme-options/footer-layout-1.jpg',
					'footer-2' => THEME_URL.'/assets/images/theme-options/footer-layout-2.jpg',
					'footer-3' => THEME_URL.'/assets/images/theme-options/footer-layout-3.jpg',
					'footer-4' => THEME_URL.'/assets/images/theme-options/footer-layout-4.jpg',
					'footer-5' => THEME_URL.'/assets/images/theme-options/footer-layout-5.jpg',
					'footer-6' => THEME_URL.'/assets/images/theme-options/footer-layout-6.jpg',
					'footer-7' => THEME_URL.'/assets/images/theme-options/footer-layout-7.jpg',
					'footer-8' => THEME_URL.'/assets/images/theme-options/footer-layout-8.jpg',
					'footer-9' => THEME_URL.'/assets/images/theme-options/footer-layout-9.jpg',
				),
				'desc' => esc_html__('Select Footer Layout (Not set to default).', 'g5plus-darna'),
			),

			array (
				'name' 	=> esc_html__('Show/Hide Bottom Bar', 'g5plus-darna'),
				'id' 	=> $prefix . 'bottom_bar',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => 'Default',
					'1' => 'Show Bottom Bar',
					'0' => 'Hide Bottom Bar'
				),
				'desc' => esc_html__('Show Hide Bottom Bar.', 'g5plus-darna'),
			),

			array (
				'name' 	=> esc_html__('Bottom Bar Layout', 'g5plus-darna'),
				'id' 	=> $prefix . 'bottom_bar_layout',
				'type' 	=> 'image_set',
				'allowClear' => true,
				'width' => '80px',
				'std' 	=> '',
				'options' => array(
					'bottom-bar-1' => THEME_URL.'/assets/images/theme-options/bottom-bar-layout-1.jpg',
					'bottom-bar-2' => THEME_URL.'/assets/images/theme-options/bottom-bar-layout-2.jpg',
					'bottom-bar-3' => THEME_URL.'/assets/images/theme-options/bottom-bar-layout-3.jpg',
					'bottom-bar-4' => THEME_URL.'/assets/images/theme-options/bottom-bar-layout-4.jpg',
				),
				'desc' => esc_html__('Bottom bar layout.', 'g5plus-darna'),
				'required-field' => array($prefix . 'bottom_bar','<>','0'),
			),

			array (
				'name' 	=> esc_html__('Bottom Bar Left Sidebar', 'g5plus-darna'),
				'id' 	=> $prefix . 'bottom_bar_left_sidebar',
				'type' 	=> 'sidebars',
				'placeholder' => esc_html__('Select Sidebar','g5plus-darna'),
				'std' 	=> '',
                'required-field' => array($prefix . 'bottom_bar','<>','0'),
			),

			array (
				'name' 	=> esc_html__('Bottom Bar Right Sidebar', 'g5plus-darna'),
				'id' 	=> $prefix . 'bottom_bar_right_sidebar',
				'type' 	=> 'sidebars',
				'placeholder' => esc_html__('Select Sidebar','g5plus-darna'),
				'std' 	=> '',
                'required-field' => array($prefix . 'bottom_bar','<>','0'),
			),

		)
	);

// PAGE LAYOUT
	$meta_boxes[] = array(
		'id' => $prefix . 'page_layout_meta_box',
		'title' => esc_html__('Page Layout', 'g5plus-darna'),
		'pages' => array('post', 'page',  'services'),
		'fields' => array(
			array(
				'name'  => esc_html__( 'Layout Style', 'g5plus-darna' ),
				'id'    => $prefix . 'layout_style',
				'type'  => 'button_set',
				'options' => array(
					'-1' => esc_html__('Default','g5plus-darna'),
					'boxed'	  => esc_html__('Boxed','g5plus-darna'),
					'wide'	  => esc_html__('Wide','g5plus-darna')
				),
				'std'	=> '-1',
				'multiple' => false,
			),
			array(
				'name'  => esc_html__( 'Page Layout', 'g5plus-darna' ),
				'id'    => $prefix . 'page_layout',
				'type'  => 'button_set',
				'options' => array(
					'-1' => esc_html__('Default','g5plus-darna'),
					'full'	  => esc_html__('Full Width','g5plus-darna'),
					'container'	  => esc_html__('Container','g5plus-darna'),
					'container-fluid'	  => esc_html__('Container Fluid','g5plus-darna'),
				),
				'std'	=> '-1',
				'multiple' => false,
			),
			array(
				'name'  => esc_html__( 'Page Sidebar', 'g5plus-darna' ),
				'id'    => $prefix . 'page_sidebar',
				'type'  => 'image_set',
				'allowClear' => true,
				'options' => array(
					'none'	  => THEME_URL.'/assets/images/theme-options/sidebar-none.png',
					'left'	  => THEME_URL.'/assets/images/theme-options/sidebar-left.png',
					'right'	  => THEME_URL.'/assets/images/theme-options/sidebar-right.png',
					'both'	  => THEME_URL.'/assets/images/theme-options/sidebar-both.png'
				),
				'std'	=> '',
				'multiple' => false,

			),
			array (
				'name' 	=> esc_html__('Left Sidebar', 'g5plus-darna'),
				'id' 	=> $prefix . 'page_left_sidebar',
				'placeholder' => esc_html__('Select Sidebar','g5plus-darna'),
				'type' 	=> 'sidebars',
				'std' 	=> '',
                'required-field' => array($prefix . 'page_sidebar','=',array('','left','both')),
			),

			array (
				'name' 	=> esc_html__('Right Sidebar', 'g5plus-darna'),
				'id' 	=> $prefix . 'page_right_sidebar',
				'type' 	=> 'sidebars',
				'placeholder' => esc_html__('Select Sidebar','g5plus-darna'),
				'std' 	=> '',
                'required-field' => array($prefix . 'page_sidebar','=',array('','right','both')),
			),

			array(
				'name'  => esc_html__( 'Sidebar Width', 'g5plus-darna' ),
				'id'    => $prefix . 'sidebar_width',
				'type'  => 'button_set',
				'options' => array(
					'-1'		=> esc_html__('Default','g5plus-darna'),
					'small'		=> esc_html__('Small (1/4)','g5plus-darna'),
					'larger'	=> esc_html__('Large (1/3)','g5plus-darna')
				),
				'std'	=> '-1',
				'multiple' => false,
                'required-field' => array($prefix . 'page_sidebar','<>','none'),
			),

			array (
				'name' 	=> esc_html__('Page Class Extra', 'g5plus-darna'),
				'id' 	=> $prefix . 'page_class_extra',
				'type' 	=> 'text',
				'std' 	=> ''
			),
		)
	);

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if (class_exists('RW_Meta_Box')) {
		foreach ($meta_boxes as $meta_box) {
			new RW_Meta_Box($meta_box);
		}
	}
}

// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action('admin_init', 'g5plus_register_meta_boxes');
