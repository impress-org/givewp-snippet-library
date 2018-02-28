<?php
/**
 * Adds a Custom "Magic" Tag
 * This function creates a custom Give email template tag
 *
 * @param array $email_tags List of email tags.
 *
 * @return array
 */
function rum_wohh_add_magic_tag( $email_tags ) {

	$new_email_tag = array(
		'tag'         => 'wohh_magic_tag',
		'description' => esc_html__( 'This tag can be used to output conditional content in email notifications.', 'give-snippet' ),
		'function'    => 'rum_wohh_get_wohh_magic_tag_data',
		'context'     => 'general', // Context can be general, donor, form or donation
	);

	array_push( $email_tags, $new_email_tag );

	return $email_tags;
}
add_filter( 'give_email_tags', 'rum_wohh_add_magic_tag' );

/**
 * Get Magic Tag Conditional Data
 *
 * Example function that returns Custom field data if present, for any form ID
 *
 * @param array $tag_args Email Tag Arguments.
 *
 * @return string
 */
function rum_wohh_get_wohh_magic_tag_data( $tag_args ) {

	switch ( true ) {
		case give_check_variable( $tag_args, 'isset', 0, 'payment_id' ):
			$payment    = new Give_Payment( $tag_args['payment_id'] );
			$payment_id = $payment->number;
			break;
	}

	$form_id      = give_get_payment_form_id( $payment_id );
	$payment_meta = give_get_payment_meta( $payment_id );
	$meta_values  = get_post_custom($payment_id);
	$output       = '';

	// Check if this payment's donation form ID matches the donation form we want custom email body copy
	if ( $form_id == '1650' ) {   // Online Donation form

		// get the custom field data for this donation.
		if ( ! empty( $meta_values['_give_payment_date'][0] ) ) {
			$output = sprintf(
				'<strong>Payment Date for Donation:</strong> %1$s',
				$meta_values['_give_payment_date'][0]
			);
		}
	}

	if ( $form_id === '1865' ) {   // Annual Memorial Walk Butterfly Campaign.

		if ( ! empty( $meta_values['my_donation_is_in_memory_of'][0] ) ) {

			$output = sprintf(
				'<strong>In Memory Of:</strong> %1$s',
				$meta_values['my_donation_is_in_memory_of'][0]
			);
		}
	}

	return $output;
}


