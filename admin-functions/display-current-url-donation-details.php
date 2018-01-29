<?php
/**
 * Display the Current URL of the Donation Form from which the donation was submitted from.
 *
 * @param int $payment_id
 */
function my_give_customer_display_current_url( $payment_id ) {

	// Bounce out if no data for this transaction
	$current_url = get_post_meta( $payment_id, '_give_current_url', true );

	if ( $current_url ) : ?>

		<p>
			<strong>URL of Donation Submission:</strong><br>
			<a href="<?php echo esc_url( $current_url ); ?>"><?php echo esc_url( $current_url ); ?></a>
		</p>

	<?php endif;

}

add_action( 'give_payment_view_details', 'my_give_customer_display_current_url', 10, 2 );
