<?php

/**
 *
 * Removes the IP address from being stored in the database
 *
 * @return string
 *
 */
function my_give_remove_ip(){
    return 'IP Not Stored';
}
    
add_filter( 'give_get_ip', 'my_give_remove_ip');
