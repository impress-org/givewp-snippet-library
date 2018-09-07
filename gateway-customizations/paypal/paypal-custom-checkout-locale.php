<?php
/**
 * Customizes the PayPal Standard checkout page language.
 *
 * For locales see https://developer.paypal.com/docs/classic/api/locale_codes/
 *
 * @param array $paypal_args   Params used to build redirect query to PayPal.
 * @param array $donation_data Information about the donation.
 *
 * @return mixed
 */
function give_customize_paypal_standard_checkout_language( $paypal_args, $payment_data ) {

	$paypal_args['lc'] = 'pt_BR';

	return $paypal_args;

}

add_filter( 'give_paypal_redirect_args', 'give_customize_paypal_standard_checkout_language', 99, 2 );
