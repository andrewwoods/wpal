<?php
/**
 * Base WPAL plugin file
 *
 * This file sets the necessary constants and loads the autoloader.
 *
 * @package WPAL
 * @since 0.1.0
 */

/*
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *                                                         *
 *                       CONSTANTS                         *
 *                                                         *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */
define( 'WPAL_DIR', __DIR__ );
define( 'WPAL_SRC_DIR', WPAL_DIR . '/src' );


/*
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *                                                         *
 *                       INCLUDES                          *
 *                                                         *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */
require_once WPAL_SRC_DIR . '/class-autoloader.php';


/*
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *                                                         *
 *                         MAIN                            *
 *                                                         *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */

/**
 * Determine how to autoload a class for this plugin.
 *
 * @param string $class the name of the class to autoload.
 */
function wpal_autoload( $class ) {
	\WPAL\Autoloader::autoload_class( $class, WPAL_SRC_DIR );
}

spl_autoload_register( 'wpal_autoload' );
