<?php

/**
 * Don't require certain fields.
 *
 * Removes field requirements by unsetting them to the array passed. 
 * In this sample, the "State/Province" field is the one being targeted.
 * Find a list of required standard fields here: https://github.com/WordImpress/Give/blob/0907fe1a00419b68b793534b515f67d6f6401296/includes/process-purchase.php#L361
 *
 * @param $required_fields
 * @param $form_id
 *
 * @return array
 */
function give_dont_require_fields( $required_fields, $form_id ) {

	if(isset($required_fields['card_state'])) {
		unset($required_fields['card_state']);
	}

	return $required_fields;
}

add_filter( 'give_donation_form_required_fields', 'give_dont_require_fields', 10, 2 );
