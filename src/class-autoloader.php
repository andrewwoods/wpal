<?php
/**
 * This is part of the WordPress AutoLoader (WPAL) Plugin
 *
 * @license GPL
 * @since 0.1.0
 *
 * @package WPAL
 */

namespace WPAL;

/**
 * Class Autoloader
 *
 * @package WPAL
 */
class Autoloader {

	/**
	 * Autoloader constructor.
	 *
	 * @since 0.1.0
	 */
	public function __construct() {
	}

	/**
	 * The primary method used by client autoloading functions.
	 *
	 * @since 0.1.0
	 * @param string $class_name The class/trait/interface the client developer wants to use.
	 * @param string $class_directory The plugin directory where the user keeps their classes.
	 * @return bool
	 */
	public static function autoload_class( $class_name, $class_directory ) {
		$self = new self();
		$file = $self->check_as_class( $class_name, $class_directory );
		if ( $self->include_if_exists( $file ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Attempt to autoload this as a class
	 *
	 * WordPress expects filenames for classes to be prefixed with 'class-'.
	 *
	 * @since 0.1.0
	 * @param string $class_name The class/trait/interface the client developer wants to use.
	 * @param string $class_directory the plugin directory where the user keeps their classes.
	 * @return string
	 */
	public function check_as_class( $class_name, $class_directory ) {
		$data = $this->process_class_name( $class_name, $class_directory );

		$filename = $this->make_filename_from_class( $data['class'] );

		return $data['path'] . $filename;
	}

	/**
	 * Parse the class name
	 *
	 * @since 0.1.0
	 * @param string $class_name $class_name The class/trait/interface the client developer wants to use.
	 * @param string $class_directory The plugin directory where the user keeps their classes.
	 * @return array
	 */
	public function process_class_name( $class_name, $class_directory ) {
		$class_name_slashed = str_replace( '\\', '/', $class_name );

		$name_space = dirname( $class_name_slashed );
		if ( '.' === $name_space ) {
			$name_space = '';
		}

		$name_space = $this->sanitize_path( $name_space );
		if ( ! empty( $name_space ) ) {
			$name_space = '/' . $name_space;
		}

		$class = basename( $class_name_slashed );

		$file_path = trailingslashit( $class_directory . $name_space );

		return [
			'path' => $file_path,
			'class' => $class,
		];
	}

	/**
	 * Load a file if found
	 *
	 * @since 0.1.0
	 * @param string $file the full path to the file you want to include.
	 * @return bool
	 */
	protected function include_if_exists( $file ) {
		if ( file_exists( $file ) ) {
			include_once $file;
			return true;
		}

		return false;
	}


	/**
	 * Create a filename based on a class name
	 *
	 * @since 0.1.0
	 * @param string $class the WordPress class.
	 * @return string
	 */
	public function make_filename_from_class( $class ) {

		$slug = $this->sanitize_path( $class );

		return 'class-' . $slug . '.php';
	}

	/**
	 * Remove illegal characters and lowercase the value.
	 *
	 * PHP Namespaces are mapped to directories, so they're sanitized in the
	 * same fashion as directories. Illegal characters are converted to hyphens
	 * and multiple hyphens are collapsed to a single hyphen.
	 *
	 * @since 0.1.0
	 * @param string $content a directory or name space.
	 * @return string
	 */
	public function sanitize_path( $content ) {
		$slug = str_replace( '_', '-', $content );
		$slug = preg_replace( '/[!@#$%^&\*\(\)]+/', '-', $slug );
		$slug = preg_replace( '/\-{2,}/', '-', $slug );
		$slug = strtolower( $slug );

		return $slug;
	}
}
