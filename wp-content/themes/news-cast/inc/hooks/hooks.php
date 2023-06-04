<?php
/**
 * Handles hooks file and functioning for entire theme
 * 
 * @package News Cast
 * @since 1.0.0
 * 
 */
 if( !function_exists( 'news_cast_archive_read_more_button' ) ) :
    /**
     * Archive read more button fnc
     * 
     */
    function news_cast_archive_read_more_button() {
        $archive_read_more_option   = get_theme_mod( 'archive_read_more_option', true );
        if( !$archive_read_more_option ) {
            return;
        }
        $archive_read_more_text     = get_theme_mod( 'archive_read_more_text', esc_html__( 'Read more . . ', 'news-cast' ) );
        $news_cast_archive_layout = get_theme_mod( 'archive_posts_layout', 'list-layout' );

        $news_cast_layout = 'grid';
        if( $news_cast_archive_layout == 'list-layout') {
            $news_cast_layout = 'list';
        }
        switch( $news_cast_layout ) {
            case 'list' : echo '<div class="bmm-read-more-one"><a href="' . esc_url( get_the_permalink() ) . '">' . esc_html( $archive_read_more_text ) . '</a></div>';
                        break;
            default : echo '<div class="bmm-read-more-one"><a href="' . esc_url( get_the_permalink() ) . '">' . esc_html( $archive_read_more_text ) . '</a></div>';
                        break;
        }
    }
    add_action( 'news_cast_archive_single_post_before_article_hook', 'news_cast_archive_read_more_button', 10 );
 endif;

 if( !function_exists( 'news_cast_scroll_to_top' ) ) :
    /**
     * scroll to top fnc
     * 
     */
    function news_cast_scroll_to_top() {
        $scroll_to_top_option = get_theme_mod( 'scroll_to_top_option', true );
        if( !$scroll_to_top_option ) {
            return;
        }
        $scroll_to_top_align = get_theme_mod( 'scroll_to_top_align', 'align--right' );
    ?>
        <div id="news-cast-scroll-to-top" class="layout-default <?php echo esc_attr( $scroll_to_top_align ); ?>">
            <a href="#" data-tooltip="Back To Top">
                <span class="back_txt"><?php esc_html_e( 'Back to Top', 'news-cast' ); ?></span>
                <i class="fas fa-long-arrow-alt-up"></i>
                <i class="fas fa-chevron-up"></i>
            </a>
        </div><!-- #news-cast-scroll-to-top -->
    <?php
    }
    add_action( 'news_cast_after_footer_hook', 'news_cast_scroll_to_top' );
 endif;

 if( ! function_exists( 'news_cast_pagination_fnc' ) ) :
    /**
     * Renders pagination
     * 
     */
    function news_cast_pagination_fnc() {
        if( is_null( paginate_links() ) ) {
            return;
        }
        echo '<div class="bmm-pagination-links">'.paginate_links().'</div>';
    }
    add_action( 'news_cast_pagination_link_hook', 'news_cast_pagination_fnc' );
 endif;
 /**
 * Theme Hooks
 */
require NEWS_CAST_INCLUDES_PATH . 'hooks/top-header-hooks.php';
require NEWS_CAST_INCLUDES_PATH . 'hooks/header-hooks.php';
require NEWS_CAST_INCLUDES_PATH . 'hooks/footer-hooks.php';