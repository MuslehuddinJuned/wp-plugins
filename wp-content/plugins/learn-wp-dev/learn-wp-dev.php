<?php
/*
Plugin Name:    Learn to develop WP plugins
Plugin URI:     http://plugin-url.com
Description:    This is the most awesome demo plugin on planet earth
Version:        1.0.0
Author:         Author Name
Author URI:     http://author-link.com
Text Domain:    learn-wp-dev
Domain Path:    /languages
*/

// insert this line of code inside all of your files to prevent usage without WP core
defined( 'ABSPATH' ) or die();

if ( ! class_exists( 'LearnWPDev' ) ):

	final class LearnWPDev {

		private static $instance = null;

		/**
		 * LearnWPDev constructor.
		 */
		private function __construct() {
			$this->initializeHooks();
			$this->setupDatabase();
		}

		public static function getInstance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		private function initializeHooks() {
			if ( is_admin() ) {
				require_once( 'admin/admin.php' );
			}

			require_once( 'public/public.php' );

			add_action( 'plugins_loaded', array( 'LearnWPDev', 'loadTextDomain' ) );
		}

		private function setupDatabase() {
			require_once( 'admin/Our_Database.php' );

			register_activation_hook( __FILE__, array( 'Our_Database', 'createDatabaseTable' ) );

			add_action( 'wp_login', array( 'Our_Database', 'registerUserLogin' ), 10, 2 );
		}

		public static function loadTextDomain() {
			load_plugin_textdomain( 'learn-wp-dev', false, basename( dirname( __FILE__ ) ) . '/languages' );
		}
	}
endif;

LearnWPDev::getInstance();
