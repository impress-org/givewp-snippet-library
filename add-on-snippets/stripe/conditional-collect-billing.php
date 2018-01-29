<?php

/**
 *  Conditionally Remove Billing Fields
 *  Make sure the global Stripe setting to 
 *  collect Billing info is "enabled".
 *  Then add as many form IDs into the 
 *  $forms array as you need.
 *
 */
 
function my_remove_action($form_id) {
    $forms = array(110, 125, 170, 210);
	
	if ( in_array( $form_id, $forms ) ) {
		remove_action( 'give_after_cc_fields', 'give_default_cc_address_fields' );
	}
}

add_action('give_after_donation_levels','my_remove_action');