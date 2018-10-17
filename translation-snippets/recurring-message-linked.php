<?php

/* 
 * Update No Subscriptions Message to link to become a Subscriber
 *
 */

function my_give_recurring_message_switcher( $translations, $text, $domain ) {
	// changes the "Donations" text in multiple places
	if ( $domain == 'give-recurring' && $text == 'You have not made any subscription donations.' ) {
		$translations = __( 'You are not yet a recurring donor. Help sustain our work by <a href="https://example.com/donations/your-donation-form">becoming one today</a>.', 'give-recurring' );
	}
	
	return $translations;
}

add_filter( 'gettext', 'my_give_recurring_message_switcher', 10, 3 );
