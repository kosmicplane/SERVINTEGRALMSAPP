<?php
// don't load directly
if (!defined('ABSPATH')) die('-1');
if (!class_exists('g5plusFramework_Shortcode_Video_Bg')) {
	class g5plusFramework_Shortcode_Video_Bg
	{
		function __construct()
		{
			add_shortcode('darna_video_bg', array($this, 'video_bg_shortcode'));
		}

		function video_bg_shortcode($atts)
		{
			$autoplay = $layout_style = $video_link = $description = $title = $image = $el_class = $g5plus_animation = $css_animation = $duration = $delay = '';
			extract(shortcode_atts(array(
				'layout_style' => 'style1',
				'video_link' => '',
				'title' => '',
				'description' => '',
				'image' => '',
				'autoplay' => 'false',
				'el_class' => '',
				'css_animation' => '',
				'duration' => '',
				'delay' => ''
			), $atts));
			$g5plus_animation .= ' ' . esc_attr($el_class);
			$g5plus_animation .= g5plusFramework_Shortcodes::g5plus_get_css_animation($css_animation);
			$number_id = 'video-bg-' . uniqid();
			$img = wp_get_attachment_image_src($image, 'full');
			$style_autoplay = ' style="display: none;"';
			$icon = "fa fa-play";
			if ($autoplay == 'yes') {
				$icon = "fa fa-pause";
				$style_autoplay = '';
			}
			ob_start();?>
			<div
				class="darna-video-bg <?php echo esc_attr($layout_style); ?> <?php echo esc_attr($g5plus_animation) ?>" <?php echo g5plusFramework_Shortcodes::g5plus_get_style_animation($duration, $delay); ?>>
				<?php if ($autoplay != 'yes'): ?>
					<div class="video-play video-bg-img"
					     style="background-image: url(<?php echo esc_url($img[0]); ?>);"></div>
				<?php endif; ?>
				<div class="video-play video-bg-video" <?php echo wp_kses_post($style_autoplay); ?>>
					<video id="video<?php echo esc_attr($number_id) ?>" muted="muted" loop="loop"
					       preload="auto" <?php if ($autoplay == 'yes') echo 'autoplay'; ?>
					       poster="<?php echo esc_url($img[0]); ?>">
						<source src="<?php echo esc_url($video_link); ?>">
					</video>
				</div>
				<div class="video-content">
					<div class="video-content-inner">
						<a href="javascript:;" class="play-video-bg"><i class="<?php echo esc_attr($icon) ?>"></i></a>

						<h2><?php echo esc_html($title); ?></h2>
						<?php if ($description != ''): ?>
							<p><?php echo esc_html($description); ?></p>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<?php
			$content = ob_get_clean();
			return $content;
		}
	}

	new g5plusFramework_Shortcode_Video_Bg();
}