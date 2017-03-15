<?php
/**
 * Translate "Personal Info" tooltips
 *
 * @param $translations
 * @param $text
 * @param $domain
 *
 * @return string
 */
function my_give_text_switcher( $translations, $text, $domain ) {

	// Changes "First Name" tooltip
	if ( $domain == 'give' && $text == 'We will use this to personalize your account experience.' ) {
		return 'Wir verwenden Ihren Vornamen für die Personalisierung Ihrer Spende.';
	}

	// Changes "Last Name" tooltip
	if ( $domain == 'give' && $text == 'We will use this as well to personalize your account experience.' ) {
		return 'Wir verwenden Ihren Nachnamen für die Personalisierung Ihrer Spende.';
	}

	// Changes "Name" tooltip
	if ( $domain == 'give' && $text == 'We will send the donation receipt to this address.' ) {
		return 'Wir schicken Ihre Spendenquittung an diese E-Mail-Adresse.';
	}

	return $translations;
}

add_filter( 'gettext', 'my_give_text_switcher', 10, 3 );