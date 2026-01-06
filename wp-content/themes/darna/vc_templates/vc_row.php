<?php
if(!function_exists('vc_map_get_attributes'))
{
    /** @var $this WPBakeryShortCode_VC_Row */
    $video_link=$css_animation = $duration = $delay=$output = $style_css = $layout = $parallax_style = $parallax_scroll_effect = $parallax_speed = $overlay_set = $overlay_color = $overlay_image = $overlay_opacity = $el_id = $el_class = $bg_image = $bg_color = $bg_image_repeat = $pos = $font_color = $padding = $margin_bottom = $css = '';
    extract( shortcode_atts( array(
        'el_class'        => '',
        'el_id'           => '',
        'bg_image'        => '',
        'bg_color'        => '',
        'bg_image_repeat' => '',
        'font_color'      => '',
        'padding'         => '',
        'margin_bottom'   => '',
        'css'             => '',
        'layout'          => '',
        'parallax_style'  => 'none',
        'video_link'      => '',
        'parallax_scroll_effect'  => '',
        'parallax_speed'  => '',
        'overlay_set'     => 'hide_overlay',
        'overlay_color'   => '',
        'overlay_image'   => '',
        'overlay_opacity' => '',
        'css_animation'   => '',
        'duration'        => '',
        'delay'           => ''
    ), $atts ) );

    // wp_enqueue_style( 'js_composer_front' );
    wp_enqueue_script( 'wpb_composer_front_js' );
    // wp_enqueue_style('js_composer_custom_css');

    $el_class = $this->getExtraClass( $el_class );

    $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row ' . ( $this->settings( 'base' ) === 'vc_row_inner' ? 'vc_inner ' : '' ) . get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

    $style = $this->buildStyle( $bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom );
    $str_el_id='';
    $css_overlay_video='';
    if($el_id!='')
    {
        $str_el_id='id="'.esc_attr($el_id).'"';
    }
    if ( $layout == 'boxed' ) {
        $style_css='container';
    } elseif ( $layout == 'container-fluid' ) {
        $style_css='container-fluid';
    }else
    {
        $style_css='fullwidth';
    }
    $output .= '<div '.$str_el_id.' class="'.$style_css . g5plus_get_css_animation($css_animation) .'" '.g5plus_get_style_animation($duration,$delay).'>';
    if ($parallax_style != 'none' && $parallax_style != 'video-background') {
        if($overlay_set!='hide_overlay'){
            $css_overlay_video=' overlay-wapper';
        }
        $output .= '<div data-parallax_speed="'.(esc_attr($parallax_speed)/100) .'" data-scroll_effect="'.esc_attr($parallax_scroll_effect).'" class="' . esc_attr($css_class) .  ' '.esc_attr($parallax_style).$css_overlay_video.'"' . $style .'>';
    }
    else
    {
        if($overlay_set!='hide_overlay'){
            $css_overlay_video=' overlay-wapper';
        }
        if ($parallax_style == 'video-background') {
            $css_overlay_video.=' video-background-wapper';
        }
        $output .= '<div class="' . esc_attr($css_class) . $css_overlay_video.'"' . $style .'>';
    }
    if ($parallax_style == 'video-background') {
        $output .= '<video muted="muted" loop="loop" autoplay="true" preload="auto">
                    <source src="' . esc_url($video_link) . '">
                </video>';
    }
    if($overlay_set!='hide_overlay'){
        $overlay_id='overlay-'.uniqid();
        if($overlay_set=='show_overlay_color'){
            $overlay_color = g5plus_convert_hex_to_rgba(esc_attr($overlay_color),(esc_attr($overlay_opacity)/100));
            $style_css=' data-overlay_color= '.esc_attr($overlay_color);
        }
        else if($overlay_set=='show_overlay_image'){
            $image_attributes = wp_get_attachment_image_src( $overlay_image,'full' );
            $style_css=' data-overlay_image= '.$image_attributes[0].' data-overlay_opacity='.(esc_attr($overlay_opacity)/100);
        }
        $output .= '<div id="'.$overlay_id.'" class="overlay" '.$style_css.'></div>';
    }
    $output .= wpb_js_remove_wpautop( $content );
    $output .= '</div></div>';
    echo !empty( $output ) ? $output : '';
}
else
{
    /**
     * Shortcode attributes
     * @var $atts
     * @var $layout
     * @var $overlay_set
     * @var $overlay_image
     * @var $overlay_color
     * @var $overlay_opacity
     * @var $el_class
     * @var $full_width
     * @var $full_height
     * @var $content_placement
     * @var $parallax
     * @var $parallax_image
     * @var $parallax_speed
     * @var $css
     * @var $el_id
     * @var $css_animation
     * @var $duration
     * @var $delay
     * @var $video_bg
     * @var $video_bg_url
     * @var $video_bg_parallax
     * @var $content - shortcode content
     * Shortcode class
     * @var $this WPBakeryShortCode_VC_Row
     */
    $output = $str_el_id = $layout = $overlay_set = $overlay_image = $overlay_color = $overlay_opacity = $el_class = $full_width = $full_height = $content_placement = $parallax = $parallax_image = $parallax_speed = $css = $el_id = $css_animation = $duration = $delay = $video_bg = $video_bg_url = $video_bg_parallax = '';
    $atts = vc_map_get_attributes($this->getShortcode(), $atts);
    extract($atts);

    wp_enqueue_script('wpb_composer_front_js');

    $el_class = $this->getExtraClass($el_class);

    $css_classes = array(
        'vc_row',
        'wpb_row', //deprecated
        'vc_row-fluid',
        $el_class,
        vc_shortcode_custom_css_class($css),
    );
    $wrapper_attributes = array();
    // build attributes for wrapper
    if (!empty($full_height)) {
        $css_classes[] = ' vc_row-o-full-height';
        if (!empty($content_placement)) {
            $css_classes[] = ' vc_row-o-content-' . $content_placement;
        }
    }

    $has_video_bg = (!empty($video_bg) && !empty($video_bg_url) && vc_extract_youtube_id($video_bg_url));

    if ($has_video_bg) {
        $parallax = $video_bg_parallax;
        $parallax_image = $video_bg_url;
        $css_classes[] = ' vc_video-bg-container';
        wp_enqueue_script('vc_youtube_iframe_api_js');
    }

    if (!empty($parallax)) {
        wp_enqueue_script('vc_jquery_skrollr_js');
        $wrapper_attributes[] = 'data-vc-parallax="' . esc_attr($parallax_speed) . '"'; // parallax speed
        $css_classes[] = 'vc_general vc_parallax vc_parallax-' . $parallax;
        if (strpos($parallax, 'fade') !== false) {
            $css_classes[] = 'js-vc_parallax-o-fade';
            $wrapper_attributes[] = 'data-vc-parallax-o-fade="on"';
        } elseif (strpos($parallax, 'fixed') !== false) {
            $css_classes[] = 'js-vc_parallax-o-fixed';
        }
    }

    if (!empty ($parallax_image)) {
        if ($has_video_bg) {
            $parallax_image_src = $parallax_image;
        } else {
            $parallax_image_id = preg_replace('/[^\d]/', '', $parallax_image);
            $parallax_image_src = wp_get_attachment_image_src($parallax_image_id, 'full');
            if (!empty($parallax_image_src[0])) {
                $parallax_image_src = $parallax_image_src[0];
            }
        }
        $wrapper_attributes[] = 'data-vc-parallax-image="' . esc_attr($parallax_image_src) . '"';
    }
    if (!$parallax && $has_video_bg) {
        $wrapper_attributes[] = 'data-vc-video-bg="' . esc_attr($video_bg_url) . '"';
    }
    $css_class = preg_replace('/\s+/', ' ', apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode(' ', array_filter($css_classes)), $this->settings['base'], $atts));

    if ($overlay_set != 'hide_overlay') {
        $css_class .= ' overlay-bg-vc-wapper';
        if ($overlay_set == 'show_overlay_color') {
            $overlay_color = g5plus_convert_hex_to_rgba(esc_attr($overlay_color), (esc_attr($overlay_opacity) / 100));
            $wrapper_attributes[] = 'data-overlay-color="' . esc_attr($overlay_color) . '"';
        } else if ($overlay_set == 'show_overlay_image') {
            $image_attributes = wp_get_attachment_image_src($overlay_image, 'full');
            $wrapper_attributes[] = 'data-overlay-image="' . $image_attributes[0] . '"';
            $wrapper_attributes[] = 'data-overlay-opacity="' . (esc_attr($overlay_opacity) / 100) . '"';
        }
    }
    $wrapper_attributes[] = 'class="' . esc_attr(trim($css_class)) . '"';
    if (!empty($el_id)) {
        $str_el_id = ' id="' . esc_attr($el_id) . '" ';
    }
    if ($layout == 'boxed') {
        $style_layout = 'container';
    } elseif ($layout == 'container-fluid') {
        $style_layout = 'container-fluid';
    } else {
        $style_layout = 'fullwidth';
    }

    $output .= '<div' . $str_el_id . ' class="' . $style_layout . g5plus_get_css_animation($css_animation) . '" ' . g5plus_get_style_animation($duration, $delay) . '>';
    $output .= '<div ' . implode(' ', $wrapper_attributes) . '>';
    $output .= wpb_js_remove_wpautop($content);
    $output .= '</div></div>';
    echo !empty($output) ? $output : '';
}