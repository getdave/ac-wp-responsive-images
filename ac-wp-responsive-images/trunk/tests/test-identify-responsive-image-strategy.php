<?php

class Identify_Responsive_Image_Strategy extends WP_UnitTestCase {

	function testResponsiveImageStrategySetCorrectly() {
		$instance = new AC_WP_Responsive_Image(
			array(
				"image" => "http://placehold.it/350x150",
				"type" => "img"
			)
		);

		$ri = $instance->create();

		$this->assertEquals( "img", $ri->ri_strategy, "Fails to correct identify 'img' when type is set to 'img'");



		$instance2 = new AC_WP_Responsive_Image(
			array(
				"image" => "http://placehold.it/350x150",
				"type" => "picture"
			)
		);

		$ri2 = $instance2->create();

		$this->assertEquals( "picture", $ri2->ri_strategy, "Fails to correct identify 'picture' when type is set to 'picture'");
	}
}

