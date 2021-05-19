<?php
/**
 * Add a custom tag to be supported in PDF Receipts
 *
 * This tag adds a new {gift_aid_status} tag which displays Yes if the donor checked the Gift Aid 
 * checkbox and No if it was not selected.
 *
 * @param $template_content
 * @param $args
 *
 * @return mixed
 */
 
function give_add_gift_aid_status_pdf_tag( $template_content, $args ) {	
	$gift_aid_status  = isset( $args['payment_meta']['_give_gift_aid_accept_term_condition'] ) && $args['payment_meta']['_give_gift_aid_accept_term_condition'] == 'on' ? __('Yes', 'give') : __('No', 'give');
	$template_content = str_replace( '{gift_aid_status}', $gift_aid_status, $template_content );
	return $template_content;
}

add_filter( 'give_pdf_compiled_template_content', 'give_add_gift_aid_status_pdf_tag', 999, 2 );
