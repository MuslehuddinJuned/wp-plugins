<?php

function hide_admin_bar(){
    $option = get_option( 'our-first-option');

    if($option === "yes") add_filter('show_admin_bar', '__return_false');
}
add_action('init', 'hide_admin_bar');

function register_our_settings(){
    register_setting('our-settings-group', 'our-first-option');
}
add_action('admin_init', 'register_our_settings');

function our_menu(){
    ?>
    <form action="options.php" method="post">
        <?php settings_fields( 'our-settings-group' ) ?>

        <input type="checkbox" id="hide-admin" name="our-first-option" value="yes" <?php checked( get_option('our-first-option'), 'yes' ) ?>>
        <label for="hide-admin">Hide Admin Bar at Frontend?</label>

        <?php submit_button('Save')?>
    </form>
    <?php
}

function build_our_menu(){
    // wp inits backend menu...
    add_menu_page('Page title', 'menu_title', 'administrator', 'our_menu_slug', 'our_menu', 'dashicons-star-filled');
    add_submenu_page( 'our_menu_slug', 'sub_page_title', 'sub_menu_title', 'administrator', 'sub_menu_slug', 'our_menu');
}

add_action('admin_menu', 'build_our_menu');