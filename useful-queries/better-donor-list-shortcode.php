<?php

/**
 * A [my_donor_list] shortcode to list donors with names and amounts with attributes:
 *
 * @number  = the number of donations to list.
 * @form_id = whether to limit the donors to a specific form.
 * @heading = the text heading that appears above the donor list.
 *
 * @param $atts
 */
function give_donor_list_shortcode_function_example( $atts ) {

	if ( ! class_exists( 'Give_Payments_Query' ) ) {
		return;
	}

	$atts = shortcode_atts( array(
		'number'  => 30,
		'form_id' => '',
		'heading' => 'We\'d like to thank the following gracious donors:',
	), $atts, 'my_donor_list' );

	$args = array(
		'output' => 'payments',
		'number' => $atts['number'],
	);

	$payments = new Give_Payments_Query( $args );
	$payments = $payments->get_payments();

	if ( $payments ) : ?>
		<style>
			/* Flex grid */
			ul {
				margin: 0;
				padding: 0;
				display: flex;
				flex-wrap: wrap;
			}

			ul.my-give-donor-wall li {
				text-align: center;
				list-style-type: none;
				display: flex;
				padding: 0.5em;
				width: 100%;
			}

			@media all and (min-width: 40em) {
				ul.my-give-donor-wall li {
					width: 50%;
				}
			}

			@media all and (min-width: 60em) {
				ul.my-give-donor-wall li {
					width: 33.33%;
				}
			}

			/* List content */
			.my-give-donorwall-donor {
				background-color: #fff;
				display: flex;
				flex-direction: column;
				padding: 1em;
				width: 100%;
			}

			/* Avatar */
			ul.my-give-donor-wall .my-give-donorwall-avatar {
				display: block;
				margin: 0 0 10px;
				text-align: center;
			}

			ul.my-give-donor-wall .my-give-donorwall-avatar img {
				border-radius: 50%;
			}


		</style>
		<h2><?php echo esc_html( $atts['heading'] ); ?></h2>
		<hr />
		<ul class="my-give-donor-wall">
			<?php
			/**
			 * Loop through individual payments.
			 *
			 */
			foreach ( $payments as $payment ) :
				/* @var $payment \Give_Payment */
				$first_name = $payment->get_meta( '_give_donor_billing_first_name', true );
				$last_name = $payment->get_meta( '_give_donor_billing_last_name', true );

				$total  = give_currency_filter( give_format_amount( $payment->total, array( 'sanitize' => false ) ), array( 'currency_code' => $payment->currency ) );
				$avatar = get_avatar( $payment->email, 64 );
				?>
				<li>
					<div class="my-give-donorwall-donor">
						<span class="my-give-donorwall-avatar"><?php echo $avatar; ?></span>
						<span class="my-give-donorwall-name"><?php echo esc_html( $first_name . ' ' . $last_name ); ?></span> <span
								class="my-give-donorwall-total"><?php echo $total;
							?></span>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php else : ?>
		<!-- If you don't have donations that fit this query -->
		<h2>Sorry you don't have any donation payments that fit this query</h2>

	<?php endif;

}

add_shortcode( 'my_donor_list', 'give_donor_list_shortcode_function_example' );