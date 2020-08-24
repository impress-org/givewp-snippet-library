<?php
/**
 *  The Multi-Step form template loads in an iframe, which prevents theme styles from interfering with form styles.
 *  To style Multi-Step forms, use this PHP snippet to add a custom stylesheet that styles the form. 
 *  
 */


function my_custom_override_form_template_styles() {
    wp_enqueue_style(
        'form-template-styles',
        get_template_directory_uri() . '/form-template-styles.css',
        'give-sequoia-template-css'
    );
}

add_action('wp_print_styles', 'my_custom_override_form_template_styles', 10);
