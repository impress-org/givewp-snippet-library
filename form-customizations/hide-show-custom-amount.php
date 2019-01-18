/*
 *  Hide/Show Custom Amount when Custom Amount Button is clicked
 *
 *
 */
 
 function myprefix_give_hide_amount_onclick() { ?>

    <script>
        jQuery(".give-total-wrap").hide();

        jQuery(document).ready(function($) {
            $('button[data-price-id="custom"').click(function(){
                $('.give-total-wrap').slideDown();
            });
            $('button[class*="give-donation-level"]:not(.give-btn-level-custom)').click(function(){
                $('.give-total-wrap').slideUp();
            });
        });
    </script>

<?php }

add_action( 'give_payment_mode_top', 'myprefix_give_hide_amount_onclick' );
