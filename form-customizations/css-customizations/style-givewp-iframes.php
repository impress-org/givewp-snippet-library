<?php 

/**
 *  The multi-Step form template and the donor dashboard load in an iframe, which prevents theme styles from interfering with their styles.
 *  To style them, use this PHP snippet to add inline styles. Replace lines 16-26 with your custom styles.
 */

function override_iframe_template_styles_with_inline_styles() {
    wp_add_inline_style(
        /**
         *  Below, use give-sequoia-template-css to style the multi-step donation form
         *  or use give-donor-dashboards-app to style the donor dashboard
         */
        'give-sequoia-template-css',
        '
        /* add styles here! A sample (turns the headline text blue): */

        .introduction .headline {
            color: blue;
        }
        
        /* It changes the donor name on the donor dashboard to green: */
        
        .give-donor-dashboard-donor-info__details .give-donor-dashboard-donor-info__name {
            color: green;
        }
        '
    );
}

add_action('wp_print_styles', 'override_iframe_template_styles_with_inline_styles', 10);
