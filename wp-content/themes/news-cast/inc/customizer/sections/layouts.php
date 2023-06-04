<?php
/**
 * Layouts settings
 * 
 * @package News Cast
 * @since 1.0.0
 */

add_action( 'customize_register', 'news_cast_customize_layouts_section_register', 10 );
/**
 * Add settings for layouts section in the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function news_cast_customize_layouts_section_register( $wp_customize ) {
    /**
     * Layouts Settings Section
     * 
     * panel - news_cast_theme_panel
     */
    $wp_customize->add_section( 'layouts_section', array(
        'title' => esc_html__( 'Layouts Settings', 'news-cast' ),
        'panel' => 'news_cast_theme_panel',
        'priority'  => 40,
    ));
    
    /**
     * Whole Site Layout Settings Heading
     * 
     */
    $wp_customize->add_setting( 'site_layout_setting_header', array(
      'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control( 
        new Style_Mag_WP_Section_Heading_Control( $wp_customize, 'site_layout_setting_header', array(
          'label'       => esc_html__( 'MAin Site Layout', 'news-cast' ),
          'section'     => 'layouts_section',
          'settings'    => 'site_layout_setting_header',
          'type'        => 'section-heading',
      ))
    );

    /**
     * Site layout settings
     * 
     */
    $wp_customize->add_setting( 'site_layout',
      array(
        'default'           => 'box-layout',
        'sanitize_callback' => 'sanitize_text_field',
      )
    );

    // Add the layout control.
    $wp_customize->add_control( new News_Cast_WP_Radio_Image_Control(
        $wp_customize,
        'site_layout',
        array(
          'section'  => 'layouts_section',
          'choices'  => array(
            'box-layout' => array(
              'label' => esc_html__( 'Boxed Width', 'news-cast' ),
              'url'   => '%s/images/customizer/site-boxed.png'
            ),
            'full-layout' => array(
              'label' => esc_html__( 'Full Width', 'news-cast' ),
              'url'   => '%s/images/customizer/site-full-width.png'
            )
          )
        )
      )
    );
    
    /**
     * Post Layout Settings Heading
     * 
     */
    $wp_customize->add_setting( 'post_layout_setting_header', array(
      'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control( 
        new Style_Mag_WP_Section_Heading_Control( $wp_customize, 'post_layout_setting_header', array(
          'label'       => esc_html__( 'Post/Page Layout', 'news-cast' ),
          'section'     => 'layouts_section',
          'settings'    => 'post_layout_setting_header',
          'type'        => 'section-heading',
      ))
    );

    /**
     * Post layout settings
     * 
     */
    $wp_customize->add_setting( 'post_layout',
      array(
        'default'           => 'full-width',
        'sanitize_callback' => 'sanitize_text_field',
      )
    );

    // Add the layout control.
    $wp_customize->add_control( new News_Cast_WP_Radio_Image_Control(
        $wp_customize,
        'post_layout',
        array(
          'section'  => 'layouts_section',
          'choices'  => array(
            'full-width' => array(
              'label' => esc_html__( 'Full Width', 'news-cast' ),
              'url'   => '%s/images/customizer/full_width_layout.jpg'
            ),
            'boxed-content-width' => array(
              'label' => esc_html__( 'Box Content Width', 'news-cast' ),
              'url'   => '%s/images/customizer/boxed_width_layout.jpg'
            )
          )
        )
      )
    );

    /**
     * Archive Layout Settings Heading
     * 
     */
    $wp_customize->add_setting( 'archive_layout_setting_header', array(
      'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control( 
        new Style_Mag_WP_Section_Heading_Control( $wp_customize, 'archive_layout_setting_header', array(
          'label'       => esc_html__( 'Archive Layout', 'news-cast' ),
          'section'     => 'layouts_section',
          'settings'    => 'archive_layout_setting_header',
          'type'        => 'section-heading',
      ))
    );

    /**
     * Archive layout settings
     * 
     */
    $wp_customize->add_setting( 'archive_layout',
      array(
        'default'           => 'full-width',
        'sanitize_callback' => 'sanitize_text_field',
      )
    );

    // Add the layout control.
    $wp_customize->add_control( new News_Cast_WP_Radio_Image_Control(
        $wp_customize,
        'archive_layout',
        array(
          'section'  => 'layouts_section',
          'choices'  => array(
            'full-width' => array(
              'label' => esc_html__( 'Full Width', 'news-cast' ),
              'url'   => '%s/images/customizer/full_width_layout.jpg'
            ),
            'boxed-content-width' => array(
              'label' => esc_html__( 'Box Content Width', 'news-cast' ),
              'url'   => '%s/images/customizer/boxed_width_layout.jpg'
            )
          )
        )
      )
    );
}