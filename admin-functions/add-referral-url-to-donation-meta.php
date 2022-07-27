<?php 
/**
 * Show Referral URL where the donation took place in the Donation Meta on the Donation Details screen
 *
 * @param $payment_id
 */
function freeaddons_donations_donation_details( $payment_id ) {

    $payment    = new Give_Payment( $payment_id );
    $payment_meta = $payment->get_meta();
    $referral_url = esc_url($payment_meta['_give_current_url']);

	if ( $referral_url ) : ?>

		<div id="give-engraving-message" class="give-admin-box-inside">
			<p><strong><?php esc_html_e( 'Referral URL:', 'give' ); ?></strong><br />
			<a href="<?php echo $referral_url; ?>" target="_blank" rel="noopener noreferrer"><?php echo $referral_url; ?></a>
		</div>

	<?php endif;

}

add_action( 'give_view_donation_details_payment_meta_after', 'freeaddons_donations_donation_details', 10, 1 );
