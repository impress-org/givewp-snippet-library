<?php
/**
 * Use this function to unset/remove/disable one or more recurring periods.
 * This snippet removes the "Daily" and "Weekly" options from the recurring periods.
 * 
 * For Reference, all current options are: 
 * day 
 * week
 * month
 * quarter
 * year 
 * 
 * Each option must be unset individually, as shown below.
 *
 * @param array $periods
 *
 * @return array $periods
 */
function my_give_recurring_periods( $periods ) {
	unset( $periods['day'] );
	unset( $periods['week'] );

	return $periods;
}
add_filter( 'give_recurring_periods', 'my_give_recurring_periods' );

