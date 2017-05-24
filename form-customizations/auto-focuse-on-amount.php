<?php
/**
 * AUTO-FOCUS ON AMOUNT FIELD
 *
 * This is a simple jQuery snippet that will put the mouse
 * cursor on the Custom Amount field on page load
 */

function my_give_focus_custom_amount() { ?>
    <script>
        jQuery("#give-amount").focus();
    </script>

<?php }

add_action( 'give_payment_mode_top', 'my_give_focus_custom_amount' );
