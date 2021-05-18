<?php
/**
 *  The multi-Step form template and the donor dashboard load in an iframe, which prevents theme styles from interfering with their styles.
 *  To style them, use this PHP snippet to add inline styles. 
 *  
 *  Make sure you create the form-template-styles.css file with the CSS styles you'll use.
 */


function my_custom_override_iframe_template_styles() {
    wp_enqueue_style(
        'form-template-styles',
        get_template_directory_uri() . '/form-template-styles.css',
        /**
         *  Below, use give-sequoia-template-css to style the multi-step donation form
         *  or use give-donor-dashboards-app to style the donor dashboard
         */
        'give-sequoia-template-css'
    );
}

add_action('wp_print_styles', 'my_custom_override_iframe_template_styles', 10);
