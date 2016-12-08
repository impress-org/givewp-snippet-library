<?php
/**
 * Customize the "Pending" Offline donation notification subject for admins.
 *
 * Note: You can use template tags within the subject.
 *
 * @param $subject    The original subject
 * @param $payment_id The payment ID.
 *
 * @return string
 */
function my_custom_give_offline_pending_email_subject( $subject, $payment_id ) {

	$new_subject = __( 'Testing 123 {fullname}', 'give' );

	$admin_message = give_do_email_tags( $new_subject, $payment_id );

	return $admin_message;
}

add_filter( 'give_offline_admin_donation_notification_subject', 'my_custom_give_offline_pending_email_subject', 10, 2 );