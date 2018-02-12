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
			$testquery = new Give_Payments_Query( array( 'number' => 1 ) );
			$payments       = $testquery->get_payments();

			if ( $payments ) {
				foreach ( $payments as $payment ) {
					$meta = give_get_meta( $payment->ID );
					?>
					<div style="background: #555; color: white; padding: 2rem;">
						<h3>Test Data</h3>
						<p>The following outputs all the "give_payment" fields for you to reference in building out your
							donation list</p>
						<p><?php var_dump( $meta ); ?></p>
					</div>
					<?php
				}
			}
		}
		// end testing
		?>

		<?php
		/**
		 *  QUERY 1: Basic Example
		 *
		 *  This query outputs the latest 3 transactions
		 *  with the amount and date
		 */

		// Query 1 Argument
		$args = array(
			'number' => 3
		);

		$loop1 = new Give_Payments_Query( $args );
		$loop1 = $loop1->get_payments();


		if ( $loop1 ) {
			?>
			<h2>Output latest 3 donations with amount and date</h2>
			<hr/>
			<ul>
				<?php
				foreach ( $loop1 as $payment ) {
					?>

					<li><strong>Donation for $<?php echo esc_html( $payment->total ); ?></strong><br/>
						Was given on <?php echo esc_html( date( "F j, Y", strtotime( $payment->date ) ) ); ?><br/>
						With the <?php echo esc_html( $payment->gateway ); ?> Payment Gateway
					</li>
					<?php
				}
				?>
			</ul>
			<?php
		} else {
			?>
			<!-- If you don't have donations that fit this query -->
			<h2>Sorry you don't have any transactions that fit this query</h2>
			<?php
		}
		?>

		<?php
		/**
		 *  QUERY 2: Query by Gateway
		 *
		 *  This query outputs the latest 3 transactions
		 *  that were made with the Offline Donations Gateway only
		 */

		// Query 2 Arguments
		$args = array(
			'number' => 3,
			'meta_key'       => '_give_payment_gateway',
			'meta_value'     => 'manual',
			'meta_compare'   => '=',
		);

		$loop2 = new Give_Payments_Query( $args );
		$loop2 = $loop2->get_payments();

		if ( $loop2 ) {
			?>
			<h2>Output latest 3 Offline donations with amount and email address</h2>
			<hr/>
			<ul>
				<?php
				foreach ( $loop2 as $payment ) {
					?>

					<li><strong>Donation for $<?php echo esc_html( $payment->total ); ?></strong><br/>
						Was given on <?php echo esc_html( date( "F j, Y", strtotime( $payment->date ) ) ); ?><br/>
						With the <?php echo esc_html( $payment->gateway ); ?> Payment Gateway
					</li>
					<?php
				}
				?>
			</ul>
			<?php
		} else {
			?>
			<!-- If you don't have donations that fit this query -->
			<h2>Sorry you don't have any transactions that fit this query</h2>
			<?php
		}
		?>

		<?php
		/**
		 *  QUERY 3: Show Donor Information
		 *
		 *  This query outputs the latest 3 transactions
		 *  with the name of the donor and the amount
		 */

		// Query 2 Arguments
		$args = array(
			'number' => 3
		);

		$loop3 = new Give_Payments_Query( $args );
		$loop3 = $loop3->get_payments();

		if ( $loop2 ) {
			?>
			<h2>Output latest 3 donations with amount and names</h2>
			<hr/>
			<ul>
				<?php
				foreach ( $loop3 as $payment ) {
					?>
					<li>
						<strong>Thanks to <?php echo esc_html( $payment->first_name . ' ' . $payment->last_name ); ?></strong><br/>
						For their generous gift of $<?php echo esc_html( $payment->total ); ?><br/>
					</li>
					<?php
				}
				?>
			</ul>
			<?php
		} else {
			?>
			<!-- If you don't have donations that fit this query -->
			<h2>Sorry you don't have any transactions that fit this query</h2>
			<?php
		}
		?>
	</main>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
