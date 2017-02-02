<?php
/**
 * Customize the Default State in the select field
 * 
 * @description: This works when a donor is not logged out, if they are logged in then it will default to their donor profile state
 *
 * @return string
 */

function your_prefix_set_give_state() {
	return "OH";
}

add_filter( 'give_give_state', 'your_prefix_set_give_state' );
