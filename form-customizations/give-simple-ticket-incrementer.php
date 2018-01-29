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


add_action( 'give_after_donation_amount', 'give_tickets_form_add_incrementer' );

function give_tickets_form_add_incrementer( $form_id ) {

	// STEP 6: Set your form ID here
	$forms = array( 89, 88 );

	if ( in_array( $form_id, $forms ) ) {

		ob_start(); ?>

        <p id="give-ticket-wrap" class="form-row form-row-wide js-give-ticket-wrap">
            <label class="give-label" for="give-ticket-number">
                Number of tickets <span class="give-required-indicator">*</span>
                <span class="give-tooltip give-icon give-icon-question"
                      data-tooltip="Choose the number of tickets you would like."></span>
            </label>

            <input class="js-give-tickets give-input required" value="1" type="number" name="give_ticket_number"
                   id="give-ticket-number" required="" aria-required="true">
        </p>

        <script>

            jQuery(document).ready(function ($) {

                var wrapper = $('.js-give-ticket-wrap');
                var amount = $('.give-amount-top');
                var ticketAmt = $('.give-amount-top').val();
                var ticketInput = wrapper.find('.js-give-tickets');

                $(document).on('input', ticketInput, function () {
                    var dollars = parseFloat(ticketAmt);
                    var ticketValue = ticketInput.val();
                    amount.val(ticketValue * dollars).blur();
                })

            });

        </script>

		<?php
		$output = ob_get_clean();

		echo wp_kses_post( $output );
	}
}

function give_tickets_save_ticket_amount( $payment_id, $payment_data ) {

    if ( isset( $_POST['give_ticket_number'] ) ) {
		$ticket_amount = implode( "\n", array_map( 'sanitize_text_field', explode( "\n", $_POST['give_ticket_number'] ) ) );

		add_post_meta( $payment_id, 'give_ticket_number', $ticket_amount );
	}

}

add_action( 'give_insert_payment', 'give_tickets_save_ticket_amount', 10, 2 );

function give_tickets_ticket_amount_donation_meta( $payment_id ) {

	// Bounce out if no data for this transaction
	$give_ticket_amount = get_post_meta( $payment_id, 'give_ticket_number', true );

	if ( $give_ticket_amount ) : ?>
        <div id="give-donor-details" class="postbox">
            <h3 class="hndle">Ticket Information</h3>

            <div class="inside">

                <div class="ticket-amount">
                    <p>
                        <label><strong><?php esc_html_e( 'Ticket Amount:', 'give' ); ?></strong></label>
						<?php echo '<span>' . esc_html( $give_ticket_amount ) . '</span>'; ?>
                    </p>
                </div>

            </div>
            <!-- /.inside -->
        </div>

	<?php endif;
}

add_action( 'give_view_order_details_billing_before', 'give_tickets_ticket_amount_donation_meta', 10, 2 );
