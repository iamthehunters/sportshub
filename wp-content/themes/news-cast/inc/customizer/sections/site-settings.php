<?php
/**
 * Site settings
 * 
 * @package News Cast
 * @since 1.0.0
 */

add_action( 'customize_register', 'news_cast_customize_site_section_register', 10 );
/**
 * Add settings for site in the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function news_cast_customize_site_section_register( $wp_customize ) {
    /**
     * Site Section
     * 
     * panel - news_cast_theme_panel
     */

    $wp_customize->add_section( 'site_section', array(
      'title' => esc_html__( 'Site Settings', 'news-cast' ),
      'panel' => 'news_cast_theme_panel',
      'priority'  => 5,
    ));
    
    /**
     * Sticky Header Settings Heading
     * 
     */
    $wp_customize->add_setting( 'sticky_header_settings_header', array(
        'sanitize_callback' => 'sanitize_text_field'
      ));

    $wp_customize->add_control( 
        new Style_Mag_WP_Section_Heading_Control( $wp_customize, 'sticky_header_settings_header', array(
            'label'	      => esc_html__( 'Sticky Header Setting', 'news-cast' ),
            'section'     => 'site_section',
            'settings'    => 'sticky_header_settings_header',
            'type'        => 'section-heading',
        ))
    );

    /**
     * Sticky Header On Scroll down
     * 
     */
    $wp_customize->add_setting( 'sticky_header_option', array(
        'default'           => false,
        'sanitize_callback' => 'news_cast_sanitize_toggle_control',
    ));

    $wp_customize->add_control( 
        new Style_Mag_WP_Toggle_Control( $wp_customize, 'sticky_header_option', array(
            'label'	      => esc_html__( 'Enable Sticky Header on Scroll Down', 'news-cast' ),
            'section'     => 'site_section',
            'settings'    => 'sticky_header_option',
            'type'        => 'toggle',
        ))
    );
    
    /**
     * Scroll To Top Settings Heading
     * 
     */
    $wp_customize->add_setting( 'scroll_to_top_settings_header', array(
        'sanitize_callback' => 'sanitize_text_field'
      ));

    $wp_customize->add_control( 
        new Style_Mag_WP_Section_Heading_Control( $wp_customize, 'scroll_to_top_settings_header', array(
            'label'	      => esc_html__( 'Scroll To Top Setting', 'news-cast' ),
            'section'     => 'site_section',
            'settings'    => 'scroll_to_top_settings_header',
            'type'        => 'section-heading',
        ))
    );

    /**
     * Scroll To Top Option
     * 
     */
    $wp_customize->add_setting( 'scroll_to_top_option', array(
        'default'           => true,
        'sanitize_callback' => 'news_cast_sanitize_toggle_control',
    ));

    $wp_customize->add_control( 
        new Style_Mag_WP_Toggle_Control( $wp_customize, 'scroll_to_top_option', array(
            'label'	      => esc_html__( 'Enable Scroll To Top', 'news-cast' ),
            'section'     => 'site_section',
            'settings'    => 'scroll_to_top_option',
            'type'        => 'toggle',
        ))
    );
    
    /**
     * Scroll To Top Align settings
     * 
     */
    $wp_customize->add_setting( 'scroll_to_top_align',
      array(
        'default'           => 'align--left',
        'sanitize_callback' => 'sanitize_text_field',
      )
    );

    // Add the layout control.
    $wp_customize->add_control( new News_Cast_WP_Radio_Tab_Control(
        $wp_customize,
        'scroll_to_top_align',
            array(
            'label'    => esc_html__( 'Align', 'news-cast' ),
            'section'  => 'site_section',
            'choices'  => array(
                'align--left' => array(
                    'icon'  => esc_attr( 'fas fa-align-left' )
                ),
                'align--center' => array(
                    'icon'  => esc_attr( 'fas fa-align-center' )
                ),
                'align--right' => array(
                    'icon'  => esc_attr( 'fas fa-align-right' )
                )
            ),
            'active_callback' => 'scroll_to_top_option_callback'
        )
    ));
}