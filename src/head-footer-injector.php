<?php
/**
 * Plugin Name: Head and Footer Injector
 * Plugin URI: https://github.com/wp-head-footer-adder/head-footer-injector
 * Description: Add custom meta tags to the page header and injected links to the footer navigation. Perfect for adding tracking codes, verification meta tags, and custom footer links.
 * Version: 1.0.0
 * Author: Fernando Binkowski de Andrade
 * Author URI: https://github.com/fekow
 * License: GPL2+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: head-footer-injector
 * Domain Path: /languages
 * Requires at least: 5.0
 * Requires PHP: 7.4
 * Network: false
 *
 * @package Head_Footer_Injector
 * @author Fernando Binkowski de Andrade
 * @license GPL2+
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define plugin constants.
define( 'HEAD_FOOTER_INJECTOR_VERSION', '1.0.0' );
define( 'HEAD_FOOTER_INJECTOR_PATH', plugin_dir_path( __FILE__ ) );
define( 'HEAD_FOOTER_INJECTOR_URL', plugin_dir_url( __FILE__ ) );

if ( ! class_exists( 'Head_Footer_Injector_Plugin' ) ) {

    class Head_Footer_Injector_Plugin {

        /**
         * Flag to avoid rendering the link multiple times.
         *
         * @var bool
         */
        private static $link_added = false;

        /**
         * Singleton instance.
         *
         * @var Head_Footer_Injector_Plugin|null
         */
        private static $instance = null;

        /**
         * Retrieve a single instance of the plugin.
         *
         * @return Head_Footer_Injector_Plugin
         */
        public static function get_instance() {
            if ( null === self::$instance ) {
                self::$instance = new self();
            }

            return self::$instance;
        }

        /**
         * Register hooks.
         */
        private function __construct() {
            add_action( 'init', array( $this, 'load_textdomain' ) );
            add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
            add_action( 'admin_init', array( $this, 'register_settings' ) );

            if ( is_admin() ) {
                return;
            }

            // Add meta tag to header
            add_action( 'wp_head', array( $this, 'add_meta_tag_to_header' ) );

            // Start output buffering early to capture all content
            add_action( 'template_redirect', array( $this, 'start_output_buffering' ), 1 );
            // Process footer at shutdown after everything is rendered
            add_action( 'shutdown', array( $this, 'process_footer_on_shutdown' ), 0 );
        }

        /**
         * Load plugin translations.
         *
         * @since 1.0.0
         */
        public function load_textdomain() {
            load_plugin_textdomain(
                'head-footer-injector',
                false,
                dirname( plugin_basename( __FILE__ ) ) . '/languages/'
            );
        }

        /**
         * Add settings menu in WordPress admin.
         *
         * @since 1.0.0
         */
        public function add_admin_menu() {
            add_options_page(
                __( 'Head and Footer Injector Settings', 'head-footer-injector' ),
                __( 'Head & Footer Injector', 'head-footer-injector' ),
                'manage_options',
                'head-footer-injector',
                array( $this, 'render_settings_page' )
            );
        }

        /**
         * Register plugin settings with sanitization and validation.
         *
         * @since 1.0.0
         */
        public function register_settings() {
            register_setting(
                'head_footer_injector_options',
                'head_footer_injector_header_key',
                array(
                    'type'              => 'string',
                    'sanitize_callback' => 'sanitize_text_field',
                    'default'           => '',
                    'show_in_rest'      => true,
                )
            );

            register_setting(
                'head_footer_injector_options',
                'head_footer_injector_header_value',
                array(
                    'type'              => 'string',
                    'sanitize_callback' => 'sanitize_text_field',
                    'default'           => '',
                    'show_in_rest'      => true,
                )
            );

            register_setting(
                'head_footer_injector_options',
                'head_footer_injector_footer_link_url',
                array(
                    'type'              => 'string',
                    'sanitize_callback' => 'esc_url_raw',
                    'default'           => '',
                    'show_in_rest'      => true,
                )
            );

            register_setting(
                'head_footer_injector_options',
                'head_footer_injector_footer_link_text',
                array(
                    'type'              => 'string',
                    'sanitize_callback' => 'sanitize_text_field',
                    'default'           => '',
                    'show_in_rest'      => true,
                )
            );

            // Add settings sections
            add_settings_section(
                'head_footer_injector_header_section',
                __( 'Header Meta Tag', 'head-footer-injector' ),
                array( $this, 'render_header_section' ),
                'head-footer-injector'
            );

            add_settings_section(
                'head_footer_injector_footer_section',
                __( 'Footer Link Settings', 'head-footer-injector' ),
                array( $this, 'render_footer_section' ),
                'head-footer-injector'
            );

            // Add settings fields
            add_settings_field(
                'head_footer_injector_header_key',
                __( 'Header Meta Key', 'head-footer-injector' ),
                array( $this, 'render_header_key_field' ),
                'head-footer-injector',
                'head_footer_injector_header_section'
            );

            add_settings_field(
                'head_footer_injector_header_value',
                __( 'Header Meta Value', 'head-footer-injector' ),
                array( $this, 'render_header_value_field' ),
                'head-footer-injector',
                'head_footer_injector_header_section'
            );

            add_settings_field(
                'head_footer_injector_footer_link_url',
                __( 'Footer Link URL', 'head-footer-injector' ),
                array( $this, 'render_footer_url_field' ),
                'head-footer-injector',
                'head_footer_injector_footer_section'
            );

            add_settings_field(
                'head_footer_injector_footer_link_text',
                __( 'Footer Link Text', 'head-footer-injector' ),
                array( $this, 'render_footer_text_field' ),
                'head-footer-injector',
                'head_footer_injector_footer_section'
            );
        }

        /**
         * Render the settings page with nonce verification.
         *
         * @since 1.0.0
         */
        public function render_settings_page() {
            if ( ! current_user_can( 'manage_options' ) ) {
                wp_die( esc_html__( 'You do not have permission to access this page.', 'head-footer-injector' ) );
            }
            ?>
            <div class="wrap">
                <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
                <form method="post" action="options.php">
                    <?php
                    settings_fields( 'head_footer_injector_options' );
                    do_settings_sections( 'head-footer-injector' );
                    submit_button();
                    ?>
                </form>
            </div>
            <?php
        }

        /**
         * Render header section description.
         *
         * @since 1.0.0
         */
        public function render_header_section() {
            echo '<p>' . esc_html__( 'Add a custom meta tag to the page header (wp_head). Useful for verification codes and tracking scripts.', 'head-footer-injector' ) . '</p>';
        }

        /**
         * Render header key field.
         *
         * @since 1.0.0
         */
        public function render_header_key_field() {
            $value = get_option( 'head_footer_injector_header_key' );
            ?>
            <input type="text" name="head_footer_injector_header_key" value="<?php echo esc_attr( $value ); ?>" class="regular-text" placeholder="e.g., google-site-verification" />
            <p class="description"><?php esc_html_e( 'The name attribute of the meta tag.', 'head-footer-injector' ); ?></p>
            <?php
        }

        /**
         * Render header value field.
         *
         * @since 1.0.0
         */
        public function render_header_value_field() {
            $value = get_option( 'head_footer_injector_header_value' );
            ?>
            <input type="text" name="head_footer_injector_header_value" value="<?php echo esc_attr( $value ); ?>" class="regular-text" placeholder="e.g., your-verification-code" />
            <p class="description"><?php esc_html_e( 'The content attribute of the meta tag.', 'head-footer-injector' ); ?></p>
            <?php
        }

        /**
         * Render footer section description.
         *
         * @since 1.0.0
         */
        public function render_footer_section() {
            echo '<p>' . esc_html__( 'Configure the link that will be added to the footer navigation menu.', 'head-footer-injector' ) . '</p>';
        }

        /**
         * Render footer URL field.
         *
         * @since 1.0.0
         */
        public function render_footer_url_field() {
            $value = get_option( 'head_footer_injector_footer_link_url' );
            ?>
            <input type="url" name="head_footer_injector_footer_link_url" value="<?php echo esc_attr( $value ); ?>" class="regular-text" placeholder="https://example.com/" />
            <p class="description"><?php esc_html_e( 'The URL the footer link will point to.', 'head-footer-injector' ); ?></p>
            <?php
        }

        /**
         * Render footer text field.
         *
         * @since 1.0.0
         */
        public function render_footer_text_field() {
            $value = get_option( 'head_footer_injector_footer_link_text' );
            ?>
            <input type="text" name="head_footer_injector_footer_link_text" value="<?php echo esc_attr( $value ); ?>" class="regular-text" placeholder="Link Text" />
            <p class="description"><?php esc_html_e( 'The text displayed for the footer link.', 'head-footer-injector' ); ?></p>
            <?php
        }

        /**
         * Add meta tag to the page header.
         *
         * @since 1.0.0
         */
        public function add_meta_tag_to_header() {
            $header_key   = get_option( 'head_footer_injector_header_key' );
            $header_value = get_option( 'head_footer_injector_header_value' );

            if ( ! empty( $header_key ) && ! empty( $header_value ) ) {
                echo '<meta name="' . esc_attr( $header_key ) . '" content="' . esc_attr( $header_value ) . '" />' . "\n";
            }
        }

        /**
         * Start output buffering early to capture the complete page output.
         *
         * @since 1.0.0
         */
        public function start_output_buffering() {
            ob_start();
        }

        /**
         * Process the complete page output and inject the link into the footer.
         *
         * @since 1.0.0
         */
        public function process_footer_on_shutdown() {
            // Only inject once per page load
            if ( self::$link_added ) {
                $output = ob_get_clean();
                echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                return;
            }

            // Get all output buffering content
            $output = ob_get_clean();

            if ( empty( $output ) || ! is_string( $output ) ) {
                echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                return;
            }

            // Extract footer section from the output
            $footer_section = '';

            // Look for closing </body> tag and extract footer content.
            if ( preg_match( '/(.*)<\/body>/is', $output, $matches ) ) {
                // Get last 5000 characters which should contain the footer.
                $footer_section = substr( $matches[1], -5000 );
            }

            if ( ! empty( $footer_section ) ) {
                $modified_footer = $this->inject_footer_link( $footer_section );

                // If injection succeeded, replace in full output.
                if ( $modified_footer !== $footer_section ) {
                    $output = str_replace( $footer_section, $modified_footer, $output );
                    self::$link_added = true;
                }
            }

            echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }

        /**
         * Inject the link into the footer HTML using multiple strategies.
         *
         * @since 1.0.0
         *
         * @param string $footer_html Footer HTML content.
         *
         * @return string Modified footer HTML.
         */
        private function inject_footer_link( $footer_html ) {
            $link_text = get_option( 'head_footer_injector_footer_link_text' );
            if ( empty( $link_text ) ) {
                $link_text = __( 'Link', 'head-footer-injector' );
            }

            $link_url = get_option( 'head_footer_injector_footer_link_url' );
            if ( empty( $link_url ) ) {
                return $footer_html;
            }

            // Strategy 1: Look for navigation lists with wp-block-navigation or menu classes.
            if ( preg_match( '/<ul[^>]*class="[^"]*(?:wp-block-navigation|menu)[^"]*"[^>]*>.*?<\/ul>/is', $footer_html ) ) {
                if ( preg_match_all( '/<ul[^>]*class="[^"]*(?:wp-block-navigation|menu)[^"]*"[^>]*>(.*?)<\/ul>/is', $footer_html, $matches ) ) {
                    $last_match_index = count( $matches[0] ) - 1;
                    $last_ul          = $matches[0][ $last_match_index ];

                    if ( preg_match( '/<li[^>]*class="([^"]*)"[^>]*>/', $last_ul, $li_match ) ) {
                        $li_class = $li_match[1];

                        // Check if this is block-based navigation.
                        if ( strpos( $li_class, 'wp-block-navigation-item' ) !== false ) {
                            $new_item = '<li class="' . esc_attr( $li_class ) . '"><a class="wp-block-navigation-item__content" href="' . esc_url( $link_url ) . '" target="_blank" rel="noopener noreferrer nofollow"><span class="wp-block-navigation-item__label">' . esc_html( $link_text ) . '</span></a></li>';
                        } else {
                            $new_item = '<li class="' . esc_attr( $li_class ) . '"><a href="' . esc_url( $link_url ) . '" target="_blank" rel="noopener noreferrer nofollow">' . esc_html( $link_text ) . '</a></li>';
                        }

                        $updated_ul = str_replace( '</ul>', $new_item . '</ul>', $last_ul );
                        $footer_html = str_replace( $last_ul, $updated_ul, $footer_html );

                        return $footer_html;
                    }
                }
            }

            // Strategy 2: Look for any <ul> in footer area (catch-all).
            if ( preg_match( '/<ul[^>]*>.*?<\/ul>/is', $footer_html ) ) {
                if ( preg_match_all( '/<ul[^>]*>(.*?)<\/ul>/is', $footer_html, $matches ) ) {
                    $last_match_index = count( $matches[0] ) - 1;
                    $last_ul          = $matches[0][ $last_match_index ];

                    if ( preg_match( '/<li[^>]*class="([^"]*)"[^>]*>/', $last_ul, $li_match ) ) {
                        $li_class = $li_match[1];
                        $new_item = '<li class="' . esc_attr( $li_class ) . '"><a href="' . esc_url( $link_url ) . '" target="_blank" rel="noopener noreferrer nofollow">' . esc_html( $link_text ) . '</a></li>';
                    } else {
                        $new_item = '<li><a href="' . esc_url( $link_url ) . '" target="_blank" rel="noopener noreferrer nofollow">' . esc_html( $link_text ) . '</a></li>';
                    }

                    $updated_ul = str_replace( '</ul>', $new_item . '</ul>', $last_ul );
                    $footer_html = str_replace( $last_ul, $updated_ul, $footer_html );

                    return $footer_html;
                }
            }

            // Strategy 3: Look for <nav> elements.
            if ( preg_match( '/<nav[^>]*>.*?<\/nav>/is', $footer_html ) ) {
                if ( preg_match_all( '/<nav[^>]*>(.*?)<\/nav>/is', $footer_html, $matches ) ) {
                    $last_nav = $matches[0][ count( $matches[0] ) - 1 ];

                    if ( strpos( $last_nav, '<ul' ) !== false ) {
                        $nav_content = preg_replace_callback(
                            '/<ul[^>]*>(.*?)<\/ul>/is',
                            function( $ul_matches ) use ( $link_text, $link_url ) {
                                $ul_content = $ul_matches[0];

                                if ( preg_match( '/<li[^>]*class="([^"]*)"/', $ul_content, $li_match ) ) {
                                    $li_class = $li_match[1];
                                    $new_item = '<li class="' . esc_attr( $li_class ) . '"><a href="' . esc_url( $link_url ) . '" target="_blank" rel="noopener noreferrer nofollow">' . esc_html( $link_text ) . '</a></li>';
                                } else {
                                    $new_item = '<li><a href="' . esc_url( $link_url ) . '" target="_blank" rel="noopener noreferrer nofollow">' . esc_html( $link_text ) . '</a></li>';
                                }

                                return str_replace( '</ul>', $new_item . '</ul>', $ul_content );
                            },
                            $last_nav,
                            1
                        );

                        $footer_html = str_replace( $last_nav, $nav_content, $footer_html );

                        return $footer_html;
                    }
                }
            }

            // Strategy 4: Look for footer divs with links.
            if ( preg_match( '/<div[^>]*class="[^"]*footer[^"]*"[^>]*>.*?<\/div>/is', $footer_html ) ) {
                if ( preg_match_all( '/<div[^>]*class="[^"]*footer[^"]*"[^>]*>(.*?)<\/div>/is', $footer_html, $matches ) ) {
                    $last_footer_div = $matches[0][ count( $matches[0] ) - 1 ];

                    if ( strpos( $last_footer_div, '<a' ) !== false ) {
                        if ( preg_match( '/<a[^>]*class="([^"]*)"/', $last_footer_div, $link_match ) ) {
                            $link_class = $link_match[1];
                            $new_link   = '<a class="' . esc_attr( $link_class ) . '" href="' . esc_url( $link_url ) . '" target="_blank" rel="noopener noreferrer nofollow">' . esc_html( $link_text ) . '</a>';
                        } else {
                            $new_link = '<a href="' . esc_url( $link_url ) . '" target="_blank" rel="noopener noreferrer nofollow">' . esc_html( $link_text ) . '</a>';
                        }

                        $updated_div = str_replace( '</div>', $new_link . '</div>', $last_footer_div );
                        $footer_html = str_replace( $last_footer_div, $updated_div, $footer_html );

                        return $footer_html;
                    }
                }
            }

            return $footer_html;
        }
    }
}

Head_Footer_Injector_Plugin::get_instance();
