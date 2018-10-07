<?php
/**
 * This function will display credit card form for ACH.
 *
 * Note: We have removed credit card HTML for ACH as it is not required.
 *
 * @param int   $form_id Donation Form ID.
 * @param array $args    List of arguments.
 *
 * @since 1.0.0
 */
function give_stripe_ach_credit_card_form( $form_id, $args ) {

	/**
	 * This action hook will be used to display billing address only on Stripe ACH.
	 *
	 * @since 1.0.0
	 */
	do_action( 'give_stripe_ach_after_cc_form', $form_id, $args );
}

add_action( 'give_stripe_ach_cc_form', 'give_stripe_ach_credit_card_form', 10, 2 );


/**
 * Outputs the default credit card address fields.
 *
 * @since 1.0.0
 *
 * @param  int $form_id Donation form ID.
 *
 * @return void
 */
function give_stripe_ach_default_cc_address_fields( $form_id ) {
	// Get user info.
	$give_user_info = _give_get_prefill_form_field_values( $form_id );

	$logged_in = is_user_logged_in();

	if ( $logged_in ) {
		$user_address = give_get_donor_address( get_current_user_id() );
	}

	ob_start();
	?>
	<fieldset id="give_cc_address" class="cc-address">
		<legend><?php echo apply_filters( 'give_billing_details_fieldset_heading', esc_html__( 'Billing Details', 'give' ) ); ?></legend>
		<?php
		/**
		 * Fires while rendering credit card billing form, before address fields.
		 *
		 * @since 1.0
		 *
		 * @param int $form_id The form ID.
		 */
		do_action( 'give_cc_billing_top' );

		// For Country.
		$selected_country = give_get_country();
		if ( ! empty( $give_user_info['billing_country'] ) && '*' !== $give_user_info['billing_country'] ) {
			$selected_country = $give_user_info['billing_country'];
		}
		$countries = give_get_country_list();

		// For state.
		$selected_state = '';
		if ( $selected_country === give_get_country() ) {
			// Get default selected state by admin.
			$selected_state = give_get_state();
		}
		// Get the last payment made by user states.
		if ( ! empty( $give_user_info['card_state'] ) && '*' !== $give_user_info['card_state'] ) {
			$selected_state = $give_user_info['card_state'];
		}
		// Get the country code.
		if ( ! empty( $give_user_info['billing_country'] ) && '*' !== $give_user_info['billing_country'] ) {
			$selected_country = $give_user_info['billing_country'];
		}
		$label        = __( 'State', 'give' );
		$states_label = give_get_states_label();
		// Check if $country code exists in the array key for states label.
		if ( array_key_exists( $selected_country, $states_label ) ) {
			$label = $states_label[ $selected_country ];
		}
		$states = give_get_states( $selected_country );
		// Get the country list that do not have any states init.
		$no_states_country = give_no_states_country_list();
		// Get the country list that does not require states.
		$states_not_required_country_list = give_states_not_required_country_list();
		?>
		<p id="give-card-country-wrap" class="form-row form-row-wide">
			<label for="billing_country" class="give-label">
				<?php esc_html_e( 'Country', 'give' ); ?>
				<?php if ( give_field_is_required( 'billing_country', $form_id ) ) : ?>
					<span class="give-required-indicator">*</span>
				<?php endif; ?>
				<span class="give-tooltip give-icon give-icon-question"
					data-tooltip="<?php esc_attr_e( 'The country for your billing address.', 'give' ); ?>"></span>
			</label>

			<select
				name="billing_country"
				autocomplete="country-name"
				id="billing_country"
				class="billing-country billing_country give-select<?php echo( give_field_is_required( 'billing_country', $form_id ) ? ' required' : '' ); ?>"
				<?php echo( give_field_is_required( 'billing_country', $form_id ) ? ' required aria-required="true" ' : '' ); ?>
			>
				<?php
				foreach ( $countries as $country_code => $country ) {
					echo '<option value="' . esc_attr( $country_code ) . '"' . selected( $country_code, $selected_country, false ) . '>' . $country . '</option>';
				}
				?>
			</select>
		</p>

		<p id="give-card-address-wrap" class="form-row form-row-wide">
			<label for="card_address" class="give-label">
				<?php _e( 'Address 1', 'give' ); ?>
				<?php
				if ( give_field_is_required( 'card_address', $form_id ) ) :
					?>
					<span class="give-required-indicator">*</span>
				<?php endif; ?>
				<?php echo Give()->tooltips->render_help( __( 'The primary billing address for your credit card.', 'give' ) ); ?>
			</label>

			<input
				type="text"
				id="card_address"
				name="card_address"
				autocomplete="address-line1"
				class="card-address give-input<?php echo( give_field_is_required( 'card_address', $form_id ) ? ' required' : '' ); ?>"
				placeholder="<?php _e( 'Address line 1', 'give' ); ?>"
				value="<?php echo isset( $give_user_info['card_address'] ) ? $give_user_info['card_address'] : ''; ?>"
				<?php echo( give_field_is_required( 'card_address', $form_id ) ? '  required aria-required="true" ' : '' ); ?>
			/>
		</p>

		<p id="give-card-address-2-wrap" class="form-row form-row-wide">
			<label for="card_address_2" class="give-label">
				<?php _e( 'Address 2', 'give' ); ?>
				<?php if ( give_field_is_required( 'card_address_2', $form_id ) ) : ?>
					<span class="give-required-indicator">*</span>
				<?php endif; ?>
				<?php echo Give()->tooltips->render_help( __( '(optional) The suite, apartment number, post office box (etc) associated with your billing address.', 'give' ) ); ?>
			</label>

			<input
				type="text"
				id="card_address_2"
				name="card_address_2"
				autocomplete="address-line2"
				class="card-address-2 give-input<?php echo( give_field_is_required( 'card_address_2', $form_id ) ? ' required' : '' ); ?>"
				placeholder="<?php _e( 'Address line 2', 'give' ); ?>"
				value="<?php echo isset( $give_user_info['card_address_2'] ) ? $give_user_info['card_address_2'] : ''; ?>"
				<?php echo( give_field_is_required( 'card_address_2', $form_id ) ? ' required aria-required="true" ' : '' ); ?>
			/>
		</p>

		<p id="give-card-city-wrap" class="form-row form-row-wide">
			<label for="card_city" class="give-label">
				<?php _e( 'City', 'give' ); ?>
				<?php if ( give_field_is_required( 'card_city', $form_id ) ) : ?>
					<span class="give-required-indicator">*</span>
				<?php endif; ?>
				<?php echo Give()->tooltips->render_help( __( 'The city for your billing address.', 'give' ) ); ?>
			</label>
			<input
				type="text"
				id="card_city"
				name="card_city"
				autocomplete="address-level3"
				class="card-city give-input<?php echo( give_field_is_required( 'card_city', $form_id ) ? ' required' : '' ); ?>"
				placeholder="<?php _e( 'City', 'give' ); ?>"
				value="<?php echo isset( $give_user_info['card_city'] ) ? $give_user_info['card_city'] : ''; ?>"
				<?php echo( give_field_is_required( 'card_city', $form_id ) ? ' required aria-required="true" ' : '' ); ?>
			/>
		</p>

		<p id="give-card-state-wrap"
			class="form-row form-row-first form-row-responsive <?php echo ( ! empty( $selected_country ) && array_key_exists( $selected_country, $no_states_country ) ) ? 'give-hidden' : ''; ?> ">
			<label for="card_state" class="give-label">
				<span class="state-label-text"><?php echo $label; ?></span>
				<?php
				if ( give_field_is_required( 'card_state', $form_id ) ) :
					?>
					<span
						class="give-required-indicator <?php echo( array_key_exists( $selected_country, $states_not_required_country_list ) ? 'give-hidden' : '' ); ?> ">*</span>
				<?php endif; ?>
				<span class="give-tooltip give-icon give-icon-question"
					data-tooltip="<?php esc_attr_e( 'The state, province, or county for your billing address.', 'give' ); ?>"></span>
			</label>
			<?php

			if ( ! empty( $states ) ) :
				?>
				<select
					name="card_state"
					autocomplete="address-level4"
					id="card_state"
					class="card_state give-select<?php echo( give_field_is_required( 'card_state', $form_id ) ? ' required' : '' ); ?>"
					<?php echo( give_field_is_required( 'card_state', $form_id ) ? ' required aria-required="true" ' : '' ); ?>>
					<?php
					foreach ( $states as $state_code => $state ) {
						echo '<option value="' . $state_code . '"' . selected( $state_code, $selected_state, false ) . '>' . $state . '</option>';
					}
					?>
				</select>
			<?php else : ?>
				<input type="text" size="6" name="card_state" id="card_state" class="card_state give-input"
					placeholder="<?php echo $label; ?>" value="<?php echo $selected_state; ?>"/>
			<?php endif; ?>
		</p>

		<p id="give-card-zip-wrap" class="form-row form-row-last form-row-responsive">
			<label for="card_zip" class="give-label">
				<?php _e( 'Zip / Postal Code', 'give' ); ?>
				<?php if ( give_field_is_required( 'card_zip', $form_id ) ) : ?>
					<span class="give-required-indicator">*</span>
				<?php endif; ?>
				<?php echo Give()->tooltips->render_help( __( 'The ZIP Code or postal code for your billing address.', 'give' ) ); ?>
			</label>

			<input
				type="text"
				size="4"
				id="card_zip"
				name="card_zip"
				autocomplete="postal-code"
				class="card-zip give-input<?php echo( give_field_is_required( 'card_zip', $form_id ) ? ' required' : '' ); ?>"
				placeholder="<?php _e( 'Zip / Postal Code', 'give' ); ?>"
				value="<?php echo isset( $give_user_info['card_zip'] ) ? $give_user_info['card_zip'] : ''; ?>"
				<?php echo( give_field_is_required( 'card_zip', $form_id ) ? ' required aria-required="true" ' : '' ); ?>
			/>
		</p>
		<?php
		/**
		 * Fires while rendering credit card billing form, after address fields.
		 *
		 * @since 1.0
		 *
		 * @param int $form_id The form ID.
		 */
		do_action( 'give_cc_billing_bottom' );
		?>
	</fieldset>
	<?php
	echo ob_get_clean();
}

add_action( 'give_stripe_ach_after_cc_form', 'give_stripe_ach_default_cc_address_fields' );
