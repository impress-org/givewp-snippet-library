<?php
/*
 * Move the recurring donor's choice checkbox on a per-form basis
 *
 */
function my_give_move_recurring_checkbox( $form_id ) {

	//moves the checkbox on the form with ID 648 to after the Credit Card fields
	if ( $form_id == 648 ) {
		remove_action( 'give_after_donation_levels', 'give_output_donors_choice_checkbox', 1 );

		add_action( 'give_donation_form_after_cc_form', 'give_output_donors_choice_checkbox', 100, 2 );
	}
	//moves the checkbox on the form with ID 650 to after the personal info fields
	elseif ( $form_id == 650 ) {
		remove_action( 'give_after_donation_levels', 'give_output_donors_choice_checkbox', 1 );

		add_action( 'give_donation_form_after_personal_info', 'give_output_donors_choice_checkbox', 100, 2 );
	} else {
		return;
	}
}

add_action( 'give_pre_form', 'my_give_move_recurring_checkbox' );
