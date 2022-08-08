<?php 
/**
 *  Creates a shortcode to display a message with the total number of donations for a specific donation form.
 *
 *  Sample shortcode:
 *
 * 	In case you have a form with 3 donations, its ID is 123, and the title is Help Old Horses :
 * 	
 *	[give_raised_for_forms form_id="123"] displays "We already have 3 donations for the Help Old Horses campaign!"
 *
 * 	If you insert an ID for a post type that is NOT a GiveWP form, this is what happens:
 *
 *	[give_raised_for_forms form_id="11"] displays "This is not a donation form. Make sure you are using an ID for a donation form."
 *
 * 	Another possible scenario is that you add the shortcode without passing the form ID as a parameter. In this case, the shortcode will display "It's necessary that you insert the form ID on the shortcode."
 */

function my_give_display_donations_for_forms( $atts ) {

	$atts = shortcode_atts( array(
		'form_id' => false,
	), $atts, 'give_raised_for_forms' );

	$html = '';
	$formId = $atts[ 'form_id' ];

	if ( ! $formId ) {
		$html = '
			<div class="give_raised_for_forms">
				<p>
					It\'s necessary that you insert the form ID on the shortcode.
				</p>
			</div>
		';

		return $html;
	}

	if ( get_post_type( $formId ) !== 'give_forms' ) {
		$html = '
			<div class="give_raised_for_forms">
				<p>
					This is not a donation form. Make sure you are using an ID for a donation form.
				</p>
			</div>
		';

		return $html;
	}

	$info = get_post_meta( $formId );
	$post_title = get_the_title( $formId );

	$number_of_donations = $info[ '_give_form_sales' ][0];

	$html = '
		<div class="give_total_forms">
			<p>
				We already have ' . $number_of_donations . ' donations for the ' . $post_title . ' campaign!
			</p>
		</div>
	';
	
	return $html;

}
add_shortcode( 'give_raised_for_forms', 'my_give_display_donations_for_forms');