<?php
/**
 * Change the Anonymous Donation text on the form's front end.
 *
 * @param string $text
 *
 * @return string $text
 */

function custom_anonymous_donation_checkbox_label($text) {
	$text = 'YOUR CUSTOM TEXT HERE';
	return $text;
}

add_filter( 'give_anonymous_donation_checkbox_label', 'custom_anonymous_donation_checkbox_label' );
