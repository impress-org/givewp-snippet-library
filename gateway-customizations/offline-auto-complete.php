<?php
/**
 * Auto Approve Offline Donations
 *
 * If you would like to have donations skip the "pending" stage and auto-approve and set them to "complete" status.
 *
 * @param array $payment_data
 *
 * @return mixed
 */
function give_auto_approve_offline_donations( $payment_data ) {

	$gateway    = ! empty( $payment_data['gateway'] ) ? $payment_data['gateway'] : '';
	$gateway    = empty( $gateway ) && isset( $_POST['give-gateway'] ) ? give_clean( $_POST['give-gateway'] ) : $gateway;

	// Ensure gateway is set and check for offline gateway.
	if ( 'offline' === $gateway ) {
		$payment_data['status'] = 'publish';
	}

	// Always return $payment_data back.
	return $payment_data;

}

add_action( 'give_pre_insert_payment', 'give_auto_approve_offline_donations' );
