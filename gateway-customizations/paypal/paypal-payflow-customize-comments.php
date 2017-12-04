<?php
/**
 * Changes the PayPal comment data sent over.
 *
 * @param $post_data
 *
 * @return array
 */
function give_change_paypal_payflow_comments( $post_data ) {

	// Customize the comment 2 field with addition $_POST data.
	$comment2 = '';

	// Donor name.
	if ( isset( $_POST['give_first'] ) ) {
		$comment2 .= __( 'Donor Name:', 'give-paypal-pro' ) . ' ' . $_POST['give_first'] . ' ' . $_POST['give_last'] . ' ';
	}

	// Donor email.
	if ( isset( $_POST['give_email'] ) ) {
		$comment2 .= __( 'Donor Email:', 'give-paypal-pro' ) . ' ' . $_POST['give_email'] . ' ';
	}

	// Donation URL.
	if ( isset( $_POST['give-current-url'] ) ) {
		$comment2 .= __( 'Donation URL:', 'give-paypal-pro' ) . ' ' . $_POST['give-current-url'] . ' ';
	}

	// Important: set the info.
	$post_data['COMMENT2'] = $comment2;

	// Return to Give's PP gateway.
	return $post_data;


}

add_filter( 'give_paypal_payflow_post_data', 'give_change_paypal_payflow_comments', 10, 1 );