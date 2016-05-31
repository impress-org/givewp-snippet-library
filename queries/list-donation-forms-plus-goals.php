<?php
/**
 *  Template Name: Donation Forms & Goals
 *
 *  This snippet is a page template with an example query that gets the 10 latest donation forms and displays their goal
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
				while ( $wp_query->have_posts() ) : $wp_query->the_post();
					$meta    = get_post_meta( get_the_ID() );
					$total   = $meta['_give_payment_total'][0];
					$getdate = $meta['_give_completed_date'][0];
					$date    = date( "F j, Y", strtotime( $getdate ) );
					$gateway = $meta['_give_payment_gateway'][0];
					?>


					<div class="<?php post_class(); ?>">

						<h2 class="give-form-title"><?php echo get_the_title(); ?></h2>

					</div>

				<?php endwhile;
				wp_reset_postdata(); // end of Query 1 ?>

		<?php else : ?>
			<!-- If you don't have donations that fit this query -->

			<h2>Sorry you don't have any transactions that fit this query</h2>

		<?php endif;
		wp_reset_query(); ?>
		
	</main>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
