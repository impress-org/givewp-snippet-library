<?php
/**
 * Keep the gateway active in the backend but hide it on the frontend.
 *
 * @param array $gateway_list
 * @param int   $form_id
 *
 * @return array $gateways
 */
function give_hide_stripe_frontend( $gateway_list, $form_id ) {

	if ( isset( $gateway_list['stripe'] ) ) {
		unset( $gateway_list['stripe'] );
	}

	return $gateway_list;
}

add_filter( 'give_enabled_payment_gateways', 'give_hide_stripe_frontend', 10, 2 );