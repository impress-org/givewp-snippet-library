<?php
/**
 * Customize Give's Email Headings
 *
 * Use this snippet to update the donation email's main headings; for instance "New Donation!", etc.
 *
 * @param $message
 * @param $email_obj
 */
function my_custom_give_email_headings( $message ) {

	switch ( $message ) {

		case 'New Donation!':
			$message = 'Boom! New Donation';
			break;
		case 'Donation Receipt':
			$message = 'Your Donation Receipt';
			break;

	}

	return $message;

}

add_filter( 'give_email_heading', 'my_custom_give_email_headings', 10, 1 );