<?php

/**
 *   Show All Donation Statuses
 *   @since Give version 1.8.12
 *   Shows all donation statuses in sub-menu
 *   whether donations match that status or not.
 */

// Check if function does not exists.
if ( ! function_exists( 'give_payments_table_show_all_status_callback' ) ) {
	function give_payments_table_show_all_status_callback( $value ) {
		return true;
	}
}
/**
 * This filter will show all the donation status in side the donation submenu of admin dashboard.
 *
 * @param bool $value To show or hide the status Menu.
 *
 * @return bool $value;
 */
add_action( 'give_payments_table_show_all_status', 'give_payments_table_show_all_status_callback', 10, 1 );
