<?php
//This function adds the WeGlog Script to the entire site.
//It's based on WeGlot's Javascript implementation
//https://developers.weglot.com/javascript/javascript
add_action( 'wp_footer', 'weglot_js' );
function weglot_js() {
	
	wp_enqueue_script(
			'givewp-we-glot-iframe',
			'https://cdn.weglot.com/weglot.min.js',
			[],
			GIVE_VERSION
		);

	wp_add_inline_script( 'givewp-we-glot-iframe', '
		Weglot.initialize({
    	api_key: "YOUR WEGLOT API HERE",
    	translate_iframes: ["#iFrameResizer0"]
		});
	' );

}


//This function adds the WeGlog Script to GiveWP iframes (The Donor Dashboard and multistep for templates.
//It's based on WeGlot's Javascript implementation
//https://developers.weglot.com/javascript/translate-iframe
add_action( 'give_embed_head', 'weGlotIframeScript' );
function weGlotIframeScript(){
	
		wp_enqueue_script(
			'givewp-we-glot-iframe',
			'https://cdn.weglot.com/weglot.min.js',
			[],
			GIVE_VERSION
		);
}

add_action( 'give_embed_head', 'givewp_weglot_js' );
function givewp_weglot_js() {

	wp_add_inline_script( 'givewp-we-glot-iframe', '
		Weglot.initialize({
    	api_key: "YOUR WEGLOT API HERE",
    	hide_switcher: true // You already have a switcher in parent window
		});
	' );

}





