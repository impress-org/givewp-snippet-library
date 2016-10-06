<?php

/**
 * Require Last Name Snippet.
 *
 * Adds asterisk and error validation to the last name field of all Give forms.
 *
 * @param $required_fields
 * @param $form_id
 *
 * @return mixed
 */
function give_require_last_name( $required_fields, $form_id ) {

	$required_fields['give_last'] = array(
		'error_id'      => 'invalid_last_name',
		'error_message' => __( 'Please enter your last name', 'give' )
	);

	return $required_fields;
}

add_filter( 'give_purchase_form_required_fields', 'give_require_last_name', 10, 2 );
