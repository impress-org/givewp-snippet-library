<?php
/**
 * Customize Give's Email Content Per Donation Form
 *
 * Use this snippet to update the donation email's main content.
 *
 * @param $email_body
 * @param $payment_id
 * @param $payment_data
 *
 * @return string
 */
function my_custom_give_email_content( $email_body, $payment_id, $payment_data ) {

	$form_id = give_get_payment_form_id( $payment_id );

	//Check if this payment's donation form ID matches the donation form we want custom email body copy
	if ( $form_id == '1150' ) {

		//Here you can output custom content or pull from custom post meta using get_post_meta, or use an ACF field, WordPress functions, etc.
		//You can also use Give's email tags like {price}, {fullname}, etc.
		$email_body = '<p>Hi {name},</p>';
		$email_body .= '<p>Thank you for your donation to . ' . get_the_title( $form_id ) . '. This is my custom content!</p>';
		$email_body .= '<p>We can add anything here we like...</p>';
		$email_body .= '<p>Even our custom email tags: {receipt_link}</p>';

		//Make sure we return the new $email_body;
		return $email_body;

	} elseif ( $form_id == '460' ) {

		//Here you can output custom content or pull from custom post meta using get_post_meta, or use an ACF field, WordPress functions, etc.
		//You can also use Give's email tags like {price}, {fullname}, etc.
		$email_body = '<p>Hi {name},</p>';
		$email_body .= '<p>Thank you for your donation to . ' . get_the_title( $form_id ) . '. This is some different custom content!</p>';
		$email_body .= '<p>Some different content...</p>';
		$email_body .= '<p>Even our custom email tags: {receipt_link}</p>';

		//Make sure we return the new $email_body;
		return $email_body;

	} else {
		//Be sure to return default email body if we don't make a match
		return $email_body;
	}

}

add_filter( 'give_donation_receipt', 'my_custom_give_email_content', 10, 3 );

