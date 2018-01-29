<?php
/**
 * Use this function to unset/remove/disable one or more recurring periods.
 * This below snippets remove the Daily and Weekly option from the recurring periods.
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

