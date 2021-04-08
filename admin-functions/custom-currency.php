<?php
/**
 * Adds a new Currency symbol and name to Give payment options.
 *
 * @since 1.0
 *
 * NOTE: Give supports all currencies that PayPal Standard offers
 * See here: https://developer.paypal.com/docs/classic/api/country_codes/
 *
 * Get the Unicode for Currencies here:
 * https://www.w3schools.com/charsets/ref_utf_currency.asp
 *
 * This adds the currency as an option in your currency settings
 * and will output in your front-end forms. But it is up to your
 * Payment Gateway to handle that currency correctly.
 * This means that even though the form will show your currency, and
 * you'll see the reports with this currency, your Payment processor
 * may reflect something different.
 */

/**
 * Adds Vietnamese đồng currency to your Give settings
 * it's required Give minimum Version 1.8.15
 *
 * @since 1.8.15
 *
 * @param $currencies
 *
 * @return mixed
 */
function my_give_add_costarican_currency( $currencies ) {
	$currencies['VND'] = array(
		'admin_label' => __( 'Vietnamese đồng (₫)', 'give' ),
		'symbol'      => '&#8363;',
		'setting'     => array(
			'currency_position'   => 'after',
			'thousands_separator' => '.',
			'decimal_separator'   => ',',
			'number_decimals'     => 2,
		),
	);

	return $currencies;
}

add_filter( 'give_register_currency', 'my_give_add_costarican_currency', 10, 1 );
