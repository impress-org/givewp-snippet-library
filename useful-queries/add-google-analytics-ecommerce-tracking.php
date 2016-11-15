<?php
/*
 * Add Google Analytics ecommerce tracking code to the donation confirmation page. 
 * Note that this code requires the Google analytics code to be called elsewhere on the page, 
 * preferrably in the document head.
 * 
 */ 

function my_give_google_analytics_event( $payment, $give_receipt_args ) {

	if ( $give_receipt_args['payment_id'] ) {
		// Use a meta value so we only send the beacon once.
		if ( get_post_meta( $payment->ID, 'give_ga_beacon_sent', true ) ) {
			return;
		}

		$total = give_get_payment_amount( $payment->ID );

		?>
		<script type="text/javascript">

				ga('require', 'ecommerce', 'ecommerce.js');

				ga('ecommerce:addTransaction', {
					'id': '<?php echo esc_js( give_get_payment_number( $payment->ID ) ); ?>', // Transaction ID. Required.
					'affiliation': '<?php echo esc_js( get_bloginfo( 'name' ) ); ?>', // Affiliation or store name.
					'revenue': '<?php echo esc_js( $total ); ?>' // donation amount.
				});

				ga('ecommerce:send');

		</script>
		<?php

		update_post_meta( $payment->ID, 'give_ga_beacon_sent', true );

	}

}

add_action( 'give_payment_receipt_after_table', 'my_give_google_analytics_event', 10, 2 );