<?php

/**
 *  Add a custom tag to be supported in PDF Receipts
 *
 *  This tag adds the new {amount} tag
 */
 
add_filter('give_pdf_get_template_content', 'give_add_amount_support', 10, 9);

function give_add_amount_support( $template_content ) {

	$price = give_currency_filter( give_format_amount( 10.50, array( 'sanitize' => false ) ) );

	$template_content = str_replace( '{amount}', $price, $template_content );

	return $template_content;
    
}
