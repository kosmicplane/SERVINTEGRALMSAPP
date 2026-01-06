<?php
function indofinance_fa_style_settings_customize_register( $wp_customize ) {
    // Add panel for featured posts settings
    $wp_customize->add_panel(
        'indofinance-fa-style-settings', array(
            'title'    => __( 'Featured Area', 'indofinance' ),
            'priority' => 20
        )
    );

    // Add section for featured area within the panel
    $wp_customize->add_section( 'indofinance_fa_post_section', array(
        'title'    => __( 'Featured Area', 'indofinance' ),
        'priority' => 25,
        'panel'    => 'indofinance-fa-style-settings',
    ) );

    // Setting and control for the featured posts checkbox
    $wp_customize->add_setting( 'indofinance_fa_post_enable', array(
        'sanitize_callback' => 'indofinance_sanitize_checkbox',
        'transport'         => 'refresh', // or 'postMessage' if using live preview
    ) );

    $wp_customize->add_control( 'indofinance_fa_post_enable_ctrl', array(
        'label'       => __( 'Featured Posts Area', 'indofinance' ),
        'description' => __( 'Show or hide the featured posts area from here.', 'indofinance' ),
        'section'     => 'indofinance_fa_post_section',
        'settings'    => 'indofinance_fa_post_enable',
        'type'        => 'checkbox',
        'priority'    => 10,
    ) );

    // Setting and control for the featured area title textbox
    $wp_customize->add_setting( 'indofinance_fa_title', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh', // or 'postMessage'
    ) );

    $wp_customize->add_control( 'indofinance_fa_title_ctrl', array(
        'label'       => __( 'Featured Posts Area Title', 'indofinance' ),
        'description' => __( 'Modify Your Title From Here', 'indofinance' ),
        'section'     => 'indofinance_fa_post_section',
        'settings'    => 'indofinance_fa_title',
        'type'        => 'text',
        'priority'    => 10,
    ) );

    // Setting and control for the category selection dropdown
    $wp_customize->add_setting( 'indofinance_fa_post_category', array(
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh', // or 'postMessage'
    ) );

    $wp_customize->add_control(
        new WP_Customize_Category_Control(
            $wp_customize,
            'indofinance_fa-category_ctrl',
            array(
                'label'       => __( 'Featured Posts Category', 'indofinance' ),
                'description' => __( 'Select the category for the featured posts', 'indofinance' ),
                'section'     => 'indofinance_fa_post_section',
                'settings'    => 'indofinance_fa_post_category',
                'priority'    => 20,
            )
        )
    );

        // Function to retrieve categories as options for the dropdown
        function indofinance_get_categories_dropdown() {
            $categories = get_categories();
            $options = array();
            foreach ( $categories as $category ) {
                $options[$category->term_id] = $category->name;
            }
            return $options;
        }
 

           // Add setting for post order
           $wp_customize->add_setting( 'indofinance_featured_posts_width', array(
            'default'           => 'boxed',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh', // or 'postMessage' for live preview
        ));
    
        $wp_customize->add_control( 'indofinance_featured_posts_width', array(
            'label'   => esc_html__( 'Featured Posts Width', 'indofinance' ),
            'section' => 'indofinance_fa_post_section',
            'setting' => 'indofinance_featured_posts_width',
            'type'    => 'select',
            'choices' => array(
                'full' => esc_html__( 'Full Width', 'indofinance' ),
                'boxed'  => esc_html__( 'Boxed Width', 'indofinance' ),
                'wide-width'  => esc_html__( 'Wide Width', 'indofinance' ),
               
            ),
        ));

        // Add section for featured posts slider
        $wp_customize->add_section( 'indofinance_featured_posts_slider', array(
            'title'    => esc_html__( 'Featured Posts Slider', 'indofinance' ),
            'priority' => 35,
            'panel'    => 'indofinance-fa-style-settings', // Associate with the 'indofinance Options' panel
        ));
        
            // Setting and control for the featured posts checkbox
        $wp_customize->add_setting( 'indofinance_fa_slider_style_enable', array(
            'sanitize_callback' => 'indofinance_sanitize_checkbox',
            'transport'         => 'refresh', // or 'postMessage' if using live preview
        ) );

        $wp_customize->add_control( 'indofinance_fa_style_enable_ctrl', array(
            'label'       => __( 'Enable/Disable Slider', 'indofinance' ),
            'description' => __( 'Show or hide the slider from here.', 'indofinance' ),
            'section'     => 'indofinance_featured_posts_slider',
            'settings'    => 'indofinance_fa_slider_style_enable',
            'type'        => 'checkbox',
            'priority'    => 10,
        ) );


          // Add setting for number of posts
          $wp_customize->add_setting( 'indofinance_featured_posts_slider_number', array(
            'default'           => 4,
            'sanitize_callback' => 'absint',
            'transport'         => 'refresh', // or 'postMessage' for live preview
        ));
    
        $wp_customize->add_control( 'indofinance_featured_posts_slider_number', array(
            'label'       => esc_html__( 'Number of Posts', 'indofinance' ),
            'section'     => 'indofinance_featured_posts_slider',
            'type'        => 'number',
            'input_attrs' => array(
                'min'   => 1,
                'max'   => 10,
                'step'  => 1,
            ),
        ));
    
        // Add setting for post category
        $wp_customize->add_setting( 'indofinance_featured_posts_slider_category', array(
            'default'           => '',
            'sanitize_callback' => 'absint',
            'transport'         => 'refresh', // or 'postMessage' for live preview
        ));
    
        $wp_customize->add_control( 'indofinance_featured_posts_slider_category', array(
            'label'    => esc_html__( 'Category', 'indofinance' ),
            'section'  => 'indofinance_featured_posts_slider',
            'type'     => 'select',
            'choices'  => indofinance_get_categories_dropdown(), // Call the function to retrieve categories
        ));
    
        // Add setting for post order
        $wp_customize->add_setting( 'indofinance_featured_posts_slider_order', array(
            'default'           => 'DESC',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh', // or 'postMessage' for live preview
        ));
    
        $wp_customize->add_control( 'indofinance_featured_posts_slider_order', array(
            'label'   => esc_html__( 'Post Order', 'indofinance' ),
            'section' => 'indofinance_featured_posts_slider',
            'type'    => 'select',
            'choices' => array(
                'DESC' => esc_html__( 'Descending', 'indofinance' ),
                'ASC'  => esc_html__( 'Ascending', 'indofinance' ),
            ),
        ));

         // Add setting for post order
         $wp_customize->add_setting( 'indofinance_featured_posts_slider_width', array(
            'default'           => 'Full',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh', // or 'postMessage' for live preview
        ));
    
        $wp_customize->add_control( 'indofinance_featured_posts_slider_width', array(
            'label'   => esc_html__( 'Slider Width', 'indofinance' ),
            'section' => 'indofinance_featured_posts_slider',
            'type'    => 'select',
            'choices' => array(
                'full' => esc_html__( 'Full Width', 'indofinance' ),
                'boxed'  => esc_html__( 'Boxed Width', 'indofinance' ),
                'wide-width'  => esc_html__( 'Wide Width', 'indofinance' ),
               
            ),
        ));
 
             // Add section for featured area within the panel
        $wp_customize->add_section( 'indofinance_featured_posts_widgets_before_content_width', array(
            'title'    => __( 'Widgets Before Main Content Width', 'indofinance' ),
            'priority' => 25,
            'panel'    => 'indofinance-fa-style-settings',
        ) );

          // Add setting for post order
          $wp_customize->add_setting( 'indofinance_featured_posts_widgets_before_content_width', array(
            'default'           => 'boxed',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh', // or 'postMessage' for live preview
        ));
    
        $wp_customize->add_control( 'indofinance_featured_posts_widgets_before_content_width', array(
            'label'   => esc_html__( 'Widgets Before Main Content Width', 'indofinance' ),
            'section' => 'indofinance_featured_posts_widgets_before_content_width',
            'type'    => 'select',
            'choices' => array(
                'full-width' => esc_html__( 'Full Width', 'indofinance' ),
                'boxed'  => esc_html__( 'Boxed Width', 'indofinance' ),
                'wide-width'  => esc_html__( 'Wide Width', 'indofinance' ),
               
            ),
        ));
}

add_action( 'customize_register', 'indofinance_fa_style_settings_customize_register' );

/**
 * Custom control for category dropdown
 */
if (class_exists('WP_Customize_Control')) {
    class WP_Customize_Category_Control extends WP_Customize_Control {
        public $type = 'dropdown-categories';

        public function render_content() {
            $dropdown = wp_dropdown_categories(
                array(
                    'name'              => '_customize-dropdown-categories-' . $this->id,
                    'echo'              => 0,
                    'show_option_none'  => __( '&mdash; Select Category &mdash;', 'indofinance' ),
                    'option_none_value' => '0',
                    'selected'          => $this->value(),
                )
            );

            // Replace default name attribute with customizer-specific one
            $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );

            printf(
                '<label class="customize-control-select">
                    <span class="customize-control-title">%s</span>
                    %s
                </label>',
                esc_html( $this->label ),
                $dropdown
            );
        }
    }
}

