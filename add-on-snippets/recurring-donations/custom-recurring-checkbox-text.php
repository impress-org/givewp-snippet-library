<?php
/**
 * Customize the Recurring Checkbox Text
 *
 * Important - rename this function so it's unique to avoid conflicts.
 *
 * Requires Recurring Donations version 1.6+.
 *
 * This function allows admins to customize the checkbox text that is presented to donors to opt-in to recurring donations.
 *
 * @param string $default_text
 * @param string $period
 * @param int $times
 * @param string $show_period
 * @param int $form_id
 *
 * @return string
 */
function my_customize_recurring_checkbox_text( $default_text, $period, $times, $show_period, $form_id ) {

	// Customize the default text
	// Uncomment the chosen customization below:
	// Example 1: "Make this Donation Recurring Monthly
	$period_functionality = give_get_meta( $form_id, '_give_period_functionality', true );

	$show_period = ( 'donors_choice' === $period_functionality ? give_recurring_donors_choice_period_element( $form_id ) : give_recurring_pretty_subscription_frequency( $period, $times, true ) );

	// Example 1: Donor's Choice Period (select field on form w/ periods).
	$default_text_example_1 = sprintf(
		esc_html__( 'I\'d like to make this donation %1$s', 'give-recurring' ),
		$show_period
	);

	//Example 2: Preset period "Monthly Recurring Donation"
	$default_text_example_2 = __( 'Monthly Recurring Donation', 'give-recurring' );

	// Return either variable from above depending on your configuration.
	return $default_text_example_1;

}

add_filter( 'give_recurring_output_donors_choice_text', 'my_customize_recurring_checkbox_text', 10, 5 );

