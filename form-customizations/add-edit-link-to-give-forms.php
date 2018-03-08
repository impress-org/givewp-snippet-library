<?php

/**
 *  Adds Edit link only on Single Give Form pages
 *
 **/
 
add_action('give_post_form_output', 'give_add_edit_form_link');

function give_add_edit_form_link() {

    if (current_user_can('edit_give_forms') && is_singular('give_forms')) {
	   edit_post_link('Edit this donation form', '<p>', '</p>');
    }
}
