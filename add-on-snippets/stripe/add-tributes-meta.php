<?php
/**
 * This function will add tributes meta to stripe metadata.
 *
 * @param array $charge_args Charge Arguments.
 *
 * @return mixed
 */
function give_stripe_custom_payment_meta( $charge_args ) {

	$donation_id = $charge_args['metadata']['Donation Post ID'];

	$tribute_text       = Give()->payment_meta->get_meta( $donation_id, '_give_tributes_type', true );
	$tribute_first_name = Give()->payment_meta->get_meta( $donation_id, '_give_tributes_first_name', true );
	$tribute_last_name  = Give()->payment_meta->get_meta( $donation_id, '_give_tributes_last_name', true );

	$custom_meta_fields = array(
		$tribute_text => "{$tribute_first_name} {$tribute_last_name}",
	);

	$charge_args['metadata'] = array_merge( $charge_args['metadata'], $custom_meta_fields );

	return $charge_args;
}

add_filter( 'give_stripe_create_charge_args', 'give_stripe_custom_payment_meta', 10, 2 );
