<?php
defined( 'ABSPATH' ) or die();

if ( ! class_exists( 'Our_Database' ) ):
	class Our_Database {

		private static function getTableName() {
			global $wpdb;

			return $wpdb->prefix . 'learn_wp_db';
		}

		public static function setupDbTable() {
			global $wpdb;
			$table_name      = self::getTableName();
			$charset_collate = $wpdb->get_charset_collate();

			$sql = "CREATE TABLE $table_name (
				id int(11) NOT NULL AUTO_INCREMENT,
				user_id int(11) NOT NULL,
				user_name text NOT NULL,
				last_login datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
				PRIMARY KEY  (id)
				) $charset_collate";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );
		}

		/*
		 * This function gets called each time the plugin is activated. In your project you should also set some
		 * version number for this table to allow migration to newer database schema updates.
		 * See https://codex.wordpress.org/Creating_Tables_with_Plugins for more information to that
		 */
		public static function createDatabaseTable() {
			global $wpdb;

			// probably never reached code for your installation. In case you're using a WP Multisite, we need to setup
			// the table programmatically for each individual blog. This is what the further lines do.
			if ( function_exists( 'is_multisite' ) && is_multisite() ) {
				//check if it is network activation if so run the activation function for each id
				$old_blog = $wpdb->blogid;
				//Get all blog ids
				$blogids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );
				foreach ( $blogids as $blog_id ) {
					switch_to_blog( $blog_id );
					// Create database table for the current blog we "programmatically" are at the moment
					self::setupDbTable();
				}
				switch_to_blog( $old_blog );

				return;

			}

			// Create database table for our current installation (single site)
			self::setupDbTable();
		}

		/*
		 * This function gets called each time a user logs in. (hook defined in learn-wp-dev.php line 53)
		 *
		 * Navigate to your local database and check the table's content. Try with different users.
		 */
		public static function registerUserLogin( $user_login, $user ) {
			global $wpdb;

			$wpdb->insert( self::getTableName(), array(
				'user_id'    => $user->ID,
				'user_name'  => $user_login,
				'last_login' => current_time( 'mysql' )
			) );
		}

		/*
		 * Just for demonstration, how we can generate an URL with custom parameters, e.g.
		 * www.yourdomain.com/xyz?action=asdf&post=3&nonce=asdf
		 *
		 * The nonce can be verified in function deleteDatabaseEntry() to avoid usage of this function by non authroized people :-)
		 */
		function generateDeleteLink( $content ) {
			// add query args: action, post, nonce
			$url = add_query_arg(
				[
					'action' => 'delete_our_database_entry',
					'post'   => get_the_ID(),
					'nonce'  => wp_create_nonce( 'delete_db_entry_nonce' ),
				],
				home_url()
			);

			return $content . ' <a href="' . esc_url( $url ) . '">' . esc_html( 'Delete Post' ) . '</a>';
		}

		function deleteDatabaseEntry() {
			if ( isset( $_GET['action'] ) && isset( $_GET['nonce'] ) &&
			     $_GET['action'] === 'delete_our_database_entry' && wp_verify_nonce( $_GET['nonce'], 'delete_db_entry_nonce' )
			) {
				global $wpdb;
			}
		}

	}
endif;