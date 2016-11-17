<?php
/**
 * Prevent the donor notification email but keep the admin notification email functionality.
 *
 * @param $payment_id
 */
function my123_give_remove_donor_notification( $payment_id ) {
	remove_action( 'give_complete_donation', 'give_trigger_donation_receipt', 999, 1 );

	//Remove these lines to stop triggering the admin notification.
	$payment_data = give_get_payment_meta( $payment_id );

	if ( ! give_admin_notices_disabled( $payment_id ) ) {
		do_action( 'give_admin_donation_email', $payment_id, $payment_data );
	}

}

add_action( 'give_complete_donation', 'my123_give_remove_donor_notification', 1 );