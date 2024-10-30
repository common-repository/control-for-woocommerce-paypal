<?php
/**
 * Log wrapper around WC_Logger
 *
 * @category  Integration
 * @author    Norman Sue <norman@getcontrol.co>
 * @copyright 2014-2016 Control Mobile Inc.
 * @license   GNU General Public License, version 2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WC_Integration_Control_Logger' ) ) :

/**
 * WC_Integration_Control_Logger
 *
 * Logger wrapper class around the WooCommerce WC_Logger class.
 * Logging is only enabled when the WP_DEBUG variable is set to true.
 *
 */
class WC_Integration_Control_Logger {

	/**
	 * __construct
	 * @uses   WC_Logger
	 * @return void
	 */
	public function __construct() {
		$this->logger     = new WC_Logger();
		$this->log_handle = 'control-paypal-ipn';
	}

	/**
	 * Check if debug logging is enabled.
	 * @return boolean
	 */
	public function is_wp_debug_enabled() {
		if ( defined( 'WP_DEBUG' ) && true === WP_DEBUG ) {
			return true;
		}
		return false;
	}

	/**
	 * Log the message.
	 * @param string $message Log message.
	 * @return void
	 */
	public function write( $message ) {
		if ( $this->is_wp_debug_enabled() ) {
			$this->logger->add( $this->log_handle, $message );
		}
	}

}

endif;
