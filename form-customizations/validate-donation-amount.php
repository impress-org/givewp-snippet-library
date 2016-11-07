<?php
/**
 * Validation donation amount. Note: Give handles validation minimum amount out-of-the-box.
 *
 * Check that a donation is above or below a maximum amount.
 *
 * @param $valid_data
 * @param $data
 */
function give_donations_validate_donation_amount( $valid_data, $data ) {
	// Only validate the form with the IDs "754" and "586";
	// Remove "If" statement to validation for all forms
	// For a single form, use this instead:

//	$forms = array( 1425 );
//	if ( ! in_array( $data['give-form-id'], $forms ) ) {
//		return;
//	}

	$sanitized_amount = (int) give_sanitize_amount( $data['give-amount'] );
	$max_amount       = 1000;

	//Check for message data
	if ( $sanitized_amount >= $max_amount ) {
		give_set_error( 'give_message', sprintf( __( 'Sorry, we can\'t accept donations more than %s.', 'give' ), give_currency_filter( give_format_amount( $max_amount ) ) ) );
	}

}

add_action( 'give_checkout_error_checks', 'give_donations_validate_donation_amount', 10, 2 );