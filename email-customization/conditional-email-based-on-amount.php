<?php
/**
 * Customize Give's Email Message based on Donation Amount
 *
 * This snippet checks for a donation amount to a certain form (ID 1329 in the example code), and then 
 * 1. sends a custom message for donations under ($)5 
 * 2. sends the default message for anything between ($)5 and ($)500
 * 3. sends a different custom message for donations over ($)500
 * 
 * NOTE: this snippet has not been tested thoroughly, especially alongside the Per Form Emails add-on. Use at your own risk.
 *
 * @param $email_body the default email body
 * @param $payment_id the donation ID
 * @param $payment_data the donation data (unused)
 */
 
function my_custom_give_email_content( $email_body, $payment_id, $payment_data ) {
	$amount = give_get_payment_amount($payment_id);
	$form_id = give_get_payment_form_id($payment_id);
	//Check if this payment's donation amount and form ID matches the donation form we want custom email body copy

	if ( $amount < 5 && $form_id == '1329'  ) {
		//Here you can output custom content or pull from custom post meta using get_post_meta, or use an ACF field, WordPress functions, etc.
		//You can also use Give's email tags like {price}, {fullname}, etc.

		$email_body = '<p>Hi {name}, </p>';
		$email_body .= '<p> your donation to {form_title} was for {price} and that\'s great!</p>';

		//Make sure we return the new $email_body;
		return $email_body;

	} elseif ( $amount > 500 && $form_id == '1329'  ) {
		//Here you can output custom content or pull from custom post meta using get_post_meta, or use an ACF field, WordPress functions, etc.
		//You can also use Give's email tags like {price}, {fullname}, etc.

		$email_body = '<p>Hi {name}, You are a rock star! Thanks for such a large gift</p>';

		//Make sure we return the new $email_body;
		return $email_body;

			//Be sure to return default email body if we don't make a match
		} else {
			return $email_body;
	}
}

add_filter( 'give_donation_receipt', 'my_custom_give_email_content', 10, 3 );