<?php
/**
 * Customize the remaining page height background for your PDF Receipts.
 *
 * By default the color of the remaining height of PDFs matches the default receipt. If you customize the main background you can change the remaining height background color
 * (using RGB colors).
 *
 * @return int[]
 */
function my_custom_pdf_receipt_bg(){
	return array( 255, 255, 255 );
}

add_filter('give_pdf_receipt_remain_bottom_height_bg', 'my_custom_pdf_receipt_bg');
add_filter('give_pdf_receipt_remain_height_bg', 'my_custom_pdf_receipt_bg');
