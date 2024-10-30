<?php
/**
 * Plugin Name: Control for WooCommerce PayPal
 * Plugin URI:  https://www.getcontrol.co
 * Description: WooCommerce plugin for forwarding PayPal instant payment notifications (IPNs) to Control for sending real-time mobile payment alerts.
 * Version:     1.0.0
 * Author:      Control
 * Author URI:  https://www.getcontrol.co
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 * Control for WooCommerce PayPal is free software: you can redistribute
 * it and/or modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation, either version 2 of the
 * License, or any later version.
 *
 * Control for WooCommerce PayPal is distributed in the hope that it will
 * be useful, but WITHOUT ANY WARRANTY; without even the implied warranty
 * of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Control for WooCommerce PayPal. If not, see
 * https://www.gnu.org/licenses/gpl-2.0.html
 *
 * @category  Integration
 * @author    Norman Sue <norman@getcontrol.co>
 * @copyright 2014-2016 Control Mobile Inc.
 * @license   GNU General Public License, version 2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WC_Integration_Control_Paypal_IPN' ) ) :

/**
 * WC_Integration_Control_Paypal_IPN
 *
 */
class WC_Integration_Control_Paypal_IPN {

	/**
	 * Initialize this integration plugin.
	 * @return void
	 */
	public function __construct() {
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}

	/**
	 * If WooCommerce is installed, initalize the inetegration classes
	 * and register the integration.
	 * @return void
	 */
	public function init() {

		if ( class_exists( 'WC_Integration' ) ) {
			require_once 'classes/class-wc-integration-control-paypal-ipn.php';
			require_once 'classes/class-wc-integration-control-logger.php';

			// Register the integration
			add_filter( 'woocommerce_integrations', array( $this, 'add_integration' ) );
		}
	}

	/**
	 * Add a new integration to WooCommerce.
	 * @param  array $integrations Array of existing WooCommerce integrations.
	 * @return array $integrations Updated Array of WooCommerce integrations.
	 */
	public function add_integration( $integrations ) {
		$integrations[] = 'WC_Integration_Control_Paypal_IPN_Integration';
		return $integrations;
	}

}

$WC_Integration_Control_Paypal_IPN = new WC_Integration_Control_Paypal_IPN( __FILE__ );

endif;
