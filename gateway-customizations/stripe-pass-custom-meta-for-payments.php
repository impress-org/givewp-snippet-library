<?php
/**
 * Pass custom field data to Stripe when payment is processed.
 *
 * Retrieves custom form field data from the $_POST variable and merges it into
 * the array that is passed to Stripe when a payment is made. Custom field data
 * can be found under Metadata in the Stripe payment details screen.
 *
 * @param $charge_args   array Arguments passed to Stripe payment gateway.
 * @param $donation_data array Data associated with the current donation.
 *
 * @return array
 */
function give_stripe_custom_payment_meta( $charge_args, $donation_data ) {
	$custom_meta_fields = array(
		'Text Field' => ! empty( $_POST['text_field'] ) ? $_POST['text_field'] : 'undefined',
		'Dropdown Field' => ! empty( $_POST['dropdown_field'] ) ? $_POST['dropdown_field'][0] : 'undefined',
	);
	$charge_args['metadata'] = array_merge( $charge_args['metadata'], $custom_meta_fields );

	return $charge_args;
}
add_filter( 'give_stripe_create_charge_args', 'give_stripe_custom_payment_meta', 10, 2 );
