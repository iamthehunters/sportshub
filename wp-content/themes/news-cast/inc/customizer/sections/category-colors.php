<?php
/**
 * Category Colors Settings
 * 
 * @package News Cast
 * @since 1.0.0
 */

add_action( 'customize_register', 'news_cast_customize_category_colors_section_register', 10 );
/**
 * Add settings for category colors section in the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function news_cast_customize_category_colors_section_register( $wp_customize ) {
    /**
     * Category Colors Section
     * 
     * panel - news_cast_theme_panel
     */
    $wp_customize->add_section( 'category_colors_section', array(
        'title' => esc_html__( 'Category Colors', 'news-cast' ),
        'panel' => 'news_cast_theme_panel',
        'priority'  => 7,
    ));

    /**
     * Category Colors
     * 
     */
    $categories = get_categories();
    foreach( $categories as $category ) :
        /**
         * Category Color
         * 
         */
        $wp_customize->add_setting( 'category_' .esc_attr( $category->slug ),
            array(
            'default'           => '#000000',
            'sanitize_callback' => 'sanitize_text_field',
            )
        );

        // Add the layout control.
        $wp_customize->add_control( new News_Cast_WP_Radio_Image_Control(
                $wp_customize,
                'category_' .esc_attr( $category->slug ),
                array(
                    'label'    => esc_html( $category->name ),
                    'section'  => 'category_colors_section',
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
                    ),
                    'active_callback' => 'footer_option_callback'
                )
            )
        );
    endforeach;
}