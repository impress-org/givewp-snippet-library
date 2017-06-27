<?php
/**
 * Force a different minimum donation amount and show an error if not met
 *
 * @param $valid_data
 * @param $posted
 */
function give_custom_min_donation_amount( $valid_data, $posted ) {
	if ( give_sanitize_amount( $posted['give-amount'] ) < 5 ) {
		give_set_error( 'donation_amount', __( 'The donation amount must be $5 or more. Please go back and select a specified amount or enter a larger donation amount.' ,'give' ) );
	}
}

add_action( 'give_checkout_error_checks', 'give_custom_min_donation_amount', 10, 2 );
