<?php
defined( 'ABSPATH' ) or die();

if ( ! class_exists( 'Lwd_Shortcodes' ) ):
	class Lwd_Shortcodes {

		/*
		 * Whenever wordpress renders your shortcode, this function gets called.
		 * IMPORTANT NOTE: Always RETURN the string which should be replaced with the shortcode, DO NOT print it directly!
		 */
		public static function executeFirstShortcode( $attr ) {
			wp_enqueue_script( 'my-js-id', plugins_url() . '/learn-wp-dev/public/js/my_js.js' );
			wp_enqueue_style( 'my-css-id', plugins_url() . '/learn-wp-dev/public/css/my_css.css' );

			$output_text = 'Hi everybody!';
			if ( isset( $attr['attribute'] ) ) {
				$output_text = $attr['attribute'];
			}

			return '<p class="our_demo_class" onclick="changeColor()" id="our_demo">You gave me: ' . $output_text . '</p>';
		}

		public static function executeWeatherShortcode( $attr ) {
			// "Berlin, DE"
			$city = esc_html( isset( $attr['city'] ) ? $attr['city'] : 'nyc,usa' );

			if ( ! isset( $attr['appid'] ) ) {
				return '<p>You need to feed me with a valid app id</p>';
			}

			$current_transient = get_transient( $city );
			if ( false === $current_transient ) {
				$appid = $attr['appid'];
				$url   = "http://api.openweathermap.org/data/2.5/weather?q=$city&appid=$appid";

				$response = wp_remote_get( $url );

				// returns 200
				$response_code = wp_remote_retrieve_response_code( $response );
				$body          = wp_remote_retrieve_body( $response );
				$weather_data  = json_decode( $body );

				if ( 200 !== $response_code || 200 !== $weather_data->cod ) {
					return '<p>There was an error</p>';
				}

				$header_text = '<h1>Weather data for ' . $weather_data->name . '</h1>';

				$weather_img = $weather_data->weather[0]->icon;
				$body_text   = "<img height=\"100\" width=\"100\" src=\"http://openweathermap.org/img/w/$weather_img.png\">";

				$weather_text = '<p>' . $weather_data->weather[0]->main . '</p>';

				set_transient( $city, $header_text . $body_text . $weather_text, 10 * 60 );

				return $header_text . $body_text . $weather_text;
			}

			return $current_transient;
		}

	}
endif;