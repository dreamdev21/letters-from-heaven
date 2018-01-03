<?php
/*
Plugin Name: Endurance PHP Edge
Description: Run the latest version of PHP available or select your version using the MOJO Marketplace Plugin.
Version: 0.2
Author: Mike Hansen
Author URI: https://www.mikehansen.me/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// Do not access file directly!
if ( ! defined( 'WPINC' ) ) { die; }

define( 'EPE_VERSION', 0.1 );

if ( ! class_exists( 'Endurance_PHP_Edge' ) ) {
	class Endurance_PHP_Edge {
		function __construct() {
			$this->hooks();
		}

		function hooks() {
			add_filter( 'mod_rewrite_rules', array( $this, 'htaccess_contents' ), 99 );
		}

		function htaccess_contents( $rules ) {
			if ( file_exists( '/opt/cpanel/ea-php70/root/usr/bin/php-cgi' ) ) {
				$default_handler = 'application/x-httpd-ea-php70';
			} else {
				$default_handler = 'application/x-httpd-php70';
			}

			$handler = get_option( 'epe_php_handler', $default_handler );
			$handler = 'AddHandler ' . $handler . ' .php' . "\n";
			return $handler . $rules;
		}
	}
	$ebc = new Endurance_PHP_Edge;
}
