<?php
/**
 * Inner Pages settings
 * 
 * @package News Cast
 * @since 1.0.0
 */

add_action( 'customize_register', 'news_cast_customize_innerpages_section_register', 10 );
/**
 * Add settings for innerpages in the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function news_cast_customize_innerpages_section_register( $wp_customize ) {
    /**
     * Inner Pages Setting
     * 
     * panel - news_cast_theme_panel
     */
    $wp_customize->add_section(
         new News_Cast_WP_Customize_Section( $wp_customize, 'innerpages_section', array(
                'title' => esc_html__( 'InnerPages Setting', 'news-cast' ),
                'panel' => 'news_cast_theme_panel',
            )
        )
    );

    /**
     *  Archive Page Section
     * 
     */
    $wp_customize->add_section(
        new News_Cast_WP_Customize_Section( $wp_customize, 'innerpages_archive_page_section', array(
               'title'      => esc_html__( 'Archive Page', 'news-cast' ),
               'section'    => 'innerpages_section',
               'panel' => 'news_cast_theme_panel',
           )
       )
    );
    
    /**
     * Archive general content settings
     * 
     */
    $wp_customize->add_setting( 'archive_general_content_setting_header', array(
        'sanitize_callback' => 'sanitize_text_field'
      ));

    $wp_customize->add_control( 
        new Style_Mag_WP_Section_Heading_Control( $wp_customize, 'archive_general_content_setting_header', array(
            'label'       => esc_html__( 'General Content Settings', 'news-cast' ),
            'section'     => 'innerpages_archive_page_section',
            'settings'    => 'archive_general_content_setting_header',
            'type'        => 'section-heading',
        ))
    );

    /**
     * Archive post content type
     * 
     */
    $wp_customize->add_setting( 'archive_content_type', array(
        'default' => 'excerpt',
        'sanitize_callback' => 'news_cast_sanitize_select_control'
    ));
      
    $wp_customize->add_control( 'archive_content_type', array(
        'type'      => 'select',
        'section'   => 'innerpages_archive_page_section',
        'label'     => __( 'Post Content to display', 'news-cast' ),
        'choices'   => array(
            'excerpt' => esc_html__( 'Excerpt', 'news-cast' ),
            'content' => esc_html__( 'Content', 'news-cast' )
        ),
    ));
    
    /**
     * Archive Posted on Date Option
     * 
     */
    $wp_customize->add_setting( 'archive_post_date_option', array(
        'default'         => true,
        'sanitize_callback' => 'news_cast_sanitize_toggle_control',
    ));
  
    $wp_customize->add_control( 
        new Style_Mag_WP_Toggle_Control( $wp_customize, 'archive_post_date_option', array(
            'label'	      => esc_html__( 'Show/Hide post date', 'news-cast' ),
            'section'     => 'innerpages_archive_page_section',
            'settings'    => 'archive_post_date_option',
            'type'        => 'toggle'
        ))
    );

    /**
     * Archive Author Option
     * 
     */
    $wp_customize->add_setting( 'archive_post_author_option', array(
        'default'         => true,
        'sanitize_callback' => 'news_cast_sanitize_toggle_control',
    ));
  
    $wp_customize->add_control( 
        new Style_Mag_WP_Toggle_Control( $wp_customize, 'archive_post_author_option', array(
            'label'	      => esc_html__( 'Show/Hide post author', 'news-cast' ),
            'section'     => 'innerpages_archive_page_section',
            'settings'    => 'archive_post_author_option',
            'type'        => 'toggle'
        ))
    );
    
    /**
     * Archive Category Option
     * 
     */
    $wp_customize->add_setting( 'archive_post_categories_option', array(
        'default'         => true,
        'sanitize_callback' => 'news_cast_sanitize_toggle_control',
    ));
  
    $wp_customize->add_control( 
        new Style_Mag_WP_Toggle_Control( $wp_customize, 'archive_post_categories_option', array(
            'label'	      => esc_html__( 'Show/Hide post categories', 'news-cast' ),
            'section'     => 'innerpages_archive_page_section',
            'settings'    => 'archive_post_categories_option',
            'type'        => 'toggle'
        ))
    );
    
    /**
     * Archive Tag Option
     * 
     */
    $wp_customize->add_setting( 'archive_post_tags_option', array(
        'default'         => true,
        'sanitize_callback' => 'news_cast_sanitize_toggle_control',
    ));
  
    $wp_customize->add_control( 
        new Style_Mag_WP_Toggle_Control( $wp_customize, 'archive_post_tags_option', array(
            'label'	      => esc_html__( 'Show/Hide post tags', 'news-cast' ),
            'section'     => 'innerpages_archive_page_section',
            'settings'    => 'archive_post_tags_option',
            'type'        => 'toggle'
        ))
    );
    
    /**
     * Archive Read more Option
     * 
     */
    $wp_customize->add_setting( 'archive_read_more_option', array(
        'default'         => true,
        'sanitize_callback' => 'news_cast_sanitize_toggle_control',
    ));
  
    $wp_customize->add_control( 
        new Style_Mag_WP_Toggle_Control( $wp_customize, 'archive_read_more_option', array(
            'label'	      => esc_html__( 'Show/Hide read more', 'news-cast' ),
            'section'     => 'innerpages_archive_page_section',
            'settings'    => 'archive_read_more_option',
            'type'        => 'toggle'
        ))
    );
    /*----------------------------------------------------------------------------------------------------------------------------------------*/

    /**
     *  Single Page Section
     * 
     */
    $wp_customize->add_section(
        new News_Cast_WP_Customize_Section( $wp_customize, 'innerpages_single_page_section', array(
               'title'      => esc_html__( 'Single Page', 'news-cast' ),
               'section'    => 'innerpages_section',
               'panel' => 'news_cast_theme_panel',
           )
       )
    );

    /**
     * Single general content settings
     * 
     */
    $wp_customize->add_setting( 'single_general_content_setting_header', array(
        'sanitize_callback' => 'sanitize_text_field'
      ));

    $wp_customize->add_control( 
        new Style_Mag_WP_Section_Heading_Control( $wp_customize, 'single_general_content_setting_header', array(
            'label'       => esc_html__( 'General Content Settings', 'news-cast' ),
            'section'     => 'innerpages_single_page_section',
            'settings'    => 'single_general_content_setting_header',
            'type'        => 'section-heading',
        ))
    );

    /**
     * Single Posted on Date Option
     * 
     */
    $wp_customize->add_setting( 'single_post_date_option', array(
        'default'         => true,
        'sanitize_callback' => 'news_cast_sanitize_toggle_control',
    ));
  
    $wp_customize->add_control( 
        new Style_Mag_WP_Toggle_Control( $wp_customize, 'single_post_date_option', array(
            'label'	      => esc_html__( 'Show/Hide post date', 'news-cast' ),
            'section'     => 'innerpages_single_page_section',
            'settings'    => 'single_post_date_option',
            'type'        => 'toggle'
        ))
    );

    /**
     * Single Author Option
     * 
     */
    $wp_customize->add_setting( 'single_post_author_option', array(
        'default'         => true,
        'sanitize_callback' => 'news_cast_sanitize_toggle_control',
    ));
  
    $wp_customize->add_control( 
        new Style_Mag_WP_Toggle_Control( $wp_customize, 'single_post_author_option', array(
            'label'	      => esc_html__( 'Show/Hide post author', 'news-cast' ),
            'section'     => 'innerpages_single_page_section',
            'settings'    => 'single_post_author_option',
            'type'        => 'toggle'
        ))
    );

    /**
     * Single Category Option
     * 
     */
    $wp_customize->add_setting( 'single_post_categories_option', array(
        'default'         => true,
        'sanitize_callback' => 'news_cast_sanitize_toggle_control',
    ));
  
    $wp_customize->add_control( 
        new Style_Mag_WP_Toggle_Control( $wp_customize, 'single_post_categories_option', array(
            'label'	      => esc_html__( 'Show/Hide post categories', 'news-cast' ),
            'section'     => 'innerpages_single_page_section',
            'settings'    => 'single_post_categories_option',
            'type'        => 'toggle'
        ))
    );
    
    /**
     * Single Tag Option
     * 
     */
    $wp_customize->add_setting( 'single_post_tags_option', array(
        'default'         => true,
        'sanitize_callback' => 'news_cast_sanitize_toggle_control',
    ));
  
    $wp_customize->add_control( 
        new Style_Mag_WP_Toggle_Control( $wp_customize, 'single_post_tags_option', array(
            'label'	      => esc_html__( 'Show/Hide post tags', 'news-cast' ),
            'section'     => 'innerpages_single_page_section',
            'settings'    => 'single_post_tags_option',
            'type'        => 'toggle'
        ))
    );
}