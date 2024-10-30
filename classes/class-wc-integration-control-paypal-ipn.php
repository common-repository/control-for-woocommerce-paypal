<?php
/**
 * Control PayPal IPN Integration.
 *
 * @category  Integration
 * @author    Norman Sue <norman@getcontrol.co>
 * @copyright 2014-2016 Control Mobile Inc.
 * @license   GNU General Public License, version 2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WC_Integration_Control_Paypal_IPN_Integration' ) ) :

/**
 * Validates and saves the Control PayPal IPN URL to forward IPNs to,
 * and the callback for making the remote POST to the Control API.
 */
class WC_Integration_Control_Paypal_IPN_Integration extends WC_Integration {

	/**
	 * Initialize and hook in this integration.
	 * @uses WC_Integration_Control_Logger
	 */
	public function __construct() {
		global $woocommerce;

		$this->id                 = 'control-paypal-ipn';
		$this->method_title       = __( 'Control for WooCommerce PayPal', 'woocommerce-integration-control-paypal-ipn' );
		$this->method_description = __( 'To receive Control real-time alerts for PayPal orders made from this WooCommerce store, enter your Control PayPal notification URL which you would have received via email. It should look similar to https://service.getcontrol.co/webhook/paypal/ipn/arAPn3QN8dQViYReRa. Contact <a href="mailto:support@getcontrol.co" target="_blank">support@getcontrol.co</a> if you need help.', 'woocommerce-integration-control-paypal-ipn' );

		// Load the settings.
		$this->init_form_fields();
		$this->init_settings();

		// Define user set variables.
		$this->ipn_url = $this->get_option( 'ipn_url' );

		// Initialize logger.
		$this->logger = new WC_Integration_Control_Logger();

		// Actions.
		add_action( 'woocommerce_update_options_integration_' . $this->id, array( $this, 'process_admin_options' ) );
		add_action( 'valid-paypal-standard-ipn-request', array( $this, 'forward_paypal_ipn' ), 0 );

		// Filters.
		add_filter( 'woocommerce_settings_api_sanitized_fields_' . $this->id, array( $this, 'sanitize_settings' ) );
	}

	/**
	 * Debug logging helper method.
	 * @param string $message Message to log.
	 * @return void
	 */
	public function log( $message ) {
		$this->logger->write( $message );
	}

	/**
	 * Initialize the settings form fields in the admin page.
	 * @return void
	 */
	public function init_form_fields() {
		$this->form_fields = array(
			'ipn_url' => array(
				'title'             => __( 'Notification URL', 'woocommerce-integration-control-paypal-ipn' ),
				'type'              => 'text',
				'description'       => __( 'Your Control PayPal instant payment notification URL which you would have received via email.', 'woocommerce-integration-control-paypal-ipn' ),
				'desc_tip'          => true,
				'default'           => '',
			),
		);
	}

	/**
	 * Santize the settings from the admin page.
	 * @see    process_admin_options()
	 * @param  array $settings Array for the single database entry containing all settings for this integration plugin.
	 * @return array
	 */
	public function sanitize_settings( $settings ) {
		if ( isset( $settings['ipn_url'] ) ) {
			$settings['ipn_url'] = esc_url_raw( $settings['ipn_url'], array( 'https' ) );
			$this->log( "Saving ipn_url ${settings['ipn_url']}" );
		}

		return $settings;
	}

	/**
	 * Validate the Control PayPal IPN URL.
	 * @see    validate_settings_fields()
	 * @param  mixed $key
	 * @return string Validated IPN URL field.
	 */
	public function validate_ipn_url_field( $key ) {
		$posted_ipn_url = $_POST[ $this->plugin_id . $this->id . '_' . $key ];

		if ( isset( $posted_ipn_url ) &&
			! preg_match( '|^https://.*/webhook/paypal/ipn/.*$|i', $posted_ipn_url ) ) {
			$this->errors[] = __( 'Please check that your Control IPN URL starts with https://service.getcontrol.co/webhook/paypal/ipn/', 'woocommerce-integration-control-paypal-ipn' );
		}

		return $posted_ipn_url;
	}

	/**
	 * Display errors by overriding the `display_errors()` method.
	 * @see    display_errors()
	 * @return void
	 */
	public function display_errors() {
		foreach ( $this->errors as $error ) {
			?>
			<div class="error">
				<p><?php echo $error; ?></p>
			</div>
			<?php
		}
	}

	/**
	 * Forward an incoming PayPal IPN to the Control API at the saved `$this->ipn_url` endpoint.
	 * @param  array $ipn Raw IPN received from PayPal by WooCommerce.
	 * @return void
	 */
	public function forward_paypal_ipn( $ipn ) {
		if ( '' === $this->ipn_url ) {
			return;
		}

		$response = wp_remote_post( $this->ipn_url, array( 'body' => $ipn ) );

		if ( is_wp_error( $response ) ) {
			$this->log( "IPN forward error " . $response->get_error_message() . print_r( $response, true ) );
		} elseif ( isset( $response['response']['code'] ) && 200 !== $response['response']['code'] ) {
			$this->log( "IPN forward not OK " . print_r( $response, true ) );
		}
	}

}

endif;
