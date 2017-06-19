<?php
/**
  *  SHORTCODE -- Top Give Forms 
  *  Example: [top_give_forms]
  *  Defaults: [top_give_forms limit="3" order="DESC"]
  *
  */
  
function top_give_forms_function( $atts ) {

	// Defaults
	$atts = shortcode_atts( array(
		'limit' => 3,
		'order' => 'DESC'
	), $atts, 'top_give_forms' );

	$args = array(
		'post_type'         => 'give_forms',
		'posts_per_page'    => $atts['limit'],
		'meta_key'          => '_give_form_earnings',
		'orderby'           => 'meta_value_num',
        'order'             => $atts['order'],
	);

	$wp_query = new WP_Query( $args );

	if ( $wp_query->have_posts() ) :

        ob_start();
        ?>

        <div class="top-donation-forms-list">

        <h3>Top Performing Donation Forms</h3>

        <?php
		while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

                <p class="top-form-title"><strong><?php echo get_the_title(); ?></strong>
				<?php
                    //Output the goal (if enabled)
                    $id          = get_the_ID();
                    $meta = get_post_meta( $id );
                    $earnings = $meta['_give_form_earnings'];
                    echo '<span>Earnings: ' . give_currency_symbol() . give_format_amount( $earnings[0], false) . '</span>';
                ?></p>

		<?php endwhile;

		else :
		//If you don't have donation forms that fit this query
		?>

        <h3>Sorry, no top donation forms found.</h3>

	<?php endif; ?>

    </div>

    <?php

    $output = ob_get_contents();
    ob_end_clean();
    return $output;

    wp_reset_query();
}

add_shortcode( 'top_give_forms', 'top_give_forms_function' );