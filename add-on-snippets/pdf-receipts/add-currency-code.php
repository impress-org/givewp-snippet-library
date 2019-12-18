<?php

/**
 * Adds the currency code (USD, INR, CAD, etc) to a pdf template tag of {abbr}
 *
 * @return string
 */

 function give_add_currency_pdf_tag( $template_content, $args ) {
	// during testing, uncomment the next line to see a full printed array of the possible args that you can query
	// var_dump("<pre>".print_r($args,true)."</pre>");
	if ( ! empty( $args['payment_meta']['_give_payment_currency'] ) ) {
		$template_content = str_replace( '{abbr}', $args['payment_meta']['_give_payment_currency'], $template_content );
	}
	return $template_content;
}

add_filter( 'give_pdf_compiled_template_content', 'give_add_currency_pdf_tag', 999, 2 );