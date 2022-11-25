<?php
/**
 *  The multi-step form template and the donor dashboard load in an iframe, which prevents theme styles from interfering with their styles.
 *  To style them, use this PHP snippet to add a custom stylesheet that styles the form or the donor dashboard.
 *  
 *  Make sure you create the givewp-iframes-styles.css file with the CSS styles you'll use.
 */


function my_custom_override_iframe_template_styles() {
    wp_enqueue_style(
        'givewp-iframes-styles',
        get_template_directory_uri() . '/givewp-iframes-styles.css',
        /**
         *  Below, use 'give-sequoia-template-css' to style the Multi-Step donation
         *  'give-classic-template' to style the Classic template
         *  or 'give-styles' to style the Donor Dashboard
         */
        'give-sequoia-template-css'
    );
}

add_action('wp_print_styles', 'my_custom_override_iframe_template_styles', 10);
