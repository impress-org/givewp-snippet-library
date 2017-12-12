<?php

/**
 *  Disables the "Donation" row from the Donation Receipt page
 *
 */
 
 function my_give_custom_receipt_items( $args, $donation_id, $form_id ) {

	$updated_args['donation'] = array(
		'display' => false,
	);
	return array_merge($args, $updated_args);
}

add_filter( 'give_donation_receipt_args', 'my_give_custom_receipt_items', 30, 3 );
