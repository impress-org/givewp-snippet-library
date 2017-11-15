<?php
/**
 * Disables the Show Terms toggle link and forces the terms to always appear.
 */
function disable_give_terms_slidein() {

	// Only if jQuery is present and on single give form. You can customize as needed.
	if ( wp_script_is( 'jquery', 'done' ) && is_singular( 'give_forms' ) ) { ?>

		<script type="text/javascript">
					jQuery( '#give_show_terms a' ).removeClass( function() {
						return jQuery( this ).attr( 'class', 'show_always' );
					} );
		</script>

		<style>
			#give_show_terms {
				display: none;
			}

			#give_terms {
				display: block !important;
			}
		</style>

	<?php }
}

add_action( 'wp_footer', 'disable_give_terms_slidein' );
