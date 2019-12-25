<?php
defined( 'ABSPATH' ) or die();

/*
 * This file is only included when a backend page is loaded, e.g. if is_admin() returns true
 */

require_once( 'Our_Menu_Class.php' );

// register your custom settings
add_action( 'admin_init', array( 'Our_Menu_Class', 'registerSettings' ) );
// create the backend sidebar menu
add_action( 'admin_menu', array( 'Our_Menu_Class', 'createMenu' ) );
// create the custom menu in the admin bar
add_action( 'admin_bar_menu', array( 'Our_Menu_Class', 'addAdminBarMenu' ) );


/*
 * The hook "wp_ajax_{action_name}" will be called whenever wordpress receives an ajax request. action_name needs to be
 * replaced by your individual action name, which you find in learn-wp-ajax.js line 4
 *
 * Note that each ajax handler needs to terminate with either sending json_success, json_error or wp_die()!
 * What happens?
 * - If you terminate with json_error(), the client's javascipt file will jump into SUCCESS callback
 * (learn-wp-ajax.js line 13), which sounds weird, but the response passed to this callback will contain the
 * information of either you used wp_send_json_success() or wp_send_json_error()
 * - You will only get to the line 16 of file learn-wp-ajax.js, if the request timed out or for any reason the server
 * was not reachable
 */
function learn_wp_ajax_handler() {
	if ( check_ajax_referer( 'abc', 'security' ) ) {

		$current_option = get_option( 'our-first-option' );
		// toggle the states accordingly
		if ( false === $current_option || 'yes' !== $current_option ) {
			update_option( 'our-first-option', 'yes' );
		} else {
			update_option( 'our-first-option', 'no' );
		}

		wp_send_json_success();
	} else {
		// if someone tried to play a trick on this ajax handler, send back an error
		wp_send_json_error();
	}

	// this point will never be reached, but is essential for terminating correctly. If we would accidentally delete line 41, this would be used as "backup"
	wp_die();
}

add_action( 'wp_ajax_our-ajax-action-name', 'learn_wp_ajax_handler' );

/*
 * Filter gets called in each admin page request. IMPORTANT NOTE: return the filtered content, instead of directly printing it out!
 * The filter may be called a while before it actually will render its content to the webpage!
 */
function lwd_changeBackendFooterText( $text ) {
	return '<p style="color: red">It is time for your first plugin</p>' . $text;
}

add_filter( 'admin_footer_text', 'lwd_changeBackendFooterText' );