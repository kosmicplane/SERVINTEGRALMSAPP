<?php
// don't load directly
if (!defined('ABSPATH')) die('-1');
if (!class_exists('g5plusFramework_Shortcode_Testimonial')) {
	class g5plusFramework_Shortcode_Testimonial
	{
		function __construct()
		{
			add_shortcode('darna_testimonial_ctn', array($this, 'testimonial_ctn_shortcode'));
			add_shortcode('darna_testimonial_sc', array($this, 'testimonial_sc_shortcode'));
		}

		function testimonial_ctn_shortcode($atts, $content)
		{
			$layout_style = $rewindspeed = $paginationspeed = $slidespeed = $autoheight = $autoplay = $stoponhover = $el_class = $g5plus_animation = $css_animation = $duration = $delay = '';
			extract(shortcode_atts(array(
				'layout_style' => 'style1',
				'stoponhover' => 'false',
				'autoplay' => 'true',
				'autoheight' => 'true',
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
			if ($layout_style == 'style1') {
				$data_carousel = '"navigation":true,"pagination":false,"singleItem":true,"transitionStyle":"fade"';
			} else {
				$data_carousel = '"navigation":false,"pagination":true,"singleItem":true,"transitionStyle":"fade"';
			}
			$stoponhover = ($stoponhover == 'yes') ? 'true' : 'false';
			$autoheight = ($autoheight == 'yes') ? 'true' : 'false';

			$data_carousel .= ',"stopOnHover":' . $stoponhover;
			$data_carousel .= ',"autoHeight":' . $autoheight;
			if ($autoplay != '') {
				$data_carousel .= ',"autoPlay":' . $autoplay;
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
			ob_start();?>
			<div data-plugin-options='{<?php echo esc_attr($data_carousel) ?>}'
			     class="darna-testimonial <?php echo esc_attr($layout_style) ?> owl-carousel <?php echo esc_attr($g5plus_animation) ?>" <?php echo g5plusFramework_Shortcodes::g5plus_get_style_animation($duration, $delay); ?>>
				<?php echo do_shortcode($content) ?>
			</div>
			<?php
			$output = ob_get_clean();
			return $output;
		}

		function testimonial_sc_shortcode($atts, $content = null)
		{
			$author = $author_info = '';
			extract(shortcode_atts(array(
				'author' => '',
				'author_info' => ''
			), $atts));
			ob_start();?>
			<div class="darna-testimonial-item">
				<p><?php echo wp_strip_all_tags($content) ?></p>
				<?php if ($author != ''): ?>
					<h6><?php echo esc_html($author) ?></h6>
				<?php endif;
				if ($author_info != ''):?>
					<span><?php echo esc_html($author_info) ?></span>
				<?php endif; ?>
			</div>
			<?php
			$output = ob_get_clean();
			return $output;
		}
	}

	new g5plusFramework_Shortcode_Testimonial();
}
if (class_exists('WPBakeryShortCodesContainer')) {
	class WPBakeryShortCode_darna_testimonial_ctn extends WPBakeryShortCodesContainer
	{
	}
}
if (class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_darna_testimonial_sc extends WPBakeryShortCode
	{
	}
}
?>
