<?php
/**
 * Give Custom Donation Total Label
 *
 * @description: Customizes the "Donation Total" label for all Give forms; be sure to customize the name of the function to avoid conflicts
 *
 * @return string|void
 */
function my123_custom_donation_total_label() {

	return __( 'My Custom Label', 'my_textdomain' );

}

add_filter( 'give_donation_total_label', 'my123_custom_donation_total_label' );