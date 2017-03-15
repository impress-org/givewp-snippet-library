<?php
/**
 * AUTO-POPULATE AMOUNT FROM URL STRING
 *
 * This jQuery snippet will auto-populate the Give form amount
 * from a defined amount in your URL
 * EXAMPLE: https://example.com/donations/give-form/?amount=42.00
 * 
 * CAVEATS:
 * -- Your form must support custom amounts
 * -- This snippet only supports one form per page as-is
 */
 
add_action( 'give_after_single_form', 'give_populate_amount' );

function give_populate_amount() { ?>

    <script>
        // Get variable from query string in URL
        function getQueryVariable(variable)
        {
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
            var getamount = getQueryVariable("amount");

            // Set fallback in case URL variable isn't set
            if ( getamount != false ) {
                amount = getamount;
            } else {
                amount = '1.00';
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
