<?php
/**
 * Changes the 'Receipt-' prefix of the pdf receipt filename
 * Change 'YOUR TEXT HERE' to your desired text.
 *
 * @return string
 */

function my_give_pdf_receipt_filename_changer() {
        $newname = 'YOUR-TEXT-HERE';
        return $newname;
}
    
add_filter( 'give_pdf_receipt_filename_prefix', 'my_give_pdf_receipt_filename_changer' );
