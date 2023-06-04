<?php
/**
 * Top header settings
 * 
 * @package News Cast
 * @since 1.0.0
 */

add_action( 'customize_register', 'news_cast_customize_top_header_section_register', 10 );
/**
 * Add settings for top header in the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function news_cast_customize_top_header_section_register( $wp_customize ) {
    /**
     * Top Header Section
     * 
     * panel - news_cast_theme_panel
     */
    $wp_customize->add_section( 'top_header_section', array(
      'title' => esc_html__( 'Top Header Section', 'news-cast' ),
      'panel' => 'news_cast_theme_panel',
      'priority'  => 10,
    ));

    /**
     * Top Header tab settings
     * 
     */
    $wp_customize->add_setting( 'top_header_settings_tab',
      array(
        'default'           => 'general',
        'sanitize_callback' => 'sanitize_text_field',
      )
    );

    // Add the layout control.
    $wp_customize->add_control( new News_Cast_WP_Radio_Tab_Control(
			$wp_customize,
			'top_header_settings_tab',
        array(
          'label'    => esc_html__( 'Filter top header settings', 'news-cast' ),
          'section'  => 'top_header_section',
          'choices'  => array(
            'general' => array(
              'label' => esc_html__( 'General', 'news-cast' )
            )
          )
        )
    ));

    /**
     * Top Header General Settings Heading
     * 
     */
    $wp_customize->add_setting( 'top_header_general_setting_header', array(
      'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control( 
        new Style_Mag_WP_Section_Heading_Control( $wp_customize, 'top_header_general_setting_header', array(
          'label'	      => esc_html__( 'General Settings', 'news-cast' ),
          'section'     => 'top_header_section',
          'settings'    => 'top_header_general_setting_header',
          'type'        => 'section-heading',
          'active_callback' => function($control) {
            if( top_header_settings_tab_general_callback($control) ) {
              return true;
            } else {
              return false;
            }
          }
      ))
    );

    /**
     * Top Header Tags Option
     * 
     */
    $wp_customize->add_setting( 'top_header_tags_option', array(
      'default'           => true,
      'sanitize_callback' => 'news_cast_sanitize_toggle_control',
    ));

    $wp_customize->add_control( 
      new Style_Mag_WP_Toggle_Control( $wp_customize, 'top_header_tags_option', array(
          'label'	      => esc_html__( 'Show/Hide Tags', 'news-cast' ),
          'section'     => 'top_header_section',
          'settings'    => 'top_header_tags_option',
          'type'        => 'toggle',
          'active_callback' => function($control) {
            if( top_header_settings_tab_general_callback($control) ) {
              return true;
            } else {
              return false;
            }
          }
      ))
    );
    
    /**
     * Top Header Date Option
     * 
     */
    $wp_customize->add_setting( 'top_header_date_option', array(
      'default'         => true,
      'sanitize_callback' => 'news_cast_sanitize_toggle_control',
    ));

    $wp_customize->add_control( 
      new Style_Mag_WP_Toggle_Control( $wp_customize, 'top_header_date_option', array(
          'label'	      => esc_html__( 'Show/Hide Current Date', 'news-cast' ),
          'section'     => 'top_header_section',
          'settings'    => 'top_header_date_option',
          'type'        => 'toggle',
          'active_callback' => function($control) {
            if( top_header_settings_tab_general_callback($control) ) {
              return true;
            } else {
              return false;
            }
          }
      ))
    );
    
    /**
     * Top Header Menu Option
     * 
     */
    $wp_customize->add_setting( 'top_header_menu_option', array(
      'default'         => true,
      'sanitize_callback' => 'news_cast_sanitize_toggle_control',
    ));

    $wp_customize->add_control( 
      new Style_Mag_WP_Toggle_Control( $wp_customize, 'top_header_menu_option', array(
          'label'	      => esc_html__( 'Show/Hide Menu', 'news-cast' ),
          'section'     => 'top_header_section',
          'settings'    => 'top_header_menu_option',
          'type'        => 'toggle',
          'active_callback' => function($control) {
            if( top_header_settings_tab_general_callback($control) ) {
              return true;
            } else {
              return false;
            }
          }
      ))
    );

    /**
     * Top Header Social Icons
     * 
     */
    $wp_customize->add_setting( 'top_header_social_icons_option', array(
      'default'         => true,
      'sanitize_callback' => 'news_cast_sanitize_toggle_control',
    ));

    $wp_customize->add_control( 
      new Style_Mag_WP_Toggle_Control( $wp_customize, 'top_header_social_icons_option', array(
          'label'	      => esc_html__( 'Show/Hide Social Icons', 'news-cast' ),
          'section'     => 'top_header_section',
          'settings'    => 'top_header_social_icons_option',
          'type'        => 'toggle',
          'active_callback' => function($control) {
            if( top_header_settings_tab_general_callback($control) ) {
              return true;
            } else {
              return false;
            }
          }
      ))
    );

    /**
     * Social Icon One
     * 
     */
    $wp_customize->add_setting( 'top_header_social_icon_one', array(
      'default'         => 'facebook',
      'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( 'top_header_social_icon_one', array(
          'label'	      => esc_html__( 'Icon', 'news-cast' ),
          'section'     => 'top_header_section',
          'type'        => 'select',
          'choices'     => array(
            'facebook'  => esc_html__( 'Facebook', 'news-cast' ),
            'vimeo'     => esc_html__( 'Vimeo', 'news-cast' ),
            'twitter'   => esc_html__( 'Twitter', 'news-cast' ),
            'pinterest' => esc_html__( 'Pinterest', 'news-cast' ),
            'instagram' => esc_html__( 'Instagram', 'news-cast' )
          ),
          'active_callback' => function($control) {
            if( top_header_social_icons_option_callback($control) && top_header_settings_tab_general_callback($control) ) {
              return true;
            } else {
              return false;
            }
          }
      )
    );

    /**
     * Social Icon One Url
     * 
     */
    $wp_customize->add_setting( 'top_header_social_icon_one_url', array(
      'default'        => '#',
      'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control( 'top_header_social_icon_one_url', array(
        'label'    => esc_html__( 'Icon Url', 'news-cast' ),
        'section'  => 'top_header_section',		
        'type'     => 'url',
        'active_callback' => function($control) {
          if( top_header_social_icons_option_callback($control) && top_header_settings_tab_general_callback($control) ) {
            return true;
          } else {
            return false;
          }
        }
    ));

    /**
     * Social Icon Two
     * 
     */
    $wp_customize->add_setting( 'top_header_social_icon_two', array(
      'default'         => 'vimeo',
      'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( 'top_header_social_icon_two', array(
          'label'	      => esc_html__( 'Icon', 'news-cast' ),
          'section'     => 'top_header_section',
          'type'        => 'select',
          'choices'     => array(
            'facebook'  => esc_html__( 'Facebook', 'news-cast' ),
            'vimeo'     => esc_html__( 'Vimeo', 'news-cast' ),
            'twitter'   => esc_html__( 'Twitter', 'news-cast' ),
            'pinterest' => esc_html__( 'Pinterest', 'news-cast' ),
            'instagram' => esc_html__( 'Instagram', 'news-cast' )
          ),
          'active_callback' => function($control) {
            if( top_header_social_icons_option_callback($control) && top_header_settings_tab_general_callback($control) ) {
              return true;
            } else {
              return false;
            }
          }
      )
    );

    /**
     * Social Icon Two Url
     * 
     */
    $wp_customize->add_setting( 'top_header_social_icon_two_url', array(
      'default'        => '#',
      'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control( 'top_header_social_icon_two_url', array(
        'label'    => esc_html__( 'Icon Url', 'news-cast' ),
        'section'  => 'top_header_section',		
        'type'     => 'url',
        'active_callback' => function($control) {
          if( top_header_social_icons_option_callback($control) && top_header_settings_tab_general_callback($control) ) {
            return true;
          } else {
            return false;
          }
        }
    ));

    /**
     * Social Icon Three
     * 
     */
    $wp_customize->add_setting( 'top_header_social_icon_three', array(
      'default'         => 'twitter',
      'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( 'top_header_social_icon_three', array(
          'label'	      => esc_html__( 'Icon', 'news-cast' ),
          'section'     => 'top_header_section',
          'type'        => 'select',
          'choices'     => array(
            'facebook'  => esc_html__( 'Facebook', 'news-cast' ),
            'vimeo'     => esc_html__( 'Vimeo', 'news-cast' ),
            'twitter'   => esc_html__( 'Twitter', 'news-cast' ),
            'pinterest' => esc_html__( 'Pinterest', 'news-cast' ),
            'instagram' => esc_html__( 'Instagram', 'news-cast' )
          ),
          'active_callback' => function($control) {
            if( top_header_social_icons_option_callback($control) && top_header_settings_tab_general_callback($control) ) {
              return true;
            } else {
              return false;
            }
          }
      )
    );

    /**
     * Social Icon Three Url
     * 
     */
    $wp_customize->add_setting( 'top_header_social_icon_three_url', array(
      'default'        => '#',
      'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control( 'top_header_social_icon_three_url', array(
        'label'    => esc_html__( 'Icon Url', 'news-cast' ),
        'section'  => 'top_header_section',		
        'type'     => 'url',
        'active_callback' => function($control) {
          if( top_header_social_icons_option_callback($control) && top_header_settings_tab_general_callback($control) ) {
            return true;
          } else {
            return false;
          }
        }
    ));

}