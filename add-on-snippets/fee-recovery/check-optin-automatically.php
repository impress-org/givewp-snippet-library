<?php
/**
 *  Check the Donor Opt-in checkbox in Give Fee Recovery automatically
 */
function my_give_focus_custom_amount() { ?>
    <script>
        jQuery(document).ready( function() {
            jQuery('input.give_fee_mode_checkbox').prop('checked', true);
        });
    </script>

<?php }

add_action( 'give_post_form_output', 'my_give_focus_custom_amount' );