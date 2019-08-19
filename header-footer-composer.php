<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://metricthemes.com
 * @since             1.0.0
 * @package           Header_Footer_Composer
 *
 * @wordpress-plugin
 * Plugin Name:       Header Footer Composer for Elementor
 * Plugin URI:        https://metricthemes.com/header-footer-composer
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            MetricThemes
 * Author URI:        https://metricthemes.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       header-footer-composer
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
define( 'HEADER_FOOTER_COMPOSER_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-header-footer-composer-activator.php
 */
function activate_header_footer_composer() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-header-footer-composer-activator.php';
	Header_Footer_Composer_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-header-footer-composer-deactivator.php
 */
function deactivate_header_footer_composer() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-header-footer-composer-deactivator.php';
	Header_Footer_Composer_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_header_footer_composer' );
register_deactivation_hook( __FILE__, 'deactivate_header_footer_composer' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-header-footer-composer.php';

function hfcmt_no_elementor() {
	if ( file_exists( WP_PLUGIN_DIR . '/elementor/elementor.php' ) ) {
		$link = network_admin_url() . 'plugins.php?s=elementor';
	} else {
		$link = network_admin_url() . 'plugin-install.php?s=elementor&tab=search&type=term';
	}

	echo '<div class="notice notice-error">';
	/* Translators: URL to install or activate Elementor plugin. */
	echo '<p>' . sprintf( __( 'The <strong>Header Footer Composer</strong> plugin requires <strong><a href="%s">Elementor</strong></a> plugin installed & activated.', 'header-footer-elementor' ) . '</p>', $link );
	echo '</div>';
}

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_header_footer_composer() {
	if ( defined( 'ELEMENTOR_VERSION' ) && is_callable( 'Elementor\Plugin::instance' ) ) {		 
		$plugin = new Header_Footer_Composer();
		$plugin->run();
	}
	else {
		add_action( 'admin_notices', 'hfcmt_no_elementor' );	
	}

}
run_header_footer_composer();
