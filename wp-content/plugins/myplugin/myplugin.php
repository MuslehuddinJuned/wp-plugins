<?php
/**
 * Plugin Name:       MyPlugin
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Handle the basics with this plugin.
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Muslehuddin Juned
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       my-basics-plugin
 * Domain Path:       /languages
 */

 add_filter('admin_footer_text', 'my_custom_footer');
 add_action('admin_bar_menu', 'add_my_own_menu');
 add_shortcode('myshortcode', 'myshortcodefunction');
 add_action('admin_menu', 'build_our_first_menu');
 function my_custom_footer(){
     return '<p style="color: green;">It is footer text</p>';
 }

 function add_my_own_menu (){
     global $wp_admin_bar;

     $custom_menu = array(
         'id' => 'demo_menu',
         'title' => 'my plugin',
         'parent' =>'top-secondary',
         'href' => site_url()
     );

     $wp_admin_bar->add_node($custom_menu);
 }

 function myshortcodefunction(){
     return "Our shortcodes works";
 }
function our_menu_callback(){
    echo "Hello Juned";
}
 function build_our_first_menu(){
     add_menu_page( 
         'My Page Title', 
         'My Menu Title', 
         'administrator', 
         'my_slug', 
         'our_menu_callback', 
         'dashicons-star-filled');
    add_submenu_page(
        'my_slug', 
        'Submenu Page Title', 
        'Submenu Title', 
        'administrator', 
        'my_submenu_slug', 
        'our_menu_callback');
 }