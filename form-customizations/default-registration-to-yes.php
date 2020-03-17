<?php
/**
 * Default the "Create an account" checkbox to checked.
 *
 */

function my_give_register_by_default() { ?>
	<script>
        jQuery("input[name=give_create_account][value='on']").prop("checked", true);

	</script>

<?php }

add_action( 'give_donation_form_after_submit', 'my_give_register_by_default' );