<?php

/*  
 *  Customize the number of Donations listed in the Donations screen
 *
 */
 
 
add_filter('give_payment_table_payments_query', 'custom_donation_list_num', 30, 1);

function custom_donation_list_num($args = array()) {

	$updated_args = array(
		'number'    => 50, // Default is 30
	);

	return array_merge( $args, $updated_args );
}
