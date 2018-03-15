<?php

/**
 * Limit the
 *
 * @param $progress
 * @param $form_id
 * @param $form
 *
 * @return int
 */
function limit_donation_exceed_to_100( $progress, $form_id, $form ) {
	$goal_format         = give_get_meta( $form_id, '_give_goal_format', true );
	$income              = $form->get_earnings();
	$goal                = $form->goal;
	$donations_goal      = give_get_meta( $form_id, '_give_number_of_donation_goal', true );
	$donations_completed = give_get_form_sales_stats( $form_id );

	return 'donation' === $goal_format ? ( $donations_completed >= $donations_goal ? 100 : $progress ) : ( $income >= $goal ? 100 : $progress );
}


add_filter( 'give_goal_amount_funded_percentage_output', 'limit_donation_exceed_to_100', 10, 3 );