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


class Give_Add_Custom_fields_in_Form {

	/**
	 * Custom meta key
	 *
	 * @var string
	 */
	public $key = 'give_engraving_message';


	/**
	 * Form id where the meta key need to be display
	 *
	 * @var array
	 */
	public $forms = array( 8 );

	function __construct() {

		add_action( 'give_after_donation_levels', array( $this, 'custom_fields' ) );

		add_filter( 'give_donation_form_required_fields', array( $this, 'required_fields' ), 10, 2 );

		add_action( 'give_insert_payment', array( $this, 'save' ) );

		add_action( 'give_view_donation_details_billing_before', array( $this, 'donation_details' ), 10, 1 );

		add_action( 'give_add_email_tags', array( $this, 'email_tags' ) );

		add_filter( 'give_donation_receipt_args', array( $this, 'receipt_args' ), 30, 3 );

		add_action( 'give_export_donation_standard_donor_fields', array( $this, 'export_standard_donor_fields' ) );

		add_filter( 'give_export_donation_get_columns_name', array( $this, 'update_columns_heading' ) );

		add_filter( 'give_export_donation_data', array( $this, 'export_donation_data' ), 10, 3 );

		add_filter( 'give_export_donations_get_custom_fields', array( $this, 'export_custom_fields' ), 10, 2 );
	}

	/**
	 * Custom Form Fields in Donation form
	 *
	 * @param $form_id
	 */
	function custom_fields( $form_id ) {

		if ( in_array( $form_id, $this->forms ) ) {
			?>
			<div id="give-message-wrap" class="form-row form-row-wide">
				<label class="give-label" for="<?php echo $this->key; ?>">
					<?php _e( 'What should be engraved on the plaque?', 'give' ); ?>
					<?php if ( give_field_is_required( $this->key, $form_id ) ) : ?>
						<span class="give-required-indicator">*</span>
					<?php endif ?>
					<span class="give-tooltip give-icon give-icon-question"
					      data-tooltip="<?php _e( 'Please provide the names that should be engraved on the plaque.', 'give' ) ?>"></span>
				</label>

				<textarea class="give-textarea" name="<?php echo $this->key; ?>"
				          id="<?php echo $this->key; ?>"></textarea>
			</div>
			<?php
		}
	}


	/**
	 * Require custom field "Engraving message" field.
	 *
	 * @param $required_fields
	 * @param $form_id
	 *
	 * @return array
	 */
	function required_fields( $required_fields, $form_id ) {

		if ( in_array( $form_id, $this->forms ) ) {
			$required_fields[ $this->key ] = array(
				'error_id'      => $this->key,
				'error_message' => __( 'Please enter a message for your engraving', 'give' ),
			);
		}

		return $required_fields;
	}

	/**
	 * Add Field to Payment Meta
	 *
	 * Store the custom field data custom post meta attached to the `give_payment` CPT.
	 *
	 * @param $payment_id
	 *
	 * @return mixed
	 */
	function save( $payment_id ) {

		if ( isset( $_POST[ $this->key ] ) ) {
			$message = wp_strip_all_tags( $_POST[ $this->key ], true );
			give_update_payment_meta( $payment_id, $this->key, $message );
		}

	}

	/**
	 * Show Data in Transaction Details
	 *
	 * Show the custom field(s) on the transaction page.
	 *
	 * @param $payment_id
	 */
	function donation_details( $payment_id ) {

		$engraving_message = give_get_meta( $payment_id, $this->key, true );

		if ( $engraving_message ) : ?>

			<div id="<?php echo $this->key; ?>" class="postbox">
				<h3 class="hndle"><?php esc_html_e( 'Engraving Message', 'give' ); ?></h3>
				<div class="inside" style="padding-bottom:10px;">
					<?php echo wpautop( $engraving_message ); ?>
				</div>
			</div>

		<?php endif;

	}

	/**
	 * Adds a Custom "Engraved Message" Tag
	 *
	 * This function creates a custom Give email template tag.
	 */
	function email_tags() {
		give_add_email_tag( $this->key, 'This outputs the Engraved Message', array( $this, 'donation_referral_data' ) );
	}

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
	function donation_referral_data( $tag_args ) {
		$engraving_message = give_get_meta( $tag_args['payment_id'], $this->key, true );

		$output = __( 'No referral data found.', 'give' );

		if ( ! empty( $engraving_message ) ) {
			$output = wp_kses_post( $engraving_message );
		}

		return $output;
	}

	/**
	 * Add Donation engraving message fields.
	 *
	 * @params array    $args
	 * @params int      $donation_id
	 * @params int      $form_id
	 *
	 * @since  1.8.8
	 *
	 * @return array
	 */
	function receipt_args( $args, $donation_id, $form_id ) {

		if ( in_array( $form_id, $this->forms ) ) {
			$engraving_message  = give_get_meta( $donation_id, $this->key, true );
			$args[ $this->key ] = array(
				'name'    => __( 'Engraved Message', 'give' ),
				'value'   => wp_kses_post( $engraving_message ),
				// Do not show Engraved field if empty
				'display' => empty( $engraving_message ) ? false : true,
			);
		}

		return $args;
	}

	/**
	 * Add Donation engraving message fields in export donor fields tab.
	 */
	function export_standard_donor_fields() {
		?>
		<li>
			<label for="<?php echo $this->key; ?>">
				<input type="checkbox" checked
				       name="give_give_donations_export_option[<?php echo $this->key; ?>]"
				       id="<?php echo $this->key; ?>"><?php _e( 'Engraved Message', 'give' ); ?>
			</label>
		</li>
		<?php
	}

	/**
	 * Add Donation engraving message header in CSV.
	 */
	function update_columns_heading( $cols ) {
		if ( isset( $cols[ $this->key ] ) ) {
			$cols[ $this->key ] = __( 'Engraved Message', 'give' );
		}

		return $cols;

	}

	/**
	 * Add Donation engraving message fields in CSV.
	 *
	 * @param array Donation data.
	 * @param Give_Payment $payment Instance of Give_Payment
	 * @param array $columns Donation data $columns that are not being merge
	 *
	 * @return array Donation data.
	 */
	function export_donation_data( $data, $payment, $columns ) {
		if ( ! empty( $columns[ $this->key ] ) ) {
			$message            = $payment->get_meta( $this->key );
			$data[ $this->key ] = isset( $message ) ? wp_kses_post( $message ) : '';
		}

		return $data;
	}

	/**
	 * Export donation standard fields.
	 *
	 * @param array $responses Contain all the fields that need to be display when donation form is display
	 * @param int $form_id Donation Form ID
	 *
	 * @return array $responses
	 */
	function export_custom_fields( $responses, $form_id ) {
		if ( in_array( $form_id, $this->forms ) && ! empty( $responses['standard_fields'] ) ) {
			$standard_fields = $responses['standard_fields'];
			if ( in_array( $this->key, $standard_fields ) ) {
				$standard_fields              = array_diff( $standard_fields, array( $this->key ) );
				$responses['standard_fields'] = $standard_fields;
			}
		}

		return $responses;
	}
}


new Give_Add_Custom_fields_in_Form();