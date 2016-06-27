<?php
/**
 *  Template Name: List Donations
 *
 *  This snippet is a page template with 3 Sample Queries
 *  Each query displays subtly different information about
 *  your transactions.
 *  
 *  Please be sensitive to whether your donors want any of
 *  this information public at all.
 *  
 *  IMPORTANT: This snippet, unlike others you might find in 
 *  our snippet library, does not go in functions.php or a 
 *  must-use plugin. Save this entire file as something like
 *  'page_list-donations.php' and place it in your theme's folder.
 *  then create a new page, and select "List Donations" from the
 *  dropdown menu. Publish the page and view it 
 *  on the front end of your site.
 */

get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php
		/**
		 *  TESTING: Outputs all post meta
		 *
		 * This section outputs all the custom fields for your reference
		 * Just set the $testing variable to true
		 */
		$testing = false;

		if ( $testing == true ) {
			$testquery = new WP_Query( array( 'post_type' => 'give_payment', 'post_count' => 1 ) );
			$firstpost = $testquery->posts;
			$meta      = get_post_meta( $firstpost[0]->ID );

			?>
			<div style="background: #555; color: white; padding: 2rem;">
				<h3>Test Data</h3>
				<p>The following outputs all the "give_payment" fields for you to reference in building out your donation list</p>
				<p><?php var_dump( $meta ); ?></p>
			</div>
		<?php } // end testing ?>

		<?php
		/**
		 *  QUERY 1: Basic Example
		 *
		 *  This query outputs the latest 3 transactions
		 *  with the amount and date
		 */

		// Query 1 Argument
		$args = array(
			'post_type'      => 'give_payment',
			'posts_per_page' => 3
		);

		$loop = new WP_Query( $args );

		if ( $loop->have_posts() ) : ?>

			<h2>Output latest 3 donations with amount and date</h2>
			<hr/>
			<ul>
				<?php
				while ( $loop->have_posts() ) : $loop->the_post();
					$meta    = get_post_meta( get_the_ID() );
					$total   = $meta['_give_payment_total'][0];
					$getdate = $meta['_give_completed_date'][0];
					$date    = date( "F j, Y", strtotime( $getdate ) );
					$gateway = $meta['_give_payment_gateway'][0];
					?>

					<li><strong>Donation for $<?php echo $total; ?></strong><br/>
						Was given on <?php echo $date; ?><br/>
						With the <?php echo $gateway; ?> Payment Gateway
					</li>

				<?php endwhile;
				wp_reset_postdata(); // end of Query 1 ?>
			</ul>
		<?php else : ?>
			<!-- If you don't have donations that fit this query -->

			<h2>Sorry you don't have any transactions that fit this query</h2>

		<?php endif;
		wp_reset_query(); ?>

		<?php
		/**
		 *  QUERY 2: Query by Gateway
		 *
		 *  This query outputs the latest 3 transactions
		 *  that were made with the Offline Donations Gateway only
		 */

		// Query 2 Arguments
		$args2 = array(
			'post_type'      => 'give_payment',
			'posts_per_page' => 3,
			'meta_key'       => '_give_payment_gateway',
			'meta_value'     => 'manual',
			'meta_compare'   => '=',
		);

		$loop2 = new WP_Query( $args2 );

		if ( $loop2->have_posts() ) : ?>

			<h2>Output latest 3 Offline donations with amount and email address</h2>
			<hr/>
			<ul>
				<?php
				while ( $loop2->have_posts() ) : $loop2->the_post();
					$meta    = get_post_meta( get_the_ID() );
					$total   = $meta['_give_payment_total'][0];
					$getdate = $meta['_give_completed_date'][0];
					$date    = date( "F j, Y", strtotime( $getdate ) );
					$gateway = $meta['_give_payment_gateway'][0];
					?>
					<li><strong>Donation for $<?php echo $total; ?></strong><br/>
						Was given on <?php echo $date; ?><br/>
						With the <?php echo $gateway; ?> Payment Gateway
					</li>

				<?php endwhile;
				wp_reset_postdata(); // end of Query 1 ?>
			</ul>

		<?php else : ?>
			<!-- If you don't have donations that fit this query -->
			<h2>Sorry you don't have any transactions that fit this query</h2>

		<?php endif;
		wp_reset_query(); ?>

		<?php
		/**
		 *  QUERY 3: Show Donor Information
		 *
		 *  This query outputs the latest 3 transactions
		 *  with the name of the donor and the amount
		 */

		// Query 3 Arguments
		$args3 = array(
			'post_type'      => 'give_payment',
			'posts_per_page' => 3,
		);

		$loop3 = new WP_Query( $args3 );

		if ( $loop3->have_posts() ) : ?>

			<h2>Output latest 3 donations with amount and names</h2>
			<hr/>
			<ul>
				<?php
				/** Getting user data is a bit more complex
				 *  Also keep in mind whether or not your donors
				 *  actually WANT their names posted publicly.
				 */

				while ( $loop3->have_posts() ) : $loop3->the_post();

					$meta = get_post_meta( get_the_ID() );
					// Transaction have their own metadata; let's get it.
					$paymentmeta = $meta['_give_payment_meta'];

					// The metadata is serialized. Let's pull that apart.
					$getmeta = maybe_unserialize( $paymentmeta[0] );

					// Now that we've got it, we can define the name
					$firstname = $getmeta['user_info']['first_name'];
					$lastname  = $getmeta['user_info']['last_name'];

					$total = $meta['_give_payment_total'][0];
					?>

					<li>
						<strong>Thanks to <?php echo $firstname . ' ' . $lastname; ?></strong><br/>
						For their generous gift of $<?php echo $total; ?><br/>
					</li>
				<?php endwhile;
				wp_reset_postdata(); // end of Query 1 ?>
			</ul>
		<?php else : ?>
			<!-- If you don't have donations that fit this query -->
			<h2>Sorry you don't have any transactions that fit this query</h2>

		<?php endif;
		wp_reset_query(); ?>
	</main>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
