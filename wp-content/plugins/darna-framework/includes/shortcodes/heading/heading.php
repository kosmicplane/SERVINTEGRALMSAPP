<?php
// don't load directly
if (!defined('ABSPATH')) die('-1');
if (!class_exists('g5plusFramework_Shortcode_Heading')) {
	class g5plusFramework_Shortcode_Heading
	{
		function __construct()
		{
			add_shortcode('darna_heading', array($this, 'heading_shortcode'));
		}

		function heading_shortcode($atts)
		{
			$sub_title = $title = $layout_style = $title = $html = $el_class = $g5plus_animation = $css_animation = $duration = $delay = $styles_animation = '';
			extract(shortcode_atts(array(
				'layout_style' => 'style1',
				'title' => '',
				'sub_title' => '',
				'el_class' => '',
				'css_animation' => '',
				'duration' => '',
				'delay' => ''
			), $atts));
			$g5plus_animation .= ' ' . esc_attr($el_class);
			$g5plus_animation .= g5plusFramework_Shortcodes::g5plus_get_css_animation($css_animation);
			ob_start();?>
			<div
				class="darna-heading <?php echo esc_attr($layout_style) ?><?php echo esc_attr($g5plus_animation) ?>" <?php echo g5plusFramework_Shortcodes::g5plus_get_style_animation($duration, $delay); ?>>
				<?php if ($title != ''): ?>
					<h2><?php echo wp_kses_post($title) ?></h2>
				<?php endif; ?>
				<?php if ($sub_title != ''): ?>
					<p><?php echo wp_kses_post($sub_title) ?></p>
				<?php endif; ?>
			</div>
			<?php
			$content = ob_get_clean();
			return $content;
		}
	}

	new g5plusFramework_Shortcode_Heading();
}