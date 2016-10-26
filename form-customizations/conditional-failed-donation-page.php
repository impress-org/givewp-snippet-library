<?php
/**
 * Change the transaction failed page on a per-form basis.
 *
 * Form ID 650 is given as an example.
 *
 * @param $uri
 *
 * @return string|void
 */
function my_give_change_failed_transaction_uri( $uri ) {

	$form_id = isset( $_POST['give-form-id'] ) ? $_POST['give-form-id'] : '';

	if ( $form_id == 650 ) {
		//Return a custom permalink or URL.
		return get_permalink( 123 );
	} else {
		//Always return default $uri.
		return $uri;
	}

}

add_filter( 'give_get_failed_transaction_uri', 'my_give_change_failed_transaction_uri', 13 );