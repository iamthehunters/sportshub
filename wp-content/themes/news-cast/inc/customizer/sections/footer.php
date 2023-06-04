<?php
/**
 * Footer settings
 * 
 * @package News Cast
 * @since 1.0.0
 */

add_action( 'customize_register', 'news_cast_customize_footer_section_register', 10 );
/**
 * Add settings for footer in the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function news_cast_customize_footer_section_register( $wp_customize ) {
    /**
     * Footer Section
     * 
     * panel - news_cast_theme_panel
     */

    $wp_customize->add_section( 'footer_section', array(
      'title' => esc_html__( 'Footer Section', 'news-cast' ),
      'panel' => 'news_cast_theme_panel',
      'priority'  => 100,
    ));

    /**
     * Footer Settings Heading
     * 
     */
    $wp_customize->add_setting( 'footer_settings', array(
      'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control( 
        new Style_Mag_WP_Section_Heading_Control( $wp_customize, 'footer_settings', array(
            'label'	      => esc_html__( 'Footer Settings', 'news-cast' ),
            'section'     => 'footer_section',
            'settings'    => 'footer_settings',
            'type'        => 'section-heading',
        ))
    );

    /**
     * Footer Option
     * 
     */
    $wp_customize->add_setting( 'footer_option', array(
      'default'           => true,
      'sanitize_callback' => 'news_cast_sanitize_toggle_control',
    ));

    $wp_customize->add_control( 
        new Style_Mag_WP_Toggle_Control( $wp_customize, 'footer_option', array(
          'label'	      => esc_html__( 'Show/Hide footer section', 'news-cast' ),
          'section'     => 'footer_section',
          'settings'    => 'footer_option',
          'type'        => 'toggle',
      ))
    );

    /**
     * Footer Tab settings
     * 
     */
    $wp_customize->add_setting( 'footer_settings_tab',
      array(
        'default'           => 'general',
        'sanitize_callback' => 'sanitize_text_field',
      )
    );
    
    // Add the layout control.
    $wp_customize->add_control( new News_Cast_WP_Radio_Tab_Control(
			$wp_customize,
			'footer_settings_tab',
        array(
          'label'    => esc_html__( 'Filter footer settings', 'news-cast' ),
          'section'  => 'footer_section',
          'choices'  => array(
            'general' => array(
              'label' => esc_html__( 'General', 'news-cast' )
            ),
          ),
          'active_callback' => 'footer_option_callback'
        )
    ));

    /**
     * Footer General Settings Heading
     * 
     */
    $wp_customize->add_setting( 'footer_general_setting', array(
      'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control( 
        new Style_Mag_WP_Section_Heading_Control( $wp_customize, 'footer_general_setting', array(
            'label'	      => esc_html__( 'Main Footer General Settings', 'news-cast' ),
            'section'     => 'footer_section',
            'settings'    => 'footer_general_setting',
            'type'        => 'section-heading',
            'active_callback' => function($control) {
              if( footer_option_callback($control) && footer_settings_tab_general_callback($control) ) {
                return true;
              } else {
                return false;
              }
            }
        ))
    );

    /**
     * Footer column settings
     * 
     */
    $wp_customize->add_setting( 'footer_widget_column',
      array(
        'default'           => 'column-three',
        'sanitize_callback' => 'sanitize_text_field',
      )
    );

    // Add the layout control.
    $wp_customize->add_control( new News_Cast_WP_Radio_Image_Control(
        $wp_customize,
        'footer_widget_column',
        array(
          'label'    => esc_html__( 'Footer Layout', 'news-cast' ),
          'section'  => 'footer_section',
          'choices'  => array(
            'column-three' => array(
              'label' => esc_html__( 'Column Three', 'news-cast' ),
              'url'   => '%s/images/customizer/bz_footer_three.jpg'
            ),
            'column-two' => array(
              'label' => esc_html__( 'Column Two', 'news-cast' ),
              'url'   => '%s/images/customizer/bz_footer_two.jpg'
            ),
            'column-one' => array(
              'label' => esc_html__( 'Column One', 'news-cast' ),
              'url'   => '%s/images/customizer/bz_footer_one.jpg'
            )
          ),
          'active_callback' => function($control) {
            if( footer_option_callback($control) && footer_settings_tab_general_callback($control) ) {
              return true;
            } else {
              return false;
            }
          }
        )
      )
    );

    /**
     * Bottom Footer Settings Heading
     * 
     */
    $wp_customize->add_setting( 'bottom_footer_settings', array(
      'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control( 
        new Style_Mag_WP_Section_Heading_Control( $wp_customize, 'bottom_footer_settings', array(
            'label'	      => esc_html__( 'Bottom Footer Settings', 'news-cast' ),
            'section'     => 'footer_section',
            'settings'    => 'bottom_footer_settings',
            'type'        => 'section-heading',
        ))
    );

    /**
     * Bottom Footer Tab settings
     * 
     */
    $wp_customize->add_setting( 'bottom_footer_settings_tab',
      array(
        'default'           => 'general',
        'sanitize_callback' => 'sanitize_text_field',
      )
    );

    // Add the layout control.
    $wp_customize->add_control( new News_Cast_WP_Radio_Tab_Control(
			$wp_customize,
			'bottom_footer_settings_tab',
        array(
          'label'    => esc_html__( 'Filter bottom footer settings', 'news-cast' ),
          'section'  => 'footer_section',
          'choices'  => array(
            'general' => array(
              'label' => esc_html__( 'General', 'news-cast' )
            )
          )
        )
    ));

    /**
     * Bottom Footer General Settings Heading
     * 
     */
    $wp_customize->add_setting( 'bottom_footer_general_setting', array(
      'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control( 
        new Style_Mag_WP_Section_Heading_Control( $wp_customize, 'bottom_footer_general_setting', array(
            'label'	      => esc_html__( 'General Settings', 'news-cast' ),
            'section'     => 'footer_section',
            'settings'    => 'bottom_footer_general_setting',
            'type'        => 'section-heading',
            'active_callback' => 'bottom_footer_settings_tab_general_callback'
        ))
    );
    
    /**
     * Site Logo Option
     * 
     */
    $wp_customize->add_setting( 'footer_site_logo_option', array(
      'default'           => true,
      'sanitize_callback' => 'news_cast_sanitize_toggle_control',
    ));

    $wp_customize->add_control( 
        new Style_Mag_WP_Toggle_Control( $wp_customize, 'footer_site_logo_option', array(
          'label'	      => esc_html__( 'Show/Hide footer site logo', 'news-cast' ),
          'section'     => 'footer_section',
          'settings'    => 'footer_site_logo_option',
          'type'        => 'toggle',
          'active_callback' => 'bottom_footer_settings_tab_general_callback'
      ))
    );

    /**
     * Footer Site Logo
     * 
     */
    $wp_customize->add_setting( 'footer_logo_image', array(
      'sanitize_callback' => 'esc_url_raw'
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'footer_logo_image',
          array(
              'label'      => __( 'Footer Logo Image', 'news-cast' ),
              'description'=> __( 'Upload image suitable for footer logo area', 'news-cast' ),
              'section'    => 'footer_section',
              'settings'   => 'footer_logo_image',
              'active_callback' => 'bottom_footer_settings_tab_general_callback'
          )
      )
    );

    /**
     * Footer Menu Option
     * 
     */
    $wp_customize->add_setting( 'bottom_footer_menu_option', array(
      'default'           => true,
      'sanitize_callback' => 'news_cast_sanitize_toggle_control',
    ));

    $wp_customize->add_control( 
        new Style_Mag_WP_Toggle_Control( $wp_customize, 'bottom_footer_menu_option', array(
          'label'	      => esc_html__( 'Show/Hide footer menu', 'news-cast' ),
          'description' => esc_html__( 'Goto Appearance > Menus & assign non-empty menu to Bottom Footer in Menu Settings section', 'news-cast' ),
          'section'     => 'footer_section',
          'settings'    => 'bottom_footer_menu_option',
          'type'        => 'toggle',
          'active_callback' => 'bottom_footer_settings_tab_general_callback'
      ))
    );


    /**
     * Footer Social Icons Option
     * 
     */
    $wp_customize->add_setting( 'footer_social_icons_option', array(
      'default'           => true,
      'sanitize_callback' => 'news_cast_sanitize_toggle_control',
    ));

    $wp_customize->add_control( 
        new Style_Mag_WP_Toggle_Control( $wp_customize, 'footer_social_icons_option', array(
          'label'	      => esc_html__( 'Show/Hide footer social icons', 'news-cast' ),
          'description' => sprintf( 'Manage social icons from %s', '<a href="' .admin_url( 'customize.php' . '?autofocus[control]=top_header_social_icons_option' ). '">' .esc_html__( 'social icons links', 'news-cast' ). '</a>' ),
          'section'     => 'footer_section',
          'settings'    => 'footer_social_icons_option',
          'type'        => 'toggle',
          'active_callback' => 'bottom_footer_settings_tab_general_callback'
      ))
    );
}