<?php
/*
 * Removes both the new user notification email and the admin notification email
 * indicating a new user has been created.
 */
function my_give_remove_new_user_notification() {
	remove_action( 'give_insert_user', 'give_new_user_notification', 10);
}

add_action( 'give_insert_user', 'my_give_remove_new_user_notification', 1 );
