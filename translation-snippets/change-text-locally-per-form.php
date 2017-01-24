<?php

/*
 * A local translation snippet for making text changes to only one of the forms.
 * Change 'YOUR TEXT HERE' to your desired text, and the "964" to the form ID you'd like to modify.
 *
 * Also, ensure that all functions here have unique names to avoid conflicts.
 *
 */

function my_give_picky_text_switcher( $translations, $text, $domain ) {


	if ( $domain == 'give' && $text == 'Donation Total:' ) {
		return __( 'YOUR TEXT HERE', 'give' );
	}


	return $translations;
}

function my_give_confirm_form( $form_id ) {

	if ( $form_id == 964 ) {
		add_filter( 'gettext', 'my_give_picky_text_switcher', 10, 3 );
	}
}

add_action( 'give_pre_form_output', 'my_give_confirm_form', 10, 1);