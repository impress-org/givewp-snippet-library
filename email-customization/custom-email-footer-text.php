<?php
/**
 * Change the Site Title linked text in the footer of the email.
 * By Default, the site title is linked in the footer of emails, this snippet allows you to change that and supports a link.
 *
 * @return string
 */
    
    function my_give_change_email_footer_text() {
        return '<a href="https://example.com">Some Words</a>';
    }
    
    add_filter( 'give_email_footer_text', 'my_give_change_email_footer_text' );
