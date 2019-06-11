<?php
/**
 * Customize the Default featured image throughout the site
 *
 * @return string
 */
 
add_filter('give_placeholder_img_src', 'my_default_give_image');

function my_default_give_image() {

    $placeholder_url = 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/50/RedPandaFullBody.JPG/1200px-RedPandaFullBody.JPG';

    return $placeholder_url;
}
