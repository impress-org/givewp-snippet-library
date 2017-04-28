<?php
/**
 * Disable Decimals for Donations
 *
 * If you don't want any decimals throughout Give use the following function
 */


/**
 * No Decimals
 *
 * Be sure to customize the function name below to prevent conflicts!
 *
 * @return int
 */
function my_give_no_decimals() {
	return 0;
}

add_filter( 'give_format_amount_decimals', 'my_give_no_decimals' );