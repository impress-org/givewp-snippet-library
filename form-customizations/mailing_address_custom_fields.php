<?php

/**
 * Outputs Mailing Address Fields
 * To all Give Forms and creates 
 * Mailing Address email tag
 *
 */
 
function my_prefix_give_mailing_fields( $form_id ) {
	?>
	<fieldset id="give_mailing_address" class="mailing-address">
		<legend>Mailing Address</legend>

		<p id="give-mailing-address-wrap" class="form-row form-row-wide">
			<label for="mailing_address_1" class="give-label">
				Address 1
					<span class="give-required-indicator">*</span>
					<span class="give-tooltip give-icon give-icon-question"
					  data-tooltip="The mailing address of the recipient."></span>
			</label>

			<input
					type="text"
					id="mailing_address_1"
					name="mailing_address_1"
					class="mailing-address give-input-required"
					placeholder="Address line 1"
					value="<?php echo isset( $give_user_info['mailing_address_1'] ) ? $give_user_info['mailing_address_1'] : ''; ?>"
					required aria-required="true"
			/>
		</p>

		<p id="give-mailing-address-2-wrap" class="form-row form-row-wide">
			<label for="mailing_address_2" class="give-label">
				Address 2

				<span class="give-tooltip give-icon give-icon-question"
					  data-tooltip="(optional) The suite, apt no, PO box, etc, associated with this mailing address."></span>
			</label>

			<input
					type="text"
					id="mailing_address_2"
					name="mailing_address_2"
					class="mailing-address-2 give-input"
					placeholder="Address line 2"
					value="<?php echo isset( $give_user_info['mailing_address_2'] ) ? $give_user_info['mailing_address_2'] : ''; ?>"
			/>
		</p>

		<p id="give-mailing-city-wrap" class="form-row form-row-first form-row-responsive">
			<label for="mailing_city" class="give-label">
				City
				<span class="give-required-indicator">*</span>
				<span class="give-tooltip give-icon give-icon-question"
					  data-tooltip="The city of the recipient's mailing address."></span>
			</label>
			<input
					type="text"
					id="mailing_city"
					name="mailing_city"
					class="mailing-city give-input-required"
					placeholder="City"
					value="<?php echo isset( $give_user_info['mailing_city'] ) ? $give_user_info['mailing_city'] : ''; ?>"
					required aria-required="true"
			/>
		</p>

		<p id="give-mailing-zip-wrap" class="form-row form-row-last form-row-responsive">
			<label for="mailing_zip" class="give-label">
				Zip / Postal Code
				<span class="give-required-indicator">*</span>

				<span class="give-tooltip give-icon give-icon-question"
					  data-tooltip="The zip or postal code of the recipient's mailing address."></span>
			</label>

			<input
					type="text"
					size="4"
					id="mailing_zip"
					name="mailing_zip"
					class="card-zip give-input-required"
					placeholder="Zip / Postal Code'"
					value="<?php echo isset( $give_user_info['mailing_zip'] ) ? $give_user_info['mailing_zip'] : ''; ?>"
					required aria-required="true"
			/>
		</p>

		<p id="give-mailing-country-wrap" class="form-row form-row-first form-row-responsive">
			<label for="mailing_country" class="give-label">
				Country
				<span class="give-required-indicator">*</span>

				<span class="give-tooltip give-icon give-icon-question"
					  data-tooltip="The country of your recipient's mailing address."></span>
			</label>

			<select
					name="mailing_country"
					id="mailing_country"
					class="mailing-country mailing_country give-select-required"
					required aria-required="true"
			>
				<?php

				$selected_country = give_get_country();

				if ( ! empty( $give_user_info['billing_country'] ) && '*' !== $give_user_info['billing_country'] ) {
					$selected_country = $give_user_info['billing_country'];
				}

				$countries = give_get_country_list();
				foreach ( $countries as $country_code => $country ) {
					echo '<option value="' . esc_attr( $country_code ) . '"' . selected( $country_code, $selected_country, false ) . '>' . $country . '</option>';
				}
				?>
			</select>
		</p>

		<p id="give-mailing-state-wrap" class="form-row form-row-last form-row-responsive">
			<label for="mailing_state" class="give-label">
				State / Province
				<span class="give-required-indicator">*</span>

				<span class="give-tooltip give-icon give-icon-question"
					  data-tooltip="The state or province of your recipient's mailing address."></span>
			</label>

			<?php
			$selected_state = give_get_state();
			$states         = give_get_states( $selected_country );

			if ( ! empty( $give_user_info['card_state'] ) ) {
				$selected_state = $give_user_info['card_state'];
			}

			if ( ! empty( $states ) ) : ?>
				<select
						name="mailing_state"
						id="mailing_state"
						class="mailing_state give-select-required"
						required aria-required="true">
					<?php
					foreach ( $states as $state_code => $state ) {
						echo '<option value="' . $state_code . '"' . selected( $state_code, $selected_state, false ) . '>' . $state . '</option>';
					}
					?>
				</select>
			<?php else : ?>
				<input type="text" size="6" name="mailing_state" id="mailing_state" class="mailing_state give-input"
					   placeholder="<?php esc_attr_e( 'State / Province', 'give' ); ?>"/>
			<?php endif; ?>
		</p>

	</fieldset>
	<?php
}
add_action( 'give_after_donation_levels', 'my_prefix_give_mailing_fields', 10, 1 );

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
function myprefix_give_save_mailing_field_data( $payment_id, $payment_data ) {
	if ( isset( $_POST['mailing_address_1'] ) ) {
		$message = implode( "\n", array_map( 'sanitize_text_field', explode( "\n", $_POST['mailing_address_1'] ) ) );
		add_post_meta( $payment_id, 'mailing_address_1', $message );
	}

	if ( isset( $_POST['mailing_address_2'] ) ) {
		$message = implode( "\n", array_map( 'sanitize_text_field', explode( "\n", $_POST['mailing_address_2'] ) ) );
		add_post_meta( $payment_id, 'mailing_address_2', $message );
	}

	if ( isset( $_POST['mailing_city'] ) ) {
		$message = implode( "\n", array_map( 'sanitize_text_field', explode( "\n", $_POST['mailing_city'] ) ) );
		add_post_meta( $payment_id, 'mailing_city', $message );
	}

	if ( isset( $_POST['mailing_zip'] ) ) {
		$message = implode( "\n", array_map( 'sanitize_text_field', explode( "\n", $_POST['mailing_zip'] ) ) );
		add_post_meta( $payment_id, 'mailing_zip', $message );
	}

	if ( isset( $_POST['mailing_country'] ) ) {
		$message = implode( "\n", array_map( 'sanitize_text_field', explode( "\n", $_POST['mailing_country'] ) ) );
		add_post_meta( $payment_id, 'mailing_country', $message );
	}

	if ( isset( $_POST['mailing_state'] ) ) {
		$message = implode( "\n", array_map( 'sanitize_text_field', explode( "\n", $_POST['mailing_state'] ) ) );
		add_post_meta( $payment_id, 'mailing_state', $message );
	}
}
add_action( 'give_insert_payment', 'myprefix_give_save_mailing_field_data', 10, 2 );

/**
 * Show Data in Transaction Details
 *
 * Show the custom field(s) on the transaction page.
 *
 * @param $payment_id
 */
function myprefix123_give_mailing_fields_donation_details( $payment_id ) {
	$address1 = get_post_meta( $payment_id, 'mailing_address_1', true );
	$address2 = get_post_meta( $payment_id, 'mailing_address_2', true );
	$city = get_post_meta( $payment_id, 'mailing_city', true );
	$zip = get_post_meta( $payment_id, 'mailing_zip', true );
	$country = get_post_meta( $payment_id, 'mailing_country', true );
	$state = get_post_meta( $payment_id, 'mailing_state', true );

	if ( $address1 ) : ?>

		<div id="give-mailing-address" class="postbox">
			<h3 class="hndle"><?php esc_html_e( 'Recipient Mailing Address', 'give' ); ?></h3>
			<div class="inside" style="padding-bottom:10px;">
				<p><?php echo $address1; ?><br />
					<?php echo $address2; ?>
					<?php echo $city; ?>, <?php echo $state; ?> <?php echo $zip; ?><br />
					<?php echo $country; ?>
				</p>
			</div>
		</div>

	<?php endif;
}
add_action( 'give_view_order_details_billing_before', 'myprefix123_give_mailing_fields_donation_details', 10, 1 );

/**
 * Adds a Custom Email Tag
 *
 * This function creates a custom Give email template tag.
 *
 * @param $payment_id
 */
function myprefix123_add_mailing_address_email_tag( $payment_id ) {
	give_add_email_tag( 'honoree_mailing_address', 'This outputs the Mailing Address of the honoree', 'myprefix123_get_mailing_address_email_data' );
}
add_action( 'give_add_email_tags', 'myprefix123_add_mailing_address_email_tag' );

/**
 * Get Donation Referral Data
 *
 * Example function that returns Custom field data if present in payment_meta;
 * The example used here is in conjunction with the Give documentation tutorials.
 *
 * @param $payment_id
 * @param $payment_meta
 *
 * @return string
 */
function myprefix123_get_mailing_address_email_data( $payment_id, $payment_meta ) {

	$address1 = get_post_meta( $payment_id, 'mailing_address_1', true );
	$address2 = get_post_meta( $payment_id, 'mailing_address_2', true );
	$city = get_post_meta( $payment_id, 'mailing_city', true );
	$zip = get_post_meta( $payment_id, 'mailing_zip', true );
	$country = get_post_meta( $payment_id, 'mailing_country', true );
	$state = get_post_meta( $payment_id, 'mailing_state', true );

	$output = __( 'No referral data found.', 'give' );

	if ( ! empty( $address1 ) ) {
		ob_start(); ?>
			<p><?php echo $address1; ?><br />
			<?php echo $address2; ?>
			<?php echo $city; ?>, <?php echo $state; ?> <?php echo $zip; ?><br />
			<?php echo $country; ?>
			</p>
		<?php

		$output = ob_get_clean();
	}
	return $output;
}