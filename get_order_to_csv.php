<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://test.com
 * @since             1.0.0
 * @package           Get_order_to_csv
 *
 * @wordpress-plugin
 * Plugin Name:       get_order_to_csv
 * Plugin URI:        https://test.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            vadim
 * Author URI:        https://test.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       get_order_to_csv
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'GET_ORDER_TO_CSV_VERSION', '1.0.0' );
define( 'GET_ORDER_TO_CSV_ROOT_DIR', plugin_dir_path(__FILE__) );
define( 'GET_ORDER_TO_CSV_CACHE_DIR', plugin_dir_path(__FILE__)."cache/" );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-get_order_to_csv-activator.php
 */
function activate_get_order_to_csv() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-get_order_to_csv-activator.php';
	Get_order_to_csv_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-get_order_to_csv-deactivator.php
 */
function deactivate_get_order_to_csv() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-get_order_to_csv-deactivator.php';
	Get_order_to_csv_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_get_order_to_csv' );
register_deactivation_hook( __FILE__, 'deactivate_get_order_to_csv' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-get_order_to_csv.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_get_order_to_csv() {

	$plugin = new Get_order_to_csv();
	$plugin->run();

}
run_get_order_to_csv();
