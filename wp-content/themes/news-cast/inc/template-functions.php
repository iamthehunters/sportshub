<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package News Cast
 * @since 1.0.0
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function news_cast_body_classes( $classes ) {
	global $post;

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Main site layout
	$site_layout = get_theme_mod( 'site_layout', 'box-layout' );
	$classes[] = esc_attr( 'mainsite--' . $site_layout );

	// Menu hover effect
	$menu_hover = get_theme_mod( 'menu_hover_style', 'menu_hover_1' );
	$classes[] = esc_attr( $menu_hover );
	
	$classes[] = esc_attr( 'header--layout-three' );

	$classes[] = esc_attr( 'widget-title-layout-three' );

	$classes[] = 'no_image_design';

	// Manage sidebar layouts
	if( is_page() ) {
		if( is_front_page() ) {
			$frontpage_sidebar_option = get_theme_mod( 'frontpage_sidebar_option', true );
			$frontpage_sidebar_layout = get_theme_mod( 'frontpage_sidebar_layout', 'right-sidebar' );
			$sidebar_layout = $frontpage_sidebar_option ? $frontpage_sidebar_layout : 'no-sidebar';
		} else {
			$post_sidebar_option = get_theme_mod( 'post_sidebar_option', true );
			$post_sidebar_layout = get_theme_mod( 'post_sidebar_layout', 'right-sidebar' );
			$sidebar_layout = $post_sidebar_option ? $post_sidebar_layout : 'no-sidebar';
		}
		//layout settings
		$layout = get_theme_mod( 'post_layout', 'full-width' ); // layout value
	} else if( is_home() ) {
		$frontpage_sidebar_option = get_theme_mod( 'frontpage_sidebar_option', true );
		$frontpage_sidebar_layout = get_theme_mod( 'frontpage_sidebar_layout', 'right-sidebar' );
		$sidebar_layout = $frontpage_sidebar_option ? $frontpage_sidebar_layout : 'no-sidebar';

		// posts layout
		$archive_posts_layout = get_theme_mod( 'archive_posts_layout', 'list-layout' );
		$classes[] = esc_html( 'posts--'. $archive_posts_layout );
		
	} else if( is_single() ) {
		$post_sidebar_option = get_theme_mod( 'post_sidebar_option', true );
		$post_sidebar_layout = get_theme_mod( 'post_sidebar_layout', 'right-sidebar' );
		$sidebar_layout = $post_sidebar_option ? $post_sidebar_layout : 'no-sidebar';
		//layout settings
		$layout = get_theme_mod( 'post_layout', 'full-width' ); // layout value
	} else if ( is_archive() || is_search() ) {
		// posts layout
		$archive_posts_layout = get_theme_mod( 'archive_posts_layout', 'list-layout' );
		$classes[] = esc_html( 'posts--'. $archive_posts_layout );

		$archive_sidebar_option = get_theme_mod( 'archive_sidebar_option', true );
		$archive_sidebar_layout = get_theme_mod( 'archive_sidebar_layout', 'right-sidebar' );
		$layout = get_theme_mod( 'archive_layout', 'full-width' ); // layout value
		$sidebar_layout = $archive_sidebar_option ? $archive_sidebar_layout : 'no-sidebar';
	}
	$classes[] = isset( $sidebar_layout ) ? esc_attr( $sidebar_layout ) : 'no-sidebar'; // sidebar class
	$classes[] = isset( $layout ) ? esc_attr( $layout ) : 'full-width'; // layout class

	return $classes;
}
add_filter( 'body_class', 'news_cast_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function news_cast_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'news_cast_pingback_header' );

/**
 * Enqueue scripts and styles.
 */
function news_cast_scripts() {
	wp_enqueue_style( 'news-cast-font-awesome', get_template_directory_uri() . '/assets/lib/fontawesome/css/all.min.css', array(), '5.15.3', 'all' );
	wp_enqueue_style( 'slick-slider', get_template_directory_uri() . '/assets/lib/slick/slick.css', array(), '1.8.1', 'all' );
	// Theme Main Style
	wp_enqueue_style( 'news_cast_maincss', get_template_directory_uri() . '/assets/style/main.css', array(), NEWS_CAST_VERSION );
	//Theme Block Style
	wp_enqueue_style( 'news_cast_blockcss', get_template_directory_uri() . '/assets/style/blocks/blocks.css', array(), NEWS_CAST_VERSION );

	// enqueue inline style
	ob_start();
		include get_template_directory() . '/inc/inline-styles.php';
	$news_cast_theme_inline_sss = ob_get_clean();
	wp_add_inline_style( 'news_cast_maincss', wp_strip_all_tags($news_cast_theme_inline_sss) );

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'news-cast-fonts', news_cast_fonts_url(), array(), null );

	wp_enqueue_style( 'news-cast-style', get_stylesheet_uri(), array(), NEWS_CAST_VERSION );
	wp_style_add_data( 'news-cast-style', 'rtl', 'replace' );

	wp_enqueue_script( 'slick-slider', get_template_directory_uri() . '/assets/lib/slick/slick.min.js', array('jquery'), '1.8.1', true );
	wp_enqueue_script( 'waypoint', get_template_directory_uri() . '/assets/lib/waypoint/jquery.waypoint.min.js', array('jquery'), '4.0.1', true );
	wp_enqueue_script( 'news-cast-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), NEWS_CAST_VERSION, true );
	// stickey js
	wp_enqueue_script( 'sticky-sidebar-js', get_template_directory_uri() . '/assets/lib/sticky/theia-sticky-sidebar.js', array(), '1.7.0', true );
	// theme js
	wp_enqueue_script( 'news-cast-theme', get_template_directory_uri() . '/assets/js/theme.js', array( 'jquery' ), NEWS_CAST_VERSION, true );
	// localize variables
	wp_localize_script( 'news-cast-theme', 'themeVar', array(
		'footerTxt' => esc_html__( 'WordPress Theme | News Cast by ', 'news-cast' ),
		'themeUrl'	=> esc_url( wp_get_theme()->get( 'ThemeURI' ) ),
		'author' 	=> esc_html( wp_get_theme()->get( 'Author' ) ),
	));

	$scriptVars = array(
		'scrollToTop'		=> get_theme_mod( 'scroll_to_top_option', true ),
		'stickeyHeader_one' => get_theme_mod( 'sticky_header_option', false )
	);
	wp_localize_script( 'news-cast-navigation', 'screenReaderText', array(
		'expand'   => __( 'expand child menu', 'news-cast' ),
		'collapse' => __( 'collapse child menu', 'news-cast' ),
	));

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'news_cast_scripts' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function news_cast_widgets_init() {
	// Header toggle sidebar
	register_sidebar(
		array(
			'name'          => esc_html__( 'Header Toggle Sidebar', 'news-cast' ),
			'id'            => 'sidebar-header-toggle',
			'description'   => esc_html__( 'Add widgets here.', 'news-cast' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title"><span>',
			'after_title'   => '</span></h2>',
		)
	);

	// default sidebar
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'news-cast' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'news-cast' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title"><span>',
			'after_title'   => '</span></h2>',
		)
	);

	// sidebar Page
	register_sidebar(
		array(
			'name'          => esc_html__( 'Page Sidebar', 'news-cast' ),
			'id'            => 'sidebar-page',
			'description'   => esc_html__( 'Add widgets here.', 'news-cast' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title"><span>',
			'after_title'   => '</span></h2>',
		)
	);

	// footer sidebars
	register_sidebars( 3, array(
			'name'          => esc_html__( 'Footer Column %d', 'news-cast' ),
			'id'            => 'footer-column',
			'description'   => esc_html__( 'Add widgets here.', 'news-cast' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title"><span>',
			'after_title'   => '</span></h2>',
		)
	);
}
add_action( 'widgets_init', 'news_cast_widgets_init' );

//define constant
define( 'NEWS_CAST_INCLUDES_PATH', get_template_directory() . '/inc/' );

/**
 * Elementor modules file
 */
require NEWS_CAST_INCLUDES_PATH . 'elementor-widgets/elementor.php';

/**
 * Theme Hooks
 */
require NEWS_CAST_INCLUDES_PATH . 'hooks/hooks.php';

/**
 * Theme Hooks
 */
require NEWS_CAST_INCLUDES_PATH . 'admin/class-theme-info.php';

/**
 * Register Google fonts.
 * @return string Google fonts URL for the theme.
 */
if ( ! function_exists( 'news_cast_fonts_url' ) ) :
function news_cast_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'cyrillic,cyrillic-ext';

	if ( 'off' !== esc_html_x( 'on', 'Lora: on or off', 'news-cast' ) ) {
		$fonts[] = 'Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700';
	}

	if ( 'off' !== esc_html_x( 'on', 'Open Sans: on or off', 'news-cast' ) ) {
		$fonts[] = 'Open Sans:ital,wght@0,400;0,500;0,600;1,400;1,500;1,600&display=swap';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

if( !function_exists( 'news_cast_get_all_posts_ids' ) ) :
	/**
	 * Get all posts ids
	 * 
	 * @return array
	 */
	function news_cast_get_all_posts_ids() {
		$all_post_ids = get_posts([
			'posts_per_page' => -1,
			'post_status' => 'publish',
			'post_type' => 'post',
			'fields' => 'ids',
		]);
		return apply_filters( 'news_cast_get_all_posts_ids_filter', $all_post_ids );
	}
endif;

if( !function_exists( 'news_cast_get_organized_all_posts_ids' ) ) :
	/**
	 * Get organized all posts ids
	 * 
	 * @return array
	 */
	function news_cast_get_organized_all_posts_ids() {
		$ids = array();
		foreach( news_cast_get_all_posts_ids() as $key => $value ) {
			$ids[$value] = $value;
		}
		return apply_filters( 'news_cast_get_organized_all_posts_ids_filter', $ids );
	}
endif;

if( !function_exists( 'news_cast_get_content_type' ) ) :
	/**
	 * Get content type
	 * @return string
	 */
	function news_cast_get_content_type() {
		$content_type = apply_filters( 'news_cast_post_content_type_filter', 'content' );
		if( is_archive() || is_search() || is_home() ) {
			$archive_content_type = get_theme_mod( 'archive_content_type', 'excerpt' );
			$content_type = ( $archive_content_type ) ? esc_html( $archive_content_type ) : 'excerpt';
		}
		return apply_filters( 'news_cast_post_content_type_filter', $content_type );
	}
endif;

// navigation fallback
if ( ! function_exists( 'news_cast_primary_navigation_fallback' ) ) :

	/**
	 * Fallback for primary navigation.
	 *
	 * @since 1.0.0
	 */
	function news_cast_primary_navigation_fallback() {

		echo '<ul id="menu-main-menu" class="primary-menu">';
		echo '<li class="menu-item"><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'news-cast' ) . '</a></li>';
		$args = array(
			'posts_per_page' => 5,
			'post_type'      => 'page',
			'orderby'        => 'name',
			'order'          => 'ASC',
			);
		$the_query = new WP_Query( $args );
		if ( $the_query->have_posts() ) {
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				the_title( '<li class="menu-item"><a href="' . esc_url( get_permalink() ) . '">', '</a></li>' );
			}
			wp_reset_postdata();
		}
		echo '</ul>';
	}
endif;

// tgm class
require get_template_directory() . '/inc/tgm/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'news_cast_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function news_cast_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		// This is an example of how to include a plugin from the WordPress Plugin Repository.
		array(
			'name'      => esc_html__( 'Elementor', 'news-cast' ),
			'slug'      => 'elementor',
			'required'  => true,
		)
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'news-cast',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);
	tgmpa( $plugins, $config );
}