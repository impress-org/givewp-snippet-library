<?php

/*  
 *  Output html after a certain level on a multi-level form
 *
 */
 
 
add_filter( 'give_form_level_text', 'prefix_customize_give_buttons', 10, 3 );

function prefix_customize_give_buttons( $level_text, $form_id, $price ) {
	
	// Check for form_id and specific level text first
    if ( $form_id == 5798 && $level_text == 'Small' ) {
		
		// Return your custom HTML
        return $level_text . '<br /><span class="available">Available through 4/30</span>';
    }
	
	// Return all Level Texts
    return $level_text;
}