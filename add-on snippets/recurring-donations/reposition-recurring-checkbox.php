<?php
/**
 * Customize the Recurring Checkbox location for ALL forms.
 *
 * Important - rename this function so it's unique to avoid conflicts.
 *
 * This function unhooks Give's checkbox output action and then sets it to a desired location (see https://givewp.com/documentation/developers/actions-explanation-and-usage/ for all available actions) within the donation form using a separate action.
 */
function my_customize_recurring_checkbox_location(){

	//First we remove the action.
	remove_action( 'give_after_donation_levels', 'give_output_donors_choice_checkbox', 10 );


	//Then we re-add it to our desired location.
	add_action( 'give_before_donation_levels', 'give_output_donors_choice_checkbox', 10, 2 );


}

add_action('give_checkout_form_top', 'my_customize_recurring_checkbox_location', 1);
