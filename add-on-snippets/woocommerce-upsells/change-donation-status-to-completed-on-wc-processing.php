<?php
/**
 * Change the donation status to complete if the WC Order status is "Processing".
 *
 * The default WC behavior for shippable products is to leave the order status as "Processing" until an admin ships it and manually marks it as "Completed".
 * But in most cases the card has already been charged, so the donation should be considered complete.
 * This snippet sends the donor and admin thank you emails out right away instead of waiting until the product ships and is marked "Completed" in WC.
 *
 * @param string    $wc_order_status WC Order status.
 * @param integer   $donation_id     Give Donation ID.
 * @param \WC_Order $wc_order        wc order.
 *
 * @return string
 */

add_filter( 'give_wc_sync_payment_status', 'give_wc_sync_payment_status_processing_to_completed', 20, 3 );
function give_wc_sync_payment_status_processing_to_completed( $wc_order_status, $donation_id, $wc_order ) {
	// get the original WC status again because Give smooshes 'pending', 'processing' and 'on-hold' into 'pending' before this hook in $wc_order_status
	$wc_original_status = $wc_order->get_status();

	if ( 'processing' === $wc_original_status ) {
		$wc_order_status = 'completed';
	}

	return $wc_order_status;
}
