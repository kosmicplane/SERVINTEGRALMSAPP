<?php
// don't load directly
if (!defined('ABSPATH')) die('-1');
if (!class_exists('g5plusFramework_Shortcode_Icon_Box')) {
	class g5plusFramework_Shortcode_Icon_Box
	{
		function __construct()
		{
			add_shortcode('darna_icon_box', array($this, 'icon_box_shortcode'));
		}

		function icon_box_shortcode($atts)
		{
			$icon_type = $image = $layout_style = $link = $description = $title = $icon = $html = $el_class = $g5plus_animation = $css_animation = $duration = $delay = $styles_animation = '';
			extract(shortcode_atts(array(
				'layout_style' => 'style1',
				'icon_type' => 'font-icon',
				'icon' => '',
				'image' => '',
				'link' => '',
				'title' => '',
				'description' => '',
				'el_class' => '',
				'css_animation' => '',
				'duration' => '',
				'delay' => ''
			), $atts));
			$g5plus_animation .= ' ' . esc_attr($el_class);
			$g5plus_animation .= g5plusFramework_Shortcodes::g5plus_get_css_animation($css_animation);
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
			ob_start();?>
			<div
				class="darna-icon-box <?php echo esc_attr($layout_style) ?><?php echo esc_attr($g5plus_animation) ?>" <?php echo g5plusFramework_Shortcodes::g5plus_get_style_animation($duration, $delay); ?>>
				<a class="ibox-icon" title="<?php echo esc_attr($a_title); ?>"
				   target="<?php echo trim(esc_attr($a_target)); ?>" href="<?php echo esc_url($a_href) ?>">
					<?php if ($icon_type == 'font-icon') : ?>
						<i class="<?php echo esc_attr($icon) ?>"></i>
					<?php
					else :
						$img = wp_get_attachment_image_src($image, 'large');
						?>
						<img src="<?php echo esc_url($img[0]) ?>"/>
					<?php endif; ?>
				</a>
				<?php if ($title != ''): ?>
					<h3><a title="<?php echo esc_attr($a_title); ?>" target="<?php echo trim(esc_attr($a_target)); ?>"
					       href="<?php echo esc_url($a_href) ?>"><?php echo esc_html($title) ?></a></h3>
				<?php endif;
				if ($description != ''):?>
					<p><?php echo wp_kses_post($description) ?></p>
				<?php endif; ?>
			</div>
			<?php
			$content = ob_get_clean();
			return $content;
		}
	}

	new g5plusFramework_Shortcode_Icon_Box();
}