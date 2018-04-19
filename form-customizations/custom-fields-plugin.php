<?php
/**
 * Plugin Name: Give - Example Custom Field Integration
 * Plugin URI: https://givewp.com/documentation/developers/how-to-create-custom-form-fields/
 * Description: This plugin demonstrates adds custom fields to your Give give forms with validation, email functionality, and field data output on the payment record within wp-admin.
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

	// Only display for forms with the IDs "754" and "578";
	// Remove "If" statement to display on all forms
	// For a single form, use this instead:
	// if ( $form_id == 754) {
	$forms = array( 754, 578 );

	if ( in_array( $form_id, $forms ) ) {
		?>
		<div id="give-message-wrap" class="form-row form-row-wide">
			<label class="give-label"
				   for="give-engraving-message"><?php _e( 'What should be engraved on the plaque?', 'give' ); ?><?php if ( give_field_is_required( 'give_engraving_message', $form_id ) ) : ?>
					<span class="give-required-indicator">*</span>
				<?php endif ?><span class="give-tooltip give-icon give-icon-question"
									data-tooltip="<?php _e( 'Please provide the names that should be engraved on the plaque.', 'give' ) ?>"></span></label>

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

	// Only validate the form with the IDs "754" and "578";
	// Remove "If" statement to display on all forms
	// For a single form, use this instead:
	// if ( $form_id == 754) {
	$forms = array( 754, 578 );
	if ( in_array( $form_id, $forms ) ) {
		$required_fields['give_engraving_message'] = array(
			'error_id'      => 'invalid_give_engraving_message',
			'error_message' => __( 'Please enter a message for your engraving', 'give' ),
		);
	}

	return $required_fields;
}

add_filter( 'give_donation_form_required_fields', 'myprefix123_give_donations_require_fields', 10, 2 );


/**
 * Add Field to Payment Meta
 *
 * Store the custom field data custom post meta attached to the `give_payment` CPT.
 *
 * @param $payment_id
 * @param $payment_data
 *
 * @return mixed
 */
function myprefix123_give_donations_save_custom_fields( $payment_id, $payment_data ) {

	if ( isset( $_POST['give_engraving_message'] ) ) {
		$message = wp_strip_all_tags( $_POST['give_engraving_message'], true );
		add_post_meta( $payment_id, 'give_engraving_message', $message );
	}

}

add_action( 'give_insert_payment', 'myprefix123_give_donations_save_custom_fields', 10, 2 );

/**
 * Show Data in Transaction Details
 *
 * Show the custom field(s) on the transaction page.
 *
 * @param $payment_id
 */
function myprefix123_give_donations_donation_details( $payment_id ) {

	$engraving_message = give_get_meta( $payment_id, 'give_engraving_message', true );

	if ( $engraving_message ) : ?>

		<div id="give-engraving-details" class="postbox">
			<h3 class="hndle"><?php esc_html_e( 'Engraving Message', 'give' ); ?></h3>
			<div class="inside" style="padding-bottom:10px;">
				<?php echo wpautop( $engraving_message ); ?>
			</div>
		</div>

	<?php endif;

}

add_action( 'give_view_donation_details_billing_before', 'myprefix123_give_donations_donation_details', 10, 1 );

/**
 * Adds a Custom "Engraved Message" Tag
 *
 * This function creates a custom Give email template tag.
 */
function my_custom_prefix_add_sample_referral_tag() {

	give_add_email_tag(
			'engraving_message',
			'This outputs the Engraved Message',
			'my_custom_prefix_get_donation_referral_data'
	);

}

add_action( 'give_add_email_tags', 'my_custom_prefix_add_sample_referral_tag' );

/**
 * Get Donation Referral Data
 *
 * Example function that returns Custom field data if present in payment_meta;
 * The example used here is in conjunction with the Give documentation tutorials.
 *
 * @param array $tag_args Array of arguments
 *
 * @return string
 */
function my_custom_prefix_get_donation_referral_data( $tag_args ) {

	$engraving_message = give_get_meta( $tag_args['payment_id'], 'give_engraving_message', true );

	$output = __( 'No referral data found.', 'give' );

	if ( ! empty( $engraving_message ) ) {
		$output = wp_kses_post( $engraving_message );
	}

	return $output;
}
