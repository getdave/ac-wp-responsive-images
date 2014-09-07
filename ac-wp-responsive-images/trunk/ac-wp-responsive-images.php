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
 * Register an Autoloader for the Plugin to avoid having to manually
 * manage file includes and dependencies
 */
require_once plugin_dir_path( __FILE__ ) . 'class-ac-wp-responsive-images-autoloader.php';
new AC_WP_Responsive_Image_Autoloader();

/** This action is documented in includes/class-ac-wp-responsive-images-activator.php */
register_activation_hook( __FILE__, array( 'AC_WP_Responsive_Images_Activator', 'activate' ) );

/** This action is documented in includes/class-ac-wp-responsive-images-deactivator.php */
register_deactivation_hook( __FILE__, array( 'AC_WP_Responsive_Images_Deactivator', 'deactivate' ) );


/**
 * Primary View Helper/Utility function for Plugin
 *
 * Since WordPress favours globally defined functions we add one here so
 * that it is available to all WordPress templates.
 * Acts as a wrapper around the Plugin's static method which in turn
 *
 * @since    1.0.0
 */
function ac_wp_responsive_image( $args = array() ) {
	return AC_WP_Responsive_Images::get_responsive_image($args);
}

/**
 * Begins execution of the plugin.
 *
 * Since the Plugin is a Singleton we don't __construct. Instead we call the
 * static ::get_instance method to bootstrap the Plugin.
 */
add_action( 'plugins_loaded', array( 'AC_WP_Responsive_Images', 'get_instance' ) );

