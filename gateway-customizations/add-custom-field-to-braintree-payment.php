<?php
/**
 * Adds the donation form title to Braintree donation arguments.
 *
 * NOTE: You need to manually add this custom field in your Braintree admin panel BEFORE adding this custom snippet. Otherwise, you WILL receive an API error. Once you add that field, this snippet will add the donation form title to Braintree payment under custom fields if, once agian, you have added that custom field on Braintree with the "form_title" name.
 *
 * @see https://developers.braintreepayments.com/reference/request/transaction/sale/php#custom_fields
 * @see https://articles.braintreepayments.com/control-panel/custom-fields
 *
 * @param array $transaction
 *
 * @return array
 */
function give_braintree_add_form_title( $transaction ) {
	$transaction['customFields']['form_title'] = esc_attr( give_get_meta( $transaction['orderId'], '_give_payment_form_title', true ) );

	return $transaction;
}

add_action( 'give_braintree_transaction_args', 'give_braintree_add_form_title' );
