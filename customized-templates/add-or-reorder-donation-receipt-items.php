<?php
/**
 * Add or Reorder Donation Receipt.
 *
 * @params array    $args
 * @params int      $donation_id
 * @params int      $form_id
 *
 * @since  1.8.8
 *
 * @return array
 */
function my_give_reorder_donation_receipt_items( $args, $donation_id, $form_id ) {

	$updated_args = array();

	// Rearrange the $updated_args based on your need.
	$updated_args['date']            = $args['date'];
	$updated_args['donor']           = $args['donor'];
	$updated_args['donation']        = $args['donation'];
	$updated_args['donation_id']     = $args['donation_id'];
	$updated_args['total_donation']  = $args['total_donation'];
	$updated_args['donation_status'] = $args['donation_status'];
	$updated_args['payment_details'] = $args['payment_details'];
	$updated_args['payment_key']     = $args['payment_key'];
	$updated_args['payment_method']  = $args['payment_method'];

	// Add new item to the donation receipt.
	$updated_args['slug'] = array(
		'name'    => __( 'Label', 'give' ),
		'value'   => 'any custom value',
		'display' => true,// true or false | whether you need to display the new item in donation receipt or not.
	);

	return $updated_args;

}

add_filter( 'give_donation_receipt_args', 'my_give_reorder_donation_receipt_items', 30, 3 );
