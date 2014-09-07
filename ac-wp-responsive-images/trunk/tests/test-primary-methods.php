<?php

class Primary_Methods_Test extends WP_UnitTestCase {

	function testStaticFactoryMethodExists() {
		$this->assertTrue( method_exists('AC_WP_Responsive_Images', 'get_responsive_image'), 'Plugin Class does not have static method "get_responsive_image"');
	}

	function testGlobalFunctionExists() {
		$this->assertTrue( function_exists('ac_wp_responsive_image'), 'Global function ac_wp_responsive_image does not exist');
	}

	function testReturnInstanceOfResponsiveImageClass() {

		$valid_args = array( 
			'image' => "fooo", 
			"type" => "bar"
		);

		// Test function
		$instance1 = ac_wp_responsive_image( $valid_args );
		$this->assertInstanceOf('AC_WP_Responsive_Image', $instance1, 'Is not a valid instance of AC_WP_Responsive_Image Class');

		// Test Class method
		$instance2 = AC_WP_Responsive_Images::get_responsive_image( $valid_args );
		$this->assertInstanceOf('AC_WP_Responsive_Image', $instance2, 'Is not a valid instance of AC_WP_Responsive_Image Class');
	}


	function testRequiresRequiredArguments() {
		// Missing required args
		$instance = AC_WP_Responsive_Images::get_responsive_image( array() );
		$this->assertTrue( is_wp_error( $instance ), 'Allows missing arguments that are required'); 

		$instance2 = AC_WP_Responsive_Images::get_responsive_image( array("image" => "value") );
		$this->assertTrue( is_wp_error( $instance2 ), 'Allows "image" argument to be missing even though it is required'); 

		$instance3 = AC_WP_Responsive_Images::get_responsive_image( array("type" => "value") );
		$this->assertTrue( is_wp_error( $instance3 ), 'Allows "type" argument to be missing even though it is required'); 

	}
}

