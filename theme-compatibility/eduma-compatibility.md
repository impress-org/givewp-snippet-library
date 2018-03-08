## How to make the Eduma Theme Compatibile with Give

1. Add this custom function to your functions.php file:
```
add_action('wp_footer', 'give_fix_js_theme_conflict');

function give_fix_js_theme_conflict() { ?>
	<script>
        function fix_js() {
            jQuery('body').removeClass('thim-body-preload', 1000);
            jQuery('div#preload').fadeOut(1000);
        }

        jQuery(document).ready(function( $ ) {
            setTimeout(fix_js, 200);
        });
	</script>

	<?php
}

add_filter('give_default_wrapper_start', 'eduma_give_template_start');
add_filter('give_default_wrapper_end', 'eduma_give_template_end');

function eduma_give_template_start() {

	$templatestart = '<article id="' . get_the_ID(). '" class="'. join( ' ', get_post_class() ) .'">';
	$templatestart .= '<div class="entry-content">';

	return $templatestart;
}

function eduma_give_template_end() {
	$templateend = '</div></article>';

	return $templateend;
}
```

2. Add this to your theme's style.css file:
```
body.single.give-page article .entry-summary {
    clear:none;
}
```
