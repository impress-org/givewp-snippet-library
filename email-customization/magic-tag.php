<?php


/**
 * Adds a Custom "Magic" Tag
 * This function creates a custom Give email template tag
 *
 * @param $payment_id
 */
function rum_wohh_add_magic_tag( $payment_id ) {
	
	give_add_email_tag( 'wohh_magic_tag', 'This tag can be used to output conditional content in email notifications', 'rum_wohh_get_wohh_magic_tag_data' );
}
add_action( 'give_add_email_tags', 'rum_wohh_add_magic_tag' );




/**
 * Get Magic Tag Conditional Data
 * 
 * @description Example function that returns Custom field data if present, for any form ID
 * @param $payment_id
 *
 * @return string|void
 */
function rum_wohh_get_wohh_magic_tag_data( $payment_id ) {


	$form_id      = give_get_payment_form_id( $payment_id );
	$payment_meta = give_get_payment_meta( $payment_id );
	$meta_vals    = get_post_custom($payment_id);
	$output       = '';


	// Check if this payment's donation form ID matches the donation form we want custom email body copy
	if ( $form_id == '1650' ) {   // Online Donation form


		$donation_reason = '';


		// get the custom field data for this donation
		if ( isset($meta_vals['donation_reason']) ) {

			$donation_reason = $meta_vals['donation_reason'][0];
		}


		if ( $donation_reason != '' ) {

			$output = '<strong>Reason for Donation:</strong> ' . $donation_reason;
		}
	}





	// Check if this payment's donation form ID matches the donation form we want custom email body copy
	if ( $form_id == '1865' ) {   // Annual Memorial Walk Butterfly Campaign



		$in_memory_of = '';


		// get the custom field data for this donation
		if ( isset($meta_vals['my_donation_is_in_memory_of']) ) {

			$in_memory_of = $meta_vals['my_donation_is_in_memory_of'][0];
		}


		if ( $in_memory_of != '' ) {

			$output = '<strong>In Memory Of:</strong> ' . $in_memory_of;
		}
	}




	return $output;
}


