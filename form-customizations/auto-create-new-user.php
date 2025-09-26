<?php

/**
 * Default the "Create an account" checkbox to checked and hide it
 * In order to use this, you will need to enable registration in the option-based form settings.
 *
 */
add_action('give_donation_form_after_submit', function () {
?>
    <script>
        jQuery("input[name=give_create_account][value='on']").prop("checked", true);
        jQuery("input[name=give_create_account]").closest("fieldset").hide();
    </script>
<?php
});
