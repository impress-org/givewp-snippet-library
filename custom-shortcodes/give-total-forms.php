<?php
/**
 *  Creates a shortcode to display a message with with the total number of donation forms published on the website.
 *
 *  Sample shortcodes:
 *
 *  [give_total_forms] - displays a paragraph containing the number of donation forms you have on your website. The message will say: "We have 64 campaigns that you can donate to!"
 * 
 *  [give_total_forms donation_forms_page="https://example.com/donations/"] - displays the paragraph containing the number of donation forms you have on your website and a link pointing to https://example.com/donations/" where your donors can see your donation forms and donate.
 */

function my_give_display_number_of_forms( $atts ) {
	$number_of_donation_forms = wp_count_posts( 'give_forms' )->publish;

	$atts = shortcode_atts( array(
		'donation_forms_page_id' => false,
	), $atts, 'give_total_forms' );

	$donation_forms_page = '';

	if ( $atts['donation_forms_page_id']) {
        	$link = get_permalink($atts['donation_forms_page_id']);
        	
		$donation_forms_page = '<a href="' . $link . '"> Check out our campaigns! <a>';	
	}

	$html = '
		<div class="give_total_forms">
			<p>
				We have ' . $number_of_donation_forms . ' campaigns that you can donate to! ' . $donation_forms_page . '
			</p>
		</div>
	';

	return $html;

}
add_shortcode( 'give_total_forms', 'my_give_display_number_of_forms');
