<?php
/**
 * Footer section
 * 
 * @package News Cast
 * @since 1.0.0
 */
$footer_option = get_theme_mod( 'footer_option', true );
if( !$footer_option ) {
    return;
}
$footer_widget_column = get_theme_mod( 'footer_widget_column', 'column-three' );
?>
<div class="footer-widget">
    <?php is_active_sidebar( 'footer-column' ) ? dynamic_sidebar( 'footer-column' ) : ''; ?>
</div>
<?php
    if( $footer_widget_column !== 'column-one' ) {
    ?>
        <div class="footer-widget">
            <?php
                is_active_sidebar( 'footer-column-2' ) ? dynamic_sidebar( 'footer-column-2' ) : '';
            ?>
        </div>
<?php
    }

    if( $footer_widget_column === 'column-three' ) {
    ?>
        <div class="footer-widget">
            <?php
                is_active_sidebar( 'footer-column-3' ) ? dynamic_sidebar( 'footer-column-3' ) : '';
            ?>
        </div>
<?php
    }