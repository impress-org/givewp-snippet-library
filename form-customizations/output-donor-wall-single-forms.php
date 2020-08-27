<?php
/**
 * Output the donor wall for a specific form below the single form.
 *
 * This action outputs the [give_donor_wall] shortcode below all forms.
 *
 * @param $form outputs only the Form ID.
 *
 * @return string
 */

add_action('give_post_form_output', 'custom_output_single_donor_wall');

function custom_output_single_donor_wall( $form ) {

    // Only show on single Give forms
    if (is_singular('give_forms'))
        
        // do the [give_donor_wall] shortcode and populate the form ID
        echo '<h3>Special Thanks to our Donors:</h3>';
        echo do_shortcode('[give_donor_wall form_id="' . $form . '"]');

}
