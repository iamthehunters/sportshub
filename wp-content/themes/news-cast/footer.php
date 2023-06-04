<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package News Cast
 * @since 1.0.0
 */

 /**
  * hook - news_cast_footer_hook
  *
  * @hooked - news_cast_footer_start
  * @hooked - news_cast_footer_close
  *
  */
  	if( has_action( 'news_cast_footer_hook' ) ) {
		do_action( 'news_cast_footer_hook' );
	}

  /**
  * hook - news_cast_bottom_footer_hook
  *
  * @hooked - news_cast_bottom_footer_start
  * @hooked - news_cast_bottom_footer_site_logo
  * @hooked - news_cast_bottom_footer_menu
  * @hooked - news_cast_bottom_footer_site_info
  * @hooked - news_cast_bottom_footer_close
  *
  */
  	if( has_action( 'news_cast_bottom_footer_hook' ) ) {
	  	do_action( 'news_cast_bottom_footer_hook' );
  	}

    /**
    * hook - news_cast_after_footer_hook
    *
    * @hooked - news_cast_scroll_to_top
    *
    */
  	if( has_action( 'news_cast_after_footer_hook' ) ) {
	  	do_action( 'news_cast_after_footer_hook' );
  	}
?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
