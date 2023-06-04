<?php
/**
 * Sidebars settings
 * 
 * @package News Cast
 * @since 1.0.0
 */

add_action( 'customize_register', 'news_cast_customize_sidebars_section_register', 10 );
/**
 * Add settings for sidebars section in the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function news_cast_customize_sidebars_section_register( $wp_customize ) {
    /**
     * Sidebar Layouts Settings Section
     * 
     * panel - news_cast_theme_panel
     */
    $wp_customize->add_section( 'sidebars_section', array(
        'title' => esc_html__( 'Sidebar Layouts', 'news-cast' ),
        'panel' => 'news_cast_theme_panel',
        'priority'  => 50,
    ));

    /**
     * Frontpage Settings Heading
     * 
     */
    $wp_customize->add_setting( 'frontpage_sidebar_setting_header', array(
      'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control( 
        new Style_Mag_WP_Section_Heading_Control( $wp_customize, 'frontpage_sidebar_setting_header', array(
          'label'       => esc_html__( 'Frontpage Sidebar', 'news-cast' ),
          'section'     => 'sidebars_section',
          'settings'    => 'frontpage_sidebar_setting_header',
          'type'        => 'section-heading',
      ))
    );

    /**
     * Frontpage Sidebar Option
     * 
     */
    $wp_customize->add_setting( 'frontpage_sidebar_option', array(
        'default'           => true,
        'sanitize_callback' => 'news_cast_sanitize_toggle_control',
    ));
  
    $wp_customize->add_control( 
        new Style_Mag_WP_Toggle_Control( $wp_customize, 'frontpage_sidebar_option', array(
            'label'	      => esc_html__( 'Show on frontpage', 'news-cast' ),
            'section'     => 'sidebars_section',
            'settings'    => 'frontpage_sidebar_option',
            'type'        => 'toggle',
        ))
    );

    /**
     * Frontpage sidebar settings
     * 
     */
    $wp_customize->add_setting( 'frontpage_sidebar_layout',
      array(
        'default'           => 'right-sidebar',
        'sanitize_callback' => 'sanitize_text_field',
      )
    );

    // Add the layout control.
    $wp_customize->add_control( new News_Cast_WP_Radio_Image_Control(
        $wp_customize,
        'frontpage_sidebar_layout',
        array(
          'section'  => 'sidebars_section',
          'choices'  => array(
            'left-sidebar' => array(
              'label' => esc_html__( 'Left Sidebar', 'news-cast' ),
              'url'   => '%s/images/customizer/left_sidebar.png'
            ),
            'right-sidebar' => array(
              'label' => esc_html__( 'Right Sidebar', 'news-cast' ),
              'url'   => '%s/images/customizer/right_sidebar.png'
            )
          ),
          'active_callback' => 'frontpage_sidebar_option_callback'
        )
      )
    );

    /**
     * Post Sidebar Settings Heading
     * 
     */
    $wp_customize->add_setting( 'post_sidebar_setting_header', array(
      'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control( 
        new Style_Mag_WP_Section_Heading_Control( $wp_customize, 'post_sidebar_setting_header', array(
          'label'       => esc_html__( 'Post/Page Sidebar', 'news-cast' ),
          'section'     => 'sidebars_section',
          'settings'    => 'post_sidebar_setting_header',
          'type'        => 'section-heading',
      ))
    );

    /**
     * Post Sidebar Option
     * 
     */
    $wp_customize->add_setting( 'post_sidebar_option', array(
        'default'           => true,
        'sanitize_callback' => 'news_cast_sanitize_toggle_control',
    ));
  
    $wp_customize->add_control( 
        new Style_Mag_WP_Toggle_Control( $wp_customize, 'post_sidebar_option', array(
            'label'	      => esc_html__( 'Show on post/page', 'news-cast' ),
            'section'     => 'sidebars_section',
            'settings'    => 'post_sidebar_option',
            'type'        => 'toggle',
        ))
    );

    /**
     * Post sidebar settings
     * 
     */
    $wp_customize->add_setting( 'post_sidebar_layout',
      array(
        'default'           => 'right-sidebar',
        'sanitize_callback' => 'sanitize_text_field',
      )
    );

    // Add the layout control.
    $wp_customize->add_control( new News_Cast_WP_Radio_Image_Control(
        $wp_customize,
        'post_sidebar_layout',
        array(
          'section'  => 'sidebars_section',
          'choices'  => array(
            'left-sidebar' => array(
              'label' => esc_html__( 'Left Sidebar', 'news-cast' ),
              'url'   => '%s/images/customizer/left_sidebar.png'
            ),
            'right-sidebar' => array(
              'label' => esc_html__( 'Right Sidebar', 'news-cast' ),
              'url'   => '%s/images/customizer/right_sidebar.png'
            )
          ),
          'active_callback' => 'post_sidebar_option_callback'
        )
      )
    );

    /**
     * Archive Sidebar Settings Heading
     * 
     */
    $wp_customize->add_setting( 'archive_sidebar_setting_header', array(
      'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control( 
        new Style_Mag_WP_Section_Heading_Control( $wp_customize, 'archive_sidebar_setting_header', array(
          'label'       => esc_html__( 'Archive/Category Sidebar', 'news-cast' ),
          'section'     => 'sidebars_section',
          'settings'    => 'archive_sidebar_setting_header',
          'type'        => 'section-heading',
      ))
    );

    /**
     * Archive Sidebar Option
     * 
     */
    $wp_customize->add_setting( 'archive_sidebar_option', array(
        'default'           => true,
        'sanitize_callback' => 'news_cast_sanitize_toggle_control',
    ));
  
    $wp_customize->add_control( 
        new Style_Mag_WP_Toggle_Control( $wp_customize, 'archive_sidebar_option', array(
            'label'	      => esc_html__( 'Show on archive', 'news-cast' ),
            'section'     => 'sidebars_section',
            'settings'    => 'archive_sidebar_option',
            'type'        => 'toggle',
        ))
    );

    /**
     * Archive sidebar settings
     * 
     */
    $wp_customize->add_setting( 'archive_sidebar_layout',
      array(
        'default'           => 'right-sidebar',
        'sanitize_callback' => 'sanitize_text_field',
      )
    );

    // Add the layout control.
    $wp_customize->add_control( new News_Cast_WP_Radio_Image_Control(
        $wp_customize,
        'archive_sidebar_layout',
        array(
          'section'  => 'sidebars_section',
          'choices'  => array(
            'left-sidebar' => array(
              'label' => esc_html__( 'Left Sidebar', 'news-cast' ),
              'url'   => '%s/images/customizer/left_sidebar.png'
            ),
            'right-sidebar' => array(
              'label' => esc_html__( 'Right Sidebar', 'news-cast' ),
              'url'   => '%s/images/customizer/right_sidebar.png'
            )
          ),
          'active_callback' => 'archive_sidebar_option_callback'
        )
      )
    );
}