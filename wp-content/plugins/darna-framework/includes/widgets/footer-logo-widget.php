<?php
/**
 * Created by PhpStorm.
 * User: phuongth
 * Date: 3/26/15
 * Time: 5:24 PM
 */
class Darna_Footer_Logo extends  G5Plus_Widget {
    public function __construct() {
        $this->widget_cssclass    = 'widget-footer-logo';
        $this->widget_description = __( "Logo and sub description", 'g5plus-darna' );
        $this->widget_id          = 'darna-footer-logo';
        $this->widget_name        = __( 'G5Plus: Footer Logo', 'g5plus-darna' );
        $this->settings           = array(
            'sub_description'  => array(
                'type'  => 'text-area',
                'std'   => '',
                'label' => __( 'Sub Description', 'g5plus-darna' )
            )
        );
        parent::__construct();
    }

    function widget( $args, $instance ) {
        extract( $args, EXTR_SKIP );
        $sub_description  = empty( $instance['sub_description'] ) ? '' : apply_filters( 'widget_sub_description', $instance['sub_description'] );
        $class_custom   = empty( $instance['class_custom'] ) ? '' : apply_filters( 'widget_class_custom', $instance['class_custom'] );
        $widget_id = $args['widget_id'];
        echo wp_kses_post($before_widget);
        global $g5plus_darna_options;
        $footer_logo = '';
        if(isset($g5plus_darna_options['light_logo']))
            $footer_logo = $g5plus_darna_options['light_logo']['url'];

        ?>
        <div class="footer-logo <?php echo esc_attr($class_custom) ?>">
            <?php if(isset($footer_logo) && $footer_logo!='') { ?>
                <a href="<?php echo get_home_url() ?>"><img src="<?php echo esc_url($footer_logo) ?>" alt="<?php __('darna logo','g5plus-darna') ?>" /></a>
            <?php } ?>
            <div class="sub-description">
                <?php echo wp_kses_post($sub_description) ?>
            </div>
        </div>

        <?php
        echo wp_kses_post($after_widget);
    }
}
if (!function_exists('darna_register_widget_footer_logo')) {
    function darna_register_widget_footer_logo() {
        register_widget('Darna_Footer_Logo');
    }
    add_action('widgets_init', 'darna_register_widget_footer_logo', 1);
}