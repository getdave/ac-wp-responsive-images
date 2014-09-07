<?php

/**
 * Core Class to Build a new Responsive Image
 *
 * Uses a mixture of the Builder and Strategy Design Pattenrs to construct
 * the complex RI object and return for utilisation by main Plugin methods
 *
 *
 * @since      1.0.0
 * @package    AC_WP_Responsive_Images
 * @subpackage AC_WP_Responsive_Images/includes
 * @author     David Smith getdavemail@gmail.com
 */
class AC_WP_Responsive_Image {

	/**
	 * Array of arguments provided by caller
	 * @var array
	 */
	private $args;


	/**
	 * Contains any WP_Error objects thrown 
	 * @var Object
	 */
	public $error = null;


	/**
	 * Reference to the type of Abstract RI Strategy utilised
	 * @var Object
	 */
	public $ri_strategy;


	/**
	 * Initialise the Responsive Image
	 *
	 * @param array $args array of arguments
	 * @since    1.0.0
	 */
	public function __construct( Array $args ) {

		$this->setArgs( $args );
	}

	/**
	 * Controls the creation of the Responsive Image
	 *
	 * @return Object a valid responsive image object
	 */
	public function create() {
		if ( !$this->errored() ) { // all args are valid...

			// Get the correct strategy Class to handle the type of Responsive Image solution
			$this->ri_strategy = $this->identify_responsive_image_type( $this->args['type'] );

			return $this;
		} else {
			return $this->error;
		}
	}

	/**
	 * Validate, parse and set arguments
	 *
	 * @param array $args arguments passed to constructor
	 */
	private function setArgs( $args ) {

		// We args passed at all?
		if ( empty( $args ) ) {
			$this->error = new WP_Error('arguments', __("No arguments provied"), $args);
			return false;
		}

		// Are the args of the expected type?
		if ( !is_array( $args ) ) {
			$this->error = new WP_Error('arguments', __("Arguments not passed as an Array. Please check your arguments."), $args);
			return false;
		}

		// Were the required args passed?
		if ( !isset( $args['image'] ) || !isset( $args['type'] ) ) {
			$this->error = new WP_Error('arguments', __("Required arguments 'image' and 'type' not provided. Please check your arguments."), $args);
			return false;
		}

		// Check validity of "image" arg - can be an attachment ID or a URI for a source images as a string
		if ( !is_numeric( $args['image'] ) && !is_string( $args['image'] ) ) {
			$this->error = new WP_Error('arguments', __("The 'image' argument must be a attachment ID (int) or a valid image source URI (string). Please check your arguments."), $args);
			return false;
		}

		// Check validity of "type" arg - can be a string of "img" or "picture"
		if ( $args['type'] !== "img" && $args['type'] !== "picture" ) {
			$this->error = new WP_Error('arguments', __("The 'type' argument must be one of either 'img' or 'picture. Please check your arguments."), $args);
			return false;
		}

		// All is well
		$this->args = $args;
	}



	private function identify_responsive_image_type( $type ) {
	    if( $type === "img") {
		    return "img";
		} else {
		    return "picture";
		}
	}


	/**
	 * Checks whether the object is in an error state
	 *
	 * @access private
	 * @return Boolean
	 */
	private function errored() {
		return ! empty( $this->error );
	}


}
