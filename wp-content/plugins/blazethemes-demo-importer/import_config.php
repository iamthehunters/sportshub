<?php
/*
 * Config file with each demo data
 */
$niva_store = array(
    'niva-store' => array(
        'name' => 'Niva Store',
        'external_url' => 'https://demo.blazethemes.com/import-files/niva-store/niva-store.zip',
        'image' => 'https://i0.wp.com/themes.svn.wordpress.org/niva-store/1.5.0/screenshot.png?w=572&strip=all',
        'preview_url' => 'https://demo.blazethemes.com/niva-store/',
        'options_array' => array('sfm_settings'),
        'menu_array' => array(
            'primary' => 'Header Menu',
            'social' => 'Social Menu',
            'footer' => 'Footer Menu'
        ),
        'home_slug' => 'home',
        'blog_slug' => 'blog',
        'plugins' => array(
            'woocommerce' => array(
                'name' => 'Woocommerce',
                'source' => 'wordpress',
                'file_path' => 'woocommerce/woocommerce.php',
            )
        ),
        'tags' => array(
            'free' => 'Free'
        )
    ),
    'niva-store-pro' => array(
        'name' => 'Niva Store Pro',
        'type' => 'pro',
        'buy_url'=> 'https://blazethemes.com/theme/niva-store-pro/',
        'external_url' => 'https://demo.blazethemes.com/import-files/niva-store/niva-store-pro.zip',
        'image' => 'https://blazethemes.com/wp-content/uploads/2021/02/niva-store-main.jpg',
        'preview_url' => 'https://demo.blazethemes.com/niva-store-pro/',
        'options_array' => array('sfm_settings'),
        'menu_array' => array(
            'primary' => 'Header Menu',
            'social' => 'Social Menu',
            'footer' => 'Footer Menu'
        ),
        'home_slug' => 'home',
        'blog_slug' => 'blog',
        'plugins' => array(
            'woocommerce' => array(
                'name' => 'Woocommerce',
                'source' => 'wordpress',
                'file_path' => 'woocommerce/woocommerce.php',
            )
        ),
        'tags' => array(
            'pro' => 'Pro'
        )
    )
);

$article_lite = array(
    'article-lite' => array(
        'name' => 'Article Lite',
        'external_url' => 'https://demo.blazethemes.com/import-files/article-lite/article-lite.zip',
        'image' => 'https://i0.wp.com/themes.svn.wordpress.org/article-lite/1.3.0/screenshot.png?w=572&strip=all',
        'preview_url' => 'https://demo.blazethemes.com/article-lite/',
        'menu_array' => array(
            'primary' => 'Main Menu',
            'top-social' => 'Social menu',
            'footer' => 'Footer Menu'
        ),
        'plugins' => array(
            'woocommerce' => array(
                'name' => 'Woocommerce',
                'source' => 'wordpress',
                'file_path' => 'woocommerce/woocommerce.php',
            )
        ),
        'tags' => array(
            'free' => 'Free'
        )
    )
);

$active_theme = str_replace('-', '_', get_option('stylesheet'));

if ( isset( $active_theme ) ) {
    $demo_array = $$active_theme;
} else {
    $demo_array = array();
}

return apply_filters( 'blazethemes_demo_importer_import_files', $demo_array );