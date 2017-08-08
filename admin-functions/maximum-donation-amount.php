<?php
/**
 * Prevent donations from a certain amount from submission.
 *
 * @param $valid_data
 * @param $posted
 *
 * @return array $valid_data;
 */
function give_custom_max_donation_amount( $valid_data, $posted ) {

	// Customize the max amount here.
	$max_amount = 5000;

	if ( give_sanitize_amount( $posted['give-amount'] ) > $max_amount ) {
		give_set_error( 'max_donation_amount', sprintf( __( 'The donation amount must be %s or less. Please select a specified amount or enter a lower custom donation amount.', 'give' ), give_currency_filter( give_format_amount( $max_amount ) ) ) );
	}

	return $valid_data;

}

add_action( 'give_checkout_error_checks', 'give_custom_max_donation_amount', 10, 2 );
