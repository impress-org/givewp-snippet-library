<?php

/*
 * Disables the Show Terms toggle link
 * And forces the terms to always appear
 */

function disable_give_terms_slidein() {
	if ( wp_script_is( 'jquery', 'done' ) && is_singular('give_forms') ) { ?>
		
		<script type="text/javascript">
			jQuery( "#give_show_terms a" ).removeClass(function($) {
				return jQuery( this ).attr("class", "show_always");
			});
		</script>
		
		<style>
			#give_show_terms {display: none;}
			#give_terms {display: block !important;}
		</style>
		
	<?php }
}

add_action( 'wp_footer', 'disable_give_terms_slidein' );
