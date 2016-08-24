<?php
/**
 * Change the multilevel text separator on a recurring donation. "10 - Monthly" becomes "10 • Monthly" using this code.
 *
 * @description Requires recurring donations version 1.4
 * @author support@givewp.com
 *
 */

function my_change_recurring_multilevel_separator() {
	return " • ";
}

add_filter('give_recurring_multilevel_text_separator', 'my_change_recurring_multilevel_separator' );