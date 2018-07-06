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
 * Custom Form Fields in Donation form
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
			<label class="give-label" for="give-engraving-message">
				<?php _e( 'What should be engraved on the plaque?', 'give' ); ?>
				<?php if ( give_field_is_required( 'give_engraving_message', $form_id ) ) : ?>
					<span class="give-required-indicator">*</span>
				<?php endif ?>
				<span class="give-tooltip give-icon give-icon-question"
				      data-tooltip="<?php _e( 'Please provide the names that should be engraved on the plaque.', 'give' ) ?>">
				</span>
			</label>

			<textarea class="give-textarea" name="give_engraving_message" id="give-engraving-message"></textarea>
		</div>
		<?php
	}
}

add_action( 'give_after_donation_levels', 'myprefix123_give_donations_custom_form_fields' );

/**
 * Require custom field "Engraving message" field.
 *
 * @param $required_fields
 * @param $form_id
 *
 * @return array
 */
function myprefix123_give_donations_require_fields( $required_fields, $form_id ) {

	// Only display for forms with the IDs "754" and "578";
	// Remove "If" statement to display on all forms
	// For a single form, use this instead:
	// if ( $form_id == 754) {
	$forms = array( 754, 578 );
	if ( in_array( $form_id, $forms ) ) {
		$required_fields['give_engraving_message'] = array(
			'error_id'      => 'give_engraving_message',
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
 *
 * @return mixed
 */
function myprefix123_give_donations_save_custom_fields( $payment_id ) {

	if ( isset( $_POST['give_engraving_message'] ) ) {
		$message = wp_strip_all_tags( $_POST['give_engraving_message'], true );
		give_update_payment_meta( $payment_id, 'give_engraving_message', $message );
	}

}

add_action( 'give_insert_payment', 'myprefix123_give_donations_save_custom_fields' );

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

		<div id="give-engraving-message" class="postbox">
			<h3 class="hndle"><?php esc_html_e( 'Engraving Message', 'give' ); ?></h3>
			<div class="inside" style="padding-bottom:10px;">
				<?php echo wpautop( $engraving_message ); ?>
			</div>
		</div>

	<?php endif;

}

add_action( 'give_view_donation_details_billing_before', 'myprefix123_give_donations_donation_details', 10, 1 );


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
function myprefix123_donation_referral_data( $tag_args ) {
	$engraving_message = give_get_meta( $tag_args['payment_id'], 'give_engraving_message', true );

	$output = __( 'No referral data found.', 'give' );

	if ( ! empty( $engraving_message ) ) {
		$output = wp_kses_post( $engraving_message );
	}

	return $output;
}

/**
 * Adds a Custom "Engraved Message" Tag
 *
 * This function creates a custom Give email template tag.
 */
function myprefix123_add_sample_referral_tag() {
	give_add_email_tag( 'give_engraving_message', 'This outputs the Engraved Message', 'myprefix123_donation_referral_data' );
}

add_action( 'give_add_email_tags', 'myprefix123_add_sample_referral_tag' );

/**
 * Add Donation engraving message fields.
 *
 * @params array    $args
 * @params int      $donation_id
 * @params int      $form_id
 *
 * @return array
 */
function myprefix123_donation_receipt_args( $args, $donation_id, $form_id ) {

	// Only display for forms with the IDs "754" and "578";
	// Remove "If" statement to display on all forms
	// For a single form, use this instead:
	// if ( $form_id == 754) {
	$forms = array( 754, 578 );
	if ( in_array( $form_id, $forms ) ) {
		$engraving_message              = give_get_meta( $donation_id, 'give_engraving_message', true );
		$args['give_engraving_message'] = array(
			'name'    => __( 'Engraved Message', 'give' ),
			'value'   => wp_kses_post( $engraving_message ),
			// Do not show Engraved field if empty
			'display' => empty( $engraving_message ) ? false : true,
		);
	}

	return $args;
}

add_filter( 'give_donation_receipt_args', 'myprefix123_donation_receipt_args', 30, 3 );


/**
 * Add Donation engraving message fields in export donor fields tab.
 */
function myprefix123_donation_standard_donor_fields() {
	?>
	<li>
		<label for="give-engraving-message">
			<input type="checkbox" checked
			       name="give_give_donations_export_option[<?php echo 'give_engraving_message'; ?>]"
			       id="give-engraving-message"><?php _e( 'Engraved Message', 'give' ); ?>
		</label>
	</li>
	<?php
}

add_action( 'give_export_donation_standard_donor_fields', 'myprefix123_donation_standard_donor_fields' );


/**
 * Add Donation engraving message header in CSV.
 *
 * @param array $cols columns name for CSV
 *
 * @return  array $cols columns name for CSV
 */
function myprefix123_update_columns_heading( $cols ) {
	if ( isset( $cols['give_engraving_message'] ) ) {
		$cols['give_engraving_message'] = __( 'Engraved Message', 'give' );
	}

	return $cols;

}

add_filter( 'give_export_donation_get_columns_name', 'myprefix123_update_columns_heading' );


/**
 * Add Donation engraving message fields in CSV.
 *
 * @param array Donation data.
 * @param Give_Payment $payment Instance of Give_Payment
 * @param array $columns Donation data $columns that are not being merge
 *
 * @return array Donation data.
 */
function myprefix123_export_donation_data( $data, $payment, $columns ) {
	if ( ! empty( $columns['give_engraving_message'] ) ) {
		$message                        = $payment->get_meta( 'give_engraving_message' );
		$data['give_engraving_message'] = isset( $message ) ? wp_kses_post( $message ) : '';
	}

	return $data;
}

add_filter( 'give_export_donation_data', 'myprefix123_export_donation_data', 10, 3 );

/**
 * Remove Custom meta fields from Export donation standard fields.
 *
 * @param array $responses Contain all the fields that need to be display when donation form is display
 * @param int $form_id Donation Form ID
 *
 * @return array $responses
 */
function myprefix123_export_custom_fields( $responses, $form_id ) {
	// Only display for forms with the IDs "754" and "578";
	// Remove "If" statement to display on all forms
	// For a single form, use this instead:
	// if ( $form_id == 754) {
	$forms = array( 754, 578 );
	if ( in_array( $form_id, $forms ) && ! empty( $responses['standard_fields'] ) ) {
		$standard_fields = $responses['standard_fields'];
		if ( in_array( 'give_engraving_message', $standard_fields ) ) {
			$standard_fields              = array_diff( $standard_fields, array( 'give_engraving_message' ) );
			$responses['standard_fields'] = $standard_fields;
		}
	}

	return $responses;
}

add_filter( 'give_export_donations_get_custom_fields', 'myprefix123_export_custom_fields', 10, 2 );