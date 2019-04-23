<?php

/**
 *  Change the Fee Recovery summary language at the bottom of the form
 *  when a donor has opted in to cover the fees
 *
 *  {fee_amount} and {amount} are populated dynamically
 *
 **/

add_filter('give_fee_break_down_message', 'my_custom_give_fee_language');

function my_custom_give_fee_language() {
    return __( 'This donation includes {fee_amount} to help cover fees. Thank you for your generosity!', 'give-fee-recovery' );
}
