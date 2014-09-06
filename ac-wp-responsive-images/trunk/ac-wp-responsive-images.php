<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * Dashboard. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/getdave/ac-wp-responsive-images/
 * @since             1.0.0
 * @package           AC_WP_Responsive_Images
 *
 * @wordpress-plugin
 * Plugin Name:       AC WP Responsive Images
 * Plugin URI:        https://github.com/getdave/ac-wp-responsive-images/
 * Description:       Developer-centric Plugin enabling creation of Responsive Images for WordPress using <img> or <picture> methods
 * Version:           1.0.0
 * Author:            David Smith
 * Author URI:        https://github.com/getdave/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ac-wp-responsive-images
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/class-ac-wp-responsive-images-activator.php';

/**
 * The code that runs during plugin deactivation.
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/class-ac-wp-responsive-images-deactivator.php';

/** This action is documented in includes/class-ac-wp-responsive-images-activator.php */
register_activation_hook( __FILE__, array( 'AC_WP_Responsive_Images_Activator', 'activate' ) );

/** This action is documented in includes/class-ac-wp-responsive-images-deactivator.php */
register_deactivation_hook( __FILE__, array( 'AC_WP_Responsive_Images_Deactivator', 'deactivate' ) );

/**
 * The core plugin class that is used to define internationalization,
 * dashboard-specific hooks, and public-facing site hooks.
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/class-ac-wp-responsive-images.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function ac_wp_responsive_image( $args = array() ) {

	$plugin = AC_WP_Responsive_Images::get_instance();
	return $plugin::get_responsive_image($args);

}

add_action( 'plugins_loaded', array( 'AC_WP_Responsive_Images', 'get_instance' ) );




