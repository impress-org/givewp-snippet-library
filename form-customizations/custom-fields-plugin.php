<?php
/**
 * Plugin Name: Give Added Fields
 * Plugin URI: https://givewp.com/documentation/developers/how-to-create-custom-form-fields/
 * Description: This plugin adds custom fields to your Give Forms.
 * Version: 1.0
 * Author: The WordImpress Team
 * Author URI: https://givewp.com
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume 
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * NOTE: This is not a "snippet" but a plugin that you can install and activate. You can put it in a 
 * folder in your /plugins/ directory, or even just drop it directly into the /plugins/ directory
 * and it will activate like any other plugin.
 *
 * DISCLAIMER: This is provided as an EXAMPLE of how to do custom fields for Give. We provide no
 * guarantees if you put this on a live site. And we do not offer Support for this code at all.
 * It is simply a free resource for your purposes.
 */
 
/**
 * Custom Form Fields
 *
 * @param $form_id
 */
function give_donations_custom_form_fields( $form_id ) {

	// Only display for forms with the IDs "754" and "586";
	// Remove "If" statement to display on all forms
	// For a single form, use this instead:
	// if ( $form_id == 754) {
	
	$forms = array(754, 586);

	if ( in_array($form_id, $forms) ) {
		?>
		<div id="give-message-wrap">
			<label class="give-label" for="give-message"><?php _e( 'What should be engraved on the plaque?:', 'give' ); ?></label>
			<span class="give-tooltip icon icon-question" data-tooltip="<?php _e( 'Please provide the names that should be engraved on the plaque.', 'give' ) ?>"></span>
			<textarea class="give-textarea" name="give_message" id="give-message"></textarea>
		</div>
	<?php
	}//elseif ($form_id == $forms)
}

add_action( 'give_after_donation_levels', 'give_donations_custom_form_fields', 10, 1 );

/**
 * Validate Custom Field
 *
 * @description check for errors without custom fields
 *
 * @param $valid_data
 * @param $data
 */
function give_donations_validate_custom_fields( $valid_data, $data ) {

	// Only validate the form with the IDs "754" and "586";
	// Remove "If" statement to display on all forms
	// For a single form, use this instead:
	// if ( $form_id == 754) {
	
	$forms = array(754, 586);
	
	if (in_array($data['give-form-id'], $forms)) {
		
		return;
		
	}

	//Check for message data
	if ( empty( $data['give_message'] ) ) {
		
		give_set_error( 'give_message', __( 'Please tell us what you would like inscribed on the plaque.', 'give' ) );
		
	}
}

add_action( 'give_checkout_error_checks', 'give_donations_validate_custom_fields', 10, 2 );

/**
 * Add Field to Payment Meta
 *
 * @description store the custom field data in the payment meta
 *
 * @param $payment_meta
 *
 * @return mixed
 */
function give_donations_store_custom_fields( $payment_meta ) {
	
	$payment_meta['message'] = isset( $_POST['give_message'] ) ? implode( "n", array_map( 'sanitize_text_field', explode( "n", $_POST['give_message'] ) ) ) : '';

	return $payment_meta;
}

add_filter( 'give_payment_meta', 'give_donations_store_custom_fields' );

/**
 * Show Data in Transaction Details
 *
 * @description show the custom field(s) on the transaction page
 *
 * @param $payment_meta
 * @param $user_info
 */
function give_donations_purchase_details( $payment_meta, $user_info ) {

	//uncomment below to see payment_meta array
		// echo "<pre>";
		// var_dump($payment_meta);
		// echo "</pre>";

	//Bounce out if no data for this transaction
	if ( ! isset( $payment_meta['message'] ) ) {
		
		return;
		
	}

	?>
	
	<div class="message-data">
		<label><?php echo __( 'Message:', 'give' ); ?></label>
		<?php echo wpautop( $payment_meta['message'] ); ?>
	</div>

<?php
}

add_action( 'give_payment_personal_details_list', 'give_donations_purchase_details', 10, 2 );

/**
 * Adds a Custom "Engraved Message" Tag
 * @description: This function creates a custom Give email template tag
 *
 * @param $payment_id
 */
function my_custom_prefix_add_sample_referral_tag( $payment_id ) {
	
	give_add_email_tag( 'Engraved', 'This outputs the Engraved Message', 'my_custom_prefix_get_donation_referral_data' );
	
}

add_action( 'give_add_email_tags', 'my_custom_prefix_add_sample_referral_tag' );

/**
 * Get Donation Referral Data 
 * 
 * @description Example function that returns Custom field data if present in payment_meta; the example used here is in conjunction with the Give documentation tutorials
 * @param $payment_id
 *
 * @return string|void
 */
function my_custom_prefix_get_donation_referral_data( $payment_id, $payment_meta ) {
	
	$payment_meta = give_get_payment_meta( $payment_id );
	
	$output       = __( 'No referral data found.', 'give' );
	
	if ( ! empty( $payment_meta['message'] ) ) {
	
		$output = $payment_meta['message'];
	
	}

	return $output;
}