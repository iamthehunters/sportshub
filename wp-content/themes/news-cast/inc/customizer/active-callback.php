<?php
/**
 * Manage active callback functions
 * 
 * @package News Cast
 * @since 1.0.0
 */
// top header and social icons option callback
function top_header_social_icons_option_callback($control) {
    if ( $control->manager->get_setting( 'top_header_social_icons_option' )->value() !== false ) {
        return true;
    }
    return false;
}

// footer option callback
function footer_option_callback($control) {
    if ( $control->manager->get_setting( 'footer_option' )->value() !== false ) {
        return true;
    }
    return false;
}

// frontpage sidebar option callback
function frontpage_sidebar_option_callback($control) {
    if ( $control->manager->get_setting( 'frontpage_sidebar_option' )->value() !== false ) {
        return true;
    }
    return false;
}

// post sidebar option callback
function post_sidebar_option_callback($control) {
    if ( $control->manager->get_setting( 'post_sidebar_option' )->value() !== false ) {
        return true;
    }
    return false;
}

// archive sidebar option callback
function archive_sidebar_option_callback($control) {
    if ( $control->manager->get_setting( 'archive_sidebar_option' )->value() !== false ) {
        return true;
    }
    return false;
}

// top header settings general tab callback
function top_header_settings_tab_general_callback($control) {
    if ( $control->manager->get_setting( 'top_header_settings_tab' )->value() === 'general' ) {
        return true;
    }
    return false;
}

// header settings general tab callback
function header_settings_tab_general_callback($control) {
    if ( $control->manager->get_setting( 'header_settings_tab' )->value() === 'general' ) {
        return true;
    }
    return false;
}

// bottom footer settings general tab callback
function bottom_footer_settings_tab_general_callback($control) {
    if ( $control->manager->get_setting( 'bottom_footer_settings_tab' )->value() === 'general' ) {
        return true;
    }
    return false;
}

// bottom footer settings style tab callback
function bottom_footer_settings_tab_style_callback($control) {
    if ( $control->manager->get_setting( 'bottom_footer_settings_tab' )->value() === 'style' ) {
        return true;
    }
    return false;
}

// footer settings general tab callback
function footer_settings_tab_general_callback($control) {
    if ( $control->manager->get_setting( 'footer_settings_tab' )->value() === 'general' ) {
        return true;
    }
    return false;
}

// footer settings style tab callback
function footer_settings_tab_style_callback($control) {
    if ( $control->manager->get_setting( 'footer_settings_tab' )->value() === 'style' ) {
        return true;
    }
    return false;
}

// archive post date option callback
function archive_post_date_option_callback($control) {
    if ( $control->manager->get_setting( 'archive_post_date_option' )->value() !== false ) {
        return true;
    }
    return false;
}

// archive post author option callback
function archive_post_author_option_callback($control) {
    if ( $control->manager->get_setting( 'archive_post_author_option' )->value() !== false ) {
        return true;
    }
    return false;
}

// archive read more option callback
function archive_read_more_option_callback($control) {
    if ( $control->manager->get_setting( 'archive_read_more_option' )->value() !== false ) {
        return true;
    }
    return false;
}

// archive post categories option callback
function archive_post_categories_option_callback($control) {
    if ( $control->manager->get_setting( 'archive_post_categories_option' )->value() !== false ) {
        return true;
    }
    return false;
}

// archive post tags option callback
function archive_post_tags_option_callback($control) {
    if ( $control->manager->get_setting( 'archive_post_tags_option' )->value() !== false ) {
        return true;
    }
    return false;
}

// single post date option callback
function single_post_date_option_callback($control) {
    if ( $control->manager->get_setting( 'single_post_date_option' )->value() !== false ) {
        return true;
    }
    return false;
}

// single post author option callback
function single_post_author_option_callback($control) {
    if ( $control->manager->get_setting( 'single_post_author_option' )->value() !== false ) {
        return true;
    }
    return false;
}

// single post categories option callback
function single_post_categories_option_callback($control) {
    if ( $control->manager->get_setting( 'single_post_categories_option' )->value() !== false ) {
        return true;
    }
    return false;
}

// single post tags option callback
function single_post_tags_option_callback($control) {
    if ( $control->manager->get_setting( 'single_post_tags_option' )->value() !== false ) {
        return true;
    }
    return false;
}

// scroll to top option  callback
function scroll_to_top_option_callback($control) {
    if ( $control->manager->get_setting( 'scroll_to_top_option' )->value() !== false ) {
        return true;
    }
    return false;
}