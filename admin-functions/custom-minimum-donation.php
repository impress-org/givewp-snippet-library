<?php 

/**
 *  Force a different minimum donation amount and show an error if not met
 */
 
 function check_donation_amount($valid_data, $posted) {
	if ($posted['give-amount'] < 5)
		give_set_error('donation_amount','The donation amount must be $5 or more. Please go back and select a specified amount or enter a larger donation amount.' ,'give');
}

add_action( 'give_checkout_error_checks', 'check_donation_amount', 10, 2 );