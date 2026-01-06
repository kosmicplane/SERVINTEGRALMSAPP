<?php
// don't load directly
if (!defined('ABSPATH')) die('-1');
if (!class_exists('g5plusFramework_ShortCode_Counter')) {
	class g5plusFramework_ShortCode_Counter
	{
		function __construct()
		{
			add_shortcode('darna_counter', array($this, 'counter_shortcode'));
		}

		function counter_shortcode($atts)
		{
			$value =$value_color= $title = $title_color=$html = $el_class = '';
			extract(shortcode_atts(array(
				'value' => '',
				'value_color'=>'',
				'title' => '',
				'title_color' => '',
				'el_class' => ''
			), $atts));
			wp_enqueue_script('darna_counter', plugins_url('darna-framework/includes/shortcodes/counter/jquery.countTo.js'), array(), false, true);
			ob_start();?>
			<div class="darna-counter <?php echo esc_attr($el_class) ?>">
				<?php if ($value != ''): ?>
					<span class="display-percentage" style="color: <?php echo esc_attr($value_color) ?>"
						  data-percentage="<?php echo esc_attr($value) ?>"><?php echo esc_html($value) ?></span>
					<?php if ($title != ''): ?>
						<p class="counter-title" style="color: <?php echo esc_attr($title_color) ?>"><?php echo wp_kses_post($title) ?></p>
					<?php endif;
				endif; ?>
			</div>
			<?php
			$content = ob_get_clean();
			return $content;
		}
	}

	new g5plusFramework_ShortCode_Counter();
}