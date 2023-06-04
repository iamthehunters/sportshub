<?php
/**
 * Plugin Name: BlazeThemes Demo Importer
 * Plugin URI: https://github.com/
 * Description: Easily imports demo with just one click.
 * Version: 1.0.0
 * Author: BlazeThemes
 * Author URI:  https://blazethemes.com/
 * Text Domain: blazethemes-demo-importer
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 *
 */
if (!defined('ABSPATH'))
    exit;


define('BLAZE_DEMO_IMPORTER_VERSION', '1.1.1');

define('BLAZE_DEMO_IMPORTER_FILE', __FILE__);
define('BLAZE_DEMO_IMPORTER_PLUGIN_BASENAME', plugin_basename(BLAZE_DEMO_IMPORTER_FILE));
define('BLAZE_DEMO_IMPORTER_PATH', plugin_dir_path(BLAZE_DEMO_IMPORTER_FILE));
define('BLAZE_DEMO_IMPORTER_URL', plugins_url('/', BLAZE_DEMO_IMPORTER_FILE));

define('BLAZE_DEMO_IMPORTER_ASSETS_URL', BLAZE_DEMO_IMPORTER_URL . 'assets/');

if (!class_exists('BLAZE_DEMO_IMPORTER_Importer')) {

    class BLAZE_DEMO_IMPORTER_Importer {

        public $configFile;
        public $uploads_dir;
        public $plugin_install_count;
        public $plugin_active_count;
        public $ajax_response = array();

        /*
         * Constructor
         */
        public function __construct() {
            if( ! file_exists( get_template_directory() . '/inc/admin/assets/demos.php' ) ) {
                return;
            }
            $this->uploads_dir = wp_get_upload_dir();
            $this->plugin_install_count = 0;
            $this->plugin_active_count = 0;
            // Include necesarry files
            $this->configFile = include get_template_directory() . '/inc/admin/assets/demos.php';
            require_once BLAZE_DEMO_IMPORTER_PATH . 'classes/class-demo-importer.php';
            require_once BLAZE_DEMO_IMPORTER_PATH . 'classes/class-customizer-importer.php';
            require_once BLAZE_DEMO_IMPORTER_PATH . 'classes/class-widget-importer.php';

            // Load translation files
            add_action('init', array($this, 'load_plugin_textdomain'));

            // Add necesary backend JS
            add_action('admin_enqueue_scripts', array($this, 'load_backends'));

            // Actions for the ajax call
            add_action('wp_ajax_blazethemes_demo_importer_install_demo', array($this, 'blazethemes_demo_importer_install_demo'));
            add_action('wp_ajax_blazethemes_demo_importer_install_plugin', array($this, 'blazethemes_demo_importer_install_plugin'));
            add_action('wp_ajax_blazethemes_demo_importer_activate_plugin', array($this, 'blazethemes_demo_importer_activate_plugin'));
            add_action('wp_ajax_blazethemes_demo_importer_download_files', array($this, 'blazethemes_demo_importer_download_files'));
            add_action('wp_ajax_blazethemes_demo_importer_import_xml', array($this, 'blazethemes_demo_importer_import_xml'));
            add_action('wp_ajax_blazethemes_demo_importer_customizer_import', array($this, 'blazethemes_demo_importer_customizer_import'));
            add_action('wp_ajax_blazethemes_demo_importer_menu_import', array($this, 'blazethemes_demo_importer_menu_import'));
            add_action('wp_ajax_blazethemes_demo_importer_theme_option', array($this, 'blazethemes_demo_importer_theme_option'));
            add_action('wp_ajax_blazethemes_demo_importer_importing_widget', array($this, 'blazethemes_demo_importer_importing_widget'));
            add_action('wp_ajax_blazethemes_demo_importer_importing_revslider', array($this, 'blazethemes_demo_importer_importing_revslider'));
        }

        /**
         * Loads the translation files
         */
        public function load_plugin_textdomain() {
            load_plugin_textdomain('blazethemes-demo-importer', false, BLAZE_DEMO_IMPORTER_PATH . '/languages');
        }

        /*
         *  Do the install on ajax call
         */

        function blazethemes_demo_importer_install_demo() {
            check_ajax_referer('demo-importer-ajax', 'security');
            
            // Get the demo content from the right file
            $demo_slug = isset($_POST['demo']) ? sanitize_text_field($_POST['demo']) : '';

            $this->ajax_response['demo'] = $demo_slug;

            if (isset($_POST['reset']) && $_POST['reset'] == 'true') {
                $this->database_reset();
                $this->ajax_response['complete_message'] = esc_html__('Database reset complete', 'blazethemes-demo-importer');
            }

            $this->ajax_response['next_step'] = 'blazethemes_demo_importer_install_plugin';
            $this->ajax_response['next_step_message'] = esc_html__('Installing required plugins', 'blazethemes-demo-importer');
            $this->send_ajax_response();
        }

        function blazethemes_demo_importer_install_plugin() {
            check_ajax_referer('demo-importer-ajax', 'security');

            $demo_slug = isset($_POST['demo']) ? sanitize_text_field($_POST['demo']) : '';

            // Install Required Plugins
            $this->install_plugins($demo_slug);

            $plugin_install_count = $this->plugin_install_count;

            if ($plugin_install_count > 0) {
                $this->ajax_response['complete_message'] = esc_html__('All the required plugins installed', 'blazethemes-demo-importer');
            } else {
                $this->ajax_response['complete_message'] = esc_html__('No plugin required to install', 'blazethemes-demo-importer');
            }

            $this->ajax_response['demo'] = $demo_slug;
            $this->ajax_response['next_step'] = 'blazethemes_demo_importer_activate_plugin';
            $this->ajax_response['next_step_message'] = esc_html__('Activating required plugins', 'blazethemes-demo-importer');
            $this->send_ajax_response();
        }

        function blazethemes_demo_importer_activate_plugin() {
            check_ajax_referer('demo-importer-ajax', 'security');

            $demo_slug = isset($_POST['demo']) ? sanitize_text_field($_POST['demo']) : '';

            // Activate Required Plugins
            $this->activate_plugins($demo_slug);

            $plugin_active_count = $this->plugin_active_count;

            if ($plugin_active_count > 0) {
                $this->ajax_response['complete_message'] = esc_html__('All the required plugins activated', 'blazethemes-demo-importer');
            } else {
                $this->ajax_response['complete_message'] = esc_html__('No plugin required to activate', 'blazethemes-demo-importer');
            }

            $this->ajax_response['demo'] = $demo_slug;
            $this->ajax_response['next_step'] = 'blazethemes_demo_importer_download_files';
            $this->ajax_response['next_step_message'] = esc_html__('Downloading demo files', 'blazethemes-demo-importer');
            $this->send_ajax_response();
        }

        function blazethemes_demo_importer_download_files() {
            check_ajax_referer('demo-importer-ajax', 'security');

            $demo_slug = isset($_POST['demo']) ? sanitize_text_field($_POST['demo']) : '';

            $downloads = $this->download_files($this->configFile[$demo_slug]['external_url']);
            if ($downloads) {
                $this->ajax_response['complete_message'] = esc_html__('All demo files downloaded', 'blazethemes-demo-importer');
                $this->ajax_response['next_step'] = 'blazethemes_demo_importer_import_xml';
                $this->ajax_response['next_step_message'] = esc_html__('Importing posts, pages and medias. It may take a bit longer time', 'blazethemes-demo-importer');
            } else {
                $this->ajax_response['error'] = true;
                $this->ajax_response['error_message'] = esc_html__('Demo import process failed. Demo files can not be downloaded', 'blazethemes-demo-importer');
            }

            $this->ajax_response['demo'] = $demo_slug;
            $this->send_ajax_response();
        }

        function blazethemes_demo_importer_import_xml() {
            check_ajax_referer('demo-importer-ajax', 'security');

            $demo_slug = isset($_POST['demo']) ? sanitize_text_field($_POST['demo']) : '';

            // Import XML content
            $xml_filepath = $this->demo_upload_dir($demo_slug) . '/content.xml';

            if (file_exists($xml_filepath)) {
                $this->importDemoContent($xml_filepath);
                $this->ajax_response['complete_message'] = esc_html__('All content imported', 'blazethemes-demo-importer');
                $this->ajax_response['next_step'] = 'blazethemes_demo_importer_customizer_import';
                $this->ajax_response['next_step_message'] = esc_html__('Importing customizer settings', 'blazethemes-demo-importer');
            } else {
                $this->ajax_response['error'] = true;
                $this->ajax_response['error_message'] = esc_html__('Demo import process failed. No content file found', 'blazethemes-demo-importer');
            }

            $this->ajax_response['demo'] = $demo_slug;
            $this->send_ajax_response();
        }

        function blazethemes_demo_importer_customizer_import() {
            check_ajax_referer('demo-importer-ajax', 'security');

            $demo_slug = isset($_POST['demo']) ? sanitize_text_field($_POST['demo']) : '';

            $customizer_filepath = $this->demo_upload_dir($demo_slug) . '/customizer.dat';

            if (file_exists($customizer_filepath)) {
                ob_start();
                BLAZE_DEMO_IMPORTER_Customizer_Importer::import($customizer_filepath);
                ob_end_clean();
                $this->ajax_response['complete_message'] = esc_html__('Customizer settings imported', 'blazethemes-demo-importer');
            } else {
                $this->ajax_response['complete_message'] = esc_html__('No customizer settings found', 'blazethemes-demo-importer');
            }

            $this->ajax_response['demo'] = $demo_slug;
            $this->ajax_response['next_step'] = 'blazethemes_demo_importer_menu_import';
            $this->ajax_response['next_step_message'] = esc_html__('Setting menus', 'blazethemes-demo-importer');
            $this->send_ajax_response();
        }

        function blazethemes_demo_importer_menu_import() {
            check_ajax_referer('demo-importer-ajax', 'security');

            $demo_slug = isset($_POST['demo']) ? sanitize_text_field($_POST['demo']) : '';

            $menu_array = isset($this->configFile[$demo_slug]['menu_array']) ? $this->configFile[$demo_slug]['menu_array'] : '';
            // Set menu
            if ($menu_array) {
                $this->setMenu($menu_array);
                $this->ajax_response['complete_message'] = esc_html__('Menus saved', 'blazethemes-demo-importer');
            } else {
                $this->ajax_response['complete_message'] = esc_html__('No menus saved', 'blazethemes-demo-importer');
            }

            $this->ajax_response['demo'] = $demo_slug;
            $this->ajax_response['next_step'] = 'blazethemes_demo_importer_theme_option';
            $this->ajax_response['next_step_message'] = esc_html__('Importing theme option settings', 'blazethemes-demo-importer');
            $this->send_ajax_response();
        }

        function blazethemes_demo_importer_theme_option() {
            check_ajax_referer('demo-importer-ajax', 'security');

            $demo_slug = isset($_POST['demo']) ? sanitize_text_field($_POST['demo']) : '';

            $options_array = isset($this->configFile[$demo_slug]['options_array']) ? $this->configFile[$demo_slug]['options_array'] : '';
            if( isset( $this->configFile[$demo_slug]['pagebuilder']['elementor'] ) ) {
                $active_kit = get_posts(array(
                    'fields'          => 'ids',
                    'posts_per_page'  => 1,
                    'post_type' => 'elementor_library'
                ));
                if( ! empty( $active_kit ) ) {
                    $default_kit_id = $active_kit[0];
                    update_option( 'elementor_active_kit', $default_kit_id );
                }
            }

            if (isset($options_array) && is_array($options_array)) {
                foreach ($options_array as $theme_option) {
                    $option_filepath = $this->demo_upload_dir($demo_slug) . '/' . $theme_option . '.json';

                    if (file_exists($option_filepath)) {
                        $data = file_get_contents($option_filepath);

                        if ($data) {
                            update_option($theme_option, json_decode($data, true));
                        }
                    }
                }
                $this->ajax_response['complete_message'] = esc_html__('Theme options settings imported', 'blazethemes-demo-importer');
            } else {
                $this->ajax_response['complete_message'] = esc_html__('No theme options found', 'blazethemes-demo-importer');
            }

            $this->ajax_response['demo'] = $demo_slug;
            $this->ajax_response['next_step'] = 'blazethemes_demo_importer_importing_widget';
            $this->ajax_response['next_step_message'] = esc_html__('Importing widgets', 'blazethemes-demo-importer');
            $this->send_ajax_response();
        }

        function blazethemes_demo_importer_importing_widget() {
            check_ajax_referer('demo-importer-ajax', 'security');

            $demo_slug = isset($_POST['demo']) ? sanitize_text_field($_POST['demo']) : '';

            $widget_filepath = $this->demo_upload_dir($demo_slug) . '/widget.wie';

            if (file_exists($widget_filepath)) {
                ob_start();
                BLAZE_DEMO_IMPORTER_Widget_Importer::import($widget_filepath);
                ob_end_clean();
                $this->ajax_response['complete_message'] = esc_html__('Widgets imported', 'blazethemes-demo-importer');
            } else {
                $this->ajax_response['complete_message'] = esc_html__('No widgets found', 'blazethemes-demo-importer');
            }

            $sliderFile = $this->demo_upload_dir($demo_slug) . '/revslider.zip';

            if (file_exists($sliderFile)) {
                $this->ajax_response['next_step'] = 'blazethemes_demo_importer_importing_revslider';
                $this->ajax_response['next_step_message'] = esc_html__('Importing Revolution slider', 'blazethemes-demo-importer');
            } else {
                $this->ajax_response['next_step'] = '';
                $this->ajax_response['next_step_message'] = '';
            }

            $this->ajax_response['demo'] = $demo_slug;
            $this->send_ajax_response();
        }

        function blazethemes_demo_importer_importing_revslider() {
            check_ajax_referer('demo-importer-ajax', 'security');

            $demo_slug = isset($_POST['demo']) ? sanitize_text_field($_POST['demo']) : '';

            // Get the zip file path
            $sliderFile = $this->demo_upload_dir($demo_slug) . '/revslider.zip';

            if (file_exists($sliderFile)) {
                if (class_exists('RevSlider')) {
                    $slider = new RevSlider();
                    $slider->importSliderFromPost(true, true, $sliderFile);
                    $this->ajax_response['complete_message'] = esc_html__('Revolution slider installed', 'blazethemes-demo-importer');
                } else {
                    $this->ajax_response['complete_message'] = esc_html__('Revolution slider plugin not installed', 'blazethemes-demo-importer');
                }
            } else {
                $this->ajax_response['complete_message'] = esc_html__('No Revolution slider found', 'blazethemes-demo-importer');
            }

            $this->ajax_response['demo'] = $demo_slug;
            $this->ajax_response['next_step'] = '';
            $this->ajax_response['next_step_message'] = '';
            $this->send_ajax_response();
        }

        public function download_files($external_url) {
            // Make sure we have the dependency.
            if (!function_exists('WP_Filesystem')) {
                require_once( ABSPATH . 'wp-admin/includes/file.php' );
            }

            /**
             * Initialize WordPress' file system handler.
             *
             * @var WP_Filesystem_Base $wp_filesystem
             */
            WP_Filesystem();
            global $wp_filesystem;

            $result = true;

            if (!($wp_filesystem->exists($this->demo_upload_dir()))) {
                $result = $wp_filesystem->mkdir($this->demo_upload_dir());
            }

            // Abort the request if the local uploads directory couldn't be created.
            if (!$result) {
                return false;
            } else {
                $demo_pack = $this->demo_upload_dir() . 'demo-pack.zip';

                $file = wp_remote_retrieve_body(wp_remote_get($external_url, array(
                    'timeout' => 60,
                )));

                $wp_filesystem->put_contents($demo_pack, $file);
                unzip_file($demo_pack, $this->demo_upload_dir());
                $wp_filesystem->delete($demo_pack);
                return true;
            }
        }

        /*
         * Reset the database, if the case
         */

        function database_reset() {

            global $wpdb;
            $core_tables = array('commentmeta', 'comments', 'links', 'postmeta', 'posts', 'term_relationships', 'term_taxonomy', 'termmeta', 'terms');
            $exclude_core_tables = array('options', 'usermeta', 'users');
            $core_tables = array_map(function ($tbl) {
                global $wpdb;
                return $wpdb->prefix . $tbl;
            }, $core_tables);
            $exclude_core_tables = array_map(function ($tbl) {
                global $wpdb;
                return $wpdb->prefix . $tbl;
            }, $exclude_core_tables);
            $custom_tables = array();

            $table_status = $wpdb->get_results('SHOW TABLE STATUS');
            if (is_array($table_status)) {
                foreach ($table_status as $index => $table) {
                    if (0 !== stripos($table->Name, $wpdb->prefix)) {
                        continue;
                    }
                    if (empty($table->Engine)) {
                        continue;
                    }

                    if (false === in_array($table->Name, $core_tables) && false === in_array($table->Name, $exclude_core_tables)) {
                        $custom_tables[] = $table->Name;
                    }
                }
            }
            $custom_tables = array_merge($core_tables, $custom_tables);

            foreach ($custom_tables as $tbl) {
                $wpdb->query('SET foreign_key_checks = 0');
                $wpdb->query('TRUNCATE TABLE ' . $tbl);
            }

            // Delete Widgets
            global $wp_registered_widget_controls;

            $widget_controls = $wp_registered_widget_controls;

            $available_widgets = array();

            foreach ($widget_controls as $widget) {
                if (!empty($widget['id_base']) && !isset($available_widgets[$widget['id_base']])) {
                    $available_widgets[] = $widget['id_base'];
                }
            }

            update_option('sidebars_widgets', array('wp_inactive_widgets' => array()));
            foreach ($available_widgets as $widget_data) {
                update_option('widget_' . $widget_data, array());
            }

            // Delete Thememods
            $theme_slug = get_option('stylesheet');
            $mods = get_option("theme_mods_$theme_slug");
            if (false !== $mods) {
                delete_option("theme_mods_$theme_slug");
            }

            //Clear "uploads" folder
            $this->clear_uploads($this->uploads_dir['basedir']);
        }

        /**
         * Clear "uploads" folder
         * @param string $dir
         * @return bool
         */
        private function clear_uploads($dir) {
            $files = array_diff(scandir($dir), array('.', '..'));
            foreach ($files as $file) {
                ( is_dir("$dir/$file") ) ? $this->clear_uploads("$dir/$file") : unlink("$dir/$file");
            }

            return ( $dir != $this->uploads_dir['basedir'] ) ? rmdir($dir) : true;
        }

        /*
         * Set the menu on theme location
         */

        function setMenu($menu_array) {

            if (!$menu_array) {
                return;
            }

            $locations = get_theme_mod('nav_menu_locations');

            foreach ($menu_array as $menuId => $menuname) {
                $menu_exists = wp_get_nav_menu_object($menuname);

                if (!$menu_exists) {
                    $term_id_of_menu = wp_create_nav_menu($menuname);
                } else {
                    $term_id_of_menu = $menu_exists->term_id;
                }

                $locations[$menuId] = $term_id_of_menu;
            }

            set_theme_mod('nav_menu_locations', $locations);
        }

        /*
         * Import demo XML content
         */

        function importDemoContent($xml_filepath) {

            if (!defined('WP_LOAD_IMPORTERS'))
                define('WP_LOAD_IMPORTERS', true);

            if (!class_exists('BLAZE_DEMO_IMPORTER_Import')) {
                $class_wp_importer = BLAZE_DEMO_IMPORTER_PATH . "wordpress-importer/wordpress-importer.php";
                if (file_exists($class_wp_importer)) {
                    require_once $class_wp_importer;
                }
            }

            // Import demo content from XML
            if (class_exists('BLAZE_DEMO_IMPORTER_Import')) {
                $demo_slug = isset($_POST['demo']) ? sanitize_text_field($_POST['demo']) : '';
                $home_slug = isset($this->configFile[$demo_slug]['home_slug']) ? $this->configFile[$demo_slug]['home_slug'] : '';
                $blog_slug = isset($this->configFile[$demo_slug]['blog_slug']) ? $this->configFile[$demo_slug]['blog_slug'] : '';

                if (file_exists($xml_filepath)) {
                    $wp_import = new BLAZE_DEMO_IMPORTER_Import();
                    $wp_import->fetch_attachments = true;
                    // Capture the output.
                    ob_start();
                    $wp_import->import($xml_filepath);
                    // Clean the output.
                    ob_end_clean();
                    // Import DONE
                    // set homepage as front page
                    if ($home_slug) {
                        $page = get_page_by_path($home_slug);
                        if ($page) {
                            update_option('show_on_front', 'page');
                            update_option('page_on_front', $page->ID);
                        } else {
                            $page = get_page_by_title('Home');
                            if ($page) {
                                update_option('show_on_front', 'page');
                                update_option('page_on_front', $page->ID);
                            }
                        }
                    }

                    if ($blog_slug) {
                        $blog = get_page_by_path($blog_slug);
                        if ($blog) {
                            update_option('show_on_front', 'page');
                            update_option('page_for_posts', $blog->ID);
                        }
                    }

                    if (!$home_slug && !$blog_slug) {
                        update_option('show_on_front', 'posts');
                    }
                }
            }
        }

        function demo_upload_dir($path = '') {
            $upload_dir = $this->uploads_dir['basedir'] . '/blaze-demo-pack/' . $path;
            return $upload_dir;
        }

        function install_plugins($slug) {
            $demo = $this->configFile[$slug];

            $plugins = $demo['plugins'];

            foreach ($plugins as $plugin_slug => $plugin) {
                $name = isset($plugin['name']) ? $plugin['name'] : '';
                $source = isset($plugin['source']) ? $plugin['source'] : '';
                $file_path = isset($plugin['file_path']) ? $plugin['file_path'] : '';
                $location = isset($plugin['location']) ? $plugin['location'] : '';

                if ($source == 'wordpress') {
                    $this->plugin_installer_callback($file_path, $plugin_slug);
                } else {
                    $this->plugin_offline_installer_callback($file_path, $location);
                }
            }
        }

        function activate_plugins($slug) {
            $demo = $this->configFile[$slug];

            $plugins = $demo['plugins'];

            foreach ($plugins as $plugin_slug => $plugin) {
                $name = isset($plugin['name']) ? $plugin['name'] : '';
                $file_path = isset($plugin['file_path']) ? $plugin['file_path'] : '';
                $plugin_status = $this->plugin_status($file_path);

                if ($plugin_status == 'inactive') {
                    $this->activate_plugin($file_path);
                    $this->plugin_active_count++;
                }
            }
        }

        public function plugin_installer_callback($path, $slug) {
            $plugin_status = $this->plugin_status($path);

            if ($plugin_status == 'install') {
                // Include required libs for installation
                require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
                require_once ABSPATH . 'wp-admin/includes/class-wp-ajax-upgrader-skin.php';
                require_once ABSPATH . 'wp-admin/includes/class-plugin-upgrader.php';

                // Get Plugin Info
                $api = $this->call_plugin_api($slug);

                $skin = new WP_Ajax_Upgrader_Skin();
                $upgrader = new Plugin_Upgrader($skin);
                $upgrader->install($api->download_link);

                $this->activate_plugin($file_path);

                $this->plugin_install_count++;
            }
        }

        public function plugin_offline_installer_callback($path, $external_url) {

            $plugin_status = $this->plugin_status($path);

            if ($plugin_status == 'install') {
                // Make sure we have the dependency.
                if (!function_exists('WP_Filesystem')) {
                    require_once( ABSPATH . 'wp-admin/includes/file.php' );
                }

                /**
                 * Initialize WordPress' file system handler.
                 *
                 * @var WP_Filesystem_Base $wp_filesystem
                 */
                WP_Filesystem();
                global $wp_filesystem;

                $plugin = $this->demo_upload_dir() . 'plugin.zip';

                $file = wp_remote_retrieve_body(wp_remote_get($external_url, array(
                    'timeout' => 60,
                )));

                $wp_filesystem->mkdir($this->demo_upload_dir());

                $wp_filesystem->put_contents($plugin, $file);

                unzip_file($plugin, WP_PLUGIN_DIR);

                $plugin_file = WP_PLUGIN_DIR . '/' . esc_html($path);

                $wp_filesystem->delete($plugin);

                $this->activate_plugin($file_path);

                $this->plugin_install_count++;
            }
        }

        /* Plugin API */

        public function call_plugin_api($slug) {
            include_once ABSPATH . 'wp-admin/includes/plugin-install.php';

            $call_api = plugins_api('plugin_information', array(
                'slug' => $slug,
                'fields' => array(
                    'downloaded' => false,
                    'rating' => false,
                    'description' => false,
                    'short_description' => false,
                    'donate_link' => false,
                    'tags' => false,
                    'sections' => false,
                    'homepage' => false,
                    'added' => false,
                    'last_updated' => false,
                    'compatibility' => false,
                    'tested' => false,
                    'requires' => false,
                    'downloadlink' => true,
                    'icons' => false
            )));

            return $call_api;
        }

        public function activate_plugin($file_path) {
            if ($file_path) {
                $activate = activate_plugin($file_path, '', false, true);
            }
        }

        /* Check if plugin is active or not */

        public function plugin_status($file_path) {
            $status = 'install';

            $plugin_path = WP_PLUGIN_DIR . '/' . $file_path;

            if (file_exists($plugin_path)) {
                $status = is_plugin_active($file_path) ? 'active' : 'inactive';
            }
            return $status;
        }

        public function send_ajax_response() {
            $json = wp_json_encode($this->ajax_response);
            echo $json;
            die();
        }

        /*
          Register necessary backend js
         */

        function load_backends() {
            $theme_slug = get_option('stylesheet');
            $data = array(
                'nonce' => wp_create_nonce('demo-importer-ajax'),
                'prepare_importing' => esc_html__('Preparing to import demo', 'blazethemes-demo-importer'),
                'reset_database' => esc_html__('Reseting database', 'blazethemes-demo-importer'),
                'no_reset_database' => esc_html__('Database was not reset', 'blazethemes-demo-importer'),
                'import_error' => esc_html__('There was an error in importing demo. Please reload the page and try again.', 'blazethemes-demo-importer'),
                'import_success' => '<h2>' . esc_html__( 'All done. Have fun!', 'blazethemes-demo-importer') . '</h2><p>' . esc_html__('Your website has been successfully setup.', 'blazethemes-demo-importer') . '</p><a class="button" target="_blank" href="' . esc_url(home_url('/')) . '">View your Website</a><a class="button" href="' . esc_url(admin_url('/admin.php?page=' .esc_html(str_replace( '-pro', '', $theme_slug ) ). '-info.php')) . '">' . esc_html__('Go Back', 'blazethemes-demo-importer') . '</a>'
            );
            wp_enqueue_script('blazethemes-demo-importer-demo-ajax', BLAZE_DEMO_IMPORTER_ASSETS_URL . 'demo-importer-ajax.js', array('jquery', 'imagesloaded'), BLAZE_DEMO_IMPORTER_VERSION, true);
            wp_localize_script('blazethemes-demo-importer-demo-ajax', 'blazethemes_demo_importer_ajax_data', $data);
            wp_enqueue_style('blazethemes-demo-importer-demo-style', BLAZE_DEMO_IMPORTER_ASSETS_URL . 'demo-importer-style.css', array(), BLAZE_DEMO_IMPORTER_VERSION);
        }

    }

}

function blazethemes_demo_importer_importer() {
    new BLAZE_DEMO_IMPORTER_Importer;
}

add_action('after_setup_theme', 'blazethemes_demo_importer_importer');