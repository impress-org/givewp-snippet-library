<?php
/**
 * CLOSED GIVE FORM ADDITIONAL HTML
 *
 * The following checks whether a form is closed or not,
 * then outputs custom HTML after the Closed Form message.
 */

add_action('give_post_form_output', 'custom_closed_output', 99, 2);

function custom_closed_output($form, $args) {
    global $post;
    $give = new Give_Donate_Form();

    if ( get_post_meta( $post->ID, '_give_close_form_when_goal_achieved', true )
        && ( $give->get_goal() <= $give->get_earnings() ) ) {

        echo "<p>Your Custom Message here. Form title = " . get_the_title($post->ID) . "</p>";
    }

}