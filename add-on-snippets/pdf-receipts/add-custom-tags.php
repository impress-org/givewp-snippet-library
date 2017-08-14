<?php
/**
 *  Add a custom tag to be supported in PDF Receipts
 *
 *  This tag adds the new {amount} tag
 */
function give_add_amount_support( $template_content ) {

	$donation_id = give_pdf_get_payment_number( $payment_id );

	$payment = new Give_Payment( $donation_id );

	$give_amount = give_currency_filter( give_format_amount( $payment->total, array( 'sanitize' => false ) ), $payment->currency );

	$amount           = html_entity_decode( $give_amount, ENT_COMPAT, 'UTF-8' );
	$template_content = str_replace( '{amount}', $amount, $template_content );

	return $template_content;
}

add_filter( 'give_pdf_get_template_content', 'give_add_amount_support', 10, 1 );

