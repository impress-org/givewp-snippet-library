<?php
/**
 * Set a custom currency programmatically per donation form.
 *
 * WARNING: The follow snippet does not take into account reporting.
 *
 * All your reports will still assume there is one currency set globally. In order to have reports with one or more currencies per form you will need to install the Currency Switcher add-on.
 */

/**
 * Set a custom currency for only a single donation form.
 *
 * @param integer $donation_or_form_id Donation ID or Form ID.
 * @param  array  $args                Additional argument.
 *
 * @return string The currency symbol
 */
function myprefix_give_per_form_currency( $currency, $donation_or_form_id, $args ) {

	// Update form ID here to match your form ID.
	$form_id = 28;

	// Make sure this is a donation form, not a donation payment.
	if (
		is_numeric( $donation_or_form_id )
		&& 'give_forms' === get_post_type( $donation_or_form_id )
		&& $form_id === $donation_or_form_id
	) {
		add_filter( 'give_get_currency_formatting_settings', 'myprefix_give_customer_currency_formatting', 10, 1 );

		return 'EUR';
	}

	if ( give_is_success_page() ) {
		add_filter( 'give_get_currency_formatting_settings', 'myprefix_give_customer_currency_formatting', 10, 1 );
	}

	return $currency;
}

add_filter( 'give_currency', 'myprefix_give_per_form_currency', 10, 3 );

/**
 * Change currency when processing the payment.
 *
 * @param array $payment_data Posted payment data.
 *
 * @return mixed
 */
function myprefix_give_pre_insert_payment( $payment_data ) {
	// Replace it with your form ID.
	$form_id = 28;

	// Replace it with your form currency.
	$form_currency = 'EUR';

	// Change the form id and currency as per your requirement.
	$payment_data['currency'] = $form_id === $payment_data['give_form_id'] ? $form_currency : $payment_data['currency'];

	return $payment_data;
}

add_filter( 'give_pre_insert_payment', 'myprefix_give_pre_insert_payment', 10, 1 );


/**
 * @param string $id_or_currency_code Currency Code.
 *
 * @return array
 */
function myprefix_give_customer_currency_formatting( $id_or_currency_code ) {
	return array(
		'currency_position'   => 'before',
		'thousands_separator' => ',',
		'decimal_separator'   => '.',
		'number_decimals'     => 2,
	);
}
