<?php
/**
 *  Custom Controls for Customizer
 *
 *  @package indofinance
 */

if ( class_exists( 'WP_Customize_Control' ) ) {

    class indofinance_Range_Value_Control extends WP_Customize_Control {
        public $type = 'indofinance-range-value';
  
        /**
         * Render the control's content.
         *
         * @author soderlind
         * @version 1.2.0
         */
        public function render_content() {
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <div class="range-slider"  style="width:100%; display:flex;flex-direction: row;justify-content: flex-start;">
                    <span  style="width:100%; flex: 1 0 0; vertical-align: middle;"><input class="range-slider__range" type="range" value="<?php echo esc_attr( $this->value() ); ?>"
                    <?php
                        $this->input_attrs();
                        $this->link();
                    ?>
                    >
                    <span class="range-slider__value">0</span></span>
                </div>
                <?php if ( ! empty( $this->description ) ) : ?>
                <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                <?php endif; ?>
            </label>
            <?php
        }
    }

    class indofinance_Separator_Control extends WP_Customize_Control {

	    public $type = "indofinance-separator";

	    public function render_content() { ?>
		    <hr>
		<?php
		}
    }

    class indofinance_Heading_Control extends WP_Customize_Control {

	    public $type = "indofinance-heading";

	    public function render_content() { ?>
		    <h4><?php echo esc_html( $this->label ); ?></h4>
		<?php
		}
    }

    // Text Paragraph Control
    class indofinance_Para_Control extends WP_Customize_Control {

	    public $type = "indofinance-para";

	    public function render_content() { ?>
		    <p><?php echo $this->label; ?></p>
		<?php
		}
    }

    class indofinance_Custom_Button_Control extends WP_Customize_Control {

	    public $type = "indofinance-button";

	    public function render_content() {
		    ?>
		    <label>
		    	<div id="<?php echo $this->id ?>">
			    	<?php if ( $this->description ) : ?>
			    		<p><?php echo $this->description ?></p>
			    	<?php endif; ?>

		    		<button type="button" class="button button-primary" tabindex="0"><?php echo $this->label ?></a>
		    	</div>
		    </label>
		    <?php
	    }
    }
}



