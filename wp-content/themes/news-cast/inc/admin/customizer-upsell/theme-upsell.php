<?php
/**
 * Footer settings
 * 
 * @package News Cast
 * @since 1.0.0
 */

add_action( 'customize_register', 'news_cast_upsell_section_register', 10 );
/**
 * Add settings for upsell links
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function news_cast_upsell_section_register( $wp_customize ) {
	require get_template_directory() . '/inc/admin/customizer-upsell/upsell-section/upsell-button.php';
    require get_template_directory() . '/inc/admin/customizer-upsell/upsell-section/upsell-control.php';
    $wp_customize->register_section_type( 'News_Cast_Upsell_Button' );
    $wp_customize->register_control_type( 'News_Cast_Upsell_Control' );
    /**
     * Add Upsell Button
     * 
     */
    $wp_customize->add_section(
		new News_Cast_Upsell_Button( $wp_customize, 
            'upsell_button', [
                'button_text'   => esc_html__( 'View Premium', 'news-cast' ),
                'button_url'    => esc_url( '//blazethemes.com/theme/news-cast-pro/' ),
                'priority'      => 1
            ]
        )
	);



     /**
     * Add premium features listing section
     * 
     */
    $wp_customize->add_section( 'homepage_info_section', array(
        'title' => esc_html__( 'HomePage Setup Info', 'news-cast' ),
        'priority'  => 1,
    ));


    /**
     * List out "features" settings
     * 
     */
    $wp_customize->add_setting( 'homepage_info_settings',
        array(
            'sanitize_callback' => 'wp_kses_post',
      )
    );

    $wp_customize->add_control( 
        new News_Cast_Upsell_Control( $wp_customize, 'homepage_info_settings', array(
            'section'     => 'homepage_info_section',
            'description'   => esc_html__( "By activating Elementor, you can setup homepage customizing widgets provided by theme. Upgrade to Premium for Both Gutenberg Blocks And Elementor Widgets with multiple layouts", "news-cast" ),
            'type'        => 'news-cast-upsell'
        )
    ));

    /**
     * Add Upsell Button
     * 
     */
    $wp_customize->add_section(
        new News_Cast_Upsell_Button( $wp_customize, 
            'demo_import_button', array(
                'button_text'   => esc_html__( 'Go to Import', 'news-cast' ),
                'button_url'    => esc_url( admin_url('themes.php?page=news-cast-info.php') ),
                'title'         => esc_html__('Import Demo Data', 'news-cast'),
                'priority'  => 1000,
            )
        )
    );
    
    /**
     * Add Documentation Redirect Button
     * 
     */
    $wp_customize->add_section(
        new News_Cast_Upsell_Button( $wp_customize, 
            'documentation_button', array(
                'button_text'   => esc_html__( 'View', 'news-cast' ),
                'button_url'    => esc_url( 'https://doc.blazethemes.com/news-cast/' ),
                'title'         => esc_html__('Theme Documentation', 'news-cast'),
                'priority'  => 1000,
            )
        )
    );
}

/**
 * Enqueue theme upsell controls scripts
 * 
 */
function news_cast_upsell_scripts() {
    wp_enqueue_style( 'news-cast-upsell', get_template_directory_uri() . '/inc/admin/customizer-upsell/upsell-section/upsell.css', array(), '1.0.0', 'all' );
    wp_enqueue_script( 'news-cast-upsell', get_template_directory_uri() . '/inc/admin/customizer-upsell/upsell-section/upsell.js', array(), '1.0.0', 'all' );
}
add_action( 'customize_controls_enqueue_scripts', 'news_cast_upsell_scripts' );