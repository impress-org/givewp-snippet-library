/*
 * Set the Donor's Choice checkbox to "off" by default
 *
 */
 
add_filter('give_recurring_donors_choice_checked', 'set_recurring_checkbox_off');

function set_recurring_checkbox_off(){
	return '';
}
