<?php
/*  Unselectize Give select elements
 *  
 *  The selectize.js script prevents HTML5 alerts from appearing correctly.
 *  This script removes selectize from the Country and State fields in Give forms
 *  
 */
 
add_action('wp_footer', 'give_unselectize_give_forms');

function give_unselectize_give_forms() {
		// Only for if the fields are in a modal
		// The script runs after Magnific is opened.
		
		?>
		<script>

            ( function( $ ) {
                $( document ).on( 'mfpOpen', function() {

                    var $select = $('select.give-select').selectize();

                    $select[0].selectize.destroy();
                    $select[1].selectize.destroy();

                } );
            } )( jQuery );
		</script>
		<?php
}
