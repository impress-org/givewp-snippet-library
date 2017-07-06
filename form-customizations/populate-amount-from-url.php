<?php


/**
 * AUTO-POPULATE AMOUNT FROM URL STRING
 *
 * This jQuery snippet will auto-populate the Give form amount
 * from a defined amount in your URL.
 * EXAMPLE: https://example.com/donations/give-form/?amount=42.00
 *
 * CAVEATS:
 * -- Your form must support custom amounts
 * -- This snippet only supports one form per page as-is
 *
 * @param int $form_id The form ID this is being output to. You can use this to target specific forms.
 * @param array $args An array of configurations for the form.
 */

// Hooking into the single form view.
add_action( 'give_after_single_form', 'give_populate_amount' );
// If not using the single form view remove the above action and use this action:
// add_action( 'give_post_form_output', 'give_populate_amount', 10, 2 );

function give_populate_amount($form_id, $args) {
	?>

	<script>
			// Get variable from query string in URL
			function giveGetQueryVariable(variable) {
				var query = window.location.search.substring(1);
				var vars = query.split('&');
				for (var i=0;i<vars.length;i++) {
					var pair = vars[i].split('=');
					if(pair[0] == variable){return pair[1];}
				}
				return(false);
			}

			jQuery(document).ready(function( $ ) {

				// Get the amount from the URL
				var getamount = giveGetQueryVariable('amount');
				var amount = '1.00';

				// Set fallback in case URL variable isn't set
				if ( getamount !== false ) {
					amount = getamount;
				}

				// Populate the amount field, then update the total
				if ( $('#give-amount').length > 0 ) {
					$('#give-amount')
						.val(amount)
						.focus()
						.trigger('blur');
				}

			});

	</script>

	<?php

}
