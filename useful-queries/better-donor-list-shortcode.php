<?php
/**
 * A [donor_list] shortcode to list donors with names and amounts with attributes:
 *
 * @number  = the number of donations to list
 * @form_id = whether to limit the donors to a specific form
 * @heading = the text heading that appears above the donor list
 *
 * @param $atts
 */
function give_donor_list_shortcode_function_example( $atts ) {

	$atts = shortcode_atts( array(
		'number'  => '',
		'form_id' => '',
		'heading' => 'We\'d like to thank the following gracious donors:',
	), $atts, 'donor_list' );

	$args = array(
		'post_type'      => 'give_payment',
		'posts_per_page' => $atts['number'],
	);

	$wp_query = new WP_Query( $args );

	if ( $wp_query->have_posts() ) : ?>

		<h2><?php echo $atts['heading'] ?></h2>
		<hr />
		<ul>
			<?php
			/**
			 * Getting user data is a bit more complex.
			 *
			 * Also keep in mind whether or not your donors actually WANT their names posted publicly.
			 */
			while ( $wp_query->have_posts() ) : $wp_query->the_post();
				$meta = get_post_meta( get_the_ID() );
				// Transaction have their own metadata; let's get it.
				$paymentmeta = $meta['_give_payment_meta'];
				// The metadata is serialized. Let's pull that apart.
				$getmeta = maybe_unserialize( $paymentmeta[0] );
				// Now that we've got it, we can define the name
				$firstname = $getmeta['user_info']['first_name'];
				$lastname  = $getmeta['user_info']['last_name'];
				$total     = $meta['_give_payment_total'][0];
				?>
				<li>
					<strong><?php echo $firstname . ' ' . $lastname; ?></strong> for their gift of
					$<?php echo $total; ?>
				</li>
				<?php
			endwhile;
			wp_reset_postdata(); // end of Query 1 ?>
		</ul>
	<?php else : ?>
		<!-- If you don't have donations that fit this query -->
		<h2>Sorry you don't have any donation payments that fit this query</h2>

	<?php endif;
	wp_reset_query();

}

add_shortcode( 'donor_list', 'give_donor_list_shortcode_function_example' );
