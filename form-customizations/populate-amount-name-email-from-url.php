<?php
/**
 * AUTO-POPULATE AMOUNT, NAME, and EMAIL FROM URL STRING
 *
 * This jQuery snippet will auto-populate the Give form amount,
 * first and last name, and email address from a URL you provide
 * EXAMPLE: https://example.com/donations/give-form/?amount=46.00&first=Peter&last=Joseph&email=testing@givewp.com
 *
 * CAVEATS:
 * -- Your form must support custom amounts
 * -- This snippet only supports one form per page as-is
 */

// Hooking into the single form view.
add_action( 'give_post_form_output', 'give_populate_amount_name_email' );

function give_populate_amount_name_email() {
	?>

	<script>
		// Get variable from query string in URL
		function giveGetQueryVariable(variable) {
			var query = window.location.search.substring(1);
			var vars = query.split("&");
			for (var i=0;i<vars.length;i++) {
				var pair = vars[i].split("=");
				if(pair[0] == variable){return pair[1];}
			}
			return(false);
		}

		jQuery(document).ready(function( $ ) {
			// Get the amount from the URL
			var getamount = giveGetQueryVariable("amount");
			var amount = '1.00';

			// Set fallback in case URL variable isn't set
			if ( getamount !== false ) {
				amount = getamount;
			}

			var firstname = ( giveGetQueryVariable("first") !== false ) ? decodeURI(giveGetQueryVariable("first")) : '';
			var lastname = ( giveGetQueryVariable("last") !== false ) ? decodeURI(giveGetQueryVariable("last")) : '';
			var email = ( giveGetQueryVariable("email") !== false ) ? decodeURI(giveGetQueryVariable("email")) : '';

			// Populate the amount field, then update the total
			if ( $('#give-amount').length > 0 ) {
				$('#give-amount')
					.val(amount)
					.focus()
					.trigger('blur');
			}

			if ( firstname !== false && $('#give-first-name-wrap input.give-input').length > 0 ) {
				$('#give-first-name-wrap input.give-input')
					.val(firstname);
			}

			if ( lastname !== false && $('#give-last-name-wrap input.give-input').length > 0 ) {
				$('#give-last-name-wrap input.give-input')
					.val(lastname);
			}

			if ( email !== false && $('#give-email-wrap input.give-input').length > 0 ) {
				$('#give-email-wrap input.give-input')
					.val(email);
			}

		});

	</script>

	<?php

}
