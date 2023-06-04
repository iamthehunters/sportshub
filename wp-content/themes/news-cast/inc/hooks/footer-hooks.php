<?php
/**
 * Handles hooks for the footer area of the themes
 * 
 * @package News Cast
 * @since 1.0.0
 * 
 */

if( !function_exists( 'news_cast_footer_start' ) ) {
    /**
     * Footer start
     */
   function news_cast_footer_start() {
    $footer_widget_column = get_theme_mod( 'footer_widget_column', 'column-three' );
    echo '<footer id="colophon" class="site-footer footer-' .esc_attr( $footer_widget_column ). '">';
    echo '<div class="container footer-inner">';
   }
}

if( !function_exists( 'news_cast_footer_widget_content' ) ) :
  /**
   * Footer widget content
   * 
   */
  function news_cast_footer_widget_content() {
    get_template_part( '/footer-columns' );
  }
endif;
if( !function_exists( 'news_cast_footer_close' ) ) {
  /**
   * Footer close
   */
 function news_cast_footer_close() {
  echo '</div><!-- .container -->';
  echo '</footer><!-- #colophon -->';
 }
}

add_action( 'news_cast_footer_hook', 'news_cast_footer_start', 5 );
add_action( 'news_cast_footer_hook', 'news_cast_footer_widget_content', 10 );
add_action( 'news_cast_footer_hook', 'news_cast_footer_close', 100 );

/************************************ 
 * Bottom Footer Hook *
 * ***********************************/
if( !function_exists( 'news_cast_bottom_footer_start' ) ) {
  /**
   * Bottom Footer start
   */
 function news_cast_bottom_footer_start() {
  echo '<div id="bottom-footer">';
  echo '<div class="container bottom-footer-inner">';
 }
}

if( !function_exists( 'news_cast_bottom_footer_site_logo' ) ) {
  /**
   * Bottom Footer site logo
   */
  function news_cast_bottom_footer_site_logo() {
    $footer_site_logo_option = get_theme_mod( 'footer_site_logo_option', true );
    $footer_site_logo = get_theme_mod( 'footer_logo_image' );
    if( !$footer_site_logo_option ) {
      return;
    }
    if($footer_site_logo){
      ?>
      <div class="footer_logo">
        <img src="<?php echo esc_url($footer_site_logo); ?>">
      </div>
      <?php
    }
  }
}

if( !function_exists( 'news_cast_bottom_footer_menu' ) ) :
  /**
   * Bottom Footer navigation Info
   * 
   */
  function news_cast_bottom_footer_menu() { 
    $bottom_footer_menu_option = get_theme_mod( 'bottom_footer_menu_option', true );
    if( !$bottom_footer_menu_option ) {
      return;
    }
    ?>
      <div class="bottom-footer-menu">
        <?php
          wp_nav_menu(
            array(
              'theme_location'  => 'menu-3',
              'menu_id'         => 'bottom-footer-menu',
              'depth'           => 1,
              'fallback_cb'     => false
            )
          );
        ?>
      </div>
    <?php
  }
endif;

if( !function_exists( 'news_cast_bottom_footer_social_icons' ) ) :
  /**
   * Bottom Footer Social Icons
   * 
   */
  function news_cast_bottom_footer_social_icons() { 
    $footer_social_icons_option = get_theme_mod( 'footer_social_icons_option', true );
    if( !$footer_social_icons_option ) {
      return;
    }
    ?>
      <div class="bottom-footer-social-icons-wrap">
        <?php
          $top_header_social_icon_one_url = get_theme_mod( 'top_header_social_icon_one_url', '#' );
          if( !empty( $top_header_social_icon_one_url ) ) {
              $top_header_social_icon_one = get_theme_mod( 'top_header_social_icon_one', 'facebook' );
              echo '<a href="'.esc_url( $top_header_social_icon_one_url ).'" target="_self" rel="noopener"><i class="fab fa-' .esc_attr( $top_header_social_icon_one ). '"></i></a>';
          }

          $top_header_social_icon_two_url = get_theme_mod( 'top_header_social_icon_two_url', '#' );
          if( !empty( $top_header_social_icon_two_url ) ) {
              $top_header_social_icon_two = get_theme_mod( 'top_header_social_icon_two', 'vimeo' );
              echo '<a href="'.esc_url( $top_header_social_icon_two_url ).'" target="_self" rel="noopener"><i class="fab fa-' .esc_attr( $top_header_social_icon_two ). '"></i></a>';
          }

          $top_header_social_icon_three_url = get_theme_mod( 'top_header_social_icon_three_url', '#' );
          if( !empty( $top_header_social_icon_three_url ) ) {
              $top_header_social_icon_three = get_theme_mod( 'top_header_social_icon_three', 'twitter' );
              echo '<a href="'.esc_url( $top_header_social_icon_three_url ).'" target="_self" rel="noopener"><i class="fab fa-' .esc_attr( $top_header_social_icon_three ). '"></i></a>';
          }
        ?>
      </div>
    <?php
  }
endif;

if( !function_exists( 'news_cast_bottom_footer_close' ) ) :
  /**
   * Bottom Footer close0
   */
  function news_cast_bottom_footer_close() {
      echo '</div><!-- .container -->';
    echo '</div><!-- #bottom-footer -->';
  }
endif;

add_action( 'news_cast_bottom_footer_hook', 'news_cast_bottom_footer_start', 5 );
add_action( 'news_cast_bottom_footer_hook', 'news_cast_bottom_footer_site_logo', 10 );
add_action( 'news_cast_bottom_footer_hook', 'news_cast_bottom_footer_menu', 30 );
add_action( 'news_cast_bottom_footer_hook', 'news_cast_bottom_footer_social_icons', 40 );
add_action( 'news_cast_bottom_footer_hook', 'news_cast_bottom_footer_close', 100 );