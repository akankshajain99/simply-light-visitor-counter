<?php
/**
 * Plugin Name: Simply Light Visitor Counter
 * Plugin URI: https://github.com/akankshajain99/simply-light-visitor-counter
 * Description: A simple and lightweight visitor counter plugin for WordPress.
 * Version: 1.0.0
 * Author: Akanksha Jain
 * Author URI: https://github.com/akankshajain99
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: simply-light-visitor-counter
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Load plugin text domain
 */
function slvc_load_textdomain() {
    load_plugin_textdomain(
        'simply-light-visitor-counter',
        false,
        dirname( plugin_basename( __FILE__ ) ) . '/languages'
    );
}
add_action( 'plugins_loaded', 'slvc_load_textdomain' );

/**
 * Create option on activation
 */
function slvc_activate_plugin() {
    if ( false === get_option( 'slvc_total_visits' ) ) {
        add_option( 'slvc_total_visits', 0 );
    }
}
register_activation_hook( __FILE__, 'slvc_activate_plugin' );

/**
 * Count visitors (frontend only)
 */
function slvc_count_visitor() {
    if ( is_admin() ) {
        return;
    }

    if ( ! isset( $_COOKIE['slvc_visited'] ) ) {

        $count = (int) get_option( 'slvc_total_visits', 0 );
        update_option( 'slvc_total_visits', $count + 1 );

        setcookie(
            'slvc_visited',
            '1',
            time() + MONTH_IN_SECONDS,
            COOKIEPATH,
            COOKIE_DOMAIN,
            is_ssl(),
            true
        );
    }
}
add_action( 'init', 'slvc_count_visitor' );

/**
 * Shortcode to display visitor count
 */
function slvc_display_counter() {
    $count = (int) get_option( 'slvc_total_visits', 0 );

    return sprintf(
        '<div class="slvc-counter">👁️ %s <strong>%s</strong></div>',
        esc_html__( 'Total Visitors:', 'simply-light-visitor-counter' ),
        esc_html( $count )
    );
}
add_shortcode( 'visitor_counter', 'slvc_display_counter' );

/**
 * Add frontend styles
 */
function slvc_add_styles() {
    $css = '
        .slvc-counter {
            font-size: 16px;
            padding: 8px 12px;
            background: #f4f4f4;
            display: inline-block;
            border-radius: 5px;
        }
    ';
    wp_register_style( 'slvc-style', false );
    wp_enqueue_style( 'slvc-style' );
    wp_add_inline_style( 'slvc-style', $css );
}
add_action( 'wp_enqueue_scripts', 'slvc_add_styles' );

/**
 * Cleanup on uninstall
 */
function slvc_uninstall_plugin() {
    delete_option( 'slvc_total_visits' );
}
register_uninstall_hook( __FILE__, 'slvc_uninstall_plugin' );