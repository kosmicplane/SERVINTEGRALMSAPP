<?php
if ( ! class_exists( 'Redux_Framework_options_config' ) ) {

    class Redux_Framework_options_config {

        public $args = array();
        public $sections = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {
            if ( ! class_exists( 'ReduxFramework' ) ) {
                return;
            }
            $this->initSettings();
        }

        public function initSettings() {
            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if ( ! isset( $this->args['opt_name'] ) ) { // No errors please
                return;
            }

            $this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
        }

        public function setSections() {

            $page_title_bg_url = THEME_URL . 'assets/images/bg-page-title.jpg';
            $page_404_bg_url = THEME_URL . 'assets/images/bg-404.jpg';
            $archive_title_bg_url = THEME_URL . 'assets/images/bg-archive-title.jpg';
            $archive_shop_title_bg_url = THEME_URL . 'assets/images/bg-shop-title.jpg';
            $portfolio_title_bg_url = THEME_URL . 'assets/images/bg-portfolio-title.jpg';


            // General Setting
            $this->sections[] = array(
                'title'  => esc_html__( 'General Setting', 'g5plus-darna' ),
                'desc'   => '',
                'icon'   => 'el el-wrench',
                'fields' => array(
                    array(
                        'id' => 'home_preloader',
                        'type' => 'select',
                        'title' => esc_html__('Home Preloader', 'g5plus-darna'),
                        'subtitle' => esc_html__('Enable/Disable Home Preloader', 'g5plus-darna'),
                        'desc' => '',
                        'options' => array(
                            'none'  => esc_html__('None','g5plus-darna') ,
                            'square-1'	=> esc_html__('Square 01','g5plus-darna'),
                            'square-2'	=> esc_html__('Square 02','g5plus-darna'),
                            'square-3'	=> esc_html__('Square 03','g5plus-darna'),
                            'square-4'	=> esc_html__('Square 04','g5plus-darna'),
                            'square-5'	=> esc_html__('Square 05','g5plus-darna'),
                            'square-6'	=> esc_html__('Square 06','g5plus-darna'),
                            'square-7'	=> esc_html__('Square 07','g5plus-darna'),
                            'square-8'	=> esc_html__('Square 08','g5plus-darna'),
                            'square-9'	=> esc_html__('Square 09','g5plus-darna'),
                            'round-1'	=> esc_html__('Round 01','g5plus-darna'),
                            'round-2'	=> esc_html__('Round 02','g5plus-darna'),
                            'round-3'	=> esc_html__('Round 03','g5plus-darna'),
                            'round-4'	=> esc_html__('Round 04','g5plus-darna'),
                            'round-5'	=> esc_html__('Round 05','g5plus-darna'),
                            'round-6'	=> esc_html__('Round 06','g5plus-darna'),
                            'round-7'	=> esc_html__('Round 07','g5plus-darna'),
                            'round-8'	=> esc_html__('Round 08','g5plus-darna'),
                            'round-9'	=> esc_html__('Round 09','g5plus-darna'),
                            'various-1'	=> esc_html__('Various 01','g5plus-darna'),
                            'various-2'	=> esc_html__('Various 02','g5plus-darna'),
                            'various-3'	=> esc_html__('Various 03','g5plus-darna'),
                            'various-4'	=> esc_html__('Various 04','g5plus-darna'),
                            'various-5'	=> esc_html__('Various 05','g5plus-darna'),
                            'various-6'	=> esc_html__('Various 06','g5plus-darna'),
                            'various-7'	=> esc_html__('Various 07','g5plus-darna'),
                            'various-8'	=> esc_html__('Various 08','g5plus-darna'),
                            'various-9'	=> esc_html__('Various 09','g5plus-darna'),
                            'various-10'	=> esc_html__('Various 10','g5plus-darna'),

                        ),
                        'default' => 'none'
                    ),

                    array(
                        'id'       => 'home_preloader_bg_color',
                        'type'     => 'color_rgba',
                        'title'    => esc_html__( 'Preloader background color', 'g5plus-darna' ),
                        'subtitle' => esc_html__( 'Set Preloader background color.', 'g5plus-darna' ),
                        'default'  => array(),
                        'mode'     => 'background',
                        'validate' => 'colorrgba',
                        'required'  => array('home_preloader', 'not_empty_and', array('none')),
                    ),

                    array(
                        'id'       => 'home_preloader_spinner_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Preloader spinner color', 'g5plus-darna'),
                        'subtitle' => esc_html__('Pick a preloader spinner color for the Top Bar', 'g5plus-darna'),
                        'default'  => '',
                        'validate' => 'color',
	                    'required'  => array('home_preloader', 'not_empty_and', array('none')),
                    ),

                    array(
                        'id' => 'custom_scroll',
                        'type' => 'button_set',
                        'title' => esc_html__('Custom Scroll', 'g5plus-darna'),
                        'subtitle' => esc_html__('Enable/Disable Custom Scroll', 'g5plus-darna'),
                        'desc' => '',
                        'options' => array(
                        	'1' => esc_html__('On','g5plus-darna') ,
	                        '0' => esc_html__('Off','g5plus-darna')
                        ),
                        'default' => '0'
                    ),

                    array(
                        'id'        => 'custom_scroll_width',
                        'type'      => 'text',
                        'title'     => esc_html__('Custom Scroll Width', 'g5plus-darna'),
                        'subtitle'  => esc_html__('This must be numeric (no px) or empty.', 'g5plus-darna'),
                        'validate'  => 'numeric',
                        'default'   => '10',
                        'required'  => array('custom_scroll', '=', array('1')),
                    ),

                    array(
                        'id'       => 'custom_scroll_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Custom Scroll Color', 'g5plus-darna'),
                        'subtitle' => esc_html__('Set Custom Scroll Color', 'g5plus-darna'),
                        'default'  => '#19394B',
                        'validate' => 'color',
                        'required'  => array('custom_scroll', '=', array('1')),
                    ),

                    array(
                        'id'       => 'custom_scroll_thumb_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Custom Scroll Thumb Color', 'g5plus-darna'),
                        'subtitle' => esc_html__('Set Custom Scroll Thumb Color', 'g5plus-darna'),
                        'default'  => '#e8aa00',
                        'validate' => 'color',
                        'required'  => array('custom_scroll', '=', array('1')),
                    ),

                    array(
                        'id' => 'back_to_top',
                        'type' => 'button_set',
                        'title' => esc_html__('Back To Top', 'g5plus-darna'),
                        'subtitle' => esc_html__('Enable/Disable Back to top button', 'g5plus-darna'),
                        'desc' => '',
                        'options' => array(
	                        '1' => esc_html__('On','g5plus-darna') ,
	                        '0' => esc_html__('Off','g5plus-darna')
                        ),
                        'default' => '1'
                    ),

	                array(
		                'id' => 'enable_rtl_mode',
		                'type' => 'button_set',
		                'title' => esc_html__('Enable RTL mode', 'g5plus-darna'),
		                'subtitle' => esc_html__('Enable/Disable RTL mode', 'g5plus-darna'),
		                'desc' => '',
		                'options' => array(
	                        '1' => esc_html__('On','g5plus-darna') ,
	                        '0' => esc_html__('Off','g5plus-darna')
                        ),
		                'default' => '0'
	                ),


	                array(
                        'id' => 'enable_social_meta',
                        'type' => 'button_set',
                        'title' => esc_html__('Enable Social Meta Tags', 'g5plus-darna'),
                        'subtitle' => esc_html__('Enable the social meta head tag output.', 'g5plus-darna'),
                        'desc' => '',
                        'options' => array(
                        	'1' => esc_html__('On','g5plus-darna') ,
	                        '0' => esc_html__('Off','g5plus-darna')
                        ),
                        'default' => '0'
                    ),

                    array(
                        'id' => 'twitter_author_username',
                        'type' => 'text',
                        'title' => esc_html__('Twitter Publisher Username', 'g5plus-darna'),
                        'subtitle' => esc_html__( 'Enter your twitter username here, to be used for the Twitter Card date. Ensure that you do not include the @ symbol.','g5plus-darna'),
                        'default' => '',
                        'required'  => array('enable_social_meta', '=', array('1')),
                    ),


                    array(
                        'id' => 'general_divide_2',
                        'type' => 'divide'
                    ),
                    array(
                        'id' => 'layout_style',
                        'type' => 'image_select',
                        'title' => esc_html__('Layout Style', 'g5plus-darna'),
                        'subtitle' => esc_html__('Select the layout style', 'g5plus-darna'),
                        'options' => array(
                            'boxed' => array('title' => 'Boxed', 'img' => THEME_URL.'/assets/images/theme-options/layout-boxed.png'),
                            'wide' => array('title' => 'Wide', 'img' => THEME_URL.'/assets/images/theme-options/layout-wide.png')
                        ),
                        'default' => 'wide'
                    ),


                    array(
                        'id' => 'body_background_mode',
                        'type' => 'button_set',
                        'title' => esc_html__('Body Background Mode', 'g5plus-darna'),
                        'subtitle' => esc_html__('Chose Background Mode', 'g5plus-darna'),
                        'options' => array('background' => 'Background','pattern' => 'Pattern'),
                        'default' => 'background',
                        'required' => array('layout_style', '=', array('boxed'))
                    ),

                    array(
                        'id'       => 'body_background',
                        'type'     => 'background',
                        'output'   => array( 'body' ),
                        'title'    => esc_html__( 'Body Background', 'g5plus-darna' ),
                        'subtitle' => esc_html__( 'Body background (Apply for Boxed layout style).', 'g5plus-darna' ),
                        'default'  => array(
                            'background-color' => '',
                            'background-repeat' => 'no-repeat',
                            'background-position' => 'center center',
                            'background-attachment' => 'fixed',
                            'background-size' => 'cover'
                        ),
                        'required'  => array(
                                array('layout_style', '=', array('boxed')),
                                array('body_background_mode', '=', array('background'))
                        ),
                    ),
                    array(
                        'id' => 'body_background_pattern',
                        'type' => 'image_select',
                        'title' => esc_html__('Background Pattern', 'g5plus-darna'),
                        'subtitle' => esc_html__('Body background pattern(Apply for Boxed layout style)', 'g5plus-darna'),
                        'desc' => '',
                        'height' => '40px',
                        'options' => array(
                            'pattern-1.png' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/pattern-1.png'),
                            'pattern-2.png' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/pattern-2.png'),
                            'pattern-3.png' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/pattern-3.png'),
                            'pattern-4.png' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/pattern-4.png'),
                            'pattern-5.png' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/pattern-5.png'),
                            'pattern-6.png' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/pattern-6.png'),
                            'pattern-7.png' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/pattern-7.png'),
                            'pattern-8.png' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/pattern-8.png'),
                        ),
                        'default' => 'pattern-1.png',
                        'required'  => array(
                                array('layout_style', '=', array('boxed')),
                                array('body_background_mode', '=', array('pattern'))
                            ) ,
                    ),
                )
            );

            $this->sections[] = array(
                'title' => esc_html__('Maintenance Mode', 'g5plus-darna'),
                'desc' => '',
                'subsection' => true,
                'icon' => 'el-icon-eye-close',
                'fields' => array(
                    array(
                        'id' => 'enable_maintenance',
                        'type' => 'button_set',
                        'title' => esc_html__('Enable Maintenance', 'g5plus-darna'),
                        'subtitle' => esc_html__('Enable the themes maintenance mode.', 'g5plus-darna'),
                        'desc' => '',
                        'options' => array(
                        	'2' => esc_html__('On (Custom Page)','g5plus-darna') ,
	                        '1' => esc_html__('On (Standard)','g5plus-darna') ,
	                        '0' => esc_html__('Off','g5plus-darna') ,
                        ),
                        'default' => '0'
                    ),
                    array(
                        'id' => 'maintenance_mode_page',
                        'type' => 'select',
                        'data' => 'pages',
                        'required'  => array('enable_maintenance', '=', '2'),
                        'title' => esc_html__('Custom Maintenance Mode Page', 'g5plus-darna'),
                        'subtitle' => esc_html__('Select the page that is your maintenace page, if you would like to show a custom page instead of the standard WordPress message. You should use the Holding Page template for this page.', 'g5plus-darna'),
                        'desc' => '',
                        'default' => '',
                        'args' => array()
                    ),
                ),
            );


            // Performance Options
            $this->sections[] = array(
                'title'  => esc_html__( 'Performance', 'g5plus-darna' ),
                'desc'   => '',
                'icon'   => 'el el-dashboard',
                'subsection' => true,
                'fields' => array(
                    array(
                        'id' => 'enable_minifile_js',
                        'type' => 'button_set',
                        'title' => esc_html__('Enable Mini File JS', 'g5plus-darna'),
                        'subtitle' => esc_html__('Enable/Disable Mini File JS', 'g5plus-darna'),
                        'desc' => '',
                        'options' => array(
                        	'1' => esc_html__('On','g5plus-darna') ,
	                        '0' => esc_html__('Off','g5plus-darna')
                        ),
                        'default' => '0'
                    ),
                    array(
                        'id' => 'enable_minifile_css',
                        'type' => 'button_set',
                        'title' => esc_html__('Enable Mini File CSS', 'g5plus-darna'),
                        'subtitle' => esc_html__('Enable/Disable Mini File CSS', 'g5plus-darna'),
                        'desc' => '',
                        'options' => array(
	                        '1' => esc_html__('On','g5plus-darna') ,
	                        '0' => esc_html__('Off','g5plus-darna')
                        ),
                        'default' => '0'
                    ),
                )
            );

            // Custom Favicon
            $this->sections[] = array(
                'title'  => esc_html__( 'Custom Favicon', 'g5plus-darna' ),
                'desc'   => '',
                'icon'   => 'el el-eye-open',
                'subsection' => true,
                'fields' => array(
                    array(
                        'id' => 'custom_favicon',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Custom favicon', 'g5plus-darna'),
                        'subtitle' => esc_html__('Upload a 16px x 16px Png/Gif/ico image that will represent your website favicon', 'g5plus-darna'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'custom_ios_title',
                        'type' => 'text',
                        'title' => esc_html__('Custom iOS Bookmark Title', 'g5plus-darna'),
                        'subtitle' => esc_html__('Enter a custom title for your site for when it is added as an iOS bookmark.', 'g5plus-darna'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'custom_ios_icon57',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Custom iOS 57x57', 'g5plus-darna'),
                        'subtitle' => esc_html__('Upload a 57px x 57px Png image that will be your website bookmark on non-retina iOS devices.', 'g5plus-darna'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'custom_ios_icon72',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Custom iOS 72x72', 'g5plus-darna'),
                        'subtitle' => esc_html__('Upload a 72px x 72px Png image that will be your website bookmark on non-retina iOS devices.', 'g5plus-darna'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'custom_ios_icon114',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Custom iOS 114x114', 'g5plus-darna'),
                        'subtitle' => esc_html__('Upload a 114px x 114px Png image that will be your website bookmark on retina iOS devices.', 'g5plus-darna'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'custom_ios_icon144',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Custom iOS 144x144', 'g5plus-darna'),
                        'subtitle' => esc_html__('Upload a 144px x 144px Png image that will be your website bookmark on retina iOS devices.', 'g5plus-darna'),
                        'desc' => ''
                    ),
                )
            );


            // 404
            $this->sections[] = array(
                'title'  => esc_html__( '404 Setting', 'g5plus-darna' ),
                'desc'   => '',
                'subsection' => true,
                'icon'   => 'el el-error',
                'fields' => array(
                    array(
                        'id' => 'page_404_bg_image',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Background page', 'g5plus-darna'),
                        'subtitle' => esc_html__('Upload your background image here.', 'g5plus-darna'),
                        'desc' => '',
                        'default' =>  array(
                            'url' => $page_404_bg_url
                        )
                    ),
                    array(
                        'id'        => 'subtitle_404',
                        'type'      => 'textarea',
                        'title'     => esc_html__('Subtitle 404', 'g5plus-darna'),
                        'default'   => '',
                    ),
                    array(
                        'id'       => 'copyright_404',
                        'type'     => 'textarea',
                        'title'    => esc_html__( 'Copyright', 'g5plus-darna' ),
                        'subtitle' => esc_html__( 'Display copyright below page 404 footer', 'g5plus-darna' ),
                        'default'  => esc_html__('© 2015 darna  is proudly powered by  G5Theme', 'g5plus-darna')
                    ),

                )
            );



            // Page/Archive Setting
            $this->sections[] = array(
                'title'  => esc_html__( 'Page/Archive Setting', 'g5plus-darna' ),
                'desc'   => '',
                'icon'   => 'el el-th',
                'fields' => array(
                    array(
                        'id' => 'section-page-start',
                        'type' => 'section',
                        'title' => esc_html__('Page Options', 'g5plus-darna'),
                        'indent' => true
                    ),

                    array(
                        'id' => 'page_layout',
                        'type' => 'button_set',
                        'title' => esc_html__('Layout', 'g5plus-darna'),
                        'subtitle' => esc_html__('Select Page Layout', 'g5plus-darna'),
                        'desc' => '',
                        'options' => array(
                        	'full' => esc_html__('Full Width','g5plus-darna') ,
	                        'container' => esc_html__('Container','g5plus-darna') ,
	                        'container-fluid' => esc_html__('Container Fluid','g5plus-darna') ,
                        ),
                        'default' => 'container'
                    ),
                    array(
                        'id' => 'page_sidebar',
                        'type' => 'image_select',
                        'title' => esc_html__('Sidebar', 'g5plus-darna'),
                        'subtitle' => esc_html__('Set Sidebar Style', 'g5plus-darna'),
                        'desc' => '',
                        'options' => array(
                            'none' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/sidebar-none.png'),
                            'left' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/sidebar-left.png'),
                            'right' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/sidebar-right.png'),
                            'both' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/sidebar-both.png'),
                        ),
                        'default' => 'right'
                    ),

                    array(
                        'id' => 'page_sidebar_width',
                        'type' => 'button_set',
                        'title' => esc_html__('Sidebar Width', 'g5plus-darna'),
                        'subtitle' => esc_html__('Set Sidebar width', 'g5plus-darna'),
                        'desc' => '',
                        'options' => array(
                        	'small' => esc_html__('Small (1/4)', 'g5plus-darna'),
	                        'large' => esc_html__('Large (1/3)', 'g5plus-darna'),
                        ),
                        'default' => 'small',
                        'required'  => array('page_sidebar', '=', array('left','both','right')),
                    ),



                    array(
                        'id' => 'page_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Left Sidebar', 'g5plus-darna'),
                        'subtitle' => esc_html__('Choose the default left sidebar','g5plus-darna'),
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'sidebar-1',
                        'required'  => array('page_sidebar', '=', array('left','both')),
                    ),
                    array(
                        'id' => 'page_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Right Sidebar', 'g5plus-darna'),
                        'subtitle' => esc_html__('Choose the default right sidebar','g5plus-darna'),
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'sidebar-2',
                        'required'  => array('page_sidebar', '=', array('right','both')),
                    ),

                    array(
                        'id' => 'breadcrumbs_in_page_title',
                        'type' => 'button_set',
                        'title' => esc_html__('Breadcrumbs', 'g5plus-darna'),
                        'subtitle' => esc_html__('Enable/Disable Breadcrumbs in Page Title', 'g5plus-darna'),
                        'desc' => '',
                        'options' => array(
                        	'1' => esc_html__('On','g5plus-darna') ,
	                        '0' => esc_html__('Off','g5plus-darna')
                        ),
                        'default' => '1'
                    ),
                    array(
                        'id' => 'show_page_title',
                        'type' => 'button_set',
                        'title' => esc_html__('Show Page Title', 'g5plus-darna'),
                        'subtitle' => esc_html__('Enable/Disable Page Title', 'g5plus-darna'),
                        'desc' => '',
                        'options' => array(
	                        '1' => esc_html__('On','g5plus-darna') ,
	                        '0' => esc_html__('Off','g5plus-darna')
                        ),
                        'default' => '1'
                    ),

                    array(
                        'id'       => 'page_title_height',
                        'type'     => 'dimensions',
                        'units' => 'px',
                        'width'    =>  false,
                        'title'    => esc_html__('Page Title Height', 'g5plus-darna'),
                        'desc'      => esc_html__('You can set a height for the page title here', 'g5plus-darna'),
                        'required'  => array('show_page_title', '=', array('1')),
                        'default'  => array(
                            'height'  => ''
                        )
                    ),

                    array(
                        'id' => 'page_title_bg_image',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Page Title Background', 'g5plus-darna'),
                        'subtitle' => esc_html__('Upload page title background.', 'g5plus-darna'),
                        'desc' => '',
                        'default' => array(
                            'url' => $page_title_bg_url
                        )
                    ),

                    array(
                        'id' => 'page_comment',
                        'type' => 'button_set',
                        'title' => esc_html__('Page Comment', 'g5plus-darna'),
                        'subtitle' => esc_html__('Enable/Disable page comment', 'g5plus-darna'),
                        'desc' => '',
                        'options' => array(
	                        '1' => esc_html__('On','g5plus-darna') ,
	                        '0' => esc_html__('Off','g5plus-darna')
                        ),
                        'default' => '1'
                    ),

                    array(
                        'id'     => 'section-page-end',
                        'type'   => 'section',
                        'indent' => false,
                    ),

                    array(
                        'id' => 'section-archive-start',
                        'type' => 'section',
                        'title' => esc_html__('Archive Options', 'g5plus-darna'),
                        'indent' => true
                    ),

                    array(
                        'id' => 'archive_layout',
                        'type' => 'button_set',
                        'title' => esc_html__('Layout', 'g5plus-darna'),
                        'subtitle' => esc_html__('Select Archive Layout', 'g5plus-darna'),
                        'options' => array(
                        	'full' => esc_html__('Full Width','g5plus-darna') ,
	                        'container' => esc_html__('Container', 'g5plus-darna'),
	                        'container-fluid' => esc_html__('Container Fluid', 'g5plus-darna'),
                        ),
                        'default' => 'container'
                    ),

                    array(
                        'id' => 'archive_sidebar',
                        'type' => 'image_select',
                        'title' => esc_html__('Sidebar', 'g5plus-darna'),
                        'subtitle' => esc_html__('Set Sidebar Style', 'g5plus-darna'),
                        'options' => array(
                            'none' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/sidebar-none.png'),
                            'left' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/sidebar-left.png'),
                            'right' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/sidebar-right.png'),
                            'both' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/sidebar-both.png'),
                        ),
                        'default' => 'right'
                    ),


                    array(
                        'id' => 'archive_sidebar_width',
                        'type' => 'button_set',
                        'title' => esc_html__('Sidebar Width', 'g5plus-darna'),
                        'subtitle' => esc_html__('Set Sidebar width', 'g5plus-darna'),
                        'options' => array(
                        	'small' => esc_html__('Small (1/4)','g5plus-darna'),
	                        'large' => esc_html__('Large (1/3)','g5plus-darna'),
                        ),
                        'default' => 'small',
                        'required'  => array('archive_sidebar', '=', array('left','both','right')),
                    ),

                    array(
                        'id' => 'archive_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Left Sidebar', 'g5plus-darna'),
                        'subtitle' => esc_html__('Choose the default left sidebar','g5plus-darna'),
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'sidebar-1',
                        'required'  => array('archive_sidebar', '=', array('left','both')),
                    ),
                    array(
                        'id' => 'archive_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Right Sidebar', 'g5plus-darna'),
                        'subtitle' => esc_html__('Choose the default right sidebar','g5plus-darna'),
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'sidebar-2',
                        'required'  => array('archive_sidebar', '=', array('right','both')),
                    ),
                    array(
                        'id' => 'archive_paging_style',
                        'type' => 'button_set',
                        'title' => esc_html__('Paging Style', 'g5plus-darna'),
                        'subtitle' => esc_html__('Select archive paging style', 'g5plus-darna'),
                        'desc' => '',
                        'options' => array(
                        	'default' => esc_html__('Default','g5plus-darna') ,
	                        'load-more' => esc_html__('Load More','g5plus-darna') ,
	                        'infinity-scroll' => esc_html__('Infinity Scroll','g5plus-darna') ,
                        ),
                        'default' => 'default'
                    ),
                    array(
                        'id' => 'breadcrumbs_in_archive_title',
                        'type' => 'button_set',
                        'title' => esc_html__('Breadcrumbs', 'g5plus-darna'),
                        'subtitle' => esc_html__('Enable/Disable Breadcrumbs in Archive Title', 'g5plus-darna'),
                        'desc' => '',
                        'options' => array(
	                        '1' => esc_html__('On','g5plus-darna') ,
	                        '0' => esc_html__('Off','g5plus-darna')
                        ),
                        'default' => '1'
                    ),

                    array(
                        'id' => 'show_archive_title',
                        'type' => 'button_set',
                        'title' => esc_html__('Show Archive Title', 'g5plus-darna'),
                        'subtitle' => esc_html__('Enable/Disable Archive Title', 'g5plus-darna'),
                        'desc' => '',
                        'options' => array(
	                        '1' => esc_html__('On','g5plus-darna') ,
	                        '0' => esc_html__('Off','g5plus-darna')
                        ),
                        'default' => '1'
                    ),
                    array(
                        'id'        => 'archive_title_height',
                        'type'      => 'dimensions',
                        'title'     => esc_html__('Archive Title Height', 'g5plus-darna'),
                        'desc'      => esc_html__('You can set a height for the archive title here', 'g5plus-darna'),
                        'required' => array('show_archive_title','=',array('1')),
                        'units' => 'px',
                        'width'    =>  false,
                        'default'  => array(
                            'height'  => ''
                        )
                    ),

                    array(
                        'id' => 'archive_title_bg_image',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Archive Title Background', 'g5plus-darna'),
                        'subtitle' => esc_html__('Upload archive title background.', 'g5plus-darna'),
                        'default' =>  array(
                            'url' => $archive_title_bg_url
                        )
                    ),



                    array(
                        'id'     => 'section-archive-end',
                        'type'   => 'section',
                        'indent' => false,
                    ),

                    array(
                        'id' => 'section-single-blog-start',
                        'type' => 'section',
                        'title' => esc_html__('Single Blog Options', 'g5plus-darna'),
                        'indent' => true
                    ),

                    array(
                        'id' => 'single_blog_layout',
                        'type' => 'button_set',
                        'title' => esc_html__('Layout', 'g5plus-darna'),
                        'subtitle' => esc_html__('Select Single Blog Layout', 'g5plus-darna'),
                        'desc' => '',
                        'options' => array(
                        	'full' => esc_html__('Full Width','g5plus-darna') ,
	                        'container' =>  esc_html__('Container','g5plus-darna') ,
	                        'container-fluid' => esc_html__('Container Fluid','g5plus-darna') ,
                        ),
                        'default' => 'container'
                    ),

                    array(
                        'id' => 'single_blog_sidebar',
                        'type' => 'image_select',
                        'title' => esc_html__('Sidebar', 'g5plus-darna'),
                        'subtitle' => esc_html__('Set Sidebar Style', 'g5plus-darna'),
                        'desc' => '',
                        'options' => array(
                            'none' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/sidebar-none.png'),
                            'left' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/sidebar-left.png'),
                            'right' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/sidebar-right.png'),
                            'both' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/sidebar-both.png'),
                        ),
                        'default' => 'none'
                    ),

                    array(
                        'id' => 'single_blog_sidebar_width',
                        'type' => 'button_set',
                        'title' => esc_html__('Sidebar Width', 'g5plus-darna'),
                        'subtitle' => esc_html__('Set Sidebar width', 'g5plus-darna'),
                        'options' => array(
                        	'small' => esc_html__('Small (1/4)', 'g5plus-darna'),
	                        'large' => esc_html__('Large (1/3)', 'g5plus-darna'),
                        ),
                        'default' => 'small',
                        'required'  => array('single_blog_sidebar', '=', array('left','both','right')),
                    ),


                    array(
                        'id' => 'single_blog_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Left Sidebar', 'g5plus-darna'),
                        'subtitle' => esc_html__('Choose the default left sidebar','g5plus-darna'),
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'sidebar-1',
                        'required'  => array('single_blog_sidebar', '=', array('left','both')),
                    ),

                    array(
                        'id' => 'single_blog_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Right Sidebar', 'g5plus-darna'),
                        'subtitle' => esc_html__('Choose the default right sidebar','g5plus-darna'),
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'sidebar-2',
                        'required'  => array('single_blog_sidebar', '=', array('right','both')),
                    ),


                    array(
                        'id' => 'show_single_blog_title',
                        'type' => 'button_set',
                        'title' => esc_html__('Show Single Blog Title', 'g5plus-darna'),
                        'subtitle' => esc_html__('Enable/Disable Single Blog Title', 'g5plus-darna'),
                        'desc' => '',
                        'options' => array(
	                        '1' => esc_html__('On','g5plus-darna') ,
	                        '0' => esc_html__('Off','g5plus-darna')
                        ),
                        'default' => '1'
                    ),

                    array(
                        'id' => 'breadcrumbs_in_single_blog_title',
                        'type' => 'button_set',
                        'title' => esc_html__('Breadcrumbs', 'g5plus-darna'),
                        'subtitle' => esc_html__('Enable/Disable Breadcrumbs in Single Blog Title', 'g5plus-darna'),
                        'desc' => '',
                        'options' => array(
	                        '1' => esc_html__('On','g5plus-darna') ,
	                        '0' => esc_html__('Off','g5plus-darna')
                        ),
                        'default' => '1'
                    ),

                    array(
                        'id'        => 'single_blog_title_height',
                        'type'      => 'dimensions',
                        'title'     => esc_html__('Single Blog Title Height', 'g5plus-darna'),
                        'desc'      => esc_html__('You can set a height for the single blog title here', 'g5plus-darna'),
                        'required'  => array('show_single_blog_title', '=', array('1')),
                        'units' => 'px',
                        'width'    =>  false,
                        'default'  => array(
                            'height'  => ''
                        )
                    ),

                    array(
                        'id' => 'single_blog_title_bg_image',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Single Blog Title Background', 'g5plus-darna'),
                        'subtitle' => esc_html__('Upload single blog title background.', 'g5plus-darna'),
                        'desc' => '',
                        'default' =>  array(
                            'url' => $archive_title_bg_url
                        )
                    ),
                    array(
                        'id'     => 'section-single-blog-end',
                        'type'   => 'section',
                        'indent' => false,
                    ),
                )
            );

            // Logo
            $this->sections[] = array(
                'title'  => esc_html__( 'Logo', 'g5plus-darna' ),
                'desc'   => '',
                'icon'   => 'el el-leaf',
                'fields' => array(
                    array(
                        'id' => 'logo',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Logo', 'g5plus-darna'),
                        'subtitle' => esc_html__('Upload your logo here.', 'g5plus-darna'),
                        'default' => array(
                            'url' => THEME_URL . '/assets/images/theme-options/logo.png'
                        )
                    ),
                    array(
                        'id' => 'light_logo',
                        'type' => 'media',
                        'url'=> false,
                        'title' => esc_html__('Light Logo', 'g5plus-darna'),
                        'subtitle' => esc_html__('Upload a light version of your logo here', 'g5plus-darna'),
                        'default' => array(
                            'url' => THEME_URL . '/assets/images/theme-options/logo-light.png'
                        )
                    ),
                    array(
                        'id' => 'dark_logo',
                        'type' => 'media',
                        'url'=> false,
                        'title' => esc_html__('Dark Logo', 'g5plus-darna'),
                        'subtitle' => esc_html__('Upload a dark version of your logo here', 'g5plus-darna'),
                        'default' => array(
                            'url' => THEME_URL . '/assets/images/theme-options/logo-dark.png'
                        )
                    ),
                    array(
                        'id'        => 'logo_max_height',
                        'type'      => 'dimensions',
                        'title'     => esc_html__('Logo Max Height', 'g5plus-darna'),
                        'desc'      => esc_html__('You can set a max height for the logo here', 'g5plus-darna'),
                        'units' => 'px',
                        'width'    =>  false,
                        'default'  => array(
                            'height'  => ''
                        )
                    ),

                    array(
                        'id'        => 'logo_padding',
                        'type'      => 'text',
                        'title'     => esc_html__('Logo Top/Bottom Padding', 'g5plus-darna'),
                        'subtitle'  => esc_html__('This must be numeric (no px). Leave balnk for default.', 'g5plus-darna'),
                        'desc'      => esc_html__('If you would like to override the default logo top/bottom padding, then you can do so here.', 'g5plus-darna'),
                        'validate'  => 'numeric',
                        'default'   => '',
                    ),
                )
            );

            // Header
            $this->sections[] = array(
                'title'  => esc_html__( 'Header', 'g5plus-darna' ),
                'desc'   => '',
                'icon'   => 'el el-credit-card',
                'fields' => array(
	                array(
		                'id'       => 'top_drawer_type',
		                'type'     => 'button_set',
		                'title'    => esc_html__( 'Top Drawer Type', 'g5plus-darna' ),
		                'subtitle' => esc_html__( 'Set top drawer type.', 'g5plus-darna' ),
		                'desc'     => '',
		                'options'  => array(
		                	'none' => esc_html__('Disable', 'g5plus-darna' ),
			                'show' => esc_html__('Always Show', 'g5plus-darna' ),
			                'toggle' =>  esc_html__('Toggle' , 'g5plus-darna' ),
		                ),
		                'default'  => 'none'
	                ),
	                array(
                        'id'       => 'top_drawer_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Top Drawer Sidebar', 'g5plus-darna'),
                        'subtitle' => esc_html__('Choose the default top drawer sidebar','g5plus-darna'),
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'top_drawer_sidebar',
		                'required' => array('top_drawer_type','=',array('show','toggle')),
                    ),
                    array(
                        'id' => 'top_drawer_layout',
                        'type' => 'image_select',
                        'title' => esc_html__('Top Drawer Layout', 'g5plus-darna'),
                        'subtitle' => esc_html__('Select the top drawer column layout.', 'g5plus-darna'),
                        'desc' => '',
                        'options' => array(
                            'top-drawer-1' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/footer-layout-1.jpg'),
                            'top-drawer-2' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/footer-layout-2.jpg'),
                            'top-drawer-3' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/footer-layout-3.jpg'),
                            'top-drawer-4' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/footer-layout-4.jpg'),
                            'top-drawer-5' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/footer-layout-5.jpg'),
                            'top-drawer-6' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/footer-layout-6.jpg'),
                            'top-drawer-7' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/footer-layout-7.jpg'),
                            'top-drawer-8' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/footer-layout-8.jpg'),
                            'top-drawer-9' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/footer-layout-9.jpg'),
                        ),
                        'default' => 'top-drawer-9',
                        'required' => array('top_drawer_type','=',array('show','toggle')),
                    ),
                    array(
                        'id' => 'top_drawer_wrapper_layout',
                        'type' => 'button_set',
                        'title' => esc_html__('Top Drawer Wrapper Layout', 'g5plus-darna'),
                        'subtitle' => esc_html__('Select top drawer wrapper layout', 'g5plus-darna'),
                        'options' => array(
                        	'full' => esc_html__('Full Width','g5plus-darna') ,
	                        'container' => esc_html__('Container','g5plus-darna') ,
	                        'container-fluid' => esc_html__('Container Fluid','g5plus-darna') ,
                        ),
                        'default' => 'container',
                        'required' => array('top_drawer_type','=',array('show','toggle')),
                    ),
                    array(
                        'id'       => 'top_bar',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Show/Hide Top Bar', 'g5plus-darna' ),
                        'subtitle' => esc_html__( 'Show Hide Top Bar.', 'g5plus-darna' ),
                        'options'  => array(
                        	'1' => esc_html__( 'On', 'g5plus-darna' ),
	                        '0' => esc_html__( 'Off' , 'g5plus-darna' ),
                        ),
                        'default'  => '0',
                    ),

                    array(
                        'id' => 'top_bar_layout',
                        'type' => 'image_select',
                        'title' => esc_html__('Top bar Layout', 'g5plus-darna'),
                        'subtitle' => esc_html__('Select the top bar column layout.', 'g5plus-darna'),
                        'options' => array(
                            'top-bar-1' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/top-bar-layout-1.jpg'),
                            'top-bar-2' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/top-bar-layout-2.jpg'),
                            'top-bar-3' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/top-bar-layout-3.jpg'),
	                        'top-bar-4' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/top-bar-layout-4.jpg'),
                        ),
                        'default' => 'top-bar-1',
                        'required' => array('top_bar','=','1'),
                    ),

                    array(
                        'id' => 'top_bar_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Top Left Sidebar', 'g5plus-darna'),
                        'subtitle' => esc_html__('Choose the default top left sidebar', 'g5plus-darna'),
                        'data'      => 'sidebars',
                        'default' => 'top_bar_left',
                        'required' => array('top_bar','=','1'),
                    ),
                    array(
                        'id' => 'top_bar_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Top Right Sidebar', 'g5plus-darna'),
                        'subtitle' => esc_html__('Choose the default top right sidebar','g5plus-darna'),
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'top_bar_right',
                        'required' => array('top_bar','=','1'),
                    ),

                    array(
                        'id' => 'header_layout',
                        'type' => 'image_select',
                        'title' => esc_html__('Header Layout', 'g5plus-darna'),
                        'subtitle' => esc_html__('Select a header layout option from the examples.', 'g5plus-darna'),
                        'desc' => '',
                        'options' => array(
                            'header-1' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/header-1.jpg'),
	                        'header-2' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/header-2.jpg'),
	                        'header-3' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/header-3.jpg'),
	                        'header-4' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/header-4.jpg'),
	                        'header-5' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/header-5.jpg'),
                        ),
                        'default' => 'header-3'
                    ),

	                array(
		                'id' => 'main_menu_after_customize',
		                'type' => 'ace_editor',
		                'mode' => 'html',
		                'theme' => 'monokai',
		                'title' => esc_html__('Custom text for primary menu', 'g5plus-darna'),
		                'subtitle' => esc_html__('Add Content for primary menu after (header 3)', 'g5plus-darna'),
		                'default' => '',
		                'options'  => array('minLines'=> 4, 'maxLines' => 60),
	                ),

	                array(
		                'id'      => 'header_customize',
		                'type'    => 'sorter',
		                'title'   => esc_html__('Header customize', 'g5plus-darna'),
		                'desc'    => esc_html__('Organize how you want the layout to appear on the header', 'g5plus-darna'),
		                'options' => array(
			                'enabled'  => array(
				                'get-a-quote' =>  esc_html__('Get a quote', 'g5plus-darna'),
				                'shopping-cart'   =>  esc_html__('Shopping Cart', 'g5plus-darna'),
				                'search' =>  esc_html__('Search Box', 'g5plus-darna'),
			                ),
			                'disabled' => array(
				                'custom-text' =>  esc_html__('Custom Text', 'g5plus-darna'),
			                )
		                )
	                ),

	                array(
		                'id' => 'header_customize_text',
		                'type' => 'ace_editor',
		                'mode' => 'html',
		                'theme' => 'monokai',
		                'title' => esc_html__('Custom Text Content', 'g5plus-darna'),
		                'subtitle' => esc_html__('Add Content for Custom Text', 'g5plus-darna'),
		                'default' => '',
		                'options'  => array('minLines'=> 8, 'maxLines' => 60),
	                ),

	                array(
		                'id' => 'header_get_a_quote_shortcode',
		                'type' => 'text',
		                'title' => esc_html__('Get a quote shortcode', 'g5plus-darna'),
		                'desc' => esc_html__('Set shortcode for popup content. Blank to default (mail chimp shortcode: mc4wp_form)','g5plus-darna'),
		                'default' => '',
	                ),

	                array(
		                'id'       => 'header_sticky',
		                'type'     => 'button_set',
		                'title'    => esc_html__( 'Show/Hide Header Sticky', 'g5plus-darna' ),
		                'subtitle' => esc_html__( 'Show Hide header Sticky.', 'g5plus-darna' ),
		                'options'  => array(
		                	'1' => esc_html__('On', 'g5plus-darna' ),
			                '0' => esc_html__('Off' , 'g5plus-darna' ),
		                ),
		                'default'  => '1'
	                ),

	                array(
		                'id' => 'header_shopping_cart_button',
		                'type' => 'checkbox',
		                'title' => esc_html__('Shopping Cart Button', 'g5plus-darna'),
		                'subtitle' => esc_html__('Select header shopping cart button', 'g5plus-darna'),
		                'options' => array(
			                'view-cart' => esc_html__('View Cart', 'g5plus-darna'),
			                'checkout' => esc_html__('Checkout', 'g5plus-darna'),
		                ),
		                'default' => array(
			                'view-cart' => '1',
			                'checkout' => '1',
		                ),
		                'required' => array('header_shopping_cart','=','1'),
	                ),

                    array(
                        'id' => 'search_box_type',
                        'type' => 'button_set',
                        'title' => esc_html__('Search Box Type', 'g5plus-darna'),
                        'subtitle' => esc_html__('Select search box type.', 'g5plus-darna'),
                        'options' => array(
                        	'standard' => esc_html__('Standard','g5plus-darna'),
	                        'ajax' => esc_html__('Ajax Search','g5plus-darna')
                        ),
                        'default' => 'standard'
                    ),

                    array(
                        'id' => 'search_box_post_type',
                        'type' => 'checkbox',
                        'title' => esc_html__('Post type for Ajax Search', 'g5plus-darna'),
                        'subtitle' => esc_html__('Select post type for ajax search', 'g5plus-darna'),
                        'options' => array(
                            'post' => 'Post',
	                        'page' => 'Page',
                            'product' => 'Product',
                            'portfolio' => 'Portfolio',
                            'service' => 'Our Services',
                        ),
                        'default' => array(
                            'post'      => '1',
	                        'page'      => '1',
                            'product'   => '1',
                            'portfolio' => '1',
                            'testimonial' => '1',
                        ),
                        'required' => array('search_box_type','=','ajax'),
                    ),

                    array(
                        'id'        => 'search_box_result_amount',
                        'type'      => 'text',
                        'title'     => esc_html__('Amount Of Search Result', 'g5plus-darna'),
                        'subtitle'  => esc_html__('This must be numeric (no px) or empty (default: 8).', 'g5plus-darna'),
                        'desc'      => esc_html__('Set mount of Search Result', 'g5plus-darna'),
                        'validate'  => 'numeric',
                        'default'   => '',
                        'required' => array('search_box_type','=','ajax'),
                    ),
                )
            );

            $this->sections[] = array(
                'title'  => esc_html__( 'Mobile Header', 'g5plus-darna' ),
                'desc'   => '',
                'icon'   => 'el el-th-list',
                'fields' => array(
	                array(
		                'id' => 'mobile_header_layout',
		                'type' => 'image_select',
		                'title' => esc_html__('Header Layout', 'g5plus-darna'),
		                'subtitle' => esc_html__('Select header mobile layout', 'g5plus-darna'),
		                'desc' => '',
		                'options' => array(
			                'header-mobile-1' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/header-mobile-layout-1.png'),
			                'header-mobile-2' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/header-mobile-layout-2.png'),
			                'header-mobile-3' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/header-mobile-layout-3.png'),
			                'header-mobile-4' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/header-mobile-layout-4.png'),
		                ),
		                'default' => 'header-mobile-2'
	                ),

	                array(
		                'id'       => 'mobile_header_menu_drop',
		                'type'     => 'button_set',
		                'title'    => esc_html__( 'Menu Drop Type', 'g5plus-darna' ),
		                'subtitle' => esc_html__( 'Set menu drop type for mobile header', 'g5plus-darna' ),
		                'options'  => array(
			                'dropdown' => esc_html__('Dropdown Menu','g5plus-darna'),
			                'fly' => esc_html__('Fly Menu','g5plus-darna')
		                ),
		                'default'  => 'fly'
	                ),

                    array(
                        'id' => 'mobile_header_logo',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Mobile Logo', 'g5plus-darna'),
                        'subtitle' => esc_html__('Upload your logo here.', 'g5plus-darna'),
                        'desc' => '',
                        'default' => array(
                            'url' => THEME_URL . '/assets/images/theme-options/logo.png'
                        )
                    ),

	                array(
		                'id'        => 'logo_mobile_max_height',
		                'type'      => 'dimensions',
		                'title'     => esc_html__('Logo Mobile Max Height', 'g5plus-darna'),
		                'desc'      => esc_html__('You can set a max height for the logo mobile here', 'g5plus-darna'),
		                'units' => 'px',
		                'width'    =>  false,
		                'default'  => array(
			                'height'  => ''
		                )
	                ),

	                array(
		                'id'        => 'logo_mobile_padding',
		                'type'      => 'dimensions',
		                'title'     => esc_html__('Logo Top/Bottom Padding', 'g5plus-darna'),
		                'desc'      => esc_html__('If you would like to override the default logo top/bottom padding, then you can do so here', 'g5plus-darna'),
		                'units' => 'px',
		                'width'    =>  false,
		                'default'  => array(
			                'height'  => ''
		                )
	                ),

                    array(
                        'id'       => 'mobile_header_top_bar',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Top Bar', 'g5plus-darna' ),
                        'subtitle' => esc_html__( 'Enable Top bar.', 'g5plus-darna' ),
                        'desc'     => '',
                        'options'  => array(
                        	'1' =>  esc_html__('On', 'g5plus-darna' ),
	                        '0' =>  esc_html__('Off' , 'g5plus-darna' ),
                        ),
                        'default'  => '0'
                    ),
                    array(
                        'id'       => 'mobile_header_stick',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Stick Mobile Header', 'g5plus-darna' ),
                        'subtitle' => esc_html__( 'Enable Stick Mobile Header.', 'g5plus-darna' ),
                        'desc'     => '',
                        'options'  => array(
	                       '1' =>  esc_html__('On', 'g5plus-darna' ),
	                        '0' => esc_html__('Off' , 'g5plus-darna' ),
                        ),
                        'default'  => '1'
                    ),
                    array(
                        'id'       => 'mobile_header_search_box',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Search Box', 'g5plus-darna' ),
                        'subtitle' => esc_html__( 'Enable Search Box.', 'g5plus-darna' ),
                        'desc'     => '',
                         'options'  => array(
	                       '1' =>  esc_html__('On', 'g5plus-darna' ),
	                        '0' => esc_html__('Off' , 'g5plus-darna' ),
                        ),
                        'default'  => '1'
                    ),
                    array(
                        'id'       => 'mobile_header_shopping_cart',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Shopping Cart', 'g5plus-darna' ),
                        'subtitle' => esc_html__( 'Enable Shopping Cart', 'g5plus-darna' ),
                        'desc'     => '',
                         'options'  => array(
	                       '1' =>  esc_html__('On', 'g5plus-darna' ),
	                        '0' => esc_html__('Off' , 'g5plus-darna' ),
                        ),
                        'default'  => '1'
                    ),
                )
            );

            $this->sections[] = array(
                'title'  => esc_html__( 'Footer', 'g5plus-darna' ),
                'desc'   => '',
                'icon'   => 'el el-website',
                'fields' => array(
                    array(
                        'id' => 'footer_layout',
                        'type' => 'image_select',
                        'title' => esc_html__('Footer Layout', 'g5plus-darna'),
                        'subtitle' => esc_html__('Select the footer column layout.', 'g5plus-darna'),
                        'desc' => '',
                        'options' => array(
                            'footer-1' => array('title' => '', 'img' => THEME_URL . 'assets/images/theme-options/footer-layout-1.jpg'),
                            'footer-2' => array('title' => '', 'img' => THEME_URL . 'assets/images/theme-options/footer-layout-2.jpg'),
                            'footer-3' => array('title' => '', 'img' => THEME_URL . 'assets/images/theme-options/footer-layout-3.jpg'),
                            'footer-4' => array('title' => '', 'img' => THEME_URL . 'assets/images/theme-options/footer-layout-4.jpg'),
                            'footer-5' => array('title' => '', 'img' => THEME_URL . 'assets/images/theme-options/footer-layout-5.jpg'),
                            'footer-6' => array('title' => '', 'img' => THEME_URL . 'assets/images/theme-options/footer-layout-6.jpg'),
                            'footer-7' => array('title' => '', 'img' => THEME_URL . 'assets/images/theme-options/footer-layout-7.jpg'),
                            'footer-8' => array('title' => '', 'img' => THEME_URL . 'assets/images/theme-options/footer-layout-8.jpg'),
                            'footer-9' => array('title' => '', 'img' => THEME_URL . 'assets/images/theme-options/footer-layout-9.jpg'),
                        ),
                        'default' => 'footer-1'
                    ),

	                array(
		                'id' => 'footer_bg_image',
		                'type' => 'media',
		                'url'=> false,
		                'title' => esc_html__('Footer background image', 'g5plus-darna'),
		                'subtitle' => esc_html__('Upload footer background image here', 'g5plus-darna'),
		                'default' => array(
			                'url' => THEME_URL . 'assets/images/theme-options/bg-footer.jpg'
		                )
	                ),

                    array(
                        'id'       => 'footer_parallax',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Footer Parallax', 'g5plus-darna' ),
                        'subtitle' => esc_html__( 'Enable Footer Parallax', 'g5plus-darna' ),
                         'options'  => array(
	                       '1' =>  esc_html__('On', 'g5plus-darna' ),
	                        '0' => esc_html__('Off' , 'g5plus-darna' ),
                        ),
                        'default'  => '0'
                    ),

	                array(
		                'id'       => 'footer_above_layout',
		                'type'     => 'select',
		                'title'    => esc_html__( 'Footer above layout', 'g5plus-darna' ),
		                'subtitle' => esc_html__( 'Select footer above layout', 'g5plus-darna' ),
		                'options'  => array(
			                'col-md-12'                 => esc_html__('Large (full)','g5plus-darna'),
			                'col-md-6 col-md-push-3'    => esc_html__('Medium (1/2)','g5plus-darna'),
		                    'col-md-4 col-md-push-4'                  => esc_html__('Small (1/3)','g5plus-darna')
		                ),
		                'default'  => 'col-md-6 col-md-push-3'
	                ),


                    array(
                        'id'       => 'collapse_footer',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Collapse footer on mobile device', 'g5plus-darna' ),
                        'subtitle' => esc_html__( 'Enable collapse footer', 'g5plus-darna' ),
                        'desc'     => '',
                         'options'  => array(
	                       '1' =>  esc_html__('On', 'g5plus-darna' ),
	                        '0' => esc_html__('Off' , 'g5plus-darna' ),
                        ),
                        'default'  => '0'
                    ),
                    array(
                        'id'       => 'bottom_bar',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Bottom Bar', 'g5plus-darna' ),
                        'subtitle' => esc_html__( 'Enable Bottom Bar (below Footer)', 'g5plus-darna' ),
                        'desc'     => '',
                         'options'  => array(
	                       '1' =>  esc_html__('On', 'g5plus-darna' ),
	                        '0' => esc_html__('Off' , 'g5plus-darna' ),
                        ),
                        'default'  => '1'
                    ),

                    array(
                        'id' => 'bottom_bar_layout',
                        'type' => 'image_select',
                        'title' => esc_html__('Bottom bar Layout', 'g5plus-darna'),
                        'subtitle' => esc_html__('Select the bottom bar column layout.', 'g5plus-darna'),
                        'desc' => '',
                        'options' => array(
                            'bottom-bar-1' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/bottom-bar-layout-1.jpg'),
                            'bottom-bar-2' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/bottom-bar-layout-2.jpg'),
                            'bottom-bar-3' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/bottom-bar-layout-3.jpg'),
	                        'bottom-bar-4' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/bottom-bar-layout-4.jpg'),
                        ),
                        'default' => 'bottom-bar-1',
                        'required' => array('bottom_bar','=','1'),
                    ),

                    array(
                        'id' => 'bottom_bar_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Bottom Left Sidebar', 'g5plus-darna'),
                        'subtitle' =>  esc_html__('Choose the default bottom left sidebar', 'g5plus-darna'),
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'bottom_bar_left',
                        'required' => array('bottom_bar','=','1'),
                    ),
                    array(
                        'id' => 'bottom_bar_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Bottom Right Sidebar', 'g5plus-darna'),
                        'subtitle' =>  esc_html__('Choose the default bottom right sidebar', 'g5plus-darna'),
                        'data'      => 'sidebars',
                        'default' => 'bottom_bar_right',
                        'required' => array('bottom_bar','=','1'),
                    ),


                )
            );

            $this->sections[] = array(
                'title'  => esc_html__( 'Styling Options', 'g5plus-darna' ),
                'desc'   => esc_html__( 'If you change value in this section, you must "Save & Generate CSS"', 'g5plus-darna' ),
                'icon'   => 'el el-magic',
                'fields' => array(
                    array(
                        'id'       => 'primary_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Primary Color', 'g5plus-darna'),
                        'subtitle' => esc_html__('Set Primary Color', 'g5plus-darna'),
                        'default'  => '#ffb600',
                        'validate' => 'color',
                    ),

                    array(
                        'id'       => 'secondary_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Secondary Color', 'g5plus-darna'),
                        'subtitle' => esc_html__('Set Secondary Color', 'g5plus-darna'),
                        'default'  => '#222222',
                        'validate' => 'color',
                    ),

	                array(
		                'id'       => 'top_drawer_bg_color',
		                'type'     => 'color',
		                'title'    => esc_html__( 'Top drawer background color', 'g5plus-darna' ),
		                'subtitle' => esc_html__( 'Set Top drawer background color.', 'g5plus-darna' ),
		                'default'  => '#2f2f2f',
		                'validate' => 'color',
	                ),

	                array(
		                'id'       => 'top_drawer_text_color',
		                'type'     => 'color',
		                'title'    => esc_html__('Top drawer text color', 'g5plus-darna'),
		                'subtitle' => esc_html__('Pick a text color for the Top drawer', 'g5plus-darna'),
		                'default'  => '#c5c5c5',
		                'validate' => 'color',
	                ),

	                array(
		                'id'       => 'top_bar_bg_color',
		                'type'     => 'color_rgba',
		                'title'    => esc_html__( 'Top Bar background color', 'g5plus-darna' ),
		                'subtitle' => esc_html__( 'Set Top Bar background color.', 'g5plus-darna' ),
		                'default'  => array(
			                'color' => '#F8F8F8',
			                'alpha' => '1'
		                ),
		                'mode'     => 'background',
		                'validate' => 'colorrgba',
	                ),

	                array(
		                'id'       => 'top_bar_text_color',
		                'type'     => 'color',
		                'title'    => esc_html__('Top Bar text color', 'g5plus-darna'),
		                'subtitle' => esc_html__('Pick a text color for the Top Bar', 'g5plus-darna'),
		                'default'  => '#222',
		                'validate' => 'color',
	                ),

                    array(
                        'id'       => 'text_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Text Color', 'g5plus-darna'),
                        'subtitle' => esc_html__('Set Text Color.', 'g5plus-darna'),
                        'default'  => '#8f8f8f',
                        'validate' => 'color',
                    ),

                    array(
                        'id'       => 'bold_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Bolder Color', 'g5plus-darna'),
                        'subtitle' => esc_html__('Set Bolder Color.', 'g5plus-darna'),
                        'default'  => '#222222',
                        'validate' => 'color',
                    ),

                    array(
                        'id'       => 'heading_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Heading Color', 'g5plus-darna'),
                        'subtitle' => esc_html__('Set Heading Color.', 'g5plus-darna'),
                        'default'  => '#222222',
                        'validate' => 'color',
                    ),

                    array(
                        'id'       => 'footer_bg_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Footer Background Color', 'g5plus-darna'),
                        'subtitle' => esc_html__('Set Footer Background Color.', 'g5plus-darna'),
                        'default'  => '#2F2F2F',
                        'validate' => 'color',
                    ),

                    array(
                        'id'       => 'footer_text_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Footer Text Color', 'g5plus-darna'),
                        'subtitle' => esc_html__('Set Footer Text Color.', 'g5plus-darna'),
                        'default'  => '#8f8f8f',
                        'validate' => 'color',
                    ),

                    array(
                        'id'       => 'footer_heading_text_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Footer Heading Text Color', 'g5plus-darna'),
                        'subtitle' => esc_html__('Set Footer Heading Text Color.', 'g5plus-darna'),
                        'default'  => '#FFFFFF',
                        'validate' => 'color',
                    ),

                    array(
                        'id'       => 'bottom_bar_bg_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Bottom Bar Background Color', 'g5plus-darna'),
                        'subtitle' => esc_html__('Set Bottom Bar Background Color.', 'g5plus-darna'),
                        'default'  => '#191919',
                        'validate' => 'color',
                    ),

                    array(
                        'id'       => 'bottom_bar_text_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Bottom Bar Text Color', 'g5plus-darna'),
                        'subtitle' => esc_html__('Set Bottom Bar Text Color.', 'g5plus-darna'),
                        'default'  => '#828282',
                        'validate' => 'color',
                    ),

                    array(
                        'id'       => 'link_color',
                        'type'     => 'link_color',
                        'title'    => esc_html__( 'Link Color', 'g5plus-darna' ),
                        'subtitle' => esc_html__( 'Link Color.', 'g5plus-darna' ),
                        'default'  => array(
                            'regular'  => '#ffb600', // blue
                            'hover'    => '#ffb600', // red
                            'active'   => '#ffb600',  // purple
                        ),
                    ),

                    array(
                        'id'=>'styling-color-divide-0',
                        'type' => 'divide'
                    ),

                    array(
                        'id'       => 'menu_text_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Menu Text Color', 'g5plus-darna'),
                        'subtitle' => esc_html__('Set Menu Text Color.', 'g5plus-darna'),
                        'default'  => '#222',
                        'validate' => 'color',
                    ),

                    array(
                        'id'       => 'menu_sub_bg_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Sub Menu Background Color', 'g5plus-darna'),
                        'subtitle' => esc_html__('Set Sub Menu Background Color.', 'g5plus-darna'),
                        'default'  => '#F8F8F8',
                        'validate' => 'color',
                    ),

                    array(
                        'id'       => 'menu_sub_text_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Sub Menu Background Color', 'g5plus-darna'),
                        'subtitle' => esc_html__('Set Sub Menu Background Color.', 'g5plus-darna'),
                        'default'  => '#222',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'styling-color-divide-1',
                        'type' => 'divide'
                    ),

                    array(
                        'id' => 'page_title_text_color',
                        'type'     => 'color',
                        'title' => esc_html__('Page Title Text Color', 'g5plus-darna'),
                        'subtitle' => esc_html__('Pick a text color for page title.', 'g5plus-darna'),
                        'default'  => '#FFFFFF',
                        'validate' => 'color',
                    ),
                    array(
                        'id' => 'page_title_bg_color',
                        'type'     => 'color',
                        'title' => esc_html__('Page Title Background Color', 'g5plus-darna'),
                        'subtitle' => esc_html__('Pick a background color for page title.', 'g5plus-darna'),
                        'default'  => '#2a2a2a',
                        'validate' => 'color',
                    ),
                    array(
                        'id' => 'page_title_overlay_color',
                        'type'     => 'color',
                        'title' => esc_html__('Page Title Background Overlay Color', 'g5plus-darna'),
                        'subtitle' => esc_html__('Pick a background overlay color for page title.', 'g5plus-darna'),
                        'default'  => '#000',
                        'validate' => 'color',
                    ),

                    array(
                        'id' => 'page_title_overlay_opacity',
                        'type'     => 'slider',
                        'title' => esc_html__('Page Title Background Overlay Opacity', 'g5plus-darna'),
                        'subtitle' => esc_html__('Set the opacity level of the overlay.', 'g5plus-darna'),
                        'default'  => '40',
                        "min"       => 0,
                        "step"      => 1,
                        "max"       => 100
                    ),

                )
            );

            $this->sections[] = array(
                'icon' => 'el-icon-fontsize',
                'title' => esc_html__('Font Options', 'g5plus-darna'),
                'desc'   => esc_html__ ('If you change value in this section, you must "Save & Generate CSS"', 'g5plus-darna' ),
                'fields' => array(
                    array(
                        'id'=>'body_font',
                        'type' => 'typography',
                        'title' => esc_html__('Body Font', 'g5plus-darna'),
                        'subtitle' => esc_html__('Specify the body font properties.', 'g5plus-darna'),
                        'google'=> true,
                        'text-align'=>false,
                        'color'=>false,
                        'letter-spacing'=>false,
                        'line-height'=>false,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array('body'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array('body'), // An array of CSS selectors to apply this font style to dynamically
                        'units'=>'px', // Defaults to px
                        'default' => array(
                            'font-size'=>'14px',
                            'font-family'=>'Lato',
                            'font-weight'=>'400',
                        ),
                    ),
                    array(
                        'id'=>'h1_font',
                        'type' => 'typography',
                        'title' => esc_html__('H1 Font', 'g5plus-darna'),
                        'subtitle' => esc_html__('Specify the H1 font properties.', 'g5plus-darna'),
                        'google'=> true,
                        'text-align'=>false,
                        'line-height'=>false,
                        'color'=>false,
                        'letter-spacing'=>false,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array('h1'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array('h1'), // An array of CSS selectors to apply this font style to dynamically
                        'units'=>'px', // Defaults to px
                        'default' => array(
                            'font-size'=>'32px',
                            'line-height'=>'48px',
                            'font-family'=>'Oswald',
                            'font-weight'=>'400',
                        ),
                    ),
                    array(
                        'id'=>'h2_font',
                        'type' => 'typography',
                        'title' => esc_html__('H2 Font', 'g5plus-darna'),
                        'subtitle' => esc_html__('Specify the H2 font properties.', 'g5plus-darna'),
                        'google'=> true,
                        'line-height'=>false,
                        'text-align'=>false,
                        'color'=>false,
                        'letter-spacing'=>false,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array('h2'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array('h2'), // An array of CSS selectors to apply this font style to dynamically
                        'units'=>'px', // Defaults to px
                        'default' => array(
                            'font-size'=>'24px',
                            'line-height'=>'36px',
                            'font-family'=>'Oswald',
                            'font-weight'=>'400',
                        ),
                    ),
                    array(
                        'id'=>'h3_font',
                        'type' => 'typography',
                        'title' => esc_html__('H3 Font', 'g5plus-darna'),
                        'subtitle' => esc_html__('Specify the H3 font properties.', 'g5plus-darna'),
                        'google'=> true,
                        'text-align'=>false,
                        'line-height'=>false,
                        'color'=>false,
                        'letter-spacing'=>false,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array('h3'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array('h3'), // An array of CSS selectors to apply this font style to dynamically
                        'units'=>'px', // Defaults to px
                        'default' => array(
                            'font-size'=>'22px',
                            'line-height'=>'28px',
                            'font-family'=>'Oswald',
                            'font-weight'=>'400',
                        ),
                    ),
                    array(
                        'id'=>'h4_font',
                        'type' => 'typography',
                        'title' => esc_html__('H4 Font', 'g5plus-darna'),
                        'subtitle' => esc_html__('Specify the H4 font properties.', 'g5plus-darna'),
                        'google'=> true,
                        'text-align'=>false,
                        'line-height'=>false,
                        'color'=>false,
                        'letter-spacing'=>false,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array('h4'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array('h4'), // An array of CSS selectors to apply this font style to dynamically
                        'units'=>'px', // Defaults to px
                        'default' => array(
                            'font-size'=>'18px',
                            'line-height'=>'24px',
                            'font-family'=>'Oswald',
                            'font-weight'=>'400',
                        ),
                    ),
                    array(
                        'id'=>'h5_font',
                        'type' => 'typography',
                        'title' => esc_html__('H5 Font', 'g5plus-darna'),
                        'subtitle' => esc_html__('Specify the H5 font properties.', 'g5plus-darna'),
                        'google'=> true,
                        'line-height'=>false,
                        'text-align'=>false,
                        'color'=>false,
                        'letter-spacing'=>false,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array('h5'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array('h5'), // An array of CSS selectors to apply this font style to dynamically
                        'units'=>'px', // Defaults to px
                        'default' => array(
                            'font-size'=>'16px',
                            'line-height'=>'22px',
                            'font-family'=>'Oswald',
                            'font-weight'=>'400',
                        ),
                    ),
                    array(
                        'id'=>'h6_font',
                        'type' => 'typography',
                        'title' => esc_html__('H6 Font', 'g5plus-darna'),
                        'subtitle' => esc_html__('Specify the H6 font properties.', 'g5plus-darna'),
                        'google'=> true,
                        'line-height'=>false,
                        'text-align'=>false,
                        'color'=>false,
                        'letter-spacing'=>false,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array('h6'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array('h6'), // An array of CSS selectors to apply this font style to dynamically
                        'units'=>'px', // Defaults to px
                        'default' => array(
                            'font-size'=>'12px',
                            'line-height'=>'16px',
                            'font-family'=>'Oswald',
                            'font-weight'=>'400',
                        ),
                    ),
                    array(
                        'id'=> 'menu_font',
                        'type' => 'typography',
                        'title' => esc_html__('Menu Font', 'g5plus-darna'),
                        'subtitle' => esc_html__('Specify the Menu font properties.', 'g5plus-darna'),
                        'google' => true,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'line-height'=>false,
                        'color'=>false,
                        'text-align'=>false,
                        'font-style' => false,
                        'subsets' => false,
                        'font-size' => false,
                        'font-weight' => false,
                        'output' => array(''), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array(''), // An array of CSS selectors to apply this font style to dynamically
                        'units'=> 'px', // Defaults to px
                        'default' => array(
                            'font-family'=>'Roboto',
                        ),
                    ),


                    array(
                        'id'=> 'primary_font',
                        'type' => 'typography',
                        'title' => esc_html__('Primary Font', 'g5plus-darna'),
                        'subtitle' => esc_html__('Specify the Primary font properties.', 'g5plus-darna'),
                        'google' => true,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'line-height'=>false,
                        'color'=>false,
                        'text-align'=>false,
                        'font-style' => false,
                        'subsets' => false,
                        'font-size' => false,
                        'font-weight' => false,
                        'output' => array(''), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array(''), // An array of CSS selectors to apply this font style to dynamically
                        'units'=> 'px', // Defaults to px
                        'default' => array(
                            'font-family'=>'Lato',
                        ),
                    ),

                    array(
                        'id'=> 'secondary_font',
                        'type' => 'typography',
                        'title' => esc_html__('Secondary Font', 'g5plus-darna'),
                        'subtitle' => esc_html__('Specify the Secondary font properties.', 'g5plus-darna'),
                        'google' => true,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'line-height'=>false,
                        'color'=>false,
                        'text-align'=>false,
                        'font-style' => false,
                        'subsets' => false,
                        'font-size' => false,
                        'font-weight' => false,
                        'output' => array(''), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array(''), // An array of CSS selectors to apply this font style to dynamically
                        'units'=> 'px', // Defaults to px
                        'default' => array(
                            'font-family'=>'Oswald',
                        ),
                    ),
                ),
            );

            $this->sections[] = array(
                'title'  => esc_html__( 'Social Profiles', 'g5plus-darna' ),
                'desc'   => '',
                'icon'   => 'el el-path',
                'fields' => array(
                    array(
                        'id' => 'twitter_url',
                        'type' => 'text',
                        'title' => esc_html__('Twitter', 'g5plus-darna'),
                        'subtitle' => esc_html__('Your Twitter', 'g5plus-darna'),
                        'default' => ''
                    ),
                    array(
                        'id' => 'facebook_url',
                        'type' => 'text',
                        'title' => esc_html__('Facebook', 'g5plus-darna'),
                        'subtitle' => esc_html__('Your facebook page/profile url', 'g5plus-darna'),
                        'default' => ''
                    ),
                    array(
                        'id' => 'dribbble_url',
                        'type' => 'text',
                        'title' => esc_html__('Dribbble', 'g5plus-darna'),
                        'subtitle' => esc_html__('Your Dribbble','g5plus-darna'),
                        'default' => ''
                    ),
                    array(
                        'id' => 'vimeo_url',
                        'type' => 'text',
                        'title' => esc_html__('Vimeo', 'g5plus-darna'),
                        'subtitle' => esc_html__('Your Vimeo','g5plus-darna'),
                        'default' => ''
                    ),
                    array(
                        'id' => 'tumblr_url',
                        'type' => 'text',
                        'title' => esc_html__('Tumblr', 'g5plus-darna'),
                        'subtitle' => esc_html__('Your Tumblr','g5plus-darna'),
                        'default' => ''
                    ),
                    array(
                        'id' => 'skype_username',
                        'type' => 'text',
                        'title' => esc_html__('Skype', 'g5plus-darna'),
                        'subtitle' => esc_html__('Your Skype username','g5plus-darna'),
                        'default' => ''
                    ),
                    array(
                        'id' => 'linkedin_url',
                        'type' => 'text',
                        'title' => esc_html__('LinkedIn', 'g5plus-darna'),
                        'subtitle' => esc_html__('Your LinkedIn page/profile url','g5plus-darna'),
                        'default' => ''
                    ),
                    array(
                        'id' => 'flickr_url',
                        'type' => 'text',
                        'title' => esc_html__('Flickr', 'g5plus-darna'),
                        'subtitle' => esc_html__('Your Flickr page url','g5plus-darna'),
                        'default' => ''
                    ),
                    array(
                        'id' => 'youtube_url',
                        'type' => 'text',
                        'title' => esc_html__('YouTube', 'g5plus-darna'),
                        'subtitle' => esc_html__('Your YouTube URL','g5plus-darna'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'pinterest_url',
                        'type' => 'text',
                        'title' => esc_html__('Pinterest', 'g5plus-darna'),
                        'subtitle' => esc_html__('Your Pinterest','g5plus-darna'),
                        'default' => ''
                    ),
                    array(
                        'id' => 'foursquare_url',
                        'type' => 'text',
                        'title' => esc_html__('Foursquare', 'g5plus-darna'),
                        'subtitle' => esc_html__('Your Foursqaure URL','g5plus-darna'),
                        'default' => ''
                    ),
                    array(
                        'id' => 'instagram_url',
                        'type' => 'text',
                        'title' => esc_html__('Instagram', 'g5plus-darna'),
                        'subtitle' => esc_html__('Your Instagram','g5plus-darna'),
                        'default' => ''
                    ),
                    array(
                        'id' => 'github_url',
                        'type' => 'text',
                        'title' => esc_html__('GitHub', 'g5plus-darna'),
                        'subtitle' => esc_html__('Your GitHub URL','g5plus-darna'),
                        'default' => ''
                    ),
                    array(
                        'id' => 'xing_url',
                        'type' => 'text',
                        'title' => esc_html__('Xing', 'g5plus-darna'),
                        'subtitle' => esc_html__('Your Xing URL','g5plus-darna'),
                        'default' => ''
                    ),
                    array(
                        'id' => 'behance_url',
                        'type' => 'text',
                        'title' => esc_html__('Behance', 'g5plus-darna'),
                        'subtitle' => esc_html__('Your Behance URL','g5plus-darna'),
                        'default' => ''
                    ),
                    array(
                        'id' => 'deviantart_url',
                        'type' => 'text',
                        'title' => esc_html__('Deviantart', 'g5plus-darna'),
                        'subtitle' => esc_html__('Your Deviantart URL','g5plus-darna'),
                        'default' => ''
                    ),
                    array(
                        'id' => 'soundcloud_url',
                        'type' => 'text',
                        'title' => esc_html__('SoundCloud', 'g5plus-darna'),
                        'subtitle' => esc_html__('Your SoundCloud URL','g5plus-darna'),
                        'default' => ''
                    ),
                    array(
                        'id' => 'yelp_url',
                        'type' => 'text',
                        'title' => esc_html__('Yelp', 'g5plus-darna'),
                        'subtitle' => esc_html__('Your Yelp URL','g5plus-darna'),
                        'default' => ''
                    ),
                    array(
                        'id' => 'rss_url',
                        'type' => 'text',
                        'title' => esc_html__('RSS Feed', 'g5plus-darna'),
                        'subtitle' => esc_html__('Your RSS Feed URL','g5plus-darna'),
                        'default' => ''
                    ),
                    array(
                        'id' => 'email_address',
                        'type' => 'text',
                        'title' => esc_html__('Email address', 'g5plus-darna'),
                        'subtitle' => esc_html__('Your email address','g5plus-darna'),
                        'default' => ''
                    ),
                    array(
                        'id'=>'social-profile-divide-0',
                        'type' => 'divide'
                    ),
                    array(
                        'title'    => esc_html__('Social Share', 'g5plus-darna'),
                        'id'       => 'social_sharing',
                        'type'     => 'checkbox',
                        'subtitle' => esc_html__('Show the social sharing in blog posts', 'g5plus-darna'),

                        //Must provide key => value pairs for multi checkbox options
                        'options'  => array(
                            'facebook' => 'Facebook',
                            'twitter' => 'Twitter',
                            'linkedin' => 'Linkedin',
                            'tumblr' => 'Tumblr',
                            'pinterest' => 'Pinterest'
                        ),

                        //See how default has changed? you also don't need to specify opts that are 0.
                        'default' => array(
                            'facebook' => '1',
                            'twitter' => '1',
                            'linkedin' => '1',
                            'tumblr' => '1',
                            'pinterest' => '1'
                        )
                    ),
                    array(
                        'title'    => esc_html__('Social share on page 404', 'g5plus-darna'),
                        'id'       => 'social_sharing_404',
                        'type'     => 'checkbox',
                        'subtitle' => esc_html__('Show the social sharing in page 404', 'g5plus-darna'),

                        //Must provide key => value pairs for multi checkbox options
                        'options'  => array(
                            'facebook' => 'Facebook',
                            'twitter' => 'Twitter',
                            'behance' => 'Behance',
                            'skype' => 'Skype'
                        ),

                        //See how default has changed? you also don't need to specify opts that are 0.
                        'default' => array(
                            'facebook' => '1',
                            'twitter' => '1',
                            'behance' => '1',
                            'skype' => '1'
                        )
                    )
                )
            );

            $this->sections[] = array(
                'title'  => esc_html__( 'Woocommerce', 'g5plus-darna' ),
                'desc'   => '',
                'icon'   => 'el el-shopping-cart',
                'fields' => array(
                    array(
                        'id'       => 'add_to_cart_animation',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Add To Cart Animation', 'g5plus-darna' ),
                        'subtitle' => esc_html__( 'Enable Add To Cart Animation', 'g5plus-darna' ),
                         'options'  => array(
	                       '1' =>  esc_html__('On', 'g5plus-darna' ),
	                        '0' => esc_html__('Off' , 'g5plus-darna' ),
                        ),
                        'default'  => '0'
                    ),
                    array(
                        'id'        => 'product_per_page',
                        'type'      => 'text',
                        'title'     => esc_html__('Products Per Page', 'g5plus-darna'),
                        'subtitle'  => esc_html__('This must be numeric or empty (default 12).', 'g5plus-darna'),
                        'desc'      => esc_html__('Set Products Per Page in archive product', 'g5plus-darna'),
                        'validate'  => 'numeric',
                        'default'   => '12',
                    ),
                    array(
                        'id' => 'product_display_columns',
                        'type' => 'select',
                        'title' => esc_html__('Product Display Columns', 'g5plus-darna'),
                        'subtitle' => esc_html__('Choose the number of columns to display on shop/category pages.','g5plus-darna'),
                        'options' => array(
                            '2'		=> '2',
                            '3'		=> '3',
                            '4'		=> '4',
                            '5'		=> '5',
                            '6'		=> '6',
                        ),
                        'desc' => '',
                        'default' => '3'
                    ),
                    array(
                        'id'       => 'product_show_rating',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Show Rating', 'g5plus-darna' ),
                        'subtitle' => esc_html__( 'Show/Hide Rating product', 'g5plus-darna' ),
                         'options'  => array(
	                       '1' =>  esc_html__('On', 'g5plus-darna' ),
	                        '0' => esc_html__('Off' , 'g5plus-darna' ),
                        ),
                        'default'  => '1'
                    ),


                    array(
                        'id'       => 'product_sale_flash_mode',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Sale Flash Mode', 'g5plus-darna' ),
                        'subtitle' => esc_html__( 'Chose Sale Flash Mode', 'g5plus-darna' ),
                        'options'  => array( 'text' => 'Text', 'percent' => 'Percent' ),
                        'default'  => 'text'
                    ),

                    array(
                        'id'       => 'product_show_result_count',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Show Result Count', 'g5plus-darna' ),
                        'subtitle' => esc_html__( 'Show/Hide Result Count In Archive Product', 'g5plus-darna' ),
                         'options'  => array(
	                       '1' =>  esc_html__('On', 'g5plus-darna' ),
	                        '0' => esc_html__('Off' , 'g5plus-darna' ),
                        ),
                        'default'  => '1'
                    ),
                    array(
                        'id'       => 'product_show_catalog_ordering',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Show Catalog Ordering', 'g5plus-darna' ),
                        'subtitle' => esc_html__( 'Show/Hide Catalog Ordering', 'g5plus-darna' ),
                         'options'  => array(
	                       '1' =>  esc_html__('On', 'g5plus-darna' ),
	                        '0' => esc_html__('Off' , 'g5plus-darna' ),
                        ),
                        'default'  => '1'
                    ),
                    array(
                        'id'       => 'product_quick_view',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Quick View', 'g5plus-darna' ),
                        'subtitle' => esc_html__( 'Enable/Disable Quick View', 'g5plus-darna' ),
                        'options'  => array(
                        	'1' => esc_html__('Enable','g5plus-darna'),
	                        '0' => esc_html__('Disable','g5plus-darna')
                        ),
                        'default'  => '1'
                    ),
                )
            );


            // Archive Product Layout
            $this->sections[] = array(
                'title'  => esc_html__( 'Archive Product Layout', 'g5plus-darna' ),
                'desc'   => '',
                'icon'   => 'el el-shopping-cart',
                'subsection' => true,
                'fields' => array(
                    array(
                        'id' => 'archive_product_layout',
                        'type' => 'button_set',
                        'title' => esc_html__('Archive Product Layout', 'g5plus-darna'),
                        'subtitle' => esc_html__('Select Archive Product Layout', 'g5plus-darna'),
                        'options' => array(
                        	'full' => esc_html__('Full Width','g5plus-darna'),
	                        'container' => esc_html__('Container','g5plus-darna'),
	                        'container-fluid' => esc_html__('Container Fluid','g5plus-darna')
                        ),
                        'default' => 'container'
                    ),
                    array(
                        'id' => 'archive_product_sidebar',
                        'type' => 'image_select',
                        'title' => esc_html__('Archive Product Sidebar', 'g5plus-darna'),
                        'subtitle' => esc_html__('Set Archive Product Sidebar', 'g5plus-darna'),
                        'desc' => '',
                        'options' => array(
                            'none' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/sidebar-none.png'),
                            'left' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/sidebar-left.png'),
                            'right' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/sidebar-right.png'),
                            'both' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/sidebar-both.png'),
                        ),
                        'default' => 'right'
                    ),
                    array(
                        'id' => 'archive_product_sidebar_width',
                        'type' => 'button_set',
                        'title' => esc_html__('Sidebar Width', 'g5plus-darna'),
                        'subtitle' => esc_html__('Set Sidebar width', 'g5plus-darna'),
                        'options' => array(
                        	'small' => esc_html__('Small (1/4)','g5plus-darna'),
	                        'large' => esc_html__('Large (1/3)','g5plus-darna')
                        ),
                        'default' => 'small',
                        'required'  => array('archive_product_sidebar', '=', array('left','both','right')),
                    ),
                    array(
                        'id' => 'archive_product_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Archive Product Left Sidebar', 'g5plus-darna'),
                        'subtitle' => esc_html__('Choose the default Archive Product left sidebar','g5plus-darna'),
                        'data'      => 'sidebars',
                        'default' => 'woocommerce',
                        'required'  => array('archive_product_sidebar', '=', array('left','both')),
                    ),
                    array(
                        'id' => 'archive_product_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Archive Product Right Sidebar', 'g5plus-darna'),
                        'subtitle' => esc_html__('Choose the default Archive Product right sidebar','g5plus-darna'),
                        'data'      => 'sidebars',
                        'default' => 'woocommerce',
                        'required'  => array('archive_product_sidebar', '=', array('right','both')),
                    ),
                    array(
                        'id' => 'show_archive_product_title',
                        'type' => 'button_set',
                        'title' => esc_html__('Show Archive Title', 'g5plus-darna'),
                        'subtitle' => esc_html__('Enable/Disable Archive Product Title', 'g5plus-darna'),
                        'options' => array(
	                        '1' => esc_html__('On','g5plus-darna') ,
	                        '0' => esc_html__('Off','g5plus-darna')
                        ),
                        'default' => '1'
                    ),
                    array(
                        'id'        => 'archive_product_title_height',
                        'type'      => 'dimensions',
                        'title'     => esc_html__('Archive Product Title Height', 'g5plus-darna'),
                        'desc'      => esc_html__('You can set a height for the archive product title here', 'g5plus-darna'),
                        'required'  => array('show_archive_product_title', '=', array('1')),
                        'units' => 'px',
                        'width'    =>  false,
                        'default'  => array(
                            'height'  => ''
                        )
                    ),

                    array(
                        'id' => 'breadcrumbs_in_archive_product_title',
                        'type' => 'button_set',
                        'title' => esc_html__('Breadcrumbs in Archive Product Title', 'g5plus-darna'),
                        'subtitle' => esc_html__('Enable/Disable Breadcrumbs in Archive Product Title', 'g5plus-darna'),
                        'desc' => '',
                        'options' => array(
	                        '1' => esc_html__('On','g5plus-darna') ,
	                        '0' => esc_html__('Off','g5plus-darna')
                        ),
                        'default' => '1'
                    ),
                    array(
                        'id' => 'archive_product_title_bg_image',
                        'type' => 'media',
                        'url'=> false,
                        'title' => esc_html__('Archive Product Title Background', 'g5plus-darna'),
                        'subtitle' => esc_html__('Upload archive product title background.', 'g5plus-darna'),
                        'default' => array(
                            'url' => $archive_shop_title_bg_url
                        )
                    )
                )
            );

            // Single Product Layout
            $this->sections[] = array(
                'title'  => esc_html__( 'Single Product Layout', 'g5plus-darna' ),
                'desc'   => '',
                'icon'   => 'el el-shopping-cart',
                'subsection' => true,
                'fields' => array(
                    array(
                        'id' => 'single_product_layout',
                        'type' => 'button_set',
                        'title' => esc_html__('Single Product Layout', 'g5plus-darna'),
                        'subtitle' => esc_html__('Select Single Product Layout', 'g5plus-darna'),
                        'options' => array(
                        	'full' => esc_html__('Full Width','g5plus-darna'),
	                        'container' => esc_html__('Container','g5plus-darna'),
	                        'container-fluid' => esc_html__('Container Fluid','g5plus-darna')
                        ),
                        'default' => 'container'
                    ),
                    array(
                        'id' => 'single_product_sidebar',
                        'type' => 'image_select',
                        'title' => esc_html__('Single Product Sidebar', 'g5plus-darna'),
                        'subtitle' => esc_html__('Set Single Product Sidebar', 'g5plus-darna'),
                        'desc' => '',
                        'options' => array(
                            'none' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/sidebar-none.png'),
                            'left' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/sidebar-left.png'),
                            'right' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/sidebar-right.png'),
                            'both' => array('title' => '', 'img' => THEME_URL.'/assets/images/theme-options/sidebar-both.png'),
                        ),
                        'default' => 'none'
                    ),
                    array(
                        'id' => 'single_product_sidebar_width',
                        'type' => 'button_set',
                        'title' => esc_html__('Single Product Sidebar Width', 'g5plus-darna'),
                        'subtitle' => esc_html__('Set Sidebar width', 'g5plus-darna'),
                        'options' => array(
                        	'small' => esc_html__('Small (1/4)','g5plus-darna'),
	                        'large' => esc_html__('Large (1/3)','g5plus-darna')
                        ),
                        'default' => 'small',
                        'required'  => array('single_product_sidebar', '=', array('left','both','right')),
                    ),
                    array(
                        'id' => 'single_product_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Single Product Left Sidebar', 'g5plus-darna'),
                        'subtitle' => esc_html__('Choose the default Single Product left sidebar','g5plus-darna'),
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'sidebar-1',
                        'required'  => array('single_product_sidebar', '=', array('left','both')),
                    ),
                    array(
                        'id' => 'single_product_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Single Product Right Sidebar', 'g5plus-darna'),
                        'subtitle' => esc_html__('Choose the default Single Product right sidebar','g5plus-darna'),
                        'data'      => 'sidebars',
                        'default' => 'sidebar-2',
                        'required'  => array('single_product_sidebar', '=', array('right','both')),
                    ),
                    array(
                        'id' => 'show_single_product_title',
                        'type' => 'button_set',
                        'title' => esc_html__('Show Single Title', 'g5plus-darna'),
                        'subtitle' => esc_html__('Enable/Disable Single Product Title', 'g5plus-darna'),
                        'options' => array(
	                        '1' => esc_html__('On','g5plus-darna') ,
	                        '0' => esc_html__('Off','g5plus-darna')
                        ),
                        'default' => '1'
                    ),
                    array(
                        'id'        => 'single_product_title_height',
                        'type'      => 'dimensions',
                        'title'     => esc_html__('Single Product Title Height', 'g5plus-darna'),
                        'subtitle'  => esc_html__('This must be numeric (no px) or empty.', 'g5plus-darna'),
                        'desc'      => esc_html__('You can set a height for the single product title here', 'g5plus-darna'),
                        'required'  => array('show_single_product_title', '=', array('1')),
                        'units' => 'px',
                        'width'    =>  false,
                        'default'  => array(
                            'height'  => ''
                        )
                    ),

                    array(
                        'id' => 'breadcrumbs_in_single_product_title',
                        'type' => 'button_set',
                        'title' => esc_html__('Breadcrumbs in Single Product Title', 'g5plus-darna'),
                        'subtitle' => esc_html__('Enable/Disable Breadcrumbs in Single Product Title', 'g5plus-darna'),
                        'options' => array(
	                        '1' => esc_html__('On','g5plus-darna') ,
	                        '0' => esc_html__('Off','g5plus-darna')
                        ),
                        'default' => '1'
                    ),
                    array(
                        'id' => 'single_product_title_bg_image',
                        'type' => 'media',
                        'url'=> false,
                        'title' => esc_html__('Single Product Title Background', 'g5plus-darna'),
                        'subtitle' => esc_html__('Upload single product title background.', 'g5plus-darna'),
                        'default' => array(
                            'url' => $archive_shop_title_bg_url
                        )
                    ),


                    array(
                        'id'       => 'related_product_count',
                        'type'     => 'text',
                        'title'    => esc_html__('Related Product Total Record', 'g5plus-darna'),
                        'subtitle' => esc_html__('Total Record Of Related Product.', 'g5plus-darna'),
                        'validate' => 'number',
                        'default'  => '6',
                    ),

                    array(
                        'id' => 'related_product_display_columns',
                        'type' => 'select',
                        'title' => esc_html__('Related Product Display Columns', 'g5plus-darna'),
                        'subtitle' => esc_html__('Choose the number of columns to display on related product.','g5plus-darna'),
                        'options' => array(
                            '3'		=> '3',
                            '4'		=> '4',
                        ),
                        'desc' => '',
                        'default' => '4'
                    ),

                    array(
                        'id' => 'related_product_condition',
                        'type' => 'checkbox',
                        'title' => esc_html__('Related Product Condition', 'g5plus-darna'),
                        'options' => array(
                            'category' => esc_html__('Same Category','g5plus-darna'),
                            'tag' => esc_html__('Same Tag','g5plus-darna'),
                        ),
                        'default' => array(
                            'category'      => '1',
                            'tag'      => '1',
                        ),
                    ),
                )
            );



            $this->sections[] = array(
                'title'  => esc_html__( 'Custom Post Type', 'g5plus-darna' ),
                'desc'   => '',
                'icon'   => 'el el-screenshot',
                'fields' => array(
                    array(
                        'id' => 'cpt-disable',
                        'type' => 'checkbox',
                        'title' => esc_html__('Disable Custom Post Types', 'g5plus-darna'),
                        'subtitle' => esc_html__('You can disable the custom post types used within the theme here, by checking the corresponding box. NOTE: If you do not want to disable any, then make sure none of the boxes are checked.', 'g5plus-darna'),
                        'options' => array(
                            'portfolio' => esc_html__('Portfolio','g5plus-darna'),
                            'ourteam' => esc_html__('Our Team','g5plus-darna'),
                        ),
                        'default' => array(
                            'portfolio' => '0',
                            'ourteam' => '0',
                        )
                    ),

                    array(
                        'id'=>'custom-post-type-divide-0',
                        'type' => 'divide'
                    ),

                    array(
                        'id' => 'show_portfolio_title',
                        'type' => 'button_set',
                        'title' => esc_html__('Show Portfolio Title', 'g5plus-darna'),
                        'subtitle' => esc_html__('Enable/Disable Portfolio Title', 'g5plus-darna'),
                        'options' => array(
	                        '1' => esc_html__('On','g5plus-darna') ,
	                        '0' => esc_html__('Off','g5plus-darna')
                        ),
                        'default' => '1'
                    ),
                    array(
                        'id'        => 'portfolio_title_height',
                        'type'      => 'dimensions',
                        'title'     => esc_html__('Portfolio Title Height', 'g5plus-darna'),
                        'subtitle'  => esc_html__('This must be numeric (no px) or empty.', 'g5plus-darna'),
                        'desc'      => esc_html__('You can set a height for the Portfolio title here', 'g5plus-darna'),
                        'units' => 'px',
                        'width'    =>  false,
                        'default'  => array(
                            'height'  => ''
                        )
                    ),
                    array(
                        'id' => 'breadcrumbs_in_portfolio_title',
                        'type' => 'button_set',
                        'title' => esc_html__('Breadcrumbs in Portfolio Title', 'g5plus-darna'),
                        'subtitle' => esc_html__('Enable/Disable Breadcrumbs in Portfolio Title', 'g5plus-darna'),
                        'options' => array(
	                        '1' => esc_html__('On','g5plus-darna') ,
	                        '0' => esc_html__('Off','g5plus-darna')
                        ),
                        'default' => '1'
                    ),

                    array(
                        'id' => 'portfolio_title_bg_image',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Portfolio Title Background', 'g5plus-darna'),
                        'subtitle' => esc_html__('Upload portfolio title background.', 'g5plus-darna'),
                        'default' => array(
                            'url' => $portfolio_title_bg_url
                        )
                    ),
                    array(
                        'id' => 'portfolio_archive_link',
                        'type' => 'text',
                        'title' => esc_html__('Portfolio Archive Link', 'g5plus-darna'),
                    ),
                )
            );

            $this->sections[] = array(
                'title'  => esc_html__( 'Resources Options', 'g5plus-darna' ),
                'desc'   => '',
                'icon'   => 'el el-random',
                'fields' => array(
                    array(
                        'id'        => 'cdn_bootstrap_js',
                        'type'      => 'text',
                        'title'     => esc_html__('CDN Bootstrap Script', 'g5plus-darna'),
                        'subtitle'  => esc_html__('Url CDN Bootstrap Script', 'g5plus-darna'),
                        'default'   => '',
                    ),

                    array(
                        'id'        => 'cdn_bootstrap_css',
                        'type'      => 'text',
                        'title'     => esc_html__('CDN Bootstrap Stylesheet', 'g5plus-darna'),
                        'subtitle'  => esc_html__('Url CDN Bootstrap Stylesheet', 'g5plus-darna'),
                        'default'   => '',
                    ),

                    array(
                        'id'        => 'cdn_font_awesome',
                        'type'      => 'text',
                        'title'     => esc_html__('CDN Font Awesome', 'g5plus-darna'),
                        'subtitle'  => esc_html__('Url CDN Font Awesome', 'g5plus-darna'),
                        'default'   => '',
                    ),

                )
            );
            $this->sections[] = array(
                'title'  => esc_html__( 'Custom CSS & Script', 'g5plus-darna' ),
                'desc'   => esc_html__( 'If you change Custom CSS, you must "Save & Generate CSS"', 'g5plus-darna' ),
                'icon'   => 'el el-edit',
                'fields' => array(
                    array(
                        'id' => 'custom_css',
                        'type' => 'ace_editor',
                        'mode' => 'css',
                        'theme' => 'monokai',
                        'title' => esc_html__('Custom CSS', 'g5plus-darna'),
                        'subtitle' => esc_html__('Add some CSS to your theme by adding it to this textarea. Please do not include any style tags.', 'g5plus-darna'),
                        'default' => '',
                        'options'  => array('minLines'=> 20, 'maxLines' => 60)
                    ),
                    array(
                        'id' => 'custom_js',
                        'type' => 'ace_editor',
                        'mode' => 'javascript',
                        'theme' => 'chrome',
                        'title' => esc_html__('Custom JS', 'g5plus-darna'),
                        'subtitle' => esc_html__('Add some custom JavaScript to your theme by adding it to this textarea. Please do not include any script tags.', 'g5plus-darna'),
                        'default' => '',
                        'options'  => array('minLines'=> 20, 'maxLines' => 60)
                    ),

                )
            );
        }

        public function setHelpTabs() {
        }

        /**
         * All the possible arguments for Redux.
         * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'           => 'g5plus_darna_options',
                // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'       => $theme->get( 'Name' ),
                // Name that appears at the top of your panel
                'display_version'    => $theme->get( 'Version' ),
                // Version that appears at the top of your panel
                'menu_type'          => 'menu',
                //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'     => true,
                // Show the sections below the admin menu item or not
                'menu_title'         => esc_html__( 'Theme Options', 'g5plus-darna' ),
                'page_title'         => esc_html__( 'Theme Options', 'g5plus-darna' ),
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key'     => '',
                // Must be defined to add google fonts to the typography module

                'async_typography'   => false,
                // Use a asynchronous font on the front end or font string
                'admin_bar'          => true,
                // Show the panel pages on the admin bar
                'global_variable'    => '',
                // Set a different name for your global variable other than the opt_name
                'dev_mode'           => false,
                // Show the time the page took to load, etc
                'customizer'         => false,
                // Enable basic customizer support

                // OPTIONAL -> Give you extra features
                'page_priority'      => null,
                // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'        => 'themes.php',
                // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_theme_page#Parameters
                'page_permissions'   => 'manage_options',
                // Permissions needed to access the options panel.
                'menu_icon'          => '',
                // Specify a custom URL to an icon
                'last_tab'           => '',
                // Force your panel to always open to a specific tab (by id)
                'page_icon'          => 'icon-themes',
                // Icon displayed in the admin panel next to your menu_title
                'page_slug'          => '_options',
                // Page slug used to denote the panel
                'save_defaults'      => true,
                // On load save the defaults to DB before user clicks save or not
                'default_show'       => false,
                // If true, shows the default value next to each field that is not the default value.
                'default_mark'       => '',
                // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,
                // Shows the Import/Export panel when not used as a field.

                // CAREFUL -> These options are for advanced use only
                'transient_time'     => 60 * MINUTE_IN_SECONDS,
                'output'             => true,
                // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'         => true,
                // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'           => '',
                // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info'        => false,
                // REMOVE

                // HINTS
                'hints'              => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'   => 'light',
                        'shadow'  => true,
                        'rounded' => false,
                        'style'   => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show' => array(
                            'effect'   => 'slide',
                            'duration' => '500',
                            'event'    => 'mouseover',
                        ),
                        'hide' => array(
                            'effect'   => 'slide',
                            'duration' => '500',
                            'event'    => 'click mouseleave',
                        ),
                    ),
                )
            );


            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            $this->args['share_icons'][] = array(
                'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
                'title' => 'Visit us on GitHub',
                'icon'  => 'el el-github'
                //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
            );
            $this->args['share_icons'][] = array(
                'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
                'title' => 'Like us on Facebook',
                'icon'  => 'el el-facebook'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://twitter.com/reduxframework',
                'title' => 'Follow us on Twitter',
                'icon'  => 'el el-twitter'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://www.linkedin.com/company/redux-framework',
                'title' => 'Find us on LinkedIn',
                'icon'  => 'el el-linkedin'
            );

            // Panel Intro text -> before the form
            if ( ! isset( $this->args['global_variable'] ) || $this->args['global_variable'] !== false ) {
                if ( ! empty( $this->args['global_variable'] ) ) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace( '-', '_', $this->args['opt_name'] );
                }
            }

            // Add content after the form.
            $this->args['footer_text'] = wp_kses_post( __( '<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'g5plus-darna' ));
        }

    }

    global $reduxConfig;
    $reduxConfig = new Redux_Framework_options_config();
}