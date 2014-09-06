<?php

class Primary_Methods_TEST extends WP_UnitTestCase {

	function testStaticFactoryMethodExists() {
		$plugin = AC_WP_Responsive_Images::get_instance();

		$plugin::get_responsive_image( array() );

		$this->assertTrue( method_exists($plugin, 'get_responsive_image'), 'Plugin Class does not have static method "get_responsive_image"');
	}

	function testGlobalFunctionExists() {
		$this->assertTrue( function_exists('ac_wp_responsive_image'), 'Global function ac_wp_responsive_image does not exist');
	}
}

