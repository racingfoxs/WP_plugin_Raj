<?php
/**
Plugin Name: Raj Plugin
Plugin URI: https://github.com/
Description: Plugin Development.
Version: 1.0
Requires at least: 5.0
Requires PHP: 5.2
Author: Automattic
Author URI: https://github.com/
License: GPLv2 or later
Text Domain: raj-plugin
 *
 * @package RajPlugin
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'No Direct Access' );
}

define( 'RP_PLUGIN_FILE', __FILE__ );
define( 'RP_VERSION', '1.0.0.1' );



require_once dirname( __FILE__ ) . '/includes/wp_requirements.php';

$my_plugin_requirements = new RP_Requirements(
	'Raj Plugin',
	RP_PLUGIN_FILE,
	array(
		'PHP'       => '7.4',
		'WordPress' => '5.0',
	)
);

if ( false === $my_plugin_requirements->pass() ) {
	$my_plugin_requirements->halt();
	return;
}


require_once dirname( __FILE__ ) . '/includes/news_location.php';
require_once dirname( __FILE__ ) . '/includes/news_meta_box.php';
require_once dirname( __FILE__ ) . '/includes/news_shortcode.php';
require_once dirname( __FILE__ ) . '/includes/news_custom_post_types.php';
require_once dirname( __FILE__ ) . '/includes/admin_settings.php';
require_once dirname( __FILE__ ) . '/includes/news-content.php';
require_once dirname( __FILE__ ) . '/includes/insert_post_activation.php';
require_once dirname( __FILE__ ) . '/includes/welcome_screen.php';
require_once dirname( __FILE__ ) . '/includes/rp_api_calls.php';

/**
 * Enqueue styles and scripts for the frontend.
 */

function add_style_front_end() {
	if ( is_singular( 'news' ) ) {
		wp_enqueue_style( 'news-setting-style', plugins_url( 'includes/css/frontend.css', RP_PLUGIN_FILE ), array(), RP_VERSION );
		wp_enqueue_script( 'news-setting-script', plugins_url( 'includes/js/frontend.js', RP_PLUGIN_FILE ), array(), RP_VERSION );
	}
}

add_action( 'wp_enqueue_scripts', 'add_style_front_end' );


/**
 * Load plugin text domain.
 */

function raj_plugin_language_text_domain() {
	load_plugin_textdomain( 'raj-plugin', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'init', 'raj_plugin_language_text_domain' );
