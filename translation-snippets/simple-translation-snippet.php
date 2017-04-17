<?php
/**
 * A local translation snippet. Change 'YOUR TEXT HERE' to your desired text.
 *
 * @param $translations
 * @param $text
 * @param $domain
 *
 * @return string
 */
function my_give_text_switcher( $translations, $text, $domain ) {
	// changes the "Donations" text in multiple places
	if ( $domain == 'give' && $text == 'Donations' ) {
		$translations = __( 'YOUR TEXT HERE', 'give' );
	}
  
	// changes the "Make this Donation [monthly/weekly/daily]"
	// text for a donor's choice recurring checkbox
	if ( $domain == 'give-recurring' && $translations == 'Make this Donation' ) {
		$translations = __( 'YOUR TEXT HERE', 'give-recurring' );
	}
  
	// changes the "[Make this Donation] Weekly"
	// text for a donor's choice recurring checkbox
	if ( $domain == 'give-recurring' && $translations == 'Weekly' ) {
		$$translations = __( 'YOUR TEXT HERE', 'give-recurring' );
	}
  
	return $translations;
}
add_filter( 'gettext', 'my_give_text_switcher', 10, 3 );
