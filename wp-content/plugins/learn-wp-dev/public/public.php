<?php
defined( 'ABSPATH' ) or die();

/*
 * This file is required in each page rendering process.
 */

require_once( 'Lwd_Shortcodes.php' );

/*
 * Register our shortcodes here:
 */
add_shortcode( 'lwd_first_sc', array( 'Lwd_Shortcodes', 'executeFirstShortcode' ) );
add_shortcode( 'lwd_weather', array( 'Lwd_Shortcodes', 'executeWeatherShortcode' ) ); // display the weather to the user

/*
 * This function checks if the admin bar should be displayed in the frontend.
 * It will simply set an in-built function "__return_false" to the filter "show_admin_bar".
 * This function does the thing we would expect --> just returning false :-)
 */
function lwd_hideAdminBar() {
	$option = get_option( 'our-first-option' );

	if ( $option === "yes" ) {
		add_filter( 'show_admin_bar', '__return_false' );
	}
}

add_action( 'init', 'lwd_hideAdminBar' );