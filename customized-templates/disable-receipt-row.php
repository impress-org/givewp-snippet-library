<?php

/**
 *  Disables the "Donation" row from the Donation Receipt page
 *  See here for a list of other $updated_args:
 *  https://github.com/WordImpress/Give-Snippet-Library/blob/master/customized-templates/add-or-reorder-donation-receipt-items.php
 *
 */
 
 function my_give_custom_receipt_items( $args, $donation_id, $form_id ) {

	$updated_args['donation'] = array(
		'display' => false,
	);
	return array_merge($args, $updated_args);
}

add_filter( 'give_donation_receipt_args', 'my_give_custom_receipt_items', 30, 3 );
