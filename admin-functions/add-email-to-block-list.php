<?php

/**
 *  Allows admins to block all donations from a specific email address
 *
 * 
 */

function my_give_block_list( $spam ){
    
    $email = give_clean($_POST['give_email']);

    //replace the emails in the array with emails you want to block
    $blocked = array('nefarious@example.com','badguy@example.com' );

    if( in_array( $email, $blocked ) ) {
        $spam = true;
    } 
    return $spam;
}

add_filter( 'give_spam', 'my_give_block_list', 0, 1 );