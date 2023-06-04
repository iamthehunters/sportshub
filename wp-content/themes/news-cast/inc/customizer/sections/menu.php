<?php
/**
 * Menu settings
 * 
 * @package News Cast
 * @since 1.0.0
 */

add_action( 'customize_register', 'news_cast_customize_menu_section_register', 10 );
/**
 * Add settings for Menu in the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function news_cast_customize_menu_section_register( $wp_customize ) {
    /**
     * Menu Section
     * 
     * panel - news_cast_theme_panel
     */
    $wp_customize->add_section( 'menu_section', array(
      'title' 		=> esc_html__( 'Menu Section', 'news-cast' ),
      'panel' 		=> 'news_cast_theme_panel',
      'priority' 	=> 6,
    ));

	  /**
     * Primary Menu Heading
     * 
     */
    $wp_customize->add_setting( 'menu_hover_style_header', array(
        'sanitize_callback' => 'sanitize_text_field'
      ));

    $wp_customize->add_control( 
        new Style_Mag_WP_Section_Heading_Control( $wp_customize, 'menu_hover_style_header', array(
            'label'       => esc_html__( 'Primary Menu Hover Effect', 'news-cast' ),
            'section'     => 'menu_section',
            'settings'    => 'menu_hover_style_header',
            'type'        => 'section-heading',
        ))
    );

    /**
     * Primary Menu Hover Settings
     * 
     */
	$wp_customize->add_setting( 'menu_hover_style', array(
		'default' => 'menu_hover_1',
		'sanitize_callback' => 'news_cast_sanitize_menuhover',
	) );  
	$wp_customize->add_control( 
		'menu_hover_style', array(
			'type' 		=> 'radio',
			'section' 	=> 'menu_section',
			'choices' 	=> array(	
					'menu_hover_1' => __( 'Menu Hover Effect 1', 'news-cast' ),
					'menu_hover_none' => __( 'Menu Hover Effect none', 'news-cast' )
			)
		)
	);

    /**** Mobile Menu color Options ****/
    /**
     * Menu Styling Heading
     * 
     */
    $wp_customize->add_setting( 'menu_styling_header', array(
      'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control( 
        new Style_Mag_WP_Section_Heading_Control( $wp_customize, 'menu_styling_header', array(
            'label'       => esc_html__( 'Menu Styling/Colors', 'news-cast' ),
            'section'     => 'menu_section',
            'settings'    => 'menu_styling_header',
            'type'        => 'section-heading',
        ))
    );

    /**
     * Main Menu Border bottom
     * 
     */
    $wp_customize->add_setting( 'main_menu_items_bg_color',
        array(
        'default'           => '#000000',
        'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control( new News_Cast_WP_Radio_Image_Control(
        $wp_customize,
        'main_menu_items_bg_color',
          array(
            'label'    => esc_html__( 'Menu Border Top', 'news-cast' ),
            'section'  => 'menu_section',
            'choices'  => array(
                '#ea2e49' => array(
                    'label' => esc_html__( 'Light Red', 'news-cast' ),
                    'url'   => '%s/images/customizer/category-light-red.png'
                ),
                '#ff0000' => array(
                    'label' => esc_html__( 'Red', 'news-cast' ),
                    'url'   => '%s/images/customizer/category-red.png'
                ),
                '#0000ff' => array(
                    'label' => esc_html__( 'Blue', 'news-cast' ),
                    'url'   => '%s/images/customizer/category-blue.png'
                ),
                '#000000' => array(
                    'label' => esc_html__( 'Black', 'news-cast' ),
                    'url'   => '%s/images/customizer/category-black.png'
                )
            )
          )
      )
    );

    /**
     * Main Menu Border bottom
     * 
     */
    $wp_customize->add_setting( 'main_menu_border_bottom_color',
        array(
        'default'           => '#000000',
        'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control( new News_Cast_WP_Radio_Image_Control(
        $wp_customize,
        'main_menu_border_bottom_color',
          array(
            'label'    => esc_html__( 'Menu Border Bottom', 'news-cast' ),
            'section'  => 'menu_section',
            'choices'  => array(
                '#ea2e49' => array(
                    'label' => esc_html__( 'Light Red', 'news-cast' ),
                    'url'   => '%s/images/customizer/category-light-red.png'
                ),
                '#ff0000' => array(
                    'label' => esc_html__( 'Red', 'news-cast' ),
                    'url'   => '%s/images/customizer/category-red.png'
                ),
                '#0000ff' => array(
                    'label' => esc_html__( 'Blue', 'news-cast' ),
                    'url'   => '%s/images/customizer/category-blue.png'
                ),
                '#000000' => array(
                    'label' => esc_html__( 'Black', 'news-cast' ),
                    'url'   => '%s/images/customizer/category-black.png'
                )
            )
          )
      )
    );
}