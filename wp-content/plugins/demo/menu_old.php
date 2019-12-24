<?php

function our_menu(){
    echo "Hello World";
}

function build_our_menu(){
    // wp inits backend menu...
    add_menu_page('Page title', 'menu_title', 'administrator', 'our_menu_slug', 'our_menu', 'dashicons-star-filled');
    add_submenu_page( 'our_menu_slug', 'sub_page_title', 'sub_menu_title', 'administrator', 'sub_menu_slug', 'our_menu');
}

add_action('admin_menu', 'build_our_menu');