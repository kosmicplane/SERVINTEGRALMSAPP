<?php
/**
* Customizer Custom Classes.
* @package Kindergarten Toys
*/

if ( ! function_exists( 'kindergarten_toys_sanitize_number_range' ) ) :
    function kindergarten_toys_sanitize_number_range( $kindergarten_toys_input, $kindergarten_toys_setting ) {
        $kindergarten_toys_input = absint( $kindergarten_toys_input );
        $kindergarten_toys_atts = $kindergarten_toys_setting->manager->get_control( $kindergarten_toys_setting->id )->input_attrs;
        $kindergarten_toys_min = ( isset( $kindergarten_toys_atts['min'] ) ? $kindergarten_toys_atts['min'] : $kindergarten_toys_input );
        $kindergarten_toys_max = ( isset( $kindergarten_toys_atts['max'] ) ? $kindergarten_toys_atts['max'] : $kindergarten_toys_input );
        $kindergarten_toys_step = ( isset( $kindergarten_toys_atts['step'] ) ? $kindergarten_toys_atts['step'] : 1 );
        return ( $kindergarten_toys_min <= $kindergarten_toys_input && $kindergarten_toys_input <= $kindergarten_toys_max && is_int( $kindergarten_toys_input / $kindergarten_toys_step ) ? $kindergarten_toys_input : $kindergarten_toys_setting->default );
    }
endif;

/**
 * Upsell customizer section.
 *
 * @since  1.0.0
 * @access public
 */
class Kindergarten_Toys_Customize_Section_Upsell extends WP_Customize_Section {

    /**
     * The type of customize section being rendered.
     *
     * @since  1.0.0
     * @access public
     * @var    string
     */
    public $type = 'upsell';

    /**
     * Custom button text to output.
     *
     * @since  1.0.0
     * @access public
     * @var    string
     */
    public $pro_text = '';

    /**
     * Custom pro button URL.
     *
     * @since  1.0.0
     * @access public
     * @var    string
     */
    public $pro_url = '';

    public $notice = '';
    public $nonotice = '';

    /**
     * Add custom parameters to pass to the JS via JSON.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    public function json() {
        $json = parent::json();

        $json['pro_text'] = $this->pro_text;
        $json['pro_url']  = esc_url( $this->pro_url );
        $json['notice']  = esc_attr( $this->notice );
        $json['nonotice']  = esc_attr( $this->nonotice );

        return $json;
    }

    /**
     * Outputs the Underscore.js template.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    protected function render_template() { ?>

        <li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">

            <# if ( data.notice ) { #>
                <h3 class="accordion-section-notice">
                    {{ data.title }}
                </h3>
            <# } #>

            <# if ( !data.notice ) { #>
                <h3 class="accordion-section-title">
                    {{ data.title }}

                    <# if ( data.pro_text && data.pro_url ) { #>
                        <a href="{{ data.pro_url }}" class="button button-secondary alignright" target="_blank">{{ data.pro_text }}</a>
                    <# } #>
                </h3>
            <# } #>
            
        </li>
    <?php }
}