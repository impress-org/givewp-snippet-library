<?php

/**
 * Function to change the description data that is passed to authorize.net.
 *
 * Here in the snippet the custom field is a dropdown which is created via FFM.
 *
 * Make sure to replace "cause" with the meta_key of your custom field.
 * If the custom field is a dropdown the value would be stored in an array like "$donation_data['post_data']['cause'][0]"
 * For a text field it would be stored in a variable like "$donation_data['post_data']['cause']", easiest way to check this is to check the "name" attribute
 * For an array it would be "cause[]" and for a variable it would be "cause"
 *
 * @param String $description
 * @param Array $donation_data
 *
 * @return $description
 */
function my_give_authorize_payment_description( $description, $donation_data ) {
	if ( $cause = $donation_data['post_data']['cause'] ) {
		$description = $cause[0];
	}

	return $description;

}
add_filter( 'give_authorize_one_time_payment_description', 'my_give_authorize_payment_description', 10, 2 );
