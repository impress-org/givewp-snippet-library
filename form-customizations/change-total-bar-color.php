<?php
/**
 * This snippet changes the color of the Progress bar on a [give_totals] shortcode.
 * 
 * The example here changes the color to Black. 
 */
 
function my_give_switch_total_bar_color() {
    $color = "#000";
    
    return $color;
}

add_filter( 'give_totals_progress_color', 'my_give_switch_total_bar_color' );