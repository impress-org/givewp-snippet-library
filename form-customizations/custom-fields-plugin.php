<?php
/**
 * Plugin Name: Give - Example Custom Field Added.
 * Plugin URI: https://givewp.com/documentation/developers/how-to-create-custom-form-fields/
 * Description: This plugin demonstrates adds custom fields to your Give Forms.
 * Version: 1.0
 * Author: WordImpress
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
function myprefix123_give_donations_custom_form_fields( $form_id ) {

	// Only display for forms with the IDs "754" and "586";
	// Remove "If" statement to display on all forms
	// For a single form, use this instead:
	// if ( $form_id == 754) {
	$forms = array( 754, 586 );

	if ( in_array( $form_id, $forms ) ) {
		?>
		<div id="give-message-wrap">
			<label class="give-label" for="give-engraving-message"><?php _e( 'What should be engraved on the plaque?:', 'give' ); ?></label>
			<span class="give-tooltip icon icon-question" data-tooltip="<?php _e( 'Please provide the names that should be engraved on the plaque.', 'give' ) ?>"></span>
			<textarea class="give-textarea" name="give_engraving_message" id="give-engraving-message"></textarea>
		</div>
	<?php
	}
}

add_action( 'give_after_donation_levels', 'myprefix123_give_donations_custom_form_fields', 10, 1 );


/**
 * Require custom field "Engraving message" field.
 *
 * @param $required_fields
 * @param $form_id
 *
 * @return array
 */
function myprefix123_give_donations_require_fields( $required_fields, $form_id ) {

	$required_fields['give-engraving-message'];

	return $required_fields;
}

add_filter( 'give_donation_form_required_fields', 'myprefix123_give_donations_require_fields', 10, 2 );

/**
 * Validate Custom Field
 *
 * Check for errors without custom fields.
 *
 * @param $valid_data
 * @param $data
 */
function myprefix123_give_donations_validate_custom_fields( $valid_data, $data ) {

	// Only validate the form with the IDs "754" and "586";
	// Remove "If" statement to display on all forms
	// For a single form, use this instead:
	// if ( $form_id == 754) {
	$forms = array( 754, 586 );

	if ( in_array( $data['give-form-id'], $forms ) ) {
		return;
	}

	// Check for message data
	if ( empty( $data['give_message'] ) ) {
		give_set_error( 'give_message', __( 'Please tell us what you would like inscribed on the plaque.', 'give' ) );
	}
}

add_action( 'give_checkout_error_checks', 'myprefix123_give_donations_validate_custom_fields', 10, 2 );

/**
 * Add Field to Payment Meta
 *
 * Store the custom field data custom post meta attached to the `give_payment` CPT.
 *
 * @param $payment
 * @param $payment_data
 *
 * @return mixed
 */
function myprefix123_give_donations_save_custom_fields( $payment, $payment_data ) {

	if( isset( $_POST['give_message'] ) ) {

		$message1 = implode( 'n', array_map( 'sanitize_text_field', explode( 'n', $_POST['give_message'] ) ) );
		$message2 = sanitize_text_field($_POST['give_message'] );

	     echo "<pre>";
	    var_dump($message1);
	    var_dump($message2);
	    echo "</pre>";
    }


}

add_action( 'give_insert_payment', array( $this, 'myprefix123_give_donations_save_custom_fields' ), 10, 2 );

/**
 * Show Data in Transaction Details
 *
 * Show the custom field(s) on the transaction page.
 *
 * @param $payment_meta
 * @param $user_info
 */
function myprefix123_give_donations_purchase_details( $payment_meta, $user_info ) {

	// uncomment below to see payment_meta array
		// echo "<pre>";
		// var_dump($payment_meta);
		// echo "</pre>";
	// Bounce out if no data for this transaction
	if ( ! isset( $payment_meta['message'] ) ) {
		return;
	} ?>

	<div class="message-data">
		<label><?php echo __( 'Message:', 'give' ); ?></label>
		<?php echo wpautop( $payment_meta['message'] ); ?>
	</div>

<?php
}

add_action( 'give_payment_personal_details_list', 'myprefix123_give_donations_purchase_details', 10, 2 );

/**
 * Adds a Custom "Engraved Message" Tag
 *
 * This function creates a custom Give email template tag
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
 * Example function that returns Custom field data if present in payment_meta;
 * The example used here is in conjunction with the Give documentation tutorials.
 *
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
