<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.sourcepole.com/modest-map-wp
 * @package           Modest_Map
 *
 * @wordpress-plugin
 * Plugin Name:       Modest Map
 * Plugin URI:        https://wordpress.org/plugins/modest-map/
 * Description:       Self-hosted GDPR compliant map without tracking.
 * Version:           1.0.0
 * Author:            Sourcepole
 * Author URI:        https://www.sourcepole.com/modest-map-wp
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define('MODEST_MAP__PLUGIN_VERSION', '1.0.0');
define('MODEST_MAP__PLUGIN_DIR', plugin_dir_path(__FILE__));

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-modest-map-activator.php
 */
function activate_modest_map() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-modest-map-activator.php';
	Modest_Map_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-modest-map-deactivator.php
 */
function deactivate_modest_map() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-modest-map-deactivator.php';
	Modest_Map_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_modest_map' );
register_deactivation_hook( __FILE__, 'deactivate_modest_map' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-modest-map.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 */
function run_modest_map() {

	$plugin = new Modest_Map();
	$plugin->run();

}
run_modest_map();
