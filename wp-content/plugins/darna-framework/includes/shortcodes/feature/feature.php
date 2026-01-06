<?php
// don't load directly
if (!defined('ABSPATH')) die('-1');
if (!class_exists('g5plusFramework_Shortcode_Feature')) {
	class g5plusFramework_Shortcode_Feature
	{
		function __construct()
		{
			add_shortcode('darna_feature', array($this, 'feature_shortcode'));
		}

		function feature_shortcode($atts)
		{
			$layout_style = $video_url = $description = $title = $icon = $link = $image = $html = $el_class = $g5plus_animation = $css_animation = $duration = $delay = $styles_animation = '';
			extract(shortcode_atts(array(
				'layout_style' => 'style1',
				'image' => '',
				'video_url' => '',
				'title' => '',
				'description' => '',
				'icon' => '',
				'link' => '',
				'el_class' => '',
				'css_animation' => '',
				'duration' => '',
				'delay' => ''
			), $atts));
			$g5plus_animation .= ' ' . esc_attr($el_class);
			$g5plus_animation .= g5plusFramework_Shortcodes::g5plus_get_css_animation($css_animation);

			$thumbnail_url = '';
			$width = 370;
			$height = 280;
			if (!empty($image)) {
				if (function_exists('matthewruddy_image_resize_id')) {
					$thumbnail_url = matthewruddy_image_resize_id($image,$width, $height);
				}
			}
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
				class="darna-feature <?php echo esc_attr($layout_style) ?> <?php echo esc_attr($g5plus_animation) ?>" <?php echo g5plusFramework_Shortcodes::g5plus_get_style_animation($duration, $delay); ?>>
				<div class="darna-feature-thumb">
					<?php if ($video_url != ''): ?>
						<a data-rel="prettyPhoto[feature]" href="<?php
						echo esc_url($video_url);?>">
							<img alt="<?php echo esc_html($title); ?>" src="<?php echo esc_url($thumbnail_url); ?>">
							<span><i class="fa fa-play-circle"></i></span>
						</a>
					<?php else: ?>
						<a data-rel="prettyPhoto[feature]" href="<?php echo esc_url($thumbnail_url); ?>">
							<img alt="<?php echo esc_html($title); ?>" src="<?php echo esc_url($thumbnail_url); ?>">
						</a>
					<?php endif; ?>
				</div>
				<div class="darna-feature-content">
					<h4>
						<?php if ($icon != ''): ?>
							<i class="<?php echo esc_attr($icon); ?>"></i>
						<?php endif; ?>
						<a target="<?php echo esc_attr($a_target) ?>"
						   href="<?php echo esc_url($a_href); ?>"><?php echo esc_html($title); ?></a>
					</h4>

					<p><?php echo esc_html($description); ?></p>
					<?php if ($a_title != ''): ?>
						<a class="darna-button style4 size-xs" target="<?php echo esc_attr($a_target) ?>"
						   href="<?php echo esc_url($a_href); ?>"><?php echo esc_html($a_title); ?></a>
					<?php endif; ?>
				</div>
			</div>
			<?php
			$content = ob_get_clean();
			return $content;
		}
	}

	new g5plusFramework_Shortcode_Feature();
}