<?php
/**
 * Plugin Name: Simple Visitor Counter
 * Plugin URI: https://github.com/akankshajain99/simple-visitor-counter
 * Description: A simple and lightweight visitor counter plugin for WordPress.
 * Version: 1.0.0
 * Author: Akanksha Jain
 * Author URI: https://github.com/akankshajain99
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: simple-visitor-counter
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Load plugin text domain
 */
function svc_load_textdomain() {
    load_plugin_textdomain(
        'simple-visitor-counter',
        false,
        dirname( plugin_basename( __FILE__ ) ) . '/languages'
    );
}
add_action( 'plugins_loaded', 'svc_load_textdomain' );

/**
 * Create option on activation
 */
function svc_activate_plugin() {
    if ( false === get_option( 'svc_total_visits' ) ) {
        add_option( 'svc_total_visits', 0 );
    }
}
register_activation_hook( __FILE__, 'svc_activate_plugin' );

/**
 * Count visitors (frontend only)
 */
function svc_count_visitor() {
    if ( is_admin() ) {
        return;
    }

    if ( ! isset( $_COOKIE['svc_visited'] ) ) {

        $count = (int) get_option( 'svc_total_visits', 0 );
        update_option( 'svc_total_visits', $count + 1 );

        setcookie(
            'svc_visited',
            '1',
            time() + MONTH_IN_SECONDS,
            COOKIEPATH,
            COOKIE_DOMAIN,
            is_ssl(),
            true
        );
    }
}
add_action( 'init', 'svc_count_visitor' );

/**
 * Shortcode to display visitor count
 */
function svc_display_counter() {
    $count = (int) get_option( 'svc_total_visits', 0 );

    return sprintf(
        '<div class="svc-counter">👁️ %s <strong>%s</strong></div>',
        esc_html__( 'Total Visitors:', 'simple-visitor-counter' ),
        esc_html( $count )
    );
}
add_shortcode( 'visitor_counter', 'svc_display_counter' );

/**
 * Add frontend styles
 */
function svc_add_styles() {
    $css = '
        .svc-counter {
            font-size: 16px;
            padding: 8px 12px;
            background: #f4f4f4;
            display: inline-block;
            border-radius: 5px;
        }
    ';
    wp_register_style( 'svc-style', false );
    wp_enqueue_style( 'svc-style' );
    wp_add_inline_style( 'svc-style', $css );
}
add_action( 'wp_enqueue_scripts', 'svc_add_styles' );

/**
 * Cleanup on uninstall
 */
function svc_uninstall_plugin() {
    delete_option( 'svc_total_visits' );
}
register_uninstall_hook( __FILE__, 'svc_uninstall_plugin' );