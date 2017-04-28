<?php
/**
 * Customize the Recurring Checkbox Text
 *
 * Important - rename this function so it's unique to avoid conflicts.
 *
 * This function allows admins to customize the checkbox text that is presented to donors to opt-in to recurring donations
 *
 * @param $default_text
 * @param $period
 * @param $times
 *
 * @return string
 */
function my_customize_recurring_checkbox_text($default_text, $period, $times){

	//Use function to get nice subscription frequency
	$pretty_period = give_recurring_pretty_subscription_frequency( $period, $times );

	//Customize the default text
	//Uncomment the chosen customization below:
	//Example 1: "Make this Donation Recurring Monthly
//	$default_text = __('Make this Donation Recurring') . ' ' . $pretty_period;

	//Example 2: "Monthly Recurring Donation"
	$default_text = $pretty_period . ' ' . __('Recurring Donation');

	return $default_text;

}

add_filter('give_recurring_output_donors_choice_text', 'my_customize_recurring_checkbox_text', 10, 3 );