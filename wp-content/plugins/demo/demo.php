<?php
/*
 * Plugin Name:       Demo
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Handle the basics with this plugin.
 * Version:           1.0.0
 * Requires at least: 4.0
 * Requires PHP:      7.0
 * Author:            Muslehuddin
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       my-basics-plugin
 * Domain Path:       /languages
*/

function footer_text($text){
    return "<p style='color:green;'>hello, lets build the plugin $text</p>";
}
add_filter('admin_footer_text', 'footer_text');

function header_menu(){
    global $wp_admin_bar;

    $custom_menu = array(
        'id' => 'demo_menu',
        'title' => 'first plugin menu',
        'parent' => 'top-secondary',
        'href' => site_url()
    );

    $wp_admin_bar->add_node($custom_menu);
}
add_action('admin_bar_menu', 'header_menu');

function first_short_code($attr){

    wp_enqueue_script('myJS', plugins_url( ). '/demo/myJS.js');
    wp_enqueue_style('myCSS', plugins_url( ). '/demo/myCSS.css');

    if(isset($attr['attribute'])) return '<p class="our_demo_class" onclick="changeColor()" id="our_demo">'.$attr['attribute'].'</p>';
    else 
    return '<p class="our_demo_class" onclick="changeColor()" id="our_demo">My name is Juned</p>';
}
add_shortcode('first_short_code', 'first_short_code');

include_once('menu.php');