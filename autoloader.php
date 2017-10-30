<?php
/**
 * Plugin Name: WP Auto Loader
 * Plugin URI: http://wordpress.org/plugins/wpal
 * Description: A PHP Class Namespace auto loader to help modernize your code.
 * Author: awoods
 * Author URI: http://andrewwoods.net
 * Text Domain: wpal
 * Domain Path: /languages
 * Version: 0.1.0
 *
 * @package WPAL
 */

$mu_plugins_dir = plugin_dir_path( __FILE__ );

require_once $mu_plugins_dir . 'wpal/wpal.php';

