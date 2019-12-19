<?php
/**
 * Add form title to Braintree donation arguments
 * Note: This snippet will add form title to Branintree payment under custom fields if a custom field exist on Braintree with form_title api name
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