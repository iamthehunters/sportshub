<?php
/**
 * Sanitize functions
 * 
 * @package News Cast
 * @since 1.0.0
 */

 if( !function_exists( 'news_cast_sanitize_toggle_control' )  ) :
    /**
     * Sanitize toggle control value
     * 
     */
    function news_cast_sanitize_toggle_control( $value ) {
        return rest_sanitize_boolean( $value );
    }
 endif;
 
 if( !function_exists( 'news_cast_sanitize_select_control' ) ) :
    /**
     * Sanitize select control value
     * 
     */
    function news_cast_sanitize_select_control( $input, $setting ) {
        // Ensure input is a slug.
        $input = sanitize_key( $input );
        // Get list of choices from the control associated with the setting.
        $choices = $setting->manager->get_control( $setting->id )->choices;
        // If the input is a valid key, return it; otherwise, return the default.
        return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
    }
endif;

// adds sanitization callback function for header style
if ( ! function_exists( 'news_cast_sanitize_menuhover' ) ) :
  function news_cast_sanitize_menuhover( $value ) {
    $menu_hover_effect = array( 'menu_hover_1', 'menu_hover_2', 'menu_hover_3', 'menu_hover_4', 'menu_hover_5' , 'menu_hover_none' );
    if ( ! in_array( $value, $menu_hover_effect ) ) {
      $value = 'menu_hover_1';
    }
    return $value;
  }
endif;

if( !function_exists( 'news_cast_sanitize_number_absint' ) ) :
    /**
     * Sanitize number control value
     * 
     */
    function news_cast_sanitize_number_absint( $number, $setting ) {
        // Ensure $number is an absolute integer (whole number, zero or greater).
        $number = absint( $number );
    
        // If the input is an absolute integer, return it; otherwise, return the default
        return ( $number ? $number : $setting->default );
    }
endif;