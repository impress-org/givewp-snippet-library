<?php

/**
 *  Plugin Name: Give Simple Ticket Incrementer
 *  Author: GiveWP.com
 *  Description: A simple functionality plugin (not supported) to increment donation amounts based on a number input field. Ideal for simple ticket sales. This is provided as an example plugin, it is not officially supported by GiveWP.com in any way and we are not liable for how it impacts your site in any way.
 */

/**
 *  HOW TO USE:
 *  1. Install like a normal plugin
 *  2. Create a form that has a Set Donation (not multi-level)
 *  3. Set the donation amount to your ticket price for ONE ticket
 *  4. Enable the Custom Amount option.
 *  5. Set any other settings you like for this form and hit publish.
 *  6. Get the FORM ID of that form and enter it into the "array()" in line 26 below. Multiple forms can be entered separated by a comma like in the example below.
 *  7. Now your form will have a number field below the top amount, and as you increase the number the total donation amount will increase according to your Set Donation amount.
 */

/**
 * This function will add number of tickets field to donation form.
 *
 * @param int   $form_id Donation Form ID.
 * @param array $args    List of arguments.
 */
function give_tickets_form_add_incrementer( $form_id, $args ) {

	$id_prefix = ! empty( $args['id_prefix'] ) ? $args['id_prefix'] : 0;

	// STEP 6: Set your form ID here
	$forms = array( 3099 );

	if ( in_array( $form_id, $forms, true ) ) {

		ob_start(); ?>

		<p id="give-ticket-wrap-<?php echo $id_prefix;?>" class="form-row form-row-wide js-give-ticket-wrap">
			<label class="give-label" for="give-ticket-number">
				Number of tickets <span class="give-required-indicator">*</span>
				<span class="give-tooltip give-icon give-icon-question"
						data-tooltip="Choose the number of tickets you would like."></span>
			</label>

			<input class="js-give-tickets give-input required" value="1" type="number" name="give_ticket_number"
					id="give-ticket-number-<?php echo $id_prefix;?>" required="" aria-required="true">
		</p>

		<script>

			jQuery( document ).ready( function( $ ) {

				var giveFormWrap      = $( '.give-form-wrap' );
				var idPrefix          = '<?php echo $id_prefix;?>';
				var giveFormElement   = giveFormWrap.find( '#give-form-' + idPrefix );
				var ticketWrapper     = giveFormElement.find( '.js-give-ticket-wrap' );
				var donationTotalWrap = giveFormElement.find( '.give-final-total-amount' );
				var ticketAmount      = giveFormElement.find( '.give-amount-top' ).val();
				var ticketInput       = ticketWrapper.find( 'input[name="give_ticket_number"]' );

				ticketInput.on( 'change', function() {
					var ticketCount     = $( this ).val();
					var donationTotal   = ticketCount * parseFloat( ticketAmount );
					var formattedAmount = Give.fn.formatCurrency( donationTotal, {}, giveFormElement );
					donationTotalWrap.attr( 'data-total', formattedAmount ).text( Give.fn.getGlobal().currency_sign + formattedAmount );
				})

			});

		</script>

		<?php
		$output = ob_get_clean();

		echo $output;
	}
}
add_action( 'give_after_donation_amount', 'give_tickets_form_add_incrementer', 10, 2 );

/**
 * This function will be used to add number of tickets field to donation receipt.
 *
 * @param array $give_receipt_args List of donation receipt fields.
 * @param int   $donation_id Donation ID.
 * @param int   $form_id     Donation Form ID.
 *
 * @return array
 */
function give_tickets_add_field_to_donation_receipt( $give_receipt_args, $donation_id, $form_id ) {

	// STEP 6: Set your form ID here
	$forms = array( 3099 );

	if ( in_array( (int)$form_id, $forms, true ) ) {
		$give_receipt_args['give_tickets_count'] = array(
			'name'    => __( 'No. of Tickets', 'give' ),
			'value'   => Give()->payment_meta->get_meta( $donation_id, 'give_ticket_number', true ),
			'display' => true,
		);
	}

	return $give_receipt_args;
}
add_filter( 'give_donation_receipt_args', 'give_tickets_add_field_to_donation_receipt', 10, 3 );

/**
 * This function will save the number of tickets value to DB.
 *
 * @param int   $donation_id Donation ID.
 */
function give_tickets_save_ticket_amount( $donation_id ) {

	$post_data = give_clean( $_POST );

	if ( isset( $post_data['give_ticket_number'] ) ) {
		$ticket_amount = $post_data['give_ticket_number'];

		Give()->payment_meta->add_meta( $donation_id, 'give_ticket_number', $ticket_amount );
	}
}
add_action( 'give_insert_payment', 'give_tickets_save_ticket_amount', 10, 1 );

/**
 * This function will update the donation amount based on the number of tickets selected.
 *
 * @param array $donation_data List of donation data.
 *
 * @return array
 */
function give_tickets_update_ticket_amount( $donation_data ) {

	$donation_data['price'] = $donation_data['price'] * $donation_data['post_data']['give_ticket_number'];

	return $donation_data;
}

add_filter( 'give_donation_data_before_gateway', 'give_tickets_update_ticket_amount', 10, 1 );

/**
 * This function will display the number of tickets data in admin.
 *
 * @param int $donation_id Donation ID.
 */
function give_tickets_ticket_amount_donation_meta( $donation_id ) {

	// Bounce out if no data for this transaction
	$no_of_tickets = Give()->payment_meta->get_meta( $donation_id, 'give_ticket_number', true );

	if ( $no_of_tickets ) : ?>
		<div id="give-donor-details" class="postbox">
			<h3 class="hndle">Ticket Information</h3>

			<div class="inside">

				<div class="ticket-amount">
					<p>
						<label><strong><?php esc_html_e( 'No. of Tickets:', 'give' ); ?></strong></label>
						<?php echo '<span>' . esc_html( $no_of_tickets ) . '</span>'; ?>
					</p>
				</div>

			</div>
			<!-- /.inside -->
		</div>

	<?php endif;
}
add_action( 'give_view_donation_details_billing_before', 'give_tickets_ticket_amount_donation_meta', 10, 2 );
