<?php
/**
 * Add a custom tag to be supported in PDF Receipts
 *
 * This tag adds the new {amount} tag
 *
 * @param $template_content
 * @param $payment_id
 *
 * @return mixed
 */
function give_add_amount_support( $template_content, $payment_id ) {

	// If fee recovery is active, use the replace method there.
	if ( method_exists( 'Give_Fee_Recovery_Admin', 'give_fee_email_tag_amount' ) ) {
		$template_content = str_replace( '{amount}', give_fee_recovery()->plugin_admin->give_fee_email_tag_amount( $payment_id ), $template_content );
		return $template_content;
	}

	// Fee recovery not available. Output total.
	$payment = new Give_Payment( $payment_id );

	$give_amount = give_currency_filter( give_format_amount( $payment->total, array( 'sanitize' => false ) ), $payment->currency );

	$amount           = html_entity_decode( $give_amount, ENT_COMPAT, 'UTF-8' );
	$template_content = str_replace( '{amount}', $amount, $template_content );

	return $template_content;
}

add_filter( 'give_pdf_get_template_content', 'give_add_amount_support', 10, 2 );