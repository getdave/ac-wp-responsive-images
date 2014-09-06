<?php

class Primary_Methods_TEST extends WP_UnitTestCase {

	function testStaticFactoryMethodExists() {
		$this->assertTrue( method_exists('AC_WP_Responsive_Images', 'get_responsive_image'), 'Plugin Class does not have static method "get_responsive_image"');
	}

	function testGlobalFunctionExists() {
		$this->assertTrue( function_exists('ac_wp_responsive_image'), 'Global function ac_wp_responsive_image does not exist');
	}

	function testReturnInstanceOfBuilderClass() {
		$instance1 = ac_wp_responsive_image();
		$this->assertInstanceOf('AC_WP_Responsive_Image', $instance1, 'Is not a valid instance of AC_WP_Responsive_Image Class');

		$instance2 = AC_WP_Responsive_Images::get_responsive_image(array());

		$this->assertInstanceOf('AC_WP_Responsive_Image', $instance2, 'Is not a valid instance of AC_WP_Responsive_Image Class');

	}
}

