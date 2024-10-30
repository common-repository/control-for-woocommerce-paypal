=== Real-time Updates for PayPal Analytics ===

Contributors: controlnorman
Tags: woocommerce, integration, control, payments, paypal, ipn, analytics, notifications, push notifications, mobile, ios, android, alerts
Requires at least: 3.9
Tested up to: 4.6
Stable tag: 1.0.2
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Receive PayPal analytics in real-time to your Control account via WooCommerce. Get alerts to your iOS and Android devices, when key events occur.

== Description ==

Control’s Real-time Updates for PayPal Analytics forwards PayPal Instant Payment Notifications (IPN) messages to the Control app because PayPal only permits one IPN endpoint per account and it is overridden by WooCommerce. To keep your data up-to-date and receive push notifications in the Control app, you need to install this plugin. 

= About Control =

**One Source of Information**

- Connects to both PayPal and Stripe. 
- Stop switching between dashboards, exporting spreadsheets, and manually calculating your key business metrics.
- No integration or coding work required; your business intelligence is within 1 click.

**Be Informed**

- Whether your business is eCommerce, subscription-based, or SaaS, Control provides key Stripe and PayPal analytics tailored for your business type.
- From understanding your customers: average order value (AOV) to life-time value (LTV), to growing your business: monthly recurring revenue (MRR) to Churn, we’ll help you reach your goals.

**React Faster with Real-Time Intelligence**

- Control delivers your Stripe and PayPal fraud alerts and payments analytics directly to your device.
- Retry, refund, and create charges; block credit cards directly from your phone.
- Specific sound are associated with key alerts, so you know if you have new sales, new customers, potential fraud, or money coming your way by way of new transfers.

[Visit the homepage](http://getcontrol.co)

[Download on the iOS app](https://itunes.apple.com/us/app/control-alerts-analytics-for/id558387939)

[Download the Android app](https://play.google.com/store/apps/details?id=co.getcontrol.paypal)

[Sign up for the web app](https://controlboard.getcontrol.co)

[Support](https://www.getcontrol.co/knowledge-base/)

== Installation ==

1. Create a new Control account or log in to an existing Control account on any of our [Web app](https://controlboard.getcontrol.co), [iOS app](https://itunes.apple.com/us/app/control-alerts-analytics-for/id558387939), or [Android app](https://play.google.com/store/apps/details?id=co.getcontrol.paypal).
2. Connect your PayPal account to Control by following [these instructions for web](https://www.getcontrol.co/knowledge-base/connect-stripe-and-paypal-accounts/) and [these instructions for mobile](https://www.getcontrol.co/knowledge-base/connect-stripe-paypal-accounts-mobile-app/).
3. Check your email inbox for a message containing your Control PayPal IPN notification URL.
4. Upload the `woocommerce-integration-control-paypal-ipn` folder to your plugins directory (e.g. `/wp-content/plugins/`).
5. Activate the plugin through the 'Plugins' menu in WordPress.
6. In the WordPress admin dashboard:
    - Click the **WooCommerce > Settings** link.
    - Click the **Integration** tab.
    - Enter your Control PayPal IPN notification url (which you should have received by email) into the text box.
    - Click the **Save changes** button.

Contact [support@getcontrol.co](mailto:support@getcontrol.co) if you need additional help.

== Frequently Asked Questions ==
 
= I don't know what my Notification URL is =

Contact [support@getcontrol.co](mailto:support@getcontrol.co) and we can send you your notification URL again.

= I have a question about the Control app =

Visit our [support page](https://www.getcontrol.co/knowledge-base/) for answers to many more frequently asked questions.

== Screenshots ==

1. WooCommerce integration settings page.
 
== Changelog ==

= 1.0.0 =
* Initial release

= 1.0.1 =
* Minor description changes

= 1.0.2 =
* Fix version numbering
