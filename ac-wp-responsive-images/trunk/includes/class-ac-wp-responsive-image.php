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
	 * Placeholder for error objects
	 *
	 */
	public $error;


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
		if ( !$this->errored() ) { // there is no error
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
			$this->error = new WP_Error(__("No arguments provied"), $args);
			return false;
		}

		// Are the args of the expected type?
		if ( !is_array( $args ) ) {
			$this->error = new WP_Error(__("Arguments not passed as an Array. Please check your arguments"), $args);
			return false;
		}

		// Were the required args passed?
		if ( !isset( $args['image'] ) || !isset( $args['type'] ) ) {
			$this->error = new WP_Error(__("Required arguments 'image' and 'type' not provided. Please check your arguments"), $args);
			return false;
		}


		// All is well
		$this->args = $args;
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
