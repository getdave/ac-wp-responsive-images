<?php

class Primary_Methods_Test extends WP_UnitTestCase {

	private $valid_image_arg = "http://placehold.it/350x150";
	private $valid_type_arg = "img";
	private $valid_args = null;

	public function setUp() {
		$this->valid_args = array(
			"image" => $this->valid_image_arg,
			"type" => $this->valid_type_arg
		);
	}

	function testStaticFactoryMethodExists() {
		$this->assertTrue( method_exists('AC_WP_Responsive_Images', 'get_responsive_image'), 'Plugin Class does not have static method "get_responsive_image"');
	}

	function testGlobalFunctionExists() {
		$this->assertTrue( function_exists('ac_wp_responsive_image'), 'Global function ac_wp_responsive_image does not exist');
	}

	function testReturnInstanceOfResponsiveImageClass() {

		// Test function
		$instance1 = ac_wp_responsive_image( $this->valid_args );
		$this->assertInstanceOf('AC_WP_Responsive_Image', $instance1, 'Is not a valid instance of AC_WP_Responsive_Image Class');


		// Test Class method
		$instance2 = AC_WP_Responsive_Images::get_responsive_image( $this->valid_args );
		$this->assertInstanceOf('AC_WP_Responsive_Image', $instance2, 'Is not a valid instance of AC_WP_Responsive_Image Class');
	}


	function testEnforcesRequiredArguments() {
		// Missing required args
		$instance = AC_WP_Responsive_Images::get_responsive_image( array() );
		$this->assertTrue( is_wp_error( $instance ), 'Allows missing arguments that are required');

		$instance2 = AC_WP_Responsive_Images::get_responsive_image( array("image" => $this->valid_image_arg ) );
		$this->assertTrue( is_wp_error( $instance2 ), 'Allows "type" argument to be missing even though it is required');

		$instance3 = AC_WP_Responsive_Images::get_responsive_image( array("type" => $this->valid_type_arg) );
		$this->assertTrue( is_wp_error( $instance3 ), 'Allows "image" argument to be missing even though it is required');

	}

	function testEnforcesValidRequiresArgumentTypes() {
		$invalid_arg = array();

		$instance1 = AC_WP_Responsive_Images::get_responsive_image( array('image' => $invalid_arg, 'type' => $this->valid_type_arg) );
		$this->assertTrue( is_wp_error( $instance1 ), 'Allows "image" argument to be a type that is not String or INT');

		$instance2 = AC_WP_Responsive_Images::get_responsive_image( array('image' => $this->valid_image_arg, 'type' => $invalid_arg) );
		$this->assertTrue( is_wp_error( $instance2 ), 'Allows "type" argument to not be of type String');
	}


}

