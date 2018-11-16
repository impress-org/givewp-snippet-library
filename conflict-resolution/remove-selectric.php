<?php

/**
 *  Destroy's the Selectric.js from running on Currency Switcher
 *   
 *  The Selectric.js script is popular with themes, and makes dropdowns look nice.
 *  but it causes problems with our Currency Switcher dropdown on forms.
 *  It's not easy to "destroy" this correctly, see this issue as a reference:
 *
 *
 */
 
 
// Only destroys on modal click
function my_give_destroy_onclick_selectric() { ?>
    <script>

		jQuery( "button.give-btn-modal" ).click(function($) {
			var Selectric = jQuery('.give-cs-select-currency').data('selectric'); 
			
			if (Selectric) {
  				jQuery('.give-cs-select-currency').selectric('destroy');
			}
			
		});
    </script>

<?php }

add_action( 'wp_footer', 'my_give_destroy_onclick_selectric', 999999 );

// Should destroy after the page is fully loaded
function my_give_destroy_onload_selectric() { ?>
    <script>

		jQuery(window).bind("load", function($) {
			var Selectric = jQuery('.give-cs-select-currency').data('selectric'); 
			
			if (Selectric) {
  				jQuery('.give-cs-select-currency').selectric('destroy');
			}
			
		});
    </script>

<?php }

add_action( 'wp_footer', 'my_give_destroy_selectric', 999999 );
