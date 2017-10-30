<?php
/**
 * Class SampleTest
 *
 * @package Wpal
 */

use WPAL\Autoloader;

/**
 * Sample test case.
 */
class AutoloaderTest extends WP_UnitTestCase {

	/**
	 * Test the creation of a filename based on the class name.
	 */
	function test_make_filename_from_class() {
		// Replace this with some actual testing code.
		$autoloader = new Autoloader();

		$first = $autoloader->make_filename_from_class( 'First' );
		self::assertEquals( 'class-first.php', $first );

		$second = $autoloader->make_filename_from_class( 'First_Second' );
		self::assertEquals( 'class-first-second.php', $second );

		$third = $autoloader->make_filename_from_class( 'First_Second_Third' );
		self::assertEquals( 'class-first-second-third.php', $third );
	}

	/**
	 * Test the processing of the class name as a string
	 */
	function test_process_class_name() {
		$autoload = new Autoloader();

		$result = $autoload->process_class_name( 'One', '/var/www/project/wp-content/plugins/acme' );
		$dir = '/var/www/project/wp-content/plugins/acme/';

		self::assertEquals( $dir, $result['path'] );
		self::assertEquals( 'One', $result['class'] );

		$result = $autoload->process_class_name( 'Name_Space\One', '/var/www/project/wp-content/plugins/acme' );
		self::assertEquals( $dir . 'name-space/', $result['path'] );
		self::assertEquals( 'One', $result['class'] );

		$result = $autoload->process_class_name( 'Name_Space\\Sub_Space\\One', '/var/www/project/wp-content/plugins/acme' );
		self::assertEquals( $dir . 'name-space/sub-space/', $result['path'] );
		self::assertEquals( 'One', $result['class'] );
	}

	/**
	 * Test the inclusion of a class name.
	 */
	function test_check_as_class() {
		$autoload = new Autoloader();

		$dir = '/var/www/lib';

		$result = $autoload->check_as_class( 'World', $dir );
		self::assertEquals( $dir . '/class-world.php', $result );

		$result = $autoload->check_as_class( 'World\\Country', $dir );
		self::assertEquals( $dir . '/world/class-country.php', $result );

		$result = $autoload->check_as_class( 'World\\North_America\\United_States', $dir );
		self::assertEquals( $dir . '/world/north-america/class-united-states.php', $result );
	}


	/**
	 * Ensure illegal characters are removed appropriately.
	 */
	function test_sanitize_path() {
		$autoload = new Autoloader();

		$result = $autoload->sanitize_path( 'First--Second' );
		self::assertEquals( 'first-second', $result );

		$result = $autoload->sanitize_path( 'First_Name--Last_Name' );
		self::assertEquals( 'first-name-last-name', $result );

		$result = $autoload->sanitize_path( 'First_Name--Middle_name$!@#$%^&Last_Name' );
		self::assertEquals( 'first-name-middle-name-last-name', $result );
	}
}
