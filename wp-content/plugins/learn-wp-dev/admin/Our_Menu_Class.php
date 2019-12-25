<?php
defined( 'ABSPATH' ) or die();

if ( ! class_exists( 'Our_Menu_Class' ) ):
	class Our_Menu_Class {

		public static function createMenu() {
			add_menu_page(
				'Our Page Title',
				__( 'Our Menu Title', 'learn-wp-dev' ),
				'administrator',
				'our_menu_slug',
				array( 'Our_Menu_Class', 'menuCallback' ),
				'dashicons-heart'
			);

			add_submenu_page( 'our_menu_slug',
				'Our Submenu',
				'Our Submenu Title',
				'administrator',
				'our_submenu_slug',
				array( 'Our_Menu_Class', 'menuCallback' ) );
		}

		public static function menuCallback() {
			wp_enqueue_script( 'learn-wp-ajax-js', plugins_url() . '/learn-wp-dev/admin/js/learn-wp-ajax.js', array( 'jquery' ) );
			wp_localize_script( 'learn-wp-ajax-js', 'LearnWPAjax', array( 'security' => wp_create_nonce( 'abc' ) ) );

			?>

            <h1><?php _e( 'Our first settings :)', 'learn-wp-dev' ) ?></h1>
            <form action="options.php" method="post">
				<?php
				//settings_fields( 'our-settings-group' );
				?>

                <input id="hide-admin" type="checkbox" name="our-first-option" class="hide-admin-cb"
                       value="yes" <?php checked( get_option( 'our-first-option' ), 'yes' ) ?>>
                <label for="hide-admin"><?php _e( 'Hide Admin Bar in Frontend?', 'learn-wp-dev' ) ?></label>

				<?php
				// We do not need a submit button because we listen for an ajax handler whenever the user clicks the checkbox
				//submit_button( 'Save' );
				?>

            </form>

			<?php
		}

		public static function registerSettings() {
			register_setting( 'our-settings-group', 'our-first-option' );
		}

		public static function addAdminBarMenu() {
			global $wp_admin_bar;

			$custom_menu = array(
				'id'     => 'demo_menu',
				'title'  => 'This is made from our first WP plugin',
				'parent' => 'top-secondary',
				'href'   => site_url()
			);

			$wp_admin_bar->add_node( $custom_menu );
		}


	}
endif;