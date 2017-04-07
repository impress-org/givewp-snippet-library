<?php
/**
 * A local translation snippet. Change 'YOUR TEXT HERE' to your desired text.
 *
 * @param $translation
 * @param $text
 * @param $domain
 *
 * @return string
 */
function my_give_text_switcher( $translation, $text, $domain ) {
	if ( 'give' === $domain ) {
		switch ( $translation ) {
			/*
			 * Changes the "Donations" text in multiple places.
			 */
			case 'Donations' :
				$translation = __( 'YOUR TEXT HERE', 'give' );
				break;
		}
	} elseif ( 'give-recurring' === $domain ) {
		switch ( $translation ) {
			/*
			 * Changes the "Make this Donation [monthly/weekly/daily]" text for
			 * a donor's choice recurring checkbox.
			 */
			case 'Make this Donation' :
				$translation = __( 'YOUR TEXT HERE', 'give' );
				break;

			/*
			 * Changes the "[Make this Donation] Weekly" text for a donor's
			 * choice recurring checkbox.
			 */
			case 'Weekly' :
				$translation = __( 'YOUR TEXT HERE', 'give' );
				break;
		}
	}

	return $translation;
}

add_filter( 'gettext', 'my_give_text_switcher', 10, 3 );
