<?php
/**
 * Add a custom tag to be supported in PDF Receipts
 *
 * This tag adds a new {LABEL} tag which populates with Form Field Manager Meta tag data. Replace LABEL in three places in the code (and here in the comment?), and replace the REPLACE WITH FFM META tag with the appropriate Form Field Manager meta tag.
 *
 * @param $template_content
 * @param $args
 *
 * @return mixed
 */

        
function give_add_LABEL_pdf_tag( $template_content, $args ) {
            
    // during testing, uncomment the next line to see a full printed array of the possible args that you can query
    // var_dump("<pre>".print_r($args,true)."</pre>");
            
    $total     = isset( $args['payment_meta']['REPLACE WITH FFM META'] ) ? html_entity_decode( $args['payment_meta']['REPLACE WITH FFM META'], ENT_COMPAT, 'UTF-8' ) : '';
    $template_content = str_replace( '{LABEL}', $total, $template_content );
    return $template_content;
}
        
add_filter( 'give_pdf_compiled_template_content', 'give_add_LABEL_pdf_tag', 999, 2 );
    
