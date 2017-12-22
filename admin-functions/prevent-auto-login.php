<?php

/**
 *  Prevents donors from being auto-logged-in if they register during donation
 *
 */
 
add_filter('give_log_user_in_on_register', 'give_dont_auto_login');

function give_dont_auto_login() {
	return false;
}
