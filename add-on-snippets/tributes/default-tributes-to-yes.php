<?php

/**
 *  Default the Tributes selection to "Yes Please"
 *  
 *  You can also hide the tributes options and legend with this CSS code added to your theme's stylesheet.
 * 
 * [id*='give-tributes-options'] {
 *     display:none;
 * }
 *
 * 
 * [id*=give-tributes-dedicate-donation] legend {
 *     display:none;
 *  }
 *
 */
 
function my_give_tribute_by_default() { ?>
	<script>
        jQuery("input[name=give_tributes_show_dedication][value='yes']").prop("checked", true);

	</script>

<?php }

add_action( 'give_donation_form_after_submit', 'my_give_tribute_by_default' );
