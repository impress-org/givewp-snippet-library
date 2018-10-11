<?php
/**
 * Customizes the PayPal Standard checkout page language.
 *
 * For locales see https://developer.paypal.com/docs/classic/api/locale_codes/
 *
 * @param array $paypal_args   Arguments used to build redirect query to PayPal.
 * @param array $donation_data Information about the donation.
 *
 * @return array Modified array of PayPal arguments.
 */
function give_customize_paypal_standard_checkout_language( $paypal_args, $payment_data ) {
	$paypal_args['lc'] = 'pt_BR';

	return $paypal_args;
}

add_filter( 'give_paypal_redirect_args', 'give_customize_paypal_standard_checkout_language', 99, 2 ); // Filter args for one-time donations.
add_filter( 'give_recurring_paypal_args', 'give_customize_paypal_standard_checkout_language', 99, 2 ); // Filter args for recurring donations.
