<?php
/**
 * indofinance Theme Customizer
 *
 * @package indofinance
 */

function indofinance_header_customize_register( $wp_customize ) {

    $wp_customize->get_section( 'title_tagline' )->panel  = 'indofinance_header_panel';
    $wp_customize->get_section( 'header_image' )->panel   = 'indofinance_header_panel';

    $wp_customize->add_panel(
        'indofinance_header_panel', array(
            'title'     =>  __('Header', 'indofinance'),
            'priority'  =>  10
        )
    );

    $wp_customize->add_section(
        'indofinance_header_options', array(
            'title'     =>  __('Header Options', 'indofinance'),
            'priority'  =>  80,
            'panel'     =>  'indofinance_header_panel'
        )
    );

    $wp_customize->add_setting(
        'indofinance_header_layout', array(
            'sanitize_callback' =>  'indofinance_sanitize_radio',
            'default'           =>  'center'
        )
    );

    $wp_customize->add_control(
        'indofinance_header_layout', array(
            'title'         =>  __('Header Layout', 'indofinance'),
            'description'   =>  __('Choose the header layout for the theme', 'indofinance'),
            'type'          =>  'select',
            'section'       =>  'indofinance_header_options',
            'priority'      =>  5,
            'choices'       =>  array(
                'default'       =>  __('Default', 'indofinance'),
                'full'          =>  __('Full', 'indofinance'),
                'center'        =>  __('Center', 'indofinance'),
                'top'           =>  __('Top', 'indofinance'),
                'widget'        =>  __('Widget', 'indofinance')
            )
        )
    );

    $wp_customize->add_control(
        new indofinance_Custom_Button_Control(
            $wp_customize, 'indofinance_header_widget_btn', array(
                'label'     =>  __('Manage Header Widget', 'indofinance'),
                'section'   =>  'indofinance_header_options',
                'type'      =>  'indofinance-button',
                'settings'  =>  []
            )
        )
    );

    $control = $wp_customize->get_control('indofinance_header_widget_btn');
    $control->active_callback = function( $control ) {
        $setting = $control->manager->get_setting( 'indofinance_header_layout' );
        return $setting->value() == 'widget' ? true : false;
    };

    $wp_customize->add_section(
        'indofinance_top_bar', array(
            'title'     =>  __('Top Bar', 'indofinance'),
            'panel'     =>  'indofinance_header_panel',
            'priority'  =>  5
        )
    );

    $wp_customize->add_setting(
        'indofinance_top_bar_enable', array(
            'default'   =>  '1',
            'sanitize_callback' =>  'indofinance_sanitize_checkbox'
        )
    );

    $wp_customize->add_control(
        'indofinance_top_bar_enable', array(
            'label'     =>  __('Enable Top Bar', 'indofinance'),
            'type'      =>  'checkbox',
            'section'   =>  'indofinance_top_bar',
        )
    );

    $wp_customize->add_setting(
        'indofinance_top_menu_enable', array(
            'default'   =>  '',
            'sanitize_callback' =>  'indofinance_sanitize_checkbox'
        )
    );

    $wp_customize->add_control(
        'indofinance_top_menu_enable', array(
            'label'     =>  __('Enable Top Menu', 'indofinance'),
            'type'      =>  'checkbox',
            'section'   =>  'indofinance_top_bar',
        )
    );

    $wp_customize->add_control(
        new indofinance_Separator_Control(
            $wp_customize, 'indofinance-sep1', array(
                'type'  =>  'indofinance-separator',
                'section'   =>  'indofinance_top_bar',
                'settings'  =>  [],
            )
        )
    );

    $wp_customize->add_control(
        new indofinance_Heading_Control(
            $wp_customize, 'indofinance_social_icons_title', array(
                'label'     =>  __('Social icons', 'indofinance'),
                'section'   =>  'indofinance_top_bar',
                'settings'  =>  [],
                'type'      =>  'indofinance-heading'
            )
        )
    );

    $social_networks = array( //Redefinied in Sanitization Function.
        'none' 			=> esc_html__('-','indofinance'),
        'facebook-alt' 	=> esc_html__('Facebook', 'indofinance'),
        'twitter' 		=> esc_html__('Twitter', 'indofinance'),
        'instagram' 	=> esc_html__('Instagram', 'indofinance'),
        'linkedin'      => esc_html__('LinkedIn', 'indofinance'),
        'youtube' 		=> esc_html__('Youtube', 'indofinance'),
    );

    for ($i = 1; $i <= 6; $i++) {
        $wp_customize->add_setting(
            "indofinance_{$i}_icon", array(
                'default'           =>  'none',
                'sanitize_callback' =>  'indofinance_sanitize_social'
            )
        );

        $wp_customize->add_control(
            "indofinance_{$i}_icon", array(
                'label'     =>  sprintf(__("Icon %s", 'indofinance'), $i),
                'section'   =>  'indofinance_top_bar',
                'type'      =>  'select',
                'choices'   =>  $social_networks
            )
        );

        $wp_customize->add_setting(
			'indofinance_social_url_'.$i, array(
				'sanitize_callback' => 'esc_url_raw'
			));

		$wp_customize->add_control( 'indofinance_social_url_' . $i, array(
			'label' 		=> sprintf( __('Icon %s Url', 'indofinance'), $i ),
            'settings' 		=> 'indofinance_social_url_' . $i,
            'section' 		=> 'indofinance_top_bar',
            'type' 			=> 'url'
		));
    }

    $social_urls = [];
    for($i = 1; $i <= 6; $i++) {
        $social_urls[] = $wp_customize->get_control("indofinance_{$i}_icon");
        $social_urls[] = $wp_customize->get_control("indofinance_social_url_{$i}");
    };

    $controls = [
        $wp_customize->get_control('indofinance_header_widget_btn'),
        $wp_customize->get_control('indofinance_top_menu_enable'),
        $wp_customize->get_control('indofinance-sep1'),
        $wp_customize->get_control('indofinance_social_icons_title'),
        ...$social_urls
    ];

    foreach($controls as $control) {
        $control->active_callback = function( $control ) {
            $setting = $control->manager->get_setting( 'indofinance_top_bar_enable' );
            return !empty($setting->value()) ? true : false;
        };
    }

}
add_action('customize_register', 'indofinance_header_customize_register');