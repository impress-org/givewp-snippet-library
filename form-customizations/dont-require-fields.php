<?php

/**
 * Don't required certain fields.
 *
 * Removes field requirements by unsetting them to the array passed.
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

add_filter( 'give_purchase_form_required_fields', 'give_dont_require_fields', 10, 2 );
