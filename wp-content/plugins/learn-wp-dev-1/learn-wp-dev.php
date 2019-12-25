<?php
/*
 * Plugin Name:       Plugin with OOP
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

if(!class_exists('LearnWPDev')):

final class LearnWPDev{
    private static $instance = null;

    private function __construct(){
        $this->initializeHooks();
    }

    public static function getInstance(){
        if(is_null(self::$instance))
            self::$instance = new self();

        return self::$instance;
    }

    private function initializeHooks(){
        if(is_admin()){
            require_once('admin/admin.php');
        }
        // include_once('menu.php');
    }
}

endif;

LearnWPDev::getInstance();


