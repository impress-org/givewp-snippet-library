<?php
/**
 * Add custom fields to your donation payment receipt table.
 *
 * Depending on your needs you will pull data from post meta, donor meta, or payment meta.
 * You can use give_get_meta or get_post_meta depending on your needs.
 * You can also use the various meta methods in Give core.
 *
 * @param $payment
 * @param $give_receipt_args
 */
function my_give_custom_receipt_row( $payment, $give_receipt_args ) {

	// Here you can pull custom meta from postmeta or wherever.
	// You can use $payment to retrieve info like payment_id and form_id.
	?>
	<tr>
		<td scope="row"><strong><?php echo 'My Row Name'; ?></strong></td>
		<td><?php echo 'Some value'; ?></td>
	</tr>

<?php }

add_action( 'give_payment_receipt_after', 'my_give_custom_receipt_row', 10, 2 );