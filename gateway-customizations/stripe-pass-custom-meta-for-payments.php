<?php
/**
 * Pass custom field data to Stripe when payment is processed.
 *
 * Retrieves custom form field data from the $_POST variable and merges it into
 * the array that is passed to Stripe when a payment is made. Custom field data
 * can be found under Metadata in the Stripe payment details screen.
 *
 * @param array $charge_args Arguments passed to Stripe payment gateway.
 *
 * @return array
 */
function give_stripe_custom_payment_meta( $charge_args ) {

	// Sanitize the input posted data to the form.
	$posted_data = give_clean( filter_input_array( INPUT_POST ) );

	// Prepare metadata fields list.
	$custom_meta_fields = array(
		'Text Field'     => ! empty( $posted_data['text_field'] ) ? $posted_data['text_field'] : 'undefined',
		'Dropdown Field' => ! empty( $posted_data['dropdown_field'] ) ? $posted_data['dropdown_field'][0] : 'undefined',
		'Donor Comment'  => ! empty( $posted_data['give_comment'] ) ? $posted_data['give_comment'] : '',
	);
	$charge_args['metadata'] = array_merge( $charge_args['metadata'], $custom_meta_fields );

	return $charge_args;
}
add_filter( 'give_stripe_create_charge_args', 'give_stripe_custom_payment_meta', 10 );
