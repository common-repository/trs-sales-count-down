<?php
/**
 * Plugin Name: TRS Sales Count Down
 * Plugin URI: http://vessno.com
 * Description: You can create sales count down with different available presets and styles.
 * Version: 1.0.1
 * Author: alishanvr
 * Author URI: https://www.vessno.com/
 * License: GPLv3 or later
 * Text Domain: trs
 * Domain Path: /languages/
 * Requires at least: 4.5
 * Requires PHP: 7.0
 * Copyright: 2020 All rights are reserved.
 *
 * GNU General Public License, Free Software Foundation <https://www.gnu.org/licenses/gpl-3.0.en.html>
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 *  @package TRS_Sales_Count_Down
 */

require_once 'vendor/autoload.php';

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'TRS_Sales_Count_Down' ) ) {
	/**
	 * The main class that will hook and init all the other files and classes.
	 * Class TRS_Sales_Count_Down
	 */
	final class TRS_Sales_Count_Down {

		/**
		 * The object of the class to implement Singleton methodology.
		 *
		 * @var null
		 */
		public static $object = null;

		/**
		 * The path of the plugin. It will useful at time of getting the plugin path or plugin url.
		 *
		 * @var null
		 */
		public static $plugin_path = null;

		/**
		 * The plugin file path.
		 *
		 * @var null
		 */
		public static $plugin_file_base = null;

		/**
		 * The version of the plugin.
		 *
		 * @var string
		 */
		public $plugin_version = '1.0.0';

		/**
		 * The main function that is responsible to initi the plugin and to include other useful files.
		 * TRS_Sales_Count_Down constructor.
		 */
		public function __construct() {
			// setting up constants.
			$this->set_constants();

			// checking and comparing dependencies.
			add_action( 'plugins_loaded', array( $this, 'check_dependency' ) );
			add_action( 'deactivate_trs_sales_count_down', array( $this, 'deactivate_plugin' ) );
			$this->load_files();
		}

		/**
		 * Load other required files, like for backend and for frontend.
		 *
		 * @since 1.0
		 */
		public function load_files() {
			require_once self::$plugin_path . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'class-trs-sales-count-down-frontend.php';
			require_once self::$plugin_path . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'class-trs-sales-count-down-backend.php';
		}

		/**
		 * Setting up some constants to use in the plugin.
		 *
		 * @since 1.0
		 */
		private function set_constants() {
			if ( ! defined( 'TRS_PLUGIN_NAME' ) ) {
				define( 'TRS_PLUGIN_NAME', 'TRS Sales Count Down' );
			}

			self::$plugin_path      = plugin_dir_path( __FILE__ );
			self::$plugin_file_base = plugin_basename( __FILE__ );
		}

		/**
		 * Checking dependencies.
		 *
		 * @since 1.0
		 */
		public function check_dependency() {
			if ( ! class_exists( 'WooCommerce' ) ) {
				add_action( 'admin_notices', array( $this, 'display_dependency_error' ) );
			}
		}

		/**
		 * Deactivate the plugin.
		 *
		 * @since 1.0
		 */
		public function deactivate_plugin() {
			deactivate_plugins( self::$plugin_path );
		}

		/**
		 * Displays dependency error.
		 *
		 * @since 1.0
		 */
		public function display_dependency_error() {
			$class   = 'notice notice-error';
			$message = __( 'TRS Sales Count Down needs <strong>WooCommerce</strong> to be installed and activated.<br />We have deactivated the plugin.', 'trs' );
			printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_attr( $message ) );

			do_action( 'deactivate_trs_sales_count_down' );
		}

		// ===============================================================================================================
		/**
		 * Cloning is forbidden.
		 *
		 * @since 2.1
		 */
		public function __clone() {
			_doing_it_wrong( __FUNCTION__, esc_attr( __( 'Cloning is forbidden.', 'trs' ) ), '1.0' );
		}

		/**
		 * Only store the object type to avoid serializing the data store instance.
		 *
		 * @return array
		 */
		public function __sleep() {
			return array( 'object_type' );
		}

		/**
		 * Un-serializing instances of this class is forbidden.
		 *
		 * @since 2.1
		 */
		public function __wakeup() {
			_doing_it_wrong( __FUNCTION__, esc_attr( __( 'Unserializing instances of this class is forbidden.', 'trs' ) ), '1.0' );
		}
	}

    new TRS_Sales_Count_Down();
}
