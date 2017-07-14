<?php
/**
 * Customize the Gateway Labels
 *
 * This function uses the `give_payment_gateways` library and adjusts
 * the label that appears for the donor on the frontend donation forms. This will affect ALL donation forms.
 * The 'admin_label' will affect the backend of the site, while the 'checkout_label' will affect the donor-facing labels
 *
 * Note: only use the 4 lines following the commented line for the gateway labels you wish to modify.
 * You may safely delete the rest. We strongly recommend testing this code before use on production sites.
 *
 * @param $gateways
 *
 * @return mixed
 */
function my_custom_gateway_labels( $gateways ) {
	// add the following 4 lines to change the label for Offline Donations
	$gateways['offline'] = array(
		'admin_label'    => 'Offline Donation',
		'checkout_label' => __( 'Mail a Check', 'give' ),
	);

	// add the following 4 lines to change the label for PayPal Standard
	$gateways['paypal'] = array(
		'admin_label'    => 'PayPal Standard',
		'checkout_label' => __( 'Credit/Debit Card or PayPal', 'give' ),
	);

	// add the following 4 lines to change the label for PayPal Payflow.
	$gateways['paypalpro_payflow'] = array(
		'admin_label'    => 'PayPal Payflow',
		'checkout_label' => __( 'PayPal Payflow', 'give' ),
	);

	// add the following 4 lines to change the label for Stripe
	$gateways['stripe'] = array(
		'admin_label'    => 'Stripe',
		'checkout_label' => __( 'Credit Card (Stripe)', 'give' ),
	);

	// add the following 4 lines to change the label for Stripe's ability to do ACH bank account transfers via Plaid
	$gateways['stripe_ach'] = array(
		'admin_label'    => 'Stripe (ACH via Plaid)',
		'checkout_label' => __( 'Donate from a bank account', 'give' ),
	);

	// add the following 4 lines to change the label for Braintree
	$gateways['braintree'] = array(
		'admin_label'    => 'Braintree',
		'checkout_label' => __( 'Credit Card (Braintree)', 'give' ),
	);

	// add the following 4 lines to change the label for Dwolla
	$gateways['dwolla'] = array(
		'admin_label'    => 'Dwolla',
		'checkout_label' => __( 'Dwolla Account', 'give' ),
	);

	// add the following 4 lines to change the label for Authorize.net
	$gateways['authorize'] = array(
		'admin_label'    => 'Authorize.net',
		'checkout_label' => __( 'Credit Card (Authorize.net)', 'give' ),
	);

	// add the following 4 lines to change the label for Paymill
	$gateways['paymill'] = array(
		'admin_label'    => 'Paymill',
		'checkout_label' => __( 'Credit Card (Paymill)', 'give' ),
	);

	// add the following 4 lines to change the label for 2Checkout
	$gateways['twocheckout'] = array(
		'admin_label'    => '2Checkout',
		'checkout_label' => __( 'Credit Card (2Checkout)', 'give' ),
	);

	// add the following 4 lines to change the label for WePay
	$gateways['wepay'] = array(
		'admin_label'    => 'WePay',
		'checkout_label' => __( 'Credit Card (WePay)', 'give' ),
	);

	return $gateways;
}

add_filter( 'give_payment_gateways', 'my_custom_gateway_labels', 10 );
