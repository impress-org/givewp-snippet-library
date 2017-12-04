<?php
/**
 * Customize the PayPal Cancel Redirect URL.
 *
 * Be default when using PayPal standard when a donor clicks to PayPal and then clicks cancel return to the website it takes you to a Transaction Failed page instead of the donation page. This will redirect back to donation page when the donor cancels.
 *
 * Please note: when using this redirect payments won't be marked as "Failed" when a donor clicks the cancel option in PayPal. They will be left in a "pending" status until being marked as "abandoned" at the 7 day mark. Not a big deal for most, but it's worth mentioning.
 *
 * @see: https://wordpress.org/support/topic/paypal-back-to-website-url/
 *
 * @param array $paypal_args   Params used to build redirect query to PayPal.
 * @param array $donation_data Information about the donation.
 *
 * @return mixed
 */
function give_customize_paypal_failed_redirect( $paypal_args, $donation_data ) {

	$cancel_url = add_query_arg( array(
		'payment-mode' => 'paypal',
	), give_get_current_page_url() );

	if ( isset( $paypal_args['cancel_return'] ) ) {
		$paypal_args['cancel_return'] = $cancel_url;
	}

	return $paypal_args;

}

add_filter( 'give_paypal_redirect_args', 'give_customize_paypal_failed_redirect', 10, 2 );