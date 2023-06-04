<?php
/**
 * Handles hooks for the header area of the themes
 * 
 * @package News Cast
 * @since 1.0.0
 * 
 */

if( !function_exists( 'news_cast_header_start' ) ) {
    /**
     * Header start
     */
   function news_cast_header_start() {
    echo '<header id="masthead" class="site-header">';
   }
}

if( !function_exists( 'news_cast_header_site_sec_wrap_open' ) ) :
    /**
     * Site branding section wrap open
     * 
     */
    function news_cast_header_site_sec_wrap_open() {
        echo '<div class="site-branding-section-wrap">';
        echo "<div class='container'>";
        echo '<div class="row align-items-center site-branding-inner-wrap">';
    }
endif;

if( !function_exists( 'news_cast_header_site_branding' ) ) {
   /**
    * Header site branding element
    * 
    */
   function news_cast_header_site_branding() {
   ?>
      <div class="site-branding">
  			<?php
  			    the_custom_logo();
  			if ( is_front_page() && is_home() ) :
  				?>
  				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
  				<?php
  			else :
  				?>
  				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
  				<?php
  			endif;
  			$news_cast_description = get_bloginfo( 'description', 'display' );
  			if ( $news_cast_description || is_customize_preview() ) :
  				?>
  				<p class="site-description"><?php echo esc_html( $news_cast_description ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
  			<?php endif; ?>
		</div><!-- .site-branding -->
   <?php
   }
}

if( !function_exists( 'news_cast_header_ad_banner' ) ) {
    /**
     * Header Ad Banner element
     * 
     */
    function news_cast_header_ad_banner() {
        $header_ad_banner_image = get_theme_mod( 'header_ad_banner_image' );
        if( empty( $header_ad_banner_image ) ) { 
            return;
        }
    ?>
        <div class="blaze-ad-banner">
            <?php
                $header_ad_banner_link = get_theme_mod( 'header_ad_banner_link' );
                echo '<a href="' .esc_url( $header_ad_banner_link ). '"><img src="' .esc_url( $header_ad_banner_image ). '"></a>';
            ?>
        </div><!-- #blaze-ad-banner -->
    <?php
    }
 }

 if( !function_exists( 'news_cast_header_site_sec_wrap_close' ) ) :
    /**
     * Site branding section wrap close
     * 
     */
    function news_cast_header_site_sec_wrap_close() {
        echo '</div><!-- .row-->';
        echo '</div><!-- .container -->';
        echo '</div><!-- .site-branding-section-wrap -->';
    }
endif;

if( !function_exists( 'news_cast_header_main_menu_sec_wrap_open' ) ) :
    /**
     * Main menu wrap open
     * 
     */
    function news_cast_header_main_menu_sec_wrap_open() {
        echo '<div class="main-navigation-section-wrap">';
            echo '<div class="container">';
                echo '<div class="row align-items-center menu_search_wrap_inner">';
    }
endif;

if( !function_exists( 'news_cast_header_toggle_sidebar' ) ) {
    /**
     * Header Toggle Sidebar Element
     * 
     */
    function news_cast_header_toggle_sidebar() {
        $header_toggle_sidebar_option = get_theme_mod( 'header_toggle_sidebar_option', true );
        if( ! $header_toggle_sidebar_option ) {
            return;
        }
    ?>
        <div class="header-toggle-sidebar-wrap">
            <a class="header-sidebar-trigger hamburger" href="javascript:void(0);">
              <div class="top-bun"></div>
              <div class="meat"></div>
              <div class="bottom-bun"></div>
            </a>
            <div class="header-sidebar-content" style="display:none;">
                <a class="header-sidebar-trigger-close" href="javascript:void(0);"><i class="far fa-window-close"></i></a>
                <?php 
                    if( is_active_sidebar('sidebar-header-toggle') ) {
                            dynamic_sidebar('sidebar-header-toggle');
                    } else {
                        echo '<div class="four-zero-four-sidebar-message">' .esc_html__( 'No widgets are assigned to this sidebar. Go to your Dashboard > Widgets > Assign widgets to Header Toggle Sidebar', 'news-cast' ). '</div>';
                    }
                ?>
                
            </div>
        </div>
    <?php
    }
 }

if( !function_exists( 'news_cast_header_main_menu' ) ) {
   /**
    * Header menu element
    * 
    */
   function news_cast_header_main_menu() {
   ?>
    <div class="main-navigation-wrap">
      <nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'news-cast' ); ?>">
  		  <button id="menu-toggle" class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
          <i class="fas fa-bars"></i>
          <i class="fas fa-times"></i>
        </button>
        <div id="site-header-menu" class="site-header-menu">
    			<?php
                    wp_nav_menu(
                        array(
                            'theme_location'=> 'menu-1',
                            'menu_class'    => 'primary-menu',
                            'fallback_cb'   => 'news_cast_primary_navigation_fallback'
                        )
                    );
    			?>
        </div>
  		</nav><!-- #site-navigation -->
    </div>
   <?php
   }
}

if( !function_exists( 'news_cast_header_search_bar' ) ) {
   /**
    * Header search bar element
    * 
    */
   function news_cast_header_search_bar() {
       $header_search_bar_option = get_theme_mod( 'header_search_bar_option', true );
       if( !$header_search_bar_option ) return;
   ?>
      <div class="header-search-wrap">
        <div class="header-search-bar">
            <?php
              get_search_form();
            ?>
        </div><!-- .header-search-bar -->
      </div>
   <?php
   }
}

if( !function_exists( 'news_cast_header_main_menu_sec_wrap_close' ) ) :
    /**
     * Main menu wrap close
     * 
     */
    function news_cast_header_main_menu_sec_wrap_close() {
                echo '</div><!-- .row -->';
            echo '</div><!-- .container -->';
        echo '</div><!-- .main-navigation-section-wrap -->';
    }
endif;

if( !function_exists( 'news_cast_header_close' ) ) {
   /**
    * Header close
    */
   function news_cast_header_close() {
    echo '</header><!-- #masthead -->';
   }
}
add_action( 'news_cast_header_hook', 'news_cast_header_start', 5 );
add_action( 'news_cast_header_hook', 'news_cast_header_site_sec_wrap_open', 10 );
add_action( 'news_cast_header_hook', 'news_cast_header_site_branding', 15 );
add_action( 'news_cast_header_hook', 'news_cast_header_ad_banner', 20 );
add_action( 'news_cast_header_hook', 'news_cast_header_site_sec_wrap_close', 25 );
add_action( 'news_cast_header_hook', 'news_cast_header_main_menu_sec_wrap_open', 30 );
add_action( 'news_cast_header_hook', 'news_cast_header_toggle_sidebar', 35 );
add_action( 'news_cast_header_hook', 'news_cast_header_main_menu', 40 );
add_action( 'news_cast_header_hook', 'news_cast_header_search_bar', 45 );
add_action( 'news_cast_header_hook', 'news_cast_header_main_menu_sec_wrap_close', 50 );
add_action( 'news_cast_header_hook', 'news_cast_header_close', 100 );