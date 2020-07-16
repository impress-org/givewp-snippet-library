<?php 

/**
 *  The Multi-Step form template loads in an iframe, which prevents theme styles from interfering with form styles.
 *  To style Multi-Step forms, use this PHP snippet to add inline styles. Replace lines 13-17 with your custom styles.
 *
 */

function override_form_template_styles_with_inline_styles() {
    wp_add_inline_style(
        'give-sequoia-template-css',
        '
        /* add styles here! A sample (turns the headline text blue): */

        .introduction .headline {
            color: blue;
        }
        '
    );
}

add_action('wp_print_styles', 'override_form_template_styles_with_inline_styles', 10);
