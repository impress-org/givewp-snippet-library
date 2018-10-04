<?php
/**
 * Add donor meta field to form
 *
 * @param int $form_id
 */
function give_add_donor_phone_form_field( $form_id ){
	?>
	<p id="give-email-wrap" class="form-row form-row-wide">
		<label class="give-label" for="give-email">
			<?php _e( 'Phone', 'give' ); ?>
			<?php if ( give_field_is_required( 'give_phone', $form_id ) ) : ?>
				<span class="give-required-indicator">*</span>
			<?php endif ?>
			<?php echo Give()->tooltips->render_help( __( 'We will use this as well to personalize your account experience.', 'give' ) ); ?>
		</label>

		<input
			class="give-input required"
			type="text"
			name="give_phone"
			autocomplete="phone"
			placeholder="<?php _e( 'Phone', 'give' ); ?>"
			id="give-email"
			value="<?php isset( $_POST['give_phone'] ) ? give_clean( $_POST['give_phone'] ) : ''; ?>"
			required=""
			aria-required="true"
		>

	</p>
	<?php
}
add_action( 'give_donation_form_after_email', 'give_add_donor_phone_form_field' );

/**
 * Set donor phone form field as required
 *
 * @param array $required_fields
 * @param int $form_id
 *
 * @return array
 */
function give_required_donor_phone_form_field( $required_fields, $form_id ){
	$required_fields['give_phone'] = array(
		'error_id'      => 'invalid_phone',
		'error_message' => __( 'Please enter phone number.', 'give' ),
	);

	return $required_fields;
}
add_action( 'give_donation_form_required_fields', 'give_required_donor_phone_form_field', 10, 2 );

/**
 * Save phone number to donation and donor meta
 * Note: donor phone will update in donor meta if donor changes there phone number.
 *
 * @param $donation_id
 */
function give_save_donor_phone_number( $donation_id ){
	$donor_id = give_get_payment_donor_id( $donation_id );
	$new_phone_number = give_clean( $_POST['give_phone'] );
	$phone_numbers = Give()->donor_meta->get_meta( $donor_id, 'give_phone' );

	// Add phone number to donor meta only if not exist.
	if( ! in_array( $new_phone_number, $phone_numbers ) ) {
		Give()->donor_meta->add_meta( $donor_id, 'give_phone', $new_phone_number  );
	}

	// Save phone number to donation meta.
	Give()->payment_meta->update_meta( $donation_id, '_give_phone', $new_phone_number );
}
add_action( 'give_insert_payment', 'give_save_donor_phone_number', 10 );

/**
 * Show donor phone numbers on donor profile
 *
 * @param Give_Donor $donor
 */
function give_show_donor_phone_numbers( $donor ) {
	$phone_numbers = $donor->get_meta( 'give_phone', false );
	?>
	<div id="donor-address-wrapper" class="donor-section clear">
		<h3><?php _e( 'Phone Numbers', 'give' ); ?></h3>

		<div class="postbox">
			<div class="inside">
				<?php if ( empty( $phone_numbers ) ) : ?>
					<?php _e( 'This donor does not have any phone number saved.', 'give' ); ?>
				<?php else: ?>
					<?php foreach ( $phone_numbers as $phone_number ) : ?>
						<?php echo $phone_number; ?><br>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php
}
add_action( 'give_donor_before_address', 'give_show_donor_phone_numbers' );

/**
 * This function will add a new custom field to export.
 *
 * @param array $default_columns List of default columns.
 *
 * @return array
 */
function give_add_custom_column_to_export_donor( $default_columns ) {

	$default_columns['phone_number'] = esc_html__( 'Phone Number', 'give' );

	return $default_columns;
}
add_filter( 'give_export_donors_get_default_columns', 'give_add_custom_column_to_export_donor' );

/**
 * This function will be used to set the value of new custom field which will be displayed in exported CSV.
 *
 * @param array      $data  List of data which is displayed in exported CSV.
 * @param Give_Donor $donor Donor Object.
 *
 * @return mixed
 */
function give_export_set_custom_donor_data( $data, $donor ) {

	$phone_number         = Give()->donor_meta->get_meta( $donor->id, 'give_phone', true );
	$data['phone_number'] = ! empty( $phone_number ) ? $phone_number : '- N/A - ';

	return $data;
}
add_filter( 'give_export_set_donor_data', 'give_export_set_custom_donor_data', 10, 2 );
