<?php
/**
 * Theme inline styles with theme dynamic field values
 * 
 * @package News Cast
 * @since 1.0.0
 */
$header_text_color = get_header_textcolor();
$header_bg_img = get_header_image();

// category colors 
$categories = get_categories();
foreach( $categories as $category ) :
	$category_color = get_theme_mod( 'category_' .esc_attr( $category->slug ) , '#000000' );
	$category_query = get_category_by_slug( $category->slug );
	if( $category_query ) {
		echo ".bmm-block .bmm-post-cats-wrap .bmm-post-cat.bmm-cat-" .esc_attr( $category_query->cat_ID ). "{ background-color : " .esc_attr( $category_color ). ";}\n";
		echo ".bmm-block .bmm-post-cats-wrap .bmm-post-cat.bmm-cat-" .esc_attr( $category_query->cat_ID ). "{ color : " .esc_attr( $category_color ). ";}\n";

		echo ".archive .bmm-post .bmm-post-cat a.bmm-cat-" .esc_attr( $category_query->cat_ID ). "{ color : " .esc_attr( $category_color ). ";}\n";
	}
endforeach;

//Menu
// main menu
	$main_menu_items_bg_color = get_theme_mod( 'main_menu_items_bg_color', '#000000' );
	$menu_border_bottom = get_theme_mod( 'main_menu_border_bottom_color', '#000000' );

	echo ".menu_search_wrap_inner { background-color:". esc_attr($main_menu_items_bg_color) ."; border-bottom-color: ". esc_attr($menu_border_bottom)." }";
	echo "button.menu-toggle { background-color: ". esc_attr($main_menu_items_bg_color) ." }";

	echo "button.menu-toggle { background-color: ". esc_attr($main_menu_items_bg_color) ." }";

	echo "#site-navigation {border-bottom-color:" . esc_attr($main_menu_items_bg_color) . "}"."\n";	
	

echo ".site-branding-section-wrap .container .row{ color: ". esc_attr($header_text_color)." }";

echo ".mainsite--full-layout .site-branding-section-wrap .container { color: ". esc_attr($header_text_color)." }";

if( get_header_image() ){
	echo ".site-branding-section-wrap .container .row{ background-image:url(".get_header_image()."); background-color: #2b2b2b;}";

	echo ".mainsite--full-layout .site-branding-section-wrap .container{ background-image:url(".get_header_image()."); background-color: #2b2b2b;}";
}