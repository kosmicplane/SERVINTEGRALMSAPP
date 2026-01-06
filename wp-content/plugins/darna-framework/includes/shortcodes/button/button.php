<?php
// don't load directly
if (!defined('ABSPATH')) die('-1');
if (!class_exists('g5plusFramework_ShortCode_Button')) {
	class g5plusFramework_ShortCode_Button
	{
		function __construct()
		{
			add_shortcode('darna_button', array($this, 'button_shortcode'));
		}

		function button_shortcode($atts)
		{
			$layout_style = $link = $size = $add_icon = $icon = $i_align = $html = $el_class = $g5plus_animation = $css_animation = $duration = $delay = $styles_animation = '';
			extract(shortcode_atts(array(
				'layout_style' => 'style1',
				'link' => '',
				'size' => 'md',
				'add_icon' => '',
				'icon' => '',
				'i_align' => 'left',
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
			$use_link = false;
			if (strlen($link['url']) > 0) {
				$use_link = true;
				$a_href = $link['url'];
				$a_title = $link['title'];
				$a_target = strlen($link['target']) > 0 ? $link['target'] : '_self';

				$button_html = $a_title;

				if ($add_icon && !empty($icon)) {
					$icon_html = '<i class="' . $icon . '"></i>';
					if ($i_align == 'left') {
						$button_html = $icon_html . ' ' . $button_html;
					} else {
						$button_html .= ' ' . $icon_html;
					}
				}

			}
			$button_class = ' size-' . $size . ' ' . $layout_style . ' icon-' . $i_align;
			ob_start();
			?>
			<?php if ($use_link) : ?>
			<a class="darna-button <?php echo esc_attr(trim($button_class)); ?> <?php echo esc_attr($g5plus_animation) ?>"
			   href="<?php echo esc_url($a_href); ?>"
			   title="<?php echo esc_attr($a_title); ?>"
			   target="<?php echo esc_attr($a_target); ?>"
				<?php echo g5plusFramework_Shortcodes::g5plus_get_style_animation($duration, $delay); ?>>
				<?php echo wp_kses_post($button_html); ?>
			</a>
		<?php endif; ?>
			<?php
			$content = ob_get_clean();
			return $content;
		}
	}

	new g5plusFramework_ShortCode_Button();
}