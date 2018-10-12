<?php

/**
 * CCAvenue Per Form Credentials.
 *
 * This allows you to customize the CCAvenue API for multiple accounts.
 *
 * @param $credentials
 *
 * @return array
 */
function my_customer_give_ccavenue_per_form_credentials( $credentials ) {

	$form_id = absint( $_GET['form-id'] );

	// Update "18" here to be the ID of the donation form you want to customize.
	if ( 18 === $form_id ) {
		$credentials = array(
			'merchant_id' => 'INSERT MERCHANT ID FOR THIS FORM HERE',
			'working_key' => 'INSERT WORKING KEY FOR THIS FORM HERE',
			'access_code' => 'INSERT ACCESS CODE FOR THIS FORM HERE',
		);
	} elseif ( 20 === $form_id ) {
		$credentials = array(
			'merchant_id' => 'INSERT MERCHANT ID FOR THIS FORM HERE',
			'working_key' => 'INSERT WORKING KEY FOR THIS FORM HERE',
			'access_code' => 'INSERT ACCESS CODE FOR THIS FORM HERE',
		);
	}

	// Important to always return credentials.
	// If none of the form ID conditions are me above then it will return the global settings credentials.
	return $credentials;
}

add_filter( 'give_ccavenue_get_merchant_credentials', 'my_customer_give_ccavenue_per_form_credentials', 10, 1 );