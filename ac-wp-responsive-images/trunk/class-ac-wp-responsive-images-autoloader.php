<?php

/**
 * Autoloading Class
 *
 * Autoloads classes as required
 * Uses a modified standard autoload pattern to match 
 * WordPress' coding standards as per
 * http://widthauto.com/autoload-classes-wordpress-plugin/
 *
 *
 * @since      1.0.0
 * @package    AC_WP_Responsive_Images
 * @subpackage AC_WP_Responsive_Images/includes
 * @author     David Smith getdavemail@gmail.com
 */

class AC_WP_Responsive_Image_Autoloader {

    public function __construct() {
        spl_autoload_register(array($this, 'include_autoloader'));
        spl_autoload_register(array($this, 'public_autoloader'));
        spl_autoload_register(array($this, 'admin_autoloader'));
    }

    private function include_autoloader( $class ) {
  
	    $class = strtolower( str_replace('_', '-', $class) );
	    if ( file_exists ( plugin_dir_path( __FILE__ ) . 'includes/class-' . $class . '.php' ) ){
	        include( plugin_dir_path( __FILE__ ) . 'includes/class-' . $class . '.php');
	    }
	}


	private function public_autoloader( $class ) {
	    $class = strtolower( str_replace('_', '-', $class) );
	    if ( file_exists ( plugin_dir_path( __FILE__ ) . 'public/class-' . $class . '.php' ) ){
	        include( plugin_dir_path( __FILE__ ) . 'public/class-' . $class . '.php');
	    }
	}


	private function admin_autoloader( $class ) {
	    $class = strtolower( str_replace('_', '-', $class) );
	    if ( file_exists ( plugin_dir_path( __FILE__ ) . 'admin/class-' . $class . '.php' ) ){
	        include( plugin_dir_path( __FILE__ ) . 'admin/class-' . $class . '.php');
	    }
	}

}

