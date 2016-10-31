<?php
/**
 * WP WordPress.org API (https://codex.wordpress.org/WordPress.org_API)
 *
 * @package WP-WpOrgAPI-API
 */

/* Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) { exit; }

/* Check if class exists. */
if ( ! class_exists( 'WpOrgAPI' ) ) {

	/**
	 * WpOrgAPI class.
	 */
	class WpOrgAPI {

		/**
		 * URL to the API.
		 *
		 * @var string
		 */
		private $base_uri = 'https://api.wordpress.org';


		/**
		 * __construct function.
		 *
		 * @access public
		 * @return void
		 */
		public function __construct() {

		}

		/**
		 * Fetch the request from the API.
		 *
		 * @access private
		 * @param mixed $request Request URL.
		 * @return $body Body.
		 */
		private function fetch( $request ) {

			$response = wp_remote_get( $request );
			$code = wp_remote_retrieve_response_code( $response );

			if ( 200 !== $code ) {
				return new WP_Error( 'response-error', sprintf( __( 'Server response code: %d', 'text-domain' ), $code ) );
			}

			$body = wp_remote_retrieve_body( $response );

			return json_decode( $body );

		}

		/**
		 * get_stats_wp_versions function.
		 *
		 * @access public
		 * @return void
		 */
		public function get_stats_wp_versions() {

			$request = $this->base_uri . '/stats/wordpress/1.0/';

			return $this->fetch( $request );
		}

		/**
		 * get_stats_wp_php_versions function.
		 *
		 * @access public
		 * @return void
		 */
		public function get_stats_wp_php_versions() {

			$request = $this->base_uri . '/stats/php/1.0/';

			return $this->fetch( $request );
		}

		/**
		 * get_stats_wp_mysql_versions function.
		 *
		 * @access public
		 * @return void
		 */
		public function get_stats_wp_mysql_versions() {

			$request = $this->base_uri . '/stats/mysql/1.0/';

			return $this->fetch( $request );
		}

	}
}
