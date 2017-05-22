<?php
/**
 * Adds text or images before the Credit Card fields on the form
 *
 * Note: to style these images, use a CSS snippet like this:
 *  .my_custom_alert img {
 *    margin: .2em .5em;
 *    max-height: 35px;
 *   }
 *
 */
function my_custom_alert_message() {

	$amex       = GIVE_PLUGIN_URL . '/assets/images/amex.png';
	$diners     = GIVE_PLUGIN_URL . '/assets/images/diners-club.png';
	$discover   = GIVE_PLUGIN_URL . '/assets/images/discover.png';
	$jcb        = GIVE_PLUGIN_URL . '/assets/images/jcb.png';
	$maestro    = GIVE_PLUGIN_URL . '/assets/images/maestro.png';
	$mastercard = GIVE_PLUGIN_URL . '/assets/images/mastercard.png';
	$unionpay   = GIVE_PLUGIN_URL . '/assets/images/unionpay.png';
	$visa       = GIVE_PLUGIN_URL . '/assets/images/visa.png';

	$output = "<div class='my_custom_alert'>";

	//to display AMEX, leave this line as is. Otherwise, delete it.
	$output .= "<img src='" . $amex . "' />";

	//to display Diners Club, leave this line as is. Otherwise, delete it.
	$output .= "<img src='" . $diners . "' />";

	//to display DISCOVER, leave this line as is. Otherwise, delete it.
	$output .= "<img src='" . $discover . "' />";

	//to display JCB, leave this line as is. Otherwise, delete it.
	$output .= "<img src='" . $jcb . "' />";

	//to display MAESTRO, leave this line as is. Otherwise, delete it.
	$output .= "<img src='" . $maestro . "' />";

	//to display MASTERCARD, leave this line as is. Otherwise, delete it.
	$output .= "<img src='" . $mastercard . "' />";

	//to display UNIONPAY, leave this line as is. Otherwise, delete it.
	$output .= "<img src='" . $unionpay . "' />";

	//to display VISA, leave this line as is. Otherwise, delete it.
	$output .= "<img src='" . $visa . "' />";

	$output .= "</div>";

	echo $output;
}


add_action( 'give_before_cc_fields', 'my_custom_alert_message' );