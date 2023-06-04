<?php
/**
 * Demo info
 * 
 * 
 */
$demos_array = array(
    'news-cast' => array(
        'name' => 'News Cast',
        'type' => 'free',
        'buy_url'=> 'https://blazethemes.com/theme/news-cast-free/',
        'external_url' => 'https://demo.blazethemes.com/import-files/news-cast/news-cast.zip',
        'image' => 'https://blazethemes.com/wp-content/uploads/2021/11/news-cast-main-screen.png',
        'preview_url' => 'https://demo.blazethemes.com/news-cast/',
        'menu_array' => array(
            'menu-1' => 'Header Menu',
            'menu-3' => 'Footer Menu'
        ),
        'home_slug' => 'home',
        'blog_slug' => 'blog',
        'plugins' => array(
            'elementor' => array(
                'name' => 'Elementor',
                'source' => 'wordpress',
                'file_path' => 'elementor/elementor.php',
            )
        ),
        'tags' => array(
            'free' => 'Free'
        ),
        'pagebuilder' => array(
            'elementor' => 'Elementor Based'
        )
    ),
    'news-cast-pro' => array(
        'name' => 'News Cast Pro',
        'type' => 'pro',
        'buy_url'=> 'https://blazethemes.com/theme/news-cast-pro/',
        'external_url' => 'https://demo.blazethemes.com/import-files/news-cast/news-cast-pro.zip',
        'image' => 'https://blazethemes.com/wp-content/uploads/2021/11/News-Cast-Pro.png',
        'preview_url' => 'https://demo.blazethemes.com/news-cast-pro/',
        'menu_array' => array(
            'menu-1' => 'Header Menu',
            'menu-3' => 'Footer Menu'
        ),
        'home_slug' => 'home',
        'plugins' => array(
            'contact-form-7'  => array(
                'name' => 'Contact Form 7',
                'source' => 'wordpress',
                'file_path' => 'contact-form-7/wp-contact-form-7.php'
            )
        ),
        'tags' => array(
            'pro' => 'Pro'
        ),
        'pagebuilder' => array(
            'gutenberg' => 'Gutenberg Based'
        )
    ),
    'news-cast-pro-journal' => array(
        'name' => 'Journal News',
        'type' => 'pro',
        'buy_url'=> 'https://blazethemes.com/theme/news-cast-pro/',
        'external_url' => 'https://demo.blazethemes.com/import-files/news-cast/news-cast-pro-journal.zip',
        'image' => 'https://blazethemes.com/wp-content/uploads/2021/11/News-Cast-Pro-Jo.jpg',
        'preview_url' => 'https://demo.blazethemes.com/news-cast-pro-journal/',
        'menu_array' => array(
            'menu-1' => 'Header Menu',
            'menu-3' => 'Footer Menu'
        ),
        'home_slug' => 'home',
        'plugins' => array(
            'elementor' => array(
                'name' => 'Elementor',
                'source' => 'wordpress',
                'file_path' => 'elementor/elementor.php',
            )
        ),
        'tags' => array(
            'pro' => 'Pro'
        ),
        'pagebuilder' => array(
            'gutenberg' => 'Gutenberg Based'
        )
    ),
    'news-cast-pro-gadgets' => array(
        'name' => 'Gadgets News',
        'type' => 'pro',
        'buy_url'=> 'https://blazethemes.com/theme/news-cast-pro/',
        'external_url' => 'https://demo.blazethemes.com/import-files/news-cast/news-cast-pro-gadgets.zip',
        'image' => 'https://blazethemes.com/wp-content/uploads/2021/11/Screenshot.jpg',
        'preview_url' => 'https://demo.blazethemes.com/news-cast-pro-gadgets/',
        'menu_array' => array(
            'menu-1' => 'Header Menu',
            'menu-3' => 'Footer Menu'
        ),
        'home_slug' => 'home',
        'plugins' => array(
            'contact-form-7'  => array(
                'name' => 'Contact Form 7',
                'source' => 'wordpress',
                'file_path' => 'contact-form-7/wp-contact-form-7.php'
            )
        ),
        'tags' => array(
            'pro' => 'Pro'
        ),
        'pagebuilder' => array(
            'elementor' => 'Elementor Based'
        )
    )
);
return apply_filters( 'news_cast__demos_array_filter', $demos_array );