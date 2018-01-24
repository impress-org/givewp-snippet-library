<?php

/*
 * Customizes the "Download Receipt" text everywhere it is output by the PDF Receipts add-on.
 * 
 * The example changes it to "Download Tax Receipt"
 */

add_filter( 'give_pdf_receipt_shortcode_link_text', 'my_give_pdf_text' );

function my_give_pdf_text() {
	return "Download Tax Receipt";

}