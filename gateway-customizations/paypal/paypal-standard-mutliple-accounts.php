<?php
/**
 * Multiple PayPal Standard Accounts
 *
 * Modify the paypal business email on a per form basis.
 * This allows you to create separate donation forms per paypal "business" aka nonprofit cause.
 * NOTE: this snippet does NOT support recurring donations.
 * ALSO NOTE: if you use this, in order for transactions to be marked as complete, you must disable
 *    the IPN verification step at Donations > Settings > Payment Gateways > PayPal Standard
 *
 * @param $paypal_args
 * @param $payment_data
 *
 * @return array $paypal_args
 */
function my_custom_multiple_paypal_accounts( $paypal_args, $payment_data ) {

	$form_id = isset( $payment_data['post_data']['give-form-id'] ) ? $payment_data['post_data']['give-form-id'] : '';

	// If this form is ID '144' then we customize the email for it.
	if('144' === $form_id ) {
		// Customize the email address for this form's email
		$paypal_args['business'] = 'mypaypal@email.com';
	}

	// Always return the paypal args.
	return $paypal_args;

}

add_filter( 'give_paypal_redirect_args', 'my_custom_multiple_paypal_accounts', 10, 2 );
add_filter( 'give_recurring_paypal_args', 'my_custom_multiple_paypal_accounts', 10, 2 );
