<?php
/**
 * Custom Functions.
 *
 * @package Kindergarten Toys
 */

if( !function_exists( 'kindergarten_toys_fonts_url' ) ) :

    //Google Fonts URL
    function kindergarten_toys_fonts_url(){

        $kindergarten_toys_font_families = array(
            'Caveat:wght@400..700',  //font-family: "Caveat", cursive;
            'Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900', //  font-family: "Poppins", sans-serif;
        );

        $kindergarten_toys_fonts_url = add_query_arg( array(
            'family' => implode( '&family=', $kindergarten_toys_font_families ),
            'display' => 'swap',
        ), 'https://fonts.googleapis.com/css2' );

        return esc_url_raw($kindergarten_toys_fonts_url);

    }

endif;

if ( ! function_exists( 'kindergarten_toys_sub_menu_toggle_button' ) ) :

    function kindergarten_toys_sub_menu_toggle_button( $kindergarten_toys_args, $kindergarten_toys_item, $depth ) {

        // Add sub menu toggles to the main menu with toggles
        if ( $kindergarten_toys_args->theme_location == 'kindergarten-toys-primary-menu' && isset( $kindergarten_toys_args->show_toggles ) ) {
            
            // Wrap the menu item link contents in a div, used for positioning
            $kindergarten_toys_args->before = '<div class="submenu-wrapper">';
            $kindergarten_toys_args->after  = '';

            // Add a toggle to items with children
            if ( in_array( 'menu-item-has-children', $kindergarten_toys_item->classes ) ) {

                $toggle_target_string = '.menu-item.menu-item-' . $kindergarten_toys_item->ID . ' > .sub-menu';

                // Add the sub menu toggle
                $kindergarten_toys_args->after .= '<button type="button" class="theme-aria-button submenu-toggle" data-toggle-target="' . $toggle_target_string . '" data-toggle-type="slidetoggle" data-toggle-duration="250" aria-expanded="false"><span class="btn__content" tabindex="-1"><span class="screen-reader-text">' . esc_html__( 'Show sub menu', 'kindergarten-toys' ) . '</span>' . kindergarten_toys_get_theme_svg( 'chevron-down' ) . '</span></button>';

            }

            // Close the wrapper
            $kindergarten_toys_args->after .= '</div><!-- .submenu-wrapper -->';
            // Add sub menu icons to the main menu without toggles (the fallback menu)

        }elseif( $kindergarten_toys_args->theme_location == 'kindergarten-toys-primary-menu' ) {

            if ( in_array( 'menu-item-has-children', $kindergarten_toys_item->classes ) ) {

                $kindergarten_toys_args->before = '<div class="link-icon-wrapper">';
                $kindergarten_toys_args->after  = kindergarten_toys_get_theme_svg( 'chevron-down' ) . '</div>';

            } else {

                $kindergarten_toys_args->before = '';
                $kindergarten_toys_args->after  = '';

            }

        }

        return $kindergarten_toys_args;

    }

endif;

add_filter( 'nav_menu_item_args', 'kindergarten_toys_sub_menu_toggle_button', 10, 3 );

if ( ! function_exists( 'kindergarten_toys_the_theme_svg' ) ):
    
    function kindergarten_toys_the_theme_svg( $kindergarten_toys_svg_name, $kindergarten_toys_return = false ) {

        if( $kindergarten_toys_return ){

            return kindergarten_toys_get_theme_svg( $kindergarten_toys_svg_name ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in kindergarten_toys_get_theme_svg();.

        }else{

            echo kindergarten_toys_get_theme_svg( $kindergarten_toys_svg_name ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in kindergarten_toys_get_theme_svg();.

        }
    }

endif;

if ( ! function_exists( 'kindergarten_toys_get_theme_svg' ) ):

    function kindergarten_toys_get_theme_svg( $kindergarten_toys_svg_name ) {

        // Make sure that only our allowed tags and attributes are included.
        $kindergarten_toys_svg = wp_kses(
            Kindergarten_Toys_SVG_Icons::get_svg( $kindergarten_toys_svg_name ),
            array(
                'svg'     => array(
                    'class'       => true,
                    'xmlns'       => true,
                    'width'       => true,
                    'height'      => true,
                    'viewbox'     => true,
                    'aria-hidden' => true,
                    'role'        => true,
                    'focusable'   => true,
                ),
                'path'    => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'd'         => true,
                    'transform' => true,
                ),
                'polygon' => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'points'    => true,
                    'transform' => true,
                    'focusable' => true,
                ),
                'polyline' => array(
                    'fill'      => true,
                    'points'    => true,
                ),
                'line' => array(
                    'fill'      => true,
                    'x1'      => true,
                    'x2' => true,
                    'y1'    => true,
                    'y2' => true,
                ),
            )
        );
        if ( ! $kindergarten_toys_svg ) {
            return false;
        }
        return $kindergarten_toys_svg;

    }

endif;

if( !function_exists( 'kindergarten_toys_post_category_list' ) ) :

    // Post Category List.
    function kindergarten_toys_post_category_list( $kindergarten_toys_select_cat = true ){

        $kindergarten_toys_post_cat_lists = get_categories(
            array(
                'hide_empty' => '0',
                'exclude' => '1',
            )
        );

        $kindergarten_toys_post_cat_cat_array = array();
        if( $kindergarten_toys_select_cat ){

            $kindergarten_toys_post_cat_cat_array[''] = esc_html__( '-- Select Category --','kindergarten-toys' );

        }

        foreach ( $kindergarten_toys_post_cat_lists as $kindergarten_toys_post_cat_list ) {

            $kindergarten_toys_post_cat_cat_array[$kindergarten_toys_post_cat_list->slug] = $kindergarten_toys_post_cat_list->name;

        }

        return $kindergarten_toys_post_cat_cat_array;
    }

endif;

if( !function_exists('kindergarten_toys_single_post_navigation') ):

    function kindergarten_toys_single_post_navigation(){

        $kindergarten_toys_default = kindergarten_toys_get_default_theme_options();
        $kindergarten_toys_twp_navigation_type = esc_attr( get_post_meta( get_the_ID(), 'twp_disable_ajax_load_next_post', true ) );
        $kindergarten_toys_current_id = '';
        $article_wrap_class = '';
        global $post;
        $kindergarten_toys_current_id = $post->ID;
        if( $kindergarten_toys_twp_navigation_type == '' || $kindergarten_toys_twp_navigation_type == 'global-layout' ){
            $kindergarten_toys_twp_navigation_type = get_theme_mod('twp_navigation_type', $kindergarten_toys_default['twp_navigation_type']);
        }

        if( $kindergarten_toys_twp_navigation_type != 'no-navigation' && 'post' === get_post_type() ){

            if( $kindergarten_toys_twp_navigation_type == 'theme-normal-navigation' ){ ?>

                <div class="navigation-wrapper">
                    <?php
                    // Previous/next post navigation.
                    the_post_navigation(array(
                        'prev_text' => '<span class="arrow" aria-hidden="true">' . kindergarten_toys_the_theme_svg('arrow-left',$kindergarten_toys_return = true ) . '</span><span class="screen-reader-text">' . esc_html__('Previous post:', 'kindergarten-toys') . '</span><span class="post-title">%title</span>',
                        'next_text' => '<span class="arrow" aria-hidden="true">' . kindergarten_toys_the_theme_svg('arrow-right',$kindergarten_toys_return = true ) . '</span><span class="screen-reader-text">' . esc_html__('Next post:', 'kindergarten-toys') . '</span><span class="post-title">%title</span>',
                    )); ?>
                </div>
                <?php

            }else{

                $kindergarten_toys_next_post = get_next_post();
                if( isset( $kindergarten_toys_next_post->ID ) ){

                    $kindergarten_toys_next_post_id = $kindergarten_toys_next_post->ID;
                    echo '<div loop-count="1" next-post="' . absint( $kindergarten_toys_next_post_id ) . '" class="twp-single-infinity"></div>';

                }
            }

        }

    }

endif;

add_action( 'kindergarten_toys_navigation_action','kindergarten_toys_single_post_navigation',30 );

if( !function_exists('kindergarten_toys_content_offcanvas') ):

    // Offcanvas Contents
    function kindergarten_toys_content_offcanvas(){ ?>

        <div id="offcanvas-menu">
            <div class="offcanvas-wraper">
                <div class="close-offcanvas-menu">
                    <div class="offcanvas-close">
                        <a href="javascript:void(0)" class="skip-link-menu-start"></a>
                        <button type="button" class="button-offcanvas-close">
                            <span class="offcanvas-close-label">
                                <?php echo esc_html__('Close', 'kindergarten-toys'); ?>
                            </span>
                        </button>
                    </div>
                </div>
                <div id="primary-nav-offcanvas" class="offcanvas-item offcanvas-main-navigation">
                    <nav class="primary-menu-wrapper" aria-label="<?php esc_attr_e('Horizontal', 'kindergarten-toys'); ?>" role="navigation">
                        <ul class="primary-menu theme-menu">
                            <?php
                            if (has_nav_menu('kindergarten-toys-primary-menu')) {
                                wp_nav_menu(
                                    array(
                                        'container' => '',
                                        'items_wrap' => '%3$s',
                                        'theme_location' => 'kindergarten-toys-primary-menu',
                                        'show_toggles' => true,
                                    )
                                );
                            }else{

                                wp_list_pages(
                                    array(
                                        'match_menu_classes' => true,
                                        'show_sub_menu_icons' => true,
                                        'title_li' => false,
                                        'show_toggles' => true,
                                        'walker' => new Kindergarten_Toys_Walker_Page(),
                                    )
                                );
                            }
                            ?>
                        </ul>
                    </nav><!-- .primary-menu-wrapper -->
                </div>
                <a href="javascript:void(0)" class="skip-link-menu-end"></a>
            </div>
        </div>

    <?php
    }

endif;

add_action( 'kindergarten_toys_before_footer_content_action','kindergarten_toys_content_offcanvas',30 );

if( !function_exists('kindergarten_toys_footer_content_widget') ):

    function kindergarten_toys_footer_content_widget(){
        
        $kindergarten_toys_default = kindergarten_toys_get_default_theme_options();
        
        $kindergarten_toys_footer_column_layout = absint(get_theme_mod('kindergarten_toys_footer_column_layout', $kindergarten_toys_default['kindergarten_toys_footer_column_layout']));
        $kindergarten_toys_footer_sidebar_class = 12;
        
        if($kindergarten_toys_footer_column_layout == 2) {
            $kindergarten_toys_footer_sidebar_class = 6;
        }
        
        if($kindergarten_toys_footer_column_layout == 3) {
            $kindergarten_toys_footer_sidebar_class = 4;
        }
        ?>
        
        <?php if ( get_theme_mod('kindergarten_toys_display_footer', true) == true ) : ?>
            <div class="footer-widgetarea">
                <div class="wrapper">
                    <div class="column-row">
                    
                        <?php for ($i = 0; $i < $kindergarten_toys_footer_column_layout; $i++) : ?>
                            
                            <div class="column <?php echo 'column-' . absint($kindergarten_toys_footer_sidebar_class); ?> column-sm-12">
                                
                                <?php 
                                // If no widgets are assigned, display default widgets
                                if ( ! is_active_sidebar( 'kindergarten-toys-footer-widget-' . $i ) ) : 

                                    if ($i === 0) : ?>
                                        <div id="media_image-3" class="widget widget_media_image">
                                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.png'); ?>" alt="<?php echo esc_attr__( 'Footer Image', 'kindergarten-toys' ); ?>" style="max-width: 100%; height: auto;">
                                        </div>
                                        <div id="text-3" class="widget widget_text">
                                            <div class="textwidget">
                                                <p class="widget_text">
                                                    <?php esc_html_e('The Free Kindergarten WordPress Theme is a versatile, beautifully crafted theme tailored to meet the unique needs of kindergartens, preschools, and nursery schools. Designed with early childhood education in mind, this theme is perfect for showcasing all the essential elements a kindergarten has to offer.', 'kindergarten-toys'); ?>
                                                </p>
                                            </div>
                                        </div>

                                    <?php elseif ($i === 1) : ?>
                                        <div id="pages-2" class="widget widget_pages">
                                            <h2 class="widget-title"><?php esc_html_e('Calendar', 'kindergarten-toys'); ?></h2>
                                            <?php get_calendar(); ?>
                                        </div>

                                    <?php elseif ($i === 2) : ?>
                                        <div id="search-2" class="widget widget_search">
                                            <h2 class="widget-title"><?php esc_html_e('Enter Keywords Here', 'kindergarten-toys'); ?></h2>
                                            <?php get_search_form(); ?>
                                        </div>
                                    <?php endif; 
                                    
                                else :
                                    // Display dynamic sidebar widget if assigned
                                    dynamic_sidebar('kindergarten-toys-footer-widget-' . $i);
                                endif;
                                ?>
                                
                            </div>
                            
                        <?php endfor; ?>

                    </div>
                </div>
            </div>
        <?php endif; ?> 

    <?php
    }

endif;

add_action( 'kindergarten_toys_footer_content_action', 'kindergarten_toys_footer_content_widget', 10 );

if( !function_exists('kindergarten_toys_footer_content_info') ):

    /**
     * Footer Copyright Area
    **/
    function kindergarten_toys_footer_content_info(){

        $kindergarten_toys_default = kindergarten_toys_get_default_theme_options(); ?>
        <div class="site-info">
            <div class="wrapper">
                <div class="column-row">
                    <div class="column column-9">
                        <div class="footer-credits">
                            <div class="footer-copyright">
                                <?php
                                $kindergarten_toys_footer_copyright_text = wp_kses_post( get_theme_mod( 'kindergarten_toys_footer_copyright_text', $kindergarten_toys_default['kindergarten_toys_footer_copyright_text'] ) );
                                    echo esc_html( $kindergarten_toys_footer_copyright_text );
                                    echo '<br>';
                                    echo esc_html__('Theme: ', 'kindergarten-toys') . '<a href="' . esc_url('https://www.omegathemes.com/products/free-kindergarten-wordpress-theme') . '" title="' . esc_attr__('Kindergarten Toys ', 'kindergarten-toys') . '" target="_blank"><span>' . esc_html__('Kindergarten Toys', 'kindergarten-toys') . '</span></a>' . esc_html__(' By ', 'kindergarten-toys') . '  <span>' . esc_html__('OMEGA ', 'kindergarten-toys') . '</span>';
                                    echo esc_html__('Powered by ', 'kindergarten-toys') . '<a href="' . esc_url('https://wordpress.org') . '" title="' . esc_attr__('WordPress', 'kindergarten-toys') . '" target="_blank"><span>' . esc_html__('WordPress.', 'kindergarten-toys') . '</span></a>';
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="column column-3 align-text-right">
                        <a class="to-the-top" href="#site-header">
                            <span class="to-the-top-long">
                                <?php if ( get_theme_mod('kindergarten_toys_enable_to_the_top', true) == true ) : ?>
                                    <?php
                                    $kindergarten_toys_to_the_top_text = get_theme_mod( 'kindergarten_toys_to_the_top_text', __( 'To the Top', 'kindergarten-toys' ) );
                                    printf( 
                                        wp_kses( 
                                            /* translators: %s is the arrow icon markup */
                                            '%s %s', 
                                            array( 'span' => array( 'class' => array(), 'aria-hidden' => array() ) ) 
                                        ), 
                                        esc_html( $kindergarten_toys_to_the_top_text ),
                                        '<span class="arrow" aria-hidden="true">&uarr;</span>' 
                                    );
                                    ?>
                                <?php endif; ?>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    <?php
    }

endif;

add_action( 'kindergarten_toys_footer_content_action','kindergarten_toys_footer_content_info',20 );


if( !function_exists( 'kindergarten_toys_main_slider' ) ) :

    function kindergarten_toys_main_slider(){

        $kindergarten_toys_default = kindergarten_toys_get_default_theme_options();

        $kindergarten_toys_slider_section_title = esc_html( get_theme_mod( 'kindergarten_toys_slider_section_title',
        $kindergarten_toys_default['kindergarten_toys_slider_section_title'] ) );

        $kindergarten_toys_header_banner = get_theme_mod( 'kindergarten_toys_header_banner', $kindergarten_toys_default['kindergarten_toys_header_banner'] );
        $kindergarten_toys_header_banner_cat = get_theme_mod( 'kindergarten_toys_header_banner_cat','Slider' );

        $kindergarten_toys_slider_button_url = esc_url( get_theme_mod( 'kindergarten_toys_slider_button_url',
        $kindergarten_toys_default['kindergarten_toys_slider_button_url'] ) );

        $kindergarten_toys_slider_button_text = esc_html( get_theme_mod( 'kindergarten_toys_slider_button_text',
        $kindergarten_toys_default['kindergarten_toys_slider_button_text'] ) );

        if( $kindergarten_toys_header_banner ){

            $kindergarten_toys_rtl = '';
            if( is_rtl() ){
                $kindergarten_toys_rtl = 'dir="rtl"';
            }

            $kindergarten_toys_banner_query = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 4,'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html( $kindergarten_toys_header_banner_cat ) ) );

            if( $kindergarten_toys_banner_query->have_posts() ): ?>

                <div class="theme-custom-block theme-banner-block">
                    <div class="swiper-container theme-main-carousel swiper-container" <?php echo $kindergarten_toys_rtl; ?>>
                        <div class="swiper-wrapper">
                            <?php
                            while( $kindergarten_toys_banner_query->have_posts() ):
                            $kindergarten_toys_banner_query->the_post();
                            $kindergarten_toys_featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                            $kindergarten_toys_featured_image = isset( $kindergarten_toys_featured_image[0] ) ? $kindergarten_toys_featured_image[0] : ''; ?>
                                <div class="swiper-slide main-carousel-item">                              
                                        <div class="theme-article-post">
                                            <div class="entry-thumbnail">
                                                <div class="data-bg data-bg-large" data-background="<?php if($kindergarten_toys_featured_image)  { echo esc_url($kindergarten_toys_featured_image); } else { echo esc_url(get_template_directory_uri() . '/assets/images/default.jpg'); } ?>">
                                                    <a href="<?php the_permalink(); ?>" class="theme-image-responsive" tabindex="0"></a>
                                                </div>
                                                <?php kindergarten_toys_post_format_icon(); ?>
                                            </div>
                                            <div class="main-carousel-caption">
                                                <div class="post-content">
                                                    <header class="entry-header">
                                                        <?php if( $kindergarten_toys_slider_section_title ){ ?>
                                                            <h3><?php echo esc_html( $kindergarten_toys_slider_section_title ); ?></h3>
                                                        <?php } ?>
                                                        <h2 class="entry-title entry-title-big">
                                                            <a href="<?php the_permalink(); ?>" rel="bookmark"><span><?php the_title(); ?></span></a>
                                                        </h2>
                                                    </header>
                                                    <?php if( $kindergarten_toys_slider_button_url || $kindergarten_toys_slider_button_text ){ ?>
                                                        <a href="<?php echo esc_url($kindergarten_toys_slider_button_url) ?>" class="slider-btn-1 btn-fancy btn-fancy-primary" tabindex="0">
                                                            <?php echo esc_html($kindergarten_toys_slider_button_text) ?>
                                                        </a>
                                                    <?php } ?>
                                                    <a href="<?php the_permalink(); ?>" class="btn-fancy btn-fancy-primary" tabindex="0">
                                                        <?php echo esc_html('Know More', 'kindergarten-toys'); ?>
                                                    </a>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

            <?php
            wp_reset_postdata();
            endif;
        }
    }

endif;


if( !function_exists( 'kindergarten_toys_product_section' ) ) :

    function kindergarten_toys_product_section(){ 

        $kindergarten_toys_default = kindergarten_toys_get_default_theme_options();
        $kindergarten_toys_locations_post = get_theme_mod( 'kindergarten_toys_locations_post', $kindergarten_toys_default['kindergarten_toys_locations_post'] );
        $kindergarten_toys_locations_post_cat = get_theme_mod( 'kindergarten_toys_locations_post_cat' );

        $kindergarten_toys_locations_query = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 9,'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html( $kindergarten_toys_locations_post_cat ) ) );

            if( $kindergarten_toys_locations_query->have_posts() ): ?>
        
            <div class="theme-product-block">
                <div class="wrapper">
                    <div class="owl-carousel" role="listbox">
                        <?php
                            $s=1;
                            while( $kindergarten_toys_locations_query->have_posts() ):
                            $kindergarten_toys_locations_query->the_post();
                            $kindergarten_toys_featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                            $kindergarten_toys_featured_image = isset( $kindergarten_toys_featured_image[0] ) ? $kindergarten_toys_featured_image[0] : ''; 
                            $kindergarten_toys_course_section_starting_date = esc_html( get_theme_mod( 'kindergarten_toys_course_section_starting_date'.$s,
                             ) );

                            $kindergarten_toys_course_section_class_time = esc_html( get_theme_mod( 'kindergarten_toys_course_section_class_time'.$s ) );

                            $kindergarten_toys_course_section_course_price = esc_html( get_theme_mod( 'kindergarten_toys_course_section_course_price'.$s,
                             ) );

                            $kindergarten_toys_course_section_student_age = esc_html( get_theme_mod( 'kindergarten_toys_course_section_student_age'.$s,
                            ) );
                            ?>                                
                            <div class="theme-article-post">
                                <div class="entry-thumbnail">
                                    <div class="data-bg featured-img" data-background="<?php echo esc_url($kindergarten_toys_featured_image ? $kindergarten_toys_featured_image : get_template_directory_uri() . '/assets/images/default.jpg'); ?>">
                                        <a href="<?php the_permalink(); ?>" class="theme-image-responsive" tabindex="0"></a>
                                    </div>
                                    <?php kindergarten_toys_post_format_icon(); ?>
                                </div>
                                <div class="main-owl-caption <?php echo ('catebox'.$s); ?>">
                                    <div class="post-content-location">
                                        <header class="entry-header">
                                            <h2 class="entry-title entry-title-big">
                                                <a href="<?php the_permalink(); ?>" rel="bookmark"><span><?php the_title(); ?></span></a>
                                            </h2>
                                        </header>
                                        <?php if( $kindergarten_toys_course_section_starting_date || $kindergarten_toys_course_section_course_price ){ ?>
                                        <hr>
                                        <div class="rating-box">
                                            <div class="course-start">
                                                <?php if( $kindergarten_toys_course_section_starting_date ){ ?>
                                                    <p><?php echo esc_html( $kindergarten_toys_course_section_starting_date ); ?></p>
                                                <?php } ?>
                                            </div>
                                            <div class="amount">
                                                <?php if( $kindergarten_toys_course_section_course_price ){ ?>
                                                    <h5><?php echo esc_html( $kindergarten_toys_course_section_course_price ); ?></h5>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <?php } ?>
                                    </div>
                                    <div class="post-days">
                                        <?php if( $kindergarten_toys_course_section_class_time ){ ?>
                                            <p><?php echo esc_html( $kindergarten_toys_course_section_class_time ); ?></p>
                                        <?php } ?>
                                    </div>
                                    <?php if( $kindergarten_toys_course_section_student_age ){ ?>
                                        <p class="location"><?php echo esc_html( $kindergarten_toys_course_section_student_age ); ?></p>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php $s++; endwhile; ?>
                    </div>
                </div>
            </div>
             <?php
            wp_reset_postdata();
            endif;
          ?>
    <?php }

endif;

if (!function_exists('kindergarten_toys_post_format_icon')):

    // Post Format Icon.
    function kindergarten_toys_post_format_icon() {

        $kindergarten_toys_format = get_post_format(get_the_ID()) ?: 'standard';
        $kindergarten_toys_icon = '';
        $kindergarten_toys_title = '';
        if( $kindergarten_toys_format == 'video' ){
            $kindergarten_toys_icon = kindergarten_toys_get_theme_svg( 'video' );
            $kindergarten_toys_title = esc_html__('Video','kindergarten-toys');
        }elseif( $kindergarten_toys_format == 'audio' ){
            $kindergarten_toys_icon = kindergarten_toys_get_theme_svg( 'audio' );
            $kindergarten_toys_title = esc_html__('Audio','kindergarten-toys');
        }elseif( $kindergarten_toys_format == 'gallery' ){
            $kindergarten_toys_icon = kindergarten_toys_get_theme_svg( 'gallery' );
            $kindergarten_toys_title = esc_html__('Gallery','kindergarten-toys');
        }elseif( $kindergarten_toys_format == 'quote' ){
            $kindergarten_toys_icon = kindergarten_toys_get_theme_svg( 'quote' );
            $kindergarten_toys_title = esc_html__('Quote','kindergarten-toys');
        }elseif( $kindergarten_toys_format == 'image' ){
            $kindergarten_toys_icon = kindergarten_toys_get_theme_svg( 'image' );
            $kindergarten_toys_title = esc_html__('Image','kindergarten-toys');
        } elseif( $kindergarten_toys_format == 'link' ){
            $kindergarten_toys_icon = kindergarten_toys_get_theme_svg( 'link' );
            $kindergarten_toys_title = esc_html__('Link','kindergarten-toys');
        } elseif( $kindergarten_toys_format == 'status' ){
            $kindergarten_toys_icon = kindergarten_toys_get_theme_svg( 'status' );
            $kindergarten_toys_title = esc_html__('Status','kindergarten-toys');
        } elseif( $kindergarten_toys_format == 'aside' ){
            $kindergarten_toys_icon = kindergarten_toys_get_theme_svg( 'aside' );
            $kindergarten_toys_title = esc_html__('Aside','kindergarten-toys');
        } elseif( $kindergarten_toys_format == 'chat' ){
            $kindergarten_toys_icon = kindergarten_toys_get_theme_svg( 'chat' );
            $kindergarten_toys_title = esc_html__('Chat','kindergarten-toys');
        }
        
        if (!empty($kindergarten_toys_icon)) { ?>
            <div class="theme-post-format">
                <span class="post-format-icom"><?php echo kindergarten_toys_svg_escape($kindergarten_toys_icon); ?></span>
                <?php if( $kindergarten_toys_title ){ echo '<span class="post-format-label">'.esc_html( $kindergarten_toys_title ).'</span>'; } ?>
            </div>
        <?php }
    }

endif;

if ( ! function_exists( 'kindergarten_toys_svg_escape' ) ):

    /**
     * Get information about the SVG icon.
     *
     * @param string $kindergarten_toys_svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function kindergarten_toys_svg_escape( $kindergarten_toys_input ) {

        // Make sure that only our allowed tags and attributes are included.
        $kindergarten_toys_svg = wp_kses(
            $kindergarten_toys_input,
            array(
                'svg'     => array(
                    'class'       => true,
                    'xmlns'       => true,
                    'width'       => true,
                    'height'      => true,
                    'viewbox'     => true,
                    'aria-hidden' => true,
                    'role'        => true,
                    'focusable'   => true,
                ),
                'path'    => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'd'         => true,
                    'transform' => true,
                ),
                'polygon' => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'points'    => true,
                    'transform' => true,
                    'focusable' => true,
                ),
            )
        );

        if ( ! $kindergarten_toys_svg ) {
            return false;
        }

        return $kindergarten_toys_svg;

    }

endif;

if( !function_exists( 'kindergarten_toys_sanitize_sidebar_option_meta' ) ) :

    // Sidebar Option Sanitize.
    function kindergarten_toys_sanitize_sidebar_option_meta( $kindergarten_toys_input ){

        $kindergarten_toys_metabox_options = array( 'global-sidebar','left-sidebar','right-sidebar','no-sidebar' );
        if( in_array( $kindergarten_toys_input,$kindergarten_toys_metabox_options ) ){

            return $kindergarten_toys_input;

        }else{

            return '';

        }
    }

endif;

if( !function_exists( 'kindergarten_toys_sanitize_pagination_meta' ) ) :

    // Sidebar Option Sanitize.
    function kindergarten_toys_sanitize_pagination_meta( $kindergarten_toys_input ){

        $kindergarten_toys_metabox_options = array( 'Center','Right','Left');
        if( in_array( $kindergarten_toys_input,$kindergarten_toys_metabox_options ) ){

            return $kindergarten_toys_input;

        }else{

            return '';

        }
    }

endif;

if( !function_exists( 'kindergarten_toys_sanitize_menu_transform' ) ) :

    // Sidebar Option Sanitize.
    function kindergarten_toys_sanitize_menu_transform( $kindergarten_toys_input ){

        $kindergarten_toys_metabox_options = array( 'capitalize','uppercase','lowercase');
        if( in_array( $kindergarten_toys_input,$kindergarten_toys_metabox_options ) ){

            return $kindergarten_toys_input;

        }else{

            return '';

        }
    }

endif;

if( !function_exists( 'kindergarten_toys_sanitize_page_content_alignment' ) ) :

    // Sidebar Option Sanitize.
    function kindergarten_toys_sanitize_page_content_alignment( $kindergarten_toys_input ){

        $kindergarten_toys_metabox_options = array( 'left','center','right');
        if( in_array( $kindergarten_toys_input,$kindergarten_toys_metabox_options ) ){

            return $kindergarten_toys_input;

        }else{

            return '';

        }
    }

endif;

if( !function_exists( 'kindergarten_toys_sanitize_footer_widget_title_alignment' ) ) :

    // Footer Option Sanitize.
    function kindergarten_toys_sanitize_footer_widget_title_alignment( $kindergarten_toys_input ){

        $kindergarten_toys_metabox_options = array( 'left','center','right');
        if( in_array( $kindergarten_toys_input,$kindergarten_toys_metabox_options ) ){

            return $kindergarten_toys_input;

        }else{

            return '';

        }
    }

endif;

if( !function_exists( 'kindergarten_toys_sanitize_pagination_type' ) ) :

    /**
     * Sanitize the pagination type setting.
     *
     * @param string $kindergarten_toys_input The input value from the Customizer.
     * @return string The sanitized value.
     */
    function kindergarten_toys_sanitize_pagination_type( $kindergarten_toys_input ) {
        // Define valid options for the pagination type.
        $kindergarten_toys_valid_options = array( 'numeric', 'newer_older' ); // Update valid options to include 'newer_older'

        // If the input is one of the valid options, return it. Otherwise, return the default option ('numeric').
        if ( in_array( $kindergarten_toys_input, $kindergarten_toys_valid_options, true ) ) {
            return $kindergarten_toys_input;
        } else {
            // Return 'numeric' as the fallback if the input is invalid.
            return 'numeric';
        }
    }

endif;


// Sanitize the enable/disable setting for pagination
if( !function_exists('kindergarten_toys_sanitize_enable_pagination') ) :
    function kindergarten_toys_sanitize_enable_pagination( $kindergarten_toys_input ) {
        return (bool) $kindergarten_toys_input;
    }
endif;

if( !function_exists( 'kindergarten_toys_sanitize_copyright_alignment_meta' ) ) :

    // Sidebar Option Sanitize.
    function kindergarten_toys_sanitize_copyright_alignment_meta( $kindergarten_toys_input ){

        $kindergarten_toys_metabox_options = array( 'Default','Reverse','Center');
        if( in_array( $kindergarten_toys_input,$kindergarten_toys_metabox_options ) ){

            return $kindergarten_toys_input;

        }else{

            return '';

        }
    }

endif;

/**
 * Sidebar Layout Function
 */
function kindergarten_toys_get_final_sidebar_layout() {
	$kindergarten_toys_defaults       = kindergarten_toys_get_default_theme_options();
	$kindergarten_toys_global_layout  = get_theme_mod('kindergarten_toys_global_sidebar_layout', $kindergarten_toys_defaults['kindergarten_toys_global_sidebar_layout']);
	$kindergarten_toys_page_layout    = get_theme_mod('kindergarten_toys_page_sidebar_layout', $kindergarten_toys_global_layout);
	$kindergarten_toys_post_layout    = get_theme_mod('kindergarten_toys_post_sidebar_layout', $kindergarten_toys_global_layout);
	$kindergarten_toys_meta_layout    = get_post_meta(get_the_ID(), 'kindergarten_toys_post_sidebar_option', true);

	if (!empty($kindergarten_toys_meta_layout) && $kindergarten_toys_meta_layout !== 'default') {
		return $kindergarten_toys_meta_layout;
	}
	if (is_page() || (function_exists('is_shop') && is_shop())) {
		return $kindergarten_toys_page_layout;
	}
	if (is_single()) {
		return $kindergarten_toys_post_layout;
	}
	return $kindergarten_toys_global_layout;
}