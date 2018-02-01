<?php
/**
 * Customizes the is_receipt_link_allowed() conditional check with a minimum amount.
 *
 * @param $val
 * @param $id
 *
 * @return bool
 */
function give_pdf_receipt_customize_receipt_link_allowed( $val, $id ) {

	// Customize minimum amount below.
	$min_amount = 40;
	$amount     = give_donation_amount( $id );

	// Adjust min. value here.
	if ( $min_amount <= $amount ) {
		return false;
	}

	// Don't remove.
	return $val;

}

add_action( 'give_pdf_is_receipt_link_allowed', 'give_pdf_receipt_customize_receipt_link_allowed', 1, 2 );

/**
 * Customizes the output of the table cell if the custom amount is not met.
 *
 * Note: requires PDF receipts 2.0.8+
 */
function give_pdf_receipt_min_amount_for_receipt() { ?>

	<td>
		<?php echo 'Minimum amount not met for receipt.'; ?>
	</td>

<?php }

add_filter( 'give_pdf_receipts_receipt_not_allowed_td', 'give_pdf_receipt_min_amount_for_receipt', 1 );