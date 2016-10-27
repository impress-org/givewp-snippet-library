<?php
/**
 *  Creates a shortcode to displays a "nag" (which can be styled with CSS targeting a class of 'my-custom-nag')
 *
 *  Sample shortcodes:
 *
 *  [givetotal total_goal="10,000" link="http://example.com"] displays "So far, we have raised $0 toward our goal of $10,000! Donate now"
 *  (where "0" will be replaced with total earnings from all forms, and "Donate Now" is linked to http://example.com)
 *
 *  [givetotal form_id="34" total_goal="10,000"] will display earnings for just form with an ID of 34.
 *
 *  [givetotal total_goal="9,000" message_before="Hey! We've raised " message_between=" of the " message_after=" we are trying to raise for this campaign!" link="http://example.com" link_text="Help Us Reach Our Goal." form_id="245"]
 *
 *  [givetotal total_goal= "5,000" multi_id="34,114,141"] will display earnings for the three forms with IDs 34, 114, and 141.
 *
 *  Note that "multi_id" will override "form_id", so don't use both.
 */

function my_give_display_earnings_shortcode( $atts ) {
	$total = get_option( 'give_earnings_total', false );

	$atts = shortcode_atts( array(
		'total_goal' => '10,000',
		'link'       => false,
		'form_id'    => false,
		'multi_id'   => '',
		'message_before'    => 'So far, we have raised ',
		'message_between'     => ' toward our goal of ',
		'message_after'     => '! ',
		'link_text'         => 'Donate Now'
	), $atts, 'givetotal' );

	$donate_link = '';

	if ( $atts['link'] != false ) {
		$donate_link = ' <a href="' . $atts['link'] . '">' . $atts['link_text'] . '</a>';
	}

	if ( $atts['form_id'] != false && is_numeric( $atts['form_id'] ) ) {
		$total = get_post_meta( $atts['form_id'], '_give_form_earnings', true );
	}

	if ( $atts['multi_id'] != false ) {
		$total = 0;
		$new_array = preg_split("/,/", $atts['multi_id']);

		foreach ($new_array as $value ) {
			$total += get_post_meta( $value, '_give_form_earnings', true );
		}
	}

	$custom_nag = "<div class='my-custom-nag'>" . $atts['message_before'] . "<span class='my-give-currency'>" . give_currency_symbol( give_get_currency()) . "</span><span class='my-give-raised my-give-amount'>" . give_format_amount( $total ) . "</span>" . $atts['message_between'] . "<span class='my-give-currency'>" . give_currency_symbol( give_get_currency()) . "</span><span class='my-give-total my-give-amount'>" . $atts['total_goal'] . "</span>" . $atts['message_after'] . $donate_link . "</div>";

	return $custom_nag;

}
add_shortcode( 'givetotal', 'my_give_display_earnings_shortcode');
