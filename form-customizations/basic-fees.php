<?php
/**
 * Plugin Name:    Give - Basic Fees
 * Plugin URI:     https://givewp.com/
 * Description:    Adds a set percentage to donations so the donor covers the gateway fees.
 * Author:         WordImpress
 * Author URL:     https://givewp.com/
 * Version:        1.0
 * Text Domain:    give-basic-fees
 * Domain Path:    /languages
 *
 * Note: This code isn't fully tested yet. Use at your own risk.
 */


/**
 * Adds plugin settings.
 *
 * @param $settings
 *
 * @return array
 */
function give_basic_fees_add_settings( $settings ) {
	$basic_fee_settings = array(
		array(
			'name'       => __( 'Fee Percentage', 'give-basic-fees' ),
			'desc'       => __( 'Adds a gateways fee percentage to the donation. Value should be a number, without a percentage sign.', 'give-basic-fees' ),
			'attributes' => array(
				'placeholder' => '2',
			),
			'id'         => 'basic_fee_percentage',
			'type'       => 'text'
		),
	);

	return give_settings_array_insert(
		$settings,
		'default_gateway',
		$basic_fee_settings
	);
}

add_filter( 'give_settings_gateways', 'give_basic_fees_add_settings', 10, 1 );

/**
 * Displays the fee percentage HTML below the form's top donation amount.
 */
function give_basic_fees_display_percentage() {

	$fee_percentage = give_get_option( 'basic_fee_percentage' );

	echo '<p>' . sprintf( __( 'Plus an additional %1$s (<span class="give-basic-fee-amount"></span>) to cover gateway fees.', 'give-basic-fees' ), $fee_percentage . '%' ) . '</p>';

}

add_action( 'give_after_donation_amount', 'give_basic_fees_display_percentage', 999 );


/**
 * Outputs JS in the footer.
 *
 * Requires jQuery.
 */
function give_basic_fees_js() {
	?>
	<script>
		var give_global_vars;
		//JS for Basic Fee calculation on the fly.
		jQuery(function ($) {

			/**
			 * Event Triggers
			 */
			//When document runs.
			$(document).ready(give_basic_update_percentage());

			//If donation amount update is triggered.
			$(document).on('give_donation_value_updated', function () {
				give_basic_update_percentage();
			});

			//If the donation.
			$(document).on('blur', '.give-donation-amount .give-text-input', function (e) {
				give_basic_update_percentage();
			});

			/**
			 * JS update logic - Basic update percentage JS.
			 */
			function give_basic_update_percentage() {

				//Set vars
				var percentage = <?php echo give_get_option( 'basic_fee_percentage' ); ?>;
				var current_total = $('input[name="give-amount"]').val();

				//Unformat current total so fee calculation is correct for larger donations.
				current_total = Math.abs(parseFloat(accounting.unformat(current_total, give_global_vars.decimal_separator)));
				var fee = current_total * (percentage / 100);
				var new_total = current_total + fee;

				//Set the custom amount input value format properly
				var format_args = {
					symbol: give_global_vars.currency_sign,
					decimal: give_global_vars.decimal_separator,
					thousand: give_global_vars.thousands_separator,
					precision: give_global_vars.number_decimals
				};
				fee = accounting.formatMoney(fee, format_args);
				new_total = accounting.formatMoney(new_total, format_args);

				//Update fee information text.
				$('span.give-basic-fee-amount').text(fee);

				//Update final total text.
				$('.give-final-total-amount').text(new_total);

			}

		});

	</script>

<?php }

add_action( 'wp_print_footer_scripts', 'give_basic_fees_js' );


/**
 * Adds the fee to the donation upon submit.
 *
 * @param $sanitized_amount
 *
 * @return string
 */
function give_basic_fees_add_fee( $sanitized_amount ) {

	$fee_percentage = (int) give_get_option( 'basic_fee_percentage' );
	$fee            = $sanitized_amount * ( $fee_percentage / 100 );
	$new_total      = $fee + $sanitized_amount;

	return $new_total;

}

add_filter( 'give_donation_total', 'give_basic_fees_add_fee', 1, 1 );