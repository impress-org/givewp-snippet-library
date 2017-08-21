<?php
/**
 * Support other languages with a custom font that supports the font
 *
 * Notes: Font must be TTF true type format. Be careful testing on localhost due to directory write and permission issues.
 *
 * @return string
 */
function give_pdf_receipts_support_languages() {

	// Font must be .ttf (truetype) format.
	$custom_font = 'https://recurring.givewp.com/wp-content/uploads/fonts/SimSun.ttf';

	ob_start();
	?>

	<style>
		@font-face {
			font-family: 'SimSun';
			font-style: normal;
			font-weight: normal;
			src: url('<?php echo $custom_font; ?>') format('truetype');
		}

		@font-face {
			font-family: 'SimSun';
			font-style: italic;
			src: url('<?php echo $custom_font; ?>') format('truetype');
		}

		@font-face {
			font-family: 'SimSun';
			font-style: italic;
			font-weight: bold;
			src: url('<?php echo $custom_font; ?>') format('truetype');
		}

		@font-face {
			font-family: 'SimSun';
			font-style: normal;
			font-weight: bold;
			src: url('<?php echo $custom_font; ?>') format('truetype');
		}

		html, body {
			margin: 0;
			padding: 0;
		}

		*, body, div, html {
			font-family: 'SimSun', sans-serif !important;
		}
	</style>

	<?php

	return ob_get_clean();
}

add_filter( 'give_pdf_header_styles', 'give_pdf_receipts_support_languages', 1 );