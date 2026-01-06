<?php
// don't load directly
if (!defined('ABSPATH')) die('-1');
if (!class_exists('g5plusFramework_Shortcode_Services')) {
    class g5plusFramework_Shortcode_Services
    {
        function __construct()
        {
            add_shortcode('darna_services_ctn', array($this, 'services_ctn_shortcode'));
            add_shortcode('darna_services_sc', array($this, 'services_sc_shortcode'));
        }

        function services_ctn_shortcode($atts, $content)
        {
            $rewindspeed = $paginationspeed = $slidespeed = $autoheight = $itemsscaleup = $itemsmobile = $itemstabletsmall = $itemstablet = $itemsdesktopsmall = $itemsdesktop = $items = $autoplay = $stoponhover = $singleitem = $pagination = $navigation = $el_class = $g5plus_animation = $css_animation = $duration = $delay = '';
            extract(shortcode_atts(array(
                'navigation' => 'yes',
                'pagination' => 'false',
                'singleitem' => 'false',
                'stoponhover' => 'false',
                'autoplay' => '5000',
                'items' => '4',
                'itemsdesktop' => '1199,4',
                'itemsdesktopsmall' => '979,4',
                'itemstablet' => '768,2',
                'itemstabletsmall' => 'false',
                'itemsmobile' => '479,1',
                'itemsscaleup' => 'false',
                'autoheight' => 'false',
                'slidespeed' => '',
                'paginationspeed' => '',
                'rewindspeed' => '',
                'el_class' => '',
                'css_animation' => '',
                'duration' => '',
                'delay' => ''
            ), $atts));
            $g5plus_animation .= ' ' . esc_attr($el_class);
            $g5plus_animation .= g5plusFramework_Shortcodes::g5plus_get_css_animation($css_animation);
            $data_carousel = '';

            $pagination = ($pagination == 'yes') ? 'true' : 'false';
            $navigation = ($navigation == 'yes') ? 'true' : 'false';
            $singleitem = ($singleitem == 'yes') ? 'true' : 'false';
            $stoponhover = ($stoponhover == 'yes') ? 'true' : 'false';
            $autoheight = ($autoheight == 'yes') ? 'true' : 'false';

            $data_carousel .= ',"navigation":' . $navigation;
            $data_carousel .= ',"pagination":' . $pagination;
            $data_carousel .= ',"singleItem":' . $singleitem;
            $data_carousel .= ',"stopOnHover":' . $stoponhover;
            $data_carousel .= ',"autoHeight":' . $autoheight;
            if ($autoplay != '') {
                $data_carousel .= ',"autoPlay":' . $autoplay;
            }
            if ($items != '') {
                $data_carousel .= ',"items":' . $items;
            }
            if ($itemsdesktop != '') {
                if ($itemsdesktop != 'false') {
                    $data_carousel .= ',"itemsDesktop":[' . $itemsdesktop . ']';
                } else {
                    $data_carousel .= ',"itemsDesktop":' . $itemsdesktop;
                }
            }
            if ($itemsdesktopsmall != '') {
                if ($itemsdesktopsmall != 'false') {
                    $data_carousel .= ',"itemsDesktopSmall":[' . $itemsdesktopsmall . ']';
                } else {
                    $data_carousel .= ',"itemsDesktopSmall":' . $itemsdesktopsmall;
                }

            }
            if ($itemstablet != '') {
                if ($itemstablet != 'false') {
                    $data_carousel .= ',"itemsTablet":[' . $itemstablet . ']';
                } else {
                    $data_carousel .= ',"itemsTablet":' . $itemstablet;
                }
            }
            if ($itemstabletsmall != '') {
                if ($itemstabletsmall != 'false') {
                    $data_carousel .= ',"itemsTabletSmall":[' . $itemstabletsmall . ']';
                } else {
                    $data_carousel .= ',"itemsTabletSmall":' . $itemstabletsmall;
                }
            }
            if ($itemsmobile != '') {
                if ($itemsmobile != 'false') {
                    $data_carousel .= ',"itemsMobile":[' . $itemsmobile . ']';
                } else {
                    $data_carousel .= ',"itemsMobile":' . $itemsmobile;
                }
            }
            if ($itemsscaleup != '') {
                $data_carousel .= ',"itemsScaleUp":' . $itemsscaleup;
            }
            if ($slidespeed != '') {
                $data_carousel .= ',"slideSpeed":' . $slidespeed;
            }
            if ($paginationspeed != '') {
                $data_carousel .= ',"paginationSpeed":' . $paginationspeed;
            }
            if ($rewindspeed != '') {
                $data_carousel .= ',"rewindSpeed":' . $rewindspeed;
            }
            $data_carousel = substr($data_carousel, 1);
            ob_start();?>
            <div data-plugin-options='{<?php echo esc_attr($data_carousel) ?>}'
                 class="darna-services owl-carousel <?php echo esc_attr($g5plus_animation) ?>" <?php echo g5plusFramework_Shortcodes::g5plus_get_style_animation($duration, $delay); ?>>
                <?php echo do_shortcode($content) ?>
            </div>
            <?php
            $output = ob_get_clean();
            return $output;
        }

        function services_sc_shortcode($atts)
        {
            $link = $title = $description = $icon = $image = '';
            extract(shortcode_atts(array(
                'icon' => '',
                'image' => '',
                'title' => '',
                'description' => '',
                'link' => '',
            ), $atts));
            //parse link
            $link = ($link == '||') ? '' : $link;
            $link = vc_build_link($link);

            $a_title = '';
            $a_target ='_self';
            $a_href = '#';

            if (strlen($link['url']) > 0) {
                $a_href = $link['url'];
                $a_title = $link['title'];
                $a_target = strlen($link['target']) > 0 ? $link['target'] : '_self';
            }
            $img = wp_get_attachment_image_src($image, '290x270');
            ob_start(); ?>
            <div class="darna-services-item" style="background-image: url(<?php echo esc_attr($img[0]) ?>)">
                <div class="content-middle">
                     <div class="content-middle-inner">
                         <?php if ($icon != '') : ?>
                             <i class="<?php echo esc_attr($icon) ?>"></i>
                         <?php endif; ?>
                         <?php if ($title != ''): ?>
                             <h3><a title="<?php echo esc_attr($a_title); ?>" target="<?php echo trim(esc_attr($a_target)); ?>"
                                    href="<?php echo esc_url($a_href) ?>"><?php echo esc_html($title) ?></a></h3>
                         <?php endif;
                         if ($description != ''):?>
                             <p><?php echo wp_kses_post($description) ?></p>
                         <?php endif; ?>
                     </div>
                </div>
            </div>
            <?php
            $output = ob_get_clean();
            return $output;
        }
    }

    new g5plusFramework_Shortcode_Services();
}
if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_darna_services_ctn extends WPBakeryShortCodesContainer
    {
    }
}
if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_darna_services_sc extends WPBakeryShortCode
    {
    }
}
?>
