<?php
/**
 * Customize Authorize.net payment params. In this case, a custom invoice prefix.
 *
 * @param array $args The request that's sent to Authorize.net
 *
 * @return array $args
 */
function my_custom_authorizenet_invoice_prefix($args){

	// invoiceNumber is limited to 20 characters.
	$args['transactionRequest']['order']['invoiceNumber'] = substr('rcr**PACK*' . $args['transactionRequest']['order']['invoiceNumber'], 0, 19);

	return $args;

}

add_filter( 'give_authorize_payment_args', 'my_custom_authorizenet_invoice_prefix', 100 );