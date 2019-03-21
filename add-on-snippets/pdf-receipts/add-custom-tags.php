<?php
/**
 * Add a custom tag to be supported in PDF Receipts
 *
 * This tag adds a new {total} tag which displays a total without breaking it down 
 * if Fee Recovery is enabled.
 *
 * @param $template_content
 * @param $args
 *
 * @return mixed
 */
 
function give_add_total_pdf_tag( $template_content, $args ) {
	
	// during testing, uncomment the next line to see a full printed array of the possible args that you can query
	// var_dump("<pre>".print_r($args,true)."</pre>");
	
	$total     = isset( $args['payment_meta']['_give_payment_total'] ) ? html_entity_decode( give_currency_filter( give_format_amount( $args['payment_meta']['_give_payment_total'] ) ), ENT_COMPAT, 'UTF-8' ) : '';
	$template_content = str_replace( '{total}', $total, $template_content );
	return $template_content;
}

add_filter( 'give_pdf_compiled_template_content', 'give_add_total_pdf_tag', 999, 2 );
