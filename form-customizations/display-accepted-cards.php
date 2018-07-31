<?php
/**
 * Adds text or images before the Credit Card fields on the form
 *
 * Note: to style these images, use a CSS snippet like this:
 *  .my-give-accepted-card-images img {
 *    margin: .2em .5em;
 *    max-height: 35px;
 *   }
 */
function my_give_display_accepted_card_images() {

	$amex       = GIVE_PLUGIN_URL . '/assets/dist/images/amex.png';
	$diners     = GIVE_PLUGIN_URL . '/assets/dist/images/diners-club.png';
	$discover   = GIVE_PLUGIN_URL . '/assets/dist/images/discover.png';
	$jcb        = GIVE_PLUGIN_URL . '/assets/dist/images/jcb.png';
	$maestro    = GIVE_PLUGIN_URL . '/assets/dist/images/maestro.png';
	$mastercard = GIVE_PLUGIN_URL . '/assets/dist/images/mastercard.png';
	$unionpay   = GIVE_PLUGIN_URL . '/assets/dist/images/unionpay.png';
	$visa       = GIVE_PLUGIN_URL . '/assets/dist/images/visa.png';

	$output = "<div class='my-give-accepted-card-images'>";

	// to display AMEX, leave this line as is. Otherwise, delete it.
	$output .= "<img src='" . esc_url( $amex ) . "' />";

	// to display Diners Club, leave this line as is. Otherwise, delete it.
	$output .= "<img src='" . esc_url( $diners ) . "' />";

	// to display DISCOVER, leave this line as is. Otherwise, delete it.
	$output .= "<img src='" . esc_url( $discover ) . "' />";

	// to display JCB, leave this line as is. Otherwise, delete it.
	$output .= "<img src='" . esc_url( $jcb ) . "' />";

	// to display MAESTRO, leave this line as is. Otherwise, delete it.
	$output .= "<img src='" . esc_url( $maestro ) . "' />";

	// to display MASTERCARD, leave this line as is. Otherwise, delete it.
	$output .= "<img src='" . esc_url( $mastercard ) . "' />";

	// to display UNIONPAY, leave this line as is. Otherwise, delete it.
	$output .= "<img src='" . esc_url( $unionpay ) . "' />";

	// to display VISA, leave this line as is. Otherwise, delete it.
	$output .= "<img src='" . esc_url( $visa ) . "' />";

	$output .= '</div>';

	echo wp_kses_post( $output );
}


add_action( 'give_before_cc_fields', 'my_give_display_accepted_card_images' );
