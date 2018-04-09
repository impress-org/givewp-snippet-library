<?php

/*
 * Changes the fee breakdown message that appears under the donation total on Fee Recovery-enabled forms.
 * 
 * NOTE: be sure to include the {amount} and {fee_amount} in the modified text if you want to 
 * dynamically output the data there.
 */

add_filter('give_fee_break_down_message', 'my_give_fee_recovery_text_change' );

function my_give_fee_recovery_text_change() {
    return '{amount} payment plus {fee_amount}, if you please.';
}
