<?php
/**
 * A local translation snippet specifically for the Donor's choice checkbox. Change 'YOUR TEXT HERE' to your desired text.
 *
 * @param $translations
 * @param $text
 * @param $domain
 *
 * @return string
 */
function my_give_recurring_donor_choice_text_switcher( $translations, $text, $domain ) {
	// changes the "every" text in the "Make this donation every [month/week/day]
	// This section must be translated BEFORE the next one, so that the translated string is passed into the next string.
	if ( $domain == 'give-recurring' && $text == 'Every' ) {
		$translations = __( 'YOUR TEXT HERE', 'give' );
	}

	// changes the "Make this Donation [monthly/weekly/daily]"
	// text for a donor's choice recurring checkbox
	if ( $domain == 'give-recurring' && $translations == 'Make this donation %1$s' ) {
		$translations = __( 'YOUR TEXT HERE %1$s', 'give-recurring' );
	}

	return $translations;
}
add_filter( 'gettext', 'my_give_recurring_donor_choice_text_switcher', 10, 3 );
