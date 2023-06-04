<?php
/**
 * News Cast Theme Customizer
 *
 * @package News Cast
 * @since 1.0.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function news_cast_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/**
	 * Includes customizer files
	 * 
	 */
	require NEWS_CAST_INCLUDES_PATH . 'customizer/extend-customizer/news-cast-customize-section.php';
	require NEWS_CAST_INCLUDES_PATH . 'customizer/custom-controls/toggle-control/toggle-control.php';
	require NEWS_CAST_INCLUDES_PATH . 'customizer/custom-controls/section-heading/section-heading.php';
	require NEWS_CAST_INCLUDES_PATH . 'customizer/custom-controls/radio-image/radio-image.php';
	require NEWS_CAST_INCLUDES_PATH . 'customizer/custom-controls/radio-tab/radio-tab.php';

	// extend customizer section
	$wp_customize->register_section_type( 'News_Cast_WP_Customize_Section' );
	$wp_customize->register_control_type( 'News_Cast_WP_Radio_Image_Control' );
	$wp_customize->register_control_type( 'News_Cast_WP_Radio_Tab_Control' );

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'news_cast_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'news_cast_customize_partial_blogdescription',
			)
		);
	}

	// register 'Theme Options' panel
	$wp_customize->add_panel( 'news_cast_theme_panel', array(
		'title' => esc_html__( 'Theme Options', 'news-cast' ),
		'priority' => 10,
	));
}
add_action( 'customize_register', 'news_cast_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function news_cast_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function news_cast_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function news_cast_customize_preview_js() {
	wp_enqueue_script( 'news-cast-customizer', get_template_directory_uri() . '/assets/js/customizer-preview.js', array( 'customize-preview' ), NEWS_CAST_VERSION, true );
}
add_action( 'customize_preview_init', 'news_cast_customize_preview_js' );

// Enqueue our scripts and styles
function news_cast_customize_controls_scripts() {
	wp_enqueue_script( 'news-cast-customize-controls', get_template_directory_uri() . '/inc//customizer/extend-customizer/extend-customizer.js', array(), NEWS_CAST_VERSION, true );
	wp_enqueue_script( 'news-cast-customize-preview-redirects', get_template_directory_uri() . '/inc//customizer/extend-customizer/preview-redirects.js', array('customize-controls'), NEWS_CAST_VERSION, true );

	// define global object for js file.
	wp_localize_script( 'news-cast-customize-preview-redirects', 'newsCastPreviewUrls', array(
		'errorPageUrl'  => esc_url( get_home_url() . '/vebskjbkb' )
	)
);
}
add_action( 'customize_controls_enqueue_scripts', 'news_cast_customize_controls_scripts' );

function news_cast_customize_controls_styles() {
	wp_enqueue_style( 'news-cast-customize-controls', get_template_directory_uri() . '/inc//customizer/extend-customizer/extend-customizer.css', array(), NEWS_CAST_VERSION, 'all' );
}
add_action( 'customize_controls_print_styles', 'news_cast_customize_controls_styles' );

// includes customizer files
require NEWS_CAST_INCLUDES_PATH . 'customizer/sanitize.php';
require NEWS_CAST_INCLUDES_PATH . 'customizer/active-callback.php';

/**
 * Includes customizer files
 * 
 */
require NEWS_CAST_INCLUDES_PATH . 'customizer/sections/site-settings.php';
require NEWS_CAST_INCLUDES_PATH . 'customizer/sections/menu.php';
require NEWS_CAST_INCLUDES_PATH . 'customizer/sections/top-header.php';
require NEWS_CAST_INCLUDES_PATH . 'customizer/sections/header.php';
require NEWS_CAST_INCLUDES_PATH . 'customizer/sections/footer.php';
require NEWS_CAST_INCLUDES_PATH . 'customizer/sections/sidebars.php';
require NEWS_CAST_INCLUDES_PATH . 'customizer/sections/layouts.php';
require NEWS_CAST_INCLUDES_PATH . 'customizer/sections/innerpages.php';
require NEWS_CAST_INCLUDES_PATH . 'customizer/sections/category-colors.php';
require NEWS_CAST_INCLUDES_PATH . 'admin/customizer-upsell/theme-upsell.php';