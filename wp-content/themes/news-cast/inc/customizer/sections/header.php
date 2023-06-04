<?php
/**
 * Header settings
 * 
 * @package News Cast
 * @since 1.0.0
 */

add_action( 'customize_register', 'news_cast_customize_header_section_register', 10 );
/**
 * Add settings for header in the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function news_cast_customize_header_section_register( $wp_customize ) {
    /**
     * Header Section
     * 
     * panel - news_cast_theme_panel
     */

    $wp_customize->add_section( 'header_section', array(
      'title' => esc_html__( 'Header Section', 'news-cast' ),
      'panel' => 'news_cast_theme_panel',
      'priority'  => 10,
    ));

    /**
     * Header tab settings
     * 
     */
    $wp_customize->add_setting( 'header_settings_tab',
      array(
        'default'           => 'general',
        'sanitize_callback' => 'sanitize_text_field',
      )
    );

    // Add the layout control.
    $wp_customize->add_control( new News_Cast_WP_Radio_Tab_Control(
			$wp_customize,
			'header_settings_tab',
        array(
          'label'    => esc_html__( 'Filter header settings', 'news-cast' ),
          'section'  => 'header_section',
          'choices'  => array(
            'general' => array(
              'label' => esc_html__( 'General', 'news-cast' )
            )
          )
        )
    ));

    /**
     * Header General Settings Heading
     * 
     */
    $wp_customize->add_setting( 'header_general_setting_header', array(
      'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control( 
        new Style_Mag_WP_Section_Heading_Control( $wp_customize, 'header_general_setting_header', array(
          'label'	      => esc_html__( 'General Settings', 'news-cast' ),
          'section'     => 'header_section',
          'settings'    => 'header_general_setting_header',
          'type'        => 'section-heading',
          'active_callback' => 'header_settings_tab_general_callback'
      ))
    );

    /**
     * Header Ad Banner image
     * 
     */
    $wp_customize->add_setting( 'header_ad_banner_image', array(
      'sanitize_callback' => 'esc_url_raw'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'header_ad_banner_image',
          array(
              'label'      => __( 'Ad Banner Image', 'news-cast' ),
              'description'=> __( 'Upload image suitable for header ad area', 'news-cast' ),
              'section'    => 'header_section',
              'settings'   => 'header_ad_banner_image',
              'active_callback' => 'header_settings_tab_general_callback'
          )
      )
    );

    /**
     * Ad banner url
     * 
     */
    $wp_customize->add_setting( 'header_ad_banner_link', array(
        'default'        => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control( 'header_ad_banner_link', array(
        'label'    => esc_html__( 'Ad Link', 'news-cast' ),
        'description'=> esc_html__( 'Add url to redirect ad image', 'news-cast' ),
        'section'  => 'header_section',		
        'type'     => 'text',
        'active_callback' => 'header_settings_tab_general_callback'
    ));
    
    /**
     * Header Toggle Sidebar Option
     * 
     */
    $wp_customize->add_setting( 'header_toggle_sidebar_option', array(
      'default'           => true,
      'sanitize_callback' => 'news_cast_sanitize_toggle_control',
    ));

    $wp_customize->add_control( 
        new Style_Mag_WP_Toggle_Control( $wp_customize, 'header_toggle_sidebar_option', array(
          'label'	      => esc_html__( 'Show/Hide toggle sidebar', 'news-cast' ),
          'section'     => 'header_section',
          'settings'    => 'header_toggle_sidebar_option',
          'type'        => 'toggle',
          'active_callback' => 'header_settings_tab_general_callback'
      ))
    );
    
    /**
     * Header Search Bar Option
     * 
     */
    $wp_customize->add_setting( 'header_search_bar_option', array(
      'default'         => true,
      'sanitize_callback' => 'news_cast_sanitize_toggle_control',
    ));

    $wp_customize->add_control( 
        new Style_Mag_WP_Toggle_Control( $wp_customize, 'header_search_bar_option', array(
          'label'	      => esc_html__( 'Show/Hide search bar', 'news-cast' ),
          'section'     => 'header_section',
          'settings'    => 'header_search_bar_option',
          'type'        => 'toggle',
          'active_callback' => 'header_settings_tab_general_callback'
      ))
    );
}