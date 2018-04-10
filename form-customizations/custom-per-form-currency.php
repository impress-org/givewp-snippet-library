<?php
/**
 * Set a custom currency for only a single donation form.
 *
 * @param int $donation_or_form_id
 * @param     $args
 *
 * @return string The currency symbol
 */
function myprefix_give_per_form_currency( $currency, $donation_or_form_id, $args ) {

	// Update form ID here to match your form ID.
	$form_id = 12;

	// Make sure this is a donation form, not a donation payment.
	if (
		is_numeric( $donation_or_form_id )
		&& 'give_forms' === get_post_type( $donation_or_form_id )
		&&  $form_id === $donation_or_form_id
	) {

		add_filter( 'give_get_currency_formatting_settings', 'myprefix_give_customer_currency_formatting', 10, 1 );
		return 'EUR';
		
	}


	if ( give_is_success_page()  ) {

		add_filter( 'give_get_currency_formatting_settings', 'myprefix_give_customer_currency_formatting', 10, 1 );

	}

}

add_filter( 'give_currency', 'myprefix_give_per_form_currency', 10, 3 );


/**
 *
 * @param $id_or_currency_code
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

