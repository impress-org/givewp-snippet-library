<?php 


function my_give_display_donations_for_forms( $atts ) {

	$atts = shortcode_atts( array(
		'form_id' => false,
	), $atts, 'give_raised_for_forms' );

	$html = '';

	if ( ! $atts[ 'form_id' ] ) {
		$html = '
			<div class="give_raised_for_forms">
				<p>
					It\'s necessary that you insert the form ID on the shortcode.
				</p>
			</div>
		';

		return $html;
	}

	if ( get_post_type( $atts[ 'form_id' ] ) !== 'give_forms' ) {
		$html = '
			<div class="give_raised_for_forms">
				<p>
					This is not a donation form. Make sure you are using an ID for a donation form.
				</p>
			</div>
		';

		return $html;
	}

	$info = get_post_meta( $atts[ 'form_id' ] );
	$post_title = get_the_title( $atts[ 'form_id' ] );

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