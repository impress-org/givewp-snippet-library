<?php
/**
 * Give Custom Offline Donation Instructions
 *
 * Customizes the Offline Donation Instructions that show up after a donation has been made. 
 * This snippet only affects the output on the page after a donor submits an offline donation, it does not affect the instructions on the form itself.
 *
 * @return string|void
 */
 
add_filter('give_receipt_offline_payment_instruction', 'my_give_offline_reciept_instructions');

function my_give_offline_reciept_instructions () {
	$custom = "<p>Thanks for agreeing to donate! </p>";
	$custom .= "<p> Here's the steps: </p>";
	$custom .= " <ol><li>Mail your check to us at the address listed below</li>";
	$custom .= " <li>We'll email you a receipt to the email you submitted.</li></ol>";
	$custom .= " <blockquote>123 YourAddress</br>";
	$custom .= " AnyTown<br />";
	$custom .= " North Carolina, 27777</blockquote></br>";
	$custom .= " <p> Thanks so much for your donation!</p>";

	return $custom;
}