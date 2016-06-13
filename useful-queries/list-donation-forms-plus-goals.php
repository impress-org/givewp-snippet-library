<?php
/**
 *  Template Name: Donation Forms & Goals
 *
 *  This snippet is a page template with an example query that gets 
 *  the 10 latest donation forms and displays their goal
 * 
 *  IMPORTANT: This snippet, unlike others you might find in our snippet library
 *  does not go in functions.php or a must-use plugin. Paste the entire contents
 *  of this file to a new file named archive-give_forms.php and place it in 
 *  the root of your active theme's folder. To view it on your site, naviate to 
 *  /donations (assuming you haven't changed the slug or disabled the form archives 
 *  in Donations --> Settings --> Display )
 * 
 */

get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php
		/**
		 *  Display Donation Forms
		 */
		$args = array(
			'post_type'      => 'give_forms',
			'posts_per_page' => 10
		);

		$wp_query = new WP_Query( $args );

		if ( $wp_query->have_posts() ) : ?>

			<h2>Choose a Donation</h2>
			<hr/>

			<?php
			while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>


				<div class="<?php post_class(); ?>">

					<h2 class="give-form-title"><?php echo get_the_title(); ?></h2>

					<?php //you can output the content or excerpt here ?>

					<?php
					//Output the goal (if enabled)
					$id          = get_the_ID();
					$goal_option = get_post_meta( $id, '_give_goal_option', true );
					if ( $goal_option == 'yes' ) {
						$shortcode = '[give_goal id="' . $id . '"]';
						echo do_shortcode( $shortcode );
					} ?>

					<a href="<?php echo get_permalink(); ?>" class="button readmore give-donation-form-link"><?php _e( 'Donate Now', 'give' ); ?> &raquo;</a>


				</div>

			<?php endwhile;
			wp_reset_postdata(); // end of Query 1 ?>

		<?php else :
			//If you don't have donation forms that fit this query
			?>

			<h2>Sorry, no donations found.</h2>

		<?php endif;
		wp_reset_query(); ?>

	</main>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
