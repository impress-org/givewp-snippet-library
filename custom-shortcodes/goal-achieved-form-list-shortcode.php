<?php
/**
  *  SHORTCODE -- Goal Achieved Forms
  *  Example: [give_goal_achieved_forms]
  */
function give_render_goal_achieved_forms_list() {

	// Arguments to only fetch forms with goal enabled.
	$form_args = array(
		'post_type'      => 'give_forms',
		'post_status'    => 'publish',
		'posts_per_page' => get_option( 'posts_per_page' ),
		'orderby'        => 'date',
		'order'          => 'ASC',
		'meta_key'       => '_give_goal_option',
		'meta_value'     => 'enabled',
	);

	// Query to output donation forms.
	$form_query = new WP_Query( $form_args );

	if ( $form_query->have_posts() ) {
		ob_start();

		printf( '<table><thead><th>Form ID</th><th>Form Name</th></thead><tbody>' );

		while ( $form_query->have_posts() ) {

			$form_query->the_post();

			$goal_stats = give_goal_progress_stats( get_the_ID() );

			// Skip printing the form if the goal is not achieved.
			if ( $goal_stats['raw_actual'] < $goal_stats['raw_goal'] ) {
				continue;
			}

			// Print Form ID and Form Title with hyperink.
			printf(
				'<tr><td>%1$s</td><td><a href="%2$s">%3$s</a></td></tr>',
				get_the_ID(),
				get_the_permalink(),
				get_the_title()
			);
		}

		printf( '</tbody></table>' );

		wp_reset_postdata();

		return ob_get_clean();
	}
}

add_shortcode( 'give_goal_achieved_forms', 'give_render_goal_achieved_forms_list' );
