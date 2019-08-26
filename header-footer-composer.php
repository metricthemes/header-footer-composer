<?php
/**
 * Do not go gentle into that good night,
 * Old age should burn and rave at close of day;
 * Rage, rage against the dying of the light.
 * 
 * Though wise men at their end know dark is right,
 * Because their words had forked no lightning they
 * Do not go gentle into that good night.
 *  
 * Dylan Thomas, 1914 - 1953
 *  
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License as published by the Free Software Foundation; either version 2 of the License,
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA 
 *
 * Plugin Name:       Header Footer Composer
 * Plugin URI:        https://github.com/metricthemes/header-footer-composer
 * Description:       Design custom headers and footers for your site using Elementor Page builder.
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
define( 'HEADER_FOOTER_COMPOSER_BASE_URL', plugins_url( '/', __FILE__ ) );

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
	echo '<p>' . sprintf( __( 'The <strong>Header Footer Composer</strong> plugin requires <strong><a href="%s">Elementor</strong></a> plugin installed & activated.', 'header-footer-composer' ) . '</p>', $link );
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