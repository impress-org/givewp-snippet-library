<?php
/**
 * AUTO-POPULATE AMOUNT, NAME, and EMAIL FROM URL STRING
 *
 * This jQuery snippet will auto-populate the Give form amount,
 * first and last name, and email address from a URL you provide
 * EXAMPLE: https://example.com/donations/give-form/?amount=46.00&first=Peter&last=Joseph&email=testing@givewp.com
 *
 * Hooking into the single form view.
 *
 * CAVEATS:
 * -- Your form must support custom amounts
 * -- This snippet only supports one form per page as-is
 */
function my_custom_give_populate_amount_name_email() {
	?>
	<script>
		( function( window, document, $, undefined ) {
			'use strict';
			var giveCustom = {};

			giveCustom.init = function() {

				// Are we passed a form ID?
				var form_id = giveCustom.getQueryVariable( 'form_id' ) !== false ? decodeURI( giveCustom.getQueryVariable( 'form_id' ) ) : '';

				if ( form_id !== '' ) {
					// Make to jQuery object.
					var giveForm = $( '.give-form' + giveCustom.getQueryVariable( 'form_id' ) )
				} else {
					// Fallback.
					giveForm = $( '.give-form' );
				}

				// Get the amount from the URL
				var amount = giveCustom.getQueryVariable( 'amount' ) !== false ? decodeURI( giveCustom.getQueryVariable( 'amount' ) ) : '';

				// Update the amount
				var formattedAmount = Give.fn.formatCurrency( amount, {
					symbol: Give.form.fn.getInfo( 'currency_symbol', giveForm ),
					position: Give.form.fn.getInfo( 'currency_position', giveForm )
				}, giveForm );

				// Unformatted amount (for data).
				var unformattedAmount = Give.fn.unFormatCurrency( amount, Give.form.fn.getInfo( 'decimal_separator', giveForm ) );

				// Update the total amount.
				if ( amount ) {
					giveForm.find( '.give-final-total-amount' ).attr( 'data-total', unformattedAmount )
						.text( formattedAmount );
					giveForm.find( '.give-amount-top' ).val(unformattedAmount);
				}

				// Fill personal info fields.

				var firstNamePassedVal = giveCustom.getQueryVariable( 'first' ) !== false ? decodeURI( giveCustom.getQueryVariable( 'first' ) ) : '';
				var lastNamePassedVal = giveCustom.getQueryVariable( 'last' ) !== false ? decodeURI( giveCustom.getQueryVariable( 'last' ) ) : '';
				var emailPassedVal = giveCustom.getQueryVariable( 'email' ) !== false ? decodeURI( giveCustom.getQueryVariable( 'email' ) ) : '';

				var firstNameInput = giveForm.find( '#give-first-name-wrap input.give-input' );
				var lastNameInput = giveForm.find( '#give-last-name-wrap input.give-input' );
				var emailInput = giveForm.find( '#give-email-wrap input.give-input' );

				if ( firstNamePassedVal !== false && firstNameInput.length > 0 ) {
					firstNameInput.val( firstNamePassedVal );
				}
				if ( lastNamePassedVal !== false && lastNameInput.length > 0 ) {
					lastNameInput.val( lastNamePassedVal );
				}
				if ( emailPassedVal !== false && emailInput.length > 0 ) {
					emailInput.val( emailPassedVal );
				}
			};

			/**
			 * Get Query Variable from URL.
			 *
			 * @param variable
			 * @returns {string|boolean}
			 */
			giveCustom.getQueryVariable = function( variable ) {
				var query = window.location.search.substring( 1 );
				var vars = query.split( '&' );
				for ( var i = 0; i < vars.length; i ++ ) {
					var pair = vars[ i ].split( '=' );
					if ( pair[ 0 ] == variable ) {
						return pair[ 1 ];
					}
				}
				return false;
			};

			giveCustom.init();

		} )( window, document, jQuery );
	</script>
	<?php
}

add_action( 'give_post_form_output', 'my_custom_give_populate_amount_name_email' );
