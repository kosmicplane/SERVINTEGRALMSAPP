<?php
function agencyup_archive_page_setting( $wp_customize ) {

    /**
     * Custom Customizer Controls.
     *
     * @package Agencyup
     */

    /**
     * Custom Controls of theme
     *
     * @since 1.0.0
     *
     * @see WP_Customize_Control
     */

    class Agencyup_Section_Title extends WP_Customize_Control {
        public $type = 'section-title';
        public $label = '';
        public $description = '';

        public function render_content() {
            ?>
            <h3><?php echo esc_html( $this->label ); ?></h3>
            <?php if (!empty($this->description)) { ?>
                <span class="customize-control-description"><?php echo esc_html($this->description); ?></span>
            <?php } ?>
            <?php
        }
    }
    
    class Agencyup_Custom_Radio_Default_Image_Control extends WP_Customize_Control {
        
        /**
         * Declare the control type.
         *
         * @access public
         * @var string
         */
        public $type = 'radio-image';
        
        /**
         * Enqueue scripts and styles for the custom control.
         * 
         * Scripts are hooked at {@see 'customize_controls_enqueue_scripts'}.
         * 
         * Note, you can also enqueue stylesheets here as well. Stylesheets are hooked
         * at 'customize_controls_print_styles'.
         *
         * @access public
         */
        public function enqueue() {
            wp_enqueue_script( 'jquery-ui-button' );
        }
        
        /**
         * Render the control to be displayed in the Customizer.
         */
        public function render_content() {
            if ( empty( $this->choices ) ) {
                return;
            }           
            
            $name = '_customize-radio-' . $this->id;
            ?>
            <span class="customize-control-title">
                <?php echo esc_attr( $this->label ); ?>
                <?php if ( ! empty( $this->description ) ) : ?>
                    <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                <?php endif; ?>
            </span>
            <div id="input_<?php echo esc_attr($this->id); ?>" class="image">
                <?php foreach ( $this->choices as $value => $label ) : ?>
                    <input class="image-select" type="radio" value="<?php echo esc_attr( $value ); ?>" id="<?php echo esc_attr($this->id . $value); ?>" name="<?php echo esc_attr( $name ); ?>" <?php esc_attr($this->link()); checked( esc_attr($this->value(), $value )); ?>>
                        <label for="<?php echo esc_attr($this->id . $value); ?>">
                            <img src="<?php echo esc_url( $label ); ?>" alt="<?php echo esc_attr( $value ); ?>" title="<?php echo esc_attr( $value ); ?>">
                        </label>
                    </input>
                <?php endforeach; ?>
            </div>
            <script>jQuery(document).ready(function($) { $( '[id="input_<?php echo esc_attr($this->id); ?>"]' ).buttonset(); });</script>
            <?php
        }
    }



	/* General Section */
	$wp_customize->add_section( 'archive_options', array(
		'priority' => 4,
		'capability' => 'edit_theme_options',
		'title' => __('Archive Page Title', 'agencyup'),
	) );

    $wp_customize->add_setting(
    'archive_page_title',
    array(
        'default' => esc_html__('Archive','agencyup'),
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'agencyup_archive_page_sanitize_text',
        )
    );  
    $wp_customize->add_control( 'archive_page_title',array(
    'label'   => esc_html__('Archive','agencyup'),
    'section' => 'archive_options',
     'type' => 'text'
    )); 
    
    $wp_customize->add_setting(
    'category_page_title',
    array(
        'default' => esc_html__('Category','agencyup'),
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'agencyup_archive_page_sanitize_text',
        )
    );  
    $wp_customize->add_control( 'category_page_title',array(
    'label'   => esc_html__('Category','agencyup'),
    'section' => 'archive_options',
     'type' => 'text'
    ));

    $wp_customize->add_setting(
    'author_page_title',
    array(
        'default' => esc_html__('All posts by','agencyup'),
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'agencyup_archive_page_sanitize_text',
        )
    );  
    $wp_customize->add_control( 'author_page_title',array(
    'label'   => esc_html__('Author','agencyup'),
    'section' => 'archive_options',
     'type' => 'text'
    ));
    
    $wp_customize->add_setting(
    'tag_page_title',
    array(
        'default' => esc_html__('Tag','agencyup'),
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'agencyup_archive_page_sanitize_text',
        )
    );  
    $wp_customize->add_control( 'tag_page_title',array(
    'label'   => esc_html__('Tag','agencyup'),
    'section' => 'archive_options',
     'type' => 'text'
    ));
    
    
    $wp_customize->add_setting(
    'search_page_title',
    array(
        'default' => esc_html__('Search results for','agencyup'),
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'agencyup_archive_page_sanitize_text',
        )
    );  
    $wp_customize->add_control( 'search_page_title',array(
    'label'   => esc_html__('Search','agencyup'),
    'section' => 'archive_options',
     'type' => 'text'
    ));
    
    $wp_customize->add_setting(
    '404_page_title',
    array(
        'default' => esc_html__('404','agencyup'),
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'agencyup_archive_page_sanitize_text',
        )
    );  
    $wp_customize->add_control( '404_page_title',array(
    'label'   => esc_html__('404','agencyup'),
    'section' => 'archive_options',
     'type' => 'text'
    ));
    
    
    $wp_customize->add_setting(
    'shop_page_title',
    array(
        'default' => esc_html__('Shop','agencyup'),
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'agencyup_archive_page_sanitize_text',
        )
    );  
    $wp_customize->add_control( 'shop_page_title',array(
    'label'   => esc_html__('Shop','agencyup'),
    'section' => 'archive_options',
     'type' => 'text'
    ));

    /* Archive Page Seetings */
	$wp_customize->add_section( 'archive_settings', array(
		'priority' => 4,
		'capability' => 'edit_theme_options',
		'title' => __('Archive Page Settings', 'agencyup'),
	) );

    $wp_customize->add_setting('archive_heading',
        array(
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        new Agencyup_Section_Title(
            $wp_customize,
            'archive_heading',
            array(
                'label'             => esc_html__( 'Blog/Archive/Single', 'agencyup' ),
                'section'           => 'archive_settings',
            )
        )
    );
    //Enable and disable Category
    $wp_customize->add_setting(
        'post_category_enable',
        array(
            'capability'     => 'edit_theme_options',
            'sanitize_callback' => 'agencyup_social_sanitize_checkbox',
            'default'  => 0,
        )   
    );
    $wp_customize->add_control(
        'post_category_enable',
        array(
            'label' => __('Hide / Show Category','agencyup'),
            'section' => 'archive_settings',
            'type' => 'checkbox',
        )
    );

    //Enable and disable title
    $wp_customize->add_setting(
        'post_title_enable',
        array(
            'capability'     => 'edit_theme_options',
            'sanitize_callback' => 'agencyup_social_sanitize_checkbox',
            'default'  => 0,
        )   
    );
    $wp_customize->add_control(
        'post_title_enable',
        array(
            'label' => __('Hide / Show Title','agencyup'),
            'section' => 'archive_settings',
            'type' => 'checkbox',
        )
    );

    //Enable and disable meta
    $wp_customize->add_setting(
        'post_meta_enable',
        array(
            'capability'     => 'edit_theme_options',
            'sanitize_callback' => 'agencyup_social_sanitize_checkbox',
            'default'  => 0,
        )   
    );
    $wp_customize->add_control(
        'post_meta_enable',
        array(
            'label' => __('Hide / Show Meta','agencyup'),
            'section' => 'archive_settings',
            'type' => 'checkbox',
        )
    );

    $wp_customize->add_setting('archive_page_heading',
        array(
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        new Agencyup_Section_Title(
            $wp_customize,
            'archive_page_heading',
            array(
                'label'             => esc_html__( 'Archive Pages Layout', 'agencyup' ),
                'section'           => 'archive_settings',
            )
        )
    );
    $wp_customize->add_setting(
        'agencyup_content_layout', array(
        'default'           => 'align-content-right',
        'sanitize_callback' => 'agencyup_sanitize_select',
    ) );
    $wp_customize->add_control(
        new Agencyup_Custom_Radio_Default_Image_Control( 
            // $wp_customize object
            $wp_customize,
            // $id
            'agencyup_content_layout',
            // $args
            array(
                'settings'      => 'agencyup_content_layout',
                'section'       => 'archive_settings',
                'choices'       => array(
                    'align-content-left' => get_template_directory_uri() . '/images/fullwidth-left-sidebar.png',  
                    'full-width-content'    => get_template_directory_uri() . '/images/fullwidth.png',
                    'align-content-right'    => get_template_directory_uri() . '/images/right-sidebar.png',
                )
            )
        )
    );

    $wp_customize->add_setting('single_page_heading',
        array(
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        new Agencyup_Section_Title(
            $wp_customize,
            'single_page_heading',
            array(
                'label'             => esc_html__( 'Single Pages Layout', 'agencyup' ),
                'section'           => 'archive_settings',
            )
        )
    );
    $wp_customize->add_setting(
        'agencyup_single_page_layout', array(
        'default'           => 'align-content-right',
        'sanitize_callback' => 'agencyup_sanitize_select',
    ) );
    $wp_customize->add_control(
        new Agencyup_Custom_Radio_Default_Image_Control( 
            // $wp_customize object
            $wp_customize,
            // $id
            'agencyup_single_page_layout',
            // $args
            array(
                'settings'      => 'agencyup_single_page_layout',
                'section'       => 'archive_settings',
                'choices'       => array(
                    'align-content-left' => get_template_directory_uri() . '/images/fullwidth-left-sidebar.png',  
                    'full-width-content'    => get_template_directory_uri() . '/images/fullwidth.png',
                    'align-content-right'    => get_template_directory_uri() . '/images/right-sidebar.png',
                )
            )
        )
    );

    $wp_customize->add_setting('page_type_heading',
        array(
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        new Agencyup_Section_Title(
            $wp_customize,
            'page_type_heading',
            array(
                'label'             => esc_html__( 'Pages Layout', 'agencyup' ),
                'section'           => 'archive_settings',
            )
        )
    );
    $wp_customize->add_setting(
        'agencyup_page_layout', array(
        'default'           => 'align-content-right',
        'sanitize_callback' => 'agencyup_sanitize_select',
    ) );
    $wp_customize->add_control( new Agencyup_Custom_Radio_Default_Image_Control( 
            // $wp_customize object
            $wp_customize,
            // $id
            'agencyup_page_layout',
            // $args
            array(
                'settings'      => 'agencyup_page_layout',
                'section'       => 'archive_settings',
                'choices'       => array(
                    'align-content-left' => get_template_directory_uri() . '/images/fullwidth-left-sidebar.png',  
                    'full-width-content'    => get_template_directory_uri() . '/images/fullwidth.png',
                    'align-content-right'    => get_template_directory_uri() . '/images/right-sidebar.png',
                )
            )
        )
    );
}
add_action( 'customize_register', 'agencyup_archive_page_setting' );

if (isset($wp_customize->selective_refresh)) {
    $wp_customize->selective_refresh->add_partial('post_meta_enable', array(
        'selector'        => '.bs-blog-post .bs-blog-meta', 
    ));
}

function agencyup_archive_page_sanitize_text( $input ) {

    return wp_kses_post( force_balance_tags( $input ) );

}


if ( ! function_exists( 'agencyup_sanitize_select' ) ) :

    /**
     * Sanitize select.
     *
     * @since 1.0.0
     *
     * @param mixed                $input The value to sanitize.
     * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
     * @return mixed Sanitized value.
     */
    function agencyup_sanitize_select( $input, $setting ) {

        // Ensure input is a slug.
        $input = sanitize_text_field( $input );

        // Get list of choices from the control associated with the setting.
        $choices = $setting->manager->get_control( $setting->id )->choices;

        // If the input is a valid key, return it; otherwise, return the default.
        return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

    }
endif;