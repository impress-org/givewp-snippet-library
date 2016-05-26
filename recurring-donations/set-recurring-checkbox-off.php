<?php
/**
 * Set the Donor's Choice checkbox to "off" by default
 * 
 * @return string
 */
function set_recurring_checkbox_off(){
	return '';
}
add_filter('give_recurring_donors_choice_checked', 'set_recurring_checkbox_off');
